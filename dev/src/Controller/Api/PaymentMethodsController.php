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
class PaymentMethodsController extends AppController
{

    public $id_request = null;
    public $items = null;

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        $this->Crud->disable(['delete','edit','view','add']);
    }//end beforeFilter

    public function index(){
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Not authenticate');
        }
        $this->Crud->on('beforePaginate', function(Event $event) {
            $user = $this->Auth->identify();
            $this->paginate = [
                'conditions' => ['PaymentMethods.active'=> true],

            ];
        });
        return $this->Crud->execute();
    }//end index



}
