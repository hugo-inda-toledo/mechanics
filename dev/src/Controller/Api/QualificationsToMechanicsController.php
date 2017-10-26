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

class QualificationsToMechanicsController extends AppController
{
    public $id_local = null;
    public $id_client = null;
    public $id_mechanic = null;

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->disable(['delete','edit']);
        // //se reescribe el metodo delete para que ejecute edit en vez de delete fisico
        // $this->Crud->mapAction('delete', [
        //     'className' => 'Crud.Edit',
        //     'view' => 'delete'
        // ]);

    }//end beforeFilter

    /**
     * @api {get} /api/qualifications_to_mechanics/index Listar Calificaciones
     * @apiVersion 0.1.0
     * @apiName index
     * @apiGroup QualificationsToMechanics
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
     * @apiSuccess {Array}  data detalles de la calificacion.
     *
     * @apiSuccessExample Success-Response:
     *     HTTP/1.1 200 OK
     *     {
     *        "Success": true,
     *        "data": [
     *            {
     *
     *            },
     *     }
     *
     * @apiError QualificationsToMechanicsBadResponse Datos no encontrados
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
                'conditions' => ['QualificationsToMechanics.mechanic_id' => $user['id'],'QualificationsToMechanics.active'=> true],
                'contain' => [
                    'Requests',
                    'Clients',
                    ],
            ];
        });
        return $this->Crud->execute();
    }//end index

    /**
     * @api {post} /api/qualifications_to_mechanics/add Registrar Calificacion
     * @apiVersion 0.1.0
     * @apiName add
     * @apiGroup QualificationsToMechanics
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
     * @apiParam {Number} request_id Id de la solicitud
     * @apiParam {Number} mechanic_id Id del mecanico
     * @apiParam {Number} score Puntaje.
     * @apiParam {String} observations Observaciones no obligatoria.
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
     *                "message": "Registro exitoso"
     *            },
     *     }
     *
     * @apiError QualificationsToMechanicsBadResponse Registro no realizado
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
                $event->subject->entity->client_id = $user['id'];
        });

        $this->Crud->on('afterSave', function(Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    // 'token' => __token($event->subject->entity->user_id, CFG_TIME_TOKEN),
                    'message'=>'Registro exitoso!'
                ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }//end add


    /**
     * @api {get} /api/qualifications_to_echanics/view/id_calificacion Ver calificacion detallada
     * @apiVersion 0.1.0
     * @apiName view
     * @apiGroup QualificationsToMechanics
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
     * @apiParam {String} id_qualifications Id de la calificacion.
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
     *            }
     *            ],
     *     }
     *
     * @apiError QualificationsToMechanicsBadResponse Registro no realizado
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
        $this->id_client = $user['id'];
        $this->id_mechanic = $user['id'];
        $this->Crud->on('beforeFind', function(Event $event) {
             $event->subject()
                ->query
                ->where(['QualificationsToMechanics.id' => $this->id_local, 'QualificationsToMechanics.mechanic_id'=>$this->id_mechanic])
                ->select(['QualificationsToMechanics.id','QualificationsToMechanics.score','QualificationsToMechanics.observations'])
                ->contain(['Requests'=> function($q){
                    return $q->select([
                        'car_id',
                        'start_time_schedule_requested',
                        'created',
                        'address_name',
                        ])
                    ->contain(['Cars'=> function($q){
                        return $q->select([
                            'model',
                            'Brand',
                            'year',
                            'mileage',
                            'observations',
                            ]);
                    }]);
                }])
                ->contain(['Clients'=> function($q){
                    return $q->select([
                        'name',
                        'last_name',
                        'email',
                        'phone1',
                        ]);
                }]);
        });

        return $this->Crud->execute();
    }//end view



}//end QualificationsToMechanics
