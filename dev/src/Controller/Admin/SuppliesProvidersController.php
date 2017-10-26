<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * SuppliesProviders Controller
 *
 * @property \App\Model\Table\SuppliesProvidersTable $SuppliesProviders
 */
class SuppliesProvidersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Providers', 'Supplies']
        ];
        $suppliesProviders = $this->paginate($this->SuppliesProviders);

        $this->set(compact('suppliesProviders'));
        $this->set('_serialize', ['suppliesProviders']);
    }

    /**
     * View method
     *
     * @param string|null $id Supplies Provider id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $suppliesProvider = $this->SuppliesProviders->get($id, [
            'contain' => ['Providers', 'Supplies']
        ]);

        $this->set('suppliesProvider', $suppliesProvider);
        $this->set('_serialize', ['suppliesProvider']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $suppliesProvider = $this->SuppliesProviders->newEntity();
        if ($this->request->is('post')) {
            $suppliesProvider = $this->SuppliesProviders->patchEntity($suppliesProvider, $this->request->data);
            if ($this->SuppliesProviders->save($suppliesProvider)) {
                $this->Flash->success(__('The {0} has been saved.', 'Supplies Provider'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Supplies Provider'));
            }
        }
        $providers = $this->SuppliesProviders->Providers->find('list', ['limit' => 200]);
        $supplies = $this->SuppliesProviders->Supplies->find('list', ['limit' => 200]);
        $this->set(compact('suppliesProvider', 'providers', 'supplies'));
        $this->set('_serialize', ['suppliesProvider']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Supplies Provider id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $suppliesProvider = $this->SuppliesProviders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $suppliesProvider = $this->SuppliesProviders->patchEntity($suppliesProvider, $this->request->data);
            if ($this->SuppliesProviders->save($suppliesProvider)) {
                $this->Flash->success(__('The {0} has been saved.', 'Supplies Provider'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Supplies Provider'));
            }
        }
        $providers = $this->SuppliesProviders->Providers->find('list', ['limit' => 200]);
        $supplies = $this->SuppliesProviders->Supplies->find('list', ['limit' => 200]);
        $this->set(compact('suppliesProvider', 'providers', 'supplies'));
        $this->set('_serialize', ['suppliesProvider']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Supplies Provider id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $suppliesProvider = $this->SuppliesProviders->get($id);
        if ($this->SuppliesProviders->delete($suppliesProvider)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Supplies Provider'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Supplies Provider'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
