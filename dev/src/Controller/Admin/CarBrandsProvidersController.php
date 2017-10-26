<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\TableRegistry;
/**
 * CarBrandsProviders Controller
 *
 * @property \App\Model\Table\CarBrandsProvidersTable $CarBrandsProviders
 */
class CarBrandsProvidersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CarBrands', 'Providers', 'Replacements']
        ];
        $carBrandsProviders = $this->paginate($this->CarBrandsProviders);

        $this->set(compact('carBrandsProviders'));
        $this->set('_serialize', ['carBrandsProviders']);
    }

    /**
     * View method
     *
     * @param string|null $id Car Brands Provider id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $carBrandsProvider = $this->CarBrandsProviders->get($id, [
            'contain' => ['CarBrands', 'Providers', 'Replacements']
        ]);

        $this->set('carBrandsProvider', $carBrandsProvider);
        $this->set('_serialize', ['carBrandsProvider']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $carBrandsProvider = $this->CarBrandsProviders->newEntity();
        if ($this->request->is('post')) {
            $carBrandsProvider = $this->CarBrandsProviders->patchEntity($carBrandsProvider, $this->request->data);
            if ($this->CarBrandsProviders->save($carBrandsProvider)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car Brands Provider'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car Brands Provider'));
            }
        }
        $carBrands = $this->CarBrandsProviders->CarBrands->find('list', ['limit' => 200]);
        $providers = $this->CarBrandsProviders->Providers->find('list', ['limit' => 200]);
        $replacements = $this->CarBrandsProviders->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('carBrandsProvider', 'carBrands', 'providers', 'replacements'));
        $this->set('_serialize', ['carBrandsProvider']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Car Brands Provider id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $carBrandsProvider = $this->CarBrandsProviders->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carBrandsProvider = $this->CarBrandsProviders->patchEntity($carBrandsProvider, $this->request->data);
            if ($this->CarBrandsProviders->save($carBrandsProvider)) {
                $this->Flash->success(__('The {0} has been saved.', 'Car Brands Provider'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Car Brands Provider'));
            }
        }
        $carBrands = $this->CarBrandsProviders->CarBrands->find('list', ['limit' => 200]);
        $providers = $this->CarBrandsProviders->Providers->find('list', ['limit' => 200]);
        $replacements = $this->CarBrandsProviders->Replacements->find('list', ['limit' => 200]);
        $this->set(compact('carBrandsProvider', 'carBrands', 'providers', 'replacements'));
        $this->set('_serialize', ['carBrandsProvider']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Car Brands Provider id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $carBrandsProvider = $this->CarBrandsProviders->get($id);
        if ($this->CarBrandsProviders->delete($carBrandsProvider)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Car Brands Provider'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Car Brands Provider'));
        }
        return $this->redirect(['action' => 'index']);
    }

    function refactoryRelations()
    {
        $this->loadModel('CarBrandsProviders');
        $this->loadModel('Replacements');
        $this->loadModel('Providers');

        $this->autoRender = false;

        $car_brands_providers = $this->CarBrandsProviders->find('all')->order(['car_brand_id' => 'ASC'])->toArray();
        $replacements = $this->Replacements->find('all')->toArray();
        $providers = $this->Providers->find('all')->toArray();

        $rows = [];

        foreach($car_brands_providers as $car_brands_provider)
        {
            foreach($replacements as $replacement)
            {
                if($car_brands_provider->default_provider == 1)
                {
                    $rows[] = ['car_brand_id' => $car_brands_provider->car_brand_id, 'provider_id' => $car_brands_provider->provider_id, 'replacement_id' => $replacement->id, 'stock' => 15, 'default_provider' => 1];
                }
                else
                {
                    $rows[] = ['car_brand_id' => $car_brands_provider->car_brand_id, 'provider_id' => $car_brands_provider->provider_id, 'replacement_id' => $replacement->id, 'stock' => 0, 'default_provider' => 0];
                }
                
            }
        }

        echo '<pre>';
        print_r($rows);
        echo '</pre>';


        $table_carbrand_provider = TableRegistry::get('CarBrandsProviders');
        $entities = $table_carbrand_provider->newEntities($rows);
        $table_carbrand_provider->saveMany($entities);

        echo 'ok';
    }
}
