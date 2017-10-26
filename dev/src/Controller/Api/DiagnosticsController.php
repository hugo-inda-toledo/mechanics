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

/**
 * Requests Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class DiagnosticsController extends AppController
{

    public $id_request = null;
    public $items = null;

    public function initialize()
    {
        parent::initialize();
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
        $this->Crud->on('beforeSave', function(Event $event) {
                $event->subject->entity->active = true;
                $event->subject->entity->request_id = null;
        });

        $this->Crud->on('afterSave', function(Event $event) {
            if ($event->subject->created) {
                $this->set('data', [
                    'id' => $event->subject->entity->id,
                    'token' => __token($this->id_user, CFG_TIME_TOKEN),
                    'message'=>'Registro exitoso!'
                    ]);
                $this->Crud->action()->config('serialize.data', 'data');
            }
        });
        return $this->Crud->execute();
    }//end add


}
