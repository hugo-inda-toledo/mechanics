<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * PurchaseOrdersReplacements Controller
 *
 * @property \App\Model\Table\PurchaseOrdersReplacementsTable $PurchaseOrdersReplacements
 */
class PurchaseOrdersReplacementsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['PurchaseOrders', 'Replacements', 'Providers']
        ];
        $purchaseOrdersReplacements = $this->paginate($this->PurchaseOrdersReplacements);

        $this->set(compact('purchaseOrdersReplacements'));
        $this->set('_serialize', ['purchaseOrdersReplacements']);
    }

    /**
     * View method
     *
     * @param string|null $id Purchase Orders Replacement id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $purchaseOrdersReplacement = $this->PurchaseOrdersReplacements->get($id, [
            'contain' => ['PurchaseOrders', 'Replacements', 'Providers']
        ]);

        $this->set('purchaseOrdersReplacement', $purchaseOrdersReplacement);
        $this->set('_serialize', ['purchaseOrdersReplacement']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $purchaseOrdersReplacement = $this->PurchaseOrdersReplacements->newEntity();
        if ($this->request->is('post')) {
            $purchaseOrdersReplacement = $this->PurchaseOrdersReplacements->patchEntity($purchaseOrdersReplacement, $this->request->data);
            if ($this->PurchaseOrdersReplacements->save($purchaseOrdersReplacement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Purchase Orders Replacement'));
                return $this->redirect(['controller' => 'PurchaseOrders', 'action' => 'view', $purchaseOrdersReplacement->purchase_order_id]);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Purchase Orders Replacement'));
            }
        }
        $purchaseOrders = $this->PurchaseOrdersReplacements->PurchaseOrders->find('list', ['limit' => 200]);
        $replacements = $this->PurchaseOrdersReplacements->Replacements->find('list', ['limit' => 200]);
        $providers = $this->PurchaseOrdersReplacements->Providers->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrdersReplacement', 'purchaseOrders', 'replacements', 'providers'));
        $this->set('_serialize', ['purchaseOrdersReplacement']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Purchase Orders Replacement id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $purchaseOrdersReplacement = $this->PurchaseOrdersReplacements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseOrdersReplacement = $this->PurchaseOrdersReplacements->patchEntity($purchaseOrdersReplacement, $this->request->data);
            if ($this->PurchaseOrdersReplacements->save($purchaseOrdersReplacement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Purchase Orders Replacement'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Purchase Orders Replacement'));
            }
        }
        $purchaseOrders = $this->PurchaseOrdersReplacements->PurchaseOrders->find('list', ['limit' => 200]);
        $replacements = $this->PurchaseOrdersReplacements->Replacements->find('list', ['limit' => 200]);
        $providers = $this->PurchaseOrdersReplacements->Providers->find('list', ['limit' => 200]);
        $this->set(compact('purchaseOrdersReplacement', 'purchaseOrders', 'replacements', 'providers'));
        $this->set('_serialize', ['purchaseOrdersReplacement']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Orders Replacement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $purchaseOrdersReplacement = $this->PurchaseOrdersReplacements->get($id);
        $purchase_order_id = $purchaseOrdersReplacement->purchase_order_id;
        if ($this->PurchaseOrdersReplacements->delete($purchaseOrdersReplacement)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Purchase Orders Replacement'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Purchase Orders Replacement'));
        }
        
        return $this->redirect(['controller' => 'PurchaseOrders', 'action' => 'view', $purchase_order_id]);
    }
}
