<?php
require('fpdf/fpdf.php');
require('../Dominio/coneccion.php');
require('../Dominio/Usuario.php');
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
	public function MiHora()
	{
		$timestamp=time();
		$diferenciahorasgmt = (date('Z', time()) / 3600 - (-5)) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
		$timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
		//$fecha1 = date("l jS \of F Y h:i:s A", $timestamp_ajuste); //mostramos la fecha/hora
		$fecha1 = date("h:i:s", $timestamp_ajuste);
		return $fecha1;		
	}
	//fin de al funcio para definir la hora actual del ecuador	
	function Header()
	{
		
	//		$aux4=utf8_decode("ción");		//codigo de ejemplo para colocar tildes
		$aux=new Usuario;
		session_start();
		$user=$_SESSION['DOCTOR'];
		$otros2= $_GET['otros2'];
		$otros3= $_GET['otros3'];
		$aux1=strripos($otros2,".");
		$cont=strlen($otros2);
		$hora=$this->MiHora();
		$auxT2=substr($otros2,0,$aux1);
		$auxT3=substr($otros2,$aux1,$cont);
		$nomDoc=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$user' AND estado_usu='A'");		
		$this->SetFont('Arial','B',10);
		$date=$this->Mifecha();
		$this->Text(20,14,"$date",0,'C', 0);
		$this->Cell(140,14,'CERTIFICADO ',0,'C', 0);
		$this->Ln(10);
		$this->Cell(222,14,"$auxT2",0,'C', 0);
		$this->Ln(10);
		$this->Cell(192,14,"$auxT3 $hora  $otros3",0,'C', 0);
		$this->Ln(10);
		$this->Cell(150,14,"Medico: $nomDoc",0,'C', 0);
		$this->Ln(10);
		$this->Cell(150,14,"_______________________",0,'C', 0);
		$this->Ln(10);		
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'CERTIFICADO DE ASISTECIA',0,0,'L');

	}

}
$pdf=new PDF('L','mm','A4');
$header=array('Meidcamento','Cantidad','Indicaciones');
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->Output();
?>
