<?php
namespace App\Utility;
use App\Utility\PaymentVoucherPdf;

class MainPaymentVoucherPdf{

  public function show($data, $title, $file_name, $cliente){
		$pdf= $this->createPdf($data,$title, $file_name, $cliente);

		//Close and output PDF document
		$pdf->Output($file_name . '', 'I');
	}

	public function download($data, $title, $file_name, $cliente, $route = ''){
		$pdf= $this->createPdf($data,$title, $file_name, $cliente);
		$routeToSave=  WWW_ROOT .'files' . DS . 'temp'. DS .$file_name;

		//Close and output PDF document
		$pdf->Output($routeToSave, 'F');
	}

	/*
	* i.e. : $data = [
		'requests'=>[
				'available_services'=>[
					'total_price' => 0,
					'name' => ''

				],
				'mechanic' => ['full_name' => ''],
				'created' => ''
		],
		'car_brand_name' => '',
		'car_model_name' => '',
		'patent'  => '',
		'year' => ''
	];

	 $cliente => [ 'full_name' => ''];

	 $title => '';
	 $file_name=> '';
	*/

	private function createPdf($data,$title, $file_name, $cliente){
		$pdf = new PaymentVoucherPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->SetAutoPageBreak(false, 0);
		$pdf->SetMargins(0, 0, 0, true);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Fullmec');
		$title='Comprobante de Pago';
		$pdf->SetTitle($title);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(1);

		// ---------------------------------------------------------

		// set title
		$pdf->title_header = $title;

		// set font
		//$pdf->SetFont('Helvetica', '', 11);

		// add a page
		$pdf->AddPage();
		//$pdf->setX(PDF_MARGIN_LEFT);

		$nombre_cliente = $cliente->full_name;
		$nombre_mecanico = $data->request->mechanic['full_name'];
		$marca = $data->car_brand_name;
		$modelo = $data->car_model_name;
		$patente = $data->patent;
		$ano = $data->year;
		$align = 'L';

		$fecha = new \DateTime($data->request->created);
		$fecha = $fecha->format('d/m/Y');

		// Info básica.
		$pdf->Info($fecha,$nombre_cliente,$nombre_mecanico,$marca,$modelo,$patente,$ano);


		// Detalle.
		$pdf->SubTitle('Detalle Servicios Abonados');


		$dataServices= [];
		$sum=0;
		foreach($data->request->available_services as $item){
				array_push($dataServices, ['name'=> $item->name,'value' => $item->total_price]);
				$sum= $sum + $item->total_price;
		}

		array_push($dataServices, ['name'=> 'Total', 'value' => $sum ]);

		$pdf->ItemValueList($dataServices,'40%','60%');

		// ---------------------------------------------------------

		return $pdf;
	}

}
