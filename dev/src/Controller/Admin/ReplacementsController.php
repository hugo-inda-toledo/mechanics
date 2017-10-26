<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Replacements Controller
 *
 * @property \App\Model\Table\ReplacementsTable $Replacements
 */
class ReplacementsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $replacements = $this->paginate($this->Replacements);

        $this->set(compact('replacements'));
        $this->set('_serialize', ['replacements']);
    }

    /**
     * View method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $replacement = $this->Replacements->get($id, [
            'contain' => ['AvailableServices', 'PurchaseOrders', 'Providers', 'CarBrands']
        ]);

        $this->set('replacement', $replacement);
        $this->set('_serialize', ['replacement']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $replacement = $this->Replacements->newEntity();
        if ($this->request->is('post')) {
            $replacement = $this->Replacements->patchEntity($replacement, $this->request->data);
            if ($this->Replacements->save($replacement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Replacement'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Replacement'));
            }
        }
        $availableServices = $this->Replacements->AvailableServices->find('list', ['limit' => 200]);
        $purchaseOrders = $this->Replacements->PurchaseOrders->find('list', ['limit' => 200]);
        $providers = $this->Replacements->Providers->find('list', ['limit' => 200]);
        $carBrands = $this->Replacements->CarBrands->find('list', ['limit' => 200]);
        $this->set(compact('replacement', 'availableServices', 'purchaseOrders', 'providers', 'carBrands'));
        $this->set('_serialize', ['replacement']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $replacement = $this->Replacements->get($id, [
            'contain' => ['AvailableServices', 'PurchaseOrders', 'Providers', 'CarBrands']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $replacement = $this->Replacements->patchEntity($replacement, $this->request->data);
            if ($this->Replacements->save($replacement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Replacement'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Replacement'));
            }
        }
        $availableServices = $this->Replacements->AvailableServices->find('list', ['limit' => 200]);
        $purchaseOrders = $this->Replacements->PurchaseOrders->find('list', ['limit' => 200]);
        $providers = $this->Replacements->Providers->find('list', ['limit' => 200]);
        $carBrands = $this->Replacements->CarBrands->find('list', ['limit' => 200]);
        $this->set(compact('replacement', 'availableServices', 'purchaseOrders', 'providers', 'carBrands'));
        $this->set('_serialize', ['replacement']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Replacement id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $replacement = $this->Replacements->get($id);
        if ($this->Replacements->delete($replacement)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Replacement'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Replacement'));
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

            $replacements = $this->Replacements->find('all')
                    ->contain(['CarBrands' => ['Providers']])
                    ->where(function ($exp, $q) use($start_date,$end_date) {
                         return $exp->between('Replacements.created', $start_date, $end_date);
                     })
                    ->toArray();

            if(count($replacements) > 0)
            {
                
                $replacements_up_to_date = array();

                foreach($replacements as $replacement)
                {
                    $stock = 0;
                    $brand_name = '';

                    if(count($replacement->car_brands) > 0)
                    {
                        foreach($replacement->car_brands as $car_brand)
                        {
                            $provider_name = '';

                            if(count($car_brand->providers) > 0)
                            {
                                foreach($car_brand->providers as $provider)
                                {
                                    if($provider->id == $car_brand->_joinData->provider_id)
                                    {
                                        $provider_name  = $provider->name;
                                        break;
                                    }
                                }
                            }

                            $replacements_up_to_date[] = [
                                'ID' => $replacement->id,
                                'Repuesto' => $replacement->name,
                                'Marca' => $car_brand->brand_name,
                                'Proveedor' => $provider_name,
                                'Stock' => $car_brand->_joinData->stock
                            ];
                        }
                    }
                    else
                    {
                        $replacements_up_to_date[] = [
                            'ID' => $replacement->id,
                            'Repuesto' => $replacement->name,
                            'Marca' => 'N/A',
                            'Proveedor' => 'N/A',
                            'Stock' => 0
                        ];
                    }
                }

                /*echo '<pre>';
                print_r($replacements_up_to_date);
                echo '</pre>';*/


                $this->set('replacements', $replacements_up_to_date);
            }
            else
            {
                $this->Flash->error(__('No existen repuestos entre las fechas seleccionadas'));
                $this->redirect(['controller' => 'Replacements', 'action' => 'exportData']);
            }
        }
    }
}
