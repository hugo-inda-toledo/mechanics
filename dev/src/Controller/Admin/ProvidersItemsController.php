<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ProvidersItems Controller
 *
 * @property \App\Model\Table\ProvidersItemsTable $ProvidersItems
 */
class ProvidersItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Providers', 'Items']
        ];
        $providersItems = $this->paginate($this->ProvidersItems);

        $this->set(compact('providersItems'));
        $this->set('_serialize', ['providersItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Providers Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $providersItem = $this->ProvidersItems->get($id, [
            'contain' => ['Providers', 'Items']
        ]);

        $this->set('providersItem', $providersItem);
        $this->set('_serialize', ['providersItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $providersItem = $this->ProvidersItems->newEntity();
        if ($this->request->is('post')) {
            $providersItem = $this->ProvidersItems->patchEntity($providersItem, $this->request->data);
            if ($this->ProvidersItems->save($providersItem)) {
                $this->Flash->success(__('The providers item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The providers item could not be saved. Please, try again.'));
        }
        $providers = $this->ProvidersItems->Providers->find('list', ['limit' => 200]);
        $items = $this->ProvidersItems->Items->find('list', ['limit' => 200]);
        $this->set(compact('providersItem', 'providers', 'items'));
        $this->set('_serialize', ['providersItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Providers Item id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $providersItem = $this->ProvidersItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $providersItem = $this->ProvidersItems->patchEntity($providersItem, $this->request->data);
            if ($this->ProvidersItems->save($providersItem)) {
                $this->Flash->success(__('The providers item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The providers item could not be saved. Please, try again.'));
        }
        $providers = $this->ProvidersItems->Providers->find('list', ['limit' => 200]);
        $items = $this->ProvidersItems->Items->find('list', ['limit' => 200]);
        $this->set(compact('providersItem', 'providers', 'items'));
        $this->set('_serialize', ['providersItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Providers Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $providersItem = $this->ProvidersItems->get($id);
        if ($this->ProvidersItems->delete($providersItem)) {
            $this->Flash->success(__('The providers item has been deleted.'));
        } else {
            $this->Flash->error(__('The providers item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
