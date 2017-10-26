<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * RequestsAvailableServices Controller
 *
 * @property \App\Model\Table\RequestsAvailableServicesTable $RequestsAvailableServices
 */
class RequestsAvailableServicesController extends AppController
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
        $requestsAvailableServices = $this->paginate($this->RequestsAvailableServices);

        $this->set(compact('requestsAvailableServices'));
        $this->set('_serialize', ['requestsAvailableServices']);
    }

    /**
     * View method
     *
     * @param string|null $id Requests Available Service id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestsAvailableService = $this->RequestsAvailableServices->get($id, [
            'contain' => ['Requests', 'AvailableServices']
        ]);

        $this->set('requestsAvailableService', $requestsAvailableService);
        $this->set('_serialize', ['requestsAvailableService']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestsAvailableService = $this->RequestsAvailableServices->newEntity();
        if ($this->request->is('post')) {
            $requestsAvailableService = $this->RequestsAvailableServices->patchEntity($requestsAvailableService, $this->request->data);
            if ($this->RequestsAvailableServices->save($requestsAvailableService)) {
                $this->Flash->success(__('The requests available service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests available service could not be saved. Please, try again.'));
        }
        $requests = $this->RequestsAvailableServices->Requests->find('list', ['limit' => 200]);
        $availableServices = $this->RequestsAvailableServices->AvailableServices->find('list', ['limit' => 200]);
        $this->set(compact('requestsAvailableService', 'requests', 'availableServices'));
        $this->set('_serialize', ['requestsAvailableService']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Requests Available Service id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestsAvailableService = $this->RequestsAvailableServices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestsAvailableService = $this->RequestsAvailableServices->patchEntity($requestsAvailableService, $this->request->data);
            if ($this->RequestsAvailableServices->save($requestsAvailableService)) {
                $this->Flash->success(__('The requests available service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests available service could not be saved. Please, try again.'));
        }
        $requests = $this->RequestsAvailableServices->Requests->find('list', ['limit' => 200]);
        $availableServices = $this->RequestsAvailableServices->AvailableServices->find('list', ['limit' => 200]);
        $this->set(compact('requestsAvailableService', 'requests', 'availableServices'));
        $this->set('_serialize', ['requestsAvailableService']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Requests Available Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestsAvailableService = $this->RequestsAvailableServices->get($id);
        if ($this->RequestsAvailableServices->delete($requestsAvailableService)) {
            $this->Flash->success(__('The requests available service has been deleted.'));
        } else {
            $this->Flash->error(__('The requests available service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
