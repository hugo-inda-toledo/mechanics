<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;
use Cake\ORM\TableRegistry;
use Ideauno\ServicesModStatus;
use Ideauno\RequestStatus;
use Cake\Mailer\Email;


class RequestsMechanicModsController extends AppController
{
    public $requestMechanicMod=null;
    public $request_id = null;
    public $id_local = null;
    public $user= null;

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Message');
        $this->loadComponent('Notification');
        $this->Auth->allow(['index']);
    }//end initialize



    public function index($id = null){
      $this->user = $this->Auth->identify();
      if (!$this->user) {
          throw new UnauthorizedException('Invalid username or password');
      }
    	$this->request_id = $id;
      $this->Crud->on('beforePaginate', function(Event $event) {
        	$conditions = $this->request_id !=null ? ['RequestsMechanicMods.request_id'=>$this->request_id,'RequestsMechanicMods.active'=> true] : ['RequestsMechanicMods.active'=> true];
          $this->paginate = [
            	'contain' => ['Requests', 'RequestsMechanicModItems'],
              'conditions' => $conditions
          ];
        });
      return $this->Crud->execute();
    }//end index


     public function add(){
         $this->user = $this->Auth->identify();
         if (!$this->user) {
             throw new UnauthorizedException('Invalid username or password');
         }

         $this->loadModel('Requests');
         $this->loadModel('RequestsMechanicMods');
         $this->loadModel('RequestsMechanicModItems');
         $this->loadModel('AvailableServices');
         $this->loadModel('Users');

         $this->items = $this->request->data['itemsServices'];//items seleccionados

         $query = $this->AvailableServices->find();
         $query->where(function ($exp, $q) {
              return $exp->in('AvailableServices.id', $this->items);
         });
         $query->select(['suma_total'=>$query->func()->sum('total_price')]);
         $x = $query->toArray();

         $this->total_price_l = $x[0]->suma_total;

         //En este lugar, van la validaciones que no se hacen por modelo
         $this->Crud->on('beforeSave', function(Event $event) {
                 $this->user = $this->Auth->identify();

                 //Se actualizan el request a ModMecanico
                 $query = TableRegistry::get("Requests")->query()->update()
                    ->set(['status' => RequestStatus::ModMecanico])
                    ->where(['id' => $this->request->data['request_id']])
                    ->execute();

                 //Se genera el request_mechanic_mod
                 $event->subject->entity->active = true;
                 $event->subject->entity->status = ServicesModStatus::EsperandoAprob;
                 $event->subject->entity->request_id = $this->request->data['request_id'];
                 $event->subject->entity->mechanic_id = $this->user['id'];
                 $event->subject->entity->total_price = $this->total_price_l;
         });

         $this->Crud->on('afterSave', function(Event $event) {
             if ($event->subject->created) {
                 //Se envia mail a usuario por las modificaciones realizadas

                 $request= $this->Requests->find()->where(['Requests.id'=>$event->subject->entity->request_id])->first()->toArray();
                 $userClient= $this->Users->find()->where(['Users.id'=> $request['client_id'] ])->first()->toArray();

                 $this->_send_mail_confirm_changes_by_mechanic( $userClient , $request);
                 $this->_send_notification_confirm_changes_by_mechanic($userClient, $request['id']);

                 //aqui se recorren los items del servicio seleccionado para guardarlos
                 foreach ($this->items as $key => $value) {
                     $this->request->data['ITEMS']['request_mechanic_mod_id'] = $event->subject->entity->id;
                     $this->request->data['ITEMS']['request_id'] = $event->subject->entity->request_id;
                     $this->request->data['ITEMS']['available_service_id'] = $value;
                     $this->request->data['ITEMS']['active']= 1;
                     $itemsMods = $this->RequestsMechanicModItems->newEntity();
                     $itemsMods = $this->RequestsMechanicModItems->patchEntity($itemsMods, $this->request->data['ITEMS']);
                     $this->RequestsMechanicModItems->save($itemsMods);
                 }//end foreach

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


     public function _send_notification_confirm_changes_by_mechanic($user, $request_id){
       $tokensId=[];

       if($user['active']){
         if(isset($user['id_fcm1']) && ($user['id_fcm1']!=null)){
           array_push($tokensId, $user['id_fcm1']);
         }

         if(isset($user['id_fcm2']) && ($user['id_fcm2']!=null)){
           array_push($tokensId, $user['id_fcm2']);
         }

         if(count($tokensId) >0){
           $data = [
             'tokensId' => $tokensId,
             'title' => 'Tu solicitud '. $request_id. ' ha recibido modificaciones',
             'body' => 'Valida las modificaciones realizadas',
             'data' => [
                 'action' => 'approveChanges',
                 'request_id'=> $request_id
               ]
           ];

           $this->Notification->send($data);

         }
       }
     }

     public function _send_mail_confirm_changes_by_mechanic($user, $request){
         $email = new Email('default');
         $titulo = 'Aceptar modificaciones ';
         $contenido_correo = 'Saludos <b>' . $user['name'] . ' ' . $user['last_name'] . ',</b><br>' .
         '<br>' .
         'El sistema ha recibido una notificación debido a que tu mecánico asignado a realizado modificaciones para tu petición (#'. $request['id'] .').<br>' .
         '<b>Fullmec</b> requiere que confirmes o rechaces estos cambios, por favor, ir al siguiente link: <br>'. get_server_url() . '/#/pages/solicitar-servicios/approve-changes/'. $request['id'] . '<br><br>';

         if(isset($contenido_correo)){
                 $data = [
                     'title'=>$titulo,
                     'to'=>$user['email'],
                     'body'=>  $contenido_correo,
                     'subject'=> $titulo
                 ];
                 $this->Message->send($data);
         }
     }//end _send_mail_confirm_changes_by_mechanic


}
