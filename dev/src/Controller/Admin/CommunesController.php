<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Communes Controller
 *
 * @property \App\Model\Table\CommunesTable $Communes
 */
class CommunesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Cities']
        ];
        $communes = $this->paginate($this->Communes);

        $this->set(compact('communes'));
        $this->set('_serialize', ['communes']);
    }

    /**
     * View method
     *
     * @param string|null $id Commune id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commune = $this->Communes->get($id, [
            'contain' => ['Cities', 'Users', 'Requests']
        ]);

        $this->set('commune', $commune);
        $this->set('_serialize', ['commune']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $commune = $this->Communes->newEntity();
        if ($this->request->is('post')) {
            $commune = $this->Communes->patchEntity($commune, $this->request->data);
            if ($this->Communes->save($commune)) {
                $this->Flash->success(__('The commune has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commune could not be saved. Please, try again.'));
        }
        $cities = $this->Communes->Cities->find('list', ['limit' => 200]);
        $users = $this->Communes->Users->find('list', ['limit' => 200]);
        $this->set(compact('commune', 'cities', 'users'));
        $this->set('_serialize', ['commune']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Commune id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $commune = $this->Communes->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commune = $this->Communes->patchEntity($commune, $this->request->data);
            if ($this->Communes->save($commune)) {
                $this->Flash->success(__('The commune has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The commune could not be saved. Please, try again.'));
        }
        $cities = $this->Communes->Cities->find('list', ['limit' => 200]);
        $users = $this->Communes->Users->find('list', ['limit' => 200]);
        $this->set(compact('commune', 'cities', 'users'));
        $this->set('_serialize', ['commune']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Commune id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $commune = $this->Communes->get($id);
        if ($this->Communes->delete($commune)) {
            $this->Flash->success(__('The commune has been deleted.'));
        } else {
            $this->Flash->error(__('The commune could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    function getCommunesByCityId($city_id = null, $index_array= null, $commune_id = null, $disabled = 0)
    {
        if($city_id != null && $index_array != null)
        {
            if($this->request->is('ajax')) 
            {     
                $this->viewBuilder()->layout('ajax');
                $this->set('communes', $this->Communes->find('list', ['limit' => 200, 'conditions' => ['Communes.city_id' => $city_id]]));
                $this->set('index_array', $index_array);
                $this->set('commune_id', $commune_id);
                $this->set('disabled', $disabled);
            }
        }
    }
}
