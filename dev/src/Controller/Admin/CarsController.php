<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Cars Controller
 *
 * @property \App\Model\Table\CarsTable $Cars
 */
class CarsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'CarBrands', 'CarModels']
        ];
        $cars = $this->paginate($this->Cars);

        $this->set(compact('cars'));
        $this->set('_serialize', ['cars']);
    }

    /**
     * View method
     *
     * @param string|null $id Car id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => ['Users', 'CarBrands', 'CarModels', 'HealthReports', 'MaintenceRecords', 'Requests']
        ]);

        $this->set('car', $car);
        $this->set('_serialize', ['car']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $car = $this->Cars->newEntity();
        if ($this->request->is('post')) {
            $car = $this->Cars->patchEntity($car, $this->request->data);
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car'));
            }
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $carBrands = $this->Cars->CarBrands->find('list', ['limit' => 200]);
        $carModels = $this->Cars->CarModels->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users', 'carBrands', 'carModels'));
        $this->set('_serialize', ['car']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Car id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $car = $this->Cars->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $car = $this->Cars->patchEntity($car, $this->request->data);
            if ($this->Cars->save($car)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car'));
            }
        }
        $users = $this->Cars->Users->find('list', ['limit' => 200]);
        $carBrands = $this->Cars->CarBrands->find('list', ['limit' => 200]);
        $carModels = $this->Cars->CarModels->find('list', ['limit' => 200]);
        $this->set(compact('car', 'users', 'carBrands', 'carModels'));
        $this->set('_serialize', ['car']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Car id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $car = $this->Cars->get($id);
        if ($this->Cars->delete($car)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Car'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Car'));
        }
        return $this->redirect(['action' => 'index']);
    }

    public function getCarsByClientId($user_id = null)
    {
        $carslist = array();

        if($user_id != null)
        {
            if($this->request->is('ajax'))
            {
                $this->viewBuilder()->layout('ajax');

                $cars = $this->Cars->find('all')
                    ->contain(['CarBrands', 'CarModels'])
                    ->where(['Cars.user_id' => $user_id])
                    ->toArray();

                foreach($cars as $car)
                {
                    $carslist[$car->id] = '['.$car->year.'] '.$car->car_brand->brand_name.' '.$car->car_model->model_name;
                }
            }
        }

        $this->set('cars', $carslist);
    }
}
