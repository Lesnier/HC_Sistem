<?php
include "coneccion.php";

include "Usuario.php";
include "Rol.php";
include "Paciente.php";
include "Especialidad.php";
include "Turno.php";
include "Hora.php";
include "Consulta.php";
include "Consultas.php";
include "Farmacos.php";
include "Receta.php";
include "Cie.php";
include "Medimagen.php";
include "Examen.php";
include "ExamenFisico.php";
include "Anamnesis.php";
include "Habitos.php";
include "Sistemas.php";
include "SisEstomatognatico.php";
include "SaludBucal.php";
include "IndicesCPOceo.php";
include "PlanesDiagnostico.php";
include "Prenatales.php";
include "Vacunas.php";
include "SignosVitales.php";
include "Odontograma3.php";
include	"Odontograma.php";
include "Estomatognatico.php";
include "ConsenRep.php";
include "OdontogramaDarwin.php";
include "TratamientoPagos.php";
include "Epicrisis.php";
include "CiEpicrisis.php";
include "File.php";
 include "AnamnesisCdu.php";
include "Expediente.php";
include "Solicitud.php";
include "CitaCirugia.php";
include "Informe.php";
include "CodigoIess.php";
include "ProtocoloOperatorio.php";

include "log.php";
include "funcion.php";



class Logica
{
	//funcion para definir la hora actual del ecuador
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

		function Msm($p,$msm){
			switch ($p) {
				case 'v':
				echo "
				<div class='alert alert-success' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<center><h4>$msm</h4></center>
				</div>
				";

				break;
				case 'a':
				echo "
				<div class='alert alert-info' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<center><h4>$msm</h4></center>
				</div>
				";

				break;
				case 't':
				echo "
				<div class='alert alert-warning' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<center><h4>$msm</h4></center>
				</div>
				";

				break;
				case 'r':
				echo "
				<div class='alert alert-danger' role='alert'>
					<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
					<center><h4>$msm</h4></center>
				</div>
				";

				break;


			}
		}
		
	//inicio del metoodo para cargar las busquedas del paciente
		public function BuscarXPeticionPacinete($buscar,$por,$codRol)
		{
			$buscar=utf8_decode($buscar);
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
										<td>".utf8_encode($fila["nombresCom_pac"])."</td>
										<td>".$this->Edad($fila['fechaN_pac'])."</td>
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
						if($codRol==5)/*si el doctor quiere ver el historial del pacieten*/
						{
							echo "
							<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='HistorialPacienteNew($fila[id_pac]);' value='Ver historia'/></td>
						</tr>
						";
					}
					if($codRol==6)/*boton*/
					{
						echo "
						<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='HistorialPacienteNewEpicrisis($fila[id_pac]);' value='Epicrisis'/></td>
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
	echo "No hay paciente con esta cedula";
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
							<td>".utf8_encode($fila["nombresCom_pac"])."</td>
							<td>".$this->Edad($fila['fechaN_pac'])."</td>
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
							<td>
								<a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='AsignarPaciente($fila[id_pac]);' >Agendar</a>
								<!--<input type='button' id='btnAsignar' class='btn btn-success' onclick='AsignarPaciente($fila[id_pac]);' value='Agendar'/></td>-->
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
				if($codRol==5)/*si el doctor quiere ver el historial del pacieten*/
				{
					echo "
					<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='ShowHistoria($fila[id_pac]);' value='Ver historia'/></td>
				</tr>
				";
			}
			if($codRol==6)/*boton*/
			{
				echo "
				<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='HistorialPacienteNewEpicrisis($fila[id_pac]);' value='Epicrisis'/></td>
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
	echo "No ay paciente con estos apellidos";
}

}		



}
	//fin del metoodo para cargar las busquedas del paciente
	//inicio del metodo para carga los combos de  especialidades 
public function CargarEspecialidadesParaAsignar()
{
	$esp=new Especialidad;
	$datos=$esp->Consultar_Especialidad("SELECT * FROM tbl_especialida WHERE estado_esp='MA'");
	echo " <center>
	<table class='table table-bordered table-striped table-hover table-condensed'>
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
</center>
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
	<center>
		<table class='table table-bordered table-striped table-condensend table-hover'>
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
			</center>
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
			$usuE=NULL;
			if(isset($_SESSION['ENFERMERA'])) $usuE=$_SESSION['ENFERMERA'];
			elseif(isset($_SESSION['DOCTOR'])) $usuE=$_SESSION['DOCTOR'];
		//$fechaR=date("y-m-d"); //fecha antigua
			$fechaR =$this->Mifecha();
			$turno=$tu->Consultar("SELECT MAX(numero_tur) FROM tbl_turno WHERE fechaC_tu='$fechaC' AND id_usu='$doctor';");
			$turno=$turno+1;
			$tu->Ejecutar("INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES('$doctor','$paciente','$hora','$fechaR','$fechaC','$usuE','$turno','AE');");
			$tu->Ejecutar("UPDATE tbl_paciente SET auxmovimiento_pac='TRATAMIENTO' WHERE id_pac='$paciente';");
			$codigo=$tu->Consultar("SELECT MAX(id_tu) FROM tbl_turno");

		//capturando acciones
			$idusu2015=$_SESSION['IDUser'];
			$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES");
			$tu->Ejecutar($sql2015);
		//capturando acciones


		//echo "INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES('$doctor','$paciente','$hora','$fechaR','$fechaC','$usuE','$turno','AE');";
			echo "
			<center>
				<table class='table table-bordered table-condensend table-hover table-striped'>
					<tr>
						<td>Se asignó el turno correctamente</td>
						<td><a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' id='bntImprimir' onclick='ImprimirTurno($codigo)' style='font-family:Times New Roman, Georgia, Serif; color:white;' >Imprimir Turno<a/></td>
						<td><input type='button' id='bntNewturno'  class='btn btn-primary' style='font-family:Times New Roman, Georgia, Serif; color:white;' value='Nuevo Turno'/></td>
					</tr>
				</table>
			</center>
			<script type='text/javascript'>						

				$('#bntNewturno').click(function()
				{
					ShowCreateCita();
				});
			</script>			  
			";
		}
	//fin del metodo para generar el turno por doctor
		public function GenerarTurnoXDoctor($paciente,$fechaC,$hora)
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

		//capturando acciones
			$idusu2015=$_SESSION['IDUser'];
			$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,usuarioR_tu,numero_tur,estado_tur) VALUES");
			$tu->Ejecutar($sql2015);
		//capturando acciones

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
	public function NewPaciente($cedula,$passoporte,$apellidos,$nombres,$otros,$fechaNac,$lugarNac,$lugarRes,$sexo,$raza,$religion,$estadoCivil,$instrucion,$profesion,$opcupacion,$condicionpac,$direccion,$telefonoDomi,$telefonoTraba,$celular,$correo,$referencia,$telefonoRefere,$autori,$fechaiaut,$fechafaut,$conve2,$NUmeroHistoria)
	{
		$pac=new Paciente;
		//if($pac->Consultar("SELECT COUNT(*) FROM tbl_paciente WHERE cedula_pac='$cedula'")==0)
		//{
		$apellidos=strtoupper($apellidos);
		$nombres=strtoupper($nombres);
		$comple=$apellidos." ".$nombres;
		$direccion=strtoupper($direccion);
			//$pac->Ejecutar("INSERT INTO tbl_paciente (cedula_pac,pasaporte_pac,apellidos_pac,nombres_pac,nombresCom_pac,otros_pac,fechaN_pac,lugarnac_pac,lugresid_pac,sexo_pac,raza_pac,religion_pac,estadociv_pac,instruccion_pac,profesion_pac,ocupacion_pac,condicion_pac,direccion_pac,telefono_pac,telefonoTra_pac,celular_pac,correo_pac,nombresReferencia_pac,telefonoReferencia_pac,estado_pac)
//VALUES('$cedula','$passoporte','$apellidos','$nombres','$comple','$otros','$fechaNac','$lugarNac','$lugarRes','$sexo','$raza','$religion','$estadoCivil','$instrucion','$profesion','$opcupacion','$condicionpac','$direccion','$telefonoDomi','$telefonoTraba','$celular','$correo','$referencia','$telefonoRefere','A')");
		$pac->Ejecutar("INSERT INTO tbl_paciente (cedula_pac,pasaporte_pac,nombresCom_pac,otros_pac,fechaN_pac,lugarnac_pac,lugresid_pac,sexo_pac,raza_pac,religion_pac,estadociv_pac,instruccion_pac,profesion_pac,ocupacion_pac,condicion_pac,direccion_pac,telefono_pac,telefonoTra_pac,celular_pac,correo_pac,nombresReferencia_pac,telefonoReferencia_pac,estado_pac,autorizacion_pac,fechaiauto_pac,fechafauto_pac,condi2_pac,auxmovimiento_pac,medico,numeroH)
			VALUES('$cedula','$passoporte','$apellidos','$otros','$fechaNac','$lugarNac','$lugarRes','$sexo','$raza','$religion','$estadoCivil','$instrucion','$profesion','$opcupacion','$condicionpac','$direccion','$telefonoDomi','$telefonoTraba','$celular','$correo','$referencia','$telefonoRefere','A','$autori','$fechaiaut','$fechafaut','$conve2','PRIMERA VEZ','$nombres','$NUmeroHistoria')");			

		//capturando acciones
		session_start();
		$idusu2015=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_paciente (cedula_pac,pasaporte_pac,apellidos_pac,nombres_pac,nombresCom_pac,otros_pac,fechaN_pac,lugarnac_pac,lugresid_pac,sexo_pac,raza_pac,religion_pac,estadociv_pac,instruccion_pac,profesion_pac,ocupacion_pac,condicion_pac,direccion_pac,telefono_pac,telefonoTra_pac,celular_pac,correo_pac,nombresReferencia_pac,telefonoReferencia_pac,estado_pac)
			VALUES");
		$pac->Ejecutar($sql2015);
		//capturando acciones

		echo $this->Msm("v", "Se agregó correctamente el nuevo paciente");
		//}
		//else
		//{
			/*echo "
					<h3>Ya existe un paciente con esta cedula</h3>
					";*/

		//}
				}
	//fin del metodo para agregar un nuevo paciente
	//inicio de la funcio para cargar las consulatas de hoy
				public function ConsultasDeHoyXDoctor()
				{
					$cons=new Consulta;
					session_start();
					$user=$_SESSION['DOCTOR'];

		//$fecha=date("y-m-d");	// fecha antigua
					$fecha=$this->Mifecha();
					$datos=$cons->Consultar_ConsultaHoy($user,$fecha);
					echo "

					<table class='table table-bordered table-hover table-striped table-condensend'>

						<tr>
							<th colspan='7'><div class='alert alert-success'><h4><center>Lista De Citas Para Hoy</center></h4></div></th>
						</tr>
						<tr >
							<td>Turno</td>
							<td>Cédula</td>
							<td>Nombres Paciente</td>
							<!--<td>Estado Pago</td>-->
							<td>Tipo Consulta</td>
							<td>Ingresar</td>
							<!--<td>Modificar Pago</td>-->
						</tr>


						";
						foreach($datos as $fila)
						{
							echo "
							<tr>
								<td>$fila[hora_hor]</td>
								<td>$fila[Cedula_Paciente]</td>
								<td>$fila[Nombres_Paciente]</td>
								<!--<td>$fila[estadoPa_tur]</td>-->";
								if($fila['estadoEmer_tur']=="")
								{
									echo "<td><div class='alert alert-info'>Normal</div></td>";
								}
								if($fila['estadoEmer_tur']=="A")
								{
									echo "<td><div id='PacEmergenci'>Paciente Emergencia</div></td>";
								}


								echo "<td><input type='button' class='btn btn-primary' value='Ingresar' id='bntDiagnosticar' onclick='Diagnosticar($fila[Codigo],$fila[CodigoPaciente])'/></td>
								<!--<td><input type='button' class='btn ' value='Ingresar' id='bntPago' onclick='EstadoPago($fila[Codigo])'/></td>-->
							</tr>
							";
						}
						echo "

						<tr>
							<th colspan='7'><h4><center></center></h4></th>
						</tr>

					</table>

					<script type='text/javascript'>						
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

		//capturando acciones
					session_start();
					$idusu2015=$_SESSION['IDUser'];
					$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_consultas (fechaProx_cons,estado_cons,diagnostico_cons,examenes_cons,tratamiento_cons,id_tu) VALUES\nUPDATE tbl_turno SET estado_tur");
					$tu->Ejecutar($sql2015);
		//capturando acciones

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

		//capturando acciones
					session_start();
					$idusu2015=$_SESSION['IDUser'];
					$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_receta (cantidad,indicaciones,id_far,id_cons) VALUES\nUPDATE tbl_farmacos SET estock_far");
					$rec->Ejecutar($sql2015);
		//capturando acciones


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
				  //echo "<option value='2'>ENFERMERA</option>";
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
				 //echo "<option value='1'>Medicina General</option>";
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


		//capturando acciones
					session_start();
					$idusu2015=$_SESSION['IDUser'];
					$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_usuario (cedula_usu,apellidos_usu,nombres_usu,nombresCom_usu,edad_usu,login_usu,pass_usu,direccion_usu,estado_usu,id_rol,id_esp)");
					$user->Ejecutar($sql2015);
		//capturando acciones

					echo "<h3>Se agregó el usuario</h3>";	

				}
				else
				{
					echo "<h3>Ya existe un usuario con este número de cédula</h3>";			
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
					$user->Ejecutar("UPDATE tbl_usuario SET estado_usu='E', cedula_usu='' WHERE id_usu='$codigo'");
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
					echo "<h3>Se modificó correctamente el rol $desrol</h3>";
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
		//capturando acciones
					session_start();
					$idusu2015=$_SESSION['IDUser'];
					$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_especialida (descripcion_esp,estado_esp)");
					$esp->Ejecutar($sql2015);
		//capturando acciones

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
					<h3> Esta especialidad a pasado a estado de eliminado</h3>
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
										<td>".utf8_encode($fila["nombresCom_pac"])."</td>
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
					echo "<h3>Se ha modificado el paciente: $completo</h3>";
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

				//capturando acciones
					session_start();
					$idusu2015=$_SESSION['IDUser'];
					$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_farmacos (descripcion_far,foto_far,Fecaduca_far,estock_far,estado_far)");
					$user->Ejecutar($sql2015);
		//capturando acciones


					echo "
					<h3>Se ha guardado correctamente el fármaco</h3>

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
					echo "<h3>Se modificó correctamente el fármaco</h3>";
				}
				public function Deletefarmaco($codigo)
				{
					$far=new Farmacos;
					$far->Ejecutar("UPDATE tbl_farmacos SET estado_far='E' WHERE id_far='$codigo'");
					echo "<h3>Se eliminó correctamente</h3>";
				}

	//incio del combo de horas disponibles
				public function cargarhorarioXDoctor($fecha,$codigo)
				{
					$aux=new Turno;
					$aux1=new Usuario;
					$aux2=new Hora;
					session_start();
					$loguser=$_SESSION['DOCTOR'];
					$iddoctor=$aux->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$loguser' AND id_rol='1' AND estado_usu='A'");
					$dato=$aux->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$fecha' and id_usu='$iddoctor'");
					echo "
					<div class='table-responsive'>
						<table class='table table-bordered table-striped table-condensend'>
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
				echo "</select></td><td><input type='button' id='bntDarTurno' class='btn btn-success' value='Dar Turno' onclick='GenerarTurnoPacienteGeneralXDoctor();'/></td>
				";
			}
			echo "
		</tr>
	</div>
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
	
	public function VerCie()
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

		public function VerCie33($desc)
		{
			$aux=new Cie();

			$datos1=$aux->Consultar_Cie("SELECT * FROM tbl_cie WHERE desc_diag like '%$desc%' limit 100");
			$datos2=$aux->Consultar_Cie("SELECT * FROM tbl_cie WHERE cod_diag like '$desc%' limit 100");
			$datos=NULL;
			$aux1[0]=count($datos1);
			$aux1[1]=count($datos2);
			$aux3[0]="SELECT * FROM tbl_cie WHERE desc_diag like '%$desc%' limit 100";
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
									<td>".utf8_decode($fila['desc_diag'])."</td>
									<td>".utf8_decode($fila['cod_diag'])."</td>
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

			public function CargarDiagnostico($codigo)
			{
				$aux=new Cie();
				$datos=$aux->Consultar("SELECT CONCAT(cod_diag,' ',desc_diag) desc_diag FROM tbl_cie WHERE id_diag='$codigo'");
				echo $datos;
			}

			public function VerCitasFormOrder()
			{
				$aux=new Hora;
				$aux3=new Consulta;
				session_start();
				$log=$_SESSION['DOCTOR'];
				$iduser=$aux->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$log'");
		//$date=date("Y-m-d");//fecha antigua
				$date=$this->Mifecha();
				$datos=$aux->Consultar_Hora("SELECT * FROM tbl_hora");
				echo "
				<div class='table-responsive'>
					<table class='table table-bordered table-striped table-condesend'>
						<tr>
							<td>Hora</td>
							<td>Cita</td>
							<td>Reservar</td>
						</tr>	
						";
						foreach($datos as $fila)
						{
							$codigo=$aux->Consultar("SELECT id_tu FROM tbl_turno WHERE fechaC_tu='$date' AND id_hor='$fila[id_hor]' AND id_usu='$iduser';");
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
											echo "<div id='PacNormal'>".utf8_encode($fila1["nombresCom_pac"])."</div>";
										}
										if($fila1['estadoEmer_tur']=="A")
										{
											echo "<div id='PacEmergenci'>".utf8_encode($fila1["nombresCom_pac"])."</div>";										
										}
										echo "</td>";
									}
									echo "<td><input type='button' class='btn btn-danger' value='Agendar Cita Emergencia' onclick='ReservarEmergencia($fila[id_hor])'/></td>";
								}

							}
							else
							{
								echo "<td><textarea cols='40' rows='2' id='txtCita'></textarea></td>
								<td><input type='button' value='Agendar Cita' class='btn btn-success' onclick='ReservarHoy($fila[id_hor])'/></td>";
							}
							echo "</tr>";
						}
						echo "</table></div";		
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
									<td>".utf8_encode($fila["nombresCom_pac"])."</td>
									<td>$fila[cedula_pac]</td>
									<td>$fila[telefono_pac]</td>
									<td>$edad</td>
									<td>$fila[direccion_pac]</td>
									<td><a href='#myModal' role='button' class='btn btn-danger' data-toggle='modal' onclick='Alerta()'>Ingresar</a></td>
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
							$res=$aux->Ejecutar("INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,numero_tur,estado_tur,EstadoEmer_tur) VALUES('$idUser','$paciente','$hora','$fecha','$fecha','$turn','AE','A')");
		//capturando acciones

							$idusu2015=$_SESSION['IDUser'];
							$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_turno (id_usu,id_pac,id_hor,fechaR_tu,fechaC_tu,numero_tur,estado_tur) ");
							$aux->Ejecutar($sql2015);
		//capturando acciones

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
							echo $res." Se agendo correctamente el paciente de emeregencia";

						}
						public function DataDoctor()
						{
							$aux=new Usuario;
							session_start();
							$user=$_SESSION['DOCTOR'];
							$dataUser=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$user'");
							$id=$aux->Consultar("SELECT id_esp FROM tbl_usuario WHERE login_usu='$user';");
							$esp=$aux->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$id';");
							echo "Bienvenid@: ".$dataUser."  ;Especialidad:  $esp";
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
								<td><h3 style='color:black;'>Se agendó correctamente el paciente</h3></td>
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
							echo "<div class='table-responsive'><table class='table table-bordered table-condensed table-striped table-hover' style='font-family:Times New Roman, Georgia, Serif;'>";
							foreach($datos as $fila)
							{
								$sexo=$fila["sexo_pac"];
								$estado=$fila['estadociv_pac'];
								$condicion=$fila['condicion_pac'];
								$estadopac=$fila['auxmovimiento_pac'];
								$this->fechaNac= ($fila['fechaN_pac'] == '0000-00-00' ? date("Y-m-d"):$fila['fechaN_pac'] );
								$this->fechaiauto_pac = ($fila['fechaiauto_pac'] == '0000-00-00'?  date("Y-m-d"):$fila['fechaiauto_pac'] ); 
								$apellido = $fila['nombresCom_pac'];
								echo "<tr>
								<td>Cédula:</td><td><input type='text' id='txtcedulaUsu1' value='$fila[cedula_pac]'   /></td>
								<td>Pasaporte:</td><td><input  type='text' id='txtPasport' value='$fila[pasaporte_pac]'   /></td>
							</tr>
							<tr>
								<td>Apellidos:</td> <td colspan='3'><input type='text'  class='span10' id='txtapellidoUsu1' value='$apellido'   /></td>
							</tr>
							<tr><td>Medico:</td><td colspan='3'><div class='input-append'><input type='text' class='span12' id='txtnombresUsu1' value='$fila[medico]' /><a href='#myModal' role='button' class='btn' data-toggle='modal'  onclick='AsgnarMedicoPaciente()'> Buscar</a></div></td>
							</tr>
							<tr>

								<td>Otro:</td><td><textarea id='txtOtro' cols='40' rows='2'   >$fila[otros_pac]</textarea></td>
								<td>Fecha de nacimiento:</td><td><input type='text' id='txtEdadUsu1' value='$this->fechaNac'   /></td>
							</tr>
							<tr>
								<td>Estado Paciente: </td>
								<td colspan='3'>
									<select id='cmbestPac'>
										<option value=''>--Seleccione--</option>
										<option value='PRIMERA VEZ'>PRIMERA VEZ</option> 
										<option value='TRATAMIENTO'>TRATAMIENTO</option> 
										<option value='ALTA'>ALTA</option> 
									</select>
								</td>
							</tr>
							<tr>
								<td>Lugar de nacimiento:</td><td><input type='text' id='txtLugnacim' value='$fila[lugarnac_pac]'   /></td>
								<td>Lugar de residencia:</td><td><input type='text' id='txtLugres' value='$fila[lugresid_pac]'   /></td>
							</tr>
							<tr>
								<td>Sexo:</td><td><select id='txtSex' ><option value=''>--Seleccione--</option><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select></td>
								<td>Raza:</td><td><input type='text' id='txtRaza' value='$fila[raza_pac]'   /></td>
							</tr>

							<tr>
								<td>Religión:</td><td><input type='text' id='txtReligion' value='$fila[religion_pac]'   /></td>
								<td>Estado civil:</td><td><select id='txtEstadociv'><option value=''>--Seleccione--</option><option value='Solter@'>Solter@</option><option value='Casad@'>Casad@</option><option value='Divorciad@'>Divorciad@</option><option value='Viud@'>Viud@</option></select></td>
							</tr>
							<tr>   

								<td>Instrucción:</td><td><input type='text' id='txtInstr' value='$fila[instruccion_pac]'   /></td>
								<td>Autorizacion:</td><td><input type='text' id='txtautorizacion' value='$fila[autorizacion_pac]' /></td>
							</tr>
							<tr>
								<td>Fecha inicio autorización:</td>
								<td>

									<input type='text'   id='txtfechaauto' onchange='CalcularFechaVencimiento()'  value='$this->fechaiauto_pac'/>
								</td>
								<td>Fecha V.</td><td><input type='text' id='txtfechaautovenc' readonly value='$fila[fechafauto_pac]' /></td>
							</tr>
							<tr>
								<td>Profesión:</td><td><input type='text' id='txtProf' value='$fila[profesion_pac]'   /></td>
								<td>Ocupación:</td><td><input type='text' id='txtOcupe' value='$fila[ocupacion_pac]'   /></td>
							</tr>
							<tr><td>Condición del paciente:</td><td><input type='text' id='txtCondicio' value='$fila[condi2_pac]'  /></td><td colspan='2'><select id='txtCondpac'><option value=''>--Seleccione--</option><option value='Convenio'>Convenio</option><option value='Empresa'>Empresa</option><option value='Particular'>Particular</option></select></td>
							</tr>
							<tr>
								<td>Dirección:</td><td><input type='text' id='txtdireccionUsu1'  value='$fila[direccion_pac]'  /></td>
								<td>Teléfono Domicilio:</td><td><input type='text' id='txtTelef' value='$fila[telefono_pac]'  ></td>
							</tr>
							<tr>
								<td>Teléfono Trabajo:</td><td><input type='text' id='txtTelefTraba' value='$fila[telefonoTra_pac]'  ></td>
								<td>Celular:</td><td><input type='text' id='txtCelular' value='$fila[celular_pac]'  ></td>
							</tr>
							<tr>
								<td>Correo:</td><td><input type='text' id='txtCorreo' value='$fila[correo_pac]'  ></td>
								<td>Referencia: </td><td><input type='text' id='txtNombresRefe' value='$fila[nombresReferencia_pac]'  ></td>
							</tr>
							<tr>
								<td>Teléfono de Referencia:</td>
								<td colspan='3'><input type='text' id='txtTelefonoRefe' value='$fila[telefonoReferencia_pac]'  ></td>
							</tr>
							<tr>
								<td colspan='4'>
									<center><a href='#' class='btn btn-success' onclick='SaveAndModPac($codigo)' id='bntSaveUsu13' style='font-family:Times New Roman, Georgia, Serif; font-size:15px;color:white;'>Guardar<a/> <a class='btn btn-primary' onclick='CancelarModifyPac()'> Cancelar</a></center>
								</td>
							</tr>";



							echo "</table></div>
							<script type='text/javascript'>						
								$('#txtfechaauto').datepicker({
									changeMonth: true,
									changeYear: true,
									dateFormat: 'yy-mm-dd'
								});
								$('#txtEdadUsu1').datepicker({
									hangeMonth: true,
									changeYear: true,
									dateFormat: 'yy-mm-dd'
								});


								$('#txtSex').val('$sexo');
								$('#txtEstadociv').val('$estado');
								$('#txtCondpac').val('$condicion');
								$('#cmbestPac').val('$estadopac');

							</script>						
							";
						}

					}
					else
					{
						echo $this->Msm("r", "Este paciente no tiene datos");
					}
				}
				public function UpdateFiliacion($cedula,$passoporte,$apellidos,$nombres,$otros,$fechaNac,$lugarNac,$lugarRes,$sexo,$raza,$religion,$estadoCivil,$instrucion,$profesion,$opcupacion,$condicionpac,$direccion,$telefonoDomi,$telefonoTraba,$celular,$correo,$referencia,$telefonoRefere,$codigo,$autori,$fechaiaut,$fechafaut,$condi2,$estadoPac)
				{
					$aux=new Paciente;
					$apellidos=strtoupper($apellidos);
					$nombres=strtoupper($nombres);
					$com=$apellidos." ".$nombres;
		//if($fechaiaut!=""){
		//	$res=$aux->Ejecutar("UPDATE tbl_paciente SET pasaporte_pac='$passoporte', apellidos_pac='$apellidos', nombres_pac='$nombres', nombresCom_pac='$com', direccion_pac='$direccion',nombresReferencia_pac='$referencia', telefonoReferencia_pac='$telefonoRefere',religion_pac='$religion',instruccion_pac='$instrucion', profesion_pac='$profesion',ocupacion_pac='$opcupacion',telefono_pac='$telefonoDomi',telefonoTra_pac='$telefonoTraba',celular_pac='$celular',estadociv_pac='$estadoCivil', condicion_pac='$condicionpac',correo_pac='$correo', otros_pac='$otros',sexo_pac='$sexo', fechaN_pac='$fechaNac', autorizacion_pac='$autori', fechaiauto_pac='$fechaiaut', fechafauto_pac='$fechafaut', condi2_pac='$condi2'  WHERE id_pac='$codigo'");

					$res=$aux->Ejecutar("UPDATE tbl_paciente SET pasaporte_pac='$passoporte', nombresCom_pac='$apellidos', direccion_pac='$direccion',nombresReferencia_pac='$referencia', telefonoReferencia_pac='$telefonoRefere',religion_pac='$religion',instruccion_pac='$instrucion', profesion_pac='$profesion',ocupacion_pac='$opcupacion',telefono_pac='$telefonoDomi',telefonoTra_pac='$telefonoTraba',celular_pac='$celular',estadociv_pac='$estadoCivil', condicion_pac='$condicionpac',correo_pac='$correo', otros_pac='$otros',sexo_pac='$sexo', fechaN_pac='$fechaNac', autorizacion_pac='$autori', fechaiauto_pac='$fechaiaut', fechafauto_pac='$fechafaut', condi2_pac='$condi2', auxmovimiento_pac='$estadoPac', medico='$nombres'  WHERE id_pac='$codigo'");

	//	}else{ 
					/*	$res=$aux->Ejecutar("UPDATE tbl_paciente SET pasaporte_pac='$passoporte', apellidos_pac='$apellidos', nombres_pac='$nombres', nombresCom_pac='$com', direccion_pac='$direccion',nombresReferencia_pac='$referencia', telefonoReferencia_pac='$telefonoRefere',religion_pac='$religion',instruccion_pac='$instrucion', profesion_pac='$profesion',ocupacion_pac='$opcupacion',telefono_pac='$telefonoDomi',telefonoTra_pac='$telefonoTraba',celular_pac='$celular',estadociv_pac='$estadoCivil', condicion_pac='$condicionpac',correo_pac='$correo', otros_pac='$otros',sexo_pac='$sexo', fechaN_pac='$fechaNac', lugarnac_pac='$lugarNac', lugresid_pac='$lugarRes', raza_pac='$raza' WHERE id_pac='$codigo'");*/
		//}

					echo $this->Msm("v", "Se modificó correctamente el paciente");
				}
				public function ActualizarPago ($codigo, $pago)
				{
					$aux= new Turno;
					$aux->Ejecutar("UPDATE tbl_turno SET estadoPa_tur='$pago' WHERE id_tu='$codigo'");
					echo $this->Msm("v", "Pago modificado");
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
					echo $this->Msm("r", "Cita Cancelada");
				}
		//fin  de la funcio para cancelar la cita

	//funcio para cargar el nombre del paciente 
				public function NombreCompletoPaciente($codigo)
				{
					$aux=new Paciente;
					$nomComple=$aux->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$nomComple=utf8_encode($nomComple);
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

	//funcion para guardar las areas de texto en solicitud de examenes
				public function SolicitudExam2($OtrosOrina,$EstLiquidos,$Muestrade,$Diasno,$OtrosElectrolitos,$cod)
				{
					$aux = new Examen;
					$aux->Ejecutar("INSERT INTO tbl_examen (otrosori_exa,estliq_exa,muestra_exa,diasno_exa,otroselec_exa,id_tu) VALUES ('$OtrosOrina','$EstLiquidos','$Muestrade','$Diasno','$OtrosElectrolitos','$cod')");
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
							<td><a  data-dismiss='modal' class='btn btn-success' id='bntVademecun' onclick='CodigoVademecum($fila[id_far])' aria-hidden='true'> Asignar</a> </td>

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
		//$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',id_far) FROM tbl_farmacos WHERE id_far='$codigo'");
		$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',' ') FROM tbl_farmacos WHERE id_far='$codigo'");
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
						<th>Diagnóstico</th>
						<th>Vademecun</th>
						<th>Nombre Comercial</th>
						<th>Cantidad</th>
						<th>Dosis</th>
						<th>Via Administración</th>
						<th>Frecuencia </th>
						<th>#</th>
						<th>Duración</th>
						<th>Tratamiento</th>					
					</tr>
				</thead>
				<tbody>
					";
					foreach($datos as $fila)
					{
						$diag=$aux->Consultar("SELECT desc_diag FROM tbl_cie WHERE id_diag='$fila[id_cie]'");
						$ciefghj=$aux->Consultar("SELECT cod_diag FROM tbl_cie WHERE id_diag='$fila[id_cie]'");
						echo "
						<tr>
							<td>$fila[fechaProx_cons]</td>
							<td>$ciefghj  $diag</td>
							<td>$fila[vademecun_cons]</td>
							<td>$fila[nomcomercial_cons]</td>
							<td>$fila[cantidad_cons]</td>
							<td>$fila[dosis_cons]</td>
							<td>$fila[viaAdmin_cons]</td>
							<td>$fila[frecuencia_cons]</td>
							<td>$fila[numduracion_cons]</td>
							<td>$fila[duracion_cons]</td>
							<td>$fila[tratamiento_cons]</td>
						</tr>
						";
					}
					echo "
					<!--<tr><td colspan='8'><center><input type='button' class='btn btn-success' onclick='FinPaciente($turno)' value='Finalizar Consulta' /> </center></td></tr>-->
					<tr><td colspan='8'><center><input type='button' class='btn btn-success' onclick='PrintREceta($turno)' value='Imprimir Receta' /> </center></td></tr>
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
								<th>Diagnóstico</th>
								<th>Vademecun</th>
								<th>Nombre Comercial</th>
								<th>Cantidad</th>
								<th>Dosis</th>
								<th>Via Administración</th>
								<th>Frecuencia </th>
								<th>#</th>
								<th>Duración</th>
								<th>Tratamiento</th>					
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
									<td>$fila[tratamiento_cons]</td>
								</tr>

								<script type='text/javascript'>

									$('#AreCie10').html('<input type=hidden  id=txtCodCie10   value=$fila[id_cie]  />');

								</script>
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
						$nompac=$aux->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codigo'");
						$nompac=utf8_encode($nompac);

						$apepac=$aux->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$codigo'");
						$apepac=utf8_encode($apepac);

						$sexpac=$aux->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codigo'");
						$cedpac=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo'");
						if($aux->Consultar("SELECT COUNT(*) FROM tbl_anamnesis WHERE id_paciente='$codigo'")==0)
						{
							echo "
							<!-- Cabecera --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td rowspan='2'><center>Establecimiento</center></td> <td rowspan='2'><center>Nombre</center></td> <td rowspan='2'><center>Apellido</center></td> <td colspan='2' rowspan='2'><center>Sexo</center></td> <td rowspan='2'><center>Número de <br />hoja</center></td> <td rowspan='2'><center>Historia <br />clínica</center></td> </tr> <tr> </tr> <tr> <td><input type='text' id='txtEstablecim' style='width:140px; text-align:center;' value='Clínica de Urología' readonly /></td> <td><input type='text' id='txtNompac' style='width:140px; text-align:center;' value='$nompac' readonly /></td> <td><input type='text' id='txtApepac' style='width:140px; text-align:center;' value='$apepac' readonly /></td> <td colspan='2'><input type='text' id='SexAnam' style='width:80px; text-align:center;' value='$sexpac' readonly /></td> <td><input type='text' id='txtNumHoja' style='width:100px; text-align:center;' readonly/></td> <td><input type='text' id='txtHisCl' style='width:100px; text-align:center;' value='$cedpac' readonly /></td> </tr> </table> <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>1. Motivo de consulta</td> </tr> <tr> <td><textarea id='txtConsulta' cols='40' rows='2' style='width:760px;'></textarea></td> </tr> </table> <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Antecedentes personales</td> </tr> <tr> <td><textarea id='txtAtePato' cols='40' rows='2' style='width:760px;' ></textarea></td> </tr> </table> <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Antecedentes familiares</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtalergia' style='width:760px;' ></textarea> </td> </tr> </table> <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Enfermedad o problema actual</td> </tr> <tr> <td><textarea id='txtEnfeAc' cols='40' rows='2' style='width:760px;'></textarea></td> </tr> </table> <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Revisión actual de órganos y sistemas</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtMetabolicos' style='width:760px;' ></textarea> </td> </tr> </table> <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Signos vitales</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td><center>Fecha: </center></td> <td><input type='text' id='txtFechAnam'/></td> </tr> <tr> <td><center>Presión arterial: </center></td> <td><input type='text' id='txtPreArAnam'/></td> </tr> <tr> <td><center>Pulso x min: </center></td> <td><input type='text' id='txtPulAnam'/></td> </tr> <tr> <td><center>Temperatura °c: </center></td> <td><input type='text' id='txtTemcAnam'/></td> </tr> </table> </td> </tr> </table> <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Examen físico</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtCardiovalsculares' style='width:760px;' ></textarea> </td> </tr> <tr><td><center><input type='button' class='btn btn-primary' id='bntAnamnesis' value='Guardar Anamnesis' onclick='SaveTotalAnanmesis()' /></center></td></tr> </table> <!-- 
							<table class='anamnesis'><tr><td>Motivo de Consulta</td><td><textarea id='txtConsulta' cols='40' rows='2' style='width:760px;'></textarea></td></tr><tr><td>Enfermedad Actual</td><td><textarea id='txtEnfeAc' cols='40' rows='2'></textarea></td></tr><td>Revisión Actual de Sistemas: </td><td><select id='txtSistema' onchange='modal2()'><option>--Seleccione--</option><option value='1'>Hábitos</option><option value='2'>Sistemas</option></select></td></tr><tr><tr><td>Tipo de Sangre:</td><td><select id='txtSangre'><option>Seleccione un tipo ..</option><option>A Rh Positivo</option><option>A Rh Negativo</option><option>B Rh Positivo</option><option>B Rh Negativo</option><option>AB Rh Positivo</option><option>AB Rh Negativo</option><option>O Rh Positivo</option><option>O Rh Negativo</option></select></td></tr><td>Antecedentes No Patológicos Personales</td><td><textarea id='txtAtePato' cols='40' rows='2'></textarea></td></tr><tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Personales</td></tr><tr><td>Alergias</td><td><textarea cols='40' rows='2' id='txtalergia'></textarea></td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalsculares'></textarea></td></tr><tr><td>Metabólicos</td><td><textarea cols='40' rows='2' id='txtMetabolicos'></textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciosos'></textarea></td></tr><tr><td>Neoplásicos</td><td><textarea cols='40' rows='2' id='txtneoplasias'></textarea></td></tr><tr><td>Endocrinológicos</td><td><textarea cols='40' rows='2' id='txtendoCrono'></textarea></td></tr><tr><td>Pulmonares</td><td><textarea cols='40' rows='2' id='txtpulmunares'></textarea></td></tr><tr><td>Nefrológicos</td><td><textarea cols='40' rows='2' id='txtNefrologicas'></textarea></td></tr><tr><td>Hematológicos</td><td><textarea cols='40' rows='2' id='txthematologicas'></textarea></td></tr><tr><td>Músculo Esquelético</td><td><textarea cols='40' rows='2' id='txtesqueleticos'></textarea></td><tr><td>Inmunológicos</td><td><textarea cols='40' rows='2' id='txtInmunologicas'></textarea></td></tr></tr><tr><td>Ginecoobstétricos</td><td><textarea cols='40' rows='2' id='txtginecoobste'></textarea></td></tr> <tr><td>Gastroenterológicos</td><td><textarea cols='40' rows='2' id='txtGastroe'></textarea></td></tr> <tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros'></textarea></td></tr></table></td></tr> <tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Familiares</td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalscularesFa'></textarea></td></tr><tr><td>Metabólicos</td><td><textarea cols='40' rows='2' id='txtMetabolicosFa'></textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciososFa'></textarea></td></tr><tr><td>Neoplásicos</td><td><textarea cols='40' rows='2' id='txtneoplasiasFa'></textarea></td></tr><tr><td>Endocrinológicos</td><td><textarea cols='40' rows='2' id='txtendoCronoFa'></textarea></td></tr><tr><td>Pulmonares</td><td><textarea cols='40' rows='2' id='txtpulmunaresFa'></textarea></td></tr><tr><td>Nefrológicos</td><td><textarea cols='40' rows='2' id='txtNefrologicasFa'></textarea></td></tr><tr><td>Hematológicos</td><td><textarea cols='40' rows='2' id='txthematologicasFa'></textarea></td></tr><tr><td>Músculo Esquelético</td><td><textarea cols='40' rows='2' id='txtesqueleticosFa'></textarea></td><tr><td>Inmunológicos</td><td><textarea cols='40' rows='2' id='txtInmunologicasFa'></textarea></td></tr></tr><tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros3'></textarea></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type='button' class='btn btn-primary' id='bntAnamnesis' value='Guardar Anamnesis' onclick='SaveTotalAnanmesis()' /></td></tr></td></tr>
						</table> -->					
						";
					}
					else
					{
						$nompac=$aux->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codigo'");
						$nompac=utf8_encode($nompac);
						$apepac=$aux->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$codigo'");
						$apepac=utf8_encode($apepac);
						$sexpac=$aux->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codigo'");
						$cedpac=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo'");

						$cod=$aux->Consultar("SELECT MAX(id_anam) FROM tbl_anamnesis WHERE id_paciente='$codigo'");
						$datos=$aux->Consultar_Anamnesis("SELECT * FROM tbl_anamnesis WHERE id_anam='$cod';");
						foreach($datos as $fila)
						{
							echo "
							<!-- Cabecera --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td rowspan='2'><center>Establecimiento</center></td> <td rowspan='2'><center>Nombre</center></td> <td rowspan='2'><center>Apellido</center></td> <td colspan='2' rowspan='2'><center>Sexo</center></td> <td rowspan='2'><center>Número de <br />hoja</center></td> <td rowspan='2'><center>Historia <br />clínica</center></td> </tr> <tr> </tr> <tr> <td><input type='text' id='txtEstablecim' style='width:140px; text-align:center;' value='Clínica de Urología' readonly /></td> <td><input type='text' id='txtNompac' style='width:140px; text-align:center;' value='$nompac' readonly /></td> <td><input type='text' id='txtApepac' style='width:140px; text-align:center;' value='$apepac' readonly /></td> <td colspan='2'><input type='text' id='SexAnam' style='width:80px; text-align:center;' value='$sexpac' readonly /></td> <td><input type='text' id='txtNumHoja' style='width:100px; text-align:center;' readonly/></td> <td><input type='text' id='txtHisCl' style='width:100px; text-align:center;' value='$cedpac' readonly /></td> </tr> </table> <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>1. Motivo de consulta</td> </tr> <tr> <td><textarea id='txtConsulta' cols='40' rows='2' style='width:760px;'></textarea></td> </tr> </table> <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Antecedentes personales</td> </tr> <tr> <td><textarea id='txtAtePato' cols='40' rows='2' style='width:760px;' >$fila[nopatologicos_anam]</textarea></td> </tr> </table> <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Antecedentes familiares</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtalergia' style='width:760px;' >$fila[alergias_anam]</textarea> </td> </tr> </table> <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Enfermedad o problema actual</td> </tr> <tr> <td><textarea id='txtEnfeAc' cols='40' rows='2' style='width:760px;'></textarea></td> </tr> </table> <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Revisión actual de órganos y sistemas</td> </tr> <tr> <td<textarea cols='40' rows='2' id='txtMetabolicos' style='width:760px;'>$fila[metabolicos_anam]</textarea></td> </tr> </table> <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Signos vitales</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td><center>Fecha: </center></td> <td><input type='text' id='txtFechAnam'/></td> </tr> <tr> <td><center>Presión arterial: </center></td> <td><input type='text' id='txtPreArAnam'/></td> </tr> <tr> <td><center>Pulso x min: </center></td> <td><input type='text' id='txtPulAnam'/></td> </tr> <tr> <td><center>Temperatura °c: </center></td> <td><input type='text' id='txtTemcAnam'/></td> </tr> </table> </td> </tr> </table> <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Examen físico</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtCardiovalsculares' style='width:760px;' >$fila[cardiovaculares_anam]</textarea> </td> </tr> <tr><td><center><input type='button' class='btn btn-primary' id='bntAnamnesis' value='Guardar Anamnesis' onclick='SaveTotalAnanmesis()' /></center></td></tr> </table> <!-- 
							<table class='anamnesis'><tr><td>Motivo de Consulta</td><td><textarea id='txtConsulta' cols='40' rows='2' ></textarea></td></tr><tr><td>Enfermedad Actual</td><td><textarea id='txtEnfeAc' cols='40' rows='2'></textarea></td></tr><tr><td>Revisión Actual de Sistemas: </td><td><select id='txtSistema' onchange='modal2()'><option>--Seleccione--</option><option value='1'>Hábitos</option><option value='2'>Sistemas</option></select></td></tr><tr><tr><td>Tipo de sangre:</td><td><input type='text' id='txtSangre' readonly value='$fila[tiposangre_anam]'/></td></tr><td>Antecedentes No Patológicos Personales</td><td><textarea id='txtAtePato' cols='40' rows='2'>$fila[nopatologicos_anam]</textarea></td></tr><tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Personales</td></tr><tr><td>Alergias</td><td><textarea cols='40' rows='2' id='txtalergia'>$fila[alergias_anam]</textarea></td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalsculares'>$fila[cardiovaculares_anam]</textarea></td></tr><tr><td>Metabólicos</td><td><textarea cols='40' rows='2' id='txtMetabólicos'>$fila[metabofam_anam]</textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciosos'>$fila[infescciosos_anam]</textarea></td></tr><tr><td>Neoplásicos</td><td><textarea cols='40' rows='2' id='txtneoplasias'>$fila[neoplastias_anam]</textarea></td></tr><tr><td>Endocronológicos</td><td><textarea cols='40' rows='2' id='txtendoCrono'>$fila[endocrono_anam]</textarea></td></tr><tr><td>Pulmonares</td><td><textarea cols='40' rows='2' id='txtpulmunares'>$fila[pulmonares_anam]</textarea></td></tr><tr><td>Nefrológicos</td><td><textarea cols='40' rows='2' id='txtNefrologicas'>$fila[nefro_anam]</textarea></td></tr><tr><td>Hematológicos</td><td><textarea cols='40' rows='2' id='txthematologicas'>$fila[hemato_anam]</textarea></td></tr><tr><td>Músculo Esquelético</td><td><textarea cols='40' rows='2' id='txtesqueleticos'>$fila[esquele_anam]</textarea></td><tr><td>Inmunológicos</td><td><textarea cols='40' rows='2' id='txtInmunologicas'>$fila[inmuno_anam]</textarea></td></tr></tr><tr><td>Ginecoobstétricos</td><td><textarea cols='40' rows='2' id='txtginecoobste'>$fila[ginecoobste_anam]</textarea></td></tr><tr><td>Gastroenterológicos</td><td><textarea cols='40' rows='2' id='txtGastroe'>$fila[gastroe_anam]</textarea></td></tr><tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros'>$fila[otros_anam]</textarea></td></tr></table></td></tr>    <tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Familiares</td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalscularesFa'>$fila[cardiovasfam_anam]</textarea></td></tr><tr><td>Metabólicos</td><td><textarea cols='40' rows='2' id='txtMetabolicosFa'>$fila[metabofam_anam]</textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciososFa'>$fila[infeccfam_anam]</textarea></td></tr><tr><td>Neoplásicos</td><td><textarea cols='40' rows='2' id='txtneoplasiasFa'>$fila[neoplasfam_anam]</textarea></td></tr><tr><td>Endocrinológicos</td><td><textarea cols='40' rows='2' id='txtendoCronoFa'>$fila[endocronofam_anam]</textarea></td></tr><tr><td>Pulmonares</td><td><textarea cols='40' rows='2' id='txtpulmunaresFa'>$fila[pulmofam_anam]</textarea></td></tr><tr><td>Nefrológicos</td><td><textarea cols='40' rows='2' id='txtNefrologicasFa'>$fila[nefrolofam_anam]</textarea></td></tr><tr><td>Hematológicos</td><td><textarea cols='40' rows='2' id='txthematologicasFa'>$fila[hematofam_anam]</textarea></td></tr><tr><td>Músculo Esquelético</td><td><textarea cols='40' rows='2' id='txtesqueleticosFa'>$fila[esquelefam_anam]</textarea></td><tr><td>Inmunológicas</td><td><textarea cols='40' rows='2' id='txtInmunologicasFa'>$fila[inmunofam_anam]</textarea></td></tr></tr><tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros3'>$fila[otrosfam_anam]</textarea></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type='button' class='btn btn-primary' id='bntAnamnesis' value='Guardar Anamnesis' onclick='SaveTotalAnanmesis()' /></td></tr></td></tr>
						</table> -->					
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
					echo "<table><tr><td><input type='text' id='txtMotivoCo' value='$descripcion' readonly/>&nbsp;<a href='#' class='btn' id='EditarMotivoCo' onclick='EditarMotivo()'><i class='icon-pencil'></i></a>&nbsp;<input type='button' value='Modificar' class='btn btn-success' id='bntModMotivoCo' onclick='ModificarMotivoConsulta($cod)'/></td></tr></table> 
					<script type='text/javascript'>$('#bntModMotivoCo').hide();</script>";
				}
				public function LoadEneferemedadNow()
				{
					$aux=new Anamnesis;
					$cod=$aux->Consultar("SELECT MAX(id_anam) FROM tbl_anamnesis");
					$descripcion=$aux->Consultar("SELECT enfermedac_anam FROM tbl_anamnesis WHERE id_anam='$cod';");
					echo "<table><tr><td><input type='text' id='txtEnfermedadAc' value='$descripcion' readonly/>&nbsp;<a href='#' class='btn' id='EditarEnfeAc' onclick='EditarEnfermedadActual()'><i class='icon-pencil'></i></a>&nbsp;<input type='button' value='Modificar' class='btn btn-success' id='bntEnfeActual' onclick='ModificarEnfermedadAc($cod)'/></td></tr></table>
					<script type='text/javascript'>$('#bntEnfeActual').hide();</script>";
				}
				public function UpdateMotivoConsulta($cod,$motivo)
				{
					$aux=new Anamnesis; 
					$motc=$aux->Ejecutar("UPDATE tbl_anamnesis SET motivocon_anam='$motivo' WHERE id_anam='$cod'");
				}
				public function UpdateEnfermedadActual($cod,$enfermedad)
				{
					$aux=new Anamnesis; 
					$enfac=$aux->Ejecutar("UPDATE tbl_anamnesis SET enfermedac_anam='$enfermedad' WHERE id_anam='$cod'");
				}
				public function LoadExamendNow($codigo)
				{
					$aux=new ExamenFisico;
					$datos=$aux->Consultar_ExamenFisico("SELECT * FROM tbl_examen_fisico WHERE id_tu='$codigo';");
					foreach($datos as $fila)
					{
						if($fila['biotipo_constitucional']!="")
						{
							echo "BIOTIPO CONSTITUCIONAL: $fila[biotipo_constitucional]<p>";
						}
						if($fila['actitud']!="")
						{
							echo "ACTITUD: $fila[actitud]<p>";
						}
						if($fila['estado_conciencia']!="")
						{
							echo "ESTADO CONCIENCIA: $fila[estado_conciencia]<p>";
						}
						if($fila['glasgow']!="")
						{
							echo "GLASGOW: $fila[glasgow]<p>";
						}
						if($fila['temperatura']!="")
						{
							echo "TEMPERATURA: $fila[temperatura] grado centigrado<p>";
						}
						if($fila['presion_arterial']!="")
						{
							echo "PRESION ARTERIAL: $fila[presion_arterial] mmHg<p>";
						}
						if($fila['frecuencia_cardiaca']!="")
						{
							echo "FRECUENCIA CARDIACA: $fila[frecuencia_cardiaca] latido/minuto<p>";
						}
						if($fila['frecuencia_respiratoria']!="")
						{
							echo "FRECUENCIA RESPIRATORIA: $fila[frecuencia_respiratoria] r/minuto<p>";
						}
						if($fila['peso']!="")
						{
							echo "PESO: $fila[peso] kg<p>";
						}
						if($fila['talla']!="")
						{
							echo "TALLA: $fila[talla] m<p>";
						}
						if($fila['indice_masa_corporal']!="")
						{
							echo "INDICE MASA CORPORAL: $fila[indice_masa_corporal] peso Kg / talla2 mts<p>";
						}
						if($fila['perimetro_cefalico']!="")
						{
							echo "PERIMETRO CEFALICO: $fila[perimetro_cefalico] cm<p>";
						}
						if($fila['perimetro_toracico']!="")
						{
							echo "PERIMETRO TORACICO: $fila[perimetro_toracico] cm<p>";
						}
						if($fila['perimetro_abdominal']!="")
						{
							echo "PERIMETRO ABDOMINAL: $fila[perimetro_abdominal] cm<p>";
						}
						if($fila['peso_ideal']!="")
						{
							echo "PESO IDEAL: $fila[peso_ideal] kg<p>";
						}
						if($fila['tension_arterial_acostado']!="")
						{
							echo "TENSIÓN ARTERIAL ACOSTADO: $fila[tension_arterial_acostado] mmHg<p>";
						}
						if($fila['tension_arterial_sentado']!="")
						{
							echo "TENSION ARTERIAL SENTADO: $fila[tension_arterial_sentado] mmHg<p>";
						}
						if($fila['tension_arterial_de_pie']!="")
						{
							echo "TENSION ARTERIAL DE PIE: $fila[tension_arterial_de_pie] mmHg<p>";
						}
						if($fila['superficie_corporal']!="")
						{
							echo "SUPERFICIE CORPORAL: $fila[superficie_corporal] m2<p>";
						}
						if($fila['piel']!="")
						{
							echo "PIEL: $fila[piel]<p>";
						}
						if(strlen($fila['cabeza_cuello_conopcion'])>1)
						{
							echo "CABEZA Y CUELLO: $fila[cabeza_cuello_conopcion]<p>";
						}
						if(strlen($fila['cuello_conopcion'])>1)
						{
							echo "CUELLO: $fila[cuello_conopcion]<p>";
						}
						if(strlen($fila['torax_conopcion'])>1)
						{
							echo "TORAX: $fila[torax_conopcion]<p>";
						}
						if(strlen($fila['abdomen_conopcion'])>1)
						{
							echo "ABDOMEN: $fila[abdomen_conopcion]<p>";
						}
						if($fila['aparato_urinario']!="")
						{
							echo "APARATO URINARIO: $fila[aparato_urinario]<p>";
						}
						if($fila['aparato_digestivo']!="")
						{
							echo "APARATO DIGESTIVO: $fila[aparato_digestivo]<p>";
						}
						if($fila['aparato_genital_masculino']!="")
						{
							echo "APARATO GENITAL MASCULINO: $fila[aparato_genital_masculino]<p>";
						}
						if($fila['aparato_genital_femenino']!="")
						{
							echo "APARATO GENITAL FEMENINO: $fila[aparato_genital_femenino]<p>";
						}
						if($fila['sistema_musculo_esqueletico']!="")
						{
							echo "SISTEMA MUSCULO ESQUELETICO: $fila[sistema_musculo_esqueletico]<p>";
						}
						if($fila['sistema_nervioso']!="")
						{
							echo "SISTEMA NERVIOSO: $fila[sistema_nervioso]<p>";
						}
						if($fila['CCFascies']!="")
						{
							echo "CABEZA Y CUELLO - Fascies:  $fila[CCFascies]<p>";
						}
						if($fila['CCOjos']!="")
						{
							echo "CABEZA Y CUELLO - Ojos:  $fila[CCOjos]<p>";
						}
						if($fila['CCNariz']!="")
						{
							echo "CABEZA Y CUELLO - Naríz:  $fila[CCNariz]<p>";
						}
						if($fila['CCBoca']!="")
						{
							echo "CABEZA Y CUELLO - Boca:  $fila[CCBoca]<p>";
						}
						if($fila['CCOidos']!="")
						{
							echo "CABEZA Y CUELLO - Oidos:  $fila[CCOidos]<p>";
						}
						if($fila['CCFaringe']!="")
						{
							echo "CABEZA Y CUELLO - Faringe:  $fila[CCFaringe]<p>";
						}
						if($fila['CForma']!="")
						{
							echo "CUELLO - Forma:  $fila[CForma]<p>";
						}
						if($fila['CMovimientos']!="")
						{
							echo "CUELLO - Movimientos:  $fila[CMovimientos]<p>";
						}
						if($fila['CPiel']!="")
						{
							echo "CUELLO - Piel:  $fila[CPiel]<p>";
						}
						if($fila['CPartesBlandas']!="")
						{
							echo "CUELLO - Partes Blandas:  $fila[CPartesBlandas]<p>";
						}
						if($fila['CTiroides']!="")
						{
							echo "CUELLO - Tiroides:  $fila[CTiroides]<p>";
						}
						if($fila['CGanglios']!="")
						{
							echo "CUELLO - Ganglios:  $fila[CGanglios]<p>";
						}
						if($fila['TRespiratorios']!="")
						{
							echo "TORAX - Mov. Respiratorios:  $fila[TRespiratorios]<p>";
						}
						if($fila['TPiel']!="")
						{
							echo "TORAX - Piel:  $fila[TPiel]<p>";
						}
						if($fila['TBlandas']!="")
						{
							echo "TORAX - Partes Blandas:  $fila[TBlandas]<p>";
						}
						if($fila['TMamas']!="")
						{
							echo "TORAX - Mamas:  $fila[TMamas]<p>";
						}
						if($fila['TCorazon']!="")
						{
							echo "TORAX - Corazón:  $fila[TCorazon]<p>";
						}
						if($fila['TPulmones']!="")
						{
							echo "TORAX - Pulmones:  $fila[TPulmones]<p>";
						}
						if($fila['AbdomenPiel']!="")
						{
							echo "ABDOMEN - Piel:  $fila[AbdomenPiel]<p>";
						}
						if($fila['Abdomenvolumen']!="")
						{
							echo "ABDOMEN - Forma, Volumen y Tamaño:  $fila[Abdomenvolumen]<p>";
						}
						if($fila['volumenPartesBlandas']!="")
						{
							echo "ABDOMEN - Partes Blandas:  $fila[volumenPartesBlandas]<p>";
						}
					}

				}
				public function LoadSolicitudExamenNow($codigo)
				{
					$aux=new Examen;
					$aux1=new Medimagen;
					$datos=$aux->Consultar_Examen("SELECT * FROM tbl_examen WHERE id_tu='$codigo';");
					$datos1=$aux1->Consultar_Medimagen("SELECT  * FROM tbl_medimagen WHERE id_tu='$codigo'");
					$cont=0;
					$descripcion=NULL;
					if(count($datos)>0)
					{
						echo "<div class='thumbnail'><p><h5>Solicutud de Exámenes</h5><p>";
						foreach($datos as $fila)
						{
				//if($cont<=1)
			//	{

					//$descripcion=	$fila['desc_exa']."<p>".$descripcion;
							echo $fila['desc_exa']."<p>";
							if($fila['otrosori_exa']!="")
							{
								echo $fila['otrosori_exa']."<p>";
							}
							if($fila['estliq_exa']!="")
							{
								echo $fila['estliq_exa']."<p>";
							}
							if($fila['muestra_exa']!="")
							{
								echo $fila['muestra_exa']."<p>";
							}
							if($fila['diasno_exa'])
							{
								echo $fila['diasno_exa']."<p>";
							}
							if($fila['otroselec_exa']!="")
							{
								echo $fila['otroselec_exa']."<p>";
							}


				//}
				//$cont++;
						}
			//echo $descripcion;
						echo "</div>";
					}
					if(count($datos1)>0)
					{
						echo "<div class='thumbnail'><p><h5>Solicitud de Imagen</h5><p>";
						foreach($datos1 as $fila1)
						{
				//if($cont<=1)
			//	{

					//$descripcion=	$fila['desc_exa']."<p>".$descripcion;
							echo $fila1['desc_medimagen']."<p>";

				//}
				//$cont++;
						}
			//echo $descripcion;
						echo "</div>";
					}

				}	

				public function LoadAgendaAll(){
					$tur=new Turno;
					$today=$this->Mifecha();
					session_start();
					$user=$_SESSION['DOCTOR'];
					$iddoc=$tur->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$user';");
					$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu>='$today' AND estado_tur='AE' AND id_usu='$iddoc' ORDER BY fechaC_tu ASC");
					if(count($datos)>0){
						echo "<table class='table table-bordered table-striped table-hover table-condensend'>
						<tr>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Paciente</th>
						</tr>
						";
						foreach($datos as $fila){
							$hora=$tur->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$fila[id_hor]';");
							$pac=$tur->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]';");
							$pac=utf8_encode($pac);
							echo "
							<tr>
								<th>$fila[fechaC_tu]</th>
								<th>$hora</th>
								<th>$pac</th>
							</tr>				
							";
						}
						echo "</table>";
					}else{
						echo "";
					}
				}

				public function LoadAgendaAXFecha($fecha){
					$tur=new Turno;
		//$today=$this->Mifecha();
					session_start();
					$user=$_SESSION['DOCTOR'];
					$iddoc=$tur->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$user';");
		//$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu=>'$fecha' AND estado_tur='AE' AND id_usu='$iddoc' ORDER BY fechaC_tu ASC");
					$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$fecha'  AND id_usu='$iddoc' ORDER BY fechaC_tu ASC");

					if(count($datos)>0){
						echo "<table class='table table-bordered table-striped table-hover table-condensend'>
						<tr>
							<th>Fecha</th>
							<th>Hora</th>
							<th>Paciente</th>

						</tr>
						";
						foreach($datos as $fila){
							$hora=$tur->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$fila[id_hor]';");
							$pac=$tur->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]';");
							$pac=utf8_encode($pac);
							echo "
							<tr>
								<th>$fila[fechaC_tu]</th>
								<th>$hora</th>
								<th>$pac</th>";
						//if($fila['estado_tur']=="AE"){
						//	echo "<th>Atendida</th>";
						//}else{
						//	echo "<th>No Atendida</th>";
						//}
								echo "
							</tr>				
							";
						}
						echo "</table>";
					}else{
						echo "<center><h3>No hay citas en la fecha seleccionada</h3></center>";
					}
				}	

				public function EdadPhp($edad){		
					echo $this->Edad($edad);

				}


	//Odontologia mijardin

	//start Save Indicadores de Salud bucal
				public function SaveAllSaludBucal($piezadent16,$piezadent17,$piezadent55,$piezadent11,$piezadent21,$piezadent51,$piezadent26,$piezadent27,$piezadent65,$piezadent36,$piezadent37,$piezadent75,$piezadent31,$piezadent41,$piezadent71,$piezadent46,$piezadent47,$piezadent85,$PlaValor1,$PlaValor2,$PlaValor3,$PlaValor4,$PlaValor5,$PlaValor6,$PlaRess,$CalcValor1,$CalcValor2,$CalcValor3,$CalcValor4,$CalcValor5,$CalcValor6,$CalcRess,$gingiValor1,$gingiValor2,$gingiValor3,$gingiValor4,$gingiValor5,$gingiValor6,$gingiRess,$EnferPerLeve,$EnferPerMode,$EnferPerSeve,$MalOclucionA1,$MalOclucionA2,$MalOclucionA3,$FluoroLeve,$FluoroMode,$FluoroSeve,$idpac)
				{
					$saludb=new SaludBucal;
					$aux=$saludb->Ejecutar("INSERT INTO tbl_indisaludbucal (piezas16_indicasb,piezas17_indicasb,piezas55_indicasb,piezas11_indicasb,piezas21_indicasb,piezas51_indicasb,piezas26_indicasb,piezas27_indicasb,piezas65_indicasb,piezas36_indicasb,piezas37_indicasb,piezas75_indicasb,piezas31_indicasb,piezas41_indicasb,piezas71_indicasb,piezas46_indicasb,piezas47_indicasb,piezas85_indicasb,placaval1_indicasb,placaval2_indicasb,placaval3_indicasb,placaval4_indicasb,placaval5_indicasb,placaval6_indicasb,placares_indicasb,claculoval1_indicasb,claculoval2_indicasb,claculoval3_indicasb,claculoval4_indicasb,claculoval5_indicasb,claculoval6_indicasb,claculores_indicasb,gingivitisval1_indicasb,gingivitisval2_indicasb,gingivitisval3_indicasb,gingivitisval4_indicasb,gingivitisval5_indicasb,gingivitisval6_indicasb,gingivitisres_indicasb,enfperiodonleve_indicasb,enfperiodonmode_indicasb,enfperiodonseve_indicasb,maloclucionangle1_indicasb,maloclucionangle2_indicasb,maloclucionangle3_indicasb,fluorosisleve_indicasb,fluorosismode_indicasb,fluorosisseve_indicasb,estado_indicasb,id_pac) VALUES ('$piezadent16','$piezadent17','$piezadent55','$piezadent11','$piezadent21','$piezadent51','$piezadent26','$piezadent27','$piezadent65','$piezadent36','$piezadent37','$piezadent75','$piezadent31','$piezadent41','$piezadent71','$piezadent46','$piezadent47','$piezadent85','$PlaValor1','$PlaValor2','$PlaValor3','$PlaValor4','$PlaValor5','$PlaValor6','$PlaRess','$CalcValor1','$CalcValor2','$CalcValor3','$CalcValor4','$CalcValor5','$CalcValor6','$CalcRess','$gingiValor1','$gingiValor2','$gingiValor3','$gingiValor4','$gingiValor5','$gingiValor6','$gingiRess','$EnferPerLeve','$EnferPerMode','$EnferPerSeve','$MalOclucionA1','$MalOclucionA2','$MalOclucionA3','$FluoroLeve','$FluoroMode','$FluoroSeve','A','$idpac')");
					echo "<h3>Los datos han sido guardados correctamente</h3>";
				}
	//end Save Indicadores de Salud bucal

	//start function para cargar los datos de Indicadores de salud bucal segun el codigo del paciente
				public function LoadAllDatosSaludbucal($codePac)
				{
					$aux=new SaludBucal;
					if($aux->Consultar("SELECT COUNT(*) FROM tbl_indisaludbucal WHERE id_pac='$codePac'")==0)
					{
						echo "
						<table class='table table-bordered table-striped table-condensed ' > <tr><td colspan='10' align='center'><center>HIGIENE ORAL SIMPLIFICADA</center></td> <td width='1' rowspan='10'>&nbsp;</td> <td colspan='6'>&nbsp;</td> </tr> <tr> <td colspan='6'>&nbsp;</td> <td width='1' rowspan='9'>&nbsp;</td> <td width='74'>Placa</td> <td width='74'>Cálculo</td> <td width='73'>Gingivitis</td> <td colspan='2'>Enfermedad<br /> Periodontal</td> <td colspan='2'>Mal Oclusión</td> <td colspan='2'>Fluorosis</td> </tr> <tr> <td colspan='6'>Piezas Dentales</td> <td>0 - 1 - 2 - 3</td> <td>0 - 1 - 2 - 3</td> <td>0 - 1</td> <td width='68'>Leve</td> <td width='20'><input type='checkbox' class='chkIndicadores' id='LeveEnferPeriodon'></td> <td width='61'>Angle I</td> <td width='20'><input type='checkbox' class='chkIndicadores' id='Angle_I'></td> <td width='64'>Leve</td> <td width='23'><input type='checkbox' class='chkIndicadores' id='LeveFluorosis'></td> </tr> <tr> <td width='16'>16</td> <td width='20'><input type='checkbox' class='chkPiezasDental' id='16'></td> <td width='16'>17</td> <td width='20'><input type='checkbox' class='chkPiezasDental' id='17'></td> <td width='16'>55</td> <td width='20'><input type='checkbox' class='chkPiezasDental' id='55'></td> <td><input type='text' id='txtPlaca1' style='width:72px' /></td> <td><input type='text' id='Calculo1' style='width:72px' /></td> <td><input type='text' id='Gingivitis1' style='width:72px' /></td> <td>Moderada</td> <td><input type='checkbox' class='chkIndicadores' id='ModeradaEnferPeriodon'></td> <td>Angle II</td> <td><input type='checkbox' class='chkIndicadores' id='Angle_II'></td> <td>Moderada</td> <td><input type='checkbox' class='chkIndicadores' id='ModeradaFluorosis'></td> </tr> <tr> <td>11</td> <td><input type='checkbox' class='chkPiezasDental' id='11'></td> <td>21</td> <td><input type='checkbox' class='chkPiezasDental' id='21'></td> <td>51</td> <td><input type='checkbox' class='chkPiezasDental' id='51'></td> <td><input type='text' id='txtPlaca2' style='width:72px' /></td> <td><input type='text' id='Calculo2' style='width:72px' /></td> <td><input type='text' id='Gingivitis2' style='width:72px' /></td> <td>Severa</td> <td><input type='checkbox' class='chkIndicadores' id='SeveraEnferPeriodon'></td> <td>Angle III</td> <td><input type='checkbox' class='chkIndicadores' id='Angle_III'></td> <td>Severa</td> <td><input type='checkbox' class='chkIndicadores' id='SeveraFluorosis'></td> </tr> <tr> <td>26</td> <td><input type='checkbox' class='chkPiezasDental' id='26'></td> <td>27</td> <td><input type='checkbox' class='chkPiezasDental' id='27'></td> <td>65</td> <td><input type='checkbox' class='chkPiezasDental' id='65'></td> <td><input type='text' id='txtPlaca3' style='width:72px' /></td> <td><input type='text' id='Calculo3' style='width:72px' /></td> <td><input type='text' id='Gingivitis3' style='width:72px' /></td> <td colspan='6'>&nbsp;</td> </tr> <tr> <td>36</td> <td><input type='checkbox' class='chkPiezasDental' id='36'></td> <td>37</td> <td><input type='checkbox' class='chkPiezasDental' id='37'></td> <td>75</td> <td><input type='checkbox' class='chkPiezasDental' id='75'></td> <td><input type='text' id='txtPlaca4' style='width:72px' /></td> <td><input type='text' id='Calculo4' style='width:72px' /></td> <td><input type='text' id='Gingivitis4' style='width:72px' /></td> <td colspan='6' rowspan='3'>&nbsp;</td> </tr> <tr> <td>31</td> <td><input type='checkbox' class='chkPiezasDental' id='31'></td> <td>41</td> <td><input type='checkbox' class='chkPiezasDental' id='41'></td> <td>71</td> <td><input type='checkbox' class='chkPiezasDental' id='71'></td> <td><input type='text' id='txtPlaca5' style='width:72px' /></td> <td><input type='text' id='Calculo5' style='width:72px' /></td> <td><input type='text' id='Gingivitis5' style='width:72px' /></td> </tr> <tr> <td>46</td> <td><input type='checkbox' class='chkPiezasDental' id='46'></td> <td>47</td> <td><input type='checkbox' class='chkPiezasDental' id='47'></td> <td>85</td> <td><input type='checkbox' class='chkPiezasDental' id='85'></td> <td><input type='text' id='txtPlaca6' style='width:72px' /></td> <td><input type='text' id='Calculo6' style='width:72px' /></td> <td><input type='text' id='Gingivitis6' style='width:72px' /></td> </tr> <tr> <td colspan='6'><center>Totales: </center></td> <td><input type='text' id='TotalPlaca' style='width:72px' onfocus='TotalePlaca()' /></td> <td><input type='text' id='TotalCalculo' onfocus='TotalesCalculo()' style='width:72px' /></td> <td><input type='text' id='TotalGingivitis' style='width:72px' onfocus='TotalesGingivitis()'/></td> <td colspan='3'>&nbsp;</td><td colspan='3'><center><input type='button' id='bntGuardarSaludbucal' style='width:100px;' class='btn btn-info'  onclick='SaveIndicadoresSaludb()' value='Guardar'></center></td></tr> <tr> <td colspan='17'></td> </tr> </table>
						";	
					}
					else
					{
						$code=$aux->Consultar("SELECT MAX(id_indicasb) FROM tbl_indisaludbucal WHERE id_pac='$codePac'");
						$datos=$aux->Consultar_SaludBucal("SELECT * FROM tbl_indisaludbucal WHERE id_indicasb='$code'");
						foreach($datos as $fila)
						{
							echo "
							<table class='table table-bordered table-striped table-condensed ' > <tr><td colspan='10' align='center'><center>HIGIENE ORAL SIMPLIFICADA</center></td> <td width='1' rowspan='10'>&nbsp;</td> <td colspan='6'>&nbsp;</td> </tr> <tr> <td colspan='6'>&nbsp;</td> <td width='1' rowspan='9'>&nbsp;</td> <td width='74'>Placa</td> <td width='74'>Cálculo</td> <td width='73'>Gingivitis</td> <td colspan='2'>Enfermedad<br /> Periodontal</td> <td colspan='2'>Mal Oclusión</td> <td colspan='2'>Fluorosis</td> </tr> <tr> <td colspan='6'>Piezas Dentales</td> <td>0 - 1 - 2 - 3</td> <td>0 - 1 - 2 - 3</td> <td>0 - 1</td> <td width='68'>Leve</td> <td width='20'>" ;
								if($fila['enfperiodonleve_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='LeveEnferPeriodon' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='LeveEnferPeriodon' ></td>";
								}

								echo "<td width='61'>Angle I</td> <td width='20'>" ;
								if($fila['maloclucionangle1_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='Angle_I' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='Angle_I' ></td>";
								}
								echo "<td width='64'>Leve</td> <td width='23'>" ;
								if($fila['fluorosisleve_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='LeveFluorosis' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='LeveFluorosis' ></td>";
								}
								echo "</tr> <tr> <td width='16'>16</td> <td width='20'>" ;
								if($fila['piezas16_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='16' checked='true'></td>";						
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='16' ></td>";
								}
								echo "<td width='16'>17</td> <td width='20'>" ;
								if($fila['piezas17_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='17' checked='true'></td>";
								}
								else 
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='17' ></td>";
								}
								echo "<td width='16'>55</td> <td width='20'>" ;
								if($fila['piezas55_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='55' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='55' ></td>";
								}
								echo "<td><input type='text' id='txtPlaca1' style='width:72px' value='$fila[placaval1_indicasb]' /></td> <td><input type='text' id='Calculo1' style='width:72px' value='$fila[claculoval1_indicasb]' /></td> <td><input type='text' id='Gingivitis1' style='width:72px' value='$fila[gingivitisval1_indicasb]' /></td> <td>Moderada</td> <td>" ;
								if($fila['enfperiodonmode_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='ModeradaEnferPeriodon' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='ModeradaEnferPeriodon' ></td>";
								}
								echo "<td>Angle II</td> <td>" ;
								if($fila['maloclucionangle2_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='Angle_II' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='Angle_II' ></td>";
								}
								echo "<td>Moderada</td> <td>" ;
								if($fila['fluorosismode_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='ModeradaFluorosis' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='ModeradaFluorosis' ></td>";
								}
								echo "</tr> <tr> <td>11</td> <td>" ;
								if($fila['piezas11_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='11' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='11' ></td>";
								}
								echo "<td>21</td> <td>" ;
								if($fila['piezas21_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='21' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='21' ></td>";
								}
								echo "<td>51</td> <td> ";
								if($fila['piezas51_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='51' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='51' ></td>";
								}
								echo "<td><input type='text' id='txtPlaca2' style='width:72px' value='$fila[placaval2_indicasb]' /></td> <td><input type='text' id='Calculo2' style='width:72px' value='$fila[claculoval2_indicasb]' /></td> <td><input type='text' id='Gingivitis2' style='width:72px' value='$fila[gingivitisval2_indicasb]' /></td> <td>Severa</td> <td>" ;
								if($fila['enfperiodonseve_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='SeveraEnferPeriodon' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='SeveraEnferPeriodon' ></td>";
								}
								echo "<td>Angle III</td> <td>" ;
								if($fila['maloclucionangle3_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='Angle_III' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='Angle_III' ></td>";
								}
								echo "<td>Severa</td> <td>" ;
								if($fila['fluorosisseve_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkIndicadores' id='SeveraFluorosis' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkIndicadores' id='SeveraFluorosis' ></td>";
								}
								echo "</tr> <tr> <td>26</td> <td> " ;
								if($fila['piezas26_indicasb'])
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='26' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='26' ></td>";
								}
								echo "<td>27</td> <td>" ;
								if($fila['piezas27_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='27' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='27' ></td>";
								}
								echo "<td>65</td> <td> " ;
								if($fila['piezas65_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='65' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='65' ></td>";
								}
								echo "<td><input type='text' id='txtPlaca3' style='width:72px' value='$fila[placaval3_indicasb]' /></td> <td><input type='text' id='Calculo3' style='width:72px' value='$fila[claculoval3_indicasb]' /></td> <td><input type='text' id='Gingivitis3' style='width:72px' value='$fila[gingivitisval3_indicasb]' /></td> <td colspan='6'>&nbsp;</td> </tr> <tr> <td>36</td> <td>" ;
								if($fila['piezas36_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='36' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='36' ></td>";
								}
								echo "<td>37</td> <td>";
								if($fila['piezas37_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='37' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='37' ></td>";
								}
								echo "<td>75</td> <td>" ;
								if($fila['piezas75_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='75' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='75' ></td>";
								}
								echo "<td><input type='text' id='txtPlaca4' style='width:72px' value='$fila[placaval4_indicasb]' /></td> <td><input type='text' id='Calculo4' style='width:72px' value='$fila[claculoval4_indicasb]' /></td> <td><input type='text' id='Gingivitis4' style='width:72px' value='$fila[gingivitisval4_indicasb]' /></td> <td colspan='6' rowspan='3'>&nbsp;</td> </tr> <tr> <td>31</td> <td>" ;
								if($fila['piezas31_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='31' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='31' ></td>";
								}
								echo "<td>41</td> <td>" ;
								if($fila['piezas41_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='41' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='41' ></td>";
								}
								echo "<td>71</td> <td>" ;
								if($fila['piezas71_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='71' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='71' ></td>";
								}
								echo "<td><input type='text' id='txtPlaca5' style='width:72px' value='$fila[placaval5_indicasb]' /></td> <td><input type='text' id='Calculo5' style='width:72px' value='$fila[claculoval5_indicasb]' /></td> <td><input type='text' id='Gingivitis5' style='width:72px' value='$fila[gingivitisval5_indicasb]' /></td> </tr> <tr> <td>46</td> <td>" ;
								if($fila['piezas46_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='46' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='46' ></td>";
								}
								echo "<td>47</td> <td>" ;
								if($fila['piezas47_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='47' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='47' ></td>";
								}
								echo "<td>85</td> <td>" ;
								if($fila['piezas85_indicasb']=="true")
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='85' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPiezasDental' id='85' ></td>";
								}
								echo "<td><input type='text' id='txtPlaca6' style='width:72px' value='$fila[placaval6_indicasb]' /></td> <td><input type='text' id='Calculo6' style='width:72px' value='$fila[claculoval6_indicasb]' /></td> <td><input type='text' id='Gingivitis6' style='width:72px' value='$fila[gingivitisval6_indicasb]' /></td> </tr> <tr> <td colspan='6'><center>Totales: </center></td> <td><input type='text' id='TotalPlaca' style='width:72px' onfocus='TotalePlaca()' value='$fila[placares_indicasb]' /></td> <td><input type='text' id='TotalCalculo' onfocus='TotalesCalculo()' style='width:72px' value='$fila[claculores_indicasb]' /></td> <td><input type='text' id='TotalGingivitis' style='width:72px' onfocus='TotalesGingivitis()' value='$fila[gingivitisres_indicasb]' /></td> <td colspan='3'>&nbsp;</td><td colspan='3'><center><input type='button' id='bntGuardarSaludbucal' style='width:100px;' class='btn btn-info'  onclick='SaveIndicadoresSaludb()' value='Guardar'></center></td></tr> <tr> <td colspan='17'></td> </tr> </table>
								";
							}
						}
					}
	//end function para cargar los datos de Indicadores de salud bucal segun el codigo del paciente

	//start fuction para guardar los datos de Indices CPO - ceo
					public function SaveAllIndicesCPOCeo($CPOC1,$CPOP1,$CPOO1,$CPOTotales,$ceoc2,$ceoe2,$ceoo2,$ceoTotales,$idPac)
					{
						$indicescpeo=new IndicesCPOceo;
						$aux=$indicescpeo->Ejecutar("INSERT INTO tbl_indicescpoceo (c1_cpoceo,p1_cpoceo,o1_cpoceo,totalD_cpoceo,c2_cpoceo,e2_cpoceo,o2_cpoceo,totalD2_cpoceo,id_pac,estado_cpoceo) VALUES ('$CPOC1','$CPOP1','$CPOO1','$CPOTotales','$ceoc2','$ceoe2','$ceoo2','$ceoTotales','$idPac','A')");
						echo "<h3>Los datos han sido guardados correctamente</h3>";
					}
	//end fuction para guardar los datos de Indices CPO - ceo

	//start function para cargar los datos guardados en Indices CPO ceo segun el codigo del pac
					public function LoadAllRegIndicesCpoceo($codPac)
					{
						$aux=new IndicesCPOceo;
						if($aux->Consultar("SELECT COUNT(*) FROM tbl_indicescpoceo WHERE id_pac='$codPac'")==0)
						{
							echo "
							<table class='table table-bordered table-striped table-condensed ' > <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <td width='11' rowspan='2'>D</td> <td width='72'>C</td> <td width='72'>P</td> <td width='12'>O</td> <td width='98'>Total.</td> </tr> <tr> <td><input type='text' id='txtIndicesC1' style='width:72px' /></td> <td><input type='text' id='txtIndicesP1' style='width:72px' /></td> <td><input type='text' id='txtIndicesO1' style='width:72px' /></td> <td><input type='text' id='txtTotalIndicesCpo' style='width:72px' onfocus='TotalCPO()' /></td> </tr> <tr> <td rowspan='2'>d</td> <td>c</td> <td>e</td> <td>o</td> <td>Total.</td> </tr> <tr> <td><input type='text' id='txtIndicesc2' style='width:72px' /></td> <td><input type='text' id='txtIndicese2' style='width:72px' /></td> <td><input type='text' id='txtIndiceso2' style='width:72px' /></td> <td><input type='text' id='txtTotalIndicesceo' style='width:72px' onfocus='Totalceo()' /></td> </tr> <tr><td colspan='5'><center><input type='button' id='bntSalvarIndicesCPOCeo' style='width:100px;' class='btn btn-info'  onclick='SaveIndicesCPOCeo()' value='Guardar'></center></td></tr> </table>";
						}
						else
						{
							$codeIn=$aux->Consultar("SELECT MAX(id_cpoceo) FROM tbl_indicescpoceo WHERE id_pac='$codPac'");
							$datos=$aux->Consultar_IndicesCPOceo("SELECT * FROM tbl_indicescpoceo WHERE id_cpoceo='$codeIn'");
							foreach($datos as $fila)
							{
								echo "
								<table class='table table-bordered table-striped table-condensed ' > <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <td width='11' rowspan='2'>D</td> <td width='72'>C</td> <td width='72'>P</td> <td width='12'>O</td> <td width='98'>Total.</td> </tr> <tr> <td><input type='text' id='txtIndicesC1' style='width:72px' value='$fila[c1_cpoceo]' /></td> <td><input type='text' id='txtIndicesP1' style='width:72px' value='$fila[p1_cpoceo]' /></td> <td><input type='text' id='txtIndicesO1' style='width:72px' value='$fila[o1_cpoceo]' /></td> <td><input type='text' id='txtTotalIndicesCpo' style='width:72px' onfocus='TotalCPO()' value='$fila[totalD_cpoceo]' /></td> </tr> <tr> <td rowspan='2'>d</td> <td>c</td> <td>e</td> <td>o</td> <td>Total.</td> </tr> <tr> <td><input type='text' id='txtIndicesc2' style='width:72px' value='$fila[c2_cpoceo]' /></td> <td><input type='text' id='txtIndicese2' style='width:72px' value='$fila[e2_cpoceo]' /></td> <td><input type='text' id='txtIndiceso2' style='width:72px' value='$fila[o2_cpoceo]' /></td> <td><input type='text' id='txtTotalIndicesceo' style='width:72px' onfocus='Totalceo()' value='$fila[totalD2_cpoceo]' /></td> </tr> <tr><td colspan='5'><center><input type='button' id='bntSalvarIndicesCPOCeo' style='width:100px;' class='btn btn-info'  onclick='SaveIndicesCPOCeo()' value='Guardar'></center></td></tr> </table>";
							}
						}
					}
	//end function para cargar los datos guardados en Indices CPO ceo segun el codigo del pac
	//start function para guardar los datos de planes de diagnostico terap. y ed. 
					public function SavePlanesDiagnostico($biometria,$quimicasan,$rayosx,$otros,$detalle,$codpac)
					{
						$planes=new PlanesDiagnostico;
						$aux=$planes->Ejecutar("INSERT INTO tbl_planesdiagnostico (biometria_planesdi,quimicasan_planesdi,rayosx_planesdi,otros_planesdi,detalle_planesdi,id_pac,est_planesdi) VALUES ('$biometria','$quimicasan','$rayosx','$otros','$detalle','$codpac','A')");
						echo "<h3>Los datos han sido guardados correctamente</h3>";
					}
	//end function para guardar los datos de planes de diagnostico terap. y ed.

	//start function para cargar los datos guardados en plaes de diagnostico
					public function LoadAllPlanesdeDiagnostico($idPac)
					{
						$aux=new PlanesDiagnostico;
						if($aux->Consultar("SELECT COUNT(*) FROM tbl_planesdiagnostico WHERE id_pac='$idPac'")==0)
						{
							echo "
							<table class='table table-bordered table-striped table-condensed ' > <tr> <td width='76'>Biometría</td> <td width='22'><input type='checkbox' class='chkPlanesDiagTeraEd' id='Biometría'></td> <td width='124'>Química Sanguínea</td> <td width='21'><input type='checkbox' class='chkPlanesDiagTeraEd' id='Química_Sanguínea'></td> <td width='75'>Rayos - x</td> <td width='21'><input type='checkbox' class='chkPlanesDiagTeraEd' id='Rayos_x'></td> <td width='43'>Otros</td> <td width='21'><input type='checkbox' class='chkPlanesDiagTeraEd' id='Otros'></td> </tr> <tr> <td colspan='8'>&nbsp;</td> </tr> <tr> <td colspan='8'>Detalle: </td> </tr> <tr> <td colspan='8'><textarea id='txtDetallePlanesDiagnTeraEd' cols='40' rows='2' style='width:479px'></textarea></td> </tr> <tr><td colspan='8'><center><input type='button' id='bntGuardarPlanesDi' style='width:100px;' class='btn btn-info'  onclick='SavePlanesDiagnosticoTE()' value='Guardar'></center></td></tr> </table>";
						}
						else
						{
							$codPlanes=$aux->Consultar("SELECT MAX(id_planesdi) FROM tbl_planesdiagnostico WHERE id_pac='$idPac'");
							$datos=$aux->Consultar_PlanesDiagnostico("SELECT * FROM tbl_planesdiagnostico WHERE id_planesdi='$codPlanes'");
							foreach($datos as $fila)
							{
								echo "<table class='table table-bordered table-striped table-condensed ' > <tr> <td width='76'>Biometría</td> <td width='22'>" ;
								if($fila['biometria_planesdi']=="true")
								{
									echo "<input type='checkbox' class='chkPlanesDiagTeraEd' id='Biometría' checked='true' ></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPlanesDiagTeraEd' id='Biometría' ></td>";
								}
								echo "<td width='124'>Química Sanguínea</td> <td width='21'>" ;
								if($fila['quimicasan_planesdi']=="true")
								{
									echo "<input type='checkbox' class='chkPlanesDiagTeraEd' id='Química_Sanguínea' checked='true'></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPlanesDiagTeraEd' id='Química_Sanguínea' ></td>";
								}
								echo "<td width='75'>Rayos - x</td> <td width='21'>" ;
								if($fila['rayosx_planesdi']=="true")
								{
									echo "<input type='checkbox' class='chkPlanesDiagTeraEd' id='Rayos_x' checked='true' ></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPlanesDiagTeraEd' id='Rayos_x' ></td>";
								}
								echo "<td width='43'>Otros</td> <td width='21'>" ;
								if($fila['otros_planesdi']=="true")
								{
									echo "<input type='checkbox' class='chkPlanesDiagTeraEd' id='Otros' checked='true' ></td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkPlanesDiagTeraEd' id='Otros' ></td>";
								}
								echo "</tr> <tr> <td colspan='8'>&nbsp;</td> </tr> <tr> <td colspan='8'>Detalle: </td> </tr> <tr> <td colspan='8'><textarea id='txtDetallePlanesDiagnTeraEd' cols='40' rows='2' style='width:479px'>'$fila[detalle_planesdi]' </textarea></td> </tr> <tr><td colspan='8'><center><input type='button' id='bntGuardarPlanesDi' style='width:100px;' class='btn btn-info'  onclick='SavePlanesDiagnosticoTE()' value='Guardar'></center></td></tr> </table>";
							}
						}
					}
	//end function para cargar los datos guardados en plaes de diagnostico

	//funcion para guardar examen estomatognatico
					public function SaveEstamatognatico($Labios,$Mejillas,$MaxSup,$MaxInf,$Lengua,$Paladar,$Piso,$Carrillos,$GlandulasSa,$Faringe,$Atm,$Ganglios,$DetalleExEstoma,$codpac)
					{
						$estoma=new Estomatognatico;
						$aux=$estoma->Ejecutar("INSERT INTO tbl_estomatognatico (lab_estoma,mej_estoma,msup_estoma,minf_estoma,len_estoma,pal_estoma,pis_estoma,carr_estoma,glsa_estoma,far_estoma,atm_estoma,gan_estoma,det_estoma,est__estoma,id_pac) VALUES ('$Labios','$Mejillas','$MaxSup','$MaxInf','$Lengua','$Paladar','$Piso','$Carrillos','$GlandulasSa','$Faringe','$Atm','$Ganglios','$DetalleExEstoma','A','$codpac')");
						echo "<h3>Los datos se han guardado correctamente</h3>";
					}
	//fin funcion para guardar examen estomatognatico 

	//funcion para cargar los datos de examen estomatognático
					public function LoadAllEstomatignatico($idPac)
					{
						$aux=new Estomatognatico;
						if($aux->Consultar("SELECT COUNT(*) FROM tbl_estomatognatico WHERE id_pac='$idPac'")==0)
						{
							echo"<table width='865' border='1' class='table table-bordered table-striped table-hover table-condensed' > <tr> <th colspan='5'><b>Exámen del Sistema Estomatognático</b></th> </tr> <tr> <td width='131'><input type='checkbox' class='chkEstomatognatico' id='LABIOS'>1. LABIOS</td> <td width='146'><input type='checkbox' class='chkEstomatognatico' id='MEJILLAS'>2. MEJILLAS</td> <td width='210'><input type='checkbox' class='chkEstomatognatico' id='MAXILARSUPERIOR'>3. MAXILAR SUPERIOR</td> <td width='240'><input type='checkbox' class='chkEstomatognatico' id='MAXILARINFERIOR'>4. MAXILAR INFERIOR</td> <td width='166'><input type='checkbox' class='chkEstomatognatico' id='LENGUA'>5. LENGUA</td> </tr> <tr> <td><input type='checkbox' class='chkEstomatognatico' id='PALADAR'>6. PALADAR</td> <td><input type='checkbox' class='chkEstomatognatico' id='PISO'>7. PISO</td> <td><input type='checkbox' class='chkEstomatognatico' id='CARRILLOS'>8. CARRILLOS </td> <td><input type='checkbox' class='chkEstomatognatico' id='GLANDULASSALIBALES'>9. GLANDULAS SALIBALES </td> <td><input type='checkbox' class='chkEstomatognatico' id='FARINGE'>10. ORO FARINGE </td> </tr> <tr> <td><input type='checkbox' class='chkEstomatognatico' id='ATM'>11. A.T.M.</td> <td><input type='checkbox' class='chkEstomatognatico' id='GANGLIOS'>12. GANGLIOS</td> <td colspan='3'>&nbsp;</td> </tr> <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <td colspan='5'>Describir abajo la patología de la región afectada anotando el número.</td> </tr> <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <th colspan='3'><b>DETALLE </b></th> <td>&nbsp;</td> <td>&nbsp;</td> </tr> <tr> <td colspan='3'><textarea cols='30' rows='2' id='txt_detalle' style='width:472px'></textarea></td> <td>&nbsp;</td> <!-- <td><input type='button' id='bntExOdontologico'  class='btn btn-primary' value='Imprimir Exámen' onclick='ImprOdontologico()' /></td> --> <td><input type='button' id='bntExEstoma'  class='btn btn-primary' value='Guardar' onclick='SaveExEstoma()' /></td> </tr> </table>";
						}
						else
						{
							$codEstoma=$aux->Consultar("SELECT MAX(id_estoma) FROM tbl_estomatognatico WHERE id_pac='$idPac'");
							$datos=$aux->Consultar_Estomatognatico("SELECT * FROM tbl_estomatognatico WHERE id_estoma='$codEstoma'");
							foreach($datos as $fila)
							{
								echo "<table width='865' border='1' class='table table-bordered table-striped table-hover table-condensed' > <tr> <th colspan='5'><b>Exámen del Sistema Estomatognático</b></th> </tr> <tr> <td width='131'>";
								if($fila['lab_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='LABIOS' checked='true'>1. LABIOS</td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='LABIOS'>1. LABIOS</td>";
								}
								echo "<td width='146'> ";
								if($fila['mej_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='MEJILLAS' checked='true'>2. MEJILLAS</td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='MEJILLAS' >2. MEJILLAS</td>";
								}
								echo "<td width='210'> ";
								if($fila['msup_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='MAXILARSUPERIOR' checked='true'>3. MAXILAR SUPERIOR</td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='MAXILARSUPERIOR'>3. MAXILAR SUPERIOR</td>";
								}
								echo "<td width='240'> ";
								if($fila['minf_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='MAXILARINFERIOR' checked='true'>4. MAXILAR INFERIOR</td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='MAXILARINFERIOR' >4. MAXILAR INFERIOR</td>";
								}
								echo "<td width='166'> ";
								if($fila['len_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='LENGUA' checked='true'>5. LENGUA</td>";
								}
								else 
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='LENGUA'>5. LENGUA</td>";
								}
								echo "</tr> <tr> <td> ";
								if($fila['pal_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='PALADAR' checked='true'>6. PALADAR</td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='PALADAR'>6. PALADAR</td>";
								}
								echo "<td> ";
								if($fila['pis_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='PISO' checked='true'>7. PISO</td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='PISO'>7. PISO</td>";
								}
								echo "<td> ";
								if($fila['carr_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='CARRILLOS' checked='true'>8. CARRILLOS </td>";
								}
								else 
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='CARRILLOS'>8. CARRILLOS </td>";
								}
								echo "<td> ";
								if($fila['glsa_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='GLANDULASSALIBALES' checked='true'>9. GLANDULAS SALIBALES </td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='GLANDULASSALIBALES'>9. GLANDULAS SALIBALES </td>";
								}
								echo "<td> ";
								if($fila['far_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='FARINGE' checked='true'>10. ORO FARINGE </td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='FARINGE'>10. ORO FARINGE </td>";
								}
								echo "</tr> <tr> <td> ";
								if($fila['atm_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='ATM' checked='true'>11. A.T.M.</td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='ATM'>11. A.T.M.</td>";
								}
								echo "<td> ";
								if($fila['gan_estoma']=="true")
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='GANGLIOS' checked='true'>12. GANGLIOS</td>";
								}
								else
								{
									echo "<input type='checkbox' class='chkEstomatognatico' id='GANGLIOS'>12. GANGLIOS</td>";
								}
								echo "<td colspan='3'>&nbsp;</td> </tr> <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <td colspan='5'>Describir abajo la patología de la región afectada anotando el número.</td> </tr> <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <th colspan='3'><b>DETALLE </b></th> <td>&nbsp;</td> <td>&nbsp;</td> </tr> <tr> <td colspan='3'><textarea cols='30' rows='2' id='txt_detalle' style='width:472px'>$fila[det_estoma]</textarea></td> <td>&nbsp;</td> <!-- <td><input type='button' id='bntExOdontologico'  class='btn btn-primary' value='Imprimir Exámen' onclick='ImprOdontologico()' /></td> --> <td><input type='button' id='bntExEstoma'  class='btn btn-primary' value='Guardar' onclick='SaveExEstoma()' /></td> </tr> </table>";
							}
						}
					} 
	//fin funcion para cargar los datos de examen estomatognático

	//start function save signos vitales
					public function SaveSignosVitales($PresArterial,$FrecCardiaca,$Temperatura,$Frespirat,$idPac)
					{
						$sgnvit=new SignosVitales;
						$aux=$sgnvit->Ejecutar("INSERT INTO tbl_signosvitales (prearte_signvit,frecar_signvit,tempeac_signvit,frespirat_signvit,est_signvit,id_pac) VALUES ('$PresArterial','$FrecCardiaca','$Temperatura','$Frespirat','A','$idPac')");

						echo "<h3>Los datos se han guardado correctamente</h3>";
					}
	//end function save signos vitales
	//start load all datos de signos vitales
					public function LoadAllSignosVitales($codePac)
					{
						$aux=new SignosVitales;
						if($aux->Consultar("SELECT COUNT(*) FROM tbl_signosvitales WHERE id_pac='$codePac'")==0)
						{
							echo "<table width='720' border='1' class='table table-bordered table-striped table-hover table-condensed '> <tr> <td width='169'>1. PRESIÓN ARTERIAL.</td> <td width='161'><input type='text' style='width:160px;' id='txtPresionArte'/></td> <td width='206'>2. FRECUENCIA CARDIACA.</td> <td width='160'><input type='text' style='width:160px;' id='txtFreCardi'/></td> </tr> <tr> <td>3. TEMPERATURA A °C</td> <td><input type='text' style='width:160px;' id='txtTempe_C'/></td> <td>4. F. RESPIRAT. min.</td> <td><input type='text' style='width:160px;' id='txtFrespiratmin'/></td> </tr> <tr> <td colspan='4'><center><input type='button' id='bntGuardarSignosVitales' style='width:100px;' class='btn btn-primary'  onclick='SaveSignosVi()' value='Guardar'></center></td> </tr> </table>";
						}
						else
						{
							$codsgnv=$aux->Consultar("SELECT MAX(id_signvit) FROM tbl_signosvitales WHERE id_pac='$codePac'");
							$datos=$aux->Consultar_SignosVitales("SELECT * FROM tbl_signosvitales WHERE id_signvit='$codsgnv'");
							foreach($datos as $fila)
							{
								echo "
								<table width='720' border='1' class='table table-bordered table-striped table-hover table-condensed '> <tr> <td width='169'>1. PRESIÓN ARTERIAL.</td> <td width='161'><input type='text' style='width:160px;' id='txtPresionArte' value='$fila[prearte_signvit]'/></td> <td width='206'>2. FRECUENCIA CARDIACA.</td> <td width='160'><input type='text' style='width:160px;' id='txtFreCardi' value='$fila[frecar_signvit]' /></td> </tr> <tr> <td>3. TEMPERATURA A °C</td> <td><input type='text' style='width:160px;' id='txtTempe_C' value='$fila[tempeac_signvit]' /></td> <td>4. F. RESPIRAT. min.</td> <td><input type='text' style='width:160px;' id='txtFrespiratmin' value='$fila[frespirat_signvit]'/></td> </tr> <tr> <td colspan='4'><center><input type='button' id='bntGuardarSignosVitales' style='width:100px;' class='btn btn-primary'  onclick='SaveSignosVi()' value='Guardar'></center></td> </tr> </table>";
							}
						}
					}
	//end load all datos de signos vitales 	

	//funcion para guardar e imprimir examen de sistema estomatognatico
					public function ExamenEstomatognatico($desc,$cod)
					{
						$aux=new SisEstomatognatico;
						$aux->Ejecutar("INSERT INTO tbl_sistestomatognatico (desc_sistestoma,id_tu) VALUES ('$desc','$cod')");
						echo $aux;
					}

	//funcion para guardar examen fisico

	//start function para guardar los datos prenatales
					public function SaveAllPrenatales($PrenatalesG,$PrenatalesA,$PrenatalesP,$PrenatalesC,$CompliEm,$Nac,$Edadgesta,$Peso,$Talla,$PC,$Apgar1,$Apgar2,$ComplicaNac,$Screen,$codpac)
					{
						$pre=new Prenatales;
						$aux=$pre->Ejecutar("INSERT INTO tbl_prenatales (prenag_prenatal,prenaa_prenatal,prenap_prenatal,prenac_prenatal,condicionem_prenatal,nac_prenatal,edadges_prenatal,peso_prenatal,talla_prenatal,pc_prenatal,apgar1_prenatal,apgar2_prenatal,complicanac_prenatal,screening_prenatal,est_prenatal,id_pac) VALUES ('$PrenatalesG','$PrenatalesA','$PrenatalesP','$PrenatalesC','$CompliEm','$Nac','$Edadgesta','$Peso','$Talla','$PC','$Apgar1','$Apgar2','$ComplicaNac','$Screen','A','$codpac')");
						echo "<h3>Los datos han sido guardados correctamente</h3>";
					}
	//end function para guardar los datos prenatales

	//start cargar los datos guardados en prenatales
					public function LoadAllPrenatales($idPac)
					{
						$aux=new Prenatales;
						if($aux->Consultar("SELECT COUNT(*) FROM tbl_prenatales WHERE id_pac='$idPac'")==0)
						{
							echo "
							<table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td width='115'>Prenatales: </td> <td width='100'>G &nbsp; <input type='text' id='txtGprenatales' style='width:72px' /></td> <td width='110'>A &nbsp; <input type='text' id='txtAprenatales' style='width:72px' /></td> <td width='112'>P &nbsp; <input type='text' id='txtPprenatales' style='width:72px' /></td> <td width='116'>C &nbsp; <input type='text' id='txtCprenatales' style='width:72px' /></td> </tr> <tr> <td colspan='2'>Complicaciones en el embarazo: </td> <td colspan='3'><textarea id='txtComplicacionesEmb' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>Nacimiento: </td> <td colspan='4'><select id='txtNacimiento'><option>---Seleccione---</option><option>Cesaria Electiva</option><option>Cesaria Emergencia</option><option>Parto Cefalovaginal</option><option>Parto Podálicovaginal</option></select></td> </tr> <tr> <td>Edad gestacional: </td> <td colspan='4'><input type='text' id='txtEdadGesta' style='width:72px' /> &nbsp; Semanas</td> </tr> <tr> <td colspan='2'>Peso: <input type='text' id='txtPeso' style='width:72px' />      &nbsp; gr.</td> <td colspan='2'>Talla: <input type='text' id='txtTalla' style='width:72px' />      &nbsp; cm.</td> <td colspan='2'>PC: <input type='text' id='txtPC' style='width:72px' />      &nbsp; cm.</td> </tr> <tr> <td>APGAR: </td> <td><input type='text' id='txtapgar1' style='width:72px' /></td> <td><input type='text' id='txtapgar2' style='width:72px' /></td> <td colspan='2'>&nbsp;</td> </tr> <tr> <td colspan='2'>Complicaciones al nacimiento: </td> <td colspan='3'><textarea id='txtComplicacionesNac' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td colspan='2'>Screening metabólico: </td> <td colspan='3'><textarea id='txtScreening' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td colspan='5'><center><input type='button' id='bntGuardarPrenatales' style='width:100px;' class='btn btn-primary'  onclick='SavePrenatales()' value='Guardar'></center></td> </tr> </table>";
						}
						else
						{
							$codPre=$aux->Consultar("SELECT MAX(id_prenatal) FROM tbl_prenatales WHERE id_pac='$idPac'");
							$datos=$aux->Consultar_Prenatales("SELECT * FROM tbl_prenatales WHERE id_prenatal='$codPre'");
							foreach($datos as $fila)
							{
								echo "
								<table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td width='115'>Prenatales: </td> <td width='100'>G &nbsp; <input type='text' id='txtGprenatales' style='width:72px' value='$fila[prenag_prenatal]' /></td> <td width='110'>A &nbsp; <input type='text' id='txtAprenatales' style='width:72px' value='$fila[prenaa_prenatal]' /></td> <td width='112'>P &nbsp; <input type='text' id='txtPprenatales' style='width:72px' value='$fila[prenap_prenatal]' /></td> <td width='116'>C &nbsp; <input type='text' id='txtCprenatales' style='width:72px' value='$fila[prenac_prenatal]' /></td> </tr> <tr> <td colspan='2'>Complicaciones en el embarazo: </td> <td colspan='3'><textarea id='txtComplicacionesEmb' cols='40' rows='2' style='width:200px'>$fila[condicionem_prenatal]</textarea></td> </tr> <tr> <td>Nacimiento: </td> <td colspan='4'><select id='txtNacimiento' readyonly ><option>$fila[nac_prenatal]</option>< !--<option>$fila[nac_prenatal]</option><option>$fila[nac_prenatal]</option><option>$fila[nac_prenatal]</option>-- ></select></td> </tr> <tr> <td>Edad gestacional: </td> <td colspan='4'><input type='text' id='txtEdadGesta' style='width:72px' value='$fila[edadges_prenatal]' /> &nbsp; Semanas</td> </tr> <tr> <td colspan='2'>Peso: <input type='text' id='txtPeso' style='width:72px' value='$fila[peso_prenatal]' />      &nbsp; gr.</td> <td colspan='2'>Talla: <input type='text' id='txtTalla' style='width:72px' value='$fila[talla_prenatal]' />      &nbsp; cm.</td> <td colspan='2'>PC: <input type='text' id='txtPC' style='width:72px' value='$fila[pc_prenatal]' />      &nbsp; cm.</td> </tr> <tr> <td>APGAR: </td> <td><input type='text' id='txtapgar1' style='width:72px' value='$fila[apgar1_prenatal]' /></td> <td><input type='text' id='txtapgar2' style='width:72px' value='$fila[apgar2_prenatal]' /></td> <td colspan='2'>&nbsp;</td> </tr> <tr> <td colspan='2'>Complicaciones al nacimiento: </td> <td colspan='3'><textarea id='txtComplicacionesNac' cols='40' rows='2' style='width:200px'>$fila[complicanac_prenatal]</textarea></td> </tr> <tr> <td colspan='2'>Screening metabólico: </td> <td colspan='3'><textarea id='txtScreening' cols='40' rows='2' style='width:200px'>$fila[screening_prenatal]</textarea></td> </tr> <tr> <td colspan='5'><center><input type='button' id='bntGuardarPrenatales' style='width:100px;' class='btn btn-primary'  onclick='SavePrenatales()' value='Guardar'></center></td> </tr> </table>";
							}
						}
					}
	//end cargar los datos guardados en prenatales

	//start function para guardar las vacunas
					public function SaveVacunas($dosis1DPT,$dosis2DPT,$dosis3DPT,$ref1DPT,$ref2DPT,$obDPT,$dosis1PO,$dosis2PO,$dosis3PO,$ref1PO,$ref2PO,$obPO,$dosis1HIB,$dosis2HIB,$dosis3HIB,$ref1HIB,$ref2HIB,$obHIB,$dosis1HVB,$dosis2HVB,$dosis3HVB,$ref1HVB,$ref2HVB,$obHVB,$dosis1NEUMO,$dosis2NEUMO,$dosis3NEUMO,$ref1NEUMO,$ref2NEUMO,$obNEUMO,$dosis1ROTA,$dosis2ROTA,$dosis3ROTA,$ref1ROTA,$ref2ROTA,$obROTA,$dosis1SPR,$dosis2SPR,$dosis3SPR,$ref1SPR,$ref2SPR,$obSPR,$dosis1VARI,$dosis2VARI,$dosis3VARI,$ref1VARI,$ref2VARI,$obVARI,$dosis1HVA,$dosis2HVA,$dosis3HVA,$ref1HVA,$ref2HVA,$obHVA,$dosis1FAMA,$dosis2FAMA,$dosis3FAMA,$ref1FAMA,$ref2FAMA,$obFAMA,$dosis1INFLU,$dosis2INFLU,$dosis3INFLU,$ref1INFLU,$ref2INFLU,$obINFLU,$dosis1MENINGO,$dosis2MENINGO,$dosis3MENINGO,$ref1MENINGO,$ref2MENINGO,$obMENINGO,$dosis1HPV,$dosis2HPV,$dosis3HPV,$ref1HPV,$ref2HPV,$obHPV,$dosis1FTIFO,$dosis2FTIFO,$dosis3FTIFO,$ref1FTIFO,$ref2FTIFO,$obFTIFO,$idPac,$dosis1DP,$dosis2DP,$dosis3DP,$ref1DP,$ref2DP,$obDP)
					{
						$vacuna=new Vacunas;
						$aux=$vacuna->Ejecutar("INSERT INTO tbl_vacunas (1dodpt_vacunas,2dodpt_vacunas,3dodpt_vacunas,1redpt_vacunas,2redpt_vacunas,obdpt_vacunas,1dopo_vacunas,2dopo_vacunas,3dopo_vacunas,1repo_vacunas,2repo_vacunas,obpo_vacunas,1dohib_vacunas,2dohib_vacunas,3dohib_vacunas,1rehib_vacunas,2rehib_vacunas,obhib_vacunas,1dohvb_vacunas,2dohvb_vacunas,3dohvb_vacunas,1rehvb_vacunas,2rehvb_vacunas,obhvb_vacunas,1doneumo_vacunas,2doneumo_vacunas,3doneumo_vacunas,1reneumo_vacunas,2reneumo_vacunas,obneumo_vacunas,1dorota_vacunas,2dorota_vacunas,3dorota_vacunas,1rerota_vacunas,2rerota_vacunas,obrota_vacunas,1dospr_vacunas,2dospr_vacunas,3dospr_vacunas,1respr_vacunas,2respr_vacunas,obspr_vacunas,1dovari_vacunas,2dovari_vacunas,3dovari_vacunas,1revari_vacunas,2revari_vacunas,obvari_vacunas,1dohva_vacunas,2dohva_vacunas,3dohva_vacunas,1rehva_vacunas,2rehva_vacunas,obhva_vacunas,1dofama_vacunas,2dofama_vacunas,3dofama_vacunas,1refama_vacunas,2refama_vacunas,obfama_vacunas,1doinflu_vacunas,2doinflu_vacunas,3doinflu_vacunas,1reinflu_vacunas,2reinflu_vacunas,obinflu_vacunas,1domeningo_vacunas,2domeningo_vacunas,3domeningo_vacunas,1remeningo_vacunas,2remeningo_vacunas,obmeningo_vacunas,1dohpv_vacunas,2dohpv_vacunas,3dohpv_vacunas,1rehpv_vacunas,2rehpv_vacunas,obhpv_vacunas,1doftifo_vacunas,2doftifo_vacunas,3doftifo_vacunas,1reftifo_vacunas,2reftifo_vacunas,obftifo_vacunas,est_vacunas,id_pac,1dodp_vacunas,2dodp_vacunas,3dodp_vacunas,1redp_vacunas,2redp_vacunas,obdp_vacunas) VALUES ('$dosis1DPT','$dosis2DPT','$dosis3DPT','$ref1DPT','$ref2DPT','$obDPT','$dosis1PO','$dosis2PO','$dosis3PO','$ref1PO','$ref2PO','$obPO','$dosis1HIB','$dosis2HIB','$dosis3HIB','$ref1HIB','$ref2HIB','$obHIB','$dosis1HVB','$dosis2HVB','$dosis3HVB','$ref1HVB','$ref2HVB','$obHVB','$dosis1NEUMO','$dosis2NEUMO','$dosis3NEUMO','$ref1NEUMO','$ref2NEUMO','$obNEUMO','$dosis1ROTA','$dosis2ROTA','$dosis3ROTA','$ref1ROTA','$ref2ROTA','$obROTA','$dosis1SPR','$dosis2SPR','$dosis3SPR','$ref1SPR','$ref2SPR','$obSPR','$dosis1VARI','$dosis2VARI','$dosis3VARI','$ref1VARI','$ref2VARI','$obVARI','$dosis1HVA','$dosis2HVA','$dosis3HVA','$ref1HVA','$ref2HVA','$obHVA','$dosis1FAMA','$dosis2FAMA','$dosis3FAMA','$ref1FAMA','$ref2FAMA','$obFAMA','$dosis1INFLU','$dosis2INFLU','$dosis3INFLU','$ref1INFLU','$ref2INFLU','$obINFLU','$dosis1MENINGO','$dosis2MENINGO','$dosis3MENINGO','$ref1MENINGO','$ref2MENINGO','$obMENINGO','$dosis1HPV','$dosis2HPV','$dosis3HPV','$ref1HPV','$ref2HPV','$obHPV','$dosis1FTIFO','$dosis2FTIFO','$dosis3FTIFO','$ref1FTIFO','$ref2FTIFO','$obFTIFO','A','$idPac','$dosis1DP','$dosis2DP','$dosis3DP','$ref1DP','$ref2DP','$obDP') ");

						$idvacunas=$vacuna->Consultar("SELECT MAX(id_vacunas) FROM tbl_vacunas");
						$fechavac=$this->Mifecha();
						if($dosis1DPT=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1DPT');");
						}
						if($dosis2DPT=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2DPT');");
						}
						if($dosis3DPT=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3DPT');");
						}
						if($ref1DPT=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1DPT');");
						}
						if($ref2DPT=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2DPT');");
						}
						if($dosis1PO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1PO');");
						}
						if($dosis2PO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2PO');");
						}
						if($dosis3PO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3PO');");
						}
						if($ref1PO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1PO');");
						}
						if($ref2PO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2PO');");
						}
						if($dosis1HIB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1HIB');");
						}
						if($dosis2HIB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2HIB');");
						}
						if($dosis3HIB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3HIB');");
						}
						if($ref1HIB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1HIB');");
						}
						if($ref2HIB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2HIB');");
						}
						if($dosis1HVB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1HVB');");
						}
						if($dosis2HVB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2HVB');");
						}
						if($dosis3HVB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3HVB');");
						}
						if($ref1HVB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1HVB');");
						}
						if($ref2HVB=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2HVB');");
						}
						if($dosis1NEUMO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1NEUMO');");
						}
						if($dosis2NEUMO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2NEUMO');");
						}
						if($dosis3NEUMO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3NEUMO');");
						}
						if($ref1NEUMO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1NEUMO');");
						}
						if($ref2NEUMO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2NEUMO');");
						}
						if($dosis1ROTA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1ROTA');");
						}
						if($dosis2ROTA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2ROTA');");
						}
						if($dosis3ROTA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3ROTA');");
						}
						if($ref1ROTA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1ROTA');");
						}
						if($ref2ROTA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2ROTA');");
						}
						if($dosis1SPR=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1SPR');");
						}
						if($dosis2SPR=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2SPR');");
						}
						if($dosis3SPR=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3SPR');");
						}
						if($ref1SPR=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1SPR');");
						}
						if($ref2SPR=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2SPR');");
						}
						if($dosis1VARI=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1VARI');");
						}
						if($dosis2VARI=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2VARI');");
						}
						if($dosis3VARI=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3VARI');");
						}
						if($ref1VARI=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1VARI');");
						}
						if($ref2VARI=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2VARI');");
						}
						if($dosis1HVA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1HVA');");
						}
						if($dosis2HVA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2HVA');");
						}
						if($dosis3HVA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3HVA');");
						}
						if($ref1HVA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1HVA');");
						}
						if($ref2HVA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2HVA');");
						}
						if($dosis1FAMA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1FAMA');");
						}
						if($dosis2FAMA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2FAMA');");
						}
						if($dosis3FAMA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3FAMA');");
						}
						if($ref1FAMA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1FAMA');");
						}
						if($ref2FAMA=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2FAMA');");
						}
						if($dosis1INFLU=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1INFLU');");
						}
						if($dosis2INFLU=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2INFLU');");
						}
						if($dosis3INFLU=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3INFLU');");
						}
						if($ref1INFLU=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1INFLU');");
						}
						if($ref2INFLU=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2INFLU');");
						}
						if($dosis1MENINGO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1MENINGO');");
						}
						if($dosis2MENINGO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2MENINGO');");
						}
						if($dosis3MENINGO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3MENINGO');");
						}
						if($ref1MENINGO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1MENINGO');");
						}
						if($ref2MENINGO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2MENINGO');");
						}
						if($dosis1HPV=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1HPV');");
						}
						if($dosis2HPV=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2HPV');");
						}
						if($dosis3HPV=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3HPV');");
						}
						if($ref1HPV=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1HPV');");
						}
						if($ref2HPV=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2HPV');");
						}
						if($dosis1FTIFO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1FTIFO');");
						}
						if($dosis2FTIFO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2FTIFO');");
						}
						if($dosis3FTIFO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3FTIFO');");
						}
						if($ref1FTIFO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1FTIFO');");
						}
						if($ref2FTIFO=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2FTIFO');");
						}
						if($dosis1DP=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis1DP');");
						}
						if($dosis2DP=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis2DP');");
						}
						if($dosis3DP=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','dosis3DP');");
						}
						if($ref1DP=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref1DP');");
						}
						if($ref2DP=="true")
						{
							$vacuna->Ejecutar("INSERT INTO tbl_referenciavacunas (id_vac,fecha_refvac,refevac_refvac) VALUES ('$idvacunas','$fechavac','ref2DP');");
						}

						echo "<h3>Los datos han sido guardados correctamente</h3>";
					}
	//end function para guardar las vacunas

	//start function para cargar los datos guardados en vacunas
					public function LOadAllVacunas($idPac)
					{
						$aux=new Vacunas;
						if($aux->Consultar("SELECT COUNT(*) FROM tbl_vacunas WHERE id_pac='$idPac'")==0)
						{
							echo "
							<table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td width='83'>BCG</td> <td width='35'>1° D</td> <td width='32'>2° D</td> <td width='33'>3° D</td> <td width='32'>1° R</td> <td width='38'>2° R</td> <td width='200'>OBSERVACIONES</td> </tr> <tr> <td>DPT</td> <td><input type='checkbox' class='chkVacunas' id='1DoDPT'></td> <td><input type='checkbox' class='chkVacunas' id='2DoDPT'></td> <td><input type='checkbox' class='chkVacunas' id='3DoDPT'></td> <td><input type='checkbox' class='chkVacunas' id='1ReDPT'></td> <td><input type='checkbox' class='chkVacunas' id='2ReDPT'></td> <td><textarea id='txtObDPT' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>Polio</td> <td><input type='checkbox' class='chkVacunas' id='1DoPo'></td> <td><input type='checkbox' class='chkVacunas' id='2DoPo'></td> <td><input type='checkbox' class='chkVacunas' id='3DoPo'></td> <td><input type='checkbox' class='chkVacunas' id='1RePo'></td> <td><input type='checkbox' class='chkVacunas' id='2RePo'></td> <td><textarea id='txtObPo' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>HiB</td> <td><input type='checkbox' class='chkVacunas' id='1DoHiB'></td> <td><input type='checkbox' class='chkVacunas' id='2DoHiB'></td> <td><input type='checkbox' class='chkVacunas' id='3DoHiB'></td> <td><input type='checkbox' class='chkVacunas' id='1ReHiB'></td> <td><input type='checkbox' class='chkVacunas' id='2ReHiB'></td> <td><textarea id='txtObHiB' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>HvB</td> <td><input type='checkbox' class='chkVacunas' id='1DoHvB'></td> <td><input type='checkbox' class='chkVacunas' id='2DoHvB'></td> <td><input type='checkbox' class='chkVacunas' id='3DoHvB'></td> <td><input type='checkbox' class='chkVacunas' id='1ReHvB'></td> <td><input type='checkbox' class='chkVacunas' id='2ReHvB'></td> <td><textarea id='txtObHvB' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>Neumococo</td> <td><input type='checkbox' class='chkVacunas' id='1DoNeumo'></td> <td><input type='checkbox' class='chkVacunas' id='2DoNeumo'></td> <td><input type='checkbox' class='chkVacunas' id='3DoNeumo'></td> <td><input type='checkbox' class='chkVacunas' id='1ReNeumo'></td> <td><input type='checkbox' class='chkVacunas' id='2ReNeumo'></td> <td><textarea id='txtObNeumo' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>Rotavirus</td> <td><input type='checkbox' class='chkVacunas' id='1DoRota'></td> <td><input type='checkbox' class='chkVacunas' id='2DoRota'></td> <td><input type='checkbox' class='chkVacunas' id='3DoRota'></td> <td><input type='checkbox' class='chkVacunas' id='1ReRota'></td> <td><input type='checkbox' class='chkVacunas' id='2ReRota'></td> <td><textarea id='txtObRota' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>SPR</td> <td><input type='checkbox' class='chkVacunas' id='1DoSPR'></td> <td><input type='checkbox' class='chkVacunas' id='2DoSPR'></td> <td><input type='checkbox' class='chkVacunas' id='3DoSPR'></td> <td><input type='checkbox' class='chkVacunas' id='1ReSPR'></td> <td><input type='checkbox' class='chkVacunas' id='2ReSPR'></td> <td><textarea id='txtObSPR' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>Varicela</td> <td><input type='checkbox' class='chkVacunas' id='1DoVari'></td> <td><input type='checkbox' class='chkVacunas' id='2DoVari'></td> <td><input type='checkbox' class='chkVacunas' id='3DoVari'></td> <td><input type='checkbox' class='chkVacunas' id='1ReVari'></td> <td><input type='checkbox' class='chkVacunas' id='2ReVari'></td> <td><textarea id='txtObVari' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>HvA</td> <td><input type='checkbox' class='chkVacunas' id='1DoHvA'></td> <td><input type='checkbox' class='chkVacunas' id='2DoHvA'></td> <td><input type='checkbox' class='chkVacunas' id='3DoHvA'></td> <td><input type='checkbox' class='chkVacunas' id='1ReHvA'></td> <td><input type='checkbox' class='chkVacunas' id='2ReHvA'></td> <td><textarea id='txtObHvA' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>F. Amarilla</td> <td><input type='checkbox' class='chkVacunas' id='1DoFAma'></td> <td><input type='checkbox' class='chkVacunas' id='2DoFAma'></td> <td><input type='checkbox' class='chkVacunas' id='3DoFAma'></td> <td><input type='checkbox' class='chkVacunas' id='1ReFAma'></td> <td><input type='checkbox' class='chkVacunas' id='2ReFAma'></td> <td><textarea id='txtObFAma' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>Influenza</td> <td><input type='checkbox' class='chkVacunas' id='1DoInflu'></td> <td><input type='checkbox' class='chkVacunas' id='2DoInflu'></td> <td><input type='checkbox' class='chkVacunas' id='3DoInflu'></td> <td><input type='checkbox' class='chkVacunas' id='1ReInflu'></td> <td><input type='checkbox' class='chkVacunas' id='2ReInflu'></td> <td><textarea id='txtObInflu' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>Meningococo</td> <td><input type='checkbox' class='chkVacunas' id='1DoMeningo'></td> <td><input type='checkbox' class='chkVacunas' id='2DoMeningo'></td> <td><input type='checkbox' class='chkVacunas' id='3DoMeningo'></td> <td><input type='checkbox' class='chkVacunas' id='1ReMeningo'></td> <td><input type='checkbox' class='chkVacunas' id='2ReMeningo'></td> <td><textarea id='txtObMeningo' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>HPV</td> <td><input type='checkbox' class='chkVacunas' id='1DoHPV'></td> <td><input type='checkbox' class='chkVacunas' id='2DoHPV'></td> <td><input type='checkbox' class='chkVacunas' id='3DoHPV'></td> <td><input type='checkbox' class='chkVacunas' id='1ReHPV'></td> <td><input type='checkbox' class='chkVacunas' id='2ReHPV'></td> <td><textarea id='txtObHPV' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>DP</td> <td><input type='checkbox' class='chkVacunas' id='1DoDP'></td> <td><input type='checkbox' class='chkVacunas' id='2DoDP'></td> <td><input type='checkbox' class='chkVacunas' id='3DoDP'></td> <td><input type='checkbox' class='chkVacunas' id='1ReDP'></td> <td><input type='checkbox' class='chkVacunas' id='2ReDP'></td> <td><textarea id='txtObDP' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td>F. Tifoidea</td> <td><input type='checkbox' class='chkVacunas' id='1DoFTifo'></td> <td><input type='checkbox' class='chkVacunas' id='2DoFTifo'></td> <td><input type='checkbox' class='chkVacunas' id='3DoFTifo'></td> <td><input type='checkbox' class='chkVacunas' id='1ReFTifo'></td> <td><input type='checkbox' class='chkVacunas' id='2ReFTifo'></td> <td><textarea id='txtObFTifo' cols='40' rows='2' style='width:200px'></textarea></td> </tr> <tr> <td colspan='7'><center><input type='button' id='bntGuardarVacunas' style='width:100px;' class='btn btn-primary'  onclick='SaveVacunas()' value='Guardar'></center></td> </tr> </table>";
						}
						else
						{
							$codVac=$aux->Consultar("SELECT MAX(id_vacunas) FROM tbl_vacunas WHERE id_pac='$idPac'");
							$datos=$aux->Consultar_Vacunas("SELECT * FROM tbl_vacunas WHERE id_vacunas='$codVac'");
							foreach($datos as $fila)
							{
								echo "
								<table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td width='83'>BCG</td> <td width='35'>1° D</td> <td width='32'>2° D</td> <td width='33'>3° D</td> <td width='32'>1° R</td> <td width='38'>2° R</td> <td width='200'>OBSERVACIONES</td> </tr> <tr> <td>DPT</td> <td> ";
									if($fila['1dodpt_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1DPT'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoDPT' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoDPT' ></td>";
									}
									echo "<td> ";
									if($fila['2dodpt_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2DPT'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoDPT' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoDPT'></td>";
									}
									echo "<td> ";
									if($fila['3dodpt_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3DPT'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoDPT' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoDPT'></td>";
									}
									echo "<td> ";
									if($fila['1redpt_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1DPT'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReDPT' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReDPT'></td>";
									}
									echo "<td> ";
									if($fila['2redpt_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2DPT'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReDPT' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReDPT'></td>";
									}
									echo "<td><textarea id='txtObDPT' cols='40' rows='2' style='width:200px'>$fila[obdpt_vacunas]</textarea></td> </tr> <tr> <td>Polio</td> <td> ";
									if($fila['1dopo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1PO'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoPo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoPo'></td>";
									}
									echo "<td> ";
									if($fila['2dopo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2PO'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoPo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoPo'></td>";
									}
									echo "<td> ";
									if($fila['3dopo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3PO'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoPo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoPo'></td>";
									}
									echo "<td> ";
									if($fila['1repo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1PO'");
										echo "<input type='checkbox' class='chkVacunas' id='1RePo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1RePo'></td>";
									}
									echo "<td> ";
									if($fila['2repo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2PO'");
										echo "<input type='checkbox' class='chkVacunas' id='2RePo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2RePo'></td>";
									}
									echo "<td><textarea id='txtObPo' cols='40' rows='2' style='width:200px'>$fila[obpo_vacunas]</textarea></td> </tr> <tr> <td>HiB</td> <td> ";
									if($fila['1dohib_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1HIB'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoHiB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoHiB'></td>";
									}
									echo "<td> ";
									if($fila['2dohib_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2HIB'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoHiB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoHiB'></td>";
									}
									echo "<td> ";
									if($fila['3dohib_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3HIB'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoHiB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoHiB'></td>";
									}
									echo "<td> ";
									if($fila['1rehib_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1HIB'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReHiB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReHiB'></td>";
									}
									echo "<td> ";
									if($fila['2rehib_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2HIB'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReHiB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReHiB'></td>";
									}
									echo "<td><textarea id='txtObHiB' cols='40' rows='2' style='width:200px'>$fila[obhib_vacunas]</textarea></td> </tr> <tr> <td>HvB</td> <td> ";
									if($fila['1dohvb_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1HVB'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoHvB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoHvB'></td>";
									}
									echo "<td> ";
									if($fila['2dohvb_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2HVB'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoHvB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoHvB'></td>";
									}
									echo "<td> ";
									if($fila['3dohvb_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3HVB'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoHvB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoHvB'></td>";
									}
									echo "<td> ";
									if($fila['1rehvb_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1HVB'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReHvB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReHvB'></td>";
									}
									echo "<td> ";
									if($fila['2rehvb_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2HVB'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReHvB' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReHvB'></td>";
									}
									echo "<td><textarea id='txtObHvB' cols='40' rows='2' style='width:200px'>$fila[obhvb_vacunas]</textarea></td> </tr> <tr> <td>Neumococo</td> <td> ";
									if($fila['1doneumo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1NEUMO'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoNeumo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoNeumo'></td>";
									}
									echo "<td> ";
									if($fila['2doneumo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2NEUMO'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoNeumo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoNeumo'></td>";
									}
									echo "<td> ";
									if($fila['3doneumo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3NEUMO'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoNeumo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoNeumo'></td>";
									}
									echo "<td> ";
									if($fila['1reneumo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1NEUMO'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReNeumo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReNeumo'></td>";
									}
									echo "<td> ";
									if($fila['2reneumo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2NEUMO'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReNeumo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReNeumo'></td>";
									}
									echo "<td><textarea id='txtObNeumo' cols='40' rows='2' style='width:200px'>$fila[obneumo_vacunas]</textarea></td> </tr> <tr> <td>Rotavirus</td> <td> ";
									if($fila['1dorota_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1ROTA'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoRota' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoRota'></td>";
									}
									echo "<td> ";
									if($fila['2dorota_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2ROTA'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoRota' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoRota'></td>";
									}
									echo "<td> ";
									if($fila['3dorota_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3ROTA'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoRota' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoRota'></td>";
									}
									echo "<td> ";
									if($fila['1rerota_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1ROTA'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReRota' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReRota'></td>";
									}
									echo "<td> ";
									if($fila['2rerota_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2ROTA'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReRota' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReRota'></td>";
									}
									echo "<td><textarea id='txtObRota' cols='40' rows='2' style='width:200px'>$fila[obrota_vacunas]</textarea></td> </tr> <tr> <td>SPR</td> <td> ";
									if($fila['1dospr_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1SPR'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoSPR' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoSPR'></td>";
									}
									echo "<td> ";
									if($fila['2dospr_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2SPR'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoSPR' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoSPR'></td>";
									}
									echo "<td> ";
									if($fila['3dospr_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3SPR'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoSPR' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoSPR'></td>";
									}
									echo "<td> ";
									if($fila['1respr_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1SPR'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReSPR' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReSPR'></td>";
									}
									echo "<td> ";
									if($fila['2respr_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2SPR'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReSPR' checked='true' ><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReSPR'></td>";
									}
									echo "<td><textarea id='txtObSPR' cols='40' rows='2' style='width:200px'>$fila[obspr_vacunas]</textarea></td> </tr> <tr> <td>Varicela</td> <td> ";
									if($fila['1dovari_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1VARI'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoVari' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoVari'></td>";
									}
									echo "<td> ";
									if($fila['2dovari_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2VARI'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoVari' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoVari'></td>";
									}
									echo "<td> ";
									if($fila['3dovari_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3VARI'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoVari' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoVari'></td>";
									}
									echo "<td> ";
									if($fila['1revari_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1VARI'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReVari' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReVari'></td>";
									}
									echo "<td> ";
									if($fila['2revari_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2VARI'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReVari' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReVari'></td>";
									}
									echo "<td><textarea id='txtObVari' cols='40' rows='2' style='width:200px'>$fila[obvari_vacunas]</textarea></td> </tr> <tr> <td>HvA</td> <td> ";
									if($fila['1dohva_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1HVA'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoHvA' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoHvA'></td>";
									}
									echo "<td> ";
									if($fila['2dohva_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2HVA'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoHvA' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoHvA'></td>";
									}
									echo "<td> ";
									if($fila['3dohva_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3HVA'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoHvA' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoHvA'></td>";
									}
									echo "<td> ";
									if($fila['1rehva_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1HVA'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReHvA' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReHvA'></td>";
									}
									echo "<td> ";
									if($fila['2rehva_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2HVA'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReHvA' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReHvA'></td>";
									}
									echo "<td><textarea id='txtObHvA' cols='40' rows='2' style='width:200px'>$fila[obhva_vacunas]</textarea></td> </tr> <tr> <td>F. Amarilla</td> <td> ";
									if($fila['1dofama_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1FAMA'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoFAma' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoFAma'></td>";
									}
									echo "<td> ";
									if($fila['2dofama_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2FAMA'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoFAma' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoFAma'></td>";
									}
									echo "<td> ";
									if($fila['3dofama_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3FAMA'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoFAma' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoFAma'></td>";
									}
									echo "<td> ";
									if($fila['1refama_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1FAMA'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReFAma' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReFAma'></td>";
									}
									echo "<td> ";
									if($fila['2refama_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2FAMA'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReFAma' checked='true'></td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReFAma'></td>";
									}
									echo "<td><textarea id='txtObFAma' cols='40' rows='2' style='width:200px'>$fila[obfama_vacunas]</textarea></td> </tr> <tr> <td>Influenza</td> <td> ";
									if($fila['1doinflu_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1INFLU'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoInflu' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoInflu'></td>";
									}
									echo "<td> ";
									if($fila['2doinflu_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2INFLU'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoInflu' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoInflu'></td>";
									}
									echo "<td> ";
									if($fila['3doinflu_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3INFLU'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoInflu' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoInflu'></td>";
									}
									echo "<td> ";
									if($fila['1reinflu_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1INFLU'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReInflu' checked='true'></td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReInflu'></td>";
									}
									echo "<td> ";
									if($fila['2reinflu_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2INFLU'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReInflu' checked='true'></td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReInflu'></td>";
									}
									echo "<td><textarea id='txtObInflu' cols='40' rows='2' style='width:200px'>$fila[obinflu_vacunas]</textarea></td> </tr> <tr> <td>Meningococo</td> <td> ";
									if($fila['1domeningo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1MENINGO'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoMeningo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoMeningo'></td>";
									}
									echo "<td> ";
									if($fila['2domeningo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2MENINGO'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoMeningo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoMeningo'></td>";
									}
									echo "<td> ";
									if($fila['3domeningo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3MENINGO'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoMeningo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoMeningo'></td>";
									}
									echo "<td> ";
									if($fila['1remeningo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1MENINGO'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReMeningo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReMeningo'></td>";
									}
									echo "<td> ";
									if($fila['2remeningo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2MENINGO'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReMeningo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReMeningo'></td>";
									}
									echo "<td><textarea id='txtObMeningo' cols='40' rows='2' style='width:200px'>$fila[obmeningo_vacunas]</textarea></td> </tr> <tr> <td>HPV</td> <td> ";
									if($fila['1dohpv_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1HPV'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoHPV' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoHPV'></td>";
									}
									echo "<td> ";
									if($fila['2dohpv_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2HPV'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoHPV' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoHPV'></td>";
									}
									echo "<td> ";
									if($fila['3dohpv_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3HPV'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoHPV' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoHPV'></td>";
									}
									echo "<td> ";
									if($fila['1rehpv_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1HPV'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReHPV' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReHPV'></td>";
									}
									echo "<td> ";
									if($fila['2rehpv_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2HPV'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReHPV' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReHPV'></td>";
									}
									echo "<td><textarea id='txtObHPV' cols='40' rows='2' style='width:200px'>$fila[obhpv_vacunas]</textarea></td> </tr> <tr> <td>DP</td> <td> ";
									if($fila['1dodp_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1DP'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoDP' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoDP'></td>";
									}
									echo "<td> ";
									if($fila['2dodp_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2DP'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoDP' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoDP'></td>";
									}
									echo "<td> ";
									if($fila['3dodp_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3DP'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoDP' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoDP'></td>";
									}
									echo "<td> ";
									if($fila['1redp_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1DP'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReDP' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReDP'></td>";
									}
									echo "<td> ";
									if($fila['2redp_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2DP'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReDP' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReDP'></td>";
									}
									echo "<td><textarea id='txtObDP' cols='40' rows='2' style='width:200px'>$fila[obdp_vacunas]</textarea></td> </tr> <tr> <td>F. Tifoidea</td> <td> ";
									if($fila['1doftifo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis1FTIFO'");
										echo "<input type='checkbox' class='chkVacunas' id='1DoFTifo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1DoFTifo'></td>";
									}
									echo "<td> ";
									if($fila['2doftifo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis2FTIFO'");
										echo "<input type='checkbox' class='chkVacunas' id='2DoFTifo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2DoFTifo'></td>";
									}
									echo "<td> ";
									if($fila['3doftifo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'dosis3FTIFO'");
										echo "<input type='checkbox' class='chkVacunas' id='3DoFTifo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='3DoFTifo'></td>";
									}
									echo "<td> ";
									if($fila['1reftifo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref1FTIFO'");
										echo "<input type='checkbox' class='chkVacunas' id='1ReFTifo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='1ReFTifo'></td>";
									}
									echo "<td> ";
									if($fila['2reftifo_vacunas']=="true")
									{
										$fechava=$aux->Consultar("SELECT fecha_refvac FROM tbl_referenciavacunas WHERE id_vac = '$codVac' AND refevac_refvac = 'ref2FTIFO'");
										echo "<input type='checkbox' class='chkVacunas' id='2ReFTifo' checked='true'><p>$fechava</td>";
									}
									else
									{
										echo "<input type='checkbox' class='chkVacunas' id='2ReFTifo'></td>";
									}
									echo "<td><textarea id='txtObFTifo' cols='40' rows='2' style='width:200px'>$fila[obftifo_vacunas]</textarea></td> </tr> <tr> <td colspan='7'><center><input type='button' id='bntGuardarVacunas' style='width:100px;' class='btn btn-primary'  onclick='SaveVacunas()' value='Guardar'></center></td> </tr> </table>";
								}
							}
						}
	//end function para cargar los datos guardados en vacunas

//inicio funcion para guardar el consentimiento informado de representante
						public function SaveConsenInfoRep($NombreRep,$Paren,$Telef,$Ced,$InstSis,$Uniop,$Coduo,$Parroq,$Cant,$Prov,$NumeroHi,$ApMaterno,$ApPaterno,$NombresCom,$Servicio,$Sala,$Cama,$Fecha,$Hora,$codPac,$CodTurno)
						{
							$consenrep=new ConsenRep;
							$consenrep->Ejecutar("INSERT INTO tbl_consenrepresentante (nrep_cir,pare_cir,tel_cir,ced_cir,insts_cir,unip_cir,codu_cir,parr_cir,can_cir,pro_cir,nuh_cir,apm_cir,app_cir,nom_cir,ser_cir,sal_cir,cam_cir,fech_cir,hor_cir,est_cir,id_pac,id_tu) VALUES ('$NombreRep','$Paren','$Telef','$Ced','$InstSis','$Uniop','$Coduo','$Parroq','$Cant','$Prov','$NumeroHi','$ApMaterno','$ApPaterno','$NombresCom','$Servicio','$Sala','$Cama','$Fecha','$Hora','A','$codPac','$CodTurno')");
							echo "<h3>Los datos se han guardado correctamente</h3>";
						}
//fin funcion para guardar el consentimiento informado de representante



//guardar odontograma
						public function SaveOdontogramaLight($iduser,$tratamiento){
							$aux=new Odontograma3();
							$miarray=explode(";",$tratamiento);
							$contar= count($miarray)-2;

							for($x=0;$x<=$contar;$x++){
								$fecha=$this->Mifecha();
								$aux->Ejecutar("INSERT INTO tbl_odontograma3 (id_pac,tratamiento_od,fecha_od) VALUES('$iduser','".$miarray[$x]."','$fecha');");		
							}
							$datos =$aux->Consultar_Odontograma3("SELECT *  FROM tbl_odontograma3  WHERE id_pac='$iduser';");
							if(count($datos)>0){
								echo "<table class='table table-bordered table-striped table-hover table-condensed '>
								<tr>
									<th>Tratamiento</th>
									<th>Fecha</th>
								</tr>
								";
								foreach($datos as $fila){
									echo "
									<tr>
										<td>".$fila['tratamiento_od']."</td>
										<td>".utf8_decode($fila['fecha_od'])."</td>
									</tr>
									";
								}
								echo "</table>";
							}else{
								echo "<h3>El paciente no tiene datos o historial</h3>";
							}




						}

						public function LoadOdontograma3Light($idpaciente){
							$aux=new Odontograma3();
							$datos =$aux->Consultar_Odontograma3("SELECT *  FROM tbl_odontograma3  WHERE id_pac='$idpaciente';");
							if(count($datos)>0){
								echo "<table class='table table-bordered table-striped table-hover table-condensed '>
								<tr>
									<th>Tratamiento</th>
									<th>Fecha</th>
								</tr>
								";
								foreach($datos as $fila){
									echo "
									<tr>
										<td>".$fila['tratamiento_od']."</td>
										<td>".utf8_decode($fila['fecha_od'])."</td>
									</tr>
									";
								}
								echo "</table>";
							}else{
								echo "<h3>El paciente no tiene datos o historial</h3>";
							}
						}

//fin guardar odontograma	

						public function LoadOdontogramaLightV4($codpac){
							$odo=new OdontogramaDarwin;
							$contar=$odo->Consultar("SELECT COUNT(*) FROM tbl_odontogramadarwin WHERE person='$codpac';");
							if($contar==0){
								echo"

								<center>
									<table>
										<tr>
											<th>
												Tratamiento
											</th>
											<td>
												<select id='cmb_tratamiento'>
													<option value=''>--Seleccione--</option>
													<option value='1'>Prótesis Total Por Realizar</option>
													<option value='2'>Prótesis Removible Por Realizar</option>
													<option value='3'>Prótesis Fija Por Realizar</option>
													<option value='4'>Endodoncia Por Realizar</option>
													<option value='5'>Corona</option>
													<option value='6'>Prótesis Total Realizada</option>
													<option value='7'>Prótesis Removible Realizada</option>
													<option value='8'>Prótesis Fija Realizada</option>
													<option value='9'>Endodoncia Realizada</option>
													<option value='10'>Pérdida (Otra Causa)</option>
													<option value='11'>Pérdida Por Caries</option>
													<option value='12'>Extracción Indicada</option>
													<option value='13'>Sellante Realizado</option>
													<option value='14'>Sellante Necesario</option>
													<option value='15'>Caries</option>
													<option value='16'>Obturado</option>
												</select>

												<a class='btn btn-primary' onclick='SaveOdontogramaLight5()' id='btnSaveOdo'><i class='icon-file'></i> Guardar Odontograma</a>
											</td>
										</tr>
									</table>
									<table border='1'>
										<tr>

											<td>

												<table>
													<tr><td>&nbsp;</td></tr>
													<tr><td>Recesion</td></tr>
													<tr><td>Movilidad</td></tr>
													<tr><td>&nbsp;</td></tr>
													<tr><td>Vestibular</td></tr>
													<tr><td>&nbsp;</td></tr>
												</table>
											</td>



											<td>


												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>18</td></tr><tr><td colspan='3'><input type='text' id='txtdtre18' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo18' style='width:16px;'/></td></tr>  <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_18' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_18'/></td> <td><img src='resource/db.fw.png' id='dC_18'/></td> <td><img src='resource/db.fw.png' id='dD_18'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_18'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_18'></td></tr>
												</table>

											</td>




											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>17</td></tr><tr><td colspan='3'><input type='text' id='txtdtre17' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo17' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_17' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_17'/></td> <td><img src='resource/db.fw.png' id='dC_17'/></td> <td><img src='resource/db.fw.png' id='dD_17'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_17'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_17'></td></tr>
												</table>				

											</td>			



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>16</td></tr><tr><td colspan='3'><input type='text' id='txtdtre16' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo16' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_16' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_16'/></td> <td><img src='resource/db.fw.png' id='dC_16'/></td> <td><img src='resource/db.fw.png' id='dD_16'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_16'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_16'></td></tr>
												</table>				

											</td>	



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>15</td></tr><tr><td colspan='3'><input type='text' id='txtdtre15' style='width:15px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo15' style='width:15px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_15' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_15'/></td> <td><img src='resource/db.fw.png' id='dC_15'/></td> <td><img src='resource/db.fw.png' id='dD_15'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_15'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_15'></td></tr>
												</table>				

											</td>	


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>14</td></tr><tr><td colspan='3'><input type='text' id='txtdtre14' style='width:14px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo14' style='width:14px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_14' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_14'/></td> <td><img src='resource/db.fw.png' id='dC_14'/></td> <td><img src='resource/db.fw.png' id='dD_14'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_14'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_14'></td></tr>
												</table>				

											</td>	


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>13</td></tr><tr><td colspan='3'><input type='text' id='txtdtre13' style='width:13px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo13' style='width:13px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_13' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_13'/></td> <td><img src='resource/db.fw.png' id='dC_13'/></td> <td><img src='resource/db.fw.png' id='dD_13'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_13'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_13'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>12</td></tr><tr><td colspan='3'><input type='text' id='txtdtre12' style='width:12px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo12' style='width:12px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_12' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_12'/></td> <td><img src='resource/db.fw.png' id='dC_12'/></td> <td><img src='resource/db.fw.png' id='dD_12'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_12'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_12'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>11</td></tr><tr><td colspan='3'><input type='text' id='txtdtre11' style='width:11px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo11' style='width:11px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_11' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_11'/></td> <td><img src='resource/db.fw.png' id='dC_11'/></td> <td><img src='resource/db.fw.png' id='dD_11'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_11'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_11'></td></tr>
												</table>				

											</td>	

											<td colspan='3'>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											</td>		";

											echo "


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>21</td></tr><tr><td colspan='3'><input type='text' id='txtdtre21' style='width:21px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo21' style='width:21px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_21' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_21'/></td> <td><img src='resource/db.fw.png' id='dC_21'/></td> <td><img src='resource/db.fw.png' id='dD_21'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_21'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_21'></td></tr>
												</table>				

											</td>	


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>22</td></tr><tr><td colspan='3'><input type='text' id='txtdtre22' style='width:22px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo22' style='width:22px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_22' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_22'/></td> <td><img src='resource/db.fw.png' id='dC_22'/></td> <td><img src='resource/db.fw.png' id='dD_22'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_22'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_22'></td></tr>
												</table>				

											</td>	



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>23</td></tr><tr><td colspan='3'><input type='text' id='txtdtre23' style='width:23px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo23' style='width:23px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_23' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_23'/></td> <td><img src='resource/db.fw.png' id='dC_23'/></td> <td><img src='resource/db.fw.png' id='dD_23'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_23'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_23'></td></tr>
												</table>				

											</td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>24</td></tr><tr><td colspan='3'><input type='text' id='txtdtre24' style='width:24px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo24' style='width:24px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_24' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_24'/></td> <td><img src='resource/db.fw.png' id='dC_24'/></td> <td><img src='resource/db.fw.png' id='dD_24'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_24'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_24'></td></tr>
												</table>				

											</td>											


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>25</td></tr><tr><td colspan='3'><input type='text' id='txtdtre25' style='width:25px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo25' style='width:25px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_25' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_25'/></td> <td><img src='resource/db.fw.png' id='dC_25'/></td> <td><img src='resource/db.fw.png' id='dD_25'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_25'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_25'></td></tr>
												</table>				

											</td>	


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>26</td></tr><tr><td colspan='3'><input type='text' id='txtdtre26' style='width:26px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo26' style='width:26px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_26' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_26'/></td> <td><img src='resource/db.fw.png' id='dC_26'/></td> <td><img src='resource/db.fw.png' id='dD_26'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_26'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_26'></td></tr>
												</table>				

											</td>	


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>27</td></tr><tr><td colspan='3'><input type='text' id='txtdtre27' style='width:27px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo27' style='width:27px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_27' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_27'/></td> <td><img src='resource/db.fw.png' id='dC_27'/></td> <td><img src='resource/db.fw.png' id='dD_27'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_27'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_27'></td></tr>
												</table>				

											</td>																										



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>28</td></tr><tr><td colspan='3'><input type='text' id='txtdtre28' style='width:28px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo28' style='width:28px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_28' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_28'/></td> <td><img src='resource/db.fw.png' id='dC_28'/></td> <td><img src='resource/db.fw.png' id='dD_28'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_28'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_28'></td></tr>
												</table>				

											</td>																										


										</tr>




										";


										echo "
										<tr>

											<td rowspan='2'>
												Lingual
											</td>


											<td colspa='2'></td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>55</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_55' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_55'/></td> <td><img src='resource/db.fw.png' id='dC_55'/></td> <td><img src='resource/db.fw.png' id='dD_55'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_55'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_55'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>54</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_54' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_54'/></td> <td><img src='resource/db.fw.png' id='dC_54'/></td> <td><img src='resource/db.fw.png' id='dD_54'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_54'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_54'></td></tr>
												</table>				

											</td>																															


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>53</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_53' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_53'/></td> <td><img src='resource/db.fw.png' id='dC_53'/></td> <td><img src='resource/db.fw.png' id='dD_53'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_53'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_53'></td></tr>
												</table>				

											</td>




											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>52</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_52' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_52'/></td> <td><img src='resource/db.fw.png' id='dC_52'/></td> <td><img src='resource/db.fw.png' id='dD_52'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_52'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_52'></td></tr>
												</table>				

											</td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>51</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_51' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_51'/></td> <td><img src='resource/db.fw.png' id='dC_51'/></td> <td><img src='resource/db.fw.png' id='dD_51'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_51'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_51'></td></tr>
												</table>				

											</td>					

											<td colspan='7'>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											</td>						



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>61</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_61' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_61'/></td> <td><img src='resource/db.fw.png' id='dC_61'/></td> <td><img src='resource/db.fw.png' id='dD_61'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_61'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_61'></td></tr>
												</table>				

											</td>					



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>62</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_62' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_62'/></td> <td><img src='resource/db.fw.png' id='dC_62'/></td> <td><img src='resource/db.fw.png' id='dD_62'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_62'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_62'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>63</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_63' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_63'/></td> <td><img src='resource/db.fw.png' id='dC_63'/></td> <td><img src='resource/db.fw.png' id='dD_63'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_63'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_63'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>64</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_64' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_64'/></td> <td><img src='resource/db.fw.png' id='dC_64'/></td> <td><img src='resource/db.fw.png' id='dD_64'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_64'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_64'></td></tr>
												</table>				

											</td>	



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>65</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_65' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_65'/></td> <td><img src='resource/db.fw.png' id='dC_65'/></td> <td><img src='resource/db.fw.png' id='dD_65'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_65'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_65'></td></tr>
												</table>				

											</td>


										</tr>
										";

										echo "
										<tr>

											<td colspa='2'></td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>85</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_85' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_85'/></td> <td><img src='resource/db.fw.png' id='dC_85'/></td> <td><img src='resource/db.fw.png' id='dD_85'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_85'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_85'></td></tr>
												</table>				

											</td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>84</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_84' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_84'/></td> <td><img src='resource/db.fw.png' id='dC_84'/></td> <td><img src='resource/db.fw.png' id='dD_84'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_84'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_84'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>83</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_83' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_83'/></td> <td><img src='resource/db.fw.png' id='dC_83'/></td> <td><img src='resource/db.fw.png' id='dD_83'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_83'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_83'></td></tr>
												</table>				

											</td>					


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>82</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_82' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_82'/></td> <td><img src='resource/db.fw.png' id='dC_82'/></td> <td><img src='resource/db.fw.png' id='dD_82'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_82'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_82'></td></tr>
												</table>				

											</td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>81</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_81' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_81'/></td> <td><img src='resource/db.fw.png' id='dC_81'/></td> <td><img src='resource/db.fw.png' id='dD_81'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_81'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_81'></td></tr>
												</table>				

											</td>					




											<td colspan='7'>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											</td>						


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>71</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_71' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_71'/></td> <td><img src='resource/db.fw.png' id='dC_71'/></td> <td><img src='resource/db.fw.png' id='dD_71'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_71'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_71'></td></tr>
												</table>				

											</td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>72</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_72' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_72'/></td> <td><img src='resource/db.fw.png' id='dC_72'/></td> <td><img src='resource/db.fw.png' id='dD_72'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_72'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_72'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>73</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_73' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_73'/></td> <td><img src='resource/db.fw.png' id='dC_73'/></td> <td><img src='resource/db.fw.png' id='dD_73'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_73'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_73'></td></tr>
												</table>				

											</td>					



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>74</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_74' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_74'/></td> <td><img src='resource/db.fw.png' id='dC_74'/></td> <td><img src='resource/db.fw.png' id='dD_74'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_74'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_74'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>75</td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_75' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_75'/></td> <td><img src='resource/db.fw.png' id='dC_75'/></td> <td><img src='resource/db.fw.png' id='dD_75'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_75'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_75'></td></tr>
												</table>				

											</td>										




										</tr>			
										";
			//hola
										echo "
										<tr>

											<td>

												<table>
													<tr><td>&nbsp;</td></tr>
													<tr><td>Recesion</td></tr>
													<tr><td>Movilidad</td></tr>
													<tr><td>&nbsp;</td></tr>
													<tr><td>Vestibular</td></tr>
													<tr><td>&nbsp;</td></tr>
												</table>
											</td>

											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>48</td></tr><tr><td colspan='3'><input type='text' id='txtdtre48' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo48' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_48' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_48'/></td> <td><img src='resource/db.fw.png' id='dC_48'/></td> <td><img src='resource/db.fw.png' id='dD_48'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_48'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_48'></td></tr>
												</table>				

											</td>

											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>47</td></tr><tr><td colspan='3'><input type='text' id='txtdtre47' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo47' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_47' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_47'/></td> <td><img src='resource/db.fw.png' id='dC_47'/></td> <td><img src='resource/db.fw.png' id='dD_47'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_47'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_47'></td></tr>
												</table>				

											</td>	

											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>46</td></tr><tr><td colspan='3'><input type='text' id='txtdtre46' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo46' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_46' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_46'/></td> <td><img src='resource/db.fw.png' id='dC_46'/></td> <td><img src='resource/db.fw.png' id='dD_46'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_46'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_46'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>45</td></tr><tr><td colspan='3'><input type='text' id='txtdtre45' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo45' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_45' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_45'/></td> <td><img src='resource/db.fw.png' id='dC_45'/></td> <td><img src='resource/db.fw.png' id='dD_45'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_45'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_45'></td></tr>
												</table>				

											</td>	


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>44</td></tr><tr><td colspan='3'><input type='text' id='txtdtre44' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo44' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_44' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_44'/></td> <td><img src='resource/db.fw.png' id='dC_44'/></td> <td><img src='resource/db.fw.png' id='dD_44'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_44'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_44'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>43</td></tr><tr><td colspan='3'><input type='text' id='txtdtre43' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo43' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_43' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_43'/></td> <td><img src='resource/db.fw.png' id='dC_43'/></td> <td><img src='resource/db.fw.png' id='dD_43'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_43'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_43'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>42</td></tr><tr><td colspan='3'><input type='text' id='txtdtre42' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo42' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_42' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_42'/></td> <td><img src='resource/db.fw.png' id='dC_42'/></td> <td><img src='resource/db.fw.png' id='dD_42'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_42'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_42'></td></tr>
												</table>				

											</td>

											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>41</td></tr><tr><td colspan='3'><input type='text' id='txtdtre41' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo41' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_41' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_41'/></td> <td><img src='resource/db.fw.png' id='dC_41'/></td> <td><img src='resource/db.fw.png' id='dD_41'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_41'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_41'></td></tr>
												</table>				

											</td>	





											<td colspan='3'>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

											</td>			







											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>31</td></tr><tr><td colspan='3'><input type='text' id='txtdtre31' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo31' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_31' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_31'/></td> <td><img src='resource/db.fw.png' id='dC_31'/></td> <td><img src='resource/db.fw.png' id='dD_31'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_31'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_31'></td></tr>
												</table>				

											</td>




											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>32</td></tr><tr><td colspan='3'><input type='text' id='txtdtre32' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo32' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_32' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_32'/></td> <td><img src='resource/db.fw.png' id='dC_32'/></td> <td><img src='resource/db.fw.png' id='dD_32'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_32'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_32'></td></tr>
												</table>				

											</td>






											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>33</td></tr><tr><td colspan='3'><input type='text' id='txtdtre33' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo33' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_33' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_33'/></td> <td><img src='resource/db.fw.png' id='dC_33'/></td> <td><img src='resource/db.fw.png' id='dD_33'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_33'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_33'></td></tr>
												</table>				

											</td>







											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>34</td></tr><tr><td colspan='3'><input type='text' id='txtdtre34' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo34' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_34' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_34'/></td> <td><img src='resource/db.fw.png' id='dC_34'/></td> <td><img src='resource/db.fw.png' id='dD_34'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_34'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_34'></td></tr>
												</table>				

											</td>







											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>35</td></tr><tr><td colspan='3'><input type='text' id='txtdtre35' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo35' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_35' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_35'/></td> <td><img src='resource/db.fw.png' id='dC_35'/></td> <td><img src='resource/db.fw.png' id='dD_35'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_35'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_35'></td></tr>
												</table>				

											</td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>36</td></tr><tr><td colspan='3'><input type='text' id='txtdtre36' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo36' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_36' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_36'/></td> <td><img src='resource/db.fw.png' id='dC_36'/></td> <td><img src='resource/db.fw.png' id='dD_36'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_36'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_36'></td></tr>
												</table>				

											</td>



											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>37</td></tr><tr><td colspan='3'><input type='text' id='txtdtre37' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo37' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_37' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_37'/></td> <td><img src='resource/db.fw.png' id='dC_37'/></td> <td><img src='resource/db.fw.png' id='dD_37'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_37'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_37'></td></tr>
												</table>				

											</td>


											<td>
												<table cellpadding='0' cellspacing='0' border='1'><tr><td colspan='3'>38</td></tr><tr><td colspan='3'><input type='text' id='txtdtre38' style='width:16px;'/></td></tr><tr><td colspan='3'><input type='text' id='txtdMo38' style='width:16px;'/></td></tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ab' id='dA_38' /></td> <td>&nbsp;</td> </tr> <tr> <td><img src='resource/db.fw.png' id='dI_38'/></td> <td><img src='resource/db.fw.png' id='dC_38'/></td> <td><img src='resource/db.fw.png' id='dD_38'/></td> </tr> <tr> <td>&nbsp;</td> <td><img src='resource/db.fw.png' class='ar' id='daB_38'/></td> <td>&nbsp;</td> </tr> </table>

												<table>
													<tr><td id='_38'></td></tr>
												</table>				

											</td>








										</tr>


										";


										echo "</table>";

										echo"	<script type='text/javascript'>
										$('#dA_18').click(function(){
											var codigo=$('#txt_da_18').val(); 
											CambiarColorDientes(codigo,'txt_da_18','dA_18',1);      
										});
										$('#dD_18').click(function(){
											var codigo1=$('#txt_dd_18').val();  
											CambiarColorDientes(codigo1,'txt_dd_18','dD_18',2); 
										});
										$('#daB_18').click(function(){
											var codigo2=$('#txt_dab_18').val(); 
											CambiarColorDientes(codigo2,'txt_dab_18','daB_18',3); 
										});
										$('#dI_18').click(function(){
											var codigo3=$('#txt_di_18').val();  
											CambiarColorDientes(codigo3,'txt_di_18','dI_18',4); 
										});
										$('#dC_18').click(function(){
											var codigo4=$('#txt_dc_18').val();  
											CambiarColorDientes(codigo4,'txt_dc_18','dC_18',5); 
										});


										$('#dA_17').click(function(){
											var codigo=$('#txt_da_17').val(); 
											CambiarColorDientes(codigo,'txt_da_17','dA_17',1);      
										});
										$('#dD_17').click(function(){
											var codigo1=$('#txt_dd_17').val();  
											CambiarColorDientes(codigo1,'txt_dd_17','dD_17',2); 
										});
										$('#daB_17').click(function(){
											var codigo2=$('#txt_dab_17').val(); 
											CambiarColorDientes(codigo2,'txt_dab_17','daB_17',3); 
										});
										$('#dI_17').click(function(){
											var codigo3=$('#txt_di_17').val();  
											CambiarColorDientes(codigo3,'txt_di_17','dI_17',4); 
										});
										$('#dC_17').click(function(){
											var codigo4=$('#txt_dc_17').val();  
											CambiarColorDientes(codigo4,'txt_dc_17','dC_17',5); 
										});						





										$('#dA_16').click(function(){
											var codigo=$('#txt_da_16').val(); 
											CambiarColorDientes(codigo,'txt_da_16','dA_16',1);      
										});
										$('#dD_16').click(function(){
											var codigo1=$('#txt_dd_16').val();  
											CambiarColorDientes(codigo1,'txt_dd_16','dD_16',2); 
										});
										$('#daB_16').click(function(){
											var codigo2=$('#txt_dab_16').val(); 
											CambiarColorDientes(codigo2,'txt_dab_16','daB_16',3); 
										});
										$('#dI_16').click(function(){
											var codigo3=$('#txt_di_16').val();  
											CambiarColorDientes(codigo3,'txt_di_16','dI_16',4); 
										});
										$('#dC_16').click(function(){
											var codigo4=$('#txt_dc_16').val();  
											CambiarColorDientes(codigo4,'txt_dc_16','dC_16',5); 
										});	



										$('#dA_15').click(function(){
											var codigo=$('#txt_da_15').val(); 
											CambiarColorDientes(codigo,'txt_da_15','dA_15',1);      
										});
										$('#dD_15').click(function(){
											var codigo1=$('#txt_dd_15').val();  
											CambiarColorDientes(codigo1,'txt_dd_15','dD_15',2); 
										});
										$('#daB_15').click(function(){
											var codigo2=$('#txt_dab_15').val(); 
											CambiarColorDientes(codigo2,'txt_dab_15','daB_15',3); 
										});
										$('#dI_15').click(function(){
											var codigo3=$('#txt_di_15').val();  
											CambiarColorDientes(codigo3,'txt_di_15','dI_15',4); 
										});
										$('#dC_15').click(function(){
											var codigo4=$('#txt_dc_15').val();  
											CambiarColorDientes(codigo4,'txt_dc_15','dC_15',5); 
										});														


										$('#dA_14').click(function(){
											var codigo=$('#txt_da_14').val(); 
											CambiarColorDientes(codigo,'txt_da_14','dA_14',1);      
										});
										$('#dD_14').click(function(){
											var codigo1=$('#txt_dd_14').val();  
											CambiarColorDientes(codigo1,'txt_dd_14','dD_14',2); 
										});
										$('#daB_14').click(function(){
											var codigo2=$('#txt_dab_14').val(); 
											CambiarColorDientes(codigo2,'txt_dab_14','daB_14',3); 
										});
										$('#dI_14').click(function(){
											var codigo3=$('#txt_di_14').val();  
											CambiarColorDientes(codigo3,'txt_di_14','dI_14',4); 
										});
										$('#dC_14').click(function(){
											var codigo4=$('#txt_dc_14').val();  
											CambiarColorDientes(codigo4,'txt_dc_14','dC_14',5); 
										});		


										$('#dA_13').click(function(){
											var codigo=$('#txt_da_13').val(); 
											CambiarColorDientes(codigo,'txt_da_13','dA_13',1);      
										});
										$('#dD_13').click(function(){
											var codigo1=$('#txt_dd_13').val();  
											CambiarColorDientes(codigo1,'txt_dd_13','dD_13',2); 
										});
										$('#daB_13').click(function(){
											var codigo2=$('#txt_dab_13').val(); 
											CambiarColorDientes(codigo2,'txt_dab_13','daB_13',3); 
										});
										$('#dI_13').click(function(){
											var codigo3=$('#txt_di_13').val();  
											CambiarColorDientes(codigo3,'txt_di_13','dI_13',4); 
										});
										$('#dC_13').click(function(){
											var codigo4=$('#txt_dc_13').val();  
											CambiarColorDientes(codigo4,'txt_dc_13','dC_13',5); 
										});											



										";
										echo "

										$('#dA_12').click(function(){
											var codigo=$('#txt_da_12').val(); 
											CambiarColorDientes(codigo,'txt_da_12','dA_12',1);      
										});
										$('#dD_12').click(function(){
											var codigo1=$('#txt_dd_12').val();  
											CambiarColorDientes(codigo1,'txt_dd_12','dD_12',2); 
										});
										$('#daB_12').click(function(){
											var codigo2=$('#txt_dab_12').val(); 
											CambiarColorDientes(codigo2,'txt_dab_12','daB_12',3); 
										});
										$('#dI_12').click(function(){
											var codigo3=$('#txt_di_12').val();  
											CambiarColorDientes(codigo3,'txt_di_12','dI_12',4); 
										});
										$('#dC_12').click(function(){
											var codigo4=$('#txt_dc_12').val();  
											CambiarColorDientes(codigo4,'txt_dc_12','dC_12',5); 
										});			




										$('#dA_11').click(function(){
											var codigo=$('#txt_da_11').val(); 
											CambiarColorDientes(codigo,'txt_da_11','dA_11',1);      
										});
										$('#dD_11').click(function(){
											var codigo1=$('#txt_dd_11').val();  
											CambiarColorDientes(codigo1,'txt_dd_11','dD_11',2); 
										});
										$('#daB_11').click(function(){
											var codigo2=$('#txt_dab_11').val(); 
											CambiarColorDientes(codigo2,'txt_dab_11','daB_11',3); 
										});
										$('#dI_11').click(function(){
											var codigo3=$('#txt_di_11').val();  
											CambiarColorDientes(codigo3,'txt_di_11','dI_11',4); 
										});
										$('#dC_11').click(function(){
											var codigo4=$('#txt_dc_11').val();  
											CambiarColorDientes(codigo4,'txt_dc_11','dC_11',5); 
										});	


										$('#dA_21').click(function(){
											var codigo=$('#txt_da_21').val(); 
											CambiarColorDientes(codigo,'txt_da_21','dA_21',1);      
										});
										$('#dD_21').click(function(){
											var codigo1=$('#txt_dd_21').val();  
											CambiarColorDientes(codigo1,'txt_dd_21','dD_21',2); 
										});
										$('#daB_21').click(function(){
											var codigo2=$('#txt_dab_21').val(); 
											CambiarColorDientes(codigo2,'txt_dab_21','daB_21',3); 
										});
										$('#dI_21').click(function(){
											var codigo3=$('#txt_di_21').val();  
											CambiarColorDientes(codigo3,'txt_di_21','dI_21',4); 
										});
										$('#dC_21').click(function(){
											var codigo4=$('#txt_dc_21').val();  
											CambiarColorDientes(codigo4,'txt_dc_21','dC_21',5); 
										});	


										$('#dA_22').click(function(){
											var codigo=$('#txt_da_22').val(); 
											CambiarColorDientes(codigo,'txt_da_22','dA_22',1);      
										});
										$('#dD_22').click(function(){
											var codigo1=$('#txt_dd_22').val();  
											CambiarColorDientes(codigo1,'txt_dd_22','dD_22',2); 
										});
										$('#daB_22').click(function(){
											var codigo2=$('#txt_dab_22').val(); 
											CambiarColorDientes(codigo2,'txt_dab_22','daB_22',3); 
										});
										$('#dI_22').click(function(){
											var codigo3=$('#txt_di_22').val();  
											CambiarColorDientes(codigo3,'txt_di_22','dI_22',4); 
										});
										$('#dC_22').click(function(){
											var codigo4=$('#txt_dc_22').val();  
											CambiarColorDientes(codigo4,'txt_dc_22','dC_22',5); 
										});							

										$('#dA_23').click(function(){
											var codigo=$('#txt_da_23').val(); 
											CambiarColorDientes(codigo,'txt_da_23','dA_23',1);      
										});
										$('#dD_23').click(function(){
											var codigo1=$('#txt_dd_23').val();  
											CambiarColorDientes(codigo1,'txt_dd_23','dD_23',2); 
										});
										$('#daB_23').click(function(){
											var codigo2=$('#txt_dab_23').val(); 
											CambiarColorDientes(codigo2,'txt_dab_23','daB_23',3); 
										});
										$('#dI_23').click(function(){
											var codigo3=$('#txt_di_23').val();  
											CambiarColorDientes(codigo3,'txt_di_23','dI_23',4); 
										});
										$('#dC_23').click(function(){
											var codigo4=$('#txt_dc_23').val();  
											CambiarColorDientes(codigo4,'txt_dc_23','dC_23',5); 
										});																											



										$('#dA_24').click(function(){
											var codigo=$('#txt_da_24').val(); 
											CambiarColorDientes(codigo,'txt_da_24','dA_24',1);      
										});
										$('#dD_24').click(function(){
											var codigo1=$('#txt_dd_24').val();  
											CambiarColorDientes(codigo1,'txt_dd_24','dD_24',2); 
										});
										$('#daB_24').click(function(){
											var codigo2=$('#txt_dab_24').val(); 
											CambiarColorDientes(codigo2,'txt_dab_24','daB_24',3); 
										});
										$('#dI_24').click(function(){
											var codigo3=$('#txt_di_24').val();  
											CambiarColorDientes(codigo3,'txt_di_24','dI_24',4); 
										});
										$('#dC_24').click(function(){
											var codigo4=$('#txt_dc_24').val();  
											CambiarColorDientes(codigo4,'txt_dc_24','dC_24',5); 
										});




										$('#dA_25').click(function(){
											var codigo=$('#txt_da_25').val(); 
											CambiarColorDientes(codigo,'txt_da_25','dA_25',1);      
										});
										$('#dD_25').click(function(){
											var codigo1=$('#txt_dd_25').val();  
											CambiarColorDientes(codigo1,'txt_dd_25','dD_25',2); 
										});
										$('#daB_25').click(function(){
											var codigo2=$('#txt_dab_25').val(); 
											CambiarColorDientes(codigo2,'txt_dab_25','daB_25',3); 
										});
										$('#dI_25').click(function(){
											var codigo3=$('#txt_di_25').val();  
											CambiarColorDientes(codigo3,'txt_di_25','dI_25',4); 
										});
										$('#dC_25').click(function(){
											var codigo4=$('#txt_dc_25').val();  
											CambiarColorDientes(codigo4,'txt_dc_25','dC_25',5); 
										});



										$('#dA_26').click(function(){
											var codigo=$('#txt_da_26').val(); 
											CambiarColorDientes(codigo,'txt_da_26','dA_26',1);      
										});
										$('#dD_26').click(function(){
											var codigo1=$('#txt_dd_26').val();  
											CambiarColorDientes(codigo1,'txt_dd_26','dD_26',2); 
										});
										$('#daB_26').click(function(){
											var codigo2=$('#txt_dab_26').val(); 
											CambiarColorDientes(codigo2,'txt_dab_26','daB_26',3); 
										});
										$('#dI_26').click(function(){
											var codigo3=$('#txt_di_26').val();  
											CambiarColorDientes(codigo3,'txt_di_26','dI_26',4); 
										});
										$('#dC_26').click(function(){
											var codigo4=$('#txt_dc_26').val();  
											CambiarColorDientes(codigo4,'txt_dc_26','dC_26',5); 
										});	



										$('#dA_27').click(function(){
											var codigo=$('#txt_da_27').val(); 
											CambiarColorDientes(codigo,'txt_da_27','dA_27',1);      
										});
										$('#dD_27').click(function(){
											var codigo1=$('#txt_dd_27').val();  
											CambiarColorDientes(codigo1,'txt_dd_27','dD_27',2); 
										});
										$('#daB_27').click(function(){
											var codigo2=$('#txt_dab_27').val(); 
											CambiarColorDientes(codigo2,'txt_dab_27','daB_27',3); 
										});
										$('#dI_27').click(function(){
											var codigo3=$('#txt_di_27').val();  
											CambiarColorDientes(codigo3,'txt_di_27','dI_27',4); 
										});
										$('#dC_27').click(function(){
											var codigo4=$('#txt_dc_27').val();  
											CambiarColorDientes(codigo4,'txt_dc_27','dC_27',5); 
										});


										$('#dA_28').click(function(){
											var codigo=$('#txt_da_28').val(); 
											CambiarColorDientes(codigo,'txt_da_28','dA_28',1);      
										});
										$('#dD_28').click(function(){
											var codigo1=$('#txt_dd_28').val();  
											CambiarColorDientes(codigo1,'txt_dd_28','dD_28',2); 
										});
										$('#daB_28').click(function(){
											var codigo2=$('#txt_dab_28').val(); 
											CambiarColorDientes(codigo2,'txt_dab_28','daB_28',3); 
										});
										$('#dI_28').click(function(){
											var codigo3=$('#txt_di_28').val();  
											CambiarColorDientes(codigo3,'txt_di_28','dI_28',4); 
										});
										$('#dC_28').click(function(){
											var codigo4=$('#txt_dc_28').val();  
											CambiarColorDientes(codigo4,'txt_dc_28','dC_28',5); 
										});	



										$('#dA_55').click(function(){
											var codigo=$('#txt_da_55').val(); 
											CambiarColorDientes(codigo,'txt_da_55','dA_55',1);      
										});
										$('#dD_55').click(function(){
											var codigo1=$('#txt_dd_55').val();  
											CambiarColorDientes(codigo1,'txt_dd_55','dD_55',2); 
										});
										$('#daB_55').click(function(){
											var codigo2=$('#txt_dab_55').val(); 
											CambiarColorDientes(codigo2,'txt_dab_55','daB_55',3); 
										});
										$('#dI_55').click(function(){
											var codigo3=$('#txt_di_55').val();  
											CambiarColorDientes(codigo3,'txt_di_55','dI_55',4); 
										});
										$('#dC_55').click(function(){
											var codigo4=$('#txt_dc_55').val();  
											CambiarColorDientes(codigo4,'txt_dc_55','dC_55',5); 
										});																																																									



										";

										echo "

										$('#dA_54').click(function(){
											var codigo=$('#txt_da_54').val(); 
											CambiarColorDientes(codigo,'txt_da_54','dA_54',1);      
										});
										$('#dD_54').click(function(){
											var codigo1=$('#txt_dd_54').val();  
											CambiarColorDientes(codigo1,'txt_dd_54','dD_54',2); 
										});
										$('#daB_54').click(function(){
											var codigo2=$('#txt_dab_54').val(); 
											CambiarColorDientes(codigo2,'txt_dab_54','daB_54',3); 
										});
										$('#dI_54').click(function(){
											var codigo3=$('#txt_di_54').val();  
											CambiarColorDientes(codigo3,'txt_di_54','dI_54',4); 
										});
										$('#dC_54').click(function(){
											var codigo4=$('#txt_dc_54').val();  
											CambiarColorDientes(codigo4,'txt_dc_54','dC_54',5); 
										});		




										$('#dA_53').click(function(){
											var codigo=$('#txt_da_53').val(); 
											CambiarColorDientes(codigo,'txt_da_53','dA_53',1);      
										});
										$('#dD_53').click(function(){
											var codigo1=$('#txt_dd_53').val();  
											CambiarColorDientes(codigo1,'txt_dd_53','dD_53',2); 
										});
										$('#daB_53').click(function(){
											var codigo2=$('#txt_dab_53').val(); 
											CambiarColorDientes(codigo2,'txt_dab_53','daB_53',3); 
										});
										$('#dI_53').click(function(){
											var codigo3=$('#txt_di_53').val();  
											CambiarColorDientes(codigo3,'txt_di_53','dI_53',4); 
										});
										$('#dC_53').click(function(){
											var codigo4=$('#txt_dc_53').val();  
											CambiarColorDientes(codigo4,'txt_dc_53','dC_53',5); 
										});	



										$('#dA_52').click(function(){
											var codigo=$('#txt_da_52').val(); 
											CambiarColorDientes(codigo,'txt_da_52','dA_52',1);      
										});
										$('#dD_52').click(function(){
											var codigo1=$('#txt_dd_52').val();  
											CambiarColorDientes(codigo1,'txt_dd_52','dD_52',2); 
										});
										$('#daB_52').click(function(){
											var codigo2=$('#txt_dab_52').val(); 
											CambiarColorDientes(codigo2,'txt_dab_52','daB_52',3); 
										});
										$('#dI_52').click(function(){
											var codigo3=$('#txt_di_52').val();  
											CambiarColorDientes(codigo3,'txt_di_52','dI_52',4); 
										});
										$('#dC_52').click(function(){
											var codigo4=$('#txt_dc_52').val();  
											CambiarColorDientes(codigo4,'txt_dc_52','dC_52',5); 
										});																																																																					


										$('#dA_51').click(function(){
											var codigo=$('#txt_da_51').val(); 
											CambiarColorDientes(codigo,'txt_da_51','dA_51',1);      
										});
										$('#dD_51').click(function(){
											var codigo1=$('#txt_dd_51').val();  
											CambiarColorDientes(codigo1,'txt_dd_51','dD_51',2); 
										});
										$('#daB_51').click(function(){
											var codigo2=$('#txt_dab_51').val(); 
											CambiarColorDientes(codigo2,'txt_dab_51','daB_51',3); 
										});
										$('#dI_51').click(function(){
											var codigo3=$('#txt_di_51').val();  
											CambiarColorDientes(codigo3,'txt_di_51','dI_51',4); 
										});
										$('#dC_51').click(function(){
											var codigo4=$('#txt_dc_51').val();  
											CambiarColorDientes(codigo4,'txt_dc_51','dC_51',5); 
										});																																																																								

										";

										echo "

										$('#dA_61').click(function(){
											var codigo=$('#txt_da_61').val(); 
											CambiarColorDientes(codigo,'txt_da_61','dA_61',1);      
										});
										$('#dD_61').click(function(){
											var codigo1=$('#txt_dd_61').val();  
											CambiarColorDientes(codigo1,'txt_dd_61','dD_61',2); 
										});
										$('#daB_61').click(function(){
											var codigo2=$('#txt_dab_61').val(); 
											CambiarColorDientes(codigo2,'txt_dab_61','daB_61',3); 
										});
										$('#dI_61').click(function(){
											var codigo3=$('#txt_di_61').val();  
											CambiarColorDientes(codigo3,'txt_di_61','dI_61',4); 
										});
										$('#dC_61').click(function(){
											var codigo4=$('#txt_dc_61').val();  
											CambiarColorDientes(codigo4,'txt_dc_61','dC_61',5); 
										});	


										$('#dA_62').click(function(){
											var codigo=$('#txt_da_62').val(); 
											CambiarColorDientes(codigo,'txt_da_62','dA_62',1);      
										});
										$('#dD_62').click(function(){
											var codigo1=$('#txt_dd_62').val();  
											CambiarColorDientes(codigo1,'txt_dd_62','dD_62',2); 
										});
										$('#daB_62').click(function(){
											var codigo2=$('#txt_dab_62').val(); 
											CambiarColorDientes(codigo2,'txt_dab_62','daB_62',3); 
										});
										$('#dI_62').click(function(){
											var codigo3=$('#txt_di_62').val();  
											CambiarColorDientes(codigo3,'txt_di_62','dI_62',4); 
										});
										$('#dC_62').click(function(){
											var codigo4=$('#txt_dc_62').val();  
											CambiarColorDientes(codigo4,'txt_dc_62','dC_62',5); 
										});	


										$('#dA_63').click(function(){
											var codigo=$('#txt_da_63').val(); 
											CambiarColorDientes(codigo,'txt_da_63','dA_63',1);      
										});
										$('#dD_63').click(function(){
											var codigo1=$('#txt_dd_63').val();  
											CambiarColorDientes(codigo1,'txt_dd_63','dD_63',2); 
										});
										$('#daB_63').click(function(){
											var codigo2=$('#txt_dab_63').val(); 
											CambiarColorDientes(codigo2,'txt_dab_63','daB_63',3); 
										});
										$('#dI_63').click(function(){
											var codigo3=$('#txt_di_63').val();  
											CambiarColorDientes(codigo3,'txt_di_63','dI_63',4); 
										});
										$('#dC_63').click(function(){
											var codigo4=$('#txt_dc_63').val();  
											CambiarColorDientes(codigo4,'txt_dc_63','dC_63',5); 
										});	



										$('#dA_64').click(function(){
											var codigo=$('#txt_da_64').val(); 
											CambiarColorDientes(codigo,'txt_da_64','dA_64',1);      
										});
										$('#dD_64').click(function(){
											var codigo1=$('#txt_dd_64').val();  
											CambiarColorDientes(codigo1,'txt_dd_64','dD_64',2); 
										});
										$('#daB_64').click(function(){
											var codigo2=$('#txt_dab_64').val(); 
											CambiarColorDientes(codigo2,'txt_dab_64','daB_64',3); 
										});
										$('#dI_64').click(function(){
											var codigo3=$('#txt_di_64').val();  
											CambiarColorDientes(codigo3,'txt_di_64','dI_64',4); 
										});
										$('#dC_64').click(function(){
											var codigo4=$('#txt_dc_64').val();  
											CambiarColorDientes(codigo4,'txt_dc_64','dC_64',5); 
										});																			




										$('#dA_65').click(function(){
											var codigo=$('#txt_da_65').val(); 
											CambiarColorDientes(codigo,'txt_da_65','dA_65',1);      
										});
										$('#dD_65').click(function(){
											var codigo1=$('#txt_dd_65').val();  
											CambiarColorDientes(codigo1,'txt_dd_65','dD_65',2); 
										});
										$('#daB_65').click(function(){
											var codigo2=$('#txt_dab_65').val(); 
											CambiarColorDientes(codigo2,'txt_dab_65','daB_65',3); 
										});
										$('#dI_65').click(function(){
											var codigo3=$('#txt_di_65').val();  
											CambiarColorDientes(codigo3,'txt_di_65','dI_65',4); 
										});
										$('#dC_65').click(function(){
											var codigo4=$('#txt_dc_65').val();  
											CambiarColorDientes(codigo4,'txt_dc_65','dC_65',5); 
										});	



										";

										echo "

										$('#dA_85').click(function(){
											var codigo=$('#txt_da_85').val(); 
											CambiarColorDientes(codigo,'txt_da_85','dA_85',1);      
										});
										$('#dD_85').click(function(){
											var codigo1=$('#txt_dd_85').val();  
											CambiarColorDientes(codigo1,'txt_dd_85','dD_85',2); 
										});
										$('#daB_85').click(function(){
											var codigo2=$('#txt_dab_85').val(); 
											CambiarColorDientes(codigo2,'txt_dab_85','daB_85',3); 
										});
										$('#dI_85').click(function(){
											var codigo3=$('#txt_di_85').val();  
											CambiarColorDientes(codigo3,'txt_di_85','dI_85',4); 
										});
										$('#dC_85').click(function(){
											var codigo4=$('#txt_dc_85').val();  
											CambiarColorDientes(codigo4,'txt_dc_85','dC_85',5); 
										});	


										$('#dA_84').click(function(){
											var codigo=$('#txt_da_84').val(); 
											CambiarColorDientes(codigo,'txt_da_84','dA_84',1);      
										});
										$('#dD_84').click(function(){
											var codigo1=$('#txt_dd_84').val();  
											CambiarColorDientes(codigo1,'txt_dd_84','dD_84',2); 
										});
										$('#daB_84').click(function(){
											var codigo2=$('#txt_dab_84').val(); 
											CambiarColorDientes(codigo2,'txt_dab_84','daB_84',3); 
										});
										$('#dI_84').click(function(){
											var codigo3=$('#txt_di_84').val();  
											CambiarColorDientes(codigo3,'txt_di_84','dI_84',4); 
										});
										$('#dC_84').click(function(){
											var codigo4=$('#txt_dc_84').val();  
											CambiarColorDientes(codigo4,'txt_dc_84','dC_84',5); 
										});


										$('#dA_83').click(function(){
											var codigo=$('#txt_da_83').val(); 
											CambiarColorDientes(codigo,'txt_da_83','dA_83',1);      
										});
										$('#dD_83').click(function(){
											var codigo1=$('#txt_dd_83').val();  
											CambiarColorDientes(codigo1,'txt_dd_83','dD_83',2); 
										});
										$('#daB_83').click(function(){
											var codigo2=$('#txt_dab_83').val(); 
											CambiarColorDientes(codigo2,'txt_dab_83','daB_83',3); 
										});
										$('#dI_83').click(function(){
											var codigo3=$('#txt_di_83').val();  
											CambiarColorDientes(codigo3,'txt_di_83','dI_83',4); 
										});
										$('#dC_83').click(function(){
											var codigo4=$('#txt_dc_83').val();  
											CambiarColorDientes(codigo4,'txt_dc_83','dC_83',5); 
										});




										$('#dA_82').click(function(){
											var codigo=$('#txt_da_82').val(); 
											CambiarColorDientes(codigo,'txt_da_82','dA_82',1);      
										});
										$('#dD_82').click(function(){
											var codigo1=$('#txt_dd_82').val();  
											CambiarColorDientes(codigo1,'txt_dd_82','dD_82',2); 
										});
										$('#daB_82').click(function(){
											var codigo2=$('#txt_dab_82').val(); 
											CambiarColorDientes(codigo2,'txt_dab_82','daB_82',3); 
										});
										$('#dI_82').click(function(){
											var codigo3=$('#txt_di_82').val();  
											CambiarColorDientes(codigo3,'txt_di_82','dI_82',4); 
										});
										$('#dC_82').click(function(){
											var codigo4=$('#txt_dc_82').val();  
											CambiarColorDientes(codigo4,'txt_dc_82','dC_82',5); 
										});						


										$('#dA_81').click(function(){
											var codigo=$('#txt_da_81').val(); 
											CambiarColorDientes(codigo,'txt_da_81','dA_81',1);      
										});
										$('#dD_81').click(function(){
											var codigo1=$('#txt_dd_81').val();  
											CambiarColorDientes(codigo1,'txt_dd_81','dD_81',2); 
										});
										$('#daB_81').click(function(){
											var codigo2=$('#txt_dab_81').val(); 
											CambiarColorDientes(codigo2,'txt_dab_81','daB_81',3); 
										});
										$('#dI_81').click(function(){
											var codigo3=$('#txt_di_81').val();  
											CambiarColorDientes(codigo3,'txt_di_81','dI_81',4); 
										});
										$('#dC_81').click(function(){
											var codigo4=$('#txt_dc_81').val();  
											CambiarColorDientes(codigo4,'txt_dc_81','dC_81',5); 
										});	


										$('#dA_71').click(function(){
											var codigo=$('#txt_da_71').val(); 
											CambiarColorDientes(codigo,'txt_da_71','dA_71',1);      
										});
										$('#dD_71').click(function(){
											var codigo1=$('#txt_dd_71').val();  
											CambiarColorDientes(codigo1,'txt_dd_71','dD_71',2); 
										});
										$('#daB_71').click(function(){
											var codigo2=$('#txt_dab_71').val(); 
											CambiarColorDientes(codigo2,'txt_dab_71','daB_71',3); 
										});
										$('#dI_71').click(function(){
											var codigo3=$('#txt_di_71').val();  
											CambiarColorDientes(codigo3,'txt_di_71','dI_71',4); 
										});
										$('#dC_71').click(function(){
											var codigo4=$('#txt_dc_71').val();  
											CambiarColorDientes(codigo4,'txt_dc_71','dC_71',5); 
										});	



										$('#dA_72').click(function(){
											var codigo=$('#txt_da_72').val(); 
											CambiarColorDientes(codigo,'txt_da_72','dA_72',1);      
										});
										$('#dD_72').click(function(){
											var codigo1=$('#txt_dd_72').val();  
											CambiarColorDientes(codigo1,'txt_dd_72','dD_72',2); 
										});
										$('#daB_72').click(function(){
											var codigo2=$('#txt_dab_72').val(); 
											CambiarColorDientes(codigo2,'txt_dab_72','daB_72',3); 
										});
										$('#dI_72').click(function(){
											var codigo3=$('#txt_di_72').val();  
											CambiarColorDientes(codigo3,'txt_di_72','dI_72',4); 
										});
										$('#dC_72').click(function(){
											var codigo4=$('#txt_dc_72').val();  
											CambiarColorDientes(codigo4,'txt_dc_72','dC_72',5); 
										});	



										$('#dA_73').click(function(){
											var codigo=$('#txt_da_73').val(); 
											CambiarColorDientes(codigo,'txt_da_73','dA_73',1);      
										});
										$('#dD_73').click(function(){
											var codigo1=$('#txt_dd_73').val();  
											CambiarColorDientes(codigo1,'txt_dd_73','dD_73',2); 
										});
										$('#daB_73').click(function(){
											var codigo2=$('#txt_dab_73').val(); 
											CambiarColorDientes(codigo2,'txt_dab_73','daB_73',3); 
										});
										$('#dI_73').click(function(){
											var codigo3=$('#txt_di_73').val();  
											CambiarColorDientes(codigo3,'txt_di_73','dI_73',4); 
										});
										$('#dC_73').click(function(){
											var codigo4=$('#txt_dc_73').val();  
											CambiarColorDientes(codigo4,'txt_dc_73','dC_73',5); 
										});	



										$('#dA_74').click(function(){
											var codigo=$('#txt_da_74').val(); 
											CambiarColorDientes(codigo,'txt_da_74','dA_74',1);      
										});
										$('#dD_74').click(function(){
											var codigo1=$('#txt_dd_74').val();  
											CambiarColorDientes(codigo1,'txt_dd_74','dD_74',2); 
										});
										$('#daB_74').click(function(){
											var codigo2=$('#txt_dab_74').val(); 
											CambiarColorDientes(codigo2,'txt_dab_74','daB_74',3); 
										});
										$('#dI_74').click(function(){
											var codigo3=$('#txt_di_74').val();  
											CambiarColorDientes(codigo3,'txt_di_74','dI_74',4); 
										});
										$('#dC_74').click(function(){
											var codigo4=$('#txt_dc_74').val();  
											CambiarColorDientes(codigo4,'txt_dc_74','dC_74',5); 
										});	



										$('#dA_75').click(function(){
											var codigo=$('#txt_da_75').val(); 
											CambiarColorDientes(codigo,'txt_da_75','dA_75',1);      
										});
										$('#dD_75').click(function(){
											var codigo1=$('#txt_dd_75').val();  
											CambiarColorDientes(codigo1,'txt_dd_75','dD_75',2); 
										});
										$('#daB_75').click(function(){
											var codigo2=$('#txt_dab_75').val(); 
											CambiarColorDientes(codigo2,'txt_dab_75','daB_75',3); 
										});
										$('#dI_75').click(function(){
											var codigo3=$('#txt_di_75').val();  
											CambiarColorDientes(codigo3,'txt_di_75','dI_75',4); 
										});
										$('#dC_75').click(function(){
											var codigo4=$('#txt_dc_75').val();  
											CambiarColorDientes(codigo4,'txt_dc_75','dC_75',5); 
										});																								

										";	

										echo "

										$('#dA_48').click(function(){
											var codigo=$('#txt_da_48').val(); 
											CambiarColorDientes(codigo,'txt_da_48','dA_48',1);      
										});
										$('#dD_48').click(function(){
											var codigo1=$('#txt_dd_48').val();  
											CambiarColorDientes(codigo1,'txt_dd_48','dD_48',2); 
										});
										$('#daB_48').click(function(){
											var codigo2=$('#txt_dab_48').val(); 
											CambiarColorDientes(codigo2,'txt_dab_48','daB_48',3); 
										});
										$('#dI_48').click(function(){
											var codigo3=$('#txt_di_48').val();  
											CambiarColorDientes(codigo3,'txt_di_48','dI_48',4); 
										});
										$('#dC_48').click(function(){
											var codigo4=$('#txt_dc_48').val();  
											CambiarColorDientes(codigo4,'txt_dc_48','dC_48',5); 
										});


										$('#dA_47').click(function(){
											var codigo=$('#txt_da_47').val(); 
											CambiarColorDientes(codigo,'txt_da_47','dA_47',1);      
										});
										$('#dD_47').click(function(){
											var codigo1=$('#txt_dd_47').val();  
											CambiarColorDientes(codigo1,'txt_dd_47','dD_47',2); 
										});
										$('#daB_47').click(function(){
											var codigo2=$('#txt_dab_47').val(); 
											CambiarColorDientes(codigo2,'txt_dab_47','daB_47',3); 
										});
										$('#dI_47').click(function(){
											var codigo3=$('#txt_di_47').val();  
											CambiarColorDientes(codigo3,'txt_di_47','dI_47',4); 
										});
										$('#dC_47').click(function(){
											var codigo4=$('#txt_dc_47').val();  
											CambiarColorDientes(codigo4,'txt_dc_47','dC_47',5); 
										});

										$('#dA_46').click(function(){
											var codigo=$('#txt_da_46').val(); 
											CambiarColorDientes(codigo,'txt_da_46','dA_46',1);      
										});
										$('#dD_46').click(function(){
											var codigo1=$('#txt_dd_46').val();  
											CambiarColorDientes(codigo1,'txt_dd_46','dD_46',2); 
										});
										$('#daB_46').click(function(){
											var codigo2=$('#txt_dab_46').val(); 
											CambiarColorDientes(codigo2,'txt_dab_46','daB_46',3); 
										});
										$('#dI_46').click(function(){
											var codigo3=$('#txt_di_46').val();  
											CambiarColorDientes(codigo3,'txt_di_46','dI_46',4); 
										});
										$('#dC_46').click(function(){
											var codigo4=$('#txt_dc_46').val();  
											CambiarColorDientes(codigo4,'txt_dc_46','dC_46',5); 
										});


										$('#dA_45').click(function(){
											var codigo=$('#txt_da_45').val(); 
											CambiarColorDientes(codigo,'txt_da_45','dA_45',1);      
										});
										$('#dD_45').click(function(){
											var codigo1=$('#txt_dd_45').val();  
											CambiarColorDientes(codigo1,'txt_dd_45','dD_45',2); 
										});
										$('#daB_45').click(function(){
											var codigo2=$('#txt_dab_45').val(); 
											CambiarColorDientes(codigo2,'txt_dab_45','daB_45',3); 
										});
										$('#dI_45').click(function(){
											var codigo3=$('#txt_di_45').val();  
											CambiarColorDientes(codigo3,'txt_di_45','dI_45',4); 
										});
										$('#dC_45').click(function(){
											var codigo4=$('#txt_dc_45').val();  
											CambiarColorDientes(codigo4,'txt_dc_45','dC_45',5); 
										});		


										$('#dA_44').click(function(){
											var codigo=$('#txt_da_44').val(); 
											CambiarColorDientes(codigo,'txt_da_44','dA_44',1);      
										});
										$('#dD_44').click(function(){
											var codigo1=$('#txt_dd_44').val();  
											CambiarColorDientes(codigo1,'txt_dd_44','dD_44',2); 
										});
										$('#daB_44').click(function(){
											var codigo2=$('#txt_dab_44').val(); 
											CambiarColorDientes(codigo2,'txt_dab_44','daB_44',3); 
										});
										$('#dI_44').click(function(){
											var codigo3=$('#txt_di_44').val();  
											CambiarColorDientes(codigo3,'txt_di_44','dI_44',4); 
										});
										$('#dC_44').click(function(){
											var codigo4=$('#txt_dc_44').val();  
											CambiarColorDientes(codigo4,'txt_dc_44','dC_44',5); 
										});	



										$('#dA_43').click(function(){
											var codigo=$('#txt_da_43').val(); 
											CambiarColorDientes(codigo,'txt_da_43','dA_43',1);      
										});
										$('#dD_43').click(function(){
											var codigo1=$('#txt_dd_43').val();  
											CambiarColorDientes(codigo1,'txt_dd_43','dD_43',2); 
										});
										$('#daB_43').click(function(){
											var codigo2=$('#txt_dab_43').val(); 
											CambiarColorDientes(codigo2,'txt_dab_43','daB_43',3); 
										});
										$('#dI_43').click(function(){
											var codigo3=$('#txt_di_43').val();  
											CambiarColorDientes(codigo3,'txt_di_43','dI_43',4); 
										});
										$('#dC_43').click(function(){
											var codigo4=$('#txt_dc_43').val();  
											CambiarColorDientes(codigo4,'txt_dc_43','dC_43',5); 
										});	




										$('#dA_42').click(function(){
											var codigo=$('#txt_da_42').val(); 
											CambiarColorDientes(codigo,'txt_da_42','dA_42',1);      
										});
										$('#dD_42').click(function(){
											var codigo1=$('#txt_dd_42').val();  
											CambiarColorDientes(codigo1,'txt_dd_42','dD_42',2); 
										});
										$('#daB_42').click(function(){
											var codigo2=$('#txt_dab_42').val(); 
											CambiarColorDientes(codigo2,'txt_dab_42','daB_42',3); 
										});
										$('#dI_42').click(function(){
											var codigo3=$('#txt_di_42').val();  
											CambiarColorDientes(codigo3,'txt_di_42','dI_42',4); 
										});
										$('#dC_42').click(function(){
											var codigo4=$('#txt_dc_42').val();  
											CambiarColorDientes(codigo4,'txt_dc_42','dC_42',5); 
										});	



										$('#dA_41').click(function(){
											var codigo=$('#txt_da_41').val(); 
											CambiarColorDientes(codigo,'txt_da_41','dA_41',1);      
										});
										$('#dD_41').click(function(){
											var codigo1=$('#txt_dd_41').val();  
											CambiarColorDientes(codigo1,'txt_dd_41','dD_41',2); 
										});
										$('#daB_41').click(function(){
											var codigo2=$('#txt_dab_41').val(); 
											CambiarColorDientes(codigo2,'txt_dab_41','daB_41',3); 
										});
										$('#dI_41').click(function(){
											var codigo3=$('#txt_di_41').val();  
											CambiarColorDientes(codigo3,'txt_di_41','dI_41',4); 
										});
										$('#dC_41').click(function(){
											var codigo4=$('#txt_dc_41').val();  
											CambiarColorDientes(codigo4,'txt_dc_41','dC_41',5); 
										});	





										$('#dA_31').click(function(){
											var codigo=$('#txt_da_31').val(); 
											CambiarColorDientes(codigo,'txt_da_31','dA_31',1);      
										});
										$('#dD_31').click(function(){
											var codigo1=$('#txt_dd_31').val();  
											CambiarColorDientes(codigo1,'txt_dd_31','dD_31',2); 
										});
										$('#daB_31').click(function(){
											var codigo2=$('#txt_dab_31').val(); 
											CambiarColorDientes(codigo2,'txt_dab_31','daB_31',3); 
										});
										$('#dI_31').click(function(){
											var codigo3=$('#txt_di_31').val();  
											CambiarColorDientes(codigo3,'txt_di_31','dI_31',4); 
										});
										$('#dC_31').click(function(){
											var codigo4=$('#txt_dc_31').val();  
											CambiarColorDientes(codigo4,'txt_dc_31','dC_31',5); 
										});	



										$('#dA_32').click(function(){
											var codigo=$('#txt_da_32').val(); 
											CambiarColorDientes(codigo,'txt_da_32','dA_32',1);      
										});
										$('#dD_32').click(function(){
											var codigo1=$('#txt_dd_32').val();  
											CambiarColorDientes(codigo1,'txt_dd_32','dD_32',2); 
										});
										$('#daB_32').click(function(){
											var codigo2=$('#txt_dab_32').val(); 
											CambiarColorDientes(codigo2,'txt_dab_32','daB_32',3); 
										});
										$('#dI_32').click(function(){
											var codigo3=$('#txt_di_32').val();  
											CambiarColorDientes(codigo3,'txt_di_32','dI_32',4); 
										});
										$('#dC_32').click(function(){
											var codigo4=$('#txt_dc_32').val();  
											CambiarColorDientes(codigo4,'txt_dc_32','dC_32',5); 
										});	



										$('#dA_33').click(function(){
											var codigo=$('#txt_da_33').val(); 
											CambiarColorDientes(codigo,'txt_da_33','dA_33',1);      
										});
										$('#dD_33').click(function(){
											var codigo1=$('#txt_dd_33').val();  
											CambiarColorDientes(codigo1,'txt_dd_33','dD_33',2); 
										});
										$('#daB_33').click(function(){
											var codigo2=$('#txt_dab_33').val(); 
											CambiarColorDientes(codigo2,'txt_dab_33','daB_33',3); 
										});
										$('#dI_33').click(function(){
											var codigo3=$('#txt_di_33').val();  
											CambiarColorDientes(codigo3,'txt_di_33','dI_33',4); 
										});
										$('#dC_33').click(function(){
											var codigo4=$('#txt_dc_33').val();  
											CambiarColorDientes(codigo4,'txt_dc_33','dC_33',5); 
										});	


										$('#dA_34').click(function(){
											var codigo=$('#txt_da_34').val(); 
											CambiarColorDientes(codigo,'txt_da_34','dA_34',1);      
										});
										$('#dD_34').click(function(){
											var codigo1=$('#txt_dd_34').val();  
											CambiarColorDientes(codigo1,'txt_dd_34','dD_34',2); 
										});
										$('#daB_34').click(function(){
											var codigo2=$('#txt_dab_34').val(); 
											CambiarColorDientes(codigo2,'txt_dab_34','daB_34',3); 
										});
										$('#dI_34').click(function(){
											var codigo3=$('#txt_di_34').val();  
											CambiarColorDientes(codigo3,'txt_di_34','dI_34',4); 
										});
										$('#dC_34').click(function(){
											var codigo4=$('#txt_dc_34').val();  
											CambiarColorDientes(codigo4,'txt_dc_34','dC_34',5); 
										});	


										$('#dA_35').click(function(){
											var codigo=$('#txt_da_35').val(); 
											CambiarColorDientes(codigo,'txt_da_35','dA_35',1);      
										});
										$('#dD_35').click(function(){
											var codigo1=$('#txt_dd_35').val();  
											CambiarColorDientes(codigo1,'txt_dd_35','dD_35',2); 
										});
										$('#daB_35').click(function(){
											var codigo2=$('#txt_dab_35').val(); 
											CambiarColorDientes(codigo2,'txt_dab_35','daB_35',3); 
										});
										$('#dI_35').click(function(){
											var codigo3=$('#txt_di_35').val();  
											CambiarColorDientes(codigo3,'txt_di_35','dI_35',4); 
										});
										$('#dC_35').click(function(){
											var codigo4=$('#txt_dc_35').val();  
											CambiarColorDientes(codigo4,'txt_dc_35','dC_35',5); 
										});	


										$('#dA_36').click(function(){
											var codigo=$('#txt_da_36').val(); 
											CambiarColorDientes(codigo,'txt_da_36','dA_36',1);      
										});
										$('#dD_36').click(function(){
											var codigo1=$('#txt_dd_36').val();  
											CambiarColorDientes(codigo1,'txt_dd_36','dD_36',2); 
										});
										$('#daB_36').click(function(){
											var codigo2=$('#txt_dab_36').val(); 
											CambiarColorDientes(codigo2,'txt_dab_36','daB_36',3); 
										});
										$('#dI_36').click(function(){
											var codigo3=$('#txt_di_36').val();  
											CambiarColorDientes(codigo3,'txt_di_36','dI_36',4); 
										});
										$('#dC_36').click(function(){
											var codigo4=$('#txt_dc_36').val();  
											CambiarColorDientes(codigo4,'txt_dc_36','dC_36',5); 
										});	



										$('#dA_37').click(function(){
											var codigo=$('#txt_da_37').val(); 
											CambiarColorDientes(codigo,'txt_da_37','dA_37',1);      
										});
										$('#dD_37').click(function(){
											var codigo1=$('#txt_dd_37').val();  
											CambiarColorDientes(codigo1,'txt_dd_37','dD_37',2); 
										});
										$('#daB_37').click(function(){
											var codigo2=$('#txt_dab_37').val(); 
											CambiarColorDientes(codigo2,'txt_dab_37','daB_37',3); 
										});
										$('#dI_37').click(function(){
											var codigo3=$('#txt_di_37').val();  
											CambiarColorDientes(codigo3,'txt_di_37','dI_37',4); 
										});
										$('#dC_37').click(function(){
											var codigo4=$('#txt_dc_37').val();  
											CambiarColorDientes(codigo4,'txt_dc_37','dC_37',5); 
										});	




										$('#dA_38').click(function(){
											var codigo=$('#txt_da_38').val(); 
											CambiarColorDientes(codigo,'txt_da_38','dA_38',1);      
										});
										$('#dD_38').click(function(){
											var codigo1=$('#txt_dd_38').val();  
											CambiarColorDientes(codigo1,'txt_dd_38','dD_38',2); 
										});
										$('#daB_38').click(function(){
											var codigo2=$('#txt_dab_38').val(); 
											CambiarColorDientes(codigo2,'txt_dab_38','daB_38',3); 
										});
										$('#dI_38').click(function(){
											var codigo3=$('#txt_di_38').val();  
											CambiarColorDientes(codigo3,'txt_di_38','dI_38',4); 
										});
										$('#dC_38').click(function(){
											var codigo4=$('#txt_dc_38').val();  
											CambiarColorDientes(codigo4,'txt_dc_38','dC_38',5); 
										});	


										";	


										echo "</script>";




									}else{
//cristhian
										$idfin=$odo->Consultar("SELECT MAX(id_odo) FROM tbl_odontogramadarwin WHERE person='$codpac';");
										$idini=$idfin-51;
										echo "
										<center>
											<table>
												<tr>
													<th>
														Tratamiento
													</th>
													<td>
														<select id='cmb_tratamiento'>
															<option value=''>--Seleccione--</option>
															<option value='1'>Prótesis Total Por Realizar</option>
															<option value='2'>Prótesis Removible Por Realizar</option>
															<option value='3'>Prótesis Fija Por Realizar</option>
															<option value='4'>Endodoncia Por Realizar</option>
															<option value='5'>Corona</option>
															<option value='6'>Prótesis Total Realizada</option>
															<option value='7'>Prótesis Removible Realizada</option>
															<option value='8'>Prótesis Fija Realizada</option>
															<option value='9'>Endodoncia Realizada</option>
															<option value='10'>Pérdida (Otra Causa)</option>
															<option value='11'>Pérdida Por Caries</option>
															<option value='12'>Extracción Indicada</option>
															<option value='13'>Sellante Realizado</option>
															<option value='14'>Sellante Necesario</option>
															<option value='15'>Caries</option>
															<option value='16'>Obturado</option>
														</select>

														<a class='btn btn-primary' onclick='SaveOdontogramaLight5()' id='btnSaveOdo'><i class='icon-file'></i> Guardar Odontograma</a>
													</td>
												</tr>
											</table>




											<table border='1'>
												<tr>

													<td>

														<table>
															<tr><td>&nbsp;</td></tr>
															<tr><td>Recesion</td></tr>
															<tr><td>Movilidad</td></tr>
															<tr><td>&nbsp;</td></tr>
															<tr><td>Vestibular</td></tr>
															<tr><td>&nbsp;</td></tr>
														</table>
													</td>
													";
													$box118=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='$idini';");
													$box218=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='$idini';");
													$up18=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='$idini';");
													$left18=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='$idini';");
													$center18=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='$idini';");
													$right18=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='$idini';");
													$down18=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='$idini';");
													$treatment18=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='$idini';");

													echo $this->GraficarDiente($box118,$box218,$up18,$left18,$center18,$right18,$down18,$treatment18,'18','y');

													$box117=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+1)."';");
													$box217=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+1)."';");
													$up17=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+1)."';");
													$left17=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+1)."';");
													$center17=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+1)."';");
													$right17=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+1)."';");
													$down17=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+1)."';");
													$treatment17=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+1)."';");

													echo $this->GraficarDiente($box117,$box217,$up17,$left17,$center17,$right17,$down17,$treatment17,'17','y');


													$box116=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+2)."';");
													$box216=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+2)."';");
													$up16=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+2)."';");
													$left16=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+2)."';");
													$center16=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+2)."';");
													$right16=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+2)."';");
													$down16=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+2)."';");
													$treatment16=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+2)."';");

													echo $this->GraficarDiente($box116,$box216,$up16,$left16,$center16,$right16,$down16,$treatment16,'16','y');


													$box115=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+3)."';");
													$box215=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+3)."';");
													$up15=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+3)."';");
													$left15=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+3)."';");
													$center15=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+3)."';");
													$right15=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+3)."';");
													$down15=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+3)."';");
													$treatment15=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+3)."';");

													echo $this->GraficarDiente($box115,$box215,$up15,$left15,$center15,$right15,$down15,$treatment15,'15','y');	




													$box114=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+4)."';");
													$box214=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+4)."';");
													$up14=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+4)."';");
													$left14=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+4)."';");
													$center14=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+4)."';");
													$right14=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+4)."';");
													$down14=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+4)."';");
													$treatment14=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+4)."';");

													echo $this->GraficarDiente($box114,$box214,$up14,$left14,$center14,$right14,$down14,$treatment14,'14','y');		



													$box113=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+5)."';");
													$box213=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+5)."';");
													$up13=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+5)."';");
													$left13=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+5)."';");
													$center13=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+5)."';");
													$right13=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+5)."';");
													$down13=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+5)."';");
													$treatment13=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+5)."';");

													echo $this->GraficarDiente($box113,$box213,$up13,$left13,$center13,$right13,$down13,$treatment13,'13','y');		


													$box112=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+6)."';");
													$box212=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+6)."';");
													$up12=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+6)."';");
													$left12=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+6)."';");
													$center12=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+6)."';");
													$right12=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+6)."';");
													$down12=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+6)."';");
													$treatment12=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+6)."';");

													echo $this->GraficarDiente($box112,$box212,$up12,$left12,$center12,$right12,$down12,$treatment12,'12','y');		


													$box111=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+7)."';");
													$box211=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+7)."';");
													$up11=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+7)."';");
													$left11=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+7)."';");
													$center11=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+7)."';");
													$right11=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+7)."';");
													$down11=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+7)."';");
													$treatment11=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+7)."';");

													echo $this->GraficarDiente($box111,$box211,$up11,$left11,$center11,$right11,$down11,$treatment11,'11','y');		

													echo "				<td colspan='3'>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</td>		";


												$box121=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+8)."';");
												$box221=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+8)."';");
												$up21=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+8)."';");
												$left21=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+8)."';");
												$center21=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+8)."';");
												$right21=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+8)."';");
												$down21=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+8)."';");
												$treatment21=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+8)."';");

												echo $this->GraficarDiente($box121,$box221,$up21,$left21,$center21,$right21,$down21,$treatment21,'21','y');		


												$box122=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+9)."';");
												$box222=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+9)."';");
												$up22=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+9)."';");
												$left22=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+9)."';");
												$center22=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+9)."';");
												$right22=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+9)."';");
												$down22=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+9)."';");
												$treatment22=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+9)."';");

												echo $this->GraficarDiente($box122,$box222,$up22,$left22,$center22,$right22,$down22,$treatment22,'22','y');		



												$box123=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+10)."';");
												$box223=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+10)."';");
												$up23=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+10)."';");
												$left23=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+10)."';");
												$center23=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+10)."';");
												$right23=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+10)."';");
												$down23=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+10)."';");
												$treatment23=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+10)."';");

												echo $this->GraficarDiente($box123,$box223,$up23,$left23,$center23,$right23,$down23,$treatment23,'23','y');		


												$box124=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+11)."';");
												$box224=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+11)."';");
												$up24=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+11)."';");
												$left24=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+11)."';");
												$center24=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+11)."';");
												$right24=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+11)."';");
												$down24=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+11)."';");
												$treatment24=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+11)."';");

												echo $this->GraficarDiente($box124,$box224,$up24,$left24,$center24,$right24,$down24,$treatment24,'24','y');


												$box125=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+12)."';");
												$box225=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+12)."';");
												$up25=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+12)."';");
												$left25=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+12)."';");
												$center25=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+12)."';");
												$right25=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+12)."';");
												$down25=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+12)."';");
												$treatment25=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+12)."';");

												echo $this->GraficarDiente($box125,$box225,$up25,$left25,$center25,$right25,$down25,$treatment25,'25','y');			


												$box126=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+13)."';");
												$box226=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+13)."';");
												$up26=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+13)."';");
												$left26=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+13)."';");
												$center26=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+13)."';");
												$right26=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+13)."';");
												$down26=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+13)."';");
												$treatment26=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+13)."';");

												echo $this->GraficarDiente($box126,$box226,$up26,$left26,$center26,$right26,$down26,$treatment26,'26','y');


												$box127=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+14)."';");
												$box227=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+14)."';");
												$up27=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+14)."';");
												$left27=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+14)."';");
												$center27=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+14)."';");
												$right27=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+14)."';");
												$down27=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+14)."';");
												$treatment27=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+14)."';");

												echo $this->GraficarDiente($box127,$box227,$up27,$left27,$center27,$right27,$down27,$treatment27,'27','y');


												$box128=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+15)."';");
												$box228=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+15)."';");
												$up28=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+15)."';");
												$left28=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+15)."';");
												$center28=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+15)."';");
												$right28=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+15)."';");
												$down28=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+15)."';");
												$treatment28=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+15)."';");

												echo $this->GraficarDiente($box128,$box228,$up28,$left28,$center28,$right28,$down28,$treatment28,'28','y');	


												echo "</tr>
												<tr>

													<td rowspan='2'>
														Lingual
													</td>


													<td colspa='2'></td>


													";	
													$box155=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+16)."';");
													$box255=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+16)."';");
													$up55=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+16)."';");
													$left55=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+16)."';");
													$center55=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+16)."';");
													$right55=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+16)."';");
													$down55=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+16)."';");
													$treatment55=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+16)."';");

													echo $this->GraficarDiente($box155,$box255,$up55,$left55,$center55,$right55,$down55,$treatment55,'55','');


													$box154=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+17)."';");
													$box254=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+17)."';");
													$up54=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+17)."';");
													$left54=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+17)."';");
													$center54=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+17)."';");
													$right54=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+17)."';");
													$down54=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+17)."';");
													$treatment54=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+17)."';");

													echo $this->GraficarDiente($box154,$box254,$up54,$left54,$center54,$right54,$down54,$treatment54,'54','');		


													$box153=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+18)."';");
													$box253=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+18)."';");
													$up53=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+18)."';");
													$left53=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+18)."';");
													$center53=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+18)."';");
													$right53=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+18)."';");
													$down53=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+18)."';");
													$treatment53=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+18)."';");

													echo $this->GraficarDiente($box153,$box253,$up53,$left53,$center53,$right53,$down53,$treatment53,'53','');



													$box152=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+19)."';");
													$box252=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+19)."';");
													$up52=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+19)."';");
													$left52=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+19)."';");
													$center52=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+19)."';");
													$right52=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+19)."';");
													$down52=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+19)."';");
													$treatment52=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+19)."';");

													echo $this->GraficarDiente($box152,$box252,$up52,$left52,$center52,$right52,$down52,$treatment52,'52','');

													$box151=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+20)."';");
													$box251=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+20)."';");
													$up51=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+20)."';");
													$left51=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+20)."';");
													$center51=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+20)."';");
													$right51=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+20)."';");
													$down51=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+20)."';");
													$treatment51=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+20)."';");

													echo $this->GraficarDiente($box151,$box251,$up51,$left51,$center51,$right51,$down51,$treatment51,'51','');

													echo "				<td colspan='7'>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												</td>						
												";

												$box161=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+21)."';");
												$box261=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+21)."';");
												$up61=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+21)."';");
												$left61=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+21)."';");
												$center61=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+21)."';");
												$right61=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+21)."';");
												$down61=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+21)."';");
												$treatment61=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+21)."';");

												echo $this->GraficarDiente($box161,$box261,$up61,$left61,$center61,$right61,$down61,$treatment61,'61','');



												$box162=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+22)."';");
												$box262=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+22)."';");
												$up62=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+22)."';");
												$left62=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+22)."';");
												$center62=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+22)."';");
												$right62=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+22)."';");
												$down62=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+22)."';");
												$treatment62=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+22)."';");

												echo $this->GraficarDiente($box162,$box262,$up62,$left62,$center62,$right62,$down62,$treatment62,'62','');


												$box163=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+23)."';");
												$box263=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+23)."';");
												$up63=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+23)."';");
												$left63=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+23)."';");
												$center63=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+23)."';");
												$right63=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+23)."';");
												$down63=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+23)."';");
												$treatment63=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+23)."';");

												echo $this->GraficarDiente($box163,$box263,$up63,$left63,$center63,$right63,$down63,$treatment63,'63','');



												$box164=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+24)."';");
												$box264=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+24)."';");
												$up64=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+24)."';");
												$left64=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+24)."';");
												$center64=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+24)."';");
												$right64=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+24)."';");
												$down64=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+24)."';");
												$treatment64=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+24)."';");

												echo $this->GraficarDiente($box164,$box264,$up64,$left64,$center64,$right64,$down64,$treatment64,'64','');


												$box165=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+25)."';");
												$box265=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+25)."';");
												$up65=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+25)."';");
												$left65=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+25)."';");
												$center65=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+25)."';");
												$right65=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+25)."';");
												$down65=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+25)."';");
												$treatment65=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+25)."';");

												echo $this->GraficarDiente($box165,$box265,$up65,$left65,$center65,$right65,$down65,$treatment65,'65','');

												echo "<td></td></tr><tr> <td colspa='2'></td>";


												$box185=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+26)."';");
												$box285=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+26)."';");
												$up85=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+26)."';");
												$left85=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+26)."';");
												$center85=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+26)."';");
												$right85=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+26)."';");
												$down85=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+26)."';");
												$treatment85=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+26)."';");

												echo $this->GraficarDiente($box185,$box285,$up85,$left85,$center85,$right85,$down85,$treatment85,'85','');


												$box184=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+27)."';");
												$box284=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+27)."';");
												$up84=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+27)."';");
												$left84=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+27)."';");
												$center84=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+27)."';");
												$right84=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+27)."';");
												$down84=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+27)."';");
												$treatment84=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+27)."';");

												echo $this->GraficarDiente($box184,$box284,$up84,$left84,$center84,$right84,$down84,$treatment84,'84','');


												$box183=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+28)."';");
												$box283=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+28)."';");
												$up83=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+28)."';");
												$left83=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+28)."';");
												$center83=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+28)."';");
												$right83=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+28)."';");
												$down83=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+28)."';");
												$treatment83=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+28)."';");

												echo $this->GraficarDiente($box183,$box283,$up83,$left83,$center83,$right83,$down83,$treatment83,'83','');


												$box182=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+29)."';");
												$box282=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+29)."';");
												$up82=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+29)."';");
												$left82=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+29)."';");
												$center82=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+29)."';");
												$right82=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+29)."';");
												$down82=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+29)."';");
												$treatment82=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+29)."';");

												echo $this->GraficarDiente($box182,$box282,$up82,$left82,$center82,$right82,$down82,$treatment82,'82','');


												$box181=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+30)."';");
												$box281=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+30)."';");
												$up81=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+30)."';");
												$left81=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+30)."';");
												$center81=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+30)."';");
												$right81=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+30)."';");
												$down81=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+30)."';");
												$treatment81=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+30)."';");

												echo $this->GraficarDiente($box181,$box281,$up81,$left81,$center81,$right81,$down81,$treatment81,'81','');

												echo "				<td colspan='7'>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											</td>						
											";

											$box171=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+31)."';");
											$box271=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+31)."';");
											$up71=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+31)."';");
											$left71=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+31)."';");
											$center71=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+31)."';");
											$right71=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+31)."';");
											$down71=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+31)."';");
											$treatment71=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+31)."';");

											echo $this->GraficarDiente($box171,$box271,$up71,$left71,$center71,$right71,$down71,$treatment71,'71','');


											$box172=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+32)."';");
											$box272=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+32)."';");
											$up72=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+32)."';");
											$left72=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+32)."';");
											$center72=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+32)."';");
											$right72=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+32)."';");
											$down72=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+32)."';");
											$treatment72=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+32)."';");

											echo $this->GraficarDiente($box172,$box272,$up72,$left72,$center72,$right72,$down72,$treatment72,'72','');



											$box173=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+33)."';");
											$box273=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+33)."';");
											$up73=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+33)."';");
											$left73=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+33)."';");
											$center73=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+33)."';");
											$right73=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+33)."';");
											$down73=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+33)."';");
											$treatment73=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+33)."';");

											echo $this->GraficarDiente($box173,$box273,$up73,$left73,$center73,$right73,$down73,$treatment73,'73','');



											$box174=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+34)."';");
											$box274=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+34)."';");
											$up74=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+34)."';");
											$left74=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+34)."';");
											$center74=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+34)."';");
											$right74=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+34)."';");
											$down74=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+34)."';");
											$treatment74=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+34)."';");

											echo $this->GraficarDiente($box174,$box274,$up74,$left74,$center74,$right74,$down74,$treatment74,'74','');


											$box175=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+35)."';");
											$box275=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+35)."';");
											$up75=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+35)."';");
											$left75=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+35)."';");
											$center75=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+35)."';");
											$right75=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+35)."';");
											$down75=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+35)."';");
											$treatment75=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+35)."';");

											echo $this->GraficarDiente($box175,$box275,$up75,$left75,$center75,$right75,$down75,$treatment75,'75','');	
											echo "<td></td></tr><tr>
											<td>

												<table>
													<tr><td>&nbsp;</td></tr>
													<tr><td>Recesion</td></tr>
													<tr><td>Movilidad</td></tr>
													<tr><td>&nbsp;</td></tr>
													<tr><td>Vestibular</td></tr>
													<tr><td>&nbsp;</td></tr>
												</table>
											</td>
											";

											$box148=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+36)."';");
											$box248=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+36)."';");
											$up48=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+36)."';");
											$left48=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+36)."';");
											$center48=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+36)."';");
											$right48=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+36)."';");
											$down48=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+36)."';");
											$treatment48=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+36)."';");

											echo $this->GraficarDiente($box148,$box248,$up48,$left48,$center48,$right48,$down48,$treatment48,'48','y');	

											$box147=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+37)."';");
											$box247=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+37)."';");
											$up47=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+37)."';");
											$left47=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+37)."';");
											$center47=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+37)."';");
											$right47=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+37)."';");
											$down47=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+37)."';");
											$treatment47=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+37)."';");

											echo $this->GraficarDiente($box147,$box247,$up47,$left47,$center47,$right47,$down47,$treatment47,'47','y');	


											$box146=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+38)."';");
											$box246=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+38)."';");
											$up46=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+38)."';");
											$left46=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+38)."';");
											$center46=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+38)."';");
											$right46=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+38)."';");
											$down46=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+38)."';");
											$treatment46=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+38)."';");

											echo $this->GraficarDiente($box146,$box246,$up46,$left46,$center46,$right46,$down46,$treatment46,'46','y');		


											$box145=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+39)."';");
											$box245=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+39)."';");
											$up45=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+39)."';");
											$left45=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+39)."';");
											$center45=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+39)."';");
											$right45=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+39)."';");
											$down45=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+39)."';");
											$treatment45=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+39)."';");

											echo $this->GraficarDiente($box145,$box245,$up45,$left45,$center45,$right45,$down45,$treatment45,'45','y');		



											$box144=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+401)."';");
											$box244=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+40)."';");
											$up44=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+40)."';");
											$left44=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+40)."';");
											$center44=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+40)."';");
											$right44=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+40)."';");
											$down44=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+40)."';");
											$treatment44=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+40)."';");

											echo $this->GraficarDiente($box144,$box244,$up44,$left44,$center44,$right44,$down44,$treatment44,'44','y');		


											$box143=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+41)."';");
											$box243=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+41)."';");
											$up43=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+41)."';");
											$left43=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+41)."';");
											$center43=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+41)."';");
											$right43=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+41)."';");
											$down43=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+41)."';");
											$treatment43=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+41)."';");

											echo $this->GraficarDiente($box143,$box243,$up43,$left43,$center43,$right43,$down43,$treatment43,'43','y');		


											$box142=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+42)."';");
											$box242=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+42)."';");
											$up42=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+42)."';");
											$left42=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+42)."';");
											$center42=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+42)."';");
											$right42=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+42)."';");
											$down42=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+42)."';");
											$treatment42=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+42)."';");

											echo $this->GraficarDiente($box142,$box242,$up42,$left42,$center42,$right42,$down42,$treatment42,'42','y');		


											$box141=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+43)."';");
											$box241=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+43)."';");
											$up41=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+43)."';");
											$left41=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+43)."';");
											$center41=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+43)."';");
											$right41=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+43)."';");
											$down41=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+43)."';");
											$treatment41=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+43)."';");

											echo $this->GraficarDiente($box141,$box241,$up41,$left41,$center41,$right41,$down41,$treatment41,'41','y');			


											echo "				<td colspan='3'>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										</td>		";

										$box131=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+44)."';");
										$box231=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+44)."';");
										$up31=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+44)."';");
										$left31=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+44)."';");
										$center31=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+44)."';");
										$right31=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+44)."';");
										$down31=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+44)."';");
										$treatment31=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+44)."';");

										echo $this->GraficarDiente($box131,$box231,$up31,$left31,$center31,$right31,$down31,$treatment31,'31','y');

										$box132=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+45)."';");
										$box232=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+45)."';");
										$up32=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+45)."';");
										$left32=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+45)."';");
										$center32=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+45)."';");
										$right32=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+45)."';");
										$down32=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+45)."';");
										$treatment32=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+45)."';");

										echo $this->GraficarDiente($box132,$box232,$up32,$left32,$center32,$right32,$down32,$treatment32,'32','y');


										$box133=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+46)."';");
										$box233=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+46)."';");
										$up33=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+46)."';");
										$left33=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+46)."';");
										$center33=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+46)."';");
										$right33=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+46)."';");
										$down33=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+46)."';");
										$treatment33=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+46)."';");

										echo $this->GraficarDiente($box133,$box233,$up33,$left33,$center33,$right33,$down33,$treatment33,'33','y');	


										$box134=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+47)."';");
										$box234=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+47)."';");
										$up34=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+47)."';");
										$left34=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+47)."';");
										$center34=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+47)."';");
										$right34=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+47)."';");
										$down34=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+47)."';");
										$treatment34=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+47)."';");

										echo $this->GraficarDiente($box134,$box234,$up34,$left34,$center34,$right34,$down34,$treatment34,'34','y');	



										$box135=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+48)."';");
										$box235=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+48)."';");
										$up35=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+48)."';");
										$left35=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+48)."';");
										$center35=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+48)."';");
										$right35=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+48)."';");
										$down35=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+48)."';");
										$treatment35=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+48)."';");

										echo $this->GraficarDiente($box135,$box235,$up35,$left35,$center35,$right35,$down35,$treatment35,'35','y');	



										$box136=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+49)."';");
										$box236=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+49)."';");
										$up36=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+49)."';");
										$left36=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+49)."';");
										$center36=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+49)."';");
										$right36=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+49)."';");
										$down36=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+49)."';");
										$treatment36=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+49)."';");

										echo $this->GraficarDiente($box136,$box236,$up36,$left36,$center36,$right36,$down36,$treatment36,'36','y');	

										$box137=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+50)."';");
										$box237=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+50)."';");
										$up37=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+50)."';");
										$left37=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+50)."';");
										$center37=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+50)."';");
										$right37=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+50)."';");
										$down37=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+50)."';");
										$treatment37=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+50)."';");

										echo $this->GraficarDiente($box137,$box237,$up37,$left37,$center37,$right37,$down37,$treatment37,'37','y');	


										$box138=$odo->Consultar("SELECT box1  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+51)."';");
										$box238=$odo->Consultar("SELECT box2  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+51)."';");
										$up38=$odo->Consultar("SELECT  up  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+51)."';");
										$left38=$odo->Consultar("SELECT  `left`  FROM tbl_odontogramadarwin WHERE id_odo='".($idini+51)."';");
										$center38=$odo->Consultar("SELECT center FROM tbl_odontogramadarwin WHERE id_odo='".($idini+51)."';");
										$right38=$odo->Consultar("SELECT `right` FROM tbl_odontogramadarwin WHERE id_odo='".($idini+51)."';");
										$down38=$odo->Consultar("SELECT down FROM tbl_odontogramadarwin WHERE id_odo='".($idini+51)."';");
										$treatment38=$odo->Consultar("SELECT treatment FROM tbl_odontogramadarwin WHERE id_odo='".($idini+51)."';");

										echo $this->GraficarDiente($box138,$box238,$up38,$left38,$center38,$right38,$down38,$treatment38,'38','y');	


//mauricio




										echo "</tr></table></center>";

										echo $this->PrintJavascript();


									}
								}


//metodo para almacenar la dentadura
								public function GuardarOdontogramaLIGHT5($dentadura){
									$ododarwin=new OdontogramaDarwin;

		//decodificando a un vector para recorrerlo por un foreach
									$dientes=json_decode($dentadura);

									foreach($dientes as $diente){
										$res=$ododarwin->Ejecutar("INSERT INTO tbl_odontogramadarwin  
											VALUES ('','".$diente->up."','".$diente->right."','".$diente->down."','".$diente->left."','".$diente->center."','".$diente->box1."','".$diente->box2."','".$diente->treatment."','".$diente->tooth."','".$diente->person."');");		
									}
									echo "<center><h3>Se guardo correctamente el odontograma del paciente</h3></center>";
								}
//fin metodo para almacenar la dentadura


//metodo para graficar diente y cajas
								public function GraficarDiente($box1,$box2,$up,$left,$center,$right,$down,$treatment,$Ndiente,$textb){


									echo "<td>";
									echo "<table cellpadding='0' cellspacing='0' border='1'>
									<tr>
										<td colspan='3'>$Ndiente</td>
									</tr>";
									if($textb=="y"){
										echo "
										<tr>
											<td colspan='3'><input type='text' id='txtdtre".$Ndiente."' style='width:16px;' value='$box1'/></td>
										</tr>
										<tr>
											<td colspan='3'><input type='text' id='txtdMo".$Ndiente."' style='width:16px;' value='$box2'/></td>
										</tr>";
									}


									echo "<tr> <td>&nbsp;</td>";
									switch ($up) {
										case '':
										echo "<td><img src='resource/db.fw.png' class='ab' id='dA_$Ndiente' /></td>";
										break;
										case '1':
										echo "<td><img src='resource/da.fw.png' class='ab' id='dA_$Ndiente' /></td>";
										break;

										case '2':
										echo "<td><img src='resource/dr.fw.png' class='ab' id='dA_$Ndiente' /></td>";
										break;
									}		
									echo "<td>&nbsp;</td></tr>";
									echo "
									<script type='text/javascript'>
										$('#txt_da_$Ndiente').val('$up');
									</script>
									";
									echo "<tr>";
									switch ($left) {
										case '':
										echo "<td><img src='resource/db.fw.png' id='dI_$Ndiente'/></td>";
										break;

										case '1':
										echo "<td><img src='resource/da.fw.png' id='dI_$Ndiente'/></td>";
										break;

										case '2':
										echo "<td><img src='resource/dr.fw.png' id='dI_$Ndiente'/></td>";
										break;	
									}
									switch ($center) {
										case '':
										echo "<td><img src='resource/db.fw.png' id='dC_$Ndiente'/></td>";
										break;

										case '1':
										echo "<td><img src='resource/da.fw.png' id='dC_$Ndiente'/></td>";
										break;
										case '2':
										echo "<td><img src='resource/dr.fw.png' id='dC_$Ndiente'/></td>";
										break;
									}
									switch ($right) {
										case '':
										echo "<td><img src='resource/db.fw.png' id='dD_$Ndiente'/></td>";
										break;

										case '1':
										echo "<td><img src='resource/da.fw.png' id='dD_$Ndiente'/></td>";
										break;
										case '2':
										echo "<td><img src='resource/dr.fw.png' id='dD_$Ndiente'/></td>";
										break;
									}
									echo "</tr>
									<script type='text/javascript'>
										$('#txt_di_$Ndiente').val('$left');
										$('#txt_dc_$Ndiente').val('$center');
										$('#txt_dd_$Ndiente').val('$right');
									</script>
									";
									echo "<tr><td>&nbsp;</td>";
									switch ($down) {
										case '':
										echo "<td><img src='resource/db.fw.png' class='ar' id='daB_$Ndiente'/></td>";
										break;

										case '1':
										echo "<td><img src='resource/da.fw.png' class='ar' id='daB_$Ndiente'/></td>";
										break;

										case '2':
										echo "<td><img src='resource/dr.fw.png' class='ar' id='daB_$Ndiente'/></td>";
										break;
									}
									echo "<td>&nbsp;</td></tr>
									<script type='type/javascript'>
										$('#txt_dab_$Ndiente').val('$down');
									</script>
									";
									echo "	
								</table>
								";

								echo "<table><tr><td id='_$Ndiente'>";
								if($treatment!=""){
									$vec=explode(',', $treatment);

									$numt=count($vec);
									$tratamientos18="";
									for($x=0;$x<$numt;$x++){
										if($vec[$x]=="1"){
											$tratamientos18="<i class='ims1_$Ndiente'><img src='resource/si2.fw.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="2"){
											$tratamientos18="<i class='ims2_$Ndiente'><img src='resource/s2.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="3"){
											$tratamientos18="<i class='ims3_$Ndiente'><img src='resource/s1.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="4"){
											$tratamientos18="<i class='ims4_$Ndiente'><img src='resource/s3.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="5"){
											$tratamientos18="<i class='ims5_$Ndiente'><img src='resource/s5.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="6"){
											$tratamientos18="<i class='ims6_$Ndiente'><img src='resource/si1.fw.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="7"){
											$tratamientos18="<i class='ims7_$Ndiente'><img src='resource/s6.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="8"){
											$tratamientos18="<i class='ims8_$Ndiente'><img src='resource/s7.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="9"){
											$tratamientos18="<i class='ims9_$Ndiente'><img src='resource/s8.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="10"){
											$tratamientos18="<i class='ims10_$Ndiente'><img src='resource/s9.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="11"){
											$tratamientos18="<i class='ims11_$Ndiente'><img src='resource/s9.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="12"){
											$tratamientos18="<i class='ims12_$Ndiente'><img src='resource/s10.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="13"){
											$tratamientos18="<i class='ims13_$Ndiente'><img src='resource/s11.png'/></i>".$tratamientos18;
										}
										if($vec[$x]=="14"){
											$tratamientos18="<i class='ims14_$Ndiente'><img src='resource/s12.png'/></i>".$tratamientos18;
										}
									}
									echo $tratamientos18;

								}		

								echo "</td></tr></table>
								<script type='text/javascript'>
									$('#sim_$Ndiente').val('$treatment');
								</script>
								";	
								echo "</td>";



							}
//fin metodo para graficar diente y cajas

							public function PrintJavascript(){
								echo"	<script type='text/javascript'>
								$('#dA_18').click(function(){
									var codigo=$('#txt_da_18').val(); 
									CambiarColorDientes(codigo,'txt_da_18','dA_18',1);      
								});
								$('#dD_18').click(function(){
									var codigo1=$('#txt_dd_18').val();  
									CambiarColorDientes(codigo1,'txt_dd_18','dD_18',2); 
								});
								$('#daB_18').click(function(){
									var codigo2=$('#txt_dab_18').val(); 
									CambiarColorDientes(codigo2,'txt_dab_18','daB_18',3); 
								});
								$('#dI_18').click(function(){
									var codigo3=$('#txt_di_18').val();  
									CambiarColorDientes(codigo3,'txt_di_18','dI_18',4); 
								});
								$('#dC_18').click(function(){
									var codigo4=$('#txt_dc_18').val();  
									CambiarColorDientes(codigo4,'txt_dc_18','dC_18',5); 
								});


								$('#dA_17').click(function(){
									var codigo=$('#txt_da_17').val(); 
									CambiarColorDientes(codigo,'txt_da_17','dA_17',1);      
								});
								$('#dD_17').click(function(){
									var codigo1=$('#txt_dd_17').val();  
									CambiarColorDientes(codigo1,'txt_dd_17','dD_17',2); 
								});
								$('#daB_17').click(function(){
									var codigo2=$('#txt_dab_17').val(); 
									CambiarColorDientes(codigo2,'txt_dab_17','daB_17',3); 
								});
								$('#dI_17').click(function(){
									var codigo3=$('#txt_di_17').val();  
									CambiarColorDientes(codigo3,'txt_di_17','dI_17',4); 
								});
								$('#dC_17').click(function(){
									var codigo4=$('#txt_dc_17').val();  
									CambiarColorDientes(codigo4,'txt_dc_17','dC_17',5); 
								});						





								$('#dA_16').click(function(){
									var codigo=$('#txt_da_16').val(); 
									CambiarColorDientes(codigo,'txt_da_16','dA_16',1);      
								});
								$('#dD_16').click(function(){
									var codigo1=$('#txt_dd_16').val();  
									CambiarColorDientes(codigo1,'txt_dd_16','dD_16',2); 
								});
								$('#daB_16').click(function(){
									var codigo2=$('#txt_dab_16').val(); 
									CambiarColorDientes(codigo2,'txt_dab_16','daB_16',3); 
								});
								$('#dI_16').click(function(){
									var codigo3=$('#txt_di_16').val();  
									CambiarColorDientes(codigo3,'txt_di_16','dI_16',4); 
								});
								$('#dC_16').click(function(){
									var codigo4=$('#txt_dc_16').val();  
									CambiarColorDientes(codigo4,'txt_dc_16','dC_16',5); 
								});	



								$('#dA_15').click(function(){
									var codigo=$('#txt_da_15').val(); 
									CambiarColorDientes(codigo,'txt_da_15','dA_15',1);      
								});
								$('#dD_15').click(function(){
									var codigo1=$('#txt_dd_15').val();  
									CambiarColorDientes(codigo1,'txt_dd_15','dD_15',2); 
								});
								$('#daB_15').click(function(){
									var codigo2=$('#txt_dab_15').val(); 
									CambiarColorDientes(codigo2,'txt_dab_15','daB_15',3); 
								});
								$('#dI_15').click(function(){
									var codigo3=$('#txt_di_15').val();  
									CambiarColorDientes(codigo3,'txt_di_15','dI_15',4); 
								});
								$('#dC_15').click(function(){
									var codigo4=$('#txt_dc_15').val();  
									CambiarColorDientes(codigo4,'txt_dc_15','dC_15',5); 
								});														


								$('#dA_14').click(function(){
									var codigo=$('#txt_da_14').val(); 
									CambiarColorDientes(codigo,'txt_da_14','dA_14',1);      
								});
								$('#dD_14').click(function(){
									var codigo1=$('#txt_dd_14').val();  
									CambiarColorDientes(codigo1,'txt_dd_14','dD_14',2); 
								});
								$('#daB_14').click(function(){
									var codigo2=$('#txt_dab_14').val(); 
									CambiarColorDientes(codigo2,'txt_dab_14','daB_14',3); 
								});
								$('#dI_14').click(function(){
									var codigo3=$('#txt_di_14').val();  
									CambiarColorDientes(codigo3,'txt_di_14','dI_14',4); 
								});
								$('#dC_14').click(function(){
									var codigo4=$('#txt_dc_14').val();  
									CambiarColorDientes(codigo4,'txt_dc_14','dC_14',5); 
								});		


								$('#dA_13').click(function(){
									var codigo=$('#txt_da_13').val(); 
									CambiarColorDientes(codigo,'txt_da_13','dA_13',1);      
								});
								$('#dD_13').click(function(){
									var codigo1=$('#txt_dd_13').val();  
									CambiarColorDientes(codigo1,'txt_dd_13','dD_13',2); 
								});
								$('#daB_13').click(function(){
									var codigo2=$('#txt_dab_13').val(); 
									CambiarColorDientes(codigo2,'txt_dab_13','daB_13',3); 
								});
								$('#dI_13').click(function(){
									var codigo3=$('#txt_di_13').val();  
									CambiarColorDientes(codigo3,'txt_di_13','dI_13',4); 
								});
								$('#dC_13').click(function(){
									var codigo4=$('#txt_dc_13').val();  
									CambiarColorDientes(codigo4,'txt_dc_13','dC_13',5); 
								});											



								";
								echo "

								$('#dA_12').click(function(){
									var codigo=$('#txt_da_12').val(); 
									CambiarColorDientes(codigo,'txt_da_12','dA_12',1);      
								});
								$('#dD_12').click(function(){
									var codigo1=$('#txt_dd_12').val();  
									CambiarColorDientes(codigo1,'txt_dd_12','dD_12',2); 
								});
								$('#daB_12').click(function(){
									var codigo2=$('#txt_dab_12').val(); 
									CambiarColorDientes(codigo2,'txt_dab_12','daB_12',3); 
								});
								$('#dI_12').click(function(){
									var codigo3=$('#txt_di_12').val();  
									CambiarColorDientes(codigo3,'txt_di_12','dI_12',4); 
								});
								$('#dC_12').click(function(){
									var codigo4=$('#txt_dc_12').val();  
									CambiarColorDientes(codigo4,'txt_dc_12','dC_12',5); 
								});			




								$('#dA_11').click(function(){
									var codigo=$('#txt_da_11').val(); 
									CambiarColorDientes(codigo,'txt_da_11','dA_11',1);      
								});
								$('#dD_11').click(function(){
									var codigo1=$('#txt_dd_11').val();  
									CambiarColorDientes(codigo1,'txt_dd_11','dD_11',2); 
								});
								$('#daB_11').click(function(){
									var codigo2=$('#txt_dab_11').val(); 
									CambiarColorDientes(codigo2,'txt_dab_11','daB_11',3); 
								});
								$('#dI_11').click(function(){
									var codigo3=$('#txt_di_11').val();  
									CambiarColorDientes(codigo3,'txt_di_11','dI_11',4); 
								});
								$('#dC_11').click(function(){
									var codigo4=$('#txt_dc_11').val();  
									CambiarColorDientes(codigo4,'txt_dc_11','dC_11',5); 
								});	


								$('#dA_21').click(function(){
									var codigo=$('#txt_da_21').val(); 
									CambiarColorDientes(codigo,'txt_da_21','dA_21',1);      
								});
								$('#dD_21').click(function(){
									var codigo1=$('#txt_dd_21').val();  
									CambiarColorDientes(codigo1,'txt_dd_21','dD_21',2); 
								});
								$('#daB_21').click(function(){
									var codigo2=$('#txt_dab_21').val(); 
									CambiarColorDientes(codigo2,'txt_dab_21','daB_21',3); 
								});
								$('#dI_21').click(function(){
									var codigo3=$('#txt_di_21').val();  
									CambiarColorDientes(codigo3,'txt_di_21','dI_21',4); 
								});
								$('#dC_21').click(function(){
									var codigo4=$('#txt_dc_21').val();  
									CambiarColorDientes(codigo4,'txt_dc_21','dC_21',5); 
								});	


								$('#dA_22').click(function(){
									var codigo=$('#txt_da_22').val(); 
									CambiarColorDientes(codigo,'txt_da_22','dA_22',1);      
								});
								$('#dD_22').click(function(){
									var codigo1=$('#txt_dd_22').val();  
									CambiarColorDientes(codigo1,'txt_dd_22','dD_22',2); 
								});
								$('#daB_22').click(function(){
									var codigo2=$('#txt_dab_22').val(); 
									CambiarColorDientes(codigo2,'txt_dab_22','daB_22',3); 
								});
								$('#dI_22').click(function(){
									var codigo3=$('#txt_di_22').val();  
									CambiarColorDientes(codigo3,'txt_di_22','dI_22',4); 
								});
								$('#dC_22').click(function(){
									var codigo4=$('#txt_dc_22').val();  
									CambiarColorDientes(codigo4,'txt_dc_22','dC_22',5); 
								});							

								$('#dA_23').click(function(){
									var codigo=$('#txt_da_23').val(); 
									CambiarColorDientes(codigo,'txt_da_23','dA_23',1);      
								});
								$('#dD_23').click(function(){
									var codigo1=$('#txt_dd_23').val();  
									CambiarColorDientes(codigo1,'txt_dd_23','dD_23',2); 
								});
								$('#daB_23').click(function(){
									var codigo2=$('#txt_dab_23').val(); 
									CambiarColorDientes(codigo2,'txt_dab_23','daB_23',3); 
								});
								$('#dI_23').click(function(){
									var codigo3=$('#txt_di_23').val();  
									CambiarColorDientes(codigo3,'txt_di_23','dI_23',4); 
								});
								$('#dC_23').click(function(){
									var codigo4=$('#txt_dc_23').val();  
									CambiarColorDientes(codigo4,'txt_dc_23','dC_23',5); 
								});																											



								$('#dA_24').click(function(){
									var codigo=$('#txt_da_24').val(); 
									CambiarColorDientes(codigo,'txt_da_24','dA_24',1);      
								});
								$('#dD_24').click(function(){
									var codigo1=$('#txt_dd_24').val();  
									CambiarColorDientes(codigo1,'txt_dd_24','dD_24',2); 
								});
								$('#daB_24').click(function(){
									var codigo2=$('#txt_dab_24').val(); 
									CambiarColorDientes(codigo2,'txt_dab_24','daB_24',3); 
								});
								$('#dI_24').click(function(){
									var codigo3=$('#txt_di_24').val();  
									CambiarColorDientes(codigo3,'txt_di_24','dI_24',4); 
								});
								$('#dC_24').click(function(){
									var codigo4=$('#txt_dc_24').val();  
									CambiarColorDientes(codigo4,'txt_dc_24','dC_24',5); 
								});




								$('#dA_25').click(function(){
									var codigo=$('#txt_da_25').val(); 
									CambiarColorDientes(codigo,'txt_da_25','dA_25',1);      
								});
								$('#dD_25').click(function(){
									var codigo1=$('#txt_dd_25').val();  
									CambiarColorDientes(codigo1,'txt_dd_25','dD_25',2); 
								});
								$('#daB_25').click(function(){
									var codigo2=$('#txt_dab_25').val(); 
									CambiarColorDientes(codigo2,'txt_dab_25','daB_25',3); 
								});
								$('#dI_25').click(function(){
									var codigo3=$('#txt_di_25').val();  
									CambiarColorDientes(codigo3,'txt_di_25','dI_25',4); 
								});
								$('#dC_25').click(function(){
									var codigo4=$('#txt_dc_25').val();  
									CambiarColorDientes(codigo4,'txt_dc_25','dC_25',5); 
								});



								$('#dA_26').click(function(){
									var codigo=$('#txt_da_26').val(); 
									CambiarColorDientes(codigo,'txt_da_26','dA_26',1);      
								});
								$('#dD_26').click(function(){
									var codigo1=$('#txt_dd_26').val();  
									CambiarColorDientes(codigo1,'txt_dd_26','dD_26',2); 
								});
								$('#daB_26').click(function(){
									var codigo2=$('#txt_dab_26').val(); 
									CambiarColorDientes(codigo2,'txt_dab_26','daB_26',3); 
								});
								$('#dI_26').click(function(){
									var codigo3=$('#txt_di_26').val();  
									CambiarColorDientes(codigo3,'txt_di_26','dI_26',4); 
								});
								$('#dC_26').click(function(){
									var codigo4=$('#txt_dc_26').val();  
									CambiarColorDientes(codigo4,'txt_dc_26','dC_26',5); 
								});	



								$('#dA_27').click(function(){
									var codigo=$('#txt_da_27').val(); 
									CambiarColorDientes(codigo,'txt_da_27','dA_27',1);      
								});
								$('#dD_27').click(function(){
									var codigo1=$('#txt_dd_27').val();  
									CambiarColorDientes(codigo1,'txt_dd_27','dD_27',2); 
								});
								$('#daB_27').click(function(){
									var codigo2=$('#txt_dab_27').val(); 
									CambiarColorDientes(codigo2,'txt_dab_27','daB_27',3); 
								});
								$('#dI_27').click(function(){
									var codigo3=$('#txt_di_27').val();  
									CambiarColorDientes(codigo3,'txt_di_27','dI_27',4); 
								});
								$('#dC_27').click(function(){
									var codigo4=$('#txt_dc_27').val();  
									CambiarColorDientes(codigo4,'txt_dc_27','dC_27',5); 
								});


								$('#dA_28').click(function(){
									var codigo=$('#txt_da_28').val(); 
									CambiarColorDientes(codigo,'txt_da_28','dA_28',1);      
								});
								$('#dD_28').click(function(){
									var codigo1=$('#txt_dd_28').val();  
									CambiarColorDientes(codigo1,'txt_dd_28','dD_28',2); 
								});
								$('#daB_28').click(function(){
									var codigo2=$('#txt_dab_28').val(); 
									CambiarColorDientes(codigo2,'txt_dab_28','daB_28',3); 
								});
								$('#dI_28').click(function(){
									var codigo3=$('#txt_di_28').val();  
									CambiarColorDientes(codigo3,'txt_di_28','dI_28',4); 
								});
								$('#dC_28').click(function(){
									var codigo4=$('#txt_dc_28').val();  
									CambiarColorDientes(codigo4,'txt_dc_28','dC_28',5); 
								});	



								$('#dA_55').click(function(){
									var codigo=$('#txt_da_55').val(); 
									CambiarColorDientes(codigo,'txt_da_55','dA_55',1);      
								});
								$('#dD_55').click(function(){
									var codigo1=$('#txt_dd_55').val();  
									CambiarColorDientes(codigo1,'txt_dd_55','dD_55',2); 
								});
								$('#daB_55').click(function(){
									var codigo2=$('#txt_dab_55').val(); 
									CambiarColorDientes(codigo2,'txt_dab_55','daB_55',3); 
								});
								$('#dI_55').click(function(){
									var codigo3=$('#txt_di_55').val();  
									CambiarColorDientes(codigo3,'txt_di_55','dI_55',4); 
								});
								$('#dC_55').click(function(){
									var codigo4=$('#txt_dc_55').val();  
									CambiarColorDientes(codigo4,'txt_dc_55','dC_55',5); 
								});																																																									



								";

								echo "

								$('#dA_54').click(function(){
									var codigo=$('#txt_da_54').val(); 
									CambiarColorDientes(codigo,'txt_da_54','dA_54',1);      
								});
								$('#dD_54').click(function(){
									var codigo1=$('#txt_dd_54').val();  
									CambiarColorDientes(codigo1,'txt_dd_54','dD_54',2); 
								});
								$('#daB_54').click(function(){
									var codigo2=$('#txt_dab_54').val(); 
									CambiarColorDientes(codigo2,'txt_dab_54','daB_54',3); 
								});
								$('#dI_54').click(function(){
									var codigo3=$('#txt_di_54').val();  
									CambiarColorDientes(codigo3,'txt_di_54','dI_54',4); 
								});
								$('#dC_54').click(function(){
									var codigo4=$('#txt_dc_54').val();  
									CambiarColorDientes(codigo4,'txt_dc_54','dC_54',5); 
								});		




								$('#dA_53').click(function(){
									var codigo=$('#txt_da_53').val(); 
									CambiarColorDientes(codigo,'txt_da_53','dA_53',1);      
								});
								$('#dD_53').click(function(){
									var codigo1=$('#txt_dd_53').val();  
									CambiarColorDientes(codigo1,'txt_dd_53','dD_53',2); 
								});
								$('#daB_53').click(function(){
									var codigo2=$('#txt_dab_53').val(); 
									CambiarColorDientes(codigo2,'txt_dab_53','daB_53',3); 
								});
								$('#dI_53').click(function(){
									var codigo3=$('#txt_di_53').val();  
									CambiarColorDientes(codigo3,'txt_di_53','dI_53',4); 
								});
								$('#dC_53').click(function(){
									var codigo4=$('#txt_dc_53').val();  
									CambiarColorDientes(codigo4,'txt_dc_53','dC_53',5); 
								});	



								$('#dA_52').click(function(){
									var codigo=$('#txt_da_52').val(); 
									CambiarColorDientes(codigo,'txt_da_52','dA_52',1);      
								});
								$('#dD_52').click(function(){
									var codigo1=$('#txt_dd_52').val();  
									CambiarColorDientes(codigo1,'txt_dd_52','dD_52',2); 
								});
								$('#daB_52').click(function(){
									var codigo2=$('#txt_dab_52').val(); 
									CambiarColorDientes(codigo2,'txt_dab_52','daB_52',3); 
								});
								$('#dI_52').click(function(){
									var codigo3=$('#txt_di_52').val();  
									CambiarColorDientes(codigo3,'txt_di_52','dI_52',4); 
								});
								$('#dC_52').click(function(){
									var codigo4=$('#txt_dc_52').val();  
									CambiarColorDientes(codigo4,'txt_dc_52','dC_52',5); 
								});																																																																					


								$('#dA_51').click(function(){
									var codigo=$('#txt_da_51').val(); 
									CambiarColorDientes(codigo,'txt_da_51','dA_51',1);      
								});
								$('#dD_51').click(function(){
									var codigo1=$('#txt_dd_51').val();  
									CambiarColorDientes(codigo1,'txt_dd_51','dD_51',2); 
								});
								$('#daB_51').click(function(){
									var codigo2=$('#txt_dab_51').val(); 
									CambiarColorDientes(codigo2,'txt_dab_51','daB_51',3); 
								});
								$('#dI_51').click(function(){
									var codigo3=$('#txt_di_51').val();  
									CambiarColorDientes(codigo3,'txt_di_51','dI_51',4); 
								});
								$('#dC_51').click(function(){
									var codigo4=$('#txt_dc_51').val();  
									CambiarColorDientes(codigo4,'txt_dc_51','dC_51',5); 
								});																																																																								

								";

								echo "

								$('#dA_61').click(function(){
									var codigo=$('#txt_da_61').val(); 
									CambiarColorDientes(codigo,'txt_da_61','dA_61',1);      
								});
								$('#dD_61').click(function(){
									var codigo1=$('#txt_dd_61').val();  
									CambiarColorDientes(codigo1,'txt_dd_61','dD_61',2); 
								});
								$('#daB_61').click(function(){
									var codigo2=$('#txt_dab_61').val(); 
									CambiarColorDientes(codigo2,'txt_dab_61','daB_61',3); 
								});
								$('#dI_61').click(function(){
									var codigo3=$('#txt_di_61').val();  
									CambiarColorDientes(codigo3,'txt_di_61','dI_61',4); 
								});
								$('#dC_61').click(function(){
									var codigo4=$('#txt_dc_61').val();  
									CambiarColorDientes(codigo4,'txt_dc_61','dC_61',5); 
								});	


								$('#dA_62').click(function(){
									var codigo=$('#txt_da_62').val(); 
									CambiarColorDientes(codigo,'txt_da_62','dA_62',1);      
								});
								$('#dD_62').click(function(){
									var codigo1=$('#txt_dd_62').val();  
									CambiarColorDientes(codigo1,'txt_dd_62','dD_62',2); 
								});
								$('#daB_62').click(function(){
									var codigo2=$('#txt_dab_62').val(); 
									CambiarColorDientes(codigo2,'txt_dab_62','daB_62',3); 
								});
								$('#dI_62').click(function(){
									var codigo3=$('#txt_di_62').val();  
									CambiarColorDientes(codigo3,'txt_di_62','dI_62',4); 
								});
								$('#dC_62').click(function(){
									var codigo4=$('#txt_dc_62').val();  
									CambiarColorDientes(codigo4,'txt_dc_62','dC_62',5); 
								});	


								$('#dA_63').click(function(){
									var codigo=$('#txt_da_63').val(); 
									CambiarColorDientes(codigo,'txt_da_63','dA_63',1);      
								});
								$('#dD_63').click(function(){
									var codigo1=$('#txt_dd_63').val();  
									CambiarColorDientes(codigo1,'txt_dd_63','dD_63',2); 
								});
								$('#daB_63').click(function(){
									var codigo2=$('#txt_dab_63').val(); 
									CambiarColorDientes(codigo2,'txt_dab_63','daB_63',3); 
								});
								$('#dI_63').click(function(){
									var codigo3=$('#txt_di_63').val();  
									CambiarColorDientes(codigo3,'txt_di_63','dI_63',4); 
								});
								$('#dC_63').click(function(){
									var codigo4=$('#txt_dc_63').val();  
									CambiarColorDientes(codigo4,'txt_dc_63','dC_63',5); 
								});	



								$('#dA_64').click(function(){
									var codigo=$('#txt_da_64').val(); 
									CambiarColorDientes(codigo,'txt_da_64','dA_64',1);      
								});
								$('#dD_64').click(function(){
									var codigo1=$('#txt_dd_64').val();  
									CambiarColorDientes(codigo1,'txt_dd_64','dD_64',2); 
								});
								$('#daB_64').click(function(){
									var codigo2=$('#txt_dab_64').val(); 
									CambiarColorDientes(codigo2,'txt_dab_64','daB_64',3); 
								});
								$('#dI_64').click(function(){
									var codigo3=$('#txt_di_64').val();  
									CambiarColorDientes(codigo3,'txt_di_64','dI_64',4); 
								});
								$('#dC_64').click(function(){
									var codigo4=$('#txt_dc_64').val();  
									CambiarColorDientes(codigo4,'txt_dc_64','dC_64',5); 
								});																			




								$('#dA_65').click(function(){
									var codigo=$('#txt_da_65').val(); 
									CambiarColorDientes(codigo,'txt_da_65','dA_65',1);      
								});
								$('#dD_65').click(function(){
									var codigo1=$('#txt_dd_65').val();  
									CambiarColorDientes(codigo1,'txt_dd_65','dD_65',2); 
								});
								$('#daB_65').click(function(){
									var codigo2=$('#txt_dab_65').val(); 
									CambiarColorDientes(codigo2,'txt_dab_65','daB_65',3); 
								});
								$('#dI_65').click(function(){
									var codigo3=$('#txt_di_65').val();  
									CambiarColorDientes(codigo3,'txt_di_65','dI_65',4); 
								});
								$('#dC_65').click(function(){
									var codigo4=$('#txt_dc_65').val();  
									CambiarColorDientes(codigo4,'txt_dc_65','dC_65',5); 
								});	



								";

								echo "

								$('#dA_85').click(function(){
									var codigo=$('#txt_da_85').val(); 
									CambiarColorDientes(codigo,'txt_da_85','dA_85',1);      
								});
								$('#dD_85').click(function(){
									var codigo1=$('#txt_dd_85').val();  
									CambiarColorDientes(codigo1,'txt_dd_85','dD_85',2); 
								});
								$('#daB_85').click(function(){
									var codigo2=$('#txt_dab_85').val(); 
									CambiarColorDientes(codigo2,'txt_dab_85','daB_85',3); 
								});
								$('#dI_85').click(function(){
									var codigo3=$('#txt_di_85').val();  
									CambiarColorDientes(codigo3,'txt_di_85','dI_85',4); 
								});
								$('#dC_85').click(function(){
									var codigo4=$('#txt_dc_85').val();  
									CambiarColorDientes(codigo4,'txt_dc_85','dC_85',5); 
								});	


								$('#dA_84').click(function(){
									var codigo=$('#txt_da_84').val(); 
									CambiarColorDientes(codigo,'txt_da_84','dA_84',1);      
								});
								$('#dD_84').click(function(){
									var codigo1=$('#txt_dd_84').val();  
									CambiarColorDientes(codigo1,'txt_dd_84','dD_84',2); 
								});
								$('#daB_84').click(function(){
									var codigo2=$('#txt_dab_84').val(); 
									CambiarColorDientes(codigo2,'txt_dab_84','daB_84',3); 
								});
								$('#dI_84').click(function(){
									var codigo3=$('#txt_di_84').val();  
									CambiarColorDientes(codigo3,'txt_di_84','dI_84',4); 
								});
								$('#dC_84').click(function(){
									var codigo4=$('#txt_dc_84').val();  
									CambiarColorDientes(codigo4,'txt_dc_84','dC_84',5); 
								});


								$('#dA_83').click(function(){
									var codigo=$('#txt_da_83').val(); 
									CambiarColorDientes(codigo,'txt_da_83','dA_83',1);      
								});
								$('#dD_83').click(function(){
									var codigo1=$('#txt_dd_83').val();  
									CambiarColorDientes(codigo1,'txt_dd_83','dD_83',2); 
								});
								$('#daB_83').click(function(){
									var codigo2=$('#txt_dab_83').val(); 
									CambiarColorDientes(codigo2,'txt_dab_83','daB_83',3); 
								});
								$('#dI_83').click(function(){
									var codigo3=$('#txt_di_83').val();  
									CambiarColorDientes(codigo3,'txt_di_83','dI_83',4); 
								});
								$('#dC_83').click(function(){
									var codigo4=$('#txt_dc_83').val();  
									CambiarColorDientes(codigo4,'txt_dc_83','dC_83',5); 
								});




								$('#dA_82').click(function(){
									var codigo=$('#txt_da_82').val(); 
									CambiarColorDientes(codigo,'txt_da_82','dA_82',1);      
								});
								$('#dD_82').click(function(){
									var codigo1=$('#txt_dd_82').val();  
									CambiarColorDientes(codigo1,'txt_dd_82','dD_82',2); 
								});
								$('#daB_82').click(function(){
									var codigo2=$('#txt_dab_82').val(); 
									CambiarColorDientes(codigo2,'txt_dab_82','daB_82',3); 
								});
								$('#dI_82').click(function(){
									var codigo3=$('#txt_di_82').val();  
									CambiarColorDientes(codigo3,'txt_di_82','dI_82',4); 
								});
								$('#dC_82').click(function(){
									var codigo4=$('#txt_dc_82').val();  
									CambiarColorDientes(codigo4,'txt_dc_82','dC_82',5); 
								});						


								$('#dA_81').click(function(){
									var codigo=$('#txt_da_81').val(); 
									CambiarColorDientes(codigo,'txt_da_81','dA_81',1);      
								});
								$('#dD_81').click(function(){
									var codigo1=$('#txt_dd_81').val();  
									CambiarColorDientes(codigo1,'txt_dd_81','dD_81',2); 
								});
								$('#daB_81').click(function(){
									var codigo2=$('#txt_dab_81').val(); 
									CambiarColorDientes(codigo2,'txt_dab_81','daB_81',3); 
								});
								$('#dI_81').click(function(){
									var codigo3=$('#txt_di_81').val();  
									CambiarColorDientes(codigo3,'txt_di_81','dI_81',4); 
								});
								$('#dC_81').click(function(){
									var codigo4=$('#txt_dc_81').val();  
									CambiarColorDientes(codigo4,'txt_dc_81','dC_81',5); 
								});	


								$('#dA_71').click(function(){
									var codigo=$('#txt_da_71').val(); 
									CambiarColorDientes(codigo,'txt_da_71','dA_71',1);      
								});
								$('#dD_71').click(function(){
									var codigo1=$('#txt_dd_71').val();  
									CambiarColorDientes(codigo1,'txt_dd_71','dD_71',2); 
								});
								$('#daB_71').click(function(){
									var codigo2=$('#txt_dab_71').val(); 
									CambiarColorDientes(codigo2,'txt_dab_71','daB_71',3); 
								});
								$('#dI_71').click(function(){
									var codigo3=$('#txt_di_71').val();  
									CambiarColorDientes(codigo3,'txt_di_71','dI_71',4); 
								});
								$('#dC_71').click(function(){
									var codigo4=$('#txt_dc_71').val();  
									CambiarColorDientes(codigo4,'txt_dc_71','dC_71',5); 
								});	



								$('#dA_72').click(function(){
									var codigo=$('#txt_da_72').val(); 
									CambiarColorDientes(codigo,'txt_da_72','dA_72',1);      
								});
								$('#dD_72').click(function(){
									var codigo1=$('#txt_dd_72').val();  
									CambiarColorDientes(codigo1,'txt_dd_72','dD_72',2); 
								});
								$('#daB_72').click(function(){
									var codigo2=$('#txt_dab_72').val(); 
									CambiarColorDientes(codigo2,'txt_dab_72','daB_72',3); 
								});
								$('#dI_72').click(function(){
									var codigo3=$('#txt_di_72').val();  
									CambiarColorDientes(codigo3,'txt_di_72','dI_72',4); 
								});
								$('#dC_72').click(function(){
									var codigo4=$('#txt_dc_72').val();  
									CambiarColorDientes(codigo4,'txt_dc_72','dC_72',5); 
								});	



								$('#dA_73').click(function(){
									var codigo=$('#txt_da_73').val(); 
									CambiarColorDientes(codigo,'txt_da_73','dA_73',1);      
								});
								$('#dD_73').click(function(){
									var codigo1=$('#txt_dd_73').val();  
									CambiarColorDientes(codigo1,'txt_dd_73','dD_73',2); 
								});
								$('#daB_73').click(function(){
									var codigo2=$('#txt_dab_73').val(); 
									CambiarColorDientes(codigo2,'txt_dab_73','daB_73',3); 
								});
								$('#dI_73').click(function(){
									var codigo3=$('#txt_di_73').val();  
									CambiarColorDientes(codigo3,'txt_di_73','dI_73',4); 
								});
								$('#dC_73').click(function(){
									var codigo4=$('#txt_dc_73').val();  
									CambiarColorDientes(codigo4,'txt_dc_73','dC_73',5); 
								});	



								$('#dA_74').click(function(){
									var codigo=$('#txt_da_74').val(); 
									CambiarColorDientes(codigo,'txt_da_74','dA_74',1);      
								});
								$('#dD_74').click(function(){
									var codigo1=$('#txt_dd_74').val();  
									CambiarColorDientes(codigo1,'txt_dd_74','dD_74',2); 
								});
								$('#daB_74').click(function(){
									var codigo2=$('#txt_dab_74').val(); 
									CambiarColorDientes(codigo2,'txt_dab_74','daB_74',3); 
								});
								$('#dI_74').click(function(){
									var codigo3=$('#txt_di_74').val();  
									CambiarColorDientes(codigo3,'txt_di_74','dI_74',4); 
								});
								$('#dC_74').click(function(){
									var codigo4=$('#txt_dc_74').val();  
									CambiarColorDientes(codigo4,'txt_dc_74','dC_74',5); 
								});	



								$('#dA_75').click(function(){
									var codigo=$('#txt_da_75').val(); 
									CambiarColorDientes(codigo,'txt_da_75','dA_75',1);      
								});
								$('#dD_75').click(function(){
									var codigo1=$('#txt_dd_75').val();  
									CambiarColorDientes(codigo1,'txt_dd_75','dD_75',2); 
								});
								$('#daB_75').click(function(){
									var codigo2=$('#txt_dab_75').val(); 
									CambiarColorDientes(codigo2,'txt_dab_75','daB_75',3); 
								});
								$('#dI_75').click(function(){
									var codigo3=$('#txt_di_75').val();  
									CambiarColorDientes(codigo3,'txt_di_75','dI_75',4); 
								});
								$('#dC_75').click(function(){
									var codigo4=$('#txt_dc_75').val();  
									CambiarColorDientes(codigo4,'txt_dc_75','dC_75',5); 
								});																								

								";	

								echo "

								$('#dA_48').click(function(){
									var codigo=$('#txt_da_48').val(); 
									CambiarColorDientes(codigo,'txt_da_48','dA_48',1);      
								});
								$('#dD_48').click(function(){
									var codigo1=$('#txt_dd_48').val();  
									CambiarColorDientes(codigo1,'txt_dd_48','dD_48',2); 
								});
								$('#daB_48').click(function(){
									var codigo2=$('#txt_dab_48').val(); 
									CambiarColorDientes(codigo2,'txt_dab_48','daB_48',3); 
								});
								$('#dI_48').click(function(){
									var codigo3=$('#txt_di_48').val();  
									CambiarColorDientes(codigo3,'txt_di_48','dI_48',4); 
								});
								$('#dC_48').click(function(){
									var codigo4=$('#txt_dc_48').val();  
									CambiarColorDientes(codigo4,'txt_dc_48','dC_48',5); 
								});


								$('#dA_47').click(function(){
									var codigo=$('#txt_da_47').val(); 
									CambiarColorDientes(codigo,'txt_da_47','dA_47',1);      
								});
								$('#dD_47').click(function(){
									var codigo1=$('#txt_dd_47').val();  
									CambiarColorDientes(codigo1,'txt_dd_47','dD_47',2); 
								});
								$('#daB_47').click(function(){
									var codigo2=$('#txt_dab_47').val(); 
									CambiarColorDientes(codigo2,'txt_dab_47','daB_47',3); 
								});
								$('#dI_47').click(function(){
									var codigo3=$('#txt_di_47').val();  
									CambiarColorDientes(codigo3,'txt_di_47','dI_47',4); 
								});
								$('#dC_47').click(function(){
									var codigo4=$('#txt_dc_47').val();  
									CambiarColorDientes(codigo4,'txt_dc_47','dC_47',5); 
								});

								$('#dA_46').click(function(){
									var codigo=$('#txt_da_46').val(); 
									CambiarColorDientes(codigo,'txt_da_46','dA_46',1);      
								});
								$('#dD_46').click(function(){
									var codigo1=$('#txt_dd_46').val();  
									CambiarColorDientes(codigo1,'txt_dd_46','dD_46',2); 
								});
								$('#daB_46').click(function(){
									var codigo2=$('#txt_dab_46').val(); 
									CambiarColorDientes(codigo2,'txt_dab_46','daB_46',3); 
								});
								$('#dI_46').click(function(){
									var codigo3=$('#txt_di_46').val();  
									CambiarColorDientes(codigo3,'txt_di_46','dI_46',4); 
								});
								$('#dC_46').click(function(){
									var codigo4=$('#txt_dc_46').val();  
									CambiarColorDientes(codigo4,'txt_dc_46','dC_46',5); 
								});


								$('#dA_45').click(function(){
									var codigo=$('#txt_da_45').val(); 
									CambiarColorDientes(codigo,'txt_da_45','dA_45',1);      
								});
								$('#dD_45').click(function(){
									var codigo1=$('#txt_dd_45').val();  
									CambiarColorDientes(codigo1,'txt_dd_45','dD_45',2); 
								});
								$('#daB_45').click(function(){
									var codigo2=$('#txt_dab_45').val(); 
									CambiarColorDientes(codigo2,'txt_dab_45','daB_45',3); 
								});
								$('#dI_45').click(function(){
									var codigo3=$('#txt_di_45').val();  
									CambiarColorDientes(codigo3,'txt_di_45','dI_45',4); 
								});
								$('#dC_45').click(function(){
									var codigo4=$('#txt_dc_45').val();  
									CambiarColorDientes(codigo4,'txt_dc_45','dC_45',5); 
								});		


								$('#dA_44').click(function(){
									var codigo=$('#txt_da_44').val(); 
									CambiarColorDientes(codigo,'txt_da_44','dA_44',1);      
								});
								$('#dD_44').click(function(){
									var codigo1=$('#txt_dd_44').val();  
									CambiarColorDientes(codigo1,'txt_dd_44','dD_44',2); 
								});
								$('#daB_44').click(function(){
									var codigo2=$('#txt_dab_44').val(); 
									CambiarColorDientes(codigo2,'txt_dab_44','daB_44',3); 
								});
								$('#dI_44').click(function(){
									var codigo3=$('#txt_di_44').val();  
									CambiarColorDientes(codigo3,'txt_di_44','dI_44',4); 
								});
								$('#dC_44').click(function(){
									var codigo4=$('#txt_dc_44').val();  
									CambiarColorDientes(codigo4,'txt_dc_44','dC_44',5); 
								});	



								$('#dA_43').click(function(){
									var codigo=$('#txt_da_43').val(); 
									CambiarColorDientes(codigo,'txt_da_43','dA_43',1);      
								});
								$('#dD_43').click(function(){
									var codigo1=$('#txt_dd_43').val();  
									CambiarColorDientes(codigo1,'txt_dd_43','dD_43',2); 
								});
								$('#daB_43').click(function(){
									var codigo2=$('#txt_dab_43').val(); 
									CambiarColorDientes(codigo2,'txt_dab_43','daB_43',3); 
								});
								$('#dI_43').click(function(){
									var codigo3=$('#txt_di_43').val();  
									CambiarColorDientes(codigo3,'txt_di_43','dI_43',4); 
								});
								$('#dC_43').click(function(){
									var codigo4=$('#txt_dc_43').val();  
									CambiarColorDientes(codigo4,'txt_dc_43','dC_43',5); 
								});	




								$('#dA_42').click(function(){
									var codigo=$('#txt_da_42').val(); 
									CambiarColorDientes(codigo,'txt_da_42','dA_42',1);      
								});
								$('#dD_42').click(function(){
									var codigo1=$('#txt_dd_42').val();  
									CambiarColorDientes(codigo1,'txt_dd_42','dD_42',2); 
								});
								$('#daB_42').click(function(){
									var codigo2=$('#txt_dab_42').val(); 
									CambiarColorDientes(codigo2,'txt_dab_42','daB_42',3); 
								});
								$('#dI_42').click(function(){
									var codigo3=$('#txt_di_42').val();  
									CambiarColorDientes(codigo3,'txt_di_42','dI_42',4); 
								});
								$('#dC_42').click(function(){
									var codigo4=$('#txt_dc_42').val();  
									CambiarColorDientes(codigo4,'txt_dc_42','dC_42',5); 
								});	



								$('#dA_41').click(function(){
									var codigo=$('#txt_da_41').val(); 
									CambiarColorDientes(codigo,'txt_da_41','dA_41',1);      
								});
								$('#dD_41').click(function(){
									var codigo1=$('#txt_dd_41').val();  
									CambiarColorDientes(codigo1,'txt_dd_41','dD_41',2); 
								});
								$('#daB_41').click(function(){
									var codigo2=$('#txt_dab_41').val(); 
									CambiarColorDientes(codigo2,'txt_dab_41','daB_41',3); 
								});
								$('#dI_41').click(function(){
									var codigo3=$('#txt_di_41').val();  
									CambiarColorDientes(codigo3,'txt_di_41','dI_41',4); 
								});
								$('#dC_41').click(function(){
									var codigo4=$('#txt_dc_41').val();  
									CambiarColorDientes(codigo4,'txt_dc_41','dC_41',5); 
								});	





								$('#dA_31').click(function(){
									var codigo=$('#txt_da_31').val(); 
									CambiarColorDientes(codigo,'txt_da_31','dA_31',1);      
								});
								$('#dD_31').click(function(){
									var codigo1=$('#txt_dd_31').val();  
									CambiarColorDientes(codigo1,'txt_dd_31','dD_31',2); 
								});
								$('#daB_31').click(function(){
									var codigo2=$('#txt_dab_31').val(); 
									CambiarColorDientes(codigo2,'txt_dab_31','daB_31',3); 
								});
								$('#dI_31').click(function(){
									var codigo3=$('#txt_di_31').val();  
									CambiarColorDientes(codigo3,'txt_di_31','dI_31',4); 
								});
								$('#dC_31').click(function(){
									var codigo4=$('#txt_dc_31').val();  
									CambiarColorDientes(codigo4,'txt_dc_31','dC_31',5); 
								});	



								$('#dA_32').click(function(){
									var codigo=$('#txt_da_32').val(); 
									CambiarColorDientes(codigo,'txt_da_32','dA_32',1);      
								});
								$('#dD_32').click(function(){
									var codigo1=$('#txt_dd_32').val();  
									CambiarColorDientes(codigo1,'txt_dd_32','dD_32',2); 
								});
								$('#daB_32').click(function(){
									var codigo2=$('#txt_dab_32').val(); 
									CambiarColorDientes(codigo2,'txt_dab_32','daB_32',3); 
								});
								$('#dI_32').click(function(){
									var codigo3=$('#txt_di_32').val();  
									CambiarColorDientes(codigo3,'txt_di_32','dI_32',4); 
								});
								$('#dC_32').click(function(){
									var codigo4=$('#txt_dc_32').val();  
									CambiarColorDientes(codigo4,'txt_dc_32','dC_32',5); 
								});	



								$('#dA_33').click(function(){
									var codigo=$('#txt_da_33').val(); 
									CambiarColorDientes(codigo,'txt_da_33','dA_33',1);      
								});
								$('#dD_33').click(function(){
									var codigo1=$('#txt_dd_33').val();  
									CambiarColorDientes(codigo1,'txt_dd_33','dD_33',2); 
								});
								$('#daB_33').click(function(){
									var codigo2=$('#txt_dab_33').val(); 
									CambiarColorDientes(codigo2,'txt_dab_33','daB_33',3); 
								});
								$('#dI_33').click(function(){
									var codigo3=$('#txt_di_33').val();  
									CambiarColorDientes(codigo3,'txt_di_33','dI_33',4); 
								});
								$('#dC_33').click(function(){
									var codigo4=$('#txt_dc_33').val();  
									CambiarColorDientes(codigo4,'txt_dc_33','dC_33',5); 
								});	


								$('#dA_34').click(function(){
									var codigo=$('#txt_da_34').val(); 
									CambiarColorDientes(codigo,'txt_da_34','dA_34',1);      
								});
								$('#dD_34').click(function(){
									var codigo1=$('#txt_dd_34').val();  
									CambiarColorDientes(codigo1,'txt_dd_34','dD_34',2); 
								});
								$('#daB_34').click(function(){
									var codigo2=$('#txt_dab_34').val(); 
									CambiarColorDientes(codigo2,'txt_dab_34','daB_34',3); 
								});
								$('#dI_34').click(function(){
									var codigo3=$('#txt_di_34').val();  
									CambiarColorDientes(codigo3,'txt_di_34','dI_34',4); 
								});
								$('#dC_34').click(function(){
									var codigo4=$('#txt_dc_34').val();  
									CambiarColorDientes(codigo4,'txt_dc_34','dC_34',5); 
								});	


								$('#dA_35').click(function(){
									var codigo=$('#txt_da_35').val(); 
									CambiarColorDientes(codigo,'txt_da_35','dA_35',1);      
								});
								$('#dD_35').click(function(){
									var codigo1=$('#txt_dd_35').val();  
									CambiarColorDientes(codigo1,'txt_dd_35','dD_35',2); 
								});
								$('#daB_35').click(function(){
									var codigo2=$('#txt_dab_35').val(); 
									CambiarColorDientes(codigo2,'txt_dab_35','daB_35',3); 
								});
								$('#dI_35').click(function(){
									var codigo3=$('#txt_di_35').val();  
									CambiarColorDientes(codigo3,'txt_di_35','dI_35',4); 
								});
								$('#dC_35').click(function(){
									var codigo4=$('#txt_dc_35').val();  
									CambiarColorDientes(codigo4,'txt_dc_35','dC_35',5); 
								});	


								$('#dA_36').click(function(){
									var codigo=$('#txt_da_36').val(); 
									CambiarColorDientes(codigo,'txt_da_36','dA_36',1);      
								});
								$('#dD_36').click(function(){
									var codigo1=$('#txt_dd_36').val();  
									CambiarColorDientes(codigo1,'txt_dd_36','dD_36',2); 
								});
								$('#daB_36').click(function(){
									var codigo2=$('#txt_dab_36').val(); 
									CambiarColorDientes(codigo2,'txt_dab_36','daB_36',3); 
								});
								$('#dI_36').click(function(){
									var codigo3=$('#txt_di_36').val();  
									CambiarColorDientes(codigo3,'txt_di_36','dI_36',4); 
								});
								$('#dC_36').click(function(){
									var codigo4=$('#txt_dc_36').val();  
									CambiarColorDientes(codigo4,'txt_dc_36','dC_36',5); 
								});	



								$('#dA_37').click(function(){
									var codigo=$('#txt_da_37').val(); 
									CambiarColorDientes(codigo,'txt_da_37','dA_37',1);      
								});
								$('#dD_37').click(function(){
									var codigo1=$('#txt_dd_37').val();  
									CambiarColorDientes(codigo1,'txt_dd_37','dD_37',2); 
								});
								$('#daB_37').click(function(){
									var codigo2=$('#txt_dab_37').val(); 
									CambiarColorDientes(codigo2,'txt_dab_37','daB_37',3); 
								});
								$('#dI_37').click(function(){
									var codigo3=$('#txt_di_37').val();  
									CambiarColorDientes(codigo3,'txt_di_37','dI_37',4); 
								});
								$('#dC_37').click(function(){
									var codigo4=$('#txt_dc_37').val();  
									CambiarColorDientes(codigo4,'txt_dc_37','dC_37',5); 
								});	




								$('#dA_38').click(function(){
									var codigo=$('#txt_da_38').val(); 
									CambiarColorDientes(codigo,'txt_da_38','dA_38',1);      
								});
								$('#dD_38').click(function(){
									var codigo1=$('#txt_dd_38').val();  
									CambiarColorDientes(codigo1,'txt_dd_38','dD_38',2); 
								});
								$('#daB_38').click(function(){
									var codigo2=$('#txt_dab_38').val(); 
									CambiarColorDientes(codigo2,'txt_dab_38','daB_38',3); 
								});
								$('#dI_38').click(function(){
									var codigo3=$('#txt_di_38').val();  
									CambiarColorDientes(codigo3,'txt_di_38','dI_38',4); 
								});
								$('#dC_38').click(function(){
									var codigo4=$('#txt_dc_38').val();  
									CambiarColorDientes(codigo4,'txt_dc_38','dC_38',5); 
								});	


								";	


								echo "</script>";	
							}

//metodo para guardar los datos plan de tratamiento y pagos
							public function SaveTratamPagos($activ,$numacti,$preuni,$total,$fech,$abono,$nofac,$nheque,$efectivo,$saldo,$idPac)
							{
								$plantp=new TratamientoPagos;
								$plantp->Ejecutar("INSERT INTO tbl_tratamientopagos (act_pla,num_pla,preuni_pla,total_pla,fech_pla,abono_pla,numfa_pla,che_pla,efect_pla,saldo_pla,id_pac,est_pla) VALUES ('$activ','$numacti','$preuni','$total','$fech','$abono','$nofac','$nheque','$efectivo','$saldo','$idPac','A')");
								echo "<h3>Los datos se han guardado correctamente</h3>";
							}
//fin metodo para guardar los datos plan de tratamiento y pagos

//metodo para mostrar el historial plan de tratamiento y pagos
							public function MostrarHistorialPagos($idPac)
							{
								$pagos=new TratamientoPagos;
								$aux=0;
								$datos=$pagos->Consultar_TratamientoPagos("SELECT * FROM tbl_tratamientopagos WHERE id_pac='$idPac' ORDER BY fech_pla DESC");
								echo "<table class='table table-bordered table-condensed table-striped' > <tr>
								<th><center>Actividad</center></th>
								<th><center>No. </center></th>
								<th><center>Precio Unitario</center></th>
								<th><center>Total</center></th>
								<th><center>Fecha</center></th>
								<th><center>Abono</center></th>
								<th><center>No. Factura</center></th>
								<th><center>Cheque No. </center></th>
								<th><center>Efectivo</center></th>
								<th><center>Saldo</center></th> </tr>";
								foreach($datos as $fila)
								{
									echo "<tr>

									<td>$fila[act_pla]</td>
									<td>$fila[num_pla]</td>
									<td>$fila[preuni_pla]</td>
									<td>$fila[total_pla]</td>
									<td>$fila[fech_pla]</td>
									<td>$fila[abono_pla]</td>
									<td>$fila[numfa_pla]</td>
									<td>$fila[che_pla]</td>
									<td>$fila[efect_pla]</td>
									<td>$fila[saldo_pla]</td>

								</tr>";
							}
							echo "</table>";
						}
//fin metodo para mostrar el historial plan de tratamiento y pagos

//procedimietos para la epicrisis
						public function LoadEpicrisis($turno){
							$aux=new Turno;
							$epic=new Epicrisis;
							$ciepi=new CiEpicrisis;
							session_start();
							$log=$_SESSION['DOCTOR'];
							$nombremedico=$aux->Consultar("SELECT  nombresCom_usu FROM tbl_usuario WHERE login_usu='$log';");
							$idPaciente=$aux->Consultar("SELECT p.id_pac FROM tbl_turno t, tbl_paciente p WHERE p.id_pac=t.id_pac AND t.id_tu='$turno'");
							$apellido=$aux->Consultar("SELECT p.apellidos_pac FROM tbl_turno t, tbl_paciente p WHERE p.id_pac=t.id_pac AND t.id_tu='$turno'");
							$apellido=utf8_encode($apellido);
							$nombre=$aux->Consultar("SELECT p.nombres_pac FROM tbl_turno t, tbl_paciente p WHERE p.id_pac=t.id_pac AND t.id_tu='$turno'");
							$nombre=utf8_encode($nombre);
							$cedula=$aux->Consultar("SELECT p.cedula_pac FROM tbl_turno t, tbl_paciente p WHERE p.id_pac=t.id_pac AND t.id_tu='$turno'");
							$FechaNa=$aux->Consultar("SELECT p.fechaN_pac FROM tbl_turno t, tbl_paciente p WHERE p.id_pac=t.id_pac AND t.id_tu='$turno'");
							$Genero=$aux->Consultar("SELECT p.sexo_pac FROM tbl_turno t, tbl_paciente p WHERE p.id_pac=t.id_pac AND t.id_tu='$turno'");
							$EstadoC=$aux->Consultar("SELECT p.estadociv_pac FROM tbl_turno t, tbl_paciente p WHERE p.id_pac=t.id_pac AND t.id_tu='$turno'");
							$InstruC=$aux->Consultar("SELECT p.instruccion_pac FROM tbl_turno t, tbl_paciente p WHERE p.id_pac=t.id_pac AND t.id_tu='$turno'");
							$Medico=$aux->Consultar("SELECT u.nombresCom_usu FROM tbl_turno t,  tbl_usuario u, tbl_especialida e WHERE t.id_tu='$turno' AND u.id_usu=t.id_usu AND e.id_esp=u.id_esp");
							$Especialidad=$aux->Consultar("SELECT e.descripcion_esp FROM tbl_turno t,  tbl_usuario u, tbl_especialida e WHERE t.id_tu='$turno' AND u.id_usu=t.id_usu AND e.id_esp=u.id_esp");

							$edad=$this->Edad($FechaNa);
							$fechaate=$this->Mifecha();
							$hora=$this->MiHora();

							if ($epic->Consultar("SELECT COUNT(*) FROM tbl_epicrisis WHERE id_user='$idPaciente';")==0) {
								echo "
								<table class='table table-hover table-bordered table-striped table-condensend'> <tr> <td>Unidad operativa</td> <td>Localización</td> <td>Historia clinica</td> </tr> <tr> <td><input type='text' name='txtunidad' id='txtunidad' value='Clínica de urulogía'  readonly/></td> <td> <table> <tr> <td>Parroquia</td> <td>Cantón</td> <td>Provincia</td> </tr> <tr> <td><input type='text' name='txtparro' id='txtparro' /></td> <td><input type='text' name='txtcant' id='txtcant' /></td> <td><input type='text' name='txtpro' id='txtpro' /></td> </tr> </table></td> <td>$cedula</td> </tr> </table> <table class='table table-hover table-bordered table-striped table-condensend' > <tr> <td>Apellidos</td> <td>Nombres</td> <td>Cédula de ciudadania</td> </tr> <tr> <td>$apellido</td> <td>$nombre</td> <td>$cedula</td> </tr> </table> <table class='table table-hover table-bordered table-striped table-condensend'> <tr> <td>Fecha de atencion </td> <td>Hora</td> <td>Edad</td> <td>Genero</td> <td>Estado civil</td> <td>Intrucción</td> <td>Empresa donde trabaja</td> <td>Seguro de salud</td> </tr> <tr> <td><input type='text' name='txtfechaepi' id='txtfechaepi' class='CajaTallas' value='$fechaate'  readonly /></td> <td><input type='text' name='txthoraepi' id='txthoraepi' class='CajaTallas' value='$hora' readonly/></td> <td><input type='text' name='txtedadepi' id='txtedadepi' value='$edad' readonly /></td> <td><input type='text' name='txtgeneroepi' id='txtgeneroepi' class='CajaTallas' value='$Genero' readonly/></td> <td><input type='text' name='txtestadocepi' id='txtestadocepi' class='CajaTallas' value='$EstadoC' readonly /></td> <td><input type='text' name='txtintrucepi' id='txtintrucepi' class='CajaTallas' value='$InstruC' readonly /></td> <td><input type='text' name='txtempepi' id='txtempepi' /></td> <td><input type='text' name='txtseguroepi' id='txtseguroepi' /></td> </tr> <tr> <td colspan='8'> 1 Resumen del cuadro clinico </td> </tr> <tr> <td colspan='8'> <textarea id='txtrescuadepi' cols='200' rows='5' class='span10'></textarea> </td> </tr> <tr> <td colspan='8'> 2 Resumen de evolucion y complicaciones </td> </tr> <tr> <td colspan='8'> <textarea id='txtreevolepi' cols='200' rows='5' class='span10'></textarea> </td> </tr> <tr> <td colspan='8'> 3 Hallazgos relevantes de examenes y procedimientos diagnosticos </td> </tr> <tr> <td colspan='8'> <textarea id='txthallaepi' cols='200' rows='5' class='span10'></textarea> </td> </tr> <tr> <td colspan='8'> 5 Resumen de tratamiento y procedimientos terapeuticos </td> </tr> <tr> <td colspan='8'> <textarea id='txtrestraterepi' cols='200' rows='5' class='span10'></textarea> <a href='#myModal' role='button'  data-toggle='modal' class='btn btn-success' onclick='datosvademecun2()' ><i class='icon-plus'></i> Medicamento</a> </td> </tr> </table> 



								<table  class='table table-hover table-bordered table-striped table-condensend' >
									<tr>
										<td colspan='10'>4 Diagnostico</td>
									</tr>
									<tr>
										<td>DE INGRESO</td>
										<td>CIE</td>
										<td>PRE</td>
										<td>DEF</td>
										<td>&nbsp;</td>
										<td>DE EGRESO</td>
										<td>CIE</td>
										<td>PRE</td>
										<td>DEF</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td><input type='text' id='txti1'   /> 
											<a onclick='verDiagnostico(1)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
											<td><input type='text' id='txtic1'  class='t1'  /></td>
											<td><input type='text' id='txtipr1' class='t1'   /></td>
											<td><input type='text' id='txtid1' class='t1'  /></td>
											<td><a class='btn btn-danger' onclick='DeleteDiag(1)' ><i class=' icon-remove'></i> Borrar</a></td>
											<td><input type='text' id='txte1' /> <a onclick='verDiagnostico(11)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
											<td><input type='text' id='txtec1' class='t1'  /></td>
											<td><input type='text' id='txtepr1' class='t1'  /></td>
											<td><input type='text' id='txtede1' class='t1'  /></td>
											<td><a  class='btn btn-danger' onclick='DeleteDiag(11)' ><i class=' icon-remove'></i> Borrar</a></td>
										</tr>




										<tr>
											<td><input type='text' id='txti2'   /> 
												<a onclick='verDiagnostico(2)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
												<td><input type='text' id='txtic2' class='t1'  /></td>
												<td><input type='text' id='txtipr2' class='t1'   /></td>
												<td><input type='text' id='txtid2' class='t1'  /></td>
												<td><a  class='btn btn-danger' onclick='DeleteDiag(2)' ><i class=' icon-remove'></i> Borrar</a></td>
												<td><input type='text' id='txte2' /> <a onclick='verDiagnostico(12)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
												<td><input type='text' id='txtec2' class='t1'  /></td>
												<td><input type='text' id='txtepr2' class='t1'   /></td>
												<td><input type='text' id='txtede2' class='t1'   /></td>
												<td><a  class='btn btn-danger' onclick='DeleteDiag(12)' ><i class=' icon-remove'></i> Borrar</a></td>
											</tr>




											<tr>
												<td><input type='text' id='txti3'  /> <a onclick='verDiagnostico(8)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
												<td><input type='text' id='txtic3' class='t1'  /></td>
												<td><input type='text' id='txtipr3' class='t1'  /></td>
												<td><input type='text' id='txtid3' class='t1'  /></td>
												<td><a  class='btn btn-danger' onclick='DeleteDiag(8)' ><i class=' icon-remove'></i> Borrar</a></td>
												<td><input type='text' id='txte3' /> <a onclick='verDiagnostico(13)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
												<td><input type='text' id='txtec3' class='t1'  /></td>
												<td><input type='text' id='txtepr3' class='t1'  /></td>
												<td><input type='text' id='txtede3' class='t1'  /></td>
												<td><a  class='btn btn-danger' onclick='DeleteDiag(13)' ><i class=' icon-remove'></i> Borrar</a></td>
											</tr>




											<tr>
												<td><input type='text' id='txti4' /> <a onclick='verDiagnostico(9)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
												<td><input type='text' id='txtic4' class='t1'   /></td>
												<td><input type='text' id='txtipr4' class='t1'    /></td>
												<td><input type='text' id='txtid4' class='t1'   /></td>
												<td><a class='btn btn-danger' onclick='DeleteDiag(9)' ><i class=' icon-remove'></i> Borrar</a></td>
												<td><input type='text' id='txte4'  /> <a onclick='verDiagnostico(14)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
												<td><input type='text' id='txtec4' class='t1'    /></td>
												<td><input type='text' id='txtepr4' class='t1'    /></td>
												<td><input type='text' id='txtede4' class='t1'    /></td>
												<td><a class='btn btn-danger' onclick='DeleteDiag(14)' ><i class=' icon-remove'></i> Borrar</a></td>
											</tr>




											<tr>
												<td><input type='text' id='txti5' /> <a onclick='verDiagnostico(10)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
												<td><input type='text' id='txtic5' class='t1'    /></td>
												<td><input type='text' id='txtipr5' class='t1'    /></td>
												<td><input type='text' id='txtid5' class='t1'    /></td>
												<td><a  class='btn btn-danger' onclick='DeleteDiag(10)' ><i class=' icon-remove'></i> Borrar</a></td>
												<td><input type='text' id='txte5' /> <a onclick='verDiagnostico(15)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
												<td><input type='text' id='txtec5' class='t1'    /></td>
												<td><input type='text' id='txtepr5' class='t1'    /></td>
												<td><input type='text' id='txtede5' class='t1'    /></td>
												<td><a  class='btn btn-danger' onclick='DeleteDiag(15)' ><i class=' icon-remove'></i> Borrar</a></td>
											</tr>

										</table>



										<div id='FilaCieEpicris'> </div> <table class='table table-hover table-bordered table-striped table-condensend'> <tr> <td colspan='8'> 7 Condiciones de egreso y pronostico </td> </tr> <tr> <td colspan='8'> <textarea id='txtcondiciegepi' cols='200' rows='5' class='span10'></textarea> </td> </tr> </table> <table class='table table-hover table-bordered table-striped table-condensend' > <tr> <td colspan='3'>8 Medicos tratantes</td> </tr> <tr> <td colspan='3'><textarea id='txtmedicossFin' cols='200' rows='5' class='span10'></textarea></td> </tr> </table> <table class='table table-hover table-bordered table-striped table-condensend' > <tr> <td colspan='24'>9 Egreso</td> </tr> <tr> <td>Alta definitiva</td> <td><input type='text' name='txtaldef' id='txtaldef' class='t1'/></td> <td>Asintomatico</td> <td><input type='text' name='txtasitom' id='txtasitom' class='t1' /></td> <td>Discapacidad moderada</td> <td><input type='text' name='txtdismo' id='txtdismo' class='t1'/></td> <td>Retiro voluntario</td> <td><input type='text' name='txtrevo' id='txtrevo' class='t1'/></td> <td>Defuncion antes de 48 horas</td> <td><input type='text' name='txtdefat48' id='txtdefat48' class='t1'/></td> <td>Dias estadia</td> <td><input type='text' name='txtdest' id='txtdest' class='t1'/></td> </tr> <tr> <td>Alta transitoria</td> <td> <input type='text' name='txtaltr' id='txtaltr' class='t1' /></td> <td>Discapacidad leve</td> <td><input type='text' name='txtdisleve' id='txtdisleve' class='t1' /></td> <td>Discapacidad grave</td> <td><input type='text' name='txtdisgra' id='txtdisgra' class='t1' /></td> <td>Retiroinvoluntario</td> <td><input type='text' name='txtreinv' id='txtreinv'  class='t1'/></td> <td>Defuncion despues de 48 horas</td> <td><input type='text' name='txtdefdes48' id='txtdefdes48' class='t1' /></td> <td>Dias incapacidad</td> <td><input type='text' name='txtdiasinc' id='txtdiasinc' class='t1' /></td> </tr> </tr></table> <table class='table table-condensed table-bordered table-striped table-hover'>
										<tr>
											<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
											<td>MÉDICO</td>
											<td><input type='text' id='txtMediFin' value=''/></td>
											<td>FIRMA</td>
											<th>&nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;</th>
											<td><input type='text' id='txtcodigofin'  value=''/></td>
										</tr>
										<tr>
											<td colspan='6'><center><a href='#' class='btn btn-success' onclick='SaveEpicrisis()'><i class=' icon-file'></i> Guardar</a> <a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='JavaimpEpic($idPaciente)'><i class='icon-print'></i> Imprimir</a>&nbsp;<!-- <a href='#' class='btn btn-info' onclick='PrintReceEpi()'><i class=' icon-print'></i> Imprimir Receta</a> --></center></td>
										</tr>
									</table>
									";
								}
								else{
									$idepipac=$epic->Consultar("SELECT MAX(id_epi) FROM tbl_epicrisis WHERE id_user='$idPaciente';");
									$datos=$epic->Consultar_Epicrisis("SELECT * FROM tbl_epicrisis WHERE id_epi='$idepipac';");
			//inicio for each
									foreach ($datos as $fila) {
										switch ($fila['estado_epi']) {
											case '':
											echo "
											<table class='table table-hover table-bordered table-striped table-condensend'>
												<tr>
													<td>Unidad operativa</td>
													<td>Localización</td>
													<td>Historia clinica</td>
												</tr>
												<tr>
													<td><input type='text' name='txtunidad' id='txtunidad' value='Clínica de urulogía'  readonly/></td>
													<td>
														<table>
															<tr>
																<td>Parroquia</td>
																<td>Cantón</td>
																<td>Provincia</td>
															</tr>
															<tr>
																<td><input type='text' name='txtparro' id='txtparro' value='$fila[parroquia_epi]' /></td>
																<td><input type='text' name='txtcant' id='txtcant'  value='$fila[canton_epi]'/></td>
																<td><input type='text' name='txtpro' id='txtpro'  value='$fila[provincia_epi]'/></td>
															</tr>
														</table></td>
														<td>$cedula</td>
													</tr>
												</table>

												<table class='table table-hover table-bordered table-striped table-condensend' >
													<tr>
														<td>Apellidos</td>
														<td>Nombres</td>
														<td>Cédula de ciudadania</td>
													</tr>
													<tr>
														<td>$apellido</td>
														<td>$nombre</td>
														<td>$cedula</td>
													</tr>
												</table>

												<table class='table table-hover table-bordered table-striped table-condensend'>
													<tr>
														<td>Fecha de atencion </td>
														<td>Hora</td>
														<td>Edad</td>
														<td>Genero</td>
														<td>Estado civil</td>
														<td>Intrucción</td>
														<td>Empresa donde trabaja</td>
														<td>Seguro de salud</td>
													</tr>
													<tr>
														<td><input type='text' name='txtfechaepi' id='txtfechaepi' class='CajaTallas' value='$fechaate'  readonly /></td>
														<td><input type='text' name='txthoraepi' id='txthoraepi' class='CajaTallas' value='$hora' readonly/></td>
														<td><input type='text' name='txtedadepi' id='txtedadepi' value='$edad' readonly /></td>
														<td><input type='text' name='txtgeneroepi' id='txtgeneroepi' class='CajaTallas' value='$Genero' readonly/></td>
														<td><input type='text' name='txtestadocepi' id='txtestadocepi' class='CajaTallas' value='$EstadoC' readonly /></td>
														<td><input type='text' name='txtintrucepi' id='txtintrucepi' class='CajaTallas' value='$InstruC' readonly /></td>
														<td><input type='text' name='txtempepi' id='txtempepi' value='$fila[empresa_epi]' /></td>
														<td><input type='text' name='txtseguroepi' id='txtseguroepi'  value='$fila[segurosa_epi]' /></td>
													</tr>
													<tr>
														<td colspan='8'>
															1 Resumen del cuadro clinico
														</td>
													</tr>
													<tr>
														<td colspan='8'>
															<textarea id='txtrescuadepi' cols='200' rows='5' class='span10'>$fila[rdcc_epi]</textarea>
														</td>
													</tr>
													<tr>
														<td colspan='8'>
															2 Resumen de evolucion y complicaciones
														</td>
													</tr>
													<tr>
														<td colspan='8'>
															<textarea id='txtreevolepi' cols='200' rows='5' class='span10'>$fila[rdeyc]</textarea>
														</td>
													</tr>
													<tr>
														<td colspan='8'>
															3 Hallazgos relevantes de examenes y procedimientos diagnosticos
														</td>
													</tr>
													<tr>
														<td colspan='8'>
															<textarea id='txthallaepi' cols='200' rows='5' class='span10'>$fila[hrdeyp_epi]</textarea>
														</td>
													</tr>
													<tr>
														<td colspan='8'>
															5 Resumen de tratamiento y procedimientos terapeuticos 
														</td>
													</tr>
													<tr>
														<td colspan='8'>
															<textarea id='txtrestraterepi' cols='200' rows='5' class='span10'>$fila[rdtypt_epi]</textarea> <a href='#myModal' role='button'  data-toggle='modal' class='btn btn-success'  onclick='datosvademecun2()' ><i class='icon-plus'></i> Medicamento</a>
														</td>
													</tr>  


												</table>





												<table  class='table table-hover table-bordered table-striped table-condensend' >
													<tr>
														<td colspan='10'>4 Diagnostico</td>
													</tr>
													<tr>
														<td>DE INGRESO</td>
														<td>CIE</td>
														<td>PRE</td>
														<td>DEF</td>
														<td>&nbsp;</td>
														<td>DE EGRESO</td>
														<td>CIE</td>
														<td>PRE</td>
														<td>DEF</td>
														<td>&nbsp;</td>
													</tr>
													<tr>
														<td><input type='text' id='txti1'  value='$fila[txti1]' /> 
															<a onclick='verDiagnostico(1)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
															<td><input type='text' id='txtic1'  class='t1'    value='$fila[txtic1]'/></td>
															<td><input type='text' id='txtipr1' class='t1'     value='$fila[txtipr1]'/></td>
															<td><input type='text' id='txtid1' class='t1'    value='$fila[txtid1]'/></td>
															<td><a  class='btn btn-danger' onclick='DeleteDiag(1)'><i class=' icon-remove'></i> Borrar</a></td>
															<td><input type='text' id='txte1' value='$fila[txte1]' /> <a onclick='verDiagnostico(11)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
															<td><input type='text' id='txtec1' class='t1'    value='$fila[txtec1]'/></td>
															<td><input type='text' id='txtepr1' class='t1'    value='$fila[txtepr1]'/></td>
															<td><input type='text' id='txtede1' class='t1'    value='$fila[txtede1]'/></td>
															<td><a  class='btn btn-danger' onclick='DeleteDiag(11)'><i class=' icon-remove'></i> Borrar</a></td>
														</tr>




														<tr>
															<td><input type='text' id='txti2'     value='$fila[txti2]'/> 
																<a onclick='verDiagnostico(2)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
																<td><input type='text' id='txtic2' class='t1'   value='$fila[txtic2]'/></td>
																<td><input type='text' id='txtipr2' class='t1'   value='$fila[txtipr2]'/></td>
																<td><input type='text' id='txtid2' class='t1'   value='$fila[txtid2]'/></td>
																<td><a class='btn btn-danger' onclick='DeleteDiag(2)'><i class=' icon-remove'></i> Borrar</a></td>
																<td><input type='text' id='txte2' value='$fila[txte2]'/> <a onclick='verDiagnostico(12)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
																<td><input type='text' id='txtec2' class='t1'   value='$fila[txtec2]'/></td>
																<td><input type='text' id='txtepr2' class='t1'   value='$fila[txtepr2]'/></td>
																<td><input type='text' id='txtede2' class='t1'   value='$fila[txtede2]'/></td>
																<td><a  class='btn btn-danger' onclick='DeleteDiag(12)'><i class=' icon-remove'></i> Borrar</a></td>
															</tr>




															<tr>
																<td><input type='text' id='txti3'  value='$fila[txti3]' /> <a onclick='verDiagnostico(8)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
																<td><input type='text' id='txtic3' class='t1'   value='$fila[txtic3]' /></td>
																<td><input type='text' id='txtipr3' class='t1'   value='$fila[txtipr3]' /></td>
																<td><input type='text' id='txtid3' class='t1'   value='$fila[txtid3]' /></td>
																<td><a  class='btn btn-danger' onclick='DeleteDiag(8)'><i class=' icon-remove'></i> Borrar</a></td>
																<td><input type='text' id='txte3' value='$fila[txte3]'  /> <a onclick='verDiagnostico(13)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
																<td><input type='text' id='txtec3' class='t1'   value='$fila[txtec3]' /></td>
																<td><input type='text' id='txtepr3' class='t1'   value='$fila[txtepr3]' /></td>
																<td><input type='text' id='txtede3' class='t1'   value='$fila[txtede3]' /></td>
																<td><a  class='btn btn-danger' onclick='DeleteDiag(13)'><i class=' icon-remove'></i> Borrar</a></td>
															</tr>




															<tr>
																<td><input type='text' id='txti4' value='$fila[txti4]'   /> <a onclick='verDiagnostico(9)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
																<td><input type='text' id='txtic4' class='t1'    value='$fila[txtic4]'  /></td>
																<td><input type='text' id='txtipr4' class='t1'   value='$fila[txtipr4]'  /></td>
																<td><input type='text' id='txtid4' class='t1' value='$fila[txtid4]'  /></td>
																<td><a class='btn btn-danger' onclick='DeleteDiag(9)'><i class=' icon-remove'></i> Borrar</a></td>
																<td><input type='text' id='txte4'  value='$fila[txte4]'  /> <a onclick='verDiagnostico(14)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
																<td><input type='text' id='txtec4' class='t1' value='$fila[txtec4]'  /></td>
																<td><input type='text' id='txtepr4' class='t1' value='$fila[txtepr4]'  /></td>
																<td><input type='text' id='txtede4' class='t1' value='$fila[txtede4]'  /></td>
																<td><a class='btn btn-danger' onclick='DeleteDiag(14)'><i class=' icon-remove'></i> Borrar</a></td>
															</tr>




															<tr>
																<td><input type='text' id='txti5' value='$fila[txti5]'  /> <a onclick='verDiagnostico(10)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
																<td><input type='text' id='txtic5' class='t1'    value='$fila[txtic5]'  /></td>
																<td><input type='text' id='txtipr5' class='t1'    value='$fila[txtipr5]' /></td>
																<td><input type='text' id='txtid5' class='t1'   value='$fila[txtid5]'  /></td>
																<td><a class='btn btn-danger' onclick='DeleteDiag(10)'><i class=' icon-remove'></i> Borrar</a></td>
																<td><input type='text' id='txte5' value='$fila[txte5]'  /> <a onclick='verDiagnostico(15)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
																<td><input type='text' id='txtec5' class='t1'   value='$fila[txtec5]' /></td>
																<td><input type='text' id='txtepr5' class='t1'   value='$fila[txtepr5]' /></td>
																<td><input type='text' id='txtede5' class='t1'   value='$fila[txtede5]' /></td>
																<td><a  class='btn btn-danger' onclick='DeleteDiag(15)'><i class=' icon-remove'></i> Borrar</a></td>
															</tr>

														</table>





														";
														break;

														case 'F':
														echo "
														<table class='table table-hover table-bordered table-striped table-condensend'>
															<tr>
																<td>Unidad operativa</td>
																<td>Localización</td>
																<td>Historia clinica</td>
															</tr>
															<tr>
																<td><input type='text' name='txtunidad' id='txtunidad' value='Clínica de urulogía'  readonly/></td>
																<td>
																	<table>
																		<tr>
																			<td>Parroquia</td>
																			<td>Cantón</td>
																			<td>Provincia</td>
																		</tr>
																		<tr>
																			<td><input type='text' name='txtparro' id='txtparro' value='$fila[parroquia_epi]'  readonly /></td>
																			<td><input type='text' name='txtcant' id='txtcant'  value='$fila[canton_epi]' readonly /></td>
																			<td><input type='text' name='txtpro' id='txtpro'  value='$fila[provincia_epi]' readonly/></td>
																		</tr>
																	</table></td>
																	<td>$cedula</td>
																</tr>
															</table>

															<table class='table table-hover table-bordered table-striped table-condensend' >
																<tr>
																	<td>Apellidos</td>
																	<td>Nombres</td>
																	<td>Cédula de ciudadania</td>
																</tr>
																<tr>
																	<td>$apellido</td>
																	<td>$nombre</td>
																	<td>$cedula</td>
																</tr>
															</table>

															<table class='table table-hover table-bordered table-striped table-condensend'>
																<tr>
																	<td>Fecha de atencion </td>
																	<td>Hora</td>
																	<td>Edad</td>
																	<td>Genero</td>
																	<td>Estado civil</td>
																	<td>Intrucción</td>
																	<td>Empresa donde trabaja</td>
																	<td>Seguro de salud</td>
																</tr>
																<tr>
																	<td><input type='text' name='txtfechaepi' id='txtfechaepi' class='CajaTallas' value='$fechaate'  readonly /></td>
																	<td><input type='text' name='txthoraepi' id='txthoraepi' class='CajaTallas' value='$hora' readonly/></td>
																	<td><input type='text' name='txtedadepi' id='txtedadepi' value='$edad' readonly /></td>
																	<td><input type='text' name='txtgeneroepi' id='txtgeneroepi' class='CajaTallas' value='$Genero' readonly/></td>
																	<td><input type='text' name='txtestadocepi' id='txtestadocepi' class='CajaTallas' value='$EstadoC' readonly /></td>
																	<td><input type='text' name='txtintrucepi' id='txtintrucepi' class='CajaTallas' value='$InstruC' readonly /></td>
																	<td><input type='text' name='txtempepi' id='txtempepi' value='$fila[empresa_epi]'   readonly /></td>
																	<td><input type='text' name='txtseguroepi' id='txtseguroepi'  value='$fila[segurosa_epi]' readonly /></td>
																</tr>
																<tr>
																	<td colspan='8'>
																		1 Resumen del cuadro clinico
																	</td>
																</tr>
																<tr>
																	<td colspan='8'>
																		<textarea id='txtrescuadepi' cols='200' rows='5' class='span10' readonly>$fila[rdcc_epi]</textarea>
																	</td>
																</tr>
																<tr>
																	<td colspan='8'>
																		2 Resumen de evolucion y complicaciones
																	</td>
																</tr>
																<tr>
																	<td colspan='8'>
																		<textarea id='txtreevolepi' cols='200' rows='5' class='span10' readonly>$fila[rdeyc]</textarea>
																	</td>
																</tr>
																<tr>
																	<td colspan='8'>
																		3 Hallazgos relevantes de examenes y procedimientos diagnosticos
																	</td>
																</tr>
																<tr>
																	<td colspan='8'>
																		<textarea id='txthallaepi' cols='200' rows='5' class='span10' readonly>$fila[hrdeyp_epi]</textarea>
																	</td>
																</tr>
																<tr>
																	<td colspan='8'>
																		5 Resumen de tratamiento y procedimientos terapeuticos 
																	</td>
																</tr>
																<tr>
																	<td colspan='8'>
																		<textarea id='txtrestraterepi' cols='200' rows='5' class='span10' readonly>$fila[rdtypt_epi]</textarea> <a class='btn btn-success' ><i class='icon-plus'></i> Medicamento</a>
																	</td>
																</tr>  


															</table>











															<table  class='table table-hover table-bordered table-striped table-condensend' >
																<tr>
																	<td colspan='10'>4 Diagnostico</td>
																</tr>
																<tr>
																	<td>DE INGRESO</td>
																	<td>CIE</td>
																	<td>PRE</td>
																	<td>DEF</td>
																	<td>&nbsp;</td>
																	<td>DE EGRESO</td>
																	<td>CIE</td>
																	<td>PRE</td>
																	<td>DEF</td>
																	<td>&nbsp;</td>
																</tr>
																<tr>
																	<td><input type='text' id='txti1' value='$fila[txti1]' readonly/></td>
																	<td><input type='text' id='txtic1'  class='t1' value='$fila[txtic1]' readonly/></td>
																	<td><input type='text' id='txtipr1' class='t1' value='$fila[txtipr1]' readonly /></td>
																	<td><input type='text' id='txtid1' class='t1' value='$fila[txtid1]' readonly/></td>
																	<td><a  class='btn btn-danger' onclick='DeleteDiag(1)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																	<td><input type='text' id='txte1' onclick='verDiagnostico(11)' value='$fila[txte1]' readonly/></td>
																	<td><input type='text' id='txtec1' class='t1' value='$fila[txtec1]' readonly/></td>
																	<td><input type='text' id='txtepr1' class='t1' value='$fila[txtepr1]' readonly/></td>
																	<td><input type='text' id='txtede1' class='t1' value='$fila[txtede1]' readonly/></td>
																	<td><a  class='btn btn-danger' onclick='DeleteDiag(11)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																</tr>




																<tr>
																	<td><input type='text' id='txti2'   value='$fila[txti2]' readonly/></td>
																	<td><input type='text' id='txtic2' class='t1' value='$fila[txtic2]' readonly/></td>
																	<td><input type='text' id='txtipr2' class='t1'  value='$fila[txtipr2]'readonly/></td>
																	<td><input type='text' id='txtid2' class='t1' value='$fila[txtid2]' readonly/></td>
																	<td><a  class='btn btn-danger' onclick='DeleteDiag(2)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																	<td><input type='text' id='txte2' onclick='verDiagnostico(12)' value='$fila[txte2]' readonly /></td>
																	<td><input type='text' id='txtec2' class='t1' value='$fila[txtec2]' readonly/></td>
																	<td><input type='text' id='txtepr2' class='t1' value='$fila[txtepr2]' readonly/></td>
																	<td><input type='text' id='txtede2' class='t1'  value='$fila[txtede2]'readonly/></td>
																	<td><a class='btn btn-danger' onclick='DeleteDiag(12)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																</tr>




																<tr>
																	<td><input type='text' id='txti3' onclick='verDiagnostico(8)' value='$fila[txti3]' readonly/></td>
																	<td><input type='text' id='txtic3' class='t1' value='$fila[txtic3]' readonly/></td>
																	<td><input type='text' id='txtipr3' class='t1' value='$fila[txtipr3]' readonly/></td>
																	<td><input type='text' id='txtid3' class='t1' value='$fila[txtid3]' readonly/></td>
																	<td><a href='#' class='btn btn-danger' onclick='DeleteDiag(8)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																	<td><input type='text' id='txte3' onclick='verDiagnostico(13)' value='$fila[txte3]' readonly/></td>
																	<td><input type='text' id='txtec3' class='t1' value='$fila[txtec3]' readonly/></td>
																	<td><input type='text' id='txtepr3' class='t1' value='$fila[txtepr3]' readonly/></td>
																	<td><input type='text' id='txtede3' class='t1' value='$fila[txtede3]' readonly/></td>
																	<td><a class='btn btn-danger' onclick='DeleteDiag(13)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																</tr>




																<tr>
																	<td><input type='text' id='txti4' onclick='verDiagnostico(9)'   value='$fila[txti4]' readonly/></td>
																	<td><input type='text' id='txtic4' class='t1'  value='$fila[txtic4]' readonly/></td>
																	<td><input type='text' id='txtipr4' class='t1'  value='$fila[txtipr4]'  readonly/></td>
																	<td><input type='text' id='txtid4' class='t1'  value='$fila[txtid4]'  readonly/></td>
																	<td><a href='#' class='btn btn-danger' onclick='DeleteDiag(9)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																	<td><input type='text' id='txte4'  onclick='verDiagnostico(14)'  value='$fila[txte4]'  readonly /></td>
																	<td><input type='text' id='txtec4' class='t1'  value='$fila[txtec4]'  readonly/></td>
																	<td><input type='text' id='txtepr4' class='t1'  value='$fila[txtepr4]'  readonly/></td>
																	<td><input type='text' id='txtede4' class='t1'  value='$fila[txtede4]'  readonly/></td>
																	<td><a class='btn btn-danger' onclick='DeleteDiag(14)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																</tr>




																<tr>
																	<td><input type='text' id='txti5' onclick='verDiagnostico(10)'  value='$fila[txti5]'  readonly/></td>
																	<td><input type='text' id='txtic5' class='t1'  value='$fila[txtic5]'  readonly/></td>
																	<td><input type='text' id='txtipr5' class='t1'  value='$fila[txtipr5]'  readonly/></td>
																	<td><input type='text' id='txtid5' class='t1' value='$fila[txtid5]'   readonly/></td>
																	<td><a href='#' class='btn btn-danger' onclick='DeleteDiag(10)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																	<td><input type='text' id='txte5' onclick='verDiagnostico(15)' value='$fila[txte5]'   readonly /></td>
																	<td><input type='text' id='txtec5' class='t1' value='$fila[txtec5]'   readonly/></td>
																	<td><input type='text' id='txtepr5' class='t1' value='$fila[txtepr5]'   readonly/></td>
																	<td><input type='text' id='txtede5' class='t1'  value='$fila[txtede5]'  readonly/></td>
																	<td><a  class='btn btn-danger' onclick='DeleteDiag(15)' readonly><i class=' icon-remove'></i> Borrar</a></td>
																</tr>

															</table>

															";
															break;
														}
													}
			//fin for each  ayuda

			/*if ($ciepi->Consultar("SELECT COUNT(*) FROM tbl_ciepicris WHERE id_pac='$idPaciente';")==0) {
				echo "<table class='table table-hover table-bordered table-striped table-condensend'> <tr> <td colspan='10'>4 Diagnostico</td> </tr> <tr> <td >De ingreso</td> <td >Cie</td> <td>Pre</td> <td >Def</td> <td >&nbsp;</td> <td >De egreso</td> <td >Cie</td> <td >Pre</td> <td >Def</td> <td >&nbsp;</td> </tr> <tr> <td><input type='text' id='txtcieingr' onclick='verCieInEgreso()' /></td> <td><input type='text'  id='txtcodcieingr' class='t2' /></td> <td><input type='text' name='txtingpre' id='txtingpre' class='t2' /></td> <td><input type='text' name='txtingdef' id='txtingdef' class='t2' /></td> <td><input  type='button' id='btningrecie' onclick='SaveCieIngres()' class='btn' value='Guardar' /></td> <td> <input type='text' name='txtegrecie' id='txtegrecie' onclick='vercieEgreso()' /></td> <td><input type='text' name='txtcieegre' id='txtcieegre' class='t2' /></td> <td><input type='text' name='txtpreegre' id='txtpreegre' class='t2'/></td> <td><input type='text' name='txtdefegre' id='txtdefegre' class='t2' /></td> <td><input  type='button' id='btnegrecie' onclick='SaveCieEgreso()' class='btn ' value='Guardar' /></td> </tr> </table> <div id='FilaCieEpicris'> </div>";
			}else{

		$datos1=$ciepi->Consultar_CiEpicrisis("SELECT * FROM tbl_ciepicris WHERE id_pac='$idPaciente' ORDER BY id_ciepi DESC LIMIT 10; ");
		echo "
		<table class='table table-hover table-bordered table-striped table-condensend'> <tr> <td colspan='10'>4 Diagnostico</td> </tr> <tr> <td >De ingreso</td> <td >Cie</td> <td>Pre</td> <td >Def</td> <td >&nbsp;</td> <td >De egreso</td> <td >Cie</td> <td >Pre</td> <td >Def</td> <td >&nbsp;</td> </tr> <tr> <td><input type='text' id='txtcieingr' onclick='verCieInEgreso()' /></td> <td><input type='text'  id='txtcodcieingr' class='t2' /></td> <td><input type='text' name='txtingpre' id='txtingpre' class='t2' /></td> <td><input type='text' name='txtingdef' id='txtingdef' class='t2' /></td> <td><input  type='button' id='btningrecie' onclick='SaveCieIngres()' class='btn' value='Guardar' /></td> <td> <input type='text' name='txtegrecie' id='txtegrecie' onclick='vercieEgreso()' /></td> <td><input type='text' name='txtcieegre' id='txtcieegre' class='t2' /></td> <td><input type='text' name='txtpreegre' id='txtpreegre' class='t2'/></td> <td><input type='text' name='txtdefegre' id='txtdefegre' class='t2' /></td> <td><input  type='button' id='btnegrecie' onclick='SaveCieEgreso()' class='btn ' value='Guardar' /></td> </tr> </table>
		<div id='FilaCieEpicris'>
		<table class='table table-bordered table-striped table-hover table-condensend'>";
		foreach($datos1 as $fila1){
			switch ($fila1['pos_ciepi']) {
				case 'I':
						echo "
						<tr>
						<td >$fila1[descripcion_ciepi]</td>
					    <td >$fila1[codigo_ciepi]</td>
					    <td>$fila1[pre_ciepi]</td>
					    <td >$fila1[def_ciepi]</td>
					    <td ><input type='button' class='btn btn-danger' value='Borrar' onclick='Borrar($fila1[id_ciepi])'/></td>


						<td ></td>
					    <td ></td>
					    <td></td>
					    <td ></td>
					    <td ></td>
					    </tr>
					    ";
					break;
					case 'E':
						echo " 
						<tr> 
						<td ></td>
					    <td ></td>
					    <td></td>
					    <td ></td>
					    <td ></td>


					  	<td >$fila1[descripcion_ciepi]</td>
					    <td >$fila1[codigo_ciepi]</td>
					    <td>$fila1[pre_ciepi]</td>
					    <td >$fila1[def_ciepi]</td>
					    <td ><input type='button' class='btn btn-danger' value='Borrar' onclick='Borrar($fila1[id_ciepi])'/></td>
						</tr>
					    ";
					break;					
				
				
			}

		}
		echo "</table></div>";



	}*/


			//incio segundo foreach
	foreach($datos as $fila){
		switch ($fila['estado_epi']) {
			case 'F':
			echo "
			<table class='table table-hover table-bordered table-striped table-condensend'>

				<tr>
					<td colspan='8'>
						7 Condiciones de egreso y pronostico
					</td>
				</tr>
				<tr>
					<td colspan='8'>
						<textarea id='txtcondiciegepi' cols='200' rows='5' class='span10' readonly>$fila[cdeyp_epi]</textarea>
					</td>
				</tr>   
			</table>




			<table class='table table-hover table-bordered table-striped table-condensend' >
				<tr>
					<td colspan='3'>8 Medicos tratantes</td>
				</tr>
				<tr>
					<td colspan='3'><textarea id='txtmedicossFin' cols='200' rows='5' class='span10'  readonly>$fila[medicos_epi]</textarea></td>
				</table>





				<table class='table table-hover table-bordered table-striped table-condensend' >
					<tr>
						<td colspan='24'>9 Egreso</td>
					</tr>
					<tr>
						<td>Alta definitiva</td>
						<td><input type='text' name='txtaldef' id='txtaldef' class='t1' value='$fila[altd_epi]'  readonly/></td>
						<td>Asintomatico</td>
						<td><input type='text' name='txtasitom' id='txtasitom' class='t1' value='$fila[asin_epi]' readonly/></td>
						<td>Discapacidad moderada</td>
						<td><input type='text' name='txtdismo' id='txtdismo' class='t1' value='$fila[dismod_epi]'  readonly/></td>
						<td>Retiro voluntario</td>
						<td><input type='text' name='txtrevo' id='txtrevo' class='t1' value='$fila[retirovo_epi]'  readonly/></td>
						<td>Defuncion antes de 48 horas</td>
						<td><input type='text' name='txtdefat48' id='txtdefat48' class='t1' value='$fila[defant_epi]' readonly/></td>
						<td>Dias estadia</td>
						<td><input type='text' name='txtdest' id='txtdest' class='t1' value='$fila[diases_epi]'  readonly/></td>

					</tr>
					<tr>
						<td>Alta transitoria</td>
						<td>
							<input type='text' name='txtaltr' id='txtaltr' class='t1' value='$fila[alttr_epi]' readonly/></td>
							<td>Discapacidad leve</td>
							<td><input type='text' name='txtdisleve' id='txtdisleve' class='t1' value='$fila[disleve_epi]' readonly/></td>
							<td>Discapacidad grave</td>
							<td><input type='text' name='txtdisgra' id='txtdisgra' class='t1' value='$fila[disgra_epi]'  readonly/></td>
							<td>Retiroinvoluntario</td>
							<td><input type='text' name='txtreinv' id='txtreinv'  class='t1'  value='$fila[retiinvo_epi]' readonly/></td>
							<td>Defuncion despues de 48 horas</td>
							<td><input type='text' name='txtdefdes48' id='txtdefdes48' class='t1' value='$fila[defdes_epi]' readonly/></td>
							<td>Dias incapacidad</td>
							<td><input type='text' name='txtdiasinc' id='txtdiasinc' class='t1' value='$fila[diasin_epi]' readonly/></td>
						</tr>

					</table>


					<table class='table table-condensed table-bordered table-striped table-hover'>
						<tr>
							<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
							<td>MÉDICO</td>
							<td><input type='text' id='txtMediFin' value='$nombremedico'  readonly/></td>
							<td>FIRMA</td>
							<th>&nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;</th>
							<td><input type='text' id='txtcodigofin'  value='$fila[codigo_epi]'  readonly/></td>
						</tr>
						<tr>
							<td colspan='6'><center><a href='#' class='btn btn-success' onclick='AddNewEpicrisis()'><i class=' icon-file'></i> Nueva Epicrisis</a>   <a  href='#myModal' role='button'  data-toggle='modal' class='btn btn-info' onclick='JavaimpEpic($idPaciente)'><i class='icon-print'></i> Imprimir</a>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintReceEpi($fila[id_epi])'><i class=' icon-print'></i> Imprimir Receta</a></center></td>
						</tr>
					</table>



					";						
					break;
					
					case '':
					echo "
					<table class='table table-hover table-bordered table-striped table-condensend'>

						<tr>
							<td colspan='8'>
								7 Condiciones de egreso y pronostico
							</td>
						</tr>
						<tr>
							<td colspan='8'>
								<textarea id='txtcondiciegepi' cols='200' rows='5' class='span10'>$fila[cdeyp_epi]</textarea>
							</td>
						</tr>   
					</table>




					<table class='table table-hover table-bordered table-striped table-condensend' >
						<tr>
							<td colspan='3'>8 Medicos tratantes</td>
						</tr>
						<tr>
							<td colspan='3'><textarea id='txtmedicossFin' cols='200' rows='5' class='span10'>$fila[medicos_epi]</textarea></td>
						</table>





						<table class='table table-hover table-bordered table-striped table-condensend' >
							<tr>
								<td colspan='24'>9 Egreso</td>
							</tr>
							<tr>
								<td>Alta definitiva</td>
								<td><input type='text' name='txtaldef' id='txtaldef' class='t1' value='$fila[altd_epi]'/></td>
								<td>Asintomatico</td>
								<td><input type='text' name='txtasitom' id='txtasitom' class='t1' value='$fila[asin_epi]' /></td>
								<td>Discapacidad moderada</td>
								<td><input type='text' name='txtdismo' id='txtdismo' class='t1' value='$fila[dismod_epi]' /></td>
								<td>Retiro voluntario</td>
								<td><input type='text' name='txtrevo' id='txtrevo' class='t1' value='$fila[retirovo_epi]'/></td>
								<td>Defuncion antes de 48 horas</td>
								<td><input type='text' name='txtdefat48' id='txtdefat48' class='t1' value='$fila[defant_epi]'/></td>
								<td>Dias estadia</td>
								<td><input type='text' name='txtdest' id='txtdest' class='t1' value='$fila[diases_epi]' /></td>

							</tr>
							<tr>
								<td>Alta transitoria</td>
								<td>
									<input type='text' name='txtaltr' id='txtaltr' class='t1' value='$fila[alttr_epi]' /></td>
									<td>Discapacidad leve</td>
									<td><input type='text' name='txtdisleve' id='txtdisleve' class='t1' value='$fila[disleve_epi]'/></td>
									<td>Discapacidad grave</td>
									<td><input type='text' name='txtdisgra' id='txtdisgra' class='t1' value='$fila[disgra_epi]' /></td>
									<td>Retiroinvoluntario</td>
									<td><input type='text' name='txtreinv' id='txtreinv'  class='t1'  value='$fila[retiinvo_epi]'/></td>
									<td>Defuncion despues de 48 horas</td>
									<td><input type='text' name='txtdefdes48' id='txtdefdes48' class='t1' value='$fila[defdes_epi]' /></td>
									<td>Dias incapacidad</td>
									<td><input type='text' name='txtdiasinc' id='txtdiasinc' class='t1' value='$fila[diasin_epi]' /></td>
								</tr>

							</table>


							<table class='table table-condensed table-bordered table-striped table-hover'>
								<tr>
									<th>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</th>
									<td>MÉDICO</td>
									<td><input type='text' id='txtMediFin' value='$nombremedico'/></td>
									<td>FIRMA</td>
									<th>&nbsp; &nbsp;  &nbsp;   &nbsp;   &nbsp;   &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;</th>
									<td><input type='text' id='txtcodigofin'  value='$fila[codigo_epi]'/></td>
								</tr>
								<tr>
									<td colspan='6'><center><a href='#' class='btn btn-success' onclick='SaveEpicrisis()'><i class=' icon-file'></i> Guardar</a> <a class='btn btn-primary' href='#' onclick='EndEpicris($fila[id_epi])' ><i class='icon-stop'></i> Finalizar</a> <a href='#myModal' role='button'  data-toggle='modal' class='btn btn-info' onclick='JavaimpEpic($idPaciente)'><i class='icon-print'></i> Imprimir</a>&nbsp;<a href='#myModal' role='button'  data-toggle='modal' class='btn btn-info' onclick='PrintReceEpi($fila[id_epi])'><i class=' icon-print'></i> Imprimir Receta</a></center></td>
								</tr>
							</table>



							";						
							break;
						}

					}
			//fin segundo foreach


				}

			}

			public function AddNewEpicrisis($IdPaciente){
				$epi=new Epicrisis;
				$res=$epi->Consultar("INSERT INTO tbl_epicrisis (id_user) VALUES ('$IdPaciente');");
				echo "<center><h3>Se realizo correctamente la nueva epicrisis</h3></center>";	
			}


			public function EndEpicris($idepicrisis,$MedicoEpi){
				$epi=new Epicrisis;
				$res=$epi->Consultar("UPDATE tbl_epicrisis SET estado_epi='F', medico_epi='$MedicoEpi'  WHERE id_epi='$idepicrisis';");
				echo "<center><h3>Se finalizo correctamente la epicrisis</h3></center>";
			}



			public function VademecunDoc2($donde)
			{
				$pa=new Cie;
				$datos=$pa->Consultar_Cie("SELECT * FROM tbl_cie LIMIT 300");
				echo "
				<div class='demo_jui'>
					<table cellpadding='7' cellspacing='0' id='MiTablaVademecun'>
						<thead>
							<tr class='fila'>
								<td>Codigo</td>
								<td>Descripcion</td>
								<td>Asignar</td>	
							</tr>
						</thead>	
						<tbody>

							";
							foreach($datos as $fila)
							{
								echo "
								<tr>
									<td>".utf8_decode($fila['cod_diag'])."</td>
									<td>".utf8_decode($fila['desc_diag'])."</td>														
									<td><input type='button' value='Asignar' class='btn btn-success' id='bntVademecun' onclick='CieLoad($fila[id_diag], $donde)'/></td>

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


			public function LoadDiagnosticoEpicrisisi($idPaciente){
				$ciepi=new CiEpicrisis;
				$datos1=$ciepi->Consultar_CiEpicrisis("SELECT * FROM tbl_ciepicris WHERE id_pac='$idPaciente' ORDER BY id_ciepi DESC LIMIT 10; ");
				echo "
				<!--<table class='table table-hover table-bordered table-striped table-condensend'> <tr> <td colspan='10'>4 Diagnostico</td> </tr> <tr> <td >De ingreso</td> <td >Cie</td> <td>Pre</td> <td >Def</td> <td >&nbsp;</td> <td >De egreso</td> <td >Cie</td> <td >Pre</td> <td >Def</td> <td >&nbsp;</td> </tr> <tr> <td><input type='text' id='txtcieingr' onclick='verCieInEgreso()' /></td> <td><input type='text'  id='txtcodcieingr' class='t2' /></td> <td><input type='text' name='txtingpre' id='txtingpre' class='t2' /></td> <td><input type='text' name='txtingdef' id='txtingdef' class='t2' /></td> <td><input  type='button' id='btningrecie' onclick='SaveCieIngres()' class='btn' value='Guardar' /></td> <td> <input type='text' name='txtegrecie' id='txtegrecie' onclick='vercieEgreso()' /></td> <td><input type='text' name='txtcieegre' id='txtcieegre' class='t2' /></td> <td><input type='text' name='txtpreegre' id='txtpreegre' class='t2'/></td> <td><input type='text' name='txtdefegre' id='txtdefegre' class='t2' /></td> <td><input  type='button' id='btnegrecie' onclick='SaveCieEgreso()' class='btn ' value='Guardar' /></td> </tr> </table>-->
				<div id='FilaCieEpicris'>
					<table class='table table-bordered table-striped table-hover table-condensend'>";
						foreach($datos1 as $fila1){
							switch ($fila1['pos_ciepi']) {
								case 'I':
								echo "
								<tr>
									<td >$fila1[descripcion_ciepi]</td>
									<td >$fila1[codigo_ciepi]</td>
									<td>$fila1[pre_ciepi]</td>
									<td >$fila1[def_ciepi]</td>
									<td ><input type='button' class='btn btn-danger' value='Borrar' onclick='Borrar($fila1[id_ciepi])'/></td>


									<td ></td>
									<td ></td>
									<td></td>
									<td ></td>
									<td ></td>
								</tr>
								";
								break;
								case 'E':
								echo " 
								<tr> 
									<td ></td>
									<td ></td>
									<td></td>
									<td ></td>
									<td ></td>


									<td >$fila1[descripcion_ciepi]</td>
									<td >$fila1[codigo_ciepi]</td>
									<td>$fila1[pre_ciepi]</td>
									<td >$fila1[def_ciepi]</td>
									<td ><input type='button' class='btn btn-danger' value='Borrar' onclick='Borrar($fila1[id_ciepi])'/></td>
								</tr>
								";
								break;					


							}

						}
						echo "</table></div>";

					}
					public function LoadCieTextbox($cie,$caja){
						$aux=new Cie;
						$descripcion=$aux->Consultar("SELECT desc_diag FROM tbl_cie WHERE id_diag='$cie';");
						$codigo=$aux->Consultar("SELECT cod_diag FROM tbl_cie WHERE id_diag='$cie';");
						$vector=array("$caja","$descripcion","$codigo");
						echo json_encode($vector);

					}
					public function BuscarCieEpic($caja,$por){
						$pa=new Cie;
						$datos=$pa->Consultar_Cie("SELECT * FROM tbl_cie WHERE cod_diag LIKE '%$por%' OR desc_diag LIKE '%$por%' LIMIT 100;");
						echo "

						<div class='table-responsive'>
							<table class='table table-bordered table-striped table-condensed'>
								<thead>
									<tr class='fila'>
										<td>Codigo</td>
										<td>Descripcion</td>
										<td>Asignar</td>	
									</tr>
								</thead>	
								<tbody>

									";
									foreach($datos as $fila)
									{
										echo "
										<tr>
											<td>".utf8_decode($fila['cod_diag'])."</td>
											<td>".utf8_decode($fila['desc_diag'])."</td>														
											<td><a class='btn btn-success' onclick='CieLoad($fila[id_diag], $caja)' data-dismiss='modal' aria-hidden='true'> Asignar</a> </td>

										</tr>
										";
									}
									echo "
								</tbody>
							</table>
						</div>
						";	
					}

					public function SaveCieEpicris($ciepi){
						$aux=new CiEpicrisis;

						$today=$this->Mifecha();
		//decodificando a un vector para recorrerlo por un foreach
						$ciep=json_decode($ciepi);
						$pacient=NULL;
						foreach($ciep as $c){
							$res=$aux->Ejecutar("INSERT INTO tbl_ciepicris (id_pac,descripcion_ciepi,codigo_ciepi,pre_ciepi,def_ciepi,fecha_ciepi,pos_ciepi) 
								VALUES('".$c->id_pac."','".$c->descripcion_ciepi."','".$c->codigo_ciepi."','".$c->pre_ciepi."','".$c->def_ciepi."','$today','".$c->pos_ciepi."');");		
							$paciente=$c->id_pac;
						}
//		echo "<center><h3>Se guardo correctamente el odontograma del paciente</h3></center>";
						$datos=$aux->Consultar_CiEpicrisis("SELECT * FROM tbl_ciepicris WHERE id_pac='$pacient' ORDER BY id_ciepi DESC LIMIT 10; ");
						echo "<table class='table table-bordered table-striped table-hover table-condensend'>";
						foreach($datos as $fila){
							switch ($fila['pos_ciepi']) {
								case 'I':
								echo "
								<tr>
									<td >$fila[descripcion_ciepi]</td>
									<td >$fila[codigo_ciepi]</td>
									<td>$fila[pre_ciepi]</td>
									<td >$fila[def_ciepi]</td>
									<td ><input type='button' class='btn btn-danger' value='Borrar' onclick='Borrar($fila[id_ciepi])'/></td>


									<td ></td>
									<td ></td>
									<td></td>
									<td ></td>
									<td ></td>
								</tr>
								";
								break;
								case 'E':
								echo " 
								<tr> 
									<td ></td>
									<td ></td>
									<td></td>
									<td ></td>
									<td ></td>


									<td >$fila[descripcion_ciepi]</td>
									<td >$fila[codigo_ciepi]</td>
									<td>$fila[pre_ciepi]</td>
									<td >$fila[def_ciepi]</td>
									<td ><input type='button' class='btn btn-danger' value='Borrar' onclick='Borrar($fila[id_ciepi])'/></td>
								</tr>
								";
								break;					


							}

						}
						echo "</table>";
					}

					public function SaveEpicrisPhp($objepicrisis){
						$epi=new Epicrisis;
						session_start();
						$user=$_SESSION['DOCTOR'];
						$idmed=$epi->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$user';");
						$ep=json_decode($objepicrisis);
						foreach ($ep as $e) {
							$res=$epi->Ejecutar("INSERT INTO tbl_epicrisis (id_user,id_tu,unidadop_epi,parroquia_epi,canton_epi,provincia_epi,fechaat_epi,hora_epi,empresa_epi,segurosa_epi,rdcc_epi,rdeyc,hrdeyp_epi,rdtypt_epi,cdeyp_epi,altd_epi,alttr_epi,asin_epi,disleve_epi,dismod_epi,disgra_epi,retirovo_epi,retiinvo_epi,defant_epi,defdes_epi,diases_epi,diasin_epi,medicos_epi,medico_epi,codigo_epi,txti1,txtic1,txtipr1,txtid1,txti2,txtic2,txtipr2,txtid2,txti3,txtic3,txtipr3,txtid3,txti4,txtic4,txtipr4,txtid4,txti5,txtic5,txtipr5,txtid5,txte1,txtec1,txtepr1,txtede1,txte2,txtec2,txtepr2,txtede2,txte3,txtec3,txtepr3,txtede3,txte4,txtec4,txtepr4,txtede4,txte5,txtec5,txtepr5,txtede5,id_med)
								VALUES ('".$e->user."','".$e->tur."','".$e->unidaop."','".$e->parroqu."','".$e->canton."','".$e->provincia."','".$e->fecha."','".$e->hora."','".$e->empresa."','".$e->seguro."','".$e->rdcc."','".$e->rdeyc."','".$e->hrdeyp."','".$e->rdtypt."','".$e->cdeyp."','".$e->altd."','".$e->alttr."','".$e->asin."','".$e->disleve."','".$e->dismod."','".$e->disgra."','".$e->retirovo."','".$e->retiinvo."','".$e->defant."','".$e->defdes."','".$e->diases."','".$e->diasin."','".$e->medicos."','".$e->medico."','".$e->codigo."','".$e->txti1."','".$e->txtic1."','".$e->txtipr1."','".$e->txtid1."','".$e->txti2."','".$e->txtic2."','".$e->txtipr2."','".$e->txtid2."','".$e->txti3."','".$e->txtic3."','".$e->txtipr3."','".$e->txtid3."','".$e->txti4."','".$e->txtic4."','".$e->txtipr4."','".$e->txtid4."','".$e->txti5."','".$e->txtic5."','".$e->txtipr5."','".$e->txtid5."','".$e->txte1."','".$e->txtec1."','".$e->txtepr1."','".$e->txtede1."','".$e->txte2."','".$e->txtec2."','".$e->txtepr2."','".$e->txtede2."','".$e->txte3."','".$e->txtec3."','".$e->txtepr3."','".$e->txtede3."','".$e->txte4."','".$e->txtec4."','".$e->txtepr4."','".$e->txtede4."','".$e->txte5."','".$e->txtec5."','".$e->txtepr5."','".$e->txtede5."','$idmed' ) ;");
							echo $res;
						}
					}

					public function LoadHisEpicrisis($idpaciente){
						$ep=new Epicrisis;
						$nombrePaciente=$ep->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$idpaciente';");
						$nombrePaciente=utf8_decode($nombrePaciente);
						$datos=$ep->Consultar_Epicrisis("SELECT * FROM tbl_epicrisis WHERE id_user='$idpaciente' AND estado_epi='F' ORDER BY fechaat_epi DESC");
						echo "<table class='table table-condensed table-bordered table-striped table-hover'>
						<tr>
							<th colspan='4'><center><h4>Historial Epicrisis Del Paciente: $nombrePaciente</h4></center></th>
						</tr>
						<tr>
							<th>Fecha</th>
							<th>Hora</th>
							<th></th>
							<th></th>
						</tr>
						";
						foreach ($datos as $fila) {
							echo "
							<tr>
								<td>$fila[fechaat_epi]</td>
								<td>$fila[hora_epi]</td>
								<td><a href='#' class='btn btn-info' onclick='ImpEpicrisis2($fila[id_epi],$idpaciente)'><i class='icon-print'></i> Ver</a></td>
								<!--<td><input type='checkbox' name='option1' class='chk_genpdfepi' value='$fila[id_epi],$idpaciente'></td>-->
							</tr>
							";
						}
						echo "
						<tr>
							<td colspan='4'>
								<!--<center><a href='#' class='btn btn-success' onclick='GeneralAllPdfEpic()'><i class='icon-file'></i> Generar epicrisis</a></center>-->
							</td>
						</tr>
					</table>";

				}

//fin procedimietos para la epicrisis 

// ---------------------- Mi codigo Cdu Anamnesis ------------------------------//

//save Anamnesis Cdu
				function SaveCduAnamnesis($Establecimiento,$Nombre,$Apellido,$Sexo,$NumeroHo,$HistClinica,$MotivoCon,$AntecPerso,$AntecFami,$EnferProblemAc,$ReviOrgySis,$FechaSv1,$FechaSv2,$FechaSv3,$FechaSv4,$PreArterialSv1,$PreArterialSv2,$PreArterialSv3,$PreArterialSv4,$PulsoSv1,$PulsoSv2,$PulsoSv3,$PulsoSv4,$TempSv1,$TempSv2,$TempSv3,$TempSv4,$ExamFisico,$Diag1,$Diag2,$Diag3,$Diag4,$Diag5,$CodeCie1,$CodeCie2,$CodeCie3,$CodeCie4,$CodeCie5,$Pre1,$Pre2,$Pre3,$Pre4,$Pre5,$Def1,$Def2,$Def3,$Def4,$Def5,$PlanesDiag,$IdPac,$FechaControl,$HoraFin,$Medic,$CodMedic)
				{
					$anamcdu = new AnamnesisCdu;
					$today=$this->Mifecha();
					session_start();
					$med=$_SESSION['DOCTOR'];
					$id=$anamcdu->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$med';");
					$aux = $anamcdu->Ejecutar("INSERT INTO tbl_cduanamnesis (establ_cduanam,nom_cduanam,ape_cduanam,sex_cduanam,numh_cduanam,histcl_cduanam,motivoc_cduanam,anteper_cduanam,antefam_cduanam,enferac_cduanam,reviorgsis_cduanam,fecha1_cduanam,fecha2_cduanam,fecha3_cduanam,fehca4_cduanam,prearte1_cduanam,prearte2_cduanam,prearte3_cduanam,prearte4_cduanam,pulso1_cduanam,pulso2_cduanam,pulso3_cduanam,pulso4_cduanam,temp1_cduanam,temp2_cduanam,temp3_cduanam,temp4_cduanam,examfi_cduanam,cie1_cduanam,cie2_cduanam,cie3_cduanam,cie4_cduanam,cie5_cduanam,codcie1_cduanam,codcie2_cduanam,codcie3_cduanam,codcie4_cduanam,codcie5_cduanam,pre1_cduanam,pre2_cduanam,pre3_cduanam,pre4_cduanam,pre5_cduanam,def1_cduanam,def2_cduanam,def3_cduanam,def4_cduanam,def5_cduanam,planesdte_cduanam,est_cduanam,id_pac,fechcontr_cduanam,horafin_cduanam,medico_cduanam,codmed_cduanam,fechasa_cduanm,id_med) VALUES ('$Establecimiento','$Nombre','$Apellido','$Sexo','$NumeroHo','$HistClinica','$MotivoCon','$AntecPerso','$AntecFami','$EnferProblemAc','$ReviOrgySis','$FechaSv1','$FechaSv2','$FechaSv3','$FechaSv4','$PreArterialSv1','$PreArterialSv2','$PreArterialSv3','$PreArterialSv4','$PulsoSv1','$PulsoSv2','$PulsoSv3','$PulsoSv4','$TempSv1','$TempSv2','$TempSv3','$TempSv4','$ExamFisico','$Diag1','$Diag2','$Diag3','$Diag4','$Diag5','$CodeCie1','$CodeCie2','$CodeCie3','$CodeCie4','$CodeCie5','$Pre1','$Pre2','$Pre3','$Pre4','$Pre5','$Def1','$Def2','$Def3','$Def4','$Def5','$PlanesDiag','A','$IdPac','$FechaControl','$HoraFin','$Medic','$CodMedic','$today','$id')"); 
					echo "Los datos se han guardado correctamente ";

				}
//fin save Anamnesis Cdu 

//load all datos de anamnesis cdu
				public function LoadAllAnamnesisCdu($codigo)
				{
					$aux=new AnamnesisCdu;
					session_start();
					$log=$_SESSION['DOCTOR']	;
					$nombremedico=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$log';");
					echo "<script  type='text/javascript' >
					$('#txtmd').val('$nombremedico');
				</script> "	;
				$nompac=$aux->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codigo'");
				$nompac=utf8_encode($nompac);
				$apepac=$aux->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$codigo'");
				$apepac=utf8_encode($apepac);
				$sexpac=$aux->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codigo'");
				$cedpac=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo'");
				if($aux->Consultar("SELECT COUNT(*) FROM tbl_cduanamnesis WHERE id_pac='$codigo'")==0)
				{
					echo "<!-- Cabecera --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td rowspan='2'><center>Establecimiento</center></td> <td rowspan='2'><center>Nombre</center></td> <td rowspan='2'><center>Apellido</center></td> <td colspan='2' rowspan='2'><center>Sexo</center></td> <td rowspan='2'><center>Número de <br />hoja</center></td> <td rowspan='2'><center>Historia <br />clínica</center></td> </tr> <tr> </tr> <tr> <td><input type='text' id='txtEstablecim' style='width:140px; text-align:center;' value='Clínica de Urología' readonly /></td> <td><input type='text' id='txtNompac' style='width:140px; text-align:center;' value='$nompac' readonly /></td> <td><input type='text' id='txtApepac' style='width:140px; text-align:center;' value='$apepac' readonly /></td> <td colspan='2'><input type='text' id='SexAnam' style='width:80px; text-align:center;' value='$sexpac' readonly /></td> <td><input type='text' id='txtNumHoja' style='width:100px; text-align:center;' readonly/></td> <td><input type='text' id='txtHisCl' style='width:100px; text-align:center;' value='$cedpac' readonly /></td> </tr> </table> <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>1. Motivo de consulta</td> </tr> <tr> <td><textarea id='txtMotivoCon' cols='40' rows='2' class='span10'></textarea></td> </tr> </table> <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Antecedentes personales</td> </tr> <tr> <td><textarea id='txtAntePer' cols='40' rows='2' class='span10' ></textarea></td> </tr> </table> <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Antecedentes familiares</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtAnteFam' class='span10' ></textarea> </td> </tr> </table> <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Enfermedad o problema actual</td> </tr> <tr> <td><textarea id='txtEnfermeAc' cols='40' rows='2' class='span10'></textarea></td> </tr> </table> <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Revisión actual de órganos y sistemas</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtRevisionOys' class='span10' ></textarea> </td> </tr> </table> <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Signos vitales</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td><center>Fecha: </center></td> <td><input type='text' id='txtFechAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Presión arterial: </center></td> <td><input type='text' id='txtPreArAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Pulso x min: </center></td> <td><input type='text' id='txtPulAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Temperatura °c: </center></td> <td><input type='text' id='txtTemcAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam4' style='width:140px; text-align:center;' /></td> </tr> </table> </td> </tr> </table> <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Examen físico</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtExamenFi' class='span10' ></textarea> </td> </tr> </table> <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1' class='span10'  /> <a onclick='verDiagnostico(3)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1' onclick='DeleteCie1()'/> </td> <td><input type='checkbox' id='txtPre1'></td> <td><input type='checkbox' id='txtDef1'></td> </tr> <tr> <td>2</td> <td><input type='text' id='txtCie2' class='span10' /> <a onclick='verDiagnostico(4)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2' onclick='DeleteCie2()'/> </td> <td><input type='checkbox' id='txtPre2'></td> <td><input type='checkbox' id='txtDef2'></td> </tr> <tr> <td>3</td> <td><input type='text' id='txtCie3' class='span10'  /> <a onclick='verDiagnostico(5)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod3' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3' onclick='DeleteCie3()'/> </td> <td><input type='checkbox' id='txtPre3'></td> <td><input type='checkbox' id='txtDef3'></td> </tr> <tr> <td>4</td> <td><input type='text' id='txtCie4' class='span10'  /> <a onclick='verDiagnostico(6)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4' onclick='DeleteCie4()'/> </td> <td><input type='checkbox' id='txtPre4'></td> <td><input type='checkbox' id='txtDef4'></td> </tr> <tr> <td>5</td> <td><input type='text' id='txtCie5' class='span10' />  <a onclick='verDiagnostico(7)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod5' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5' onclick='DeleteCie5()'/> </td> <td><input type='checkbox' id='txtPre5'></td> <td><input type='checkbox' id='txtDef5'></td> </tr> </table> </td> </tr> </table> <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Planes de Diagnóstico, Terapeúticos y Educacionales </td> </tr> <tr> <td><textarea id='txtPlanesdte'  cols='90' rows='4' class='span10'></textarea><a href='#myModal' role='button'  data-toggle='modal' class='btn btn-success'  onclick='datosvademecun()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table> <!-- PiePg --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Fecha para control: </td> <td><input type='text' id='txtFechaControl' style='width:100px; text-align:center;'/></td> <td>Hora fin: </td> <td><input type='text' id='txtHoraFin' style='width:100px; text-align:center;'/></td> <td>Médico: </td> <td><input type='text' id='txtMedich' value='$nombremedico' style='text-align:center;'/></td> <td>Código: </td> <td><input type='text' id='txtCodM3' style='width:70px; text-align:center;'/></td> <td>Firma: </td> <td><input type='text' id='txtFirma' style='width:70px; text-align:center;' readonly/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr><td><center> <a href='#' class='btn btn-info' onclick='SaveAnanmesisCdu()'><i class=' icon-file'></i> Guardar</a> </center></td> </tr> </table> ";
				}
				else
				{
					$codcdu=$aux->Consultar("SELECT MAX(id_cduanam) FROM tbl_cduanamnesis WHERE id_pac='$codigo'");
					$datos=$aux->Consultar_AnamnesisCdu("SELECT * FROM tbl_cduanamnesis WHERE id_cduanam='$codcdu'");

					$nompac=$aux->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$nompac=utf8_encode($nompac);
					$apepac=$aux->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$apepac=utf8_encode($apepac);
					$sexpac=$aux->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$cedpac=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo'");

					foreach($datos as $fila)
					{
						switch($fila['est_cduanam'])
						{
							case "A":
							echo "<!-- Cabecera --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td rowspan='2'><center>Establecimiento</center></td> <td rowspan='2'><center>Nombre</center></td> <td rowspan='2'><center>Apellido</center></td> <td colspan='2' rowspan='2'><center>Sexo</center></td> <td rowspan='2'><center>Número de <br />hoja</center></td> <td rowspan='2'><center>Historia <br />clínica</center></td> </tr> <tr> </tr> <tr> <td><input type='text' id='txtEstablecim' style='width:140px; text-align:center;' value='Clínica de Urología' readonly /></td> <td><input type='text' id='txtNompac' style='width:140px; text-align:center;' value='$nompac' readonly /></td> <td><input type='text' id='txtApepac' style='width:140px; text-align:center;' value='$apepac' readonly /></td> <td colspan='2'><input type='text' id='SexAnam' style='width:80px; text-align:center;' value='$sexpac' readonly /></td> <td><input type='text' id='txtNumHoja' style='width:100px; text-align:center;' readonly/></td> <td><input type='text' id='txtHisCl' style='width:100px; text-align:center;' value='$cedpac' readonly /></td> </tr> </table> <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>1. Motivo de consulta</td> </tr> <tr> <td><textarea id='txtMotivoCon' cols='40' rows='2' class='span10' >$fila[motivoc_cduanam]</textarea></td> </tr> </table> <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Antecedentes personales</td> </tr> <tr> <td><textarea id='txtAntePer' cols='40' rows='2' class='span10' >$fila[anteper_cduanam]</textarea></td> </tr> </table> <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Antecedentes familiares</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtAnteFam' class='span10' >$fila[antefam_cduanam]</textarea> </td> </tr> </table> <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Enfermedad o problema actual</td> </tr> <tr> <td><textarea id='txtEnfermeAc' cols='40' rows='2'  class='span10' >$fila[enferac_cduanam]</textarea></td> </tr> </table> <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Revisión actual de órganos y sistemas</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtRevisionOys' class='span10' >$fila[reviorgsis_cduanam]</textarea> </td> </tr> </table> <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Signos vitales</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td><center>Fecha: </center></td> <td><input type='text' id='txtFechAnam' style='width:140px; text-align:center;' value='$fila[fecha1_cduanam]' /></td> <td><input type='text' id='txtFechAnam2' style='width:140px; text-align:center;' value='$fila[fecha2_cduanam]' /></td> <td><input type='text' id='txtFechAnam3' style='width:140px; text-align:center;' value='$fila[fecha3_cduanam]'/></td> <td><input type='text' id='txtFechAnam4' style='width:140px; text-align:center;' value='$fila[fehca4_cduanam]' /></td> </tr> <tr> <td><center>Presión arterial: </center></td> <td><input type='text' id='txtPreArAnam' style='width:140px; text-align:center;' value='$fila[prearte1_cduanam]' /></td> <td><input type='text' id='txtPreArAnam2' style='width:140px; text-align:center;' value='$fila[prearte2_cduanam]' /></td> <td><input type='text' id='txtPreArAnam3' style='width:140px; text-align:center;' value='$fila[prearte3_cduanam]' /></td> <td><input type='text' id='txtPreArAnam4' style='width:140px; text-align:center;' value='$fila[prearte4_cduanam]' /></td> </tr> <tr> <td><center>Pulso x min: </center></td> <td><input type='text' id='txtPulAnam' style='width:140px; text-align:center;' value='$fila[pulso1_cduanam]' /></td> <td><input type='text' id='txtPulAnam2' style='width:140px; text-align:center;' value='$fila[pulso2_cduanam]' /></td> <td><input type='text' id='txtPulAnam3' style='width:140px; text-align:center;' value='$fila[pulso3_cduanam]' /></td> <td><input type='text' id='txtPulAnam4' style='width:140px; text-align:center;' value='$fila[pulso4_cduanam]' /></td> </tr> <tr> <td><center>Temperatura °c: </center></td> <td><input type='text' id='txtTemcAnam' style='width:140px; text-align:center;' value='$fila[temp1_cduanam]' /></td> <td><input type='text' id='txtTemcAnam2' style='width:140px; text-align:center;' value='$fila[temp2_cduanam]' /></td> <td><input type='text' id='txtTemcAnam3' style='width:140px; text-align:center;' value='$fila[temp3_cduanam]' /></td> <td><input type='text' id='txtTemcAnam4' style='width:140px; text-align:center;' value='$fila[temp4_cduanam]' /></td> </tr> </table> </td> </tr> </table> <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Examen físico</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtExamenFi' class='span10' value='$fila[examfi_cduanam]' ></textarea> </td> </tr> </table> <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1' class='span10' value='$fila[cie1_cduanam]'  /> <a onclick='verDiagnostico(3)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1' style='width:100px;' value='$fila[codcie1_cduanam]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1' onclick='DeleteCie1()'/> </td> <td>" ; 
							if($fila['pre1_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre1' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre1' ></td>";
							}
							echo "<td>";
							if($fila['def1_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef1' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef1' ></td>";
							}
							echo "</tr> <tr> <td>2</td> <td><input type='text' id='txtCie2' class='span10' value='$fila[cie2_cduanam]'  />  <a onclick='verDiagnostico(4)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2' style='width:100px;' value='$fila[codcie2_cduanam]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2' onclick='DeleteCie2()'/> </td> <td>"; 
							if($fila['pre2_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre2' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre2'></td>";
							}
							echo "<td>";
							if($fila['def2_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef2' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef2'></td>";
							}
							echo "</tr> <tr> <td>3</td> <td><input type='text' id='txtCie3' class='span10' value='$fila[cie3_cduanam]'  />  <a onclick='verDiagnostico(5)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod3' style='width:100px;' value='$fila[codcie3_cduanam]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3' onclick='DeleteCie3()'/> </td> <td>" ;
							if($fila['pre3_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre3' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre3'></td>";
							}
							echo "<td>"; 
							if($fila['def3_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef3' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef3'></td>";
							}
							echo "</tr> <tr> <td>4</td> <td><input type='text' id='txtCie4' class='span10' value='$fila[cie4_cduanam]'  /> <a onclick='verDiagnostico(6)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4' style='width:100px;' value='$fila[codcie4_cduanam]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4' onclick='DeleteCie4()'/> </td> <td>";
							if($fila['pre4_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre4' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre4'></td>";
							}
							echo "<td>";
							if($fila['def4_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef4' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef4'></td>";
							}
							echo "</tr> <tr> <td>5</td> <td><input type='text' id='txtCie5' class='span10' value='$fila[cie5_cduanam]'  /> <a onclick='verDiagnostico(7)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod5' style='width:100px;' value='$fila[codcie5_cduanam]'/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5' onclick='DeleteCie5()'/> </td> <td>";
							if($fila['pre5_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre5' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre5'></td>";
							}
							echo "<td>";
							if($fila['def5_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef5' checked='true'></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef5'></td>";
							}
							echo "</tr> </table> </td> </tr> </table> <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Planes de Diagnóstico, Terapeúticos y Educacionales </td> </tr> <tr> <td><textarea id='txtPlanesdte'  cols='90' rows='4' class='span10'>$fila[planesdte_cduanam]</textarea><a href='#myModal' role='button'  data-toggle='modal' class='btn btn-success' onclick='datosvademecun()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table> <!-- PiePg --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Fecha para control: </td> <td><input type='text' id='txtFechaControl' style='width:100px; text-align:center;' value='$fila[fechcontr_cduanam]' /></td> <td>Hora fin: </td> <td><input type='text' id='txtHoraFin' style='width:100px;  text-align:center;' value='$fila[horafin_cduanam]'/></td> <td>Médico: </td> <td><input type='text' id='txtMedich' value='$nombremedico' style='text-align:center;' value='$fila[medico_cduanam]' /></td> <td>Código: </td> <td><input type='text' id='txtCodM3' style='width:70px; text-align:center;' value='$fila[codmed_cduanam]' /></td> <td>Firma: </td> <td><input type='text' id='txtFirma' style='width:70px; text-align:center;' readonly/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr><td><center> <a href='#' class='btn btn-info' onclick='SaveAnanmesisCdu()'><i class=' icon-file'></i> Guardar</a>&nbsp; <a href='#'  class='btn btn-primary' onclick='Expediente()'><i class=' icon-share-alt'></i> Subsecuente</a>&nbsp; <a href='#myModal' role='button'  data-toggle='modal' class='btn btn-info' onclick='PrintAnamnesisCdu()'><i class=' icon-print'></i> Imprimir</a>&nbsp;    <a href='#myModal' role='button'  data-toggle='modal' class='btn btn-info' onclick='PrintRECELih($fila[id_cduanam])'><i class=' icon-print'></i> Imprimir Receta</a>    <a href='#' class='btn btn-danger' onclick='FinalizarAnam($fila[id_cduanam])'><i class=' icon-stop'></i> Finalizar</a> </center></td> </tr> </table>";
							break;

							case "F":
							echo "<!-- Cabecera --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td rowspan='2'><center>Establecimiento</center></td> <td rowspan='2'><center>Nombre</center></td> <td rowspan='2'><center>Apellido</center></td> <td colspan='2' rowspan='2'><center>Sexo</center></td> <td rowspan='2'><center>Número de <br />hoja</center></td> <td rowspan='2'><center>Historia <br />clínica</center></td> </tr> <tr> </tr> <tr> <td><input type='text' id='txtEstablecim' style='width:140px; text-align:center;' value='Clínica de Urología' readonly /></td> <td><input type='text' id='txtNompac' style='width:140px; text-align:center;' value='$nompac' readonly /></td> <td><input type='text' id='txtApepac' style='width:140px; text-align:center;' value='$apepac' readonly /></td> <td colspan='2'><input type='text' id='SexAnam' style='width:80px; text-align:center;' value='$sexpac' readonly /></td> <td><input type='text' id='txtNumHoja' style='width:100px; text-align:center;' readonly/></td> <td><input type='text' id='txtHisCl' style='width:100px; text-align:center;' value='$cedpac' readonly /></td> </tr> </table> <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>1. Motivo de consulta</td> </tr> <tr> <td><textarea id='txtMotivoCon' cols='40' rows='2' class='span10' readonly>$fila[motivoc_cduanam]</textarea></td> </tr> </table> <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Antecedentes personales</td> </tr> <tr> <td><textarea id='txtAntePer' cols='40' rows='2' class='span10' readonly>$fila[anteper_cduanam]</textarea></td> </tr> </table> <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Antecedentes familiares</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtAnteFam' class='span10' readonly>$fila[antefam_cduanam]</textarea> </td> </tr> </table> <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Enfermedad o problema actual</td> </tr> <tr> <td><textarea id='txtEnfermeAc' cols='40' rows='2'  class='span10' readonly>$fila[enferac_cduanam]</textarea></td> </tr> </table> <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Revisión actual de órganos y sistemas</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtRevisionOys' class='span10' readonly>$fila[reviorgsis_cduanam]</textarea> </td> </tr> </table> <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Signos vitales</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td><center>Fecha: </center></td> <td><input type='text' id='txtFechAnam' style='width:140px; text-align:center;' value='$fila[fecha1_cduanam]' readonly/></td> <td><input type='text' id='txtFechAnam2' style='width:140px; text-align:center;' value='$fila[fecha2_cduanam]' readonly/></td> <td><input type='text' id='txtFechAnam3' style='width:140px; text-align:center;' value='$fila[fecha3_cduanam]' readonly/></td> <td><input type='text' id='txtFechAnam4' style='width:140px; text-align:center;' value='$fila[fehca4_cduanam]' readonly/></td> </tr> <tr> <td><center>Presión arterial: </center></td> <td><input type='text' id='txtPreArAnam' style='width:140px; text-align:center;' value='$fila[prearte1_cduanam]' readonly/></td> <td><input type='text' id='txtPreArAnam2' style='width:140px; text-align:center;' value='$fila[prearte2_cduanam]' readonly/></td> <td><input type='text' id='txtPreArAnam3' style='width:140px; text-align:center;' value='$fila[prearte3_cduanam]' readonly/></td> <td><input type='text' id='txtPreArAnam4' style='width:140px; text-align:center;' value='$fila[prearte4_cduanam]' readonly/></td> </tr> <tr> <td><center>Pulso x min: </center></td> <td><input type='text' id='txtPulAnam' style='width:140px; text-align:center;' value='$fila[pulso1_cduanam]' readonly/></td> <td><input type='text' id='txtPulAnam2' style='width:140px; text-align:center;' value='$fila[pulso2_cduanam]' readonly/></td> <td><input type='text' id='txtPulAnam3' style='width:140px; text-align:center;' value='$fila[pulso3_cduanam]' readonly/></td> <td><input type='text' id='txtPulAnam4' style='width:140px; text-align:center;' value='$fila[pulso4_cduanam]' readonly/></td> </tr> <tr> <td><center>Temperatura °c: </center></td> <td><input type='text' id='txtTemcAnam' style='width:140px; text-align:center;' value='$fila[temp1_cduanam]' readonly/></td> <td><input type='text' id='txtTemcAnam2' style='width:140px; text-align:center;' value='$fila[temp2_cduanam]' readonly/></td> <td><input type='text' id='txtTemcAnam3' style='width:140px; text-align:center;' value='$fila[temp3_cduanam]' readonly/></td> <td><input type='text' id='txtTemcAnam4' style='width:140px; text-align:center;' value='$fila[temp4_cduanam]' readonly/></td> </tr> </table> </td> </tr> </table> <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Examen físico</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtExamenFi' class='span10' readonly>$fila[examfi_cduanam]</textarea> </td> </tr> </table> <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1' class='span10' value='$fila[cie1_cduanam]' readonly/></td> <td><input type='text' id='txtCod1' style='width:100px;' value='$fila[codcie1_cduanam]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1' readonly/> </td> <td>" ; 
							if($fila['pre1_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre1' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre1' readonly></td>";
							}
							echo "<td>";
							if($fila['def1_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef1' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef1' readonly></td>";
							}
							echo "</tr> <tr> <td>2</td> <td><input type='text' id='txtCie2' class='span10' value='$fila[cie2_cduanam]' readonly/></td> <td><input type='text' id='txtCod2' style='width:100px;' value='$fila[codcie2_cduanam]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2' readonly/> </td> <td>"; 
							if($fila['pre2_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre2' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre2' readonly></td>";
							}
							echo "<td>";
							if($fila['def2_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef2' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef2' readonly></td>";
							}
							echo "</tr> <tr> <td>3</td> <td><input type='text' id='txtCie3' class='span10' value='$fila[cie3_cduanam]' readonly/></td> <td><input type='text' id='txtCod3' style='width:100px;' value='$fila[codcie3_cduanam]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3' readonly/> </td> <td>" ;
							if($fila['pre3_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre3' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre3' readonly></td>";
							}
							echo "<td>"; 
							if($fila['def3_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef3' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef3' readonly></td>";
							}
							echo "</tr> <tr> <td>4</td> <td><input type='text' id='txtCie4' class='span10' value='$fila[cie4_cduanam]' readonly/></td> <td><input type='text' id='txtCod4' style='width:100px;' value='$fila[codcie4_cduanam]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4' readonly/> </td> <td>";
							if($fila['pre4_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre4' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre4' readonly></td>";
							}
							echo "<td>";
							if($fila['def4_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef4' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef4' readonly></td>";
							}
							echo "</tr> <tr> <td>5</td> <td><input type='text' id='txtCie5' class='span10' value='$fila[cie5_cduanam]' readonly/></td> <td><input type='text' id='txtCod5' style='width:100px;' value='$fila[codcie5_cduanam]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5' readonly/> </td> <td>";
							if($fila['pre5_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtPre5' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtPre5' readonly></td>";
							}
							echo "<td>";
							if($fila['def5_cduanam']=="true")
							{
								echo "<input type='checkbox' id='txtDef5' checked='true' readonly></td>";
							}
							else
							{
								echo "<input type='checkbox' id='txtDef5' readonly></td>";
							}
							echo "</tr> </table> </td> </tr> </table> <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Planes de Diagnóstico, Terapeúticos y Educacionales </td> </tr> <tr> <td><textarea id='txtPlanesdte' cols='90' rows='4' class='span10' readonly>$fila[planesdte_cduanam]</textarea> <a href='#myModal' role='button'  data-toggle='modal' class='btn btn-success' onclick='datosvademecun()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table> <!-- PiePg --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Fecha para control: </td> <td><input type='text' id='txtFechaControl' style='width:100px; text-align:center;' value='$fila[fechcontr_cduanam]' readonly/></td> <td>Hora fin: </td> <td><input type='text' id='txtHoraFin' style='width:100px;  text-align:center;' value='$fila[horafin_cduanam]' readonly/></td> <td>Médico: </td> <td><input type='text' id='txtMedich' value='$nombremedico' style='text-align:center;' value='$fila[medico_cduanam]' readonly/></td> <td>Código: </td> <td><input type='text' id='txtCodM3' style='width:70px; text-align:center;' value='$fila[codmed_cduanam]' readonly/></td> <td>Firma: </td> <td><input type='text' id='txtFirma' style='width:70px; text-align:center;' readonly/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr><td><center><a href='#' class='btn btn-success' onclick='NewAnamnesisCdu()'><i class=' icon-plus'></i> Nuevo</a>&nbsp;  <a href='#' class='btn btn-primary' onclick='Expediente()'><i class=' icon-share-alt'></i> Subsecuente</a>&nbsp; <a href='#myModal' role='button'  data-toggle='modal' class='btn btn-info' onclick='PrintAnamnesisCdu()'><i class=' icon-print'></i> Imprimir</a>&nbsp;    <a href='#myModal' role='button'  data-toggle='modal' class='btn btn-info' onclick='PrintRECELih($fila[id_cduanam])'><i class=' icon-print'></i> Imprimir Receta</a>  </center></td> </tr> </table>";
							break;

							case "":
							$aux=new AnamnesisCdu;
							$nompac=$aux->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codigo'");
							$nompac=utf8_encode($nompac);
							$apepac=$aux->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$codigo'");
							$apepac=utf8_encode($apepac);
							$sexpac=$aux->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codigo'");
							$cedpac=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo'");

							echo "<!-- Cabecera --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td rowspan='2'><center>Establecimiento</center></td> <td rowspan='2'><center>Nombre</center></td> <td rowspan='2'><center>Apellido</center></td> <td colspan='2' rowspan='2'><center>Sexo</center></td> <td rowspan='2'><center>Número de <br />hoja</center></td> <td rowspan='2'><center>Historia <br />clínica</center></td> </tr> <tr> </tr> <tr> <td><input type='text' id='txtEstablecim' style='width:140px; text-align:center;' value='Clínica de Urología' readonly /></td> <td><input type='text' id='txtNompac' style='width:140px; text-align:center;' value='$nompac' readonly /></td> <td><input type='text' id='txtApepac' style='width:140px; text-align:center;' value='$apepac' readonly /></td> <td colspan='2'><input type='text' id='SexAnam' style='width:80px; text-align:center;' value='$sexpac' readonly /></td> <td><input type='text' id='txtNumHoja' style='width:100px; text-align:center;' readonly/></td> <td><input type='text' id='txtHisCl' style='width:100px; text-align:center;' value='$cedpac' readonly /></td> </tr> </table> <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>1. Motivo de consulta</td> </tr> <tr> <td><textarea id='txtMotivoCon' cols='40' rows='2' class='span10'></textarea></td> </tr> </table> <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Antecedentes personales</td> </tr> <tr> <td><textarea id='txtAntePer' cols='40' rows='2' class='span10' ></textarea></td> </tr> </table> <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Antecedentes familiares</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtAnteFam' class='span10' ></textarea> </td> </tr> </table> <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Enfermedad o problema actual</td> </tr> <tr> <td><textarea id='txtEnfermeAc' cols='40' rows='2' class='span10'></textarea></td> </tr> </table> <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Revisión actual de órganos y sistemas</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtRevisionOys' class='span10' ></textarea> </td> </tr> </table> <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Signos vitales</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td><center>Fecha: </center></td> <td><input type='text' id='txtFechAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Presión arterial: </center></td> <td><input type='text' id='txtPreArAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Pulso x min: </center></td> <td><input type='text' id='txtPulAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Temperatura °c: </center></td> <td><input type='text' id='txtTemcAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam4' style='width:140px; text-align:center;' /></td> </tr> </table> </td> </tr> </table> <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Examen físico</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtExamenFi' class='span10' ></textarea> </td> </tr> </table> <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1' class='span10' /> <a onclick='verDiagnostico(3)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1' onclick='DeleteCie1()'/> </td> <td><input type='checkbox' id='txtPre1'></td> <td><input type='checkbox' id='txtDef1'></td> </tr> <tr> <td>2</td> <td><input type='text' id='txtCie2' class='span10' /> <a onclick='verDiagnostico(4)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2' onclick='DeleteCie2()'/> </td> <td><input type='checkbox' id='txtPre2'></td> <td><input type='checkbox' id='txtDef2'></td> </tr> <tr> <td>3</td> <td><input type='text' id='txtCie3' class='span10'  /> <a onclick='verDiagnostico(5)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod3' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3' onclick='DeleteCie3()'/> </td> <td><input type='checkbox' id='txtPre3'></td> <td><input type='checkbox' id='txtDef3'></td> </tr> <tr> <td>4</td> <td><input type='text' id='txtCie4' class='span10'  /> <a onclick='verDiagnostico(6)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4' onclick='DeleteCie4()'/> </td> <td><input type='checkbox' id='txtPre4'></td> <td><input type='checkbox' id='txtDef4'></td> </tr> <tr> <td>5</td> <td><input type='text' id='txtCie5' class='span10'  /> <a onclick='verDiagnostico(7)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod5' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5' onclick='DeleteCie5()'/> </td> <td><input type='checkbox' id='txtPre5'></td> <td><input type='checkbox' id='txtDef5'></td> </tr> </table> </td> </tr> </table> <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Planes de Diagnóstico, Terapeúticos y Educacionales </td> </tr> <tr> <td><textarea id='txtPlanesdte'  cols='90' rows='4' class='span10'></textarea><a href='#myModal' role='button'  data-toggle='modal' class='btn btn-success' onclick='datosvademecun()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table> <!-- PiePg --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Fecha para control: </td> <td><input type='text' id='txtFechaControl' style='width:100px; text-align:center;'/></td> <td>Hora fin: </td> <td><input type='text' id='txtHoraFin' style='width:100px; text-align:center;'/></td> <td>Médico: </td> <td><input type='text' id='txtMedich' value='$nombremedico' style='text-align:center;'/></td> <td>Código: </td> <td><input type='text' id='txtCodM3' style='width:70px; text-align:center;'/></td> <td>Firma: </td> <td><input type='text' id='txtFirma' style='width:70px; text-align:center;' readonly/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr><td><center><!-- <input type='button' class='btn btn-success' id='bntNewAnamnesisCdu' value='Nuevo' onclick='NewAnamnesisCdu()' />&nbsp; --> <a href='#' class='btn btn-info' onclick='SaveAnanmesisCdu()'><i class=' icon-file'></i> Guardar</a> </center></td> </tr> </table> ";
							break;
						}
					}
				}
			}
//fin load all datos de anamnesis cdu 

//save expediente (subsecuente)
			public function SaveExpedienteCdu($FechaExpe,$HoraExpe,$EvolucionExpe,$PrescripcionExpe,$MedicamExpe,$IdPac)
			{
				$exp=new Expediente;

				$aux=$exp->Ejecutar("INSERT INTO tbl_expediente (fech_expe,hora_expe,evo_expe,prescr_expe,medicam_expe,est_expe,id_pac) VALUES ('$FechaExpe','$HoraExpe','$EvolucionExpe','$PrescripcionExpe','','A','$IdPac')");

				$datos=$exp->Consultar_Expediente("SELECT * FROM tbl_expediente WHERE id_pac='$IdPac' ORDER BY fech_expe DESC");
				/* echo "<table><tr><td><center><input type='button' class='btn btn-success' id='bntRegresaraExp' value='Regresar' onclick='Expediente()' /> <input type='button' class='btn btn-danger' id='bntSalirAnam' value='Salir' onclick='ExitAn()' /> </center></td> </tr> </table>"; */ 
				echo "<table cellpadding='7' cellspacing='0' id='MiTablaExpediente' class='table table-bordered table-striped table-hover table-condensed '>
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Hora</th>
						<th>Evolución</th>
						<th>Prescripciones</th>
						<th>Medicamentos</th>
						<th>Imprimir</th>
					</tr>
				</thead>
				<tbody>";
					foreach($datos as $fila)
					{
						echo "<tr> 
						<td>$fila[fech_expe]</td>
						<td>$fila[hora_expe]</td>
						<td>$fila[evo_expe]</td>
						<td>$fila[prescr_expe]</td>
						<td>$fila[medicam_expe]</td>
						<td>
							<a href='#myModal' onclick='ImprimirExp($fila[id_exp])' role='button' class='btn btn-success' data-toggle='modal'>Imprimir</a>

						</td>

					</tr>";
				}

				echo "
			</tbody>
		</table> ";

	}
//fin save expediente (subsecuente)

//fin asiganar cie
	
//funcion finalizar Anamnesis 
	public function FinalizarAnamCdu($idAnam)
	{
		$anam=new AnamnesisCdu;
		$anam->Ejecutar("UPDATE tbl_cduanamnesis SET est_cduanam='F' WHERE id_cduanam='$idAnam'");
		echo "Se ha finalizado correctamente";
	}
	
//fin funcion finalizar Anamnesis

//load all expediente
	public function LoadAllExpediente($cod)
	{
		$exp=new Expediente;
		$cda=new AnamnesisCdu;
		$datos=$exp->Consultar_Expediente("SELECT * FROM tbl_expediente WHERE est_expe='A' AND id_pac='$cod'  ORDER BY fech_expe DESC");
		echo "<table cellpadding='7' cellspacing='0' id='MiTablaExpediente' class='table table-bordered table-striped table-hover table-condensed '>
		<thead>
			<tr>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Evolución</th>
				<th>Prescripciones</th>
				<th>Medicamentos</th>
				<th>Imprimir</th>
			</tr>
		</thead>
		<tbody>";
			foreach($datos as $fila)
			{
				echo "<tr> 
				<td>$fila[fech_expe]</td>
				<td>$fila[hora_expe]</td>
				<td><div class='text'>$fila[evo_expe]</div></td>
				<td><div class='text'>$fila[prescr_expe]</div></td>
				<td>$fila[medicam_expe]</td>
				<td>
					<a href='#myModal' role='button' id='bntPrintExpediente' class='btn btn-success' data-toggle='modal' onclick='ImprimirExp($fila[id_exp])' >Imprimir</a>

				</td>

			</tr>";
			$aux=$cda->Consultar_AnamnesisCdu("SELECT  *  FROM tbl_cduanamnesis WHERE id_pac='19' AND est_cduanam='A' AND fechasa_cduanm='$fila[fech_expe]';");
			if(count($aux)){
				foreach ($aux as $fila1) {
					echo "
					<tr>
						<td>$fila1[fechasa_cduanm]</td>
						<td></td>
						<td><div class='text'></div></td>
						<td>
							<div class='text'> 
								DIAGNOSTICOS
								$fila1[cie1_cduanam]  $fila1[codcie1_cduanam]</br>
								$fila1[cie2_cduanam]  $fila1[codcie2_cduanam]</br>
								$fila1[cie3_cduanam]  $fila1[codcie3_cduanam]</br>
								$fila1[cie4_cduanam]  $fila1[codcie4_cduanam]</br>
								$fila1[cie5_cduanam]  $fila1[codcie5_cduanam]</br>
								PlANES
								$fila1[planesdte_cduanam]
							</div>
						</td>
						<td></td>
						<td><input type='button' id='bntPrintExpediente' class='btn btn-success' value='Imprimir' onclick='ImprimirExp1($fila1[id_cduanam])'/></td>
					</tr>
					";
				}
			}
		}

		echo "
	</tbody>
</table>";
}
//fin load all expediente

//nueva anamnesis
public function CreateNewAnamnesis($IdPaciente){
	$anam=new AnamnesisCdu;
	$res=$anam->Consultar("INSERT INTO tbl_cduanamnesis (id_pac) VALUES ('$IdPaciente');");
	echo "<center>Se realizo correctamente la nueva anamnesis</center>";	
}
//fin nueva anamnesis





	//inicio para buscador de pacientes version 2 
public function BuscarXPeticionPacinetev2($buscar,$codRol)
{
	$pac=new Paciente;
	$buscar=utf8_decode($buscar);
	$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE cedula_pac LIKE '$buscar%' AND estado_pac='A' OR nombresCom_pac LIKE '%$buscar%'  AND estado_pac='A' OR nombres_pac LIKE '%$buscar%' AND estado_pac='A' OR apellidos_pac LIKE '%$buscar%' AND estado_pac='A' OR pasaporte_pac LIKE '%$buscar%' AND estado_pac='A' LIMIT 60;");


	if(count($datos)>0)
	{
		echo "
		<div class='table-responsive'><table class='table table-striped table-bordered table-hover table-condensed'>
			<thead>
				<tr class='fila'>
					<td>Cédula</td>
					<td>Nombres Completos</td>
					<td>Edad</td>
					<td>Dirección</td>
					<td></td>
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
						<td>".utf8_encode($fila["nombresCom_pac"])."</td>";
						if($fila["fechaN_pac"]!=""){

							echo "<td>".$this->Edad($fila['fechaN_pac'])."</td>";
						}else{
							echo "<td></td>";
						}

						echo	"<td>$fila[direccion_pac]</td>
						<td>$fila[auxmovimiento_pac]</td>
						";
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
						<td>
							<a href='#myModal' role='button'  data-toggle='modal' onclick='AsignarPaciente($fila[id_pac]);'  class='btn btn-success'>Agendar</a>

							<!--	<input type='button' id='btnAsignar' class='btn btn-success' onclick='AsignarPaciente($fila[id_pac]);' value='Agendar'/>-->
						</td>
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
				<td>
					<a href='#myModal' role='button'  data-toggle='modal' id='btnAsignar' class='btn btn-success' onclick='AgendarPacienteXDoctor($fila[id_pac]);' > Agendar</a>
				</tr>
				";
			}	
			if($codRol==5)/*si el doctor quiere ver el historial del pacieten*/
			{
				echo "
				<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='HistorialPacienteNew($fila[id_pac]);' value='Ver historia'/></td>
			</tr>
			";
		}
		if($codRol==6)/*boton*/
		{
			echo "
			<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='HistorialPacienteNewEpicrisis($fila[id_pac]);' value='Epicrisis'/></td>
		</tr>
		";
	}								

	if($codRol==7)/*boton*/
	{
		echo "
		<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='FrmMkEmergenciaIni($fila[id_pac]);' value='Emergencia'/></td>
	</tr>
	";
}

if($codRol==20)/*buscardor para el medico cuando necesita subir un electrocardiograma*/
{
	echo "
	<td><input type='button' id='btnAsignar' class='btn btn-success' onclick='SubirElectrocardiograma($fila[id_pac],20);' value='Subir'/></td>
</tr>
";
}								

}
echo "
</tbody>
</table></div>

";				
}else{
	echo $this->Msm("r", "No se encontraron pacientes ");
}







}
	//fin del metoodo para cargar las busquedas del paciente

	// ---------------------- Mi codigo interconsulta ------------------------------//

//funcion guardar solicitud de interconsulta
public function SaveSolicitudInterconsulta($InstitSis,$UnidadOp,$CodeSol,$Parroq,$Cant,$Prov,$HistotiaCl,$Ape,$Nomb,$CedulaCiu,$FechaAt,$Hora,$Edad,$Genero,$EstCiv,$Instr,$EmpresaTrab,$SegSalud,$EstablDestino,$ServConsultado,$ServSolicita,$Sala,$Cama,$Norm,$Urge,$MedInter,$CuadroCl,$ResPruebas,$CieSo1,$CieSo2,$CieSo3,$CieSo4,$CieSo5,$CieSo6,$CodSo1,$CodSo2,$CodSo3,$CodSo4,$CodSo5,$CodSo6,$PreSo1,$PreSo2,$PreSo3,$PreSo4,$PreSo5,$PreSo6,$DefSo1,$DefSo2,$DefSo3,$DefSo4,$DefSo5,$DefSo6,$PlanTera,$PlanEd,$Service,$Medic,$CodMed,$idPac)
{
	$sol=new Solicitud;
	session_start();
	$med=$_SESSION['DOCTOR'];
	$id=$sol->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$med'");
	$res=$sol->Ejecutar("INSERT INTO tbl_solicitudinterconsulta (insti_intsoli,uniop_intsoli,cod_intsoli,parr_intsoli,cant_intsoli,prov_intsoli,hiscl_intsoli,ape_intsoli,nom_intsoli,cedc_intsoli,fechatn_intsoli,hora_intsoli,edad_intsoli,gen_intsoli,estciv_intsoli,instr_intsoli,emprtr_intsoli,segsa_intsoli,estades_intsoli,sercon_intsoli,serso_intsoli,sala_intsoli,cama_intsoli,norm_intsoli,urge_intsoli,medin_intsoli,cuadcl_intsoli,respru_intsoli,cie1_intsoli,cie2_intsoli,cie3_intsoli,cie4_intsoli,cie5_intsoli,cie6_intsoli,cod1_intsoli,cod2_intsoli,cod3_intsoli,cod4_intsoli,cod5_intsoli,cod6_intsoli,pre1_intsoli,pre2_intsoli,pre3_intsoli,pre4_intsoli,pre5_intsoli,pre6_intsoli,def1_intsoli,def2_intsoli,def3_intsoli,def4_intsoli,def5_intsoli,def6_intsoli,plante_intsoli,planed_intsoli,serv_intsoli,med_intsoli,codmed_intsoli,id_pac,est_intsoli,id_med) VALUES ('$InstitSis','$UnidadOp','$CodeSol','$Parroq','$Cant','$Prov','$HistotiaCl','$Ape','$Nomb','$CedulaCiu','$FechaAt','$Hora','$Edad','$Genero','$EstCiv','$Instr','$EmpresaTrab','$SegSalud','$EstablDestino','$ServConsultado','$ServSolicita','$Sala','$Cama','$Norm','$Urge','$MedInter','$CuadroCl','$ResPruebas','$CieSo1','$CieSo2','$CieSo3','$CieSo4','$CieSo5','$CieSo6','$CodSo1','$CodSo2','$CodSo3','$CodSo4','$CodSo5','$CodSo6','$PreSo1','$PreSo2','$PreSo3','$PreSo4','$PreSo5','$PreSo6','$DefSo1','$DefSo2','$DefSo3','$DefSo4','$DefSo5','$DefSo6','$PlanTera','$PlanEd','$Service','$Medic','$CodMed','$idPac','A','$id')");
	echo "Los datos se han guardado correctamente";
}
//fin funcion guardar solicitud de interconsulta

//mostrar datos en solicitud de interconsulta
public function LoadAllSolicitudInterco($Id)
{
	$solct=new Solicitud;
	session_start();
	$login=$_SESSION['DOCTOR'];
	$nombredoc=$solct->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$login'");
	
	$apellidos=$solct->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$Id'");
	$apellidos=utf8_encode($apellidos);         
	$nombres=$solct->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$Id'");
	$nombres=utf8_encode($nombres);         
	$ced=$solct->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$Id'");
	$fecha=$solct->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$Id'");
	if($fecha!="")
	{
		$edad=$this->Edad($fecha);
	}
	else
	{
		$edad="";
	}
	$genero=$solct->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$Id'");
	$estcivil=$solct->Consultar("SELECT estadociv_pac FROM tbl_paciente WHERE id_pac='$Id'");
	$instruccion=$solct->Consultar("SELECT instruccion_pac FROM tbl_paciente WHERE id_pac='$Id'");
	
	if($solct->Consultar("SELECT COUNT(*) FROM tbl_solicitudinterconsulta WHERE id_pac='$Id'")==0)
	{
		echo "<!-- 0 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td rowspan='2' style='text-align:center'>Institución del sistema</td> <td rowspan='2' style='text-align:center'>Unidad operativa</td> <td rowspan='2' style='text-align:center'>Código</td> <td colspan='3' style='text-align:center'>Localización</td> <td colspan='2' rowspan='2' style='text-align:center'>Historia clínica</td> </tr> <tr> <td style='text-align:center'>Parroquia</td> <td style='text-align:center'>Cantón</td> <td style='text-align:center'>Provincia</td> </tr> <tr> <td><center><input type='text' id='txtInstitucionSis' style='width:160px; text-align:center;' value='Clínica de Urología'/></center></td> <td><center><input type='text' id='txtUnidadOp' style='width:160px; text-align:center;' value='Clínica de Urología'/></center></td> <td><center><input type='text' id='txtCode' style='width:90px; text-align:center;'/></center></td> <td><center><input type='text' id='txtParroquia' style='width:120px; text-align:center;' value='Quito'/></center></td> <td><center><input type='text' id='txtCanton' style='width:120px; text-align:center;' value='Quito'/></center></td> <td><center><input type='text' id='txtProvincia' style='width:120px; text-align:center;' value='Pichincha'/></center></td> <td colspan='2'><center><input type='text' id='txtHistoriaCl' style='width:150px; text-align:center;'/></center></td> </tr> <tr> <td colspan='3' style='text-align:center'>Apellidos</td> <td colspan='3' style='text-align:center'>Nombres</td> <td colspan='2' style='text-align:center'>Cédula de ciudadanía</td> </tr> <tr> <td colspan='3'><center><input type='text' id='txtApedillos' class='span5' value='$apellidos'/></center></td> <td colspan='3'><center><input type='text' id='txtNombres' class='span5' value='$nombres'/></center></td> <td colspan='2'><center><input type='text' id='txtCedulaCi' style='width:150px; text-align:center;' value='$ced'/></center></td> </tr> <tr> <td style='text-align:center'>Fecha de atencion</td> <td style='text-align:center'>Hora</td> <td style='text-align:center'>Edad</td> <td style='text-align:center'>Género</td> <td style='text-align:center'>Estado Civil</td> <td style='text-align:center'>Instrucción</td> <td style='text-align:center'>Empresa donde trabaja</td> <td style='text-align:center'>Seguro de salud</td> </tr> <tr> <td><center><input type='text' id='txtFechaAt' style='width:120px; text-align:center;'/></center></td> <td><center><input type='text' id='txtHoraIn' style='width:120px; text-align:center;'/></center></td> <td><center><input type='text' id='txtEdadIn' style='width:120px; text-align:center;' value='$edad'/></center></td> <td><center><input type='text' id='txtGeneroIn' style='width:120px; text-align:center;' value='$genero'/></center></td> <td><center><input type='text' id='txtEstCi' style='width:120px; text-align:center;' value='$estcivil'/></center></td> <td><center><input type='text' id='txtInstruccionIn' style='width:120px; text-align:center;' value='$instruccion'/></center></td> <td><center><input type='text' id='txtEmpresaTr' style='width:120px; text-align:center;'/></center></td> <td><center><input type='text' id='txtSeguroSa' style='width:120px; text-align:center;'/></center></td> </tr> </table>    <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='10'>1. Motivo y destino de solicitud</td> </tr> <tr> <td style='text-align:center'>Establecimiento de destino: </td> <td><center><input type='text' id='txtEstablDe' style='width:120px;'/></center></td> <td style='text-align:center'>Servicio consultado: </td> <td><center><input type='text' id='txtServicioCo' style='width:120px;'/></center></td> <td style='text-align:center'>Servicio que solicita: </td> <td><center><input type='text' id='txtServicioSo' style='width:120px;'/></center></td> <td style='text-align:center'>Sala: </td> <td><center><input type='text' id='txtSalaIn' style='width:120px;'/></center></td> <td style='text-align:center'>Cama: </td> <td><center><input type='text' id='txtCamaIn' style='width:120px;'/></center></td> </tr> <tr> <td colspan='2'>Normal <input type='checkbox' id='chkNormal'></td> <td colspan='2'>Urgente <input type='checkbox' id='chkUrgente'></td> <td style='text-align:center'>Médico interconsultado: </td> <td colspan='5'><input type='text' id='txtMedicoInt' style='width:190px;'/></td> </tr> </table>  <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Cuadro clínico actual</td> </tr> <tr> <td><textarea id='txtCuadroClinicoAc' cols='90' rows='5' class='span10'></textarea></td> </tr> </table>  <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Resultado de las pruebas diagnósticas</td> </tr> <tr> <td><textarea id='txtResulPrDi' cols='90' rows='5' class='span10'></textarea></td> </tr> </table>  <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1In' class='span12'  /> <a href='#myModal' onclick='verDiagnostico(22)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1In' onclick='DeleteCie1In()'/> </td> <td><input type='checkbox' id='chkPre1In'></td> <td><input type='checkbox' id='chkDef1In'></td> </tr> <tr> <td>2</td> <td><input type='text' id='txtCie2In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(23)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2In' onclick='DeleteCie2In()'/> </td> <td><input type='checkbox' id='chkPre2In'></td> <td><input type='checkbox' id='chkDef2In'></td> </tr> <tr> <td>3</td> <td><input type='text' id='txtCie3In' class='span12'  /> <a href='#myModal' onclick='verDiagnostico(24)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod3In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3In' onclick='DeleteCie3In()'/> </td> <td><input type='checkbox' id='chkPre3In'></td> <td><input type='checkbox' id='chkDef3In'></td> </tr> <tr> <td>4</td> <td><input type='text' id='txtCie4In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(25)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4In' onclick='DeleteCie4In()'/> </td> <td><input type='checkbox' id='chkPre4In'></td> <td><input type='checkbox' id='chkDef4In'></td> </tr> <tr> <td>5</td> <td><input type='text' id='txtCie5In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(26)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod5In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5In' onclick='DeleteCie5In()'/> </td> <td><input type='checkbox' id='chkPre5In'></td> <td><input type='checkbox' id='chkDef5In'></td> </tr> <tr> <td>6</td> <td><input type='text' id='txtCie6In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(27)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod6In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie6In' onclick='DeleteCie6In()'/> </td> <td><input type='checkbox' id='chkPre6In'></td> <td><input type='checkbox' id='chkDef6In'></td> </tr> </table> </td> </tr> </table>  <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Plan terapeútico realizado</td> </tr> <tr> <td><textarea id='txtPlanTe' cols='90' rows='5' class='span10'></textarea>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-success' onclick='datosvademecun3()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table>  <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Plan educacional realizado</td> </tr> <tr> <td><textarea id='txtPlanEd' cols='90' rows='5' class='span10'></textarea></td> </tr> </table>  <!-- pie pagina 1 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Servicio: </td> <td><input type='text' id='txtServicio'/></td> <td>Médico: </td> <td><input type='text' id='txtMedicoIn' value='$nombredoc'/></td> <td>Firma: </td> <td><input type='text' id='txtFimaIn' style='width:140px;' readonly/></td> <td>Código</td> <td><input type='text' id='txtCodIn'/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td><center><!-- <input id='bntNuevaSolicitud' onclick='NewSolucitud()' class='btn btn-success' type='button' value='Nuevo' />&nbsp; --><a href='#' class='btn btn-primary' onclick='SaveSolucitud()'><i class=' icon-file'></i> Guardar</a>&nbsp;<!-- &nbsp;<input id='bntFinalizarSolicitud' onclick='EndSolucitud()' class='btn btn-danger' type='button' value='Finalizar' /> --></center></td> </tr> </table>";
	}
	else
	{
		$codsolic=$solct->Consultar("SELECT MAX(id_intsoli) FROM tbl_solicitudinterconsulta WHERE id_pac='$Id'");
		$datos=$solct->Consultar_Solicitud("SELECT * FROM tbl_solicitudinterconsulta WHERE id_intsoli='$codsolic'");

		$apellidos=$solct->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$Id'");
		$apellidos=utf8_encode($apellidos);          
		$nombres=$solct->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$Id'");
		$nombres=utf8_encode($nombres);          
		$ced=$solct->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$Id'");
		$fecha=$solct->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$Id'");
		if($fecha!="")
		{
			$edad=$this->Edad($fecha);
		}
		else
		{
			$edad="";
		}
		$genero=$solct->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$Id'");
		$estcivil=$solct->Consultar("SELECT estadociv_pac FROM tbl_paciente WHERE id_pac='$Id'");
		$instruccion=$solct->Consultar("SELECT instruccion_pac FROM tbl_paciente WHERE id_pac='$Id'");

		foreach($datos as $fila)
		{
			switch($fila['est_intsoli'])
			{
				case "A":
				echo "<!-- 0 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td rowspan='2' style='text-align:center'>Institución del sistema</td> <td rowspan='2' style='text-align:center'>Unidad operativa</td> <td rowspan='2' style='text-align:center'>Código</td> <td colspan='3' style='text-align:center'>Localización</td> <td colspan='2' rowspan='2' style='text-align:center'>Historia clínica</td> </tr> <tr> <td style='text-align:center'>Parroquia</td> <td style='text-align:center'>Cantón</td> <td style='text-align:center'>Provincia</td> </tr> <tr> <td><center><input type='text' id='txtInstitucionSis' style='width:160px; text-align:center;' value='$fila[insti_intsoli]'/></center></td> <td><center><input type='text' id='txtUnidadOp' style='width:160px; text-align:center;' value='$fila[uniop_intsoli]'/></center></td> <td><center><input type='text' id='txtCode' style='width:90px; text-align:center;' value='$fila[cod_intsoli]'/></center></td> <td><center><input type='text' id='txtParroquia' style='width:120px; text-align:center;' value='$fila[parr_intsoli]'/></center></td> <td><center><input type='text' id='txtCanton' style='width:120px; text-align:center;' value='$fila[cant_intsoli]'/></center></td> <td><center><input type='text' id='txtProvincia' style='width:120px; text-align:center;' value='$fila[prov_intsoli]'/></center></td> <td colspan='2'><center><input type='text' id='txtHistoriaCl' style='width:150px; text-align:center;' value='$fila[hiscl_intsoli]'/></center></td> </tr> <tr> <td colspan='3' style='text-align:center'>Apellidos</td> <td colspan='3' style='text-align:center'>Nombres</td> <td colspan='2' style='text-align:center'>Cédula de ciudadanía</td> </tr> <tr> <td colspan='3'><center><input type='text' id='txtApedillos' class='span5' value='$apellidos'/></center></td> <td colspan='3'><center><input type='text' id='txtNombres' class='span5' value='$nombres'/></center></td> <td colspan='2'><center><input type='text' id='txtCedulaCi' style='width:150px; text-align:center;' value='$ced'/></center></td> </tr> <tr> <td style='text-align:center'>Fecha de atencion</td> <td style='text-align:center'>Hora</td> <td style='text-align:center'>Edad</td> <td style='text-align:center'>Género</td> <td style='text-align:center'>Estado Civil</td> <td style='text-align:center'>Instrucción</td> <td style='text-align:center'>Empresa donde trabaja</td> <td style='text-align:center'>Seguro de salud</td> </tr> <tr> <td><center><input type='text' id='txtFechaAt' style='width:120px; text-align:center;' value='$fila[fechatn_intsoli]'/></center></td> <td><center><input type='text' id='txtHoraIn' style='width:120px; text-align:center;' value='$fila[hora_intsoli]'/></center></td> <td><center><input type='text' id='txtEdadIn' style='width:120px; text-align:center;' value='$edad'/></center></td> <td><center><input type='text' id='txtGeneroIn' style='width:120px; text-align:center;' value='$genero'/></center></td> <td><center><input type='text' id='txtEstCi' style='width:120px; text-align:center;' value='$estcivil'/></center></td> <td><center><input type='text' id='txtInstruccionIn' style='width:120px; text-align:center;' value='$instruccion'/></center></td> <td><center><input type='text' id='txtEmpresaTr' style='width:120px; text-align:center;' value='$fila[emprtr_intsoli]'/></center></td> <td><center><input type='text' id='txtSeguroSa' style='width:120px; text-align:center;' value='$fila[segsa_intsoli]'/></center></td> </tr> </table>    <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='10'>1. Motivo y destino de solicitud</td> </tr> <tr> <td style='text-align:center'>Establecimiento de destino: </td> <td><center><input type='text' id='txtEstablDe' style='width:120px;' value='$fila[estades_intsoli]'/></center></td> <td style='text-align:center'>Servicio consultado: </td> <td><center><input type='text' id='txtServicioCo' style='width:120px;' value='$fila[sercon_intsoli]'/></center></td> <td style='text-align:center'>Servicio que solicita: </td> <td><center><input type='text' id='txtServicioSo' style='width:120px;' value='$fila[serso_intsoli]'/></center></td> <td style='text-align:center'>Sala: </td> <td><center><input type='text' id='txtSalaIn' style='width:120px;' value='$fila[sala_intsoli]'/></center></td> <td style='text-align:center'>Cama: </td> <td><center><input type='text' id='txtCamaIn' style='width:120px;' value='$fila[cama_intsoli]'/></center></td> </tr> <tr> <td colspan='2'>Normal ";
				if($fila['norm_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkNormal' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkNormal'></td>";
				}
				echo "<td colspan='2'>Urgente ";
				if($fila['urge_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkUrgente' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkUrgente' ></td>";
				}
				echo "<td style='text-align:center'>Médico interconsultado: </td> <td colspan='5'><input type='text' id='txtMedicoInt' style='width:190px;' value='$fila[medin_intsoli]'/></td> </tr> </table>  <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Cuadro clínico actual</td> </tr> <tr> <td><textarea id='txtCuadroClinicoAc' cols='90' rows='5' class='span10'>$fila[cuadcl_intsoli]</textarea></td> </tr> </table>  <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Resultado de las pruebas diagnósticas</td> </tr> <tr> <td><textarea id='txtResulPrDi' cols='90' rows='5' class='span10'>$fila[respru_intsoli]</textarea></td> </tr> </table>  <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1In' class='span12' value='$fila[cie1_intsoli]'/> <a href='#myModal' onclick='verDiagnostico(22)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1In' style='width:100px;' value='$fila[cod1_intsoli]'/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1In' onclick='DeleteCie1In()'/> </td> <td> ";
				if($fila['pre1_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre1In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre1In'></td>";
				}
				echo "<td> ";
				if($fila['def1_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef1In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef1In'></td>";
				}
				echo "</tr> <tr> <td>2</td> <td><input type='text' id='txtCie2In' class='span12' value='$fila[cie2_intsoli]'/> <a href='#myModal' onclick='verDiagnostico(23)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2In' style='width:100px;' value='$fila[cod2_intsoli]'/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2In' onclick='DeleteCie2In()'/> </td> <td> ";
				if($fila['pre2_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre2In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre2In'></td>";
				}
				echo "<td> ";
				if($fila['def2_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef2In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef2In'></td>";
				}
				echo "</tr> <tr> <td>3</td> <td><input type='text' id='txtCie3In' class='span12' value='$fila[cie3_intsoli]'/> <a href='#myModal' onclick='verDiagnostico(24)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod3In' style='width:100px;' value='$fila[cod3_intsoli]'/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3In' onclick='DeleteCie3In()'/> </td> <td> ";
				if($fila['pre3_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre3In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre3In'></td>";
				}
				echo "<td> ";
				if($fila['def3_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef3In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef3In'></td>";
				}
				echo "</tr> <tr> <td>4</td> <td><input type='text' id='txtCie4In' class='span12'  value='$fila[cie4_intsoli]'/> <a href='#myModal' onclick='verDiagnostico(25)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4In' style='width:100px;' value='$fila[cod4_intsoli]'/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4In' onclick='DeleteCie4In()'/> </td> <td> ";
				if($fila['pre4_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre4In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre4In'></td>";
				}
				echo "<td> ";
				if($fila['def4_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef4In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef4In'></td>";
				}
				echo "</tr> <tr> <td>5</td> <td><input type='text' id='txtCie5In' class='span12' value='$fila[cie5_intsoli]'/> <a href='#myModal' onclick='verDiagnostico(26)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod5In' style='width:100px;' value='$fila[cod5_intsoli]'/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5In' onclick='DeleteCie5In()'/> </td> <td> ";
				if($fila['pre5_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre5In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre5In'></td>";
				}
				echo "<td> ";
				if($fila['def5_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef5In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef5In'></td>";
				}
				echo "</tr> <tr> <td>6</td> <td><input type='text' id='txtCie6In' class='span12' value='$fila[cie6_intsoli]'/> <a href='#myModal' onclick='verDiagnostico(27)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod6In' style='width:100px;' value='$fila[cod6_intsoli]'/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie6In' onclick='DeleteCie6In()'/> </td> <td> ";
				if($fila['pre6_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre6In' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre6In'></td>";
				}
				echo "<td> ";
				if($fila['def6_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef6In' checked='true'></td> ";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef6In'></td> ";
				}
				echo "</tr> </table> </td> </tr> </table>  <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Plan terapeútico realizado</td> </tr> <tr> <td><textarea id='txtPlanTe' cols='90' rows='5' class='span10'>$fila[plante_intsoli]</textarea>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-success' onclick='datosvademecun3()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table>  <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Plan educacional realizado</td> </tr> <tr> <td><textarea id='txtPlanEd' cols='90' rows='5' class='span10'>$fila[planed_intsoli]</textarea></td> </tr> </table>  <!-- pie pagina 1 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Servicio: </td> <td><input type='text' id='txtServicio' value='$fila[serv_intsoli]'/></td> <td>Médico: </td> <td><input type='text' id='txtMedicoIn' value='$nombredoc'/></td> <td>Firma: </td> <td><input type='text' id='txtFimaIn' style='width:140px;' readonly/></td> <td>Código</td> <td><input type='text' id='txtCodIn' value='$fila[codmed_intsoli]'/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td><center><!-- <input id='bntNuevaSolicitud' onclick='NewSolucitud()' class='btn btn-success' type='button' value='Nuevo' />&nbsp; --><a href='#' class='btn btn-primary' onclick='SaveSolucitud()'><i class=' icon-file'></i> Guardar</a>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintSolucitud()'><i class=' icon-print'></i> Imprimir</a>&nbsp<a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintReceSoli($fila[id_intsoli])'><i class=' icon-print'></i> Imprimir Receta</a>&nbsp;<a href='#' class='btn btn-danger' onclick='EndSolucitud($fila[id_intsoli])'><i class=' icon-stop'></i> Finalizar</a></center></td> </tr> </table>";
				break;

				case "F":
				echo "<!-- 0 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td rowspan='2' style='text-align:center'>Institución del sistema</td> <td rowspan='2' style='text-align:center'>Unidad operativa</td> <td rowspan='2' style='text-align:center'>Código</td> <td colspan='3' style='text-align:center'>Localización</td> <td colspan='2' rowspan='2' style='text-align:center'>Historia clínica</td> </tr> <tr> <td style='text-align:center'>Parroquia</td> <td style='text-align:center'>Cantón</td> <td style='text-align:center'>Provincia</td> </tr> <tr> <td><center><input type='text' id='txtInstitucionSis' style='width:160px; text-align:center;' value='$fila[insti_intsoli]' readonly/></center></td> <td><center><input type='text' id='txtUnidadOp' style='width:160px; text-align:center;' value='$fila[uniop_intsoli]' readonly/></center></td> <td><center><input type='text' id='txtCode' style='width:90px; text-align:center;' value='$fila[cod_intsoli]' readonly/></center></td> <td><center><input type='text' id='txtParroquia' style='width:120px; text-align:center;' value='$fila[parr_intsoli]' readonly/></center></td> <td><center><input type='text' id='txtCanton' style='width:120px; text-align:center;' value='$fila[cant_intsoli]' readonly/></center></td> <td><center><input type='text' id='txtProvincia' style='width:120px; text-align:center;' value='$fila[prov_intsoli]' readonly/></center></td> <td colspan='2'><center><input type='text' id='txtHistoriaCl' style='width:150px; text-align:center;' value='$fila[hiscl_intsoli]' readonly/></center></td> </tr> <tr> <td colspan='3' style='text-align:center'>Apellidos</td> <td colspan='3' style='text-align:center'>Nombres</td> <td colspan='2' style='text-align:center'>Cédula de ciudadanía</td> </tr> <tr> <td colspan='3'><center><input type='text' id='txtApedillos' class='span5' value='$apellidos' readonly/></center></td> <td colspan='3'><center><input type='text' id='txtNombres' class='span5' value='$nombres' readonly/></center></td> <td colspan='2'><center><input type='text' id='txtCedulaCi' style='width:150px; text-align:center;' value='$ced' readonly/></center></td> </tr> <tr> <td style='text-align:center'>Fecha de atencion</td> <td style='text-align:center'>Hora</td> <td style='text-align:center'>Edad</td> <td style='text-align:center'>Género</td> <td style='text-align:center'>Estado Civil</td> <td style='text-align:center'>Instrucción</td> <td style='text-align:center'>Empresa donde trabaja</td> <td style='text-align:center'>Seguro de salud</td> </tr> <tr> <td><center><input type='text' id='txtFechaAt' style='width:120px; text-align:center;' value='$fila[fechatn_intsoli]' readonly/></center></td> <td><center><input type='text' id='txtHoraIn' style='width:120px; text-align:center;' value='$fila[hora_intsoli]' readonly/></center></td> <td><center><input type='text' id='txtEdadIn' style='width:120px; text-align:center;' value='$edad' readonly/></center></td> <td><center><input type='text' id='txtGeneroIn' style='width:120px; text-align:center;' value='$genero' readonly/></center></td> <td><center><input type='text' id='txtEstCi' style='width:120px; text-align:center;' value='$estcivil' readonly/></center></td> <td><center><input type='text' id='txtInstruccionIn' style='width:120px; text-align:center;' value='$instruccion' readonly/></center></td> <td><center><input type='text' id='txtEmpresaTr' style='width:120px; text-align:center;' value='$fila[emprtr_intsoli]' readonly/></center></td> <td><center><input type='text' id='txtSeguroSa' style='width:120px; text-align:center;' value='$fila[segsa_intsoli]' readonly/></center></td> </tr> </table>    <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='10'>1. Motivo y destino de solicitud</td> </tr> <tr> <td style='text-align:center'>Establecimiento de destino: </td> <td><center><input type='text' id='txtEstablDe' style='width:120px;' value='$fila[estades_intsoli]' readonly/></center></td> <td style='text-align:center'>Servicio consultado: </td> <td><center><input type='text' id='txtServicioCo' style='width:120px;' value='$fila[sercon_intsoli]' readonly/></center></td> <td style='text-align:center'>Servicio que solicita: </td> <td><center><input type='text' id='txtServicioSo' style='width:120px;' value='$fila[serso_intsoli]' readonly/></center></td> <td style='text-align:center'>Sala: </td> <td><center><input type='text' id='txtSalaIn' style='width:120px;' value='$fila[sala_intsoli]' readonly/></center></td> <td style='text-align:center'>Cama: </td> <td><center><input type='text' id='txtCamaIn' style='width:120px;' value='$fila[cama_intsoli]' readonly/></center></td> </tr> <tr> <td colspan='2'>Normal ";
				if($fila['norm_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkNormal' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkNormal' readonly></td>";
				}
				echo "<td colspan='2'>Urgente ";
				if($fila['urge_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkUrgente' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkUrgente' readonly></td>";
				}
				echo "<td style='text-align:center'>Médico interconsultado: </td> <td colspan='5'><input type='text' id='txtMedicoInt' style='width:190px;' value='$fila[medin_intsoli]' readonly/></td> </tr> </table>  <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Cuadro clínico actual</td> </tr> <tr> <td><textarea id='txtCuadroClinicoAc' cols='90' rows='5' class='span10' readonly>$fila[cuadcl_intsoli]</textarea></td> </tr> </table>  <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Resultado de las pruebas diagnósticas</td> </tr> <tr> <td><textarea id='txtResulPrDi' cols='90' rows='5' class='span10' readonly>$fila[respru_intsoli]</textarea></td> </tr> </table>  <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1In' class='span12' value='$fila[cie1_intsoli]' readonly/></td> <td><input type='text' id='txtCod1In' style='width:100px;' value='$fila[cod1_intsoli]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1In'/> </td> <td> ";
				if($fila['pre1_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre1In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre1In' readonly></td>";
				}
				echo "<td> ";
				if($fila['def1_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef1In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef1In' readonly></td>";
				}
				echo "</tr> <tr> <td>2</td> <td><input type='text' id='txtCie2In' class='span12' value='$fila[cie2_intsoli]' readonly/></td> <td><input type='text' id='txtCod2In' style='width:100px;' value='$fila[cod2_intsoli]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2In'/> </td> <td> ";
				if($fila['pre2_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre2In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre2In' readonly></td>";
				}
				echo "<td> ";
				if($fila['def2_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef2In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef2In' readonly></td>";
				}
				echo "</tr> <tr> <td>3</td> <td><input type='text' id='txtCie3In' class='span12' value='$fila[cie3_intsoli]' readonly/></td> <td><input type='text' id='txtCod3In' style='width:100px;' value='$fila[cod3_intsoli]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3In'/> </td> <td> ";
				if($fila['pre3_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre3In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre3In' readonly></td>";
				}
				echo "<td> ";
				if($fila['def3_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef3In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef3In' readonly></td>";
				}
				echo "</tr> <tr> <td>4</td> <td><input type='text' id='txtCie4In' class='span12' value='$fila[cie4_intsoli]' readonly/></td> <td><input type='text' id='txtCod4In' style='width:100px;' value='$fila[cod4_intsoli]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4In'/> </td> <td> ";
				if($fila['pre4_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre4In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre4In' readonly></td>";
				}
				echo "<td> ";
				if($fila['def4_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef4In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef4In' readonly></td>";
				}
				echo "</tr> <tr> <td>5</td> <td><input type='text' id='txtCie5In' class='span12' value='$fila[cie5_intsoli]' readonly/></td> <td><input type='text' id='txtCod5In' style='width:100px;' value='$fila[cod5_intsoli]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5In'/> </td> <td> ";
				if($fila['pre5_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre5In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre5In' readonly></td>";
				}
				echo "<td> ";
				if($fila['def5_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef5In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef5In' readonly></td>";
				}
				echo "</tr> <tr> <td>6</td> <td><input type='text' id='txtCie6In' class='span12' value='$fila[cie6_intsoli]' readonly/></td> <td><input type='text' id='txtCod6In' style='width:100px;' value='$fila[cod6_intsoli]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie6In'/> </td> <td> ";
				if($fila['pre6_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkPre6In' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre6In' readonly></td>";
				}
				echo "<td> ";
				if($fila['def6_intsoli']=="true")
				{
					echo "<input type='checkbox' id='chkDef6In' checked='true' readonly></td> ";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef6In' readonly></td> ";
				}
				echo "</tr> </table> </td> </tr> </table>  <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Plan terapeútico realizado</td> </tr> <tr> <td><textarea id='txtPlanTe' cols='90' rows='5' class='span10' readonly>$fila[plante_intsoli]</textarea>&nbsp;<a class='btn btn-success' onclick='' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table>  <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Plan educacional realizado</td> </tr> <tr> <td><textarea id='txtPlanEd' cols='90' rows='5' class='span10' readonly>$fila[planed_intsoli]</textarea></td> </tr> </table>  <!-- pie pagina 1 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Servicio: </td> <td><input type='text' id='txtServicio' value='$fila[serv_intsoli]' readonly/></td> <td>Médico: </td> <td><input type='text' id='txtMedicoIn' value='$nombredoc' readonly/></td> <td>Firma: </td> <td><input type='text' id='txtFimaIn' style='width:140px;' readonly/></td> <td>Código</td> <td><input type='text' id='txtCodIn' value='$fila[codmed_intsoli]' readonly/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td><center><a href='#' class='btn btn-success' onclick='NewSolucitud()'><i class=' icon-plus'></i> Nuevo</a><!-- &nbsp;<a href='#' class='btn btn-primary' onclick='SaveSolucitud()'><i class=' icon-file'></i> Guardar</a> -->&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintSolucitud()'><i class=' icon-print'></i> Imprimir</a>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintReceSoli($fila[id_intsoli])'><i class=' icon-print'></i> Imprimir Receta</a><!-- &nbsp;<a href='#' class='btn btn-danger' onclick='EndSolucitud()'><i class=' icon-stop'></i> Finalizar</a> --></center></td> </tr> </table>";
				break;

				case "":
				echo "<!-- 0 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td rowspan='2' style='text-align:center'>Institución del sistema</td> <td rowspan='2' style='text-align:center'>Unidad operativa</td> <td rowspan='2' style='text-align:center'>Código</td> <td colspan='3' style='text-align:center'>Localización</td> <td colspan='2' rowspan='2' style='text-align:center'>Historia clínica</td> </tr> <tr> <td style='text-align:center'>Parroquia</td> <td style='text-align:center'>Cantón</td> <td style='text-align:center'>Provincia</td> </tr> <tr> <td><center><input type='text' id='txtInstitucionSis' style='width:160px; text-align:center;' value='Clínica de Urología'/></center></td> <td><center><input type='text' id='txtUnidadOp' style='width:160px; text-align:center;' value='Clínica de Urología'/></center></td> <td><center><input type='text' id='txtCode' style='width:90px; text-align:center;'/></center></td> <td><center><input type='text' id='txtParroquia' style='width:120px; text-align:center;' value='Quito'/></center></td> <td><center><input type='text' id='txtCanton' style='width:120px; text-align:center;' value='Quito'/></center></td> <td><center><input type='text' id='txtProvincia' style='width:120px; text-align:center;' value='Pichincha'/></center></td> <td colspan='2'><center><input type='text' id='txtHistoriaCl' style='width:150px; text-align:center;'/></center></td> </tr> <tr> <td colspan='3' style='text-align:center'>Apellidos</td> <td colspan='3' style='text-align:center'>Nombres</td> <td colspan='2' style='text-align:center'>Cédula de ciudadanía</td> </tr> <tr> <td colspan='3'><center><input type='text' id='txtApedillos' class='span5' value='$apellidos'/></center></td> <td colspan='3'><center><input type='text' id='txtNombres' class='span5' value='$nombres'/></center></td> <td colspan='2'><center><input type='text' id='txtCedulaCi' style='width:150px; text-align:center;' value='$ced'/></center></td> </tr> <tr> <td style='text-align:center'>Fecha de atencion</td> <td style='text-align:center'>Hora</td> <td style='text-align:center'>Edad</td> <td style='text-align:center'>Género</td> <td style='text-align:center'>Estado Civil</td> <td style='text-align:center'>Instrucción</td> <td style='text-align:center'>Empresa donde trabaja</td> <td style='text-align:center'>Seguro de salud</td> </tr> <tr> <td><center><input type='text' id='txtFechaAt' style='width:120px; text-align:center;'/></center></td> <td><center><input type='text' id='txtHoraIn' style='width:120px; text-align:center;'/></center></td> <td><center><input type='text' id='txtEdadIn' style='width:120px; text-align:center;' value='$edad'/></center></td> <td><center><input type='text' id='txtGeneroIn' style='width:120px; text-align:center;' value='$genero'/></center></td> <td><center><input type='text' id='txtEstCi' style='width:120px; text-align:center;' value='$estcivil'/></center></td> <td><center><input type='text' id='txtInstruccionIn' style='width:120px; text-align:center;' value='$instruccion'/></center></td> <td><center><input type='text' id='txtEmpresaTr' style='width:120px; text-align:center;'/></center></td> <td><center><input type='text' id='txtSeguroSa' style='width:120px; text-align:center;'/></center></td> </tr> </table>    <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='10'>1. Motivo y destino de solicitud</td> </tr> <tr> <td style='text-align:center'>Establecimiento de destino: </td> <td><center><input type='text' id='txtEstablDe' style='width:120px;'/></center></td> <td style='text-align:center'>Servicio consultado: </td> <td><center><input type='text' id='txtServicioCo' style='width:120px;'/></center></td> <td style='text-align:center'>Servicio que solicita: </td> <td><center><input type='text' id='txtServicioSo' style='width:120px;'/></center></td> <td style='text-align:center'>Sala: </td> <td><center><input type='text' id='txtSalaIn' style='width:120px;'/></center></td> <td style='text-align:center'>Cama: </td> <td><center><input type='text' id='txtCamaIn' style='width:120px;'/></center></td> </tr> <tr> <td colspan='2'>Normal <input type='checkbox' id='chkNormal'></td> <td colspan='2'>Urgente <input type='checkbox' id='chkUrgente'></td> <td style='text-align:center'>Médico interconsultado: </td> <td colspan='5'><input type='text' id='txtMedicoInt' style='width:190px;'/></td> </tr> </table>  <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Cuadro clínico actual</td> </tr> <tr> <td><textarea id='txtCuadroClinicoAc' cols='90' rows='5' class='span10'></textarea></td> </tr> </table>  <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Resultado de las pruebas diagnósticas</td> </tr> <tr> <td><textarea id='txtResulPrDi' cols='90' rows='5' class='span10'></textarea></td> </tr> </table>  <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(22)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1In' onclick='DeleteCie1In()'/> </td> <td><input type='checkbox' id='chkPre1In'></td> <td><input type='checkbox' id='chkDef1In'></td> </tr> <tr> <td>2</td> <td><input type='text' id='txtCie2In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(23)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2In' onclick='DeleteCie2In()'/> </td> <td><input type='checkbox' id='chkPre2In'></td> <td><input type='checkbox' id='chkDef2In'></td> </tr> <tr> <td>3</td> <td><input type='text' id='txtCie3In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(24)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod3In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3In' onclick='DeleteCie3In()'/> </td> <td><input type='checkbox' id='chkPre3In'></td> <td><input type='checkbox' id='chkDef3In'></td> </tr> <tr> <td>4</td> <td><input type='text' id='txtCie4In' class='span12' /><a href='#myModal' onclick='verDiagnostico(25)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4In' onclick='DeleteCie4In()'/> </td> <td><input type='checkbox' id='chkPre4In'></td> <td><input type='checkbox' id='chkDef4In'></td> </tr> <tr> <td>5</td> <td><input type='text' id='txtCie5In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(26)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod5In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5In' onclick='DeleteCie5In()'/> </td> <td><input type='checkbox' id='chkPre5In'></td> <td><input type='checkbox' id='chkDef5In'></td> </tr> <tr> <td>6</td> <td><input type='text' id='txtCie6In' class='span12' /> <a href='#myModal' onclick='verDiagnostico(27)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod6In' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie6In' onclick='DeleteCie6In()'/> </td> <td><input type='checkbox' id='chkPre6In'></td> <td><input type='checkbox' id='chkDef6In'></td> </tr> </table> </td> </tr> </table>  <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Plan terapeútico realizado</td> </tr> <tr> <td><textarea id='txtPlanTe' cols='90' rows='5' class='span10'></textarea>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-success' onclick='datosvademecun3()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table>  <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Plan educacional realizado</td> </tr> <tr> <td><textarea id='txtPlanEd' cols='90' rows='5' class='span10'></textarea></td> </tr> </table>  <!-- pie pagina 1 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Servicio: </td> <td><input type='text' id='txtServicio'/></td> <td>Médico: </td> <td><input type='text' id='txtMedicoIn' value='$nombredoc'/></td> <td>Firma: </td> <td><input type='text' id='txtFimaIn' style='width:140px;' readonly/></td> <td>Código</td> <td><input type='text' id='txtCodIn'/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td><center><!-- <input id='bntNuevaSolicitud' onclick='NewSolucitud()' class='btn btn-success' type='button' value='Nuevo' />&nbsp; --><a href='#' class='btn btn-primary' onclick='SaveSolucitud()'><i class=' icon-file'></i> Guardar</a>&nbsp;<!-- &nbsp;<input id='bntFinalizarSolicitud' onclick='EndSolucitud()' class='btn btn-danger' type='button' value='Finalizar' /> --></center></td> </tr> </table>";
				break;
			}
		}
	}
	
	
}
//fin mostrar datos en solicitud de interconsulta

//finalizar solicitud interconsulta
public function FinalizarSolicInterconsulta($idsolic,$medicsolicitud)
{
	$slctd=new Solicitud;
	$slctd->Ejecutar("UPDATE tbl_solicitudinterconsulta SET est_intsoli='F', med_intsoli='$medicsolicitud' WHERE id_intsoli='$idsolic'");
	echo $this->Msm("v","Se finalizo correctamente!");
}
//fin finalizar solicitud interconsulta

//nueva solicitud interconsulta
public function NuevaSolicitudInterc($idPac)
{
	$slctd=new Solicitud;
	$res=$slctd->Consultar("INSERT INTO tbl_solicitudinterconsulta (id_pac) VALUES ('$idPac');");
	echo $this->Msm("a", "Se realizo correctamente una nueva solicitud para interconsulta");
}
//fin nueva solicitud interconsulta

//save informe interconsulta
public function SaveInformeInterconsulta($InstitucionInf,$UnidadOpInf,$CodigoInf,$ParroInf,$CantonInf,$ProvInf,$HistoClinicaInf,$CuadroCliInf,$PruebasDiagnInf,$Diagn1,$Diagn2,$Diagn3,$Diagn4,$Diagn5,$Diagn6,$CodCie1,$CodCie2,$CodCie3,$CodCie4,$CodCie5,$CodCie6,$PreInf1,$PreInf2,$PreInf3,$PreInf4,$PreInf5,$PreInf6,$DefInf1,$DefInf2,$DefInf3,$DefInf4,$DefInf5,$DefInf6,$PlanTeraInf,$PlanEdInf,$ResumenInf,$ServicioInf,$MedicoInf,$CodigoMedInf,$idpac)
{
	$info=new Informe;
	session_start();
	$med=$_SESSION['DOCTOR'];
	$id=$info->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$med';");
	$save=$info->Ejecutar("INSERT INTO tbl_informeinterconsulta (instisis_intinfo,uniope_intinfo,code_intinfo,parroq_intinfo,canton_intinfo,prov_intinfo,histcl_intinfo,cuadcl_intinfo,pruebdi_intinfo,dign1_intinfo,dign2_intinfo,dign3_intinfo,dign4_intinfo,dign5_intinfo,dign6_intinfo,cod1_intinfo,cod2_intinfo,cod3_intinfo,cod4_intinfo,cod5_intinfo,cod6_intinfo,pre1_intinfo,pre2_intinfo,pre3_intinfo,pre4_intinfo,pre5_intinfo,pre6_intinfo,def1_intinfo,def2_intinfo,def3_intinfo,def4_intinfo,def5_intinfo,def6_intinfo,plantep_intinfo,planedp_intinfo,resumcri_intinfo,serv_intinfo,medico_intinfo,codeme_intinfo,id_pac,est_intinfo,id_med) VALUES ('$InstitucionInf','$UnidadOpInf','$CodigoInf','$ParroInf','$CantonInf','$ProvInf','$HistoClinicaInf','$CuadroCliInf','$PruebasDiagnInf','$Diagn1','$Diagn2','$Diagn3','$Diagn4','$Diagn5','$Diagn6','$CodCie1','$CodCie2','$CodCie3','$CodCie4','$CodCie5','$CodCie6','$PreInf1','$PreInf2','$PreInf3','$PreInf4','$PreInf5','$PreInf6','$DefInf1','$DefInf2','$DefInf3','$DefInf4','$DefInf5','$DefInf6','$PlanTeraInf','$PlanEdInf','$ResumenInf','$ServicioInf','$MedicoInf','$CodigoMedInf','$idpac','A','$id')");
	echo "<center>Los datos se han guardado correctamente</center>";
}
//fin save informe interconsulta

//mostrar datos de informe interconsulta
public function LoadAllDatosInformeInterco($id)
{
	$info=new Informe;
	session_start();
	$login=$_SESSION['DOCTOR'];
	$nombremed=$info->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$login'");
	if($info->Consultar("SELECT COUNT(*) FROM tbl_informeinterconsulta WHERE id_pac='$id'")==0)
	{
		echo "<!-- 0 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td rowspan='2'><center>Institución del Sistema</center></td> <td rowspan='2'><center>Unidad operativa</center></td> <td rowspan='2'><center>Código</center></td> <td colspan='3'><center>Localización</center></td> <td rowspan='2'><center>Historia Clínica</center></td> </tr> <tr> <td><center>Parroquia</center></td> <td><center>Canton</center></td> <td><center>Provincia</center></td> </tr> <tr> <td><center><input type='text' id='InstitucionSisInfo' style='text-align:center; width:150px;' value='Clínica de Urología'/></center></td> <td><center><input type='text' id='UniOperativaInfo' style='text-align:center; width:150px;' value='Clínica de Urología'/></center></td> <td><center><input type='text' id='CodeInfo' style='text-align:center; width:120px;' /></center></td> <td><center><input type='text' id='ParroquiaInfo' style='text-align:center; width:120px;' value='Quito'/></center></td> <td><center><input type='text' id='CantonInfo' style='text-align:center; width:120px;' value='Quito'/></center></td> <td><center><input type='text' id='ProvinciaInfo' style='text-align:center; width:120px;' value='Pichincha'/></center></td> <td><center><input type='text' id='HistoriaClInfo' style='text-align:center; width:150px;' /></center></td> </tr> </table>  <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Cuadro clínico de interconsulta</td> </tr> <tr> <td><textarea id='CuadroClInInfo' cols='90' rows='5' class='span11'></textarea></td> </tr> </table>  <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Pruebas diagnósticas propuestas</td> </tr> <tr> <td><textarea id='PruebasDiProInfo' cols='90' rows='5' class='span11'></textarea></td> </tr> </table>  <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(16)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1Info' onclick='DeleteCie1Info()'/> </td> <td><input type='checkbox' id='chkPre1Info'></td> <td><input type='checkbox' id='chkDef1Info'></td> </tr> <tr> <td>2</td> <td><input type='text' id='txtCie2Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(17)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2Info' onclick='DeleteCie2Info()'/> </td> <td><input type='checkbox' id='chkPre2Info'></td> <td><input type='checkbox' id='chkDef2Info'></td> </tr> <tr> <td>3</td> <td><input type='text' id='txtCie3Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(18)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod3Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3Info' onclick='DeleteCie3Info()'/> </td> <td><input type='checkbox' id='chkPre3Info'></td> <td><input type='checkbox' id='chkDef3Info'></td> </tr> <tr> <td>4</td> <td><input type='text' id='txtCie4Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(19)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4Info' onclick='DeleteCie4Info()'/> </td> <td><input type='checkbox' id='chkPre4Info'></td> <td><input type='checkbox' id='chkDef4Info'></td> </tr> <tr> <td>5</td> <td><input type='text' id='txtCie5Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(20)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod5Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5Info' onclick='DeleteCie5Info()'/> </td> <td><input type='checkbox' id='chkPre5Info'></td> <td><input type='checkbox' id='chkDef5Info'></td> </tr> <tr> <td>6</td> <td><input type='text' id='txtCie6Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(21)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod6Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie6Info' onclick='DeleteCie6Info()'/> </td> <td><input type='checkbox' id='chkPre6Info'></td> <td><input type='checkbox' id='chkDef6Info'></td> </tr> </table> </td> </tr> </table>  <!-- 11 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>11. Plan terapeútico propuesto</td> </tr> <tr> <td><textarea id='PlanTeProInfo' cols='90' rows='5' class='span11'></textarea>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-success' onclick='datosvademecun4()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table>  <!-- 12 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>12. Plan educacional propuesto</td> </tr> <tr> <td><textarea id='PlanEdProInfo' cols='90' rows='5' class='span11'></textarea></td> </tr> </table>  <!-- 13 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>13. Resumen del criterio clínico</td> </tr> <tr> <td><textarea id='ResumenInfo' cols='90' rows='5' class='span11'></textarea></td> </tr> </table>  <!-- pie pagina 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Servicio: </td> <td><input type='text' id='txtServicioInfo'/></td> <td>Médico: </td> <td><input type='text' id='txtMedicoInfo' value='$nombremed'/></td> <td>Firma: </td> <td><input type='text' id='txtFimaInfo' style='width:140px;' readonly/></td> <td>Código</td> <td><input type='text' id='txtCodInfo' /></td> </tr> </table>  <table class='table table-bordered table-striped table-hover table-condensed ' ><tr><td><center><!-- <a href='#' class='btn btn-success' onclick='NewInforme()'><i class=' icon-plus'></i> Nuevo</a> --><a href='#' class='btn btn-primary' onclick='SaveInforme()'><i class=' icon-file'></i> Guardar</a>&nbsp;<!-- <a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintInforme()'><i class=' icon-print'></i> Imprimir</a> --><!-- <a href='#' class='btn btn-danger' onclick='EndInforme()'><i class=' icon-stop'></i> Finalizar</a> --></center></td></tr></table>";
	}
	else
	{
		$codeinfo=$info->Consultar("SELECT MAX(id_intinfo) FROM tbl_informeinterconsulta WHERE id_pac='$id'");
		$datos=$info->Consultar_Informe("SELECT * FROM tbl_informeinterconsulta WHERE id_intinfo='$codeinfo'");
		
		foreach($datos as $fila)
		{
			switch($fila['est_intinfo'])
			{
				case "A":
				echo "<!-- 0 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td rowspan='2'><center>Institución del Sistema</center></td> <td rowspan='2'><center>Unidad operativa</center></td> <td rowspan='2'><center>Código</center></td> <td colspan='3'><center>Localización</center></td> <td rowspan='2'><center>Historia Clínica</center></td> </tr> <tr> <td><center>Parroquia</center></td> <td><center>Canton</center></td> <td><center>Provincia</center></td> </tr> <tr> <td><center><input type='text' id='InstitucionSisInfo' style='text-align:center; width:150px;' value='$fila[instisis_intinfo]' /></center></td> <td><center><input type='text' id='UniOperativaInfo' style='text-align:center; width:150px;' value='$fila[uniope_intinfo]' /></center></td> <td><center><input type='text' id='CodeInfo' style='text-align:center; width:120px;' value='$fila[code_intinfo]' /></center></td> <td><center><input type='text' id='ParroquiaInfo' style='text-align:center; width:120px;' value='$fila[parroq_intinfo]' /></center></td> <td><center><input type='text' id='CantonInfo' style='text-align:center; width:120px;' value='$fila[canton_intinfo]' /></center></td> <td><center><input type='text' id='ProvinciaInfo' style='text-align:center; width:120px;' value='$fila[prov_intinfo]' /></center></td> <td><center><input type='text' id='HistoriaClInfo' style='text-align:center; width:150px;' value='$fila[histcl_intinfo]' /></center></td> </tr> </table>  <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Cuadro clínico de interconsulta</td> </tr> <tr> <td><textarea id='CuadroClInInfo' cols='90' rows='5' class='span11'>$fila[cuadcl_intinfo]</textarea></td> </tr> </table>  <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Pruebas diagnósticas propuestas</td> </tr> <tr> <td><textarea id='PruebasDiProInfo' cols='90' rows='5' class='span11'>$fila[pruebdi_intinfo]</textarea></td> </tr> </table>  <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1Info' class='span10' value='$fila[dign1_intinfo]' /> <a href='#myModal' onclick='verDiagnostico(16)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1Info' style='width:100px;' value='$fila[cod1_intinfo]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1Info' onclick='DeleteCie1Info()'/> </td> <td> ";
				if($fila['pre1_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre1Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre1Info'></td>";
				}
				echo "<td> ";
				if($fila['def1_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef1Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef1Info'></td>";
				}
				echo "</tr> <tr> <td>2</td> <td><input type='text' id='txtCie2Info' class='span10'  value='$fila[dign2_intinfo]' /> <a href='#myModal' onclick='verDiagnostico(17)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2Info' style='width:100px;' value='$fila[cod2_intinfo]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2Info' onclick='DeleteCie2Info()'/> </td> <td> ";
				if($fila['pre2_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre2Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre2Info'></td>";
				}
				echo"<td> ";
				if($fila['def2_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef2Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef2Info'></td>";
				}
				echo "</tr> <tr> <td>3</td> <td><input type='text' id='txtCie3Info' class='span10' value='$fila[dign3_intinfo]' /><a href='#myModal' onclick='verDiagnostico(18)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a> </td> <td><input type='text' id='txtCod3Info' style='width:100px;' value='$fila[cod3_intinfo]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3Info' onclick='DeleteCie3Info()'/> </td> <td> ";
				if($fila['pre3_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre3Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre3Info'></td>";
				}
				echo "<td> ";
				if($fila['def3_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef3Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef3Info'></td>";
				}
				echo "</tr> <tr> <td>4</td> <td><input type='text' id='txtCie4Info' class='span10' value='$fila[dign4_intinfo]' /> <a href='#myModal' onclick='verDiagnostico(19)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4Info' style='width:100px;' value='$fila[cod4_intinfo]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4Info' onclick='DeleteCie4Info()'/> </td> <td> ";
				if($fila['pre4_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre4Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre4Info'></td>";
				}
				echo "<td> ";
				if($fila['def4_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef4Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef4Info'></td>";
				}
				echo "</tr> <tr> <td>5</td> <td><input type='text' id='txtCie5Info' class='span10' value='$fila[dign5_intinfo]' /> <a href='#myModal' onclick='verDiagnostico(20)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a> </td> <td><input type='text' id='txtCod5Info' style='width:100px;' value='$fila[cod5_intinfo]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5Info' onclick='DeleteCie5Info()'/> </td> <td> ";
				if($fila['pre5_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre5Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre5Info'></td>";
				}
				echo "<td> ";
				if($fila['def5_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef5Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef5Info'></td>";
				}
				echo "</tr> <tr> <td>6</td> <td><input type='text' id='txtCie6Info' class='span10' value='$fila[dign6_intinfo]' /> <a href='#myModal' onclick='verDiagnostico(21)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod6Info' style='width:100px;' value='$fila[cod6_intinfo]' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie6Info' onclick='DeleteCie6Info()'/> </td> <td> ";
				if($fila['pre6_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre6Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre6Info'></td>";
				}
				echo "<td> ";
				if($fila['def6_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef6Info' checked='true'></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef6Info'></td>";
				}
				echo "</tr> </table> </td> </tr> </table>  <!-- 11 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>11. Plan terapeútico propuesto</td> </tr> <tr> <td><textarea id='PlanTeProInfo' cols='90' rows='5' class='span11'>$fila[plantep_intinfo]</textarea>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-success' onclick='datosvademecun4()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table>  <!-- 12 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>12. Plan educacional propuesto</td> </tr> <tr> <td><textarea id='PlanEdProInfo' cols='90' rows='5' class='span11'>$fila[planedp_intinfo]</textarea></td> </tr> </table>  <!-- 13 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>13. Resumen del criterio clínico</td> </tr> <tr> <td><textarea id='ResumenInfo' cols='90' rows='5' class='span11'>$fila[resumcri_intinfo]</textarea></td> </tr> </table>  <!-- pie pagina 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Servicio: </td> <td><input type='text' id='txtServicioInfo' value='$fila[serv_intinfo]' /></td> <td>Médico: </td> <td><input type='text' id='txtMedicoInfo' value='$nombremed' /></td> <td>Firma: </td> <td><input type='text' id='txtFimaInfo' style='width:140px;' readonly/></td> <td>Código</td> <td><input type='text' id='txtCodInfo' value='$fila[codeme_intinfo]' /></td> </tr> </table>  <table class='table table-bordered table-striped table-hover table-condensed ' ><tr><td><center><!-- <a href='#' class='btn btn-success' onclick='NewInforme()'><i class=' icon-plus'></i> Nuevo</a> --><a href='#' class='btn btn-primary' onclick='SaveInforme()'><i class=' icon-file'></i> Guardar</a>&nbsp;<a href='#myModal' role='button' data-toggle='modal'  class='btn btn-info' onclick='PrintInforme()'><i class=' icon-print'></i> Imprimir</a>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintReceInfo($fila[id_intinfo])'><i class=' icon-print'></i> Imprimir Receta</a>&nbsp;<a href='#' class='btn btn-danger' onclick='EndInforme($fila[id_intinfo])'><i class=' icon-stop'></i> Finalizar</a></center></td></tr></table>";
				break;
				
				case "F":
				echo "<!-- 0 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td rowspan='2'><center>Institución del Sistema</center></td> <td rowspan='2'><center>Unidad operativa</center></td> <td rowspan='2'><center>Código</center></td> <td colspan='3'><center>Localización</center></td> <td rowspan='2'><center>Historia Clínica</center></td> </tr> <tr> <td><center>Parroquia</center></td> <td><center>Canton</center></td> <td><center>Provincia</center></td> </tr> <tr> <td><center><input type='text' id='InstitucionSisInfo' style='text-align:center; width:150px;' value='$fila[instisis_intinfo]' readonly/></center></td> <td><center><input type='text' id='UniOperativaInfo' style='text-align:center; width:150px;' value='$fila[uniope_intinfo]' readonly/></center></td> <td><center><input type='text' id='CodeInfo' style='text-align:center; width:120px;' value='$fila[code_intinfo]' readonly/></center></td> <td><center><input type='text' id='ParroquiaInfo' style='text-align:center; width:120px;' value='$fila[parroq_intinfo]' readonly/></center></td> <td><center><input type='text' id='CantonInfo' style='text-align:center; width:120px;' value='$fila[canton_intinfo]' readonly/></center></td> <td><center><input type='text' id='ProvinciaInfo' style='text-align:center; width:120px;' value='$fila[prov_intinfo]' readonly/></center></td> <td><center><input type='text' id='HistoriaClInfo' style='text-align:center; width:150px;' value='$fila[histcl_intinfo]' readonly/></center></td> </tr> </table>  <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Cuadro clínico de interconsulta</td> </tr> <tr> <td><textarea id='CuadroClInInfo' cols='90' rows='5' class='span11' readonly>$fila[cuadcl_intinfo]</textarea></td> </tr> </table>  <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Pruebas diagnósticas propuestas</td> </tr> <tr> <td><textarea id='PruebasDiProInfo' cols='90' rows='5' class='span11' readonly>$fila[pruebdi_intinfo]</textarea></td> </tr> </table>  <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1Info' class='span10' value='$fila[dign1_intinfo]' readonly/></td> <td><input type='text' id='txtCod1Info' style='width:100px;' value='$fila[cod1_intinfo]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1Info' onclick='DeleteCie1Info()'/> </td> <td> ";
				if($fila['pre1_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre1Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre1Info' readonly></td>";
				}
				echo "<td> ";
				if($fila['def1_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef1Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef1Info' readonly></td>";
				}
				echo "</tr> <tr> <td>2</td> <td><input type='text' id='txtCie2Info' class='span10' value='$fila[dign2_intinfo]' readonly/></td> <td><input type='text' id='txtCod2Info' style='width:100px;' value='$fila[cod2_intinfo]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2Info' onclick='DeleteCie2Info()'/> </td> <td> ";
				if($fila['pre2_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre2Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre2Info' readonly></td>";
				}
				echo"<td> ";
				if($fila['def2_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef2Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef2Info' readonly></td>";
				}
				echo "</tr> <tr> <td>3</td> <td><input type='text' id='txtCie3Info' class='span10' value='$fila[dign3_intinfo]' readonly/></td> <td><input type='text' id='txtCod3Info' style='width:100px;' value='$fila[cod3_intinfo]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3Info' onclick='DeleteCie3Info()'/> </td> <td> ";
				if($fila['pre3_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre3Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre3Info' readonly></td>";
				}
				echo "<td> ";
				if($fila['def3_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef3Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef3Info' readonly></td>";
				}
				echo "</tr> <tr> <td>4</td> <td><input type='text' id='txtCie4Info' class='span10' value='$fila[dign4_intinfo]' readonly/></td> <td><input type='text' id='txtCod4Info' style='width:100px;' value='$fila[cod4_intinfo]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4Info' onclick='DeleteCie4Info()'/> </td> <td> ";
				if($fila['pre4_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre4Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre4Info' readonly></td>";
				}
				echo "<td> ";
				if($fila['def4_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef4Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef4Info' readonly></td>";
				}
				echo "</tr> <tr> <td>5</td> <td><input type='text' id='txtCie5Info' class='span10' value='$fila[dign5_intinfo]' readonly/></td> <td><input type='text' id='txtCod5Info' style='width:100px;' value='$fila[cod5_intinfo]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5Info' onclick='DeleteCie5Info()'/> </td> <td> ";
				if($fila['pre5_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre5Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre5Info' readonly></td>";
				}
				echo "<td> ";
				if($fila['def5_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef5Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef5Info' readonly></td>";
				}
				echo "</tr> <tr> <td>6</td> <td><input type='text' id='txtCie6Info' class='span10' value='$fila[dign6_intinfo]' readonly/></td> <td><input type='text' id='txtCod6Info' style='width:100px;' value='$fila[cod6_intinfo]' readonly/></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie6Info' onclick='DeleteCie6Info()'/> </td> <td> ";
				if($fila['pre6_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkPre6Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkPre6Info' readonly></td>";
				}
				echo "<td> ";
				if($fila['def6_intinfo']=="true")
				{
					echo "<input type='checkbox' id='chkDef6Info' checked='true' readonly></td>";
				}
				else
				{
					echo "<input type='checkbox' id='chkDef6Info' readonly></td>";
				}
				echo "</tr> </table> </td> </tr> </table>  <!-- 11 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>11. Plan terapeútico propuesto</td> </tr> <tr> <td><textarea id='PlanTeProInfo' cols='90' rows='5' class='span11' readonly>$fila[plantep_intinfo]</textarea>&nbsp;<a class='btn btn-success' onclick='' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table>  <!-- 12 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>12. Plan educacional propuesto</td> </tr> <tr> <td><textarea id='PlanEdProInfo' cols='90' rows='5' class='span11' readonly>$fila[planedp_intinfo]</textarea></td> </tr> </table>  <!-- 13 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>13. Resumen del criterio clínico</td> </tr> <tr> <td><textarea id='ResumenInfo' cols='90' rows='5' class='span11' readonly>$fila[resumcri_intinfo]</textarea></td> </tr> </table>  <!-- pie pagina 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Servicio: </td> <td><input type='text' id='txtServicioInfo' value='$fila[serv_intinfo]' readonly/></td> <td>Médico: </td> <td><input type='text' id='txtMedicoInfo' value='$nombremed' readonly/></td> <td>Firma: </td> <td><input type='text' id='txtFimaInfo' style='width:140px;' readonly/></td> <td>Código</td> <td><input type='text' id='txtCodInfo' value='$fila[codeme_intinfo]' readonly/></td> </tr> </table>  <table class='table table-bordered table-striped table-hover table-condensed ' ><tr><td><center><a href='#' class='btn btn-success' onclick='NewInforme()'><i class=' icon-plus'></i> Nuevo</a><!-- <a href='#' class='btn btn-primary' onclick='SaveInforme()'><i class=' icon-file'></i> Guardar</a> -->&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintInforme()'><i class=' icon-print'></i> Imprimir</a>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintReceInfo($fila[id_intinfo])'><i class=' icon-print'></i> Imprimir Receta</a><!-- <a href='#' class='btn btn-danger' onclick='EndInforme($fila[id_intinfo])'><i class=' icon-stop'></i> Finalizar</a> --></center></td></tr></table>";
				break;
				
				case "":
				echo "<!-- 0 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td rowspan='2'><center>Institución del Sistema</center></td> <td rowspan='2'><center>Unidad operativa</center></td> <td rowspan='2'><center>Código</center></td> <td colspan='3'><center>Localización</center></td> <td rowspan='2'><center>Historia Clínica</center></td> </tr> <tr> <td><center>Parroquia</center></td> <td><center>Canton</center></td> <td><center>Provincia</center></td> </tr> <tr> <td><center><input type='text' id='InstitucionSisInfo' style='text-align:center; width:150px;' value='Clínica de Urología'/></center></td> <td><center><input type='text' id='UniOperativaInfo' style='text-align:center; width:150px;' value='Clínica de Urología'/></center></td> <td><center><input type='text' id='CodeInfo' style='text-align:center; width:120px;' /></center></td> <td><center><input type='text' id='ParroquiaInfo' style='text-align:center; width:120px;' value='Quito'/></center></td> <td><center><input type='text' id='CantonInfo' style='text-align:center; width:120px;' value='Quito'/></center></td> <td><center><input type='text' id='ProvinciaInfo' style='text-align:center; width:120px;' value='Pichincha'/></center></td> <td><center><input type='text' id='HistoriaClInfo' style='text-align:center; width:150px;' /></center></td> </tr> </table>  <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Cuadro clínico de interconsulta</td> </tr> <tr> <td><textarea id='CuadroClInInfo' cols='90' rows='5' class='span11'></textarea></td> </tr> </table>  <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Pruebas diagnósticas propuestas</td> </tr> <tr> <td><textarea id='PruebasDiProInfo' cols='90' rows='5' class='span11'></textarea></td> </tr> </table>  <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Opción</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(16)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod1Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie1Info' onclick='DeleteCie1Info()'/> </td> <td><input type='checkbox' id='chkPre1Info'></td> <td><input type='checkbox' id='chkDef1Info'></td> </tr> <tr> <td>2</td> <td><input type='text' id='txtCie2Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(17)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod2Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie2Info' onclick='DeleteCie2Info()'/> </td> <td><input type='checkbox' id='chkPre2Info'></td> <td><input type='checkbox' id='chkDef2Info'></td> </tr> <tr> <td>3</td> <td><input type='text' id='txtCie3Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(18)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod3Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie3Info' onclick='DeleteCie3Info()'/> </td> <td><input type='checkbox' id='chkPre3Info'></td> <td><input type='checkbox' id='chkDef3Info'></td> </tr> <tr> <td>4</td> <td><input type='text' id='txtCie4Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(19)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod4Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie4Info' onclick='DeleteCie4Info()'/> </td> <td><input type='checkbox' id='chkPre4Info'></td> <td><input type='checkbox' id='chkDef4Info'></td> </tr> <tr> <td>5</td> <td><input type='text' id='txtCie5Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(20)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod5Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie5Info' onclick='DeleteCie5Info()'/> </td> <td><input type='checkbox' id='chkPre5Info'></td> <td><input type='checkbox' id='chkDef5Info'></td> </tr> <tr> <td>6</td> <td><input type='text' id='txtCie6Info' class='span10' /> <a href='#myModal' onclick='verDiagnostico(21)' role='button' class='btn' data-toggle='modal'><i class='icon-plus'></i></a></td> <td><input type='text' id='txtCod6Info' style='width:100px;' /></td> <td><input type='button' value='Borrar' class='btn btn-success' id='bntBorrrCie6Info' onclick='DeleteCie6Info()'/> </td> <td><input type='checkbox' id='chkPre6Info'></td> <td><input type='checkbox' id='chkDef6Info'></td> </tr> </table> </td> </tr> </table>  <!-- 11 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>11. Plan terapeútico propuesto</td> </tr> <tr> <td><textarea id='PlanTeProInfo' cols='90' rows='5' class='span11'></textarea>&nbsp;<a href='#myModal' role='button' data-toggle='modal' class='btn btn-success' onclick='datosvademecun4()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> </table>  <!-- 12 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>12. Plan educacional propuesto</td> </tr> <tr> <td><textarea id='PlanEdProInfo' cols='90' rows='5' class='span11'></textarea></td> </tr> </table>  <!-- 13 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>13. Resumen del criterio clínico</td> </tr> <tr> <td><textarea id='ResumenInfo' cols='90' rows='5' class='span11'></textarea></td> </tr> </table>  <!-- pie pagina 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>Servicio: </td> <td><input type='text' id='txtServicioInfo'/></td> <td>Médico: </td> <td><input type='text' id='txtMedicoInfo' value='$nombremed'/></td> <td>Firma: </td> <td><input type='text' id='txtFimaInfo' style='width:140px;' readonly/></td> <td>Código</td> <td><input type='text' id='txtCodInfo' /></td> </tr> </table>  <table class='table table-bordered table-striped table-hover table-condensed ' ><tr><td><center><!-- <a href='#' class='btn btn-success' onclick='NewInforme()'><i class=' icon-plus'></i> Nuevo</a> --><a href='#' class='btn btn-primary' onclick='SaveInforme()'><i class=' icon-file'></i> Guardar</a>&nbsp;<!-- <a href='#myModal' role='button' data-toggle='modal' class='btn btn-info' onclick='PrintInforme()'><i class=' icon-print'></i> Imprimir</a> --><!-- <a href='#' class='btn btn-danger' onclick='EndInforme()'><i class=' icon-stop'></i> Finalizar</a> --></center></td></tr></table>";
				break;
			}
		}
	}
}
//fin mostrar datos de informe interconsulta

//finalizar informe interconsulta
public function FinalizarInformeInterco($idinfo,$medicoinfo)
{
	$info=new Informe;
	$info->Ejecutar("UPDATE tbl_informeinterconsulta SET est_intinfo='F', medico_intinfo='$medicoinfo' WHERE id_intinfo='$idinfo'");
	echo $this->Msm("a","Se ha finalizado el informe de interconsulta");
}
//fin finalizar informe interconsulta

//nuevo informe interconsulta
public function NewInformeInterco($idPac)
{
	$info=new Informe;
	$res=$info->Consultar("INSERT INTO tbl_informeinterconsulta (id_pac) VALUES ($idPac)");
	echo $this->Msm("a", "Se realizo correctamente un nuevo informe de interconsulta");
}
//fin nuevo informe interconsulta

// --------------------- Medicamentos --------------------- //

//Epicrisis
public function VademecunDoc22()
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
						<td>

							<a  data-dismiss='modal' aria-hidden='true' class='btn btn-success' id='bntVademecun' onclick='CodigoVademecum22($fila[id_far])'> Asignar</a>
							

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
	
	//funcion para capturar codigo y descripcion vademecum
	public function codvademecun2($codigo)
	{
		$va=new Farmacos;
		//$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',id_far) FROM tbl_farmacos WHERE id_far='$codigo'");
		$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',' ') FROM tbl_farmacos WHERE id_far='$codigo'");
		echo  $dato;
	}
	//fin de la funcion codigo y descripcion vedemecum
	
	//Solicitud interconsulta
	public function VademecunDoc3()
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
							<td>
								<a class='btn btn-success' data-dismiss='modal' aria-hidden='true' id='bntVademecun' onclick='CodigoVademecum3($fila[id_far])'> Asignar</a></td>

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

	//funcion para capturar codigo y descripcion vademecum
		public function codvademecun3($codigo)
		{
			$va=new Farmacos;
		//$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',id_far) FROM tbl_farmacos WHERE id_far='$codigo'");
			$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',' ') FROM tbl_farmacos WHERE id_far='$codigo'");
			echo  $dato;
		}
	//fin de la funcion codigo y descripcion vedemecum

	//Informe interconsulta
		public function VademecunDoc4()
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
								<td>
									<a data-dismiss='modal' aria-hidden='true' class='btn btn-success' data-toggle='modal' id='bntVademecun' onclick='CodigoVademecum4($fila[id_far])' >Asignar</a>

								</td>

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

	//funcion para capturar codigo y descripcion vademecum
		public function codvademecun4($codigo)
		{
			$va=new Farmacos;
		//$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',id_far) FROM tbl_farmacos WHERE id_far='$codigo'");
			$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',' ') FROM tbl_farmacos WHERE id_far='$codigo'");
			echo  $dato;
		}
	//fin de la funcion codigo y descripcion vedemecum

	//Subsecuente
		public function VademecunDoc5()
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
								<td><a class='btn  btn-success' id='bntVademecun' onclick='CodigoVademecum5($fila[id_far])' data-dismiss='modal' aria-hidden='true'> Asignar</a> </td>

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

	//funcion para capturar codigo y descripcion vademecum
		public function codvademecun5($codigo)
		{
			$va=new Farmacos;
		//$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',id_far) FROM tbl_farmacos WHERE id_far='$codigo'");
			$dato=$va->Consultar("SELECT CONCAT(descripcion_far,' , ',' ') FROM tbl_farmacos WHERE id_far='$codigo'");
			echo  $dato;
		}
	//fin de la funcion codigo y descripcion vedemecum

	//Fin medicamentos

		public function DataEnfermera()
		{
			$aux=new Usuario;
			session_start();
			$user=$_SESSION['ENFERMERA'];
			$dataUser=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$user'");
			$id=$aux->Consultar("SELECT id_esp FROM tbl_usuario WHERE login_usu='$user';");
			$esp=$aux->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$id';");
			echo "Bienvenid@: ".$dataUser."  ;Especialidad:  $esp";
		}



		//FUNCIONES DE LISTA HOSPITALIZACION * Author : Lesnier Gonzalez

			

        //FUNCION PARA MOSTRAR TABLA DE ANAMNESIS DE HOSPITALIZACIÓN VACIA PARA UNA ANAMNESIS NUEVA
		public function LoadAnamnesisHospitali($codigo, $nueva)
		{
            $param_modificar = "modificar"; 
            $param_insertar = "insertar"; 
          
			$aux= new AnamnesisCdu;
			session_start();
			$log=$_SESSION['DOCTOR'];
			$nombremedico=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$log';");

			$nombremedico=$aux->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$log';");	
			$nompac=$aux->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codigo'");
			$nompac=utf8_encode($nompac);
			$apepac=$aux->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$codigo'");
			$apepac=utf8_encode($apepac);
			$sexpac=$aux->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codigo'");
			$cedpac=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo'");
			$fecnacpac=$aux->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo'");
			$edad=$this->Edad($fecnacpac);             

             //Otorgando valor verdadero o falso a la nueva variable $crearnuevo

			$crearnuevo = '';
            if($aux->Consultar("SELECT COUNT(*) FROM tbl_anamnesis_hosp WHERE id_pac='$codigo'")==0 && $nueva == 'true')
            	{$crearnuevo = 'true';}
            if($aux->Consultar("SELECT COUNT(*) FROM tbl_anamnesis_hosp WHERE id_pac='$codigo'")>0 && $nueva == 'false')
            	{$crearnuevo = 'true'; }         

            if($aux->Consultar("SELECT COUNT(*) FROM tbl_anamnesis_hosp WHERE id_pac='$codigo'")>0 && $nueva == 'true')
            	{$crearnuevo = 'false';}


			if( $crearnuevo == 'true' ){

					echo "			
		<table width='100%' border='1' class='table table-bordered table-striped table-hover table-condensed '>
		  <tr>
		    <td  colspan='20' scope='col' class='active'><center>
		        <strong>LITOTRIFAST CLINICA DE UROLOGIA</strong>
		      </center></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='4' class='active'><strong>NOMBRES</strong></td>
		    <td colspan='4' class='active'><strong>APELLIDOS</strong></td>
		    <td colspan='3' class='active'><strong>EDAD</strong></td>
		    <td colspan='3' class='active'><strong>SEXO</strong></td>
		    <td colspan='3' class='active'><strong>No. HOJA</strong></td>
		    <td colspan='3' class='active'><strong>HCL</strong></td>
		  </tr>
		  <tr>
		    <td colspan='4'><input type='text' style='border-width:0px; width:93%' value='$nompac' /></td>
		    <td colspan='4'><input type='text' style='border-width:0px; width:93%' value='$apepac' /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$edad'  /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$sexpac'  /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='' /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$cedpac' id='CduPac'  /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>1. MOTIVO DE LA CONSULTA</strong></td>
		  </tr>
		  <tr>
		    <td class='active'><strong>A</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='' id='MotivoConsA'  /></td>
		    <td class='active'><strong>C</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='' id='MotivoConsC'   /></td>
		  </tr>
		  <tr>
		    <td class='active'><strong>B</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='' id='MotivoConsB'   /></td>
		    <td class='active'><strong>D</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='' id='MotivoConsD'    /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>2. ANTECEDENTES PERSONALES</strong></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>1. VACUNAS <br>
		      <input type='checkbox' id='cb_vacunas' /></td>
		    <td colspan='3' class='active'>5. ENF ALÉRGICA <br>
		      <input type='checkbox' id='cb_alergica'/></td>
		    <td colspan='3' class='active'>9. ENF NEUROLÓGICA <br>
		      <input type='checkbox' id='cb_neurologica'/></td>
		    <td colspan='3' class='active'>13. ENF TRAUMATOLÓGICA <br>
		      <input type='checkbox' id='cb_traumatologica'/></td>
		    <td colspan='3' class='active'>17. TENDENCIA SEXUAL <br>
		      <input type='checkbox' id='cb_tendsexual'/></td>
		    <td colspan='4' class='active'>21. ACTIVIDAD SEXUAL <br>
		      <input type='checkbox' id='cb_actsexual'/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>2. ENF PERINATAL <br>
		      <input type='checkbox' id='cb_perinatal'/></td>
		    <td colspan='3' class='active'>6. ENF CARDIACA <br>
		      <input type='checkbox' id='cb_cardiaca'/></td>
		    <td colspan='3' class='active'>10. ENF METABÓLICA <br>
		      <input type='checkbox' id='cb_metabolica'/></td>
		    <td colspan='3' class='active'>14. ENF QUIRURGICA <br>
		      <input type='checkbox' id='cb_quirurgica'/></td>
		    <td colspan='3' class='active'>18. RIESGO SOCIAL <br>
		      <input type='checkbox' id='cb_riesgosocial'/></td>
		    <td colspan='4' class='active'>22. DIETA Y HABITOS <br>
		      <input type='checkbox' id='cb_dietahabitos'/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>3. ENF INFANCIA <br>
		      <input type='checkbox' id='cb_infancia'/></td>
		    <td colspan='3' class='active'>7. ENF RESPIRATORIA <br>
		      <input type='checkbox' id='cb_respiratoria'/></td>
		    <td colspan='3' class='active'>11. ENF HEMO LINF <br>
		      <input type='checkbox' id='cb_hemolinf'/></td>
		    <td colspan='3' class='active'>15. ENF MENTAL <br>
		      <input type='checkbox' id='cb_mental'/></td>
		    <td colspan='3' class='active'>19. RIESGO LABORAL <br>
		      <input type='checkbox' id='cb_riesgolaboral'/></td>
		    <td colspan='4' class='active'>23. RELIGION Y CULTURA <br>
		      <input type='checkbox' id='cb_religioncultura'/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>4. ENF ADOLECENTE <br>
		      <input type='checkbox' id='cb_adolecente'/></td>
		    <td colspan='3' class='active'>8. ENF DIGESTIVA <br>
		      <input type='checkbox' id='cb_digestiva'/></td>
		    <td colspan='3' class='active'>12. ENF URINARIA X <br>
		      <input type='checkbox' id='cb_urinaria'/></td>
		    <td colspan='3' class='active'>16. ENF T SEXUAL <br>
		      <input type='checkbox' id='cb_tsexual'/></td>
		    <td colspan='3' class='active'>20. RIESGO FAMILIAR <br>
		      <input type='checkbox' id='cb_riesgofamiliar'/></td>
		    <td colspan='4' class='active'>24. OTRO <br>
		      <input type='checkbox' id='cb_otro'/></td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea id='txtAntePer'  style=' border-width:0px; height:100%; width:98%' value=''></textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>3. ANTECEDENTES FAMILIARES</strong></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='2' class='active'>1. CARDIOPATIA <br>
		      <input type='checkbox' id='cb_cardiopatia'/></td>
		    <td colspan='2' class='active'>2. DIABETES <br>
		      <input type='checkbox' id='cb_diabetes'/></td>
		    <td colspan='2' class='active'>3. ENF VASCULARES <br>
		      <input type='checkbox' id='cb_enfvasculares'/></td>
		    <td colspan='2' class='active'>4. HTA <br>
		      <input type='checkbox' id='cb_hta'/></td>
		    <td colspan='2' class='active'>5. CANCER <br>
		      <input type='checkbox' id='cb_cancer'/></td>
		    <td colspan='2' class='active'>6. TUBERCULOSIS <br>
		      <input type='checkbox' id='cb_tuberculosis'/></td>
		    <td colspan='2' class='active'>7. ENF MENTAL <br>
		      <input type='checkbox' id='cb_enfenfmental'/></td>
		    <td colspan='2' class='active'>8. ENF INFECCIOSA <br>
		      <input type='checkbox' id='cb_enfinfecciosa'/></td>
		    <td colspan='2' class='active'>9. MAL FORMACIÓN <br>
		      <input type='checkbox' id='cb_malformacion'/></td>
		    <td colspan='2' class='active'>10. OTRO <br>
		      <input type='checkbox' id='cb_afotro'/></td>
		  </tr>
		  <tr>
		    <td colspan='20'><textarea id='txtNoRef'  style=' border-width:0px; height:100%; width:98%'></textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong> 4. ENFERMEDAD O PROBLEMA ACTUAL (Nota de Ingreso)</strong></td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea id='txtProbActual'  style=' border-width:0px; height:100%; width:98%' ></textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>5. REVISIÓN ACTUAL DE ÓRGANOS Y SISTEMAS AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		  </tr>
		  <tr style='font-size:10px; ' align='center'>
		    <td colspan='2' class='active'>1. ÓRGANOS DE LOS SENTIDOS</td>
		    <td><input type='checkbox' id='cb_1CP'/></td>
		    <td><input type='checkbox' id='cb_1SP'/></td>
		    <td colspan='2' class='active'>3. CARDIOVASCULAR</td>
		    <td><input type='checkbox' id='cb_3CP'/></td>
		    <td><input type='checkbox' id='cb_3SP'/></td>
		    <td colspan='2' class='active'>5. GENITAL</td>
		    <td><input type='checkbox' id='cb_5CP'/></td>
		    <td><input type='checkbox' id='cb_5SP'/></td>
		    <td colspan='2' class='active'>7. MÚSCULO ESQUELÉTICO</td>
		    <td><input type='checkbox' id='cb_7CP'/></td>
		    <td><input type='checkbox' id='cb_7SP'/></td>
		    <td colspan='2' class='active'>9. HEMO LINFÁTICO</td>
		    <td><input type='checkbox' id='cb_9CP'/></td>
		    <td><input type='checkbox' id='cb_9SP'/></td>
		  </tr>
		  <tr style='font-size:10px; ' align='center'>
		    <td colspan='2' class='active'>2. RESPIRATORIO</td>
		    <td><input type='checkbox' id='cb_2CP'/></td>
		    <td><input type='checkbox' id='cb_2SP'/></td>
		    <td colspan='2' class='active'>4. DIGESTIVOS</td>
		    <td><input type='checkbox' id='cb_4CP'/></td>
		    <td><input type='checkbox' id='cb_4SP'/></td>
		    <td colspan='2' class='active'>6. URINARIO</td>
		    <td><input type='checkbox' id='cb_6CP'/></td>
		    <td><input type='checkbox' id='cb_6SP'/></td>
		    <td colspan='2' class='active'>8. ENDOCRINO</td>
		    <td><input type='checkbox' id='cb_8CP'/></td>
		    <td><input type='checkbox' id='cb_8SP'/></td>
		    <td colspan='2' class='active'>10. NERVIOSO</td>
		    <td><input type='checkbox' id='cb_10CP'/></td>
		    <td><input type='checkbox' id='cb_10SP'/></td>
		  </tr>
		  <tr height='80px'>
		    <td colspan='20'><textarea id='txtRevisOrgs'  style=' border-width:0px; height:100%; width:98%' ></textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>6. SIGNOS VITALES AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='17' >&nbsp;</td>
		    <td class='active'>M</td>
		    <td class='active'>O</td>
		    <td class='active'>V</td>
		  </tr>
		  <tr style='font-size:10px; ' align='cneter'>
		    <td class='active' width='5%'>TA</td>
		    <td width='5%'><input id='ta' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td class='active' width='5%'>F.C</td>
		    <td width='5%'><input id='fc' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td class='active' width='5%'>F.R</td>
		    <td width='5%'><input id='fr' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td class='active' width='5%'>SAT O2</td>
		    <td width='5%'><input id='sato2' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td class='active' width='5%'>TEMP BUCAL</td>
		    <td width='5%'><input id='tempbuc' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td class='active' width='5%'>PESO</td>
		    <td width='5%'><input id='peso' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td class='active' width='5%'>GLUCEMIA</td>
		    <td width='5%'><input id='glucem' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td class='active' width='5%'>TALLA</td>
		    <td width='5%'><input id='talla' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td class='active' width='10%'>ESCALA DE COMA DE GLASGOW</td>
		    <td width='3%'><input id='gm' type='text' style='border-width:0px; width:78%' value=''  /></td>
		    <td width='3%'><input id='go' type='text' style='border-width:0px; width:60%' value=''  /></td>
		    <td width='3%'><input id='gv' type='text' style='border-width:0px; width:60%' value=''  /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>7. EXAMEN FÍSICO AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		  </tr>
		  <tr style='font-size:10px;' align='center' >
		    <td colspan='2' class='active'>1.R PIEL Y FANERAS</td>
		    <td><input type='checkbox' id='cb_1RCP'/></td>
		    <td><input type='checkbox' id='cb_1RSP'/></td>
		    <td colspan='2' class='active'>6.R BOCA</td>
		    <td><input type='checkbox' id='cb_6RCP'/></td>
		    <td><input type='checkbox' id='cb_6RSP'/></td>
		    <td colspan='2' class='active'>11.R ABDOMEN</td>
		    <td><input type='checkbox' id='cb_11RCP'/></td>
		    <td><input type='checkbox' id='cb_11RSP'/></td>
		    <td colspan='2' class='active'>1. S ORGANOS DE LOS SENTIDOS</td>
		    <td><input type='checkbox' id='cb_1SCP'/></td>
		    <td><input type='checkbox' id='cb_1SSP'/></td>
		    <td colspan='2' class='active'>6. S URINARIO</td>
		    <td><input type='checkbox' id='cb_6SCP'/></td>
		    <td><input type='checkbox' id='cb_6SSP'/></td>
		  </tr>
		  <tr style='font-size:10px;' align='center' >
		    <td colspan='2' class='active'>2.R CABEZA</td>
		    <td><input type='checkbox' id='cb_2RCP'/></td>
		    <td><input type='checkbox' id='cb_2RSP'/></td>
		    <td colspan='2' class='active'>7.R OROFARINGE</td>
		    <td><input type='checkbox' id='cb_7RCP'/></td>
		    <td><input type='checkbox' id='cb_7RSP'/></td>
		    <td colspan='2' class='active'>12.R COLUMNA VERTEBRAL</td>
		    <td><input type='checkbox' id='cb_12RCP'/></td>
		    <td><input type='checkbox' id='cb_12RSP'/></td>
		    <td colspan='2' class='active'>2. S RESPIRATORIO</td>
		    <td><input type='checkbox' id='cb_2SCP'/></td>
		    <td><input type='checkbox' id='cb_2SSP'/></td>
		    <td colspan='2' class='active'>7. S MÚSCULO ESQUELÉTICO</td>
		    <td><input type='checkbox' id='cb_7SCP'/></td>
		    <td><input type='checkbox' id='cb_7SSP'/></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>3.R OJOS</td>
		    <td><input type='checkbox' id='cb_3RCP'/></td>
		    <td><input type='checkbox' id='cb_3RSP'/></td>
		    <td colspan='2' class='active'>8.R CUELLO</td>
		    <td><input type='checkbox' id='cb_8RCP'/></td>
		    <td><input type='checkbox' id='cb_8RSP'/></td>
		    <td colspan='2' class='active'>13.R INGLE-PERINE</td>
		    <td><input type='checkbox' id='cb_13RCP'/></td>
		    <td><input type='checkbox' id='cb_13RSP'/></td>
		    <td colspan='2' class='active'>3. S CARDIOVASCULAR</td>
		    <td><input type='checkbox' id='cb_3SCP'/></td>
		    <td><input type='checkbox' id='cb_3SSP'/></td>
		    <td colspan='2' class='active'>8.S ENDOCRINO</td>
		    <td><input type='checkbox' id='cb_8SCP'/></td>
		    <td><input type='checkbox' id='cb_8SSP'/></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>4.R OIDOS</td>
		    <td><input type='checkbox' id='cb_4RCP'/></td>
		    <td><input type='checkbox' id='cb_4RSP'/></td>
		    <td colspan='2' class='active'>9.R AXILAS MAMAS</td>
		    <td><input type='checkbox' id='cb_9RCP'/></td>
		    <td><input type='checkbox' id='cb_9RSP'/></td>
		    <td colspan='2' class='active'>14.R MIEMBROS SUPERIORES</td>
		    <td><input type='checkbox' id='cb_14RCP'/></td>
		    <td><input type='checkbox' id='cb_14RSP'/></td>
		    <td colspan='2' class='active'>4. S DIGESTIVOS</td>
		    <td><input type='checkbox' id='cb_4SCP'/></td>
		    <td><input type='checkbox' id='cb_4SSP'/></td>
		    <td colspan='2' class='active'>9. S HEMOLINFÁTICOS</td>
		    <td><input type='checkbox' id='cb_9SCP'/></td>
		    <td><input type='checkbox' id='cb_9SSP'/></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>5.R NARIZ</td>
		    <td><input type='checkbox' id='cb_5RCP'/></td>
		    <td><input type='checkbox' id='cb_5RSP'/></td>
		    <td colspan='2' class='active'>10.R TORAX</td>
		    <td><input type='checkbox' id='cb_10RCP'/></td>
		    <td><input type='checkbox' id='cb_10RSP'/></td>
		    <td colspan='2' class='active'>15.R MIEMBROS</td>
		    <td><input type='checkbox' id='cb_15RCP'/></td>
		    <td><input type='checkbox' id='cb_15RSP'/></td>
		    <td colspan='2' class='active'>5.S GENITAL</td>
		    <td><input type='checkbox' id='cb_5sCP'/></td>
		    <td><input type='checkbox' id='cb_5sSP'/></td>
		    <td colspan='2' class='active'>10.S NEUROLÓGICO</td>
		    <td><input type='checkbox' id='cb_10sCP'/></td>
		    <td><input type='checkbox' id='cb_10sSP'/></td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea id='txtExaFisico'  style=' border-width:0px; height:100%; width:98%' ></textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>9. DIAGNÓSTICO DE INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='8'>&nbsp;</td>
		    <td class='active'>CIE</td>
		    <td class='active'>PRE</td>
		    <td class='active'>DEF</td>
		    <td colspan='6'>&nbsp;</td>
		    <td class='active'>CIE</td>
		    <td class='active'>PRE</td>
		    <td class='active'>DEF</td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>1</td>
		    <td colspan='7'><input type='text' id='txtCie1' style='border-width:0px; width:80%' value='' />
		      <a onclick='verDiagnostico(3)'  href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td style='width:8%'><input type='text' id='txtCod1' style='border-width:0px; width:70%' value=''  /></td>
		    <td><input type='checkbox' id='cb_1PRE'/></td>
		    <td><input type='checkbox' id='cb_1DEF'/></td>
		    <td class='active'>4</td>
		    <td colspan='5'><input type='text' id='txtCie4'  style='border-width:0px; width:80%' value='' />
		      <a onclick='verDiagnostico(6)'  href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td style='width:8%'><input type='text' id='txtCod4' style='border-width:0px; width:70%' value=''  /></td>
		    <td><input type='checkbox' id='cb_4PRE'/></td>
		    <td><input type='checkbox' id='cb_4DEF'/></td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>2</td>
		    <td colspan='7'><input type='text' id='txtCie2' style='border-width:0px; width:80%' value=''  />
		      <a onclick='verDiagnostico(4)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' id='txtCod2' style='border-width:0px; width:70%' value=''  /></td>
		    <td><input type='checkbox' id='cb_2PRE'/></td>
		    <td><input type='checkbox' id='cb_2DEF'/></td>
		    <td class='active'>5</td>
		    <td colspan='5'><input type='text' id='txtCie5' style='border-width:0px; width:80%' value=''/>
		      <a onclick='verDiagnostico(7)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' id='txtCod5' style='border-width:0px; width:70%' value=''  /></td>
		    <td><input type='checkbox' id='cb_5PRE'/></td>
		    <td><input type='checkbox' id='cb_5DEF'/></td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>3</td>
		    <td colspan='7'><input type='text' id='txtCie3' style='border-width:0px; width:80%' value=''  />
		      <a onclick='verDiagnostico(5)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' id='txtCod3' style='border-width:0px; width:70%' value=''  /></td>
		    <td><input type='checkbox' id='cb_3PRE'/></td>
		    <td><input type='checkbox' id='cb_3DEF'/></td>
		    <td class='active'>6</td>
		    <td colspan='5'><input type='text'  id='txti3' style='border-width:0px; width:80%' value=''  />
		      <a onclick='verDiagnostico(8)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' id='txtic3' style='border-width:0px; width:70%' value=''  /></td>
		    <td><input type='checkbox' id='cb_6PRE'/></td>
		    <td><input type='checkbox' id='cb_6DEF'/></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'>&nbsp;</td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea id='txtPlanTrat'  style=' border-width:0px; height:100%; width:98%' ></textarea></td>
		  </tr>
		  <tr height='50PX' align='center' >
		    <td colspan='2' class='active' style='font-size:12px;'>FECHA - HORA</td>
		    <td colspan='2'><input type='date' id='txtFechaAgendDoct'></td>
		    <td colspan='2' class='active' style='font-size:12px;'>NOMBRE DEL PROFESIONAL</td>
		    <td colspan='4'><input type='text' style='border-width:0px; width:95%' value='$nombremedico' id='nombremedico'  /></td>
		    <td colspan='2' class='active' style='font-size:12px;'>FIRMA</td>
		    <td colspan='8'><input type='text' style='border-width:0px; width:95%' value=''  id='firmaDoc' /></td>
		  </tr>
		</table>
		<table class='table table-bordered table-striped table-hover table-condensed ''>
		  <tbody>
		    <tr>s
		      <td><center>
		          <a href='#' class='btn btn-info'"." onclick=\"SaveAnamnesisHospitalizacion('$param_insertar')\""."> <i class=' icon-file'> </i> Guardar </a>
		        </center>
		     </td>
		    </tr>
		  </tbody>
		</table>" ;
		    }
		    else
		    {
					$id_anam_hosp=$aux->Consultar("SELECT MAX(id_anam_hosp) FROM tbl_anamnesis_hosp WHERE id_pac='$codigo'");
					$datos=$aux->Consultar_AnamnesisHosp("SELECT * FROM tbl_anamnesis_hosp WHERE id_anam_hosp='$id_anam_hosp'");
					$nompac=$aux->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$nompac=utf8_encode($nompac);
					$apepac=$aux->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$apepac=utf8_encode($apepac);
					$sexpac=$aux->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$cedpac=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$fecnacpac=$aux->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo'");
			        $edad=$this->Edad($fecnacpac);			       
                    
					foreach($datos as $fila)
					{
						switch($fila['estado_proceso'])
						{
							case "A":
							echo "			
		<table width='100%' border='1' class='table table-bordered table-striped table-hover table-condensed '>
		  <tr>
		    <td  colspan='20' scope='col' class='active'><center>
		        <strong>LITOTRIFAST CLINICA DE UROLOGIA</strong>
		      </center></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='4' class='active'><strong>NOMBRES</strong></td>
		    <td colspan='4' class='active'><strong>APELLIDOS</strong></td>
		    <td colspan='3' class='active'><strong>EDAD</strong></td>
		    <td colspan='3' class='active'><strong>SEXO</strong></td>
		    <td colspan='3' class='active'><strong>No. HOJA</strong></td>
		    <td colspan='3' class='active'><strong>HCL</strong></td>
		  </tr>
		  <tr>
		    <td colspan='4'><input type='text' style='border-width:0px; width:93%' value='$nompac' /></td>
		    <td colspan='4'><input type='text' style='border-width:0px; width:93%' value='$apepac' /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$edad'  /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$sexpac'  /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='' /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$cedpac' id='CduPac'  /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>1. MOTIVO DE LA CONSULTA</strong></td>
		  </tr>
		  <tr>
		    <td class='active'><strong>A</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='$fila[motivo_cons_a]' id='MotivoConsA'  /></td>
		    <td class='active'><strong>C</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='$fila[motivo_cons_c]' id='MotivoConsC'   /></td>
		  </tr>
		  <tr>
		    <td class='active'><strong>B</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='$fila[motivo_cons_b]' id='MotivoConsB'   /></td>
		    <td class='active'><strong>D</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='$fila[motivo_cons_d]' id='MotivoConsD'    /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>2. ANTECEDENTES PERSONALES</strong></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>1. VACUNAS <br>
		      <input type='checkbox' id='cb_vacunas' "; $val_cb_vacunas = "$fila[cb_vacunas]";  echo "". $aux->checkOrNotcheck($val_cb_vacunas)." /></td>
		    <td colspan='3' class='active'>5. ENF ALÉRGICA <br>
		      <input type='checkbox' id='cb_alergica' "; $val_cb_alergica = "$fila[cb_alergica]"; echo "". $aux->checkOrNotcheck($val_cb_alergica)."/></td>
		    <td colspan='3' class='active'>9. ENF NEUROLÓGICA <br>
		      <input type='checkbox' id='cb_neurologica' "; $val_cb_neurologica = "$fila[cb_neurologica]"; echo "". $aux->checkOrNotcheck($val_cb_neurologica)."/></td>
		    <td colspan='3' class='active'>13. ENF TRAUMATOLÓGICA <br>
		      <input type='checkbox' id='cb_traumatologica' "; $val_cb_traumatologica = "$fila[cb_traumatologica]"; echo "". $aux->checkOrNotcheck($val_cb_traumatologica)."/></td>
		    <td colspan='3' class='active'>17. TENDENCIA SEXUAL <br>
		      <input type='checkbox' id='cb_tendsexual' "; $val_cb_tendsexual = "$fila[cb_tendsexual]"; echo "". $aux->checkOrNotcheck($val_cb_tendsexual)."/></td>
		    <td colspan='4' class='active'>21. ACTIVIDAD SEXUAL <br>
		      <input type='checkbox' id='cb_actsexual' "; $val_cb_actsexual = "$fila[cb_actsexual]"; echo "". $aux->checkOrNotcheck($val_cb_actsexual)."/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>2. ENF PERINATAL <br>
		      <input type='checkbox' id='cb_perinatal' "; $val_cb_perinatal = "$fila[cb_perinatal]"; echo "". $aux->checkOrNotcheck($val_cb_perinatal)."/></td>
		    <td colspan='3' class='active'>6. ENF CARDIACA <br>
		      <input type='checkbox' id='cb_cardiaca' "; $val_cb_cardiaca = "$fila[cb_cardiaca]"; echo "". $aux->checkOrNotcheck($val_cb_cardiaca)."/></td>
		    <td colspan='3' class='active'>10. ENF METABÓLICA <br>
		      <input type='checkbox' id='cb_metabolica' "; $val_cb_metabolica = "$fila[cb_metabolica]"; echo "". $aux->checkOrNotcheck($val_cb_metabolica)."/></td>
		    <td colspan='3' class='active'>14. ENF QUIRURGICA <br>
		      <input type='checkbox' id='cb_quirurgica' "; $val_cb_quirurgica = "$fila[cb_quirurgica]"; echo "". $aux->checkOrNotcheck($val_cb_quirurgica)."/></td>
		    <td colspan='3' class='active'>18. RIESGO SOCIAL <br>
		      <input type='checkbox' id='cb_riesgosocial' "; $val_cb_riesgosocial = "$fila[cb_riesgosocial]"; echo "". $aux->checkOrNotcheck($val_cb_riesgosocial)."/></td>
		    <td colspan='4' class='active'>22. DIETA Y HABITOS <br>
		      <input type='checkbox' id='cb_dietahabitos' "; $val_cb_dietahabitos = "$fila[cb_dietahabitos]"; echo "". $aux->checkOrNotcheck($val_cb_dietahabitos)."/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>3. ENF INFANCIA <br>
		      <input type='checkbox' id='cb_infancia' "; $val_cb_infancia = "$fila[cb_infancia]"; echo "". $aux->checkOrNotcheck($val_cb_infancia)."/></td>
		    <td colspan='3' class='active'>7. ENF RESPIRATORIA <br>
		      <input type='checkbox' id='cb_respiratoria' "; $val_cb_respiratoria = "$fila[cb_respiratoria]"; echo "". $aux->checkOrNotcheck($val_cb_respiratoria)."/></td>
		    <td colspan='3' class='active'>11. ENF HEMO LINF <br>
		      <input type='checkbox' id='cb_hemolinf' "; $val_cb_hemolinf = "$fila[cb_hemolinf]"; echo "". $aux->checkOrNotcheck($val_cb_hemolinf)."/></td>
		    <td colspan='3' class='active'>15. ENF MENTAL <br>
		      <input type='checkbox' id='cb_mental' "; $val_cb_mental = "$fila[cb_mental]"; echo "". $aux->checkOrNotcheck($val_cb_mental)."/></td>
		    <td colspan='3' class='active'>19. RIESGO LABORAL <br>
		      <input type='checkbox' id='cb_riesgolaboral' "; $val_cb_riesgolaboral = "$fila[cb_riesgolaboral]"; echo "". $aux->checkOrNotcheck($val_cb_riesgolaboral)."/></td>
		    <td colspan='4' class='active'>23. RELIGION Y CULTURA <br>
		      <input type='checkbox' id='cb_religioncultura' "; $val_cb_religioncultura = "$fila[cb_religioncultura]"; echo "". $aux->checkOrNotcheck($val_cb_religioncultura)."/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>4. ENF ADOLECENTE <br>
		      <input type='checkbox' id='cb_adolecente'  "; $val_cb_adolecente = "$fila[cb_adolecente]"; echo "". $aux->checkOrNotcheck($val_cb_adolecente)." /></td>
		    <td colspan='3' class='active'>8. ENF DIGESTIVA <br>
		      <input type='checkbox' id='cb_digestiva'  "; $val_cb_digestiva = "$fila[cb_digestiva]"; echo "". $aux->checkOrNotcheck($val_cb_digestiva)." /></td>
		    <td colspan='3' class='active'>12. ENF URINARIA X <br>
		      <input type='checkbox' id='cb_urinaria'  "; $val_cb_urinaria = "$fila[cb_urinaria]"; echo "". $aux->checkOrNotcheck($val_cb_urinaria)." /></td>
		    <td colspan='3' class='active'>16. ENF T SEXUAL <br>
		      <input type='checkbox' id='cb_tsexual'  "; $val_cb_tsexual = "$fila[cb_tsexual]"; echo "". $aux->checkOrNotcheck($val_cb_tsexual)." /></td>
		    <td colspan='3' class='active'>20. RIESGO FAMILIAR <br>
		      <input type='checkbox' id='cb_riesgofamiliar'  "; $val_cb_riesgofamiliar = "$fila[cb_riesgofamiliar]"; echo "". $aux->checkOrNotcheck($val_cb_riesgofamiliar)." /></td>
		    <td colspan='4' class='active'>24. OTRO <br>
		      <input type='checkbox' id='cb_otro'  "; $val_cb_otro = "$fila[cb_otro]"; echo "". $aux->checkOrNotcheck($val_cb_otro)." /></td>
		  </tr>
		  <tr height='120px'>

		    <td colspan='20'><textarea id='txtAntePer'  style=' border-width:0px; height:100%; width:98%' >$fila[txt_ante_per]</textarea> </td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>3. ANTECEDENTES FAMILIARES</strong></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='2' class='active'>1. CARDIOPATIA <br>
		      <input type='checkbox' id='cb_cardiopatia'  "; $val_cb_cardiopatia = "$fila[cb_cardiopatia]"; echo "". $aux->checkOrNotcheck($val_cb_cardiopatia)."  /></td>
		    <td colspan='2' class='active'>2. DIABETES <br>
		      <input type='checkbox' id='cb_diabetes'  "; $val_cb_diabetes = "$fila[cb_diabetes]"; echo "". $aux->checkOrNotcheck($val_cb_diabetes)." /></td>
		    <td colspan='2' class='active'>3. ENF VASCULARES <br>
		      <input type='checkbox' id='cb_enfvasculares'  "; $val_cb_enfvasculares = "$fila[cb_enfvasculares]"; echo "". $aux->checkOrNotcheck($val_cb_enfvasculares)." /></td>
		    <td colspan='2' class='active'>4. HTA <br>
		      <input type='checkbox' id='cb_hta'  "; $val_cb_hta = "$fila[cb_hta]"; echo "". $aux->checkOrNotcheck($val_cb_hta)." /></td>
		    <td colspan='2' class='active'>5. CANCER <br>
		      <input type='checkbox' id='cb_cancer'  "; $val_cb_cancer = "$fila[cb_cancer]"; echo "". $aux->checkOrNotcheck($val_cb_cancer)." /></td>
		    <td colspan='2' class='active'>6. TUBERCULOSIS <br>
		      <input type='checkbox' id='cb_tuberculosis'  "; $val_cb_tuberculosis = "$fila[cb_tuberculosis]"; echo "". $aux->checkOrNotcheck($val_cb_tuberculosis)." /></td>
		    <td colspan='2' class='active'>7. ENF MENTAL <br>
		      <input type='checkbox' id='cb_enfenfmental'  "; $val_cb_enfenfmental = "$fila[cb_enfenfmental]"; echo "". $aux->checkOrNotcheck($val_cb_enfenfmental)." /></td>
		    <td colspan='2' class='active'>8. ENF INFECCIOSA <br>
		      <input type='checkbox' id='cb_enfinfecciosa'  "; $val_cb_enfinfecciosa = "$fila[cb_enfinfecciosa]"; echo "". $aux->checkOrNotcheck($val_cb_enfinfecciosa)." /></td>
		    <td colspan='2' class='active'>9. MAL FORMACIÓN <br>
		      <input type='checkbox' id='cb_malformacion'  "; $val_cb_malformacion = "$fila[cb_malformacion]"; echo "". $aux->checkOrNotcheck($val_cb_malformacion)." /></td>
		    <td colspan='2' class='active'>10. OTRO <br>
		      <input type='checkbox' id='cb_afotro'  "; $val_cb_afotro = "$fila[cb_afotro]"; echo "". $aux->checkOrNotcheck($val_cb_afotro)." /></td>
		  </tr>
		  <tr>
		    <td colspan='20'><textarea id='txtNoRef'  style=' border-width:0px; height:100%; width:98%'>$fila[txt_no_ref]</textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong> 4. ENFERMEDAD O PROBLEMA ACTUAL (Nota de Ingreso)</strong></td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea id='txtProbActual'  style=' border-width:0px; height:100%; width:98%' >$fila[txtProbActual]</textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>5. REVISIÓN ACTUAL DE ÓRGANOS Y SISTEMAS AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		  </tr>
		  <tr style='font-size:10px; ' align='center'>
		    <td colspan='2' class='active'>1. ÓRGANOS DE LOS SENTIDOS</td>
		    <td><input type='checkbox' id='cb_1CP' "; $val_cb_uno_cp = "$fila[cb_uno_cp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_cp)." /></td>
		    <td><input type='checkbox' id='cb_1SP' "; $val_cb_uno_sp = "$fila[cb_uno_sp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_sp)." /></td>
		    <td colspan='2' class='active'>3. CARDIOVASCULAR</td>
		    <td><input type='checkbox' id='cb_3CP' "; $val_cb_tres_cp = "$fila[cb_tres_cp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_cp)." /></td>
		    <td><input type='checkbox' id='cb_3SP' "; $val_cb_tres_SP = "$fila[cb_tres_SP]"; echo "". $aux->checkOrNotcheck($val_cb_tres_SP)." /></td>
		    <td colspan='2' class='active'>5. GENITAL</td>
		    <td><input type='checkbox' id='cb_5CP' "; $val_cb__cinco_cp = "$fila[cb__cinco_cp]"; echo "". $aux->checkOrNotcheck($val_cb__cinco_cp)." /></td>
		    <td><input type='checkbox' id='cb_5SP' "; $val_cb_cinco_sp = "$fila[cb_cinco_sp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_sp)." /></td>
		    <td colspan='2' class='active'>7. MÚSCULO ESQUELÉTICO</td>
		    <td><input type='checkbox' id='cb_7CP' "; $val_cb_siete_cp = "$fila[cb_siete_cp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_cp)." /></td>
		    <td><input type='checkbox' id='cb_7SP' "; $val_cb_siete_sp = "$fila[cb_siete_sp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_sp)." /></td>
		    <td colspan='2' class='active'>9. HEMO LINFÁTICO</td>
		    <td><input type='checkbox' id='cb_9CP' "; $val_cb_nueve_cp = "$fila[cb_nueve_cp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_cp)." /></td>
		    <td><input type='checkbox' id='cb_9SP' "; $val_cb_nueve_sp = "$fila[cb_nueve_sp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_sp)." /></td>
		  </tr>
		  <tr style='font-size:10px; ' align='center'>
		    <td colspan='2' class='active'>2. RESPIRATORIO</td>
		    <td><input type='checkbox' id='cb_2CP' "; $val_cb_dos_cp = "$fila[cb_dos_cp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_cp)." /></td>
		    <td><input type='checkbox' id='cb_2SP' "; $val_cb_dos_sp = "$fila[cb_dos_sp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_sp)." /></td>
		    <td colspan='2' class='active'>4. DIGESTIVOS</td>
		    <td><input type='checkbox' id='cb_4CP' "; $val_cb_cuatro_cp = "$fila[cb_cuatro_cp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_cp)." /></td>
		    <td><input type='checkbox' id='cb_4SP' "; $val_cb_cuatro_sp = "$fila[cb_cuatro_sp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_sp)." /></td>
		    <td colspan='2' class='active'>6. URINARIO</td>
		    <td><input type='checkbox' id='cb_6CP' "; $val_cb_seis_cp = "$fila[cb_seis_cp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_cp)." /></td>
		    <td><input type='checkbox' id='cb_6SP' "; $val_cb_seis_sp = "$fila[cb_seis_sp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_sp)." /></td>
		    <td colspan='2' class='active'>8. ENDOCRINO</td>
		    <td><input type='checkbox' id='cb_8CP' "; $val_cb_ocho_cp = "$fila[cb_ocho_cp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_cp)." /></td>
		    <td><input type='checkbox' id='cb_8SP' "; $val_cb_ocho_sp = "$fila[cb_ocho_sp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_sp)." /></td>
		    <td colspan='2' class='active'>10. NERVIOSO</td>
		    <td><input type='checkbox' id='cb_10CP' "; $val_cb_diez_cp = "$fila[cb_diez_cp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_cp)." /></td>
		    <td><input type='checkbox' id='cb_10SP' "; $val_cb_diez_sp = "$fila[cb_diez_sp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_sp)." /></td>
		  </tr>
		  <tr height='80px'>
		    <td colspan='20'><textarea id='txtRevisOrgs'  style=' border-width:0px; height:100%; width:98%' >$fila[txt_revis_orgs]</textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>6. SIGNOS VITALES AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='17' >&nbsp;</td>
		    <td class='active'>M</td>
		    <td class='active'>O</td>
		    <td class='active'>V</td>
		  </tr>
		  <tr style='font-size:10px; ' align='cneter'>
		    <td class='active' width='5%'>TA</td>
		    <td width='5%'><input id='ta' type='text' style='border-width:0px; width:78%' value='$fila[ta]'  /></td>
		    <td class='active' width='5%'>F.C</td>
		    <td width='5%'><input id='fc' type='text' style='border-width:0px; width:78%' value='$fila[fc]'  /></td>
		    <td class='active' width='5%'>F.R</td>
		    <td width='5%'><input id='fr' type='text' style='border-width:0px; width:78%' value='$fila[fr]'  /></td>
		    <td class='active' width='5%'>SAT O2</td>
		    <td width='5%'><input id='sato2' type='text' style='border-width:0px; width:78%' value='$fila[sato_dos]'  /></td>
		    <td class='active' width='5%'>TEMP BUCAL</td>
		    <td width='5%'><input id='tempbuc' type='text' style='border-width:0px; width:78%' value='$fila[tempbuc]'  /></td>
		    <td class='active' width='5%'>PESO</td>
		    <td width='5%'><input id='peso' type='text' style='border-width:0px; width:78%' value='$fila[peso]'  /></td>
		    <td class='active' width='5%'>GLUCEMIA</td>
		    <td width='5%'><input id='glucem' type='text' style='border-width:0px; width:78%' value='$fila[glucem]'  /></td>
		    <td class='active' width='5%'>TALLA</td>
		    <td width='5%'><input id='talla' type='text' style='border-width:0px; width:78%' value='$fila[talla]'  /></td>
		    <td class='active' width='10%'>ESCALA DE COMA DE GLASGOW</td>
		    <td width='3%'><input id='gm' type='text' style='border-width:0px; width:78%' value='$fila[gm]'  /></td>
		    <td width='3%'><input id='go' type='text' style='border-width:0px; width:60%' value='$fila[go]'  /></td>
		    <td width='3%'><input id='gv' type='text' style='border-width:0px; width:60%' value='$fila[gv]'  /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>7. EXAMEN FÍSICO AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		  </tr>
		  <tr style='font-size:10px;' align='center' >
		    <td colspan='2' class='active'>1.R PIEL Y FANERAS</td>
		    <td><input type='checkbox' id='cb_1RCP' "; $val_cb_uno_rcp = "$fila[cb_uno_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_rcp)." /></td>
		    <td><input type='checkbox' id='cb_1RSP' "; $val_cb_uno_rsp = "$fila[cb_uno_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_rsp)." /></td>
		    <td colspan='2' class='active'>6.R BOCA</td>
		    <td><input type='checkbox' id='cb_6RCP' "; $val_cb_seis_rcp = "$fila[cb_seis_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_rcp)." /></td>
		    <td><input type='checkbox' id='cb_6RSP' "; $val_cb_seis_rsp = "$fila[cb_seis_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_rsp)." /></td>
		    <td colspan='2' class='active'>11.R ABDOMEN</td>
		    <td><input type='checkbox' id='cb_11RCP' "; $val_cb_once_rcp = "$fila[cb_once_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_once_rcp)." /></td>
		    <td><input type='checkbox' id='cb_11RSP' "; $val_cb_once_rsp = "$fila[cb_once_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_once_rsp)." /></td>
		    <td colspan='2' class='active'>1. S ORGANOS DE LOS SENTIDOS</td>
		    <td><input type='checkbox' id='cb_1SCP' "; $val_cb_uno_scp = "$fila[cb_uno_scp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_scp)." /></td>
		    <td><input type='checkbox' id='cb_1SSP' "; $val_cb_uno_ssp = "$fila[cb_uno_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_ssp)." /></td>
		    <td colspan='2' class='active'>6. S URINARIO</td>
		    <td><input type='checkbox' id='cb_6SCP' "; $val_cb_seis_scp = "$fila[cb_seis_scp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_scp)." /></td>
		    <td><input type='checkbox' id='cb_6SSP' "; $val_cb_seis_ssp = "$fila[cb_seis_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_ssp)." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center' >
		    <td colspan='2' class='active'>2.R CABEZA</td>
		    <td><input type='checkbox' id='cb_2RCP' "; $val_cb_dos_rcp = "$fila[cb_dos_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_rcp)." /></td>
		    <td><input type='checkbox' id='cb_2RSP' "; $val_cb_dos_rsp = "$fila[cb_dos_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_rsp)." /></td>
		    <td colspan='2' class='active'>7.R OROFARINGE</td>
		    <td><input type='checkbox' id='cb_7RCP' "; $val_cb_siete_rcp = "$fila[cb_siete_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_rcp)." /></td>
		    <td><input type='checkbox' id='cb_7RSP' "; $val_cb_siete_rsp = "$fila[cb_siete_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_rsp)." /></td>
		    <td colspan='2' class='active'>12.R COLUMNA VERTEBRAL</td>
		    <td><input type='checkbox' id='cb_12RCP' "; $val_cb_doce_rcp = "$fila[cb_doce_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_doce_rcp)." /></td>
		    <td><input type='checkbox' id='cb_12RSP' "; $val_cb_doce_rsp = "$fila[cb_doce_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_doce_rsp)." /></td>
		    <td colspan='2' class='active'>2. S RESPIRATORIO</td>
		    <td><input type='checkbox' id='cb_2SCP' "; $val_cb_dos_scp = "$fila[cb_dos_scp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_scp)." /></td>
		    <td><input type='checkbox' id='cb_2SSP' "; $val_cb_dos_ssp = "$fila[cb_dos_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_sp)." /></td>
		    <td colspan='2' class='active'>7. S MÚSCULO ESQUELÉTICO</td>
		    <td><input type='checkbox' id='cb_7SCP' "; $val_cb_siete_scp = "$fila[cb_siete_scp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_scp)." /></td>
		    <td><input type='checkbox' id='cb_7SSP' "; $val_cb_siete_ssp = "$fila[cb_siete_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_ssp)." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>3.R OJOS</td>
		    <td><input type='checkbox' id='cb_3RCP' "; $val_cb_tres_rcp = "$fila[cb_tres_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_rcp)." /></td>
		    <td><input type='checkbox' id='cb_3RSP' "; $val_cb_tres_rsp = "$fila[cb_tres_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_rsp)." /></td>
		    <td colspan='2' class='active'>8.R CUELLO</td>
		    <td><input type='checkbox' id='cb_8RCP' "; $val_cb_ocho_rcp = "$fila[cb_ocho_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_rcp)." /></td>
		    <td><input type='checkbox' id='cb_8RSP' "; $val_cb_ocho_rsp = "$fila[cb_ocho_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_rsp)." /></td>
		    <td colspan='2' class='active'>13.R INGLE-PERINE</td>
		    <td><input type='checkbox' id='cb_13RCP' "; $val_cb_trece_rcp = "$fila[cb_trece_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_trece_rcp)." /></td>
		    <td><input type='checkbox' id='cb_13RSP' "; $val_cb_trece_rsp = "$fila[cb_trece_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_trece_rsp)." /></td>
		    <td colspan='2' class='active'>3. S CARDIOVASCULAR</td>
		    <td><input type='checkbox' id='cb_3SCP' "; $val_cb_tres_scp = "$fila[cb_tres_scp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_scp)." /></td>
		    <td><input type='checkbox' id='cb_3SSP' "; $val_cb_tres_ssp = "$fila[cb_tres_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_ssp)." /></td>
		    <td colspan='2' class='active'>8.S ENDOCRINO</td>
		    <td><input type='checkbox' id='cb_8SCP' "; $val_cb_ocho_scp = "$fila[cb_ocho_scp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_scp)." /></td>
		    <td><input type='checkbox' id='cb_8SSP' "; $val_cb_ocho_ssp = "$fila[cb_ocho_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_ssp)." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>4.R OIDOS</td>
		    <td><input type='checkbox' id='cb_4RCP' "; $val_cb_cuatro_rcp = "$fila[cb_cuatro_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_rcp)." /></td>
		    <td><input type='checkbox' id='cb_4RSP' "; $val_cb_cuatro_rsp = "$fila[cb_cuatro_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_rsp)." /></td>
		    <td colspan='2' class='active'>9.R AXILAS MAMAS</td>
		    <td><input type='checkbox' id='cb_9RCP' "; $val_cb_nueve_rcp = "$fila[cb_nueve_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_rcp)." /></td>
		    <td><input type='checkbox' id='cb_9RSP' "; $val_cb_nueve_rsp = "$fila[cb_nueve_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_rsp)." /></td>
		    <td colspan='2' class='active'>14.R MIEMBROS SUPERIORES</td>
		    <td><input type='checkbox' id='cb_14RCP' "; $val_cb_catorce_rcp = "$fila[cb_catorce_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_catorce_rcp)." /></td>
		    <td><input type='checkbox' id='cb_14RSP' "; $val_cb_catorce_rsp = "$fila[cb_catorce_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_catorce_rsp)." /></td>
		    <td colspan='2' class='active'>4. S DIGESTIVOS</td>
		    <td><input type='checkbox' id='cb_4SCP' "; $val_cb_cuatro_scp = "$fila[cb_cuatro_scp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_scp)." /></td>
		    <td><input type='checkbox' id='cb_4SSP' "; $val_cb_cuatro_ssp = "$fila[cb_cuatro_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_ssp)." /></td>
		    <td colspan='2' class='active'>9. S HEMOLINFÁTICOS</td>
		    <td><input type='checkbox' id='cb_9SCP' "; $val_cb_nueve_scp = "$fila[cb_nueve_scp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_scp)." /></td>
		    <td><input type='checkbox' id='cb_9SSP' "; $val_cb_nueve_ssp = "$fila[cb_nueve_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_ssp)." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>5.R NARIZ</td>
		    <td><input type='checkbox' id='cb_5RCP' "; $val_cb_cinco_rcp = "$fila[cb_cinco_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_rcp)." /></td>
		    <td><input type='checkbox' id='cb_5RSP' "; $val_cb_cinco_rsp = "$fila[cb_cinco_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_rsp)." /></td>
		    <td colspan='2' class='active'>10.R TORAX</td>
		    <td><input type='checkbox' id='cb_10RCP' "; $val_cb_diez_rcp = "$fila[cb_diez_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_rcp)." /></td>
		    <td><input type='checkbox' id='cb_10RSP' "; $val_cb_diez_rsp = "$fila[cb_diez_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_rsp)." /></td>
		    <td colspan='2' class='active'>15.R MIEMBROS</td>
		    <td><input type='checkbox' id='cb_15RCP' "; $val_cb_quince_rcp = "$fila[cb_quince_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_quince_rcp)." /></td>
		    <td><input type='checkbox' id='cb_15RSP' "; $val_cb_quince_rsp = "$fila[cb_quince_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_quince_rsp)." /></td>
		    <td colspan='2' class='active'>5.S GENITAL</td>
		    <td><input type='checkbox' id='cb_5sCP' "; $val_cb_cinco_scp = "$fila[cb_cinco_scp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_scp)." /></td>
		    <td><input type='checkbox' id='cb_5sSP' "; $val_cb_cinco_ssp = "$fila[cb_cinco_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_ssp)." /></td>
		    <td colspan='2' class='active'>10.S NEUROLÓGICO</td>
		    <td><input type='checkbox' id='cb_10sCP' "; $val_cb_diez_scp = "$fila[cb_diez_scp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_scp)." /></td>
		    <td><input type='checkbox' id='cb_10sSP' "; $val_cb_diez_ssp = "$fila[cb_diez_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_ssp)." /></td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea id='txtExaFisico'  style=' border-width:0px; height:100%; width:98%' >$fila[txt_exa_fisico]</textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>9. DIAGNÓSTICO DE INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='8'>&nbsp;</td>
		    <td class='active'>CIE</td>
		    <td class='active'>PRE</td>
		    <td class='active'>DEF</td>
		    <td colspan='6'>&nbsp;</td>
		    <td class='active'>CIE</td>
		    <td class='active'>PRE</td>
		    <td class='active'>DEF</td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>1</td>
		    <td colspan='7'><input type='text' id='txtCie1' style='border-width:0px; width:80%' value='$fila[txt_cie_uno]' />
		      <a onclick='verDiagnostico(3)'  href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td style='width:8%'><input type='text' id='txtCod1' style='border-width:0px; width:70%' value='$fila[txt_cod_uno]'  /></td>
		    <td><input type='checkbox' id='cb_1PRE' "; $val_cb_uno_pre = "$fila[cb_uno_pre]"; echo "". $aux->checkOrNotcheck($val_cb_uno_pre)."/></td>
		    <td><input type='checkbox' id='cb_1DEF' "; $val_cb_uno_def = "$fila[cb_uno_def]"; echo "". $aux->checkOrNotcheck($val_cb_uno_def)."/></td>
		    <td class='active'>4</td>
		    <td colspan='5'><input type='text' id='txtCie4'  style='border-width:0px; width:80%' value='$fila[txt_cie_cuatro]' />
		      <a onclick='verDiagnostico(6)'  href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td style='width:8%'><input type='text' id='txtCod4' style='border-width:0px; width:70%' value='$fila[txt_cod_cuatro]'  /></td>
		    <td><input type='checkbox' id='cb_4PRE' "; $val_cb_cuatro_pre = "$fila[cb_cuatro_pre]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_pre)."/></td>
		    <td><input type='checkbox' id='cb_4DEF' "; $val_cb_cuatro_def = "$fila[cb_cuatro_def]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_def)."/></td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>2</td>
		    <td colspan='7'><input type='text' id='txtCie2' style='border-width:0px; width:80%' value='$fila[txt_cie_dos]'  />
		      <a onclick='verDiagnostico(4)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' id='txtCod2' style='border-width:0px; width:70%' value='$fila[txt_cod_dos]'  /></td>
		    <td><input type='checkbox' id='cb_2PRE' "; $val_cb_dos_pre = "$fila[cb_dos_pre]"; echo "". $aux->checkOrNotcheck($val_cb_dos_pre)."/></td>
		    <td><input type='checkbox' id='cb_2DEF' "; $val_cb_dos_def = "$fila[cb_dos_def]"; echo "". $aux->checkOrNotcheck($val_cb_dos_def)."/></td>
		    <td class='active'>5</td>
		    <td colspan='5'><input type='text' id='txtCie5' style='border-width:0px; width:80%' value='$fila[txt_cie_cinco]'/>
		      <a onclick='verDiagnostico(7)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' id='txtCod5' style='border-width:0px; width:70%' value='$fila[txt_cod_cinco]'  /></td>
		    <td><input type='checkbox' id='cb_5PRE' "; $val_cb_cinco_pre = "$fila[cb_cinco_pre]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_pre)."/></td>
		    <td><input type='checkbox' id='cb_5DEF' "; $val_cb_cinco_def = "$fila[cb_cinco_def]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_def)."/></td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>3</td>
		    <td colspan='7'><input type='text' id='txtCie3' style='border-width:0px; width:80%' value='$fila[txt_cie_tres]'  />
		      <a onclick='verDiagnostico(5)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' id='txtCod3' style='border-width:0px; width:70%' value='$fila[txt_cod_tres]'  /></td>
		    <td><input type='checkbox' id='cb_3PRE' "; $val_cb_tres_pre = "$fila[cb_tres_pre]"; echo "". $aux->checkOrNotcheck($val_cb_tres_pre)."/></td>
		    <td><input type='checkbox' id='cb_3DEF' "; $val_cb_tres_def = "$fila[cb_tres_def]"; echo "". $aux->checkOrNotcheck($val_cb_tres_def)."/></td>
		    <td class='active'>6</td>
		    <td colspan='5'><input type='text'  id='txti3' style='border-width:0px; width:80%' value='$fila[txti_tres]'  />
		      <a onclick='verDiagnostico(8)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' id='txtic3' style='border-width:0px; width:70%' value='$fila[txtic_tres]'  /></td>
		    <td><input type='checkbox' id='cb_6PRE' "; $val_cb_seis_pre = "$fila[cb_seis_pre]"; echo "". $aux->checkOrNotcheck($val_cb_seis_pre)."/></td>
		    <td><input type='checkbox' id='cb_6DEF' "; $val_cb_seis_def = "$fila[cb_seis_def]"; echo "". $aux->checkOrNotcheck($val_cb_seis_def)."/></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'>&nbsp;</td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea id='txtPlanTrat'  style=' border-width:0px; height:100%; width:98%' >$fila[txt_plan_trat]</textarea></td>
		  </tr>
		  <tr height='50PX' align='center' >
		    <td colspan='2' class='active' style='font-size:12px;'>FECHA - HORA</td>
		    <td colspan='2'><input type='date' id='txtFechaAgendDoct' value='$fila[txt_fecha_agend_doct]'></td>
		    <td colspan='2' class='active' style='font-size:12px;'>NOMBRE DEL PROFESIONAL</td>
		    <td colspan='4'><input type='text' style='border-width:0px; width:95%' value='$nombremedico' id='nombremedico'  /></td>
		    <td colspan='2' class='active' style='font-size:12px;'>FIRMA</td>
		    <td colspan='8'><input type='text' style='border-width:0px; width:95%' value='$fila[firma_doc]'  id='LoadAllAnamnesisCdu' /></td>
		  </tr>
		</table>				
		<table class='table table-bordered table-striped table-hover table-condensed ' >
		  <tr>
		    <td><center>
		        <a href='#'  class='btn btn-info' "."onclick=\"SaveAnamnesisHospitalizacion('$param_modificar')\"".">
		        <i class=' icon-file'></i>Guardar</a>&nbsp;
		      
		        <a id='a_print' href='../Reportes/L_ImprimirAnamnesisHosp.php'  onclick='PrintAnamnesisHosp();return false;' role='button'   class='btn btn-info' >
		        <i class=' icon-print'></i>Imprimir</a>&nbsp;
		               
		        <a href='#' class='btn btn-danger' onclick='FinalizarAnamHosp($fila[id_anam_hosp])'>
		        <i class=' icon-stop'></i>Finalizar</a>
		      </center></td>
		  </tr>
		</table>";
               break;
               case "F":
							echo "			
		<table width='100%' border='1' class='table table-bordered table-striped table-hover table-condensed '>
		  <tr>
		    <td  colspan='20' scope='col' class='active'><center>
		        <strong>LITOTRIFAST CLINICA DE UROLOGIA</strong>
		      </center></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='4' class='active'><strong>NOMBRES</strong></td>
		    <td colspan='4' class='active'><strong>APELLIDOS</strong></td>
		    <td colspan='3' class='active'><strong>EDAD</strong></td>
		    <td colspan='3' class='active'><strong>SEXO</strong></td>
		    <td colspan='3' class='active'><strong>No. HOJA</strong></td>
		    <td colspan='3' class='active'><strong>HCL</strong></td>
		  </tr>
		  <tr>
		    <td colspan='4'><input type='text' style='border-width:0px; width:93%' value='$nompac' /></td>
		    <td colspan='4'><input type='text' style='border-width:0px; width:93%' value='$apepac' /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$edad'  /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$sexpac'  /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='' /></td>
		    <td colspan='3'><input type='text' style='border-width:0px; width:93%' value='$cedpac' id='CduPac'  /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>1. MOTIVO DE LA CONSULTA</strong></td>
		  </tr>
		  <tr>
		    <td class='active'><strong>A</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='$fila[motivo_cons_a]' readonly id='MotivoConsA'  /></td>
		    <td class='active'><strong>C</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='$fila[motivo_cons_c]' readonly id='MotivoConsC'   /></td>
		  </tr>
		  <tr>
		    <td class='active'><strong>B</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='$fila[motivo_cons_b]' readonly id='MotivoConsB'   /></td>
		    <td class='active'><strong>D</strong></td>
		    <td colspan='9'><input type='text' style='border-width:0px; width:95%' value='$fila[motivo_cons_d]' readonly id='MotivoConsD'    /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>2. ANTECEDENTES PERSONALES</strong></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>1. VACUNAS <br>
		      <input type='checkbox' readonly id='cb_vacunas' "; $val_cb_vacunas = "$fila[cb_vacunas]";  echo "". $aux->checkOrNotcheck($val_cb_vacunas)." /></td>
		    <td colspan='3' class='active'>5. ENF ALÉRGICA <br>
		      <input type='checkbox' readonly id='cb_alergica' "; $val_cb_alergica = "$fila[cb_alergica]"; echo "". $aux->checkOrNotcheck($val_cb_alergica)."/></td>
		    <td colspan='3' class='active'>9. ENF NEUROLÓGICA <br>
		      <input type='checkbox' readonly id='cb_neurologica' "; $val_cb_neurologica = "$fila[cb_neurologica]"; echo "". $aux->checkOrNotcheck($val_cb_neurologica)."/></td>
		    <td colspan='3' class='active'>13. ENF TRAUMATOLÓGICA <br>
		      <input type='checkbox' readonly id='cb_traumatologica' "; $val_cb_traumatologica = "$fila[cb_traumatologica]"; echo "". $aux->checkOrNotcheck($val_cb_traumatologica)."/></td>
		    <td colspan='3' class='active'>17. TENDENCIA SEXUAL <br>
		      <input type='checkbox' readonly id='cb_tendsexual' "; $val_cb_tendsexual = "$fila[cb_tendsexual]"; echo "". $aux->checkOrNotcheck($val_cb_tendsexual)."/></td>
		    <td colspan='4' class='active'>21. ACTIVIDAD SEXUAL <br>
		      <input type='checkbox' readonly id='cb_actsexual' "; $val_cb_actsexual = "$fila[cb_actsexual]"; echo "". $aux->checkOrNotcheck($val_cb_actsexual)."/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>2. ENF PERINATAL <br>
		      <input type='checkbox' readonly id='cb_perinatal' "; $val_cb_perinatal = "$fila[cb_perinatal]"; echo "". $aux->checkOrNotcheck($val_cb_perinatal)."/></td>
		    <td colspan='3' class='active'>6. ENF CARDIACA <br>
		      <input type='checkbox' readonly id='cb_cardiaca' "; $val_cb_cardiaca = "$fila[cb_cardiaca]"; echo "". $aux->checkOrNotcheck($val_cb_cardiaca)."/></td>
		    <td colspan='3' class='active'>10. ENF METABÓLICA <br>
		      <input type='checkbox' readonly id='cb_metabolica' "; $val_cb_metabolica = "$fila[cb_metabolica]"; echo "". $aux->checkOrNotcheck($val_cb_metabolica)."/></td>
		    <td colspan='3' class='active'>14. ENF QUIRURGICA <br>
		      <input type='checkbox' readonly id='cb_quirurgica' "; $val_cb_quirurgica = "$fila[cb_quirurgica]"; echo "". $aux->checkOrNotcheck($val_cb_quirurgica)."/></td>
		    <td colspan='3' class='active'>18. RIESGO SOCIAL <br>
		      <input type='checkbox' readonly id='cb_riesgosocial' "; $val_cb_riesgosocial = "$fila[cb_riesgosocial]"; echo "". $aux->checkOrNotcheck($val_cb_riesgosocial)."/></td>
		    <td colspan='4' class='active'>22. DIETA Y HABITOS <br>
		      <input type='checkbox' readonly id='cb_dietahabitos' "; $val_cb_dietahabitos = "$fila[cb_dietahabitos]"; echo "". $aux->checkOrNotcheck($val_cb_dietahabitos)."/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>3. ENF INFANCIA <br>
		      <input type='checkbox' readonly id='cb_infancia' "; $val_cb_infancia = "$fila[cb_infancia]"; echo "". $aux->checkOrNotcheck($val_cb_infancia)."/></td>
		    <td colspan='3' class='active'>7. ENF RESPIRATORIA <br>
		      <input type='checkbox' readonly id='cb_respiratoria' "; $val_cb_respiratoria = "$fila[cb_respiratoria]"; echo "". $aux->checkOrNotcheck($val_cb_respiratoria)."/></td>
		    <td colspan='3' class='active'>11. ENF HEMO LINF <br>
		      <input type='checkbox' readonly id='cb_hemolinf' "; $val_cb_hemolinf = "$fila[cb_hemolinf]"; echo "". $aux->checkOrNotcheck($val_cb_hemolinf)."/></td>
		    <td colspan='3' class='active'>15. ENF MENTAL <br>
		      <input type='checkbox' readonly id='cb_mental' "; $val_cb_mental = "$fila[cb_mental]"; echo "". $aux->checkOrNotcheck($val_cb_mental)."/></td>
		    <td colspan='3' class='active'>19. RIESGO LABORAL <br>
		      <input type='checkbox' readonly id='cb_riesgolaboral' "; $val_cb_riesgolaboral = "$fila[cb_riesgolaboral]"; echo "". $aux->checkOrNotcheck($val_cb_riesgolaboral)."/></td>
		    <td colspan='4' class='active'>23. RELIGION Y CULTURA <br>
		      <input type='checkbox' readonly id='cb_religioncultura' "; $val_cb_religioncultura = "$fila[cb_religioncultura]"; echo "". $aux->checkOrNotcheck($val_cb_religioncultura)."/></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>4. ENF ADOLECENTE <br>
		      <input type='checkbox' readonly id='cb_adolecente'  "; $val_cb_adolecente = "$fila[cb_adolecente]"; echo "". $aux->checkOrNotcheck($val_cb_adolecente)." /></td>
		    <td colspan='3' class='active'>8. ENF DIGESTIVA <br>
		      <input type='checkbox' readonly id='cb_digestiva'  "; $val_cb_digestiva = "$fila[cb_digestiva]"; echo "". $aux->checkOrNotcheck($val_cb_digestiva)." /></td>
		    <td colspan='3' class='active'>12. ENF URINARIA X <br>
		      <input type='checkbox' readonly id='cb_urinaria'  "; $val_cb_urinaria = "$fila[cb_urinaria]"; echo "". $aux->checkOrNotcheck($val_cb_urinaria)." /></td>
		    <td colspan='3' class='active'>16. ENF T SEXUAL <br>
		      <input type='checkbox' readonly id='cb_tsexual'  "; $val_cb_tsexual = "$fila[cb_tsexual]"; echo "". $aux->checkOrNotcheck($val_cb_tsexual)." /></td>
		    <td colspan='3' class='active'>20. RIESGO FAMILIAR <br>
		      <input type='checkbox' readonly id='cb_riesgofamiliar'  "; $val_cb_riesgofamiliar = "$fila[cb_riesgofamiliar]"; echo "". $aux->checkOrNotcheck($val_cb_riesgofamiliar)." /></td>
		    <td colspan='4' class='active'>24. OTRO <br>
		      <input type='checkbox' readonly id='cb_otro'  "; $val_cb_otro = "$fila[cb_otro]"; echo "". $aux->checkOrNotcheck($val_cb_otro)." /></td>
		  </tr>
		  <tr height='120px'>

		    <td colspan='20'><textarea readonly id='txtAntePer'  style=' border-width:0px; height:100%; width:98%' >$fila[txt_ante_per]</textarea> </td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>3. ANTECEDENTES FAMILIARES</strong></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='2' class='active'>1. CARDIOPATIA <br>
		      <input type='checkbox' readonly id='cb_cardiopatia'  "; $val_cb_cardiopatia = "$fila[cb_cardiopatia]"; echo "". $aux->checkOrNotcheck($val_cb_cardiopatia)."  /></td>
		    <td colspan='2' class='active'>2. DIABETES <br>
		      <input type='checkbox' readonly id='cb_diabetes'  "; $val_cb_diabetes = "$fila[cb_diabetes]"; echo "". $aux->checkOrNotcheck($val_cb_diabetes)." /></td>
		    <td colspan='2' class='active'>3. ENF VASCULARES <br>
		      <input type='checkbox' readonly id='cb_enfvasculares'  "; $val_cb_enfvasculares = "$fila[cb_enfvasculares]"; echo "". $aux->checkOrNotcheck($val_cb_enfvasculares)." /></td>
		    <td colspan='2' class='active'>4. HTA <br>
		      <input type='checkbox' readonly id='cb_hta'  "; $val_cb_hta = "$fila[cb_hta]"; echo "". $aux->checkOrNotcheck($val_cb_hta)." /></td>
		    <td colspan='2' class='active'>5. CANCER <br>
		      <input type='checkbox' readonly id='cb_cancer'  "; $val_cb_cancer = "$fila[cb_cancer]"; echo "". $aux->checkOrNotcheck($val_cb_cancer)." /></td>
		    <td colspan='2' class='active'>6. TUBERCULOSIS <br>
		      <input type='checkbox' readonly id='cb_tuberculosis'  "; $val_cb_tuberculosis = "$fila[cb_tuberculosis]"; echo "". $aux->checkOrNotcheck($val_cb_tuberculosis)." /></td>
		    <td colspan='2' class='active'>7. ENF MENTAL <br>
		      <input type='checkbox' readonly id='cb_enfenfmental'  "; $val_cb_enfenfmental = "$fila[cb_enfenfmental]"; echo "". $aux->checkOrNotcheck($val_cb_enfenfmental)." /></td>
		    <td colspan='2' class='active'>8. ENF INFECCIOSA <br>
		      <input type='checkbox' readonly id='cb_enfinfecciosa'  "; $val_cb_enfinfecciosa = "$fila[cb_enfinfecciosa]"; echo "". $aux->checkOrNotcheck($val_cb_enfinfecciosa)." /></td>
		    <td colspan='2' class='active'>9. MAL FORMACIÓN <br>
		      <input type='checkbox' readonly id='cb_malformacion'  "; $val_cb_malformacion = "$fila[cb_malformacion]"; echo "". $aux->checkOrNotcheck($val_cb_malformacion)." /></td>
		    <td colspan='2' class='active'>10. OTRO <br>
		      <input type='checkbox' readonly id='cb_afotro'  "; $val_cb_afotro = "$fila[cb_afotro]"; echo "". $aux->checkOrNotcheck($val_cb_afotro)." /></td>
		  </tr>
		  <tr>
		    <td colspan='20'><textarea readonly id='txtNoRef'  style=' border-width:0px; height:100%; width:98%'>$fila[txt_no_ref]</textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong> 4. ENFERMEDAD O PROBLEMA ACTUAL (Nota de Ingreso)</strong></td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea readonly id='txtProbActual'  style=' border-width:0px; height:100%; width:98%' >$fila[txtProbActual]</textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>5. REVISIÓN ACTUAL DE ÓRGANOS Y SISTEMAS AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		  </tr>
		  <tr style='font-size:10px; ' align='center'>
		    <td colspan='2' class='active'>1. ÓRGANOS DE LOS SENTIDOS</td>
		    <td><input type='checkbox' readonly id='cb_1CP' "; $val_cb_uno_cp = "$fila[cb_uno_cp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_1SP' "; $val_cb_uno_sp = "$fila[cb_uno_sp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_sp)." /></td>
		    <td colspan='2' class='active'>3. CARDIOVASCULAR</td>
		    <td><input type='checkbox' readonly id='cb_3CP' "; $val_cb_tres_cp = "$fila[cb_tres_cp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_3SP' "; $val_cb_tres_SP = "$fila[cb_tres_SP]"; echo "". $aux->checkOrNotcheck($val_cb_tres_SP)." /></td>
		    <td colspan='2' class='active'>5. GENITAL</td>
		    <td><input type='checkbox' readonly id='cb_5CP' "; $val_cb__cinco_cp = "$fila[cb__cinco_cp]"; echo "". $aux->checkOrNotcheck($val_cb__cinco_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_5SP' "; $val_cb_cinco_sp = "$fila[cb_cinco_sp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_sp)." /></td>
		    <td colspan='2' class='active'>7. MÚSCULO ESQUELÉTICO</td>
		    <td><input type='checkbox' readonly id='cb_7CP' "; $val_cb_siete_cp = "$fila[cb_siete_cp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_7SP' "; $val_cb_siete_sp = "$fila[cb_siete_sp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_sp)." /></td>
		    <td colspan='2' class='active'>9. HEMO LINFÁTICO</td>
		    <td><input type='checkbox' readonly id='cb_9CP' "; $val_cb_nueve_cp = "$fila[cb_nueve_cp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_9SP' "; $val_cb_nueve_sp = "$fila[cb_nueve_sp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_sp)." /></td>
		  </tr>
		  <tr style='font-size:10px; ' align='center'>
		    <td colspan='2' class='active'>2. RESPIRATORIO</td>
		    <td><input type='checkbox' readonly id='cb_2CP' "; $val_cb_dos_cp = "$fila[cb_dos_cp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_2SP' "; $val_cb_dos_sp = "$fila[cb_dos_sp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_sp)." /></td>
		    <td colspan='2' class='active'>4. DIGESTIVOS</td>
		    <td><input type='checkbox' readonly id='cb_4CP' "; $val_cb_cuatro_cp = "$fila[cb_cuatro_cp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_4SP' "; $val_cb_cuatro_sp = "$fila[cb_cuatro_sp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_sp)." /></td>
		    <td colspan='2' class='active'>6. URINARIO</td>
		    <td><input type='checkbox' readonly id='cb_6CP' "; $val_cb_seis_cp = "$fila[cb_seis_cp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_6SP' "; $val_cb_seis_sp = "$fila[cb_seis_sp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_sp)." /></td>
		    <td colspan='2' class='active'>8. ENDOCRINO</td>
		    <td><input type='checkbox' readonly id='cb_8CP' "; $val_cb_ocho_cp = "$fila[cb_ocho_cp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_8SP' "; $val_cb_ocho_sp = "$fila[cb_ocho_sp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_sp)." /></td>
		    <td colspan='2' class='active'>10. NERVIOSO</td>
		    <td><input type='checkbox' readonly id='cb_10CP' "; $val_cb_diez_cp = "$fila[cb_diez_cp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_cp)." /></td>
		    <td><input type='checkbox' readonly id='cb_10SP' "; $val_cb_diez_sp = "$fila[cb_diez_sp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_sp)." /></td>
		  </tr>
		  <tr height='80px'>
		    <td colspan='20'><textarea readonly id='txtRevisOrgs'  style=' border-width:0px; height:100%; width:98%' >$fila[txt_revis_orgs]</textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>6. SIGNOS VITALES AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='17' >&nbsp;</td>
		    <td class='active'>M</td>
		    <td class='active'>O</td>
		    <td class='active'>V</td>
		  </tr>
		  <tr style='font-size:10px; ' align='cneter'>
		    <td class='active' width='5%'>TA</td>
		    <td width='5%'><input readonly id='ta' type='text' style='border-width:0px; width:78%' value='$fila[ta]'  /></td>
		    <td class='active' width='5%'>F.C</td>
		    <td width='5%'><input readonly id='fc' type='text' style='border-width:0px; width:78%' value='$fila[fc]'  /></td>
		    <td class='active' width='5%'>F.R</td>
		    <td width='5%'><input readonly id='fr' type='text' style='border-width:0px; width:78%' value='$fila[fr]'  /></td>
		    <td class='active' width='5%'>SAT O2</td>
		    <td width='5%'><input readonly id='sato2' type='text' style='border-width:0px; width:78%' value='$fila[sato_dos]'  /></td>
		    <td class='active' width='5%'>TEMP BUCAL</td>
		    <td width='5%'><input readonly id='tempbuc' type='text' style='border-width:0px; width:78%' value='$fila[tempbuc]'  /></td>
		    <td class='active' width='5%'>PESO</td>
		    <td width='5%'><input readonly id='peso' type='text' style='border-width:0px; width:78%' value='$fila[peso]'  /></td>
		    <td class='active' width='5%'>GLUCEMIA</td>
		    <td width='5%'><input readonly id='glucem' type='text' style='border-width:0px; width:78%' value='$fila[glucem]'  /></td>
		    <td class='active' width='5%'>TALLA</td>
		    <td width='5%'><input readonly id='talla' type='text' style='border-width:0px; width:78%' value='$fila[talla]'  /></td>
		    <td class='active' width='10%'>ESCALA DE COMA DE GLASGOW</td>
		    <td width='3%'><input readonly id='gm' type='text' style='border-width:0px; width:78%' value='$fila[gm]'  /></td>
		    <td width='3%'><input readonly id='go' type='text' style='border-width:0px; width:60%' value='$fila[go]'  /></td>
		    <td width='3%'><input readonly id='gv' type='text' style='border-width:0px; width:60%' value='$fila[gv]'  /></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>7. EXAMEN FÍSICO AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		  </tr>
		  <tr style='font-size:10px;' align='center' >
		    <td colspan='2' class='active'>1.R PIEL Y FANERAS</td>
		    <td><input type='checkbox' readonly id='cb_1RCP' "; $val_cb_uno_rcp = "$fila[cb_uno_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_1RSP' "; $val_cb_uno_rsp = "$fila[cb_uno_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_rsp)." /></td>
		    <td colspan='2' class='active'>6.R BOCA</td>
		    <td><input type='checkbox' readonly id='cb_6RCP' "; $val_cb_seis_rcp = "$fila[cb_seis_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_6RSP' "; $val_cb_seis_rsp = "$fila[cb_seis_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_rsp)." /></td>
		    <td colspan='2' class='active'>11.R ABDOMEN</td>
		    <td><input type='checkbox' readonly id='cb_11RCP' "; $val_cb_once_rcp = "$fila[cb_once_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_once_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_11RSP' "; $val_cb_once_rsp = "$fila[cb_once_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_once_rsp)." /></td>
		    <td colspan='2' class='active'>1. S ORGANOS DE LOS SENTIDOS</td>
		    <td><input type='checkbox' readonly id='cb_1SCP' "; $val_cb_uno_scp = "$fila[cb_uno_scp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_1SSP' "; $val_cb_uno_ssp = "$fila[cb_uno_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_uno_ssp)." /></td>
		    <td colspan='2' class='active'>6. S URINARIO</td>
		    <td><input type='checkbox' readonly id='cb_6SCP' "; $val_cb_seis_scp = "$fila[cb_seis_scp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_6SSP' "; $val_cb_seis_ssp = "$fila[cb_seis_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_seis_ssp)." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center' >
		    <td colspan='2' class='active'>2.R CABEZA</td>
		    <td><input type='checkbox' readonly id='cb_2RCP' "; $val_cb_dos_rcp = "$fila[cb_dos_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_2RSP' "; $val_cb_dos_rsp = "$fila[cb_dos_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_rsp)." /></td>
		    <td colspan='2' class='active'>7.R OROFARINGE</td>
		    <td><input type='checkbox' readonly id='cb_7RCP' "; $val_cb_siete_rcp = "$fila[cb_siete_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_7RSP' "; $val_cb_siete_rsp = "$fila[cb_siete_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_rsp)." /></td>
		    <td colspan='2' class='active'>12.R COLUMNA VERTEBRAL</td>
		    <td><input type='checkbox' readonly id='cb_12RCP' "; $val_cb_doce_rcp = "$fila[cb_doce_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_doce_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_12RSP' "; $val_cb_doce_rsp = "$fila[cb_doce_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_doce_rsp)." /></td>
		    <td colspan='2' class='active'>2. S RESPIRATORIO</td>
		    <td><input type='checkbox' readonly id='cb_2SCP' "; $val_cb_dos_scp = "$fila[cb_dos_scp]"; echo "". $aux->checkOrNotcheck($val_cb_dos_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_2SSP' "; $val_cb_dos_ssp = "$fila[cb_dos_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_sp)." /></td>
		    <td colspan='2' class='active'>7. S MÚSCULO ESQUELÉTICO</td>
		    <td><input type='checkbox' readonly id='cb_7SCP' "; $val_cb_siete_scp = "$fila[cb_siete_scp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_7SSP' "; $val_cb_siete_ssp = "$fila[cb_siete_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_siete_ssp)." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>3.R OJOS</td>
		    <td><input type='checkbox' readonly id='cb_3RCP' "; $val_cb_tres_rcp = "$fila[cb_tres_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_3RSP' "; $val_cb_tres_rsp = "$fila[cb_tres_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_rsp)." /></td>
		    <td colspan='2' class='active'>8.R CUELLO</td>
		    <td><input type='checkbox' readonly id='cb_8RCP' "; $val_cb_ocho_rcp = "$fila[cb_ocho_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_8RSP' "; $val_cb_ocho_rsp = "$fila[cb_ocho_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_rsp)." /></td>
		    <td colspan='2' class='active'>13.R INGLE-PERINE</td>
		    <td><input type='checkbox' readonly id='cb_13RCP' "; $val_cb_trece_rcp = "$fila[cb_trece_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_trece_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_13RSP' "; $val_cb_trece_rsp = "$fila[cb_trece_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_trece_rsp)." /></td>
		    <td colspan='2' class='active'>3. S CARDIOVASCULAR</td>
		    <td><input type='checkbox' readonly id='cb_3SCP' "; $val_cb_tres_scp = "$fila[cb_tres_scp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_3SSP' "; $val_cb_tres_ssp = "$fila[cb_tres_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_tres_ssp)." /></td>
		    <td colspan='2' class='active'>8.S ENDOCRINO</td>
		    <td><input type='checkbox' readonly id='cb_8SCP' "; $val_cb_ocho_scp = "$fila[cb_ocho_scp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_8SSP' "; $val_cb_ocho_ssp = "$fila[cb_ocho_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_ocho_ssp)." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>4.R OIDOS</td>
		    <td><input type='checkbox' readonly id='cb_4RCP' "; $val_cb_cuatro_rcp = "$fila[cb_cuatro_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_4RSP' "; $val_cb_cuatro_rsp = "$fila[cb_cuatro_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_rsp)." /></td>
		    <td colspan='2' class='active'>9.R AXILAS MAMAS</td>
		    <td><input type='checkbox' readonly id='cb_9RCP' "; $val_cb_nueve_rcp = "$fila[cb_nueve_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_9RSP' "; $val_cb_nueve_rsp = "$fila[cb_nueve_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_rsp)." /></td>
		    <td colspan='2' class='active'>14.R MIEMBROS SUPERIORES</td>
		    <td><input type='checkbox' readonly id='cb_14RCP' "; $val_cb_catorce_rcp = "$fila[cb_catorce_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_catorce_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_14RSP' "; $val_cb_catorce_rsp = "$fila[cb_catorce_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_catorce_rsp)." /></td>
		    <td colspan='2' class='active'>4. S DIGESTIVOS</td>
		    <td><input type='checkbox' readonly id='cb_4SCP' "; $val_cb_cuatro_scp = "$fila[cb_cuatro_scp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_4SSP' "; $val_cb_cuatro_ssp = "$fila[cb_cuatro_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_ssp)." /></td>
		    <td colspan='2' class='active'>9. S HEMOLINFÁTICOS</td>
		    <td><input type='checkbox' readonly id='cb_9SCP' "; $val_cb_nueve_scp = "$fila[cb_nueve_scp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_9SSP' "; $val_cb_nueve_ssp = "$fila[cb_nueve_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_nueve_ssp)." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>5.R NARIZ</td>
		    <td><input type='checkbox' readonly id='cb_5RCP' "; $val_cb_cinco_rcp = "$fila[cb_cinco_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_5RSP' "; $val_cb_cinco_rsp = "$fila[cb_cinco_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_rsp)." /></td>
		    <td colspan='2' class='active'>10.R TORAX</td>
		    <td><input type='checkbox' readonly id='cb_10RCP' "; $val_cb_diez_rcp = "$fila[cb_diez_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_10RSP' "; $val_cb_diez_rsp = "$fila[cb_diez_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_rsp)." /></td>
		    <td colspan='2' class='active'>15.R MIEMBROS</td>
		    <td><input type='checkbox' readonly id='cb_15RCP' "; $val_cb_quince_rcp = "$fila[cb_quince_rcp]"; echo "". $aux->checkOrNotcheck($val_cb_quince_rcp)." /></td>
		    <td><input type='checkbox' readonly id='cb_15RSP' "; $val_cb_quince_rsp = "$fila[cb_quince_rsp]"; echo "". $aux->checkOrNotcheck($val_cb_quince_rsp)." /></td>
		    <td colspan='2' class='active'>5.S GENITAL</td>
		    <td><input type='checkbox' readonly id='cb_5sCP' "; $val_cb_cinco_scp = "$fila[cb_cinco_scp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_5sSP' "; $val_cb_cinco_ssp = "$fila[cb_cinco_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_ssp)." /></td>
		    <td colspan='2' class='active'>10.S NEUROLÓGICO</td>
		    <td><input type='checkbox' readonly id='cb_10sCP' "; $val_cb_diez_scp = "$fila[cb_diez_scp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_scp)." /></td>
		    <td><input type='checkbox' readonly id='cb_10sSP' "; $val_cb_diez_ssp = "$fila[cb_diez_ssp]"; echo "". $aux->checkOrNotcheck($val_cb_diez_ssp)." /></td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea readonly id='txtExaFisico'  style=' border-width:0px; height:100%; width:98%' >$fila[txt_exa_fisico]</textarea></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'><strong>9. DIAGNÓSTICO DE INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='8'>&nbsp;</td>
		    <td class='active'>CIE</td>
		    <td class='active'>PRE</td>
		    <td class='active'>DEF</td>
		    <td colspan='6'>&nbsp;</td>
		    <td class='active'>CIE</td>
		    <td class='active'>PRE</td>
		    <td class='active'>DEF</td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>1</td>
		    <td colspan='7'><input type='text' readonly id='txtCie1' style='border-width:0px; width:80%' value='$fila[txt_cie_uno]' />
		      <a onclick='verDiagnostico(3)'  href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td style='width:8%'><input type='text' readonly id='txtCod1' style='border-width:0px; width:70%' value='$fila[txt_cod_uno]'  /></td>
		    <td><input type='checkbox' readonly id='cb_1PRE' "; $val_cb_uno_pre = "$fila[cb_uno_pre]"; echo "". $aux->checkOrNotcheck($val_cb_uno_pre)."/></td>
		    <td><input type='checkbox' readonly id='cb_1DEF' "; $val_cb_uno_def = "$fila[cb_uno_def]"; echo "". $aux->checkOrNotcheck($val_cb_uno_def)."/></td>
		    <td class='active'>4</td>
		    <td colspan='5'><input type='text' readonly id='txtCie4'  style='border-width:0px; width:80%' value='$fila[txt_cie_cuatro]' />
		      <a onclick='verDiagnostico(6)'  href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td style='width:8%'><input type='text' readonly id='txtCod4' style='border-width:0px; width:70%' value='$fila[txt_cod_cuatro]'  /></td>
		    <td><input type='checkbox' readonly id='cb_4PRE' "; $val_cb_cuatro_pre = "$fila[cb_cuatro_pre]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_pre)."/></td>
		    <td><input type='checkbox' readonly id='cb_4DEF' "; $val_cb_cuatro_def = "$fila[cb_cuatro_def]"; echo "". $aux->checkOrNotcheck($val_cb_cuatro_def)."/></td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>2</td>
		    <td colspan='7'><input type='text' readonly id='txtCie2' style='border-width:0px; width:80%' value='$fila[txt_cie_dos]'  />
		      <a onclick='verDiagnostico(4)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' readonly id='txtCod2' style='border-width:0px; width:70%' value='$fila[txt_cod_dos]'  /></td>
		    <td><input type='checkbox' readonly id='cb_2PRE' "; $val_cb_dos_pre = "$fila[cb_dos_pre]"; echo "". $aux->checkOrNotcheck($val_cb_dos_pre)."/></td>
		    <td><input type='checkbox' readonly id='cb_2DEF' "; $val_cb_dos_def = "$fila[cb_dos_def]"; echo "". $aux->checkOrNotcheck($val_cb_dos_def)."/></td>
		    <td class='active'>5</td>
		    <td colspan='5'><input type='text' readonly id='txtCie5' style='border-width:0px; width:80%' value='$fila[txt_cie_cinco]'/>
		      <a onclick='verDiagnostico(7)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' readonly id='txtCod5' style='border-width:0px; width:70%' value='$fila[txt_cod_cinco]'  /></td>
		    <td><input type='checkbox' readonly id='cb_5PRE' "; $val_cb_cinco_pre = "$fila[cb_cinco_pre]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_pre)."/></td>
		    <td><input type='checkbox' readonly id='cb_5DEF' "; $val_cb_cinco_def = "$fila[cb_cinco_def]"; echo "". $aux->checkOrNotcheck($val_cb_cinco_def)."/></td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>3</td>
		    <td colspan='7'><input type='text' readonly id='txtCie3' style='border-width:0px; width:80%' value='$fila[txt_cie_tres]'  />
		      <a onclick='verDiagnostico(5)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' readonly id='txtCod3' style='border-width:0px; width:70%' value='$fila[txt_cod_tres]'  /></td>
		    <td><input type='checkbox' readonly id='cb_3PRE' "; $val_cb_tres_pre = "$fila[cb_tres_pre]"; echo "". $aux->checkOrNotcheck($val_cb_tres_pre)."/></td>
		    <td><input type='checkbox' readonly id='cb_3DEF' "; $val_cb_tres_def = "$fila[cb_tres_def]"; echo "". $aux->checkOrNotcheck($val_cb_tres_def)."/></td>
		    <td class='active'>6</td>
		    <td colspan='5'><input type='text'  readonly id='txti3' style='border-width:0px; width:80%' value='$fila[txti_tres]'  />
		      <a onclick='verDiagnostico(8)' href='#myModal' role='button' class='btn' data-toggle='modal'> <i class='icon-plus'></i></a></td>
		    <td><input type='text' readonly id='txtic3' style='border-width:0px; width:70%' value='$fila[txtic_tres]'  /></td>
		    <td><input type='checkbox' readonly id='cb_6PRE' "; $val_cb_seis_pre = "$fila[cb_seis_pre]"; echo "". $aux->checkOrNotcheck($val_cb_seis_pre)."/></td>
		    <td><input type='checkbox' readonly id='cb_6DEF' "; $val_cb_seis_def = "$fila[cb_seis_def]"; echo "". $aux->checkOrNotcheck($val_cb_seis_def)."/></td>
		  </tr>
		  <tr>
		    <td colspan='20' class='active'>&nbsp;</td>
		  </tr>
		  <tr height='120px'>
		    <td colspan='20'><textarea readonly id='txtPlanTrat'  style=' border-width:0px; height:100%; width:98%' >$fila[txt_plan_trat]</textarea></td>
		  </tr>
		  <tr height='50PX' align='center' >
		    <td colspan='2' class='active' style='font-size:12px;'>FECHA - HORA</td>
		    <td colspan='2'><input type='date' readonly id='txtFechaAgendDoct' value='$fila[txt_fecha_agend_doct]'></td>
		    <td colspan='2' class='active' style='font-size:12px;'>NOMBRE DEL PROFESIONAL</td>
		    <td colspan='4'><input type='text' style='border-width:0px; width:95%' value='$nombremedico' readonly id='nombremedico'  /></td>
		    <td colspan='2' class='active' style='font-size:12px;'>FIRMA</td>
		    <td colspan='8'><input type='text' style='border-width:0px; width:95%' value='$fila[firma_doc]'  readonly id='LoadAllAnamnesisCdu' /></td>
		  </tr>
		</table>				
		<table class='table table-bordered table-striped table-hover table-condensed ' >
		  <tr>
		    <td><center>
		        <a href='#'  class='btn btn-info' "."onclick=\"SaveAnamnesisHospitalizacion('$param_modificar')\"".">
		        <i class=' icon-file'></i>Guardar</a>&nbsp;
		        <a href='#' class='btn btn-success' onclick='LoadAnamnesisHospitali(false)' ><i class=' icon-plus'></i> Nuevo</a>&nbsp;
		     
		        <a id='a_print' href='../Reportes/L_ImprimirAnamnesisHosp.php'  onclick='PrintAnamnesisHosp();return false;' role='button'   class='btn btn-info' >
		        <i class=' icon-print'></i>Imprimir</a>&nbsp;		               
		       
		      </center></td>
		  </tr>
		</table>";
               break;
           }
       }
   }
}


	//INSERTA LOS DATOS DE ANAMNESIS DE HOSPITALIZACION EN LA BASE DE DATOS

public function SaveAnamnesisHospitalizacion(
		$CduPac,$id_pac, $MotivoConsA, $MotivoConsB, $MotivoConsC, $MotivoConsD, $cb_vacunas, $cb_alergica, $cb_neurologica, $cb_traumatologica, $cb_tendsexual, $cb_actsexual, $cb_perinatal, $cb_cardiaca, $cb_metabolica, $cb_quirurgica, $cb_riesgosocial, $cb_dietahabitos, $cb_infancia, $cb_respiratoria, $cb_hemolinf, $cb_mental, $cb_riesgolaboral, $cb_religioncultura, $cb_adolecente, $cb_digestiva, $cb_urinaria, $cb_tsexual, $cb_riesgofamiliar, $cb_otro, $txtAntePer, $cb_cardiopatia, $cb_diabetes, $cb_enfvasculares, $cb_hta, $cb_cancer, $cb_tuberculosis, $cb_enfenfmental, $cb_enfinfecciosa, $cb_malformacion, $cb_afotro, $txtNoRef, $txtProbActual, $cb_1CP, $cb_1SP, $cb_3CP, $cb_3SP, $cb_5CP, $cb_5SP, $cb_7CP, $cb_7SP, $cb_9CP, $cb_9SP, $cb_2CP, $cb_2SP, $cb_4CP, $cb_4SP, $cb_6CP, $cb_6SP, $cb_8CP, $cb_8SP, $cb_10CP, $cb_10SP, $txtRevisOrgs, $ta, $fc,$fr, $sato2, $tempbuc, $peso, $glucem, $talla, $gm, $go, $gv, $cb_1RCP, $cb_1RSP, $cb_6RCP, $cb_6RSP, $cb_11RCP, $cb_11RSP, $cb_1SCP, $cb_1SSP, $cb_6SCP, $cb_6SSP, $cb_2RCP, $cb_2RSP, $cb_7RCP, $cb_7RSP, $cb_12RCP, $cb_12RSP, $cb_2SCP, $cb_2SSP, $cb_7SCP, $cb_7SSP, $cb_3RCP, $cb_3RSP, $cb_8RCP, $cb_8RSP, $cb_13RCP, $cb_13RSP, $cb_3SCP, $cb_3SSP, $cb_8SCP, $cb_8SSP, $cb_4RCP, $cb_4RSP, $cb_9RCP, $cb_9RSP, $cb_14RCP, $cb_14RSP, $cb_4SCP, $cb_4SSP, $cb_9SCP, $cb_9SSP, $cb_5RCP, $cb_5RSP, $cb_10RCP, $cb_10RSP, $cb_15RCP, $cb_15RSP, $cb_5sCP, $cb_5sSP, $cb_10sCP, $cb_10sSP, $txtExaFisico, $txtCie1, $txtCod1, $cb_1PRE, $cb_1DEF, $txtCie4, $txtCod4, $cb_4PRE, $cb_4DEF, $txtCie2, $txtCod2, $cb_2PRE, $cb_2DEF, $txtCie5, $txtCod5, $cb_5PRE, $cb_5DEF, $txtCie3, $txtCod3, $cb_3PRE, $cb_3DEF, $txti3, $txtic3, $cb_6PRE, $cb_6DEF, $txtPlanTrat, $txtFechaAgendDoct, $nombremedico, $firmaDoc)
				{    
					$anamcdu = new AnamnesisCdu;
					$today=$this->Mifecha();
					session_start();
					$med=$_SESSION['DOCTOR'];
					$id_doc=$anamcdu->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$med';");
					$aux = $anamcdu->Ejecutar("INSERT INTO tbl_anamnesis_hosp ( historia_clinica, id_pac, motivo_cons_a, motivo_cons_b, motivo_cons_c, motivo_cons_d, cb_vacunas, cb_alergica, cb_neurologica, cb_traumatologica, cb_tendsexual, cb_actsexual, cb_perinatal, cb_cardiaca, cb_metabolica, cb_quirurgica, cb_riesgosocial, cb_dietahabitos, cb_infancia, cb_respiratoria, cb_hemolinf, cb_mental, cb_riesgolaboral, cb_religioncultura, cb_adolecente, cb_digestiva, cb_urinaria, cb_tsexual, cb_riesgofamiliar, cb_otro, txt_ante_per, cb_cardiopatia, cb_diabetes, cb_enfvasculares, cb_hta, cb_cancer, cb_tuberculosis, cb_enfenfmental, cb_enfinfecciosa, cb_malformacion, cb_afotro, txt_no_ref, txtProbActual, cb_uno_cp, cb_uno_sp, cb_tres_cp, cb_tres_SP, cb__cinco_cp, cb_cinco_sp, cb_siete_cp, cb_siete_sp, cb_nueve_cp, cb_nueve_sp, cb_dos_cp, cb_dos_sp, cb_cuatro_cp, cb_cuatro_sp, cb_seis_cp, cb_seis_sp, cb_ocho_cp, cb_ocho_sp, cb_diez_cp, cb_diez_sp, txt_revis_orgs, ta, fc, fr, sato_dos, tempbuc, peso, glucem, talla, gm, go, gv, cb_uno_rcp, cb_uno_rsp, cb_seis_rcp, cb_seis_rsp, cb_once_rcp, cb_once_rsp, cb_uno_scp, cb_uno_ssp, cb_seis_scp, cb_seis_ssp, cb_dos_rcp, cb_dos_rsp, cb_siete_rcp, cb_siete_rsp, cb_doce_rcp, cb_doce_rsp, cb_dos_scp, cb_dos_ssp, cb_siete_scp, cb_siete_ssp, cb_tres_rcp, cb_tres_rsp, cb_ocho_rcp, cb_ocho_rsp, cb_trece_rcp, cb_trece_rsp, cb_tres_scp, cb_tres_ssp, cb_ocho_scp, cb_ocho_ssp, cb_cuatro_rcp, cb_cuatro_rsp, cb_nueve_rcp, cb_nueve_rsp, cb_catorce_rcp, cb_catorce_rsp, cb_cuatro_scp, cb_cuatro_ssp, cb_nueve_scp, cb_nueve_ssp, cb_cinco_rcp, cb_cinco_rsp, cb_diez_rcp, cb_diez_rsp, cb_quince_rcp, cb_quince_rsp, cb_cinco_scp, cb_cinco_ssp, cb_diez_scp, cb_diez_ssp, txt_exa_fisico, txt_cie_uno, txt_cod_uno, cb_uno_pre, cb_uno_def, txt_cie_cuatro, txt_cod_cuatro, cb_cuatro_pre, cb_cuatro_def, txt_cie_dos, txt_cod_dos, cb_dos_pre, cb_dos_def, txt_cie_cinco, txt_cod_cinco, cb_cinco_pre, cb_cinco_def, txt_cie_tres, txt_cod_tres, cb_tres_pre, cb_tres_def, txti_tres, txtic_tres, cb_seis_pre, cb_seis_def, txt_plan_trat, txt_fecha_agend_doct, nombremedico, firma_doc, id_doc, estado_proceso) VALUES ('$CduPac','$id_pac','$MotivoConsA', '$MotivoConsB', '$MotivoConsC', '$MotivoConsD', '$cb_vacunas', '$cb_alergica', '$cb_neurologica', '$cb_traumatologica', '$cb_tendsexual', '$cb_actsexual', '$cb_perinatal', '$cb_cardiaca', '$cb_metabolica', '$cb_quirurgica', '$cb_riesgosocial', '$cb_dietahabitos', '$cb_infancia', '$cb_respiratoria', '$cb_hemolinf', '$cb_mental', '$cb_riesgolaboral', '$cb_religioncultura', '$cb_adolecente', '$cb_digestiva', '$cb_urinaria', '$cb_tsexual', '$cb_riesgofamiliar', '$cb_otro', '$txtAntePer', '$cb_cardiopatia', '$cb_diabetes', '$cb_enfvasculares', '$cb_hta', '$cb_cancer', '$cb_tuberculosis', '$cb_enfenfmental', '$cb_enfinfecciosa', '$cb_malformacion', '$cb_afotro', '$txtNoRef', '$txtProbActual', '$cb_1CP', '$cb_1SP', '$cb_3CP', '$cb_3SP', '$cb_5CP', '$cb_5SP', '$cb_7CP', '$cb_7SP', '$cb_9CP', '$cb_9SP', '$cb_2CP', '$cb_2SP', '$cb_4CP', '$cb_4SP', '$cb_6CP', '$cb_6SP', '$cb_8CP', '$cb_8SP', '$cb_10CP', '$cb_10SP', '$txtRevisOrgs', '$ta', '$fc', '$fr', '$sato2', '$tempbuc', '$peso', '$glucem', '$talla', '$gm', '$go', '$gv', '$cb_1RCP', '$cb_1RSP', '$cb_6RCP', '$cb_6RSP', '$cb_11RCP', '$cb_11RSP', '$cb_1SCP', '$cb_1SSP', '$cb_6SCP', '$cb_6SSP', '$cb_2RCP', '$cb_2RSP', '$cb_7RCP', '$cb_7RSP', '$cb_12RCP', '$cb_12RSP', '$cb_2SCP', '$cb_2SSP', '$cb_7SCP', '$cb_7SSP', '$cb_3RCP', '$cb_3RSP', '$cb_8RCP', '$cb_8RSP', '$cb_13RCP', '$cb_13RSP', '$cb_3SCP', '$cb_3SSP', '$cb_8SCP', '$cb_8SSP', '$cb_4RCP', '$cb_4RSP', '$cb_9RCP', '$cb_9RSP', '$cb_14RCP', '$cb_14RSP', '$cb_4SCP', '$cb_4SSP', '$cb_9SCP', '$cb_9SSP', '$cb_5RCP', '$cb_5RSP', '$cb_10RCP', '$cb_10RSP', '$cb_15RCP', '$cb_15RSP', '$cb_5sCP', '$cb_5sSP', '$cb_10sCP', '$cb_10sSP', '$txtExaFisico', '$txtCie1', '$txtCod1', '$cb_1PRE', '$cb_1DEF', '$txtCie4', '$txtCod4', '$cb_4PRE', '$cb_4DEF', '$txtCie2', '$txtCod2', '$cb_2PRE', '$cb_2DEF', '$txtCie5', '$txtCod5', '$cb_5PRE', '$cb_5DEF', '$txtCie3', '$txtCod3', '$cb_3PRE', '$cb_3DEF', '$txti3', '$txtic3', '$cb_6PRE', '$cb_6DEF', '$txtPlanTrat', '$txtFechaAgendDoct', '$nombremedico', '$firmaDoc', '$id_doc','A')"); 


					echo "Los datos de anamnesis insertados y hospitalizacion se han guardado correctamente ";

				}



public function ModifAnamnesisHospitalizacion(
		 $CduPac, $id_pac, $MotivoConsA, $MotivoConsB, $MotivoConsC, $MotivoConsD, $cb_vacunas, $cb_alergica, $cb_neurologica, $cb_traumatologica, $cb_tendsexual, $cb_actsexual, $cb_perinatal, $cb_cardiaca, $cb_metabolica, $cb_quirurgica, $cb_riesgosocial, $cb_dietahabitos, $cb_infancia, $cb_respiratoria, $cb_hemolinf, $cb_mental, $cb_riesgolaboral, $cb_religioncultura, $cb_adolecente, $cb_digestiva, $cb_urinaria, $cb_tsexual, $cb_riesgofamiliar, $cb_otro, $txtAntePer, $cb_cardiopatia, $cb_diabetes, $cb_enfvasculares, $cb_hta, $cb_cancer, $cb_tuberculosis, $cb_enfenfmental, $cb_enfinfecciosa, $cb_malformacion, $cb_afotro, $txtNoRef, $txtProbActual, $cb_1CP, $cb_1SP, $cb_3CP, $cb_3SP, $cb_5CP, $cb_5SP, $cb_7CP, $cb_7SP, $cb_9CP, $cb_9SP, $cb_2CP, $cb_2SP, $cb_4CP, $cb_4SP, $cb_6CP, $cb_6SP, $cb_8CP, $cb_8SP, $cb_10CP, $cb_10SP, $txtRevisOrgs, $ta, $fc, $fr, $sato2, $tempbuc, $peso, $glucem, $talla, $gm, $go, $gv, $cb_1RCP, $cb_1RSP, $cb_6RCP, $cb_6RSP, $cb_11RCP, $cb_11RSP, $cb_1SCP, $cb_1SSP, $cb_6SCP, $cb_6SSP, $cb_2RCP, $cb_2RSP, $cb_7RCP, $cb_7RSP, $cb_12RCP, $cb_12RSP, $cb_2SCP, $cb_2SSP, $cb_7SCP, $cb_7SSP, $cb_3RCP, $cb_3RSP, $cb_8RCP, $cb_8RSP, $cb_13RCP, $cb_13RSP, $cb_3SCP, $cb_3SSP, $cb_8SCP, $cb_8SSP, $cb_4RCP, $cb_4RSP, $cb_9RCP, $cb_9RSP, $cb_14RCP, $cb_14RSP, $cb_4SCP, $cb_4SSP, $cb_9SCP, $cb_9SSP, $cb_5RCP, $cb_5RSP, $cb_10RCP, $cb_10RSP, $cb_15RCP, $cb_15RSP, $cb_5sCP, $cb_5sSP, $cb_10sCP, $cb_10sSP, $txtExaFisico, $txtCie1, $txtCod1, $cb_1PRE, $cb_1DEF, $txtCie4, $txtCod4, $cb_4PRE, $cb_4DEF, $txtCie2, $txtCod2, $cb_2PRE, $cb_2DEF, $txtCie5, $txtCod5, $cb_5PRE, $cb_5DEF, $txtCie3, $txtCod3, $cb_3PRE, $cb_3DEF, $txti3, $txtic3, $cb_6PRE, $cb_6DEF, $txtPlanTrat, $txtFechaAgendDoct, $nombremedico, $firmaDoc)
				{ 
					$aux = new AnamnesisCdu;
					$today=$this->Mifecha();
					session_start();
					$med=$_SESSION['DOCTOR'];
					$id_anam_hosp=$aux->Consultar("SELECT MAX(id_anam_hosp) FROM tbl_anamnesis_hosp WHERE id_pac='$id_pac'");
					$id_doc=$aux->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$med';");
					$maux = $aux->Ejecutar("UPDATE tbl_anamnesis_hosp SET historia_clinica = '$CduPac', id_pac = '$id_pac', motivo_cons_a = '$MotivoConsA', motivo_cons_b = '$MotivoConsB', motivo_cons_c = '$MotivoConsC', motivo_cons_d = '$MotivoConsD', cb_vacunas = '$cb_vacunas', cb_alergica = '$cb_alergica', cb_neurologica = '$cb_neurologica', cb_traumatologica = '$cb_traumatologica', cb_tendsexual = '$cb_tendsexual', cb_actsexual = '$cb_actsexual', cb_perinatal = '$cb_perinatal', cb_cardiaca = '$cb_cardiaca', cb_metabolica = '$cb_metabolica', cb_quirurgica = '$cb_quirurgica', cb_riesgosocial = '$cb_riesgosocial', cb_dietahabitos = '$cb_dietahabitos', cb_infancia = '$cb_infancia', cb_respiratoria = '$cb_respiratoria', cb_hemolinf = '$cb_hemolinf', cb_mental = '$cb_mental', cb_riesgolaboral = '$cb_riesgolaboral', cb_religioncultura = '$cb_religioncultura', cb_adolecente = '$cb_adolecente', cb_digestiva = '$cb_digestiva', cb_urinaria = '$cb_urinaria', cb_tsexual = '$cb_tsexual', cb_riesgofamiliar = '$cb_riesgofamiliar', cb_otro = '$cb_otro', txt_ante_per = '$txtAntePer', cb_cardiopatia = '$cb_cardiopatia', cb_diabetes = '$cb_diabetes', cb_enfvasculares = '$cb_enfvasculares', cb_hta = '$cb_hta', cb_cancer = '$cb_cancer', cb_tuberculosis = '$cb_tuberculosis', cb_enfenfmental = '$cb_enfenfmental', cb_enfinfecciosa = '$cb_enfinfecciosa', cb_malformacion = '$cb_malformacion', cb_afotro = '$cb_afotro', txt_no_ref = '$txtNoRef', txtProbActual = '$txtProbActual', cb_uno_cp = '$cb_1CP', cb_uno_sp = '$cb_1SP', cb_tres_cp = '$cb_3CP', cb_tres_SP = '$cb_3SP', cb__cinco_cp = '$cb_5CP', cb_cinco_sp = '$cb_5SP', cb_siete_cp = '$cb_7CP', cb_siete_sp = '$cb_7SP', cb_nueve_cp = '$cb_9CP', cb_nueve_sp = '$cb_9SP', cb_dos_cp = '$cb_2CP', cb_dos_sp = '$cb_2SP', cb_cuatro_cp = '$cb_4CP', cb_cuatro_sp = '$cb_4SP', cb_seis_cp = '$cb_6CP', cb_seis_sp = '$cb_6SP', cb_ocho_cp = '$cb_8CP', cb_ocho_sp = '$cb_8SP', cb_diez_cp = '$cb_10CP', cb_diez_sp = '$cb_10SP', txt_revis_orgs = '$txtRevisOrgs', ta = '$ta', fc = '$fc', fr = '$fr', sato_dos = '$sato2', tempbuc = '$tempbuc', peso = '$peso', glucem = '$glucem', talla = '$talla', gm = '$gm', go = '$go', gv = '$gv', cb_uno_rcp = '$cb_1RCP', cb_uno_rsp = '$cb_1RSP', cb_seis_rcp = '$cb_6RCP', cb_seis_rsp = '$cb_6RSP', cb_once_rcp = '$cb_11RCP', cb_once_rsp = '$cb_11RSP', cb_uno_scp = '$cb_1SCP', cb_uno_ssp = '$cb_1SSP', cb_seis_scp = '$cb_6SCP', cb_seis_ssp = '$cb_6SSP', cb_dos_rcp = '$cb_2RCP', cb_dos_rsp = '$cb_2RSP', cb_siete_rcp = '$cb_7RCP', cb_siete_rsp = '$cb_7RSP', cb_doce_rcp = '$cb_12RCP', cb_doce_rsp = '$cb_12RSP', cb_dos_scp = '$cb_2SCP', cb_dos_ssp = '$cb_2SSP', cb_siete_scp = '$cb_7SCP', cb_siete_ssp = '$cb_7SSP', cb_tres_rcp = '$cb_3RCP', cb_tres_rsp = '$cb_3RSP', cb_ocho_rcp = '$cb_8RCP', cb_ocho_rsp = '$cb_8RSP', cb_trece_rcp = '$cb_13RCP', cb_trece_rsp = '$cb_13RSP', cb_tres_scp = '$cb_3SCP', cb_tres_ssp = '$cb_3SSP', cb_ocho_scp = '$cb_8SCP', cb_ocho_ssp = '$cb_8SSP', cb_cuatro_rcp = '$cb_4RCP', cb_cuatro_rsp = '$cb_4RSP', cb_nueve_rcp = '$cb_9RCP', cb_nueve_rsp = '$cb_9RSP', cb_catorce_rcp = '$cb_14RCP', cb_catorce_rsp = '$cb_14RSP', cb_cuatro_scp = '$cb_4SCP', cb_cuatro_ssp = '$cb_4SSP', cb_nueve_scp = '$cb_9SCP', cb_nueve_ssp = '$cb_9SSP', cb_cinco_rcp = '$cb_5RCP', cb_cinco_rsp = '$cb_5RSP', cb_diez_rcp = '$cb_10RCP', cb_diez_rsp = '$cb_10RSP', cb_quince_rcp = '$cb_15RCP', cb_quince_rsp = '$cb_15RSP', cb_cinco_scp = '$cb_5sCP', cb_cinco_ssp = '$cb_5sSP', cb_diez_scp = '$cb_10sCP', cb_diez_ssp = '$cb_10sSP', txt_exa_fisico = '$txtExaFisico', txt_cie_uno = '$txtCie1', txt_cod_uno = '$txtCod1', cb_uno_pre = '$cb_1PRE', cb_uno_def = '$cb_1DEF', txt_cie_cuatro = '$txtCie4', txt_cod_cuatro = '$txtCod4', cb_cuatro_pre = '$cb_4PRE', cb_cuatro_def = '$cb_4DEF', txt_cie_dos = '$txtCie2', txt_cod_dos = '$txtCod2', cb_dos_pre = '$cb_2PRE', cb_dos_def = '$cb_2DEF', txt_cie_cinco = '$txtCie5', txt_cod_cinco = '$txtCod5', cb_cinco_pre = '$cb_5PRE', cb_cinco_def = '$cb_5DEF', txt_cie_tres = '$txtCie3', txt_cod_tres = '$txtCod3', cb_tres_pre = '$cb_3PRE', cb_tres_def = '$cb_3DEF', txti_tres = '$txti3', txtic_tres = '$txtic3', cb_seis_pre = '$cb_6PRE', cb_seis_def = '$cb_6DEF', txt_plan_trat = '$txtPlanTrat', txt_fecha_agend_doct = '$txtFechaAgendDoct', nombremedico = '$nombremedico', firma_doc = '$firmaDoc', id_doc = '$id_doc', estado_proceso = 'A' WHERE id_anam_hosp='$id_anam_hosp'");
					echo "Los datos de anamnesis de hospitalizacion se han guardado correctamente ";	

					 }


	public function FinalizarAnamHosp($idAnam)
	{
		$anam=new AnamnesisCdu;
		$anam->Ejecutar("UPDATE tbl_anamnesis_hosp SET estado_proceso='F' WHERE id_anam_hosp='$idAnam'");
		echo "Se ha finalizado correctamente";
	}




					

}





	//FUNCIONES DE LISTA HOSPITALIZACION

	//FUNCION PARA MOSTRAR TABLA DE ANAMNESIS DE HOSPITALIZACIÓN



?>
