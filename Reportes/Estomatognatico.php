<?php
require('fpdf/fpdf.php');
require('../Dominio/coneccion.php');
require('../Dominio/SisEstomatognatico.php');

class PDF extends FPDF
{
	//Cargar los datos
	function LoadData($cod)
	{
		$aux=new SisEstomatognatico;
		$datos=$aux->Consultar_SisEstomatognatico("SELECT * FROM tbl_sistestomatognatico WHERE id_tu='$cod'"); 
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
		

		  $this->Cell(32,9,$header[0],1);
		  $this->Cell(240,9,$header[1],1);
		  		  

		  
		 
		$this->Ln();
		
		//Datos
		foreach($data as $row)
		{
			$this->SetFillColor(130,125,103);
			$this->SetTextColor(0);
			$this->Cell(32,9,$row['id_sistestoma'],1);
			$this->Cell(240,9,$row['desc_sistestoma'],1);
			$this->Ln();
		}
	}
	function Header()
	{
		$Detalle =$_GET['Detalle'];
		$this->Cell(150,16,"Examen Estomatognático",0,'C', 0);
		$this->SetFont('Arial','B',22);
		$this->Ln(10);
		$this->Cell(100,300,"Detalle: $Detalle",0,'C', 0);
		$this->Ln(5);
		
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','B',14);
		$this->Cell(100,16,'Examen Estomatognático',0,0,'L');

	}

}
$cod= $_GET['id'];
$pdf=new PDF('L','mm','A4');
$header=array('Codigo','Descripcion De Exmamen');
$data=$pdf->LoadData($cod);
$pdf->SetFont('Arial','',20);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->Output();
?>