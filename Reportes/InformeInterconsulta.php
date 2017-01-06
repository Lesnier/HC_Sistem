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

	$idPac=$_GET['idPac'];
	$info=new Informe;
	
	// Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(192, 192, 192);
	$this->SetTextColor(0,0,0);
    //$this->SetFont('Times','b',12);
    // Cabecera
    $w = array(40, 35, 45, 40);
    
    // Línea de cierre
    $this->SetXY(2,2);
	$this->Cell(17,0.0,utf8_decode(''),1,1,'L',false);
 		
	$this->SetXY(2.5,1.2);
	$this->SetFont('Arial','b',11);
	$this->Cell(7.5,1,utf8_decode('Expediente único para la Historia Clínica'),0,1,'L',false);

	$this->SetXY(2.2,1);
	$this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);

	$this->SetXY(1.3,1);
	$this->Cell(0.8,1.8,utf8_decode('46'),1,1,'L',true);

	$this->SetXY(15,2);
	$this->SetFont('Arial','b',8);
	$this->Cell(7.5,1,utf8_decode('Sistema Nacional de Salud'),0,1,'L',false);
	    
	$this->Image('img/logo1.jpg',15.5,3,3);
	
	$pacient222=$info->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$idPac' ");

	$this->SetXY(2.3,4);
	$this->SetFont('Arial','b',8);
	$this->Cell(10,0.4,utf8_decode("$pacient222"),1,1,'C',true);
	//ay1


	//Institucion del sistema
	$this->SetXY(2.3,4.35);
	$this->SetFont('Arial','b',8);
	$this->Cell(4,0.4,utf8_decode('INSTITUCIÓN DEL SISTEMA'),1,1,'C',true);
	
	$instsys=$info->Consultar("SELECT instisis_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(2.3,4.76);
	$this->SetFont('Arial','b',7);
	$this->Cell(4,1,utf8_decode("$instsys"),1,1,'C',false);
	
	//Unidad operativa
	$this->SetXY(6.3,4.35);
	$this->SetFont('Arial','b',8);
	$this->Cell(4.8,0.4,utf8_decode('UNIDAD OPERATIVA'),1,1,'C',true);
	
	$uniop=$info->Consultar("SELECT uniope_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(6.3,4.76);
	$this->SetFont('Arial','b',7);
	$this->Cell(4.8,1,utf8_decode("$uniop"),1,1,'C',false);
	
	//codigo
	$this->SetXY(11.1,4.35);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.3,0.4,utf8_decode('CÓDIGO'),1,1,'C',true);
	
	$codinfo=$info->Consultar("SELECT code_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(11.1,4.76);
	$this->SetFont('Arial','b',7);
	$this->Cell(1.3,1,utf8_decode("$codinfo"),1,1,'C',false);
	
	//Lccalizacion 
	$this->SetXY(12.4,4.35);
	$this->SetFont('Arial','b',8);
	$this->Cell(3,0.4,utf8_decode('LOCALIZACIÓN'),1,1,'C',true);
	
	//Parroquia
	$this->SetXY(12.4,4.75);
	$this->SetFont('Arial','b',4.3);
	$this->Cell(1,0.4,utf8_decode('PARROQUIA'),1,1,'C',true);
	
	$parro=$info->Consultar("SELECT parroq_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(12.4,5.15);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.6,utf8_decode("$parro"),1,1,'C',false);
	
	//Canton	
	$this->SetXY(13.4,4.75);
	$this->SetFont('Arial','b',4.3);
	$this->Cell(1,0.4,utf8_decode('CANTÓN'),1,1,'C',true);
	
	$canton=$info->Consultar("SELECT canton_intinfo FROM tbl_informeinterconsulta WHERE id_pac='' ORDER BY id_intinfo DESC");
	
	$this->SetXY(13.4,5.15);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.6,utf8_decode("$canton"),1,1,'C',false);
	
	//Provincia
	$this->SetXY(14.4,4.75);
	$this->SetFont('Arial','b',4.3);
	$this->Cell(1,0.4,utf8_decode('PROVINCIA'),1,1,'C',true);
	
	$prov=$info->Consultar("SELECT prov_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(14.4,5.15);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.6,utf8_decode("$prov"),1,1,'C',false);
	
	//Historia clinica
	$this->SetXY(15.4,4.35);
	$this->SetFont('Arial','b',8);
	$this->Cell(3,0.4,utf8_decode('HISTORIA CLÍNICA'),1,1,'C',true);
	
	$historiacl=$info->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$idPac' ");
	
	$this->SetXY(15.4,4.76);
	$this->SetFont('Arial','b',7);
	$this->Cell(3,1,utf8_decode("$historiacl"),1,1,'C',false);
	
	//Cuadro clinico de interconsulta
	$this->SetXY(2.3,5.9);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.1,0.5,utf8_decode(' 7. CUADRO CLÍNICO DE INTERCONSULTA'),1,1,'L',true);
	
	$this->SetXY(2.3,6.4);
	$this->SetFont('Arial','b',7);
	$this->Cell(16.1,4.8,utf8_decode(''),1,1,'L',false);
	
	$cuadroclin=$info->Consultar("SELECT cuadcl_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.4,6.5);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(15.9,0.5,utf8_decode("$cuadroclin"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//Pruebas diagnosticas propuestas
	$this->SetXY(2.3,11.37);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.1,0.5,utf8_decode(' 8. PRUEBAS DIAGNÓSTICAS PROPUESTAS'),1,1,'L',true);
	
	$this->SetXY(2.3,11.87);
	$this->SetFont('Arial','b',7);
	$this->Cell(16.1,2.1,utf8_decode(''),1,1,'L',false);
	
	$pruebasdg=$info->Consultar("SELECT pruebdi_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.4,12);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(15.9,0.4,utf8_decode("$pruebasdg"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//Diagnosticos
	
	//descripcion1
	$this->SetXY(2.3,14.15);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.1,0.45,utf8_decode(' 9. DIAGNÓSTICOS'),1,1,'L',true);
	
	$this->SetXY(5,14.16);
	$this->SetFont('Arial','b',5);
	$this->Cell(3.3,0.41,utf8_decode('PRE= PRESUNTIVO DEF= DEFINITIVO'),0,1,'C',true);
	
	//CIE
	$this->SetXY(8.3,14.15);
	$this->SetFont('Arial','b',8);
	$this->Cell(1,0.45,utf8_decode('CIE'),1,1,'C',true);
	
	//PRE
	$this->SetXY(9.3,14.15);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode('PRE'),1,1,'C',true);
	
	//DEF
	$this->SetXY(9.8,14.15);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode('DEF'),1,1,'C',true);
	
	//CIE2
	$this->SetXY(16.4,14.15);
	$this->SetFont('Arial','b',8);
	$this->Cell(1,0.45,utf8_decode('CIE'),1,1,'C',true);
	
	//PRE2
	$this->SetXY(17.4,14.15);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode('PRE'),1,1,'C',true);
	
	//DEF2
	$this->SetXY(17.9,14.15);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode('DEF'),1,1,'C',true);
	
	//1
	$this->SetXY(2.3,14.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode('1'),1,1,'C',true);
	
	//desc1
	$desc1=$info->Consultar("SELECT dign1_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(2.8,14.6);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(5.5,0.5,utf8_decode("$desc1"),1,1,'C',false);
	
	//cie1
	$cod1=$info->Consultar("SELECT cod1_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(8.3,14.6);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1,0.5,utf8_decode("$cod1"),1,1,'C',false);
	
	//pre1
	$this->SetXY(9.3,14.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$pre1=$info->Consultar("SELECT pre1_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($pre1)
	{
		case "true":
		$this->SetXY(9.3,14.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
		break;
		
		case "false":
		$this->SetXY(9.3,14.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//def1
	$this->SetXY(9.8,14.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$def1=$info->Consultar("SELECT def1_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($def1)
	{
		case "true":
		$this->SetXY(9.8,14.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
		break;
		
		case "false":
		$this->SetXY(9.8,14.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//2
	$this->SetXY(2.3,15.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode('2'),1,1,'C',true);
	
	//desc2
	$desc2=$info->Consultar("SELECT dign2_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC"); 
	
	$this->SetXY(2.8,15.1);
	$this->SetFont('Arial','b',5);
	$this->Cell(5.5,0.5,utf8_decode("$desc2"),1,1,'C',false);
	
	//cie2
	$cod2=$info->Consultar("SELECT cod2_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(8.3,15.1);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.5,utf8_decode("$cod2"),1,1,'C',false);
	
	//pre2
	$this->SetXY(9.3,15.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$pre2=$info->Consultar("SELECT pre2_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($pre2)
	{
		case "true":
		$this->SetXY(9.3,15.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
		break;
		
		case "false":
		$this->SetXY(9.3,15.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//def2
	$this->SetXY(9.8,15.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$def2=$info->Consultar("SELECT def2_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($def2)
    {
        case "true":
        $this->SetXY(9.8,15.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(9.8,15.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//3
	$this->SetXY(2.3,15.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode('3'),1,1,'C',true);
	
	//desc3
	$desc3=$info->Consultar("SELECT dign3_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(2.8,15.6);
	$this->SetFont('Arial','b',5);
	$this->Cell(5.5,0.5,utf8_decode("$desc3"),1,1,'C',false);
	
	//cie3
	$cod3=$info->Consultar("SELECT cod3_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(8.3,15.6);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.5,utf8_decode("$cod3"),1,1,'C',false);
	
	//pre3
	$this->SetXY(9.3,15.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$pre3=$info->Consultar("SELECT pre3_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($pre3)
    {
        case "true":
        $this->SetXY(9.3,15.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(9.3,15.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//def3
	$this->SetXY(9.8,15.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$def3=$info->Consultar("SELECT def3_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($def3)
    {
        case "true":
        $this->SetXY(9.8,15.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(9.8,15.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//4
	$this->SetXY(10.3,14.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode('4'),1,1,'C',true);
	
	//desc4
	$desc4=$info->Consultar("SELECT dign4_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(10.8,14.6);
	$this->SetFont('Arial','b',5);
	$this->Cell(5.6,0.5,utf8_decode("$desc4"),1,1,'C',false);
	
	//cie4
	$cod4=$info->Consultar("SELECT cod4_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(16.4,14.6);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.5,utf8_decode("$cod4"),1,1,'C',false);
	
	//pre4
	$this->SetXY(17.4,14.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$pre4=$info->Consultar("SELECT pre4_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($pre4)
    {
        case "true":
        $this->SetXY(17.4,14.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(17.4,14.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//def4
	$this->SetXY(17.9,14.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$def4=$info->Consultar("SELECT def4_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($def4)
    {
        case "true":
        $this->SetXY(17.9,14.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(17.9,14.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//5
	$this->SetXY(10.3,15.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode('5'),1,1,'C',true);
	
	//desc5
	$desc5=$info->Consultar("SELECT dign5_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(10.8,15.1);
	$this->SetFont('Arial','b',6);
	$this->Cell(5.6,0.5,utf8_decode("$desc5"),1,1,'C',false);
	
	//cie5
	$cod5=$info->Consultar("SELECT cod5_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(16.4,15.1);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.5,utf8_decode("$cod5"),1,1,'C',false);
	
	//pre5
	$this->SetXY(17.4,15.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$pre5=$info->Consultar("SELECT pre5_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($pre5)
    {
        case "true":
        $this->SetXY(17.4,15.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(17.4,15.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//def5
	$this->SetXY(17.9,15.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$def5=$info->Consultar("SELECT def5_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($def5)
    {
        case "true":
        $this->SetXY(17.9,15.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(17.9,15.1);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//6
	$this->SetXY(10.3,15.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode('6'),1,1,'C',true);
	
	//desc6
	$desc6=$info->Consultar("SELECT dign6_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(10.8,15.6);
	$this->SetFont('Arial','b',5);
	$this->Cell(5.6,0.5,utf8_decode("$desc6"),1,1,'C',false);
	
	//cie6
	$cod6=$info->Consultar("SELECT cod6_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(16.4,15.6);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.5,utf8_decode("$cod6"),1,1,'C',false);
	
	//pre6
	$this->SetXY(17.4,15.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$pre6=$info->Consultar("SELECT pre6_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($pre6)
    {
        case "true":
        $this->SetXY(17.4,15.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(17.4,15.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//def6
	$this->SetXY(17.9,15.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
	
	$def6=$info->Consultar("SELECT def6_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	switch($def6)
    {
        case "true":
        $this->SetXY(17.9,15.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode('x'),1,1,'C',false);
        break;
        
        case "false":
        $this->SetXY(17.9,15.6);
		$this->SetFont('Arial','b',8);
		$this->Cell(0.5,0.5,utf8_decode(''),1,1,'C',false);
        break;
    }
	
	//Plan terapeutico propuesto
	$this->SetXY(2.3,16.25);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.1,0.5,utf8_decode(' 11. PLAN TERAPEÚTICO PROPUESTO'),1,1,'L',true);
	
	$this->SetXY(2.3,16.75);
	$this->SetFont('Arial','b',7);
	$this->Cell(16.1,3.3,utf8_decode(''),1,1,'L',false);
	
	$plantepro=$info->Consultar("SELECT plantep_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	$plantepro=str_replace(";", "\n", $plantepro);

	$this->SetFillColor(300, 300, 300);	
	$this->SetXY(2.4,16.8);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(15.9,0.4,utf8_decode("$plantepro"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//Plan educacional propuesto
	$this->SetXY(2.3,20.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.1,0.5,utf8_decode(' 12. PLAN EDUCACIONAL PROPUESTO'),1,1,'L',true);
	
	$this->SetXY(2.3,20.7);
	$this->SetFont('Arial','b',7);
	$this->Cell(16.1,1.7,utf8_decode(''),1,1,'L',false);
	
	$planed=$info->Consultar("SELECT planedp_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetFillColor(300, 300, 300);	
	$this->SetXY(2.4,20.8);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(15.9,0.4,utf8_decode("$planed"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//Resumen del criterio clinico
	$this->SetXY(2.3,22.6);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.1,0.5,utf8_decode(' 13. RESUMEN DEL CRITERIO CLÍNICO'),1,1,'L',true);
	
	$this->SetXY(2.3,23.1);
	$this->SetFont('Arial','b',7);
	$this->Cell(16.1,2.7,utf8_decode(''),1,1,'L',false);
	
	$resucl=$info->Consultar("SELECT resumcri_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetFillColor(300, 300, 300);	
	$this->SetXY(2.4,23.2);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(15.9,0.4,utf8_decode("$resucl"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//servicio
	$this->SetXY(2.3,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1,0.5,utf8_decode('SERVICIO'),1,1,'L',true);
	
	$serv=$info->Consultar("SELECT serv_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(3.3,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(2,0.5,utf8_decode("$serv"),1,1,'L',false);
	
	//medico
	$this->SetXY(5.2,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1,0.5,utf8_decode('MÉDICO'),1,1,'L',true);
	
	$med=$info->Consultar("SELECT medico_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(6.2,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(4.8,0.5,utf8_decode("$med"),1,1,'L',false);
	
	//firma
	$this->SetXY(11,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1,0.5,utf8_decode('FIRMA'),1,1,'L',true);
	
	$this->SetXY(12,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(4.8,0.5,utf8_decode(''),1,1,'L',false);
	
	//codigo
	$codemed=$info->Consultar("SELECT codeme_intinfo FROM tbl_informeinterconsulta WHERE id_pac='$idPac' ORDER BY id_intinfo DESC");
	
	$this->SetXY(16.8,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1.6,0.5,utf8_decode("$codemed"),1,1,'C',false);
	
	$this->SetXY(16.8,25.86);
	$this->SetFont('Arial','b',5.1);
	$this->Cell(1.6,0.2,utf8_decode('CÓDIGO'),0,1,'C',false);
	
	//PIE DE PAGINA
	$this->SetXY(2.2,26.64);
	$this->SetFont('Arial','b',8);
	$this->Cell(4.7,0.5,utf8_decode('SNS-MSP / HCU-form.007 / 2007'),0,1,'L',false);
	
	$this->SetXY(14.1,26.64);
	$this->SetFont('Arial','b',8);
	$this->Cell(5.2,0.5,utf8_decode('INTERCONSULTA - INFORME'),0,1,'L',false);
	
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