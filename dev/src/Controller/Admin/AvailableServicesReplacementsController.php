<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * AvailableServicesReplacements Controller
 *
 * @property \App\Model\Table\AvailableServicesReplacementsTable $AvailableServicesReplacements
 */
class AvailableServicesReplacementsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['AvailableServices', 'Replacements']
        ];
        $availableServicesReplacements = $this->paginate($this->AvailableServicesReplacements);

        $this->set(compact('availableServicesReplacements'));
        $this->set('_serialize', ['availableServicesReplacements']);
    }

    /**
     * View method
     *
     * @param string|null $id Available Services Replacement id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $availableServicesReplacement = $this->AvailableServicesReplacements->get($id, [
            'contain' => ['AvailableServices', 'Replacements']
        ]);

        $this->set('availableServicesReplacement', $availableServicesReplacement);
        $this->set('_serialize', ['availableServicesReplacement']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $availableServicesReplacement = $this->AvailableServicesReplacements->newEntity();
        if ($this->request->is('post')) {
            $availableServicesReplacement = $this->AvailableServicesReplacements->patchEntity($availableServicesReplacement, $this->request->data);
            if ($this->AvailableServicesReplacements->save($availableServicesReplacement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Available Services Replacement'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Available Services Replacement'));
            }
        }
        $availableServices = $this->AvailableServicesReplacements->AvailableServices->find('list', ['limit' => 200]);
        $replacements = $this->AvailableServicesReplacements->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('availableServicesReplacement', 'availableServices', 'replacements'));
        $this->set('_serialize', ['availableServicesReplacement']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Available Services Replacement id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $availableServicesReplacement = $this->AvailableServicesReplacements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $availableServicesReplacement = $this->AvailableServicesReplacements->patchEntity($availableServicesReplacement, $this->request->data);
            if ($this->AvailableServicesReplacements->save($availableServicesReplacement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Available Services Replacement'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Available Services Replacement'));
            }
        }
        $availableServices = $this->AvailableServicesReplacements->AvailableServices->find('list', ['limit' => 200]);
        $replacements = $this->AvailableServicesReplacements->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('availableServicesReplacement', 'availableServices', 'replacements'));
        $this->set('_serialize', ['availableServicesReplacement']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Available Services Replacement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $availableServicesReplacement = $this->AvailableServicesReplacements->get($id);
        if ($this->AvailableServicesReplacements->delete($availableServicesReplacement)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Available Services Replacement'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Available Services Replacement'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
