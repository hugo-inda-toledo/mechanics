<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\I18n\Date;
use Cake\Core\Configure;
use Cake\Utility\Security;
use Cake\Utility\Text;
use Cake\Mailer\Email;
use Cake\Auth\DefaultPasswordHasher;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Notification');
        $this->loadComponent('Message');
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['login','logout']);
    }

    public function login()
    {
        $this->viewBuilder()->layout('AdminLTE.login');

        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);

                $this->loadModel('Roles');
                $role = $this->Roles->get($user['role_id'], [
                    'contain' => ['Permissions']
                ]);
                $session = $this->request->session();
                $session->write('Auth.Role', $role);

                $this->Flash->success(__('Login OK'));
                return $this->redirect(['controller'=>'Pages','action'=>'dashboard']);
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout()
    {
        $session = $this->request->session();
        //$session->delete('Auth.User');
        $session->delete('Auth.Role');

        $this->request->session()->destroy();
        $this->Flash->success(__('Logout successfully'));
        return $this->redirect($this->Auth->logout());
    }


    public function index()
    {
        $this->paginate = [
            'contain' => ['Roles', 'Communes', 'Cities', 'Commune']
        ];

        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Roles', 'Commune', 'Tools', 'UserAbilities', 'AnsweredSurveys', 'Cars', 'PaymentMethod', 'Schedules', 'Session', 'Workloads', 'Communes']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {

            $user = $this->Users->patchEntity($user, $this->request->data['User']);
            $user->hash_activate = Security::hash(Text::uuid());

            if ($this->Users->save($user)) {

                if($user->role_id == 5 || $user->role_id == 6)
                {
                    $this->_send_mail_register($user, $user->hash_activate);
                }

                /*** Si hay comunas para mecanicos***/
                if($this->request->data['UsersCommunes']['commune_id'] != null){
                    $mechanic_communes = array();
                    $x=0;
                    foreach($this->request->data['UsersCommunes']['commune_id'] as $key => $value){
                        $mechanic_communes[$x]['user_id'] = $user->id;
                        $mechanic_communes[$x]['commune_id'] = $value;
                        $x++;
                    }

                    $users_communes = TableRegistry::get('UsersCommunes');
                    $entities = $users_communes->newEntities($mechanic_communes);
                    if($users_communes->saveMany($entities)) {


                        $this->Flash->success(__('The mechanic has been saved.'));

                    }
                    else{
                        $this->Flash->error(__('The mechanic could not be saved. Please, try again.'));
                    }
                }
                else{
                    $this->Flash->success(__('The user has been saved.'));
                }
                /**** fin ****/

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $communes = $this->Users->Communes->find('list', ['limit' => 200]);
        $cities = $this->Users->Cities->find('list', ['limit' => 200]);
        $tools = $this->Users->Tools->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'communes', 'tools', 'cities'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Communes', 'Tools', 'Roles', 'Commune']
        ]);

        $ids = array();
        foreach($user->communes as $comm)
        {
            $ids[] = $comm->id;
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data['User']);
            if ($this->Users->save($user))
            {
                /** Validacion de relacion de comunas existentes, nuevas y eliminadas */
                $exist = array();

                foreach($user->communes as $comm)
                {
                    $exist[] = $comm->id;
                }

                $new = array();
                if($this->request->data['UsersCommunes']['commune_id'] != null)
                {
                    foreach($this->request->data['UsersCommunes']['commune_id'] as $key => $value)
                    {
                        if(!in_array($value, $exist))
                        {
                            $new[] = array('user_id' => $user->id, 'commune_id' => $value);
                        }
                    }
                }

                $delete_ids = array();

                if($this->request->data['UsersCommunes']['commune_id'] != null)
                {
                    $delete_ids = array_diff($exist, $this->request->data['UsersCommunes']['commune_id']);
                }
                else
                {
                    $delete_ids = $exist;
                }

                if($delete_ids != null)
                {
                    $delete = '';
                    foreach($delete_ids as $key => $value)
                    {
                        $delete .= $value.', ';
                    }

                    $delete = substr($delete, 0, -2);

                    $this->loadModel('UsersCommunes');
                    $this->UsersCommunes->deleteAll(['commune_id IN' => $delete, 'user_id' => $user->id]);
                }

                if(count($new) > 0)
                {
                    $users_communes = TableRegistry::get('UsersCommunes');
                    $entities = $users_communes->newEntities($new);
                    $users_communes->saveMany($entities);
                }
                /*** Fin validación **/


                $this->Flash->success(__('The user has been updated.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $communes = $this->Users->Communes->find('list', ['limit' => 200]);
        $cities = $this->Users->Cities->find('list', ['limit' => 200]);
        $tools = $this->Users->Tools->find('list', ['limit' => 200]);
        $this->set(compact('user', 'roles', 'communes', 'tools', 'ids', 'cities'));
        $this->set('_serialize', ['user']);
    }

    public function editMechanic($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Communes', 'Tools', 'Roles', 'Commune', 'UserAbilities', 'Tools', 'Schedules']
        ]);

        $ids = array();
        foreach($user->communes as $comm)
        {
            $ids[] = $comm->id;
        }

        if ($this->request->is(['patch', 'post', 'put']))
        {

            if(!empty($this->request->data['User']['photo_data']['tmp_name']) && $this->request->data['User']['photo_data']['error'] == 0)
            {
                $extension = explode('.', $this->request->data['User']['photo_data']['name']);

                $nueva_ruta = 'img/profiles_img/'.strtolower($user->name).'_'.strtolower($user->last_name).'.'.$extension[1];
                $url = 'profiles_img/'.strtolower($user->name).'_'.strtolower($user->last_name).'.'.$extension[1];

                if(move_uploaded_file($this->request->data['User']['photo_data']['tmp_name'], $nueva_ruta))
                {
                    $this->request->data['User']['photo_url'] = $url;
                }
            }

            $user = $this->Users->patchEntity($user, $this->request->data['User']);
            if ($this->Users->save($user))
            {
                /*********************/
                /** Validacion de relacion de comunas existentes, nuevas y eliminadas */
                $exist = array();
                foreach($user->communes as $comm)
                {
                    $exist[] = $comm->id;
                }

                $new = array();
                if($this->request->data['UsersCommunes']['commune_id'] != null)
                {
                    foreach($this->request->data['UsersCommunes']['commune_id'] as $key => $value)
                    {
                        if(!in_array($value, $exist))
                        {
                            $new[] = array('user_id' => $user->id, 'commune_id' => $value);
                        }
                    }
                }

                $delete_ids = array();

                if($this->request->data['UsersCommunes']['commune_id'] != null)
                {
                    $delete_ids = array_diff($exist, $this->request->data['UsersCommunes']['commune_id']);
                }
                else
                {
                    $delete_ids = $exist;
                }

                if($delete_ids != null)
                {
                    $this->loadModel('UsersCommunes');
                    foreach($delete_ids as $key => $value)
                    {
                        $entity = $this->UsersCommunes->get($value);
                        $this->UsersCommunes->delete($entity);
                    }
                }

                if(count($new) > 0)
                {
                    $users_communes = TableRegistry::get('UsersCommunes');
                    $entities = $users_communes->newEntities($new);
                    $users_communes->saveMany($entities);
                }

                /*********************/
                /*** Fin validación **/

                /*echo '<pre>';
                print_r($this->request->data['Schedules']);
                echo '</pre>';*/
                

                /************************************/
                /***Injección de bloques de trabajo**/

                $to_save_blocks = array();
                $to_delete_blocks = array();
                $this->loadModel('Schedules');
                foreach($this->request->data['Schedules'] as $day => $blocks)
                {
                    foreach($blocks as $block)
                    {
                        if(isset($block['is_available']))
                        {
                            if($block['is_available'] == 1 && !isset($block['id']))
                            {
                                /*$block['start_hour'] = Time::createFromTimestamp($block['start_hour']);
                                $block['end_hour'] = Time::createFromTimestamp($block['end_hour']);*/
                                //$to_save_blocks[] = $block;

                                $schedule = $this->Schedules->newEntity();
                                $schedule = $this->Schedules->patchEntity($schedule, $block);
                                $this->Schedules->save($schedule);
                            }
                            elseif($block['is_available'] == 0 && isset($block['id']))
                            {
                                $to_delete_blocks[] .= $block['id'];
                            }
                        }
                    }
                }

                if(count($to_delete_blocks) > 0)
                {
                    $this->loadModel('Schedules');

                    foreach($to_delete_blocks as $delete)
                    {
                        $entity = $this->Schedules->get($delete);
                        $this->Schedules->delete($entity);
                    }
                }

                /*if(count($to_save_blocks) > 0)
                {
                    $schedules = TableRegistry::get('Schedules');
                    $entities = $schedules->newEntities($to_save_blocks);
                    $schedules->saveMany($entities);
                }*/

                /************************************/
                /************************************/


                $this->Flash->success(__('The user has been updated.'));

                return $this->redirect(['action' => 'showAll', 'mechanic']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $roles = $this->Users->Roles->find('list', ['limit' => 200]);
        $communes = $this->Users->Communes->find('list', ['limit' => 200]);
        $cities = $this->Users->Cities->find('list', ['limit' => 200]);
        $tools = $this->Users->Tools->find('list', ['limit' => 200]);
        $week_days = [1 => 'Lunes', 2 => 'Martes', 3 => 'Miercoles', 4 => 'Jueves', 5 => 'Viernes', 6 => 'Sábado', 7 => 'Domingo'];
        $this->set(compact('user', 'roles', 'communes', 'tools', 'ids', 'week_days', 'cities'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function activated($id){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->active = true;
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been activated.'));
        }
        else{
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function deactivated($id){
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $user->active = false;
        if ($this->Users->save($user)) {
            $this->Flash->success(__('The user has been deactivated.'));
        }
        else{
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }

    public function sendNotification($userId){

      $user = $this->Users->get($userId);
      $tokensId=[];

      if($user->active){
        if(isset($user->id_fcm1) && ($user->id_fcm1!=null)){
          array_push($tokensId, $user->id_fcm1);
        }

        if(isset($user->id_fcm2) && ($user->id_fcm2!=null)){
          array_push($tokensId, $user->id_fcm2);
        }

        if(count($tokensId) >0){
          $data = [
            'tokensId' => $tokensId,
            'title' => 'Hello World',
            'body' => 'My awesome Hello World!',
            'data' => [
                'data-1' => 'Lorem ipsum',
                'data-2' => 1234,
                'data-3' => true
            ]
          ];

          $this->Notification->send($data);

        }
      }
    }


    public function recover_password(){

    }/**/

    public function showAll($role_keyword = null)
    {
        if($role_keyword != null)
        {
            $this->loadModel('Roles');
            $role = $this->Roles->find('all')
                    ->where(['Roles.keyword' => $role_keyword])
                    ->select(['id'])
                    ->first();

            $query = $this->Users->find('all')->contain(['Commune', 'Cities'])->where(['role_id' => $role->id]);
            $users = $this->paginate($query);

            $this->set(compact('users'));
            $this->set('_serialize', ['users']);
        }
        else
        {
            $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
    }

    function deletePhoto($id)
    {
        $this->autoRender = false;

        if($id != null)
        {
            $user = $this->Users->get($id);

            if(unlink('img/'.$user->photo_url))
            {
                $user->photo_url = '';
                $this->Users->save($user);
                return true;
            }
        }

        return false;

    }

    public function generateAddressRadioSelect($user_id = null)
    {
        if($user_id != null)
        {
            if($this->request->is('ajax'))
            {
                $this->viewBuilder()->layout('ajax');
                $this->loadModel('Cities');
                $this->loadModel('Communes');
                $this->set('cities', $this->Cities->find('list'));
                $this->set('communes', $this->Communes->find('list'));
                $this->set('user', $this->Users->get($user_id));
            }
        }
    }

    public function _send_mail_register($user, $token_activate){
        $email = new Email('default');

        $titulo = 'Bienvenido '.$user->name . ' ' . $user->last_name;
            $contenido_correo =
            'Saludos <b>' . $user->name . ' ' . $user->last_name . ',</b><br>' .
            '<br>' .
            'Te damos la bienvenida a Fullmec.<br>' .
            '<b>Fullmec</b> enjoy.' . '<br><br>' .
            'No responda este mail, ha sido generado de manera automática.';

        if(isset($contenido_correo)){
                $data = [
                    'title'=>$titulo,
                    'to'=>$user->email,
                    'body'=>  $contenido_correo,
                    'subject'=> $titulo
                ];
                $this->Message->send($data);
        }

    }

    function test()
    {
        $this->autoRender = false;
        $this->Users->searchMechanics(21);
    }
}
