<?php
require('fpdf/fpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/Epicrisis.php";
include "../Dominio/CiEpicrisis.php";

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
		//codigo del paciente y instacia a la clase odontograma
		$codpac=$_GET['Paci'];

		$ep=new Epicrisis;
		//$idepi=$ep->Consultar("SELECT MAX(id_epi) FROM tbl_epicrisis WHERE id_user='$codpac';");
		$idepi=$_GET['Epi'];


		$PARROQUIA=$ep->Consultar("SELECT parroquia_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$CANTON=$ep->Consultar("SELECT canton_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$PROVINCIA=$ep->Consultar("SELECT provincia_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");


		
	    // paciente
		$cedula=$ep->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codpac';");
		$apellido=$ep->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codpac';");
		$nombre=$ep->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codpac';");
		$fechaNa=$ep->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codpac';");
		$edadPac=$this->Edad($fechaNa);
		$edadPac1=explode("años", $edadPac);
		
		$sex=$ep->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codpac';");
		switch ($sex) {
			case 'Masculino':
				    $this->SetXY(8,7.5);
				    $this->SetFont('Arial','b',7);
				    $this->Cell(0.75,0.5,utf8_decode('X'),1,1,'L',false);

					$this->SetXY(8.75,7.5);
				    $this->SetFont('Arial','b',7);
				    $this->Cell(0.75,0.5,utf8_decode(''),1,1,'L',false);
				break;
			
			case 'Femenino':
					$this->SetXY(8,7.5);
				    $this->SetFont('Arial','b',7);
				    $this->Cell(0.75,0.5,utf8_decode(''),1,1,'L',false);

					$this->SetXY(8.75,7.5);
				    $this->SetFont('Arial','b',7);
				    $this->Cell(0.75,0.5,utf8_decode('X'),1,1,'L',false);
				break;;
		}

		$estcv=$ep->Consultar("SELECT estadociv_pac FROM tbl_paciente WHERE id_pac='$codpac';");
		switch ($estcv) {
			case '':
				$this->SetXY(9.5,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(9.9,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.3,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.7,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(11.1,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);
				break;
			case 'Solter@':
				$this->SetXY(9.5,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode('X'),1,1,'L',false);

				$this->SetXY(9.9,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.3,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.7,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(11.1,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);
				break;
			
			case 'Casad@':
				$this->SetXY(9.5,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(9.9,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode('X'),1,1,'L',false);

				$this->SetXY(10.3,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.7,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(11.1,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);
				break;
			case 'Divorciad@':
				$this->SetXY(9.5,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(9.9,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.3,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode('X'),1,1,'L',false);

				$this->SetXY(10.7,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(11.1,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);
				break;
			case 'Viud@':
				$this->SetXY(9.5,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(9.9,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.3,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.7,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode('X'),1,1,'L',false);

				$this->SetXY(11.1,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);
				break;
			case 'Union Libre':
				$this->SetXY(9.5,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(9.9,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.3,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(10.7,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode(''),1,1,'L',false);

				$this->SetXY(11.1,7.5);
			    $this->SetFont('Arial','b',7);
			    $this->Cell(0.4,0.5,utf8_decode('X'),1,1,'L',false);
				break;
		}
		$intruccion=$ep->Consultar("SELECT instruccion_pac FROM tbl_paciente WHERE id_pac='$codpac';");
		switch ($intruccion) {
			case '':
				$this->SetXY(11.5,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);

				$this->SetXY(11.9,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.3,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.7,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(13.1,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				break;
			case 'Sin instrucción':
				$this->SetXY(11.5,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode("X"),1,1,'L',false);

				$this->SetXY(11.9,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.3,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.7,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(13.1,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				break;
			
			case 'Basica':
				$this->SetXY(11.5,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);

				$this->SetXY(11.9,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode("X"),1,1,'L',false);
				
				$this->SetXY(12.3,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.7,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(13.1,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);			
				break;

			case 'Bachiller':
				$this->SetXY(11.5,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);

				$this->SetXY(11.9,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.3,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode("X"),1,1,'L',false);
				
				$this->SetXY(12.7,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(13.1,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);			
				break;
			case 'Superio':
				$this->SetXY(11.5,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);

				$this->SetXY(11.9,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.3,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.7,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode("X"),1,1,'L',false);
				
				$this->SetXY(13.1,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				break;
			case 'Especialida':
				$this->SetXY(11.5,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);

				$this->SetXY(11.9,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.3,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(12.7,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode(""),1,1,'L',false);
				
				$this->SetXY(13.1,7.5);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(0.4,0.5,utf8_decode("X"),1,1,'L',false);
				break;
		}

		//datos 
		$fechaate=$ep->Consultar("SELECT fechaat_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$empresa=$ep->Consultar("SELECT empresa_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$horate=$ep->Consultar("SELECT hora_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$seguro=$ep->Consultar("SELECT segurosa_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$rdcc=$ep->Consultar("SELECT rdcc_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$rdeyc=$ep->Consultar("SELECT rdeyc FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$hrdeyp=$ep->Consultar("SELECT hrdeyp_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
		



	    $this->SetFillColor(192,192,192); // color de las cajas
	    $this->SetTextColor(0,0,0); // color del texto
	    
	    $this->SetXY(2,2);
	    $this->Cell(18.5,0.0,utf8_decode(''),1,1,'L',false);
 		
	    $this->SetXY(10.5,1);
	    $this->SetFont('Arial','b',12);
	    $this->Cell(7.5,1,utf8_decode('Rediseño de los formularios básicos'),0,1,'L',false);

	    $this->SetXY(19,1);
	    $this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);


	    $this->SetXY(19.4,1);
	    $this->Cell(0.8,1.8,utf8_decode('43'),1,1,'L',true);


	    $this->SetXY(15,2);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(7.5,1,utf8_decode('Sistema Nacional de Salud'),0,1,'L',false);

	    
	    $this->Image('img/logo1.jpg',15.5,3,3);

	    $this->SetXY(2,4);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('UNIDAD OPERATIVA'),1,1,'L',true);


	    $this->SetXY(8,4);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('LOCALIZACIÓN'),1,1,'L',true);


	    $this->SetXY(14,4);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,0.5,utf8_decode('HISTORIA CLINICA'),1,1,'L',true);


	    $this->SetXY(2,4.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,1,utf8_decode("Clínica de urulogía"),1,1,'L',false);




	    $this->SetXY(8,4.5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(2,0.5,utf8_decode('PARROQUIA'),1,1,'L',true);

	    $this->SetXY(8,5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(2,0.5,utf8_decode("$PARROQUIA"),1,1,'L',false);


	    $this->SetXY(10,4.5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(2,0.5,utf8_decode('CANTÓN'),1,1,'L',true);


	    $this->SetXY(10,5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(2,0.5,utf8_decode("$CANTON"),1,1,'L',false);


	    $this->SetXY(12,4.5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(2,0.5,utf8_decode('PROVINCIA'),1,1,'L',true);

	    $this->SetXY(12,5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(2,0.5,utf8_decode("$PROVINCIA"),1,1,'L',false);


	    $this->SetXY(14,4.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(6,1,utf8_decode("$cedula"),1,1,'L',false);

	    $this->SetXY(2,5.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(14,0.5,utf8_decode('NOMBRES COMPLETOS'),1,1,'L',true);

	    $this->SetXY(2,6);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(14,0.5,utf8_decode("$apellido"),1,1,'L',false);

/*
	    $this->SetXY(9,5.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(7,0.5,utf8_decode('NOMBRES'),1,1,'L',true);

	    $this->SetXY(9,6);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(7,0.5,utf8_decode("$nombre"),1,1,'L',false);*/


	    $this->SetXY(16,5.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(4,0.5,utf8_decode('CÉDULA DE CIUDADANIA'),1,1,'L',true);


	    $this->SetXY(16,6);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(4,0.5,utf8_decode("$cedula"),1,1,'L',false);


	    $this->SetXY(2,6.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(2.7,1,utf8_decode('FECHA DE ATENCIÓN'),1,1,'L',true);


	    $this->SetXY(4.7,6.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(1.3,1,utf8_decode('HORA'),1,1,'L',true);

	    $this->SetXY(6,6.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(2,1,utf8_decode('EDAD'),1,1,'L',true);

	    $this->SetXY(8,6.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(1.5,0.5,utf8_decode('GENERO'),1,1,'L',true);

	    $this->SetXY(8,7);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(0.75,0.5,utf8_decode('M'),1,1,'L',true);

	  

	    $this->SetXY(8.75,7);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(0.75,0.5,utf8_decode('F'),1,1,'L',true);


	    


	    $this->SetXY(9.5,6.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(2,0.5,utf8_decode('ESTADO CIVIL'),1,1,'L',true);



	    $this->SetXY(9.5,7);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(0.4,0.5,utf8_decode('S'),1,1,'L',true);

	    

	    $this->SetXY(9.9,7);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(0.4,0.5,utf8_decode('C'),1,1,'L',true);

	    

	    $this->SetXY(10.3,7);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(0.4,0.5,utf8_decode('D'),1,1,'L',true);

	    


	    $this->SetXY(10.7,7);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(0.4,0.5,utf8_decode('V'),1,1,'L',true);

	    

	    $this->SetXY(11.1,7);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(0.4,0.5,utf8_decode('UL'),1,1,'L',true);

	    






	    $this->SetXY(11.5,6.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(2,0.5,utf8_decode('INSTRUCCIÓN'),1,1,'L',true);

	    $this->SetXY(11.5,7);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.4,0.5,utf8_decode('SI'),1,1,'L',true);

	    



	    $this->SetXY(11.9,7);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.4,0.5,utf8_decode('BA'),1,1,'L',true);

	    

	    $this->SetXY(12.3,7);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.4,0.5,utf8_decode('BC'),1,1,'L',true);

	    

	    $this->SetXY(12.7,7);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.4,0.5,utf8_decode('SP'),1,1,'L',true);

	    

	    $this->SetXY(13.1,7);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.4,0.5,utf8_decode('EP'),1,1,'L',true);

	    


	    $this->SetXY(13.5,6.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(3.5,1,utf8_decode('EMPRESA DONDE TRABAJA'),1,1,'L',true);

	    $this->SetXY(13.5,7.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(3.5,0.5,utf8_decode("$empresa"),1,1,'L',false);


	    $this->SetXY(17,6.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(3,1,utf8_decode('SEGURO DE SALUD'),1,1,'L',true);

	    $this->SetXY(17,7.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(3,0.5,utf8_decode("$seguro"),1,1,'L',false);


	    $this->SetXY(2,7.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(2.7,0.5,utf8_decode("$fechaate"),1,1,'L',false);

	    $this->SetXY(4.7,7.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(1.3,0.5,utf8_decode("$horate"),1,1,'L',false);


	    $this->SetXY(6,7.5);
	    $this->SetFont('Arial','b',7);
	    $this->Cell(2,0.5,utf8_decode("$edadPac1[0] años"),1,1,'L',false);


	    $this->SetXY(2,8.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('1 RESUMEN DEL CUADRO CLINICO'),1,1,'L',true);

	    

	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2,9);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,5.5,utf8_decode(''),1,1,'L',false);

	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2.5,9);
	    $this->SetFont('Arial','b',8);
	    $this->MultiCell(16,0.5,utf8_decode("$rdcc"),0,1,'J');



	    $this->SetFillColor(192,192,192);
	    $this->SetXY(2,15);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('2 RESUMEN DE EVOLUCIÓN Y COMPLICACIONES'),1,1,'L',true);

	    



	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2,15.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,5.5,utf8_decode(""),1,1,'L',false);

	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2.2,15.5);
	    $this->SetFont('Arial','b',8);
	    $this->MultiCell(17.5,0.5,utf8_decode("$rdeyc"),0,1,'J',false);



	    $this->SetFillColor(192,192,192);
	    $this->SetXY(2,21.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('3 HALLAZGOS RELEVANTES DE EXAMENES Y PROCEDMIENTOS DIAGNOSTICOS'),1,1,'L',true);



	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2,22);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,5,utf8_decode(""),1,1,'L',false);

	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2.2,22);
	    $this->SetFont('Arial','b',8);
	    $this->MultiCell(17.5,0.5,utf8_decode("$hrdeyp"),0,1,'J',false);



	    $this->SetXY(2,27);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(5,0.5,utf8_decode('SNS -MSP / HCP -form.006 / 2007'),0,1,'L',false);


	    $this->SetXY(17,27);
	    $this->SetFont('Arial','b',12);
	    $this->Cell(5,0.5,utf8_decode('EPICRISIS (1)'),0,1,'L',false);




	}




function Cuerpo2(){
	    $this->SetFillColor(192,192,192); // color de las cajas
	    $this->SetTextColor(0,0,0); // color del texto
	    
	    $this->SetXY(2,2);
	    $this->Cell(18.5,0.0,utf8_decode(''),1,1,'L',false);
 		
	    $this->SetXY(4,1);
	    $this->SetFont('Arial','b',12);
	    $this->Cell(7.5,1,utf8_decode('Expediente único para la Historia Clínica'),0,1,'L',false);

	    $this->SetXY(3.5,1);
	    $this->Cell(0.2,2,utf8_decode(''),1,1,'L',true);


	    $this->SetXY(2.5,1);
	    $this->Cell(0.8,1.8,utf8_decode('44'),1,1,'L',true);



		$this->SetXY(2,4);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('5 RESUMEN DE TRATAMIENTO Y PROCEDIMIENTOS TERAPEUTICOS'),1,1,'L',true);



	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2,4.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,10,utf8_decode(""),1,1,'L',false);

	    $ep=new Epicrisis;
		
		$codpac=$_GET['Paci'];
		//$idepi=$ep->Consultar("SELECT MAX(id_epi) FROM tbl_epicrisis WHERE id_user='$codpac';");	    
		$idepi=$_GET['Epi'];
		
	    $rdtypt=$ep->Consultar("SELECT rdtypt_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $cdeyp=$ep->Consultar("SELECT cdeyp_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $medicos_epi=$ep->Consultar("SELECT medicos_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $medico_epi=$ep->Consultar("SELECT medico_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");

	    $altd_epi=$ep->Consultar("SELECT altd_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $alttr_epi=$ep->Consultar("SELECT alttr_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $asin_epi=$ep->Consultar("SELECT asin_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $disleve_epi=$ep->Consultar("SELECT disleve_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $dismod_epi=$ep->Consultar("SELECT dismod_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $disgra_epi=$ep->Consultar("SELECT disgra_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $retirovo_epi=$ep->Consultar("SELECT retirovo_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $retiinvo_epi=$ep->Consultar("SELECT retiinvo_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $defant_epi=$ep->Consultar("SELECT defant_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $defdes_epi=$ep->Consultar("SELECT defdes_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $diases_epi=$ep->Consultar("SELECT diases_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $diasin_epi=$ep->Consultar("SELECT diasin_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $codigo_epi=$ep->Consultar("SELECT codigo_epi FROM tbl_epicrisis WHERE id_epi='$idepi';");


	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2.2,4.5);
	    $this->SetFont('Arial','b',8);
	    $this->MultiCell(17.5,0.5,utf8_decode("$rdtypt"),0,1,'J',false);

	    $this->SetFillColor(192,192,192);

	    $this->SetXY(2,15);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('4 DIAGNOSTICOS'),1,1,'L',true);




$txti1=$ep->Consultar("SELECT txti1 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtic1=$ep->Consultar("SELECT txtic1 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtipr1=$ep->Consultar("SELECT txtipr1 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtid1=$ep->Consultar("SELECT txtid1 FROM tbl_epicrisis WHERE id_epi='$idepi';");

	   	$txti2=$ep->Consultar("SELECT txti2 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtic2=$ep->Consultar("SELECT txtic2 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtipr2=$ep->Consultar("SELECT txtipr2 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtid2=$ep->Consultar("SELECT txtid2 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    

	    $txti3=$ep->Consultar("SELECT txti3 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtic3=$ep->Consultar("SELECT txtic3 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtipr3=$ep->Consultar("SELECT txtipr3 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtid3=$ep->Consultar("SELECT txtid3 FROM tbl_epicrisis WHERE id_epi='$idepi';");

	    $txti4=$ep->Consultar("SELECT txti4 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtic4=$ep->Consultar("SELECT txtic4 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtipr4=$ep->Consultar("SELECT txtipr4 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtid4=$ep->Consultar("SELECT txtid4 FROM tbl_epicrisis WHERE id_epi='$idepi';");

	    $txti5=$ep->Consultar("SELECT txti5 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtic5=$ep->Consultar("SELECT txtic5 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtipr5=$ep->Consultar("SELECT txtipr5 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtid5=$ep->Consultar("SELECT txtid5 FROM tbl_epicrisis WHERE id_epi='$idepi';");


	    $txte1=$ep->Consultar("SELECT txte1 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtec1=$ep->Consultar("SELECT txtec1 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtepr1=$ep->Consultar("SELECT txtepr1 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtede1=$ep->Consultar("SELECT txtede1 FROM tbl_epicrisis WHERE id_epi='$idepi';");

	    $txte2=$ep->Consultar("SELECT txte2 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtec2=$ep->Consultar("SELECT txtec2 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtepr2=$ep->Consultar("SELECT txtepr2 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtede2=$ep->Consultar("SELECT txtede2 FROM tbl_epicrisis WHERE id_epi='$idepi';");


	    $txte3=$ep->Consultar("SELECT txte3 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtec3=$ep->Consultar("SELECT txtec3 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtepr3=$ep->Consultar("SELECT txtepr3 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtede3=$ep->Consultar("SELECT txtede3 FROM tbl_epicrisis WHERE id_epi='$idepi';");


	    $txte4=$ep->Consultar("SELECT txte4 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtec4=$ep->Consultar("SELECT txtec4 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtepr4=$ep->Consultar("SELECT txtepr4 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtede4=$ep->Consultar("SELECT txtede4 FROM tbl_epicrisis WHERE id_epi='$idepi';");

	    $txte5=$ep->Consultar("SELECT txte5 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtec5=$ep->Consultar("SELECT txtec5 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtepr5=$ep->Consultar("SELECT txtepr5 FROM tbl_epicrisis WHERE id_epi='$idepi';");
	    $txtede5=$ep->Consultar("SELECT txtede5 FROM tbl_epicrisis WHERE id_epi='$idepi';");

	    		//ingreso
	    	   	$this->SetXY(2,16);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txti1"),1,1,'C',false);

				$this->SetXY(9,16);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtic1"),1,1,'C',false);
				
				$this->SetXY(10,16);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtipr1"),1,1,'C',false);

				$this->SetXY(10.5,16);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtid1"),1,1,'C',false);

				


	    	   	$this->SetXY(2,16.3);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txti2"),1,1,'C',false);

				$this->SetXY(9,16.3);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtic2"),1,1,'C',false);
				
				$this->SetXY(10,16.3);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtipr2"),1,1,'C',false);

				$this->SetXY(10.5,16.3);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtid2"),1,1,'C',false);



	    	   	$this->SetXY(2,16.6);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txti3"),1,1,'C',false);

				$this->SetXY(9,16.6);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtic3"),1,1,'C',false);
				
				$this->SetXY(10,16.6);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtipr3"),1,1,'C',false);

				$this->SetXY(10.5,16.6);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtid3"),1,1,'C',false);



	    	   	$this->SetXY(2,16.9);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txti4"),1,1,'C',false);

				$this->SetXY(9,16.9);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtic4"),1,1,'C',false);
				
				$this->SetXY(10,16.9);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtipr4"),1,1,'C',false);

				$this->SetXY(10.5,16.9);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtid4"),1,1,'C',false);


				$this->SetXY(2,17.2);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txti5"),1,1,'C',false);

				$this->SetXY(9,17.2);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtic5"),1,1,'C',false);
				
				$this->SetXY(10,17.2);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtipr5"),1,1,'C',false);

				$this->SetXY(10.5,17.2);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtid5"),1,1,'C',false);

			    //egreso

				$this->SetXY(11,16);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txte1"),1,1,'C',false);

				$this->SetXY(18,16);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtec1"),1,1,'C',false);


				$this->SetXY(19,16);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtepr1"),1,1,'C',FALSE);

				$this->SetXY(19.5,16);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtede1"),1,1,'C',FALSE);	



			    $this->SetXY(11,16.3);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txte2"),1,1,'C',false);

				$this->SetXY(18,16.3);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtec2"),1,1,'C',false);


				$this->SetXY(19,16.3);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtepr2"),1,1,'C',FALSE);

				$this->SetXY(19.5,16.3);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtede2"),1,1,'C',FALSE);	


			    $this->SetXY(11,16.6);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txte3"),1,1,'C',false);

				$this->SetXY(18,16.6);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtec3"),1,1,'C',false);


				$this->SetXY(19,16.6);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtepr3"),1,1,'C',FALSE);

				$this->SetXY(19.5,16.6);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtede3"),1,1,'C',FALSE);


			    $this->SetXY(11,16.9);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txte4"),1,1,'C',false);

				$this->SetXY(18,16.9);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtec4"),1,1,'C',false);


				$this->SetXY(19,16.9);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtepr4"),1,1,'C',FALSE);

				$this->SetXY(19.5,16.9);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtede4"),1,1,'C',FALSE);


			    $this->SetXY(11,17.2);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$txte5"),1,1,'C',false);

				$this->SetXY(18,17.2);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$txtec5"),1,1,'C',false);


				$this->SetXY(19,17.2);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtepr5"),1,1,'C',FALSE);

				$this->SetXY(19.5,17.2);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$txtede5"),1,1,'C',FALSE);















	    /*$cie=new CiEpicrisis;
	    $datos=$cie->Consultar_CiEpicrisis("SELECT * FROM tbl_ciepicris WHERE id_pac='$codpac' ORDER BY  id_ciepi DESC LIMIT 10;");
	    $x=0;
	    $y=0;
	    foreach ($datos as $fila) {
	    	if ($fila['pos_ciepi']=="I") {
	    		$this->SetXY(2,16+$x);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$fila[descripcion_ciepi]"),1,1,'C',false);

				$this->SetXY(9,16+$x);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$fila[codigo_ciepi]"),1,1,'C',false);
				
				$this->SetXY(10,16+$x);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$fila[pre_ciepi]"),1,1,'C',false);

				$this->SetXY(10.5,16+$x);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$fila[def_ciepi]"),1,1,'C',false);
			    $x=$x+0.5;
	    	}
	    	if ($fila['pos_ciepi']=="E") {
				$this->SetXY(11,16+$y);
			    $this->SetFont('Arial','b',4);
			    $this->Cell(7,0.3,utf8_decode("$fila[descripcion_ciepi]"),1,1,'C',false);

				$this->SetXY(18,16+$y);
			    $this->SetFont('Arial','b',6);
			    $this->Cell(1,0.3,utf8_decode("$fila[codigo_ciepi]"),1,1,'C',false);


				$this->SetXY(19,16+$y);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$fila[pre_ciepi]"),1,1,'C',FALSE);

				$this->SetXY(19.5,16+$y);
			    $this->SetFont('Arial','b',5);
			    $this->Cell(0.5,0.3,utf8_decode("$fila[def_ciepi]"),1,1,'C',FALSE);
			    $y=$y+0.5;
	    	}
	    	
	    	
	    }
*/
	    $this->SetXY(2,15.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(7,0.5,utf8_decode('DE INGRESO'),1,1,'C',true);

	    


	    $this->SetXY(9,15.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(1,0.5,utf8_decode('CIE'),1,1,'C',true);

	    

	    $this->SetXY(10,15.5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.5,0.5,utf8_decode('PRE'),1,1,'C',true);

	    


	    $this->SetXY(10.5,15.5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.5,0.5,utf8_decode('DEF'),1,1,'C',true);

	    

	    $this->SetXY(11,15.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(7,0.5,utf8_decode('DE EGRESO'),1,1,'C',true);

	    

	    

	    $this->SetXY(18,15.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(1,0.5,utf8_decode('CIE'),1,1,'C',true);

	    

	    $this->SetXY(19,15.5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.5,0.5,utf8_decode('PRE'),1,1,'C',true);

	    


	    $this->SetXY(19.5,15.5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(0.5,0.5,utf8_decode('DEF'),1,1,'C',true);

	    


		$this->SetXY(2,18);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('7 CONDICIONES DE EGRESO Y PRONOSTICO'),1,1,'L',true);

	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2,18.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,2,utf8_decode(""),1,1,'L',FALSE);

	    $this->SetFillColor(250,250,250);
	    $this->SetXY(2.2,18.5);
	    $this->SetFont('Arial','b',8);
	    $this->MultiCell(17.5,0.5,utf8_decode("$cdeyp"),0,1,'J',FALSE);


	    $this->SetFillColor(192,192,192);


	    $this->SetXY(2,21);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('8 MEDICOS TRATANTES'),1,1,'L',true);

   	    
	    $this->SetFillColor(250,250,250);
   	    $this->SetXY(2,21.5);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,1.5,utf8_decode(""),1,1,'L',false);

   	    $this->SetFillColor(250,250,250);
   	    $this->SetXY(2.2,21.5);
	    $this->SetFont('Arial','b',8);
	    $this->MultiCell(17.5,0.5,utf8_decode("$medicos_epi"),0,1,'J',false);


	    $this->SetFillColor(192,192,192);

	    $this->SetXY(2,24);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(18,0.5,utf8_decode('9 EGRESOS'),1,1,'L',true);

	    $this->SetXY(2,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(2,0.5,utf8_decode('ALTA DEFINITIVA'),1,1,'L',true);

	    $this->SetXY(4,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$altd_epi"),1,1,'L',FALSE);


	    $this->SetXY(2,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(2,0.5,utf8_decode('ALTA TRANSITORIA'),1,1,'L',true);

	    $this->SetXY(4,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$alttr_epi"),1,1,'L',FALSE);


	    $this->SetXY(4.5,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(2,0.5,utf8_decode('ASINTOMATICO'),1,1,'L',true);

	    $this->SetXY(6.5,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$asin_epi"),1,1,'L',FALSE);


	    $this->SetXY(4.5,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(2,0.5,utf8_decode('DISCAPACIDAD LEVE'),1,1,'L',true);

	    $this->SetXY(6.5,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$disleve_epi"),1,1,'L',FALSE);


	    $this->SetXY(7,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(3,0.5,utf8_decode('DISCAPACIDAD MODERADA'),1,1,'L',true);

	    $this->SetXY(10,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$dismod_epi"),1,1,'L',FALSE);


	    $this->SetXY(7,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(3,0.5,utf8_decode('DISCAPACIDAD GRAVE'),1,1,'L',true);

	    $this->SetXY(10,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$disgra_epi"),1,1,'L',FALSE);


	    $this->SetXY(10.5,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(3,0.5,utf8_decode('RETIRO VOLUNTARIO'),1,1,'L',true);

	    $this->SetXY(13.5,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$retirovo_epi"),1,1,'L',FALSE);

	    $this->SetXY(10.5,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(3,0.5,utf8_decode('RETIRO INVOLUNTARIO'),1,1,'L',true);

	    $this->SetXY(13.5,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$retiinvo_epi"),1,1,'L',FALSE);


	    $this->SetXY(14,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(2,0.5,utf8_decode('DEFUNCIÓN ANT. 48H'),1,1,'L',true);

	    $this->SetXY(16,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$defant_epi"),1,1,'L',FALSE);

	    $this->SetXY(14,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(2,0.5,utf8_decode('DEFUNCIÓN DES. 48H'),1,1,'L',true);

	    $this->SetXY(16,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$defdes_epi"),1,1,'L',FALSE);

	    $this->SetXY(16.5,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(3,0.5,utf8_decode('DIAS ESTADÍA'),1,1,'L',true);

	    $this->SetXY(19.5,24.5);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$diases_epi"),1,1,'L',FALSE);


	    $this->SetXY(16.5,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(3,0.5,utf8_decode('DIAS INCAPACIDAD'),1,1,'L',true);


	    $this->SetXY(19.5,25);
	    $this->SetFont('Arial','b',5);
	    $this->Cell(0.5,0.5,utf8_decode("$diasin_epi"),1,1,'L',FALSE);


	    $this->SetXY(2,26);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(1,0.5,utf8_decode(""),1,1,'L',true);

	    $this->SetXY(3,26);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(2,0.5,utf8_decode(""),1,1,'L',FALSE);

	    $this->SetXY(5,26);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(1,0.5,utf8_decode("MÉDICO"),1,1,'L',true);


	    $this->SetXY(6,26);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(5,0.5,utf8_decode("$medico_epi"),1,1,'L',FALSE);


	    // $idcdu=$anam->Consultar("SELECT MAX(id_cduanam) FROM tbl_cduanamnesis WHERE id_pac='$idepi';");
		$idmed=$ep->Consultar("SELECT id_med FROM tbl_epicrisis WHERE id_epi='$idepi';");
		$img=$ep->Consultar("SELECT url_usu FROM tbl_usuario WHERE id_usu='$idmed';");
		if($img!=""){
			$this->Image($img,12,26,5);		
		}

		$this->SetXY(11,26);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(1,0.5,utf8_decode("FIRMA"),1,1,'L',true);
/*
	    $this->SetXY(12,26);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(5,0.5,utf8_decode(""),1,1,'L',FALSE);
*/


	    $this->SetXY(17,25.5);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(3,0.5,utf8_decode("CODIGO"),0,1,'C',FALSE);

	    $this->SetXY(17,26);
	    $this->SetFont('Arial','b',6);
	    $this->Cell(3,0.5,utf8_decode("$codigo_epi"),1,1,'L',FALSE);



	    $this->SetXY(2,27);
	    $this->SetFont('Arial','b',8);
	    $this->Cell(5,0.5,utf8_decode('SNS -MSP / HCP -form.006 / 2007'),0,1,'L',false);


	    $this->SetXY(17,27);
	    $this->SetFont('Arial','b',12);
	    $this->Cell(5,0.5,utf8_decode('EPICRISIS (2)'),0,1,'L',false);

}
	



}

$pdf = new PDF("P","cm","A4");



$pdf->AddPage();
$pdf->Cuerpo();

$pdf->AddPage();
$pdf->Cuerpo2();

$pdf->Output();
?>