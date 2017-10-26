<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;

class HelpsWhatsupsController extends AppController
{
	private $helps_where_id = null;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }//end initialize


    public function index($id = null){
    	$this->helps_where_id = $id;
        $this->Crud->on('beforePaginate', function(Event $event) {
        	$conditions = $this->helps_where_id !=null ? ['HelpsWhatsups.helps_where_id'=>$this->helps_where_id,'HelpsWhatsups.active'=> true] : ['HelpsWhatsups.active'=> true];
            $this->paginate = [
            	'contain' => ['HelpsWheres'],
                'conditions' => $conditions,
            ];
        });
        return $this->Crud->execute();
    }//end index
}