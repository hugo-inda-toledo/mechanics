<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * UsersPaymentRefunds Controller
 *
 * @property \App\Model\Table\UsersPaymentRefundsTable $UsersPaymentRefunds
 */
class UsersPaymentRefundsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'PaymentRefunds']
        ];
        $usersPaymentRefunds = $this->paginate($this->UsersPaymentRefunds);

        $this->set(compact('usersPaymentRefunds'));
        $this->set('_serialize', ['usersPaymentRefunds']);
    }

    /**
     * View method
     *
     * @param string|null $id Users Payment Refund id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $usersPaymentRefund = $this->UsersPaymentRefunds->get($id, [
            'contain' => ['Users', 'PaymentRefunds']
        ]);

        $this->set('usersPaymentRefund', $usersPaymentRefund);
        $this->set('_serialize', ['usersPaymentRefund']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersPaymentRefund = $this->UsersPaymentRefunds->newEntity();
        if ($this->request->is('post')) {
            $usersPaymentRefund = $this->UsersPaymentRefunds->patchEntity($usersPaymentRefund, $this->request->data);
            if ($this->UsersPaymentRefunds->save($usersPaymentRefund)) {
                $this->Flash->success(__('The {0} has been saved.', 'Users Payment Refund'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Users Payment Refund'));
            }
        }
        $users = $this->UsersPaymentRefunds->Users->find('list', ['limit' => 200]);
        $paymentRefunds = $this->UsersPaymentRefunds->PaymentRefunds->find('list', ['limit' => 200]);
        $this->set(compact('usersPaymentRefund', 'users', 'paymentRefunds'));
        $this->set('_serialize', ['usersPaymentRefund']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Users Payment Refund id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $usersPaymentRefund = $this->UsersPaymentRefunds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $usersPaymentRefund = $this->UsersPaymentRefunds->patchEntity($usersPaymentRefund, $this->request->data);
            if ($this->UsersPaymentRefunds->save($usersPaymentRefund)) {
                $this->Flash->success(__('The {0} has been saved.', 'Users Payment Refund'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Users Payment Refund'));
            }
        }
        $users = $this->UsersPaymentRefunds->Users->find('list', ['limit' => 200]);
        $paymentRefunds = $this->UsersPaymentRefunds->PaymentRefunds->find('list', ['limit' => 200]);
        $this->set(compact('usersPaymentRefund', 'users', 'paymentRefunds'));
        $this->set('_serialize', ['usersPaymentRefund']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Users Payment Refund id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $usersPaymentRefund = $this->UsersPaymentRefunds->get($id);
        if ($this->UsersPaymentRefunds->delete($usersPaymentRefund)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Users Payment Refund'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Users Payment Refund'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
