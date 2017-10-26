<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * UsersTools Controller
 *
 * @property \App\Model\Table\UsersToolsTable $UsersTools
 */
class UsersToolsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Tools']
        ];
        $usersTools = $this->paginate($this->UsersTools);

        $this->set(compact('usersTools'));
        $this->set('_serialize', ['usersTools']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Tool id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersTool = $this->UsersTools->get($id, [
            'contain' => ['Users', 'Tools']
        ]);

        $this->set('usersTool', $usersTool);
        $this->set('_serialize', ['usersTool']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersTool = $this->UsersTools->newEntity();
        if ($this->request->is('post')) {
            $usersTool = $this->UsersTools->patchEntity($usersTool, $this->request->data);
            if ($this->UsersTools->save($usersTool)) {
                $this->Flash->success(__('The users tool has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users tool could not be saved. Please, try again.'));
        }
        $users = $this->UsersTools->Users->find('list', ['limit' => 200]);
        $tools = $this->UsersTools->Tools->find('list', ['limit' => 200]);
        $this->set(compact('usersTool', 'users', 'tools'));
        $this->set('_serialize', ['usersTool']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Tool id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersTool = $this->UsersTools->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersTool = $this->UsersTools->patchEntity($usersTool, $this->request->data);
            if ($this->UsersTools->save($usersTool)) {
                $this->Flash->success(__('The users tool has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users tool could not be saved. Please, try again.'));
        }
        $users = $this->UsersTools->Users->find('list', ['limit' => 200]);
        $tools = $this->UsersTools->Tools->find('list', ['limit' => 200]);
        $this->set(compact('usersTool', 'users', 'tools'));
        $this->set('_serialize', ['usersTool']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Tool id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersTool = $this->UsersTools->get($id);
        if ($this->UsersTools->delete($usersTool)) {
            $this->Flash->success(__('The users tool has been deleted.'));
        } else {
            $this->Flash->error(__('The users tool could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
