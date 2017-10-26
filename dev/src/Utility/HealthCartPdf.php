<?php

// Override fonts folder =)
define('K_PATH_FONTS', WWW_ROOT.'pdfFonts/');


class HealthCartPdf extends TCPDF {

	var $title_header = '';
	var $logo = 'img/logo_medium.png' ;
    var $height = 8;
    var $border = 0;
    var $margenY = 25;

     // Muestra encabezado de las páginas. (Logo y Título)
    public function Header() {

        // Set font
        $this->SetFont('opensansb', '', 16);

        // Fondo  y Logo
        $this->Rect(0, 0, 2000, 20,'F',array(),array(0, 59, 102));
        $this->image($this->logo,15,3.2,'42.62','13','PNG','','L', false,72);

        // Título
        $this->Ln(5);
        $this->SetTextColor(255,255,255);
        $this->Cell(0, 15, $this->title_header, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Muestra información para el Pie de Página
    public function Footer() {

    	// background rect
    	$this->Rect(0,283, 227, 15,'F',array('T'=>(array('width'=>1,'color'=>array(237,109,37)))),array(0, 59, 102));

        // Position at 15 mm from bottom
        $this->SetY(-11);
        $this->setX(PDF_MARGIN_LEFT);

        // Set font
        $this->SetFont('opensans', '', 8);
        $this->SetTextColor(255,255,255);
        // Page number
        $this->Cell('', 10, 'Pág '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, 0, 'C');
    }


    // Información básica del Vehículo.
    public function Info($fecha = null,$nombre_cliente,$nombre_mecanico,$marca,$modelo,$patente,$ano){


        // debug, test
        $border = $this->border;
        $margenY = $this->margenY;
        $align = 'L';
        $h = $this->height;

        // Mover para empezar PDF.
        $this->setY($margenY);

        // Fecha
        $this->RoundedRect(150, $margenY, 61, $h, 0.5, '1111', 'FD',['color'=>[255,255,255]],[142,139,139]);
        // Default border
        $this->SetLineStyle(array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        $fecha = $fecha ? $fecha : date('d-m-Y');
        $this->SetFont('opensansb', '', 11, '', false);
        $this->Cell(150,$h,'Fecha:',$border,0,'R');
        $this->SetFont('opensans', '', 11, '', false);
        $this->Cell('',$h,$fecha,$border,0,'L');


        // Usuario
        $this->Ln($h);
        $ancho = 22;
        $this->SetFont('opensansb', '', 11, '', false);
        $this->Cell($ancho,$h,'Usuario:',$border,0,$align);
        $this->SetFont('opensans', '', 11, '', false);
        $this->Cell('',$h,$nombre_cliente,$border);

        //Cliente
        $this->Ln($h);
        $this->SetFont('opensansb', '', 11, '', false);
        $this->Cell($ancho,$h,'Mecánico:',$border,0,$align);
        $this->SetFont('opensans', '', 11, '', false);
        $this->Cell('',$h,$nombre_mecanico,$border);

        //Marca
        $ancho = 18;
        $this->setY($margenY + ($h));
        $this->setX(135);
        $this->SetFont('opensansb', '', 11, '', false);
        $this->Cell($ancho,$h,'Marca:',$border);
        $this->SetFont('opensans', '', 11, '', false);
        $this->Cell('',$h,$marca,$border);

        // Modelo
        $this->setY($margenY + ($h * 2));
        $this->setX(135);
        $this->SetFont('opensansb', '', 11, '', false);
        $this->Cell($ancho,$h,'Modelo:',$border,0,$align);
        $this->SetFont('opensans', '', 11, '', false);
        $this->Cell('',$h,$modelo,$border);


        // Patente
        $this->setY($margenY + ($h * 3));
        $this->setX(135);
        $this->SetFont('opensansb', '', 11, '', false);
        $this->Cell($ancho,$h,'Patente:',$border,0,$align);
        $this->SetFont('opensans', '', 11, '', false);
        $this->Cell('',$h,$patente,$border);

        // Año
        $this->setY($margenY + ($h * 4));
        $this->setX(135);
        $this->SetFont('opensansb', '', 11, '', false);
        $this->Cell($ancho,$h,'Año:',$border,0,$align);
        $this->SetFont('opensans', '', 11, '', false);
        $this->Cell('',$h,$ano,$border,1);

        //  separador
        $this->Rect(15,(($h*5.2)+$margenY),178,1,'F',[],[237,109,37]);

    }

    // Muestra Subtitulo
    public function SubTitle($subtitle){
        $this->Ln(5);
        $this->SetFont('opensansb');
        $this->Cell(30, $this->height,$subtitle,$this->border,1);
        $this->Ln(2);
    }

   // Muestra un checkbox dibujado con fontAwesome checked = true/false
   public function CustomCheckBox($name, $checked = false){

        $this->SetFont('opensans', '', 11, '', false);
        $html = '<p style="">'.$name.'</p>';
        $this->writeHTML($html, true, false, true, false);
        // icono "check"
        if($checked){
            $this->SetFont('fontawesomewebfont', '', 11, '', false);
            $html = '<span style="font-size: 1.4em;">&#xf046;</span>';
            $this->writeHTML($html, true, false, true, false);
        }
        // icono "no check"
        else{
            $this->SetFont('fontawesomewebfont', '', 11, '', false);
            $html = '<span style="font-size: 1.4em;">&#xf096;</span>';
            $this->writeHTML($html, true, false, true, false);
        }
        $this->Ln(1);
   }

   // Generá una tabla con par "nombre" y "valor"
   public function ItemValueList($data,$x = '30%',$y = '70%'){

        $this->SetFont('opensans', '', 11, '', false);
        $css = "";
        $css .= "<style type='text/css'>";
        $css .=" .table {border-collapse:collapse;border-radius: 4px;}";
        $css .=" .table,th, td { border: 1px solid #dddddd; padding:3px;}";
        $css .= "</style>\n\n";


        //<table cellspacing="0" cellpadding="0">
        $tabla = '<table class="table">';
        $tabla .= '<tr>
                    <td style="width:'.$x.'">Items</td>
                    <td style="width:'.$y.'">Descripción</td>
                   </tr>';
        foreach ($data as $key => $item) {
            $color = $key % 2 == 0 ? '#EAEAEA' : '#fff';
            $tabla .= '
                    <tr style="background-color: '.$color.'">
                        <td>'.$item['name'].'</td>
                        <td>'.$item['value'].'</td>
                   </tr>
            ';

        }
        $tabla .= '</table>';

        $this->writeHTML($css.$tabla, true, false, true, false);
   }


   // Listar items - LALALA
   public function ServiceItemsAlt($data){
        foreach ($data as $key => $service) {
            $this->SetFont('fontawesomewebfont');
            $icon = '<span style="font-size: 1.2em; display: inline; line-height: 2;">&#xf054;</span>';
            $this->writeHTML($icon, false, false, false);
            $this->SetFont('opensans');
            $name = '<span style="line-height: 2;">'.$service['name'].'</span>';
            $this->writeHTML($name, true, false, false);
        }
   }


   // Lista item con linea abajo (Borde bottom)
   public function ServiceItems($data){
        $this->SetFont('opensans');
        $border = array('B' => array('width' => 0.2, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
        foreach ($data as $key => $service) {
            $this->Cell('',$this->height, $service['name'], $border, 1);
        }
   }







}



