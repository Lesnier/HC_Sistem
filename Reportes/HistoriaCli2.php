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
		$datos=$aux->Consultar_Historia2($cod); 
		return $datos;	
	}

	//Tabla simple
	function BasicTable($header,$data)
	{

		//Cabecera
		//foreach($header as $col)
		  //  $this->Cell(36,7,$col,1);
		$this->SetFillColor(250,250,250);
		$this->SetTextColor(0,0,0);
		$this->SetDrawColor(250,250,250);
		

		 // $this->MultiCell(20,7,$header[0],1);
		 // $this->MultiCell(100,7,$header[1],1);
		//  $this->MultiCell(50,7,$header[2],1);
		//  $this->MultiCell(80,7,$header[3],1);
		 // $this->Cell(80,7,$header[4],1);		  		  

		  
		 
		$this->Ln();
		
		//Datos
		foreach($data as $row)
		{


			$this->MultiCell(400,6,utf8_decode("Fecha de consulta: ". $row['Fecha_Consulta']),1,'L');
			$this->MultiCell(400,6,utf8_decode("Diagnostico: ". $row['Diagnostico']),1,'L');
			$this->MultiCell(400,6,utf8_decode("Tratamiento: ".$row['Tratamiento']),1,'L');
			$this->MultiCell(400,6,utf8_decode("Medicamentos: ".$row['Medicamentos']),1,'L');
			//$this->Cell(80,6,$row['Tratientos'],1);
									

				
			$this->Ln();
		}
	}
	function Header()
	{
		
		$da=new Consulta;
		$cedula= $_GET['id'];
		$nombrePac=$da->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$cedula'");		
		$EdadPac=$da->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$cedula'");				
		$DirecPac=$da->Consultar("SELECT direccion_pac FROM tbl_paciente WHERE id_pac='$cedula'");						
		//$tipsaPac=$da->Consultar("SELECT telefono_pac FROM tbl_paciente WHERE cedula_pac='$cedula'");								
		//$AlerPac=$da->Consultar("SELECT alergias_pac FROM tbl_paciente WHERE cedula_pac='$cedula'");										
		//$FracPac=$da->Consultar("SELECT ocupacion_pac FROM tbl_paciente WHERE cedula_pac='$cedula'");										
		//$NomFaPac=$da->Consultar("SELECT nombresReferencia_pac FROM tbl_paciente WHERE cedula_pac='$cedula'");
		//$TeleFaPac=$da->Consultar("SELECT telefonoReferencia_pac FROM tbl_paciente WHERE cedula_pac='$cedula'");
		//$DirecFaPac=$da->Consultar("SELECT direccionFamAmCon_pac FROM tbl_paciente WHERE cedula_pac='$cedula'");
		$this->SetFont('Arial','B',10);
		
		
		$this->MultiCell(100,14,"Historia Clinica \t\t\t\t\t ",0,'L');
		//$this->MultiCell(50,14,'Unimed: ',1,'L');
		$this->Ln(1);		
		$this->MultiCell(200,14,"Nombres Paciente: $nombrePac  						\t\t\t\t\tFecha de nacimieto Paciente: $EdadPac",0,'L');
		$this->Ln(1);		
//		$this->MultiCell(200,14,"Edad Paciente: $EdadPac ",1,'L');				
//		$this->Ln(4);	
		
		//$textto="<p><pb>Historia Clinica </pb><pb>Unimed</pb></p>";	
		//$this->MultiCell(200,14,$textto,1,'L');
		$this->MultiCell(250,14,"Direccion Paciente: $DirecPac ",0,"L");			
		$this->Ln(1);		

	}

	function Footer()
	{
		$this->SetY(-15);
		$this->SetFont('Arial','B',8);
		$this->Cell(100,10,'Historia Clinica',0,0,'L');

	}

}
$cod= $_GET['id'];
$pdf=new PDF('L','mm','A4');
$header=array('Fecha C.','Diagnostico','Tratamiento','Medicamentos');
$data=$pdf->LoadData($cod);
$pdf->SetFont('Arial','',10);
$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->Output();
?>
