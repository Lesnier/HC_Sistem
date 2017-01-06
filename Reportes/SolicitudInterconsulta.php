<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/Solicitud.php";

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
    
	$solicitud=new Solicitud;
	$idPac=$_GET['idPac'];
	
	// Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(192, 192, 192);
	$this->SetTextColor(0,0,0);
    //$this->SetFont('Times','b',12);
    // Cabecera
    $w = array(40, 35, 45, 40);
    
    // Línea de cierre
    $this->SetXY(2,2);
	$this->Cell(18.5,0.0,utf8_decode(''),1,1,'L',false);
 		
	$this->SetXY(11.2,1);
	$this->SetFont('Arial','b',12);
	$this->Cell(7.5,1,utf8_decode('Rediseño de los formularios básicos'),0,1,'L',false);

	$this->SetXY(19,1);
	$this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);

	$this->SetXY(19.4,1);
	$this->Cell(0.8,1.8,utf8_decode('45'),1,1,'L',true);
	
	$this->SetXY(2.2,1);
	$this->SetFont('Arial','b',16);
	$this->Cell(7.5,1,utf8_decode('Pedido de Interconsulta'),0,1,'L',false);

	$this->SetXY(15,2);
	$this->SetFont('Arial','b',8);
	$this->Cell(7.5,1,utf8_decode('Sistema Nacional de Salud'),0,1,'L',false);
	    
	$this->Image('img/logo1.jpg',15.5,2.9,3);
	
	//institucion del sistema
	$this->SetXY(2.2,4.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(4,0.3,utf8_decode('INSTITUCION DEL SISTEMA'),1,1,'C',true);
	
	$instsys=$solicitud->Consultar("SELECT insti_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.2,4.4);
	$this->SetFont('Arial','b',7);
	$this->Cell(4,0.8,utf8_decode("$instsys"),1,1,'C',false);
	
	//unidad operativa
	$this->SetXY(6.2,4.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(4.8,0.3,utf8_decode('UNIDAD OPERATIVA'),1,1,'C',true);
	
	$uniop=$solicitud->Consultar("SELECT uniop_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(6.2,4.4);
	$this->SetFont('Arial','b',7 );
	$this->Cell(4.8,0.8,utf8_decode("$uniop"),1,1,'C',false);
	
	//CODIGO
	$this->SetXY(11,4.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(1.3,0.3,utf8_decode('CÓDIGO'),1,1,'C',true);
	
	$code1=$solicitud->Consultar("SELECT cod_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(11,4.4);
	$this->SetFont('Arial','b',6);
	$this->Cell(1.3,0.8,utf8_decode("$code1"),1,1,'C',false);
	
	//localizacion
	$this->SetXY(12.3,4.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(3.1,0.3,utf8_decode('LOCALIZACIÓN'),1,1,'C',true);
	
	//parroquia
	$this->SetXY(12.3,4.4);
	$this->SetFont('Arial','b',6);
	$this->Cell(1.1,0.3,utf8_decode('Parroquia'),1,1,'C',true);
	
	$parroquia=$solicitud->Consultar("SELECT parr_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(12.3,4.7);
	$this->SetFont('Arial','b',6);
	$this->Cell(1.1,0.5,utf8_decode("$parroquia"),1,1,'C',false);
	
	//canton
	$this->SetXY(13.4,4.4);
	$this->SetFont('Arial','b',6);
	$this->Cell(1,0.3,utf8_decode('Cantón'),1,1,'C',true);
	
	$canton=$solicitud->Consultar("SELECT cant_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(13.4,4.7);
	$this->SetFont('Arial','b',6);
	$this->Cell(1,0.5,utf8_decode("$canton"),1,1,'C',false);
	
	//provincia
	$this->SetXY(14.4,4.4);
	$this->SetFont('Arial','b',6);
	$this->Cell(1,0.3,utf8_decode('Provincia'),1,1,'C',true);
	
	$prov=$solicitud->Consultar("SELECT prov_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(14.4,4.7);
	$this->SetFont('Arial','b',6);
	$this->Cell(1,0.5,utf8_decode("$prov"),1,1,'C',false);
	
	//historia cl
	$this->SetXY(15.4,4.1);
	$this->SetFont('Arial','b',8);
	$this->Cell(3,0.6,utf8_decode('HISTORIA CLÍNICA'),1,1,'C',true);
	
	$historiacl=$solicitud->Consultar("SELECT hiscl_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(15.4,4.7);
	$this->SetFont('Arial','b',6);
	$this->Cell(3,0.5,utf8_decode("$historiacl"),1,1,'C',false);
	
	//apellidos paterno - materno
	$this->SetXY(2.2,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(6.6,0.3,utf8_decode('APELLIDOS'),1,1,'C',true);
	
	$apellidos=$solicitud->Consultar("SELECT ape_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.2,5.5);
	$this->SetFont('Arial','b',7);
	$this->Cell(6.6,0.45,utf8_decode("$apellidos"),1,1,'C',false);
	
	//primer - segundo nombre
	$this->SetXY(8.8,5.2);
	$this->SetFont('Arial','b',8);
	$this->Cell(6.6,0.3,utf8_decode('NOMBRES'),1,1,'C',true);
	
	$nombres=$solicitud->Consultar("SELECT nom_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(8.8,5.5);
	$this->SetFont('Arial','b',7);
	$this->Cell(6.6,0.45,utf8_decode("$nombres"),1,1,'C',false);
	
	//cedula ciudadania
	$this->SetXY(15.4,5.2);
	$this->SetFont('Arial','b',6.3);
	$this->Cell(3,0.3,utf8_decode('CÉDULA DE CIUDADANÍA'),1,1,'C',true);
	
	$cedcn=$solicitud->Consultar("SELECT cedc_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(15.4,5.5);
	$this->SetFont('Arial','b',7);
	$this->Cell(3,0.45,utf8_decode("$cedcn"),1,1,'C',false);
	
	//fecha atencion
	$this->SetXY(2.2,5.96);
	$this->SetFont('Arial','b',6.3);
	$this->Cell(2,0.6,utf8_decode(''),1,1,'C',true);
	
	$this->SetXY(2.3,6.10);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(1.8,0.2,utf8_decode("FECHA DE \nATENCIÓN"),0,1,'C',true);
	
	$fechaten=$solicitud->Consultar("SELECT fechatn_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.2,6.56);
	$this->SetFont('Arial','b',7);
	$this->Cell(2,0.45,utf8_decode("$fechaten"),1,1,'C',false);
	
	//hora
	$this->SetXY(4.2,5.96);
	$this->SetFont('Arial','b',7);
	$this->Cell(1.25,0.6,utf8_decode('HORA'),1,1,'C',true);
	
	$hora=$solicitud->Consultar("SELECT hora_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(4.2,6.56);
	$this->SetFont('Arial','b',7);
	$this->Cell(1.25,0.45,utf8_decode("$hora"),1,1,'C',false);
	
	//edad
	$this->SetXY(5.45,5.96);
	$this->SetFont('Arial','b',7);
	$this->Cell(1.44,0.6,utf8_decode('EDAD'),1,1,'C',true);
	
	$edad=$solicitud->Consultar("SELECT edad_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(5.45,6.56);
	$this->SetFont('Arial','b',6);
	$this->MultiCell(1.44,0.2,utf8_decode("$edad"),1,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//genero
	$this->SetXY(6.9,5.96);
	$this->SetFont('Arial','b',6);
	$this->Cell(1,0.3,utf8_decode('GÉNERO'),1,1,'C',true);
	
	$aux=NULL;
	$genero=$solicitud->Consultar("SELECT gen_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	//M
	$this->SetXY(6.9,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('M'),1,1,'C',true);
	
	//F
	$this->SetXY(7.4,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('F'),1,1,'C',true);
	
	if($genero="Masculino")
	{
		$this->SetXY(6.9,6.56);
		$this->SetFont('Arial','b',6);
		$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		
		$this->SetXY(7,6.65);
		$this->SetFont('Arial','b',6);
		$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		
		$this->SetXY(7.4,6.56);
		$this->SetFont('Arial','b',6);
		$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	}
	else
	{
		$this->SetXY(6.9,6.56);
		$this->SetFont('Arial','b',6);
		$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		
		$this->SetXY(7.4,6.56);
		$this->SetFont('Arial','b',6);
		$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		
		$this->SetXY(7.5,6.65);
		$this->SetFont('Arial','b',6);
		$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
	}
	
	//estado civil
	$this->SetXY(7.9,5.96);
	$this->SetFont('Arial','b',6);
	$this->Cell(2.5,0.3,utf8_decode('ESTADO CIVIL'),1,1,'C',true);
	
	$estciv=$solicitud->Consultar("SELECT estciv_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	//S
	$this->SetXY(7.9,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('S'),1,1,'C',true);
	
	$this->SetXY(7.9,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	//C
	$this->SetXY(8.4,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('C'),1,1,'C',true);
	
	$this->SetXY(8.4,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	//D
	$this->SetXY(8.9,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('D'),1,1,'C',true);
	
	$this->SetXY(8.9,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	//V
	$this->SetXY(9.4,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('V'),1,1,'C',true);
	
	$this->SetXY(9.4,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	//UL
	$this->SetXY(9.9,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('UL'),1,1,'C',true);
	
	$this->SetXY(9.9,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	switch($estciv)
	{
		case "Solter@":		
			$this->SetXY(8,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "Casad@":
			$this->SetXY(8.5,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "Divorciad@":			
			$this->SetXY(9,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "Viud@":
			$this->SetXY(9.5,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "Union Libre":
			$this->SetXY(10,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
	}
	
	//instruccion
	$this->SetXY(10.4,5.96);
	$this->SetFont('Arial','b',6);
	$this->Cell(2.5,0.3,utf8_decode('INSTRUCCIÓN'),1,1,'C',true);
	
	$instr=$solicitud->Consultar("SELECT instr_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	//SIN
	$this->SetXY(10.4,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('SIN'),1,1,'C',true);
	
	$this->SetXY(10.4,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	//BAS
	$this->SetXY(10.9,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('BAS'),1,1,'C',true);
	
	$this->SetXY(10.9,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	//BACH
	$this->SetXY(11.4,6.26);
	$this->SetFont('Arial','b',5);
	$this->Cell(0.5,0.3,utf8_decode('BACH'),1,1,'C',true);
	
	$this->SetXY(11.4,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	//SUP
	$this->SetXY(11.9,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('SUP'),1,1,'C',true);
	
	$this->SetXY(11.9,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	//ESP
	$this->SetXY(12.4,6.26);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.3,utf8_decode('ESP'),1,1,'C',true);
	
	$this->SetXY(12.4,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	switch($instr)
	{
		case "SIN INSTRUCCION":
			$this->SetXY(10.5,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "BASICO":
			$this->SetXY(11,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "BACHILLERATO":
			$this->SetXY(11.5,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "SUPERIOR":
			$this->SetXY(12,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "ESPECIALIDAD":
			$this->SetXY(12.5,6.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
	}
	
	//empresa donde trabaja
	$this->SetXY(12.9,5.96);
	$this->SetFont('Arial','b',6);
	$this->MultiCell(2.5,0.3,utf8_decode('EMPRESA DONDE TRABAJA'),1,1,'C',true);
	
	$emprtr=$solicitud->Consultar("SELECT emprtr_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(12.9,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(2.5,0.45,utf8_decode("$emprtr"),1,1,'C',false);
	
	//seguro salud
	$this->SetXY(15.4,5.96);
	$this->SetFont('Arial','b',7);
	$this->Cell(3,0.6,utf8_decode('SEGURO DE SALUD'),1,1,'C',true);
	
	$seguro=$solicitud->Consultar("SELECT segsa_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(15.4,6.56);
	$this->SetFont('Arial','b',6);
	$this->Cell(3,0.45,utf8_decode("$seguro"),1,1,'C',false);
	
	//1 motivo solicitud
	$this->SetXY(2.2,7.16);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,0.45,utf8_decode(' 1. MOTIVO Y DESTINO DE SOLICITUD'),1,1,'L',true);
	
	//establecimiento destino
	$this->SetXY(2.2,7.61);
	$this->SetFont('Arial','b',5);
	$this->Cell(1.75,0.45,utf8_decode(''),1,1,'L',true);
	
	$this->SetXY(2.2,7.61);
	$this->SetFont('Arial','b',5);
	$this->MultiCell(1.75,0.22,utf8_decode('ESTABLECIMIENTO DE DESTINO'),1,1,'L',true);
	
	$establdes=$solicitud->Consultar("SELECT estades_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(3.96,7.61);
	$this->SetFont('Arial','b',5);
	$this->Cell(2.5,0.45,utf8_decode("$establdes"),1,1,'L',false);
	
	//servicio consultado
	$this->SetXY(6.46,7.61);
	$this->SetFont('Arial','b',5);
	$this->Cell(1.5,0.45,utf8_decode(''),1,1,'L',true);
	
	$this->SetXY(6.46,7.61);
	$this->SetFont('Arial','b',6.8);
	$this->MultiCell(1.5,0.22,utf8_decode('Servicio consultado'),1,1,'L',true);
	
	$servco=$solicitud->Consultar("SELECT sercon_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(7.96,7.61);
	$this->SetFont('Arial','b',5);
	$this->Cell(2.5,0.45,utf8_decode("$servco"),1,1,'L',false);
	
	//servicio que solicita
	$this->SetXY(10.46,7.61);
	$this->SetFont('Arial','b',5);
	$this->Cell(1.5,0.45,utf8_decode(''),1,1,'L',true);
	
	$this->SetXY(10.46,7.61);
	$this->SetFont('Arial','b',5.1);
	$this->MultiCell(1.5,0.22,utf8_decode('SERVICIO QUE SOLICITA'),1,1,'L',true);
	
	$servso=$solicitud->Consultar("SELECT serso_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(11.96,7.61);
	$this->SetFont('Arial','b',5);
	$this->Cell(2.3,0.45,utf8_decode("$servso"),1,1,'L',false);
	
	//sala
	$this->SetXY(14.25,7.61);
	$this->SetFont('Arial','b',5.1);
	$this->Cell(1,0.45,utf8_decode('SALA'),1,1,'L',true);
	
	$sala=$solicitud->Consultar("SELECT sala_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(15.25,7.61);
	$this->SetFont('Arial','b',5);
	$this->Cell(1.2,0.45,utf8_decode("$sala"),1,1,'L',false);
	
	//cama
	$this->SetXY(16.37,7.61);
	$this->SetFont('Arial','b',5.1);
	$this->Cell(1,0.45,utf8_decode('CAMA'),1,1,'L',true);
	
	$cama=$solicitud->Consultar("SELECT cama_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(17.37,7.61);
	$this->SetFont('Arial','b',5);
	$this->Cell(1.02,0.45,utf8_decode("$cama"),1,1,'L',false);
	
	//normal
	$this->SetXY(2.2,8.06);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.45,utf8_decode('NORMAL'),1,1,'L',true);
	
	$this->SetXY(3.2,8.06);
	$this->SetFont('Arial','b',5);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'L',false);
	
	$norm=$solicitud->Consultar("SELECT norm_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($norm)
	{
		case "true":
			$this->SetXY(3.3,8.15);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(3.2,8.06);
			$this->SetFont('Arial','b',5);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'L',false);
		break;
	}
	
	//urgente
	$this->SetXY(3.7,8.06);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.45,utf8_decode('URGENTE'),1,1,'L',true);
	
	$this->SetXY(4.7,8.06);
	$this->SetFont('Arial','b',5);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'L',false);
	
	$urge=$solicitud->Consultar("SELECT urge_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($urge)
	{
		case "true":
			$this->SetXY(4.8,8.15);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(4.7,8.06);
			$this->SetFont('Arial','b',5);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'L',false);
		break;
	}
	
	//medico iterconsultado
	$this->SetXY(5.21,8.06);
	$this->SetFont('Arial','b',5);
	$this->Cell(2.2,0.45,utf8_decode(''),1,1,'L',true);
	
	$this->SetXY(5.24,8.10);
	$this->SetFont('Arial','b',4.9);
	$this->MultiCell(2,0.2,utf8_decode('MEDICO INTERCONSULTADO'),0,1,'L',true);
	
	$medinterco=$solicitud->Consultar("SELECT medin_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(7.43,8.06);
	$this->SetFont('Arial','b',7);
	$this->Cell(10.97,0.45,utf8_decode("$medinterco"),1,1,'L',false);
	
	//linea en blanco
	$this->SetXY(2.2,8.51);
	$this->SetFont('Arial','b',5);
	$this->Cell(16.2,0.4,utf8_decode(''),1,1,'L',false);
	
	//2 cuadro clinico actual
	$this->SetXY(2.2,9.07);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,0.45,utf8_decode(' 2. CUADRO CLÍNICO ACTUAL'),1,1,'L',true);
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.2,9.52);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,5.25,utf8_decode(''),1,1,'L',false);
	
	$cuadrocl=$solicitud->Consultar("SELECT cuadcl_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.3,9.53);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(16,0.4,utf8_decode("$cuadrocl"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//3 resultados de las pruebas diagnosticas
	$this->SetXY(2.2,14.91);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,0.45,utf8_decode(' 3. RESULTADO DE LAS PRUEBAS DIAGNÓSTICAS'),1,1,'L',true);
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.2,15.36);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,2.6,utf8_decode(''),1,1,'L',false);
	
	$resultados=$solicitud->Consultar("SELECT respru_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.3,15.38);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(16,0.4,utf8_decode("$resultados"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//4 diagnosticos
	
	//descripcion1
	$this->SetXY(2.2,18.10);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,0.45,utf8_decode(' 4. DIAGNÓSTICOS'),1,1,'L',true);
	
	$this->SetXY(4.9,18.12);
	$this->SetFont('Arial','b',5);
	$this->Cell(3.3,0.41,utf8_decode('PRE= PRESUNTIVO DEF= DEFINITIVO'),0,1,'C',true);
	
	//CIE
	$this->SetXY(8.3,18.10);
	$this->SetFont('Arial','b',8);
	$this->Cell(1,0.45,utf8_decode('CIE'),1,1,'C',true);
	
	//PRE
	$this->SetXY(9.3,18.10);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode('PRE'),1,1,'C',true);
	
	//DEF
	$this->SetXY(9.8,18.10);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode('DEF'),1,1,'C',true);
	
	//CIE2
	$this->SetXY(16.4,18.10);
	$this->SetFont('Arial','b',8);
	$this->Cell(1,0.45,utf8_decode('CIE'),1,1,'C',true);
	
	//PRE2
	$this->SetXY(17.4,18.10);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode('PRE'),1,1,'C',true);
	
	//DEF2
	$this->SetXY(17.9,18.10);
	$this->SetFont('Arial','b',6);
	$this->Cell(0.5,0.45,utf8_decode('DEF'),1,1,'C',true);
	
	//1
	$this->SetXY(2.2,18.55);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode('1'),1,1,'C',true);
	//desc1
	$desc1=$solicitud->Consultar("SELECT cie1_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.7,18.55);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(5.6,0.45,utf8_decode("$desc1"),1,1,'C',false);
	//cie1
	$cod1=$solicitud->Consultar("SELECT cod1_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(8.3,18.55);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1,0.45,utf8_decode("$cod1"),1,1,'C',false);
	//pre1
	$this->SetXY(9.3,18.55);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$pre1=$solicitud->Consultar("SELECT pre1_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($pre1)
	{
		case "true":
			$this->SetXY(9.4,18.64);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(9.3,18.55);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//def1
	$this->SetXY(9.8,18.55);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$def1=$solicitud->Consultar("SELECT def1_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($def1)
	{
		case "true":
			$this->SetXY(9.9,18.64);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(9.8,18.55);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//2
	$this->SetXY(2.2,19);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode('2'),1,1,'C',true);
	//desc2
	$desc2=$solicitud->Consultar("SELECT cie2_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.7,19);
	$this->SetFont('Arial','b',5);
	$this->Cell(5.6,0.45,utf8_decode("$desc2"),1,1,'C',false);
	//cie2
	$cod2=$solicitud->Consultar("SELECT cod2_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(8.3,19);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.45,utf8_decode("$cod2"),1,1,'C',false);
	//pre2
	$this->SetXY(9.3,19);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$pre2=$solicitud->Consultar("SELECT pre2_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($pre2)
	{
		case "true":
			$this->SetXY(9.4,19.10);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(9.3,19);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	//def2
	$this->SetXY(9.8,19);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$def2=$solicitud->Consultar("SELECT def2_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($def2)
	{
		case "true":
			$this->SetXY(9.9,19.10);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(9.3,19);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//3
	$this->SetXY(2.2,19.45);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode('3'),1,1,'C',true);
	//desc3
	$desc3=$solicitud->Consultar("SELECT cie3_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.7,19.45);
	$this->SetFont('Arial','b',5);
	$this->Cell(5.6,0.45,utf8_decode("$desc3"),1,1,'C',false);
	//cie3
	$cod3=$solicitud->Consultar("SELECT cod3_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(8.3,19.45);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.45,utf8_decode("$cod3"),1,1,'C',false);
	//pre3
	$this->SetXY(9.3,19.45);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$pre3=$solicitud->Consultar("SELECT pre3_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($pre3)
	{
		case "true":
			$this->SetXY(9.4,19.55);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(9.3,19.45);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	//def3
	$this->SetXY(9.8,19.45);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$def3=$solicitud->Consultar("SELECT def3_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($def3)
	{
		case "true":
			$this->SetXY(9.9,19.55);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(9.8,19.45);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//4
	$this->SetXY(10.3,18.55);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode('4'),1,1,'C',true);
	//desc4
	$desc4=$solicitud->Consultar("SELECT cie4_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(10.8,18.55);
	$this->SetFont('Arial','b',5);
	$this->Cell(5.6,0.45,utf8_decode("$desc4"),1,1,'C',false);
	//cie4
	$cod4=$solicitud->Consultar("SELECT cod4_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(16.4,18.55);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.45,utf8_decode("$cod4"),1,1,'C',false);
	//pre4
	$this->SetXY(17.4,18.55);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$pre4=$solicitud->Consultar("SELECT pre4_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($pre4)
	{
		case "true":
			$this->SetXY(17.5,18.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(17.4,18.55);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	//def4
	$this->SetXY(17.9,18.55);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$def4=$solicitud->Consultar("SELECT def4_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($def4)
	{
		case "true":
			$this->SetXY(18,18.65);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(17.9,18.55);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//5
	$this->SetXY(10.3,19);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode('5'),1,1,'C',true);
	//desc5
	$desc5=$solicitud->Consultar("SELECT cie5_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(10.8,19);
	$this->SetFont('Arial','b',6);
	$this->Cell(5.6,0.45,utf8_decode("$desc5"),1,1,'C',false);
	//cie5
	$cod5=$solicitud->Consultar("SELECT cod5_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(16.4,19);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.45,utf8_decode("$cod5"),1,1,'C',false);
	//pre5
	$this->SetXY(17.4,19);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$pre5=$solicitud->Consultar("SELECT pre5_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($pre5)
	{
		case "true":
			$this->SetXY(17.5,19.10);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(17.4,19);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	//def5
	$this->SetXY(17.9,19);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$def5=$solicitud->Consultar("SELECT def5_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($def5)
	{
		case "true":
			$this->SetXY(18,19.10);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(17.9,19);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//6
	$this->SetXY(10.3,19.45);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode('6'),1,1,'C',true);
	//desc6
	$desc6=$solicitud->Consultar("SELECT cie6_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(10.8,19.45);
	$this->SetFont('Arial','b',5);
	$this->Cell(5.6,0.45,utf8_decode("$desc6"),1,1,'C',false);
	//cie6
	$cod6=$solicitud->Consultar("SELECT cod6_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(16.4,19.45);
	$this->SetFont('Arial','b',5);
	$this->Cell(1,0.45,utf8_decode("$cod6"),1,1,'C',false);
	//pre6
	$this->SetXY(17.4,19.45);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$pre6=$solicitud->Consultar("SELECT pre6_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($pre6)
	{
		case "true":
			$this->SetXY(17.5,19.55);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(17.4,19.45);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	//def6
	$this->SetXY(17.9,19.45);
	$this->SetFont('Arial','b',8);
	$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
	
	$def6=$solicitud->Consultar("SELECT def6_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	switch($def6)
	{
		case "true":
			$this->SetXY(18,19.55);
			$this->SetFont('Arial','b',6);
			$this->Cell(0.25,0.25,utf8_decode('*'),1,1,'C',true);
		break;
		
		case "false":
			$this->SetXY(17.9,19.45);
			$this->SetFont('Arial','b',8);
			$this->Cell(0.5,0.45,utf8_decode(''),1,1,'C',false);
		break;
	}
	
	//5 plan terapeutico
	$this->SetXY(2.2,20.03);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,0.45,utf8_decode(' 5. PLAN TERAPEUTICO REALIZADO'),1,1,'L',true);
	
	$planterap=$solicitud->Consultar("SELECT plante_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(2.2,20.48);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,3.5,utf8_decode(''),1,1,'L',false);
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.3,20.52);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(16,0.4,utf8_decode("$planterap"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//6 plan educacional
	$this->SetXY(2.2,24.11);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,0.45,utf8_decode(' 6. PLAN EDUCACIONAL REALIZADO'),1,1,'L',true);
	
	$this->SetXY(2.2,24.56);
	$this->SetFont('Arial','b',8);
	$this->Cell(16.2,1.3,utf8_decode(''),1,1,'L',false);
	
	$planed=$solicitud->Consultar("SELECT planed_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetFillColor(300, 300, 300);
	$this->SetXY(2.3,24.58);
	$this->SetFont('Arial','b',7);
	$this->MultiCell(16,0.4,utf8_decode("$planed"),0,1,'L',false);
	
	$this->SetFillColor(192, 192, 192);
	
	//servicio
	$this->SetXY(2.2,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1,0.5,utf8_decode('SERVICIO'),1,1,'L',true);
	
	$serv=$solicitud->Consultar("SELECT serv_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(3.2,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(2,0.5,utf8_decode("$serv"),1,1,'L',false);
	
	//medico
	$this->SetXY(5.2,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1,0.5,utf8_decode('MÉDICO'),1,1,'L',true);
	
	$medic=$solicitud->Consultar("SELECT med_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(6.2,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(4.8,0.5,utf8_decode("$medic"),1,1,'L',false);
	
	//firma
	$this->SetXY(11,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1,0.5,utf8_decode('FIRMA'),1,1,'L',true);
	
	$this->SetXY(12,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(4.8,0.5,utf8_decode(''),1,1,'L',false);
	
	//codigo
	$codigo=$solicitud->Consultar("SELECT codmed_intsoli FROM tbl_solicitudinterconsulta WHERE id_pac='$idPac' ORDER BY id_intsoli DESC");
	
	$this->SetXY(16.8,26.04);
	$this->SetFont('Arial','b',5.3);
	$this->Cell(1.6,0.5,utf8_decode("$codigo"),1,1,'C',false);
	
	$this->SetXY(16.8,25.86);
	$this->SetFont('Arial','b',5.1);
	$this->Cell(1.6,0.2,utf8_decode('CÓDIGO'),0,1,'C',false);
	
	//PIE DE PAGINA
	$this->SetXY(2.2,26.64);
	$this->SetFont('Arial','b',8);
	$this->Cell(4.7,0.5,utf8_decode('SNS-MSP / HCU-form.007 / 2007'),0,1,'L',false);
	
	$this->SetXY(14.1,26.64);
	$this->SetFont('Arial','b',8);
	$this->Cell(5.2,0.5,utf8_decode('INTERCONSULTA - SOLICITUD'),0,1,'L',false);
	
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