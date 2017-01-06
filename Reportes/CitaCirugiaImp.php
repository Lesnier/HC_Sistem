<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/CitaCirugia.php";

class PDF extends FPDF
{
 function Mifecha()
	{
		$timestamp=time();
		$diferenciahorasgmt = (date('Z', time()) / 3600 - (-5)) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
		$timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
		//$fecha1 = date("l jS \of F Y h:i:s A", $timestamp_ajuste); //mostramos la fecha/hora
		$fecha1 = date("y-m-d", $timestamp_ajuste);
		return $fecha1;		
	}
	function Edad($fecha)
	{
			list($anio,$mes,$dia) = explode("-",$fecha);
			$anio_dif = date("Y") - $anio;
			
			//calculado el año 
			list($Y,$m,$d) = explode("-",$fecha);
	    	$yearLight =( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );

			$fecha_de_nacimiento =$fecha; 
			$fecha_actual =$this->Mifecha(); 



			// separamos en partes las fechas 
			$array_nacimiento = explode ( "-", $fecha_de_nacimiento ); 
			$array_actual = explode ( "-", $fecha_actual ); 

			$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años 
			$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
			$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días 

			//ajuste de posible negativo en $días 
			if ($dias < 0) 
			{ 
			    --$meses; 

		    //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual 
		   switch ($array_actual[1]) { 
           case 1:     $dias_mes_anterior=31; break; 
           case 2:     $dias_mes_anterior=31; break; 
           case 3:  
                if ($this->bisiesto($array_actual[0])) 
                { 
                    $dias_mes_anterior=29; break; 
                } else { 
                    $dias_mes_anterior=28; break; 
                } 
           case 4:     $dias_mes_anterior=31; break; 
           case 5:     $dias_mes_anterior=30; break; 
           case 6:     $dias_mes_anterior=31; break; 
           case 7:     $dias_mes_anterior=30; break; 
           case 8:     $dias_mes_anterior=31; break; 
           case 9:     $dias_mes_anterior=31; break; 
           case 10:     $dias_mes_anterior=30; break; 
           case 11:     $dias_mes_anterior=31; break; 
           case 12:     $dias_mes_anterior=30; break; 
    	} 

	    $dias=$dias + $dias_mes_anterior; 
		} 

		//ajuste de posible negativo en $meses 
		if ($meses < 0) 
		{ 
		    --$anos; 
		   $meses=$meses + 12; 
		} 

			 $edad="$yearLight años con $meses meses y $dias días";			
			 return $edad;
			
	}
	function bisiesto($anio_actual){ 
	   $bisiesto=false; 
	   //probamos si el mes de febrero del año actual tiene 29 días 
		 if (checkdate(2,29,$anio_actual)) 
		 { 
		  $bisiesto=true; 
	   } 
	   return $bisiesto; 
	}



	function Cuerpo()
	{
		
		$cit=new CitaCirugia;

		$code=$_GET['code'];
		$codigo=$cit->Consultar("SELECT id_pac FROM tbl_citacirugia WHERE id_cir='$code';");
		$nombre=$cit->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codigo';");
		$fecha_de_nacimiento=$cit->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo';");
		$edadpaciend=$this->Edad($fecha_de_nacimiento);
		$cedu=$cit->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo';");

		$fechaCir=$cit->Consultar("SELECT fechaciru_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$pos=$cit->Consultar("SELECT horacir_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$deshora=$cit->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$pos';");
		$durop=$cit->Consultar("SELECT duraccionop_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$ciru=$cit->Consultar("SELECT id_userregs FROM tbl_citacirugia WHERE id_cir='$code';");
		$cirujano=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ciru';");
		$serce=$cit->Consultar("SELECT cirj_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$sercetaria=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$serce';");

		$ant=$cit->Consultar("SELECT antes_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$antestesiologo=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ant';");
		$ayu=$cit->Consultar("SELECT ayudan_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$ayudante=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ayu';");
		$procedimie=$cit->Consultar("SELECT procedimi_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$tiemh=$cit->Consultar("SELECT tiempohosp_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$obser=$cit->Consultar("SELECT observacion_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$est=$cit->Consultar("SELECT estado_cir FROM tbl_citacirugia WHERE id_cir='$code';");


		$fechadeagenda=$cit->Consultar("SELECT fecha FROM tbl_citacirugia WHERE id_cir='$code';");

		
		$msm=NULL;
		switch ($est) {
				case 'P':
					$msm="PROVICIONADA";
					break;
				
				case 'C':
					$msm="CONFRIMADA";
					break;

				case 'K':
					$msm="CANCELADA";
					break;
		}


	    $this->SetFillColor(192,192,192); // color de las cajas
	    $this->SetTextColor(0,0,0); // color del texto
	    
	    $this->SetXY(2,2);
	    $this->Cell(18.5,0.0,utf8_decode(''),1,1,'L',false);
 		
	    $this->SetXY(13.5,1);
	    $this->SetFont('Arial','b',12);
	    $this->Cell(7.5,1,utf8_decode('CLINICA DE URULOGIA'),0,1,'L',false);

	    $this->SetXY(19,1);
	    $this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);

	    $this->SetXY(2.2,3);
		$this->SetFont('Arial','b',16);
		$this->Cell(7.5,1,utf8_decode("CIRUGIA $msm" ),0,1,'L',false);

		$this->SetXY(9.2,3);
		$this->SetFont('Arial','b',9);
		$this->Cell(7.5,1,utf8_decode("Fecha en que se agendo $fechadeagenda" ),0,1,'L',false);

	    $this->SetXY(19.4,1);
	    $this->Cell(0.8,1.8,utf8_decode(''),1,1,'L',true);


	    $this->SetXY(15,2);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(7.5,1,utf8_decode('Sistema Nacional de Salud'),0,1,'L',false);

	    
	    $this->Image('img/logo1.jpg',15.5,3,3);

	    $this->SetXY(2,4);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('HISTORIA CLINICA'),1,1,'L',true);

	    $this->SetXY(2,4.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$cedu"),1,1,'L',FALSE);


	    $this->SetXY(8,4);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('PACIENTE'),1,1,'L',true);

	    $this->SetXY(8,4.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$nombre"),1,1,'L',FALSE);


	    $this->SetXY(14,4);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('EDAD'),1,1,'L',true);

	    $this->SetXY(14,4.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$edadpaciend"),1,1,'L',FALSE);


	  



	  	$this->SetXY(2,5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('FECHA CIRUGIA'),1,1,'L',true);


	    $this->SetXY(2,5.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$fechaCir"),1,1,'L',FALSE);


	    $this->SetXY(8,5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('HORA CIRUGIA'),1,1,'L',true);

	    $this->SetXY(8,5.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$deshora"),1,1,'L',FALSE);


	    $this->SetXY(14,5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('DURACION CIRUGIA'),1,1,'L',true);

		$this->SetXY(14,5.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$durop  "),1,1,'L',FALSE);


	    $this->SetXY(2,6);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('CIRUJANO'),1,1,'L',true);

	    $this->SetXY(2,6.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$cirujano"),1,1,'L',FALSE);


	   	$this->SetXY(8,6);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('ANESTESIOLOGO'),1,1,'L',true);


	    $this->SetXY(8,6.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$antestesiologo"),1,1,'L',FALSE);



	    $this->SetXY(14,6);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('AYUDANTE'),1,1,'L',true);

	    $this->SetXY(14,6.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode("$ayudante"),1,1,'L',FALSE);


	    $this->SetXY(2,7);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('TIEMPO HOSPITALIZACION'),1,1,'L',true);

	    $this->SetXY(8,7);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(2,0.5,utf8_decode("$tiemh"),1,1,'L',FALSE);


	    $this->SetXY(10,7);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(3,0.5,utf8_decode("SECRETARIA"),1,1,'L',TRUE);

	    $this->SetXY(13,7);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(7,0.5,utf8_decode("$sercetaria"),1,1,'L',FALSE);


	    $this->SetXY(2,8);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('PROCEDMIENTO'),1,1,'L',true);


	    $this->SetXY(2,8.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,5.5,utf8_decode(""),1,1,'L',FALSE);

	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2.5,8.5);
	    $this->SetFont('Arial','b',8);
	    $this->MultiCell(17,0.5,utf8_decode("$procedimie"),0,1,'J');





	    $this->SetFillColor(192,192,192);
	    $this->SetXY(2,15);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('OBSERVACIONES'),1,1,'L',true);


	    $this->SetXY(2,15.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,5.5,utf8_decode(""),1,1,'L',FALSE);

	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2.5,15.5);
	    $this->SetFont('Arial','b',8);
	    $this->MultiCell(17,0.5,utf8_decode("$obser"),0,1,'J');


	}



}

$pdf = new PDF("P","cm","A4");



$pdf->AddPage();
$pdf->Cuerpo();


$pdf->Output();
?>