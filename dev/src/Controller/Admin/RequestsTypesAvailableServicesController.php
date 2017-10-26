<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * RequestsTypesAvailableServices Controller
 *
 * @property \App\Model\Table\RequestsTypesAvailableServicesTable $RequestsTypesAvailableServices
 */
class RequestsTypesAvailableServicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RequestsTypes', 'AvailableServices']
        ];
        $requestsTypesAvailableServices = $this->paginate($this->RequestsTypesAvailableServices);

        $this->set(compact('requestsTypesAvailableServices'));
        $this->set('_serialize', ['requestsTypesAvailableServices']);
    }

    /**
     * View method
     *
     * @param string|null $id Requests Types Available Service id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestsTypesAvailableService = $this->RequestsTypesAvailableServices->get($id, [
            'contain' => ['RequestsTypes', 'AvailableServices']
        ]);

        $this->set('requestsTypesAvailableService', $requestsTypesAvailableService);
        $this->set('_serialize', ['requestsTypesAvailableService']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestsTypesAvailableService = $this->RequestsTypesAvailableServices->newEntity();
        if ($this->request->is('post')) {
            $requestsTypesAvailableService = $this->RequestsTypesAvailableServices->patchEntity($requestsTypesAvailableService, $this->request->data);
            if ($this->RequestsTypesAvailableServices->save($requestsTypesAvailableService)) {
                $this->Flash->success(__('The requests types available service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests types available service could not be saved. Please, try again.'));
        }
        $requestsTypes = $this->RequestsTypesAvailableServices->RequestsTypes->find('list', ['limit' => 200]);
        $availableServices = $this->RequestsTypesAvailableServices->AvailableServices->find('list', ['limit' => 200]);
        $this->set(compact('requestsTypesAvailableService', 'requestsTypes', 'availableServices'));
        $this->set('_serialize', ['requestsTypesAvailableService']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Requests Types Available Service id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestsTypesAvailableService = $this->RequestsTypesAvailableServices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestsTypesAvailableService = $this->RequestsTypesAvailableServices->patchEntity($requestsTypesAvailableService, $this->request->data);
            if ($this->RequestsTypesAvailableServices->save($requestsTypesAvailableService)) {
                $this->Flash->success(__('The requests types available service has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests types available service could not be saved. Please, try again.'));
        }
        $requestsTypes = $this->RequestsTypesAvailableServices->RequestsTypes->find('list', ['limit' => 200]);
        $availableServices = $this->RequestsTypesAvailableServices->AvailableServices->find('list', ['limit' => 200]);
        $this->set(compact('requestsTypesAvailableService', 'requestsTypes', 'availableServices'));
        $this->set('_serialize', ['requestsTypesAvailableService']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Requests Types Available Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestsTypesAvailableService = $this->RequestsTypesAvailableServices->get($id);
        if ($this->RequestsTypesAvailableServices->delete($requestsTypesAvailableService)) {
            $this->Flash->success(__('The requests types available service has been deleted.'));
        } else {
            $this->Flash->error(__('The requests types available service could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
