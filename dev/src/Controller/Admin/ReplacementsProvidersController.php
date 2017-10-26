<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ReplacementsProviders Controller
 *
 * @property \App\Model\Table\ReplacementsProvidersTable $ReplacementsProviders
 */
class ReplacementsProvidersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Providers', 'Replacements']
        ];
        $replacementsProviders = $this->paginate($this->ReplacementsProviders);

        $this->set(compact('replacementsProviders'));
        $this->set('_serialize', ['replacementsProviders']);
    }

    /**
     * View method
     *
     * @param string|null $id Replacements Provider id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $replacementsProvider = $this->ReplacementsProviders->get($id, [
            'contain' => ['Providers', 'Replacements']
        ]);

        $this->set('replacementsProvider', $replacementsProvider);
        $this->set('_serialize', ['replacementsProvider']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $replacementsProvider = $this->ReplacementsProviders->newEntity();
        if ($this->request->is('post')) {
            $replacementsProvider = $this->ReplacementsProviders->patchEntity($replacementsProvider, $this->request->data);
            if ($this->ReplacementsProviders->save($replacementsProvider)) {
                $this->Flash->success(__('The {0} has been saved.', 'Replacements Provider'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Replacements Provider'));
            }
        }
        $providers = $this->ReplacementsProviders->Providers->find('list', ['limit' => 200]);
        $replacements = $this->ReplacementsProviders->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('replacementsProvider', 'providers', 'replacements'));
        $this->set('_serialize', ['replacementsProvider']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Replacements Provider id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $replacementsProvider = $this->ReplacementsProviders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $replacementsProvider = $this->ReplacementsProviders->patchEntity($replacementsProvider, $this->request->data);
            if ($this->ReplacementsProviders->save($replacementsProvider)) {
                $this->Flash->success(__('The {0} has been saved.', 'Replacements Provider'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Replacements Provider'));
            }
        }
        $providers = $this->ReplacementsProviders->Providers->find('list', ['limit' => 200]);
        $replacements = $this->ReplacementsProviders->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('replacementsProvider', 'providers', 'replacements'));
        $this->set('_serialize', ['replacementsProvider']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Replacements Provider id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $replacementsProvider = $this->ReplacementsProviders->get($id);
        if ($this->ReplacementsProviders->delete($replacementsProvider)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Replacements Provider'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Replacements Provider'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
