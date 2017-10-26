<?php

require_once(APP. 'Utility' . DS . 'HealthCartPdf.php');
$pdf = new HealthCartPdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(0, 0, 0, true);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Fullmec');
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


// Tipo de fuente generadas para PDF.
// opensans
// opensansb
// opensansi
//EJ: $pdf->SetFont('opensans', '', 11, '', false);


$data = $data[0];
$nombre_cliente = $cliente->full_name;
$nombre_mecanico = $data->requests[0]->mechanic['full_name'];
$marca = $data->brand;
$modelo = $data->model;
$patente = $data->patent;
$ano = $data->year;
$align = 'L';

$fecha = new DateTime($data->requests[0]->created);
$fecha = $fecha->format('d/m/Y');

// Info básica.
$pdf->Info($fecha,$nombre_cliente,$nombre_mecanico,$marca,$modelo,$patente,$ano);


$name = 'lalala';
$checked = true;

//$pdf->CustomCheckBox('nombreasd',true);
//$pdf->CustomCheckBox('otra cosa',false);



$data = [
	0 => ['name'=>'probando tabla con definiciones','value' => 'valora sdas dasldksdlsandlkdldlddkdnlankdsk'],
	1 => ['name'=>'probando tabla con definiciones','value' => 'valora sdas dasldksdlsandlkdldlddkdnlankdsk'],
	2 => ['name'=>'probando tabl','value' => 'valora sdas dasldksdlsandlkdldlddkdnlankdsk'],
	3 => ['name'=>'proident, sunt in culpa','value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo']
];

// $pdf->ItemValueList($data,'40%','60%');


$pdf->SubTitle('Servicios');
$pdf->ServiceItems($data);










// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output($file_name . '.pdf', 'D');
