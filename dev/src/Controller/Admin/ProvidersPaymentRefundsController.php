<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ProvidersPaymentRefunds Controller
 *
 * @property \App\Model\Table\ProvidersPaymentRefundsTable $ProvidersPaymentRefunds
 */
class ProvidersPaymentRefundsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Providers', 'PaymentRefunds']
        ];
        $providersPaymentRefunds = $this->paginate($this->ProvidersPaymentRefunds);

        $this->set(compact('providersPaymentRefunds'));
        $this->set('_serialize', ['providersPaymentRefunds']);
    }

    /**
     * View method
     *
     * @param string|null $id Providers Payment Refund id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $providersPaymentRefund = $this->ProvidersPaymentRefunds->get($id, [
            'contain' => ['Providers', 'PaymentRefunds']
        ]);

        $this->set('providersPaymentRefund', $providersPaymentRefund);
        $this->set('_serialize', ['providersPaymentRefund']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $providersPaymentRefund = $this->ProvidersPaymentRefunds->newEntity();
        if ($this->request->is('post')) {
            $providersPaymentRefund = $this->ProvidersPaymentRefunds->patchEntity($providersPaymentRefund, $this->request->data);
            if ($this->ProvidersPaymentRefunds->save($providersPaymentRefund)) {
                $this->Flash->success(__('The {0} has been saved.', 'Providers Payment Refund'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Providers Payment Refund'));
            }
        }
        $providers = $this->ProvidersPaymentRefunds->Providers->find('list', ['limit' => 200]);
        $paymentRefunds = $this->ProvidersPaymentRefunds->PaymentRefunds->find('list', ['limit' => 200]);
        $this->set(compact('providersPaymentRefund', 'providers', 'paymentRefunds'));
        $this->set('_serialize', ['providersPaymentRefund']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Providers Payment Refund id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $providersPaymentRefund = $this->ProvidersPaymentRefunds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $providersPaymentRefund = $this->ProvidersPaymentRefunds->patchEntity($providersPaymentRefund, $this->request->data);
            if ($this->ProvidersPaymentRefunds->save($providersPaymentRefund)) {
                $this->Flash->success(__('The {0} has been saved.', 'Providers Payment Refund'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Providers Payment Refund'));
            }
        }
        $providers = $this->ProvidersPaymentRefunds->Providers->find('list', ['limit' => 200]);
        $paymentRefunds = $this->ProvidersPaymentRefunds->PaymentRefunds->find('list', ['limit' => 200]);
        $this->set(compact('providersPaymentRefund', 'providers', 'paymentRefunds'));
        $this->set('_serialize', ['providersPaymentRefund']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Providers Payment Refund id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $providersPaymentRefund = $this->ProvidersPaymentRefunds->get($id);
        if ($this->ProvidersPaymentRefunds->delete($providersPaymentRefund)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Providers Payment Refund'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Providers Payment Refund'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
