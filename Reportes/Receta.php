<?php
require('fpdf/fpdf.php');
require('../Dominio/coneccion.php');
require('../Dominio/Consulta.php');

class PDF extends FPDF
{
	//Cargar los datos
	function LoadData($cod)
	{
		$aux=new Consulta;
		$datos=$aux->Consultar_Receta($cod); 
		return $datos;	
	}

	//Tabla simple
	function BasicTable($header,$data)
	{

		//Cabecera
		//foreach($header as $col)
		  //  $this->Cell(36,7,$col,1);
		   $this->SetFillColor(255,0,0);
		$this->SetTextColor(128,220,0);
		$this->SetDrawColor(28,0,250);
		

		  $this->Cell(20,7,$header[0],1);
		  $this->Cell(60,7,$header[1],1);
		  $this->Cell(150,7,$header[2],1);

		  
		 
		$this->Ln();
		
		//Datos
		foreach($data as $row)
		{
			$this->SetFillColor(130,125,103);
			$this->SetTextColor(0);
			$this->Cell(20,6,$row['descripcion_far'],1);
			$this->Cell(60,6,$row['cantidad'],1);
			$this->Cell(150,6,$row['indicaciones'],1);

				
			$this->Ln();
		}
	}
	function Header()
	{
				
		$this->SetFont('Arial','B',10);
		$this->Text(20,14,'Receta Medica',0,'C', 0);
		$this->Cell(50,14,' ',0,'C', 0);
		$this->Ln(10);
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'Receta Medica',0,0,'L');

	}

}
$cod= $_GET['id'];
$pdf=new PDF('L','mm','A4');
$header=array('Meidcamento','Cantidad','Indicaciones');
$data=$pdf->LoadData($cod);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->Output();
?>
