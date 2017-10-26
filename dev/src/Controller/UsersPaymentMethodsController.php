<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * UsersPaymentMethods Controller
 *
 * @property \App\Model\Table\UsersPaymentMethodsTable $UsersPaymentMethods
 */
class UsersPaymentMethodsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $usersPaymentMethods = $this->paginate($this->UsersPaymentMethods);

        $this->set(compact('usersPaymentMethods'));
        $this->set('_serialize', ['usersPaymentMethods']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Payment Method id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersPaymentMethod = $this->UsersPaymentMethods->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('usersPaymentMethod', $usersPaymentMethod);
        $this->set('_serialize', ['usersPaymentMethod']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersPaymentMethod = $this->UsersPaymentMethods->newEntity();
        if ($this->request->is('post')) {
            $usersPaymentMethod = $this->UsersPaymentMethods->patchEntity($usersPaymentMethod, $this->request->data);
            if ($this->UsersPaymentMethods->save($usersPaymentMethod)) {
                $this->Flash->success(__('The users payment method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users payment method could not be saved. Please, try again.'));
        }
        $users = $this->UsersPaymentMethods->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersPaymentMethod', 'users'));
        $this->set('_serialize', ['usersPaymentMethod']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Payment Method id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersPaymentMethod = $this->UsersPaymentMethods->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersPaymentMethod = $this->UsersPaymentMethods->patchEntity($usersPaymentMethod, $this->request->data);
            if ($this->UsersPaymentMethods->save($usersPaymentMethod)) {
                $this->Flash->success(__('The users payment method has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The users payment method could not be saved. Please, try again.'));
        }
        $users = $this->UsersPaymentMethods->Users->find('list', ['limit' => 200]);
        $this->set(compact('usersPaymentMethod', 'users'));
        $this->set('_serialize', ['usersPaymentMethod']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Payment Method id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersPaymentMethod = $this->UsersPaymentMethods->get($id);
        if ($this->UsersPaymentMethods->delete($usersPaymentMethod)) {
            $this->Flash->success(__('The users payment method has been deleted.'));
        } else {
            $this->Flash->error(__('The users payment method could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
