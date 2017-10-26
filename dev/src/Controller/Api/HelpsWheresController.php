<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;


class HelpsWheresController extends AppController
{
    public $id_local = null;

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['index']);
    }//end initialize

    public function index(){
        $this->Crud->on('beforePaginate', function(Event $event) {
            $this->paginate = [
                'conditions' => ['HelpsWheres.active'=> true],
                'contain'=> [
                    'HelpsWhatsups',
                    'HelpsWhatsups.HelpsWhens',
                    'HelpsWhatsups.HelpsWhens.HelpsSituations',
                    'HelpsWhatsups.HelpsWhens.HelpsSituations.HelpsHowOftens',
                    ]
            ];
        });
        return $this->Crud->execute();
    }//end index

}//end HelpsWheres
