<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\ORM\TableRegistry;

/**
 * Calculator component
 */
class CalculatorComponent extends Component
{

	// referencia: https://book.cakephp.org/3.0/en/controllers/components.html

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];


    /**
     * Retorna datos referente a un servicio.
     * @param  [integer] 		   $service_id: id del servicio
     * @return [array]             Retorna array con datos del servicio: precio, tiempo estandar y tiempo real.
     * @author Nicolas Vera <nicolas.vera@ideauno.cl>
     */
    public function getServiceById($service_id){
    	// Get service
		$AvailableServices = TableRegistry::get('AvailableServices');
		$service = $AvailableServices->find()->where(['id'=>$service_id])->first();
		if($service != null){
			return $service;
		}
		return [];
    }


    public function getServicesByIds($services_ids){
    	$AvailableServices = TableRegistry::get('AvailableServices');		
    	$services = $AvailableServices->find('all')->where(['AvailableServices.id IN'=> $services_ids])->toArray();    	
    	return $services;
    }


    public function atLeastNotInspectionService($services){
    	foreach ($services as $key => $service) {
    		if(!$service->inspection){
    			return true;
    		}
    	}
    	return false;
    }

    public function calculate($services_ids){

    	$time_client = 0;
    	$time_mecanic = 0;
    	$time_arrived = 1; // de dónde sale esto?, por ahora fijo en 1H.

    	// Get services
    	$_services = $this->getServicesByIds($services_ids);

    	// 1 services?
    	if(count($_services) == 1){

    		$_service = $_services[0];

    		// Inspection?
    		if($_service->inspection){
    			$time_client  += $_service->estimated_time;
    			$time_mecanic += $_service->estimated_time + $time_arrived; // Tiempo estimado + traslado
    		}
    		// No Inspection
    		else{
    			$time_client  += $_service->estimated_time;	
    			$time_mecanic += $_service->real_estimated_time + $time_arrived;   // Tiemp real  + traslado
    		}
    	}    	
    	// many services
    	else{

    		// at least 1 inspection services ?
    		if($this->atLeastNotInspectionService($_services)){
    			foreach ($_services as $key => $service) {
    				$time_client  += $service->real_estimated_time;	    				
    				$time_mecanic += $service->real_estimated_time + $time_arrived;   // Tiemp real  + traslado				
    			}	
    		}
    		// at least 1 not inspection service?
    		else{
    			foreach ($_services as $key => $service) {
    				$time_client  += $service->real_estimated_time;	    				
    				$time_mecanic += $service->real_estimated_time + $time_arrived;   // Tiemp real  + traslado				
    			}
    		}
    	}    	    	
    
		return ['time_client' => $time_client, 'time_mecanic' => $time_mecanic];

    }



    // Bloqueo


    


}
