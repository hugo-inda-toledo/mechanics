<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ItemsLogs Controller
 *
 * @property \App\Model\Table\ItemsLogsTable $ItemsLogs
 */
class ItemsLogsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RequestServices', 'Requests', 'Users', 'Items']
        ];
        $itemsLogs = $this->paginate($this->ItemsLogs);

        $this->set(compact('itemsLogs'));
        $this->set('_serialize', ['itemsLogs']);
    }

    /**
     * View method
     *
     * @param string|null $id Items Log id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $itemsLog = $this->ItemsLogs->get($id, [
            'contain' => ['RequestServices', 'Requests', 'Users', 'Items']
        ]);

        $this->set('itemsLog', $itemsLog);
        $this->set('_serialize', ['itemsLog']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $itemsLog = $this->ItemsLogs->newEntity();
        if ($this->request->is('post')) {
            $itemsLog = $this->ItemsLogs->patchEntity($itemsLog, $this->request->data);
            if ($this->ItemsLogs->save($itemsLog)) {
                $this->Flash->success(__('The items log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The items log could not be saved. Please, try again.'));
        }
        $requestServices = $this->ItemsLogs->RequestServices->find('list', ['limit' => 200]);
        $requests = $this->ItemsLogs->Requests->find('list', ['limit' => 200]);
        $users = $this->ItemsLogs->Users->find('list', ['limit' => 200]);
        $items = $this->ItemsLogs->Items->find('list', ['limit' => 200]);
        $this->set(compact('itemsLog', 'requestServices', 'requests', 'users', 'items'));
        $this->set('_serialize', ['itemsLog']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Items Log id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $itemsLog = $this->ItemsLogs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemsLog = $this->ItemsLogs->patchEntity($itemsLog, $this->request->data);
            if ($this->ItemsLogs->save($itemsLog)) {
                $this->Flash->success(__('The items log has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The items log could not be saved. Please, try again.'));
        }
        $requestServices = $this->ItemsLogs->RequestServices->find('list', ['limit' => 200]);
        $requests = $this->ItemsLogs->Requests->find('list', ['limit' => 200]);
        $users = $this->ItemsLogs->Users->find('list', ['limit' => 200]);
        $items = $this->ItemsLogs->Items->find('list', ['limit' => 200]);
        $this->set(compact('itemsLog', 'requestServices', 'requests', 'users', 'items'));
        $this->set('_serialize', ['itemsLog']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Items Log id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemsLog = $this->ItemsLogs->get($id);
        if ($this->ItemsLogs->delete($itemsLog)) {
            $this->Flash->success(__('The items log has been deleted.'));
        } else {
            $this->Flash->error(__('The items log could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
