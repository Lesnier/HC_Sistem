<?php
require('fpdf/fpdf.php');
require('../Dominio/coneccion.php');
require('../Dominio/Usuario.php');
require('../Dominio/Consultas.php');
class PDF extends FPDF
{
	//funcion para definir la hora actual del ecuador
	public function Mifecha()
	{
		$timestamp=time();
		$diferenciahorasgmt = (date('Z', time()) / 3600 - (-5)) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
		$timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
		//$fecha1 = date("l jS \of F Y h:i:s A", $timestamp_ajuste); //mostramos la fecha/hora
		$fecha1 = date("y-m-d", $timestamp_ajuste);
		return $fecha1;		
	}
	//fin de al funcio para definir la hora actual del ecuador	
	
/*	function LoadData($cod)
	{
		$aux=new Consultas;
		$datos=$aux->Consultar_Consultas("SELECT * FROM tbl_consultas WHERE id_tu='$cod'"); 
		return $datos;	
	}


	//Tabla simple
	function BasicTable($header,$data)
	{


		


		$aux=new Usuario;
		$cons=new Consultas;
		$Otros1= $_GET['Otros1'];
		$aux1=strripos($Otros1,".");
		$cont=strlen($Otros1);
		$auxT2=substr($Otros1,0,$aux1);
		$auxT3=substr($Otros1,$aux1,$cont);
		//$nomDoc=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$user' AND estado_usu='A'");		
		//$this->SetFont('Arial','B',10);
		//$date=$this->Mifecha();
		//$this->Text(20,14,"$date",0,'C', 0);
		//$this->Cell(140,14,'CERTIFICADO ',0,'C', 0);
		//$this->Ln(10);
		$this->SetFont('Arial','B',10);
		$this->Cell(222,14,"$auxT2",0,'C', 0);
		$this->Ln(10);
		
	   	//$this->SetFillColor(255,0,0);
		$this->SetTextColor(128,220,0);
		$this->SetDrawColor(250,250,250);
		


		  $this->Cell(150,7,$header[0],1);
		  $this->Cell(100,7,$header[1],1);


		  
		 
		$this->Ln();
		
		//Datos
		foreach($data as $row)
		{
			$cie=$cons->Consultar("SELECT desc_diag FROM tbl_cie WHERE id_diag='$row[id_cie]'");
			$this->SetFillColor(130,125,103);
			$this->SetTextColor(0);
			$this->Cell(150,6,$cie,1);
			$this->Cell(100,6,$row['vademecun_cons'],1);
			$this->Ln();
		}
		$this->SetFont('Arial','B',10);
		$this->Cell(192,14,"$auxT3",0,'C', 0);
		$this->Ln(10);

		$this->Ln(10);		
	}
*/
/*
	
	function Header()
	{
		
	//		$aux4=utf8_decode("ción");		//codigo de ejemplo para colocar tildes
		//$aux=new Usuario;
		//session_start();
		//$user=$_SESSION['DOCTOR'];
		$Otros1= $_GET['Otros1'];
		$aux1=strripos($Otros1,".");
		$cont=strlen($Otros1);
		$auxT2=substr($Otros1,0,$aux1);
		$auxT3=substr($Otros1,$aux1,$cont);
			
		$this->SetFont('Arial','B',10);
		$date=$this->Mifecha();
		$this->Text(20,14,"$date",0,'C', 0);
		$this->Cell(140,14,'CERTIFICADO ',0,'C', 0);
		$this->Ln(10);
		//$this->Cell(222,14,"$auxT2",0,'C', 0);
		//$this->Ln(10);
		//$this->Cell(192,14,"$auxT3",0,'C', 0);
		//$this->Ln(10);
		//$this->Cell(150,14,"Medico: $nomDoc",0,'C', 0);
		//$this->Ln(10);
		//$this->Cell(550,14,"_______________________",0,'C', 0);
		$this->Ln(10);		
	}
*/
	function Header()
	{
		
	//		$aux4=utf8_decode("ción");		//codigo de ejemplo para colocar tildes
		$aux=new Usuario;
		$auxC= new Consultas;
		session_start();
		$user=$_SESSION['DOCTOR'];
		$Otros1= $_GET['Otros1'];
		$codTurn= $_GET['codTurn'];
		//$Turno= $_GET['Turno3'];
		$aux1=strripos($Otros1,".");
		$cont=strlen($Otros1);
		$auxT2=substr($Otros1,0,$aux1);
		$auxT3=substr($Otros1,$aux1,$cont);
		$cie10=$auxC->Consultar_Consultas("SELECT * FROM tbl_consultas WHERE id_tu='$codTurn'");
		$con1=NULL;
		foreach ($cie10 as $fila)
		{
			$con1=$auxC->Consultar("SELECT desc_diag FROM tbl_cie WHERE id_diag='$fila[id_cie]'")." , ".$con1;
		}
		$con1="hola";
		$nomDoc=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$user' AND estado_usu='A'");		
		$this->SetFont('Arial','B',10);
		$date=$this->Mifecha();
		$this->Text(20,14,"$date",0,'C', 0);
		$this->Cell(140,14,'CERTIFICADO ',0,'C', 0);
		$this->Ln(10);
		$this->Cell(230,14,"$auxT2",0,'C', 0);
		$this->Ln(10);
		$this->Cell(175,14,"$con1  $auxT3 ",0,'C', 0);
//		$this->Ln(10);
//		$this->Cell(230,14,"$codTurn",0,'C', 0);
		$this->Ln(10);
		$this->Ln(10);
		$this->Cell(150,14,"Medico: $nomDoc ",0,'C', 0);
		$this->Ln(10);
		$this->Cell(150,14,"_______________________",0,'C', 0);
		$this->Ln(10);		
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'CERTIFICADO DE CUIDADO',0,0,'L');

	}


}

$pdf=new PDF('L','mm','A4');
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->Output();
?>
