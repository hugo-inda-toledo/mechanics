<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Network\Exception\UnauthorizedException;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\BadRequestException;
use Firebase\JWT\JWT;
use Cake\I18n\Time;
use Cake\Mailer\Email;
use Cake\Utility\Text;
use Cake\Utility\Security;

class SchedulesController extends AppController
{
    public $id_local = null;
    public $id_user = null;

    public function index(){
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Not authenticate');
        }
        $this->Crud->on('beforePaginate', function(Event $event) {
            $user = $this->Auth->identify();
            $this->paginate = [
                'conditions' => ['Schedules.user_id' => $user['id'],'Schedules.active'=> true],
                'fields' => []
            ];
        });
        return $this->Crud->execute();
    }//end index


    public function add(){
        $user = $this->Auth->identify();
        if (!$user) {
            throw new UnauthorizedException('Invalid username or password');
        }

        if ($this->request->is('post')) {

          $query= $this->Schedules->query();
          $query->delete()
                ->where([ 'user_id'=>$user['id']])
                ->execute();


          $schedules = TableRegistry::get('Schedules');
          $entities = $schedules->newEntities($this->request->data);
          $schedules->connection()->transactional(function () use ($schedules, $entities) {
              $user = $this->Auth->identify();
              foreach($entities as $data){
                  $data['is_available'] = true;
                  $data['active'] = true;
                  $data['user_id'] = $user['id'];
                  $schedules->save($data, ['atomic' => false]);
              }

              echo json_encode(['success'=>true,'data'=>['message'=>'Actualizado']]);
          });
        }
        $this->autoRender= false;
    }//end add

}//end Cars
