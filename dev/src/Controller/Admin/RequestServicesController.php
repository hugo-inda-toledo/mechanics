<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * RequestServices Controller
 *
 * @property \App\Model\Table\RequestServicesTable $RequestServices
 */
class RequestServicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Requests', 'AvailableServices']
        ];
        $requestServices = $this->paginate($this->RequestServices);

        $this->set(compact('requestServices'));
        $this->set('_serialize', ['requestServices']);
    }

    /**
     * View method
     *
     * @param string|null $id Request Service id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestService = $this->RequestServices->get($id, [
            'contain' => ['Requests', 'AvailableServices', 'ItemsLogs']
        ]);

        $this->set('requestService', $requestService);
        $this->set('_serialize', ['requestService']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestService = $this->RequestServices->newEntity();
        if ($this->request->is('post')) {
            $requestService = $this->RequestServices->patchEntity($requestService, $this->request->data);
            if ($this->RequestServices->save($requestService)) {
                $this->Flash->success(__('The request service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request service could not be saved. Please, try again.'));
        }
        $requests = $this->RequestServices->Requests->find('list', ['limit' => 200]);
        $availableServices = $this->RequestServices->AvailableServices->find('list', ['limit' => 200]);
        $this->set(compact('requestService', 'requests', 'availableServices'));
        $this->set('_serialize', ['requestService']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Request Service id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestService = $this->RequestServices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestService = $this->RequestServices->patchEntity($requestService, $this->request->data);
            if ($this->RequestServices->save($requestService)) {
                $this->Flash->success(__('The request service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The request service could not be saved. Please, try again.'));
        }
        $requests = $this->RequestServices->Requests->find('list', ['limit' => 200]);
        $availableServices = $this->RequestServices->AvailableServices->find('list', ['limit' => 200]);
        $this->set(compact('requestService', 'requests', 'availableServices'));
        $this->set('_serialize', ['requestService']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Request Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestService = $this->RequestServices->get($id);
        if ($this->RequestServices->delete($requestService)) {
            $this->Flash->success(__('The request service has been deleted.'));
        } else {
            $this->Flash->error(__('The request service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
