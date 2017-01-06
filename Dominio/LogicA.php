<?php
class LogicAngular{
		//funcion para definir la hora actual del ecuador
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
	//fin de la funcion para calcular la edad de lospaciente



	/*
	* acrualizando procesos con angular
	*/
	/*
	* Funciones para obetener el usuario  que esta usando el sistema
	*/
	public function GetNameUserID()
	{
		$us=new Usuario;
		session_start();
	    $log=NULL;
    	$log=$_SESSION['IDUser'];
    	$nom=$us->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$log';");
    	return $nom.";".$log;
	}
	/*
	* Fin Funciones para obetener el usuario  que esta usando el sistema
	*/
	public function DataHPaciente($buscar)
	{
		$buscar=utf8_decode($buscar);
		$pac=new Paciente;
		$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE cedula_pac LIKE '$buscar%' AND estado_pac='A' OR nombresCom_pac LIKE '%$buscar%' AND estado_pac='A'  LIMIT 10;");
		$dataPaciente = array();
		$today=$this->Mifecha();
		$DUA=$this->GetNameUserID();
		$VecUser=explode(";", $DUA);

		foreach ($datos as $fila) {
			$edadpaciente;
			if($fila["fechaN_pac"]!=""){
				$edadpaciente=$this->Edad($fila["fechaN_pac"]);
			}else{
				$edadpaciente="";
			}	
			$dataPaciente[]=array(
				'Codigo' => $fila["id_pac"], 
				'Paciente'=> utf8_encode($fila["nombresCom_pac"]),
				"Cedula"=> $fila["cedula_pac"],
				"Edad"=>$edadpaciente,
				"Direccion"=> $fila["direccion_pac"],
				"Telefono"=> $fila["telefono_pac"],
				"Celular"=> $fila["celular_pac"],
				"EstadoAtencion"=> $fila["auxmovimiento_pac"],
				"FechaBusqueda"=>$today,
				"NameUserAct"=>$VecUser[0],
				"IDUserAct"=>$VecUser[1],
				"MedicoPaciente"=>$fila["medico"]
				);
		}
		return json_encode($dataPaciente);
	}

	public function DataHistoriaPaciente()
	{
		$pac=new Paciente;
		$datapop = file_get_contents("php://input");
		$pact=json_decode($datapop);
		//echo $pact->Codigo;

		$laboratorio=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$pact->Codigo' AND ubicacion_fil='1';");
		$rx=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$pact->Codigo' AND ubicacion_fil='2';");
		$urudinamia=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$pact->Codigo' AND ubicacion_fil='3';");
		$ultrasonido=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$pact->Codigo' AND ubicacion_fil='4';");
		$tomografias=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$pact->Codigo' AND ubicacion_fil='5';");
		$otros=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$pact->Codigo' AND ubicacion_fil='6';");
		$aname=$pac->Consultar("SELECT COUNT(*)  FROM  tbl_cduanamnesis WHERE id_pac='$pact->Codigo' AND est_cduanam='F' ;");
		$epircris=$pac->Consultar("SELECT COUNT(*) FROM tbl_epicrisis WHERE id_user='$pact->Codigo' AND estado_epi='F';");
		$PROTOCOLOOPERTATORIO=$pac->Consultar("SELECT COUNT(*) FROM tbl_protocoloperatorio p, tbl_citacirugia c WHERE p.id_cir=c.id_cir AND c.id_pac='$pact->Codigo';");
		$auto=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$pact->Codigo' AND ubicacion_fil='7';");
		$HC=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$pact->Codigo' AND ubicacion_fil='8';");
		$solinter=$pac->Consultar("SELECT COUNT(*) FROM tbl_solicitudinterconsulta WHERE id_pac='$pact->Codigo'  AND est_intsoli='F';");
		$infosolinter=$pac->Consultar("SELECT COUNT(*) FROM tbl_informeinterconsulta WHERE id_pac='$pact->Codigo' AND est_intinfo='F';");
		
		$dataAllFilePact[]=array(
			'Codigo' =>$pact->Codigo ,
			'Paciente'=>$pact->Paciente,
			'Cedula'=>$pact->Cedula,
			'Edad'=>$pact->Edad,
			'Direccion'=>$pact->Direccion,
			'Telefono'=>$pact->Telefono,
			'EstadoAtencion'=>$pact->EstadoAtencion,
			'Laboratorio'=>$laboratorio,
			'RayosX'=>$rx,
			'Urudinamia'=>$urudinamia,
			'Ultrasonido'=>$ultrasonido,
			'Tomografias'=>$tomografias,
			'Otros'=>$otros,
			'Anamnesis'=>$aname,
			'Epircris'=>$epircris,
			'POperatorio'=>$PROTOCOLOOPERTATORIO,
			'Auto'=>$auto,
			'HC'=>$HC,
			'SInterconsulta'=>$solinter,
			'InfoInterconsulta'=>$infosolinter
			 );
		return json_encode($dataAllFilePact);
	}

	public function VerFileXPaciente($paciente,$archivo)
	{
		$fl=new File;
		$pac=file_get_contents("php://input");
		$Dp=json_decode($paciente);
		$DPF = array();
		$datos=NULL;
		switch ($archivo) {
			case '1':
					$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$paciente' AND ubicacion_fil='1' ORDER BY fecha_fil DESC ;");
				break;
			case '2':
					$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$paciente' AND ubicacion_fil='2' ORDER BY fecha_fil DESC ;");
				break;
			case '3':
					$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$paciente' AND ubicacion_fil='3' ORDER BY fecha_fil DESC ;");
				break;
			case '4':
					$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$paciente' AND ubicacion_fil='4' ORDER BY fecha_fil DESC ;");
				break;
			case '5':
					$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$paciente' AND ubicacion_fil='5' ORDER BY fecha_fil DESC ;");
				break;
			case '6':
					$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$paciente' AND ubicacion_fil='6' ORDER BY fecha_fil DESC ;");
				break;
			case '7':
					$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$paciente' AND ubicacion_fil='7' ORDER BY fecha_fil DESC ;");
				break;
			case '8':
					$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$paciente' AND ubicacion_fil='8' ORDER BY fecha_fil DESC ;");
				break;
			case '9':
					$ana=new AnamnesisCdu;
					$datos=$ana->Consultar_AnamnesisCdu("SELECT *  FROM  tbl_cduanamnesis WHERE id_pac='$paciente' AND est_cduanam='F' ORDER BY fechasa_cduanm DESC ;");
				break;
			case '10':
					$ana=new Epicrisis;
					$datos=$ana->Consultar_Epicrisis("SELECT * FROM tbl_epicrisis WHERE id_user='$paciente' AND estado_epi='F' ORDER BY fechaat_epi DESC;");
				break;
			case '11':
				$inte=new Solicitud;
				$datos=$inte->Consultar_Solicitud("SELECT * FROM tbl_solicitudinterconsulta WHERE id_pac='$paciente'  AND est_intsoli='F' ORDER BY  id_intsoli DESC");
				break;
			case '12':
				$info=new Informe;
				$datos=$info->Consultar_Informe("SELECT * FROM tbl_informeinterconsulta WHERE id_pac='$paciente' AND est_intinfo='F' ORDER BY id_intinfo DESC;");
				break;	
			case '13':
				$ci=new CitaCirugia;
				$datos=$ci->Consultar_CitaCirugia("SELECT * FROM tbl_citacirugia WHERE id_pac='$paciente';");
				break;				
		}
		foreach ($datos as $f) {

			if($archivo>0 & $archivo<9){
				$DPF[]=array(
				'Codigo' =>$paciente ,
				'URL'=>$f["url_fil"],
				'NOMBRE'=>$f["nombre_fil"],
				'FECHA'=>$f["fecha_fil"] );
			}elseif($archivo==9){
				$DPF[]=array(
				'Codigo' =>$paciente ,
				'URL'=> "../Reportes/AnamnesisCdu2.php?code=$f[id_cduanam]",
				'NOMBRE'=> "",
				'FECHA'=>$f["fechasa_cduanm"] );
			}elseif($archivo==10){
				$DPF[]=array(
				'Codigo' =>$paciente ,
				'URL'=> "../Reportes/EpicrisisImp2.php?Paci=$paciente&Epi=$f[id_epi]",
				'NOMBRE'=> "",
				'FECHA'=>$f["fechaat_epi"] );
			}elseif($archivo==11){
				$DPF[]=array(
				'Codigo' =>$paciente ,
				'URL'=> "../Reportes/SolicitudInterconsulta2.php?idPac=$paciente&id=$f[id_intsoli]",
				'NOMBRE'=> "",
				'FECHA'=> "" );
			}elseif($archivo==12){
				$DPF[]=array(
				'Codigo' =>$paciente ,
				'URL'=> "../Reportes/InformeInterconsulta2.php?idPac=$paciente&id=$f[id_intinfo]",
				'NOMBRE'=> "",
				'FECHA'=> "" );
			}
			elseif($archivo==13){
				$contar=$ci->Consultar("SELECT COUNT(*) FROM tbl_protocoloperatorio WHERE id_cir='$f[id_cir]';");
				if ($contar>0) {
					$IDPROTOCOLO=$ci->Consultar("SELECT id_pop FROM tbl_protocoloperatorio WHERE id_cir='$f[id_cir]';");
					$DPF[]=array(
						'Codigo' =>$paciente ,
						'URL'=> "../Reportes/ProtocoloOperatorio.php?code=$IDPROTOCOLO",
						'NOMBRE'=> "PROTOCOLO OPERATORIO",
						'FECHA'=> "" );
				}
			}
		}
		return json_encode($DPF);
	}

	//administrador altas y bajas
	public function BuscarAdm($buscar)
	{
		$user=new Usuario;
		$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='3' AND estado_usu='A' AND id_esp!='5' AND cedula_usu LIKE '$buscar%' OR nombresCom_usu LIKE '%$buscar%' AND id_rol='3' AND estado_usu='A' AND id_esp!='5' LIMIT 100;");
		$ADMIN = array();
		foreach ($datos as $f) {
			$ADMIN[]=array(
				'Codigo' =>$f["id_usu"] ,
				'Cedula'=>$f["cedula_usu"],
				'Usuario'=>$f["nombresCom_usu"],
				'Apellidos'=>$f["apellidos_usu"],
				'Nombre'=>$f["nombres_usu"],
				'Edad'=>$f["edad_usu"],
				'Direccion'=>$f["direccion_usu"],
				'Login'=>$f["login_usu"],
				'Clave'=>$f["pass_usu"],
				'Permisos'=>$f["id_esp"]
			 );
		}
		return json_encode($ADMIN);
	}
	public function SaveChangeAdmin()
	{
		$user=new Usuario;
		$admin=file_get_contents("php://input");
		$useadm=json_decode($admin);
		$user->Ejecutar("UPDATE tbl_usuario SET cedula_usu='".$useadm->Cedula."', apellidos_usu='".strtoupper($useadm->Apellidos)."',nombres_usu='".strtoupper($useadm->Nombres)."' , nombresCom_usu='".strtoupper($useadm->Apellidos." ".$useadm->Nombres)."', edad_usu='$useadm->Edad', direccion_usu='".strtoupper($useadm->Direccion)."', login_usu='".$useadm->Login."', pass_usu='".$useadm->Clave."',id_esp='".$useadm->Permisos."' WHERE id_usu='".$useadm->Codigo."';");
	}
	public function DeleteUserAdmin()
	{
		$user=new Usuario;
		$useradmin = file_get_contents("php://input");
		$admin=json_decode($useradmin);
		$user->Ejecutar("UPDATE tbl_usuario SET estado_usu='E', cedula_usu='' WHERE id_usu='$admin->Codigo'");
	}
	public function BuscarSecRece($buscar)
	{
		$user=new Usuario;
		$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='5' AND estado_usu='A' AND id_esp='16' AND cedula_usu LIKE '$buscar%' AND id_rol='5' AND id_esp='16' AND estado_usu='A' OR nombresCom_usu LIKE '%$buscar%'  AND id_rol='5' AND id_esp='16' AND estado_usu='A' LIMIT 100;");
		$SecRecep = array();
		foreach ($datos as $f) {
			$SecRecep[]=array(
				'Codigo' =>$f["id_usu"] ,
				'Cedula'=>$f["cedula_usu"],
				'Usuario'=>$f["nombresCom_usu"],
				'Apellidos'=>$f["apellidos_usu"],
				'Nombre'=>$f["nombres_usu"],
				'Edad'=>$f["edad_usu"],
				'Direccion'=>$f["direccion_usu"],
				'Login'=>$f["login_usu"],
				'Clave'=>$f["pass_usu"],
				'Permisos'=>$f["id_esp"]
			 );
		}
		return json_encode($SecRecep);
	}
	//modificar varios usuarios
	public function SaveVariosUsers()
	{
		$user=new Usuario;
		$admin=file_get_contents("php://input");
		$useadm=json_decode($admin);
		$user->Ejecutar("UPDATE tbl_usuario SET cedula_usu='".$useadm->Cedula."', apellidos_usu='".strtoupper($useadm->Apellidos)."',nombres_usu='".strtoupper($useadm->Nombres)."' , nombresCom_usu='".strtoupper($useadm->Apellidos." ".$useadm->Nombres)."', edad_usu='$useadm->Edad', direccion_usu='".strtoupper($useadm->Direccion)."', login_usu='".$useadm->Login."', pass_usu='".$useadm->Clave."',id_esp='".$useadm->Permisos."' WHERE id_usu='".$useadm->Codigo."';");
	}

	public function DataDigitador($buscar)
	{
		$user=new Usuario;
		$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='8' AND estado_usu='A' AND id_esp='16' AND cedula_usu LIKE '$buscar%' OR id_rol='8' AND id_esp='16' AND estado_usu='A' AND nombresCom_usu LIKE '$buscar%' AND id_rol='8' AND id_esp='16' AND estado_usu='A'  LIMIT 100;");
		$Digit = array();
		foreach ($datos as $f) {
			$Digit[]=array(
				'Codigo' =>$f["id_usu"] ,
				'Cedula'=>$f["cedula_usu"],
				'Usuario'=>$f["nombresCom_usu"],
				'Apellidos'=>$f["apellidos_usu"],
				'Nombre'=>$f["nombres_usu"],
				'Edad'=>$f["edad_usu"],
				'Direccion'=>$f["direccion_usu"],
				'Login'=>$f["login_usu"],
				'Clave'=>$f["pass_usu"],
				'Permisos'=>$f["id_esp"]
			 );
		}
		return json_encode($Digit);
	}

	public function DataTimeCitasNormales($Fecha,$IDMedico)
	{
			$aux=new Turno;
			$aux1=new Usuario;
			$aux2=new Hora;
			$dato=$aux->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$Fecha' and id_usu='$IDMedico' AND estado_tur!='E';");
			$CitasT=array();
			if(count($dato)>0)
			{
					$tu= array();
					$ho= array();
					foreach($dato as $fila)
					{
						$tu[]=($fila['id_hor']);
					}
					$dato1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
						foreach($dato1 as $fila1)
						{
								$ho[]=($fila1['id_hor']);
						}
						$contar=count($ho);
						for($x=0;$x<count($tu);$x++)
						{
							for($y=0;$y<count($ho);$y++)
							{
								if(isset($ho[$y])){
								if($ho[$y]==$tu[$x])
								{
									Unset($ho[$y]);
								}
								}
							}
						}
						for($z=0;$z<$contar;$z++)
						{
							if(isset($ho[$z]))
							{
							$des=$aux1->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$ho[$z]' ");
								$CitasT[]=array(
										'ID' => $ho[$z],
										'Time'=> $des 
									);
							}
						}
						//return json_encode($CitasT);
			}
			else
			{
				$datos1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
				foreach($datos1 as $filas1)
				{
					$CitasT[]=array(
									'ID' => $filas1["id_hor"],
									'Time'=> $filas1["hora_hor"]
									);
				}
				//return json_encode($CitasT);
			}
			return json_encode($CitasT);
	}

	public function GenerarTurnoOCita()
	{
		$tu=new Turno;
		session_start();
		$usuE=NULL;
		if(isset($_SESSION['ENFERMERA'])) $usuE=$_SESSION['ENFERMERA'];
    	elseif(isset($_SESSION['DOCTOR'])) $usuE=$_SESSION['DOCTOR'];
    	$cita=file_get_contents("php://input");
		$cit=json_decode($cita);
		$fechaR =$this->Mifecha();
		$turno=$tu->Consultar("SELECT MAX(numero_tur) FROM tbl_turno WHERE fechaC_tu='$cit->FechaConsulta' AND id_usu='$cit->MedicoID';");
		$turno=$turno+1;
		$tu->Ejecutar("INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES('$cit->MedicoID','$cit->PacienteID','$cit->HoraCita','$cit->FechaReserva','$cit->FechaConsulta','$usuE','$turno','AE');");
		$tu->Ejecutar("UPDATE tbl_paciente SET auxmovimiento_pac='TRATAMIENTO' WHERE id_pac='$cit->PacienteID';");
		$codigo=$tu->Consultar("SELECT MAX(id_tu) FROM tbl_turno");
		
		//capturando acciones
		$idusu2015=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES");
		$tu->Ejecutar($sql2015);
		//capturando acciones

		return $codigo;
	}
	public function DiasF($Month,$Year){
		return date("d",mktime(0,0,0,$Month+1,0,$Year));
	}
	public function BuscarCitaMedico($Medico,$Fecha,$Fecha2,$Control)
	{
		$tur=new Turno;
		$datos=NULL;
		switch ($Control) {
			case 1:
					$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$Medico' AND fechaC_tu='$Fecha'  ORDER BY  id_hor ASC ;");		
				break;
			case 2:
					$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$Medico' AND fechaC_tu>='$Fecha' AND fechaC_tu<='$Fecha2'  ORDER BY  id_hor ASC ;");
				break;
			case 3:
				$fi=date("y")."-".$Fecha."-01";
				$diasfin=$this->DiasF($Fecha,date("y"));
				$ff=date("y")."-".$Fecha."-$diasfin";
				$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$Medico' AND fechaC_tu>='$fi' AND fechaC_tu<='$ff'  ORDER BY  id_hor ASC ;");
				break;
		}
		
		$estadoCita=NULL;
		$DatosCitas=array();
		if(count($datos)>0){
			foreach ($datos as $c) {
				$paciente=$tur->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$paciente=utf8_encode($paciente);
				$TELEFONO=$tur->Consultar("SELECT telefono_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$Celular=$tur->Consultar("SELECT celular_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$hora=$tur->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$c[id_hor]';");
				$fechaRegistro=$tur->Consultar("SELECT fechaiauto_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$fechaFinRegistro=$tur->Consultar("SELECT fechafauto_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				switch ($c["estado_tur"]) {
					case 'AE':
						 $estadoCita="Agendada";
						break;
					case 'E':
						 $estadoCita="Cancelada";
						break;
					case 'RM':
						 $estadoCita="Completada";
						break;
				}
				$DatosCitas[]=array(
					'Paciente' => $paciente,
					'Telefono'=>$TELEFONO,
					'Celular'=>$Celular,
					'Hora'=>$hora,
					'FechaRegistro'=>$fechaRegistro,
					'FechaFinRegistro'=>$fechaFinRegistro,
					'EstadoCita'=>$estadoCita,
					"FechaConsulta"=>$c["fechaC_tu"] );
			}
		}

		return json_encode($DatosCitas);
	}

	public function AdelantarFecha($modo,$valor,$fecha_inicio=false){
	   if($fecha_inicio!=false) {
	          $fecha_base = strtotime($fecha_inicio);
	   }else {
	          $time=time();
	          $fecha_actual=date("Y-m-d",$time);
	          $fecha_base=strtotime($fecha_actual);
	   }
	   $calculo = strtotime("$valor $modo","$fecha_base");
	   return date("Y-m-d", $calculo);
	}
	public function CargarVistaCitasPorSemana2($backandnext,$persona)
	{
		
		$tur=new Turno;
		$HO=new Hora;
		$today=NULL;
		$LUNES=NULL;
		$MARTES=NULL;
		$MIERCOLES=NULL;
		$JUEVES=NULL;
		$VIERNES=NULL;
		$SABADO=NULL;
		$DOMINGO=NULL;
		$LUNES2=NULL;
		$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
	
		$today=$this->Mifecha();
		$NUMERODIA=date('N', strtotime($backandnext))-1;
		if($NUMERODIA==0){
				$LUNES2=$backandnext;
		}else{
			 	$LUNES2=$this->AdelantarFecha("days",-$NUMERODIA,$backandnext);
		}
			
		$LUNES=$LUNES2;
		$MARTES=$this->AdelantarFecha("days",1,$LUNES);
		$MIERCOLES=$this->AdelantarFecha("days",2,$LUNES);
		$JUEVES=$this->AdelantarFecha("days",3,$LUNES);
		$VIERNES=$this->AdelantarFecha("days",4,$LUNES);
		$SABADO=$this->AdelantarFecha("days",5,$LUNES);
		$DOMINGO=$this->AdelantarFecha("days",6,$LUNES);
		$vecLunes=NULL;
		$vecMartes=NULL;
		$vecMiercoles=NULL;
		$vecJueves=NULL;
		$vecViernes=NULL;
		$vecSabado=NULL;
		$vecDomingo=NULL;
		$datos2=$HO->Consultar_Hora("SELECT * FROM tbl_hora;");
		//vector con las fechas de los dias  

		$LunesVec=array();
		$MartesVec=array();
		$MiercolesVec=array();
		$JuevesVec=array();
		$Viernes=array();
		$SabadoVec=array();
		$DomingoVec=array();
		$SemanaVec=array();
		$dataH=array();
		foreach ($datos2 as $h) {
			
				$dataH[]=array(
					'Codigo' => $h["id_hor"],
					'Hora' => $h["hora_hor"]);

				
				if($persona==""){
					$vecLunes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$LUNES' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecLunes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$LUNES' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				$MEDICO=NULL;
				if(count($vecLunes)>0){
					foreach ($vecLunes as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						$LunesVec[]=array(
							'Estado' =>$ESTADO,
							'Medico'=> $MEDICO,
							'Hora'=>$h["id_hor"] );
					}
				}else{
					$LunesVec[]=array(
							'Estado' =>"",
							'Medico'=> "",
							'Hora'=>$h["id_hor"]);
				}
				if($persona==""){
					$vecMartes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$MARTES' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecMartes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$MARTES' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				if (count($vecMartes)>0) {
					foreach ($vecMartes as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						$MartesVec[]=array(
							'Estado' =>$ESTADO,
							'Medico'=> $MEDICO,
							'Hora'=>$h["id_hor"] );
					}
				}else{
					$MartesVec[]=array(
							'Estado' =>"",
							'Medico'=> "",
							'Hora'=>$h["id_hor"] );
				}
				
		}

		$SemanaVec[]=array(
			'Horas'=>$dataH,
			'Lunes' =>$LunesVec ,
			'Martes'=>$MartesVec );
		return json_encode($SemanaVec);
	}

}