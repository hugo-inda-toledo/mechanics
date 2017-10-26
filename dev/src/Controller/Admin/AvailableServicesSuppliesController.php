<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * AvailableServicesSupplies Controller
 *
 * @property \App\Model\Table\AvailableServicesSuppliesTable $AvailableServicesSupplies
 */
class AvailableServicesSuppliesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AvailableServices', 'Supplies']
        ];
        $availableServicesSupplies = $this->paginate($this->AvailableServicesSupplies);

        $this->set(compact('availableServicesSupplies'));
        $this->set('_serialize', ['availableServicesSupplies']);
    }

    /**
     * View method
     *
     * @param string|null $id Available Services Supply id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $availableServicesSupply = $this->AvailableServicesSupplies->get($id, [
            'contain' => ['AvailableServices', 'Supplies']
        ]);

        $this->set('availableServicesSupply', $availableServicesSupply);
        $this->set('_serialize', ['availableServicesSupply']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $availableServicesSupply = $this->AvailableServicesSupplies->newEntity();
        if ($this->request->is('post')) {
            $availableServicesSupply = $this->AvailableServicesSupplies->patchEntity($availableServicesSupply, $this->request->data);
            if ($this->AvailableServicesSupplies->save($availableServicesSupply)) {
                $this->Flash->success(__('The {0} has been saved.', 'Available Services Supply'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Available Services Supply'));
            }
        }
        $availableServices = $this->AvailableServicesSupplies->AvailableServices->find('list', ['limit' => 200]);
        $supplies = $this->AvailableServicesSupplies->Supplies->find('list', ['limit' => 200]);
        $this->set(compact('availableServicesSupply', 'availableServices', 'supplies'));
        $this->set('_serialize', ['availableServicesSupply']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Available Services Supply id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $availableServicesSupply = $this->AvailableServicesSupplies->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $availableServicesSupply = $this->AvailableServicesSupplies->patchEntity($availableServicesSupply, $this->request->data);
            if ($this->AvailableServicesSupplies->save($availableServicesSupply)) {
                $this->Flash->success(__('The {0} has been saved.', 'Available Services Supply'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Available Services Supply'));
            }
        }
        $availableServices = $this->AvailableServicesSupplies->AvailableServices->find('list', ['limit' => 200]);
        $supplies = $this->AvailableServicesSupplies->Supplies->find('list', ['limit' => 200]);
        $this->set(compact('availableServicesSupply', 'availableServices', 'supplies'));
        $this->set('_serialize', ['availableServicesSupply']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Available Services Supply id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $availableServicesSupply = $this->AvailableServicesSupplies->get($id);
        if ($this->AvailableServicesSupplies->delete($availableServicesSupply)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Available Services Supply'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Available Services Supply'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
