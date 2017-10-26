<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;
use Ideauno\RequestStatus;

/**
 * RequestCancelationOptions Controller
 *
 * @property \App\Model\Table\RequestCancelationOptionsTable RequestCancelationOptions
 */
class RequestCancelationOptionsController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        //$this->loadComponent('Message');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }


    // Listado de Opciones de anulación.
    // retorna listado activo.
    public function getlist(){
       $options = $this->RequestCancelationOptions->find()
        ->where(['active'=>true])
        ->order(['id'=>'ASC'])
        ->toArray();
       $status =  $options ? true : false;
       $this->set([
         'success' => $status,
         'data' => $options,
         '_serialize' => ['success','data']
       ]);


    }

}
