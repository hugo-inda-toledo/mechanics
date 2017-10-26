<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;

class HelpsWhensController extends AppController
{
	private $helps_whatsup_id = null;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }//end initialize


    public function index($id = null){
    	$this->helps_whatsup_id = $id;
        $this->Crud->on('beforePaginate', function(Event $event) {
        	$conditions = $this->helps_whatsup_id !=null ? ['HelpsWhens.helps_whatsup_id'=>$this->helps_whatsup_id,'HelpsWhens.active'=> true] : ['HelpsWhens.active'=> true];
            $this->paginate = [
            	'contain' => ['HelpsWhatsups'],
                'conditions' => $conditions,
            ];
        });
        return $this->Crud->execute();
    }//end index
}