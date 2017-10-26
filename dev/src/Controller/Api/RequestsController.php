<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;
use Firebase\JWT\JWT;
use Cake\Utility\Text;
use Cake\Utility\Security;
use Ideauno\RequestStatus;
use Ideauno\ServicesModStatus;
use Ideauno\UserRoles;
use Cake\ORM\TableRegistry;
use Cake\Mailer\Email;


/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AppController
{

    public $id_request = null;
    public $id_local = null;
    public $id_user= null;
    public $items = null;
    public $items2=null;
    public $itemsModIds= null;
    public $total_price_l = null;
    public $paymentsdata = [];
    public $user = null;
    public $status = null;
    public $diagnostics_id = null;
    public $userClient= null;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Message');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        // Para el mecánico
        // solicitud pendientes
        $this->Crud->mapAction('myworks', [
            'className' => 'Crud.Index',
        ]);

        // ver solicitud
        $this->Crud->mapAction('showwork', [
            'className' => 'Crud.View',
        ]);

        $this->Crud->mapAction('delete', [
            'className' => 'Crud.Edit',
            'view' => 'delete'
        ]);
    }




    public function view($id = null ){
        $user = $this->Auth->identify();
        $this->id_local = $id;
        $this->id_user = $user['id'];
        $this->Crud->on('beforeFind', function(Event $event) {
             $event->subject()
                ->query
                ->where(['Requests.id' => $this->id_local, 'client_id'=>$this->id_user])
                ->find('all')
                //->select(['Requests.id','client_id','mechanic_id','car_id','address_name','address_number','address_complement','city_id','commune_id','start_time_schedule_requested','total_price'])
                ->contain(['Cars'])
                ->contain(['Cars.CarBrands'])
                ->contain(['Cars.CarModels'])
                ->contain(['RequestsMechanicMods.AvailableServices'])
                ->contain(['Mechanics'=> function($q){
                    return $q->select([
                        'name',
                        'last_name',
                        'email',
                        'phone1',
                        ]);
                }])->contain(['AvailableServices'=> function ($q) {
                    return $q->autoFields(false)
                             ->select(['id','requests_type_id','name','estimated_time', 'real_estimated_time', 'total_price', 'inspection'])
                             ->where(['AvailableServices.active' => 1]);
                    }
                ]);
        });

        return $this->Crud->execute();
    }



    /**
    *
    *     Mecánico
    *
    */

    // trabajo actual
    public function mycurrentwork($id = null){

      // set local
      $this->user = $this->getUser();

          // conditions
          $conditions = [];
          $conditions['Requests.mechanic_id'] = $this->user['id'];
          $conditions['Requests.status'] = RequestStatus::EnCurso;

         // find current request (trabajo en curso)
          $request = $this->Requests->find()
             ->where($conditions)
             ->select(['id','client_id','mechanic_id','status','start_time_schedule_requested'])
             ->contain([
                 'Cars' =>  function($q){
                     return $q->select(['patent']);
                 },
                 'Clients'=> function($q){
                     return $q->select(['name','last_name','email','phone1']);
                 }
             ])
             ->order(['Requests.start_time_schedule_requested DESC'])
             ->first();

        // Response
         $status = $request ? true : false;
         $this->set([
             'success' => $status,
             'data' => $request,
             '_serialize' => ['success','data']
         ]);

    }

    // listado de trabajos pendientes de un mecánico
    public function myworks(){
      // set local
     $this->user = $this->getUser();

     // query
     $this->Crud->on('beforePaginate',function(Event $event){
         $conditions['Requests.mechanic_id'] = $this->user['id'];
         $conditions= array('OR' => array(
                array('Requests.status' => RequestStatus::EnEsperaTrabajo),
                array('Requests.status' => RequestStatus::ModMecanico)
            )
        );
         $event->subject()->query->where($conditions)
            ->select(['id','client_id','mechanic_id','status','start_time_schedule_requested'])
            ->contain([
                //'RequestsMechanicMods.AvailableServices',
                //'AvailableServices'=>['RequestsTypes'],
                'Cars' =>  function($q){
                    return $q->select(['patent']);
                },
                'Clients'=> function($q){
                    return $q->select(['name','last_name','email','phone1']);
                }
            ]);
      });
      return $this->Crud->execute();
    }

    // Datos de un trabajo en particular.
    public function showwork($id = null){

      // set local
      $this->id_request = $id;
      $user = $this->Auth->identify();
      $this->user = $user;
      if (!$user) {
           throw new UnauthorizedException('Invalid username or password');
      }
      if($id == null){
           throw new BadRequestException('Invalid request');
      }

      $this->Crud->on('beforeFind',function(Event $event){
          $conditions['Requests.id'] = $this->id_request;
          $conditions['Requests.mechanic_id'] = $this->user['id'];
          $event->subject()->query
            ->where($conditions)
            ->contain([
                'Cars',
                'RequestsMechanicMods.AvailableServices',
                'AvailableServices'=> function ($q) {
                    return $q->autoFields(false)
                        ->select(['id','requests_type_id','name','estimated_time', 'real_estimated_time', 'total_price', 'inspection'])
                        ->where(['AvailableServices.active' => 1]);
                },
                'Clients'=> function($q){
                    return $q->select(['name','last_name','email','phone1','phone2']);
                }
            ]);
      });

      return $this->Crud->execute();
    }

    // Enviar correo a fullmec notificando de llamar a mecánico
    public function callmenow(){

        $id = $this->request->data['id'];
        $request = $this->Requests->find()
            ->where(['Requests.id'=>$id])
            ->contain(['Mechanics'=> function($q){
                return $q->select([
                    'name',
                    'last_name',
                    'email',
                    'phone1',
                    ]);
            }])
            ->toArray();

        $response = [
            'class'=>'error',
            'status'=>false,
            'message'=>'No se envió el correo, por favor intente más tarde.'
        ];

        $data = [
            'to' => (defined('CFG_MAIL_CALL_MECHANIC') ? CFG_MAIL_CALL_MECHANIC : null),
            'title' => 'LLamar a mecánico',
            'subject' => 'Llmar a mecánico',
            'body' => ''
        ];

        // si todo bien, enviar correo.
        if ($request && $data['to']) {

            $data['body'] = "<p>Solicitud ID: {$request[0]->id}</p>";
            $data['body'] .= "<p>Nombre: {$request[0]->mechanic->full_name}</p>";
            $data['body'] .= "<p>Teléfono 1: {$request[0]->mechanic->phone1}</p>";
            $data['body'] .= "<p>Teléfono 2: {$request[0]->mechanic->phone2}</p>";

            if($this->Message->send($data)){
                $response['status'] = true;
                $response['class'] = "success";
                $response['title'] = 'Mensaje enviado';
                $response['message'] = 'Pronto te llamará un ejecutivo de Fullmec';
            }
        }

        // devolver datos
        $this->set([
            'success' => $response['status'],
            'response' => $response,
            '_serialize' => ['success', 'response']
        ]);


    }

    // Comenzar el Trabajo por Parte del Mecánico.
    public function start_work(){

        $this->user = $this->getUser();
        $id = isset($this->request->data['id']) ? $this->request->data['id'] : null;
        $response = [
            'status'  => false,
            'message' => 'No fué posible comenzar el trabajo',
            'class'   => 'error',
            'title'   => 'Error'
        ];

        // id del request ! null
        if($id){
            $request = $this->Requests->find()->where(['id'=>$id])->first();
            // Existe Trabajo y pertence al mecánico
            if($request && $request->mechanic_id == $this->user['id']){
                // Actualizar estado y fecha
                $request->status = RequestStatus::EnCurso;
                $request->start_time = new \DateTime();

                // ok actualización
                if($this->Requests->save($request)){
                    $response['status'] = true;
                    $response['message'] = 'Ha comenzado con el trabajo correctamente';
                    $response['class'] = 'success';
                    $response['title'] = 'Trabajo en Curso';
                }
                // error al actualizar.
                else{
                    $response['message'] = 'No fué posible comenzar el Trabajo. Por favor intente más tarde. Si el problema persiste, contacte a soporte de Fullmec';
                }
            }
        }

        $this->set([
            'success' => $response['status'],
            'data' => $response,
            '_serialize' => ['success', 'data']
        ]);
    }

    // Registar rechazo del mecácnico a un trabajo
    // y cambiar de estado el trabajo
    public function cancel_work(){

        // revisar si está logiado.
        $user = $this->getUser();

        $response = [
            'status'=>false,
            'message'=>'Error intente más tarde.',
            'class' =>'error',
            'title'=>'Error al Anular el trabajo'
        ];

        $id = isset($this->request->data['request_id']) ? $this->request->data['request_id'] : false;
        // no hay id de trabajo, error
        if($id == null){
            throw new BadRequestException('Invalid request');
        }

        // Buscar Request y Guardar Motivo.
        $request = $this->Requests->find()
            ->where(['Requests.id'=>$id])
            ->contain(['Clients'])
            ->first();

        // Si existe trabajo
        if($request){
            // Guardar registro
            $cancelation = $this->Requests->RequestCancelations->newEntity();
            $cancelation->request_id = $id;
            $cancelation->request_cancelation_option_id = $this->request->data['subject_id'];
            $cancelation->comment = $this->request->data['message'];

            // Si el Trabajo NO pertenece al mecánico, error
            if($request->mechanic_id != $user['id']){
                throw new BadRequestException('Invalid request');
            }

            // Registar anulación
            if($this->Requests->RequestCancelations->save($cancelation)){
                // Si se registra anulación entonces cambiar de estado el Trabajo
                $request->status = RequestStatus::AnuladaMecanico;
                if($this->Requests->save($request)){
                    // Si todo ok, entonces envió datos.
                    $response['status'] = true;
                    $response['class']  = 'success';
                    $response['message'] = 'Trabajo anulado correctamente';
                    $response['title'] = 'Trabajo Anulado';

                    // Enviar Correo a Cliente y Administrador Fullmec
                    $to = [$request->client->email,CFG_MAIL_GENERAL];
                    $body = "
                        <p>Estimado {$request->client->name} el trabajo #ID <strong>{$request->id}</strong> fue anulado</p>
                        <p>Mecánico: {$request->client->full_name}</p>
                        <p>Fecha anulación:".date('d-m-Y H:i:s')."</p>
                    ";
                    $data = [
                        'title' => 'Trabajo anulado por Mecánico',
                        'subject' => "Fullmec Trabajo {$request->id} Anulado",
                        'body'=> $body,
                        'to'=>$to
                    ];
                    $this->Message->send($data);
                }
                else{
                    // Escribir error
                    $response['message'] = 'Ocurrió un error al anular el trabajo';
                    // Borrar registro de anulación
                    $this->Requests->RequestCancelations->delete($cancelation);
                }
            }
            else{
                $response['message'] = 'Error al registar el motivo de Anulación de Trabajo';
            }
        }

        $this->set([
            'success' => $response['status'],
            'data' => $response,
            '_serialize' => ['success', 'data']
        ]);
    }



    /**
     * Edit method
     *
     *
     *  Se ejecuta:  url/requests/edit/id
     *  {
     *      action: 'id'
     *  }
     *
     *
     * @param string|null $id Request id.
     */

    /**
     * @api {post} /api/requests/edit/id_requests Editar Solicitudes
     * @apiVersion 0.1.0
     * @apiName edit
     * @apiGroup Requests
     *
     * @apiHeader {String} Authorization Auth header with JWT Token
     * @apiHeader {String} Accept Datos aceptados
     * @apiHeader {String} Content-Type Tipo de Datos
     *
     * @apiHeaderExample {String} Authorization-Example:
     * Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjIsImV4cCI6MTQ4NzU5....
     * Accept: application/json
     * Content-type: application/json
     *
     * @apiParam {String} pordefinir Por definir
     *
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data detalles del registro.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": [
     *            {
     *                "id": "1",
     *                "token": "token",
     *                "message": "Solicitud finalizada"
     *            },
     *     }
     *
     * @apiError RequestsBadResponse Registro no realizado
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function edit($id = null)
    {
        $action = $this->request->data['action'];
        $this->id_request = $id;
        $user = $this->Auth->identify();

        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }

        switch ($action) {
            case 'finish':
                $this->Crud->on('beforeFind',function(Event $event){
                    $event->subject()->query->where(['id'=>$this->id_request]);
                });

                $this->Crud->on('beforeSave', function(Event $event) {
                    $event->subject()->entity->status = RequestStatus::Finalizada;
                });

                $this->Crud->on('afterSave', function(Event $event) {

                    // Busco correo del cliente
                    $client = $this->Requests->Clients->find()
                        ->where(['id'=>$event->subject->entity->client_id])
                        ->select(['Clients.email'])
                        ->first();

                    $user = $this->Auth->identify();
                    $this->set('data', [
                        'id'      => $event->subject->entity->id,
                        'token'   => __token($user["id"], CFG_TIME_TOKEN),
                        'message' => 'Solicitud Finalizada',
                    ]);

                    // Enviar correo de notificación el Cliente, avisando que califique al Mecánico.
                    $data = ['to'=>$client->email,'body'=>'<p>Recuerde calificar a su mecánico, por el servicio prestado.</p>'];
                    $this->Message->send($data);

                    // devolver datos json.
                    $this->Crud->action()->config('serialize.data', 'data');
                });

                break;

            case 'changeDocument':
                $this->paymentsdata['payment_method_id'] = $this->request->data['requests_types_id'];
                $this->paymentsdata['request_id']        = $this->id_request;
                $this->paymentsdata['user_id']           = $user['id'];
                $this->paymentsdata['amount']            = $this->request->data['total_price'];
                $this->paymentsdata['paid']              = 0;
                $this->paymentsdata['active']            = true;
                $this->Crud->on('beforeFind',function(Event $event){
                    $event->subject()->query->where(['id'=>$this->id_request]);
                });

                $this->Crud->on('afterSave', function(Event $event) {

                    $user = $this->Auth->identify();

                    //Se guarda pagos
                    $this->loadModel('Payments');
                    $payment = $this->Payments->newEntity();
                    $payment = $this->Payments->patchEntity($payment, $this->paymentsdata);
                    if ($this->Payments->save($payment)) {
                        //
                        //debug($payment);
                        $this->set('data', [
                        'id'      => $event->subject->entity->id,
                        'token'   => __token($user["id"], CFG_TIME_TOKEN),
                        'message' => 'Solicitud Finalizada',
                        'payment_id' => $payment->id,
                        ]);
                    }
                    $this->Crud->action()->config('serialize.data', 'data');
                });
                break;

            case 'approveChanges':
              $this->itemsModIds = $this->request->data['itemsMods'];
              $this->loadModel('RequestsAvailableServices');
              $this->loadModel('AvailableServices');

              //Obtengo las modificaciones almacenadas
              $itemsRawMods = TableRegistry::get('RequestsMechanicModItems')
                  ->find()
                  ->select(['RequestsMechanicModItems.available_service_id'])
                  ->where(['RequestsMechanicModItems.active' => '1', 'RequestsMechanicModItems.request_id' => $this->id_request]);

              $this->items= array();
              foreach($itemsRawMods as $item) {
                  array_push($this->items, $item->available_service_id);
              }

              //Obtengo los servicios ya guardados
              $itemsRaw = TableRegistry::get('RequestsAvailableServices')
                  ->find()
                  ->select(['RequestsAvailableServices.available_service_id'])
                  ->where(['RequestsAvailableServices.active' => '1', 'RequestsAvailableServices.request_id' => $this->id_request]);

              $this->items2= array();
              foreach($itemsRaw as $item) {
                  array_push($this->items2, $item->available_service_id);
              }

              //Se actualiza precios
              $query = $this->AvailableServices->find();
              $query->where(function ($exp, $q) {
                      return $exp->in('AvailableServices.id', array_merge($this->items, $this->items2) );
                  });
              $query->select(['suma_total'=>$query->func()->sum('total_price')]);
              $x = $query->toArray();

              $this->total_price_l = $x[0]->suma_total;

              $this->Crud->on('beforeFind',function(Event $event){
                  $event->subject()->query->where(['id'=>$this->id_request]);
              });

              $this->Crud->on('beforeSave', function(Event $event) {
                  $event->subject()->entity->status = RequestStatus::EnEsperaraPagoMod;
                  $event->subject->entity->total_price = $this->total_price_l;
              });


              $this->Crud->on('afterSave', function(Event $event) {

                  $result = TableRegistry::get("RequestsMechanicMods")->query()->update()
                           ->set(['status' => ServicesModStatus::Aprobada])
                           ->where(['request_id' => $event->subject->entity->id ,
                                    'active' => 1,'status' => ServicesModStatus::EsperandoAprob,
                                    function ($exp, $q) {
                                       return $exp->in('RequestsMechanicMods.id', $this->itemsModIds);
                                   }])
                           ->execute();

                  $this->set('data', [
                      'id' => $event->subject->entity->id,
                      'token' => __token($event->subject->entity->user_id, CFG_TIME_TOKEN),
                      'message'=>'Registro exitoso!'
                  ]);
                  $this->Crud->action()->config('serialize.data', 'data');

              });
              break;
            case 'refuseChanges':
              $this->itemsModIds = $this->request->data['itemsMods'];
              $this->Crud->on('beforeFind',function(Event $event){
                  $event->subject()->query->where(['id'=>$this->id_request]);
              });

              $this->Crud->on('beforeSave', function(Event $event) {
                  $event->subject()->entity->status = RequestStatus::EnEsperaTrabajo;
              });


              $this->Crud->on('afterSave', function(Event $event) {

                 $result = TableRegistry::get("RequestsMechanicModItems")->query()->update()
                            ->set(['active' => 0])
                            ->where(['request_id' => $event->subject->entity->id ,
                                     'active' => 1,
                                     function ($exp, $q) {
                                        return $exp->in('RequestsMechanicModItems.request_mechanic_mod_id', $this->itemsModIds);
                                    }])
                            ->execute();

                 $result2 = TableRegistry::get("RequestsMechanicMods")->query()->update()
                            ->set(['active' => 0 , 'status' => ServicesModStatus::Anulada])
                            ->where(['request_id' => $event->subject->entity->id ,
                                     'active' => 1,
                                     'status' => ServicesModStatus::EsperandoAprob,
                                     function ($exp, $q) {
                                        return $exp->in('RequestsMechanicMods.id', $this->itemsModIds);
                                    }])
                            ->execute();

                  $this->set('data', [
                      'id' => $event->subject->entity->id,
                      'token' => __token($event->subject->entity->user_id, CFG_TIME_TOKEN),
                      'message'=>'Registro exitoso!'
                  ]);
                  $this->Crud->action()->config('serialize.data', 'data');

              });
              break;
            default:
              break;
        }
        return $this->Crud->execute();
    }

    public function _send_mail_initial_budget($user, $request){
        $email = new Email('default');
        $titulo = 'Aceptar presupuesto ';
        $contenido_correo =
        'Saludos <b>' . $user['name'] . ' ' . $user['last_name'] . ',</b><br>' .
        '<br>' .
        'Hemos recibido una nueva solicitud de servicios. Confirma si son correctos los datos de la solicitud (#'. $request['id'] .') :<br>';

        $ii = [];
        foreach ($request['available_services'] as $value) {
            $ii[] = $value['name'] .' ($'. $value['total_price'] .')';
        }

        $resumen_pedido = implode("<br>", $ii);
        $contenido_correo .= "<br><b>Descripcion de bienes y servicios:</b>";
        $contenido_correo .= "<br>".$resumen_pedido;
        $contenido_correo .= "<br><br><b>Total:</b>".$request['total_price'];

        $contenido_correo .='<br><br><b>Fullmec</b> requiere que completes tu solicitud realizando un pago si estás de acuerdo. Por favor, ir al siguiente link: <br>'. '/#/pages/solicitar-servicios/view/'. $request['id'] . '<br><br>';

        if(isset($contenido_correo)){
                $data = [
                    'title'=>$titulo,
                    'to'=>$user['email'],
                    'body'=>  $contenido_correo,
                    'subject'=> $titulo
                ];
                $this->Message->send($data);
        }

    }//end _send_mail_initial_budget


    public function _send_mail_need_inspection($user, $request){
        $email = new Email('default');
        $titulo = 'Requiere inspección ';
        $contenido_correo =
        'Saludos <b>' . $user['name'] . ' ' . $user['last_name'] . ',</b><br>' .
        '<br>' .
        'Hemos recibido una nueva solicitud de servicios (#'. $request['id'] .') :<br>';

        $ii = [];
        foreach ($request['available_services'] as $value) {
            $ii[] = $value['name'] .' ($'. $value['total_price'] .')';
        }

        $resumen_pedido = implode("<br>", $ii);
        $contenido_correo .= "<br><b>Descripcion de bienes y servicios:</b>";
        $contenido_correo .= "<br>".$resumen_pedido;
        $contenido_correo .= "<br><br><b>Total:</b>".$request['total_price'];

        $contenido_correo .='<br><br><b>Fullmec</b> con el afán de ayudarte estudiará tu solicitud y agendará una inspección con un '
        .' mecánico con el fin de que revise los servicios que de verdad necesitas sin que tengas que pagar de más.';

        if(isset($contenido_correo)){
                $data = [
                    'title'=>$titulo,
                    'to'=>$user['email'],
                    'body'=>  $contenido_correo,
                    'subject'=> $titulo
                ];
                $this->Message->send($data);
        }

    }//end _send_mail_initial_budget


    public function add(){
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }


        $this->loadModel('AvailableServices');
        $this->loadModel('RequestsAvailableServices');
        $this->loadModel('Diagnostics');
        $this->loadModel('Requests');

        $this->items = $this->request->data['itemsServices'];//items seleccionados
        $this->diagnostics_id = $this->request->data['diagnostics_id'];

        $query = $this->AvailableServices->find();
        $query->where(function ($exp, $q) {
                return $exp->in('AvailableServices.id', $this->items);
            });
        $query->select(['suma_total'=>$query->func()->sum('total_price')]);
        $x = $query->toArray();

        $this->total_price_l = $x[0]->suma_total;

        //En este lugar, van la validaciones que no se hacen por modelo
        $this->Crud->on('beforeSave', function(Event $event) {
                $user = $this->Auth->identify();
                $event->subject->entity->active = true;
                if(sizeof($this->items)> CFG_REQUEST_MAX_BEFORE_INSPECTION){
                  $event->subject->entity->status = RequestStatus::RequiereInspeccion;
                }
                else{
                  $event->subject->entity->status = RequestStatus::Abierta;
                }

                $event->subject->entity->car_id = $this->request->data['car_id']==0 ? null : $this->request->data['car_id'];
                $event->subject->entity->mechanic_id = null;
                $event->subject->entity->client_id = $user['id'];
                $event->subject->entity->total_price = $this->total_price_l;
        });

        $this->Crud->on('afterSave', function(Event $event) {
            if ($event->subject->created) {
                //aqui se recorren los items del servicio seleccionado para guardarlos
                foreach ($this->items as $key => $value) {
                    $this->request->data['ITEMS']['request_id'] = $event->subject->entity->id;
                    $this->request->data['ITEMS']['available_service_id'] = $value;
                    $this->request->data['ITEMS']['status']= 1;
                    $this->request->data['ITEMS']['active']= 1;
                    $requestsAvailableService = $this->RequestsAvailableServices->newEntity();
                    $requestsAvailableService = $this->RequestsAvailableServices->patchEntity($requestsAvailableService, $this->request->data['ITEMS']);
                    $this->RequestsAvailableServices->save($requestsAvailableService);
                }//end foreach

                if($this->diagnostics_id>0){
                        $this->request->data['D']['request_id'] = $event->subject->entity->id;
                        $diagnostic = $this->Diagnostics->get($this->diagnostics_id);
                        $diagnostic = $this->Diagnostics->patchEntity($diagnostic, $this->request->data['D']);
                        $this->Diagnostics->save($diagnostic);
                }

                //Se envia mail
                if(sizeof($this->items)> CFG_REQUEST_MAX_BEFORE_INSPECTION){
                  $this->_send_mail_need_inspection( $this->Auth->identify(), $this->Requests->find()->where(['Requests.id'=>$event->subject->entity->id])->contain(['AvailableServices'])->first()->toArray() );
                }
                else{
                  $this->_send_mail_initial_budget( $this->Auth->identify(), $this->Requests->find()->where(['Requests.id'=>$event->subject->entity->id])->contain(['AvailableServices'])->first()->toArray() );
                }


                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'request' => $event->subject->entity,
                    'token' => __token($event->subject->entity->user_id, CFG_TIME_TOKEN),
                    'message'=>'Registro exitoso!'
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }//end add

    public function index(){
        $user = $this->Auth->identify();
        $this->Crud->on('beforePaginate', function(Event $event) {
            $user = $this->Auth->identify();
            $this->paginate = [
                'conditions' => ['Requests.active'=> true],
                'order' => ['Requests.id'=> 'DESC'],
                'contain' => [
                    'Cars',
                    'Cars.CarBrands',
                    'Cars.CarModels',
                    'QualificationsToMechanics',
                    'AvailableServices',
                    'Mechanics',
                    'RequestsMechanicMods.AvailableServices'
                    ],
            ];
        });
        return $this->Crud->execute();
    }//end index


    public function delete($id = null ){
        $this->user = $this->Auth->identify();
        $this->id_local = $id;

        $this->Crud->on('beforeFind', function(Event $event) {
            if($this->user['role_id'] === UserRoles::Cliente){
              $conditions= ['id' => $this->id_local, 'client_id'=>$this->user['id']];
              $event->subject()->query->where($conditions);
            }
            else if($this->user['role_id'] === UserRoles::Mecanico){
              $conditions= ['id' => $this->id_local, 'mechanic_id'=>$this->user['id']];
              $event->subject()->query->where($conditions);
            }
        });

        $this->Crud->on('beforeSave', function(Event $event) {
            $event->subject()->entity->id = $this->id_local;

            if($this->user['role_id'] === UserRoles::Cliente){
              $event->subject()->entity->status = RequestStatus::AnuladaCliente;
            }
            else if($this->user['role_id'] === UserRoles::Mecanico){
              $event->subject()->entity->status = RequestStatus::AnuladaMecanico;
            }
        });

        $this->Crud->on('afterSave', function(Event $event) {
            if (!$event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'message'=>'Registro eliminado exitosamente!'
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }else{

            }
        });
        return $this->Crud->execute();
    }//end delete



}
