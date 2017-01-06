<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/AnamnesisCdu.php";

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
    
	$anam=new AnamnesisCdu;
	$idPac=$_GET['idPac'];
	//$id=$_GET['id'];
	
	// Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(192, 192, 192);
	$this->SetTextColor(0,0,0);
    //$this->SetFont('Times','b',12);
    // Cabecera
    $w = array(40, 35, 45, 40);
    
    // Línea de cierre
    $this->SetXY(2,2);
	$this->Cell(18.5,0.0,utf8_decode(''),1,1,'L',false);
 		
	$this->SetXY(10.5,1);
	$this->SetFont('Arial','b',12);
	$this->Cell(7.5,1,utf8_decode('Rediseño de los formularios básicos'),0,1,'L',false);

	$this->SetXY(19,1);
	$this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);

	$this->SetXY(19.4,1);
	$this->Cell(0.8,1.8,utf8_decode('35'),1,1,'L',true);
	
	$this->SetXY(2.2,3);
	$this->SetFont('Arial','b',16);
	$this->Cell(7.5,1,utf8_decode('Anamnesis'),0,1,'L',false);

	$this->SetXY(15,2);
	$this->SetFont('Arial','b',8);
	$this->Cell(7.5,1,utf8_decode('Sistema Nacional de Salud'),0,1,'L',false);
	    
	$this->Image('img/logo1.jpg',15.5,3,3);
	
	//Establecimiento 
	$this->SetXY(2.2,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(3.7,0.6,utf8_decode('ESTABLECIMIENTO'),1,1,'L',true);
	
	$this->SetXY(2.2,4.9);
	$this->SetFont('Arial','b',10);
	$this->Cell(3.7,0.6,utf8_decode('Clínica de Urología'),1,1,'C',false);
	
	//Nombre
	$this->SetXY(5.9,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(4,0.6,utf8_decode('NOMBRE'),1,1,'C',true);
	
	$nom=$anam->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$idPac'");
	
	$this->SetXY(5.9,4.9);
	$this->SetFont('Arial','b',8);
	$this->Cell(4,0.6,utf8_decode("$nom"),1,1,'C',false);
	
	//Apellido 
	$this->SetXY(9.9,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(4,0.6,utf8_decode('APELLIDO'),1,1,'C',true); 
	
	$ape=$anam->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$idPac'");
	
	$this->SetXY(9.9,4.9);
	$this->SetFont('Arial','b',8);
	$this->Cell(4,0.6,utf8_decode("$ape"),1,1,'C',false);
	
	//Sexo
	$this->SetXY(13.9,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(1,0.6,utf8_decode('SEXO'),1,1,'C',true);
	
	$aux=NULL;
	$sex=$anam->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$idPac'");
	if($sex=="Masculino")
	{
		$aux="M";
	}
	else
	{
		$aux="F";
	}
	
	$this->SetXY(13.9,4.9);
	$this->SetFont('Arial','b',8);
	$this->Cell(1,0.6,utf8_decode("$aux"),1,1,'C',false); 
	
	//numero de hoja
	$this->SetXY(14.9,4.3);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.3,0.6,utf8_decode('N° Hoja'),1,1,'C',true); 
	
	$this->SetXY(14.9,4.9);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.3,0.6,utf8_decode(''),1,1,'C',false); 
	
	//Historia clinica
	$this->SetXY(16.2,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(3.5,0.6,utf8_decode('HISTORIA CLÍNICA'),1,1,'C',true);
	
	$hcl=$anam->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$idPac'");
	
	$this->SetXY(16.2,4.9);
	$this->SetFont('Arial','b',8);
	$this->Cell(3.5,0.6,utf8_decode("$hcl"),1,1,'C',false);
	
	//Motivo de consulta 
	$this->SetXY(2.2,5.7);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.5,0.6,utf8_decode('1. MOTIVO DE CONSULTA'),1,1,'L',true);
	
	$cons=$anam->Consultar("SELECT motivoc_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(2.2,6.3);
	$this->SetFont('Arial','b',8);
	$this->Cell(17.5,0.6,utf8_decode("$cons"),1,1,'L',false);
	
	//Antecedentes personales
	$this->SetXY(2.2,7.1);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.5,0.6,utf8_decode('2. ANTECEDENTES PERSONALES'),1,1,'L',true);
	
	$antepe=$anam->Consultar("SELECT anteper_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.2,7.7);
	$this->SetFont('Arial','b',8);
	$this->Cell(17.5,1.4,utf8_decode(''),1,1,'L',false);
	
	$this->SetDrawColor(300, 300, 300);
	$this->SetXY(2.3,7.8);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(17.3,0.4,utf8_decode("$antepe"),1,1,'L',false);
	$this->SetDrawColor(0,0,0);
	
	//Antecedentes familiares
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,9.2);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.5,0.6,utf8_decode('3. ANTECEDENTES FAMILIARES'),1,1,'L',true);
	
	$antefa=$anam->Consultar("SELECT antefam_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.2,9.8);
	$this->SetFont('Arial','b',8);
	$this->Cell(17.5,1.4,utf8_decode(''),1,1,'L',false);
	
	$this->SetDrawColor(300, 300, 300);
	$this->SetXY(2.3,9.9);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(17.3,0.4,utf8_decode("$antefa"),1,1,'L',false);
	$this->SetDrawColor(0,0,0);
	
	//Enfermedad o problema actual
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,11.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.5,0.6,utf8_decode('4. ENFERMEDAD O PROBLEMA ACTUAL'),1,1,'L',true);
	
	$enfac=$anam->Consultar("SELECT enferac_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.2,11.9);
	$this->SetFont('Arial','b',8);
	$this->Cell(17.5,2.5,utf8_decode(''),1,1,'L',false);
	
	$this->SetDrawColor(300, 300, 300);
	$this->SetXY(2.3,12);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(17.3,0.4,utf8_decode("$enfac"),1,1,'L',false);
	$this->SetDrawColor(0, 0, 0);
	
	//Revision actual de organos y sistemas
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,14.5);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.5,0.6,utf8_decode('5. REVISIÓN ACTUAL DE ÓRGANOS Y SISTEMAS'),1,1,'L',true);
	
	$revoys=$anam->Consultar("SELECT reviorgsis_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.2,15.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(17.5,1.3,utf8_decode(''),1,1,'L',false);
	
	$this->SetDrawColor(300, 300, 300);
	$this->SetXY(2.3,15.2);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(17.3,0.4,utf8_decode("$revoys"),1,1,'L',false);
	$this->SetDrawColor(0, 0, 0);
	
	//signos vitales
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,16.5);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.5,0.6,utf8_decode('6. SIGNOS VITALES'),1,1,'L',true);
	//fecha
	$this->SetXY(2.2,17.1);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode('FECHA'),1,1,'C',true);
	//f1
	$fech1=$anam->Consultar("SELECT fecha1_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(5.7,17.1);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$fech1"),1,1,'C',true);
	//f2
	$fech2=$anam->Consultar("SELECT fecha2_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(9.2,17.1);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$fech2"),1,1,'C',true);
	//f3
	$fech3=$anam->Consultar("SELECT fecha3_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(12.7,17.1);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$fech3"),1,1,'C',true);
	//f4
	$fech4=$anam->Consultar("SELECT fehca4_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(16.2,17.1);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$fech4"),1,1,'C',true);
	//presion arterial
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,17.7);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode('PRESIÓN ARTERIAL'),1,1,'C',true);
	//p1
	$prear1=$anam->Consultar("SELECT prearte1_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(5.7,17.7);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$prear1"),1,1,'C',true);
	//p2
	$prear2=$anam->Consultar("SELECT prearte2_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(9.2,17.7);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$prear2"),1,1,'C',true);
	//p3
	$prear3=$anam->Consultar("SELECT prearte3_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(12.7,17.7);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$prear3"),1,1,'C',true);
	//p4
	$prear4=$anam->Consultar("SELECT prearte4_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(16.2,17.7);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$prear4"),1,1,'C',true);
	//pulso x min
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,18.3);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode('PULSO X min'),1,1,'C',true);
	//pxm1
	$pulsoxm1=$anam->Consultar("SELECT pulso1_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(5.7,18.3);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$pulsoxm1"),1,1,'C',true);
	//pxm2
	$pulsoxm2=$anam->Consultar("SELECT pulso2_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(9.2,18.3);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$pulsoxm2"),1,1,'C',true);
	//pxm3
	$pulsoxm3=$anam->Consultar("SELECT pulso3_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(12.7,18.3);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$pulsoxm3"),1,1,'C',true);
	//pxm4
	$pulsoxm4=$anam->Consultar("SELECT pulso4_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(16.2,18.3);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$pulsoxm4"),1,1,'C',true);
	//temperatura °c
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,18.9);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode('TEMPERATURA °c'),1,1,'C',true);
	//t1
	$temp1=$anam->Consultar("SELECT temp1_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(5.7,18.9);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$temp1"),1,1,'C',true);
	//t2
	$temp2=$anam->Consultar("SELECT temp2_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(9.2,18.9);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$temp2"),1,1,'C',true);
	//t3
	$temp3=$anam->Consultar("SELECT temp3_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(12.7,18.9);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$temp3"),1,1,'C',true);
	//t4
	$temp4=$anam->Consultar("SELECT temp4_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(16.2,18.9);
	$this->SetFont('Arial','b',9);
	$this->Cell(3.5,0.6,utf8_decode("$temp4"),1,1,'C',true);
	
	//examen fisico
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,19.7);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.5,0.6,utf8_decode('7. EXAMEN FÍSICO'),1,1,'L',true);
	
	$exfi=$anam->Consultar("SELECT examfi_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.2,20.3);
	$this->SetFont('Arial','b',8);
	$this->Cell(17.5,4.2,utf8_decode(''),1,1,'L',false); 
	
	$this->SetDrawColor(300,300,300);
	$this->SetXY(2.3,20.4);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(17.3,0.4,utf8_decode("$exfi"),1,1,'L',false);
	$this->SetDrawColor(0,0,0);
	
	//Pie de Pagina 1
	$this->SetDrawColor(300,300,300);
	$this->SetXY(2,27);
	$this->SetFont('Arial','b',10);
	$this->Cell(5,0.6,utf8_decode('SNS-MSP  /  HCU-form.002 / 2007'),1,1,'L',false);
	 
	$this->SetXY(13.3,27);
	$this->Cell(7,0.6,utf8_decode('CONSULTA EXTERNA - ANAMNESIS'),1,1,'L',false);
	$this->SetDrawColor(0,0,0);
	
	//Diagnosticos
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,29.2);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.5,0.0,utf8_decode(''),1,1,'L',true);
	//HOJA 2
	$this->SetXY(2.2,3.5);
	$this->SetFont('Arial','b',10);
	$this->Cell(14.1,0.6,utf8_decode('8. DIAGNÓSTICOS'),1,1,'L',true);
	
	$this->SetXY(16.3,3.5);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.9,0.6,utf8_decode('CIE'),1,1,'C',true);
	
	$this->SetXY(18.2,3.5);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.6,0.6,utf8_decode('PRE'),1,1,'C',true);
	
	$this->SetXY(18.8,3.5);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.6,0.6,utf8_decode('DEF'),1,1,'C',true);
	//1
	$this->SetXY(2.2,4.1);
  	$this->SetFont('Arial','b',10);
  	$this->Cell(0.6,0.6,utf8_decode('1'),1,1,'L',true);
	//cie1
	
	$cie1=$anam->Consultar("SELECT cie1_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.8,4.1);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(13.5,0.6,utf8_decode("$cie1"),1,1,'L',false);
	//cod1
	
	$cod1=$anam->Consultar("SELECT codcie1_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(16.3,4.1);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(1.9,0.6,utf8_decode("$cod1"),1,1,'L',false);
	//pre1
	$idanam=$anam->Consultar("SELECT MAX(id_cduanam) FROM tbl_cduanamnesis WHERE id_pac='$idPac'");
	$pre1=$anam->Consultar("SELECT pre1_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($pre1=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,4.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.3,4.3);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,4.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',false);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.3,4.3);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',false);
	}
	//def1
	$def1=$anam->Consultar("SELECT def1_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($def1=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,4.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.9,4.3);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);	
		$this->SetXY(18.8,4.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',false);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.9,4.3);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',false);
	}
	//2
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,4.7);
  	$this->SetFont('Arial','b',10);
  	$this->Cell(0.6,0.6,utf8_decode('2'),1,1,'L',true);
	//cie2
	
	$cie2=$anam->Consultar("SELECT cie2_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.8,4.7);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(13.5,0.6,utf8_decode("$cie2"),1,1,'L',false);
	//cod2
	
	$cod2=$anam->Consultar("SELECT codcie2_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(16.3,4.7);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(1.9,0.6,utf8_decode("$cod2"),1,1,'L',false);
	//pre2
	$pre2=$anam->Consultar("SELECT pre2_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($pre2=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,4.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.3,4.9);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,4.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',false);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.3,4.9);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',false);
	}
	//def2
	$def2=$anam->Consultar("SELECT def2_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($def2=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,4.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.9,4.9);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,4.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.9,4.9);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',true);
	}
	//3
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,5.3);
  	$this->SetFont('Arial','b',10);
  	$this->Cell(0.6,0.6,utf8_decode('3'),1,1,'L',true);
	//cie3
	
	$cie3=$anam->Consultar("SELECT cie3_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.8,5.3);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(13.5,0.6,utf8_decode("$cie3"),1,1,'L',false);
	//cod3
	
	$cod3=$anam->Consultar("SELECT codcie3_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(16.3,5.3);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(1.9,0.6,utf8_decode("$cod3"),1,1,'L',false);
	//pre3
	$pre3=$anam->Consultar("SELECT pre3_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($pre3=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,5.3);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.3,5.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,5.3);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',false);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.3,5.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',false);
	}
	//def3
	$def3=$anam->Consultar("SELECT def3_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($def3=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,5.3);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.9,5.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,5.3);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',false);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.9,5.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',false);
	}
	//4
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,5.9);
  	$this->SetFont('Arial','b',10);
  	$this->Cell(0.6,0.6,utf8_decode('4'),1,1,'L',true);
	//cie4
	
	$cie4=$anam->Consultar("SELECT cie4_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.8,5.9);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(13.5,0.6,utf8_decode("$cie4"),1,1,'L',false);
	//cod4
	
	$cod4=$anam->Consultar("SELECT codcie4_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(16.3,5.9);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(1.9,0.6,utf8_decode("$cod4"),1,1,'L',false);
	//pre4
	$pre4=$anam->Consultar("SELECT pre4_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($pre4=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,5.9);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.3,6.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,5.9);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',false);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.3,6.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',false);
	}
	//def4
	$def4=$anam->Consultar("SELECT def4_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($def4=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,5.9);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.9,6.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,5.9);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',false);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.9,6.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',false);
	}
	//5
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,6.5);
  	$this->SetFont('Arial','b',10);
  	$this->Cell(0.6,0.6,utf8_decode('5'),1,1,'L',true);
	//cie5
	
	$cie5=$anam->Consultar("SELECT cie5_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.8,6.5);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(13.5,0.6,utf8_decode("$cie5"),1,1,'L',false);
	//cod5
	
	$cod5=$anam->Consultar("SELECT codcie5_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(16.3,6.5);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(1.9,0.6,utf8_decode("$cod5"),1,1,'L',false);
	//pre5
	$pre5=$anam->Consultar("SELECT pre5_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($pre5=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,6.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.3,6.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.2,6.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',false);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.3,6.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',false);
	}
	//def5
	$def5=$anam->Consultar("SELECT def5_cduanam FROM tbl_cduanamnesis WHERE id_cduanam='$idanam' ORDER BY id_cduanam DESC");
	if($def5=="true")
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,6.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(192, 192, 192);
		$this->SetXY(18.9,6.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode('*'),1,1,'C',true);
	}
	else
	{
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.8,6.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.6,0.6,utf8_decode(''),1,1,'C',true);
		
		$this->SetFillColor(300, 300, 300);
		$this->SetXY(18.9,6.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.3,0.3,utf8_decode(''),1,1,'C',true);
	}
	
	//Planes Dte
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,7.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(17.3,0.6,utf8_decode('8. PLANES DE DIAGNÓSTICO, TERAPÉUTICOS Y EDUCACIONALES'),1,1,'L',true);
	
	$planes=$anam->Consultar("SELECT planesdte_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.2,7.9);
	$this->SetFont('Arial','b',8);
	$this->Cell(17.3,4,utf8_decode(''),1,1,'L',false);
	
	$this->SetDrawColor(300, 300, 300);
	$this->SetXY(2.3,8);
	$this->SetFont('Arial','b',8);
	$this->MultiCell(17.1,0.4,utf8_decode("$planes"),1,1,'L',false);
	$this->SetDrawColor(0, 0, 0);
	
	//Fecha para control 
	$this->SetFillColor(192, 192, 192);
	$this->SetXY(2.2,12.4);
	$this->SetFont('Arial','b',6);
	$this->MultiCell(1.4,0.3,utf8_decode('FECHA PARA CONTROL'),1,1,'C',true); 
	
	$fecontr=$anam->Consultar("SELECT fechcontr_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(3.6,12.4);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.9,0.9,utf8_decode("$fecontr"),1,1,'C',false);
	
	//hora fin
	$this->SetXY(5.5,12.4);
	$this->SetFont('Arial','b',6);
	$this->Cell(1.1,0.9,utf8_decode('HORA FIN'),1,1,'C',true);
	
	$horafin=$anam->Consultar("SELECT horafin_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(6.6,12.4);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.9,0.9,utf8_decode("$horafin"),1,1,'C',false);
	
	//MEDICO
	$this->SetXY(8.5,12.4);
	$this->SetFont('Arial','b',6);
	$this->Cell(1.1,0.9,utf8_decode('MÉDICO'),1,1,'C',true);
	
	$med=$anam->Consultar("SELECT medico_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(9.6,12.4);
	$this->SetFont('Arial','b',7);
	$this->Cell(3.7,0.9,utf8_decode("$med"),1,1,'C',false);
	
	//codigo
	$this->SetDrawColor(300,300,300);
	$this->SetXY(13.3,12);
	$this->SetFont('Arial','b',7);
	$this->Cell(1.1,0.3,utf8_decode('CÓDIGO'),1,1,'C',false);
	$this->SetDrawColor(0,0,0);
	
	$codm=$anam->Consultar("SELECT codmed_cduanam FROM tbl_cduanamnesis WHERE id_pac='$idPac' ORDER BY id_cduanam DESC");
	
	$this->SetXY(13.3,12.4);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.1,0.9,utf8_decode("$codm"),1,1,'C',false); 
	
	//firma 
	$idcdu=$anam->Consultar("SELECT MAX(id_cduanam) FROM tbl_cduanamnesis WHERE id_pac='$idPac';");
	$idmed=$anam->Consultar("SELECT id_med FROM tbl_cduanamnesis WHERE id_cduanam='$idcdu';");
	$img=$anam->Consultar("SELECT url_usu FROM tbl_usuario WHERE id_usu='$idmed';");
	if($img!=""){
		$this->Image($img,15.5,12.4,3);		
	}

	$this->SetXY(14.4,12.4);
	$this->SetFont('Arial','b',6);
	$this->Cell(1,0.9,utf8_decode("FIRMA "),1,1,'C',true);
	


	$this->SetXY(15.4,12.4);
	$this->SetFont('Arial','b',8);
	$this->Cell(4.1,0.9,utf8_decode(''),1,1,'C',false);
	
	//Pie de Pagina 2
	$this->SetDrawColor(300,300,300);
	$this->SetXY(2,27);
	$this->SetFont('Arial','b',10);
	$this->Cell(5,0.6,utf8_decode('SNS-MSP  /  HCU-form.002 / 2007'),1,1,'L',false);
	 
	$this->SetXY(13.3,27);
	$this->Cell(7,0.6,utf8_decode('CONSULTA EXTERNA - ANAMNESIS'),1,1,'L',false);
	$this->SetDrawColor(0,0,0);
	
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