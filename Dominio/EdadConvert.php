<?php

class EdadConvert{

public $fechaiauto_pac;
	public $fechaNac;
	public function Mifecha()
	{
		$timestamp=time();
		$diferenciahorasgmt = (date('Z', time()) / 3600 - (-5)) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
		$timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
		//$fecha1 = date("l jS \of F Y h:i:s A", $timestamp_ajuste); //mostramos la fecha/hora
		$fecha1 = date("y-m-d", $timestamp_ajuste);
		return $fecha1;		
	}
	//fin de al funcio para definir la hora actual del ecuador
	//funcion para definir la hora actual del ecuador
	public function MiHora()
	{
		$timestamp=time();
		$diferenciahorasgmt = (date('Z', time()) / 3600 - (-5)) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
		$timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
		//$fecha1 = date("l jS \of F Y h:i:s A", $timestamp_ajuste); //mostramos la fecha/hora
		$fecha1 = date("H:i:s", $timestamp_ajuste);
		return $fecha1;		
	}
	//fin de al funcio para definir la hora actual del ecuador	
	//funcion para calcular la edad de los paciente 
	public function Edad($fecha)
	{
		list($anio,$mes,$dia) = explode("-",$fecha);
		$anio_dif = date("Y") - $anio;
			/*$mes_dif = date("m") - $mes;
			$dia_dif = date("d") - $dia;
			if ($dia_dif < 0 || $mes_dif < 0)
			$anio_dif--;
			$edActu=$anio_dif." años, con ".$mes." meses , y ".$dia_dif." dias";


			return 	$edActu;*/
			
			
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
		private function bisiesto($anio_actual){ 
			$bisiesto=false; 
	   //probamos si el mes de febrero del año actual tiene 29 días 
			if (checkdate(2,29,$anio_actual)) 
			{ 
				$bisiesto=true; 
			} 
			return $bisiesto; 
		}
}