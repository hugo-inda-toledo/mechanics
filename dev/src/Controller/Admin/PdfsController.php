<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
//use App\Utility\TESTPDF;

/**
 * Pdfs Controller
 *
 * @property \App\Model\Table\PdfsTable $Pdfs
 */
class PdfsController extends AppController
{

	// Test para desarrollar plantilla.
	public function test(){

   		$this->viewBuilder()->layout('ajax');
        $this->set('title', 'Informe de Salud');
        $this->set('file_name', 'Informe_de_Salud' .'.pdf');
        $this->response->type('pdf');               
    
    }

    // Informa de Salud del Vehículo.
    public function salud(){

   		$this->viewBuilder()->layout('ajax');
        $this->set('title', 'Informe de Salud');
        $this->set('file_name', 'Informe_de_Salud' .'.pdf');
        $this->response->type('pdf');               
    }


    // Informe de PreCompra de Vehículo.
    public function precompra(){

   		$this->viewBuilder()->layout('ajax');
        $this->set('title', 'Informe Revisión PreCompra');
        $this->set('file_name', 'Informe_revisión_vehiculo' .'.pdf');
        $this->response->type('pdf');               
    }


    // Inform de Servicios
    public function servicios(){

   		$this->viewBuilder()->layout('ajax');
        $this->set('title', 'Informe Servicios');
        $this->set('file_name', 'Informe_Servicios' .'.pdf');
        $this->response->type('pdf');               
    }




}
