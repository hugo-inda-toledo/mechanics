<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * RequestsTypes Controller
 *
 * @property \App\Model\Table\RequestsTypesTable $RequestsTypes
 */
class RequestsTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $requestsTypes = $this->paginate($this->RequestsTypes);

        $this->set(compact('requestsTypes'));
        $this->set('_serialize', ['requestsTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Requests Type id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $requestsType = $this->RequestsTypes->get($id, [
            'contain' => ['AvailableServices', 'Requests']
        ]);

        $this->set('requestsType', $requestsType);
        $this->set('_serialize', ['requestsType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $requestsType = $this->RequestsTypes->newEntity();
        if ($this->request->is('post')) {
            $requestsType = $this->RequestsTypes->patchEntity($requestsType, $this->request->data);
            if ($this->RequestsTypes->save($requestsType)) {
                $this->Flash->success(__('The requests type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests type could not be saved. Please, try again.'));
        }
        $availableServices = $this->RequestsTypes->AvailableServices->find('list', ['limit' => 200]);
        $this->set(compact('requestsType', 'availableServices'));
        $this->set('_serialize', ['requestsType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Requests Type id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $requestsType = $this->RequestsTypes->get($id, [
            'contain' => ['AvailableServices']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $requestsType = $this->RequestsTypes->patchEntity($requestsType, $this->request->data);
            if ($this->RequestsTypes->save($requestsType)) {
                $this->Flash->success(__('The requests type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The requests type could not be saved. Please, try again.'));
        }
        $availableServices = $this->RequestsTypes->AvailableServices->find('list', ['limit' => 200]);
        $this->set(compact('requestsType', 'availableServices'));
        $this->set('_serialize', ['requestsType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Requests Type id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $requestsType = $this->RequestsTypes->get($id);
        if ($this->RequestsTypes->delete($requestsType)) {
            $this->Flash->success(__('The requests type has been deleted.'));
        } else {
            $this->Flash->error(__('The requests type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
