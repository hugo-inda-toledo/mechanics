<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * CarBrands Controller
 *
 * @property \App\Model\Table\CarBrandsTable $CarBrands
 */
class CarBrandsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $carBrands = $this->paginate($this->CarBrands);

        $this->set(compact('carBrands'));
        $this->set('_serialize', ['carBrands']);
    }

    /**
     * View method
     *
     * @param string|null $id Car Brand id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $carBrand = $this->CarBrands->get($id, [
            'contain' => ['Providers', 'Replacements', 'CarModels', 'Cars']
        ]);

        $this->set('carBrand', $carBrand);
        $this->set('_serialize', ['carBrand']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $carBrand = $this->CarBrands->newEntity();
        if ($this->request->is('post')) {
            $carBrand = $this->CarBrands->patchEntity($carBrand, $this->request->data);
            if ($this->CarBrands->save($carBrand)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car Brand'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car Brand'));
            }
        }
        $providers = $this->CarBrands->Providers->find('list', ['limit' => 200]);
        $replacements = $this->CarBrands->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('carBrand', 'providers', 'replacements'));
        $this->set('_serialize', ['carBrand']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Car Brand id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $carBrand = $this->CarBrands->get($id, [
            'contain' => ['Providers', 'Replacements']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carBrand = $this->CarBrands->patchEntity($carBrand, $this->request->data);
            if ($this->CarBrands->save($carBrand)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car Brand'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car Brand'));
            }
        }
        $providers = $this->CarBrands->Providers->find('list', ['limit' => 200]);
        $replacements = $this->CarBrands->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('carBrand', 'providers', 'replacements'));
        $this->set('_serialize', ['carBrand']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Car Brand id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $carBrand = $this->CarBrands->get($id);
        if ($this->CarBrands->delete($carBrand)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Car Brand'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Car Brand'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
