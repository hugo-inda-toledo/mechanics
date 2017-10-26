<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Supplies Controller
 *
 * @property \App\Model\Table\SuppliesTable $Supplies
 */
class SuppliesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $supplies = $this->paginate($this->Supplies);

        $this->set(compact('supplies'));
        $this->set('_serialize', ['supplies']);
    }

    /**
     * View method
     *
     * @param string|null $id Supply id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supply = $this->Supplies->get($id, [
            'contain' => ['AvailableServices', 'Providers']
        ]);

        $this->set('supply', $supply);
        $this->set('_serialize', ['supply']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $supply = $this->Supplies->newEntity();
        if ($this->request->is('post')) {
            $supply = $this->Supplies->patchEntity($supply, $this->request->data);
            if ($this->Supplies->save($supply)) {
                $this->Flash->success(__('The {0} has been saved.', 'Supply'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Supply'));
            }
        }
        $availableServices = $this->Supplies->AvailableServices->find('list', ['limit' => 200]);
        $providers = $this->Supplies->Providers->find('list', ['limit' => 200]);
        $this->set(compact('supply', 'availableServices', 'providers'));
        $this->set('_serialize', ['supply']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Supply id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $supply = $this->Supplies->get($id, [
            'contain' => ['AvailableServices', 'Providers']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $supply = $this->Supplies->patchEntity($supply, $this->request->data);
            if ($this->Supplies->save($supply)) {
                $this->Flash->success(__('The {0} has been saved.', 'Supply'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Supply'));
            }
        }
        $availableServices = $this->Supplies->AvailableServices->find('list', ['limit' => 200]);
        $providers = $this->Supplies->Providers->find('list', ['limit' => 200]);
        $this->set(compact('supply', 'availableServices', 'providers'));
        $this->set('_serialize', ['supply']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Supply id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supply = $this->Supplies->get($id);
        if ($this->Supplies->delete($supply)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Supply'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Supply'));
        }
        return $this->redirect(['action' => 'index']);
    }

    function exportData()
    {

    }

    /**
    * HU2.21 Exportar  archivo de costos en formato excel
    */
    public function exportFile()
    {
        if($this->request->is('post'))
        {
            $dates = explode(' - ', $this->request->data['range']);

            $start_date = $dates[0];
            $end_date = $dates[1];

            $supplies = $this->Supplies->find('all')
                    ->where(function ($exp, $q) use($start_date,$end_date) {
                         return $exp->between('Supplies.created', $start_date, $end_date);
                     })
                    ->toArray();

            if(count($supplies) > 0)
            {
                $this->set('supplies', $supplies);
            }
            else
            {
                $this->Flash->error(__('No existen insumos entre las fechas seleccionadas'));
                $this->redirect(['controller' => 'Supplies', 'action' => 'exportData']);
            }
        }
    }
}
