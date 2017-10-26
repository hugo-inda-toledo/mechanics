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
use Cake\ORM\TableRegistry;

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class InvoicesController extends AppController
{

    public $id_request = null;
    public $items = null;
    public $total_price_l = null;
    public $id_user = null;
    public $paymentsdata = [];

    public function initialize()
    {
        parent::initialize();
        //$this->Auth->allow(['edit']);
        $this->loadComponent('Message');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Crud->disable(['delete','edit','index','view']);
    }//end beforeFilter

    public function add(){
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }
        $this->id_user = $user['id'];
        $this->paymentsdata['payment_method_id'] = $this->request->data['payment_method_id'];
        $this->paymentsdata['request_id']        = $this->request->data['request_id'];
        $this->paymentsdata['user_id']           = $this->id_user;
        $this->paymentsdata['amount']            = $this->request->data['total_price'];
        $this->paymentsdata['paid']              = 0;
        $this->paymentsdata['active']            = true;
        $this->Crud->on('beforeSave', function(Event $event) {
                $event->subject->entity->active = true;
                $event->subject->entity->client_id = $this->id_user;
        });

        $this->Crud->on('afterSave', function(Event $event) {
            if ($event->subject->created) {
              
                $this->loadModel('Payments');
                $payment = $this->Payments->newEntity();
                $payment = $this->Payments->patchEntity($payment,$this->paymentsdata);
                if ($this->Payments->save($payment)) {
                    //
                    $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => __token($event->subject->entity->user_id, CFG_TIME_TOKEN),
                    'message'=>'Registro exitoso!',
                    'payment_id' => $payment->id
                    ]);
                }


                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }//end add


}
