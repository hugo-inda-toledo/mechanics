<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Reports Controller
 *
 * @property \App\Model\Table\ReportsTable $Reports
 */
class ReportsController extends AppController
{

    function index()
    {
        
    }

    function productsSearch()
    {

    }

    function productsResult()
    {
    	if($this->request->is('post'))
    	{
    		$dates = explode(' - ', $this->request->data['range']);

            $start_date = $dates[0];
            $end_date = $dates[1];

            $products = array();

            if($this->request->data['type_search'] == 'Replacements')
            {
            	$this->loadModel('Replacements'); 
            	$replacements = $this->Replacements->find('all')
                    ->contain(['CarBrands' => ['Providers']])
                    ->where(function ($exp, $q) use($start_date,$end_date) {
                         return $exp->between('Replacements.created', $start_date, $end_date);
                     })
                    ->toArray();

	            if(count($replacements) > 0)
	            {
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

	                            $products[] = [
	                                'id' => $replacement->id,
	                                'repuesto' => $replacement->name,
	                                'marca' => $car_brand->brand_name,
	                                'proveedor' => $provider_name,
	                                'stock' => $car_brand->_joinData->stock
	                            ];
	                        }
	                    }
	                    else
	                    {
	                        $products[] = [
	                            'id' => $replacement->id,
	                            'repuesto' => $replacement->name,
	                            'marca' => 'N/A',
	                            'proveedor' => 'N/A',
	                            'stock' => 0
	                        ];
	                    }
	                }


	                $this->set('products', $products);
	                $this->set('type_search', $this->request->data['type_search']);
	                $this->set('range', $this->request->data['range']);
	            }
	            else
	            {
	                $this->Flash->error(__('No existen repuestos entre las fechas seleccionadas'));
	                $this->redirect(['controller' => 'Reports', 'action' => 'productsSearch']);
	            }
            }
            elseif($this->request->data['type_search'] == 'Supplies')
            {
            	$this->loadModel('Supplies'); 
            	$products = $this->Supplies->find('all')
            		->contain(['Providers'])
                    ->where(function ($exp, $q) use($start_date,$end_date) {
                         return $exp->between('Supplies.created', $start_date, $end_date);
                     })
                    ->toArray();

	            if(count($products) > 0)
	            {
	                $this->set('products', $products);
	                $this->set('type_search', $this->request->data['type_search']);
	                $this->set('range', $this->request->data['range']);
	            }
	            else
	            {
	                $this->Flash->error(__('No existen insumos entre las fechas seleccionadas'));
	                $this->redirect(['controller' => 'Supplies', 'action' => 'exportData']);
	            }
            }
            else
            {
            	$this->Flash->error(__('Debes seleccionar un tipo de producto a buscar'));
	            $this->redirect(['controller' => 'Reports', 'action' => 'productsSearch']);
            }
    	}
    }
}
