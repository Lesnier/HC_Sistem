<?php
require('fpdf/fpdf.php');
require('../Dominio/coneccion.php');
require('../Dominio/Medimagen.php');

class PDF extends FPDF
{
	//Cargar los datos
	function LoadData($cod)
	{
		$aux=new Medimagen;
		$datos=$aux->Consultar_Medimagen("SELECT * FROM tbl_medimagen WHERE id_tu='$cod'"); 
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
		

		  $this->Cell(25,7,$header[0],1);
		  $this->Cell(80,7,$header[1],1);		  		  

		  
		 
		$this->Ln();
		
		//Datos
		foreach($data as $row)
		{
			$this->SetFillColor(130,125,103);
			$this->SetTextColor(0);
			$this->Cell(25,6,$row['id_medimagen'],1);
			$this->Cell(80,6,$row['desc_medimagen'],1);
								

				
			$this->Ln();
		}
	}
	function Header()
	{
		$this->Cell(150,14,"MEDIMAGENES",0,'C', 0);			
		$this->Ln(10);		
		
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'MEDIMAGENES',0,0,'L');

	}

}
$cod= $_GET['id'];
$pdf=new PDF('L','mm','A4');
$header=array('CODIGO','DESCRIPCION DE EXAMEN');
$data=$pdf->LoadData($cod);
$pdf->SetFont('Arial','',16);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->Output();
?>
