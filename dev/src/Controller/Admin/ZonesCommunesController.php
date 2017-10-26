<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * ZonesCommunes Controller
 *
 * @property \App\Model\Table\ZonesCommunesTable $ZonesCommunes
 */
class ZonesCommunesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Zones', 'Communes']
        ];
        $zonesCommunes = $this->paginate($this->ZonesCommunes);

        $this->set(compact('zonesCommunes'));
        $this->set('_serialize', ['zonesCommunes']);
    }

    /**
     * View method
     *
     * @param string|null $id Zones Commune id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $zonesCommune = $this->ZonesCommunes->get($id, [
            'contain' => ['Zones', 'Communes']
        ]);

        $this->set('zonesCommune', $zonesCommune);
        $this->set('_serialize', ['zonesCommune']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $zonesCommune = $this->ZonesCommunes->newEntity();
        if ($this->request->is('post')) {
            $zonesCommune = $this->ZonesCommunes->patchEntity($zonesCommune, $this->request->data);
            if ($this->ZonesCommunes->save($zonesCommune)) {
                $this->Flash->success(__('The zones commune has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zones commune could not be saved. Please, try again.'));
        }
        $zones = $this->ZonesCommunes->Zones->find('list', ['limit' => 200]);
        $communes = $this->ZonesCommunes->Communes->find('list', ['limit' => 200]);
        $this->set(compact('zonesCommune', 'zones', 'communes'));
        $this->set('_serialize', ['zonesCommune']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Zones Commune id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $zonesCommune = $this->ZonesCommunes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $zonesCommune = $this->ZonesCommunes->patchEntity($zonesCommune, $this->request->data);
            if ($this->ZonesCommunes->save($zonesCommune)) {
                $this->Flash->success(__('The zones commune has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The zones commune could not be saved. Please, try again.'));
        }
        $zones = $this->ZonesCommunes->Zones->find('list', ['limit' => 200]);
        $communes = $this->ZonesCommunes->Communes->find('list', ['limit' => 200]);
        $this->set(compact('zonesCommune', 'zones', 'communes'));
        $this->set('_serialize', ['zonesCommune']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Zones Commune id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $zonesCommune = $this->ZonesCommunes->get($id);
        if ($this->ZonesCommunes->delete($zonesCommune)) {
            $this->Flash->success(__('The zones commune has been deleted.'));
        } else {
            $this->Flash->error(__('The zones commune could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
