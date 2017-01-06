// JavaScript Document
$(document).ready(function()
{
//diñeno del menu para doctor
$( "#menufenix" ).menu();
//fin diseno del menu para doctor
//inicio de la llamada a la funcion para carga las consulta de hoy
CargarConsultasDeHoyXDoctor();
//fin de la llamada a la funcion para carga las consulta de hoy

//inicio de la funcion parqa cargar los datos del doctor
DataDoctor();
//fin de la funcion parqa cargar los datos del doctor
//function para cargar el cie
CargarCie();
//

$("#ad_18").hide();
$("#DiagNosTOdontolo").hide();

});
//inicio de la funcio para cargar los datos de las consultas del dia de hoy
function CargarConsultasDeHoyXDoctor()
{
		$.ajax({
			url:'Procesar.php?accion=CargarPacientes',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#MainRespuestaDoctor").html(res);
			},
			error:function()
			{
				$("#MainRespuestaDoctor").html("error al cargar");
			}
		});
		$("#MenuDoctor").html("");
		$("#HistorialPaciente").html("");
		$("#RespuestaFamacos").html("");
		$("#arealerta").html("");
		$("#RespConsulta").html("");
		$("#LoadaDataNow").html("");
	
}
//historial del paciente
function LoadDataHistorialPac(codigo)
{
		$.ajax({
			url:'Procesar.php?accion=HistorialPaciente&CodigoPac='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#HistorialPaciente").html(res);
			},
			error:function()
			{
				$("#HistorialPaciente").html("error al cargar");
			}
		});	
}
//historial del paciente fin
//fin de la funcio para cargar los datos de las consultas del dia de hoy

function DatosAllFiliacion(codigo)
{
	$( "#DataFiliaCionPaciente" ).attr("title","Datos Filiación");
	$( "#DataFiliaCionPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:850,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#DataFiliaCionPaciente" ).dialog( "open" );
		$.ajax({
			url:'Procesar.php?accion=DataAfiliacionPaciente&CodigoPac='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#DataFiliaCionPaciente").html(res);
			},
			error:function()
			{
				$("#DataFiliaCionPaciente").html("error al cargar");
			}
		});
}
function ReloadDataPac(codigo)
{
	$.ajax({
			url:'Procesar.php?accion=DataAfiliacionPaciente&CodigoPac='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#DataFiliaCionPaciente").html(res);
			},
			error:function()
			{
				$("#DataFiliaCionPaciente").html("error al cargar");
			}
		});	
}

function SaveAndModPac(codigo)
{
				$.ajax({
					url:'Procesar.php?accion=ModDataPac&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+'&CodigoPaciente='+codigo,
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#DataFiliaCionPaciente").html(res);
						setTimeout(function()
						{
							$("#DataFiliaCionPaciente").html("");
							ReloadDataPac(codigo);
							CargarConsultasDeHoyXDoctor();
							
						},3000);
					},
					error:function()
					{
						$("#DataFiliaCionPaciente").html("error al cargar");
					}
				});
	
}
function NombrePaciente(codigo)
{
	$.ajax({
			url:'Procesar.php?accion=NombrePaciente&CodigoPaciente321='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreNombrePaciente").html(res);
			},
			error:function()
			{
				$("#AreNombrePaciente").html("error al cargar");
			}
		});	
}
function CargarAlertas(codigo)
{
	$.ajax({
			url:'Procesar.php?accion=CargarAlert&CodigoPaciente321='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#arealerta").html(res);
			},
			error:function()
			{
				$("#arealerta").html("error al cargar");
			}
		});	
}
function Diagnosticar(codigo,codigo1)
{
	//codigo1 es el usuario
	//LoadDataHistorialPac(codigo1); //datos del historial paciente  antiguo
	/*aqui ay un div para crear los botones para ver la receta e imprimirla*/
	
	//cargando el nombre del paciente
	NombrePaciente(codigo1);
	//fincargando el nombre del paciente
	//cargar alertas al ingresar el paciente
	CargarAlertas(codigo1);
	//fin cargar las alertas	
	
	/*$("#RespuestaFamacos").html("<table><tr><td>Diagnostico</td><td><textarea  id='txtDiagnosticar' cols='90' rows='2'></textarea></td></tr><tr><td>Examnes</td><td><textarea  id='txtExamnes' cols='90' rows='2'></textarea></td></tr><tr><td>Tratamiento</td><td><textarea  id='txtTratamiento' cols='90' rows='2'></textarea></td></tr><tr><td>Fecha Pro.</td><td><input type='text' id='txtFechaProx'/><input type='button' value='Buscar' id='bntBuscarCon' onclick='FirstTurno()'/> <div id='AreaHorario'></div></td></tr><tr><td colspan='3'><input type='button' value='Guardar' id='bntSaveDiagnostico'/> <input type='button' value='Recetar' id='bntRecetar'/> <div id='RespuestaRectaDadaPorDoctor'></div></td></tr><tr><td colspan='2'><input type='hidden' value='"+codigo+"' id='txtTurnoCons'/><input type='hidden' value='"+codigo1+"' id='txtCodpac'/></td></tr></table>");
				//antigua area para llenear los diseños
	
	$("#bntSaveDiagnostico").button();*/
	
	
/*	$('#MenuDoctor').html("<ul style='height:170px;' id='menufenix'><li class='ui-state-disabled'><a href='#'>Menu Doctor</a></li><li><a href='#' onclick='DatosAllFiliacion("+codigo1+")'>Datos de Filiación</a></li><li><a href='#' onclick='Anamnesis()'>Anamnesis</a></li><li><a href='#' onclick='ExamenFisico2()'>Exámen Físico</a></li><li><a href='#' onclick='Examenfisico()'>Exámenes</a></li><li><a href='#' onclick='Diagnostico3()'>Diagnóstico</a></li><li><a href='#' onclick='Tratamiento2()'>Tratamiento</a></li></ul> ");*/
	
	CargarFiliacion(codigo1);
	
	
	

	
	
	//$( "#menufenix" ).menu();
	
	/*$("#bntBuscarCon").button();
	$("#bntRecetar").button();
			$('#txtFechaProx').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtFechaProx').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );
	
	
	$("#bntSaveDiagnostico").click(function()
	{
		$.ajax({
			url:'Procesar.php?accion=Diagnosticar&dignosticopaciente='+$("#txtDiagnosticar").val()+'&examensePac='+$("#txtExamnes").val()+'&tratamientoPac='+$("#txtTratamiento").val()+'&turnoPac='+codigo+'&fechaPr='+$("#txtFechaProx").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#CodigoConsulta").html(res);
			},
			error:function()
			{
				$("#CodigoConsulta").html("error al cargar");
			}
		});
		setTimeout(function()
		{
			CargarConsultasDeHoyXDoctor();
		},100);

	});
	$("#bntRecetar").click(function()
	{
		$.ajax({
			url:'Procesar.php?accion=CargarFarmacos&codigoTu='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RecetarFarmacos").html(res);
			},
			error:function()
			{
				$("#RecetarFarmacos").html("error al cargar");
			}
		});
	
	});*/ //botones para el antigu funcionamiento para  del diagnostico
	/*$("#RespuestaFamacos").html("<div class='demo_jui'><table cellpadding='0' cellspacing='0' id='MiTabla666' ><thead><tr><td>Codigo Vademecun</td><td>Cantidad</td><td>Dosis</td><td>Via de administracion</td><td>Frecuencia</td><td>Duracion</td><td>Diagnostico</td></tr></thead><tbody><tr><td><input type='text' style='width:150px;' id='txtCodigoVade'/></td><td><input type='text'  style='width:150px;' id='txtCantidaMedi' /></td><td><input type='text' style='width:160px;' id='txtDosis' /></td><td><select style='width:150px;' id='cmbViaAdm'><option value=''>--Seleccione--</option><option>Oral</option><option>Rectal</option><option>Intramuscular</option><option>Intravenoso</option><option>Aplicacion</option></select></td><td><select style='width:150px;' id='cmbFrecu'><option value=''>--Seleccione--</option><option>C/4 Horas</option><option>C/6 Horas</option><option>C/8 Horas</option><option>C/12 Horas</option><option>Diaria</option><option>Semanal</option><option>Mensual</option></select></td><td><select style='width:150px;' id='cmbHora'><option value=''>--Seleccione--</option><option>Dia</option><option>Semana</option><option>Mes</option></select></td><td><input style='width:200px;' type='text' id='txtDiagnosti' /></td></tr></tbody></table></div>");
	$('#MiTabla666').dataTable({
		'bJQueryUI': true,
		'sPaginationType': 'full_numbers'
	});
	*/
	
//caja oculta para solicitud de imagenes
$("#caja32").html("<input type='hidden' id='imagenes123' value='"+codigo+"'/>");
$("#Caja").html("<input type='hidden' id='codigoTurno123' value='"+codigo+"'/>");
$("#MyAreaFenixCodTurno").html("<input type='hidden' id='CajaOcultaFenixTurno' value='"+codigo+"'/>");

$("#CajaCodPac").html("<input type='hidden' id='codigoPaciente' value='"+codigo1+"'/>");

$("#AreaAnamnesis").html("<input type='hidden' id='codigoescondidoanam123' value='"+codigo1+"'/>");


//menu para el paciente seleccionado

	$("#MenuDoctor").html("<div class='navbar '> <div class='navbar-inner'> <div class='brand'>Menú Paciente</div> <ul class='nav pull-left'><li><a href='#' onclick='FinPaciente()'>Finalizar Consulta</a></li> <li class='dropdown'> <a href='#' class='dropdown-toggle' data-toggle='dropdown'>Odontología</a> <ul class='dropdown-menu'> <li><a href='#' onclick='Signosvitales()'><span class='icon-adjust'></span>&nbsp; Signos vitales </a></li> <li><a href='#' onclick='ExaSistEstoma()'><span class='icon-adjust'></span>&nbsp; Exámen del sistema estomatognático </a> </li> <li><a href='#' onclick='IndicadoresBucal()'><span class='icon-adjust'></span>&nbsp; Indicadores de salud bucal</a> </li><li><a href='#' onClick='IndicesCpoceo()'><span class='icon-adjust'></span>&nbsp; Índices CPO -ceo</a> </li> <li><a href='#' onClick='PlanesDiagnTerapeutico()'><span class='icon-adjust'></span>&nbsp; Planes de diagnóstico</a> </li> <li class=''> <a tabindex='-1' href='#' onclick='OPenOdontograma()'><span class='icon-adjust'></span>&nbsp; Odontograma </a> </li>   <li class='dropdown-submenu'> <a tabindex='-1' href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='icon-adjust'></span>&nbsp; Consentimiento Informado</a> <ul class='dropdown-menu'>  <!-- <li><a tabindex='-1' href='#' onClick='ConsenInfoPac()'><span class='icon-print'></span>&nbsp; Consentimiento Informado del Paciente</a></li> --> <li><a tabindex='-1' href='#' onClick='ConsenInfoRepre()'><span class='icon-file'></span>&nbsp; Consentimiento Informado del Paciente y </br>Representante Legal</a></li> </ul>   <li class='dropdown-submenu'> <a tabindex='-1' href='#' class='dropdown-toggle' data-toggle='dropdown'><span class='icon-adjust'></span>&nbsp; Plan de tratamiento y control de pagos</a> <ul class='dropdown-menu'> <li><a tabindex='-1' href='#' onClick='IngresarPlanTraPago()'><span class='icon-pencil'></span>&nbsp; Ingresar</a></li> <li><a tabindex='-1' href='#' onClick='HistoPlanTraPago()'><span class='icon-hand-right'></span>&nbsp; Ver historial</a></li>  </ul>  </ul> </li> <li><a href='#' onclick='DatosAllFiliacion("+codigo1+")'>Datos de Filiación</a></li><li><a href='#' onclick='Anamnesis()'>Anamnesis</a></li><li><a href='#' onclick='ExamenFisico2()'>Exámen Físico</a></li><li><a href='#' onclick='Examenfisico()'>Exámenes</a></li><li><a href='#' onclick='DiagnosticoFenix()'>Diagnóstico</a></li> <li><a href='#' onclick='datosvademecun()'>Vademecum</a></li><!-- <li><a href='#' onclick='Tratamiento2()'>Tratamiento</a></li>--><li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'>Certificados</a><ul class='dropdown-menu'><li><a href='#' onclick='CertificadoAsistencia()' ><span class='icon-file'></span>&nbsp;Asistencia</a></li><li><a href='#' onclick='EnfermedaReposo()'><span class='icon-file'></span>&nbsp;Enfermedad y reposo</a></li><li><a href='#' onclick='CertificadoCuidado()'><span class='icon-file'></span>&nbsp;Cuidado</a></li></li><li><a href='#' onclick='CertificadoCirugia()'><span class='icon-file'></span>&nbsp;Cirugía</a></li><li><a href='#' onclick='CertificadoSalud()'><span class='icon-file'></span>&nbsp;Salud</a></li><li><a href='#' onclick='CertificadoSaludVacunacion()'><span class='icon-file'></span>&nbsp;Salud y vacunación</a></li>    <li><a href='#' onclick='ConsentimientoInfo()'><span class='icon-file'></span>&nbsp;Consentimiento Informado</a></li></ul></ul> </div> </div>");
	


//cambios Mijin
//tabla para llenar el diagnostico con los farmacos	
	$("#RespuestaFamacos").html("<table class='table table-bordered table-striped table-hover table-condensed ' ><thead><tr><th><center>Código Vademecun</center></th><th><center>Nombre Comercial</center></th><th><center>Cantidad</center></th><th><center>Dosis</center></th><th><center>Vía</center></th></tr></thead><tbody><tr><td><center><input type='text' style='width:160px;' id='txtCodigoVade'/></center></td><td><center><input type='text' style='width:160px;' id='txtNombrComer'/></center></td><td><center><input type='text'  style='width:60px;' id='txtCantidaMedi' /><center></td><td><center><input type='text' style='width:60px;' id='txtDosis' /></center></td><td><center><select style='width:100px;' id='cmbViaAdm'><option value=''>--Seleccione--</option><option>Oral</option><option>Rectal</option><option>Intramuscular</option><option>Intravenoso</option><option>Aplicacion</option></select></center></td></tr>  <tr><th><center>No.</center></th><th><center>Duración &nbsp;&nbsp;Frecuencia</center></th><th><center>Diagnóstico</center></th><th colspan='2'><center>Tratamiento</center></th></tr> <tr><td><center><select style='width:100px;' id='cmbFrecu'><option value=''>--Seleccione--</option><option>C/4 Horas</option><option>C/6 Horas</option><option>C/8 Horas</option><option>C/12 Horas</option><option>Diaria</option><option>Semanal</option><option>Mensual</option></select></center></td><td><center><input type='text' style='width:30px;' id='txtNumeroDiSeMe'/>&nbsp;<select style='width:100px;' id='cmbHora'><option value=''>--Seleccione--</option><option>Dias</option><option>Semanas</option><option>Meses</option></select></center></td><td><center><input style='width:153px;' type='text' id='txtDiagnosti' /></center></td><td colspan='2'><center><textarea cols='50' row='3' id='txtTratamieto'></textarea></center></td></tr> <tr> <td colspan='9'> <center><input id='bntguardarconsulta' onclick='SaveConsulta()' style='width:100px;' class='btn btn-success' type='button' value='Guardar' /></center> </td></tr></tbody></table>");
	
	
	
	
	
	$("#LoadaDataNow").html("<center><table class='table-bordered table-striped table-hover table-condensed'><tr><th>Motivo de consulta</th><th>Enefermedad actual</th><th>Examen Físico</th><th>Exámenes</th></tr><tr><td id='MotivoConsultaLoad'></td><td id='EnfermedadAcutalLoad'></td><td id='ExamenFiscoActualLoad'></td><td id='ExamensLoad'></td></tr></table></center>");
	
	
	
	ToLoadConsTodayNowToTurn();//cargando consultas de hoy por turno
}
//funcion para certificado de enfermedad y reposo
function mostrarFechaReposo(){
	days=$("#txtDias321").val();
    fecha=new Date();
    day=fecha.getDate();
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();
 
 	actual=year+"-"+month+"-"+day;
 
    tiempo=fecha.getTime();
    milisegundos=parseInt(days*24*60*60*1000);
    total=fecha.setTime(tiempo+milisegundos);
    day=fecha.getDate();
    month=fecha.getMonth()+1;
    year=fecha.getFullYear();
 
 	futura=year+"-"+month+"-"+day;
	$("#Diasreposo").html(actual +" hasta "+futura);
}

function ConsenInfoPac()
{
	$("#ConsenInfoPaciente").attr("title","Consentimiento Informado del Paciente");
	$( "#ConsenInfoPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:900,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#ConsenInfoPaciente" ).dialog( "open" );
	$( "#ConsenInfoPaciente" ).html("<object type='text/html' data='../Reportes/ConsenInfoPaciente.php'></object>");		
}

//inicio funcion consentimiento informado de representante
function ConsenInfoRepre()
{
	$("#ConsenInfoRepresentante").attr("title","Consentimiento Informado del Paciente y Representante Legal");
	$( "#ConsenInfoRepresentante" ).dialog({
			autoOpen: false,
			modal: true,
			height:585,
			width:1100,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#ConsenInfoRepresentante" ).dialog( "open" );
	$( "#ConsenInfoRepresentante" ).html("<table class='table table-bordered table-striped table-hover table-condensed' > <tr> <td colspan='5'>Como responsable legal del paciente que ha sido considerado por ahora imposibilitado para decidir en forma autónoma su consentimiento, autorizo la realización del tratamiento segun la información entregada por los profesionales de la salud en este documento. </td> </tr> <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <td><center>Nombre del Representante Legal</center></td> <td><center>Parentesco</center></td> <td><center>Teléfono</center></td> <td><center>Cédula de ciudadanía</center></td> <td><center>Firma</center></td> </tr> <tr> <td><center><input type='text' id='txtNomRepresentante'/></center></td> <td><center><input type='text' id='txtParentesco'/></center></td> <td><center><input type='text' id='txtTelefono'/></center></td> <td><center><input type='text' id='txtCedula'/></center></td> <td><center><input type='text' id='txtFirma' readonly style='width:60px;'/></center></td> </tr> <tr> <td><center>Institución del Sistema</center></td> <td><center>Unidad Operativa</center></td> <td colspan='3'><center>Cod. UO</center></td> </tr> <tr> <td><center><input type='text' id='txtInstSistem'/></center></td> <td><center><input type='text' id='txtUniOpe'/></center></td> <td colspan='3'><center><input type='text' id='txtCodUo'/></center></td> </tr> <tr> <td colspan='3'><center>Cod. Localización</center></td> <td colspan='2' rowspan='2'><center>Número de <br />Historia Clínica</center></td> </tr> <tr> <td><center>Parroquia</center></td> <td><center>Cantón</center></td> <td><center>Provincia</center></td> </tr> <tr> <td><center><input type='text' id='txtParroquia'/></center></td> <td><center><input type='text' id='txtCanton'/></center></td> <td><center><input type='text' id='txtProvincia'/></center></td> <td colspan='2'><center><input type='text' id='txtHistoria'/></center></td> </tr> <tr> <td><center>Apellido Paterno</center></td> <td><center>Apellido Materno</center></td> <td><center>Nombres</center></td> <td colspan='2'><center>Servicio</center></td> </tr> <tr> <td><center><input type='text' id='txtApPaterno'/></center></td> <td><center><input type='text' id='txtApMaterno'/></center></td> <td><center><input type='text' id='txtNombres'/></center></td> <td colspan='2'><center><input type='text' id='txtServicio'/></center></td> </tr> <tr> <td><center>Sala</center></td> <td><center>Cama</center></td> <td><center>Fecha</center></td> <td colspan='2'><center>Hora</center></td> </tr> <tr> <td><center><input type='text' id='txtSala'/></center></td> <td><center><input type='text' id='txtCama'/></center></td> <td><center><input type='text' id='txtFecha' readonly/></center></td> <td colspan='4'><center><input type='text' id='txtHora' readonly /></center></td> </tr> <tr> <td colspan='6'><center><input type='button' class='btn btn-primary' onclick='SaveConsenInfoRep()' value='Guardar'/></center></td> </tr> </table>");
	
	var f = new Date();
	$("#txtFecha").val(f.getDate() + "/" + (f.getMonth() +1) + "/" + f.getFullYear());
	
	$("#txtHora").val(f.getHours() + ":" + (f.getMinutes()));
}
//fin funcion consentimiento informado de representante

//funcion para guardar consentimiento informado de representante
function SaveConsenInfoRep()
{
	$.ajax({
			url:'Procesar.php?accion=SaveConsentimientoInfoRep&CodigoPac06='+$('#codigoPaciente').val()+'&NombreRepLegal='+$('#txtNomRepresentante').val()+'&Parentesco='+$("#txtParentesco").val()+'&Telefono='+$("#txtTelefono").val()+'&Cedula='+$("#txtCedula").val()+'&InstitucionSistema='+$("#txtInstSistem").val()+'&UnidadOp='+$("#txtUniOpe").val()+'&CodUO='+$("#txtCodUo").val()+'&Parroquia='+$("#txtParroquia").val()+'&Canton='+$("#txtCanton").val()+'&Provincia='+$("#txtProvincia").val()+'&HistoriaCli='+$("#txtHistoria").val()+'&ApellidoPa='+$("#txtApPaterno").val()+'&ApellidoMa='+$("#txtApMaterno").val()+'&Nombres='+$("#txtNombres").val()+'&Servicio='+$("#txtServicio").val()+'&Sala='+$("#txtSala").val()+'&Cama='+$("#txtCama").val()+'&Fecha='+$("#txtFecha").val()+'&Hora='+$("#txtHora").val()+'&Turno='+$("#CajaOcultaFenixTurno").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#ConsenInfoRepresentante").html(res);
				$("#ReporteConsenInfoRep").attr("title","Consentimiento Informado del Paciente y Representante Legal");
				$( "#ReporteConsenInfoRep" ).dialog({
					autoOpen: false,
					modal: true,
					height:585,
					width:1100,
					show: {
						effect: "slide",
						duration: 1000
					},
					hide: {
						effect: "drop",
						duration: 1000
					}
				});
			$( "#ReporteConsenInfoRep" ).dialog( "open" );
			$( "#ReporteConsenInfoRep" ).html("<object type='text/html' data='../Reportes/ConsenInfoRepresentante.php?id="+$('#CajaOcultaFenixTurno').val()+"'></object>");
			//$( "#ReporteConsenInfoRep" ).html("<object type='text/html' data='../Reportes/ConsenInfoPaciente.php'></object>");
					},
					error:function()
					{
						$("#ReporteConsenInfoRep").html("error al cargar");
					}
				});
}
//fin funcion para guardar consentimiento informado de representante

//funcion para modal de plan de tratamiento y control de pagos
function IngresarPlanTraPago()
{
	$("#IngPlanTratamientoPago").attr("title","Plan de tratamiento y control de pagos");
	$( "#IngPlanTratamientoPago" ).dialog({
			autoOpen: false,
			modal: true,
			height:660,
			width:490,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#IngPlanTratamientoPago" ).dialog( "open" );
	$( "#IngPlanTratamientoPago" ).html("<table class='table table-bordered table-striped table-hover table-condensed' > <tr> <th colspan='2'>Plan de Tratamiento</th> </tr> <tr> <td>Actividad</td> <td><input type='text' id='txtActividad'/></td> </tr> <tr> <td>No.</td> <td><input type='text' id='txtNumeroAc'/></td> </tr> <tr> <td>Precio Unitario</td> <td><input type='text' id='txtPrecioUni'/></td> </tr> <tr> <td>Total</td> <td><input type='text' id='txtTotal'/></td> </tr> <tr> <td colspan='2'>&nbsp;</td> </tr> <tr> <th colspan='2'>Control Pagos</th> </tr> <tr> <td>Fecha</td> <td><input type='text' id='txtFecha' readonly/></td> </tr> <tr> <td>Abono</td> <td><input type='text' id='txtAbono'/></td> </tr> <tr> <td>No. Factura</td> <td><input type='text' id='txtNumeroFac'/></td> </tr> <tr> <td>Cheque No.</td> <td><input type='text' id='txtCheque'/></td> </tr> <tr> <td>Efectivo</td> <td><input type='text' id='txtEfectivo'/></td> </tr> <tr> <td>Saldo</td> <td><input type='text' id='txtSaldo'/></td> </tr> <tr> <td colspan='2'><center><input id='bntguardarconsulta' onclick='SavePlanPagos()' class='btn btn-primary' type='button' value='Guardar' /></center></td> </tr> </table>");
	
	
	
	var f = new Date();
	$("#txtFecha").val(f.getFullYear() + "-" + (f.getMonth() +1) + "-" + f.getDate());
}
//fin funcion para modal de plan de tratamiento y control de pagos

//ajax funcion para guardar los datos de plan de tratamiento y control de pagos
function SavePlanPagos()
{
	$.ajax({
			url:'Procesar.php?accion=SavePlanTratamientoPagos&CodPac99='+$('#codigoPaciente').val()+'&Actividad='+$('#txtActividad').val()+'&NumActividad='+$('#txtNumeroAc').val()+'&PrecUnitario='+$('#txtPrecioUni').val()+'&Total='+$('#txtTotal').val()+'&Fecha123='+$('#txtFecha').val()+'&Abono='+$('#txtAbono').val()+'&NumFactura='+$('#txtNumeroFac').val()+'&Cheque='+$('#txtCheque').val()+'&Efectivo='+$('#txtEfectivo').val()+'&Saldo='+$('#txtSaldo').val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#IngPlanTratamientoPago").html(res);
			},
			error:function()
			{
				$("#IngPlanTratamientoPago").html("error al cargar");
			}
		});
}
//fin ajax funcion para guardar los datos de plan de tratamiento y control de pagos

//fuancion para mostrar historial plan de tratamiento y pagos
function HistoPlanTraPago()
{
	codigo=$("#codigoPaciente").val();
	$("#HistoPlanTratamientoPagos").attr("title","Plan de tratamiento y control de pagos");
	$( "#HistoPlanTratamientoPagos" ).dialog({
			autoOpen: false,
			modal: true,
			height:660,
			width:750,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#HistoPlanTratamientoPagos" ).dialog( "open" );
	$.ajax({
				url:'Procesar.php?accion=PlanTratamiPagos&CodigoPaciente15='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#HistoPlanTratamientoPagos").html(res);
				},
				error:function()
				{
					$("#HistoPlanTratamientoPagos").html("Errror Al cargar");
				}
			});
}
//fin fuancion para mostrar historial plan de tratamiento y pagos 

//inicio function para el certificado de asistencia
function CertificadoAsistencia()
{	
	$("#AreaParaCertificadoAsistencia").attr("title","Certificado de Asistencia");
	$( "#AreaParaCertificadoAsistencia" ).dialog({
			autoOpen: false,
			modal: true,
			height:350,
			width:750,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreaParaCertificadoAsistencia" ).dialog( "open" );	
	$( "#AreaParaCertificadoAsistencia" ).html("<table> <tr> <td colspan='2'><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td><div id='TextoParaCertificadoAsistencia'>El suscrito medico certifica haber examinado clinicamente al niño(a): "+$("#txtNomCompletoPaciete").val()+".Quien asistio a consulta medica</div> <tr><td><textarea id='txt_asistencia' cols='70' rows='2'></textarea></td></tr> <tr><td><div id='TextohoraAsistencia'>El dia de Hoy a las:</div><div id='Textohora'>horas.</div></td></tr> </td></tr> <tr><td colspan='2'><input type='button' class='btn btn-primary' onclick='ImpCertificadoAsistencia()' value='Imprimir'/></td></tr> </table>");	
}
// fin de la funcion para certificado de asistencia

//funcion para editar el motivo de consulta
function EditarMotivo()
{
	$("#txtMotivoCo").removeAttr("readonly");
	$("#bntModMotivoCo").show();
	$("#EditarMotivoCo").hide();
}
//fin de funcion para edita el motivo de consulta

//funcion para editar la parte de enfermedad actual
function EditarEnfermedadActual()
{
	$("#txtEnfermedadAc").removeAttr("readonly");
	$("#bntEnfeActual").show();
	$("#EditarEnfeAc").hide();
}
//fin funcion para editar la parte de enfermedad actual

//funcion para modificar el motivo de consulta
function ModificarMotivoConsulta(cod)
{
	$.ajax({
			url:'Procesar.php?accion=UpdateMotivoCo&CodigoMo='+cod+'&MotivoConsulta='+$("#txtMotivoCo").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				//$("#RespConsulta").html(res);
				LoadaMotivoConsultaLoad();
			},
			error:function()
			{
				$("#RespConsulta").html("error al cargar");
			}
		});
}
//fin funcion para modificar el motivo de consulta

 //funcion para modificar la enfermedad actual 
 function ModificarEnfermedadAc(cod)
 {
	 $.ajax({
			url:'Procesar.php?accion=UpdateEnfermedadAc&CodigoEnAc='+cod+'&EnfermedadActual='+$("#txtEnfermedadAc").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				//$("#RespConsulta").html(res);
				LoadEnefermedadConsultaLoad();
			},
			error:function()
			{
				$("#RespConsulta").html("error al cargar");
			}
		});
 }
 //fin funcion para modificar la enfermedad actual

// inicio la fincio imprimir certificado asisyencia
function ImpCertificadoAsistencia()
{
	
	assistencia=$("#TextoParaCertificadoAsistencia").html()+"  "+$("#txt_asistencia").val()+"  "+$("#TextohoraAsistencia").html();
	asistencia2=$("#Textohora").html();
	$( "#ImpAreaParaCertificadoAsistencia" ).attr("title","Certificado de Asistecia");
	$( "#ImpAreaParaCertificadoAsistencia" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:900,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

$( "#ImpAreaParaCertificadoAsistencia" ).dialog( "open" );
$( "#ImpAreaParaCertificadoAsistencia" ).html("<object type='text/html' data='../Reportes/CertificadosG5.php?otros2="+assistencia+"&otros3="+asistencia2+"'></object>");	
}
// fin de la funcion para imprimir el certificado asistencia

// inicio certificado de cuidado
function CertificadoCuidado()
{
	$("#AreaParaCertificadoCuidado").attr("title","Certificado de Cuidado");
	$( "#AreaParaCertificadoCuidado" ).dialog({
			autoOpen: false,
			modal: true,
			height:450,
			width:750,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
		$( "#AreaParaCertificadoCuidado" ).dialog( "open" );	
	$( "#AreaParaCertificadoCuidado" ).html("<table><tr><td>Ingrese los dias de reposo: </td><td><input type='text' onkeyup='mostrarFechaReposo()' id='txtDias321'/></td><tr></table> <table> <tr> <td colspan='2'><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td><div id='TextoParaCertificadocuidado'>El suscrito medico certifica haber examinado clinicamente al niño(a): "+$("#txtNomCompletoPaciete").val()+". Quien Presenta:</div><div id='TextoParaRequiere'>Y requiere el cuidado de</div> <tr><td><textarea id='txt_cuidado' cols='100' rows='1'></textarea></td></tr> <tr><td><div id='TextIndicacion'>Por indicacion medica desde:</div><div id='Diasreposo'></div></td></tr> </td></tr> <tr><td colspan='2'><input type='button' class='btn btn-primary' onclick='ImpCertificadoCuidado()' value='Imprimir'/></td></tr> </table>");	
}

function ImpCertificadoCuidado()
{
	if($("#Diasreposo").html()!="")
	{
		turno=$("#imagenes123").val();
		texto=$("#TextoParaCertificadocuidado").html();
		codtuno=$("#TextoParaRequiere").html()+" "+$("#txt_cuidado").val()+" "+$("#TextIndicacion").html()+$("#Diasreposo").html();
		$( "#ImpAreaParaCertificadoCuidado" ).attr("title","Certificado de Cuidado");
		$( "#ImpAreaParaCertificadoCuidado" ).dialog({
				autoOpen: false,
				modal: true,
				height:700,
				width:900,
				show: {
					effect: "blind",
					duration: 1000
				},
				hide: {
					effect: "explode",
					duration: 1000
				}
			});
	
	$( "#ImpAreaParaCertificadoCuidado" ).dialog( "open" );
	$( "#ImpAreaParaCertificadoCuidado" ).html("<object type='text/html' data='../Reportes/CertificadosG7.php?Otros1="+texto+"&codTurn="+codtuno+"&Turno3="+turno+"'></object>");				
	}
	else
	{
		alert("Llene los dias de reposo para continar");
	}
}

// fin del certificado de cuidado



function EnfermedaReposo(){

	$("#AreaParaCertificadoEneferemedadYSalud").attr("title","Certificado de enfermedad y reposo");
	$( "#AreaParaCertificadoEneferemedadYSalud" ).dialog({
			autoOpen: false,
			modal: true,
			height:300,
			width:750,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreaParaCertificadoEneferemedadYSalud" ).dialog( "open" );	
	$( "#AreaParaCertificadoEneferemedadYSalud" ).html("<table><tr><td>Ingrese los dias de reposo: </td><td><input type='text' onkeyup='mostrarFechaReposo()' id='txtDias321'/></td><tr></table><table><tr> <td colspan='2'><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td><div id='TextoParaCertificadoEnefermedadreposo'>El suscrito medico certifica haber examinado clinicamente a el paciente: "+$("#txtNomCompletoPaciete").val()+" Quien presenta: .y requiere de reposo por indicacion medica desde: </div> <div id='Diasreposo'></div>  </td><td></td></tr><tr><td colspan='2'><input type='button' class='btn btn-primary' onclick='ImpCertificadoEnfermedadReposo()' value='Imprimir'/></td></tr> </table>");		
}
function ImpCertificadoEnfermedadReposo()
{
	if($("#Diasreposo").html()!="")
	{
		codtuno=$("#imagenes123").val();
		texto=$("#TextoParaCertificadoEnefermedadreposo").html()+$("#Diasreposo").html();
		$( "#ImpAreaParaCertificadoEneferemedadYSalud" ).attr("title","Certificado de enfermedad y reposo");
		$( "#ImpAreaParaCertificadoEneferemedadYSalud" ).dialog({
				autoOpen: false,
				modal: true,
				height:700,
				width:800,
				show: {
					effect: "blind",
					duration: 1000
				},
				hide: {
					effect: "explode",
					duration: 1000
				}
			});
	
	$( "#ImpAreaParaCertificadoEneferemedadYSalud" ).dialog( "open" );
	$( "#ImpAreaParaCertificadoEneferemedadYSalud" ).html("<object type='text/html' data='../Reportes/CertificadosG6.php?Otros1="+texto+"&codTurn="+codtuno+"'></object>");				
	}
	else
	{
		alert("Llene los dias de reposo para continar");
	}
}
//fin funcion para certificado de enfermedad y reposo
//inicio de la funcion que guarda la consulta
function SaveConsulta()
{
	//alert($("#codigoTurno123").val() +" "+$("#txtCodCie10").val()+" "+$("#txtCodigoVade").val()+ " "+$("#txtCantidaMedi").val()+" "+$("#txtDosis").val()+" "+$("#cmbViaAdm").val()+" "+$("#cmbFrecu").val()+" "+$("#cmbHora").val());

if($("#txtCodCie10").val()!="" & $("#txtCodCie10").val()!=null)
{
		$.ajax({
			url:'Procesar.php?accion=SaveConsulta&CodTurnoFenix123='+$('#CajaOcultaFenixTurno').val()+'&codCie10='+$("#txtCodCie10").val()+'&vademe='+$("#txtCodigoVade").val()+'&nombrecomer='+$("#txtNombrComer").val()+'&Cantidad='+$("#txtCantidaMedi").val()+'&Dosis='+$("#txtDosis").val()+'&ViaAdmin='+$("#cmbViaAdm").val()+'&Frecuen='+$("#cmbFrecu").val()+'&Hora='+$("#cmbHora").val()+'&numeroDsm='+$("#txtNumeroDiSeMe").val()+'&TratamietoF='+$("#txtTratamieto").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RespConsulta").html(res);
			},
			error:function()
			{
				$("#RespConsulta").html("error al cargar");
			}
		});	
	
	$("#codigoTurno123").attr("value","");
	//$("#txtCodCie10").attr("value","");
	$("#txtCodigoVade").attr("value","");
	$("#txtNombrComer").attr("value","");
	$("#txtCantidaMedi").attr("value","");
	$("#txtDosis").attr("value","");
	$("#cmbViaAdm").attr("value","");
	$("#cmbFrecu").attr("value","");					
	$("#cmbHora").attr("value","");		
	$("#txtNumeroDiSeMe").attr("value","");		
	$("#txtDiagnosti").attr("value","");
	$("#txtTratamieto").attr("value","");
}
else
{
	alert("Seleccione un diagnostico");
}
}
//fin de la funcion que guara la consulta
//inicio function para el certificado de cirugia
function CertificadoCirugia()
{
	$("#AreaParaCertificadoCirugia").attr("title","Certificado de cirugia");
	$( "#AreaParaCertificadoCirugia" ).dialog({
			autoOpen: false,
			modal: true,
			height:300,
			width:750,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreaParaCertificadoCirugia" ).dialog( "open" );	
	$( "#AreaParaCertificadoCirugia" ).html("<table> <tr> <td colspan='2'><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td><div id='TextoParaCertificadoCirugia'>El suscrito medico certifica haber examinado clinicamente a el paciente: "+$("#txtNomCompletoPaciete").val()+".Quien se encuentra en buen estado de salud y no tiene contraindicacion para cirugia</div> </td><td></td></tr><tr><td colspan='2'><input type='button' class='btn btn-primary' onclick='ImpCertificadoCirugia()' value='Imprimir'/></td></tr> </table>");	
}
function ImpCertificadoCirugia()
{
	$( "#ImpAreaParaCertificadoCirugia" ).attr("title","Certificado de cirugia");
	$( "#ImpAreaParaCertificadoCirugia" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

$( "#ImpAreaParaCertificadoCirugia" ).dialog( "open" );
$( "#ImpAreaParaCertificadoCirugia" ).html("<object type='text/html' data='../Reportes/CertificadosG4.php?Otros1="+$("#TextoParaCertificadoCirugia").html()+"'></object>");	
}
//fin funcion para el certificado de cirugia
//inicio funcion para el certificado de salud y vacunacion
function CertificadoSaludVacunacion()
{
	$("#AreaParaCertificadoSaludVacunacion").attr("title","Certificado de Salud y vacunacion");
	$( "#AreaParaCertificadoSaludVacunacion" ).dialog({
			autoOpen: false,
			modal: true,
			height:300,
			width:750,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreaParaCertificadoSaludVacunacion" ).dialog( "open" );	
	$( "#AreaParaCertificadoSaludVacunacion" ).html("<table> <tr> <td colspan='2'><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td><div id='TextoParaCertificadoSaludYVAcunacion'>El suscrito medico certifica haber examinado clinicamente a el paciente: "+$("#txtNomCompletoPaciete").val()+".Quien se encuentra en buen estado de salud y tiene completo el esquema de vacunas para la edad</div> </td><td></td></tr><tr><td colspan='2'><input type='button' class='btn btn-primary' onclick='ImpCertificadoSaludVacunacion()' value='Imprimir'/></td></tr> </table>");	
}
function ImpCertificadoSaludVacunacion()
{
	$( "#ImpAreaParaCertificadoSaludVacunacion" ).attr("title","Certificado de Salud y vacunacion");
	$( "#ImpAreaParaCertificadoSaludVacunacion" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

$( "#ImpAreaParaCertificadoSaludVacunacion" ).dialog( "open" );
$( "#ImpAreaParaCertificadoSaludVacunacion" ).html("<object type='text/html' data='../Reportes/CertificadosG3.php?Otros1="+$("#TextoParaCertificadoSaludYVAcunacion").html()+"'></object>");	
}
//fin funcion para el certificado de salud y vacunacion
//inicio funcion para el certificado de consentimiento informado
function ConsentimientoInfo()
{
	$("#AreaParaCertificadoConsentimientoInfo").attr("title","Certificado de Consentimiento Informado");
	$( "#AreaParaCertificadoConsentimientoInfo" ).dialog({
			autoOpen: false,
			modal: true,
			height:770,
			width:656,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreaParaCertificadoConsentimientoInfo" ).dialog( "open" );	
	$( "#AreaParaCertificadoConsentimientoInfo" ).html("<table width='612' class='table table-border'> <tr> <td colspan='2'><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td colspan='2'><center><h4>FORMULARIO DE EXPLICACIÓN Y AUTORIZACIÓN DE TRATAMIENTO MÉDICO</h4></center></td> </tr> <tr> <td width='279'><div id='TextoParaCertificadoConsentimientoInfo' style='text-decoration:underline'>"+$("#txtNomCompletoPaciete").val()+"</div></td> <td width='317'><div id='areanumhisc'>_____________</div></td> </tr> <tr> <td><div id='lblNombreDelPaciente'>Nombre del Paciente.</div></td> <td> <div id='lblNumHistoriaClinica'>Numero de Historia Clinica.</div></td> </tr> <tr> <td colspan='2'>&nbsp;</td> </tr> <tr> <td>Diagnóstico.</td> <td><textarea  id='txtDiagnosticoC' cols='50' rows='2'></textarea></td> </tr> <tr> <td>Tratamiento Planificado.</td> <td><textarea  id='txtTraPlanificadoC' cols='50' rows='2'></textarea></td> </tr> <tr> <td>Beneficios del Tratamiento. </td> <td><textarea  id='txtBeneficiosC' cols='50' rows='2'></textarea></td> </tr> <tr> <td>Riesgos:</td> <td><textarea  id='txtRiesgosC' cols='50' rows='4'></textarea></td> </tr> <tr> <td colspan='2'>&nbsp;</td> </tr> <tr> <td colspan='2' align='justify'> <div id='txtEstandar33'>Todo procedimiento médico no esta exento de riesgo. Autorizo a mi médico u otro especialista para realizar los procedimientos necesarios o interconsultas si las circunstancias lo ameritan, asi como la toma de fotos  y la filiación con fines docentes.</div></td> </tr> <tr> <td colspan='2'>&nbsp;</td> </tr> <tr> <td>Quito</td> <td align='center'> <div id='areaFirmaFamiliaroResponsable'>_____________________________________</div></td> </tr> <tr> <td>&nbsp;</td> <td align='center'><div id='lblFirmaFamoRepresentante'>Firma del Familiar Responsable o Representante</div></td> </tr> <tr> <td colspan='2'>&nbsp;</td> </tr> <tr> <td align='center'><div id='areaFimraMedicoTratante'>________________________________</div></td> <td align='center'><div id='areaFrimaDelTestigo'>________________________________</div></td> </tr> <tr> <td align='center'><div id='lblFrimaMedicoTratante'>Firma del Médico Tratante </div></td> <td align='center'><div id='lblFirmaTestigo'>Firma del Testigo</div></td> </tr> <tr> <td colspan='2'>&nbsp;</td> </tr> <tr> <td colspan='2' align='center'><input type='button' class='btn btn-primary' onclick='ImpCertificadoConsentimientoInformado()' value='Imprimir'/></td> </tr> </table>");
}
function ImpCertificadoConsentimientoInformado()
{
	certificadoCI=$("#TextoParaCertificadoConsentimientoInfo").html()+$("#txtDiagnosticoC").val()+$("#txtTraPlanificadoC").val()+$("#txtBeneficiosC").val()+$("#txtRiesgosC").val()+$("#txtEstandar33").html()+$("#areanumhisc").html+$("#lblNombreDelPaciente").html+$("#lblNumHistoriaClinica").html+$("#lblNumHistoriaClinica").html+$("#areaFirmaFamiliaroResponsable").html+$("#lblFirmaFamoRepresentante").html+$("#areaFimraMedicoTratante").html+$("#areaFrimaDelTestigo").html+$("#lblFrimaMedicoTratante").html+$("#lblFirmaTestigo").html;
	
	$( "#ImpAreaParaCertificadoConsentimientoInfo" ).attr("title","Certificado de Consentimiento Informado");
	$( "#ImpAreaParaCertificadoConsentimientoInfo" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

$( "#ImpAreaParaCertificadoConsentimientoInfo" ).dialog( "open" );
$( "#ImpAreaParaCertificadoConsentimientoInfo" ).html("<object type='text/html' data='../Reportes/CertificadosCI.php?Otros1="+$("#TextoParaCertificadoConsentimientoInfo").html()+"&Otros2="+$("#txtDiagnosticoC").val()+"&Otros3="+$("#txtTraPlanificadoC").val()+"&Otros4="+$("#txtBeneficiosC").val()+"&Otros5="+$("#txtRiesgosC").val()+"&Otros6="+$("#txtEstandar33").html()+"&HistPac="+$("#codigoPaciente").val()+"'></object>");
}
//fin funcion para el certificado de consentimiento informado
//inicio de certificados de otros
function CertificadoOtros()
{
	
	$( "#AreaCertificados" ).attr("title","Certificado Otros");
	$( "#AreaCertificados" ).dialog({
			autoOpen: false,
			modal: true,
			height:300,
			width:750,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});

		$( "#AreaCertificados" ).dialog( "open" );
		//aqui esta el div para capturaora el texto a imprimir en el certidicado de otros es: 	TextoParaCertificadoOtros
		$("#ContenidoCertificados").html("<center><table> <tr> <td><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td><label for='txtcertificadootros'></label> <textarea name='txtcertificadootros' style='width:600px;' id='txtcertificadootros' cols='200' rows='3'></textarea></td> </tr> <tr> <td><center><input type='button' class='btn btn-primary' onclick='ImpCertificadoOtros()' value='Imprimir' /></center></td> </tr> </table></center>");
}
function ImpCertificadoOtros()
{
	$( "#AreaImpOtros" ).attr("title","Certificado otros");
	$( "#AreaImpOtros" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

$( "#AreaImpOtros" ).dialog( "open" );
$( "#AreaImpOtros" ).html("<object type='text/html' data='../Reportes/CertificadosG1.php?Otros1="+$("#txtcertificadootros").val()+"'></object>");	
}
//fin de certificados de otros
//inicio funcio para certidicado salud
function CertificadoSalud()
{
	$("#AreaCertificadoSalud").attr("title","Certificado Salud");
	$( "#AreaCertificadoSalud" ).dialog({
			autoOpen: false,
			modal: true,
			height:300,
			width:750,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreaCertificadoSalud" ).dialog( "open" );	
	$( "#AreaCertificadoSalud" ).html("<table> <tr> <td colspan='2'><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td><div id='TextoParaCertificadoOtros'>El suscrito medico certifica haber examinado clinicamente a el paciente: "+$("#txtNomCompletoPaciete").val()+".Quien se encuentra en buen estado de salud y no presenta patologia infecciosa</div> </td><td></td></tr><tr><td colspan='2'><input type='button' class='btn btn-primary' onclick='ImpCertificadoSalud()' value='Imprimir'/></td></tr> </table>");
}
function ImpCertificadoSalud()
{
	$( "#AraImpCertificadoSalud" ).attr("title","Certificado Salud");
	$( "#AraImpCertificadoSalud" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

$( "#AraImpCertificadoSalud" ).dialog( "open" );
$( "#AraImpCertificadoSalud" ).html("<object type='text/html' data='../Reportes/CertificadosG2.php?Otros1="+$("#TextoParaCertificadoOtros").html()+"'></object>");	
}
//fin funcio para certidicado salud
function FirstTurno()
{
	if($('#txtFechaProx').val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=HorarioConsutaDoc&FechaPoxima='+$('#txtFechaProx').val()+'&CodigoForma='+1,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreaHorario").html(res);
			},
			error:function()
			{
				$("#AreaHorario").html("error al cargar");
			}
		});		
	}
	else
	{
		alert("Seleccione una fecha para la proxima consulta");
	}
}
function GenerarTurnoPacienteXDoctor()
{
				$.ajax({
					url:'Procesar.php?accion=AsignarTurnoXDoctor&Paciente12='+$('#txtCodpac').val()+'&fechaProx12='+$("#txtFechaProx").val()+'&hora12='+$("#cmb_horas").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreaHorario").html(res);
					},
					error:function()
					{
						$("#AreaHorario").html("error al cargar");
					}
				});			
}
function AsFarma(farmaco, turno)
{

	if($("#txtCodCons").val()!=null )
	{
	$( "#FormulatioDeCantFarmacos" ).dialog({
			autoOpen: false,
			modal: true,
			height:180,
			width:300,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#FormulatioDeCantFarmacos" ).dialog( "open" );
		$( "#FormulatioDeCantFarmacos" ).html("<table><tr><td>Cantidad</td><td><input type='text' id='txtCantFar'/></td></tr><tr><td>Indicaciones</td><td><textarea  id='txtIndica' cols='18' rows='2'></textarea></td></tr><tr><td colspan><input type='button' id='bntAddFarmaco' value='Agregar'></td></tr></table>");
		$("#bntAddFarmaco").button();
		$("#bntAddFarmaco").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=RecetaConsulta&CodMedicamento='+farmaco+'&CodConsulta='+$("#txtCodCons").val()+'&indicaciones='+$("#txtIndica").val()+'&cantidad='+$("#txtCantFar").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#RespuestaRectaDadaPorDoctor").html(res);
				},
				error:function()
				{
					$("#RespuestaRectaDadaPorDoctor").html("error al cargar");
				}
				
			});			
			$( "#FormulatioDeCantFarmacos" ).dialog( "close" );
		});
	}
	else
	{
		alert("Primero guarder el diagnostico para poder recetars");
	}
}
function ImprimirReceta(codigo)
{
	$( "#ImprimirRecetaParaPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#ImprimirRecetaParaPaciente" ).dialog( "open" );	
		$( "#ImprimirRecetaParaPaciente" ).html("<object type='text/html' data='../Reportes/Receta.php?id="+codigo+"'></object>");		
}
function BuscarHistoriaPaciente()
{
	$( "#HistoriaClinica" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#HistoriaClinica" ).dialog( "open" );		
		$("#FrmBuscar").html("Buscar:<select id='SearchFor'><option value=''>--Seleccione--</option><option value='ced'>Cédula</option><option value='ape'>Apellido</option></select><div class='input-append'><input type='text' id='txtBuscar' onkeyup='BuscarPacientePAraVerHistoria()' /><spand class='add-on'><span class='icon-eye-open'></span></spand> </div>");
		
		
	/*	$("#bntBuscaCedulaPac").click(function()
		{
			$( "#RespuesraHistoria" ).html("<object type='text/html' data='../Reportes/HistoriaCli.php?id="+$("#txtBuscarCedula").val()+"'></object>");					
		});*/
}
function BuscarPacientePAraVerHistoria()
{
	if($("#txtBuscar").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPaciente&buscar='+$("#txtBuscar").val()+'&por='+$("#SearchFor").val()+'&CodigoRol='+5,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RespuesraHistoria").html(res);
			},
			error:function()
			{
				$("#RespuesraHistoria").html("error al cargar");
			}
		});
			
	}else{
		$("#RespuesraHistoria").html("");
	}
}

//inicio de la funcio par un nuevo paciente
function NuevoPaciente()
{
	$( "#NewPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:760,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#NewPaciente" ).dialog( "open" );
		$("#RespuestaNewPaciente").html("<table><tr><td>Cédula:</td><td><input type='text' id='txtcedulaUsu1' /></td></tr><tr><td>Pasaporte:</td><td><input type='text' id='txtPasport' /></td></tr><tr><td>Apellidos:</td> <td><input type='text' id='txtapellidoUsu1' /></td></tr><tr><td>Nombres:</td><td><input type='text' id='txtnombresUsu1'  /></td></tr><tr><td>Otro:</td><td><textarea id='txtOtro' cols='40' rows='2'></textarea></td></tr></tr><tr><td>Fecha de Nacimiento:</td><td><input type='text' id='txtEdadUsu1'   /><td><input type='text' id='TxtEdad123'/></tr><tr><td>Lugar de Nacimiento:</td><td><input type='text' id='txtLugnacim' /><td></tr><tr><td>Lugar de Residencia:</td><td><input type='text' id='txtLugres' /></td></tr><tr><td>Sexo:</td><td><select id='txtSex'><option value=''>--Seleccione--</option><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select></td></tr><tr><td>Raza:</td><td><input type='text' id='txtRaza' /></td><tr><td>Religión:</td><td><input type='text' id='txtReligion' /></td></tr></tr><tr><td>Estado civil:</td><td><select id='txtEstadociv'><option value=''>--Seleccione un estado civil--</option><option value='Solter@'>Solter@</option><option value='Casad@'>Casad@</option><option value='Divorciad@'>Divorciad@</option><option value='Viud@'>Viud@</option></select></td></tr><tr><td>Instrucción:</td><td><input type='text' id='txtInstr' /></td></tr><tr><td>Profesión:</td><td><input type='text' id='txtProf' /></td></tr><tr><td>Ocupación:</td><td><input type='text' id='txtOcupe' /></td></tr><tr><td>Condición del paciente:</td><td><select id='txtCondpac'><option value=''>--Seleccione una condición--</option><option value='Convenio'>Convenio</option><option value='Empresa'>Empresa</option><option value='Particular'>Particular</option></select></td></tr><tr><td>Dirección:</td><td><input type='text' id='txtdireccionUsu1'  /></td></tr><tr><td>Teléfono Domicilio:</td><td><input type='text' id='txtTelef'></td><tr><td>Teléfono Trabajo:</td><td><input type='text' id='txtTelefTraba'></td></tr></tr><tr><td>Celular:</td><td><input type='text' id='txtCelular'></td><tr><td>Correo:</td><td><input type='text' id='txtCorreo'></td></tr></tr><tr><td>Referencia: </td><td><input type='text' id='txtNombresRefe'></td></tr><tr><td>Teléfono de Referencia:</td><td><input type='text' id='txtTelefonoRefe'></td></tr><tr><td colspan'2'><input type='button' id='bntSaveUsu1' onclick='SavePac()' class='btn btn-success' value='Guardar' /></td></tr>  </table>");
		 
	$("#txtcedulaUsu1").validarCedulaEC({
		  onValid: function () {
			console.log(this);
		//	$("#bntSaveUsu1").removeAttr("disabled");	
			$("#txtcedulaUsu1").css("background","green");
		},
        onInvalid: function () {
          console.log(this);
          window.alert("cédula inválida.");
		  $("#txtcedulaUsu1").css("background","red");
		 // $("#bntSaveUsu1").attr("disabled","true");	
        }
      });
		$("#bntSaveUsu1").button();
		
			$('#txtEdadUsu1').datepicker({
				changeMonth: true,
				changeYear: true,
				 onSelect:function()
				 {
					 setTimeout(function(){Calcular()},500);
				 }
			});
			$('#txtEdadUsu1').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );
			$('#txtEdadUsu1').datepicker( 'option', 'yearRange', '-99:+0' );		
			//$('#txtEdadUsu1').datepicker('setDate', '1950-01-01');
		
		//validando campos de texto
		$("#txtapellidoUsu1").alpha({allow:" "}); //restringe todos los numeros y algunos caracteres especiales menos el espacio
		$("#txtnombresUsu1").alpha({allow:" "});
		$("#txtEdadUsu1").numeric();	//restringe letras
		//$("#txtSangre").alpha({allow:"+-"});
		$("#txtNombresFAOC").alpha({allow:" "});		
		$("#txtTelefonoFAOC").numeric();
		
}
//fin de la funcio par un nuevo paciente
//funcion para calculara la edad
function Calcular()
{
	/*
	$("#TxtEdad123").attr("value","");
	var fec=$("#txtEdadUsu1").val();
	var year=fec.substring(0,4);
	var mont=fec.substring(5,7);
	var day=fec.substring(8,10);
	
	
	var dt=day;
	var month=mont;
	var year=year;
	var curdate = new Date();
	var dob = new Date(year,month-1,dt);
	var diff = curdate.getTime()-dob.getTime();
	
	var nextdob = new Date();
	nextdob.setMonth(month-1);
	nextdob.setDate(dt);
	if(curdate.getMonth()>dob.getMonth()){
		nextdob.setYear(nextdob.getFullYear()+1);
	}
	var nextdob_date=nextdob.getTime()-curdate.getTime();
	var yy1 = curdate.getFullYear(), mm1 = curdate.getMonth(), dd1 = curdate.getDate(),
	 yy2 = dob.getFullYear(), mm2 = dob.getMonth(), dd2 = dob.getDate();
	 var dm1=0;
    if (dd1 < dd2) {
        mm1--;
        dm1 += DaysInMonth(yy2, mm2);
    }
    if (mm1 < mm2) {
        yy1--;
        mm1 += 12;
    }
	$("#TxtEdad123").val((yy1-yy2)+" Años, "+(mm1-mm2)+" Meses, Y "+(dd1-dd2)+" Dias");
	*/
	$.get("Procesar.php?accion=CalcularEdadPhp&Fecha123="+$("#txtEdadUsu1").val(), function(data) {
	  $( "#TxtEdad123" ).val(data);
	});	
	
}

//fin de la funcion para calucluar la edad del paciente






function SavePac()
{
			if( $('#txtapellidoUsu1').val()!="" & $('#txtnombresUsu1').val()!="" )
			{
				$.ajax({
					url:'Procesar.php?accion=NewPaciente&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#RespuestaNewPaciente").html(res);
					},
					error:function()
					{
						$("#RespuestaNewPaciente").html("error al cargar");
					}
				});	
			}
			else
			{
				alert("Llene todos los campos");
			}

}
function ImprimirTurno(codigo)
{
	$( "#FormularioDeImpresionTurno" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:700,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#FormularioDeImpresionTurno" ).dialog( "open" );
	$( "#FormularioDeImpresionTurno" ).html("<object type='text/html' data='../Reportes/Turno.php?id="+codigo+"'></object>");
	
}
function modal2()
{

		if($("#txtSistema").val()==1)
		{
			$( "#Modal2" ).attr("title","Revision actual del sistema");
			$( "#Modal2" ).dialog({
					autoOpen: false,
					modal: true,
					height:600,
					width:500,
					show: {
						effect: "blind",
						duration: 1000
					},
					hide: {
						effect: "explode",
						duration: 1000
					}
				});

		$( "#Modal2" ).dialog( "open" );
		
				$.ajax({
					url:'Procesar.php?accion=SistemaHabitos&CodigoPaciente312='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#Modal2").html(res);
					},
					error:function()
					{
						$("#Modal2").html("error al cargar");
					}
				});
		
/*			$( "#Modal2" ).html("<table><tr><td colspan='2' align='center'>Formulario de Hábitos del Paciente.</tr><tr><td></td></tr><tr><td>Tabaco: </td><td><input type='text' id='txtTabaco' /></td></tr><tr><td>Alcohol: </td><td><input type='text' id='txtAlcohol'/></td></tr><tr><td>Drogas: </td><td><input type='text' id='txtDrogas' /></td></tr><tr><td>Medicamentos (los que tome continuamente)</td><td><input type='text' id='txtMedicamentos'/></td></tr><tr><td>Ejercicio: </td><td><input type='text' id='txtEjercicio' /></td></tr><tr><td>Tipo de Dieta: </td><td><input type='text' id='txtDieta' /></td></tr><tr><td>Vacunas: </td><td><input type='text' id='txtVacunas' /></td><tr><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr></tr><tr><td colspan='2' align='center'><input type='button' class='btn btn-primary' id='bntExitHab' value='Guaradar y Salir' onclick='ExitHabitos()' />  &nbsp;&nbsp;&nbsp;</td></tr></table>");*/
		}
		else
		{
			$( "#AreaParaRevisionSistema2" ).attr("title","Revision actual del sistema");
			$( "#AreaParaRevisionSistema2" ).dialog({
					autoOpen: false,
					modal: true,
					height:560,
					width:500,
					show: {
						effect: "blind",
						duration: 1000
					},
					hide: {
						effect: "explode",
						duration: 1000
					}
				});
			$( "#AreaParaRevisionSistema2" ).dialog( "open" );
				$.ajax({
					url:'Procesar.php?accion=SistemaLoad&CodigoPaciente312='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreaParaRevisionSistema2").html(res);
					},
					error:function()
					{
						$("#AreaParaRevisionSistema2").html("error al cargar");
					}
				});
				/*			
			$( "#AreaParaRevisionSistema2" ).html("<table><tr><td>Auditivo: </td><td><textarea id='txtAuditivo' cols='40' rows='2'></textarea></td></tr><tr><td>Oftalmológico: </td><td><textarea id='txtOftalmo' cols='40' rows='2'></textarea></td></tr><tr><td>Otorrinolaringológicos: </td><td><textarea id='txtOtorrino' cols='40' rows='2'></textarea></td></tr><tr><td>Nervios Craneales: </td><td><textarea id='txtNervios' cols='40' rows='2'></textarea></td></tr><tr><td>Digestivo: </td><td><textarea id='txtDigest' cols='40' rows='2'></textarea></td></tr><tr><td>Renal: </td><td><textarea id='txtRenal' cols='40' rows='2'></textarea></td></tr><tr><td>Pulmonar: </td><td><textarea id='txtPulmonar' cols='40' rows='2'></textarea></td></tr><tr><td>Cardiovascular: </td><td><textarea id='txtCardio' cols='40' rows='2'></textarea></td></tr><tr><td>Oseo: </td><td><textarea id='txtOseo' cols='40' rows='2'></textarea></td></tr><tr><td>Gineco Obstétrico: </td><td><textarea id='txtGinecoObs' cols='40' rows='2'></textarea></td></tr><tr><td>Otros: </td><td><textarea id='txtOtros' cols='40' rows='2'></textarea></td></tr><tr><td>&nbsp;&nbsp;&nbsp;</td><td>&nbsp;&nbsp;&nbsp;</td></tr></tr><tr><td colspan='2' align='center'><input type='button' class='btn btn-primary' id='bntExitSys' value='Guaradar y Salir' onclick='ExitSistemas()' />  &nbsp;&nbsp;&nbsp;</td></tr></table>");*/
		}

}
function ExitHabitos()
{
				$.ajax({
					url:'Procesar.php?accion=SaveHabitosLight&CodigoPaciente567='+$("#codigoPaciente").val()+'&TabacoHa='+$("#txtTabaco").val()+'&AlcoholHab='+$("#txtAlcohol").val()+'&DrogasHab='+$("#txtDrogas").val()+'&MedicametoHab='+$("#txtMedicamentos").val()+'&EjercicioHab='+$("#txtEjercicio").val()+"&DietaHab="+$("#txtDieta").val()+'&VacunasHab='+$("#txtVacunas").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#Modal2").html(res);
					},
					error:function()
					{
						$("#Modal2").html("error al cargar");
					}
				});	
	$( "#Modal2" ).dialog( "close" );
	
}
function ExitSistemas()
{
				$.ajax({
					url:'Procesar.php?accion=SaveSistemaLight&CodigoPaciente741='+$("#codigoPaciente").val()+'&AuditivoSis='+$("#txtAuditivo").val()+'&OftalmologicoSis='+$("#txtOftalmo").val()+'&OtorrinoSis='+$("#txtOtorrino").val()+'&NerviosCraneSis='+$("#txtNervios").val()+'&DigestivoSis='+$("#txtDigest").val()+"&RenalSis="+$("#txtRenal").val()+'&PulmonarSis='+$("#txtPulmonar").val()+'&CardioSIs='+$("#txtCardio").val()+'&OseoSis='+$("#txtOseo").val()+'&GinecoObstSis='+$("#txtGinecoObs").val()+'&OtrosSis='+$("#txtOtros").val()+'&Endocrino='+$('#txtEndocrino').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#Modal2").html(res);
					},
					error:function()
					{
						$("#Modal2").html("error al cargar");
					}
				});		
		$( "#Modal2" ).dialog( "close" );				
	//$( "#AreaParaRevisionSistema2" ).dialog( "close" );
}

function Anamnesis()
{
	$( "#AreaAnanmesis" ).attr("title","Anamnesis");
	$( "#AreaAnanmesis" ).dialog({
			autoOpen: false,
			modal: true,
			height:800,
			width:825,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#AreaAnanmesis" ).dialog( "open" );	
				$.ajax({
					url:'Procesar.php?accion=GenerarAnamesisi&CodigoPaciente312='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreaAnanmesis").html(res);
					},
					error:function()
					{
						$("#AreaAnanmesis").html("error al cargar");
					}
				});
		
		
		/*$( "#AreaAnanmesis" ).html("<table><tr><td>Motivo de Consulta</td><td><textarea id='txtConsulta' cols='40' rows='2'></textarea></td></tr><tr><td>Enfermedad Actual</td><td><textarea id='txtEnfeAc' cols='40' rows='2'></textarea></td></tr><td>Revisión Actual de Sistemas: </td><td><select id='txtSistema' onchange='modal2()'><option>--Seleccione--</option><option value='1'>Hábitos</option><option value='2'>Sistemas</option></select></td></tr><tr><tr><td>Tipo de sangre:</td><td><select id='txtSangre'><option>Seleccione un tipo ..</option><option>A Rh Positivo</option><option>A Rh Negativo</option><option>B Rh Positivo</option><option>B Rh Negativo</option><option>AB Rh Positivo</option><option>AB Rh Negativo</option><option>O Rh Positivo</option><option>O Rh Negativo</option></select></td></tr><td>Antecedentes No Patológicos Personales</td><td><textarea id='txtAtePato' cols='40' rows='2'></textarea></td></tr><tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patológicos Personales</td></tr><tr><td>Alergias</td><td><textarea cols='40' rows='2' id='txtalergia'></textarea></td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalsculares'></textarea></td></tr><tr><td>Metabolicos</td><td><textarea cols='40' rows='2' id='txtMetabolicos'></textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciosos'></textarea></td></tr><tr><td>Neoplasias</td><td><textarea cols='40' rows='2' id='txtneoplasias'></textarea></td></tr><tr><td>EndoCronologicas</td><td><textarea cols='40' rows='2' id='txtendoCrono'></textarea></td></tr><tr><td>Pulmunares</td><td><textarea cols='40' rows='2' id='txtpulmunares'></textarea></td></tr><tr><td>Nefrologicas</td><td><textarea cols='40' rows='2' id='txtNefrologicas'></textarea></td></tr><tr><td>Hematologicas</td><td><textarea cols='40' rows='2' id='txthematologicas'></textarea></td></tr><tr><td>Esqueleticos</td><td><textarea cols='40' rows='2' id='txtesqueleticos'></textarea></td><tr><td>Inmunologicas</td><td><textarea cols='40' rows='2' id='txtInmunologicas'></textarea></td></tr></tr><tr><td>Ginecoobstetricos</td><td><textarea cols='40' rows='2' id='txtginecoobste'></textarea></td></tr><tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros'></textarea></td></tr></table></td></tr>    <tr><td colspan='2'><table><tr><td colspan='2'>Antecedentes Patologicos Familiares</td></tr><tr><td>Cardiovasculares</td><td><textarea cols='40' rows='2' id='txtCardiovalscularesFa'></textarea></td></tr><tr><td>Metabolicos</td><td><textarea cols='40' rows='2' id='txtMetabolicosFa'></textarea></td></tr><tr><td>Infecciosos</td><td><textarea cols='40' rows='2' id='txtinfecciososFa'></textarea></td></tr><tr><td>Neoplasias</td><td><textarea cols='40' rows='2' id='txtneoplasiasFa'></textarea></td></tr><tr><td>EndoCronologicas</td><td><textarea cols='40' rows='2' id='txtendoCronoFa'></textarea></td></tr><tr><td>Pulmunares</td><td><textarea cols='40' rows='2' id='txtpulmunaresFa'></textarea></td></tr><tr><td>Nefrologicos</td><td><textarea cols='40' rows='2' id='txtNefrologicasFa'></textarea></td></tr><tr><td>Hematologicas</td><td><textarea cols='40' rows='2' id='txthematologicasFa'></textarea></td></tr><tr><td>Esqueleticos</td><td><textarea cols='40' rows='2' id='txtesqueleticosFa'></textarea></td><tr><td>Inmunologicas</td><td><textarea cols='40' rows='2' id='txtInmunologicasFa'></textarea></td></tr></tr><tr><td>Otros</td><td><textarea cols='40' rows='2' id='txtotros3'></textarea></td><td>&nbsp;&nbsp;&nbsp;</td><td><input type='button' class='btn btn-primary' id='bntAnamnesis' value='Guardar Anamnesis' onclick='SaveTotalAnanmesis()' /></td></tr></td></tr></table>");*/
}



function SaveTotalAnanmesis()
{
	//if($("#txtTabaco").val()!=null & $("#txtAuditivo").val()!=null)
	//{

				$.ajax({
					url:'Procesar.php?accion=Anamnesis1&MotivoConsu='+$('#txtConsulta').val()+'&EnfActual='+$('#txtEnfeAc').val()+'&TipSangre='+$('#txtSangre').val()+'&PatoNoPersonales='+$('#txtAtePato').val()+'&Alergias='+$('#txtalergia').val()+'&Cardiovascu='+$('#txtCardiovalsculares').val()+'&Metabolico='+$('#txtMetabolicos').val()+'&Infecciosos='+$('#txtinfecciosos').val()+'&Neoplasia='+$('#txtneoplasias').val()+'&Endocrono='+$('#txtendoCrono').val()+'&Pulmonares='+$('#txtpulmunares').val()+'&Nefrologicas='+$('#txtNefrologicas').val()+'&Hematologica='+$('#txthematologicas').val()+'&Esqueleticos='+$('#txtesqueleticos').val()+'&Inmuno='+$('#txtInmunologicas').val()+'&Ginecoobstetr='+$('#txtginecoobste').val()+'&Otros2='+$('#txtotros').val()+'&Cardiovasfam='+$('#txtCardiovalscularesFa').val()+'&Metabolifam='+$('#txtMetabolicosFa').val()+'&Infecciososfam='+$('#txtinfecciososFa').val()+'&Neoplasfam='+$('#txtneoplasiasFa').val()+'&Endocronofam='+$('#txtendoCronoFa').val()+'&Pulmonaresfam='+$('#txtpulmunaresFa').val()+'&Nefrolofam='+$('#txtNefrologicasFa').val()+'&Hematolofam='+$('#txthematologicasFa').val()+'&Esqueletifam='+$('#txtesqueleticosFa').val()+'&Inmunolofam='+$('#txtInmunologicasFa').val()+'&Otros3='+$('#txtotros3').val()+'&Tabaco='+$('#txtTabaco').val()+'&Alcohol='+$('#txtAlcohol').val()+'&Drogas='+$('#txtDrogas').val()+'&Medicamentos='+$('#txtMedicamentos').val()+'&Ejercicio='+$('#txtEjercicio').val()+'&TipoDieta='+$('#txtDieta').val()+'&Vacunas='+$('#txtVacunas').val()+'&Auditivo='+$('#txtAuditivo').val()+'&Oftalmologico='+$('#txtOftalmo').val()+'&Otorrinolari='+$('#txtOtorrino').val()+'&NerviosCra='+$('#txtNervios').val()+'&Digestivo='+$('#txtDigest').val()+'&Renal='+$('#txtRenal').val()+'&Pulmonar='+$('#txtPulmonar').val()+'&Cardiovascular='+$('#txtCardio').val()+'&Oseo='+$('#txtOseo').val()+'&Ginecobs='+$('#txtGinecoObs').val()+'&Otros='+$('#txtOtros').val()+'&CodOculPac='+$('#codigoescondidoanam123').val()+'&CodigoTurnoLight='+$("#CajaOcultaFenixTurno").val()+'&Endocrino='+$('#txtEndocrino').val()+'&Gastroente='+$('#txtGastroe').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreaAnanmesis").html(res);
					},
					error:function()
					{
						$("#AreaAnanmesis").html("error al cargar");
					}
				});
				
				$("#Modal2").html(""); $("#AreaParaRevisionSistema2").html("");

				setTimeout(function (){
				LoadEnefermedadConsultaLoad();
				LoadaMotivoConsultaLoad();
					},1000);
					
					
	//}
	//else
	//{
	//	alert("Vea La Revisión Actual de Sistemas para poder guardar");
	//}
}


function LoadaMotivoConsultaLoad()
{
		$.ajax({
				url:'Procesar.php?accion=LoadMotivoConsulta',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#MotivoConsultaLoad").html(res);
				},
				error:function()
				{
					$("#MotivoConsultaLoad").html("error al cargar");
				}
			});	
}
function LoadEnefermedadConsultaLoad()
{
		$.ajax({
				url:'Procesar.php?accion=LoadEnefermedadConsultaLoad',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#EnfermedadAcutalLoad").html(res);
				},
				error:function()
				{
					$("#EnfermedadAcutalLoad").html("error al cargar");
				}
			});	
}


function UpdateAnamnesis()
{
	if($("#txtTabaco").val()!=null & $("#txtAuditivo").val()!=null)
	{
				$.ajax({
					url:'Procesar.php?accion=UpdateAnamnesis1&MotivoConsu='+$('#txtConsulta').val()+'&EnfActual='+$('#txtEnfeAc').val()+'&TipSangre='+$('#txtSangre').val()+'&PatoNoPersonales='+$('#txtAtePato').val()+'&Alergias='+$('#txtalergia').val()+'&Cardiovascu='+$('#txtCardiovalsculares').val()+'&Metabolico='+$('#txtMetabolicos').val()+'&Infecciosos='+$('#txtinfecciosos').val()+'&Neoplasia='+$('#txtneoplasias').val()+'&Endocrono='+$('#txtendoCrono').val()+'&Pulmonares='+$('#txtpulmunares').val()+'&Nefrologicas='+$('#txtNefrologicas').val()+'&Hematologica='+$('#txthematologicas').val()+'&Esqueleticos='+$('#txtesqueleticos').val()+'&Inmuno='+$('#txtInmunologicas').val()+'&Ginecoobstetr='+$('#txtginecoobste').val()+'&Otros2='+$('#txtotros').val()+'&Cardiovasfam='+$('#txtCardiovalscularesFa').val()+'&Metabolifam='+$('#txtMetabolicosFa').val()+'&Infecciososfam='+$('#txtinfecciososFa').val()+'&Neoplasfam='+$('#txtneoplasiasFa').val()+'&Endocronofam='+$('#txtendoCronoFa').val()+'&Pulmonaresfam='+$('#txtpulmunaresFa').val()+'&Nefrolofam='+$('#txtNefrologicasFa').val()+'&Hematolofam='+$('#txthematologicasFa').val()+'&Esqueletifam='+$('#txtesqueleticosFa').val()+'&Inmunolofam='+$('#txtInmunologicasFa').val()+'&Otros3='+$('#txtotros3').val()+'&Tabaco='+$('#txtTabaco').val()+'&Alcohol='+$('#txtAlcohol').val()+'&Drogas='+$('#txtDrogas').val()+'&Medicamentos='+$('#txtMedicamentos').val()+'&Ejercicio='+$('#txtEjercicio').val()+'&TipoDieta='+$('#txtDieta').val()+'&Vacunas='+$('#txtVacunas').val()+'&Auditivo='+$('#txtAuditivo').val()+'&Oftalmologico='+$('#txtOftalmo').val()+'&Otorrinolari='+$('#txtOtorrino').val()+'&NerviosCra='+$('#txtNervios').val()+'&Digestivo='+$('#txtDigest').val()+'&Renal='+$('#txtRenal').val()+'&Pulmonar='+$('#txtPulmonar').val()+'&Cardiovascular='+$('#txtCardio').val()+'&Oseo='+$('#txtOseo').val()+'&Ginecobs='+$('#txtGinecoObs').val()+'&Otros='+$('#txtOtros').val()+'&CodOculPac='+$('#codigoescondidoanam123').val()+'&CodigoPacieten789='+$("#codigoPaciente").val()+'&Endocrino='+$('#txtEndocrino').val()+'&Gastroente='+$('#txtGastroe').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreaAnanmesis").html(res);
					},
					error:function()
					{
						$("#AreaAnanmesis").html("error al cargar");
					}
				});	
	}
	else
	{
		alert("Vea La Revisión Actual de Sistemas para poder guardar");
	}
}
/*function SaveTotalAnanmesis()
{
	alert($("#txtTabaco").val() + " "+ $("#txtAlcohol").val()+ " "+ $("#txtDrogas").val()+ " "+ $("#txtMedicamentos").val()+ " "+ $("#txtEjercicio").val()+ " "+ $("#txtDieta").val()+ " "+ $("#txtVacunas").val() + "  segundo formulario "+ $("#txtAuditivo").val()+ " "+$("#txtOftalmo").val() + " "+$("#txtOtorrino").val()+ " "+$("#txtNervios").val() + " "+$("#txtDigest").val()+ " "+$("#txtRenal").val()+ " "+$("#txtPulmonar").val()+ " "+$("#txtCardio").val()+ " "+$("#txtOseo").val()+ " "+$("#txtGinecoObs").val()+ " "+$("#txtOtros").val());
}*/
function Alerta()
{
	$( "#alert" ).attr("title","Alertas");
	$( "#alert" ).dialog({
			autoOpen: false,
			modal: true,
			height:210,
			width:445,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#alert" ).dialog( "open" );
		$( "#alert").html("<table><tr><td><textarea  id='txtAlerta' style='width:400px' cols='100' rows='2'></textarea></td> </tr><tr><td colspan='4' align='center'><input type='button' class='btn' id='btn_alerta' value='Guardar' onclick='RegistrarAlerta()'/></td></tr> </table>");
}
function RegistrarAlerta()
{
	$.ajax({
				url:'Procesar.php?accion=savealerta&codigopac='+$("#codigoPaciente").val()+'&alerta='+$("#txtAlerta").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#arealerta").html(res);
					$( "#alert" ).dialog( "close" );
					//setTimeout(function(){CargarConsultasDeHoyXDoctor();},1000);
				},
				error:function()
				{
					$("#alert").html("error al cargar");
				}
			});		
				
}

function VerReceta(codigo)
{
	$( "#VerReceta" ).attr("title","RECETA");
	$( "#VerReceta" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:700,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#VerReceta" ).dialog( "open" );
		$.ajax({
				url:'Procesar.php?accion=VerReceta&CodCons='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#VerReceta").html(res);
				},
				error:function()
				{
					$("#VerReceta").html("error al cargar");
				}
				
			});			
}

function DiagnosticoFenix()
{
		$( "#DiagnosticoFenix" ).attr("title","CIE 10");
		$( "#DiagnosticoFenix" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:900,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#DiagnosticoFenix" ).dialog( "open" );
		$( "#HeaderDiagFenix" ).html("<table><tr><!--<td>Buscar Enfermedad por: </td><td><select><option>---Seleccione---</option><option>Descripción</option><option>Código</option></select></td>--><td><center>Buscar: <input type='text' id='txtBucarcie' onkeyup='buscarcie2()'/></center></td></tr></table>");
		
			$.ajax({
				url:'Procesar.php?accion=VerCie',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#bodyDiaFenix").html(res);
				},
				error:function()
				{
					$("#bodyDiaFenix").html("error al cargar");
				}
				
			});		
}

function Diagnostico3()
{
//		$( "#AreaAnanmesis" )
		$( "#Diagnostico133" ).attr("title","CIE 10");
		$( "#Diagnostico133" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:900,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#Diagnostico133" ).dialog( "open" );
		$( "#Diagnostico133" ).html("<table><tr><!--<td>Buscar Enfermedad por: </td><td><select><option>---Seleccione---</option><option>Descripción</option><option>Código</option></select></td>--><td><center>Buscar: <input type='text' id='txtBucarcie' onkeyup='buscarcie2()'/></center></td></tr></table><div id='Datoscie'></div>");
		
			$.ajax({
				url:'Procesar.php?accion=VerCie',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#Datoscie").html(res);
				},
				error:function()
				{
					$("#Datoscie").html("error al cargar");
				}
				
			});	
			CargarCie();	
			
}
function CargarCie()
{
			$.ajax({
				url:'Procesar.php?accion=VerCie',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#Datoscie").html(res);
				},
				error:function()
				{
					$("#Datoscie").html("error al cargar");
				}
				
			});
}
function buscarcie2()
{
	$.ajax({
				url:'Procesar.php?accion=VerCie3&Descripcion33='+$("#txtBucarcie").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#bodyDiaFenix").html(res);
				},
				error:function()
				{
					$("#bodyDiaFenix").html("error al cargar");
				}
				
			});	
}
function modal3()
{
	$( "#Modal3" ).attr("title","Exámenes");
	$( "#Modal3" ).dialog({
			autoOpen: false,
			modal: true,
			height:900,
			width:990,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

		$( "#Modal3" ).dialog( "open" );
		if($("#txtExamenes").val()==1)
		{
			$( "#Modal3" ).html("<table border='1' class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='2'><b>HEMATOLOGÍA.</b></td> <td colspan='4'><b>ORINA</b></td> <td colspan='3'><b>SEROLOGÍA</b></td> </tr> <tr> <td width='145'><input type='checkbox' class='chkExamenes' value='Biometría Hemática'>&nbsp; Biometría Hemática</td> <td width='156'><input type='checkbox' class='chkExamenes' value='Hematocrito'>&nbsp; Hematocrito</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Elemental y Microscópico'>&nbsp; Elemental y Microscópico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Asto'>&nbsp; Asto</td> <td width='102'><input type='checkbox' class='chkExamenes' value='Latex'>&nbsp; Latex</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Reticulositos'>&nbsp; Reticulositos</td> <td><input type='checkbox' class='chkExamenes' value='Plaquetas'>&nbsp; Plaquetas</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Gota Fresca'>&nbsp; Gota Fresca</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='PCR'>&nbsp; PCR</td> <td><input type='checkbox' class='chkExamenes' value='Waaler Rose'>&nbsp; Waaler Rose</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Sedimentación'>&nbsp; Sedimentación</td> <td><input type='checkbox' class='chkExamenes' value='Fórmula Leuc.'>&nbsp; Fórmula Leuc.</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Gram'>&nbsp; Gram</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='VDRL'>&nbsp; VDRL</td> <td><input type='checkbox' class='chkExamenes' value='RPR'>&nbsp; RPR</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Hemoparásitos'>&nbsp; Hemoparásitos</td> <td><input type='checkbox' class='chkExamenes' value='Grupo Sanguineo'>&nbsp; Grupo Sanguineo</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Microalbuminuria'>&nbsp; Microalbuminuria</td> <td width='129'><input type='checkbox' class='chkExamenes' value='HIV'>&nbsp; HIV</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='FTA -ABS'>&nbsp; FTA -ABS</td> </tr> <tr> <td colspan='2'><b>COAGULACIÓN.</b></td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Proteinuria 24 horas'>&nbsp; Proteinuria 24 horas</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Serameba'>&nbsp; Serameba</td> <td><input type='checkbox' class='chkExamenes' value='Monotest'>&nbsp; Monotest</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='TP'>&nbsp; TP</td> <td><input type='checkbox' class='chkExamenes' value='TTP'>&nbsp; TTP</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Depuración Creatinina'>&nbsp; Depuración Creatinina</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='H. Pylori IgG'>&nbsp; H. Pylori IgG</td> <td><input type='checkbox' class='chkExamenes' value='H. Pylori IgA'>&nbsp; H. Pylori IgA</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Tiempo Trombina'>&nbsp; Tiempo Trombina</td> <td><input type='checkbox' class='chkExamenes' value='INR'>&nbsp; INR</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='SodioOr'>&nbsp; Sodio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='PotasioOr'>&nbsp; Potasio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Aglutinaciones'>&nbsp; Aglutinaciones</td> <td><input type='checkbox' class='chkExamenes' value='Dengue'>&nbsp; Dengue</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Tiempo Coagulación'>&nbsp; Tiempo Coagulación</td> <td><input type='checkbox' class='chkExamenes' value='Fibrinógeno'>&nbsp; Fibrinógeno</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='CloroOr'>&nbsp; Cloro</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Ac. UricoOr'>&nbsp; Ac. Urico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Epstein Barr'>&nbsp; Epstein Barr</td> <td><input type='checkbox' class='chkExamenes' value='IgGEps'>&nbsp; IgG</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Tiempo Hemorragia'>&nbsp; Tiempo Hemorragia</td> <td><input type='checkbox' class='chkExamenes' value='Antitrombina III'>&nbsp; Antitrombina III</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='CalcioOr'>&nbsp; Calcio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='FósforoOr'>&nbsp; Fósforo</td> <td colspan='3'><b>AUTOINMUNIDAD.</b></td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Coombs Directo'>&nbsp; Coombs Directo</td> <td><input type='checkbox' class='chkExamenes' value='Indirecto'>&nbsp; Indirecto</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='MagnesioOr'>&nbsp; Magnesio</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Ac. Antinucleares'>&nbsp; Ac. Antinucleares</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Retracción de Coágulo'>&nbsp; Retracción de Coágulo</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Prueba de embarazo'>&nbsp; Prueba de embarazo</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Ac. Anti DNA'>&nbsp; Ac. Anti DNA</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Otros Coagulación:'>&nbsp; Otros Coagulación:</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Panel de drogas (abuso)'>&nbsp; Panel de drogas (abuso)</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Células Le'>&nbsp; Células Le</td> </tr> <tr> <td colspan='2'><b>QUÍMICA SANGUÍNEA.</b></td> <td colspan='4'><!-- <input type='checkbox' class='chkExamenes' value='Otros Orina'> -->Otros Orina: <textarea id='txtOtrosOrina'cols='90' rows='2'></textarea></td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Anticitrulina (Anti -CCP)'>&nbsp; Anticitrulina (Anti -CCP)</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Glucosa Ayunas'>&nbsp; Glucosa Ayunas</td> <td><input type='checkbox' class='chkExamenes' value='Glocosa Postprandial'>&nbsp; Glocosa Postprandial</td> <td colspan='4'><b>INMUNODIAGNÓSTICO.</b></td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Ac. Antimicrosomales'>&nbsp; Ac. Antimicrosomales</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Curva de Glucosa'>&nbsp; Curva de Glucosa</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='TSH'>&nbsp; TSH</td> <td width='82'><input type='checkbox' class='chkExamenes' value='fT3'>&nbsp; fT3</td> <td width='54'><input type='checkbox' class='chkExamenes' value='fT4'>&nbsp; fT4</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Ac. Antitiroglobulinas'>&nbsp; Ac. Antitiroglobulinas</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Urea'>&nbsp; Urea</td> <td><input type='checkbox' class='chkExamenes' value='Bun'>&nbsp; Bun</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='FSH'>&nbsp; FSH</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='FH'>&nbsp; FH</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='ANA -BIOT'>&nbsp; ANA -BIOT</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Creatinina'>&nbsp; Creatinina</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Estrógenos'>&nbsp; Estrógenos</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Progesterona'>&nbsp; Progesterona</td> <td><input type='checkbox' class='chkExamenes' value='Antifosfolípidos'>&nbsp; Antifosfolípidos</td> <td width='45'><input type='checkbox' class='chkExamenes' value='IgGAntifosfo'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntifosfo'>&nbsp; IgM</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Ácido Úrico'>&nbsp; Ácido Úrico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='BHCG'>&nbsp; BHCG</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Testosferona'>&nbsp; Testosferona</td> <td><input type='checkbox' class='chkExamenes' value='Anticardiolipinas'>&nbsp; Anticardiolipinas</td> <td><input type='checkbox' class='chkExamenes' value='IgGAnticardio'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAnticardio'>&nbsp; IgM</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Lípidos Totales (Col -Tg -HDL -LDL)'>&nbsp; Lípidos Totales (Col -Tg -HDL -LDL)</td> <td width='101'><input type='checkbox' class='chkExamenes' value='Prolactina'>&nbsp; Prolactina</td> <td width='63'><input type='checkbox' class='chkExamenes' value='AMPro'>&nbsp; AM</td> <td><input type='checkbox' class='chkExamenes' value='PMPro'>&nbsp; PM</td> <td><input type='checkbox' class='chkExamenes' value='10'>&nbsp; 10</td> <td><input type='checkbox' class='chkExamenes' value='ANTI B2GP1'>&nbsp; ANTI B2GP1</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='ANCAS'>&nbsp; ANCAS</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Colesterol'>&nbsp; Colesterol</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Cortisol'>&nbsp; Cortisol</td> <td><input type='checkbox' class='chkExamenes' value='AMCor'>&nbsp; AM</td> <td><input type='checkbox' class='chkExamenes' value='PMCor'>&nbsp; PM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Anti mitocondriales'>&nbsp; Anti mitocondriales</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HDL -Colesterol'>&nbsp; HDL -Colesterol</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Insulina ayunas'>&nbsp; Insulina ayunas</td> <td><input type='checkbox' class='chkExamenes' value='PP'>&nbsp; PP</td> <td colspan='3'><b>MARCADORES TUMORALES.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='LDL -Colesterol'>&nbsp; LDL -Colesterol</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Péptido C'>&nbsp; Péptido C</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='CEA -Carcino Embrionario'>&nbsp; CEA -Carcino Embrionario</td> </tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Triglicéridos'>&nbsp; Triglicéridos</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Hormona de Crecimiento'>&nbsp; Hormona de Crecimiento</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='AFP - Alfa -feto Proteína'>&nbsp; AFP - Alfa -feto Proteína</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Apolipoproteína A'>&nbsp; Apolipoproteína A</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='IgFBP1'>&nbsp; IgFBP1</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='IgFBP3'>&nbsp; IgFBP3</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='PSA - Antígeno Prostático Específico'>&nbsp; PSA - Antígeno Prostático Específico</td> </tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Apolipoproteína B'>&nbsp; Apolipoproteína B</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Paratohormona'>&nbsp; Paratohormona</td> <td><input type='checkbox' class='chkExamenes' value='PSA libre'>&nbsp; PSA libre</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HCGBMarcTum'>&nbsp; HCGB</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='VLDL'>&nbsp; VLDL</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='17 -OH -progesterona'>&nbsp; 17 -OH -progesterona</td> <td><input type='checkbox' class='chkExamenes' value='Ca 125'>&nbsp; Ca 125</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Ca 15 -3'>&nbsp; Ca 15 -3</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Bilirrubinas (T -I -D)'>&nbsp; Bilirrubinas (T -I -D)</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Androstendiona'>&nbsp; Androstendiona</td> <td><input type='checkbox' class='chkExamenes' value='Ca 19 -9'>&nbsp; Ca 19 -9</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Ca 72 -4'>&nbsp; Ca 72 -4</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Proteínas Totales'>&nbsp; Proteínas Totales</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='DHEAS'>&nbsp; DHEAS</td> <td><input type='checkbox' class='chkExamenes' value='Anti TPO'>&nbsp; Anti TPO</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Tiroglobulina'>&nbsp; Tiroglobulina</td> </tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Albúmina -Globulina'>&nbsp; Albúmina -Globulina</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Test Estimulación HGH'>&nbsp; Test Estimulación HGH</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Neuroenolasa específica'>&nbsp; Neuroenolasa específica</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HB glicosilada'>&nbsp; HB glicosilada</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Test LH /GnRH'>&nbsp; Test LH /GnRH</td> <td colspan='3'><b>ESTUDIOS ESPECIALES.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Fructosamina'>&nbsp; Fructosamina</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Test FSH /GnRH'>&nbsp; Test FSH /GnRH</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Espermatograma'>&nbsp; Espermatograma</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Hierro'>&nbsp; Hierro</td> <td><input type='checkbox' class='chkExamenes' value='Vit. B12'>&nbsp; Vit. B12</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Test TSH /TRH'>&nbsp; Test TSH /TRH</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Estudio cálculo'>&nbsp; Estudio cálculo</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Transferrina'>&nbsp; Transferrina</td> <td><input type='checkbox' class='chkExamenes' value='Ac. Fólico'>&nbsp; Ac. Fólico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti Toxoplasma'>&nbsp; Anti Toxoplasma</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiTox'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiTox'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Citoquímico LCR'>&nbsp; Citoquímico LCR</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Ferritina'>&nbsp; Ferritina</td> <td><input type='checkbox' class='chkExamenes' value='Ind. Saturación'>&nbsp; Ind. Saturación</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti Rubeola'>&nbsp; Anti Rubeola</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiRu'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiRu'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Pap -Test'>&nbsp; Pap -Test</td> </tr><tr> <td><input type='checkbox' class='chkExamenes' value='TGO /AST'>&nbsp; TGO /AST</td> <td><input type='checkbox' class='chkExamenes' value='CPK'>&nbsp; CPK</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti CMV'>&nbsp; Anti CMV</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiCmv'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiIgm'>&nbsp; IgM</td> <td colspan='3'><!-- <input type='checkbox' class='chkExamenes' value='Estudio Líquidos'> -->Estudio Líquidos: <textarea id='txtEstLiq' cols='90' rows='2'></textarea> </td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='TGP /ALT'>&nbsp; TGP /ALT</td> <td><input type='checkbox' class='chkExamenes' value='CPK -MB'>&nbsp; CPK -MB</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti Herpes I'>&nbsp; Anti Herpes I</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiH1'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiH1'>&nbsp; IgM</td> <td colspan='3'><b>BACTERIOLOGÍA.</b></td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Gamma GT'>&nbsp; Gamma GT</td> <td><input type='checkbox' class='chkExamenes' value='Troponina'>&nbsp; Troponina</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti Herpes II'>&nbsp; Anti Herpes II</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiH2'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiH2'>&nbsp; IgM</td> <td colspan='3'> <!-- <input type='checkbox' class='chkExamenes' value='Muestra de: '> -->Muestra de: <textarea id='txtMuestra' cols='90' rows='2'></textarea></td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Fost. Alcalina'>&nbsp; Fost. Alcalina</td> <td><input type='checkbox' class='chkExamenes' value='Aldolasa'>&nbsp; Aldolasa</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='TORCH'>&nbsp; TORCH</td> <td><input type='checkbox' class='chkExamenes' value='IgGTorch'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMTorch'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Cultivo y antibiograma'>&nbsp; Cultivo y antibiograma</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Fost. Acida'>&nbsp; Fost. Acida</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='C3'>&nbsp; C3</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='C4'>&nbsp; C4</td> <td><input type='checkbox' class='chkExamenes' value='Gram'>&nbsp; Gram</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Fresco'>&nbsp; Fresco</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Fost. Ac. Prostática'>&nbsp; Fost. Ac. Prostática</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgGIn'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='BAAR'>BAAR</td> <td colspan='2'> <!-- <input type='checkbox' class='chkExamenes' value='Días No: '> -->Días No: <textarea id='txtDiasNo' cols='90' rows='2'></textarea> </td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Amilasa'>&nbsp; Amilasa</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgMIn'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Investigacion de hongos (KOH)'>&nbsp; Investigacion de hongos (KOH)</td> </tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Lipasa'>&nbsp; Lipasa</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgE'>&nbsp; IgE</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Control tratamiento'>&nbsp; Control tratamiento</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Glucosa 6 Fosfato DH'>&nbsp; Glucosa 6 Fosfato DH</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgA'>&nbsp; IgA</td> <td colspan='3'><b>PERFIL GENERAL.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Deshidrogena láctica'>&nbsp; Deshidrogena láctica</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgD'>&nbsp; IgD</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Biometría Hemática, EMO, Coproparasitario, glucosa, urea, creatina, ac. único, colesterol trigliceridos, HDL, LDL, VDRL.'>&nbsp; Biometría Hemática, EMO, Coproparasitario, glucosa, urea, creatina, ac. único, colesterol trigliceridos, HDL, LDL, VDRL.</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Colinesterasa'>&nbsp; Colinesterasa</td> <td><input type='checkbox' class='chkExamenes' value='Chlamidia'>&nbsp; Chlamidia</td> <td><input type='checkbox' class='chkExamenes' value='IgGChl'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMChl'>&nbsp; IgM</td> <td><input type='checkbox' class='chkExamenes' value='IgAChl'>&nbsp; IgA</td> <td colspan='3'><b>PERFIL DE DIABETES.</b></td> </tr> <tr> <td colspan='2'><b>ELECTROLITOS.</b></td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Hepatitis A'>&nbsp; Hepatitis A</td> <td><input type='checkbox' class='chkExamenes' value='IgMHepA'>&nbsp; IgM</td> <td><input type='checkbox' class='chkExamenes' value='IgMHepA'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Biometría, glucosa, Hb glicosilada, fructosamina creatina, acido úrico, colesterol, HDL, LDL, Triglicéridos, microalbuminuria, EMO.'>&nbsp; Biometría, glucosa, Hb glicosilada, fructosamina creatina, acido úrico, colesterol, HDL, LDL, Triglicéridos, microalbuminuria, EMO.</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Sodio'>&nbsp; Sodio</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Hepatitis B'>&nbsp; Hepatitis B</td> <td colspan='3'><b>PERFIL HEPÁTICO.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Potasio'>&nbsp; Potasio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HBsAg'>&nbsp; HBsAg</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti HBs'>&nbsp; Anti HBs</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Biometría, glucosa, colesterol, triglicéridos, proteínas, albúmina, bilirrubinas, TGO, TGP, GGT, fosfata alcalina, TP.'> &nbsp; Biometría, glucosa, colesterol, triglicéridos, proteínas, albúmina, bilirrubinas, TGO, TGP, GGT, fosfata alcalina, TP, TTP, Bilirrubina Totales y Parciales. </td> </tr><tr> <td><input type='checkbox' class='chkExamenes' value='Cloro'>&nbsp; Cloro</td> <td><input type='checkbox' class='chkExamenes' value='Magnesio'>&nbsp; Magnesio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HBc'>&nbsp; HBc</td> <td><input type='checkbox' class='chkExamenes' value='IgGHbc'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgmHbc'>&nbsp; Igm</td> <td colspan='3'><b>PERFIL LIPÍDICO.</b></td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Calcio total'>&nbsp; Calcio total</td> <td><input type='checkbox' class='chkExamenes' value='Calcio lónico'>&nbsp; Calcio lónico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HBeAg'>HBeAg</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti HBe'>&nbsp; Anti HBe</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Líquidos totales, Colesterol, Triglicéridos, HDL, LDL, Apo A, Apo B, fibrinógeno.'>&nbsp; Líquidos totales, Colesterol, Triglicéridos, HDL, LDL, Apo A, Apo B, fibrinógeno. </td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Fósforo'>&nbsp; Fósforo</td> <td><input type='checkbox' class='chkCobre'>Cobre</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Hepatitis C'>&nbsp; Hepatitis C</td> <td colspan='3'><b>PERFIL REUMÁTICO.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Litio'>&nbsp; Litio</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Tuberculosis en suero'>&nbsp; Tuberculosis en suero</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='PERFIL REUMÁTICO: BH, Glucosa, Creatinina, Asto, PCR'>&nbsp; BH, Glucosa, Creatinina, Asto, PCR</td></tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Amonio'>&nbsp; Amonio</td> <td colspan='4'><b>HECES.</b></td> <td colspan='3'><b>TIROIDITIS.</b></td></tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Ácido Valproico'>&nbsp; Ácido Valproico</td> <td><input type='checkbox' class='chkExamenes' value='Digoxina'>&nbsp; Digoxina</td>  <td colspan='4'><input type='checkbox' class='chkExamenes' value='Coproparasitario rutina'>&nbsp; Coproparasitario rutina</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Tiroiditis: Anti - Tiroglobulina, Anti - Peroxidasa, Tiroglobulina'> &nbsp; Anti - Tiroglobulina, Anti - Peroxidasa, Tiroglobulina</td></tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Carbamacepina'>&nbsp; Carbamacepina</td> <td><input type='checkbox' class='chkExamenes' value='Fenobarbital'>&nbsp; Fenobarbital</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Coproparasitario Seriado'>&nbsp; Coproparasitario Seriado</td> <td colspan='3'><b>HIPOTIROIDISMO.</b></td></tr><tr> <td><input type='checkbox' class='chkExamenes' value='Epamin'>&nbsp; Epamin</td> <td>&nbsp;</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Inv. Polimorfonucleares'>&nbsp; Inv. Polimorfonucleares</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Hipotiroidismo: TSH, FT4, FT3. '> &nbsp; TSH, FT4, FT3. </td></tr> <tr> <td colspan='2'>Otros Electrolitos: <textarea id='txtOtrosElectro' cols='90' rows='2'></textarea></td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Sangre oculta'>&nbsp; Sangre oculta</td> <td colspan='3'>&nbsp;</td></tr> <tr> <td colspan='2'><b>HTA. Hipertensión.</b></td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Rotavirus'>&nbsp; Rotavirus</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='pH'>&nbsp; pH</td> <td colspan='3'><b>PREQUIRÚRGICO.</b></td></tr> <tr> <td> <!--<input type='checkbox' class='chkExamenes' value='Otros Electrolitos: '> --> <input type='checkbox' class='chkExamenes' value='BH.'>&nbsp; BH.</td> <td> <input type='checkbox' class='chkExamenes' value='HDL'>&nbsp; HDL </td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Concentración'>&nbsp; Concentración</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Andenovirus'>&nbsp; Andenovirus</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='PREQUIRÚRGICO: Biometría Hemática, Uera, Glucosa, Creatinina, TP, EMO.'>&nbsp; Biometría Hemática, Uera, Glucosa, Creatinina, TP, EMO</td></tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Urea Prequ'>&nbsp; Urea</td> <td> <input type='checkbox' class='chkExamenes' value='LDL'>&nbsp; LDL </td><td colspan='2'><input type='checkbox' class='chkExamenes' value='Sudan III'>&nbsp; Sudan III</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Coprológico'>&nbsp; Coprológico</td> <td colspan='3'>&nbsp;</td></tr><tr> <td><input type='checkbox' class='chkExamenes' value='Glucosa'>&nbsp; Glucosa.</td><td><input type='checkbox' class='chkExamenes' value='TSH'>&nbsp; TSH</td><td colspan='4'>&nbsp;</td><td colspan='3'><b>PRUEBAS INMUNOLÓGICAS</b></td></tr><tr> <td><input type='checkbox' class='chkExamenes' value='Cratinina'>&nbsp; Creatinina</td> <td><input type='checkbox' class='chkExamenes' value='TSH'>&nbsp; TSH</td><td colspan='4'>&nbsp;</td><td colspan='3'><input type='checkbox' class='chkExamenes' value='Pruebas Inmunológicas: AMA, ANCAS, ANTI - ANA, C3, C4'>&nbsp; ANA, ANCAS, ANTI - ANA, C3, C4</td></tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Triglicérido'>&nbsp; Triglicérido</td><td colspan='4'>&nbsp;</td><td colspan='3'>&nbsp;</td></tr><tr> <td colspan='9'>&nbsp;</td></tr><tr> <td colspan='9'><center><input type='button' class='btn btn-primary' id='bntSolicitudExam' value='Guardar Exámenes' onclick='ImprSolicitud()' /></center></td></tr><tr> <td colspan='9'>&nbsp;</td></tr></table>");
		}
		else
		{
			$( "#Modal3" ).html("<table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='4'>RESONACIA MAGNETICA Siemens MAGNETOM ESSENZA 1.5 T</td> </tr> <tr> <td colspan='4'>CABEZA</td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='CEREBRO'> CEREBRO <br><input type='checkbox' class='chk_medimagenes' value='contraste_CEREBRO'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='HIPOFISIS'> HIPOFISIS <br><input type='checkbox' class='chk_medimagenes' value='contraste_HIPOFISIS'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='SENOS_PARANASALES'> SENOS PARANASALES <br><input type='checkbox' class='chk_medimagenes' value='contraste_SENOS_PARANA'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='OIDOS'> OIDOS <br><input type='checkbox' class='chk_medimagenes' value='contraste_OIDOS'>Con contraste</br></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='ORBITAS'> ORBITAS <br><input type='checkbox' class='chk_medimagenes' value='contraste_ORBITAS'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='CAROTIDAS'> CAROTIDAS <br><input type='checkbox' class='chk_medimagenes' value='contraste_CAROTIDAS'>Con contraste</br></td> <td colspan='2'><input type='checkbox' class='chk_medimagenes' value='OTROS_CABEZA'> OTROS </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='2'>COLUMNA</td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='COLUMNA_CERVICAL'> COLUMNA CERVICAL <br><input type='checkbox' class='chk_medimagenes' value='contraste_COLUMNA_CERVICAL'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='COLUMNA_DORSAL'> COLUMNA DORSAL <br><input type='checkbox' class='chk_medimagenes'>Con contraste</br></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='COLUMNA_LUMBAR'> COLUMNA LUMBAR <br><input type='checkbox' class='chk_medimagenes' value='contraste_COLUMNA_LUMBAR'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='OTROS_COLUMNA'> OTROS </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed' > <tr> <td colspan='3'>CUELLO Y CUERPO</td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='CUELLO'> CUELLO <br><input type='checkbox' class='chk_medimagenes' value='contraste_CUELLO'>Con contraste</br></td> <td colspan='2'><input type='checkbox' class='chk_medimagenes' value='TORAX'> TORAX <br><input type='checkbox' class='chk_medimagenes' value='contraste_TORAX'>Con contraste</br></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='ABDOMEN'> ABDOMEN <br><input type='checkbox' class='chk_medimagenes' value='contraste_ABDOMEN'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='PELVIS'> PELVIS <br><input type='checkbox' class='chk_medimagenes' value='contraste_PELVIS'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes'> OTROS </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='2'>MAMAS<input type='checkbox' class='chk_medimagenes' value='MAMAS'></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='contraste_MAMAS'> Con contraste <input type='checkbox' class='chk_medimagenes' value='espectroscopia_MAMAS'> Espectroscopia </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed' > <tr> <td colspan='3'>MUSCULO ESQUELETICO</td> </tr> <tr> <td>RODILLA: DER<input type='checkbox' class='chk_medimagenes' value='RODILLA_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='RODILLA_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_RODILLA'>Con contraste</br></td> <td>PELVIS: DER<input type='checkbox' class='chk_medimagenes' value='PELVIS_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='PELVIS_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_PELVIS'>Con contraste</br></td> <td>MUÑECA: DER<input type='checkbox' class='chk_medimagenes' value='MUÑECA_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='MUÑECA_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_MUÑECA'>Con contraste</br></td> </tr> <tr> <td>HOMBRO: DER<input type='checkbox' class='chk_medimagenes' value='HOMBRO_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='HOMBRO_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_HOMBRO'>Con contraste</br></td> <td>TOBILLO: DER<input type='checkbox' class='chk_medimagenes' value='TOBILLO_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='TOBILLO_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_TOBILLO'>Con contraste</br></td> <td>CODO: DER<input type='checkbox' class='chk_medimagenes' value='CODO_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='CODO_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_CODO'>Con contraste</br></td> </tr> <tr> <td>MANO: DER<input type='checkbox' class='chk_medimagenes' value='MANO_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='MANO_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_MANO'>Con contraste</br></td> <td>PIE: DER<input type='checkbox' class='chk_medimagenes'> IZQ <input type='checkbox' class='chk_medimagenes' value='PIE_izq'> <br><input type='checkbox' id='chk_contraste_PIE' value='contraste_PIE'>Con contraste</br></td> <td>OTROS <br><input type='checkbox' class='chk_medimagenes' value='contraste_MUSCU_ESQUE_OTROS'>Con contraste</br></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='3'>TOMOGRAFIA AXIAL COMPUTARIZADA <input type='checkbox' class='chk_medimagenes' value='TOMOGRAFIA'></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='craneo_TOMOGRAFIA'>CRANEO <br><input type='checkbox' class='chk_medimagenes' value='contraste_craneo_TOMOGRAFIA'>Con contraste <input type='checkbox' class='chk_medimagenes' value='osea_TOMOGRAFIA'>Ventana Ósea </br></td> <td><input type='checkbox' class='chk_medimagenes' value='SENOS PARANASALES_TOMOGRAFIA'>SENOS PARANASALES<br><input type='checkbox' class='chk_medimagenes' value='axia_TOMOGRAFIA'>Axial <input type='checkbox' class='chk_medimagenes' value='coronal_TOMOGRAFIA'>Coronal </br></td> <td><input type='checkbox' class='chk_medimagenes' value='facial_TOMOGRAFIA'>MACIZO FACIAL</td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='oidos_TOMOGRAFIA'>OIDOS <br><input type='checkbox' class='chk_medimagenes' value='axia_oido_TOMOGRAFIA'>Axial <input type='checkbox' class='chk_medimagenes' value='Coronal_oido_TOMOGRAFIA'>Coronal </br></td> <td><input type='checkbox' class='chk_medimagenes' value='orbitas_TOMOGRAFIA'>ORBITAS <br><input type='checkbox' class='chk_medimagenes' value='contraste_orbitas_TOMOGRAFIA'>Con contraste </br></td> <td><input type='checkbox' class='chk_medimagenes' value='cuello_TOMOGRAFIA'>CUELLO <br><input type='checkbox' class='chk_medimagenes' value='contraste_cuello_TOMOGRAFIA'>Con contraste </br></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='torax_TOMOGRAFIA'>TORAX <br><input type='checkbox' class='chk_medimagenes' value='contraste_torax_TOMOGRAFIA'>Con contraste </br></td> <td><input type='checkbox' class='chk_medimagenes' value='abdomen_TOMOGRAFIA'>ABDOMEN <br><input type='checkbox' class='chk_medimagenes' value='contraste_abdomen_TOMOGRAFIA'>Con contraste </br></td> <td><input type='checkbox' class='chk_medimagenes' value='pelvis_TOMOGRAFIA'>PELVIS <br><input type='checkbox' class='chk_medimagenes' value='contraste_pelvis_TOMOGRAFIA'>Con contraste </br></td> </tr> <tr> <td colspan='3'><input type='checkbox' class='chk_medimagenes' value='otros_TOMOGRAFIA'>OTROS: </td> </tr> </table> <table  class='table table-bordered table-striped table-hover table-condensed' > <tr> <td>RX DIGITAL<input type='checkbox' class='chk_medimagenes' value='RX_DIGITAL'> PANORAMICA DENTAL<input type='checkbox' class='chk_medimagenes' value='PANORAMICA_DENTAL'></td> </tr> <tr> <td>&nbsp;</td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td>MAMOGRAFIA DIGITAL<input type='checkbox' class='chk_medimagenes' value='MAMOGRAFIA_DIGITAL'></td> </tr> <tr> <td>BILATERAL<input type='checkbox' class='chk_medimagenes' value='BILATERAL_MAMOGRAFIA'> UNILATERAL<input type='checkbox' class='chk_medimagenes' value='UNILATERAL_MAMOGRAFIA'>FOCALIZACION<input type='checkbox' class='chk_medimagenes' value='FOCALIZACION_MAMOGRAFIA'>GALACTOGRAFIA<input type='checkbox' class='chk_medimagenes' value='GALACTOGRAFIA_MAMOGRAFIA'></td> </tr> </table> <table  class='table table-bordered table-striped table-hover table-condensed'  > <tr> <td>ECOGRAFIA<input type='checkbox' class='chk_medimagenes' value='ECOGRAFIA'> 3-4 D<input type='checkbox' class='chk_medimagenes' value='3-4_D'>DOPPLER<input type='checkbox' class='chk_medimagenes' value='DOPPLER'> ECOCARDIOGRAMA<input type='checkbox' class='chk_medimagenes' value='ECOCARDIOGRAMA'></td> </tr> <tr> <td>&nbsp;</td> </tr> </table> <table   class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='4'>DENSITOMETRIA OSEA<input type='checkbox' class='chk_medimagenes' ></td> </tr> <td>ANTEBRAZO<input type='checkbox' class='chk_medimagenes' value='ANTEBRAZO_DENSITOMETRIA'></td><td> COLUMNA LUMBAR</td> <td>CUELLO FEMORAL</td> <td> CUERPO TOTAL<input type='checkbox' class='chk_medimagenes' value='CUELLO_FEMORAL_DENSITOMETRIA'></td> </tr> <tr> <td>&nbsp;</td> <td>AP<input type='checkbox' class='chk_medimagenes' value='AP_COLUMNA_LUMBAR'> LAT<input type='checkbox' class='chk_medimagenes' value='LAT_COLUMNA_LUMBAR'> </td> <td>DER<input type='checkbox' class='chk_medimagenes' value='DER_CUELLO_FEMORAL'> IZQ<input type='checkbox' class='chk_medimagenes' value='IZQ_CUELLO_FEMORAL'> </td> <td>&nbsp;</td> </tr> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='4'>RADIOGRAFIA</td> </tr> <tr> <td>ART. TEMPORO MAXILAR UNI.<input type='checkbox' class='chk_medimagenes' value='ART. TEMPORO MAXILAR UNI.' /></td> <td>ART. TEMPORO MAXILAR BIL.<input type='checkbox' class='chk_medimagenes' value='ART. TEMPORO MAXILAR BIL.' /></td> <td>TOMOGRAFIA DE CRANEO<input type='checkbox' class='chk_medimagenes' value='TOMOGRAFIA DE CRANEO' /></td> <td>HUESOS FACIALES 1 POSC.<input type='checkbox' class='chk_medimagenes' value='HUESOS FACIALES 1 POSC.' /></td> </tr> <tr> <td>HUESOS FACIALES 2 POSC.<input type='checkbox' class='chk_medimagenes' value='HUESOS FACIALES 2 POSC.' /></td> <td>HUESOS FACIALES 3 POSC.<input type='checkbox' class='chk_medimagenes' value='HUESOS FACIALES 3 POSC.' /></td> <td>HUESOS NASALES 3 POSC.<input type='checkbox' class='chk_medimagenes' value='HUESOS NASALES 3 POSC.' /></td> <td>MAXILAR 2 POSC.<input type='checkbox' class='chk_medimagenes' value='MAXILAR 2 POSC.' /></td> </tr> <tr> <td>MAXILAR 3 POSC.<input type='checkbox' class='chk_medimagenes' value='MAXILAR 3 POSC.' /></td> <td>SENOS PARANASALES<input type='checkbox' class='chk_medimagenes' value='SENOS PARANASALES' /></td> <td>CAVUN SIMPLE<input type='checkbox' class='chk_medimagenes' value='CAVUN SIMPLE' /></td> <td>CAVUN CONTRASTADO<input type='checkbox' class='chk_medimagenes' value='CAVUN CONTRASTADO' /></td> </tr> <tr> <td>CUELLO 2 POSC. PARTES BLANDAS<input type='checkbox' class='chk_medimagenes' value='CUELLO 2 POSC. PARTES BLANDAS' /></td> <td>CERVICAL AP-LAT<input type='checkbox' class='chk_medimagenes' value='CERVICAL AP-LAT' /></td> <td>CERVICAL AP-LAT-OBL<input type='checkbox' class='chk_medimagenes' value='CERVICAL AP-LAT-OBL' /></td> <td>CERVICAL FUNCIONAL<input type='checkbox' class='chk_medimagenes' value='CERVICAL FUNCIONAL' /></td> </tr> <tr> <td>DORSAL AP-LAT<input type='checkbox' class='chk_medimagenes' value='DORSAL AP-LAT' /></td> <td>DORSAL 4 POSC.<input type='checkbox' class='chk_medimagenes' value='DORSAL 4 POSC.' /></td> <td>LUMBAR AP-LAT<input type='checkbox' class='chk_medimagenes' value='LUMBAR AP-LAT' /></td> <td>LUMBAR 4 POSC.<input type='checkbox' class='chk_medimagenes' value='CERVICAL FUNCIONAL' /></td> </tr> <tr> <td>SACRO Y COXIS AP-LAT<input type='checkbox' class='chk_medimagenes' value='SACRO Y COXIS AP-LAT' /></td> <td>COLUMNA 1 POSC.-1 PLACA<input type='checkbox' class='chk_medimagenes' value='COLUMNA 1 POSC.-1 PLACA' /></td> <td>COLUMNA 2 POSC.-2 PLACA<input type='checkbox' class='chk_medimagenes' value='COLUMNA 2 POSC.-2 PLACA' /></td> <td>COLUMNA 3 POSC.-3 PLACA<input type='checkbox' class='chk_medimagenes' value='COLUMNA 3 POSC.-3 PLACA' /></td> </tr> <tr> <td>TOMOGRAFIA DE COLUMNA<input type='checkbox' class='chk_medimagenes' value='TOMOGRAFIA DE COLUMNA' /></td> <td>TORAX 1 POSC.<input type='checkbox' class='chk_medimagenes' value='TORAX 1 POSC.' /></td> <td>TORAX 2 POSC.<input type='checkbox' class='chk_medimagenes' value='TORAX 2 POSC.' /></td> <td>TORAX 3 POSC.<input type='checkbox' class='chk_medimagenes' value='TORAX 2 POSC.' /></td> </tr> <tr> <td>TORAX 4 POSC.<input type='checkbox' class='chk_medimagenes' value='TORAX 4 POSC.' /></td> <td>FLUROSCOPIA DE TORAX<input type='checkbox' class='chk_medimagenes' value='FLUROSCOPIA DE TORAX' /></td> <td>TOMOGRAFIA PULMONAR<input type='checkbox' class='chk_medimagenes' value='TOMOGRAFIA PULMONAR' /></td> <td>ESOFAGOGRAMA<input type='checkbox' class='chk_medimagenes' value='ESOFAGOGRAMA' /></td> </tr> <tr> <td>ABDOMEN 1 POSC.<input type='checkbox' class='chk_medimagenes' value='ABDOMEN 1 POSC.' /></td> <td>ABDOMEN 2 POSC.<input type='checkbox' class='chk_medimagenes' value='ABDOMEN 2 POSC.' /></td> <td>ABDOMEN 3 POSC.<input type='checkbox' class='chk_medimagenes' value='ABDOMEN 3 POSC.' /></td> <td>SERIE E.G.D<input type='checkbox' class='chk_medimagenes' value='SERIE E.G.D' /></td> </tr> <tr> <td>S.G.D.+ TRANSITO INTESTINAL<input type='checkbox' class='chk_medimagenes' value='S.G.D.+ TRANSITO INTESTINAL' /></td> <td>TRANSITO INTESTINAL<input type='checkbox' class='chk_medimagenes' value='TRANSITO INTESTINAL' /></td> <td>ENEMA DE BARIO<input type='checkbox' class='chk_medimagenes' value='ENEMA DE BARIO' /></td> <td>COLECISTOGRAFIA ORAL<input type='checkbox' class='chk_medimagenes' value='COLECISTOGRAFIA ORAL' /></td> </tr> <tr> <td>COLANGIOGRAFIA INTRAVENOSA<input type='checkbox' class='chk_medimagenes' value='COLANGIOGRAFIA INTRAVENOSA' /></td> <td>COLANGIOGRAFIA POR SONDA<input type='checkbox' class='chk_medimagenes' value='COLANGIOGRAFIA POR SONDA' /></td> <td>COLANGIOGRAFIA TRANS-OPEN<input type='checkbox' class='chk_medimagenes' value='COLANGIOGRAFIA TRANS-OPEN' /></td> <td>UROGRAFIA EXCRETORIA<input type='checkbox' class='chk_medimagenes' value='UROGRAFIA EXCRETORIA' /></td> </tr> <tr> <td>UROGRAFIA POR DILUCION<input type='checkbox' class='chk_medimagenes' value='UROGRAFIA POR DILUCION' /></td> <td>NEFROTOMOGRAFIA<input type='checkbox' class='chk_medimagenes' value='NEFROTOMOGRAFIA' /></td> <td>PIELOGRAFIA RETROGADA<input type='checkbox' class='chk_medimagenes' value='PIELOGRAFIA RETROGADA' /></td> <td>CISTOGRAFIA<input type='checkbox' class='chk_medimagenes' value='CISTOGRAFIA' /></td> </tr> <tr> <td>URETROCISTOPOGRAFICA<input type='checkbox' class='chk_medimagenes' value='URETROCISTOPOGRAFICA' /></td> <td>PELVIMETRIA<input type='checkbox' class='chk_medimagenes' value='PELVIMETRIA' /></td> <td>FISTULOGRAFIA<input type='checkbox' class='chk_medimagenes' value='FISTULOGRAFIA' /></td> <td>CLAVIVULA 1 POSC.<input type='checkbox' class='chk_medimagenes' value='CLAVIVULA 1 POSC.' /></td> </tr> <tr> <td>HOMBRO 1 POSC.<input type='checkbox' class='chk_medimagenes' value='HOMBRO 1 POSC.' /></td> <td>HOMBRO 2 POSC.<input type='checkbox' class='chk_medimagenes' value='HOMBRO 2 POSC.' /></td> <td>HOMBRO 3 POSC.<input type='checkbox' class='chk_medimagenes' value='HOMBRO 3 POSC.' /></td> <td>HOMBRO BILATERAL 1 PLACA<input type='checkbox' class='chk_medimagenes' value='HOMBRO BILATERAL 1 PLACA' /></td> </tr> <tr> <td>BRAZO AP-LAT<input type='checkbox' class='chk_medimagenes' value='BRAZO AP-LAT' /></td> <td>CODO AP-LAT<input type='checkbox' class='chk_medimagenes' value='CODO AP-LAT' /></td> <td>CODO 3 POSC.<input type='checkbox' class='chk_medimagenes' value='CODO 3 POSC.' /></td> <td>ANTEBRAZO AP-LAT<input type='checkbox' class='chk_medimagenes' value='ANTEBRAZO AP-LAT' /></td> </tr> <tr> <td>MUÑECA 2 POSC.<input type='checkbox' class='chk_medimagenes' value='MUÑECA 2 POSC.' /></td> <td>MUÑECA 3 POSC.<input type='checkbox' class='chk_medimagenes' value='MUÑECA 3 POSC.' /></td> <td>MANO 2 POSC.<input type='checkbox' class='chk_medimagenes' value='MANO 2 POSC.' /></td> <td>DEDOS AP-LAT<input type='checkbox' class='chk_medimagenes' value='DEDOS AP-LAT' /></td> </tr> <tr> <td>MIEMBRO SUP. 1 POSC.<input type='checkbox' class='chk_medimagenes' value='MIEMBRO SUP. 1 POSC.' /></td> <td>PELVIS 1 POSC.<input type='checkbox' class='chk_medimagenes' value='PELVIS 1 POSC.' /></td> <td>CADERA 2 POSC.<input type='checkbox' class='chk_medimagenes' value='CADERA 2 POSC.' /></td> <td>CADERA 3 POSC.<input type='checkbox' class='chk_medimagenes' value='CADERA 3 POSC.' /></td> </tr> <tr> <td>CADERA 4 POSC.<input type='checkbox' class='chk_medimagenes' value='CADERA 4 POSC.' /></td> <td>MUSLO AP-LAT<input type='checkbox' class='chk_medimagenes' value='MUSLO AP-LAT' /></td> <td>RODILLA AP-LAT<input type='checkbox' class='chk_medimagenes' value='RODILLA AP-LAT' /></td> <td>RODILLA 4 POSC.<input type='checkbox' class='chk_medimagenes' value='RODILLA 4 POSC.' /></td> </tr> <tr> <td>PIERNA AP-LAT<input type='checkbox' class='chk_medimagenes' value='PIERNA AP-LAT' /></td> <td>TOBILLO AP-LAT<input type='checkbox' class='chk_medimagenes' value='TOBILLO AP-LAT' /></td> <td>TOBILLO 4 POSC.<input type='checkbox' class='chk_medimagenes' value='TOBILLO 4 POSC.' /></td> <td>PIE 2 POSC.<input type='checkbox' class='chk_medimagenes' value='PIE 2 POSC.' /></td> </tr> <tr> <td>PIE 3 POSC.<input type='checkbox' class='chk_medimagenes' value='PIE 3 POSC.' /></td> <td>CALCANEO 2 POSC.<input type='checkbox' class='chk_medimagenes' value='CALCANEO 2 POSC.' /></td> <td>MIEMBRO INFERIOR 1 POSC.<input type='checkbox' class='chk_medimagenes' value='MIEMBRO INFERIOR 1 POSC.' /></td> <td>ESCANOGRAMA<input type='checkbox' class='chk_medimagenes' value='ESCANOGRAMA' /></td> </tr> <tr> <td>EDAD OSEA 1 PLACA<input type='checkbox' class='chk_medimagenes' value='EDAD OSEA 1 PLACA' /></td> <td>EDAD OSEA 2 PLACA<input type='checkbox' class='chk_medimagenes' value='EDAD OSEA 2 PLACA' /></td> <td>EDAD OSEA 3 PLACA<input type='checkbox' class='chk_medimagenes' value='EDAD OSEA 3 PLACA' /></td> <td>SERIE METASTASICA<input type='checkbox' class='chk_medimagenes' value='SERIE METASTASICA' /></td> </tr> <tr> <td>TEST DE FARRIL<input type='checkbox' class='chk_medimagenes' value='TEST DE FARRIL' /></td> </tr> <tr> <td colspan='4' align='center'><br>Firma Y Sello Del Medico</br></td> </tr> <td align='center'><input type='button' id='btn_Imprimir_MEDIMAGENES' class='btn btn-primary' value='Guardar' onclick='imp_medimagenes()'/> </td> </table>");
		}
}

function imp_medimagenes()
{
	var codigo=$("#imagenes123").val();
	$(".chk_medimagenes").each(function() 
	{
        if($(this).attr("checked"))
		{
			$.ajax({
					url:'Procesar.php?accion=ImprimirMedImagen&CodTur2='+$("#imagenes123").val()+'&medimagenes='+$(this).val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$('#areaExamenes2').dialog({
							autoOpen: false,
							modal: true,
							height:600,
							width:600,
							show: {
								effect: 'slide',
								duration: 1000
								},
							hide:{
								effect: 'drop',
								duration: 1000
								}
							});
				$('#areaExamenes2').dialog('open');
				$('#areaExamenes2').html("<object type='text/html' data='../Reportes/MedImagenes.php?id="+$("#imagenes123").val()+"'></object>");
						setTimeout(function()
						{
							LoadSolicitudNow(codigo);
						},1000);
					},
					error:function()
					{
						$("#Modal7").html();
					}
				});
			}
		});
}

function LoadSolicitudNow(codigo)
{
			$.ajax({
				url:'Procesar.php?accion=VerSolictudExamenNow&CodtuNow='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					//var ant=$("#ExamensLoad").html();
					//var act=ant+" <p>"+res;
					$("#ExamensLoad").html(res);
				},
				error:function()
				{
					$("#ExamensLoad").html();
				}
				
			});		
}
function ImprSolicitud()
{
	var codigo=$("#imagenes123").val();
	$.ajax({
				url:'Procesar.php?accion=SaveExamFi&Codtu0='+$("#imagenes123").val()+'&OtOrina='+$("#txtOtrosOrina").val()+'&EstLiquidos='+$("#txtEstLiq").val()+'&Muestra='+$("#txtMuestra").val()+'&DiasNo='+$("#txtDiasNo").val()+'&OtElectro='+$("#txtOtrosElectro").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
				
				
				},
				error:function()
				{
					$("#alert").html("error al cargar");
				}
			});
			
	$(".chkExamenes").each(function()
	{
			
		if($(this).attr("checked"))
		{
			$.ajax({
				url:'Procesar.php?accion=GuardarExamen&Codtu='+$("#imagenes123").val()+'&DescExamen='+$(this).val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					
			
				
					setTimeout(function()
					{
						
		$( '#areaExamenes' ).dialog({
						autoOpen: false,
						modal: true,
						height:600,
						width:600,
						show: {
							effect: 'blind',
							duration: 1000
						},
						hide: {
							effect: 'explode',
							duration: 1000
						}
					});
					
					$( '#areaExamenes' ).dialog( 'open' );
				$( "#areaExamenes" ).html("<object type='text/html' data='../Reportes/SolicitudExamenes.php?id="+$("#imagenes123").val()+"'></object>");
										
						
						
						
						
						
						LoadSolicitudNow(codigo);
					},1000);
				},
				error:function()
				{
					$("#Modal7").html();
				}
				
			});	
		}
	});
}
function Examenfisico()
{
//	$( "#AreaAnanmesis" )
	$( "#Exames3" ).attr("title","Exámenes");
	$( "#Exames3" ).dialog({
			autoOpen: false,
			modal: true,
			height:200,
			width:400,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		
		$( "#Exames3" ).dialog( "open" );
		$( "#Exames3" ).html("<table><tr><td>Tipo de Exámenes: </td><td><select id='txtExamenes' onchange='modal3()'><option>---Elija una Opción---</option><option value='1'>Solicutud de Exámenes</option value='2'><option>Solicitud de Imagen</option></Select></td></tr></table><div id='Datoscie'></div>");
}
function ExamenFisico2()
{
	//$("#AreaAnanmesis").
	$("#ExamesFisicos2").attr("title","Examen Físico");
	$( "#ExamesFisicos2" ).dialog({
			autoOpen: false,
			modal: true,
			height:800,
			width:630,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		
		$( "#ExamesFisicos2" ).dialog( "open" );
		$( "#ExamesFisicos2" ).html("<table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>Biotipo Constitucional</td> <td><select id='cbo_biotipo'> <option value=''>---Selecione---</option> <option>Atlético</option> <option>Pícnico</option> <option>Displásico</option> <option>Asténico</option> </select></td> </tr> <tr> <td>Actitud </td> <td><input type='text' id='txt_actitud' /></td></tr> <tr> <td>Estado Conciencia</td> <td><input type='text' id='txt_conciencia' /></td></tr> <tr> <td>Glasgow</td> <td><input type='text' id='txt_glas' style='width:60px;'/></td> </tr> <tr> <td>Temperatura</td> <td colspan='2'><input type='text' id='txt_tempe' /> &nbsp; &nbsp; °C</td> </tr> <tr> <td>Presión Arterial</td> <td colspan='2'><input type='text' id='txt_arterial' /> &nbsp; &nbsp; mmHg</td> </tr> <tr> <td>Frecuencia Cardiaca</td> <td colspan='2'><input type='text' id='txt_cardica' /> &nbsp; &nbsp; latido/minuto</td> </tr> <tr> <td>Frecuencia Respiratoria</td> <td colspan='2'><input type='text' id='txt_respiratoria' /> &nbsp; &nbsp; respiraciones/minuto</td> </tr> <tr> <td>Peso</td> <td colspan='2'><input type='text' id='txt_peso' /> &nbsp; &nbsp; kg</td> </tr> <tr> <td>Talla</td> <td colspan='2'><input type='text' id='txt_talla' onblur='masacorporal()' /> &nbsp; &nbsp; m</td> </tr> <tr> <td>IMC</td> <td colspan='2'><input type='text' id='txt_MCorp' readonly/> </td> </tr> <tr> <td>Perímeto Cefálico</td> <td colspan='2'><input type='text' id='txt_PCefalico' /> &nbsp; &nbsp; cm</td> </tr> <tr> <td>Perímetro Torácico</td> <td colspan='2'><input type='text' id='txt_PToracico' /> &nbsp; &nbsp; cm</td> </tr> <tr> <td>Perímetro Abdominal</td> <td colspan='2'><input type='text' id='txt_abdominal' /> &nbsp; &nbsp; cm</td> </tr> <tr> <td>Peso Ideal</td> <td colspan='2'><input type='text' id='txt_PesoIdeal' /> &nbsp; &nbsp; kg</td> </tr> <tr> <td>T.A. Acostado</td> <td colspan='2'><input type='text' id='txt_TAacostado' /> &nbsp; &nbsp; mmHg</td> </tr> <tr> <td>T.A. Sentado</td> <td colspan='2'><input type='text' id='txt_TAsentado' /> &nbsp; &nbsp; mmHg</td> </tr> <tr> <td>T.A. de Pie</td> <td colspan='2'><input type='text' id='txt_TApie' /> &nbsp; &nbsp; mmHg</td> </tr> <tr> <td>Siperficie Corporal</td> <td colspan='2'><input type='text' id='txt_Scorporal' /> &nbsp; &nbsp; m2</td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>Piel</td> <td><textarea cols='30' rows='2' id='txt_piel' ></textarea></td> </tr> <tr> <td colspan='2'><center>CABEZA</center></td> </tr> <tr><td>Fascies</td><td><textarea cols='30' rows='2' id='txt_facies' ></textarea></td></tr><tr><td>Ojos</td><td><textarea cols='30' rows='2' id='txt_ojos' ></textarea></td></tr><tr><td>Naríz</td><td><textarea cols='30' rows='2' id='txt_nariz' ></textarea></td></tr><tr><td>Boca</td><td><textarea cols='30' rows='2' id='txt_boca' ></textarea></td></tr><tr><td>Oidos</td><td><textarea cols='30' rows='2' id='txt_oidos' ></textarea></td></tr><tr><td>Faringe</td><td><textarea cols='30' rows='2' id='txt_faringe' ></textarea></td></tr> <tr><td colspan='2'><center>CUELLO</center></td></tr> <tr><td>Forma</td><td><textarea cols='30' rows='2' id='txt_Cforma' ></textarea></td></tr><tr><td>Movimientos</td><td><textarea cols='30' rows='2' id='txt_Cmovimiento' ></textarea></td></tr><tr><td>Piel</td><td><textarea cols='30' rows='2' id='txt_Cpiel' ></textarea></td></tr><tr><td>Partes Blandas</td><td><textarea cols='30' rows='2' id='txt_CParBlandas' ></textarea></td></tr><tr><td>Tiroides</td><td><textarea cols='30' rows='2' id='txt_CTiroides' ></textarea></td></tr><tr><td>Ganglios</td><td><textarea cols='30' rows='2' id='txt_Cganglios' ></textarea></td></tr> <tr> <td colspan='2'><center>TÓRAX</center></td> </tr> <tr><td>Mov. Respiratorios</td><td><textarea cols='30' rows='2' id='txt_TMovRespira' ></textarea></td></tr><tr><td>Piel</td><td><textarea cols='30' rows='2' id='txt_TPiel' ></textarea></td></tr><tr><td>Partes Blandas</td><td><textarea cols='30' rows='2' id='txt_TParBlandas' ></textarea></td></tr><tr><td>Mamas</td><td><textarea cols='30' rows='2' id='txt_Tmamas' ></textarea></td></tr><tr><td>Corazón</td><td><textarea cols='30' rows='2' id='txt_TCorazon' ></textarea></td></tr><tr><td>Pulmones</td><td><textarea cols='30' rows='2' id='txt_TPulmones' ></textarea></td></tr> <tr><td colspan='2'><center>ABDOMEN</center></td></tr> <tr><td>Piel</td><td><textarea cols='30' rows='2' id='txt_AbPiel' ></textarea></td></tr><tr><td>Forma, volumen y tamaño</td><td><textarea cols='30' rows='2' id='txt_AbFVT' ></textarea></td></tr><tr><td>Partes Blandas</td><td><textarea cols='30' rows='2' id='txt_AbParBlandas' ></textarea></td></tr></table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>Aparato Urinario</td> <td><textarea cols='30' rows='2' id='txt_urinario' ></textarea></td> </tr> <tr> <td>Aparato Digestivo</td> <td><textarea cols='30' rows='2' id='txt_digestivo' ></textarea></td> </tr> <tr> <td>Aparato Genital Masculino</td> <td><textarea cols='30' rows='2' id='txt_masculino' ></textarea></td> </tr> <tr> <td>Aparato Genital Femenino</td> <td><textarea cols='30' rows='2' id='txt_femenino' ></textarea></td> </tr> <tr> <td>Sistema Músculo Esquelético</td> <td><textarea cols='30' rows='2' id='txt_esqueletico' ></textarea></td> </tr> <tr> <td>Sistema Nervioso</td> <td><textarea cols='30' rows='2' id='txt_nervioso' ></textarea></td> </tr> <tr><td colspan='3'><center><input type='button' id='btn_imprimurEF' class='btn btn-success' value='Guardar' onclick='SaveExamenfisico()'/> </center></td></tr> </table>");
}

function masacorporal()
{
	if($("#txt_peso").val()!="" & $("#txt_talla").val()!="")
	{
		var aux1=$("#txt_peso").val();
		var aux2=$("#txt_talla").val();
		var aux3=((aux1)/(Math.pow(aux2,2)));
		$("#txt_MCorp").attr("value",""+aux3+"");
	}
	
}



function Tratamiento2()
{
	//$( "#AreaAnanmesis" ).
	$( "#Diagnostico321" ).attr("title","Tratamiento");
	$( "#Diagnostico321" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:900,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		
		$( "#Diagnostico321" ).dialog( "open" );
		$( "#Diagnostico321" ).html("<table><tr><td>Descripcion de tratamiento: </td><td><textarea id='txtDescTratamiento' cols='40' rows='2'></textarea></td></tr></table><div id='Datoscie'></div>");
}

function AsignarCie(codigo)
{
	$("#AreCie10").html("<input type='hidden' id='txtCodCie10' value="+codigo+">");
	$.ajax({
				url:'Procesar.php?accion=AsigCie&Cie='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					var ant=$("#txtDiagnosti").val();
					//$("#txtDiagnosti").val(ant+" "+res);
					$("#txtDiagnosti").val(res);
					$( "#DiagnosticoFenix" ).dialog( "close" );
				},
				error:function()
				{
					$("#txtDiagnosticar").val("error al cargar");
				}
				
			});	
			
}
function CargarFiliacion(codigo)
{
	$.ajax({
			url:'Procesar.php?accion=CargarDatosFiliacion&filiacion='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#MainRespuestaDoctor").html(res);
			},
			error:function()
			{
				$("#MainRespuestaDoctor").html("error al cargar");
			}
		});
}

function VerCitas()
{
		$("#NewCitas").attr("title","Citas de hoy");	
		$( "#NewCitas" ).dialog({
			autoOpen: false,
			modal: true,
			height:900,
			width:650,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		
		$( "#NewCitas" ).dialog( "open" );
			$.ajax({
				url:'Procesar.php?accion=VerCitasAllHoy',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#NewCitas").html(res);
				},
				error:function()
				{
					$("#NewCitas").html("error al cargar");
				}
				
			});
		
}
function ReloadCitas()
{
			$.ajax({
				url:'Procesar.php?accion=VerCitasAllHoy',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#NewCitas").html(res);
				},
				error:function()
				{
					$("#NewCitas").html("error al cargar");
				}
				
			});
}
function ReservarHoy(codigo)
{		

		$( "#SearchPaciente" ).attr("title","BUSCAR PACIENTE");
		$( "#SearchPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:600,
			width:850,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#SearchPaciente" ).dialog( "open" );
		$("#Buscador").html("<table><tr><td>Buscar: &nbsp;<select id='SearchFor'><option value=''>--Seleccione--</option><option value='ced'>Cédula</option><option value='ape'>Apellido</option></select></td><td><div class='input-append'><input type='text' id='txtBuscar' onkeyup='BuscarPaciente()' /><spand class='add-on'><span class='icon-eye-open'></span></spand> </div></td></tr></table>");
		
		$("#CodHorario").html("<input type='hidden' id='txtCodHora'  value='"+codigo+"'/>");

		
	

}
function BuscarPaciente()
{

	if($("#txtBuscar").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPaciente&buscar='+$("#txtBuscar").val()+'&por='+$("#SearchFor").val()+'&CodigoRol='+2,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RespuestaPaciente").html(res);
			},
			error:function()
			{
				$("#RespuestaPaciente").html("error al cargar");
			}
		});
			
	}
}
function AsignarPaciente(codigo)
{
		$.ajax({
			url:'Procesar.php?accion=AgendarHoy&HoraHoy='+$("#txtCodHora").val()+'&Paciente='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RespuestaAsignacion").html(res);
				setTimeout(function(){ReloadCitas(),CargarConsultasDeHoyXDoctor()},1000);
				setTimeout(function()
				{
					$("#RespuestaAsignacion").html("");
					$("#RespuestaPaciente").html("");
					$( "#SearchPaciente" ).dialog( "close" );
				},3000);
				
			},
			error:function()
			{
				$("#RespuestaAsignacion").html("error al cargar");
			}
		});
		
	
}
function ReservarEmergencia(codigo)
{
		$( "#SearchPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:600,
			width:850,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#SearchPaciente" ).dialog( "open" );
		$("#Buscador").html("Buscar:<select id='SearchFor'><option value=''>--Seleccione--</option><option value='ced'>Cedula</option><option value='ape'>Apellido</option></select><input type='text' id='txtBuscar' onkeyup='BuscarPacienteEmergencia()' />");
		
		$("#CodHorario").html("<input type='hidden' id='txtCodHora'  value='"+codigo+"'/>");
	
}
function BuscarPacienteEmergencia()
{
	if($("#txtBuscar").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPaciente&buscar='+$("#txtBuscar").val()+'&por='+$("#SearchFor").val()+'&CodigoRol='+3,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RespuestaPaciente").html(res);
			},
			error:function()
			{
				$("#RespuestaPaciente").html("error al cargar");
			}
		});
			
	}
}
function AsignarPacienteEmeregencia(codigo)
{
		$.ajax({
			url:'Procesar.php?accion=AgendarHoyEmergencia&HoraHoy='+$("#txtCodHora").val()+'&Paciente='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RespuestaAsignacion").html(res);
				setTimeout(function(){ReloadCitas(),CargarConsultasDeHoyXDoctor()});
				
			},
			error:function()
			{
				$("#RespuestaAsignacion").html("error al cargar");
			}
		});	

}
function DataDoctor()
{
		$.ajax({
			url:'Procesar.php?accion=DataDoc',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#InfoDataDoc").html(res);
				
			},
			error:function()
			{
				$("#InfoDataDoc").html("error al cargar");
			}
		});	
}
function AgendarCitas()
{
	

				
		$("#SearchPaciente").attr("title","Agendar cita para paciente");
		$( "#SearchPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:600,
			width:850,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#SearchPaciente" ).dialog( "open" );
		$("#Buscador").html("Buscar:<select id='SearchFor'><option value=''>--Seleccione--</option><option value='ced'>Cédula</option><option value='ape'>Apellido</option></select><div class='input-append'><input type='text' id='txtBuscar' onkeyup='BuscarPacienteAgendar()' /><spand class='add-on'><span class='icon-eye-open'></span></spand> </div>");	
		
}
function BuscarPacienteAgendar()
{
	if($("#txtBuscar").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPaciente&buscar='+$("#txtBuscar").val()+'&por='+$("#SearchFor").val()+'&CodigoRol='+4,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RespuestaPaciente").html(res);
			},
			error:function()
			{
				$("#RespuestaPaciente").html("error al cargar");
			}
		});
			
	}
}

function AgendarPacienteXDoctor(codigo)
{
	$("#RespuestaAsignacion").html("Buscar Fecha: <input type='text' id='txtFechaAgendDoct'/> <input type='button' id='bntOk321' value='Agendar' />");
	$("#bntOk321").button();
	$('#txtFechaAgendDoct').datepicker({
				changeMonth: true,
				changeYear: true
			});
	$('#txtFechaAgendDoct').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );
	
	
	
	$("#bntOk321").click(function()
	{
		if($('#txtFechaAgendDoct').val()!="")
		{
			
			//guarado los codigo de pacienete y la fecha en la que reserva
	$("#CampoTextocodigo").html("<input type='hidden' id='txtCodigoPacente147' value='"+codigo+"'/><input type='hidden' id='txtfechaReseva147' value='"+$('#txtFechaAgendDoct').val()+"'/>");
	
	//ajax 
			
			$.ajax({
				url:'Procesar.php?accion=HorarioConsutaDoc&FechaPoxima='+$('#txtFechaAgendDoct').val()+'&CodigoForma='+2,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#RespuestaFecha").html(res);
				},
				error:function()
				{
					$("#RespuestaFecha").html("error al cargar");
				}
			});		
		}
		else
		{
			alert("Seleccione una fecha para la proxima consulta");
		}		
	});
	
}
function GenerarTurnoPacienteGeneralXDoctor()
{

			$.ajax({
				url:'Procesar.php?accion=AgendarPcienteXDocotorGeneral&FechaPoxima='+$('#txtfechaReseva147').val()+'&hora12='+$("#cmb_horas").val()+'&CodigoPanciente='+$("#txtCodigoPacente147").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#RespuetaResTurnoDoctor").html(res);
					setTimeout(function(){CargarConsultasDeHoyXDoctor();},1000);
				setTimeout(function()
				{
					$("#RespuestaAsignacion").html("");
					$("#RespuestaPaciente").html("");
					$("#RespuetaResTurnoDoctor").html("");
					$("#RespuestaFecha").html("");
					$( "#SearchPaciente" ).dialog( "close" );
				},3000);
				},
				error:function()
				{
					$("#RespuetaResTurnoDoctor").html("error al cargar");
				}
			});		
}
function EstadoPago(codigo)
{
	$( "#estadopago" ).dialog({
			autoOpen: false,
			modal: true,
			height:200,
			width:300,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#estadopago" ).dialog( "open" );
		$( "#formpago").html("<table><tr><td>Modificar pago</td> <td> <select id='st_pago'><option value=''>Selecione...</option><option>Cancelado </option> <option>Pendiente</option></select></td></tr><tr><td colspan='2'><input type='button' class='btn' id='btn_pago' value='guardar'/></td></tr> </table>");
		$("#btn_pago").button();
		$("#btn_pago").click(function(){
			if($("#st_pago").val()!=""){
				$.ajax({
				url:'Procesar.php?accion=actualizarpago&codigoturno='+codigo+'&pago='+$("#st_pago").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#formpago").html(res);
					setTimeout(function(){CargarConsultasDeHoyXDoctor();},1000);
				},
				error:function()
				{
					$("#formpago").html("error al cargar");
				}
			});		
				}
				else
				{
					alert("selecione una opcion");
				}
			}); 
}

function LoadExamenNow(codigo)
{
		$.ajax({
				url:'Procesar.php?accion=LoadDataExamenNow&CodigoExamenNow='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#ExamenFiscoActualLoad").html(res);
				},
				error:function()
				{
					$("#ExamenFiscoActualLoad").html("error al cargar");
				}
			});	
}
//funcion para guardar Examen Fisico
function SaveExamenfisico()
{
	var codigo=$('#codigoPaciente').val();
	//alert(codigo);
					$.ajax({
					url:'Procesar.php?accion=DataExamen&ComboBiotipo='+$('#cbo_biotipo').val()+'&Actitud='+$("#txt_actitud").val()+'&Conciencia='+$('#txt_conciencia').val()+'&GlasGow='+$('#txt_glas').val()+'&Teperatura='+$("#txt_tempe").val()+'&PrecionArterial='+$('#txt_arterial').val()+'&FrecuenciaCardiaca='+$('#txt_cardica').val()+'&FrecuenciaRespiratoria='+$("#txt_respiratoria").val()+'&Peso='+$("#txt_peso").val()+'&Talla='+$("#txt_talla").val()+'&MasaCorporal='+$("#txt_MCorp").val()+'&PerimetroCefalico='+$("#txt_PCefalico").val()+'&PerimetroToracico='+$("#txt_PToracico").val()+'&PerimetroAbdominal='+$('#txt_abdominal').val()+'&PesoIdeal='+$('#txt_PesoIdeal').val()+'&TenArtAcostado='+$('#txt_TAacostado').val()+'&TenArtSentado='+$('#txt_TAsentado').val()+'&TenArtPie='+$('#txt_TApie').val()+'&SuperCorporal='+$('#txt_Scorporal').val()+'&Piel='+$('#txt_piel').val()+'&CCfaciees='+$('#txt_facies').val()+'&CCojos='+$('#txt_ojos').val()+'&CCNariz='+$('#txt_nariz').val()+'&CCboca='+$('#txt_boca').val()+'&CCoido='+$('#txt_oidos').val()+'&CCfaringe='+$('#txt_faringe').val()+'&Cuforma='+$('#txt_Cforma').val()+'&Cumovi='+$('#txt_Cmovimiento').val()+'&Cupiel='+$('#txt_Cpiel').val()+'&CuParBlan='+$('#txt_CParBlandas').val()+'&Cutiroides='+$('#txt_CTiroides').val()+'&Cuganglios='+$('#txt_Cganglios').val()+'&Trespita='+$('#txt_TMovRespira').val()+'&Tpiel='+$('#txt_TPiel').val()+'&TBlandas='+$('#txt_TParBlandas').val()+'&Tmamas='+$('#txt_Tmamas').val()+'&ToCorazon='+$('#txt_TCorazon').val()+'&ToPulmones='+$('#txt_TPulmones').val()+'&AdPiel='+$('#txt_AbPiel').val()+'&AdForVoTam='+$('#txt_AbFVT').val()+'&AdTblandaParte='+$('#txt_AbParBlandas').val()+'&AparatoUrinario='+$('#txt_urinario').val()+'&AparatoDigestivo='+$('#txt_digestivo').val()+'&AparatoGMasculino='+$('#txt_masculino').val()+'&AparatoGFemenino='+$('#txt_femenino').val()+'&MusculoEsqueletico='+$('#txt_esqueletico').val()+'&SistemaNervioso='+$('#txt_nervioso').val()+'&codigo='+codigo+'&turno='+$("#CajaOcultaFenixTurno").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#ExamesFisicos2").html(res);
						LoadExamenNow($("#CajaOcultaFenixTurno").val());
						/*setInterval(function()
						{
							$( "#ExamesFisicos2" ).dialog( "close" );
							
							
						},10000);*/
					},
					error:function()
					{
						$("#ExamesFisicos2").html("Error al cargar la inf");
					}
						});
}

function datosvademecun()
{
	$("#AreaVademecun").attr("title","Vademecun");
		$("#AreaVademecun").dialog({
			autoOpen: false,
			modal: true,
			height:600,
			width:800,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$("#AreaVademecun").dialog( "open");
		
	$.ajax({
				url:'Procesar.php?accion=VademecunCargar',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#AreaVademecun").html(res);
				},
				error:function()
				{
					$("#AreaVademecun").html("error al cargar");
				}
			});
		
}

function CodigoVademecum (codigo)
{
	$.ajax({
				url:'Procesar.php?accion=recetarvademecun&codvade='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
				$("#txtCodigoVade").attr("value",""+res+"");
				$("#AreaVademecun").dialog( "close");
				},
				error:function()
				{
					//$("#AreaVademecun").html("error al cargar");
				}
			});
				
				
}
//funcion para ver el nuevo diagnostico 
function HistorialPacienteNew(codigo)
{
	$("#HistorialPaciente").attr("title","Historial Del Paciente");
	$( "#HistorialPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:600,
			width:1300,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#HistorialPaciente" ).dialog( "open" );	
	$.ajax({
				url:'Procesar.php?accion=NewDiagnosticoDelPaciente&CodigoPaciente159='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#HistorialPaciente").html(res);
				},
				error:function()
				{
					$("#HistorialPaciente").html("Errror Alcargar");
				}
			});	
}
//funcion para finalizar con el paciente
function FinPaciente()
{
	codigo=$("#imagenes123").val();
	$.ajax({
				url:'Procesar.php?accion=EndPaciete&CodigoTurno753='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
						setTimeout(function(){CargarConsultasDeHoyXDoctor()},500);			
				},
				error:function()
				{
					//$("#HistorialPaciente").html("Errror Alcargar");
				}
			});	
			CargarConsultasDeHoyXDoctor();	

}
//funcion para cargar las consultas de hoy echas a el paciente por turno
function ToLoadConsTodayNowToTurn()
{
	codigo=$("#imagenes123").val();
	$.ajax({
				url:'Procesar.php?accion=LoadNowconsHoyPorTunoN&CodigoTurno951='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
						$("#RespConsulta").html(res);
				},
				error:function()
				{
					$("#RespConsulta").html("Errror Alcargar");
				}
			});		
}
//fin funcion para cargar las consultas de hoy echas a el paciente por turno
window.onload = function() {
	//setTimeout(function(){ReloadConsutlasHoy()},1000);
}

function ShowHistoria(codigo){
		$("#HistoriPacientes").attr("title","Historial Del Paciente");
	$( "#HistoriPacientes" ).dialog({
			autoOpen: false,
			modal: true,
			height:600,
			width:1000,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#HistoriPacientes" ).dialog( "open" );	
$( "#HistoriPacientes" ).html("<object type='text/html' data='../Reportes/HistoriaCli2.php?id="+codigo+"'></object>");					
			
}
function AgendaDoctor(){
	$("#ResSearchAgenda").html("");
	$("#AgendaDoctor").attr("title","Agenda");
	$( "#AgendaDoctor" ).dialog({
			autoOpen: false,
			modal: true,
			height:600,
			width:1000,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#AgendaDoctor" ).dialog( "open" );	
		$("#FrmSearchAgenda").html("<table><tr><th>Fecha de las Consultas</th><td><input type='text' id='txtFechaAgenda'></td><td><input type='button' id='btnBuscaAge' value='Buscar' class='btn btn-success'/></td></tr><table>");
			$('#txtFechaAgenda').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtFechaAgenda').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );	
			$("#btnBuscaAge").click(function(){
				if($('#txtFechaAgenda').val()!=""){
				$.ajax({
							url:'Procesar.php?accion=VerAgendaXFecha&FechaAgenda='+$('#txtFechaAgenda').val(),
							type:'GET',
							cache:false,
							success:function(res)
							{
									$("#ResSearchAgenda").html(res);
							},
							error:function()
							{
								$("#ResSearchAgenda").html("Errror Alcargar");
							}
					});	
					
				}else{
					alert("Seleccione una fecha");
				}
			});	
		
		
		/*
	$.ajax({
				url:'Procesar.php?accion=VerAgendaAll',
				type:'GET',
				cache:false,
				success:function(res)
				{
						$("#AgendaDoctor").html(res);
				},
				error:function()
				{
					$("#AgendaDoctor").html("Errror Alcargar");
				}
		});	
			*/		
		
}
function PrintREceta(codigo){
;
	$( "#AreReceta2" ).attr("title","Receta");
	$( "#AreReceta2" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:900,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

$( "#AreReceta2" ).dialog( "open" );
$( "#AreReceta2" ).html("<object type='text/html' data='../Reportes/Receta2.php?id="+codigo+"'></object>");		
}
//start modal signos vitales
function Signosvitales()
{
	$("#SignosVitales").attr("title","4. SIGNOS VITALES");
	$( "#SignosVitales" ).dialog({
			autoOpen: false,
			modal: true,
			height:200,
			width:815,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#SignosVitales" ).dialog( "open" );	
	$.ajax({
					url:'Procesar.php?accion=LoadDatosSignosVitales&CodigoPaciente89='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#SignosVitales").html(res);
					},
					error:function()
					{
						$("#SignosVitales").html("error al cargar");
					}
				});
	/*$( "#SignosVitales" ).html("<table width='720' border='1' class='table table-bordered table-striped table-hover table-condensed '> <tr> <td width='169'>1. PRESIÓN ARTERIAL.</td> <td width='161'><input type='text' style='width:160px;' id='txtPresionArte'/></td> <td width='206'>2. FRECUENCIA CARDIACA.</td> <td width='160'><input type='text' style='width:160px;' id='txtFreCardi'/></td> </tr> <tr> <td>3. TEMPERATURA A °C</td> <td><input type='text' style='width:160px;' id='txtTempe_C'/></td> <td>4. F. RESPIRAT. min.</td> <td><input type='text' style='width:160px;' id='txtFrespiratmin'/></td> </tr> <tr> <td colspan='4'><center><input type='button' id='bntGuardarSignosVitales' style='width:100px;' class='btn btn-primary'  onclick='SaveSignosVi()' value='Guardar'></center></td> </tr> </table>");  */
}
//end modal signos vitales
//start save signos vitales
function SaveSignosVi()
{
	$.ajax({
			url:'Procesar.php?accion=SaveSignosVitales&CodePac17='+$('#codigoPaciente').val()+'&pressnarterial='+$("#txtPresionArte").val()+'&frecardiaca='+$("#txtFreCardi").val()+'&tempeC='+$("#txtTempe_C").val()+'&frespiramin='+$("#txtFrespiratmin").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#SignosVitales").html(res);
			},
			error:function()
			{
				$("#SignosVitales").html("error al cargar");
			}
		});
}
//end save signos vitales
//start examen del sistema estomatognatico
function ExaSistEstoma()
{
	$("#AreadeSistEstomatognatico").attr("title","5. EXAMEN DEL SISTEMA ESTOMATOGNÁTICO");
	$( "#AreadeSistEstomatognatico" ).dialog({
			autoOpen: false,
			modal: true,
			height:460,
			width:850,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreadeSistEstomatognatico" ).dialog( "open" );	
	$.ajax({
					url:'Procesar.php?accion=LoadDatosEstoma&CodigoPaciente09='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreadeSistEstomatognatico").html(res);
					},
					error:function()
					{
						$("#AreadeSistEstomatognatico").html("error al cargar");
					}
				});	
	/*$( "#AreadeSistEstomatognatico" ).html("<table width='865' border='1' class='table table-bordered table-striped table-hover table-condensed' > <tr> <th colspan='5'><b>Exámen del Sistema Estomatognático</b></th> </tr> <tr> <td width='131'><input type='checkbox' class='chkEstomatognatico' id='LABIOS'>1. LABIOS</td> <td width='146'><input type='checkbox' class='chkEstomatognatico' id='MEJILLAS'>2. MEJILLAS</td> <td width='210'><input type='checkbox' class='chkEstomatognatico' id='MAXILAR SUPERIOR'>3. MAXILAR SUPERIOR</td> <td width='240'><input type='checkbox' class='chkEstomatognatico' id='MAXILAR INFERIOR'>4. MAXILAR INFERIOR</td> <td width='166'><input type='checkbox' class='chkEstomatognatico' id='LENGUA'>5. LENGUA</td> </tr> <tr> <td><input type='checkbox' class='chkEstomatognatico' id='PALADAR'>6. PALADAR</td> <td><input type='checkbox' class='chkEstomatognatico' id='PISO'>7. PISO</td> <td><input type='checkbox' class='chkEstomatognatico' id='CARRILLOS'>8. CARRILLOS </td> <td><input type='checkbox' class='chkEstomatognatico' id='GLANDULAS SALIBALES'>9. GLANDULAS SALIBALES </td> <td><input type='checkbox' class='chkEstomatognatico' id='ORO FARINGE'>10. ORO FARINGE </td> </tr> <tr> <td><input type='checkbox' class='chkEstomatognatico' id='A.T.M.'>11. A.T.M.</td> <td><input type='checkbox' class='chkEstomatognatico' id='GANGLIOS'>12. GANGLIOS</td> <td colspan='3'>&nbsp;</td> </tr> <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <td colspan='5'>Describir abajo la patología de la región afectada anotando el número.</td> </tr> <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <th colspan='3'><b>DETALLE </b></th> <td>&nbsp;</td> <td>&nbsp;</td> </tr> <tr> <td colspan='3'><textarea cols='30' rows='2' id='txt_detalle' style='width:472px'></textarea></td> <td>&nbsp;</td> <!-- <td><input type='button' id='bntExOdontologico'  class='btn btn-primary' value='Imprimir Exámen' onclick='ImprOdontologico()' /></td> --> <td><input type='button' id='bntExEstoma'  class='btn btn-primary' value='Guardar' onclick='SaveExEstoma()' /></td> </tr> </table>"); */
}
//end examen del sistema estomatognatico

//start funcion para guardar los examenes del sistema estomatognatico
function SaveExEstoma()
{
	$.ajax({
			url:'Procesar.php?accion=SaveSistemaEstoma&CodPac09='+$('#codigoPaciente').val()+'&labios='+$("#LABIOS").is(":checked")+'&mejillas='+$("#MEJILLAS").is(":checked")+'&maxilarsup='+$("#MAXILARSUPERIOR").is(":checked")+'&maxilarinf='+$("#MAXILARINFERIOR").is(":checked")+'&lengua='+$("#LENGUA").is(":checked")+'&paladar='+$("#PALADAR").is(":checked")+'&piso='+$("#PISO").is(":checked")+'&carrillos='+$("#CARRILLOS").is(":checked")+'&glsalibales='+$("#GLANDULASSALIBALES").is(":checked")+'&ofaringe='+$("#FARINGE").is(":checked")+'&atm='+$("#ATM").is(":checked")+'&ganglios='+$("#GANGLIOS").is(":checked")+'&detallesisestoma='+$('#txt_detalle').val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreadeSistEstomatognatico").html(res);
			},
			error:function()
			{
				$("#AreadeSistEstomatognatico").html("error al cargar");
			}
		});
}
//fin funcion para guardar los examenes del sistema estomatognatico

//start modal indicadores de salud bucal
function IndicadoresBucal()
{	
	$("#IndicadoresSaludBucal").attr("title","7. INDICADORES DE SALUD BUCAL");
	$( "#IndicadoresSaludBucal" ).dialog({
			autoOpen: false,
			modal: true,
			height:540,
			width:850,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#IndicadoresSaludBucal" ).dialog( "open" );	
			$.ajax({
					url:'Procesar.php?accion=LoadDatosSaludbucal&CodigoPaciente7='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#IndicadoresSaludBucal").html(res);
					},
					error:function()
					{
						$("#IndicadoresSaludBucal").html("error al cargar");
					}
				});
	/*$( "#IndicadoresSaludBucal" ).html("<table class='table table-bordered table-striped table-condensed ' > <tr><td colspan='10' align='center'><center>HIGIENE ORAL SIMPLIFICADA</center></td> <td width='1' rowspan='10'>&nbsp;</td> <td colspan='6'>&nbsp;</td> </tr> <tr> <td colspan='6'>&nbsp;</td> <td width='1' rowspan='9'>&nbsp;</td> <td width='74'>Placa</td> <td width='74'>Cálculo</td> <td width='73'>Gingivitis</td> <td colspan='2'>Enfermedad<br /> Periodontal</td> <td colspan='2'>Mal Oclusión</td> <td colspan='2'>Fluorosis</td> </tr> <tr> <td colspan='6'>Piezas Dentales</td> <td>0 - 1 - 2 - 3</td> <td>0 - 1 - 2 - 3</td> <td>0 - 1</td> <td width='68'>Leve</td> <td width='20'><input type='checkbox' class='chkIndicadores' id='LeveEnferPeriodon'></td> <td width='61'>Angle I</td> <td width='20'><input type='checkbox' class='chkIndicadores' id='Angle_I'></td> <td width='64'>Leve</td> <td width='23'><input type='checkbox' class='chkIndicadores' id='LeveFluorosis'></td> </tr> <tr> <td width='16'>16</td> <td width='20'><input type='checkbox' class='chkPiezasDental' id='16'></td> <td width='16'>17</td> <td width='20'><input type='checkbox' class='chkPiezasDental' id='17'></td> <td width='16'>55</td> <td width='20'><input type='checkbox' class='chkPiezasDental' id='55'></td> <td><input type='text' id='txtPlaca1' style='width:72px' /></td> <td><input type='text' id='Calculo1' style='width:72px' /></td> <td><input type='text' id='Gingivitis1' style='width:72px' /></td> <td>Moderada</td> <td><input type='checkbox' class='chkIndicadores' id='ModeradaEnferPeriodon'></td> <td>Angle II</td> <td><input type='checkbox' class='chkIndicadores' id='Angle_II'></td> <td>Moderada</td> <td><input type='checkbox' class='chkIndicadores' id='ModeradaFluorosis'></td> </tr> <tr> <td>11</td> <td><input type='checkbox' class='chkPiezasDental' id='11'></td> <td>21</td> <td><input type='checkbox' class='chkPiezasDental' id='21'></td> <td>51</td> <td><input type='checkbox' class='chkPiezasDental' id='51'></td> <td><input type='text' id='txtPlaca2' style='width:72px' /></td> <td><input type='text' id='Calculo2' style='width:72px' /></td> <td><input type='text' id='Gingivitis2' style='width:72px' /></td> <td>Severa</td> <td><input type='checkbox' class='chkIndicadores' id='SeveraEnferPeriodon'></td> <td>Angle III</td> <td><input type='checkbox' class='chkIndicadores' id='Angle_III'></td> <td>Severa</td> <td><input type='checkbox' class='chkIndicadores' id='SeveraFluorosis'></td> </tr> <tr> <td>26</td> <td><input type='checkbox' class='chkPiezasDental' id='26'></td> <td>27</td> <td><input type='checkbox' class='chkPiezasDental' id='27'></td> <td>65</td> <td><input type='checkbox' class='chkPiezasDental' id='65'></td> <td><input type='text' id='txtPlaca3' style='width:72px' /></td> <td><input type='text' id='Calculo3' style='width:72px' /></td> <td><input type='text' id='Gingivitis3' style='width:72px' /></td> <td colspan='6'>&nbsp;</td> </tr> <tr> <td>36</td> <td><input type='checkbox' class='chkPiezasDental' id='36'></td> <td>37</td> <td><input type='checkbox' class='chkPiezasDental' id='37'></td> <td>75</td> <td><input type='checkbox' class='chkPiezasDental' id='75'></td> <td><input type='text' id='txtPlaca4' style='width:72px' /></td> <td><input type='text' id='Calculo4' style='width:72px' /></td> <td><input type='text' id='Gingivitis4' style='width:72px' /></td> <td colspan='6' rowspan='3'>&nbsp;</td> </tr> <tr> <td>31</td> <td><input type='checkbox' class='chkPiezasDental' id='31'></td> <td>41</td> <td><input type='checkbox' class='chkPiezasDental' id='41'></td> <td>71</td> <td><input type='checkbox' class='chkPiezasDental' id='71'></td> <td><input type='text' id='txtPlaca5' style='width:72px' /></td> <td><input type='text' id='Calculo5' style='width:72px' /></td> <td><input type='text' id='Gingivitis5' style='width:72px' /></td> </tr> <tr> <td>46</td> <td><input type='checkbox' class='chkPiezasDental' id='46'></td> <td>47</td> <td><input type='checkbox' class='chkPiezasDental' id='47'></td> <td>85</td> <td><input type='checkbox' class='chkPiezasDental' id='85'></td> <td><input type='text' id='txtPlaca6' style='width:72px' /></td> <td><input type='text' id='Calculo6' style='width:72px' /></td> <td><input type='text' id='Gingivitis6' style='width:72px' /></td> </tr> <tr> <td colspan='6'><center>Totales: </center></td> <td><input type='text' id='TotalPlaca' style='width:72px' onfocus='TotalePlaca()' /></td> <td><input type='text' id='TotalCalculo' onfocus='TotalesCalculo()' style='width:72px' /></td> <td><input type='text' id='TotalGingivitis' style='width:72px' onfocus='TotalesGingivitis()'/></td> <td colspan='3'>&nbsp;</td><td colspan='3'><center><input type='button' id='bntGuardarSaludbucal' style='width:100px;' class='btn btn-info'  onclick='SaveIndicadoresSaludb()' value='Guardar'></center></td></tr> <tr> <td colspan='17'></td> </tr> </table>");*/
}
//end modal indicadores de salud bucal
//start placa totals
function TotalePlaca()
{
	var count=0;
	var aux1=0;
	var aux2=0;
	var aux3=0;
	var aux4=0;
	var aux5=0;
	var aux6=0;
	
	if($("#txtPlaca1").val()!="")
	{
		aux1=$("#txtPlaca1").val();
		count++;
	}
	else
	{
		$("#txtPlaca1").attr("value","");
		aux1=0;
	}
	if($("#txtPlaca2").val()!="")
	{
		aux2=$("#txtPlaca2").val();
		count++;
	}
	else
	{
		$("#txtPlaca2").attr("value","");
		aux2=0;
	}
	if($("#txtPlaca3").val()!="")
	{
		aux3=$("#txtPlaca3").val();
		count++;
	}
	else
	{
		$("#txtPlaca3").attr("value","");
		aux3=0;
	}
	if($("#txtPlaca4").val()!="")
	{
		aux4=$("#txtPlaca4").val();
		count++;
	}
	else
	{
		$("#txtPlaca4").attr("value","");
		aux4=0;
	}
	if($("#txtPlaca5").val()!="")
	{
		aux5=$("#txtPlaca5").val();
		count++;
	}
	else
	{
		$("#txtPlaca5").attr("value","");
		aux5=0;
	}
	if($("#txtPlaca6").val()!="")
	{
		aux6=$("#txtPlaca6").val();
		count++;
	}
	else
	{
		$("#txtPlaca6").attr("value","");
		aux6=0;
	}
	
		var res1=parseInt(aux1)+parseInt(aux2)+parseInt(aux3)+parseInt(aux4)+parseInt(aux5)+parseInt(aux6);
		var res2=count;
		var res=res1/res2;
	$("#TotalPlaca").attr("value",""+res+"");
}
//end placa totals
//start total calculo
function TotalesCalculo()
{
	var count=0;
	var aux1=0;
	var aux2=0;
	var aux3=0;
	var aux4=0;
	var aux5=0;
	var aux6=0;
	
	if($("#Calculo1").val()!="")
	{
		aux1=$("#Calculo1").val();
		count++;
	}
	else
	{
		$("#Calculo1").attr("value","");
		aux1=0;
	}
	if($("#Calculo2").val()!="")
	{
		aux2=$("#Calculo2").val();
		count++;
	}
	else
	{
		$("#Calculo2").attr("value","");
		aux2=0;
	}
	if($("#Calculo3").val()!="")
	{
		aux3=$("#Calculo3").val();
		count++;
	}
	else
	{
		$("#Calculo3").attr("value","");
		aux3=0;
	}
	if($("#Calculo4").val()!="")
	{
		aux4=$("#Calculo4").val();
		count++;
	}
	else
	{
		$("#Calculo4").attr("value","");
		aux4=0;
	}
	if($("#Calculo5").val()!="")
	{
		aux5=$("#Calculo5").val();
		count++;
	}
	else
	{
		$("#Calculo5").attr("value","");
		aux5=0;
	}
	if($("#Calculo6").val()!="")
	{
		aux6=$("#Calculo6").val();
		count++;
	}
	else
	{
		$("#Calculo6").attr("value","");
		aux6=0;
	}
	
		var res1=parseInt(aux1)+parseInt(aux2)+parseInt(aux3)+parseInt(aux4)+parseInt(aux5)+parseInt(aux6);
		var res2=count;
		var res=res1/res2;
	$("#TotalCalculo").attr("value",""+res+"");
}
//end total caclculo
//start totales gingivitis
function TotalesGingivitis()
{
	var count=0;
	var aux1=0;
	var aux2=0;
	var aux3=0;
	var aux4=0;
	var aux5=0;
	var aux6=0;
	
	if($("#Gingivitis1").val()!="")
	{
		aux1=$("#Gingivitis1").val();
		count++;
	}
	else
	{
		$("#Gingivitis1").attr("value","");
		aux1=0;
	}
	if($("#Gingivitis2").val()!="")
	{
		aux2=$("#Gingivitis2").val();
		count++;
	}
	else
	{
		$("#Gingivitis2").attr("value","");
		aux2=0;
	}
	if($("#Gingivitis3").val()!="")
	{
		aux3=$("#Gingivitis3").val();
		count++;
	}
	else
	{
		$("#Gingivitis3").attr("value","");
		aux3=0;
	}
	if($("#Gingivitis4").val()!="")
	{
		aux4=$("#Gingivitis4").val();
		count++;
	}
	else
	{
		$("#Gingivitis4").attr("value","");
		aux4=0;
	}
	if($("#Gingivitis5").val()!="")
	{
		aux5=$("#Gingivitis5").val();
		count++;
	}
	else
	{
		$("#Gingivitis5").attr("value","");
		aux5=0;
	}
	if($("#Gingivitis6").val()!="")
	{
		aux6=$("#Gingivitis6").val();
		count++;
	}
	else
	{
		$("#Gingivitis6").attr("value","");
		aux6=0;
	}
	
		var res1=parseInt(aux1)+parseInt(aux2)+parseInt(aux3)+parseInt(aux4)+parseInt(aux5)+parseInt(aux6);
		var res2=count;
		var res=res1/res2;
	$("#TotalGingivitis").attr("value",""+res+"");
}
//end totales gingivitis
//start Save Indicadores de salud bucal Table
function SaveIndicadoresSaludb()
{
	$.ajax({
			url:'Procesar.php?accion=SaveSaludbucal&CodPac='+$('#codigoPaciente').val()+'&piezadental16='+$("#16").is(":checked")+'&piezadental17='+$("#17").is(":checked")+'&piezadental55='+$("#55").is(":checked")+'&piezadental11='+$("#11").is(":checked")+'&piezadental21='+$("#21").is(":checked")+'&piezadental51='+$("#51").is(":checked")+'&piezadental26='+$("#26").is(":checked")+'&piezadental27='+$("#27").is(":checked")+'&piezadental65='+$("#65").is(":checked")+'&piezadental36='+$("#36").is(":checked")+'&piezadental37='+$("#37").is(":checked")+'&piezadental75='+$("#75").is(":checked")+'&piezadental31='+$("#31").is(":checked")+'&piezadental41='+$("#41").is(":checked")+'&piezadental71='+$("#71").is(":checked")+'&piezadental46='+$("#46").is(":checked")+'&piezadental47='+$("#47").is(":checked")+'&piezadental85='+$("#85").is(":checked")+"&PlacaV1="+$("#txtPlaca1").val()+"&PlacaV2="+$("#txtPlaca2").val()+"&PlacaV3="+$("#txtPlaca3").val()+"&PlacaV4="+$("#txtPlaca4").val()+"&PlacaV5="+$("#txtPlaca5").val()+"&PlacaV6="+$("#txtPlaca6").val()+"&PlacaRess="+$("#TotalPlaca").val()+"&CalculoV1="+$("#Calculo1").val()+"&CalculoV2="+$("#Calculo2").val()+"&CalculoV3="+$("#Calculo3").val()+"&CalculoV4="+$("#Calculo4").val()+"&CalculoV5="+$("#Calculo5").val()+"&CalculoV6="+$("#Calculo6").val()+"&CalculoRess="+$("#TotalCalculo").val()+"&GingivitisV1="+$("#Gingivitis1").val()+"&GingivitisV2="+$("#Gingivitis2").val()+"&GingivitisV3="+$("#Gingivitis3").val()+"&GingivitisV4="+$("#Gingivitis4").val()+"&GingivitisV5="+$("#Gingivitis5").val()+"&GingivitisV6="+$("#Gingivitis6").val()+"&GingivitisRess="+$("#TotalGingivitis").val()+'&EnfePeriodonLeve='+$("#LeveEnferPeriodon").is(":checked")+'&EnfePeriodonModerada='+$("#ModeradaEnferPeriodon").is(":checked")+'&EnfePeriodonSevera='+$("#SeveraEnferPeriodon").is(":checked")+'&MalOcluAngle1='+$("#Angle_I").is(":checked")+'&MalOcluAngle2='+$("#Angle_II").is(":checked")+'&MalOcluAngle3='+$("#Angle_III").is(":checked")
+'&FluorosisLeve='+$("#LeveFluorosis").is(":checked")+'&FluorosisModerada='+$("#ModeradaFluorosis").is(":checked")+'&FluorosisSeve='+$("#SeveraFluorosis").is(":checked"),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#IndicadoresSaludBucal").html(res);
			},
			error:function()
			{
				$("#IndicadoresSaludBucal").html("error al cargar");
			}
		});
}
//end Save Indicadores de salud bucal Table
//star indices cpo - ceo
function IndicesCpoceo()
{
	$("#AreaIndicesCpo").attr("title","8. ÍNDICES CPO - ceo");
	$( "#AreaIndicesCpo" ).dialog({
			autoOpen: false,
			modal: true,
			height:287,
			width:520,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreaIndicesCpo" ).dialog( "open" );	
	$.ajax({
					url:'Procesar.php?accion=LoadDatosIndicesCPOCeo&CodigoPaciente27='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreaIndicesCpo").html(res);
					},
					error:function()
					{
						$("#AreaIndicesCpo").html("error al cargar");
					}
				});
	/*$( "#AreaIndicesCpo" ).html("<table class='table table-bordered table-striped table-condensed ' > <tr> <td colspan='5'>&nbsp;</td> </tr> <tr> <td width='11' rowspan='2'>D</td> <td width='72'>C</td> <td width='72'>P</td> <td width='12'>O</td> <td width='98'>Total.</td> </tr> <tr> <td><input type='text' id='txtIndicesC' style='width:72px' /></td> <td><input type='text' id='txtIndicesP' style='width:72px' /></td> <td><input type='text' id='txtIndicesO' style='width:72px' /></td> <td><input type='text' id='txtTotalIndicesCpo' style='width:72px' onfocus='TotalCPO()' /></td> </tr> <tr> <td rowspan='2'>d</td> <td>c</td> <td>e</td> <td>o</td> <td>Total.</td> </tr> <tr> <td><input type='text' id='txtIndicesc' style='width:72px' /></td> <td><input type='text' id='txtIndicese' style='width:72px' /></td> <td><input type='text' id='txtIndiceso' style='width:72px' /></td> <td><input type='text' id='txtTotalIndicesceo' style='width:72px' onfocus='Totalceo()' /></td> </tr> <tr><td colspan='5'><center><input type='button' id='bntSalvarIndicesCPOCeo' style='width:100px;' class='btn btn-info'  onclick='SaveIndicesCPOCeo()' value='Guardar'></center></td></tr> </table>"); */
}
//end indices cpo - ceo
//start calcular total CPO
function TotalCPO()
{
	var count=0;
	
	var aux1=0;
	var aux2=0;
	var aux3=0;

	if($("#txtIndicesC").val()!="" & $("#txtIndicesP").val()!="" & $("#txtIndicesO").val()!="")
	{
		aux1=$("#txtIndicesC1").val();
		aux2=$("#txtIndicesP1").val();
		aux3=$("#txtIndicesO1").val();
		var res=(parseInt(aux1)+parseInt(aux2)+parseInt(aux3));
		$("#txtTotalIndicesCpo").attr("value",""+res+"");
	}
}
//end calcular total CPO
//start calcular total ceo
function Totalceo()
{
	var count=0;
	
	var aux1=0;
	var aux2=0;
	var aux3=0;

	if($("#txtIndicesc").val()!="" & $("#txtIndicese").val()!="" & $("#txtIndiceso").val()!="")
	{
		aux1=$("#txtIndicesc2").val();
		aux2=$("#txtIndicese2").val();
		aux3=$("#txtIndiceso2").val();
		var res=(parseInt(aux1)+parseInt(aux2)+parseInt(aux3));
		$("#txtTotalIndicesceo").attr("value",""+res+"");
	}
}
//end calcular total ceo
//start function salvar datos de Indices CPO ceo
function SaveIndicesCPOCeo()
{
	$.ajax({
			url:'Procesar.php?accion=SaveCPOCeo&CodePaciente='+$('#codigoPaciente').val()+'&IndicesCPO1='+$("#txtIndicesC1").val()+'&IndicesCPO2='+$("#txtIndicesP1").val()+'&IndicesCPO3='+$("#txtIndicesO1").val()+'&IndicesCPOTotal='+$("#txtTotalIndicesCpo").val()+'&Indicesceo1='+$("#txtIndicesc2").val()+'&Indicesceo2='+$("#txtIndicese2").val()+'&Indicesceo3='+$("#txtIndiceso2").val()+'&IndicesceoTotal='+$("#txtTotalIndicesceo").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreaIndicesCpo").html(res);
			},
			error:function()
			{
				$("#AreaIndicesCpo").html("error al cargar");
			}
		});
}
//end function salvar datos de Indices CPO ceo
//start planes de diagnostico terapeutico y educacional
function PlanesDiagnTerapeutico()
{
	$("#AreadeDiagnTerapeutico").attr("title","10. PLANES DE DIAGNÓSTICO, TERAPÉUTICO Y EDUCACIONAL");
	$( "#AreadeDiagnTerapeutico" ).dialog({
			autoOpen: false,
			modal: true,
			height:260,
			width:550,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#AreadeDiagnTerapeutico" ).dialog( "open" );	
	$.ajax({
					url:'Procesar.php?accion=LoadDatosPlanesD&CodigoPaciente00='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreadeDiagnTerapeutico").html(res);
					},
					error:function()
					{
						$("#AreadeDiagnTerapeutico").html("error al cargar");
					}
				});
	/*$( "#AreadeDiagnTerapeutico" ).html("<table class='table table-bordered table-striped table-condensed ' > <tr> <td width='76'>Biometría</td> <td width='22'><input type='checkbox' class='chkPlanesDiagTeraEd' id='Biometría'></td> <td width='124'>Química Sanguínea</td> <td width='21'><input type='checkbox' class='chkPlanesDiagTeraEd' id='Química_Sanguínea'></td> <td width='75'>Rayos - x</td> <td width='21'><input type='checkbox' class='chkPlanesDiagTeraEd' id='Rayos_x'></td> <td width='43'>Otros</td> <td width='21'><input type='checkbox' class='chkPlanesDiagTeraEd' id='Otros'></td> </tr> <tr> <td colspan='8'>&nbsp;</td> </tr> <tr> <td colspan='8'>Detalle: </td> </tr> <tr> <td colspan='8'><textarea id='txtDetallePlanesDiagnTeraEd' cols='40' rows='2' style='width:479px'></textarea></td> </tr> <tr><td colspan='8'><center><input type='button' id='bntGuardarPlanesDi' style='width:100px;' class='btn btn-info'  onclick='SavePlanesDiagnosticoTE()' value='Guardar'></center></td></tr> </table>");*/
}
//end planes de diagnostico terapeutico y educacional
//start function para guardar los planes de diagnostico terap. y educacional
function SavePlanesDiagnosticoTE()
{
	$.ajax({
			url:'Procesar.php?accion=SavePlanesD&CodPaciente='+$('#codigoPaciente').val()+'&biome='+$("#Biometría").is(":checked")+'&quimsang='+$("#Química_Sanguínea").is(":checked")+'&rayosx='+$("#Rayos_x").is(":checked")+'&otros='+$("#Otros").is(":checked")+'&detalleplanes='+$('#txtDetallePlanesDiagnTeraEd').val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreadeDiagnTerapeutico").html(res);
			},
			error:function()
			{
				$("#AreadeDiagnTerapeutico").html("error al cargar");
			}
		});
}
//end function para guardar los planes de diagnostico terap. y educacional

//start imprimir examen del sistema estomatognatico
function ImprOdontologico()
{
	detalleEE=$("#txt_detalle").val();
	$(".chkEstomatognatico").each(function()
	{
		if($(this).attr("checked"))
		{
			$.ajax({
				url:'Procesar.php?accion=GuardarEstoma&Codtu='+$("#imagenes123").val()+'&DescOdonto='+$(this).val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					
					$( '#areaEstoma' ).dialog({
						autoOpen: false,
						modal: true,
						height:600,
						width:600,
						show: {
							effect: 'blind',
							duration: 1000
						},
						hide: {
							effect: 'explode',
							duration: 1000
						}
					});
					
					$( '#areaEstoma' ).dialog( 'open' );
				$( "#areaEstoma" ).html("<object type='text/html' data='../Reportes/Estomatognatico.php?id="+$("#imagenes123").val()+"&Detalle="+$("#txt_detalle").val()+"'></object>");
				},
				error:function()
				{
					$("#Modal7").html();
				}
				
			});	
		}
	});
}
//start imprimir examen del sistema estomatognatico






//abrir Odontograma
function  OPenOdontograma(){




	$( '#OdontogramaLightV2' ).attr("title","Odontograma");
	$( '#OdontogramaLightV2' ).dialog({
						autoOpen: false,
						modal: true,
						height:800,
						width:1050,
						show: {
							effect: 'blind',
							duration: 1000
						},
						hide: {
							effect: 'explode',
							duration: 1000
						}
					});
					
	$( '#OdontogramaLightV2' ).dialog( 'open' );
		
		var codPac=$("#codigoPaciente").val();
			$.ajax({
				url:'Procesar.php?accion=LoadOdontograma&CP0='+codPac,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#OdontogramaLightV2Dibujo").html(res);
				},
				error:function()
				{
					$("#OdontogramaLightV2Dibujo").html("error al cargar el ajax de guarad odontograma ");
				}
			});	

}
function CambiarColorDientes(codigo,caja,diente,posicion){

if($("#cmb_tratamiento").val()!=""){
	
	var bus=diente;
	var res=bus.split("_");
	
	
	if($("#cmb_tratamiento").val()=="1"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],1, posicion);

	}
	if($("#cmb_tratamiento").val()=="2"){
		//$("#"+caja+"").attr("value","2");		
		AddAndRemoveSimbolo(res[1],2,posicion);		
	}
	if($("#cmb_tratamiento").val()=="3"){
		//$("#"+caja+"").attr("value","2");
		AddAndRemoveSimbolo(res[1],3,posicion);
	}
	if($("#cmb_tratamiento").val()=="4"){
		//$("#"+caja+"").attr("value","2");
		AddAndRemoveSimbolo(res[1],4,posicion);
	}
	if($("#cmb_tratamiento").val()=="5"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],5,posicion);			
	}
	if($("#cmb_tratamiento").val()=="6"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],6,posicion);
	}
	if($("#cmb_tratamiento").val()=="7"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],7,posicion);
	}
	if($("#cmb_tratamiento").val()=="8"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],8,posicion);
	}
	if($("#cmb_tratamiento").val()=="9"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],9,posicion);
	}
	if($("#cmb_tratamiento").val()=="10"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],10,posicion);
	}
	if($("#cmb_tratamiento").val()=="11"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],11,posicion);
	}
	if($("#cmb_tratamiento").val()=="12"){
		//$("#"+caja+"").attr("value","2");
		AddAndRemoveSimbolo(res[1],12,posicion);
	}
	if($("#cmb_tratamiento").val()=="13"){
		//$("#"+caja+"").attr("value","1");
		AddAndRemoveSimbolo(res[1],13,posicion);
	}
	if($("#cmb_tratamiento").val()=="14"){
		//$("#"+caja+"").attr("value","2");
		AddAndRemoveSimbolo(res[1],14,posicion);
	}
	if($("#cmb_tratamiento").val()=="15"){
		$("#"+caja+"").attr("value","2");
		$("#"+diente+"").attr("src","resource/dr.fw.png");
		AddAndRemoveSimbolo(res[1],15,posicion);
	}
	if($("#cmb_tratamiento").val()=="16"){
		$("#"+caja+"").attr("value","1");
		$("#"+diente+"").attr("src","resource/da.fw.png");
		AddAndRemoveSimbolo(res[1],16,posicion);
	}

   }
   else{
	   alert("Selecione un tratamiento");
   }
}


function AddAndRemoveSimbolo(diente,tratamiento, cajacodigo){
		var text=$("#sim_"+diente+"").val();
		if(text.indexOf(""+tratamiento+",")>=0){
		}else{
			
			var  text=text+" "+tratamiento+",";//agregando los tratamientos 
			$("#sim_"+diente+"").attr("value",""+text+"");//tratamientos aplicados a el diente

			var tratext="";

			//if para colocar los sibolos 
			if(tratamiento==1){
				$("#_"+diente+"").append("<i class='ims1_"+diente+"'><img src='resource/si2.fw.png'/></i>");//simbolo
				tratext="Prótesis Total Por Realizar";
			}
			if(tratamiento==2){
				$("#_"+diente+"").append("<i class='ims2_"+diente+"'><img src='resource/s2.png'/></i>");
				tratext="Prótesis Removible Por Realizar";
			}
			if(tratamiento==3){
				$("#_"+diente+"").append("<i class='ims3_"+diente+"'><img src='resource/s1.png'/></i>");
				tratext="Prótesis Fija Por Realizar";
			}
			if(tratamiento==4){
				$("#_"+diente+"").append("<i class='ims4_"+diente+"'><img src='resource/s3.png'/></i>");
				tratext="Endodoncia Por Realizar";
			}
			if(tratamiento==5){
				$("#_"+diente+"").append("<i class='ims5_"+diente+"'><img src='resource/s5.png'/></i>");
				tratext="Corona";
			}
			if(tratamiento==6){
				$("#_"+diente+"").append("<i class='ims6_"+diente+"'><img src='resource/si1.fw.png'/></i>");
				tratext="Prótesis Total Realizada";
			}
			if(tratamiento==7){
				$("#_"+diente+"").append("<i class='ims7_"+diente+"'><img src='resource/s6.png'/></i>");
				tratext="Prótesis Removible Realizada";
			}
			if(tratamiento==8){
				$("#_"+diente+"").append("<i class='ims8_"+diente+"'><img src='resource/s7.png'/></i>");
				tratext="Prótesis Fija Realizada";
			}
			if(tratamiento==9){
				$("#_"+diente+"").append("<i class='ims9_"+diente+"'><img src='resource/s8.png'/></i>");
				tratext="Endodoncia Realizada";
			}
			if(tratamiento==10){
				$("#_"+diente+"").append("<i class='ims10_"+diente+"'><img src='resource/s9.png'/></i>");
				tratext="Pérdida (Otra Causa)";
			}
			if(tratamiento==11){
				$("#_"+diente+"").append("<i class='ims11_"+diente+"'><img src='resource/s9.png'/></i>");
				tratext="Pérdida Por Caries";
			}
			if(tratamiento==12){
				$("#_"+diente+"").append("<i class='ims12_"+diente+"'><img src='resource/s10.png'/></i>");
				tratext="Extracción Indicada";
			}
			if(tratamiento==13){
				$("#_"+diente+"").append("<i class='ims13_"+diente+"'><img src='resource/s11.png'/></i>");
				tratext="Sellante Realizado";
			}
			if(tratamiento==14){
				$("#_"+diente+"").append("<i class='ims14_"+diente+"'><img src='resource/s12.png'/></i>");
				tratext="Sellante Necesario";
			}
			if(tratamiento==15){
				tratext="Caries";
			}
			if(tratamiento==16){
				tratext="Obturado";
			}

			//boton para eliminar el tratamiento seleccionado 
			var link="<a href='#' onClick='deletTrt("+diente+","+tratamiento+","+cajacodigo+")' class='deletra' > Diente "+diente+", Se le aplico: "+tratext+"</a>";
			var codehtml=$("#AreaListTrataMiento").html();
			$("#AreaListTrataMiento").append(link+"<p>");


			$(".deletra").click(function(){
				$(this).html("");
			});


		}
}
function deletTrt(diente,tratamiento,cajacodigo){


	var pos=null;
	var posd=null;
	if(cajacodigo==1){
		pos="da";
		posd="dA";
	}
	if(cajacodigo==2){
		pos="dd";
		posd="dD";
	}
	
	if(cajacodigo==3){
		pos="dab";
		posd="daB";
	}
	
	if(cajacodigo==4){
		pos="di";
		posd="dI";
	}
	
	if(cajacodigo==5){
		pos="dc";
		posd="dC";
	}	
	if($("#txt_"+pos+"_"+diente).val()!=""){
		$("#txt_"+pos+"_"+diente).attr("value","");
		$("#"+posd+"_"+diente).attr("src","resource/db.fw.png"); darwin
	}

		var text=$("#sim_"+diente+"").val();
		if(text.indexOf(""+tratamiento+",")>=0){
			var text2=text.replace(""+tratamiento+",","");
			$("#sim_"+diente+"").attr("value",""+text2+"");
		}

		if(tratamiento==1){
			$(".ims1_"+diente+"").html("");
		}
		if(tratamiento==2){
			$(".ims2_"+diente+"").html("");
		}
		if(tratamiento==3){
			$(".ims3_"+diente+"").html("");
		}
		if(tratamiento==4){
			$(".ims4_"+diente+"").html("");
		}
		if(tratamiento==5){
			$(".ims5_"+diente+"").html("");
		}
		if(tratamiento==6){
			$(".ims6_"+diente+"").html("");
		}
		if(tratamiento==7){
			$(".ims7_"+diente+"").html("");
		}
		if(tratamiento==8){
			$(".ims8_"+diente+"").html("");
		}
		if(tratamiento==9){
			$(".ims9_"+diente+"").html("");
		}
		if(tratamiento==10){
			$(".ims10_"+diente+"").html("");
		}
		if(tratamiento==11){
			$(".ims11_"+diente+"").html("");
		}
		if(tratamiento==12){
			$(".ims12_"+diente+"").html("");
		}
		if(tratamiento==13){
			$(".ims13_"+diente+"").html("");
		}
		if(tratamiento==14){
			$(".ims14_"+diente+"").html("");
		}

}



//inicio funcion objeto para guardar el diente
function Diente(up,right,down,left,center,box1,box2,treatment,tooth,person){
	this.up=up;
	this.right=right;
	this.down=down;
	this.left=left;
	this.center=center;
	this.box1=box1;
	this.box2=box2;
	this.treatment=treatment;
	this.tooth=tooth;
	this.person=person;
}
function SaveOdontogramaLight5(){
	//creacion de objeto diente para cada uno de los 52 dientes 
	var dt18=new Diente($("#txt_da_18").val(),$("#txt_dd_18").val(),$("#txt_dab_18").val(),$("#txt_di_18").val(),$("#txt_dc_18").val(),$("#txtdtre18").val(),$("#txtdMo18").val(),$("#sim_18").val(),"dt18",$("#codigoPaciente").val());
	var dt17=new Diente($("#txt_da_17").val(),$("#txt_dd_17").val(),$("#txt_dab_17").val(),$("#txt_di_17").val(),$("#txt_dc_17").val(),$("#txtdtre17").val(),$("#txtdMo17").val(),$("#sim_17").val(),"dt17",$("#codigoPaciente").val());
	var dt16=new Diente($("#txt_da_16").val(),$("#txt_dd_16").val(),$("#txt_dab_16").val(),$("#txt_di_16").val(),$("#txt_dc_16").val(),$("#txtdtre16").val(),$("#txtdMo16").val(),$("#sim_16").val(),"dt16",$("#codigoPaciente").val());
	var dt15=new Diente($("#txt_da_15").val(),$("#txt_dd_15").val(),$("#txt_dab_15").val(),$("#txt_di_15").val(),$("#txt_dc_15").val(),$("#txtdtre15").val(),$("#txtdMo15").val(),$("#sim_15").val(),"dt15",$("#codigoPaciente").val());
	var dt14=new Diente($("#txt_da_14").val(),$("#txt_dd_14").val(),$("#txt_dab_14").val(),$("#txt_di_14").val(),$("#txt_dc_14").val(),$("#txtdtre14").val(),$("#txtdMo14").val(),$("#sim_14").val(),"dt14",$("#codigoPaciente").val());
	var dt13=new Diente($("#txt_da_13").val(),$("#txt_dd_13").val(),$("#txt_dab_13").val(),$("#txt_di_13").val(),$("#txt_dc_13").val(),$("#txtdtre13").val(),$("#txtdMo13").val(),$("#sim_13").val(),"dt13",$("#codigoPaciente").val());
	var dt12=new Diente($("#txt_da_12").val(),$("#txt_dd_12").val(),$("#txt_dab_12").val(),$("#txt_di_12").val(),$("#txt_dc_12").val(),$("#txtdtre12").val(),$("#txtdMo12").val(),$("#sim_12").val(),"dt12",$("#codigoPaciente").val());
	var dt11=new Diente($("#txt_da_11").val(),$("#txt_dd_11").val(),$("#txt_dab_11").val(),$("#txt_di_11").val(),$("#txt_dc_11").val(),$("#txtdtre11").val(),$("#txtdMo11").val(),$("#sim_11").val(),"dt11",$("#codigoPaciente").val());


	var dt21=new Diente($("#txt_da_21").val(),$("#txt_dd_21").val(),$("#txt_dab_21").val(),$("#txt_di_21").val(),$("#txt_dc_21").val(),$("#txtdtre21").val(),$("#txtdMo21").val(),$("#sim_21").val(),"dt21",$("#codigoPaciente").val());
	var dt22=new Diente($("#txt_da_22").val(),$("#txt_dd_22").val(),$("#txt_dab_22").val(),$("#txt_di_22").val(),$("#txt_dc_22").val(),$("#txtdtre22").val(),$("#txtdMo22").val(),$("#sim_22").val(),"dt22",$("#codigoPaciente").val());
	var dt23=new Diente($("#txt_da_23").val(),$("#txt_dd_23").val(),$("#txt_dab_23").val(),$("#txt_di_23").val(),$("#txt_dc_23").val(),$("#txtdtre23").val(),$("#txtdMo23").val(),$("#sim_23").val(),"dt23",$("#codigoPaciente").val());
	var dt24=new Diente($("#txt_da_24").val(),$("#txt_dd_24").val(),$("#txt_dab_24").val(),$("#txt_di_24").val(),$("#txt_dc_24").val(),$("#txtdtre24").val(),$("#txtdMo24").val(),$("#sim_24").val(),"dt24",$("#codigoPaciente").val());
	var dt25=new Diente($("#txt_da_25").val(),$("#txt_dd_25").val(),$("#txt_dab_25").val(),$("#txt_di_25").val(),$("#txt_dc_25").val(),$("#txtdtre25").val(),$("#txtdMo25").val(),$("#sim_25").val(),"dt25",$("#codigoPaciente").val());
	var dt26=new Diente($("#txt_da_26").val(),$("#txt_dd_26").val(),$("#txt_dab_26").val(),$("#txt_di_26").val(),$("#txt_dc_26").val(),$("#txtdtre26").val(),$("#txtdMo26").val(),$("#sim_26").val(),"dt26",$("#codigoPaciente").val());
	var dt27=new Diente($("#txt_da_27").val(),$("#txt_dd_27").val(),$("#txt_dab_27").val(),$("#txt_di_27").val(),$("#txt_dc_27").val(),$("#txtdtre27").val(),$("#txtdMo27").val(),$("#sim_27").val(),"dt27",$("#codigoPaciente").val());
	var dt28=new Diente($("#txt_da_28").val(),$("#txt_dd_28").val(),$("#txt_dab_28").val(),$("#txt_di_28").val(),$("#txt_dc_28").val(),$("#txtdtre28").val(),$("#txtdMo28").val(),$("#sim_28").val(),"dt28",$("#codigoPaciente").val());


	var dt55=new Diente($("#txt_da_55").val(),$("#txt_dd_55").val(),$("#txt_dab_55").val(),$("#txt_di_55").val(),$("#txt_dc_55").val(),"","",$("#sim_55").val(),"dt55",$("#codigoPaciente").val());
	var dt54=new Diente($("#txt_da_54").val(),$("#txt_dd_54").val(),$("#txt_dab_54").val(),$("#txt_di_54").val(),$("#txt_dc_54").val(),"","",$("#sim_54").val(),"dt54",$("#codigoPaciente").val());
	var dt53=new Diente($("#txt_da_53").val(),$("#txt_dd_53").val(),$("#txt_dab_53").val(),$("#txt_di_53").val(),$("#txt_dc_53").val(),"","",$("#sim_53").val(),"dt53",$("#codigoPaciente").val());
	var dt52=new Diente($("#txt_da_52").val(),$("#txt_dd_52").val(),$("#txt_dab_52").val(),$("#txt_di_52").val(),$("#txt_dc_52").val(),"","",$("#sim_52").val(),"dt52",$("#codigoPaciente").val());
	var dt51=new Diente($("#txt_da_51").val(),$("#txt_dd_51").val(),$("#txt_dab_51").val(),$("#txt_di_51").val(),$("#txt_dc_51").val(),"","",$("#sim_51").val(),"dt51",$("#codigoPaciente").val());


	var dt61=new Diente($("#txt_da_61").val(),$("#txt_dd_61").val(),$("#txt_dab_61").val(),$("#txt_di_61").val(),$("#txt_dc_61").val(),"","",$("#sim_61").val(),"dt61",$("#codigoPaciente").val());
	var dt62=new Diente($("#txt_da_62").val(),$("#txt_dd_62").val(),$("#txt_dab_62").val(),$("#txt_di_62").val(),$("#txt_dc_62").val(),"","",$("#sim_62").val(),"dt62",$("#codigoPaciente").val());
	var dt63=new Diente($("#txt_da_63").val(),$("#txt_dd_63").val(),$("#txt_dab_63").val(),$("#txt_di_63").val(),$("#txt_dc_63").val(),"","",$("#sim_63").val(),"dt63",$("#codigoPaciente").val());
	var dt64=new Diente($("#txt_da_64").val(),$("#txt_dd_64").val(),$("#txt_dab_64").val(),$("#txt_di_64").val(),$("#txt_dc_64").val(),"","",$("#sim_64").val(),"dt64",$("#codigoPaciente").val());
	var dt65=new Diente($("#txt_da_65").val(),$("#txt_dd_65").val(),$("#txt_dab_65").val(),$("#txt_di_65").val(),$("#txt_dc_65").val(),"","",$("#sim_65").val(),"dt65",$("#codigoPaciente").val());


	var dt85=new Diente($("#txt_da_85").val(),$("#txt_dd_85").val(),$("#txt_dab_85").val(),$("#txt_di_85").val(),$("#txt_dc_85").val(),"","",$("#sim_85").val(),"dt85",$("#codigoPaciente").val());
	var dt84=new Diente($("#txt_da_84").val(),$("#txt_dd_84").val(),$("#txt_dab_84").val(),$("#txt_di_84").val(),$("#txt_dc_84").val(),"","",$("#sim_84").val(),"dt84",$("#codigoPaciente").val());
	var dt83=new Diente($("#txt_da_83").val(),$("#txt_dd_83").val(),$("#txt_dab_83").val(),$("#txt_di_83").val(),$("#txt_dc_83").val(),"","",$("#sim_83").val(),"dt83",$("#codigoPaciente").val());
	var dt82=new Diente($("#txt_da_82").val(),$("#txt_dd_82").val(),$("#txt_dab_82").val(),$("#txt_di_82").val(),$("#txt_dc_82").val(),"","",$("#sim_82").val(),"dt82",$("#codigoPaciente").val());
	var dt81=new Diente($("#txt_da_81").val(),$("#txt_dd_81").val(),$("#txt_dab_81").val(),$("#txt_di_81").val(),$("#txt_dc_81").val(),"","",$("#sim_81").val(),"dt81",$("#codigoPaciente").val());


	var dt71=new Diente($("#txt_da_71").val(),$("#txt_dd_71").val(),$("#txt_dab_71").val(),$("#txt_di_71").val(),$("#txt_dc_71").val(),"","",$("#sim_71").val(),"dt71",$("#codigoPaciente").val());
	var dt72=new Diente($("#txt_da_72").val(),$("#txt_dd_72").val(),$("#txt_dab_72").val(),$("#txt_di_72").val(),$("#txt_dc_72").val(),"","",$("#sim_72").val(),"dt72",$("#codigoPaciente").val());
	var dt73=new Diente($("#txt_da_73").val(),$("#txt_dd_73").val(),$("#txt_dab_73").val(),$("#txt_di_73").val(),$("#txt_dc_73").val(),"","",$("#sim_73").val(),"dt73",$("#codigoPaciente").val());
	var dt74=new Diente($("#txt_da_74").val(),$("#txt_dd_74").val(),$("#txt_dab_74").val(),$("#txt_di_74").val(),$("#txt_dc_74").val(),"","",$("#sim_74").val(),"dt74",$("#codigoPaciente").val());
	var dt75=new Diente($("#txt_da_75").val(),$("#txt_dd_75").val(),$("#txt_dab_75").val(),$("#txt_di_75").val(),$("#txt_dc_75").val(),"","",$("#sim_75").val(),"dt75",$("#codigoPaciente").val());



	var dt48=new Diente($("#txt_da_48").val(),$("#txt_dd_48").val(),$("#txt_dab_48").val(),$("#txt_di_48").val(),$("#txt_dc_48").val(),$("#txtdtre48").val(),$("#txtdMo48").val(),$("#sim_48").val(),"dt48",$("#codigoPaciente").val());
	var dt47=new Diente($("#txt_da_47").val(),$("#txt_dd_47").val(),$("#txt_dab_47").val(),$("#txt_di_47").val(),$("#txt_dc_47").val(),$("#txtdtre47").val(),$("#txtdMo47").val(),$("#sim_47").val(),"dt47",$("#codigoPaciente").val());
	var dt46=new Diente($("#txt_da_46").val(),$("#txt_dd_46").val(),$("#txt_dab_46").val(),$("#txt_di_46").val(),$("#txt_dc_46").val(),$("#txtdtre46").val(),$("#txtdMo46").val(),$("#sim_46").val(),"dt46",$("#codigoPaciente").val());
	var dt45=new Diente($("#txt_da_45").val(),$("#txt_dd_45").val(),$("#txt_dab_45").val(),$("#txt_di_45").val(),$("#txt_dc_45").val(),$("#txtdtre45").val(),$("#txtdMo45").val(),$("#sim_45").val(),"dt45",$("#codigoPaciente").val());
	var dt44=new Diente($("#txt_da_44").val(),$("#txt_dd_44").val(),$("#txt_dab_44").val(),$("#txt_di_44").val(),$("#txt_dc_44").val(),$("#txtdtre44").val(),$("#txtdMo44").val(),$("#sim_44").val(),"dt44",$("#codigoPaciente").val());
	var dt43=new Diente($("#txt_da_43").val(),$("#txt_dd_43").val(),$("#txt_dab_43").val(),$("#txt_di_43").val(),$("#txt_dc_43").val(),$("#txtdtre43").val(),$("#txtdMo43").val(),$("#sim_43").val(),"dt43",$("#codigoPaciente").val());
	var dt42=new Diente($("#txt_da_42").val(),$("#txt_dd_42").val(),$("#txt_dab_42").val(),$("#txt_di_42").val(),$("#txt_dc_42").val(),$("#txtdtre42").val(),$("#txtdMo42").val(),$("#sim_42").val(),"dt42",$("#codigoPaciente").val());
	var dt41=new Diente($("#txt_da_41").val(),$("#txt_dd_41").val(),$("#txt_dab_41").val(),$("#txt_di_41").val(),$("#txt_dc_41").val(),$("#txtdtre41").val(),$("#txtdMo41").val(),$("#sim_41").val(),"dt41",$("#codigoPaciente").val());


	var dt31=new Diente($("#txt_da_31").val(),$("#txt_dd_31").val(),$("#txt_dab_31").val(),$("#txt_di_31").val(),$("#txt_dc_31").val(),$("#txtdtre31").val(),$("#txtdMo31").val(),$("#sim_31").val(),"dt31",$("#codigoPaciente").val());
	var dt32=new Diente($("#txt_da_32").val(),$("#txt_dd_32").val(),$("#txt_dab_32").val(),$("#txt_di_32").val(),$("#txt_dc_32").val(),$("#txtdtre32").val(),$("#txtdMo32").val(),$("#sim_32").val(),"dt32",$("#codigoPaciente").val());
	var dt33=new Diente($("#txt_da_33").val(),$("#txt_dd_33").val(),$("#txt_dab_33").val(),$("#txt_di_33").val(),$("#txt_dc_33").val(),$("#txtdtre33").val(),$("#txtdMo33").val(),$("#sim_33").val(),"dt33",$("#codigoPaciente").val());
	var dt34=new Diente($("#txt_da_34").val(),$("#txt_dd_34").val(),$("#txt_dab_34").val(),$("#txt_di_34").val(),$("#txt_dc_34").val(),$("#txtdtre34").val(),$("#txtdMo34").val(),$("#sim_34").val(),"dt34",$("#codigoPaciente").val());
	var dt35=new Diente($("#txt_da_35").val(),$("#txt_dd_35").val(),$("#txt_dab_35").val(),$("#txt_di_35").val(),$("#txt_dc_35").val(),$("#txtdtre35").val(),$("#txtdMo35").val(),$("#sim_35").val(),"dt35",$("#codigoPaciente").val());
	var dt36=new Diente($("#txt_da_36").val(),$("#txt_dd_36").val(),$("#txt_dab_36").val(),$("#txt_di_36").val(),$("#txt_dc_36").val(),$("#txtdtre36").val(),$("#txtdMo36").val(),$("#sim_36").val(),"dt36",$("#codigoPaciente").val());
	var dt37=new Diente($("#txt_da_37").val(),$("#txt_dd_37").val(),$("#txt_dab_37").val(),$("#txt_di_37").val(),$("#txt_dc_37").val(),$("#txtdtre37").val(),$("#txtdMo37").val(),$("#sim_37").val(),"dt37",$("#codigoPaciente").val());
	var dt38=new Diente($("#txt_da_38").val(),$("#txt_dd_38").val(),$("#txt_dab_38").val(),$("#txt_di_38").val(),$("#txt_dc_38").val(),$("#txtdtre38").val(),$("#txtdMo38").val(),$("#sim_38").val(),"dt38",$("#codigoPaciente").val());



	//fin creacion de objeto diente para cada uno de los 52 dientes 

	//creacion de un arreglo para almacenar a los dientes
	var dentadura=[];
	var dentadura2=[];
	var dentadura3=[];
	//fin de creacion de un arreglo para almacenar a los dientes

	//agregando a la dentadura los dientes
	dentadura.push(dt18);
	dentadura.push(dt17);
	dentadura.push(dt16);
	dentadura.push(dt15);
	dentadura.push(dt14);
	dentadura.push(dt13);
	dentadura.push(dt12);
	dentadura.push(dt11);

	dentadura.push(dt21);
	dentadura.push(dt22);
	dentadura.push(dt23);
	dentadura.push(dt24);
	dentadura.push(dt25);
	dentadura.push(dt26);
	dentadura.push(dt27);
	dentadura.push(dt28);

	dentadura.push(dt55);
	dentadura.push(dt54);
	dentadura.push(dt53);
	dentadura.push(dt52);
	dentadura.push(dt51);

	dentadura2.push(dt61);
	dentadura2.push(dt62);
	dentadura2.push(dt63);
	dentadura2.push(dt64);
	dentadura2.push(dt65);

	dentadura2.push(dt85);
	dentadura2.push(dt84);
	dentadura2.push(dt83);
	dentadura2.push(dt82);
	dentadura2.push(dt81);

	dentadura2.push(dt71);
	dentadura2.push(dt72);
	dentadura2.push(dt73);
	dentadura2.push(dt74);
	dentadura2.push(dt75);

	dentadura2.push(dt48);
	dentadura2.push(dt47);
	dentadura2.push(dt46);
	dentadura2.push(dt45);
	dentadura2.push(dt44);
	dentadura3.push(dt43);
	dentadura3.push(dt42);
	dentadura3.push(dt41);
	
	dentadura3.push(dt31);
	dentadura3.push(dt32);
	dentadura3.push(dt33);
	dentadura3.push(dt34);
	dentadura3.push(dt35);
	dentadura3.push(dt36);
	dentadura3.push(dt37);
	dentadura3.push(dt38);

	//fin agregando a la dentadura los dientes

	//convertimos a el vector con la lista de objetos en una cadena con formato JSON 
	var dentaduraJson=JSON.stringify(dentadura);
	var dentaduraJson2=JSON.stringify(dentadura2);
	var dentaduraJson3=JSON.stringify(dentadura3);
	//finconvertimos a el vector con la lista de objetos en una cadena con formato JSON 

	//pasando las variables a un procesar que conecta a la logica para almacenar en la base de datos

	$.ajax({
			url:'Procesar.php?accion=SaveOdontogramaLight5&Dentadura='+dentaduraJson,
			type:'GET',
			cache:false,
			beforeSend:function()
			{
				$("#OdontogramaLightV2Dibujo").html("<center><img src='resource/load.gif'/></center>");
			},
			success:function(res)
			{
//				$("#OdontogramaLightV2Dibujo").html(res);


				$.ajax({
						url:'Procesar.php?accion=SaveOdontogramaLight6&Dentadura='+dentaduraJson2,
						type:'GET',
						cache:false,
						beforeSend:function()
						{
							$("#OdontogramaLightV2Dibujo").html("<center><img src='resource/load.gif'/></center>");
						},
						success:function(res)
						{
							//$("#OdontogramaLightV2Dibujo").html(res);


								$.ajax({
										url:'Procesar.php?accion=SaveOdontogramaLight7&Dentadura='+dentaduraJson3,
										type:'GET',
										cache:false,
										beforeSend:function()
										{
											$("#OdontogramaLightV2Dibujo").html("<center><img src='resource/load.gif'/></center>");
										},
										success:function(res)
										{
											$("#OdontogramaLightV2Dibujo").html(res);
											
										},
										error:function(res)
										{
											$("#OdontogramaLightV2Dibujo").html("error al cargar");
										}
									});	



						},
						error:function(res)
						{
							$("#OdontogramaLightV2Dibujo").html("error al cargar");
						}
					});



			},
			error:function(res)
			{
				$("#OdontogramaLightV2Dibujo").html("error al cargar");
			}
		});

	//fin pasando las variables a un procesar que conecta a la logica para almacenar en la base de datos

}