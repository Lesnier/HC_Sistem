<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/Expediente.php";

class PDF extends FPDF
{
// Tabla simple
function BasicTable()
{
    
}

// Una tabla más completa

// Tabla coloreada
function FancyTable()
{
    // Colores, ancho de línea y fuente en negrita
    /*$this->SetFillColor(148, 110, 140);
    $this->SetTextColor(0,0,0);
    $this->SetDrawColor(57, 115, 91);
    $this->SetLineWidth(1);
    $this->SetFont('Times','b',12); */
    // Cabecera
    $w = array(40, 35, 45, 40);
    
	$expe=new Expediente;
	$id=$_GET['id'];
	
	// Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(192, 192, 192);
	$this->SetTextColor(0,0,0);
    //$this->SetFont('Times','b',12);
    // Cabecera
    $w = array(40, 35, 45, 40);
    
    // Línea de cierre
    $this->SetXY(2,2);
	$this->Cell(18.5,0.0,utf8_decode(''),1,1,'L',false);
 		
	$this->SetXY(2.3,1.2);
	$this->SetFont('Arial','b',12);
	$this->Cell(7.5,1,utf8_decode('Expediente único para la Historia Clínica'),0,1,'L',false);

	$this->SetXY(1.9,1);
	$this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);

	$this->SetXY(0.9,1);
	$this->Cell(0.8,1.8,utf8_decode('36'),1,1,'L',true);

	$this->SetXY(15,2);
	$this->SetFont('Arial','b',8);
	$this->Cell(7.5,1,utf8_decode('Sistema Nacional de Salud'),0,1,'L',false);
	    
	$this->Image('img/logo1.jpg',15.5,3,3);
	
	$this->SetXY(2.1,4.2);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(1.6,0.5,utf8_decode("FECHA \n(D/M/A)"),1,1,'C',true);
	
	$this->SetXY(3.7,4.2);
	$this->SetFont('Arial','b',7);
	$this->Cell(0.8,1,utf8_decode('HORA'),1,1,'C',true);
	
	$this->SetXY(4.5,4.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(6.6,0.5,utf8_decode('EVOLUCÓN'),1,1,'C',true);
	
	$this->SetXY(4.5,4.7);
	$this->SetFont('Arial','b',6);
	$this->Cell(6.6,0.5,utf8_decode('FIRMAR AL PIE DE CADA NOTA DE EVOLUCIÓN'),1,1,'C',true);
	
	$this->SetXY(11.1,4.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(6.6,0.5,utf8_decode('PRESCRIPCIONES'),1,1,'C',true);
	
	$this->SetXY(11.1,4.7);
	$this->SetFont('Arial','b',6);
	$this->Cell(6.6,0.5,utf8_decode('FIRMAR AL PIE DE CADA CONJUNTO DE PRESCRIPCIONES'),1,1,'C',true);
	
	$this->SetXY(17.7,4.2);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(1.8,0.25,utf8_decode("MEDICA\nMENTOS"),1,1,'C',true);
	
	$this->SetXY(17.7,4.7);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(1.8,0.25,utf8_decode("REGISTRAR\nADMINISTR."),1,1,'C',true);
	
	//fecha
	//$idexp=$expe->Consultar("SELECT MAX(id_exp) FROM tbl_expediente WHERE id_pac='$id'");
	$fecha=$expe->Consultar("SELECT fech_expe FROM tbl_expediente WHERE id_exp='$id' ORDER BY id_exp DESC");
	
	$this->SetXY(2.1,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.6,21.8,utf8_decode(''),1,1,'C',false);
	
	$this->SetXY(2.1,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.6,0.6,utf8_decode("$fecha"),0,1,'C',false);
	
	//hora
	$ho=$expe->Consultar("SELECT hora_expe FROM tbl_expediente WHERE id_exp='$id' ORDER BY id_exp DESC");
	
	$this->SetXY(3.7,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.8,21.8,utf8_decode(''),1,1,'C',false); 
	
	$this->SetXY(3.7,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.8,0.6,utf8_decode("$ho"),0,1,'C',false);
	
	//evolucion
	$ev=$expe->Consultar("SELECT evo_expe FROM tbl_expediente WHERE id_exp='$id' ORDER BY id_exp DESC");
	
	$this->SetXY(4.5,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(6.6,21.8,utf8_decode(''),1,1,'L',false);
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(4.6,5.3);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(6.4,0.4,utf8_decode("$ev"),0,1,'L',false);
	
	//prescripciones
	$pres=$expe->Consultar("SELECT prescr_expe FROM tbl_expediente WHERE id_exp='$id' ORDER BY id_exp DESC");
	
	$this->SetXY(11.1,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(6.6,21.8,utf8_decode(''),1,1,'L',false);
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(11.2,5.3);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(6.4,0.4,utf8_decode("$pres"),0,1,'L',false);
	
	//medicamentos administr.
	$med=$expe->Consultar("SELECT medicam_expe FROM tbl_expediente WHERE id_exp='$id' ORDER BY id_exp DESC");
	
	$this->SetXY(17.7,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.8,21.8,utf8_decode(''),1,1,'L',false);
	
	$this->SetXY(17.7,5.3);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.8,0.4,utf8_decode("$med"),0,1,'L',false);
	
	//pie de pagina
	$this->SetXY(2.2,27);
	$this->SetFont('Arial','b',10);
	$this->Cell(5,0.6,utf8_decode('SNS-MSP / HCU-form.002 / 2007'),0,1,'L',false);
	
	$this->SetXY(13.1,27);
	$this->SetFont('Arial','b',10);
	$this->Cell(6.7,0.6,utf8_decode('CONSULTA EXTERNA - EVOLUCIÓN'),0,1,'L',false);
}
}

$pdf = new PDF("P","cm","A4");
// Títulos de las columnas
$header = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');
// Carga de datos

$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable();
$pdf->Output();
?>