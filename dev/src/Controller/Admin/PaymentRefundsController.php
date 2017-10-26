<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * PaymentRefunds Controller
 *
 * @property \App\Model\Table\PaymentRefundsTable $PaymentRefunds
 */
class PaymentRefundsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Banks']
        ];
        $paymentRefunds = $this->paginate($this->PaymentRefunds);

        $this->set(compact('paymentRefunds'));
        $this->set('_serialize', ['paymentRefunds']);
    }

    /**
     * View method
     *
     * @param string|null $id Payment Refund id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentRefund = $this->PaymentRefunds->get($id, [
            'contain' => ['Banks', 'Providers', 'Users']
        ]);

        $this->set('paymentRefund', $paymentRefund);
        $this->set('_serialize', ['paymentRefund']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paymentRefund = $this->PaymentRefunds->newEntity();
        if ($this->request->is('post')) {
            $paymentRefund = $this->PaymentRefunds->patchEntity($paymentRefund, $this->request->data);
            if ($this->PaymentRefunds->save($paymentRefund)) {
                $this->Flash->success(__('The {0} has been saved.', 'Payment Refund'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Payment Refund'));
            }
        }
        $banks = $this->PaymentRefunds->Banks->find('list', ['limit' => 200]);
        $providers = $this->PaymentRefunds->Providers->find('list', ['limit' => 200]);
        $users = $this->PaymentRefunds->Users->find('list', ['limit' => 200]);
        $this->set(compact('paymentRefund', 'banks', 'providers', 'users'));
        $this->set('_serialize', ['paymentRefund']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment Refund id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paymentRefund = $this->PaymentRefunds->get($id, [
            'contain' => ['Providers', 'Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentRefund = $this->PaymentRefunds->patchEntity($paymentRefund, $this->request->data);
            if ($this->PaymentRefunds->save($paymentRefund)) {
                $this->Flash->success(__('The {0} has been saved.', 'Payment Refund'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Payment Refund'));
            }
        }
        $banks = $this->PaymentRefunds->Banks->find('list', ['limit' => 200]);
        $providers = $this->PaymentRefunds->Providers->find('list', ['limit' => 200]);
        $users = $this->PaymentRefunds->Users->find('list', ['limit' => 200]);
        $this->set(compact('paymentRefund', 'banks', 'providers', 'users'));
        $this->set('_serialize', ['paymentRefund']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment Refund id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paymentRefund = $this->PaymentRefunds->get($id);
        if ($this->PaymentRefunds->delete($paymentRefund)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Payment Refund'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Payment Refund'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
