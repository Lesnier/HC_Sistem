<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/Informe.php";

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
    
	$info=new Informe;
	$id=$_GET['id'];
	//$id=$id+1;
	$med=$info->Consultar("SELECT medico_intinfo FROM tbl_informeinterconsulta WHERE id_intinfo='$id'");
	$idpac=$info->Consultar("SELECT id_pac FROM tbl_informeinterconsulta WHERE id_intinfo='$id'");
	$ced=$info->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$idpac'");
	$nombpac=$info->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$idpac'");
	$plantepro=$info->Consultar("SELECT plantep_intinfo FROM tbl_informeinterconsulta WHERE id_intinfo='$id'");
	$auxvec=explode(";",$plantepro);
	
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
	$this->Cell(7.5,1,utf8_decode('Receta '),0,1,'L',false);

	$this->SetXY(1.9,1);
	$this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);

	$this->SetXY(0.9,1);
	$this->Cell(0.8,1.8,utf8_decode(''),1,1,'L',true);

	$this->SetXY(15,2);
	$this->SetFont('Arial','b',8);
	$this->Cell(7.5,1,utf8_decode('Sistema Nacional de Salud'),0,1,'L',false);
	    
	$this->Image('img/logo1.jpg',8,3,7);
	
	$this->SetXY(2,6);
	$this->SetFont('Arial','b',8);
	$this->Cell(3,1,utf8_decode("MEDICO: "),1,1,'C',true);
	
	$this->SetXY(5,6);
	$this->SetFont('Arial','b',8);
	$this->Cell(15,1,utf8_decode("$med"),1,1,'C',false);

	$this->SetXY(2,7);
	$this->SetFont('Arial','b',8);
	$this->Cell(3,1,utf8_decode("HISTORIA CLINICA: "),1,1,'C',true);

	$this->SetXY(5,7);
	$this->SetFont('Arial','b',8);
	$this->Cell(15,1,utf8_decode("$ced "),1,1,'C',false);
	
	
	$this->SetXY(2,8);
	$this->SetFont('Arial','b',8);
	$this->Cell(3,1,utf8_decode("PACIENTE: "),1,1,'C',true);
	
	$this->SetXY(5,8);
	$this->SetFont('Arial','b',8);
	$this->Cell(15,1,utf8_decode("$nombpac"),1,1,'C',false);

	$this->SetXY(2,10);
	$this->SetFont('Arial','b',8);
	$this->Cell(18,0.5,utf8_decode("MEDICAMENTOS E INDICACIONES"),1,1,'l',true);

	$this->SetXY(2,10.5);
	$this->SetFont('Arial','b',8);
	$this->Cell(18,16,utf8_decode(""),1,1,'l',false);

	 $this->SetFillColor(255, 255, 255);
	$this->SetXY(2.5,11);
	$this->SetFont('Arial','b',8);
	
	$this->MultiCell(17,0.5,utf8_decode("  "),0,1,'l',true);


	$this->SetFont('Arial','b',8);
	$y=0.5;
	for($x=0;$x<count($auxvec);$x++){
		$this->SetXY(2.7, (11+$y) );
		$this->Cell(16,0.5,utf8_decode("".$auxvec[$x]),0,1,'l',true);
		$y=$y+0.5;
	}
	




	
		$idmed=$info->Consultar("SELECT id_med FROM tbl_informeinterconsulta WHERE id_intinfo='$id'");
		$img=$info->Consultar("SELECT url_usu FROM tbl_usuario WHERE id_usu='$idmed';");
		if($img!=""){
			$this->Image($img,13,27,3); 
		} 
	

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
