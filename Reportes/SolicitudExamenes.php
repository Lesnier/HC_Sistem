<?php
require('fpdf/fpdf.php');
require('../Dominio/coneccion.php');
require('../Dominio/Examen.php');

class PDF extends FPDF
{
	//Cargar los datos
	function LoadData($cod)
	{
		$aux=new Examen;
		$datos=$aux->Consultar_Examen("SELECT * FROM tbl_examen WHERE id_tu='$cod'"); 
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
		

		  $this->Cell(240,9,$header[1],1);
		  		  

		  
		 
		$this->Ln();
		
		//Datos
		foreach($data as $row)
		{
			$this->SetFillColor(130,125,103);
			$this->SetTextColor(0);
			
			$this->Cell(240,9,$row['desc_exa'],1);
			
			if($row['otrosori_exa']!="")
			{
				$this->Ln();
				$this->Cell(240,9,"Otros Orina: ".$row['otrosori_exa'],1);
			}
			if($row['estliq_exa']!="")
			{
				$this->Ln();
				$this->Cell(240,9,"Estudio Líquidos: ".$row['estliq_exa'],1);
			}
			if($row['muestra_exa']!="")
			{
				$this->Ln();
				$this->Cell(240,9,"Muestra de: ".$row['muestra_exa'],1);
			}
			if($row['diasno_exa']!="")
			{
				$this->Ln();
				$this->Cell(240,9,"Días no: ".$row['diasno_exa'],1);
			}
			if($row['otroselec_exa']!="")
			{
				$this->Ln();
				$this->Cell(240,9,"Otros Electrolitos: ".$row['otroselec_exa'],1);
			}
			
			$this->Ln();
		}
	}
	function Header()
	{
		$this->Cell(100,16,"Solicitud de examnes",0,'C', 0);
		$this->SetFont('Arial','B',22);
		$this->Ln(15);
	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','B',14);
		$this->Cell(100,16,'Solicitud de examnes',0,0,'L');

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
