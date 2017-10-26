<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;
use Firebase\JWT\JWT;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Utility\Security;
use App\Utility\MainPaymentVoucherPdf;

class ReportsController extends AppController
{
    public $id_local = null;
    public $id_user = null;
    public $id_request = null;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['health','services', 'payment_voucher']);
    }//end initialize

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }//end beforeFilter


    /**
     * @api {get} /api/reports/health/id_car/id_request/token Reporte salud
     * @apiVersion 0.1.0
     * @apiName health
     * @apiGroup Reports
     *
     * @apiParam {String} id_car Id del carro
     * @apiParam {String} id_request Id de la solicitud
     * @apiParam {String} token token user
     *
     * @apiSuccess {File}  Reporte pdf
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "file pdf"
     *     }
     *
     * @apiError ReportsBadResponse Reporte no encontrado
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function health($id = null, $id_req = null,$token ){
        $token = str_replace('__', '', $token);
        $user_id =  __token_user_id($token);
        $this->viewBuilder()->layout('ajax');
        if($user_id>0){
            $this->loadModel('Cars');
            $this->loadModel('Users');
            $this->set('cliente', $user=$this->Users->get($user_id));
            // debug($user);
            $this->id_local   = $id;
            $this->id_user    = $user_id;
            $this->id_request = $id_req;

            $data = $this->Cars->find('all')
                ->where(['id' => $this->id_local, 'user_id'=>$this->id_user])
                //->select(['Cars.id','Cars.model','Cars.brand','Cars.year','Cars.mileage','Cars.observations','Cars.patent'])
                ->contain(['Requests'=> function($q){
                    return $q->where(['Requests.id'=>$this->id_request]);
                }])
                ->contain(['Requests.Cities'])
                ->contain(['Requests.Communes'])
                ->contain(['Requests.HealthReports'])
                ->contain(['Requests.Payments'])
                ->contain(['Requests.PurchaseOrders'])
                ->contain(['Requests.RequestsFiles'])
                ->contain(['Requests.AvailableServices'])
                // ->contain(['Requests.AvailableServices.RequestsTypes'])
                //->contain(['Requests.AvailableServices.Items'])
                ->contain(['Requests.Mechanics'=> function($q){
                    return $q->select([
                        'full_name'
                        ]);
                }])
                ->contain(['Requests.AnsweredSurveys'=> function($q){
                    return $q->select(['request_id','survey_id'])->where(['AnsweredSurveys.active'=>true])
                    ->contain(['Surveys'=> function($q){
                        return $q->select([
                            'name'
                            ])->where(['Surveys.active'=> true]);
                    }]);
                }])->toArray();
                $this->set(compact('data'));
                $this->set('_serialize', ['data']);
                //debug($data);die;

                $this->set('title', 'Informe de Salud');
                $this->set('file_name', $f='Informe_de_Salud_'.date('dmYHis').'.pdf');
                $this->set('filename', $f);
                $this->response->type('pdf');

        }else{
            throw new UnauthorizedException('Error');
            //$this->redirect('##/error');
        }


    }//end health

    public function services($id = null, $id_req = null,$token ){
        $token = str_replace('__', '', $token);
        $user_id =  __token_user_id($token);
        $this->viewBuilder()->layout('ajax');
        if($user_id>0){
            $this->loadModel('Cars');
            $this->loadModel('Users');
            $this->set('cliente', $user=$this->Users->get($user_id));
            // debug($user);
            $this->id_local   = $id;
            $this->id_user    = $user_id;
            $this->id_request = $id_req;

            $data = $this->Cars->find('all')
                ->where(['id' => $this->id_local, 'user_id'=>$this->id_user])
                //->select(['Cars.id','Cars.model','Cars.brand','Cars.year','Cars.mileage','Cars.observations','Cars.patent'])
                ->contain(['Requests'=> function($q){
                    return $q->where(['Requests.id'=>$this->id_request]);
                }])
                ->contain(['Requests.Cities'])
                ->contain(['Requests.Communes'])
                ->contain(['Requests.HealthReports'])
                ->contain(['Requests.Payments'])
                ->contain(['Requests.PurchaseOrders'])
                ->contain(['Requests.RequestsFiles'])
                ->contain(['Requests.AvailableServices'])
                // ->contain(['Requests.AvailableServices.RequestsTypes'])
                //->contain(['Requests.AvailableServices.Items'])
                ->contain(['Requests.Mechanics'=> function($q){
                    return $q->select([
                        'name',
                        'last_name',
                        'email',
                        'phone1',
                        ]);
                }])
                ->contain(['Requests.AnsweredSurveys'=> function($q){
                    return $q->select(['request_id','survey_id'])->where(['AnsweredSurveys.active'=>true])
                    ->contain(['Surveys'=> function($q){
                        return $q->select([
                            'name'
                            ])->where(['Surveys.active'=> true]);
                    }]);
                }])->toArray();
                $this->set(compact('data'));
                $this->set('_serialize', ['data']);
                //debug($data);die;

                $this->set('title', 'Informe de Servicio');
                $this->set('file_name', $f='Informe_de_Servicio_'.date('dmYHis').'.pdf');
                $this->set('filename', $f);
                $this->response->type('pdf');
        }else{
            throw new UnauthorizedException('Error');
            //$this->redirect('##/error');
        }


    }//end services


    public function payment_voucher($id = null, $id_req = null,$token ){
        $token = str_replace('__', '', $token);
        $user_id =  __token_user_id($token);
        $this->viewBuilder()->layout('ajax');
        if($user_id>0){
            $this->loadModel('Cars');
            $this->loadModel('Users');
            $this->loadModel('CarBrands');
            $this->loadModel('CarModels');

            $this->set('cliente', $user=$this->Users->get($user_id));
            //debug($user);die();
            $this->id_local   = $id;
            $this->id_user    = $user_id;
            $this->id_request = $id_req;

            $data = $this->Cars->find('all')
                ->where(['id' => $this->id_local, 'user_id'=>$this->id_user])
                //->select(['Cars.id','Cars.model','Cars.brand','Cars.year','Cars.mileage','Cars.observations','Cars.patent'])

                ->contain(['Requests'=> function($q){
                    return $q->where(['Requests.id'=>$this->id_request]);
                }])
                ->contain(['Requests.Cities'])
                ->contain(['Requests.Communes'])
                ->contain(['Requests.HealthReports'])
                ->contain(['Requests.Payments'])
                ->contain(['Requests.PurchaseOrders'])
                ->contain(['Requests.RequestsFiles'])
                ->contain(['Requests.AvailableServices'])
                //->contain(['Requests.RequestsMechanicMods.AvailableServices'])
                // ->contain(['Requests.AvailableServices.RequestsTypes'])
                //->contain(['Requests.AvailableServices.Items'])
                ->contain(['Requests.Mechanics'=> function($q){
                    return $q->select([
                        'name',
                        'last_name',
                        'email',
                        'phone1',
                        ]);
                }])
                ->contain(['Requests.AnsweredSurveys'=> function($q){
                    return $q->select(['request_id','survey_id'])->where(['AnsweredSurveys.active'=>true])
                    ->contain(['Surveys'=> function($q){
                        return $q->select([
                            'name'
                            ])->where(['Surveys.active'=> true]);
                    }]);
                }])->toArray();


                $data[0]->car_brand_name= $this->CarBrands->get($data[0]->car_brand_id)->brand_name;
                $data[0]->car_model_name= $this->CarModels->get($data[0]->car_model_id)->model_name;
                $data[0]->request = $data[0]->requests[0];

                $this->set(compact('data'));
                $this->set('_serialize', ['data']);

                //debug($data[0]);die;

                $this->set('title', 'Comprobante de Pago');
                $this->set('file_name', $f='Comprobante_Pago_'.date('dmYHis').'.pdf');
                $this->response->type('pdf');

                $main= new MainPaymentVoucherPdf();
                $main->show($data[0],'Comprobante de Pago', 'Comprobante_Pago_'.date('dmYHis').'.pdf', $user);
                //$main->download($data[0], 'Comprobante de Pago', 'Comprobante_Pago_'.date('dmYHis').'.pdf', $user);
        }else{
            throw new UnauthorizedException('Error');
            //$this->redirect('##/error');
        }


    }//end payment




}//end Reports
