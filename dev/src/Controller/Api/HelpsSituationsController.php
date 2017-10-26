<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;

class HelpsSituationsController extends AppController
{
	private $helps_when_id = null;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }//end initialize


    public function index($id = null){
    	$this->helps_when_id = $id;
        $this->Crud->on('beforePaginate', function(Event $event) {
        	$conditions = $this->helps_when_id !=null ? ['HelpsSituations.helps_when_id'=>$this->helps_when_id,'HelpsSituations.active'=> true] : ['HelpsSituations.active'=> true];
            $this->paginate = [
            	'contain' => ['HelpsWhens'],
                'conditions' => $conditions,
            ];
        });
        return $this->Crud->execute();
    }//end index
}