<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * CarModels Controller
 *
 * @property \App\Model\Table\CarModelsTable $CarModels
 */
class CarModelsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CarBrands']
        ];
        $carModels = $this->paginate($this->CarModels);

        $this->set(compact('carModels'));
        $this->set('_serialize', ['carModels']);
    }

    /**
     * View method
     *
     * @param string|null $id Car Model id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $carModel = $this->CarModels->get($id, [
            'contain' => ['CarBrands', 'Cars']
        ]);

        $this->set('carModel', $carModel);
        $this->set('_serialize', ['carModel']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $carModel = $this->CarModels->newEntity();
        if ($this->request->is('post')) {
            $carModel = $this->CarModels->patchEntity($carModel, $this->request->data);
            if ($this->CarModels->save($carModel)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car Model'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car Model'));
            }
        }
        $carBrands = $this->CarModels->CarBrands->find('list', ['limit' => 200]);
        $this->set(compact('carModel', 'carBrands'));
        $this->set('_serialize', ['carModel']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Car Model id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $carModel = $this->CarModels->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carModel = $this->CarModels->patchEntity($carModel, $this->request->data);
            if ($this->CarModels->save($carModel)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car Model'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car Model'));
            }
        }
        $carBrands = $this->CarModels->CarBrands->find('list', ['limit' => 200]);
        $this->set(compact('carModel', 'carBrands'));
        $this->set('_serialize', ['carModel']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Car Model id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $carModel = $this->CarModels->get($id);
        if ($this->CarModels->delete($carModel)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Car Model'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Car Model'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
