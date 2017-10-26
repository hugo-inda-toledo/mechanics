<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * AvailableServicesItems Controller
 *
 * @property \App\Model\Table\AvailableServicesItemsTable $AvailableServicesItems
 */
class AvailableServicesItemsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AvailableServices', 'Items']
        ];
        $availableServicesItems = $this->paginate($this->AvailableServicesItems);

        $this->set(compact('availableServicesItems'));
        $this->set('_serialize', ['availableServicesItems']);
    }

    /**
     * View method
     *
     * @param string|null $id Available Services Item id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $availableServicesItem = $this->AvailableServicesItems->get($id, [
            'contain' => ['AvailableServices', 'Items']
        ]);

        $this->set('availableServicesItem', $availableServicesItem);
        $this->set('_serialize', ['availableServicesItem']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $availableServicesItem = $this->AvailableServicesItems->newEntity();
        if ($this->request->is('post')) {
            $availableServicesItem = $this->AvailableServicesItems->patchEntity($availableServicesItem, $this->request->data);
            if ($this->AvailableServicesItems->save($availableServicesItem)) {
                $this->Flash->success(__('The available services item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The available services item could not be saved. Please, try again.'));
        }
        $availableServices = $this->AvailableServicesItems->AvailableServices->find('list', ['limit' => 200]);
        $items = $this->AvailableServicesItems->Items->find('list', ['limit' => 200]);
        $this->set(compact('availableServicesItem', 'availableServices', 'items'));
        $this->set('_serialize', ['availableServicesItem']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Available Services Item id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $availableServicesItem = $this->AvailableServicesItems->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $availableServicesItem = $this->AvailableServicesItems->patchEntity($availableServicesItem, $this->request->data);
            if ($this->AvailableServicesItems->save($availableServicesItem)) {
                $this->Flash->success(__('The available services item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The available services item could not be saved. Please, try again.'));
        }
        $availableServices = $this->AvailableServicesItems->AvailableServices->find('list', ['limit' => 200]);
        $items = $this->AvailableServicesItems->Items->find('list', ['limit' => 200]);
        $this->set(compact('availableServicesItem', 'availableServices', 'items'));
        $this->set('_serialize', ['availableServicesItem']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Available Services Item id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $availableServicesItem = $this->AvailableServicesItems->get($id);
        if ($this->AvailableServicesItems->delete($availableServicesItem)) {
            $this->Flash->success(__('The available services item has been deleted.'));
        } else {
            $this->Flash->error(__('The available services item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
