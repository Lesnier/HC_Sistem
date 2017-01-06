<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/AnamnesisCdu.php";
include "../Dominio/Turno.php";

class PDF extends FPDF
{
// Tabla simple
function BasicTable()
{
    
}

// Una tabla más completa
 function DiasF($Month,$Year){
		return date("d",mktime(0,0,0,$Month+1,0,$Year));
	}
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
    
	$tur=new Turno;
	$code=$_GET['code'];
	$mes=$_GET['mes'];

	$fi=date("y")."-".$mes."-01";
	$diasfin=$this->DiasF($mes,date("y"));
	$ff=date("y")."-".$mes."-$diasfin";
	
	$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$code' AND fechaC_tu>='$fi' AND fechaC_tu<='$ff' ORDER BY  id_hor ASC ;");
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
	$this->Cell(7.5,1,utf8_decode(''),0,1,'L',false);

	$this->SetXY(19,1);
	$this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);

	$this->SetXY(19.4,1);
	$this->Cell(0.8,1.8,utf8_decode(''),1,1,'L',true);
	
	$this->SetXY(2.2,3);
	$this->SetFont('Arial','b',16);
	$this->Cell(7.5,1,utf8_decode('Citas del medico por fechas'),0,1,'L',false);

	$this->SetXY(15,2);
	$this->SetFont('Arial','b',8);
	$this->Cell(7.5,1,utf8_decode('Sistema Nacional de Salud'),0,1,'L',false);
	    
	$this->Image('img/logo1.jpg',15.5,3,3);
	
	//Establecimiento 
	$this->SetXY(2.2,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(5,0.6,utf8_decode('PACIENTE'),1,1,'L',true);
	
	
	
	//Nombre
	$this->SetXY(7.2,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(5,0.6,utf8_decode('FECHA DE CONSULTA'),1,1,'C',true);
	
	
	
	//Apellido 
	$this->SetXY(12,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(4,0.6,utf8_decode('HORA'),1,1,'C',true); 
	
	
	//Sexo
	$this->SetXY(16,4.3);
	$this->SetFont('Arial','b',10);
	$this->Cell(4,0.6,utf8_decode('Estado'),1,1,'C',true);
	
	$x=0;
	$estado="";
	foreach ($datos as $c) {
		
		$paciente=$tur->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
		$hora=$tur->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$c[id_hor]';");

		switch ($c["estado_tur"]) {
				case 'AE':
					 $estado="Agendada";
					break;
				case 'E':
					 $estado="Cancelada";
					break;
				case 'RM':
					 $estado="Completada";
					break;
				
				
			}

		$this->SetXY(2.2,(4.9+$x) );
		$this->SetFont('Arial','b',7);
		$this->Cell(5,0.6,utf8_decode("$paciente"),1,1,'C',false);

		$this->SetXY(7.2,(4.9+$x));
		$this->SetFont('Arial','b',7);
		$this->Cell(4.8,0.6,utf8_decode("$c[fechaC_tu]"),1,1,'C',false);
		
		//Apellido 
		$this->SetXY(12,(4.9+$x));
		$this->SetFont('Arial','b',7);
		$this->Cell(4,0.6,utf8_decode("$hora"),1,1,'C',false); 
		
		
		//Sexo
		$this->SetXY(16,(4.9+$x));
		$this->SetFont('Arial','b',7);
		$this->Cell(4,0.6,utf8_decode("$estado"),1,1,'C',false);

		$x=$x+0.6;

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