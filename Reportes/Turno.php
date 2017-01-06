<?php
require('fpdf/fpdf.php');
require('../Dominio/coneccion.php');
require('../Dominio/Consultas.php');

class PDF extends FPDF
{
function Header()
{
	global $title;

	$this->SetFont('Arial','B',15);
	$w=$this->GetStringWidth($title)+6;
	$this->SetX((210-$w)/2);
	
	$this->Cell($w,9,$title,0,1,'C',false);
	
	$this->Ln(10);
}

function Footer()
{
	//Posición a 1,5 cm del final
	$this->SetY(-15);
	//Arial itálica 8
	$this->SetFont('Arial','I',8);
	//Color del texto en gris
	$this->SetTextColor(128);
	//Número de página
	$this->Cell(0,10,'Página '.$this->PageNo(),0,0,'C');
	//$this->Image('img/logo1.jpg',150,8,50);
}

function ChapterTitle()
{
	$aux=new Consultas;
	$cod= $_GET['id'];				
	$this->SetFont('Arial','',12);
	
	$this->Ln(4);
	$turno=$aux->Consultar("SELECT tu.numero_tur  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");
	$FechaRe=$aux->Consultar("SELECT tu.fechaR_tu  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");
	$FechaCo=$aux->Consultar("SELECT tu.fechaC_tu  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");
	$Servicio=$aux->Consultar("SELECT es.descripcion_esp  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");
	$Doctor=$aux->Consultar("SELECT us.nombresCom_usu  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");
	$Historia=$aux->Consultar("SELECT pac.id_pac  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");
	$Paciente=$aux->Consultar("SELECT pac.nombresCom_pac  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");
	$Cedula=$aux->Consultar("SELECT pac.cedula_pac  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");
	$Hora=$aux->Consultar("SELECT h.hora_hor  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es, tbl_hora h  WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu AND h.id_hor=tu.id_hor");

	$telefono_pac=$aux->Consultar("SELECT pac.telefono_pac  FROM tbl_turno tu, tbl_usuario us, tbl_paciente pac,tbl_especialida es WHERE tu.id_tu='$cod' AND tu.id_pac=pac.id_pac AND es.id_esp=us.id_esp AND tu.id_usu=us.id_usu");

/*
	$this->Cell(0,6,utf8_decode("Número del Turno: $turno"),0,1,'L',false);
	$this->Ln(4);
	$this->Cell(0,6,utf8_decode("Fecha de reservación: $FechaRe"),0,1,'L',false);
	$this->Ln(4);
	$this->Cell(0,6,utf8_decode("Hora de la consulta: $Hora"),0,1,'L',false);
	$this->Ln(4);
	$this->Cell(0,6,"Fecha de consulta: $FechaCo",0,1,'L',false);
	$this->Ln(4);
	$this->Cell(0,6,"Servicio: $Servicio",0,1,'L',false);
	$this->Ln(4);
	$this->Cell(0,6,"Doctor: $Doctor",0,1,'L',false);
	$this->Ln(4);
	$this->Cell(0,6,"# De Historia: $Cedula",0,1,'L',false);
	$this->Ln(4);
	$this->Cell(0,6,"Paciente: $Paciente",0,1,'L',false);	
	//Salto de línea
	$this->Ln(4);*/

	$this->SetXY(1,1);
	$this->SetFont('Arial','b',12);
	$this->Cell(19,0.5,utf8_decode("Turno"),0,1,'C',false);

	$this->Image('img/logo1.jpg',1,1,3);

	$this->SetFont('Arial','b',7);

	$this->SetXY(1,2.5);
	$this->Cell(19,0.5,utf8_decode("Turno Nº $turno"),1,1,'C',false);

	$this->SetXY(1,3);
	$this->Cell(3,0.5,utf8_decode("Fecha Consulta: "),1,1,'C',false);

	$this->SetXY(4,3);
	$this->Cell(3,0.5,utf8_decode(" $FechaCo"),1,1,'C',false);

	$this->SetXY(7,3);
	$this->Cell(3,0.5,utf8_decode("Hora: "),1,1,'C',false);

	$this->SetXY(10,3);
	$this->Cell(3,0.5,utf8_decode("$Hora "),1,1,'C',false);

	$this->SetXY(13,3);
	$this->Cell(3,0.5,utf8_decode("Fecha Reserva: "),1,1,'C',false);

	$this->SetXY(16,3);
	$this->Cell(4,0.5,utf8_decode("$FechaRe"),1,1,'C',false);



	$this->SetXY(1,3.5);
	$this->Cell(19,0.5,utf8_decode("Asistir 30 minutos antes de la cita medica"),1,1,'C',false);



	$this->SetXY(1,4.5);
	$this->Cell(19,0.5,utf8_decode("Infomracion Paciente"),1,1,'C',false);

	$this->SetXY(1,5);
	$this->Cell(3,0.5,utf8_decode("# De Historia: "),1,1,'C',false);

	$this->SetXY(4,5);
	$this->Cell(3,0.5,utf8_decode("$Cedula"),1,1,'C',false);


	$this->SetXY(7,5);
	$this->Cell(3,0.5,utf8_decode("Paciente: "),1,1,'C',false);

	$this->SetXY(10,5);
	$this->Cell(10,0.5,utf8_decode("$Paciente"),1,1,'C',false);



	$this->SetXY(1,5.5);
	$this->Cell(3,0.5,utf8_decode("Servicio: "),1,1,'C',false);

	$this->SetXY(4,5.5);
	$this->Cell(3,0.5,utf8_decode("$Servicio"),1,1,'C',false);


	$this->SetXY(7,5.5);
	$this->Cell(3,0.5,utf8_decode("Medico: "),1,1,'C',false);

	$this->SetXY(10,5.5);
	$this->Cell(10,0.5,utf8_decode("$Doctor"),1,1,'C',false);


	$this->SetFont('Arial','b',6);
	$this->SetXY(1,6.5);
	$this->SetFillColor(300, 300, 300);
	$this->MultiCell(19,0.5,utf8_decode("Nota: Recuerde que las autorizaciones tienen una valides de un mes, usted debe solicitar a los funcionarios de la clínica los documentos para renovar si su autorización esta próxima a caducarse.\nEl plazo para retirar sus medicinas es de máximo 48 horas hábiles sin excepción."),0,1,'C',false);





	//$this->SetXY(115,35);
	//$this->Cell(0.75,0.5,utf8_decode("Telefono paciente: $telefono_pac"),0,1,'L',false);
}



}
$cod= $_GET['id'];				
//$pdf=new PDF();
$pdf = new PDF("P","cm","A4");
$title='Turno';
$pdf->SetTitle($title);
$pdf->AddPage();
$pdf->ChapterTitle();


$pdf->Output();
?>
