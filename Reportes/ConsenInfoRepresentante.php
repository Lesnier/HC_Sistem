<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/ConsenRep.php";

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
    $this->SetFillColor(148, 110, 140);
    $this->SetTextColor(0,0,0);
    $this->SetDrawColor(57, 115, 91);
    $this->SetLineWidth(1);
    $this->SetFont('Times','b',12);
    // Cabecera
    $w = array(40, 35, 45, 40);
    
	$conrep=new ConsenRep;
	$id=$_GET['id'];
    // Línea de cierre
    $this->MultiCell(191,7,utf8_decode("Consentimiento Informado del Representante Legal"),1,1,"L");
	$this->Ln();
	
	$this->SetFillColor(57,115,140);
	$this->SetDrawColor(57,115,91);
	$this->SetFont('Times','b',12);
	$this->SetXY(10,17);
	$this->MultiCell(191,7,utf8_decode("Como responsable legal del paciente que ha sido considerado por ahora imposibilitado para decidir en forma autónoma su consentimiento, autorizo la realización del tratamiento segun la información entregada por los profesionales de la salud en este documento. "),1,1,"L");
	$this->Ln();
	
	$nombrer=$conrep->Consultar("SELECT nrep_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetFillColor(250,250,250);
	$this->SetDrawColor(250,250,250);
	$this->SetFont('Times','b',12);
	$this->SetXY(10,42);
	$this->MultiCell(191,7,utf8_decode("Nombre del Representante Legal: $nombrer"),1,1,"L");
	$this->Ln();
	
	$pare=$conrep->Consultar("SELECT pare_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,51);
	$this->MultiCell(191,7,utf8_decode("Parentesco: $pare"),1,1,"L");
	$this->Ln();
	
	$telef=$conrep->Consultar("SELECT tel_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,60);
	$this->MultiCell(191,7,utf8_decode("Teléfono: $telef"),1,1,"L");
	$this->Ln();
	
	$ced=$conrep->Consultar("SELECT ced_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,69);
	$this->MultiCell(191,7,utf8_decode("Cédula: $ced"),1,1,"L");
	$this->Ln();
	
	$instsis=$conrep->Consultar("SELECT insts_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,78);
	$this->MultiCell(191,7,utf8_decode("Intitución del Sistema: $instsis"),1,1,"L");
	$this->Ln();
	
	$uniope=$conrep->Consultar("SELECT unip_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,87);
	$this->MultiCell(191,7,utf8_decode("Unidad Operativa: $uniope"),1,1,"L");
	$this->Ln();
	
	$coduo=$conrep->Consultar("SELECT codu_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,96);
	$this->MultiCell(191,7,utf8_decode("COD. UO: $coduo"),1,1,"L");
	$this->Ln();
	
	$parroq=$conrep->Consultar("SELECT parr_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,105);
	$this->MultiCell(191,7,utf8_decode("Parroquia: $parroq"),1,1,"L");
	$this->Ln();
	
	$cant=$conrep->Consultar("SELECT can_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,114);
	$this->MultiCell(191,7,utf8_decode("Cantón: $cant"),1,1,"L");
	$this->Ln();
	
	$prov=$conrep->Consultar("SELECT pro_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,123);
	$this->MultiCell(191,7,utf8_decode("Provincia: $prov"),1,1,"L");
	$this->Ln();
	
	$nhistoria=$conrep->Consultar("SELECT nuh_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,132);
	$this->MultiCell(191,7,utf8_decode("Número de Historia Clínica: $nhistoria"),1,1,"L");
	$this->Ln();
	
	$appaterno=$conrep->Consultar("SELECT app_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,141);
	$this->MultiCell(191,7,utf8_decode("Apellido Paterno: $appaterno"),1,1,"L");
	$this->Ln();
	
	$apmaterno=$conrep->Consultar("SELECT apm_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,150);
	$this->MultiCell(191,7,utf8_decode("Apellido Materno: $apmaterno"),1,1,"L");
	$this->Ln();
	
	$nombrecomp=$conrep->Consultar("SELECT nom_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,159);
	$this->MultiCell(191,7,utf8_decode("Nombres: $nombrecomp"),1,1,"L");
	$this->Ln();
	
	$serv=$conrep->Consultar("SELECT ser_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,168);
	$this->MultiCell(191,7,utf8_decode("Servicio: $serv"),1,1,"L");
	$this->Ln();
	
	$sala=$conrep->Consultar("SELECT sal_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,177);
	$this->MultiCell(191,7,utf8_decode("Sala: $sala"),1,1,"L");
	$this->Ln();
	
	$cama=$conrep->Consultar("SELECT cam_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,186);
	$this->MultiCell(191,7,utf8_decode("Cama: $cama"),1,1,"L");
	$this->Ln();
	
	$fecha=$conrep->Consultar("SELECT fech_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,195);
	$this->MultiCell(191,7,utf8_decode("Fecha: $fecha"),1,1,"L");
	$this->Ln();
	
	$hora=$conrep->Consultar("SELECT hor_cir FROM tbl_consenrepresentante WHERE id_tu='$id'");
	$this->SetXY(10,204);
	$this->MultiCell(191,7,utf8_decode("Hora: $hora"),1,1,"L");
	$this->Ln();
	
	$this->SetXY(70,252);
	$this->MultiCell(191,7,utf8_decode("_____________________________________"),1,1,"L");
	$this->Ln();
	
	$this->SetXY(100,260);
	$this->MultiCell(191,7,utf8_decode("Firma"),1,1,"L");
	$this->Ln();
	
	// Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(148, 110, 140);
    $this->SetTextColor(0,0,0);
    $this->SetDrawColor(57, 115, 91);
    $this->SetLineWidth(1);
    $this->SetFont('Times','b',12);
    // Cabecera
    $w = array(40, 35, 45, 40);
    
    // Línea de cierre
    $this->MultiCell(190,7,utf8_decode("Consentimiento Informado del Paciente"),1,1,"L");
	$this->Ln();
	
	$this->SetFillColor(250,250,250);
	$this->SetDrawColor(250,250,250);
	$this->SetFont('Times','b',8);
	$this->MultiCell(190,7,utf8_decode("Firmas del paciente"),1,0,"L");
	$this->Ln();
	
	$this->SetFillColor(57,115,140);
	$this->SetDrawColor(57,115,91);
	$this->SetFont('Times','b',12);
	$this->SetXY(10,38);
	$this->MultiCell(140,7,utf8_decode("A. El profesional tratante me ha informado satisfactoriamente a cerca de los motivos y propósitos del tratamiento planificado para mi enfermedad"),1,1,"L");
	$this->SetDrawColor(57,115,91);
	$this->SetXY(155,38);
	$this->Cell(45,32,utf8_decode(""),1,1,"L");
	$this->Ln();
	
	$this->SetXY(10,56);
	$this->MultiCell(140,7,utf8_decode("B. El profesional tratante me ha explicado adecuadamente las actividades esenciales que se realizarán durante el tratamiento de mi enfermedad"),1,1,"L");
	$this->Ln();
	
	$this->SetXY(10,77);
	$this->MultiCell(140,7,utf8_decode("C. Consiento a que se realicen las intervenciones quirúrgicas, procedimientos diagnósticos y tratamientos necesarios para mi enfermedad"),1,1,"L");
	$this->SetDrawColor(57,115,91);
	$this->SetXY(155,77);
	$this->Cell(45,25,utf8_decode(""),1,1,"L");
	$this->Ln();
	
	$this->SetXY(10,95);
	$this->MultiCell(140,7,utf8_decode("D. Consiento a que me administren la anestesia propuesta"),1,1,"L");
	$this->Ln();
	
	$this->MultiCell(140,7,utf8_decode("E. He entendido bien que existe garantía de la calidad de los medios utilizados para el tratamiento, pero no acerca de los resultados"),1,1,"L");
	$this->SetDrawColor(57,115,91);
	$this->SetXY(155,109);
	$this->Cell(45,33,utf8_decode(""),1,1,"L");
	$this->Ln();
	
	$this->SetXY(10,128);
	$this->MultiCell(140,7,utf8_decode("F. He comprendido plenamente los beneficios y los riesgos de complicaciones derivadas del tratamiento"),1,1,"L");
	$this->Ln();
	
	$this->MultiCell(140,7,utf8_decode("G. El profesional tratante me ha informando que existe garantía de respeto a mi intimidad, mis creencias religiosas y a la confidencialidad de la información (inclusive en el caso de vih/sida)"),1,1,"L");
	$this->SetDrawColor(57,115,91);
	$this->SetXY(155,149);
	$this->Cell(45,71,utf8_decode(""),1,1,"L");
	$this->Ln();
	
	$this->SetXY(10,174);
	$this->MultiCell(140,7,utf8_decode("H. He compredido que tengo el derecho de anular este consentimiento informado en el momento que yo lo considere necesario"),1,1,"L");
	$this->Ln();
	
	$this->SetXY(10,192);
	$this->MultiCell(140,7,utf8_decode("I. Declaro que he entregado al profesional tratante informacion completa y fidedigna sobre los antecedentes personales y familiares de mi estado de salud, estoy conciente de que mis omisiones o distorsiones deliberadas de los hechos pueden afectar los resultados del tratamiento"),1,1,"L");
	$this->Ln();
	
	
}
}

$pdf = new PDF("P");
// Títulos de las columnas
$header = array('País', 'Capital', 'Superficie (km2)', 'Pobl. (en miles)');
// Carga de datos

$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->FancyTable();
$pdf->Output();
?>