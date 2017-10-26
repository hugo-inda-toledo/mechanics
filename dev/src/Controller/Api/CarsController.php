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

class CarsController extends AppController
{
    public $id_local = null;
    public $id_user = null;

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        //se reescribe el metodo delete para que ejecute edit en vez de delete fisico
        $this->Crud->mapAction('delete', [
            'className' => 'Crud.Edit',
            'view' => 'delete'
        ]);

    }//end beforeFilter

    /**
     * @api {get} /api/cars/index Listar autos del cliente
     * @apiVersion 0.1.0
     * @apiName index
     * @apiGroup Cars
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
     * @apiSuccess {Boolean} success  true/false.
     * @apiSuccess {Array}  data detalles del auto.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": [
     *            {
     *                "id": "1",
     *                "patent": "CL-12313",
     *                "model": "Modelo",
     *                "brand": "marca",
     *                "year" : "2017",
     *                "mileage" : "250",
     *                "observations" : "observaciones",
     *                "requests" : {
     *                        "id" : "1",
     *                        "id": "1",
     *                        "client_id": "1",
     *                        "mechanic_id": "2",
     *                        "car_id": "1",
     *                        "address_name": "Calle uno",
     *                        "address_number": "01",
     *                        "address_complement":"33-A",
     *                        "city_id": "1",
     *                        "commune_id": "1",
     *                        "status": "1",
     *                        "active": "true",
     *                        "start_time_schedule_requested": "0000-00-00 00:00:00",
     *                        "type_documents_payment": "1",
     *                    }
     *
     *            },
     *     }
     *
     * @apiError CarBadResponse Datos no encontrados
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function index(){
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Not authenticate');
        }
        $this->Crud->on('beforePaginate', function(Event $event) {
            $user = $this->Auth->identify();
            $this->paginate = [
                'conditions' => ['Cars.user_id' => $user['id'],'Cars.active'=> true],
                'contain' => [
                    'Requests',
                    'Requests.QualificationsToMechanics',
                    'CarBrands',
                    'CarModels',
                    ],
                /*'fields' => [
                    'Cars.id',
                    'Cars.patent',
                    'Cars.car_brand_id',
                    'Cars.car_model_id',
                    'Cars.year',
                    'Cars.mileage',
                    'Cars.observations'
                    ],*/
            ];
        });
        return $this->Crud->execute();
    }//end index

    /**
     * @api {post} /api/cars/add Registrar auto
     * @apiVersion 0.1.0
     * @apiName add
     * @apiGroup Cars
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
     * @apiParam {String} patent Pantente del auto.
     * @apiParam {String} model Modelo del auto.
     * @apiParam {String} brand Marca del auto.
     * @apiParam {Number} year Año del auto.
     * @apiParam {Number} mileage Kilometraje del auto.
     * @apiParam {String} observations Observaciones del auto.
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
     *                "message": "Registro exitoso"
     *            },
     *     }
     *
     * @apiError CarBadResponse Registro no realizado
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function add(){
    	$user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }

        //En este lugar, van la validaciones que no se hacen por modelo
        $this->Crud->on('beforeSave', function(Event $event) {
        		$user = $this->Auth->identify();
                $event->subject->entity->active = true;
                $event->subject->entity->user_id = $user['id'];
        });

        $this->Crud->on('afterSave', function(Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => __token($event->subject->entity->user_id, CFG_TIME_TOKEN),
                    'message'=>'Registro exitoso!'
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }//end add

    /**
     * @api {post} /api/cars/edit/id_auto Editar autos
     * @apiVersion 0.1.0
     * @apiName edit
     * @apiGroup Cars
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
     * @apiParam {String} patent Pantente del auto.
     * @apiParam {String} model Modelo del auto.
     * @apiParam {String} brand Marca del auto.
     * @apiParam {Number} year Año del auto.
     * @apiParam {Number} mileage Kilometraje del auto.
     * @apiParam {String} observations Observaciones del auto.
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
     *                "message": "Registro editado exitosamente"
     *            },
     *     }
     *
     * @apiError CarBadResponse Registro no realizado
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function edit($id = null ){
        $user = $this->Auth->identify();
        $this->id_local = $id;
        $this->id_user = $user['id'];
        $this->Crud->on('beforeFind', function(Event $event) {
            $event->subject()->query->where(['id' => $this->id_local, 'user_id'=>$this->id_user]);
        });

        $this->Crud->on('beforeSave', function(Event $event) {
            $event->subject()->entity->id = $this->id_local;
            //$event->subject()->entity->user_id = $user['id'];
        });

        $this->Crud->on('afterSave', function(Event $event) {
            if (!$event->subject->created) {
            	$this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => __token($event->subject->entity->user_id, CFG_TIME_TOKEN),
                    'message'=>'Registro editado exitosamente!'
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }else{

            }
        });
        return $this->Crud->execute();
    }//end edit

    /**
     * @api {get} /api/cars/view/id_auto ver auto
     * @apiVersion 0.1.0
     * @apiName view
     * @apiGroup Cars
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
     * @apiParam {String} id_auto Id del auto.
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
     *                 "id":1,
     *                 "model":"Fiesta",
     *                 "brand":"Ford",
     *                 "observations":"Observaciones",
     *                 "requests":[
     *                    {
     *                       "id":1,
     *                       "client_id":1,
     *                       "mechanic_id":2,
     *                       "car_id":1,
     *                       "address_name": "calle",
     *                       "address_number": "111",
     *                       "address_complement": " 33-B",
     *                       "city_id": 1,
     *                       "commune_id": 1,
     *                       "status": 1,
     *                       "active": true,
     *                       "start_time_schedule_requested": 0000-00-00 00:00:00,
     *                       "type_documents_payment": null,
     *                       "created": null,
     *                       "modified": null,
     *                       "answered_surveys":[
     *                          {
     *                             "request_id": 1,
     *                             "survey_id": 1,
     *                             "survey":{
     *                                "name":"surveys algo"
     *                             }
     *                          }
     *                       ],
     *                       "mechanic":{
     *                          "name":"MECANICO",
     *                          "last_name":"IDEAUNO",
     *                          "email":"mecanico+1@ideauno.cl",
     *                          "phone1":"90000000"
     *                       },
     *                       "available_services":[
     *                          {
     *                             "id":1,
     *                             "requests_type_id":1,
     *                             "name":"Serivicio",
     *                             "description":"descripcion",
     *                             "estimated_time":1,
     *                             "real_estimated_time":1,
     *                             "price":15000,
     *                             "active":true,
     *                             "created":null,
     *                             "modified":null,
     *                             "inspection":false,
     *                             "_joinData":{
     *                                "id":1,
     *                                "request_id":1,
     *                                "available_service_id":1,
     *                                "created":null,
     *                                "modified":null
     *                             },
     *                             "items":[
     *                                {
     *                                   "id":1,
     *                                   "name":"Caucho",
     *                                   "description":"Caucho",
     *                                   "quantity":1,
     *                                   "cost":8900,
     *                                   "brand":"Goodyear",
     *                                   "active":true,
     *                                   "created":null,
     *                                   "modified":null,
     *                                   "category":"Prueba",
     *                                   "_joinData":{
     *                                      "id":1,
     *                                      "available_service_id":1,
     *                                      "item_id":1,
     *                                      "active":true,
     *                                      "created":null,
     *                                      "modified":null
     *                                   }
     *                                }
     *                             ]
     *                          }
     *                       ],
     *                       "requests_files":[
     *                          {
     *                             "id":1,
     *                             "request_id":1,
     *                             "name":"esto es un archivo",
     *                             "type":"1",
     *                             "size":1,
     *                             "active":true,
     *                             "created":null,
     *                             "modified":null
     *                          }
     *                       ],
     *                       "purcharse_orders":[
     *
     *                       ],
     *                       "payments":[
     *
     *                        ],
     *                       "health_reports":[
     *
     *                        ],
     *                       "commune":{
     *                          "id":1,
     *                          "name":"Santiago",
     *                          "active":null,
     *                          "created":null,
     *                          "modified":null,
     *                          "city_id":1
     *                       },
     *                       "city":{
     *                          "id":1,
     *                          "name":"Santiago",
     *                          "active":null,
     *                          "created":null,
     *                          "modified":null
     *                       }
     *                    },
     *                 ]
     *
     *            }
     *            ],
     *     }
     *
     * @apiError CarBadResponse Registro no realizado
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function view($id = null ){
        $user = $this->Auth->identify();
        $this->id_local = $id;
        $this->id_user = $user['id'];
        $this->Crud->on('beforeFind', function(Event $event) {
             $event->subject()
                ->query
                ->where(['Cars.id' => $this->id_local, 'Cars.user_id'=>$this->id_user])
                //->select(['Cars.id','Cars.car_model_id','Cars.car_brand_id','Cars.year','Cars.mileage','Cars.observations','Cars.patent'])
                ->contain(['CarBrands'])
                ->contain(['CarModels'])
                ->contain(['Requests'])
                ->contain(['Requests.Cities'])
                ->contain(['Requests.Communes'])
                ->contain(['Requests.HealthReports'])
                ->contain(['Requests.Payments'])
                ->contain(['Requests.PurchaseOrders'])
                ->contain(['Requests.RequestsFiles'])
                ->contain(['Requests.AvailableServices'])
                // ->contain(['Requests.AvailableServices.RequestsTypes'])
                // ->contain(['Requests.AvailableServices.Items'])
                ->contain(['Requests.Mechanics'])
                ->contain(['Requests.AnsweredSurveys'=> function($q){
                    return $q->select(['request_id','survey_id'])->where(['AnsweredSurveys.active'=>true])
                    ->contain(['Surveys'=> function($q){
                        return $q->select([
                            'name'
                            ])->where(['Surveys.active'=> true]);
                    }]);
                }]);
        });
        $this->autoRender = false;
        return $this->Crud->execute();
    }//end view

    /**
     * @api {POST} /api/cars/delete/id_auto eliminar auto
     * @apiVersion 0.1.0
     * @apiName delete
     * @apiGroup Cars
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
     * @apiParam {Number} id_auto Id auto.
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
     *                "message": "Registro eliminado exitosamente"
     *            },
     *     }
     *
     * @apiError CarBadResponse Registro no eliminado
     *
     * @apiError BaD-Response:
     *     HTTP/1.1 401 Bad Response
     *     {
     *       "error": "BadResponse"
     *     }
     */
    public function delete($id = null ){
        $user = $this->Auth->identify();
        $this->id_local = $id;
        $this->id_user = $user['id'];

        $this->Crud->on('beforeFind', function(Event $event) {
            $event->subject()->query->where(['id' => $this->id_local, 'user_id'=>$this->id_user]);
        });

        $this->Crud->on('beforeSave', function(Event $event) {
            $event->subject()->entity->id = $this->id_local;
            $event->subject()->entity->active = false;
        });

        $this->Crud->on('afterSave', function(Event $event) {
            if (!$event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    //'token' => __token($event->subject->entity->user_id, CFG_TIME_TOKEN),
                    'message'=>'Registro eliminado exitosamente!'
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }else{

            }
        });
        return $this->Crud->execute();
    }//end delete

}//end Cars
