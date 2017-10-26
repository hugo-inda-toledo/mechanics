<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * UsersCommunes Controller
 *
 * @property \App\Model\Table\UsersCommunesTable $UsersCommunes
 */
class UsersCommunesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Communes']
        ];
        $usersCommunes = $this->paginate($this->UsersCommunes);

        $this->set(compact('usersCommunes'));
        $this->set('_serialize', ['usersCommunes']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Commune id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersCommune = $this->UsersCommunes->get($id, [
            'contain' => ['Users', 'Communes']
        ]);

        $this->set('usersCommune', $usersCommune);
        $this->set('_serialize', ['usersCommune']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersCommune = $this->UsersCommunes->newEntity();
        if ($this->request->is('post')) {
            $usersCommune = $this->UsersCommunes->patchEntity($usersCommune, $this->request->data);
            if ($this->UsersCommunes->save($usersCommune)) {
                $this->Flash->success(__('The users commune has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users commune could not be saved. Please, try again.'));
        }
        $users = $this->UsersCommunes->Users->find('list', ['limit' => 200]);
        $communes = $this->UsersCommunes->Communes->find('list', ['limit' => 200]);
        $this->set(compact('usersCommune', 'users', 'communes'));
        $this->set('_serialize', ['usersCommune']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Commune id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersCommune = $this->UsersCommunes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersCommune = $this->UsersCommunes->patchEntity($usersCommune, $this->request->data);
            if ($this->UsersCommunes->save($usersCommune)) {
                $this->Flash->success(__('The users commune has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users commune could not be saved. Please, try again.'));
        }
        $users = $this->UsersCommunes->Users->find('list', ['limit' => 200]);
        $communes = $this->UsersCommunes->Communes->find('list', ['limit' => 200]);
        $this->set(compact('usersCommune', 'users', 'communes'));
        $this->set('_serialize', ['usersCommune']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Commune id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersCommune = $this->UsersCommunes->get($id);
        if ($this->UsersCommunes->delete($usersCommune)) {
            $this->Flash->success(__('The users commune has been deleted.'));
        } else {
            $this->Flash->error(__('The users commune could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
