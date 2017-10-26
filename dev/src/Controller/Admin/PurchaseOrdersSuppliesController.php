<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * PurchaseOrdersSupplies Controller
 *
 * @property \App\Model\Table\PurchaseOrdersSuppliesTable $PurchaseOrdersSupplies
 */
class PurchaseOrdersSuppliesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseOrders', 'Supplies', 'Providers']
        ];
        $purchaseOrdersSupplies = $this->paginate($this->PurchaseOrdersSupplies);

        $this->set(compact('purchaseOrdersSupplies'));
        $this->set('_serialize', ['purchaseOrdersSupplies']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Orders Supply id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseOrdersSupply = $this->PurchaseOrdersSupplies->get($id, [
            'contain' => ['PurchaseOrders', 'Supplies', 'Providers']
        ]);

        $this->set('purchaseOrdersSupply', $purchaseOrdersSupply);
        $this->set('_serialize', ['purchaseOrdersSupply']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseOrdersSupply = $this->PurchaseOrdersSupplies->newEntity();
        if ($this->request->is('post')) {
            $purchaseOrdersSupply = $this->PurchaseOrdersSupplies->patchEntity($purchaseOrdersSupply, $this->request->data);
            if ($this->PurchaseOrdersSupplies->save($purchaseOrdersSupply)) {
                $this->Flash->success(__('The {0} has been saved.', 'Purchase Orders Supply'));
                return $this->redirect(['controller' => 'PurchaseOrders', 'action' => 'view', $purchaseOrdersSupply->purchase_order_id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Purchase Orders Supply'));
            }
        }
        $purchaseOrders = $this->PurchaseOrdersSupplies->PurchaseOrders->find('list', ['limit' => 200]);
        $supplies = $this->PurchaseOrdersSupplies->Supplies->find('list', ['limit' => 200]);
        $providers = $this->PurchaseOrdersSupplies->Providers->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrdersSupply', 'purchaseOrders', 'supplies', 'providers'));
        $this->set('_serialize', ['purchaseOrdersSupply']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Orders Supply id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOrdersSupply = $this->PurchaseOrdersSupplies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOrdersSupply = $this->PurchaseOrdersSupplies->patchEntity($purchaseOrdersSupply, $this->request->data);
            if ($this->PurchaseOrdersSupplies->save($purchaseOrdersSupply)) {
                $this->Flash->success(__('The {0} has been saved.', 'Purchase Orders Supply'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Purchase Orders Supply'));
            }
        }
        $purchaseOrders = $this->PurchaseOrdersSupplies->PurchaseOrders->find('list', ['limit' => 200]);
        $supplies = $this->PurchaseOrdersSupplies->Supplies->find('list', ['limit' => 200]);
        $providers = $this->PurchaseOrdersSupplies->Providers->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrdersSupply', 'purchaseOrders', 'supplies', 'providers'));
        $this->set('_serialize', ['purchaseOrdersSupply']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Orders Supply id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrdersSupply = $this->PurchaseOrdersSupplies->get($id);
        $purchase_order_id = $purchaseOrdersSupply->purchase_order_id;
        if ($this->PurchaseOrdersSupplies->delete($purchaseOrdersSupply)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Purchase Orders Supply'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Purchase Orders Supply'));
        }
        return $this->redirect(['controller' => 'PurchaseOrders', 'action' => 'view', $purchase_order_id]);
    }
}
