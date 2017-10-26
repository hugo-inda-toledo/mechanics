<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * PurchaseOrdersItems Controller
 *
 * @property \App\Model\Table\PurchaseOrdersItemsTable $PurchaseOrdersItems
 */
class PurchaseOrdersItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseOrders', 'Items']
        ];
        $purchaseOrdersItems = $this->paginate($this->PurchaseOrdersItems);

        $this->set(compact('purchaseOrdersItems'));
        $this->set('_serialize', ['purchaseOrdersItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Orders Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseOrdersItem = $this->PurchaseOrdersItems->get($id, [
            'contain' => ['PurchaseOrders', 'Items']
        ]);

        $this->set('purchaseOrdersItem', $purchaseOrdersItem);
        $this->set('_serialize', ['purchaseOrdersItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseOrdersItem = $this->PurchaseOrdersItems->newEntity();
        if ($this->request->is('post')) {
            $purchaseOrdersItem = $this->PurchaseOrdersItems->patchEntity($purchaseOrdersItem, $this->request->data);
            if ($this->PurchaseOrdersItems->save($purchaseOrdersItem)) {
                $this->Flash->success(__('The {0} has been saved.', 'Purchase Orders Item'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Purchase Orders Item'));
            }
        }
        $purchaseOrders = $this->PurchaseOrdersItems->PurchaseOrders->find('list', ['limit' => 200]);
        $items = $this->PurchaseOrdersItems->Items->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrdersItem', 'purchaseOrders', 'items'));
        $this->set('_serialize', ['purchaseOrdersItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Orders Item id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOrdersItem = $this->PurchaseOrdersItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOrdersItem = $this->PurchaseOrdersItems->patchEntity($purchaseOrdersItem, $this->request->data);
            if ($this->PurchaseOrdersItems->save($purchaseOrdersItem)) {
                $this->Flash->success(__('The {0} has been saved.', 'Purchase Orders Item'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Purchase Orders Item'));
            }
        }
        $purchaseOrders = $this->PurchaseOrdersItems->PurchaseOrders->find('list', ['limit' => 200]);
        $items = $this->PurchaseOrdersItems->Items->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrdersItem', 'purchaseOrders', 'items'));
        $this->set('_serialize', ['purchaseOrdersItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Orders Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrdersItem = $this->PurchaseOrdersItems->get($id);
        if ($this->PurchaseOrdersItems->delete($purchaseOrdersItem)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Purchase Orders Item'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Purchase Orders Item'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
