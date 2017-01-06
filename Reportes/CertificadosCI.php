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
	//fin de al funcio para definir la hora actual del ecuador	
	function Header()
	{
		
		$aux=new Usuario;
		$Otros1= $_GET['Otros1'];
		$Otros2= $_GET['Otros2'];
		$Otros3= $_GET['Otros3'];
		$Otros4= $_GET['Otros4'];
		$Otros5= $_GET['Otros5'];
		$Otros6= $_GET['Otros6'];
		$HistPac= $_GET['HistPac'];
		
		$aux4=utf8_decode($Otros1);
		$aux5=utf8_decode($Otros2);
		$aux6=utf8_decode($Otros3);
		$aux7=utf8_decode($Otros4);
		$aux8=utf8_decode($Otros5);
		$aux10=utf8_decode("Diagnóstico: ");
		$aux9=utf8_decode("Todo procedimiento médico no esta exento de riesgo. Autorizo a mi médico u otro especialista para realizar los procedimientos necesarios");
		$aux11=utf8_decode("o interconsultas si las circunstancias lo ameritan, asi como la toma de fotos y la filiación con fines docentes.");
		session_start();
		$user=$_SESSION['DOCTOR'];
		
		$aux1=strripos($Otros1,".");
		$cont=strlen($Otros1);
		$auxT2=substr($Otros1,0,$aux1);
		$auxT3=substr($Otros1,$aux1,$cont);
		$nomDoc=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$user' AND estado_usu='A'");		
		$this->SetFont('Arial','B',10);
		$date=$this->Mifecha();
		$this->Text(20,14,"$date",0,'C', 0);
		$this->Cell(140,14,'CERTIFICADO ',0,'C', 0);
		$this->Ln(15);
		$this->Cell(122,14,"Nombre del Paciente: $aux4",0,'C', 0);
		$this->Cell(150,14,"Historia del Paciente: $HistPac",0,'C', 0);
		$this->Ln(10);
		$this->Cell(45,14,"$aux10 $aux5",0,'C', 0);
		$this->Ln(10);
		$this->Cell(66,14,"Tratamiento Planificado: $aux6",0,'C', 0);
		$this->Ln(10);
		$this->Cell(71,14,"Beneficios del Tratamiento: $aux7",0,'C', 0);
		$this->Ln(10);
		$this->Cell(40,14,"Riesgos: $aux8",0,'C', 0);
		$this->Ln(15);
		$this->Cell(255,14,"$aux9",0,'C', 0);
		$this->Ln(10);
		$this->Cell(230,14,"$aux11",0,'C', 0);
		$this->Ln(30);
		$this->Cell(50,14,"Quito: $date",0,'C', 0);
		$this->Cell(205,14,"Firma del Familiar Responsable o Representante: _______________________________",0,'C', 0);
		$this->Ln(10);
		$this->Cell(222,14,"$auxT2",0,'C', 0);
		$this->Ln(10);
		//$this->Cell(192,14,"$auxT3",0,'C', 0);
		$this->Ln(10);
		$this->Cell(127,14,"Medico: $nomDoc _______________________________",0,'C', 0);
		$this->Cell(120,14,"Firma del Testigo: _______________________________",0,'C', 0);
				
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'CERTIFICADO DE CONSENTIMIENTO INFORMADO',0,0,'L');

	}

}
$pdf=new PDF('L','mm','A4');
$header=array('Meidcamento','Cantidad','Indicaciones');
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->Output();
?>
