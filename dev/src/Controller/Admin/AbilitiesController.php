<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Abilities Controller
 *
 * @property \App\Model\Table\AbilitiesTable $Abilities
 */
class AbilitiesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $abilities = $this->paginate($this->Abilities);

        $this->set(compact('abilities'));
        $this->set('_serialize', ['abilities']);
    }

    /**
     * View method
     *
     * @param string|null $id Ability id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ability = $this->Abilities->get($id, [
            'contain' => ['Users']
        ]);

        $this->set('ability', $ability);
        $this->set('_serialize', ['ability']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ability = $this->Abilities->newEntity();
        if ($this->request->is('post')) {
            $ability = $this->Abilities->patchEntity($ability, $this->request->data);
            if ($this->Abilities->save($ability)) {
                $this->Flash->success(__('The ability has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ability could not be saved. Please, try again.'));
        }
        $users = $this->Abilities->Users->find('list', ['limit' => 200]);
        $this->set(compact('ability', 'users'));
        $this->set('_serialize', ['ability']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Ability id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ability = $this->Abilities->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ability = $this->Abilities->patchEntity($ability, $this->request->data);
            if ($this->Abilities->save($ability)) {
                $this->Flash->success(__('The ability has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ability could not be saved. Please, try again.'));
        }
        $users = $this->Abilities->Users->find('list', ['limit' => 200]);
        $this->set(compact('ability', 'users'));
        $this->set('_serialize', ['ability']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ability id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ability = $this->Abilities->get($id);
        if ($this->Abilities->delete($ability)) {
            $this->Flash->success(__('The ability has been deleted.'));
        } else {
            $this->Flash->error(__('The ability could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
