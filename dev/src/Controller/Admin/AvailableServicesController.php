<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * AvailableServices Controller
 *
 * @property \App\Model\Table\AvailableServicesTable $AvailableServices
 */
class AvailableServicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['RequestsTypes'],
            'order' => ['AvailableServices.id' => 'DESC']

        ];
        $availableServices = $this->paginate($this->AvailableServices);

        $this->set(compact('availableServices'));
        $this->set('_serialize', ['availableServices']);
    }

    /**
     * View method
     *
     * @param string|null $id Available Service id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $availableService = $this->AvailableServices->get($id, [
            'contain' => ['RequestsTypes', 'Abilities', 'Replacements', 'Supplies', 'Requests']
        ]);

        $this->set('availableService', $availableService);
        $this->set('_serialize', ['availableService']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $availableService = $this->AvailableServices->newEntity();
        if ($this->request->is('post')) {

            if($this->request->data['replacements']['_ids'] != null)
            {
                $this->loadModel('Replacements');
                $replacements_total = 0;
                foreach($this->request->data['replacements']['_ids'] as $key => $value)
                {
                    $replacement_data = $this->Replacements->get($value);
                    $replacements_total += $replacement_data->price_for_request;
                }

                $this->request->data['replacements_price'] = $replacements_total;
            }

            if($this->request->data['supplies']['_ids'] != null)
            {
                $this->loadModel('Supplies');
                $supplies_total = 0;
                foreach($this->request->data['supplies']['_ids'] as $key => $value)
                {
                    $supply_data = $this->Supplies->get($value);
                    $supplies_total += $supply_data->price_for_request;
                }

                $this->request->data['supplies_price'] = $supplies_total;
            }

            $availableService = $this->AvailableServices->patchEntity($availableService, $this->request->data);
            if ($this->AvailableServices->save($availableService)) {
                $this->Flash->success(__('The {0} has been saved.', 'Available Service'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Available Service'));
            }
        }
        $requestsTypes = $this->AvailableServices->RequestsTypes->find('list', ['limit' => 200]);
        $abilities = $this->AvailableServices->Abilities->find('list', ['limit' => 200]);
        $replacements = $this->AvailableServices->Replacements->find('list', ['limit' => 200, 'order' => ['Replacements.name' => 'ASC']]);
        $supplies = $this->AvailableServices->Supplies->find('list', ['limit' => 200, 'order' => ['Supplies.name' => 'ASC']]);
        $requests = $this->AvailableServices->Requests->find('list', ['limit' => 200]);
        $this->set(compact('availableService', 'requestsTypes', 'abilities', 'replacements', 'supplies', 'requests'));
        $this->set('_serialize', ['availableService']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Available Service id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $availableService = $this->AvailableServices->get($id, [
            'contain' => ['Abilities', 'Replacements', 'Supplies', 'Requests']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $availableService = $this->AvailableServices->patchEntity($availableService, $this->request->data);
            if ($this->AvailableServices->save($availableService)) {
                $this->Flash->success(__('The {0} has been saved.', 'Available Service'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Available Service'));
            }
        }
        $requestsTypes = $this->AvailableServices->RequestsTypes->find('list', ['limit' => 200]);
        $abilities = $this->AvailableServices->Abilities->find('list', ['limit' => 200]);
        $replacements = $this->AvailableServices->Replacements->find('list', ['limit' => 200]);
        $supplies = $this->AvailableServices->Supplies->find('list', ['limit' => 200]);
        $requests = $this->AvailableServices->Requests->find('list', ['limit' => 200]);
        $this->set(compact('availableService', 'requestsTypes', 'abilities', 'replacements', 'supplies', 'requests'));
        $this->set('_serialize', ['availableService']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Available Service id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $availableService = $this->AvailableServices->get($id);
        if ($this->AvailableServices->delete($availableService)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Available Service'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Available Service'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
