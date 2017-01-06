<?php
include "LugarCirugia.php";
include "LugarTurnoCir.php";

class LogicaCirugia
{
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
                if (bisiesto($array_actual[0])) 
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

			 $edad="$anio_dif años con $meses meses y $dias días";			
			 return $edad;
			
	}
	//fin de la funcion para calcular la edad de lospaciente
	//metodo que carga el formulario para el login
	//metodo que carga el formulario para el login
	public function CargarFormulacioLogi()
	{
		$rl=new Rol;
		$datos=$rl->Consultar_Rol("SELECT * FROM tbl_rol WHERE estado_rol='A'");
		echo "
				<form action='Dominio/login.php' method='post'>
				<table>
				<tr>
					<td>Usuario: </td>
					<td><input type='text' name='txtUser'/></td>
				</tr>
				<tr>
					<td>Password: </td>
					<td><input type='password' name='txtPass'/></td>
				</tr>				
				<tr>
					<td>Seleccione: </td>
					<td><select name='cmbtipo'><option value=''>Seleccione un rol</option>				
			 ";
			 foreach($datos as $fila)
			 {
				 echo "<option value='$fila[id_rol]'>$fila[descripcion_rol]</option>";
			 }
			 echo "
			 	</td>
				</tr>
				<tr>
					<td colspan='2'><input type='submit' name='bntOk' value='Ingresar'/></td>
				</tr>
				</table>
				</form>
			 	  ";
	}
	//fin del metodo que carga el formulario para el login	
	//inicio del metoodo para cargar las busquedas del paciente
	public function BuscarXPeticionPacinete($buscar,$por,$codRol)
	{
		$pac=new Paciente;
		if($por=="ced")
		{
			$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE cedula_pac LIKE '$buscar%' AND estado_pac='A'");
			if(count($datos)>0)
			{
			echo "
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTabla'>
				<thead>
					<tr class='fila'>
						<td>Cédula</td>
						<td>Nombres Completos</td>
						<td>Edad</td>
						<td>Dirección</td>
						<td>Asignar</td>
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 		<tr>
								<td>$fila[cedula_pac]</td>
								<td>$fila[nombresCom_pac]</td>
								<td>$fila[fechaN_pac]</td>
								<td>$fila[direccion_pac]</td>";
								if($codRol==1)
								{
								echo "
								<td><input type='button' id='bntAsignarPacADoc' class='btn btn-success' onclick='ShowAsignarPacADoc($fila[id_pac]);' value='Asignar Doctor'/></td>
							</tr>
					       ";
								}
								if($codRol==2)
								{
								echo "
								<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='AsignarPaciente($fila[id_pac]);' value='Agendar'/></td>
							</tr>
					       ";
								}
								if($codRol==3)
								{
								echo "
								<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='AsignarPacienteEmeregencia($fila[id_pac]);' value='Agendar Emergencia'/></td>
							</tr>
					       ";
								}
								if($codRol==4)/*si el doctor ase la reserva del turno*/
								{
								echo "
								<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='AgendarPacienteXDoctor($fila[id_pac]);' value='Agendar'/></td>
							</tr>
					       ";
								}								
				 }
				 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers', 
							'bFilter': true, 
							
							'oLanguage':{
										'sProcessing':     'Procesando...',
										'sLengthMenu':     'Mostrar _MENU_ registros',
										'sZeroRecords':    'No se encontraron resultados',
										'sEmptyTable':     'Ningún dato disponible en esta tabla',
										'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
										'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
										'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
										'sInfoPostFix':    '',
										'sSearch':         'Buscar:',
										'sUrl':            '',
										'sInfoThousands':  ',',
										'sLoadingRecords': 'Cargando...',
										'oPaginate': {
													'sFirst':    'Primero',
													'sLast':     'Último',
													'sNext':     'Siguiente',
													'sPrevious': 'Anterior'
													},
													'oAria': {
															'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
															'sSortDescending': ': Activar para ordenar la columna de manera descendente'
															}
										}
						});
						$('.boton').button();
					</script>
				 ";				
			}
			else
			{
				echo "No existe un paciente con esta cédula";
			}
				 
		}
		

		if($por=="ape")
		{
			$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE nombresCom_pac LIKE '$buscar%' AND estado_pac='A'");
			if(count($datos)>0)
			{
			echo "
				<div class='demo_jui'>
				<table cellpadding='0' cellspacing='0' id='MiTabla'>
				<thead>
					<tr class='fila'>
						<td>Cedula</td>
						<td>Nombres Completos</td>
						<td>Edad</td>
						<td>Direccion</td>
						<td>Asignar</td>
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 		<tr class='fila'>
								<td>$fila[cedula_pac]</td>
								<td>$fila[nombresCom_pac]</td>
								<td>$fila[fechaN_pac]</td>
								<td>$fila[direccion_pac]</td>";
								if($codRol==1)
								{
								echo "
								<td><input type='button' id='bntAsignarPacADoc' class='btn btn-success' onclick='ShowAsignarPacADoc($fila[id_pac]);' value='Asignar Doctor'/></td>
							</tr>
					       ";
								}
								if($codRol==2)
								{
								echo "
								<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='AsignarPaciente($fila[id_pac]);' value='Agendar'/></td>
							</tr>
					       ";
								}
								if($codRol==3)
								{
									echo "
										<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='AsignarPacienteEmeregencia($fila[id_pac]);' value='Agendar Emergencia'/></td>
									</tr>
								   ";									
								}
								if($codRol==4)/*si el doctor ase la reserva del turno*/
								{
								echo "
								<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='AgendarPacienteXDoctor($fila[id_pac]);' value='Agendar'/></td>
							</tr>
					       ";
								}								
				 }
				 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers', 
							'bFilter': true, 
							
							'oLanguage':{
										'sProcessing':     'Procesando...',
										'sLengthMenu':     'Mostrar _MENU_ registros',
										'sZeroRecords':    'No se encontraron resultados',
										'sEmptyTable':     'Ningún dato disponible en esta tabla',
										'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
										'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
										'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
										'sInfoPostFix':    '',
										'sSearch':         'Buscar:',
										'sUrl':            '',
										'sInfoThousands':  ',',
										'sLoadingRecords': 'Cargando...',
										'oPaginate': {
													'sFirst':    'Primero',
													'sLast':     'Último',
													'sNext':     'Siguiente',
													'sPrevious': 'Anterior'
													},
													'oAria': {
															'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
															'sSortDescending': ': Activar para ordenar la columna de manera descendente'
															}
										}
						});
						$('.boton').button();
					</script>
				 ";				
			}
			else
			{
				echo "No existe un paciente con estos apellidos";
			}
				 
		}		
		
		
		
	}
	//fin del metoodo para cargar las busquedas del paciente
	//inicio del metodo para carga los combos de  especialidades 
	public function CargarEspecialidadesParaAsignar()
	{
		$esp=new Especialidad;
		$datos=$esp->Consultar_Especialidad("SELECT * FROM tbl_especialida WHERE estado_esp='MA'");
		echo "
				<table>
				<tr>
					<td>Especialida: </td>
					<td><select id='cmbEspec' onchange='CargarDoctores()'><option value=''>Seleccione</option>
			 ";
			 foreach($datos as $fila)
			 {
				 echo "<option value='$fila[id_esp]'>$fila[descripcion_esp]</option>";
			 }
		echo "
					</select>
					</td>
				</tr>
				<tr>
					<td>
						Médico:
					</td>
					<td>
						<div id='AreaDoctores'>
							<select id='cmbDoctor'>
								<option value=''>Selecione</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan='2'><input type='button' class='btn btn-success' value='Asignar' id='bntAsignar' onclick='FormarCamposAsgnar()'/></td>
				</tr>
				</table>
					<script type='text/javascript'>												
					</script>
				
			 ";
	}
	//fin del metodo para carga los combos de  especialidades 
	//inicio del metodo para caargar los combos de doctor segun la especialidad
	public function CargarDoctoresXEspe($especialidad)
	{
		$doc=new Usuario;
		$datos=$doc->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='1' AND id_esp='$especialidad' AND estado_usu='A'");
		echo "<select id='cmbDoctor'><option value=''>Seleccione</option>
		     ";
			 foreach($datos as $fila)
			 {
				 echo "<option value='$fila[id_usu]'>$fila[nombresCom_usu]</option>";
			 }
		echo "</select>";
	}
	//fin del metodo para caargar los combos de doctor segun la especialidad	
	//incio del combo de horas disponibles
		public function cargarhorario($fecha,$iddoctor)
		{
			$aux=new Turno;
			$aux1=new Usuario;
			$aux2=new Hora;
			$dato=$aux->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$fecha' and id_usu='$iddoctor'");
			echo "
			<table>
			<tr>
			<td>Seleccione: </td>
			<td>
			<select id='cmb_horas' > <option>Seleccione un horario</option>";
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
							echo "<option value='$ho[$z]'>$des</option>";
							}

						}
			}
			else
			{
				$datos1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
				foreach($datos1 as $filas1)
				{
					echo "<option value='$filas1[id_hor]'>$filas1[hora_hor]</option>";
				}
			}

			
			echo "</select></td><td><input type='button' class='btn btn-success' id='bntDarTurno' value='Dar Turno' onclick='GenerarTurnoPaciente();'/></td>
			</tr>
			</table>
					<script type='text/javascript'>						
						$('#bntDarTurno').button();						
					</script>
			
			";
		}	
	//fin del combo de horas disponbles
	//inicio del metodo para generar el turno
	public function GenerarTurno($paciente,$especialidad,$doctor,$fechaC,$hora)
	{
		$tu=new Turno;
		session_start();
		$usuE=$_SESSION['ENFERMERA'];
		//$fechaR=date("y-m-d"); //fecha antigua
		$fechaR =$this->Mifecha();
		$turno=$tu->Consultar("SELECT MAX(numero_tur) FROM tbl_turno WHERE fechaC_tu='$fechaC'");
		$turno=$turno+1;
		$tu->Ejecutar("INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES('$doctor','$paciente','$hora','$fechaR','$fechaC','$usuE','$turno','AE');");
		$codigo=$tu->Consultar("SELECT MAX(id_tu) FROM tbl_turno");
		echo "<table>
				<tr>
					<td>Se asigno el turno correctamente</td>
					<td><input type='button' id='bntImprimir'  class='btn btn-success' onclick='ImprimirTurno($codigo)' value='Imprimir Turno'/></td>
					<td><input type='button' id='bntNewturno'  class='btn btn-primary' value='Nuevo Turno'/></td>
				</tr>
			  </table>
					<script type='text/javascript'>						
						
						$('#bntNewturno').click(function()
						{
							location.reload();
						});
					</script>			  
			  ";
	}
	//fin del metodo para generar el turno por doctor
	public function GenerarTurnoXCirugia($paciente,$fechaC,$hora)
	{
		$tu=new Turno;
		session_start();
		$usuE=$_SESSION['DOCTOR'];
		$doctor=$tu->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$usuE' AND id_rol='1' AND estado_usu='A'");
		//$fechaR=date("y-m-d");//fecha antigua 
		$fechaR=$this->Mifecha();
		$turno=$tu->Consultar("SELECT MAX(numero_tur) FROM tbl_turno WHERE fechaC_tu='$fechaC'");
		$turno=$turno+1;
		$tu->Ejecutar("INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES('$doctor','$paciente','$hora','$fechaR','$fechaC','$usuE','$turno','AE');");
		$codigo=$tu->Consultar("SELECT MAX(id_tu) FROM tbl_turno");
		echo "<table>
				<tr>
					<td>Se asigno el turno correctamente</td>
					<td><input type='button' id='bntImprimir' onclick='ImprimirTurno($codigo)' value='Imprimir Turno'/></td>
					
				</tr>
			  </table>
					<script type='text/javascript'>						
						$('#bntImprimir').button();
						$('#bntNewturno').button();						
						$('#bntNewturno').click(function()
						{
							location.reload();
						});
					</script>			  
			  ";
	}
	//fin del metodo para generar el turno por doctor	
	
	//inicio del metodo para agregar un nuevo paciente
	public function NewPaciente($cedula,$passoporte,$apellidos,$nombres,$otros,$fechaNac,$lugarNac,$lugarRes,$sexo,$raza,$religion,$estadoCivil,$instrucion,$profesion,$opcupacion,$condicionpac,$direccion,$telefonoDomi,$telefonoTraba,$celular,$correo,$referencia,$telefonoRefere)
	{
		$pac=new Paciente;
		if($pac->Consultar("SELECT COUNT(*) FROM tbl_paciente WHERE cedula_pac='$cedula'")==0)
		{
			$apellidos=strtoupper($apellidos);
			$nombres=strtoupper($nombres);
			$comple=$apellidos." ".$nombres;
			$direccion=strtoupper($direccion);
			$pac->Ejecutar("INSERT INTO tbl_paciente (cedula_pac,pasaporte_pac,apellidos_pac,nombres_pac,nombresCom_pac,otros_pac,fechaN_pac,lugarnac_pac,lugresid_pac,sexo_pac,raza_pac,religion_pac,estadociv_pac,instruccion_pac,profesion_pac,ocupacion_pac,condicion_pac,direccion_pac,telefono_pac,telefonoTra_pac,celular_pac,correo_pac,nombresReferencia_pac,telefonoReferencia_pac,estado_pac)
VALUE('$cedula','$passoporte','$apellidos','$nombres','$comple','$otros','$fechaNac','$lugarNac','$lugarRes','$sexo','$raza','$religion','$estadoCivil','$instrucion','$profesion','$opcupacion','$condicionpac','$direccion','$telefonoDomi','$telefonoTraba','$celular','$correo','$referencia','$telefonoRefere','A')");
			echo "
					<h3>Se agregó correctamente el nuevo paciente</h3>
				 ";
		}
		else
		{
			echo "
					<h3>Ya existe un paciente con este número de cédula</h3>
				 ";
			
		}
	}
	//fin del metodo para agregar un nuevo paciente
	
	public function CargarLugarCirugia($lugar)
	{
		$Ciru=new LugarCirugia();
		$datoLu=$Ciru->Ejecutar("INSERT INTO tbl_lugar (Lugar_Cirugia,est_lugar) VALUE ('$lugar','A')");
		$datoIdLu=$Ciru->Consultar("SELECT MAX(id_lugar) FROM tbl_lugar");
		$datoTur=$Ciru->Consultar("SELECT MAX(id_tu) FROM tbl_turno");
		$datosLuTur=$Ciru->Ejecutar("INSERT INTO tbl_lugar_turno (id_tu,id_lugar,est_lugar_turno) VALUES ('$datoTur','$datoIdLu','A')");
	}

	
	
	//inicio de la funcio para cargar las consulatas de hoy
	public function ConsultasDeHoyXCirugia()
	{
		$cons=new Consulta;
		session_start();
		$user=$_SESSION['DOCTOR'];

		//$fecha=date("y-m-d");	// fecha antigua
		$fecha=$this->Mifecha();
		$datos=$cons->Consultar_hoy_cirugia($user,$fecha);
					echo "
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTabla1'>
				<thead>
					<tr class='fila'>
						<td>Hora</td>
						<td>Cédula</td>
						<td>Nombres</td>
						<td>Lugar</td>
						<td>Estado Pago</td>
						<td>Ingresar</td>
						<td>Modificar Pago</td>
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 	<tr>
							<td>$fila[hora_hor]</td>
							<td>$fila[Cedula_Paciente]</td>
							<td>$fila[Nombres_Paciente]</td>
							<td>$fila[Lugar_Cirugia]</td>
							<td>$fila[estadoPa_tur]</td>
							";
							
							
							echo "<td><input type='button' class='btn' value='Ingresar' id='bntDiagnosticar' onclick='DiagnosticarCir($fila[Codigo],$fila[CodigoPaciente])'/></td>
								<td><input type='button' class='btn' value='Ingresar' id='bntPago' onclick='EstadoPago($fila[Codigo])'/></td>
						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla1').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers', 
							'bFilter': true, 
							
							'oLanguage':{
										'sProcessing':     'Procesando...',
										'sLengthMenu':     'Mostrar _MENU_ registros',
										'sZeroRecords':    'No se encontraron resultados',
										'sEmptyTable':     'Ningún dato disponible en esta tabla',
										'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
										'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
										'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
										'sInfoPostFix':    '',
										'sSearch':         'Buscar:',
										'sUrl':            '',
										'sInfoThousands':  ',',
										'sLoadingRecords': 'Cargando...',
										'oPaginate': {
													'sFirst':    'Primero',
													'sLast':     'Último',
													'sNext':     'Siguiente',
													'sPrevious': 'Anterior'
													},
													'oAria': {
															'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
															'sSortDescending': ': Activar para ordenar la columna de manera descendente'
															}
										}
						});
						$('.boton').button();
					</script>
				 ";					
	}
	//fin de la funcio para cargar las consulatas de hoy	
	//incio del metodo para agregar la consulta
	public function SaveDiagnostico($diagnostico,$tratamiento,$examnes,$turno,$fechapr)
	{
		$conp=new Consultas;
			$conp->Ejecutar("INSERT INTO tbl_consultas (fechaProx_cons,estado_cons,diagnostico_cons,examenes_cons,tratamiento_cons,id_tu) VALUES('$fechapr','MD','$diagnostico','$examnes','$tratamiento','$turno')");
			$conp->Ejecutar("UPDATE tbl_turno SET estado_tur='MD' WHERE id_tu='$turno'");
			$cod=$conp->Consultar("SELECT MAX(id_cons) FROM tbl_consultas");
			echo "<input type='hidden' id='txtCodCons' value='$cod'/> ";
	}
	//fin del metodo para agregar la consulta	
	public function CargarFarmacos($codigo)
	{
		$far=new Farmacos;
		$datos=$far->Consultar_Farmacos("SELECT * FROM tbl_farmacos WHERE estado_far='A' AND estock_far>0");
					echo "
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTabla2'>
				<thead>
					<tr class='fila'>
						<td>Descripcion</td>
						<td>Foto</td>
						<td>Fecha C.</td>
						<td>Estock</td>
						<td>Agregar</td>
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 	<tr>
							<td>$fila[descripcion_far]</td>
							<td><div id='Imagenes'><img src='../Bodega/$fila[foto_far]'/></div></td>
							<td>$fila[Fecaduca_far]</td>
							<td>$fila[estock_far]</td>
							<td><input type='button' value='Diagnosticar' id='bntDarFar' onclick='AsFarma($fila[id_far],$codigo)'/></td>
						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla2').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers',
							'bFilter': true,
							
							'oLanguage':{
											'sProcessing':     'Procesando...',
											'sLengthMenu':     'Mostrar _MENU_ registros',
											'sZeroRecords':    'No se encontraron resultados',
											'sEmptyTable':     'Ningún dato disponible en esta tabla',
											'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
											'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
											'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
											'sInfoPostFix':    '',
											'sSearch':         'Buscar:',
											'sUrl':            '',
											'sInfoThousands':  ',',
											'sLoadingRecords': 'Cargando...',
											'oPaginate': {
															'sFirst':    'Primero',
															'sLast':     'Último',
															'sNext':     'Siguiente',
															'sPrevious': 'Anterior'
														},
														'oAria': {
																	'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
																	'sSortDescending': ': Activar para ordenar la columna de manera descendente'
																}
										}
						});
						$('#bntNewRol').button();
					</script> ";				
		
	}
	
	public function AgregarFarmacosALareceta($farmaco,$consulta,$cantidad,$indicaciones)
	{
		$rec=new Receta;
		$rec->Ejecutar("INSERT INTO tbl_receta (cantidad,indicaciones,id_far,id_cons) VALUES('$cantidad','$indicaciones','$farmaco','$consulta')");
		
		$total=$rec->Consultar("SELECT estock_far FROM tbl_farmacos WHERE id_far='$farmaco'");
		$totalAct=$total-$cantidad;
		$rec->Ejecutar("UPDATE tbl_farmacos SET estock_far='$totalAct' WHERE id_far='$farmaco'");
		
		echo "<input type='button' id='bntImprimirReceta' value='Imprimir Receta' onclick='ImprimirReceta($consulta)'/>
			<input type='button' id='bntnewDig' value='Nuevo Diagnostico'/>
		<script type='text/javascript'>
			$('#bntImprimirReceta').button();
			$('#bntnewDig').button();			
			$('#bntnewDig').click(function()
			{
				location.reload();
			});
		</script>						
		";
	}
	public function LoadUsuarios()
	{
		$user=new Usuario;
		$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE estado_usu='A'");
					echo "
					<input type='button' id='bntNewUser' class='btn' onclick='ShowNewUser()' value='Nuevo Usuario'>
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTabla2'>
				<thead>
					<tr class='fila'>
						<td>Nombres</td>
						<td>Dirección</td>
						<td>Rol</td>
						<td>Especialidad</td>
						<td>Modificar</td>
						<td>Eliminar</td>						
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 $roles=$user->Consultar("SELECT descripcion_rol FROM tbl_rol WHERE id_rol='$fila[id_rol]'");
					 $esp=$user->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$fila[id_esp]'");
					 echo "
					 	<tr>
							<td>$fila[nombresCom_usu]</td>
							<td>$fila[direccion_usu]</td>
							<td>$roles</td>
							<td>$esp</td>
							<td><input type='button' value='Modificar' id='bntShowModUser' class='btn' onclick='ShowModificarUser($fila[id_usu])'/></td>
							<td><input type='button' value='Eliminar' id='bntShowDeleteUser' class='btn' onclick='ShowDeleteUser($fila[id_usu])'/></td>

						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla2').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers',
							'bFilter': true,
							
							'oLanguage':{
											'sProcessing':     'Procesando...',
											'sLengthMenu':     'Mostrar _MENU_ registros',
											'sZeroRecords':    'No se encontraron resultados',
											'sEmptyTable':     'Ningún dato disponible en esta tabla',
											'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
											'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
											'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
											'sInfoPostFix':    '',
											'sSearch':         'Buscar:',
											'sUrl':            '',
											'sInfoThousands':  ',',
											'sLoadingRecords': 'Cargando...',
											'oPaginate': {
															'sFirst':    'Primero',
															'sLast':     'Último',
															'sNext':     'Siguiente',
															'sPrevious': 'Anterior'
														},
														'oAria': {
																	'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
																	'sSortDescending': ': Activar para ordenar la columna de manera descendente'
																}
										}
						});
						$('#bntNewRol').button();
					</script> ";					
	}
	
	public function CargarNuevoUsuario()
	{
		$rl=new Rol;
		$esp=new Especialidad;
		$datos=$rl->Consultar_Rol("SELECT * FROM tbl_rol");
		$datos1=$esp->Consultar_Especialidad("SELECT * FROM tbl_especialida");
		echo "
				<table>
				<tr>
					<td>Cédula</td>
					<td><input type='text' id='txtCedula'/></td>
				</tr>
				<tr>
					<td>Apellido</td>
					<td><input type='text' id='txtapellido'/></td>
				</tr>				
				<tr>
					<td>Nombres</td>
					<td><input type='text' id='txtnombres'/></td>
				</tr>								
				<tr>
					<td>Edad</td>
					<td><input type='text' id='txtEdad'/></td>
				</tr>								
				<tr>
					<td>Dirección</td>
					<td><input type='text' id='txtDireccion'/></td>
				</tr>								
				<tr>
					<td>Usuario</td>
					<td><input type='text' id='txtLogin'/></td>
				</tr>								
				<tr>
					<td>Clave</td>
					<td><input type='text' id='txtpassword'/></td>
				</tr>								
				<tr>
					<td>Seleccione</td>
					<td><select id='cmbrol'><option value=''>Seleccione rol</option>
			 ";
			 foreach($datos as $fila)
			 {
				 echo "<option value='$fila[id_rol]'>$fila[descripcion_rol]</option>";
			 }
			 echo "
			 		</td>
					</tr>
				<tr>
					<td>Seleccione</td>
					<td><select id='cmbesp'><option value=''>Seleccione especialidad</option>					
			 	  ";
			foreach($datos1 as $fila1)
			{
				 echo "<option value='$fila1[id_esp]'>$fila1[descripcion_esp]</option>";				
			}
			echo "
					</td>
					</tr>
					<tr>
						<td colspan='2'><input type='button' class='btn' value='Guardar' id='bntSaveUser' onclick='SaveUser()'></td>
					</tr>
				</table>
				</div>
					<script type='text/javascript'>						
				
						$('#bntSaveUser').button();
					$('#txtCedula').validarCedulaEC({
						  onValid: function () {
							console.log(this);
							$('#bntSaveUser').removeAttr('disabled');	
							$('#txtCedula').css('background','green');
						},
						onInvalid: function () {
						  console.log(this);
						  window.alert('cédula inválida.');
						  $('#txtCedula').css('background','red');
						  $('#bntSaveUser').attr('disabled','true');	
						}
					  });
						
					</script>
					
					
				 ";		
	}
	public function SaveUser($cedula,$nombre,$apellido,$edad,$direccion,$login,$pass,$rl,$esp)
	{
		$user=new Usuario;
		if($user->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE cedula_usu='$cedula'")==0)
		{
			$apellido=strtoupper($apellido);
			$nombre=strtoupper($nombre);
			$completo=$apellido." ".$nombre;
			$user->Ejecutar("INSERT INTO tbl_usuario (cedula_usu,apellidos_usu,nombres_usu,nombresCom_usu,edad_usu,login_usu,pass_usu,direccion_usu,estado_usu,id_rol,id_esp) VALUES('$cedula','$apellido','$nombre','$completo','$edad','$login','$pass','$direccion','A','$rl','$esp')");
			echo "<h3>Se agregó el usuario</h3>";			
		}
		else
		{
			echo "<h3>Ya existe un usuario con este n+umero de cédula</h3>";			
		}
	}
	public function LoadDatosParaModUser($codigoUser)
	{
		$user=new Usuario;
		$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_usu='$codigoUser'");
		echo  "
				<table>
			  ";
			  foreach($datos as $fila)
			  {
				  echo "
				  		<tr>
				  			<td>Apellidos</td>
							<td><input type='text' id='txtApeUs' value='$fila[apellidos_usu]'/></td>
				  		</tr>
				  		<tr>
				  			<td>Nombres</td>
							<td><input type='text' id='txtNombUs' value='$fila[nombres_usu]'/></td>
				  		</tr>
				  		<tr>
				  			<td>edad</td>
							<td><input type='text' id='txtEdadUs' value='$fila[edad_usu]'/></td>
				  		</tr>												
				  		<tr>
				  			<td>Usuario</td>
							<td><input type='text' id='txtLogdUs' value='$fila[login_usu]'/></td>
				  		</tr>												
				  		<tr>
				  			<td>Clave</td>
							<td><input type='text' id='txtPassdUs' value='$fila[pass_usu]'/></td>
				  		</tr>												
				  		<tr>
				  			<td>Dirección</td>
							<td><input type='text' id='txtDirecUs' value='$fila[direccion_usu]'/></td>
				  		</tr>												
				  		<tr>
							<td colspan='2'><input type='button' id='bntOkMd' class='btn' value='Modificar' onclick='ModificarUser($codigoUser)' /></td>
				  		</tr>												
						
				  	   ";
			  }
		echo "</table>
				<script type='text/javascript'>
					$('#bntOkMd').button();
				</script>
			";
	}
	public function ModifyUsuario($codigo,$apellido,$nombre,$edad,$login,$pass,$direccion)
	{
		$user=new Usuario;
		$apellido=strtoupper($apellido);
		$nombre=strtoupper($nombre);
		$complete=$apellido." ".$nombre;
		$direccion=strtoupper($direccion);
		$user->Ejecutar("UPDATE tbl_usuario SET apellidos_usu='$apellido', nombres_usu='$nombre', nombresCom_usu='$complete', edad_usu='$edad', login_usu='$login', pass_usu='$pass', direccion_usu='$direccion'  WHERE id_usu='$codigo'");
		echo "<h3>Se modificó correctamente el usuario $complete</h3>";
	}
	public function DeleteUser($codigo)
	{
		$user=new Usuario;
		$user->Ejecutar("UPDATE tbl_usuario SET estado_usu='E' WHERE id_usu='$codigo'");
		echo "<h3>Se ha eliminado correctamente el usuario</h3>";
	}
	
	public function LoadRoles()
	{
		$rl=new Rol;
		$datos=$rl->Consultar_Rol("SELECT * FROM tbl_rol");
					echo "
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTabla3'>
				<thead>
					<tr class='fila'>
						<td>Código</td>
						<td>Dirección</td>
						<td>Estado</td>
						<td>Modificar</td>
					<!--	<td>Eliminar</td>						-->
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 	<tr>
							<td>$fila[id_rol]</td>
							<td>$fila[descripcion_rol]</td>
							<td>$fila[estado_rol]</td>							
							<td><input type='button' value='Modificar' class='btn' id='bntShowModRol' onclick='ShowModificarRol($fila[id_rol])'/></td>
						<!--	<td><input type='button' value='Eliminar' id='bntShowDeleteRol' onclick='ShowDeleteRol($fila[id_rol])'/></td>-->

						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla3').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers',
							'bFilter': true,
							
							'oLanguage':{
											'sProcessing':     'Procesando...',
											'sLengthMenu':     'Mostrar _MENU_ registros',
											'sZeroRecords':    'No se encontraron resultados',
											'sEmptyTable':     'Ningún dato disponible en esta tabla',
											'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
											'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
											'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
											'sInfoPostFix':    '',
											'sSearch':         'Buscar:',
											'sUrl':            '',
											'sInfoThousands':  ',',
											'sLoadingRecords': 'Cargando...',
											'oPaginate': {
															'sFirst':    'Primero',
															'sLast':     'Último',
															'sNext':     'Siguiente',
															'sPrevious': 'Anterior'
														},
														'oAria': {
																	'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
																	'sSortDescending': ': Activar para ordenar la columna de manera descendente'
																}
										}
						});
						$('#bntNewRol').button();
					</script> ";					
	}
	public function LoadRol($codigoRl)
	{
		$rl=new Rol;
		$derRol=$rl->Consultar("SELECT descripcion_rol FROM tbl_rol WHERE id_rol='$codigoRl'");
		echo "
				<table>
					<tr>
						<td>Descripcion</td>
						<td><input type='text' id='txtDesRol' value='$derRol' /></td>
					</tr>
					<tr>
						<td colspan='2'><input type='button' class='btn btn-success' id='bntModRl' value='Modificar' onclick='ModificarRol($codigoRl)'/></td>
					</tr>					
				</table>
					<script type='text/javascript'>						
						$('#bntModRl').button();
					</script>				
			";
	}
	public function ModifyRol($codigo,$desrol)
	{
		$rl=new Rol;
		$desrol=strtoupper($desrol);
		$rl->Ejecutar("UPDATE tbl_rol SET descripcion_rol='$desrol' WHERE id_rol='$codigo'");
		echo "<h3>Se ha modificado correctamente el rol $desrol</h3>";
	}

	public function LoadEspecialidad()
	{
		$esp=new Especialidad;
		$datos=$esp->Consultar_Especialidad("SELECT * FROM tbl_especialida");
					echo "
					<input type='button' class='btn' id='bntNewEsp' onclick='ShowNewEspe()' value='Nuevo Especialidad'>
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTabla4'>
				<thead>
					<tr class='fila'>
						<td>Código</td>
						<td>Dirección</td>
						<td>Estado</td>
						<td>Modificar</td>
						<td>Eliminar</td>
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 	<tr>
							<td>$fila[id_esp]</td>
							<td>$fila[descripcion_esp]</td>
							<td>$fila[estado_esp]</td>							
							<td><input type='button' class='btn' value='Modificar' id='bntShowModEsp' onclick='ShowModificarEspecialidad($fila[id_esp])'/></td>
							<td><input type='button' class='btn' value='Eliminar' id='bntShowDeleteEsp' onclick='ShowDeleteEspecialidad($fila[id_esp])'/></td>

						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla4').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers', 
							'bFilter': true, 
							
							'oLanguage':{
										'sProcessing':     'Procesando...',
										'sLengthMenu':     'Mostrar _MENU_ registros',
										'sZeroRecords':    'No se encontraron resultados',
										'sEmptyTable':     'Ningún dato disponible en esta tabla',
										'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
										'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
										'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
										'sInfoPostFix':    '',
										'sSearch':         'Buscar:',
										'sUrl':            '',
										'sInfoThousands':  ',',
										'sLoadingRecords': 'Cargando...',
										'oPaginate': {
													'sFirst':    'Primero',
													'sLast':     'Último',
													'sNext':     'Siguiente',
													'sPrevious': 'Anterior'
												},
												'oAria': {
														'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
														'sSortDescending': ': Activar para ordenar la columna de manera descendente'
														}
										}
						});
						
					</script> ";					
	}
	public function saveEspecialidad($desc,$est)
	{
		$esp=new Especialidad;
		$esp->Ejecutar("INSERT INTO tbl_especialida (descripcion_esp,estado_esp) VALUES('$desc','$est')");
		echo "<h3>Se guardó correctamente la especialidad $desc</h3>";
	}
	public function CargarEspecialidad($codigo)
	{
		$esp=new Especialidad;
		$des=$esp->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$codigo'");
		echo "
					<table>
						<tr>
							<td>
								Descripcion
							</td>
							<td>
								<input type='text' id='txtDesesp' value='$des'/>
							</td>
						</tr>
						<tr>
							<td><input type='button' class='btn btn-success' value='Modificar' id='bntModEsp' onclick='Modificarespecialidad($codigo)'></td>
						</tr>
					</table>
					<script type='text/javascript'>						

					</script> 					
			 ";
	}
	public function ModifyEspecialidad($codigo,$descripcion)
	{
		$esp=new Especialidad;
		$esp->Ejecutar("UPDATE tbl_especialida SET descripcion_esp='$descripcion', estado_esp='MA' WHERE id_esp='$codigo'");
		echo "
				<h3> Se ha modificado correctamente</h3>
			 ";
	}
	public function DeleteEspecialidad($codigo)
	{
				$esp=new Especialidad;
		$esp->Ejecutar("UPDATE tbl_especialida SET estado_esp='E' WHERE id_esp='$codigo'");
		echo "
				<h3> Se ha pasado a estado de eliminado esta especialidad</h3>
			 ";
	}
	public function LoadPacientes()
	{
		$pa=new Paciente;
		$datos=$pa->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE estado_pac='A'");
					echo "
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTabla5'>
				<thead>
					<tr class='fila'>
						<td>Cédula</td>
						<td>Nombres</td>
						<td>Edad</td>						
						<td>Dirección</td>
						<td>Modificar</td>
						<td>Eliminar</td>
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 	<tr>
							<td>$fila[cedula_pac]</td>
							<td>$fila[nombresCom_pac]</td>
							<td>$fila[fechaN_pac]</td>							
							<td>$fila[direccion_pac]</td>														
							<td><input type='button' value='Modificar' class='btn' id='bntShowModPac' onclick='ShowModificarPaciente($fila[id_pac])'/></td>
							<td><input type='button' value='Eliminar' class='btn' id='bntShowDeletePac' onclick='ShowDeletepaciente($fila[id_pac])'/></td>

						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla5').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers', 
							'bFilter': true, 
							
							'oLanguage':{
										'sProcessing':     'Procesando...',
										'sLengthMenu':     'Mostrar _MENU_ registros',
										'sZeroRecords':    'No se encontraron resultados',
										'sEmptyTable':     'Ningún dato disponible en esta tabla',
										'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
										'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
										'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
										'sInfoPostFix':    '',
										'sSearch':         'Buscar:',
										'sUrl':            '',
										'sInfoThousands':  ',',
										'sLoadingRecords': 'Cargando...',
										'oPaginate': {
													'sFirst':    'Primero',
													'sLast':     'Último',
													'sNext':     'Siguiente',
													'sPrevious': 'Anterior'
													},
													'oAria': {
															'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
															'sSortDescending': ': Activar para ordenar la columna de manera descendente'
															}
										}
						});
						$('#bntNewEsp').button();
					</script> ";					
	}
	public function CargarPaciente($codigo)
	{
		$pac=new Paciente;
		$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE id_pac='$codigo' AND estado_pac='A'");
		echo "<table>";
		foreach($datos as $fila)
		{
			echo "
				<tr>	
					<td>Apellidos</td>
					<td><input type='text' id='txtApePac' value='$fila[apellidos_pac]'/></td>
				</tr>
				<tr>	
					<td>Nombres</td>
					<td><input type='text' id='txtNombrePac' value='$fila[nombres_pac]'/></td>
				</tr>
				<tr>	
					<td>Edad</td>
					<td><input type='text' id='txtEdadPac' value='$fila[fechaN_pac]'/></td>
				</tr>
				<tr>	
					<td>Dirección</td>
					<td><input type='text' id='txtDireccionPac' value='$fila[direccion_pac]'/></td>
				</tr>
				<tr>	
					<td colspan='2'><input type='button' class='btn btn-success' value='Modificar' id='bntModPac' onclick='ModificarPaciente($codigo)'/></td>
				</tr>																
				
			";
		}
		echo "</table>
			<script type='text/javascript'>						

						$('#bntModPac').button();
					</script>
		";		
	}
	public function ModifyPaciente($codigo,$apellido,$nombre,$edad,$direccion)
	{
		$pac=new Paciente;
		$apellido=strtoupper($apellido);
		$nombre=strtoupper($nombre);
		$completo=$apellido." ".$nombre;
		$pac->Ejecutar("UPDATE tbl_paciente SET apellidos_pac='$apellido', nombres_pac='$nombre', nombresCom_pac='$completo', edad_pac='$edad', direccion_pac='$direccion' WHERE id_pac='$codigo'");
		echo "<h3>Se a modificado el paciente: $completo</h3>";
	}
	public function deletePaciente($codigo)
	{
		$pac=new Paciente;
		$pac->Ejecutar("UPDATE tbl_paciente SET estado_pac='E' WHERE id_pac='$codigo'");
		echo "<h3>Se ha eliminado correctamente el paciente</h3>";
	}
	public function LoadMedicamentos()
	{
		$pa=new Farmacos;
		$datos=$pa->Consultar_Farmacos("SELECT * FROM tbl_farmacos WHERE estado_far='A' AND estock_far>0");
					echo "
				<div class='demo_jui'>
				<input type='button' id='bntNewFarmaco' class='btn' onclick='ShowNewFarmaco()' value='Nuevo Farmaco'>
				<table cellpadding='7' cellspacing='0' id='MiTabla8'>
				<thead>
					<tr class='fila'>
						<td>Descripción</td>
						<td>Presentación</td>
						<!--<td>Foto</td>-->
						<td>Fecha</td>						
						<td>Estock</td>
						<td>Modificar</td>
						<td>Eliminar</td>
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 	<tr>
							<td>$fila[descripcion_far]</td>
							<td>$fila[presentacion_farm]</td>
							<!--<td><div id='Imagenes'><img src='../Bodega/$fila[foto_far]'/></div></td>-->
							<td>$fila[Fecaduca_far]</td>							
							<td>$fila[estock_far]</td>														
							<td><input type='button' value='Modificar' class='btn' id='bntShowModFarma' onclick='ShowModificarFarmaco($fila[id_far])'/></td>
							<td><input type='button' value='Eliminar' class='btn' id='bntShowDeleteFarm' onclick='ShowDeleteFarmaco($fila[id_far])'/></td>

						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla8').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers', 
							'bFilter': true, 
							
							'oLanguage':{
										'sProcessing':     'Procesando...',
										'sLengthMenu':     'Mostrar _MENU_ registros',
										'sZeroRecords':    'No se encontraron resultados',
										'sEmptyTable':     'Ningún dato disponible en esta tabla',
										'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
										'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
										'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
										'sInfoPostFix':    '',
										'sSearch':         'Buscar:',
										'sUrl':            '',
										'sInfoThousands':  ',',
										'sLoadingRecords': 'Cargando...',
										'oPaginate': {
													'sFirst':    'Primero',
													'sLast':     'Último',
													'sNext':     'Siguiente',
													'sPrevious': 'Anterior'
													},
													'oAria': {
															'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
															'sSortDescending': ': Activar para ordenar la columna de manera descendente'
															}
										}
						});
						$('#bntNewFarmaco').button();
					</script> ";					
	}
	public function NuevoFarmaco($descipcion,$fecha,$cantidad)
	{
		$pro=new Farmacos;
		$foto=$_SERVER['HTTP_X_FILE_NAME'];
		$pro->Ejecutar("INSERT INTO tbl_farmacos (descripcion_far,foto_far,Fecaduca_far,estock_far,estado_far) VALUES('$descipcion','$foto','$fecha','$cantidad','A');");
			$carpeta="../Bodega/";
				file_put_contents($carpeta.$_SERVER['HTTP_X_FILE_NAME'],
				file_get_contents('php://input'));
				echo "
						<h3>Se ha guardado correctamente el farmaco</h3>
				
					 ";

	}
	public function VerFarmaco($codigo)
	{
		$farm=new Farmacos;
		$des=$farm->Consultar("SELECT descripcion_far FROM tbl_farmacos WHERE id_far='$codigo'");
		$cant=$farm->Consultar("SELECT estock_far FROM tbl_farmacos WHERE id_far='$codigo'");	
		echo "
				<table>
					<tr>
						<td>Descripción</td>
						<td><input type='text' id='txtDesfar' value='$des'></td>
					</tr>
					<tr>
						<td>Cantidad</td>
						<td><input type='text' id='txtCantfar' value='$cant'></td>
					</tr>					
					<tr>
						<td><input type='button' id='bntModfarm' class='btn btn-success' value='Modificar' onclick='Modificarfarmaco($codigo)'></td>
					</tr>					
				</table>
					<script type='text/javascript'>						
						$('#bntModfarm').button();
					</script>				
			";	
	}
	public function Modifyfarmaco($codigo,$descripion,$cantidad)
	{
		$far=new Farmacos;
		$far->Ejecutar("UPDATE tbl_farmacos SET descripcion_far='$descripion', estock_far='$cantidad' WHERE id_far='$codigo'");
		echo "<h3>Se modificó correctamente el farmaco</h3>";
	}
	public function Deletefarmaco($codigo)
	{
		$far=new Farmacos;
		$far->Ejecutar("UPDATE tbl_farmacos SET estado_far='E' WHERE id_far='$codigo'");
		echo "<h3>Se eliminó correctamente</h3>";
	}
	
	//incio del combo de horas disponibles
		public function cargarhorarioXDoctorCir($fecha,$codigo)
		{
			$aux=new Turno;
			$aux1=new Usuario;
			$aux2=new Hora;
			session_start();
			$loguser=$_SESSION['DOCTOR'];
			$iddoctor=$aux->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$loguser' AND id_rol='1' AND estado_usu='A'");
			$dato=$aux->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$fecha' and id_usu='$iddoctor'");
			echo "
			<table>
		
			<tr>
			<td>Seleccione: </td>
			<td>
			<select id='cmb_horas' > <option>Seleccione un horario</option>";
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
							echo "<option value='$ho[$z]'>$des</option>";
							}

						}
			}
			else
			{
				$datos1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
				foreach($datos1 as $filas1)
				{
					echo "<option value='$filas1[id_hor]'>$filas1[hora_hor]</option>";
				}
			}

			if($codigo==1) //primera forma para agendar al paciente cunado lo busca por diaginostico
			{
				echo "</select></td><td><input type='button' id='bntDarTurno' class='btn btn-success' value='Dar Turno' onclick='GenerarTurnoPacienteXDoctor();'/></td>
					 ";
			}
			if($codigo==2)//forma pra que el doctor agende por si mismo
			{
				echo "</select></td><tr><td>Lugar:</td><td><textarea cols='40' rows='1' id='txtLugar2'></textarea></td></tr><tr><td><input type='button' id='bntDarTurno' class='btn btn-success' value='Dar Turno' onclick='GenerarTurnoPacienteGeneralXDoctor();'/></td>
				 ";
			}
			echo "
						</tr>
					</table>
					<script type='text/javascript'>						
						
					</script>
			
			";
		}	
	//fin del combo de horas disponbles
	//inicio del metodo para cargar el historial del paciente
	public function HistorialPaciente($codigo)
	{
		$aux=new Consulta;
		$datos=$aux->Consultar_HistorialPaciente($codigo);
		echo "
		<div class='demo_jui'>
		<table cellpadding='7' cellspacing='0' id='MiTabla32'>
				<thead>
					<tr class='fila'>
					<td>Diagnostico</td>
					<td>Examenes</td>
					<td>Tratamiento</td>
					<td>Fecha de la consulta</td>
					<td>Receta</td>
				</tr>
				</thead>	
				<tbody>
			 ";
			 foreach($datos as $fila)
			 {
				 echo "
				 		<tr>
							<td>$fila[diagnostico_cons]</td>
							<td>$fila[examenes_cons]</td>
							<td>$fila[tratamiento_cons]</td>
							<td>$fila[fechaC_tu]</td>
							<td><input type='button' id='bntVerReceta' class='btn btn-success' value='Ver historial receta' onclick='VerReceta($fila[id_cons])'/></td>
						</tr>
				 	  ";
			 }
		echo "
		</tbody>
		</table>
		</div>
					<script type='text/javascript'>						
						$('#MiTabla32').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers', 
							'bFilter': true,
							
							'oLanguage':{
										'sProcessing':     'Procesando...',
										'sLengthMenu':     'Mostrar _MENU_ registros',
										'sZeroRecords':    'No se encontraron resultados',
										'sEmptyTable':     'Ningún dato disponible en esta tabla',
										'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
										'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
										'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
										'sInfoPostFix':    '',
										'sSearch':         'Buscar:',
										'sUrl':            '',
										'sInfoThousands':  ',',
										'sLoadingRecords': 'Cargando...',
										'oPaginate': {
													'sFirst':    'Primero',
													'sLast':     'Último',
													'sNext':     'Siguiente',
													'sPrevious': 'Anterior'
													},
													'oAria': {
															'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
															'sSortDescending': ': Activar para ordenar la columna de manera descendente'
															}
										}	
						});
						
					</script>";			
	}
	//fin del metodo para cargar el historial del paciente	
	
	public function VerReceta($codigo)
	{
		$aux=new Consulta();
		$datos=$aux->Consultar_VerReceta($codigo);
		echo "
		<div class='demo_jui'>
		<table cellpadding='0' cellspacing='0' id='MiTabla1555' border='0'>
				<thead>
					<tr class='fila'>
					<td>Indicaciones</td>
					<td>Descripcion</td>
					<td>Foto</td>
				</tr>
				</thead>	
				<tbody>
			 ";
			 foreach($datos as $fila)
			 {
				 echo "
				 		<tr>
							<td>$fila[indicaciones]</td>
							<td>$fila[descripcion_far]</td>
							<td></td>
						</tr>
				 	  ";
			 }
			 echo "</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla1555').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers'
						});
						
					</script>";
	}
	
	public function VerCieCirgia()
	{
		$aux=new Cie();
		$datos=$aux->Consultar_Cie("SELECT * FROM tbl_cie LIMIT 30");
		echo "
		<div class='demo_jui'>
		<table cellpadding='7' cellspacing='0' id='MiTabla280' border='0' align='center'>
				<thead>
					<tr class='fila'>
					<td>Descrpción CIE10</td>
					<td>Código CIE9R</td>
					<td>Asignar</td>
				</tr>
				</thead>	
				<tbody>
			 ";
			 foreach($datos as $fila)
			 {
				 echo "
				 		<tr>
							<td>$fila[desc_diag]</td>
							<td>$fila[cod_diag]</td>
							<td><input type='button' id='bntAsignarCie' class='btn btn-success' value='Asignar' onclick='AsignarCie($fila[id_diag])'/></td>
						</tr>
				 	  ";
			 }
			 echo "</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla280').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers',
							'bFilter': false,
							
							'oLanguage':{
											'sProcessing':     'Procesando...',
											'sLengthMenu':     'Mostrar _MENU_ registros',
											'sZeroRecords':    'No se encontraron resultados',
											'sEmptyTable':     'Ningún dato disponible en esta tabla',
											'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
											'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
											'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
											'sInfoPostFix':    '',
											'sSearch':         'Buscar:',
											'sUrl':            '',
											'sInfoThousands':  ',',
											'sLoadingRecords': 'Cargando...',
											'oPaginate': {
															'sFirst':    'Primero',
															'sLast':     'Último',
															'sNext':     'Siguiente',
															'sPrevious': 'Anterior'
														},
														'oAria': {
																	'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
																	'sSortDescending': ': Activar para ordenar la columna de manera descendente'
																}
										}
						});
						
					</script>";
	}
	
		public function VerCie3Cir($desc)
	{
		$aux=new Cie();
		
		$datos1=$aux->Consultar_Cie("SELECT * FROM tbl_cie WHERE desc_diag like '$desc%' limit 100");
		$datos2=$aux->Consultar_Cie("SELECT * FROM tbl_cie WHERE cod_diag like '$desc%' limit 100");
		$datos=NULL;
		$aux1[0]=count($datos1);
		$aux1[1]=count($datos2);
		$aux3[0]="SELECT * FROM tbl_cie WHERE desc_diag like '$desc%' limit 100";
		$aux3[1]="SELECT * FROM tbl_cie WHERE cod_diag like '$desc%' limit 100";
		$aux2=-10;
		for($x=0;$x<=1;$x++)
		{
			if($aux1[$x]>$aux2)
			{
				$aux2=$aux1[$x];
				$datos=$aux->Consultar_Cie($aux3[$x]);
			}
		}
		
		echo "
		<html lang='en'>
		<head>
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
		</head>
		<body>
		<div class='demo_jui'>
		<table cellpadding='0' cellspacing='0' id='MiTabla580' border='0' align='center'>
				<thead>
					<tr class='fila'>
					<td>Código CIE</td>
					<td>Descripción CIE</td>
					<td>Asignar</td>
				</tr>
				</thead>	
				<tbody>
			 ";
			 foreach($datos as $fila)
			 {
				 echo "
				 		<tr>
							<td>$fila[desc_diag]</td>
							<td>$fila[cod_diag]</td>
		<td><input type='button' id='bntAsignarCie' class='btn btn-success' value='Asignar' onclick='AsignarCie($fila[id_diag])'/></td>

						</tr>
				 	  ";
			 }
			 echo "</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla580').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers'
						});
						
					</script>
					</body>
					</html>";
	}
	
	public function CargarDiagnosticoCirugia($codigo)
	{
		$aux=new Cie();
		$datos=$aux->Consultar("SELECT desc_diag FROM tbl_cie WHERE id_diag='$codigo'");
		echo $datos;
	}
		

	public function VerCitasFormOrderCir()
	{
		$aux=new Hora;
		$aux3=new Consulta;
		//$date=date("Y-m-d");//fecha antigua
		$date=$this->Mifecha();
		$datos=$aux->Consultar_Hora("SELECT * FROM tbl_hora");
		session_start();
		$log=$_SESSION['DOCTOR'];
		$iduser=$aux->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$log'");
		echo "<table>
				<tr>
					<td>Hora</td>
					<td>Cita</td>
					<td>Lugar</td>
					<td>Reservar</td>
				</tr>	
			 ";
			 foreach($datos as $fila)
			 {
				 $codigo=$aux->Consultar("SELECT id_tu FROM tbl_turno WHERE fechaC_tu='$date' AND id_hor='$fila[id_hor]';");
				 $paciente=$aux3->Consultar_PacienteEmer($date,$fila['id_hor'],$iduser);
				 echo "<tr>
				 		<td>$fila[hora_hor]</td>
						";
						if($codigo>0)
						{
							$aux2=0;

							$aux4=count($paciente);
							if($aux4<=2)
							{
								foreach($paciente as $fila1)
								{
									echo "<td>";

									if($fila1['estadoEmer_tur']=="")
									{
									echo "<div id='PacNormal'>$fila1[nombresCom_pac]</div>";
									}
									if($fila1['estadoEmer_tur']=="A")
									{
										echo "<div id='PacEmergenci'>$fila1[nombresCom_pac]</div>";										
									}
									echo "</td>";
								}
								echo "<!--<td><input type='button' class='btn btn-danger' value='Agendar Cita Emergencia' onclick='ReservarEmergencia($fila[id_hor])'/></td>-->";
							}
							
						}
						else
						{
							echo "<td><textarea cols='40' rows='2' id='txtCita'></textarea></td><td><textarea cols='40' rows='2' class='txtLugar'></textarea></td>
								 <td><input type='button' value='Agendar Cita' class='btn btn-success' onclick='ReservarHoy($fila[id_hor])'/></td>";
						}
				 	   echo "</tr>";
			 }
		echo "</table>";		
	}
	
	public function CargarPacXCod($codigo)
	{
		$aux=new Paciente();
		$datos=$aux->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE id_pac='$codigo'");
			$fecha=$aux->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo';");
			if($fecha!="")
			{
				$edad=$this->Edad($fecha);
			}
			else
			{
				$edad="";
			}		
		echo "

		<table  class='table table-bordered table-striped table-hover table-condensed '  align='center'>
				
				<tr >
					<th>Nombre</th>
					<th>Cédula</th>
					<th>Teléfono</th>
					<th>Edad</th>
					<th>Dirección</th>
					<th>Alerta</th>
					<th>Historial</th>
				</tr>
				
				
			 ";
			 foreach($datos as $fila)
			 {
				 echo "
				 		<tr>
							<td>$fila[nombresCom_pac]</td>
							<td>$fila[cedula_pac]</td>
							<td>$fila[telefono_pac]</td>
							<td>$edad</td>
							<td>$fila[direccion_pac]</td>
							<td><input type='button' class='btn btn-danger' id='bntAlerta' onclick='Alerta()' value='Ingresar'/></td>
							<td><input type='button' class='btn btn-success' id='bntAlerta' onclick='HistorialPacienteNew($codigo)' value='Historial'/></td>
						</tr>
				 	  ";
			 }
			  echo "</table>";
	}
	public function AsignarCita($hora,$paciente)
	{
		$aux=new Turno;
		//$fecha=date("y-m-d");//fecha antigua
		$fecha=$this->Mifecha();
		session_start();
		$user=$_SESSION['DOCTOR'];
		$idUser=$aux->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$user'");
		$turn=$aux->Consultar("SELECT MAX(numero_tur) FROM tbl_turno WHERE   fechaR_tu='$fecha'")+1;
		$res=$aux->Ejecutar("INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,numero_tur,estado_tur) VALUES('$idUser','$paciente','$hora','$fecha','$fecha','$turn','AE')");
		echo "<h3 style='color:black;'> Se agendó correctamente el paciente</h3>";
	}
	public function AgendarHoyEmeregencia($hora,$paciente)
	{
		$aux=new Turno;
		//$fecha=date("y-m-d");//fecha antigua
		$fecha=$this->Mifecha();
		session_start();
		$user=$_SESSION['DOCTOR'];
		$idUser=$aux->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$user'");
		$turn=$aux->Consultar("SELECT MAX(numero_tur) FROM tbl_turno WHERE   fechaR_tu='$fecha'")+1;
		$res=$aux->Ejecutar("INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,numero_tur,estado_tur,estadoEmer_tur) VALUES('$idUser','$paciente','$hora','$fecha','$fecha','$turn','AE','A')");
		echo $res." Se agendó correctamente el paciente de emeregencia";
		
	}
	public function DataDoctor()
	{
		$aux=new Usuario;
		session_start();
		$user=$_SESSION['DOCTOR'];
		$dataUser=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$user'");
		echo "Bienvenid@: ".$dataUser;
	}
	public function ReservarTurnoPorDocGeneral($codigoPaciente,$fecha,$hora)
	{
		$aux=new Turno;
		session_start();
		$user=$_SESSION['DOCTOR'];
		//$hoy=date("y-m-d");//fecha antigua
		$hoy=$this->Mifecha();
		$idUser=$aux->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$user'");
		$numTurno=$aux->Consultar("SELECT COUNT(*) FROM tbl_turno WHERE  fechaR_tu='$fecha'")+1;
		$res=$aux->Ejecutar("INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES('$idUser','$codigoPaciente','$hora','$hoy','$fecha','$user','$numTurno','AE')");
		$codigo=$aux->Consultar("SELECT MAX(id_tu) FROM tbl_turno");
		echo "<table>
				<tr>
					<td><h3 style='color:black;'>Se agendo correctamente el paciente</h3></td>
					<td><input type='button' id='bntImprimir' onclick='ImprimirTurno($codigo)' value='Imprimir Turno'/></td>
					
				</tr>
			  </table>
					<script type='text/javascript'>						
						$('#bntImprimir').button();
						$('#bntNewturno').button();						
						$('#bntNewturno').click(function()
						{
							location.reload();
						});
					</script>			  
			  ";
		
	}
	public function DataAllPaciente($codigo)
	{
		$aux=new Paciente;
		$datos=$aux->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE id_pac='$codigo'");
		if(count($datos)>0)
		{
			echo "<table>";
			foreach($datos as $fila)
			{
				echo "<tr><td>Cédula:</td><td><input type='text' id='txtcedulaUsu1' value='$fila[cedula_pac]'  readonly /></td></tr>
					 <tr><td>Pasaporte:</td><td><input type='text' id='txtPasport' value='$fila[pasaporte_pac]'  readonly /></td></tr>
					 <tr><td>Apellidos:</td> <td><input type='text' id='txtapellidoUsu1' value='$fila[apellidos_pac]'   /></td></tr>
					 <tr><td>Nombres:</td><td><input type='text' id='txtnombresUsu1'   value='$fila[nombres_pac]'  /></td></tr>
					 <tr><td>Otro:</td><td><textarea id='txtOtro' cols='40' rows='2'   >$fila[otros_pac]</textarea></td></tr>
					 </tr><tr><td>Fecha de nacimiento:</td><td><input type='text' id='txtEdadUsu1' value='$fila[fechaN_pac]'  readonly /></tr>
					 <tr><td>Lugar de nacimiento:</td><td><input type='text' id='txtLugnacim' value='$fila[lugarnac_pac]'  readonly /><td></tr>
					 <tr><td>Lugar de residencia:</td><td><input type='text' id='txtLugres' value='$fila[lugresid_pac]'  readonly /></td></tr>";
					 if($fila['sexo_pac']!="")
					 {
						 echo "<tr><td>Sexo:</td><td><input type='text' id='txtSexo' value='$fila[sexo_pac]'  readonly/></td><td><select id='txtSex' readonly ><option value='$fila[sexo_pac]'>$fila[sexo_pac]</option></select></td></tr>";
					 }
					 if($fila['sexo_pac']==""){
						 echo "<tr><td>Sexo:</td><td><input type='text' id='txtSexo' value='$fila[sexo_pac]'  readonly/></td><td><select id='txtSex' ><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select></td></tr>";
					 }
					 echo "
					 <tr><td>Raza:</td><td><input type='text' id='txtRaza' value='$fila[raza_pac]'  readonly /></td></tr>
					 <tr><td>Religión:</td><td><input type='text' id='txtReligion' value='$fila[religion_pac]'   /></td></tr>
					 <tr><td>Estado civil:</td><td><input type='text' id='txtEstadoCivil' value='$fila[estadociv_pac]'  /></td><td><select id='txtEstadociv'><option value='$fila[estadociv_pac]'>$fila[estadociv_pac]</option><option value='Solter@'>Solter@</option><option value='Casad@'>Casad@</option><option value='Divorciad@'>Divorciad@</option><option value='Viud@'>Viud@</option></select></td></tr>
					 <tr><td>Instrucción:</td><td><input type='text' id='txtInstr' value='$fila[instruccion_pac]'   /></td></tr>
					 <tr><td>Profesión:</td><td><input type='text' id='txtProf' value='$fila[profesion_pac]'   /></td></tr>
					 <tr><td>Ocupación:</td><td><input type='text' id='txtOcupe' value='$fila[ocupacion_pac]'   /></td></tr>
					 <tr><td>Condición del paciente:</td><td><input type='text' id='txtCondicio' value='$fila[condicion_pac]'  /></td><td><select id='txtCondpac'><option value='$fila[condicion_pac]'>$fila[condicion_pac]</option><option value='Convenio'>Convenio</option><option value='Empresa'>Empresa</option><option value='Particular'>Particular</option></select></td></tr>
					 <tr><td>Dirección:</td><td><input type='text' id='txtdireccionUsu1'  value='$fila[direccion_pac]'  /></td></tr>
					 <tr><td>Teléfono Domicilio:</td><td><input type='text' id='txtTelef' value='$fila[telefono_pac]'  ></td></tr>
					 <tr><td>Teléfono Trabajo:</td><td><input type='text' id='txtTelefTraba' value='$fila[telefonoTra_pac]'  ></td></tr>
					 <tr><td>Celular:</td><td><input type='text' id='txtCelular' value='$fila[celular_pac]'  ></td></tr>
					 <tr><td>Correo:</td><td><input type='text' id='txtCorreo' value='$fila[correo_pac]'  ></td></tr>
					 <tr><td>Referencia: </td><td><input type='text' id='txtNombresRefe' value='$fila[nombresReferencia_pac]'  ></td></tr>
					 <tr><td>Teléfono de Referencia:</td><td><input type='text' id='txtTelefonoRefe' value='$fila[telefonoReferencia_pac]'  ></td></tr>
					 <tr><td colspan'2'><input type='button' id='bntSaveUsu13' class='btn btn-success' onclick='SaveAndModPac($codigo)' value='Guardar' /></td></tr>";
			}
			echo "<table>
					<script type='text/javascript'>						
						;	
					</script>						
			";
		}
		else
		{
			echo "Este paciente no tiene datos ";
		}
	}
	public function UpdateFiliacion($cedula,$passoporte,$apellidos,$nombres,$otros,$fechaNac,$lugarNac,$lugarRes,$sexo,$raza,$religion,$estadoCivil,$instrucion,$profesion,$opcupacion,$condicionpac,$direccion,$telefonoDomi,$telefonoTraba,$celular,$correo,$referencia,$telefonoRefere, $codigo)
	{
		$aux=new Paciente;
		$apellidos=strtoupper($apellidos);
		$nombres=strtoupper($nombres);
		$com=$apellidos." ".$nombres;
		$res=$aux->Ejecutar("UPDATE tbl_paciente SET pasaporte_pac='$passoporte', apellidos_pac='$apellidos', nombres_pac='$nombres', nombresCom_pac='$com', direccion_pac='$direccion',nombresReferencia_pac='$referencia', telefonoReferencia_pac='$telefonoRefere',religion_pac='$religion',instruccion_pac='$instrucion', profesion_pac='$profesion',ocupacion_pac='$opcupacion',telefono_pac='$telefonoDomi',telefonoTra_pac='$telefonoTraba',celular_pac='$celular',estadociv_pac='$estadoCivil', condicion_pac='$condicionpac',correo_pac='$correo', otros_pac='$otros',sexo_pac='$sexo' WHERE id_pac='$codigo'");
		
		echo "<h3>".$res."Se modificó correctamente el paciente</h3>";
	}
	public function ActualizarPago ($codigo, $pago)
	{
		$aux= new Turno;
		$aux->Ejecutar("UPDATE tbl_turno SET estadoPa_tur='$pago' WHERE id_tu='$codigo'");
		echo "<h3>Pago Modificado</h3>";
	}
		//inicio de la funcio para cargar todas las consulatas de hoy
	public function ConsultasDeHoyAll()
	{
		$cons=new Consulta;
		session_start();
		$user=$_SESSION['ENFERMERA'];
		//$fecha=date("y-m-d");	//fecha antigua
		$fecha=$this->Mifecha();
		$datos=$cons->Consultar_ConsultasHoyAll($user,$fecha);
					echo "
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTabla98'>
				<thead>
					<tr class='fila'>
						<td>Turno</td>
						<td>Hora</td>
						<td>Cédula</td>
						<td>Nombres</td>
						<td>Estado Pago</td>
						<td>Tipo Consulta</td>
						<td>Cancelar</td>
						<td>Modificar Pago</td>
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 	<tr>
							<td>$fila[Numero_Turno]</td>
							<td>$fila[hora_hor]</td>
							<td>$fila[Cedula_Paciente]</td>
							<td>$fila[Nombres_Paciente]</td>
							<td>$fila[estadoPa_tur]</td>";
							if($fila['estadoEmer_tur']=="")
							{
								echo "<td></td>";
							}
							if($fila['estadoEmer_tur']=="A")
							{
								echo "<td><div id='PacEmergenci'>Paciente Emergencia</div></td>";
							}
							
							
							echo "
								<td><input type='button' class='btn btn-success' value='Cancelar' id='bntPago' onclick='CancelarCita($fila[Codigo])'/></td>
								<td><input type='button' class='btn btn-primary' value='Pagar' id='bntPago' onclick='EstadoPago($fila[Codigo])'/></td>
						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTabla98').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers', 
							'bFilter': true,
							
							'oLanguage':{
										'sProcessing':     'Procesando...',
										'sLengthMenu':     'Mostrar _MENU_ registros',
										'sZeroRecords':    'No se encontraron resultados',
										'sEmptyTable':     'Ningún dato disponible en esta tabla',
										'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
										'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
										'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
										'sInfoPostFix':    '',
										'sSearch':         'Buscar:',
										'sUrl':            '',
										'sInfoThousands':  ',',
										'sLoadingRecords': 'Cargando...',
										'oPaginate': {
													'sFirst':    'Primero',
													'sLast':     'Último',
													'sNext':     'Siguiente',
													'sPrevious': 'Anterior'
													},
													'oAria': {
															'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
															'sSortDescending': ': Activar para ordenar la columna de manera descendente'
															}
										}
						});
						$('.boton').button();
					</script>
				 ";					
	}
	//fin de la funcio para cargar las todas consulatas de hoy	
		//inicio de la funcio para cancelar la cita
	public function EliminarCita($codigo)
	{
		$aux= new Turno;
		$aux->Ejecutar("UPDATE tbl_turno SET estado_tur='E' WHERE id_tu='$codigo'");
		echo "<h3 style='color:red;'>Cita Cancelada</h3>";
	}
		//fin  de la funcio para cancelar la cita
	
	//funcio para cargar el nombre del paciente 
	public function NombreCompletoPaciente($codigo)
	{
		$aux=new Paciente;
		$nomComple=$aux->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codigo'");
		echo "<input type='hidden' id='txtNomCompletoPaciete' value='$nomComple'/>";
	}
	//fin funcio para cargar el nombre del paciente 
	
	//fucion pala la solicitud de imagen
	public function solicutudimagen($desimagen, $turno){
				$aux= new Medimagen;
				$aux->Ejecutar("INSERT INTO tbl_medimagen (desc_medimagen,id_tu) VALUES('$desimagen','$turno');");
				echo "123";
	}
	
	//funcion para guardar e imprimir examenes de solicitud
	public function SolicitudExamenes($desc,$cod)
	{
		$aux=new Examen;
		$aux->Ejecutar("INSERT INTO tbl_examen (desc_exa,id_tu) VALUES('$desc','$cod')");
		echo $aux;
	}
	
	//funcion para guardar examen fisico
	public function dateExamenFisico ($ComboBiotipo,$Actitud,$Conciencia,$GlasGow,$Teperatura,$PrecionArterial,$FrecuenciaCardiaca,$FrecuenciaRespiratoria,$Peso,$Talla,$MasaCorporal,$PerimetroCefalico,$PerimetroToracico,$PerimetroAbdominal,$PesoIdeal,$TenArtAcostado,$TenArtSentado,$TenArtPie,$SuperCorporal,$Piel,$AparatoUrinario,$AparatoDigestivo,$AparatoGMasculino,$AparatoGFemenino,$MusculoEsqueletico,$SistemaNervioso,$codigo,$CCFascies,$CCOjos,$CCNariz,$CCBoca,$CCOidos,$CCFaringe,$CForma,$CMovimientos,$CPiel,$CPartesBlandas,$CTiroides,$CGanglios,$TRespiratorios,$TPiel,$TBlandas,$TMamas,$TCorazon,$TPulmones,$AbdomenPiel,$Abdomenvolumen,$volumenPartesBlandas,$turno)
	 {
		/*$auxcacu=$CabezayCuello." ".$OpcionCuCa;
		$auxcu=$Cuello." ".$OpcionCu;
		$auxtorax=$Torax." ".$Opciontorax;
		$auxabdomen=$Abdomen." ".$OpcionAbdomen;*/
		
		$aux= new ExamenFisico;
		$ej=$aux->Ejecutar("INSERT INTO tbl_examen_fisico (biotipo_constitucional,actitud,estado_conciencia,glasgow,temperatura,presion_arterial,frecuencia_cardiaca,frecuencia_respiratoria,peso,talla,indice_masa_corporal,perimetro_cefalico,perimetro_toracico,perimetro_abdominal,peso_ideal,tension_arterial_acostado,tension_arterial_sentado,tension_arterial_de_pie,superficie_corporal,piel,aparato_urinario,aparato_digestivo,aparato_genital_masculino,aparato_genital_femenino,sistema_musculo_esqueletico,sistema_nervioso,id_pac,CCFascies,CCOjos,CCNariz,CCBoca,CCOidos,CCFaringe,CForma,CMovimientos,CPiel,CPartesBlandas,CTiroides,CGanglios,TRespiratorios,TPiel,TBlandas,TMamas,TCorazon,TPulmones,AbdomenPiel,Abdomenvolumen,volumenPartesBlandas,id_tu) VALUES ('$ComboBiotipo','$Actitud','$Conciencia','$GlasGow','$Teperatura','$PrecionArterial','$FrecuenciaCardiaca','$FrecuenciaRespiratoria','$Peso','$Talla','$MasaCorporal','$PerimetroCefalico','$PerimetroToracico','$PerimetroAbdominal','$PesoIdeal','$TenArtAcostado','$TenArtSentado','$TenArtPie','$SuperCorporal','$Piel','$AparatoUrinario','$AparatoDigestivo','$AparatoGMasculino','$AparatoGFemenino','$MusculoEsqueletico','$SistemaNervioso','$codigo','$CCFascies','$CCOjos','$CCNariz','$CCBoca','$CCOidos','$CCFaringe','$CForma','$CMovimientos','$CPiel','$CPartesBlandas','$CTiroides','$CGanglios','$TRespiratorios','$TPiel','$TBlandas','$TMamas','$TCorazon','$TPulmones','$AbdomenPiel','$Abdomenvolumen','$volumenPartesBlandas','$turno')");
		echo "<h3>Los datos se guardaron correctamente  $ej</h3>";
		
		
	}
		
	//funcion para guardar los datos de Anamnesis
	public function IngresarAnamnesis($motivocon,$enfermeactual,$tiposangre,$nopatologicos,$alergi,$cardiovas,$metab,$infecc,$neoplas,$endocro,$pulmon,$nefro,$hemato,$esquele,$inmuno,$gineco,$otrospat,$cardiofam,$metabfam,$infeccfam,$neoplasfam,$endocronofam,$pulmofam,$nefrofam,$hematofam,$esquelefam,$inmunofam,$otrosfam,  
	
	$tabaco,$achohol,$drogas,$medi,$exercise,$tipodiet,$vacuns, 
	
	$audit,$oftalmo,$otorrinolari,$nervioscran,$digest,$renal,$pulmonar,$cardiovas3,$oseo,$ginecoobste,$otrossyst,$codoculpacanam,$CodigoTurnoLight,$endocrino,$gastroen)
	{
		$aux=new Anamnesis;
		$aux2=new Habitos;
		$aux3=new Sistemas;

		$hoy=$this->Mifecha();
		//$aux2->Ejecutar("INSERT INTO tbl_habitos (tabaco_hab,alcohol_hab,drogas_hab,medicamentos_hab,ejercicio_hab,tipodieta_hab,vacunas_hab,estado_hab) VALUES('$tabaco','$achohol','$drogas','$medi','$exercise','$tipodiet','$vacuns','A')");
		$codhabitos=$aux2->Consultar("SELECT MAX(id_hab) FROM tbl_habitos");
		
		if($codhabitos==""){
			$codhabitos=1;
		}else{
			$codhabitos=$codhabitos;
		}
		
		
		//$aux3->Ejecutar("INSERT INTO tbl_sistemas (auditivo_sist,oftalmo_sist,otorrino_sist,nervioscra_sist,digestivo_sist,renal_sist,pulmonar_sist,cardiovas_sist,oseao_sist,ginecoobst_sist,otros_sist,estado_sist) VALUES('$audit','$oftalmo','$otorrinolari','$nervioscran','$digest','$renal','$pulmonar','$cardiovas3','$oseo','$ginecoobste','$otrossyst','A')");
		$codsistemas=$aux3->Consultar("SELECT MAX(id_sist) FROM tbl_sistemas");
		if($codsistemas==""){
			$codsistemas=1;
		}else{
			$codsistemas=$codsistemas;
		}
		
		echo $aux->Ejecutar("INSERT INTO tbl_anamnesis (motivocon_anam,enfermedac_anam,tiposangre_anam,nopatologicos_anam,alergias_anam,cardiovaculares_anam,metabolicos_anam,infescciosos_anam,neoplastias_anam,endocrono_anam,pulmonares_anam,nefro_anam,hemato_anam,esquele_anam,inmuno_anam,ginecoobste_anam,otros_anam,cardiovasfam_anam,metabofam_anam,infeccfam_anam,neoplasfam_anam,endocronofam_anam,pulmofam_anam,nefrolofam_anam,hematofam_anam,esquelefam_anam,inmunofam_anam,otrosfam_anam,estado_anam,id_paciente,id_habitos,id_sistemas,fecha_anam,id_tu,gastroe_anam) VALUES('$motivocon','$enfermeactual','$tiposangre','$nopatologicos','$alergi','$cardiovas','$metab','$infecc','$neoplas','$endocro','$pulmon','$nefro','$hemato','$esquele','$inmuno','$gineco','$otrospat','$cardiofam','$metabfam','$infeccfam','$neoplasfam','$endocronofam','$pulmofam','$nefrofam','$hematofam','$esquelefam','$inmunofam','$otrosfam','A','$codoculpacanam','$codhabitos','$codsistemas','$hoy','$CodigoTurnoLight','$gastroen')");
		
		echo "<h3>Se ha guardado correctamente la Anamnesis</h3>";
	}
	
	//funcion Vademecun doctor
	public function VademecunDoc()
	{
		$pa=new Farmacos;
		$datos=$pa->Consultar_Farmacos("SELECT * FROM tbl_farmacos WHERE estado_far='A' AND estock_far>0");
					echo "
				<div class='demo_jui'>
				<table cellpadding='7' cellspacing='0' id='MiTablaVademecun'>
				<thead>
					<tr class='fila'>
						<td>Descripción</td>
						<td>Presentación</td>
						<!--<td>Foto</td>-->
						<td>Fecha</td>						
						<!--<td>Estock</td>-->
						<td>Código <!--Vademecum--></td>
						<td>Asignar</td>	
					</tr>
				</thead>	
				<tbody>

				 ";
				 foreach($datos as $fila)
				 {
					 echo "
					 	<tr>
							<td>$fila[descripcion_far]</td>
							<td>$fila[presentacion_farm]</td>
							<!--<td><div id='Imagenes'><img src='../Bodega/$fila[foto_far]'/></div></td>-->
							<td>$fila[Fecaduca_far]</td>							
							<!--<td>$fila[estock_far]</td>-->
							<td>$fila[id_far]</td>														
							<td><input type='button' value='Asignar' class='btn btn-success' id='bntVademecun' onclick='CodigoVademecum($fila[id_far])'/></td>

						</tr>
					 ";
				 }
			 	echo "
				</tbody>
				</table>
				</div>
					<script type='text/javascript'>						
						$('#MiTablaVademecun').dataTable({
							'bJQueryUI': true,
							'sPaginationType': 'full_numbers',
							'bFilter': true,
							'oLanguage':{
					'sProcessing':     'Procesando...',
					'sLengthMenu':     'Mostrar _MENU_ registros',
					'sZeroRecords':    'No se encontraron resultados',
					'sEmptyTable':     'Ningún dato disponible en esta tabla',
					'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
					'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
					'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
					'sInfoPostFix':    '',
					'sSearch':         'Buscar:',
					'sUrl':            '',
					'sInfoThousands':  ',',
					'sLoadingRecords': 'Cargando...',
					'oPaginate': {
						'sFirst':    'Primero',
						'sLast':     'Último',
						'sNext':     'Siguiente',
						'sPrevious': 'Anterior'
					},
					'oAria': {
						'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
						'sSortDescending': ': Activar para ordenar la columna de manera descendente'
					}
				}
						});
					</script> ";					
	}
	//fin de la funcion vademecum
	//funcion para capturar codigo y descripcion vademecum
	public function codvademecun($codigo)
	{
		$va=new Farmacos;
		$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',id_far) FROM tbl_farmacos WHERE id_far='$codigo'");
		echo  $dato;
	}
	//fin de la funcion codigo y descripcion vedemecum

	//funcio para guaradar la consulta
	public function SaveConsulta($turno,$cie101,$vademe,$cantidad,$dosis,$viaadm,$frecuecia,$hora,$nombreComer,$numeroduracion,$tratamieto)
	{
		$aux=new Consultas;
		$fecha=$this->Mifecha();
		
		$res=$aux->Ejecutar("INSERT INTO 
tbl_consultas (fechaProx_cons,estado_cons,id_tu,id_cie,vademecun_cons,cantidad_cons,dosis_cons,viaAdmin_cons,frecuencia_cons,duracion_cons,nomcomercial_cons,numduracion_cons,tratamiento_cons)
VALUES ('$fecha','MD','$turno','$cie101','$vademe','$cantidad','$dosis','$viaadm','$frecuecia','$hora','$nombreComer','$numeroduracion','$tratamieto')");
		$datos=$aux->Consultar_Consultas("SELECT * FROM tbl_consultas WHERE id_tu='$turno'");
		
		
		echo "
		<div class='demo_jui'>
		<table class='table table-bordered table-striped table-hover table-condensed' id='tblHistori123'>
		<thead>
				<tr>
					<th>Fecha Consulta</th>
					<th>Diagnostico</th>
					<th>Vademecun</th>
					<th>Nombre Comercial</th>
					<th>Cantidad</th>
					<th>Dosis</th>
					<th>Via Administracion</th>
					<th>Frecuencia </th>
					<th>#</th>
					<th>Duracion</th>					
				</tr>
		</thead>
		<tbody>
			";
			foreach($datos as $fila)
			{
				$diag=$aux->Consultar("SELECT desc_diag FROM tbl_cie WHERE id_diag='$fila[id_cie]'");
				echo "
						<tr>
							<td>$fila[fechaProx_cons]</td>
							<td>$fila[id_cie]  $diag</td>
							<td>$fila[vademecun_cons]</td>
							<td>$fila[nomcomercial_cons]</td>
							<td>$fila[cantidad_cons]</td>
							<td>$fila[dosis_cons]</td>
							<td>$fila[viaAdmin_cons]</td>
							<td>$fila[frecuencia_cons]</td>
							<td>$fila[numduracion_cons]</td>
							<td>$fila[duracion_cons]</td>
						</tr>
				    ";
			}
		echo "
			<!--<tr><td colspan='8'><center><input type='button' class='btn btn-success' onclick='FinPaciente($turno)' value='Finalizar Consulta' /> </center></td></tr>-->
	</tbody></table></div>
	<script type='text/javascript'>
			$('#tblHistori123').dataTable({
				'bFilter': false,
				'oLanguage':{
					'sProcessing':     'Procesando...',
					'sLengthMenu':     'Mostrar _MENU_ registros',
					'sZeroRecords':    'No se encontraron resultados',
					'sEmptyTable':     'Ningún dato disponible en esta tabla',
					'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
					'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
					'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
					'sInfoPostFix':    '',
					'sSearch':         'Buscar:',
					'sUrl':            '',
					'sInfoThousands':  ',',
					'sLoadingRecords': 'Cargando...',
					'oPaginate': {
						'sFirst':    'Primero',
						'sLast':     'Último',
						'sNext':     'Siguiente',
						'sPrevious': 'Anterior'
					},
					'oAria': {
						'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
						'sSortDescending': ': Activar para ordenar la columna de manera descendente'
					}
				}			
			});
			</script>					
				
		";
		
	}
	//end funcio para guaradar la consulta
	//funcion para cargar las consultas de hoy hechas a el pacuente en es turno
	public function LoadConsHoyXTurno($turno)
	{
		$aux=new Consultas;
		
		$datos=$aux->Consultar_Consultas("SELECT * FROM tbl_consultas WHERE id_tu='$turno'");
		
		
		echo "
		<div class='demo_jui'>
		<table class='table table-bordered table-striped table-hover table-condensed' id='tblHistori123'>
		<thead>
				<tr>
					<th>Fecha Consulta</th>
					<th>Diagnostico</th>
					<th>Vademecun</th>
					<th>Nombre Comercial</th>
					<th>Cantidad</th>
					<th>Dosis</th>
					<th>Via Administracion</th>
					<th>Frecuencia </th>
					<th>#</th>
					<th>Duracion</th>					
				</tr>
		</thead>
		<tbody>
			";
			foreach($datos as $fila)
			{
				$diag=$aux->Consultar("SELECT desc_diag FROM tbl_cie WHERE id_diag='$fila[id_cie]'");
				echo "
						<tr>
							<td>$fila[fechaProx_cons]</td>
							<td>$fila[id_cie] $diag</td>
							<td>$fila[vademecun_cons]</td>
							<td>$fila[nomcomercial_cons]</td>
							<td>$fila[cantidad_cons]</td>
							<td>$fila[dosis_cons]</td>
							<td>$fila[viaAdmin_cons]</td>
							<td>$fila[frecuencia_cons]</td>
							<td>$fila[numduracion_cons]</td>
							<td>$fila[duracion_cons]</td>
						</tr>
				    ";	
		}
		echo "
			<!--<tr><td colspan='8'><center><input type='button' class='btn btn-success' onclick='FinPaciente($turno)' value='Finalizar Consulta' /> </center></td></tr>-->
	</tbody></table></div>
	<script type='text/javascript'>
			$('#tblHistori123').dataTable({
				'bFilter': false,
				'oLanguage':{
					'sProcessing':     'Procesando...',
					'sLengthMenu':     'Mostrar _MENU_ registros',
					'sZeroRecords':    'No se encontraron resultados',
					'sEmptyTable':     'Ningún dato disponible en esta tabla',
					'sInfo':           'Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros',
					'sInfoEmpty':      'Mostrando registros del 0 al 0 de un total de 0 registros',
					'sInfoFiltered':   '(filtrado de un total de _MAX_ registros)',
					'sInfoPostFix':    '',
					'sSearch':         'Buscar:',
					'sUrl':            '',
					'sInfoThousands':  ',',
					'sLoadingRecords': 'Cargando...',
					'oPaginate': {
						'sFirst':    'Primero',
						'sLast':     'Último',
						'sNext':     'Siguiente',
						'sPrevious': 'Anterior'
					},
					'oAria': {
						'sSortAscending':  ': Activar para ordenar la columna de manera ascendente',
						'sSortDescending': ': Activar para ordenar la columna de manera descendente'
					}
				}			
			});
			</script>					
				
		";

	}
	//fin funcion para cargar las consultas de hoy hechas a el pacuente en es turno
	//funcion para cargar los datos de anamesis o dejarlos vacios
	public function GenerarFormAnanmesis($codigo)
	{
		$aux=new Anamnesis;
		if($aux->Consultar("SELECT COUNT(*) FROM tbl_anamnesis WHERE id_paciente='$codigo'")==0)
		{
			echo "
				<table class='anamnesis'><tr><td>Motivo de Consulta</td><td><textarea id='txtConsulta' cols='40' rows='2'></textarea></td></tr><tr><td>Enfermedad Actual</td><td><textarea id='txtEnfeAc' cols='40' rows='2'></textarea></td></tr><td>Revisión Actual de Sistemas: </td><td><select id='txtSistema' onchange='modal2()'><option>--Seleccione--</option><option value='1'>Hábitos</option><option value='2'>Sistemas</option></select></td></tr><tr><tr><td>Tipo de Sangre:</td><td><select id='txtSangre'><option>Seleccione un tipo ..</option><option>A Rh Positivo</option><option>A Rh Negativo</option><option>B Rh Positivo</option><option>B Rh Negativo</option><option>AB Rh Positivo</option><option>AB Rh Negativo</option><option>O Rh Positivo</option><option>O Rh Negativo</option></select></td></tr><td>Antecedentes No Patológicos Personales</td><td><textarea id='txtAtePato' cols='40' rows='2'></textarea></td></tr><tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Personales</td></tr><tr><td>Alergias</td><td><textarea cols='40' rows='2' id='txtalergia'></textarea></td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalsculares'></textarea></td></tr><tr><td>Metabólicos</td><td><textarea cols='40' rows='2' id='txtMetabolicos'></textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciosos'></textarea></td></tr><tr><td>Neoplásicos</td><td><textarea cols='40' rows='2' id='txtneoplasias'></textarea></td></tr><tr><td>Endocrinológicos</td><td><textarea cols='40' rows='2' id='txtendoCrono'></textarea></td></tr><tr><td>Pulmonares</td><td><textarea cols='40' rows='2' id='txtpulmunares'></textarea></td></tr><tr><td>Nefrológicos</td><td><textarea cols='40' rows='2' id='txtNefrologicas'></textarea></td></tr><tr><td>Hematológicos</td><td><textarea cols='40' rows='2' id='txthematologicas'></textarea></td></tr><tr><td>Músculo Esquelético</td><td><textarea cols='40' rows='2' id='txtesqueleticos'></textarea></td><tr><td>Inmunológicos</td><td><textarea cols='40' rows='2' id='txtInmunologicas'></textarea></td></tr></tr><tr><td>Ginecoobstétricos</td><td><textarea cols='40' rows='2' id='txtginecoobste'></textarea></td></tr> <tr><td>Gastroenterológicos</td><td><textarea cols='40' rows='2' id='txtGastroe'></textarea></td></tr> <tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros'></textarea></td></tr></table></td></tr> <tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Familiares</td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalscularesFa'></textarea></td></tr><tr><td>Metabólicos</td><td><textarea cols='40' rows='2' id='txtMetabolicosFa'></textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciososFa'></textarea></td></tr><tr><td>Neoplásicos</td><td><textarea cols='40' rows='2' id='txtneoplasiasFa'></textarea></td></tr><tr><td>Endocrinológicos</td><td><textarea cols='40' rows='2' id='txtendoCronoFa'></textarea></td></tr><tr><td>Pulmonares</td><td><textarea cols='40' rows='2' id='txtpulmunaresFa'></textarea></td></tr><tr><td>Nefrológicos</td><td><textarea cols='40' rows='2' id='txtNefrologicasFa'></textarea></td></tr><tr><td>Hematológicos</td><td><textarea cols='40' rows='2' id='txthematologicasFa'></textarea></td></tr><tr><td>Músculo Esquelético</td><td><textarea cols='40' rows='2' id='txtesqueleticosFa'></textarea></td><tr><td>Inmunológicos</td><td><textarea cols='40' rows='2' id='txtInmunologicasFa'></textarea></td></tr></tr><tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros3'></textarea></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type='button' class='btn btn-primary' id='bntAnamnesis' value='Guardar Anamnesis' onclick='SaveTotalAnanmesis()' /></td></tr></td></tr>
				</table>					
				 ";
		}
		else
		{
			$cod=$aux->Consultar("SELECT MAX(id_anam) FROM tbl_anamnesis WHERE id_paciente='$codigo'");
			$datos=$aux->Consultar_Anamnesis("SELECT * FROM tbl_anamnesis WHERE id_anam='$cod';");
			foreach($datos as $fila)
			{
							echo "
				<table class='anamnesis'><tr><td>Motivo de Consulta</td><td><textarea id='txtConsulta' cols='40' rows='2' ></textarea></td></tr><tr><td>Enfermedad Actual</td><td><textarea id='txtEnfeAc' cols='40' rows='2'></textarea></td></tr><tr><td>Revisión Actual de Sistemas: </td><td><select id='txtSistema' onchange='modal2()'><option>--Seleccione--</option><option value='1'>Hábitos</option><option value='2'>Sistemas</option></select></td></tr><tr><tr><td>Tipo de sangre:</td><td><input type='text' id='txtSangre' readonly value='$fila[tiposangre_anam]'/></td></tr><td>Antecedentes No Patológicos Personales</td><td><textarea id='txtAtePato' cols='40' rows='2'>$fila[nopatologicos_anam]</textarea></td></tr><tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Personales</td></tr><tr><td>Alergias</td><td><textarea cols='40' rows='2' id='txtalergia'>$fila[alergias_anam]</textarea></td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalsculares'>$fila[cardiovaculares_anam]</textarea></td></tr><tr><td>Metabólicos</td><td><textarea cols='40' rows='2' id='txtMetabólicos'>$fila[metabofam_anam]</textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciosos'>$fila[infescciosos_anam]</textarea></td></tr><tr><td>Neoplásicos</td><td><textarea cols='40' rows='2' id='txtneoplasias'>$fila[neoplastias_anam]</textarea></td></tr><tr><td>Endocronológicos</td><td><textarea cols='40' rows='2' id='txtendoCrono'>$fila[endocrono_anam]</textarea></td></tr><tr><td>Pulmonares</td><td><textarea cols='40' rows='2' id='txtpulmunares'>$fila[pulmonares_anam]</textarea></td></tr><tr><td>Nefrológicos</td><td><textarea cols='40' rows='2' id='txtNefrologicas'>$fila[nefro_anam]</textarea></td></tr><tr><td>Hematológicos</td><td><textarea cols='40' rows='2' id='txthematologicas'>$fila[hemato_anam]</textarea></td></tr><tr><td>Músculo Esquelético</td><td><textarea cols='40' rows='2' id='txtesqueleticos'>$fila[esquele_anam]</textarea></td><tr><td>Inmunológicos</td><td><textarea cols='40' rows='2' id='txtInmunologicas'>$fila[inmuno_anam]</textarea></td></tr></tr><tr><td>Ginecoobstétricos</td><td><textarea cols='40' rows='2' id='txtginecoobste'>$fila[ginecoobste_anam]</textarea></td></tr><tr><td>Gastroenterológicos</td><td><textarea cols='40' rows='2' id='txtGastroe'>$fila[gastroe_anam]</textarea></td></tr><tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros'>$fila[otros_anam]</textarea></td></tr></table></td></tr>    <tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Familiares</td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalscularesFa'>$fila[cardiovasfam_anam]</textarea></td></tr><tr><td>Metabólicos</td><td><textarea cols='40' rows='2' id='txtMetabolicosFa'>$fila[metabofam_anam]</textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciososFa'>$fila[infeccfam_anam]</textarea></td></tr><tr><td>Neoplásicos</td><td><textarea cols='40' rows='2' id='txtneoplasiasFa'>$fila[neoplasfam_anam]</textarea></td></tr><tr><td>Endocrinológicos</td><td><textarea cols='40' rows='2' id='txtendoCronoFa'>$fila[endocronofam_anam]</textarea></td></tr><tr><td>Pulmonares</td><td><textarea cols='40' rows='2' id='txtpulmunaresFa'>$fila[pulmofam_anam]</textarea></td></tr><tr><td>Nefrológicos</td><td><textarea cols='40' rows='2' id='txtNefrologicasFa'>$fila[nefrolofam_anam]</textarea></td></tr><tr><td>Hematológicos</td><td><textarea cols='40' rows='2' id='txthematologicasFa'>$fila[hematofam_anam]</textarea></td></tr><tr><td>Músculo Esquelético</td><td><textarea cols='40' rows='2' id='txtesqueleticosFa'>$fila[esquelefam_anam]</textarea></td><tr><td>Inmunológicas</td><td><textarea cols='40' rows='2' id='txtInmunologicasFa'>$fila[inmunofam_anam]</textarea></td></tr></tr><tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros3'>$fila[otrosfam_anam]</textarea></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type='button' class='btn btn-primary' id='bntAnamnesis' value='Guardar Anamnesis' onclick='SaveTotalAnanmesis()' /></td></tr></td></tr>
				</table>					
				 ";
			}
			
		}
	}
	//fin funcion para cargar los datos de anamesis o dejarlos vacios	
	//function to load data system
	public function Systema($codigo)
	{
		$aux=new Sistemas;
		if($aux->Consultar("SELECT COUNT(*) FROM tbl_anamnesis WHERE id_paciente='$codigo'")==0)
		{
			echo "<table><tr><td>Auditivo: </td><td><textarea id='txtAuditivo' cols='40' rows='2'></textarea></td></tr><tr><td>Oftalmológico: </td><td><textarea id='txtOftalmo' cols='40' rows='2'></textarea></td></tr><tr><td>Otorrinolaringológico: </td><td><textarea id='txtOtorrino' cols='40' rows='2'></textarea></td></tr><tr><td>Nervios Craneales: </td><td><textarea id='txtNervios' cols='40' rows='2'></textarea></td></tr><tr><td>Digestivo: </td><td><textarea id='txtDigest' cols='40' rows='2'></textarea></td></tr><tr><td>Renal: </td><td><textarea id='txtRenal' cols='40' rows='2'></textarea></td></tr><tr><td>Pulmonar: </td><td><textarea id='txtPulmonar' cols='40' rows='2'></textarea></td></tr><tr><td>Cardiovascular: </td><td><textarea id='txtCardio' cols='40' rows='2'></textarea></td></tr><tr><td>Músculo Esquelético: </td><td><textarea id='txtOseo' cols='40' rows='2'></textarea></td></tr><tr><td>Gineco Obstétrico: </td><td><textarea id='txtGinecoObs' cols='40' rows='2'></textarea></td></tr><tr><td>Endocrinológico: </td><td><textarea id='txtEndocrino' cols='40' rows='2'></textarea></td></tr><tr><td>Otros: </td><td><textarea id='txtOtros' cols='40' rows='2'></textarea></td></tr><tr><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr></tr><tr><td colspan='2' align='center'><input type='button' class='btn btn-primary' id='bntExitSys' value='Guardar y Salir' onclick='ExitSistemas()' />  &nbsp;&nbsp;&nbsp;</td></tr></table>";
		}
		else
		{
			$cod=$aux->Consultar("SELECT MAX(id_sistemas) FROM tbl_anamnesis WHERE id_paciente='$codigo';");
			$datos=$aux->Consultar_Sistemas("SELECT * FROM tbl_sistemas WHERE id_sist='$cod'");
			foreach($datos as $fila)
			{
			echo "<table><tr><td>Auditivo: </td><td><textarea id='txtAuditivo' cols='40' rows='2'>$fila[auditivo_sist]</textarea></td></tr><tr><td>Oftalmológico: </td><td><textarea id='txtOftalmo' cols='40' rows='2'>$fila[oftalmo_sist]</textarea></td></tr><tr><td>Otorrinolaringológico: </td><td><textarea id='txtOtorrino' cols='40' rows='2'>$fila[otorrino_sist]</textarea></td></tr><tr><td>Nervios Craneales: </td><td><textarea id='txtNervios' cols='40' rows='2'>$fila[nervioscra_sist]</textarea></td></tr><tr><td>Digestivo: </td><td><textarea id='txtDigest' cols='40' rows='2'>$fila[digestivo_sist]</textarea></td></tr><tr><td>Renal: </td><td><textarea id='txtRenal' cols='40' rows='2'>$fila[renal_sist]</textarea></td></tr><tr><td>Pulmonar: </td><td><textarea id='txtPulmonar' cols='40' rows='2'>$fila[pulmonar_sist]</textarea></td></tr><tr><td>Cardiovascular: </td><td><textarea id='txtCardio' cols='40' rows='2'>$fila[cardiovas_sist]</textarea></td></tr><tr><td>Músculo Esquelético: </td><td><textarea id='txtOseo' cols='40' rows='2'>$fila[oseao_sist]</textarea></td></tr><tr><td>Gineco Obstétrico: </td><td><textarea id='txtGinecoObs' cols='40' rows='2'>$fila[ginecoobst_sist]</textarea></td></tr><tr><td>Endocrinológico: </td><td><textarea id='txtEndocrino' cols='40' rows='2'>$fila[endocrino_sist]</textarea></td></tr><tr><td>Otros: </td><td><textarea id='txtOtros' cols='40' rows='2'>$fila[otros_sist]</textarea></td></tr><tr><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr></tr><tr><td colspan='2' align='center'><input type='button' class='btn btn-primary' id='bntExitSys' value='Guardar y Salir' onclick='ExitSistemas()' />  &nbsp;&nbsp;&nbsp;</td></tr></table>";				
			}
		}
	}
	//function to load data system
	
	//functio to load data habits
	public function HabitosLoad($codigo)
	{
		$aux=new Habitos;
		if($aux->Consultar("SELECT COUNT(*) FROM tbl_anamnesis WHERE id_paciente='$codigo';")==0)
		{
			echo "<table><tr><td colspan='2' align='center'>Formulario de Hábitos del Paciente.</tr><tr><td></td></tr><tr><td>Tabaco: </td><td><input type='text' id='txtTabaco' /></td></tr><tr><td>Alcohol: </td><td><input type='text' id='txtAlcohol'/></td></tr><tr><td>Drogas: </td><td><input type='text' id='txtDrogas' /></td></tr><tr><td>Medicamentos (los que tome continuamente)</td><td><input type='text' id='txtMedicamentos'/></td></tr><tr><td>Ejercicio: </td><td><input type='text' id='txtEjercicio' /></td></tr><tr><td>Tipo de Dieta: </td><td><input type='text' id='txtDieta' /></td></tr><tr><td>Vacunas: </td><td><input type='text' id='txtVacunas' /></td><tr><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr></tr><tr><td colspan='2' align='center'><input type='button' class='btn btn-primary' id='bntExitHab' value='Guardar y Salir' onclick='ExitHabitos()' />  &nbsp;&nbsp;&nbsp;</td></tr></table>";
		}
		else
		{
			$cod=$aux->Consultar("SELECT MAX(id_habitos) FROM tbl_anamnesis WHERE id_paciente='$codigo';");
			$datos=$aux->Consultar_Habitos("SELECT * FROM tbl_habitos WHERE id_hab='$cod';");
			foreach($datos as $fila)
			{
				echo "<table><tr><td colspan='2' align='center'>Formulario de Hábitos del Paciente.</tr><tr><td></td></tr><tr><td>Tabaco: </td><td><input type='text' id='txtTabaco' value='$fila[tabaco_hab]' /></td></tr><tr><td>Alcohol: </td><td><input type='text' id='txtAlcohol' value='$fila[alcohol_hab]'/></td></tr><tr><td>Drogas: </td><td><input type='text' id='txtDrogas' value='$fila[drogas_hab]'/></td></tr><tr><td>Medicamentos (los que tome continuamente)</td><td><input type='text' id='txtMedicamentos' value='$fila[medicamentos_hab]'/></td></tr><tr><td>Ejercicio: </td><td><input type='text' id='txtEjercicio' value='$fila[ejercicio_hab]' /></td></tr><tr><td>Tipo de Dieta: </td><td><input type='text' id='txtDieta' value='$fila[tipodieta_hab]' /></td></tr><tr><td>Vacunas: </td><td><input type='text' id='txtVacunas' value='$fila[vacunas_hab]' /></td><tr><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr></tr><tr><td colspan='2' align='center'><input type='button' class='btn btn-primary' id='bntExitHab' value='Guardar y Salir' onclick='ExitHabitos()' />  &nbsp;&nbsp;&nbsp;</td></tr></table>";
			}
		}
	}
	///function to load data habits
	
	public function HabitosLight($codigo,$tabaco,$alcohol,$drogas,$medicamentos,$ejercicio,$dieta,$vacunas){
		$aux2=new Habitos;
		$res=$aux2->Ejecutar("INSERT INTO tbl_habitos (tabaco_hab,alcohol_hab,drogas_hab,medicamentos_hab,ejercicio_hab,tipodieta_hab,vacunas_hab,estado_hab) VALUES('$tabaco','$alcohol','$drogas','$medicamentos','$ejercicio','$dieta','$vacunas','A')");
		echo "Datos Guardados Correctamente ";
	}
	public function SistemasLight($codigo,$auditivo,$oftalmo,$otorrino,$nervios,$digestivo,$renal,$pulmonar,$cardivas,$oseo,$gineco,$otros,$endocrino){
		$aux3=new Sistemas;
		$aux3->Ejecutar("INSERT INTO tbl_sistemas (auditivo_sist,oftalmo_sist,otorrino_sist,nervioscra_sist,digestivo_sist,renal_sist,pulmonar_sist,cardiovas_sist,oseao_sist,ginecoobst_sist,otros_sist,estado_sist,endocrino_sist) VALUES('$auditivo','$oftalmo','$otorrino','$nervios','$digestivo','$renal','$pulmonar','$cardivas','$oseo','$gineco','$otros','A','$endocrino')");
				echo "Datos Guardados Correctamente ";
	}
	//funcion para actulizar los datos de Anamnesis
	
	public function UpdateAnamnesis($motivocon,$enfermeactual,$tiposangre,$nopatologicos,$alergi,$cardiovas,$metab,$infecc,$neoplas,$endocro,$pulmon,$nefro,$hemato,$esquele,$inmuno,$gineco,$otrospat,$cardiofam,$metabfam,$infeccfam,$neoplasfam,$endocronofam,$pulmofam,$nefrofam,$hematofam,$esquelefam,$inmunofam,$otrosfam, 
	
	$tabaco,$achohol,$drogas,$medi,$exercise,$tipodiet,$vacuns, 
	
	$audit,$oftalmo,$otorrinolari,$nervioscran,$digest,$renal,$pulmonar,$cardiovas3,$oseo,$ginecoobste,$otrossyst,$codoculpacanam, $codigo,$endocri,$gastroe)
	{
		$aux=new Anamnesis;
		$aux2=new Habitos;
		$aux3=new Sistemas;
		
		$codHab=$aux->Consultar("SELECT id_habitos FROM tbl_anamnesis WHERE id_paciente='$codigo' ;");
		$codSiste=$aux->Consultar("SELECT id_sistemas FROM tbl_anamnesis WHERE id_paciente='$codigo';");
		$codAname=$aux->Consultar("SELECT id_anam FROM tbl_anamnesis WHERE id_paciente='$codigo' ;");
		
		 $aux2->Ejecutar("UPDATE tbl_habitos SET tabaco_hab='$tabaco', alcohol_hab='$achohol', drogas_hab='$drogas', medicamentos_hab='$medi', ejercicio_hab='$exercise', tipodieta_hab='$tipodiet', vacunas_hab='$vacuns' WHERE id_hab='$codHab';");
		
		
		
		
		 $aux3->Ejecutar("UPDATE tbl_sistemas SET auditivo_sist='$audit',oftalmo_sist='$oftalmo',otorrino_sist='$otorrinolari',nervioscra_sist='$nervioscran',digestivo_sist='$digest',renal_sist='$renal',pulmonar_sist='$pulmonar',cardiovas_sist='$cardiovas3',oseao_sist='$oseo',ginecoobst_sist='$ginecoobste',otros_sist='$otrossyst',endocrino_sist='$endocri' where id_sist='$codSiste'");
		//$codsistemas=$aux3->Consultar("SELECT MAX(id_sist) FROM tbl_sistemas");
		
		
		 $aux->Ejecutar("UPDATE tbl_anamnesis SET motivocon_anam='$motivocon',enfermedac_anam='$enfermeactual',tiposangre_anam='$tiposangre',nopatologicos_anam='$nopatologicos',alergias_anam='$alergi',cardiovaculares_anam='$cardiovas',metabolicos_anam='$metab',infescciosos_anam='$infecc',neoplastias_anam='$neoplas',endocrono_anam='$endocro',pulmonares_anam='$pulmon',nefro_anam='$nefro',hemato_anam='$hemato',esquele_anam='$esquele',inmuno_anam='$inmuno',ginecoobste_anam='$gineco',otros_anam='$otrospat',cardiovasfam_anam='$cardiofam',metabofam_anam='$metabfam',infeccfam_anam='$infeccfam',neoplasfam_anam='$neoplasfam',endocronofam_anam='$endocronofam',pulmofam_anam='$pulmofam',nefrolofam_anam='$nefrofam',hematofam_anam='$hematofam',esquelefam_anam='$esquelefam',inmunofam_anam='$inmunofam',otrosfam_anam='$otrosfam', gastroe_anam='$gastroe' WHERE id_anam='$codAname';");
		echo "<h3>Se ha guardado correctamente la Anamnesis</h3>";
	}	
	
	
	
	
	
	
	//function para cargar el nuevo histrorial del paciente 
	public function NewHistorialPaciente($codigo)
	{
		$anam=new Anamnesis;
		$cie=new Cie;
		$tu=new Turno;
		$con=new Consultas;
		$descie=NULL;
		$tratamiento=NULL;
		$exa=new Examen;
		$ima=new Medimagen;
		$exaf=new ExamenFisico;
		$datos=$tu->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_pac='$codigo' ORDER BY id_tu DESC ;");
		$ex=$exa->Consultar("SELECT MAX(id_tu) FROM tbl_turno WHERE id_pac='$codigo'");
		
		$descex=NULL;
		$descimgn=NULL;
		$exafisico=NULL;
		if(count($datos)>0){
			echo "<table class='table table-bordered table-condensed table-striped'>
					<tr>
						<th>Fecha</th>
						<th>Consulta</th>
						<th>Diagnostico</th>
						<th>Tratamiento</th>
						<th>Examenes</th>
						<th>Examen Físico</th>
						<th>Imagen</th>
						<th>Medicamentos</th>
						<th>Médico Tratante</th>
					</tr>
			";
			foreach($datos as $fila){
				if($anam->Consultar("SELECT COUNT(*) FROM tbl_anamnesis WHERE id_tu='$fila[id_tu]';")>0){
					echo "
					<tr>
		<td>".$anam->Consultar("SELECT fecha_anam FROM tbl_anamnesis WHERE id_tu='$fila[id_tu]';")."</td>					        <td>".$anam->Consultar("SELECT motivocon_anam FROM tbl_anamnesis WHERE id_tu='$fila[id_tu]';")."</td>
		<td>
		";
		$consultas=$con->Consultar_Consultas("SELECT * FROM tbl_consultas WHERE id_tu='$fila[id_tu]'");
	
		foreach($consultas as $fila1){
				$descie=$fila1['id_cie']." ".$anam->Consultar("SELECT desc_diag FROM tbl_cie WHERE id_diag='$fila1[id_cie]';")." ; ".$descie;
			
		}
		echo $descie;
		$descie="";
	
						echo"
						</td><td>";
				foreach($consultas as $fila1){
					$tratamiento=$fila1['tratamiento_cons']." , ".$tratamiento;
						
				}				
					echo $tratamiento;
					$tratamiento="";	
				echo "	</td>";
				
				$examensss=$exa->Consultar_Examen("SELECT * FROM tbl_examen WHERE id_tu='$fila[id_tu]'");
				
				echo "<td>";
				foreach($examensss as $fila3)
				{
					if($fila3['otrosori_exa']!="")
					{
						$descex="<b>Otros Orina: </b>".$fila3['otrosori_exa'].", ".$descex."<p>";
					}
					if($fila3['estliq_exa']!="")
					{
						$descex="<b>Estudio Líquidos: </b>".$fila3['estliq_exa'].", ".$descex."<p>";
					}
					if($fila3['muestra_exa']!="")
					{
						$descex="<b>Muestra de: </b>".$fila3['muestra_exa'].", ".$descex."<p>";
					}
					if($fila3['diasno_exa']!="")
					{
						$descex="<b>Días no: </b>".$fila3['diasno_exa'].", ".$descex."<p>";
					}
					if($fila3['otroselec_exa']!="")
					{
						$descex="<b>Otros Electrolitos: </b>".$fila3['otroselec_exa'].", ".$descex."<p>";
					}
					
					$descex=$fila3['desc_exa'].", ".$descex."<p>";
					
				}
				echo $descex;
				$descex="";
				echo "</td>";
				
				$exfi=$exaf->Consultar_ExamenFisico("SELECT * FROM tbl_examen_fisico WHERE id_tu='$fila[id_tu]'");
				
				echo "<td>";
				foreach ($exfi as $filae)
				{
					if($filae['biotipo_constitucional']!="")
					{
						$exafisico="<b>Biotipo Constitucional: </b>".$filae['biotipo_constitucional'].", ".$exafisico."<p>";
					}
					if($filae['actitud']!="")
					{
						$exafisico="<b>Actitud: </b>".$filae['actitud'].", ".$exafisico."<p>"; 
					}
					if($filae['estado_conciencia']!="")
					{
						$exafisico="<b>Estado Conciencia: </b>".$filae['estado_conciencia'].", ".$exafisico."<p>";
					}
					if($filae['glasgow']!="")
					{
						$exafisico="<b>Glasgow: </b>".$filae['glasgow'].", ".$exafisico."<p>";
					}
					if($filae['temperatura']!="")
					{
						$exafisico="<b>Temperatura: </b>".$filae['temperatura'].", ".$exafisico."<p>";
					}
					if($filae['presion_arterial']!="")
					{
						$exafisico="<b>Presión Arterial: </b>".$filae['presion_arterial'].", ".$exafisico."<p>";
					}
					if($filae['frecuencia_cardiaca']!="")
					{
						$exafisico="<b>Frecuencia Cardiaca: </b>".$filae['frecuencia_cardiaca'].", ".$exafisico."<p>";
					}
					if($filae['frecuencia_respiratoria']!="")
					{
						$exafisico="Frecuencia Respiratoria: ".$filae['frecuencia_respiratoria'].", ".$exafisico."<p>";
					}
					if($filae['peso']!="")
					{
						$exafisico="<b>Peso: </b>".$filae['peso'].", ".$exafisico."<p>";
					}
					if($filae['talla']!="")
					{
						$exafisico="<b>Talla: </b>".$filae['talla'].", ".$exafisico."<p>";
					}
					if($filae['indice_masa_corporal']!="")
					{
						$exafisico="<b>IMC</b>".$filae['indice_masa_corporal'].", ".$exafisico."<p>";
					}
					if($filae['perimetro_cefalico']!="")
					{
						$exafisico="<b>Perímetro Cefálico: </b>".$filae['perimetro_cefalico'].", ".$exafisico."<p>";
					}
					if($filae['perimetro_toracico']!="")
					{
						$exafisico="<b>Perímetro Torácico: </b>".$filae['perimetro_toracico'].", ".$exafisico."<p>";
					}
					if($filae['perimetro_abdominal']!="")
					{
						$exafisico="<b>Perímetro Abdominal: </b>".$filae['perimetro_abdominal'].", ".$exafisico."<p>";
					}
					if($filae['peso_ideal']!="")
					{
						$exafisico="<b>Peso Ideal: </b>".$filae['peso_ideal'].", ".$exafisico."<p>";
					}
					if($filae['tension_arterial_acostado']!="")
					{
						$exafisico="<b>T.A. Acostado: </b>".$filae['tension_arterial_acostado'].", ".$exafisico."<p>";
					}
					if($filae['tension_arterial_sentado']!="")
					{
						$exafisico="<b>T.A. Sentado: </b>".$filae['tension_arterial_sentado'].", ".$exafisico."<p>";
					}
					if($filae['tension_arterial_de_pie']!="")
					{
						$exafisico="<b>T.A. de Pie: </b>".$filae['tension_arterial_de_pie'].", ".$exafisico."<p>";
					}
					if($filae['superficie_corporal']!="")
					{
						$exafisico="<b>Superficie Corporal: </b>".$filae['superficie_corporal'].", ".$exafisico."<p>";
					}
					if($filae['piel']!="")
					{
						$exafisico="<b>Piel: </b>".$filae['piel'].", ".$exafisico."<p>";
					}
					if($filae['cabeza_cuello_conopcion']!="")
					{
						$exafisico="<b>Cabeza: </b>".$filae['cabeza_cuello_conopcion'].", ".$exafisico."<p>";
					}
					if($filae['cuello_conopcion']!="")
					{
						$exafisico="<b>Cuello: </b>".$filae['cuello_conopcion'].", ".$exafisico."<p>";
					}
					if($filae['torax_conopcion']!="")
					{
						$exafisico="<b>Torax :</b>".$filae['torax_conopcion'].", ".$exafisico."<p>";
					}
					if($filae['abdomen_conopcion']!="")
					{
						$exafisico="<b>Abdomen: </b>".$filae['abdomen_conopcion'].", ".$exafisico."<p>";
					}
					if($filae['aparato_urinario']!="")
					{
						$exafisico="<b>Aparato Urinario: </b>".$filae['aparato_urinario'].", ".$exafisico."<p>";
					}
					if($filae['aparato_digestivo']!="")
					{
						$exafisico="Aparato Digestivo: ".$filae['aparato_digestivo'].", ".$exafisico."<p>";
					}
					if($filae['aparato_genital_masculino']!="")
					{
						$exafisico="<b>Aparato Genital Masculino: </b>".$filae['aparato_genital_masculino'].", ".$exafisico."<p>";
					}
					if($filae['aparato_genital_femenino']!="")
					{
						$exafisico="<b>Aparato Genital Femenino: </b>".$filae['aparato_genital_femenino'].", ".$exafisico."<p>";
					}
					if($filae['sistema_musculo_esqueletico']!="")
					{
						$exafisico="<b>Sistema Músculo Esquelético: </b>".$filae['sistema_musculo_esqueletico'].", ".$exafisico."<p>";
					}
					if($filae['sistema_nervioso']!="")
					{
						$exafisico="<b>Sistema Nervioso: </b>".$filae['sistema_nervioso'].", ".$exafisico."<p>";
					}
					if($filae['CCFascies']!="")
					{
						$exafisico="<b>Fascies: </b>".$filae['CCFascies'].", ".$exafisico."<p>";
					}
					if($filae['CCOjos']!="")
					{
						$exafisico="<b>Ojos: </b>".$filae['CCOjos'].", ".$exafisico."<p>";
					}
					if($filae['CCNariz']!="")
					{
						$exafisico="<b>Nariz: </b>".$filae['CCNariz'].", ".$exafisico."<p>";
					}
					if($filae['CCBoca']!="")
					{
						$exafisico="<b>Boca: </b>".$filae['CCBoca'].", ".$exafisico."<p>";
					}
					if($filae['CCOidos']!="")
					{
						$exafisico="<b>Oidos: </b>".$filae['CCOidos'].", ".$exafisico."<p>";
					}
					if($filae['CCFaringe']!="")
					{
						$exafisico="<b>Faringe: </b>".$filae['CCFaringe'].", ".$exafisico."<p>";
					}
					if($filae['CForma']!="")
					{
						$exafisico="<b>Forma: </b>".$filae['CForma'].", ".$exafisico."<p>";
					}
					if($filae['CMovimientos']!="")
					{
						$exafisico="<b>Movimientos: </b>".$filae['CMovimientos'].", ".$exafisico."<p>";
					}
					if($filae['CPiel']!="")
					{
						$exafisico="<b>Piel(Cuello): </b>".$filae['CPiel'].", ".$exafisico."<p>";
					}
					if($filae['CPartesBlandas']!="")
					{
						$exafisico="<b>Partes Blandas(Cuello): </b>".$filae['CPartesBlandas'].", ".$exafisico."<p>";
					}
					if($filae['CTiroides']!="")
					{
						$exafisico="<b>Tiroides: </b>".$filae['CTiroides'].", ".$exafisico."<p>";
					}
					if($filae['CGanglios']!="")
					{
						$exafisico="<b>Ganglios: </b>".$filae['CGanglios'].", ".$exafisico."<p>";
					}
					if($filae['TRespiratorios']!="")
					{
						$exafisico="<b>Mov. Respiratorios: </b>".$filae['TRespiratorios'].", ".$exafisico."<p>";
					}
					if($filae['TPiel']!="")
					{
						$exafisico="<b>Piel(Torax): </b>".$filae['TPiel'].", ".$exafisico."<p>";
					}
					if($filae['TBlandas']!="")
					{
						$exafisico="<b>Partes Blandas(Torax): </b>".$filae['TBlandas'].", ".$exafisico."<p>";
					}
					if($filae['TMamas']!="")
					{
						$exafisico="<b>Mamas: </b>".$filae['TMamas'].", ".$exafisico."<p>";
					}
					if($filae['TCorazon']!="")
					{
						$exafisico="<b>Corazón: </b>".$filae['TCorazon'].", ".$exafisico."<p>";
					}
					if($filae['TPulmones']!="")
					{
						$exafisico="<b>Pulmones: </b>".$filae['TPulmones'].", ".$exafisico."<p>";
					}
					if($filae['AbdomenPiel']!="")
					{
						$exafisico="<b>Piel(Abdomen): </b>".$filae['AbdomenPiel'].", ".$exafisico."<p>";
					}
					if($filae['Abdomenvolumen']!="")
					{
						$exafisico="<b>Forma, Volumen y Tamaño: </b>".$filae['Abdomenvolumen'].", ".$exafisico."<p>";
					}
					if($filae['volumenPartesBlandas']!="")
					{
						$exafisico="<b>Partes Blandas(Abdomen): </b>".$filae['volumenPartesBlandas'].", ".$exafisico."<p>";
					}
				}
				echo $exafisico;
				$exafisico="";
				echo "</td>";
				
				$imagen=$ima->Consultar_Medimagen("SELECT * FROM tbl_medimagen WHERE id_tu='$fila[id_tu]'");
				
				echo "<td>";
				foreach($imagen as $fila4)
				{
					$descimgn=$fila4['desc_medimagen'].", ".$descimgn."<p>";
				}
				echo $descimgn;
				$descimgn="";
				echo "</td>";
				
				echo "<td>
				
				<table>
						<tr>
							<th>Medicamento</th>
							<th>Cant.</th>
							<th>Dosis</th>
							<th>Via</th>
							<th>Frecuencia</th>
							<th>Duracion</th>
						</tr>
				";
				foreach($consultas as $fila2){
				echo "
					<tr >
						<!--<td>$fila2[nomcomercial_cons]</td>-->
						<td>$fila2[vademecun_cons]</td>
						<td>$fila2[cantidad_cons]</td>
						<td>$fila2[dosis_cons]</td>
						<td>$fila2[viaAdmin_cons]</td>
						<td>$fila2[frecuencia_cons]</td>
						<td>$fila2[duracion_cons]</td>
					</tr>
					";
				}
				$medico=$tu->Consultar("SELECT CONCAT(u.nombresCom_usu,' -> ',e.descripcion_esp) nombresCom_usu FROM tbl_usuario u, tbl_especialida e WHERE u.id_usu='$fila[id_usu]' AND u.id_esp=e.id_esp");
				echo "</table></td>	
					
					<td>$medico</td>
					
					</tr>
					";
										
				}
			}
			echo "</table>";
		}else{
			echo "Error Paciente Sin Turno";
		}
		
	}
	//end function para cargar el nuevo histrorial del paciente  
	
	//funcion para registrar la alerta
	public function RegistrarAlerta($codigo, $alerta)
	{
		$pac=new Paciente;
		$alert=$pac->Consultar("SELECT alerta_pac FROM tbl_paciente WHERE id_pac='$codigo'");
		$var=$alert." <p> ".$alerta; 
		$aux=$pac->Consultar("UPDATE tbl_paciente SET alerta_pac='$var' WHERE id_pac='$codigo'");
		$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE id_pac='$codigo'");
			echo "
		<table class='table table-bordered table-striped table-hover table-condensed'>
				<thead>
					<tr class='fila'>
						<th>Alertas</th>
					</tr>
					</thead>	
					
				 ";
		foreach($datos as $fila)
		{
			echo "<tr>
					<td>$fila[alerta_pac]</td>
				</tr>";
		}
		echo "</table>";
	}
	//fin funcion para registrar la alerta
	//inicio funcion Cargar All alertas
	public function CargarAllAlertas($codigo)
	{
		$pac=new Paciente;
		$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE id_pac='$codigo'");
		echo "
		<table class='table table-bordered table-striped table-hover table-condensed'>
				<thead>
					<tr class='fila'>
						<th>Alertas</th>
					</tr>
					</thead>	
					
				 ";
		foreach($datos as $fila)
		{
			echo "<tr>
					<td>$fila[alerta_pac]</td>
				</tr>";
		}
		echo "</table>";
		
	}
	//fin funcion cargar all alertas
	//funcion para sacar a el pacieten de la lista de conultas
	public function FinaLizarPaciente($turno)
	{
		$aux=new Turno;
		$aux->Ejecutar("UPDATE tbl_turno SET estado_tur='RM' WHERE id_tu='$turno';");
		
		
	}
	//fin funcion para sacar a el pacieten de la lista de conultas	
	
	public function LoadMotivoNow()
	{
		$aux=new Anamnesis;
		$cod=$aux->Consultar("SELECT MAX(id_anam) FROM tbl_anamnesis");
		$descripcion=$aux->Consultar("SELECT motivocon_anam FROM tbl_anamnesis WHERE id_anam='$cod'");
		echo $descripcion;
	}
	public function LoadEneferemedadNow()
	{
		$aux=new Anamnesis;
		$cod=$aux->Consultar("SELECT MAX(id_anam) FROM tbl_anamnesis");
		$descripcion=$aux->Consultar("SELECT enfermedac_anam FROM tbl_anamnesis WHERE id_anam='$cod';");
		echo $descripcion;
	}
	public function LoadExamendNow($codigo)
	{
		$aux=new ExamenFisico;
		$datos=$aux->Consultar_ExamenFisico("SELECT * FROM tbl_examen_fisico WHERE id_tu='$codigo';");
		foreach($datos as $fila)
		{
			echo "
					$fila[biotipo_constitucional]<p>
					$fila[actitud]<p>
					$fila[estado_conciencia]<p>
					$fila[glasgow]<p>
					$fila[temperatura]<p>
					$fila[presion_arterial]<p>
					$fila[frecuencia_cardiaca]<p>
					$fila[frecuencia_respiratoria]<p>
					$fila[peso]<p>
					$fila[talla]<p>
					$fila[indice_masa_corporal]<p>
					$fila[perimetro_cefalico]<p>
					$fila[perimetro_toracico]<p>
					$fila[perimetro_abdominal]<p>
					$fila[peso_ideal]<p>
					$fila[tension_arterial_acostado]<p>
					$fila[tension_arterial_sentado]<p>
					$fila[tension_arterial_de_pie]<p>
					$fila[superficie_corporal]<p>
					$fila[piel]<p>
					$fila[cabeza_cuello_conopcion]<p>
					$fila[cuello_conopcion]<p>
					$fila[torax_conopcion]<p>
					$fila[abdomen_conopcion]<p>
					$fila[aparato_urinario]<p>
					$fila[aparato_digestivo]<p>
					$fila[aparato_genital_masculino]<p>
					$fila[aparato_genital_femenino]<p>
					$fila[sistema_musculo_esqueletico]<p>
					$fila[sistema_nervioso]<p>
				";
		
		}
		
	}
	public function LoadSolicitudExamenNow($codigo)
	{
		$aux=new Examen;
		$datos=$aux->Consultar_Examen("SELECT * FROM tbl_examen WHERE id_tu='$codigo';");
		$cont=0;
		$descripcion=NULL;
		foreach($datos as $fila)
		{
			//if($cont<=1)
		//	{

				//$descripcion=	$fila['desc_exa']."<p>".$descripcion;
				echo $fila['desc_exa']."<p>";

			//}
			//$cont++;
		}
		//echo $descripcion;
		
	}
	public function cargarIngresoSalida($codigopaciente,$codigoturno)
	{
		$tu=new Turno;
		$pas=new Paciente;
		$dturno=$tu->Consultar("SELECT fechaC_tu FROM tbl_turno WHERE id_tu='$codigoturno'");
		$datos=$pas->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE id_pac='$codigopaciente'");
		echo"<table class='table table-bordered table-striped table-condensed'>
		<tr> 
		<th><center>Nombre</center></th>
		<th><center>Cédula</center></th>
		<th><center>Teléfono</center></th>
		<th><center>Día de Ingreso</center></th>
		<th><center>Día de Alta</center></th>
		</tr>
		
		";
		foreach($datos as $filas)
		{
			echo"<tr>
			<td><center> $filas[nombresCom_pac]</center></td>
			<td><center>$filas[cedula_pac] </center></td>
			<td><center>$filas[telefono_pac] </center></td>
			<td><center>$dturno</center></td>
			<td><center><input type= 'text' id='txtfechaalta'/></center></td>
			</tr>
			";
		}
			echo" <tr>
		<th><center>Tipo Cirugía</center></th>
		<th colspan='3'><center>Honorarios</center></th>
		<th><center>Guardar</center></th>
		</tr> 
		
		<tr>
			<td><center><textarea id='TCirugia' rows='1' cols='1'></textarea></center></td>
			<td colspan='3'><center><textarea id='txtHonorarios' rows='1' cols='1'></textarea></center></td>
			<td><center><input type= 'button' class='btn btn-danger' id='btnguardaraltap' value='Guardar' onclick='guardarsalida()'/></center></td>
			</tr>
			
		</table>
		
			<script type='text/javascript'>
			$('#txtfechaalta').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtfechaalta').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );</script>
			
			";
	}
	public function alta($codigot,$fechaturno,$tipocir,$honora)
	{
		$codt=new Turno;
		$codt->Ejecutar("UPDATE tbl_turno SET fechaR_tu='$fechaturno', TipoCirugia='$tipocir', honorario_Cirugia='$honora' WHERE id_tu='$codigot'");
		echo "Los datos de han guardado correctamente";
		}


	//funcion para guardar las areas de texto en solicitud de examenes
	public function SolicitudExam2($OtrosOrina,$EstLiquidos,$Muestrade,$Diasno,$OtrosElectrolitos,$cod)
	{
		$aux = new Examen;
		$aux->Ejecutar("INSERT INTO tbl_examen (otrosori_exa,estliq_exa,muestra_exa,diasno_exa,otroselec_exa,id_tu) VALUES ('$OtrosOrina','$EstLiquidos','$Muestrade','$Diasno','$OtrosElectrolitos','$cod')");
		echo $aux;
	}

}


?>