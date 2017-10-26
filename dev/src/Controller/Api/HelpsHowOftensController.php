<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;

class HelpsHowOftensController extends AppController
{
	private $helps_situation_id = null;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }//end initialize


    public function index($id = null){
    	$this->helps_situation_id = $id;
        $this->Crud->on('beforePaginate', function(Event $event) {
        	$conditions = $this->helps_situation_id !=null ? ['HelpsHowOftens.helps_situation_id'=>$this->helps_situation_id,'HelpsHowOftens.active'=> true] : ['HelpsHowOftens.active'=> true];
            $this->paginate = [
            	'contain' => ['HelpsSituations'],
                'conditions' => $conditions,
            ];
        });
        return $this->Crud->execute();
    }//end index
}