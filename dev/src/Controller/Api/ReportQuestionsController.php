<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;
use Cake\ORM\TableRegistry;
use Ideauno\RequestStatus;


class ReportQuestionsController extends AppController
{
    public $id_local = null;

    public function initialize()
    {
        parent::initialize();
    }

    /*
    *  Mecánico
    *
    */

    // Preguntas para informe de Salud.
    public function health(){
        // mecánico
        $user = $this->getUser();
        // id del trabajo
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : null;
        if($id == null || $id == ""){
            throw new BadRequestException('Invalid Request: ID is not present');
        }

        // default values
        $questions = null;
        $status = false;
        $message = '';
        $hasReport = false;

        // buscar request
        $requests = TableRegistry::get('Requests');
        $request = $requests->find()
            ->where(['Requests.id'=>$id])
            ->contain(['Reports'])
            ->first();

        // Buscando reporte de servicio
       $report_table = TableRegistry::get('Reports');
       $report_service = $report_table->find()
            ->where(['Reports.request_id'=>$id,'Reports.report_question_category_id'=>2])
            ->count();

       // si no tiene informe de salud
       // Buscar preguntas para informe de salud
       // de categoria = 2 con preguntas y alternativas activas.
       if($report_service == 0){
           $questions = $this->ReportQuestions->find()
               ->where(['ReportQuestions.report_question_category_id' => 2,'ReportQuestions.active' => true])
               ->select(['ReportQuestions.id','ReportQuestions.content','ReportQuestions.tips'])
               ->contain([
                   'ReportQuestionAlternatives' => function($q){
                       return $q
                        ->select(['ReportQuestionAlternatives.id','ReportQuestionAlternatives.content','ReportQuestionAlternatives.report_question_id','ReportQuestionAlternatives.score'])
                        ->where(['ReportQuestionAlternatives.active' => true]);
                   }
               ])
               //->limit(5)
               //->order(['ReportQuestions.id' => 'DESC'])
               ->toArray();

           $status = true;
       }
       else{
           $hasReport = true;
           $message = 'Ya se realizó el informe de servicio';
       }

        // retorno.
        $this->set([
            'success' => $status,
            'message' => $message,
            'data' => ['questions'=> $questions,'hasReport'=>$hasReport],
            '_serialize' => ['success', 'message','data']
        ]);
    }


    public function save_report_health(){
        // usuario en session
        $user = $this->getUser();

        // Revisar si el id del trabajo existe y pertenece al mecánico
        $id_request = isset($this->request->data['id']) ? $this->request->data['id'] : null;
        if($id_request == null || $id_request == ""){
            throw new BadRequestException('Invalid Request: ID is not present');
        }

        $status = false;
        $data = ['class'=>'error'];
        $message = 'Error x';
        $request_table = TableRegistry::get('Requests');
        $request = $request_table->find()->where(['Requests.id'=> $id_request])->first();

        // No existe request o No pertence al mecanico
        if(!$request || $request->mechanic_id != $user['id']){
            throw new ForbiddenException('Not has permission');
        }
        else{
            // Crear reporte de servicio y las respuesas correspondientes.
            $report_table = TableRegistry::get('Reports');
            $report = $report_table->newEntity();
            $report->user_id = $user['id'];  // id del usuario mecánico
            $report->request_id = $request->id; // numero de solicitud (trabajo)
            $report->report_question_category_id = 2; // informe de servicio
            $report->total = $this->request->data['answers']['total_score']; // total score

            // guardar reporte
            $count_save = 0;
            $message = 'Error al guardar su informe de servicio. Por favor intente más tarde';
            if($report_table->save($report)){
                // guardar respuestas del reporte
                foreach ($this->request->data['answers']['radios'] as $key => $answer) {
                    $new_row = $this->ReportQuestions->ReportQuestionAnswers->newEntity();
                    $new_row->report_question_id = $answer['question_id'];
                    $new_row->report_question_alternative_id = $answer['alternative'];
                    $new_row->report_question_category_id = 3; // informe de servicio
                    $new_row->score = $answer['score']; // puntaje de alternativa
                    $new_row->report_id = $report->id;

                    if($this->ReportQuestions->ReportQuestionAnswers->save($new_row)){
                        $count_save++;
                    }
                }
                // si todo va bien, entonces setiar mensaje de exito.
                if(count($this->request->data['answers']['radios']) == $count_save){
                    $status = true;
                    $message = 'Informe guardado correctamente.';
                    $data['class'] = 'success';
                    $data['title'] = 'Informe de Salud';
                }
                else{
                    // Algún error al guardar las alternativas
                    // Borrar registros "request" y las posibles resuestas.
                    $message = 'Ocurrió un error con sus alternativas, por favor intente más tarde.';
                    $report_table->delete($report);
                }
            }
            else {
                 $message = 'Error el guardar el informe de salud. Intente más tarde';
            }
        }

        $this->set([
            'success' => $status,
            'message' => $message,
            'data' => $data,
            'request' => $id_request,
            '_serialize' => ['success','message','data','request']
        ]);

    }


    // Cuando un mecánico seleccione "Finalizar un Trabajo".
    // se envián las preguntas sobre el  servicio prestado
    public function service(){
        // usuario en session
        $user = $this->getUser();
        // id de request
        $id = $this->request->data['id'];

        // default
        $questions = null;
        $status = false;
        $message = '';

        // enviar datos de request [por ahora no]
        // $requests = TableRegistry::get('Requests');
        // $request = $requests->find()
        //     ->where(['Requests.id'=>$id])
        //     ->contain(['Reports'])
        //     ->first();

        // buscando reporte de servicio
       $report_table = TableRegistry::get('Reports');
       $report_service = $report_table->find()
            ->where(['Reports.request_id'=>$id,'Reports.report_question_category_id'=>3])
            ->count();

       if($report_service == 0){
           // preguntas para informe de servicio categoria = 3
           $questions = $this->ReportQuestions->find()
               ->where(['report_question_category_id' =>3])
               ->contain(['ReportQuestionAlternatives'])
               ->toArray();

           $status = $questions ? true: false;
       }
       else{
           $message = 'Ya se realizó el informe de servicio';
       }

        // respuestas.
        $this->set([
            'success' => true,
            'message' => $message,
            'data' => ['questions'=> $questions],
            '_serialize' => ['success', 'message','data']
        ]);
    }

    //  Respuesta del informe de servicio
    //  Recibe por POST
    //  id     [integer]    id del request
    //  radios [array]      respuestas del informe => [question_id:integer, alternative:integer, comment:string?]
    //  rate   [integer]    valoración del cliente (1..5)
    public function save_report_service(){
        // usuario en session
        $user = $this->getUser();

        // Revisar si el id del trabajo existe y pertenece al mecánico
        $id_request = isset($this->request->data['id']) ? $this->request->data['id'] : null;
        if(!$id_request || $id_request == ""){
            throw new BadRequestException('Bad Request, id is not Present');
        }

        $status = false;
        $data = ['class'=>'error'];
        $request_table = TableRegistry::get('Requests');
        $request = $request_table->find()->where(['Requests.id'=> $id_request])->first();

        // No existe request o No pertence al mecanico
        if(!$request || $request->mechanic_id != $user['id']){
            throw new ForbiddenException('Not has permission');
        }
        else{
            // Crear reporte de servicio y las respuesas correspondientes.
            $report_table = TableRegistry::get('Reports');
            $report = $report_table->newEntity();
            $report->user_id = $user['id'];  // id del usuario mecánico
            $report->request_id = $request->id; // numero de solicitud (trabajo)
            $report->report_question_category_id = 3; // informe de servicio
            $report->total = 0; // total de puntos del informe, en éste caso no aplica.

            // guardar reporte
            $count_save = 0;
            $message = 'Error al guardar su informe de servicio. Por favor intente más tarde';
            if($report_table->save($report)){
                // guardar respuestas del reporte
                foreach ($this->request->data['answers']['radios'] as $key => $answer) {
                    $new_row = $this->ReportQuestions->ReportQuestionAnswers->newEntity();
                    $new_row->report_question_id = $answer['question_id'];
                    $new_row->report_question_alternative_id = $answer['alternative'];
                    $new_row->report_question_category_id = 3; // informe de servicio
                    $new_row->score = 0;  // no aplica
                    $new_row->report_id = $report->id;
                    $new_row->comment = $answer['has_comment'] ? $answer['comment'] : null;

                    if($this->ReportQuestions->ReportQuestionAnswers->save($new_row)){
                        $count_save++;
                    }
                }
                // si todo va bien, entonces setiar mensaje de exito.
                if(count($this->request->data['answers']['radios']) == $count_save){

                    // Guardar rate: calificación del mecánico al cliente
                    $qualification_table = TableRegistry::get('QualificationsToClients');
                    $qualify = $qualification_table->newEntity();
                    $qualify->client_id = $request->client_id;
                    $qualify->mechanic_id = $request->mechanic_id;
                    $qualify->request_id = $request->id;
                    $qualify->score = $this->request->data['answers']['rate'];
                    $qualify->observations = $this->request->data['answers']['obs'];

                    // Guardar calificación
                    if($qualification_table->save($qualify)){

                        // Entonces cambiar estado a finalizado.
                        $request->status = RequestStatus::Finalizada;
                        $request->finish_time = new \DateTime();

                        if($request_table->save($request)){
                            $status = true;
                            $message = 'Trabajo Finalizado correctamente.';
                            $data['class'] = 'success';
                            $data['title'] = 'Trabajo Finalizado';
                        }
                        else{
                            // rollback, para que sea consistente
                            // Error en actualizar request, por lo tanto
                            // Borrar reporte y respuestas.
                            // Enviar menssaje de error.
                            $report_table->delete($report);
                            $data['error'] = 'Error al finalizar trabajo';
                        }

                    }
                    else{
                        // rollback, para que sea consistente.
                        // Error en calificación, por lo tanto
                        // Borrar reporte y respuestas. (reports y report_question_answers)
                        // Enviar menssaje de error.
                        $report_table->delete($report);
                        $data['error'] = 'Error de calificación';
                    }

                }
                else{
                    // Algún error al guardar las alternativas
                    $message = 'Ocurrió un error con sus alternativas, por favor intente más tarde.';
                    // Borrar registros "request" y las posibles resuestas.
                }
            }
        }

        $this->set([
            'success' => $status,
            'message' => $message,
            'data' => $data,
            '_serialize' => ['success','message','data']
        ]);

    }




}
