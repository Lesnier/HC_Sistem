<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/AnamnesisCdu.php";
include "../Dominio/ProtocoloOperatorio.php";

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
	    /*$this->SetFillColor(148, 110, 140);
	    $this->SetTextColor(0,0,0);
	    $this->SetDrawColor(57, 115, 91);
	    $this->SetLineWidth(1);
	    $this->SetFont('Times','b',12); */
	    // Cabecera
	    $w = array(40, 35, 45, 40);
	    
		$anam=new ProtocoloOperatorio;
		$code=$_GET['code'];


		function br2nl($string)
		{
		    return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
		}

		$SERVICIO=$anam->Consultar("SELECT servicio_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$IDCIR=$anam->Consultar("SELECT id_cir FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$NOMBREPACIENTE=$anam->Consultar("SELECT p.nombresCom_pac FROM tbl_citacirugia c, tbl_paciente p WHERE c.id_cir='$IDCIR' AND c.id_pac=p.id_pac;");
		$CIPACIENTE=$anam->Consultar("SELECT p.cedula_pac FROM tbl_citacirugia c, tbl_paciente p WHERE c.id_cir='$IDCIR' AND c.id_pac=p.id_pac;");
		
		$PREOPERATORIO=$anam->Consultar("SELECT preop_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$PREOPERATORIO2=$anam->Consultar("SELECT preop2_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$PREOPERATORIO3=$anam->Consultar("SELECT preop3_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		
		$POSTOPERATORIO=$anam->Consultar("SELECT postoperatorio_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$POSTOPERATORIO2=$anam->Consultar("SELECT postop2_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$POSTOPERATORIO3=$anam->Consultar("SELECT postop3_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");

		$IDIESS=$anam->Consultar("SELECT cirugiaefectuada_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$CIRUGIAEFECTUADA=$anam->Consultar("SELECT CONCAT(codigo_ciess,' ',descripcion_ciess) FROM tbl_codigoiess WHERE id_ciess='$IDIESS';");

		$CIRUGIAEFECTUADA2=$anam->Consultar("SELECT cirugiaefc2_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$CIRUGIAEFECTUADA3=$anam->Consultar("SELECT cirugiaefc3_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");

		$IDCIRUJANO=$anam->Consultar("SELECT cirujano_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$CIRUJANO=$anam->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$IDCIRUJANO';");
		$IDANESTESIOLOGO=$anam->Consultar("SELECT anestesiologo_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$ANESTESIOLOGO=$anam->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$IDANESTESIOLOGO';");
		$IDCOOCIRUJANO=$anam->Consultar("SELECT coocirujano_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$COOCIRUJANO=$anam->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$IDCOOCIRUJANO';");
		$INSTRUMENTISTA=$anam->Consultar("SELECT instrumentista_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$IDPRIMERAYUDANTE=$anam->Consultar("SELECT priayudante_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$PRIMERAYUDANTE=$anam->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$IDPRIMERAYUDANTE';");
		$CIRCULANTE=$anam->Consultar("SELECT circulante_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$IDSEGUNDOAYUDANTE=$anam->Consultar("SELECT segayudante_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$SEGUNDOAYUDANTE=$anam->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$IDSEGUNDOAYUDANTE';");
		$DATECIRUGIA=$anam->Consultar("SELECT datecirugia_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$IDHORA=$anam->Consultar("SELECT horainicio_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$HORA=$anam->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$IDHORA';");

		$IDCIRUJANO3=$anam->Consultar("SELECT cirujano3_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$CIRUJANO3=$anam->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$IDCIRUJANO3';");
		
		$IDHORA2=$anam->Consultar("SELECT horafin_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$HORA2=$anam->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$IDHORA2';");

		$TIPOANESTECIA=$anam->Consultar("SELECT tipanestesiologo_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$ETIEMPOQUIRURGICO=$anam->Consultar("SELECT etiempoquirugico_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$HALLAZGOS=$anam->Consultar("SELECT hallazgos_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$PROCEDIMIENTO=$anam->Consultar("SELECT procedimientos_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$IDPREPARADOPOR=$anam->Consultar("SELECT preparadopor_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$PREPARADOPOR=$anam->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$IDPREPARADOPOR';");
		$FECHA2=$anam->Consultar("SELECT date2_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$FECHA3=$anam->Consultar("SELECT date3_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");

		$IDAPROBADOPOR=$anam->Consultar("SELECT aprobadopor_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");

		$COMPLICACCIONES=$anam->Consultar("SELECT complicaciones_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$SANGRADO=$anam->Consultar("SELECT sangrado_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");
		$HISTOPATOLOGIA=$anam->Consultar("SELECT histopatologia_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");

		$ECOGRAFISTA=$anam->Consultar("SELECT ecografista_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");

		//$id=$_GET['id'];
		
		// Colores, ancho de línea y fuente en negrita
	    $this->SetFillColor(192, 192, 192);
		$this->SetTextColor(0,0,0);
	    //$this->SetFont('Times','b',12);
	    // Cabecera
	    $w = array(40, 35, 45, 40);
	    
	    
		
		    
		
		

		$this->SetXY(2,2);
		$this->SetFont('Arial','b',10);
		$this->Cell(5,3,utf8_decode('PROTOCOLO OPERATORIO'),1,1,'C',true);



		$this->SetXY(7,2);
		$this->SetFont('Arial','b',8);
		$this->Cell(6,1,utf8_decode('DPTO. ENDOSCOPIA ANESTESIOLOGIA'),1,1,'C',true);

		

		$this->SetXY(7,3);
		$this->SetFont('Arial','b',10);
		$this->Cell(6,2,utf8_decode("$SERVICIO"),1,1,'C',false);
		
		
		$this->SetXY(13,2);
		$this->SetFont('Arial','b',8);
		$this->Cell(6,3,utf8_decode(""),1,1,'C',false);
		$this->Image('img/logo1.jpg',13.5,2.5,5);


		$this->SetXY(2,5);
		$this->SetFont('Arial','b',8);
		$this->Cell(12,0.5,utf8_decode("NOMBRE: $NOMBREPACIENTE"),1,1,'L',false);

		$this->SetXY(14,5);
		$this->SetFont('Arial','b',8);
		$this->Cell(5,0.5,utf8_decode("HCL: $CIPACIENTE"),1,1,'L',false);
		
		
		$this->SetXY(2,5.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(17,0.5,utf8_decode("A. DIAGNOSTICO"),1,1,'C',true);
		
		$this->SetXY(2,6);
		$this->SetFont('Arial','b',8);
		$this->Cell(4,1.4,utf8_decode("PRE-OPERATORIO"),1,1,'L',true);

		//Linea pre-operatorio
		$this->SetXY(6,6);
		$this->SetFont('Arial','b',8);
		$this->Cell(13,1.4,utf8_decode(""),1,1,'L',false);

		$this->SetXY(6,5.8);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$PREOPERATORIO"),0,1,'L',false);

		$this->SetXY(6,6.2);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$PREOPERATORIO2"),0,1,'L',false);

		$this->SetXY(6,6.6);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$PREOPERATORIO3"),0,1,'L',false);


		$this->SetXY(2,7.4);
		$this->SetFont('Arial','b',8);
		$this->Cell(4,1.4,utf8_decode("POST-OPERATORIO"),1,1,'L',true);

		$this->SetXY(6,7.4);
		$this->SetFont('Arial','b',8);
		$this->Cell(13,1.4,utf8_decode(""),1,1,'L',false);

		$this->SetXY(6,7.2);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$POSTOPERATORIO"),0,1,'L',false);

		$this->SetXY(6,7.6);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$POSTOPERATORIO2"),0,1,'L',false);

		$this->SetXY(6,8);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$POSTOPERATORIO3"),0,1,'L',false);


		$this->SetXY(2,8.8);
		$this->SetFont('Arial','b',8);
		$this->Cell(4,1.4,utf8_decode("CIRUGIA EFECTUADA"),1,1,'L',true);

		$this->SetXY(6,8.8);
		$this->SetFont('Arial','b',8);
		$this->Cell(13,1.4,utf8_decode(""),1,1,'L',false);

		$this->SetXY(6,8.6);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$CIRUGIAEFECTUADA"),0,1,'L',false);

		$this->SetXY(6,9);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$CIRUGIAEFECTUADA2"),0,1,'L',false);

		$this->SetXY(6,9.4);
		$this->SetFont('Arial','b',7);
		$this->Cell(13,1,utf8_decode("$CIRUGIAEFECTUADA3"),0,1,'L',false);

		$this->SetXY(2,10.2);
		$this->SetFont('Arial','b',8);
		$this->Cell(17,0.5,utf8_decode("B. EQUIPO OPERATORIO"),1,1,'C',true);



		$this->SetXY(2,10.7);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("1er CIRUJANO: $CIRUJANO "),1,1,'L',false);

		$this->SetXY(10.5,10.7);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("ANESTESIOLOGO: $ANESTESIOLOGO"),1,1,'L',false);


		$this->SetXY(2,11.2);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("2do CIRUJANO: $COOCIRUJANO"),1,1,'L',false);

		$this->SetXY(10.5,11.2);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("INSTRUMENTISTA: $INSTRUMENTISTA"),1,1,'L',false);

		$this->SetXY(2,11.7);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("3er CIRUJANO: $CIRUJANO3"),1,1,'L',false);

		$this->SetXY(2,12.2);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("PRIMER AYUDANTE: $PRIMERAYUDANTE"),1,1,'L',false);

		$this->SetXY(10.5,11.7);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("CIRCULANTE: $CIRCULANTE"),1,1,'L',false);

		$this->SetXY(2,12.7);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("SEGUNDO AYUDANTE: $SEGUNDOAYUDANTE"),1,1,'L',false);


		$this->SetXY(10.5,12.2);
		$this->SetFont('Arial','b',6);
		$this->Cell(8.5,0.5,utf8_decode("ECOGRAFISTA: $ECOGRAFISTA"),1,1,'L',false);



		$this->SetXY(10.5,12.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(8.5,0.5,utf8_decode(""),1,1,'L',false);

		// $this->SetXY(2,12.87);
		// $this->SetFont('Arial','b',8);
		// $this->Cell(17,0.25,utf8_decode(" "),1,1,'L',false);

		$this->SetXY(2,13.2);
		$this->SetFont('Arial','b',8);
		$this->Cell(7.5,0.5,utf8_decode("C. FECHA DE CIRUGIA"),1,1,'C',true);


		$this->SetXY(2,13.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(3.75,0.5,utf8_decode("$DATECIRUGIA"),1,1,'C',false);

		$this->SetXY(5.75,13.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(3.75,0.5,utf8_decode("$HORA   $HORA2"),1,1,'C',false);


		$this->SetXY(9.5,13.2);
		$this->SetFont('Arial','b',8);
		$this->Cell(4.5,0.5,utf8_decode("D. TIPO DE ANESTESIA"),1,1,'C',true);

		$this->SetXY(9.5,13.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(4.5,0.5,utf8_decode("$TIPOANESTECIA"),1,1,'C',false);


		$this->SetXY(14,13.2);
		$this->SetFont('Arial','b',8);
		$this->Cell(5,0.5,utf8_decode("E. TIEMPO QUIRURGICO"),1,1,'C',true);

		$this->SetXY(14,13.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(5,0.5,utf8_decode("$ETIEMPOQUIRURGICO"),1,1,'C',false);



		$this->SetXY(2,14.2);
		$this->SetFont('Arial','b',8);
		$this->Cell(17,0.5,utf8_decode("F. PROTOCOLO OPERATORIO"),1,1,'C',true);

		$this->SetXY(2,14.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(17,7.8,utf8_decode(""),1,1,'C',false);

		$this->SetXY(2,14.7);
		$this->SetFont('Arial','b',8);
		$this->Cell(17,0.5,utf8_decode(" "),0,1,'L',false);


		//$this->SetFillColor(192, 192, 192);

		
		$VEC=explode(";", $HALLAZGOS);
		$numvec=count($VEC);
		$HALLAZGOS2="";
		for($x=0;$x<$numvec;$x++){
			$HALLAZGOS2=$HALLAZGOS2."\n".($x+1).".  ".$VEC[$x];
		}

		$VEC2=explode(";", $PROCEDIMIENTO);
		$numvec2=count($VEC2);
		$PROCEDIMIENTO2="";
		for($y=0;$y<$numvec2;$y++){
			$PROCEDIMIENTO2=$PROCEDIMIENTO2."\n".($y+1).".  ".$VEC2[$y];
		}
		
		$VEC3=explode(";", $COMPLICACCIONES);
		$numvec3=count($VEC3);
		$COMPLICACCIONES3="";
		for($y=0;$y<$numvec3;$y++){
			$COMPLICACCIONES3=$COMPLICACCIONES3."\n".($y+1).".  ".$VEC3[$y];
		}
		

		//HALLAZGOS
		//PROCEDIMIENTO
		//COMPLICACIONES

		$this->SetFillColor(255, 255, 255);
		$this->SetXY(2.2,14.9);
		$this->SetFont('Arial','b',6);
		$this->MultiCell(16.6,0.3,utf8_decode("HALLAZGOS:$HALLAZGOS2 \n\n\nE.T.O. PROCEDIMIENTO:$PROCEDIMIENTO2\n\n\nCOMPLICACIONES:$COMPLICACCIONES3"),0,1,'C',false);

		$contar=$numvec+$numvec2+$numvec3;
		
		if($contar>=28){
			$this->SetXY(2,1);
			$this->SetFont('Arial','b',8);
			$this->Cell(17,23.5,utf8_decode(""),1,1,'C',false);	
		}

/*
		$this->SetXY(2,17.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(17,7,utf8_decode(""),1,1,'C',false);

		$this->SetXY(2,17.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(17,0.5,utf8_decode("E.T.O. PROCEDIMIENTO: "),0,1,'L',false);

		$this->SetXY(2.2,18);
		$this->SetFont('Arial','b',8);
		$this->MultiCell(16.6,0.5,utf8_decode("$PROCEDIMIENTO2"),0,1,'L',false);
*/
		
		
		$this->SetFillColor(192, 192, 192);

		$this->SetXY(2,22.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(8.5,0.5,utf8_decode("SANGRADO: "),1,1,'C',true);


		$this->SetXY(2,23);
		$this->SetFont('Arial','b',8);
		$this->Cell(8.5,0.5,utf8_decode("$SANGRADO +/- CC "),1,1,'C',false);

		$this->SetXY(10.5,22.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(8.5,0.5,utf8_decode("HISTOPATOLOGIA: "),1,1,'C',true);

		// $diagnosticoHispatologia=$anam->Consultar("SELECT dignhisp_pop FROM tbl_protocoloperatorio WHERE id_pop='$code';");

		// if ($HISTOPATOLOGIA=="SI") {
		// 	$this->SetXY(10.5,23);
		// 	$this->SetFont('Arial','b',8);
		// 	$this->Cell(8.5,0.5,utf8_decode("$diagnosticoHispatologia"),1,1,'C',false);
		// }
		// else
		// {
		// 	$this->SetXY(10.5,23);
		// 	$this->SetFont('Arial','b',8);
		// 	$this->Cell(8.5,0.5,utf8_decode("NO"),1,1,'C',false);
		// }
		
		$this->SetXY(10.5,23);
		$this->SetFont('Arial','b',8);
		$this->Cell(8.5,0.5,utf8_decode("$HISTOPATOLOGIA"),1,1,'C',false);


		$this->SetXY(2,23.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(6,0.5,utf8_decode("PREPARADO POR: "),1,1,'C',true);

		$this->SetXY(2,24);
		$this->SetFont('Arial','b',6);
		$this->Cell(6,3.5,utf8_decode("$PREPARADOPOR"),1,1,'C',false);


		$this->SetXY(8,23.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(2.5,0.5,utf8_decode("FECHA: "),1,1,'C',true);


		$this->SetXY(8,24);
		$this->SetFont('Arial','b',8);
		$this->Cell(2.5,3.5,utf8_decode("$FECHA2"),1,1,'C',false);


		$this->SetXY(10.5,23.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(6,0.5,utf8_decode("APROBADO POR: "),1,1,'C',true);

		$this->SetXY(10.5,24);
		$this->SetFont('Arial','b',8);
		$this->Cell(6,3.5,utf8_decode(""),1,1,'C',false);

		if ($COOCIRUJANO=="" && $CIRUJANO3=="") 
		{
			$this->SetXY(11,25.69);
			$this->SetFont('Arial','b',7);
			$this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

			$this->SetXY(11,25.91);
			$this->SetFont('Arial','b',6);
			$this->Cell(5,0.5,utf8_decode("$CIRUJANO"),0,1,'C',false);
		}
		else
		{
			if ($CIRUJANO3=="")
			{
				$this->SetXY(11,24.89);
				$this->SetFont('Arial','b',7);
				$this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

				$this->SetXY(11,25.16);
				$this->SetFont('Arial','b',6);
				$this->Cell(5,0.5,utf8_decode("$CIRUJANO"),0,1,'C',false);

				$this->SetXY(11,26.40);
				$this->SetFont('Arial','b',7);
				$this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

				$this->SetXY(11,26.7);
				$this->SetFont('Arial','b',6);
				$this->Cell(5,0.5,utf8_decode("$COOCIRUJANO"),0,1,'C',false);
			}
			else
			{
				if ($COOCIRUJANO!="" && $CIRUJANO3!="" && $CIRUJANO3!="") 
				{
					$this->SetXY(11,24.55);
					$this->SetFont('Arial','b',7);
					$this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

					$this->SetXY(11,24.81);
					$this->SetFont('Arial','b',6);
					$this->Cell(5,0.5,utf8_decode("$CIRUJANO"),0,1,'C',false);

					$this->SetXY(11,25.69);
					$this->SetFont('Arial','b',7);
					$this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

					$this->SetXY(11,25.91);
					$this->SetFont('Arial','b',6);
					$this->Cell(5,0.5,utf8_decode("$COOCIRUJANO"),0,1,'C',false);

					$this->SetXY(11,26.75);
					$this->SetFont('Arial','b',7);
					$this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

					$this->SetXY(11,27);
					$this->SetFont('Arial','b',6);
					$this->Cell(5,0.5,utf8_decode("$CIRUJANO3"),0,1,'C',false);
				}
			}
		}
		

		// $this->SetXY(11,24.55);
		// $this->SetFont('Arial','b',8);
		// $this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

		// $this->SetXY(11,24.81);
		// $this->SetFont('Arial','b',8);
		// $this->Cell(5,0.5,utf8_decode("$CIRUJANO"),0,1,'C',false);

		// $this->SetXY(11,25.69);
		// $this->SetFont('Arial','b',8);
		// $this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

		// $this->SetXY(11,25.91);
		// $this->SetFont('Arial','b',8);
		// $this->Cell(5,0.5,utf8_decode("$COOCIRUJANO"),0,1,'C',false);

		// $this->SetXY(11,26.75);
		// $this->SetFont('Arial','b',8);
		// $this->Cell(5,0.5,utf8_decode("------------------------------------------------------"),0,1,'C',false);

		// $this->SetXY(11,27);
		// $this->SetFont('Arial','b',8);
		// $this->Cell(5,0.5,utf8_decode("$CIRUJANO3"),0,1,'C',false);


		$this->SetXY(16.5,23.5);
		$this->SetFont('Arial','b',8);
		$this->Cell(2.5,0.5,utf8_decode("FECHA: "),1,1,'C',true);


		$this->SetXY(16.5,24);
		$this->SetFont('Arial','b',8);
		$this->Cell(2.5,3.5,utf8_decode("$FECHA3"),1,1,'C',false);


		$img=$anam->Consultar("SELECT url_usu FROM tbl_usuario WHERE id_usu='$IDAPROBADOPOR';");
		if($img!=""){
			$this->Image($img,11.2,26.6,3);		
		}

		//firma
	/*	
		$idmed=$anam->Consultar("SELECT id_med FROM tbl_cduanamnesis WHERE id_cduanam='$code';");*/
		 
		
		/*$this->SetXY(14.4,12.4);
		$this->SetFont('Arial','b',6);
		$this->Cell(1,0.9,utf8_decode('FIRMA'),1,1,'C',true);
		
		$this->SetXY(15.4,12.4);
		$this->SetFont('Arial','b',8);
		$this->Cell(4.1,0.9,utf8_decode(''),1,1,'C',false);*/
	
	
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