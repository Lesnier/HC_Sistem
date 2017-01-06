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
//CargarCie();
//

//LoadCitasCirugiaXDoc();

	$("#Frmhome0").show();
	$("#FrmVerInicProtocolos").hide();
/*

$("#Buscarpropertario").click(function(){
	
	$("#Frmhome0").hide();
	$("#FrmVerInicProtocolos").show();

	$("#MenuDoctor").html("<ul class='nav nav-list'> <li class='nav-header'>Menú Paciente</li> <li class='active'><a href='#'>Datos de filiacion</a></li> <li><a href='#'>Consulta</a></li> <li><a href='#'>Epicrisis</a></li> <li><a href='#'>Historia Examenes</a></li> <li><a href='#'>Finalizar Consulta</a></li> <li class='nav-header'>Interconsulta</li> <li><a href='#'>Solicitud</a></li> <li><a href='#'>Informe</a></li> <li class='nav-header'>Examenes</li> <li><a href='#'>Examen fisico</a></li> <li><a href='#'>Examenes</a></li><!-- <li class='nav-header'>Certificados</li> <li><a href='#'>Asistencia</a></li> <li><a href='#'>Enferemedad y reposo</a></li> <li><a href='#'>Cuidado</a></li> <li><a href='#'>Cirugia</a></li> <li><a href='#'>Salud</a></li> <li><a href='#'>Salud y vacunacion</a></li> <li><a href='#'>Consentimiento Informado</a></li>--> </ul>");
	
});*/


});
function Home() {
	$(".Cabe1").html("");
	$(".Resp1").html("");
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");
}
//inicio de la funcio para cargar los datos de las consultas del dia de hoy
function CargarConsultasDeHoyXDoctor()
{
	Home();
		$.ajax({
			url:'Procesar.php?accion=CargarPacientes',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp1").html(res);
			},
			error:function()
			{
				$(".Resp1").html("error al cargar");
			}
		});
		$("#MenuDoctor").html("<ul class='nav nav-list'>" +
		"<li class='nav-header'>Menú Paciente</li>" +
		"<li class='active'><a href='#'><i class='icon-edit'></i>  Datos de filiacion</a></li>" +
		"<li><li class='dropdown'>" +
		"<div class='dropdown-backdrop'></div><a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class=' icon-chevron-right'></i>  Consulta Externa</a>" +
		"<ul class='dropdown-menu'>" +
		"<li><a href='#'  >Consulta</a></li>" +
		"<li><a href='#' >Epicrisis</a></li>" +
		"</ul></li></li><li><li class='dropdown'>" +
		"<div class='dropdown-backdrop'></div><a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class=' icon-chevron-right'></i>  Hospitalizacion</a>" +
		"<ul class='dropdown-menu'>" +
		"<li><a href='#'  >Anamnesis</a></li>" +
		"</ul></li></li><li><a href='#'><i class='icon-th-list'></i>  Historia Examenes</a></li>" +
		"<li class='nav-header'>Interconsulta</li>" +
		"<li><a href='#'><i class='icon-hand-right'></i>  Solicitud</a></li>" +
		"<li><a href='#'><i class='icon-file'></i>  Informe</a></li>" +
		"<li class='nav-header'>Examenes</li>" +
		"<li><a href='#'><i class='icon-tint'></i>  Examen fisico</a></li>" +
		"<li><a href='#'><i class='icon-tint'></i>  Examenes</a></li>" +
		"<hr/>" +
		"<li class='nav-header'>Terminar</li>" +
		"<li><a href='#'><i class='icon-remove-sign'></i>  Finalizar Consulta</a></li>" +
		"</ul>");

		//revisar estos divs
		$("#HistorialPaciente").html("");
		$("#RespuestaFamacos").html("");
		$("#arealerta").html("");
		$("#RespConsulta").html("");
		$("#LoadaDataNow").html("");

		$("#Frmhome0").show();
		$("#FrmVerInicProtocolos").hide();
	
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
/*	$( "#DataFiliaCionPaciente" ).attr("title","Datos Filiación");
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

		$( "#DataFiliaCionPaciente" ).dialog( "open" );*/
		$(".Resp2").html("");
		$(".Resp3").html("");
		$(".Resp4").html("");
		$(".Resp5").html("");
		$(".Resp6").html("");

		$.ajax({
			url:'Procesar.php?accion=DataAfiliacionPaciente&CodigoPac='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
}
function CancelarModifyPac() {
		$(".Resp2").html("");
		$(".Resp3").html("");
		$(".Resp4").html("");
		$(".Resp5").html("");
		$(".Resp6").html("");
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
					url:'Procesar.php?accion=ModDataPac&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+'&CodigoPaciente='+codigo+"&autori="+$("#txtautorizacion").val()+"&fechaiaut="+$("#txtfechaauto").val()+"&fechafaut="+$("#txtfechaautovenc").val()+"&condi2="+$("#txtCondicio").val()+'&estadoPac='+$("#cmbestPac").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
						setTimeout(function()
						{
							$(".Resp2").html("");
							CargarFiliacion($("#codigoPaciente").val());
							//ReloadDataPac(codigo);
							//CargarConsultasDeHoyXDoctor();
							
						},3000);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
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
				$(".Cabe1").html(res);
			},
			error:function()
			{
				$(".Cabe1").html("error al cargar");
			}
		});	
}
function Diagnosticar(codigo,codigo1)
{
	
	//cargando el nombre del paciente
	NombrePaciente(codigo1);
	//fincargando el nombre del paciente
	//cargar alertas al ingresar el paciente
	CargarAlertas(codigo1);
	//fin cargar las alertas	
	
	
	CargarFiliacion(codigo1);
	
	
	

	
	
//caja oculta para solicitud de imagenes
$("#imagenes123").val(""+codigo+"");
$("#codigoTurno123").val(""+codigo+"");
$("#CajaOcultaFenixTurno").val(""+codigo+"");

$("#codigoPaciente").val(""+codigo1+"");

$("#codigoescondidoanam123").val(""+codigo1+"");


//menu para el paciente seleccionado

	$("#MenuDoctor").html("<ul class='nav nav-list'>" +
		"<li class='nav-header'>Menú Paciente</li>" +
		"<li class='active'><a href='#'  onclick='DatosAllFiliacion(" + codigo1 + ")'><i class='icon-edit'></i>  Datos de filiacion</a></li>" +
		"<li><li class='dropdown'>" +
		"<div class='dropdown-backdrop'></div><a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class=' icon-chevron-right'></i>  Consulta Externa</a>" +
		"<ul class='dropdown-menu'>" +
		"<li><a href='#' onclick='AnamnesisCdu()' >Consulta</a></li>" +
		"<li><a href='#' onclick='Epicrisis()'>Epicrisis</a></li>" +
		"</ul></li></li><li><li class='dropdown'>" +
		"<div class='dropdown-backdrop'></div><a href='#' class='dropdown-toggle' data-toggle='dropdown'><i class=' icon-chevron-right'></i>  Hospitalizacion</a>" +
		"<ul class='dropdown-menu'>" +
		"<li><a href='#' onclick='LoadAnamnesisHospitali(true)'  >Anamnesis</a></li>" +
		"</ul></li></li><li><a href='#' onclick='HExamenes()'><i class='icon-th-list'></i>  Historia Examenes</a></li>" +
		"<li class='nav-header'>Interconsulta</li>" +
		"<li><a href='#' onclick='PedidoInterconsulta()'><i class='icon-hand-right'></i>  Solicitud</a></li>" +
		"<li><a href='#'  onclick='InformeInterconsulta()'><i class='icon-file'></i>  Informe</a></li>" +
		"<li class='nav-header'>Examenes</li>" +
		"<li><a href='#' onclick='ExamenFisico2()'><i class='icon-tint'></i>  Examen fisico</a></li>" +
		"<li><a href='#' onclick='Examenfisico()'><i class='icon-tint'></i>  Examenes</a></li>" +
		"<hr/>" +
		"<li class='nav-header'>Terminar</li>" +
		"<li><a href='#' onclick='FinPaciente()'><i class='icon-remove-sign'></i>  Finalizar Consulta</a></li>" +
		"</ul>");
	

	
	
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
/*function ModificarMotivoConsulta(cod)
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
}*/
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
	/*
	
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

		$( "#AreaCertificados" ).dialog( "open" );*/
		//aqui esta el div para capturaora el texto a imprimir en el certidicado de otros es: 	TextoParaCertificadoOtros
		Home();
		$(".Resp1").html("<center><table> <tr> <td><center><h1>CERTIFICADO</h1></center></td> </tr> <tr> <td><label for='txtcertificadootros'></label> <textarea name='txtcertificadootros' style='width:600px;' id='txtcertificadootros' cols='200' rows='3'></textarea></td> </tr> <tr> <td><center><input type='button' class='btn btn-primary' onclick='ImpCertificadoOtros()' value='Imprimir' /></center></td> </tr> </table></center>");
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
	/*$( "#HistoriaClinica" ).dialog({
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

		$( "#HistoriaClinica" ).dialog( "open" );	*/
		Home();	
		$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span6' id='txtBuscar'  onkeydown='BuscarPacientePAraVerHistoria();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a> </div> </center> </td></table>");
		
		
	/*	$("#bntBuscaCedulaPac").click(function()
		{
			$( "#RespuesraHistoria" ).html("<object type='text/html' data='../Reportes/HistoriaCli.php?id="+$("#txtBuscarCedula").val()+"'></object>");					
		});*/
}
function BuscarPacientePAraVerHistoria()
{
	$(".Resp2").html("");
	$(".Resp3").html("");
	if($("#txtBuscar").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPacientev2&buscar='+$("#txtBuscar").val()+'&por='+$("#SearchFor").val()+'&CodigoRol='+5,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp1").html(res);
			},
			error:function()
			{
				$(".Resp1").html("error al cargar");
			}
		});
			
	}else{
		$(".Resp1").html("");
	}
}
function AsgnarMedicoPaciente() {
	$(".modal-body").html("<div class='Cabecera1'></div><div class='CuerpoRes1'></div>");

	$(".Cabecera1").html("<div id='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td><center><div class='input-append'><input class='span8' id='txtbuscarMedicoToPaciente'  onkeypress='BuscarMedicoParaPaciente();'  type='text'><a class='btn' ><i class='icon-search'></i>Medico</a></div></center></td></tr></table> </div>");
}
function BuscarMedicoParaPaciente(){

	if($("#txtbuscarMedicoToPaciente").val()!="")
	{
		$.ajax({
				url:'Procesar.php?accion=BuscarMedico005&Buscar='+$("#txtbuscarMedicoToPaciente").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".CuerpoRes1").html(res);

				},
				error:function()
				{
					$(".CuerpoRes1").html("error al cargar");
				}
			});	
	}else{
		$(".CuerpoRes1").html("");
	}

}
function CatchMedicoToPacient(code) {
	$("#txtnombresUsu1").val($("#nommed"+code+"").html());
}

//inicio de la funcio par un nuevo paciente
function NuevoPaciente()
{
	/*$( "#NewPaciente" ).dialog({
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

		$( "#NewPaciente" ).dialog( "open" );*/
		Home();
		$(".Resp1").html("<div class='table-responisve'><table class='table table-bordered table-striped table-condensedn'><tr><td>Cédula:</td><td><input type='text' id='txtcedulaUsu1' onkeyup='VerificarCI()' /></td><td>Pasaporte:</td><td><input type='text' id='txtPasport' /></td></tr><tr><td>Paciente:</td> <td colspan='3'><input type='text' class='span10' id='txtapellidoUsu1' /></td></tr>          <tr><td>Medico:</td><td colspan='3'><div class='input-append'><input type='text' class='span12' id='txtnombresUsu1'  /><a href='#myModal' role='button' class='btn' data-toggle='modal'  onclick='AsgnarMedicoPaciente()'> Buscar</a></div></td></tr><tr><td>Otro:</td><td colspan='3'><textarea id='txtOtro' cols='40' rows='2'></textarea></td></tr></tr><tr><td>Fecha de Nacimiento:</td><td><input type='date' id='txtEdadUsu1' onchange='Calcular();' /><td colspan='2'><input type='text' id='TxtEdad123'/></tr><tr><td>Lugar de Nacimiento:</td><td><input type='text' id='txtLugnacim' /><td>Lugar de Residencia:</td><td><input type='text' id='txtLugres' /></td></tr><tr><td>Sexo:</td><td><select id='txtSex'><option value=''>--Seleccione--</option><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select></td><!-- <td>Raza:</td> <td><input type='text' id='txtRaza' /></td><tr><td>Religión:</td><td><input type='text' id='txtReligion' /></td> --><td>Estado civil:</td><td><select id='txtEstadociv'><option value=''>--Seleccione un estado civil--</option><option value='Solter@'>Solter@</option><option value='Casad@'>Casad@</option><option value='Divorciad@'>Divorciad@</option><option value='Viud@'>Viud@</option><option value='Union Libre'>Union Libre</option></select></td></tr><tr><td>Instrucción:</td><td><input type='text' id='txtInstr' /></td><!-- <td>Profesión:</td><td><input type='text' id='txtProf' /></td> --></tr><tr><td>Autorizacion:</td><td><input type='text' id='txtautorizacion'/></td><td>Fecha:</td><td><input type='text' id='txtfechaauto' onchange='CalcularFechaVencimiento()' /></td></tr><tr><td>Fecha V.</td><td><input type='text' id='txtfechaautovenc' readonly /></td></tr><tr><!-- <td>Ocupación:</td><td><input type='text' id='txtOcupe' /></td> --><td>Condición del paciente:</td><td><select id='txtCondpac'><option value=''>--Seleccione una condición--</option><option value='Convenio'>Convenio</option><option value='Empresa'>Empresa</option><option value='Particular'>Particular</option></select></td><td><input type='text' id='txtconve2'/></td></tr><tr><td>Dirección:</td><td><input type='text' id='txtdireccionUsu1'  /></td><td>Teléfono Domicilio:</td><td><input type='text' id='txtTelef'></td><tr><td>Teléfono Trabajo:</td><td><input type='text' id='txtTelefTraba'></td><td>Celular:</td><td><input type='text' id='txtCelular'></td><tr><td>Correo:</td><td><input type='text' id='txtCorreo'></td></tr><tr><td>Referencia: </td><td><input type='text' id='txtNombresRefe'></td><td>Teléfono de Referencia:</td><td><input type='text' id='txtTelefonoRefe'></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td colspan='4'><input type='button' id='bntSaveUsu1' class='btn btn-success' onclick='SavePac();' value='Guardar' /></td></tr>  </table></div>");
		 


		 $('#txtfechaauto').datepicker({
						changeMonth: true,
						changeYear: true
					});
		$('#txtfechaauto').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );


	$("#txtcedulaUsu1").validarCedulaEC({
		  onValid: function () {
			console.log(this);
		//	$("#bntSaveUsu1").removeAttr("disabled");	
			$("#txtcedulaUsu1").css("background","#29DF20");
		},
        onInvalid: function () {
          console.log(this);
          window.alert("cédula inválida.");
		  $("#txtcedulaUsu1").css("background","red");
		 // $("#bntSaveUsu1").attr("disabled","true");	
        }
      });
		$("#bntSaveUsu1").button();
		
			/*$('#txtEdadUsu1').datepicker({
				changeMonth: true,
				changeYear: true,
				 onSelect:function()
				 {
					 setTimeout(function(){Calcular()},500);
				 }
			});
			$('#txtEdadUsu1').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );
			$('#txtEdadUsu1').datepicker( 'option', 'yearRange', '-99:+0' );		
			//$('#txtEdadUsu1').datepicker('setDate', '1950-01-01');*/
		
		//validando campos de texto
		$("#txtapellidoUsu1").alpha({allow:" "}); //restringe todos los numeros y algunos caracteres especiales menos el espacio
		$("#txtnombresUsu1").alpha({allow:" "});
		//$("#txtEdadUsu1").numeric();	//restringe letras
		//$("#txtSangre").alpha({allow:"+-"});
		$("#txtNombresFAOC").alpha({allow:" "});		
		$("#txtTelefonoFAOC").numeric();
		
}
//fin de la funcio par un nuevo paciente

//function fecha de vencimiento de autorizacion
function CalcularFechaVencimiento(){
	$.ajax({
					url:'Procesar.php?accion=FechaVencimeitoAutorizacion&date='+$("#txtfechaauto").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#txtfechaautovenc").val(res);
					},
					error:function()
					{
						//$("#RespuestaNewPaciente").html("error al cargar");
					}
				});	
}
//fin function fecha de vencimiento de autorizacion


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

			if( $('#txtapellidoUsu1').val()!=""  )
			{
				$.ajax({
					url:'Procesar.php?accion=NewPaciente&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+"&autori="+$("#txtautorizacion").val()+"&fechaiaut="+$("#txtfechaauto").val()+"&fechafaut="+$("#txtfechaautovenc").val()+"&conve2="+$("#txtconve2").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp1").html(res);
					},
					error:function()
					{
						$(".Resp1").html("error al cargar");
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
			width:890,
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
	
	/*$( "#alert" ).attr("title","Alertas");
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
		$( "#alert" ).dialog( "open" );*/
		$(".Resp2").html("");
		$(".Resp3").html("");
		$(".Resp4").html("");
		$(".Resp5").html("");
		$(".Resp6").html("");

		$( ".modal-body").html("<table class='table table-bordered table-striped'><tr><th><center>Ingrese alertas</center></th></tr><tr><td><textarea  id='txtAlerta' style='width:400px' cols='100' rows='2'></textarea></td> </tr><tr><td colspan='4' ><center><a class='btn' data-dismiss='modal' aria-hidden='true'  id='btn_alerta' onclick='RegistrarAlerta()'> Guardar</a> <td></tr> </table>");
}
function RegistrarAlerta()
{
	$.ajax({
				url:'Procesar.php?accion=savealerta&codigopac='+$("#codigoPaciente").val()+'&alerta='+$("#txtAlerta").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Cabe1").html(res);
					
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
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
			//CargarCie();	
			
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
	/*$( "#Modal3" ).attr("title","Exámenes");
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

		$( "#Modal3" ).dialog( "open" );*/
		if($("#txtExamenes").val()==1)
		{
			$( ".Resp3" ).html("<table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='2'><b>HEMATOLOGÍA.</b></td> <td colspan='4'><b>ORINA</b></td> <td colspan='3'><b>SEROLOGÍA</b></td> </tr> <tr> <td width='145'><input type='checkbox' class='chkExamenes' value='Biometría Hemática'>&nbsp; Biometría Hemática</td> <td width='156'><input type='checkbox' class='chkExamenes' value='Hematocrito'>&nbsp; Hematocrito</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Elemental y Microscópico'>&nbsp; Elemental y Microscópico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Asto'>&nbsp; Asto</td> <td width='102'><input type='checkbox' class='chkExamenes' value='Latex'>&nbsp; Latex</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Reticulositos'>&nbsp; Reticulositos</td> <td><input type='checkbox' class='chkExamenes' value='Plaquetas'>&nbsp; Plaquetas</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Gota Fresca'>&nbsp; Gota Fresca</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='PCR'>&nbsp; PCR</td> <td><input type='checkbox' class='chkExamenes' value='Waaler Rose'>&nbsp; Waaler Rose</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Sedimentación'>&nbsp; Sedimentación</td> <td><input type='checkbox' class='chkExamenes' value='Fórmula Leuc.'>&nbsp; Fórmula Leuc.</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Gram'>&nbsp; Gram</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='VDRL'>&nbsp; VDRL</td> <td><input type='checkbox' class='chkExamenes' value='RPR'>&nbsp; RPR</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Hemoparásitos'>&nbsp; Hemoparásitos</td> <td><input type='checkbox' class='chkExamenes' value='Grupo Sanguineo'>&nbsp; Grupo Sanguineo</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Microalbuminuria'>&nbsp; Microalbuminuria</td> <td width='129'><input type='checkbox' class='chkExamenes' value='HIV'>&nbsp; HIV</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='FTA -ABS'>&nbsp; FTA -ABS</td> </tr> <tr> <td colspan='2'><b>COAGULACIÓN.</b></td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Proteinuria 24 horas'>&nbsp; Proteinuria 24 horas</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Serameba'>&nbsp; Serameba</td> <td><input type='checkbox' class='chkExamenes' value='Monotest'>&nbsp; Monotest</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='TP'>&nbsp; TP</td> <td><input type='checkbox' class='chkExamenes' value='TTP'>&nbsp; TTP</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Depuración Creatinina'>&nbsp; Depuración Creatinina</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='H. Pylori IgG'>&nbsp; H. Pylori IgG</td> <td><input type='checkbox' class='chkExamenes' value='H. Pylori IgA'>&nbsp; H. Pylori IgA</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Tiempo Trombina'>&nbsp; Tiempo Trombina</td> <td><input type='checkbox' class='chkExamenes' value='INR'>&nbsp; INR</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='SodioOr'>&nbsp; Sodio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='PotasioOr'>&nbsp; Potasio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Aglutinaciones'>&nbsp; Aglutinaciones</td> <td><input type='checkbox' class='chkExamenes' value='Dengue'>&nbsp; Dengue</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Tiempo Coagulación'>&nbsp; Tiempo Coagulación</td> <td><input type='checkbox' class='chkExamenes' value='Fibrinógeno'>&nbsp; Fibrinógeno</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='CloroOr'>&nbsp; Cloro</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Ac. UricoOr'>&nbsp; Ac. Urico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Epstein Barr'>&nbsp; Epstein Barr</td> <td><input type='checkbox' class='chkExamenes' value='IgGEps'>&nbsp; IgG</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Tiempo Hemorragia'>&nbsp; Tiempo Hemorragia</td> <td><input type='checkbox' class='chkExamenes' value='Antitrombina III'>&nbsp; Antitrombina III</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='CalcioOr'>&nbsp; Calcio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='FósforoOr'>&nbsp; Fósforo</td> <td colspan='3'><b>AUTOINMUNIDAD.</b></td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Coombs Directo'>&nbsp; Coombs Directo</td> <td><input type='checkbox' class='chkExamenes' value='Indirecto'>&nbsp; Indirecto</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='MagnesioOr'>&nbsp; Magnesio</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Ac. Antinucleares'>&nbsp; Ac. Antinucleares</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Retracción de Coágulo'>&nbsp; Retracción de Coágulo</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Prueba de embarazo'>&nbsp; Prueba de embarazo</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Ac. Anti DNA'>&nbsp; Ac. Anti DNA</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Otros Coagulación:'>&nbsp; Otros Coagulación:</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Panel de drogas (abuso)'>&nbsp; Panel de drogas (abuso)</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Células Le'>&nbsp; Células Le</td> </tr> <tr> <td colspan='2'><b>QUÍMICA SANGUÍNEA.</b></td> <td colspan='4'><!-- <input type='checkbox' class='chkExamenes' value='Otros Orina'> -->Otros Orina: <textarea id='txtOtrosOrina'cols='90' rows='2'></textarea></td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Anticitrulina (Anti -CCP)'>&nbsp; Anticitrulina (Anti -CCP)</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Glucosa Ayunas'>&nbsp; Glucosa Ayunas</td> <td><input type='checkbox' class='chkExamenes' value='Glocosa Postprandial'>&nbsp; Glocosa Postprandial</td> <td colspan='4'><b>INMUNODIAGNÓSTICO.</b></td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Ac. Antimicrosomales'>&nbsp; Ac. Antimicrosomales</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Curva de Glucosa'>&nbsp; Curva de Glucosa</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='TSH'>&nbsp; TSH</td> <td width='82'><input type='checkbox' class='chkExamenes' value='fT3'>&nbsp; fT3</td> <td width='54'><input type='checkbox' class='chkExamenes' value='fT4'>&nbsp; fT4</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Ac. Antitiroglobulinas'>&nbsp; Ac. Antitiroglobulinas</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Urea'>&nbsp; Urea</td> <td><input type='checkbox' class='chkExamenes' value='Bun'>&nbsp; Bun</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='FSH'>&nbsp; FSH</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='FH'>&nbsp; FH</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='ANA -BIOT'>&nbsp; ANA -BIOT</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Creatinina'>&nbsp; Creatinina</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Estrógenos'>&nbsp; Estrógenos</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Progesterona'>&nbsp; Progesterona</td> <td><input type='checkbox' class='chkExamenes' value='Antifosfolípidos'>&nbsp; Antifosfolípidos</td> <td width='45'><input type='checkbox' class='chkExamenes' value='IgGAntifosfo'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntifosfo'>&nbsp; IgM</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Ácido Úrico'>&nbsp; Ácido Úrico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='BHCG'>&nbsp; BHCG</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Testosferona'>&nbsp; Testosferona</td> <td><input type='checkbox' class='chkExamenes' value='Anticardiolipinas'>&nbsp; Anticardiolipinas</td> <td><input type='checkbox' class='chkExamenes' value='IgGAnticardio'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAnticardio'>&nbsp; IgM</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Lípidos Totales (Col -Tg -HDL -LDL)'>&nbsp; Lípidos Totales (Col -Tg -HDL -LDL)</td> <td width='101'><input type='checkbox' class='chkExamenes' value='Prolactina'>&nbsp; Prolactina</td> <td width='63'><input type='checkbox' class='chkExamenes' value='AMPro'>&nbsp; AM</td> <td><input type='checkbox' class='chkExamenes' value='PMPro'>&nbsp; PM</td> <td><input type='checkbox' class='chkExamenes' value='10'>&nbsp; 10</td> <td><input type='checkbox' class='chkExamenes' value='ANTI B2GP1'>&nbsp; ANTI B2GP1</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='ANCAS'>&nbsp; ANCAS</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Colesterol'>&nbsp; Colesterol</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Cortisol'>&nbsp; Cortisol</td> <td><input type='checkbox' class='chkExamenes' value='AMCor'>&nbsp; AM</td> <td><input type='checkbox' class='chkExamenes' value='PMCor'>&nbsp; PM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Anti mitocondriales'>&nbsp; Anti mitocondriales</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HDL -Colesterol'>&nbsp; HDL -Colesterol</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Insulina ayunas'>&nbsp; Insulina ayunas</td> <td><input type='checkbox' class='chkExamenes' value='PP'>&nbsp; PP</td> <td colspan='3'><b>MARCADORES TUMORALES.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='LDL -Colesterol'>&nbsp; LDL -Colesterol</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Péptido C'>&nbsp; Péptido C</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='CEA -Carcino Embrionario'>&nbsp; CEA -Carcino Embrionario</td> </tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Triglicéridos'>&nbsp; Triglicéridos</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Hormona de Crecimiento'>&nbsp; Hormona de Crecimiento</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='AFP - Alfa -feto Proteína'>&nbsp; AFP - Alfa -feto Proteína</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Apolipoproteína A'>&nbsp; Apolipoproteína A</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='IgFBP1'>&nbsp; IgFBP1</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='IgFBP3'>&nbsp; IgFBP3</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='PSA - Antígeno Prostático Específico'>&nbsp; PSA - Antígeno Prostático Específico</td> </tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Apolipoproteína B'>&nbsp; Apolipoproteína B</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Paratohormona'>&nbsp; Paratohormona</td> <td><input type='checkbox' class='chkExamenes' value='PSA libre'>&nbsp; PSA libre</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HCGBMarcTum'>&nbsp; HCGB</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='VLDL'>&nbsp; VLDL</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='17 -OH -progesterona'>&nbsp; 17 -OH -progesterona</td> <td><input type='checkbox' class='chkExamenes' value='Ca 125'>&nbsp; Ca 125</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Ca 15 -3'>&nbsp; Ca 15 -3</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Bilirrubinas (T -I -D)'>&nbsp; Bilirrubinas (T -I -D)</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Androstendiona'>&nbsp; Androstendiona</td> <td><input type='checkbox' class='chkExamenes' value='Ca 19 -9'>&nbsp; Ca 19 -9</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Ca 72 -4'>&nbsp; Ca 72 -4</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Proteínas Totales'>&nbsp; Proteínas Totales</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='DHEAS'>&nbsp; DHEAS</td> <td><input type='checkbox' class='chkExamenes' value='Anti TPO'>&nbsp; Anti TPO</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Tiroglobulina'>&nbsp; Tiroglobulina</td> </tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Albúmina -Globulina'>&nbsp; Albúmina -Globulina</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Test Estimulación HGH'>&nbsp; Test Estimulación HGH</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Neuroenolasa específica'>&nbsp; Neuroenolasa específica</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HB glicosilada'>&nbsp; HB glicosilada</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Test LH /GnRH'>&nbsp; Test LH /GnRH</td> <td colspan='3'><b>ESTUDIOS ESPECIALES.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Fructosamina'>&nbsp; Fructosamina</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Test FSH /GnRH'>&nbsp; Test FSH /GnRH</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Espermatograma'>&nbsp; Espermatograma</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Hierro'>&nbsp; Hierro</td> <td><input type='checkbox' class='chkExamenes' value='Vit. B12'>&nbsp; Vit. B12</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Test TSH /TRH'>&nbsp; Test TSH /TRH</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Estudio cálculo'>&nbsp; Estudio cálculo</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Transferrina'>&nbsp; Transferrina</td> <td><input type='checkbox' class='chkExamenes' value='Ac. Fólico'>&nbsp; Ac. Fólico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti Toxoplasma'>&nbsp; Anti Toxoplasma</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiTox'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiTox'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Citoquímico LCR'>&nbsp; Citoquímico LCR</td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Ferritina'>&nbsp; Ferritina</td> <td><input type='checkbox' class='chkExamenes' value='Ind. Saturación'>&nbsp; Ind. Saturación</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti Rubeola'>&nbsp; Anti Rubeola</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiRu'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiRu'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Pap -Test'>&nbsp; Pap -Test</td> </tr><tr> <td><input type='checkbox' class='chkExamenes' value='TGO /AST'>&nbsp; TGO /AST</td> <td><input type='checkbox' class='chkExamenes' value='CPK'>&nbsp; CPK</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti CMV'>&nbsp; Anti CMV</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiCmv'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiIgm'>&nbsp; IgM</td> <td colspan='3'><!-- <input type='checkbox' class='chkExamenes' value='Estudio Líquidos'> -->Estudio Líquidos: <textarea id='txtEstLiq' cols='90' rows='2'></textarea> </td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='TGP /ALT'>&nbsp; TGP /ALT</td> <td><input type='checkbox' class='chkExamenes' value='CPK -MB'>&nbsp; CPK -MB</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti Herpes I'>&nbsp; Anti Herpes I</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiH1'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiH1'>&nbsp; IgM</td> <td colspan='3'><b>BACTERIOLOGÍA.</b></td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Gamma GT'>&nbsp; Gamma GT</td> <td><input type='checkbox' class='chkExamenes' value='Troponina'>&nbsp; Troponina</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti Herpes II'>&nbsp; Anti Herpes II</td> <td><input type='checkbox' class='chkExamenes' value='IgGAntiH2'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMAntiH2'>&nbsp; IgM</td> <td colspan='3'> <!-- <input type='checkbox' class='chkExamenes' value='Muestra de: '> -->Muestra de: <textarea id='txtMuestra' cols='90' rows='2'></textarea></td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Fost. Alcalina'>&nbsp; Fost. Alcalina</td> <td><input type='checkbox' class='chkExamenes' value='Aldolasa'>&nbsp; Aldolasa</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='TORCH'>&nbsp; TORCH</td> <td><input type='checkbox' class='chkExamenes' value='IgGTorch'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMTorch'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Cultivo y antibiograma'>&nbsp; Cultivo y antibiograma</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Fost. Acida'>&nbsp; Fost. Acida</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='C3'>&nbsp; C3</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='C4'>&nbsp; C4</td> <td><input type='checkbox' class='chkExamenes' value='Gram'>&nbsp; Gram</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Fresco'>&nbsp; Fresco</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Fost. Ac. Prostática'>&nbsp; Fost. Ac. Prostática</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgGIn'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='BAAR'>BAAR</td> <td colspan='2'> <!-- <input type='checkbox' class='chkExamenes' value='Días No: '> -->Días No: <textarea id='txtDiasNo' cols='90' rows='2'></textarea> </td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Amilasa'>&nbsp; Amilasa</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgMIn'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Investigacion de hongos (KOH)'>&nbsp; Investigacion de hongos (KOH)</td> </tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Lipasa'>&nbsp; Lipasa</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgE'>&nbsp; IgE</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Control tratamiento'>&nbsp; Control tratamiento</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Glucosa 6 Fosfato DH'>&nbsp; Glucosa 6 Fosfato DH</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgA'>&nbsp; IgA</td> <td colspan='3'><b>PERFIL GENERAL.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Deshidrogena láctica'>&nbsp; Deshidrogena láctica</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='IgD'>&nbsp; IgD</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Biometría Hemática, EMO, Coproparasitario, glucosa, urea, creatina, ac. único, colesterol trigliceridos, HDL, LDL, VDRL.'>&nbsp; Biometría Hemática, EMO, Coproparasitario, glucosa, urea, creatina, ac. único, colesterol trigliceridos, HDL, LDL, VDRL.</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Colinesterasa'>&nbsp; Colinesterasa</td> <td><input type='checkbox' class='chkExamenes' value='Chlamidia'>&nbsp; Chlamidia</td> <td><input type='checkbox' class='chkExamenes' value='IgGChl'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgMChl'>&nbsp; IgM</td> <td><input type='checkbox' class='chkExamenes' value='IgAChl'>&nbsp; IgA</td> <td colspan='3'><b>PERFIL DE DIABETES.</b></td> </tr> <tr> <td colspan='2'><b>ELECTROLITOS.</b></td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Hepatitis A'>&nbsp; Hepatitis A</td> <td><input type='checkbox' class='chkExamenes' value='IgMHepA'>&nbsp; IgM</td> <td><input type='checkbox' class='chkExamenes' value='IgMHepA'>&nbsp; IgM</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Biometría, glucosa, Hb glicosilada, fructosamina creatina, acido úrico, colesterol, HDL, LDL, Triglicéridos, microalbuminuria, EMO.'>&nbsp; Biometría, glucosa, Hb glicosilada, fructosamina creatina, acido úrico, colesterol, HDL, LDL, Triglicéridos, microalbuminuria, EMO.</td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Sodio'>&nbsp; Sodio</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Hepatitis B'>&nbsp; Hepatitis B</td> <td colspan='3'><b>PERFIL HEPÁTICO.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Potasio'>&nbsp; Potasio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HBsAg'>&nbsp; HBsAg</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti HBs'>&nbsp; Anti HBs</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Biometría, glucosa, colesterol, triglicéridos, proteínas, albúmina, bilirrubinas, TGO, TGP, GGT, fosfata alcalina, TP.'> &nbsp; Biometría, glucosa, colesterol, triglicéridos, proteínas, albúmina, bilirrubinas, TGO, TGP, GGT, fosfata alcalina, TP, TTP, Bilirrubina Totales y Parciales. </td> </tr><tr> <td><input type='checkbox' class='chkExamenes' value='Cloro'>&nbsp; Cloro</td> <td><input type='checkbox' class='chkExamenes' value='Magnesio'>&nbsp; Magnesio</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HBc'>&nbsp; HBc</td> <td><input type='checkbox' class='chkExamenes' value='IgGHbc'>&nbsp; IgG</td> <td><input type='checkbox' class='chkExamenes' value='IgmHbc'>&nbsp; Igm</td> <td colspan='3'><b>PERFIL LIPÍDICO.</b></td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Calcio total'>&nbsp; Calcio total</td> <td><input type='checkbox' class='chkExamenes' value='Calcio lónico'>&nbsp; Calcio lónico</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='HBeAg'>HBeAg</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Anti HBe'>&nbsp; Anti HBe</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Líquidos totales, Colesterol, Triglicéridos, HDL, LDL, Apo A, Apo B, fibrinógeno.'>&nbsp; Líquidos totales, Colesterol, Triglicéridos, HDL, LDL, Apo A, Apo B, fibrinógeno. </td> </tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Fósforo'>&nbsp; Fósforo</td> <td><input type='checkbox' class='chkCobre'>Cobre</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Hepatitis C'>&nbsp; Hepatitis C</td> <td colspan='3'><b>PERFIL REUMÁTICO.</b></td> </tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Litio'>&nbsp; Litio</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Tuberculosis en suero'>&nbsp; Tuberculosis en suero</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='PERFIL REUMÁTICO: BH, Glucosa, Creatinina, Asto, PCR'>&nbsp; BH, Glucosa, Creatinina, Asto, PCR</td></tr> <tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Amonio'>&nbsp; Amonio</td> <td colspan='4'><b>HECES.</b></td> <td colspan='3'><b>TIROIDITIS.</b></td></tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Ácido Valproico'>&nbsp; Ácido Valproico</td> <td><input type='checkbox' class='chkExamenes' value='Digoxina'>&nbsp; Digoxina</td>  <td colspan='4'><input type='checkbox' class='chkExamenes' value='Coproparasitario rutina'>&nbsp; Coproparasitario rutina</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Tiroiditis: Anti - Tiroglobulina, Anti - Peroxidasa, Tiroglobulina'> &nbsp; Anti - Tiroglobulina, Anti - Peroxidasa, Tiroglobulina</td></tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Carbamacepina'>&nbsp; Carbamacepina</td> <td><input type='checkbox' class='chkExamenes' value='Fenobarbital'>&nbsp; Fenobarbital</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Coproparasitario Seriado'>&nbsp; Coproparasitario Seriado</td> <td colspan='3'><b>HIPOTIROIDISMO.</b></td></tr><tr> <td><input type='checkbox' class='chkExamenes' value='Epamin'>&nbsp; Epamin</td> <td>&nbsp;</td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Inv. Polimorfonucleares'>&nbsp; Inv. Polimorfonucleares</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='Hipotiroidismo: TSH, FT4, FT3. '> &nbsp; TSH, FT4, FT3. </td></tr> <tr> <td colspan='2'>Otros Electrolitos: <textarea id='txtOtrosElectro' cols='90' rows='2'></textarea></td> <td colspan='4'><input type='checkbox' class='chkExamenes' value='Sangre oculta'>&nbsp; Sangre oculta</td> <td colspan='3'>&nbsp;</td></tr> <tr> <td colspan='2'><b>HTA. Hipertensión.</b></td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Rotavirus'>&nbsp; Rotavirus</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='pH'>&nbsp; pH</td> <td colspan='3'><b>PREQUIRÚRGICO.</b></td></tr> <tr> <td> <!--<input type='checkbox' class='chkExamenes' value='Otros Electrolitos: '> --> <input type='checkbox' class='chkExamenes' value='BH.'>&nbsp; BH.</td> <td> <input type='checkbox' class='chkExamenes' value='HDL'>&nbsp; HDL </td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Concentración'>&nbsp; Concentración</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Andenovirus'>&nbsp; Andenovirus</td> <td colspan='3'><input type='checkbox' class='chkExamenes' value='PREQUIRÚRGICO: Biometría Hemática, Uera, Glucosa, Creatinina, TP, EMO.'>&nbsp; Biometría Hemática, Uera, Glucosa, Creatinina, TP, EMO</td></tr> <tr> <td><input type='checkbox' class='chkExamenes' value='Urea Prequ'>&nbsp; Urea</td> <td> <input type='checkbox' class='chkExamenes' value='LDL'>&nbsp; LDL </td><td colspan='2'><input type='checkbox' class='chkExamenes' value='Sudan III'>&nbsp; Sudan III</td> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Coprológico'>&nbsp; Coprológico</td> <td colspan='3'>&nbsp;</td></tr><tr> <td><input type='checkbox' class='chkExamenes' value='Glucosa'>&nbsp; Glucosa.</td><td><input type='checkbox' class='chkExamenes' value='TSH'>&nbsp; TSH</td><td colspan='4'>&nbsp;</td><td colspan='3'><b>PRUEBAS INMUNOLÓGICAS</b></td></tr><tr> <td><input type='checkbox' class='chkExamenes' value='Cratinina'>&nbsp; Creatinina</td> <td><input type='checkbox' class='chkExamenes' value='TSH'>&nbsp; TSH</td><td colspan='4'>&nbsp;</td><td colspan='3'><input type='checkbox' class='chkExamenes' value='Pruebas Inmunológicas: AMA, ANCAS, ANTI - ANA, C3, C4'>&nbsp; ANA, ANCAS, ANTI - ANA, C3, C4</td></tr><tr> <td colspan='2'><input type='checkbox' class='chkExamenes' value='Triglicérido'>&nbsp; Triglicérido</td><td colspan='4'>&nbsp;</td><td colspan='3'>&nbsp;</td></tr><tr> <td colspan='9'>&nbsp;</td></tr><tr> <td colspan='9'><center><a href='#myModal'  onclick='ImprSolicitud()' role='button' class='btn btn-primary' data-toggle='modal' > Guardar Exámenes</a></center></td></tr><tr> <td colspan='9'>&nbsp;</td></tr></table>");
		}
		else
		{
			$( ".Resp3" ).html("<table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='4'>RESONACIA MAGNETICA Siemens MAGNETOM ESSENZA 1.5 T</td> </tr> <tr> <td colspan='4'>CABEZA</td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='CEREBRO'> CEREBRO <br><input type='checkbox' class='chk_medimagenes' value='contraste_CEREBRO'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='HIPOFISIS'> HIPOFISIS <br><input type='checkbox' class='chk_medimagenes' value='contraste_HIPOFISIS'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='SENOS_PARANASALES'> SENOS PARANASALES <br><input type='checkbox' class='chk_medimagenes' value='contraste_SENOS_PARANA'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='OIDOS'> OIDOS <br><input type='checkbox' class='chk_medimagenes' value='contraste_OIDOS'>Con contraste</br></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='ORBITAS'> ORBITAS <br><input type='checkbox' class='chk_medimagenes' value='contraste_ORBITAS'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='CAROTIDAS'> CAROTIDAS <br><input type='checkbox' class='chk_medimagenes' value='contraste_CAROTIDAS'>Con contraste</br></td> <td colspan='2'><input type='checkbox' class='chk_medimagenes' value='OTROS_CABEZA'> OTROS </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='2'>COLUMNA</td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='COLUMNA_CERVICAL'> COLUMNA CERVICAL <br><input type='checkbox' class='chk_medimagenes' value='contraste_COLUMNA_CERVICAL'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='COLUMNA_DORSAL'> COLUMNA DORSAL <br><input type='checkbox' class='chk_medimagenes'>Con contraste</br></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='COLUMNA_LUMBAR'> COLUMNA LUMBAR <br><input type='checkbox' class='chk_medimagenes' value='contraste_COLUMNA_LUMBAR'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='OTROS_COLUMNA'> OTROS </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed' > <tr> <td colspan='3'>CUELLO Y CUERPO</td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='CUELLO'> CUELLO <br><input type='checkbox' class='chk_medimagenes' value='contraste_CUELLO'>Con contraste</br></td> <td colspan='2'><input type='checkbox' class='chk_medimagenes' value='TORAX'> TORAX <br><input type='checkbox' class='chk_medimagenes' value='contraste_TORAX'>Con contraste</br></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='ABDOMEN'> ABDOMEN <br><input type='checkbox' class='chk_medimagenes' value='contraste_ABDOMEN'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes' value='PELVIS'> PELVIS <br><input type='checkbox' class='chk_medimagenes' value='contraste_PELVIS'>Con contraste</br></td> <td><input type='checkbox' class='chk_medimagenes'> OTROS </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='2'>MAMAS<input type='checkbox' class='chk_medimagenes' value='MAMAS'></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='contraste_MAMAS'> Con contraste <input type='checkbox' class='chk_medimagenes' value='espectroscopia_MAMAS'> Espectroscopia </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed' > <tr> <td colspan='3'>MUSCULO ESQUELETICO</td> </tr> <tr> <td>RODILLA: DER<input type='checkbox' class='chk_medimagenes' value='RODILLA_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='RODILLA_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_RODILLA'>Con contraste</br></td> <td>PELVIS: DER<input type='checkbox' class='chk_medimagenes' value='PELVIS_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='PELVIS_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_PELVIS'>Con contraste</br></td> <td>MUÑECA: DER<input type='checkbox' class='chk_medimagenes' value='MUÑECA_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='MUÑECA_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_MUÑECA'>Con contraste</br></td> </tr> <tr> <td>HOMBRO: DER<input type='checkbox' class='chk_medimagenes' value='HOMBRO_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='HOMBRO_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_HOMBRO'>Con contraste</br></td> <td>TOBILLO: DER<input type='checkbox' class='chk_medimagenes' value='TOBILLO_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='TOBILLO_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_TOBILLO'>Con contraste</br></td> <td>CODO: DER<input type='checkbox' class='chk_medimagenes' value='CODO_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='CODO_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_CODO'>Con contraste</br></td> </tr> <tr> <td>MANO: DER<input type='checkbox' class='chk_medimagenes' value='MANO_der'> IZQ <input type='checkbox' class='chk_medimagenes' value='MANO_izq'> <br><input type='checkbox' class='chk_medimagenes' value='contraste_MANO'>Con contraste</br></td> <td>PIE: DER<input type='checkbox' class='chk_medimagenes'> IZQ <input type='checkbox' class='chk_medimagenes' value='PIE_izq'> <br><input type='checkbox' id='chk_contraste_PIE' value='contraste_PIE'>Con contraste</br></td> <td>OTROS <br><input type='checkbox' class='chk_medimagenes' value='contraste_MUSCU_ESQUE_OTROS'>Con contraste</br></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='3'>TOMOGRAFIA AXIAL COMPUTARIZADA <input type='checkbox' class='chk_medimagenes' value='TOMOGRAFIA'></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='craneo_TOMOGRAFIA'>CRANEO <br><input type='checkbox' class='chk_medimagenes' value='contraste_craneo_TOMOGRAFIA'>Con contraste <input type='checkbox' class='chk_medimagenes' value='osea_TOMOGRAFIA'>Ventana Ósea </br></td> <td><input type='checkbox' class='chk_medimagenes' value='SENOS PARANASALES_TOMOGRAFIA'>SENOS PARANASALES<br><input type='checkbox' class='chk_medimagenes' value='axia_TOMOGRAFIA'>Axial <input type='checkbox' class='chk_medimagenes' value='coronal_TOMOGRAFIA'>Coronal </br></td> <td><input type='checkbox' class='chk_medimagenes' value='facial_TOMOGRAFIA'>MACIZO FACIAL</td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='oidos_TOMOGRAFIA'>OIDOS <br><input type='checkbox' class='chk_medimagenes' value='axia_oido_TOMOGRAFIA'>Axial <input type='checkbox' class='chk_medimagenes' value='Coronal_oido_TOMOGRAFIA'>Coronal </br></td> <td><input type='checkbox' class='chk_medimagenes' value='orbitas_TOMOGRAFIA'>ORBITAS <br><input type='checkbox' class='chk_medimagenes' value='contraste_orbitas_TOMOGRAFIA'>Con contraste </br></td> <td><input type='checkbox' class='chk_medimagenes' value='cuello_TOMOGRAFIA'>CUELLO <br><input type='checkbox' class='chk_medimagenes' value='contraste_cuello_TOMOGRAFIA'>Con contraste </br></td> </tr> <tr> <td><input type='checkbox' class='chk_medimagenes' value='torax_TOMOGRAFIA'>TORAX <br><input type='checkbox' class='chk_medimagenes' value='contraste_torax_TOMOGRAFIA'>Con contraste </br></td> <td><input type='checkbox' class='chk_medimagenes' value='abdomen_TOMOGRAFIA'>ABDOMEN <br><input type='checkbox' class='chk_medimagenes' value='contraste_abdomen_TOMOGRAFIA'>Con contraste </br></td> <td><input type='checkbox' class='chk_medimagenes' value='pelvis_TOMOGRAFIA'>PELVIS <br><input type='checkbox' class='chk_medimagenes' value='contraste_pelvis_TOMOGRAFIA'>Con contraste </br></td> </tr> <tr> <td colspan='3'><input type='checkbox' class='chk_medimagenes' value='otros_TOMOGRAFIA'>OTROS: </td> </tr> </table> <table  class='table table-bordered table-striped table-hover table-condensed' > <tr> <td>RX DIGITAL<input type='checkbox' class='chk_medimagenes' value='RX_DIGITAL'> PANORAMICA DENTAL<input type='checkbox' class='chk_medimagenes' value='PANORAMICA_DENTAL'></td> </tr> <tr> <td>&nbsp;</td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td>MAMOGRAFIA DIGITAL<input type='checkbox' class='chk_medimagenes' value='MAMOGRAFIA_DIGITAL'></td> </tr> <tr> <td>BILATERAL<input type='checkbox' class='chk_medimagenes' value='BILATERAL_MAMOGRAFIA'> UNILATERAL<input type='checkbox' class='chk_medimagenes' value='UNILATERAL_MAMOGRAFIA'>FOCALIZACION<input type='checkbox' class='chk_medimagenes' value='FOCALIZACION_MAMOGRAFIA'>GALACTOGRAFIA<input type='checkbox' class='chk_medimagenes' value='GALACTOGRAFIA_MAMOGRAFIA'></td> </tr> </table> <table  class='table table-bordered table-striped table-hover table-condensed'  > <tr> <td>ECOGRAFIA<input type='checkbox' class='chk_medimagenes' value='ECOGRAFIA'> 3-4 D<input type='checkbox' class='chk_medimagenes' value='3-4_D'>DOPPLER<input type='checkbox' class='chk_medimagenes' value='DOPPLER'> ECOCARDIOGRAMA<input type='checkbox' class='chk_medimagenes' value='ECOCARDIOGRAMA'></td> </tr> <tr> <td>&nbsp;</td> </tr> </table> <table   class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='4'>DENSITOMETRIA OSEA<input type='checkbox' class='chk_medimagenes' ></td> </tr> <td>ANTEBRAZO<input type='checkbox' class='chk_medimagenes' value='ANTEBRAZO_DENSITOMETRIA'></td><td> COLUMNA LUMBAR</td> <td>CUELLO FEMORAL</td> <td> CUERPO TOTAL<input type='checkbox' class='chk_medimagenes' value='CUELLO_FEMORAL_DENSITOMETRIA'></td> </tr> <tr> <td>&nbsp;</td> <td>AP<input type='checkbox' class='chk_medimagenes' value='AP_COLUMNA_LUMBAR'> LAT<input type='checkbox' class='chk_medimagenes' value='LAT_COLUMNA_LUMBAR'> </td> <td>DER<input type='checkbox' class='chk_medimagenes' value='DER_CUELLO_FEMORAL'> IZQ<input type='checkbox' class='chk_medimagenes' value='IZQ_CUELLO_FEMORAL'> </td> <td>&nbsp;</td> </tr> <table class='table table-bordered table-striped table-hover table-condensed'> <tr> <td colspan='4'>RADIOGRAFIA</td> </tr> <tr> <td>ART. TEMPORO MAXILAR UNI.<input type='checkbox' class='chk_medimagenes' value='ART. TEMPORO MAXILAR UNI.' /></td> <td>ART. TEMPORO MAXILAR BIL.<input type='checkbox' class='chk_medimagenes' value='ART. TEMPORO MAXILAR BIL.' /></td> <td>TOMOGRAFIA DE CRANEO<input type='checkbox' class='chk_medimagenes' value='TOMOGRAFIA DE CRANEO' /></td> <td>HUESOS FACIALES 1 POSC.<input type='checkbox' class='chk_medimagenes' value='HUESOS FACIALES 1 POSC.' /></td> </tr> <tr> <td>HUESOS FACIALES 2 POSC.<input type='checkbox' class='chk_medimagenes' value='HUESOS FACIALES 2 POSC.' /></td> <td>HUESOS FACIALES 3 POSC.<input type='checkbox' class='chk_medimagenes' value='HUESOS FACIALES 3 POSC.' /></td> <td>HUESOS NASALES 3 POSC.<input type='checkbox' class='chk_medimagenes' value='HUESOS NASALES 3 POSC.' /></td> <td>MAXILAR 2 POSC.<input type='checkbox' class='chk_medimagenes' value='MAXILAR 2 POSC.' /></td> </tr> <tr> <td>MAXILAR 3 POSC.<input type='checkbox' class='chk_medimagenes' value='MAXILAR 3 POSC.' /></td> <td>SENOS PARANASALES<input type='checkbox' class='chk_medimagenes' value='SENOS PARANASALES' /></td> <td>CAVUN SIMPLE<input type='checkbox' class='chk_medimagenes' value='CAVUN SIMPLE' /></td> <td>CAVUN CONTRASTADO<input type='checkbox' class='chk_medimagenes' value='CAVUN CONTRASTADO' /></td> </tr> <tr> <td>CUELLO 2 POSC. PARTES BLANDAS<input type='checkbox' class='chk_medimagenes' value='CUELLO 2 POSC. PARTES BLANDAS' /></td> <td>CERVICAL AP-LAT<input type='checkbox' class='chk_medimagenes' value='CERVICAL AP-LAT' /></td> <td>CERVICAL AP-LAT-OBL<input type='checkbox' class='chk_medimagenes' value='CERVICAL AP-LAT-OBL' /></td> <td>CERVICAL FUNCIONAL<input type='checkbox' class='chk_medimagenes' value='CERVICAL FUNCIONAL' /></td> </tr> <tr> <td>DORSAL AP-LAT<input type='checkbox' class='chk_medimagenes' value='DORSAL AP-LAT' /></td> <td>DORSAL 4 POSC.<input type='checkbox' class='chk_medimagenes' value='DORSAL 4 POSC.' /></td> <td>LUMBAR AP-LAT<input type='checkbox' class='chk_medimagenes' value='LUMBAR AP-LAT' /></td> <td>LUMBAR 4 POSC.<input type='checkbox' class='chk_medimagenes' value='CERVICAL FUNCIONAL' /></td> </tr> <tr> <td>SACRO Y COXIS AP-LAT<input type='checkbox' class='chk_medimagenes' value='SACRO Y COXIS AP-LAT' /></td> <td>COLUMNA 1 POSC.-1 PLACA<input type='checkbox' class='chk_medimagenes' value='COLUMNA 1 POSC.-1 PLACA' /></td> <td>COLUMNA 2 POSC.-2 PLACA<input type='checkbox' class='chk_medimagenes' value='COLUMNA 2 POSC.-2 PLACA' /></td> <td>COLUMNA 3 POSC.-3 PLACA<input type='checkbox' class='chk_medimagenes' value='COLUMNA 3 POSC.-3 PLACA' /></td> </tr> <tr> <td>TOMOGRAFIA DE COLUMNA<input type='checkbox' class='chk_medimagenes' value='TOMOGRAFIA DE COLUMNA' /></td> <td>TORAX 1 POSC.<input type='checkbox' class='chk_medimagenes' value='TORAX 1 POSC.' /></td> <td>TORAX 2 POSC.<input type='checkbox' class='chk_medimagenes' value='TORAX 2 POSC.' /></td> <td>TORAX 3 POSC.<input type='checkbox' class='chk_medimagenes' value='TORAX 2 POSC.' /></td> </tr> <tr> <td>TORAX 4 POSC.<input type='checkbox' class='chk_medimagenes' value='TORAX 4 POSC.' /></td> <td>FLUROSCOPIA DE TORAX<input type='checkbox' class='chk_medimagenes' value='FLUROSCOPIA DE TORAX' /></td> <td>TOMOGRAFIA PULMONAR<input type='checkbox' class='chk_medimagenes' value='TOMOGRAFIA PULMONAR' /></td> <td>ESOFAGOGRAMA<input type='checkbox' class='chk_medimagenes' value='ESOFAGOGRAMA' /></td> </tr> <tr> <td>ABDOMEN 1 POSC.<input type='checkbox' class='chk_medimagenes' value='ABDOMEN 1 POSC.' /></td> <td>ABDOMEN 2 POSC.<input type='checkbox' class='chk_medimagenes' value='ABDOMEN 2 POSC.' /></td> <td>ABDOMEN 3 POSC.<input type='checkbox' class='chk_medimagenes' value='ABDOMEN 3 POSC.' /></td> <td>SERIE E.G.D<input type='checkbox' class='chk_medimagenes' value='SERIE E.G.D' /></td> </tr> <tr> <td>S.G.D.+ TRANSITO INTESTINAL<input type='checkbox' class='chk_medimagenes' value='S.G.D.+ TRANSITO INTESTINAL' /></td> <td>TRANSITO INTESTINAL<input type='checkbox' class='chk_medimagenes' value='TRANSITO INTESTINAL' /></td> <td>ENEMA DE BARIO<input type='checkbox' class='chk_medimagenes' value='ENEMA DE BARIO' /></td> <td>COLECISTOGRAFIA ORAL<input type='checkbox' class='chk_medimagenes' value='COLECISTOGRAFIA ORAL' /></td> </tr> <tr> <td>COLANGIOGRAFIA INTRAVENOSA<input type='checkbox' class='chk_medimagenes' value='COLANGIOGRAFIA INTRAVENOSA' /></td> <td>COLANGIOGRAFIA POR SONDA<input type='checkbox' class='chk_medimagenes' value='COLANGIOGRAFIA POR SONDA' /></td> <td>COLANGIOGRAFIA TRANS-OPEN<input type='checkbox' class='chk_medimagenes' value='COLANGIOGRAFIA TRANS-OPEN' /></td> <td>UROGRAFIA EXCRETORIA<input type='checkbox' class='chk_medimagenes' value='UROGRAFIA EXCRETORIA' /></td> </tr> <tr> <td>UROGRAFIA POR DILUCION<input type='checkbox' class='chk_medimagenes' value='UROGRAFIA POR DILUCION' /></td> <td>NEFROTOMOGRAFIA<input type='checkbox' class='chk_medimagenes' value='NEFROTOMOGRAFIA' /></td> <td>PIELOGRAFIA RETROGADA<input type='checkbox' class='chk_medimagenes' value='PIELOGRAFIA RETROGADA' /></td> <td>CISTOGRAFIA<input type='checkbox' class='chk_medimagenes' value='CISTOGRAFIA' /></td> </tr> <tr> <td>URETROCISTOPOGRAFICA<input type='checkbox' class='chk_medimagenes' value='URETROCISTOPOGRAFICA' /></td> <td>PELVIMETRIA<input type='checkbox' class='chk_medimagenes' value='PELVIMETRIA' /></td> <td>FISTULOGRAFIA<input type='checkbox' class='chk_medimagenes' value='FISTULOGRAFIA' /></td> <td>CLAVIVULA 1 POSC.<input type='checkbox' class='chk_medimagenes' value='CLAVIVULA 1 POSC.' /></td> </tr> <tr> <td>HOMBRO 1 POSC.<input type='checkbox' class='chk_medimagenes' value='HOMBRO 1 POSC.' /></td> <td>HOMBRO 2 POSC.<input type='checkbox' class='chk_medimagenes' value='HOMBRO 2 POSC.' /></td> <td>HOMBRO 3 POSC.<input type='checkbox' class='chk_medimagenes' value='HOMBRO 3 POSC.' /></td> <td>HOMBRO BILATERAL 1 PLACA<input type='checkbox' class='chk_medimagenes' value='HOMBRO BILATERAL 1 PLACA' /></td> </tr> <tr> <td>BRAZO AP-LAT<input type='checkbox' class='chk_medimagenes' value='BRAZO AP-LAT' /></td> <td>CODO AP-LAT<input type='checkbox' class='chk_medimagenes' value='CODO AP-LAT' /></td> <td>CODO 3 POSC.<input type='checkbox' class='chk_medimagenes' value='CODO 3 POSC.' /></td> <td>ANTEBRAZO AP-LAT<input type='checkbox' class='chk_medimagenes' value='ANTEBRAZO AP-LAT' /></td> </tr> <tr> <td>MUÑECA 2 POSC.<input type='checkbox' class='chk_medimagenes' value='MUÑECA 2 POSC.' /></td> <td>MUÑECA 3 POSC.<input type='checkbox' class='chk_medimagenes' value='MUÑECA 3 POSC.' /></td> <td>MANO 2 POSC.<input type='checkbox' class='chk_medimagenes' value='MANO 2 POSC.' /></td> <td>DEDOS AP-LAT<input type='checkbox' class='chk_medimagenes' value='DEDOS AP-LAT' /></td> </tr> <tr> <td>MIEMBRO SUP. 1 POSC.<input type='checkbox' class='chk_medimagenes' value='MIEMBRO SUP. 1 POSC.' /></td> <td>PELVIS 1 POSC.<input type='checkbox' class='chk_medimagenes' value='PELVIS 1 POSC.' /></td> <td>CADERA 2 POSC.<input type='checkbox' class='chk_medimagenes' value='CADERA 2 POSC.' /></td> <td>CADERA 3 POSC.<input type='checkbox' class='chk_medimagenes' value='CADERA 3 POSC.' /></td> </tr> <tr> <td>CADERA 4 POSC.<input type='checkbox' class='chk_medimagenes' value='CADERA 4 POSC.' /></td> <td>MUSLO AP-LAT<input type='checkbox' class='chk_medimagenes' value='MUSLO AP-LAT' /></td> <td>RODILLA AP-LAT<input type='checkbox' class='chk_medimagenes' value='RODILLA AP-LAT' /></td> <td>RODILLA 4 POSC.<input type='checkbox' class='chk_medimagenes' value='RODILLA 4 POSC.' /></td> </tr> <tr> <td>PIERNA AP-LAT<input type='checkbox' class='chk_medimagenes' value='PIERNA AP-LAT' /></td> <td>TOBILLO AP-LAT<input type='checkbox' class='chk_medimagenes' value='TOBILLO AP-LAT' /></td> <td>TOBILLO 4 POSC.<input type='checkbox' class='chk_medimagenes' value='TOBILLO 4 POSC.' /></td> <td>PIE 2 POSC.<input type='checkbox' class='chk_medimagenes' value='PIE 2 POSC.' /></td> </tr> <tr> <td>PIE 3 POSC.<input type='checkbox' class='chk_medimagenes' value='PIE 3 POSC.' /></td> <td>CALCANEO 2 POSC.<input type='checkbox' class='chk_medimagenes' value='CALCANEO 2 POSC.' /></td> <td>MIEMBRO INFERIOR 1 POSC.<input type='checkbox' class='chk_medimagenes' value='MIEMBRO INFERIOR 1 POSC.' /></td> <td>ESCANOGRAMA<input type='checkbox' class='chk_medimagenes' value='ESCANOGRAMA' /></td> </tr> <tr> <td>EDAD OSEA 1 PLACA<input type='checkbox' class='chk_medimagenes' value='EDAD OSEA 1 PLACA' /></td> <td>EDAD OSEA 2 PLACA<input type='checkbox' class='chk_medimagenes' value='EDAD OSEA 2 PLACA' /></td> <td>EDAD OSEA 3 PLACA<input type='checkbox' class='chk_medimagenes' value='EDAD OSEA 3 PLACA' /></td> <td>SERIE METASTASICA<input type='checkbox' class='chk_medimagenes' value='SERIE METASTASICA' /></td> </tr> <tr> <td>TEST DE FARRIL<input type='checkbox' class='chk_medimagenes' value='TEST DE FARRIL' /></td> </tr> <tr> <td colspan='4' align='center'><br>Firma Y Sello Del Medico</br></td> </tr> <td align='center'><a href='#myModal' role='button' class='btn btn-primary' data-toggle='modal' onclick='imp_medimagenes()'>Guardar</a>  </table>");
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
						/*$('#areaExamenes2').dialog({
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
				$('#areaExamenes2').dialog('open');*/
				$('.modal-body').html("<object type='text/html' data='../Reportes/MedImagenes.php?id="+$("#imagenes123").val()+"'></object>");
				

						setTimeout(function()
						{
							//LoadSolicitudNow(codigo);
							$(".Resp2").html("");
							$(".Resp3").html("");
							$(".Resp4").html("");
							$(".Resp5").html("");
							$(".Resp6").html("");
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
						
		/*$( '#areaExamenes' ).dialog({
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
					
					$( '#areaExamenes' ).dialog( 'open' );*/
				$( ".modal-body" ).html("<object type='text/html' data='../Reportes/SolicitudExamenes.php?id="+$("#imagenes123").val()+"'></object>");
						$('.Resp2').html('');				
						$('.Resp3').html('');
						$('.Resp4').html('');
						$('.Resp5').html('');
						$('.Resp6').html('');
						
						
						
						
						//LoadSolicitudNow(codigo);
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
	/*$( "#Exames3" ).attr("title","Exámenes");
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
		
		$( "#Exames3" ).dialog( "open" );*/
		$(".Resp2").html("");
		$(".Resp3").html("");
		$(".Resp4").html("");
		$(".Resp5").html("");
		$(".Resp6").html("");

		$( ".Resp2" ).html("<table class='table table-striped table-bordered table-condensed'><tr><td>Tipo de Exámenes: </td><td><select id='txtExamenes' onchange='modal3()'><option>---Elija una Opción---</option><option value='1'>Solicutud de Exámenes</option value='2'><option>Solicitud de Imagen</option></Select></td></tr></table><div id='Datoscie'></div>");
}
function ExamenFisico2()
{
	//$("#AreaAnanmesis").
	/*$("#ExamesFisicos2").attr("title","Examen Físico");
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
		
		$( "#ExamesFisicos2" ).dialog( "open" );*/
		$(".Resp2").html("");
		$(".Resp3").html("");
		$(".Resp4").html("");
		$(".Resp5").html("");
		$(".Resp6").html("");

		$( ".Resp2" ).html("<table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>Biotipo Constitucional</td> <td><select id='cbo_biotipo'> <option value=''>---Selecione---</option> <option>Atlético</option> <option>Pícnico</option> <option>Displásico</option> <option>Asténico</option> </select></td> </tr> <tr> <td>Actitud </td> <td><input type='text' id='txt_actitud' /></td></tr> <tr> <td>Estado Conciencia</td> <td><input type='text' id='txt_conciencia' /></td></tr> <tr> <td>Glasgow</td> <td><input type='text' id='txt_glas' style='width:60px;'/></td> </tr> <tr> <td>Temperatura</td> <td colspan='2'><input type='text' id='txt_tempe' /> &nbsp; &nbsp; °C</td> </tr> <tr> <td>Presión Arterial</td> <td colspan='2'><input type='text' id='txt_arterial' /> &nbsp; &nbsp; mmHg</td> </tr> <tr> <td>Frecuencia Cardiaca</td> <td colspan='2'><input type='text' id='txt_cardica' /> &nbsp; &nbsp; latido/minuto</td> </tr> <tr> <td>Frecuencia Respiratoria</td> <td colspan='2'><input type='text' id='txt_respiratoria' /> &nbsp; &nbsp; respiraciones/minuto</td> </tr> <tr> <td>Peso</td> <td colspan='2'><input type='text' id='txt_peso' /> &nbsp; &nbsp; kg</td> </tr> <tr> <td>Talla</td> <td colspan='2'><input type='text' id='txt_talla' onblur='masacorporal()' /> &nbsp; &nbsp; m</td> </tr> <tr> <td>IMC</td> <td colspan='2'><input type='text' id='txt_MCorp' readonly/> </td> </tr> <tr> <td>Perímeto Cefálico</td> <td colspan='2'><input type='text' id='txt_PCefalico' /> &nbsp; &nbsp; cm</td> </tr> <tr> <td>Perímetro Torácico</td> <td colspan='2'><input type='text' id='txt_PToracico' /> &nbsp; &nbsp; cm</td> </tr> <tr> <td>Perímetro Abdominal</td> <td colspan='2'><input type='text' id='txt_abdominal' /> &nbsp; &nbsp; cm</td> </tr> <tr> <td>Peso Ideal</td> <td colspan='2'><input type='text' id='txt_PesoIdeal' /> &nbsp; &nbsp; kg</td> </tr> <tr> <td>T.A. Acostado</td> <td colspan='2'><input type='text' id='txt_TAacostado' /> &nbsp; &nbsp; mmHg</td> </tr> <tr> <td>T.A. Sentado</td> <td colspan='2'><input type='text' id='txt_TAsentado' /> &nbsp; &nbsp; mmHg</td> </tr> <tr> <td>T.A. de Pie</td> <td colspan='2'><input type='text' id='txt_TApie' /> &nbsp; &nbsp; mmHg</td> </tr> <tr> <td>Siperficie Corporal</td> <td colspan='2'><input type='text' id='txt_Scorporal' /> &nbsp; &nbsp; m2</td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>Piel</td> <td><textarea cols='30' rows='2' id='txt_piel' ></textarea></td> </tr> <tr> <td colspan='2'><center>CABEZA</center></td> </tr> <tr><td>Fascies</td><td><textarea cols='30' rows='2' id='txt_facies' ></textarea></td></tr><tr><td>Ojos</td><td><textarea cols='30' rows='2' id='txt_ojos' ></textarea></td></tr><tr><td>Naríz</td><td><textarea cols='30' rows='2' id='txt_nariz' ></textarea></td></tr><tr><td>Boca</td><td><textarea cols='30' rows='2' id='txt_boca' ></textarea></td></tr><tr><td>Oidos</td><td><textarea cols='30' rows='2' id='txt_oidos' ></textarea></td></tr><tr><td>Faringe</td><td><textarea cols='30' rows='2' id='txt_faringe' ></textarea></td></tr> <tr><td colspan='2'><center>CUELLO</center></td></tr> <tr><td>Forma</td><td><textarea cols='30' rows='2' id='txt_Cforma' ></textarea></td></tr><tr><td>Movimientos</td><td><textarea cols='30' rows='2' id='txt_Cmovimiento' ></textarea></td></tr><tr><td>Piel</td><td><textarea cols='30' rows='2' id='txt_Cpiel' ></textarea></td></tr><tr><td>Partes Blandas</td><td><textarea cols='30' rows='2' id='txt_CParBlandas' ></textarea></td></tr><tr><td>Tiroides</td><td><textarea cols='30' rows='2' id='txt_CTiroides' ></textarea></td></tr><tr><td>Ganglios</td><td><textarea cols='30' rows='2' id='txt_Cganglios' ></textarea></td></tr> <tr> <td colspan='2'><center>TÓRAX</center></td> </tr> <tr><td>Mov. Respiratorios</td><td><textarea cols='30' rows='2' id='txt_TMovRespira' ></textarea></td></tr><tr><td>Piel</td><td><textarea cols='30' rows='2' id='txt_TPiel' ></textarea></td></tr><tr><td>Partes Blandas</td><td><textarea cols='30' rows='2' id='txt_TParBlandas' ></textarea></td></tr><tr><td>Mamas</td><td><textarea cols='30' rows='2' id='txt_Tmamas' ></textarea></td></tr><tr><td>Corazón</td><td><textarea cols='30' rows='2' id='txt_TCorazon' ></textarea></td></tr><tr><td>Pulmones</td><td><textarea cols='30' rows='2' id='txt_TPulmones' ></textarea></td></tr> <tr><td colspan='2'><center>ABDOMEN</center></td></tr> <tr><td>Piel</td><td><textarea cols='30' rows='2' id='txt_AbPiel' ></textarea></td></tr><tr><td>Forma, volumen y tamaño</td><td><textarea cols='30' rows='2' id='txt_AbFVT' ></textarea></td></tr><tr><td>Partes Blandas</td><td><textarea cols='30' rows='2' id='txt_AbParBlandas' ></textarea></td></tr></table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>Aparato Urinario</td> <td><textarea cols='30' rows='2' id='txt_urinario' ></textarea></td> </tr> <tr> <td>Aparato Digestivo</td> <td><textarea cols='30' rows='2' id='txt_digestivo' ></textarea></td> </tr> <tr> <td>Aparato Genital Masculino</td> <td><textarea cols='30' rows='2' id='txt_masculino' ></textarea></td> </tr> <tr> <td>Aparato Genital Femenino</td> <td><textarea cols='30' rows='2' id='txt_femenino' ></textarea></td> </tr> <tr> <td>Sistema Músculo Esquelético</td> <td><textarea cols='30' rows='2' id='txt_esqueletico' ></textarea></td> </tr> <tr> <td>Sistema Nervioso</td> <td><textarea cols='30' rows='2' id='txt_nervioso' ></textarea></td> </tr> <tr><td colspan='3'><center><input type='button' id='btn_imprimurEF' class='btn btn-success' value='Guardar' onclick='SaveExamenfisico()'/> </center></td></tr> </table>");
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
				$(".Resp1").html(res);
			},
			error:function()
			{
				$(".Resp1").html("error al cargar");
			}
		});
}

function VerCitas()
{
	/*	$("#NewCitas").attr("title","Citas de hoy");	
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
		
		$( "#NewCitas" ).dialog( "open" );*/
		Home();
			$.ajax({
				url:'Procesar.php?accion=VerCitasAllHoy',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp1").html(res);
				},
				error:function()
				{
					$(".Resp1").html("error al cargar");
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

	/*	$( "#SearchPaciente" ).attr("title","BUSCAR PACIENTE");
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
		$( "#SearchPaciente" ).dialog( "open" );*/
		$(".Resp1").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span6' id='txtBuscar'  onkeydown='BuscarPaciente();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a> </div> </center> </td></table>");
		
		$("#txtCodHora").val(codigo);

		
	

}
function BuscarPaciente()
{

	if($("#txtBuscar").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPacientev2&buscar='+$("#txtBuscar").val()+'&por='+$("#SearchFor").val()+'&CodigoRol='+2,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
			
	}
}
function AsignarPaciente(codigo)
{
	ComprobarFecha(codigo);
		$.ajax({
			url:'Procesar.php?accion=AgendarHoy&HoraHoy='+$("#txtCodHora").val()+'&Paciente='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
				setTimeout(function(){ReloadCitas(),CargarConsultasDeHoyXDoctor()},1000);
				setTimeout(function()
				{
					$(".Resp2").html("");
				},3000);
				
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
		
	
}
function ReservarEmergencia(codigo)
{
		/*$( "#SearchPaciente" ).dialog({
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
		$( "#SearchPaciente" ).dialog( "open" );*/
		$(".Resp1").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span12' id='txtBuscar'  onkeydown='BuscarPaciente();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a> </div> </center> </td></table>");
		
		$("#txtCodHora").val(codigo);
	
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
{		/*		
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
		$( "#SearchPaciente" ).dialog( "open" );*/
		Home();
		$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span6' id='txtBuscar'  onkeydown='BuscarPacienteAgendar();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a> </div> </center> </td></table>");	
		
}
function BuscarPacienteAgendar()
{
	if($("#txtBuscar").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPacientev2&buscar='+$("#txtBuscar").val()+'&por='+$("#SearchFor").val()+'&CodigoRol='+4,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp1").html(res);
			},
			error:function()
			{
				$(".Resp1").html("error al cargar");
			}
		});
			
	}
}

function AgendarPacienteXDoctor(codigo)
{
	$(".Resp2").html("<div class='table-responsive'><table class='table table-bordered table-striped table-condensend'><tr><th><center>Buscar Fecha: <input type='date' id='txtFechaAgendDoct'/> <input type='button' class='btn btn-success' id='bntOk321' value='Agendar' /></center></th></tr></table></div>");
	/*$("#bntOk321").button();
	$('#txtFechaAgendDoct').datepicker({
				changeMonth: true,
				changeYear: true
			});
	$('#txtFechaAgendDoct').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );*/
	
	ComprobarFecha(codigo);
	
	$("#bntOk321").click(function()
	{
		if($('#txtFechaAgendDoct').val()!="")
		{
			
			//guarado los codigo de pacienete y la fecha en la que reserva
	
	$("#txtCodigoPacente147").val(codigo);
	$("#txtfechaReseva147").val(""+$('#txtFechaAgendDoct').val()+"");
	
	//ajax 
			
			$.ajax({
				url:'Procesar.php?accion=HorarioConsutaDoc&FechaPoxima='+$('#txtFechaAgendDoct').val()+'&CodigoForma='+2,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp3").html(res);
				},
				error:function()
				{
					$(".Resp3").html("error al cargar");
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
					$(".Resp3").html("");
					$(".Resp2").html(res);
					setTimeout(function(){CargarConsultasDeHoyXDoctor();},1000);
				setTimeout(function()
				{
					$(".Resp3").html("");
					$(".Resp3").html("");
					$(".Resp2").html("");
					//$("#RespuestaFecha").html("");
					//$( "#SearchPaciente" ).dialog( "close" );
				},4000);
				},
				error:function()
				{
					$(".Resp2").html("error al cargar");
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
					$(".Resp6").html(res);
				},
				error:function()
				{
					$(".Resp6").html("error al cargar");
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
						$(".Resp2").html(res);
						//LoadExamenNow($("#CajaOcultaFenixTurno").val());
						/*setInterval(function()
						{
							$( "#ExamesFisicos2" ).dialog( "close" );
							
							
						},10000);*/
					},
					error:function()
					{
						$(".Resp2").html("Error al cargar la inf");
					}
						});
}

function datosvademecun()
{
	/*$("#AreaVademecun").attr("title","Vademecun");
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
		$("#AreaVademecun").dialog( "open");*/
		
	$.ajax({
				url:'Procesar.php?accion=VademecunCargar',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
				}
			});
		
}

function CodigoVademecum(codigo)
{
	$.ajax({
				url:'Procesar.php?accion=recetarvademecun&codvade='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					var ant=$("#txtPlanesdte").val();
					var con=ant+"  \n"+res;
				$("#txtPlanesdte").attr("value",""+con+"");
				//$("#AreaVademecun").dialog( "close");
				},
				error:function()
				{
					//$("#AreaVademecun").html("error al cargar");
				}
		});
				
				
}
//funcion para ver el nuevo diagnostico 
/*
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
}*/
function HistorialPacienteNew(codigo)
{
	/*$("#HistorialPaciente").attr("title","Historial Del Paciente");
	$( "#HistorialPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:600,
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
		$( "#HistorialPaciente" ).dialog( "open" );	*/
	$.ajax({
				url:'Procesar.php?accion=HistoriTotalPdf&CdPacToPDF='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
				},
				error:function()
				{
					$(".Resp2").html("Errror Alcargar");
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
						setTimeout(function(){
							CargarConsultasDeHoyXDoctor();
							$("#txtCodHora").val("");
							$("#txtCodigoPacente147").val("");
							$("#txtfechaReseva147").val("");
							$("#imagenes123").val("");
							$("#codigoTurno123").val("");
							$("#CajaOcultaFenixTurno").val("");
							$("#codigoPaciente").val("");
							$("#codigoescondidoanam123").val("");
							$("#txtmd").val("");
						},2000);			
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
	/*$("#ResSearchAgenda").html("");
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
		$( "#AgendaDoctor" ).dialog( "open" );*/	
		Home();
		$(".Cabe1").html("<table class='table table-bordered table-striped table-condensed'><tr><th>Fecha de las Consultas</th><td><input type='text' id='txtFechaAgenda'></td><td><input type='button' id='btnBuscaAge' value='Buscar' class='btn btn-success'/></td></tr><table>");
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
									$(".Resp1").html(res);
							},
							error:function()
							{
								$(".Resp1").html("Errror Alcargar");
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


function Epicrisis(){
	/*$( "#Areaepicrisi" ).attr("title","Epicrisis");
	$( "#Areaepicrisi" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:1200,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});

$( "#Areaepicrisi" ).dialog( "open" );	*/

$(".Resp2").html("");
$(".Resp3").html("");
$(".Resp4").html("");
$(".Resp5").html("");
$(".Resp6").html("");
	$.ajax({
				url:'Procesar.php?accion=VerEpicris&CodTurEpi='+$("#CajaOcultaFenixTurno").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
						$(".Resp2").html(res);
				},
				error:function()
				{
					$(".Resp2").html("Errror Alcargar");
				}
		});

}

// funciones para Epicrisis
function ObjetoEpicrisis(user,tur,unidaop,parroqu,canton,provincia,fecha,hora,empresa,seguro,rdcc,rdeyc,hrdeyp,rdtypt,cdeyp,altd,alttr,asin,disleve,dismod,disgra,retirovo,retiinvo,defant,defdes,diases,diasin,medicos,medico,codigo,txti1,txtic1,txtipr1,txtid1,txti2,txtic2,txtipr2,txtid2,txti3,txtic3,txtipr3,txtid3,txti4,txtic4,txtipr4,txtid4,txti5,txtic5,txtipr5,txtid5,txte1,txtec1,txtepr1,txtede1,txte2,txtec2,txtepr2,txtede2,txte3,txtec3,txtepr3,txtede3,txte4,txtec4,txtepr4,txtede4,txte5,txtec5,txtepr5,txtede5){
	this.user=user;
	this.tur=tur;
	this.unidaop=unidaop;
	this.parroqu=parroqu;
	this.canton=canton;
	this.provincia=provincia;
	this.fecha=fecha;
	this.hora=hora;
	this.empresa=empresa;
	this.seguro=seguro;
	this.rdcc=rdcc;
	this.rdeyc=rdeyc;
	this.hrdeyp=hrdeyp;
	this.rdtypt=rdtypt;
	this.cdeyp=cdeyp;
	this.altd=altd;
	this.alttr=alttr;
	this.asin=asin;
	this.disleve=disleve;
	this.dismod=dismod;
	this.disgra=disgra;
	this.retirovo=retirovo;
	this.retiinvo=retiinvo;
	this.defant=defant;
	this.defdes=defdes;
	this.diases=diases;
	this.diasin=diasin;
	this.medicos=medicos;
	this.medico=medico;
	this.codigo=codigo;
	this.txti1=txti1;
	this.txtic1=txtic1;
	this.txtipr1=txtipr1;
	this.txtid1=txtid1;
	this.txti2=txti2;
	this.txtic2=txtic2;
	this.txtipr2=txtipr2;
	this.txtid2=txtid2;
	this.txti3=txti3;
	this.txtic3=txtic3;
	this.txtipr3=txtipr3;
	this.txtid3=txtid3;
	this.txti4=txti4;
	this.txtic4=txtic4;
	this.txtipr4=txtipr4;
	this.txtid4=txtid4;
	this.txti5=txti5;
	this.txtic5=txtic5;
	this.txtipr5=txtipr5;
	this.txtid5=txtid5;
	this.txte1=txte1;
	this.txtec1=txtec1;
	this.txtepr1=txtepr1;
	this.txtede1=txtede1;
	this.txte2=txte2;
	this.txtec2=txtec2;
	this.txtepr2=txtepr2;
	this.txtede2=txtede2;
	this.txte3=txte3;
	this.txtec3=txtec3;
	this.txtepr3=txtepr3;
	this.txtede3=txtede3;
	this.txte4=txte4;
	this.txtec4=txtec4;
	this.txtepr4=txtepr4;
	this.txtede4=txtede4;
	this.txte5=txte5;
	this.txtec5=txtec5;
	this.txtepr5=txtepr5;
	this.txtede5=txtede5;

}
function SaveEpicrisis(){
	
	var epic=new ObjetoEpicrisis($("#codigoPaciente").val(),$("#CajaOcultaFenixTurno").val(),$("#txtunidad").val(),$("#txtparro").val(),$("#txtcant").val(),$("#txtpro").val(),$("#txtfechaepi").val(),$("#txthoraepi").val(),$("#txtempepi").val(),$("#txtseguroepi").val(),$("#txtrescuadepi").val(),$("#txtreevolepi").val(),$("#txthallaepi").val(),$("#txtrestraterepi").val(),$("#txtcondiciegepi").val(),$("#txtaldef").val(),$("#txtaltr").val(),$("#txtasitom").val(),$("#txtdisleve").val(),$("#txtdismo").val(),$("#txtdisgra").val(),$("#txtrevo").val(),$("#txtreinv").val(),$("#txtdefat48").val(),$("#txtdefdes48").val(),$("#txtdest").val(),$("#txtdiasinc").val(),$("#txtmedicossFin").val(),$("#txtMediFin").val(),$("#txtcodigofin").val(),$("#txti1").val(),$("#txtic1").val(),$("#txtipr1").val(),$("#txtid1").val(),$("#txti2").val(),$("#txtic2").val(),$("#txtipr2").val(),$("#txtid2").val(),$("#txti3").val(),$("#txtic3").val(),$("#txtipr3").val(),$("#txtid3").val(),$("#txti4").val(),$("#txtic4").val(),$("#txtipr4").val(),$("#txtid4").val(),$("#txti5").val(),$("#txtic5").val(),$("#txtipr5").val(),$("#txtid5").val(),$("#txte1").val(),$("#txtec1").val(),$("#txtepr1").val(),$("#txtede1").val(),$("#txte2").val(),$("#txtec2").val(),$("#txtepr2").val(),$("#txtede2").val(),$("#txte3").val(),$("#txtec3").val(),$("#txtepr3").val(),$("#txtede3").val(),$("#txte4").val(),$("#txtec4").val(),$("#txtepr4").val(),$("#txtede4").val(),$("#txte5").val(),$("#txtec5").val(),$("#txtepr5").val(),$("#txtede5").val());
	var epicrisis=[];
	epicrisis.push(epic);
	var epicrisisJson=JSON.stringify(epicrisis);

	$.ajax({
				url:'Procesar.php?accion=SaveEpicrisP&ObjEpic='+epicrisisJson,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
				},
				error:function()
				{
					$(".Resp2").html("error al cargar");
				}
			});	
	
}









function verCieInEgreso(){
	
		$("#BuscadorCie").html("<table class='table table-striped table-condensed table-hover table-bordered'><tr><td>Buscar: </td><td><input type='text' id='txtBuscadorCieEpi' onkeyup='BuscarcieEpi(1)'/></td></tr></table>");
		$("#CieEpicris").attr("title","Diagnostico Cie");
		$("#CieEpicris").dialog({
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
		$("#CieEpicris").dialog( "open");
	$.ajax({
				url:'Procesar.php?accion=VademecunCargar1&caja=1',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#AreaCie").html(res);
				},
				error:function()
				{
					$("#AreaCie").html("error al cargar");
				}
			});

}
function vercieEgreso(){
		//$("#CieEpicris").html("");
		$("#BuscadorCie").html("<table class='table table-striped table-condensed table-hover table-bordered'><tr><td>Buscar: </td><td><input type='text' id='txtBuscadorCieEpi' onkeyup='BuscarcieEpi(2)'/></td></tr></table>");
		$("#CieEpicris").attr("title","Diagnostico Cie");
		$("#CieEpicris").dialog({
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
		$("#CieEpicris").dialog( "open");
	$.ajax({
				url:'Procesar.php?accion=VademecunCargar1&caja=2',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#AreaCie").html(res);
				},
				error:function()
				{
					$("#AreaCie").html("error al cargar");
				}
			});		
}

function CieLoad(cie, caja){
	
	$.ajax({
				url:'Procesar.php?accion=LoadCieEpi&cie='+cie+'&textbox='+caja,
				type:'GET',
				cache:false,
				success:function(res)
				{
					
					var lista = JSON.parse(res);
					switch(lista[0]){
						case "1":
							$("#txti1").val(lista[1]);
							$("#txtic1").val(lista[2]);
						break;
						case "2":
							$("#txti2").val(lista[1]);
							$("#txtic2").val(lista[2]);
						break;
						case "3":
							$("#txtCie1").val(lista[1]);
							$("#txtCod1").val(lista[2]);
						break;
						case "4":
							$("#txtCie2").val(lista[1]);
							$("#txtCod2").val(lista[2]);
						break;
						case "5":
							$("#txtCie3").val(lista[1]);
							$("#txtCod3").val(lista[2]);
						break;
						case "6":
							$("#txtCie4").val(lista[1]);
							$("#txtCod4").val(lista[2]);
						break;
						case "7":
							$("#txtCie5").val(lista[1]);
							$("#txtCod5").val(lista[2]);
						break;
						case "8":
							$("#txti3").val(lista[1]);
							$("#txtic3").val(lista[2]);
						break;
						case "9":
							$("#txti4").val(lista[1]);
							$("#txtic4").val(lista[2]);
						break;
						case "10":
							$("#txti5").val(lista[1]);
							$("#txtic5").val(lista[2]);
						break;
						case "11":
							$("#txte1").val(lista[1]);
							$("#txtec1").val(lista[2]);
						break;
						case "12":
							$("#txte2").val(lista[1]);
							$("#txtec2").val(lista[2]);
						break;
						case "13":
							$("#txte3").val(lista[1]);
							$("#txtec3").val(lista[2]);
						break;
						case "14":
							$("#txte4").val(lista[1]);
							$("#txtec4").val(lista[2]);
						break;
						case "15":
							$("#txte5").val(lista[1]);
							$("#txtec5").val(lista[2]);
						break;
						case "16":
							$("#txtCie1Info").val(lista[1]);
							$("#txtCod1Info").val(lista[2]);
						break;
						case "17":
							$("#txtCie2Info").val(lista[1]);
							$("#txtCod2Info").val(lista[2]);
						break;
						case "18":
							$("#txtCie3Info").val(lista[1]);
							$("#txtCod3Info").val(lista[2]);
						break;
						case "19":
							$("#txtCie4Info").val(lista[1]);
							$("#txtCod4Info").val(lista[2]);
						break;
						case "20":
							$("#txtCie5Info").val(lista[1]);
							$("#txtCod5Info").val(lista[2]);
						break;
						case "21":
							$("#txtCie6Info").val(lista[1]);
							$("#txtCod6Info").val(lista[2]);
						break;
						case "22":
							$("#txtCie1In").val(lista[1]);
							$("#txtCod1In").val(lista[2]);
						break;
						case "23":
							$("#txtCie2In").val(lista[1]);
							$("#txtCod2In").val(lista[2]);
						break;
						case "24":
							$("#txtCie3In").val(lista[1]);
							$("#txtCod3In").val(lista[2]);
						break;
						case "25":
							$("#txtCie4In").val(lista[1]);
							$("#txtCod4In").val(lista[2]);
						break;
						case "26":
							$("#txtCie5In").val(lista[1]);
							$("#txtCod5In").val(lista[2]);
						break;
						case "27":
							$("#txtCie6In").val(lista[1]);
							$("#txtCod6In").val(lista[2]);
						break;
					}
					
				},
				error:function()
				{
					$(".Cuerpo").html("error al cargar");
				}
			});
}

function BuscarcieEpi(codigo){
 
	$.ajax({
				url:'Procesar.php?accion=CieCargar1&caja='+codigo+"&BuscarPor="+$("#txtBuscadorCieEpi").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Cuerpo").html(res);
				},
				error:function()
				{
					$(".Cuerpo").html("error al cargar");
				}
			});
}

function LoadDiagnosticosEpicrisis(){

$.ajax({
				url:'Procesar.php?accion=LoadDiagnosticosEpicrisis&IdDiaEpicri='+$("#codigoPaciente").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#FilaCieEpicris").html(res);
				},
				error:function()
				{
					$("#FilaCieEpicris").html("error al cargar");
				}
			});
}


function ObjectCieEpi(id_pac,descripcion_ciepi,codigo_ciepi,pre_ciepi,def_ciepi,pos_ciepi){
	this.id_pac=id_pac;
	this.descripcion_ciepi=descripcion_ciepi;
	this.codigo_ciepi=codigo_ciepi;
	this.pre_ciepi=pre_ciepi;
	this.def_ciepi=def_ciepi;
	this.pos_ciepi=pos_ciepi;
}

function SaveCieIngres(){

	
	var obj=new ObjectCieEpi($("#codigoPaciente").val(),$("#txtcieingr").val(),$("#txtcodcieingr").val(),$("#txtingpre").val(),$("#txtingdef").val(),"I");
	var ciepi=[];
	ciepi.push(obj);
	var ciepiJson=JSON.stringify(ciepi);

		$.ajax({
				url:'Procesar.php?accion=SaveCiePi&CieEpicris='+ciepiJson,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#FilaCieEpicris").html(res);
				},
				error:function()
				{
					$("#FilaCieEpicris").html("error al cargar");
				}
			});

		LoadDiagnosticosEpicrisis();

}
	


function SaveCieEgreso(){
	var obj=new ObjectCieEpi($("#codigoPaciente").val(),$("#txtegrecie").val(),$("#txtcieegre").val(),$("#txtpreegre").val(),$("#txtdefegre").val(),"E");
	var ciepi=[];
	ciepi.push(obj);
	var ciepiJson=JSON.stringify(ciepi);

		$.ajax({
				url:'Procesar.php?accion=SaveCiePi&CieEpicris='+ciepiJson,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#FilaCieEpicris").html(res);
				},
				error:function()
				{
					$("#FilaCieEpicris").html("error al cargar");
				}
			});

		LoadDiagnosticosEpicrisis();
}

function JavaimpEpic(codigo){
		/*$("#ImpEpicrisis").attr("title","Diagnostico Cie");
		$("#ImpEpicrisis").dialog({
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
		$("#ImpEpicrisis").dialog( "open");	*/
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/EpicrisisImp.php?Id="+$("#codigoPaciente").val()+"'></object>");	
}

function EndEpicris(codigo){
	if ($("#txtMediFin").val()!="") {
	$.ajax({
				url:'Procesar.php?accion=EndEpicrisis&CodEpicri='+codigo+'&MedicoEpi='+$("#txtMediFin").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
				},
				error:function()
				{
					$(".Resp2").html("error al cargar");
				}
			});
	}
	else{
		alert("Porvafor llene el campo de medico para finalizar la epicrisis");
	}		
}
function AddNewEpicrisis(){
$.ajax({
				url:'Procesar.php?accion=AddNewEpicrisisi&IdPaciente='+$("#codigoPaciente").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
				},
				error:function()
				{
					$(".Resp2").html("error al cargar");
				}
			});	
}
function BuscarHistoriaPacienteEpicrisis()
{
	/*$( "#HistoriaEmpicrisi" ).attr("Title","Buscar Historial Epicrisis");
	$( "#HistoriaEmpicrisi" ).dialog({
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

		$( "#HistoriaEmpicrisi" ).dialog( "open" );	*/	
		Home();
		$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span6' id='txtBuscar09'  onkeydown='BuscarPacientePAraVerEpicrisis();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a> </div> </center> </td></table>");
		
		
	/*	$("#bntBuscaCedulaPac").click(function()
		{
			$( "#RespuesraHistoria" ).html("<object type='text/html' data='../Reportes/HistoriaCli.php?id="+$("#txtBuscarCedula").val()+"'></object>");					
		});*/
}
function BuscarPacientePAraVerEpicrisis()
{
	if($("#txtBuscar09").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPacientev2&buscar='+$("#txtBuscar09").val()+'&por='+$("#SearchFor09").val()+'&CodigoRol='+6,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#ResBusEpicrisi").html(res);
			},
			error:function()
			{
				$("#ResBusEpicrisi").html("error al cargar");
			}
		});
			
	}else{
		$("#RespuesraHistoria").html("");
	}
}
function HistorialPacienteNewEpicrisis(codigo){
	$( "#LoadHisEpicris" ).attr("Title","Buscar Historial Epicrisis");
	$( "#LoadHisEpicris" ).dialog({
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

		$( "#LoadHisEpicris" ).dialog( "open" );		
$.ajax({
			url:'Procesar.php?accion=Hisepcrisis&IdPacienteEp='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#LoadHisEpicris").html(res);
			},
			error:function()
			{
				$("#LoadHisEpicris").html("error al cargar");
			}
		});
}
function ImpEpicrisis2(idepi,idpaci){
$("#ImpEpicrisis").attr("title","Empicrisis");
		$("#ImpEpicrisis").dialog({
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
		$("#ImpEpicrisis").dialog( "open");	
		$( "#ImpEpicrisis" ).html("<object type='text/html' data='../Reportes/EpicrisisImp2.php?Paci="+idpaci+"&Epi="+idepi+"'></object>");	
}

function verDiagnostico(codigo){
	/*
	$("#CieAnamnesisCdu").attr("title","Diagnostico Cie");
		$("#CieAnamnesisCdu").dialog({
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
		$("#CieAnamnesisCdu").dialog( "open");*/

		$(".modal-body").html("<div class='Cabecera'></div><div class='Cuerpo'></div>");
		$(".Cabecera").html("<table class='table table-striped table-condensed table-hover table-bordered'><tr><td>Buscar: </td><td><input type='text' id='txtBuscadorCieEpi' onkeyup='BuscarcieEpi("+codigo+")'/></td></tr></table>");
		
	/*$.ajax({
				url:'Procesar.php?accion=VademecunCargar1&caja='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#AreaListCie").html(res);
				},
				error:function()
				{
					$("#AreaListCie").html("error al cargar");
				}
			});*/

}

function DeleteDiag(codigo){
	switch(codigo){
		case 1:
			$("#txti1").val("");
			$("#txtic1").val("");
			$("#txtipr1").val("");
			$("#txtid1").val("");
		break;
		case 2:
			$("#txti2").val("");
			$("#txtic2").val("");
			$("#txtipr2").val("");
			$("#txtid2").val("");
		break;
		case 3:
			$("#").val();
			$("#").val();
			$("#").val();
			$("#").val();
		break;
		case 4:
			$("#").val();
			$("#").val();
			$("#").val();
			$("#").val();
		break;
		case 5:
			$("#").val();
			$("#").val();
			$("#").val();
			$("#").val();
		break;
		case 6:
			$("#").val();
			$("#").val();
			$("#").val();
			$("#").val();
		break;
		case 7:
			$("#").val();
			$("#").val();
			$("#").val();
			$("#").val();
		break;
		case 8:
			$("#txti3").val("");
			$("#txtic3").val("");
			$("#txtipr3").val("");
			$("#txtid3").val("");
		break;
		case 9:
			$("#txti4").val("");
			$("#txtic4").val("");
			$("#txtipr4").val("");
			$("#txtid4").val("");
		break;
		case 10:
			$("#txti5").val("");
			$("#txtic5").val("");
			$("#txtipr5").val("");
			$("#txtid5").val("");
		break;
		case 11:
			$("#txte1").val("");
			$("#txtec1").val("");
			$("#txtepr1").val("");
			$("#txtede1").val("");
		break;
		case 12:
			$("#txte2").val("");
			$("#txtec2").val("");
			$("#txtepr2").val("");
			$("#txtede2").val("");
		break;
		case 13:
			$("#txte3").val("");
			$("#txtec3").val("");
			$("#txtepr3").val("");
			$("#txtede3").val("");
		break;
		case 14:
			$("#txte4").val("");
			$("#txtec4").val("");
			$("#txtepr4").val("");
			$("#txtede4").val("");
		break;
		case 15:
			$("#txte5").val("");
			$("#txtec5").val("");
			$("#txtepr5").val("");
			$("#txtede5").val("");
		break;
	}
}

function NewEmergencia(){
/*$("#ImpEpicrisis").attr("title","Registro Emergencia");
		$("#ImpEpicrisis").dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:1350,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$("#ImpEpicrisis").dialog( "open");*/
		Home();
		$(".Resp1").html("<table class='table table-bordered table-striped table-hover table-condensed '  align='center'> <tr> <td>INSTITUCION DEL SISTEMA</td> <td>UNIDAD OPERATIVA</td> <td>LOCALIZACION</td> <td>N HISTORIA CLINICA</td> </tr> <tr> <td><input type='text' id='txtintsis' class='medio' /></td> <td>Clinica de Urulogia</td> <td> <table> <tr> <td>PARROQUIA</td> <td>CANTON</td> <td>PROVINCIA</td> </tr> <tr> <td><input type='text' id='txtpar' class='medio'/></td> <td><input type='text' id='txtcan' class='medio'/></td> <td><input type='text' id='txtpro' class='medio'></td> </tr> </table> </td> <td><input type='text' id='txthist' class='medio'/></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '  align='center'> <tr> <td colspan='4'>1 REGISTRO DE ADMISION</td> </tr> <tr> <td>APELLIDOS</td> <td>NOMBRES</td> <td>NACIONALIDAD</td> <td>N CEDULA DE CIUDADANIA</td> </tr> <tr> <td><input type='text' id='txtape'  class='medio'></td> <td><input type='text' id='txtnom'  class='medio'></td> <td><input type='text' id='txtnaci'  class='medio'></td> <td><input type='text' id='txtcedu'  class='medio'></td> </tr> <tr> <td>DIRECCION DE RESIDENCIA HABITUAL</td> <td>CANTON</td> <td>PROVINCIA</td> <td>N TELEFONO</td> </tr> <tr> <td><input type='text' id='txtdirres' class='medio'></td> <td><input type='text' id='txtcan1' class='medio'></td> <td><input type='text' id='txttxtpro1' class='medio'></td> <td><input type='text' id='txtcedu1' class='medio'></td> </tr> <tr> <td> <table> <tr> <td>FECHA DE ATENCION</td> <td>HORA</td> <td>FECHA DE NACIMIETO</td> </tr> <tr> <td><input type='text' id='txtfecate' class='medio'/></td> <td><input type='text' id='txthora' class='medio'/></td> <td><input type='text' id='txtfechNac' class='medio'/></td> </tr> </table> </td> <td> <table> <tr> <td>SEXO</td> <td>ESTADO CIVIL</td> <td>INSTRUCCION</td> </tr> <tr> <td><select id='cmbsex' class='medio'><option>MASCULINO</option><option>FEMENINO</option></select></select></td> <td><select id='cmbestad' class='medio'><option>SOLTER@</option><option>CASAD@</option><option>DIVORSIAD@</option><option>VIOD@</option><option>UNION LIBRE</option></select></td> <td><select id='cmbinstr' class='medio'><option>SIN INSTRUCCION</option><option>BASICA</option><option>BACHILLER</option><option>SUPERIOR</option><option>ESPECIAL</option></select></td> </tr> </table> </td> <td> <table> <tr> <td>OCUPACION</td> </tr> <tr> <td><input type='text' id='txtocupa'/></td> </tr> </table> </td> <td> <table> <tr> <td colspan='4'>N DE SEGURO DE SALUD</td> </tr> <tr> <td>IESS</td> <td><input type='text' id='txtiess' class='t1'></td> <td>OTROS</td> <td><input type='text' id='txtotros' class='t1'></td> </tr> </table> </td> </tr> <tr> <td>NOMBRE DE LA PERSONA PARA NOTIFICACION</td> <td>PARENTESCO O AFINIDAD</td> <td>DIRECCION</td> <td>TELEFONO</td> </tr> <tr> <td><input type='text' id='txtnompern' class='medio' /></td> <td><input type='text' id='txtpare' class='medio' /></td> <td><input type='text' id='txtdire' class='medio' /></td> <td><input type='text' id='txttele' class='medio' /></td> </tr> <tr> <td>NOMBRE DEL ACOMPAÑANTE</td> <td>N CEDULA DE IDENTIFICACION</td> <td>DIRECCION</td> <td>N TELEFONO</td> </tr> <tr> <td><input type='text' id='txtnomdeac' class='medio'></td> <td><input type='text' id='txtceduac' class='medio'></td> <td><input type='text' id='txtdireac' class='medio'></td> <td><input type='text' id='txtteleac' class='medio'></td> </tr> <tr> <td>FORMA DE LLEGADA</td> <td>FUENTE DE IMFORMACION</td> <td>INSTITUCION O PERSONA QUE ENTREGA A EL PACIENTE</td> <td>N TELEFONO</td> </tr> <tr> <td> <table> <tr> <td>AMBULATORIO</td> <td><input type='text' id='txtambu' class='t1'></td> <td>SILLA DE RUEDAS</td> <td><input type='text' id='txtsilla' class='t1'></td> <td>CAMILLA</td> <td><input type='text' id='txtcami' class='t1'></td> </tr> </table> </td> <td><input type='text' id='txtfueninfo' class='medio'></td> <td><input type='text' id='txtinstoper' class='medio'></td> <td><input type='text' id='txtteleinstop' class='medio'></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '  align='center'> <tr> <td colspan='15'>2 INICIO DE ATENCION</td> </tr> <tr> <td>HORA</td> <td><input type='text' id='txthora' class='t1'></td> <td>VIA AEREA LIBRE</td> <td><input type='text' id='txtviaeli' class='t1'></td> <td>VIA AEREA OBSTRUIDA</td> <td><input type='text' id='txtviaob' class='t1'></td> <td>GRUPO - Rh</td> <td><input type='text' id='txtgrurh' class='t1'></td> <td>CONDICIONES DE LLEGADA</td> <td>ESTABLE</td> <td><input type='text'  id='txtest' class='t1'></td> <td>INESTABLE</td> <td><input type='text' id='txtinest' class='t1'></td> <td>OTROS</td> <td><input type='text' id='txtotorcond' class='t1'></td> </tr> <tr> <td>MOTIVO DE LLEGADA</td> <td colspan='14'><input type='text' id='txtmolle' class='CajaArea'></td> </tr> </table> <table  class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='3'>3 ACCIDENTE, VIOLENCIA, INTOXICACION</td> <td>NO APLICA</td> <td><input type='text' id='txtnoapl' class='t1'></td> </tr> <tr> <td>LUGAR DEL EVENTO</td> <td>DIRECCION DEL EVENTO</td> <td>FECHA</td> <td>HORA</td> <td>VEHICULO O ARMA</td> </tr> <tr> <td><input type='text' id='txtlugeven' class='medio' ></td> <td><input type='text' id='txtdireven' class='medio' ></td> <td><input type='text' id='txtfechven' class='medio' ></td> <td><input type='text' id='txthoraven' class='medio' ></td> <td><input type='text' id='txtvehiven' class='medio' ></td> </tr> <tr> <td colspan='3'>TIPO DE EVENTO</td> <td colspan='2'>AUTORIDAD COMPETENTE</td> </tr> <tr> <td colspan='3'> <table> <tr> <td>ACCIDENTE</td> <td><input type='text' id='txttpacc' class='t1'></td> <td>ENVENENAMIENTO</td> <td><input type='text' id='txttpenven' class='t1'></td> <td>VIOLENCIA</td> <td><input type='text' id='txttpviole' class='t1'></td> <td>OTROS</td> <td><input type='text' id='txttpotros' class='t1'></td> </tr> </table> </td> <td colspan='2'> <table> <tr> <td><input type='text' id='txtautocomp' class='medio'></td> <td>HORA DENUNCIA</td> <td><input type='text' id='txthorden' class='t1'></td> <td>CUSTODIA POLICIAL</td> <td><input type='text' id='txtcuspoli' class='t1'></td> </tr> </table> </td> </tr> <tr> <td>OBSERVACIONES</td> <td colspan='4'><input type='text' id='txtobseripev' class='CajaArea2'></td> </tr> <tr> <td colspan='3'>INTOXICACION</td> <td colspan='2'>VIOLENCIA</td> </tr> <tr> <td colspan='3'> <table> <tr> <td>ALIENTO ETILICO</td> <td><input type='text' id='txtalietili' class='t1'></td> <td>VALOR ALCOCHECK</td> <td><input type='text' id='txtvalalco' class='t1'></td> <td>HORA EXAMEN</td> <td><input type='text' id='txthoraintosexa' class='t1'></td> <td>SE HACE ALCOHOLEMIA</td> <td><input type='text' id='txtsehahalcoho' class='t1'></td> <td>OTRAS SUSTANCIA</td> <td><input type='text' id='txtotrsusintox' class='t1'></td> </tr> </table> </td> <td colspan='2'> <table> <tr> <td>SOSPECHA</td> <td><input type='text' id='txtsospeviol' class='t1'></td> <td>ABUSO FISICO</td> <td><input type='text' id='txtabusfisivi' class='t1'></td> <td>ABUSO PSICOLOGICO</td> <td><input type='text' id='txtabspsicolviol' class='t1'></td> <td>ABUSO SEXUAL</td> <td><input type='text' id='txtabussexviol' class='t1'></td> </tr> </table> </td> </tr> <tr> <td>OBSERVACIONES</td> <td colspan='4'><input type='text' id='txtobserintviol' class='CajaArea2'></td> </tr> <tr> <td colspan='3'>QUEMADURA</td> <td>PICADURA</td> <td>MORDEDURA</td> </tr> <tr> <td colspan='3'> <table> <tr> <td>GRADO I</td> <td><input type='text' id='txtgri' class='t1'></td> <td>GRADO II</td> <td><input type='text' id='txtgrii' class='t1'></td> <td>GRADO III</td> <td><input type='text' id='txtgriii' class='t1'></td> <td>PORCENTAJE SUPERFICIE</td> <td><input type='text' id='txtporsupeque' class='t1'></td> </tr> </table> </td> <td><input type='text' id='txtpicadur' class='medio'></td> <td><input type='text' id='txtmordedur' class='medio'></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='6'>4 ANTECEDENTES PERSONALES Y FAMILIARES RELEVANTES</td> <td colspan='5'><h7>PARA DESCRIBIR SEÑALE EL NUMERO Y LA LETRA CORRESPONDIENTE. P= PERSONAL, F= FAMILIAR</h7></td> <td colspan='5'>NO APLICA</td> <td><input type='text' id='txtantperyfaml' class='t1' ></td> </tr> <tr> <td>1. ALERGICOS</td> <td><input type='text' id='txtalergicos' class='t1'></td> <td>2 .CLINICOS</td> <td><input type='text' id='txtclinicos' class='t1'></td> <td>3. GINECOLOGICOS</td> <td><input type='text' id='txtginecolo' class='t1'></td> <td>4. TRAUMATOLOGICOS</td> <td><input type='text' id='txttraumatolo' class='t1'></td> <td>5. PEDIATRICOS</td> <td><input type='text' id='txtpediatric' class='t1'></td> <td>6. QUIRURGICOS</td> <td><input type='text' id='txtquirurgi' class='t1'></td> <td>7. FARMACOLOGICOS</td> <td><input type='text' id='txtfarmacolo' class='t1'></td> <td>8. OTROS</td> <td><input type='text' id='txtateperfamreotros' class='t1'></td> </tr> <tr> <td colspan='16'><textarea cols='100' rows='4' id='txt4antecedentes' class='CajaArea2'></textarea></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>5 ENFERMEDAD ACTUAL Y REVISION DE SISTEMAS</td> <td><h7>CRONOLOGIA-LOCALIZACION-CARACTERISTICAS-INTENCIDAD-FRECUENCIA-FACTORES A GRAVANTES</h7></td> <td>NO APLICA</td> <td><input type='text' id='txt5enfer' class='t1'></td> </tr> <tr> <td colspan='4'><textarea id='txt5enfermedad' cols='100' rows='4' class='CajaArea2'></textarea></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='2'>6. CARACTERISTICAS DEL DOLOR</td> <td colspan='3'>EVOLUCION</td> <td colspan='3'>TIPO</td> <td colspan='5'>MODIFICACIONES</td> <td colspan='4'>ALIVIA CON</td> <td colspan='3'>NO APLICA <input type='text' id='txt6caracterist' class='t1'></td> </tr> <tr> <td>REGION ANATOMICA</td> <td>PUNTO DOLOROSO</td> <td>AGUDO</td> <td>BUB AGUDO</td> <td>CRONICO</td> <td>EPISODICO</td> <td>CONTINUO</td> <td>COLICO</td> <td>POSICION</td> <td>INGESTA</td> <td>ESFUERZO</td> <td>DIGITO PRESION</td> <td>SE IRRADIA</td> <td>ANTIESPASMODICO</td> <td>OPIACEO</td> <td>AINE</td> <td>NO ALIVIA</td> <td>INTENSIDAD LEVE MODERADO O GRAVE</td> </tr> <tr> <td><input type='text' id='txtr1' class='medio'></td> <td><input type='text' id='txtpu1' class='medio'></td> <td><input type='text' id='txtag1' class='t1'></td> <td><input type='text' id='txtbu1' class='t1'></td> <td><input type='text' id='txtcr1' class='t1'></td> <td><input type='text' id='txtep1' class='t1'></td> <td><input type='text' id='txtcon1' class='t1'></td> <td><input type='text' id='txtcoll' class='t1'></td> <td><input type='text' id='txtpos1' class='t1'></td> <td><input type='text' id='txtine1' class='t1'></td> <td><input type='text' id='txtesf1' class='t1'></td> <td><input type='text' id='txtdig1' class='t1'></td> <td><input type='text' id='txtser1' class='t1'></td> <td><input type='text' id='txtant1' class='t1'></td> <td><input type='text' id='txtopi1' class='t1'></td> <td><input type='text' id='txtain1' class='t1'></td> <td><input type='text' id='txtnoal1' class='t1'></td> <td><input type='text' id='txtintel1' class='t1'></td> </tr> <tr> <td><input type='text' id='txtr2' class='medio'></td> <td><input type='text' id='txtpu2' class='medio'></td> <td><input type='text' id='txtag2' class='t1'></td> <td><input type='text' id='txtbu2' class='t1'></td> <td><input type='text' id='txtcr2' class='t1'></td> <td><input type='text' id='txtep2' class='t1'></td> <td><input type='text' id='txtcon2' class='t1'></td> <td><input type='text' id='txtcol2' class='t1'></td> <td><input type='text' id='txtpos2' class='t1'></td> <td><input type='text' id='txtine2' class='t1'></td> <td><input type='text' id='txtesf2' class='t1'></td> <td><input type='text' id='txtdig2' class='t1'></td> <td><input type='text' id='txtser2' class='t1'></td> <td><input type='text' id='txtant2' class='t1'></td> <td><input type='text' id='txtopi2' class='t1'></td> <td><input type='text' id='txtain2' class='t1'></td> <td><input type='text' id='txtnoal2' class='t1'></td> <td><input type='text' id='txtintel2' class='t1'></td> </tr> <tr> <td><input type='text' id='txtr13' class='medio'></td> <td><input type='text' id='txtpu3' class='medio'></td> <td><input type='text' id='txtag3' class='t1'></td> <td><input type='text' id='txtbu3' class='t1'></td> <td><input type='text' id='txtcr3' class='t1'></td> <td><input type='text' id='txtep3' class='t1'></td> <td><input type='text' id='txtcon3' class='t1'></td> <td><input type='text' id='txtcol3' class='t1'></td> <td><input type='text' id='txtpos3' class='t1'></td> <td><input type='text' id='txtine3' class='t1'></td> <td><input type='text' id='txtesf3' class='t1'></td> <td><input type='text' id='txtdig3' class='t1'></td> <td><input type='text' id='txtser3' class='t1'></td> <td><input type='text' id='txtant3' class='t1'></td> <td><input type='text' id='txtopi3' class='t1'></td> <td><input type='text' id='txtain3' class='t1'></td> <td><input type='text' id='txtnoal3' class='t1'></td> <td><input type='text' id='txtintel3' class='t1'></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='16'>7 SIGNOS VITALES, MEDICIONES Y VALORES</td> </tr> <tr> <td>PRESION ARTERIAL</td> <td><input type='text' id='txtpresarterial' class='t1'></td> <td>FRECUENCIA CARDIACA min</td> <td><input type='text' id='txtfrecucarmi' class='t1'></td> <td>FRECUENCIA RESPIRATORIA min</td> <td><input type='text' id='txtfrecuresoimi' class='t1'></td> <td>TEMPERATURA BUCAL C</td> <td><input type='text' id='txttembuca' class='t1'></td> <td>TEMPERATURA AXILAR C</td> <td><input type='text' id='txttemeaxil' class='t1'></td> <td>PESO kg</td> <td><input type='text' id='txtpesokg' class='t1'></td> <td>TALLA m</td> <td><input type='text' id='txttallam' class='t1'></td> <td>PERIMETRO CEFALIC cm</td> <td><input type='text' id='txtpercefal' class='t1'></td> </tr> <tr> <td>GLASGOW INICIAL</td> <td>OCULAR</td> <td><input type='text' id='txtocular' class='t1'></td> <td>VERVAL</td> <td><input type='text' id='txtverval' class='t1'></td> <td>MOTORA</td> <td><input type='text' id='txtmotora' class='t1'></td> <td>TOTAL</td> <td><input type='text' id='txttotal' class='t1'></td> <td>REACCION PUPILAR DER</td> <td><input type='text' id='txtreaccpupilder' class='t1'></td> <td>REACCION PUPILAR IZ</td> <td><input type='text' id='txtreacpupiliz' class='t1'></td> <td>T. LLENADO CAPILAR</td> <td><input type='text' id='txttllenadoca1' class='t1'></td> <td><input type='text' id='txttllenadoca2' class='medio'></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='15'>8 EXAMEN FISICO R=REGIONAL  S=SISTEMICO CP=CON EVIDENCIA DE PATALOGIA: MARCAR 'X' Y DESCRIBIR ABAJO SP=SIN EVIDENCIA DE PATOLOGIA: ANOTANDO EL NUMERO Y LETRA CORRESPONDIENTE       MARCAR 'X' Y NO DESCRIBIR</td> </tr> <tr> <td></td> <td>CP</td> <td>SP</td> <td></td> <td>CP</td> <td>SP</td> <td></td> <td>CP</td> <td>SP</td> <td></td> <td>CP</td> <td>SP</td> <td></td> <td>CP</td> <td>SP</td> </tr> <tr> <td>1R PIEL Y FANERAS</td> <td><input type='text' id='txtPYF1' class='t1' /></td> <td><input type='text' id='txtPYF2' class='t1' /></td> <td>6R BOCA</td> <td><input type='text' id='txtBC1' class='t1' /></td> <td><input type='text' id='txtBC2' class='t1' /></td> <td>11R ABDOMENN</td> <td><input type='text' id='txtABD1' class='t1' /></td> <td><input type='text' id='txtABD2' class='t1' /></td> <td>1S ORGANOS DE LOS SENTIDOS</td> <td><input type='text' id='txtORS1' class='t1' /></td> <td><input type='text' id='txtORS2' class='t1' /></td> <td>6S URINARIO</td> <td><input type='text' id='txtURI1' class='t1' /></td> <td><input type='text' id='txtURI2' class='t1' /></td> </tr> <tr> <td>2R CABEZA</td> <td><input type='text' id='txtCAB1' class='t1' /></td> <td><input type='text' id='txtCAB2' class='t1' /></td> <td>7R ORO FARINGE</td> <td><input type='text' id='txtORF1' class='t1' /></td> <td><input type='text' id='txtORF2' class='t1' /></td> <td>12R COLUMNA VERTEBRAL</td> <td><input type='text' id='txtCOLVER1' class='t1' /></td> <td><input type='text' id='txtCOLVER2' class='t1' /></td> <td>2S RESPIRATORIO</td> <td><input type='text' id='txtRESP1' class='t1' /></td> <td><input type='text' id='txtRESP2' class='t1' /></td> <td>7S MUSCULO ESQUELETICO</td> <td><input type='text' id='txtMUSES1' class='t1' /></td> <td><input type='text' id='txtMUSES2' class='t1' /></td> </tr> <tr> <td>3R OJOS</td> <td><input type='text' id='txtOJO1' class='t1' /></td> <td><input type='text' id='txtOJO2' class='t1' /></td> <td>8R CUELLO</td> <td><input type='text' id='txtCUEL1' class='t1' /></td> <td><input type='text' id='txtCUEL2' class='t1' /></td> <td>13R INGLE-PERINE</td> <td><input type='text' id='txtINGPER1' class='t1' /></td> <td><input type='text' id='txtINGPER2' class='t1' /></td> <td>3S CARDIO BASCULAR</td> <td><input type='text' id='txtCARBAS1' class='t1' /></td> <td><input type='text' id='txtCARBAS2' class='t1' /></td> <td>8S ENDOCRINO</td> <td><input type='text' id='txtENDO1' class='t1' /></td> <td><input type='text' id='txtENDO2' class='t1' /></td> </tr> <tr> <td>4R OIDOS</td> <td><input type='text' id='txtOIDO1' class='t1' /></td> <td><input type='text' id='txtOIDO2' class='t1' /></td> <td>9R AXILAS-MAMAS</td> <td><input type='text' id='txtAXIL1' class='t1' /></td> <td><input type='text' id='txtAXIL2' class='t1' /></td> <td>14R MIEMBROS SUPERIORES</td> <td><input type='text' id='txtMIESUP1' class='t1' /></td> <td><input type='text' id='txtMIESUP2' class='t1' /></td> <td>4S DIGESTIVO</td> <td><input type='text' id='txtDIGES1' class='t1' /></td> <td><input type='text' id='txtDIGES2' class='t1' /></td> <td>9S HEMO LIMFATICO</td> <td><input type='text' id='txtHEMLI1' class='t1' /></td> <td><input type='text' id='txtHEMLI2' class='t1' /></td> </tr> <tr> <td>5R NARIZ</td> <td><input type='text' id='txtNARI1' class='t1' /></td> <td><input type='text' id='txtNARI2' class='t1' /></td> <td>10R TORAX</td> <td><input type='text' id='txtTORA1' class='t1' /></td> <td><input type='text' id='txtTORA2' class='t1' /></td> <td>15R MIEMBROS INFERIORES</td> <td><input type='text' id='txtMIEMINF1' class='t1' /></td> <td><input type='text' id='txtMIEMINF2' class='t1' /></td> <td>5S GENITAL</td> <td><input type='text' id='txtGENI1' class='t1' /></td> <td><input type='text' id='txtGENI2' class='t1' /></td> <td>10S NEUROLOGICO</td> <td><input type='text' id='txtNEUROLO1' class='t1' /></td> <td><input type='text' id='txtNEUROLO2' class='t1' /></td> </tr> <tr> <td colspan='15'><textarea id='txtexamenfi8' cols='100' rows='4' class='CajaArea2'></textarea></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='2'>9 DIAGRAMA TOPOGRAFICO     ANOTAR EL NUMERO SOBRE EL LUGAR DE LA LESION</td> <td><input type='text' id='txt9diagratopo' class='t1'></td> </tr> <tr> <td style='width: 198px; height:198px;'> </td> <td colspan='2'> <table> <tr> <td>1 HERIDAD PENETRANTE</td> <td><input type='text' id='txtHERPENE' class='t1' /></td> </tr> <tr> <td>2 HERIDA NO PENETRANTE</td> <td><input type='text' id='txtHERNOPENE' class='t1' /></td> </tr> <tr> <td>3 FRACTURA EXPUESTA</td> <td><input type='text' id='txtFRACEXP' class='t1' /></td> </tr> <tr> <td>4 FRACTURA CERRADA</td> <td><input type='text' id='txtFRACCERRA' class='t1' /></td> </tr> <tr> <td>5 AMPUTACION</td> <td><input type='text' id='txtAMPUTA' class='t1' /></td> </tr> <tr> <td>6 HEMORRAGIA</td> <td><input type='text' id='txtHEMORRA' class='t1' /></td> </tr> <tr> <td>7 MORDEDURA</td> <td><input type='text' id='txtMORDEDU' class='t1' /></td> </tr> <tr> <td>8 PICADURA</td> <td><input type='text' id='txtPICADU' class='t1' /></td> </tr> <tr> <td>9 EXCORIACION</td> <td><input type='text' id='txtEXCORIAC' class='t1' /></td> </tr> <tr> <td>10 DEMORMIDAD O MASA</td> <td><input type='text' id='txtDEFORMIDA' class='t1' /></td> </tr> <tr> <td>11 HEMATOMA</td> <td><input type='text' id='txtHEMATO' class='t1' /></td> </tr> <tr> <td>12 QUEMADURA G-I</td> <td><input type='text' id='txtQUEMAGI' class='t1' /></td> </tr> <tr> <td>13 QUEMADURA G-II</td> <td><input type='text' id='txtQUEMAGII' class='t1' /></td> </tr> <tr> <td>14 QUEMADURA G-III</td> <td><input type='text' id='txtQUEMAGIII' class='t1' /></td> </tr> </table> </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='10'>10 EMBARAZO - PARTO   NO APLICA <input type='text' id='txt10emarapart' class='t1'></td> </tr> <tr> <td>GESTA</td> <td><input type='text' id='txtGESTA' class='t1'></td> <td>PARTOS</td> <td><input type='text' id='txtPARTOS' class='t1'></td> <td>ABORTOS</td> <td><input type='text' id='txtABORTOS' class='t1'></td> <td>CESAREAS</td> <td colspan='2'><input type='text' id='txtCESARES' class='t1'></td> </tr> <tr> <td>FECHA ULT. MENSTRUACION</td> <td><input type='text' id='txtFECULTMENS' class='t1'></td> <td>SEMANAS GESTACION</td> <td><input type='text' id='txtSEMANGES' class='t1'></td> <td>MOVIMIENTO FETAL</td> <td><input type='text' id='txtMOVIENFETA' class='t1'></td> <td>FRECUENCIA C. FETAL</td> <td><input type='text' id='txtFRECCFETAL' class='t1'></td> </tr> <tr> <td>MEMBRANAS ROTAS</td> <td><input type='text' id='txtMEMBRAROTA' class='t1'></td> <td>TIEMPO</td> <td><input type='text' id='txtTIEMPO' class='t1'></td> <td>ALTURA UTERINA</td> <td><input type='text' id='txtALTUTERIN' class='t1'></td> <td>PRESENTACION</td> <td><input type='text' id='txtPRESENTA' class='t1'></td> <td>DILATACION</td> <td><input type='text' id='txtDILATACIO' class='t1'></td> </tr> <tr> <td>BORRAMIENTO</td> <td><input type='text' id='txtBORRAMIEN' class='t1'></td> <td>PLANO</td> <td><input type='text' id='txtPLANO' class='t1'></td> <td>PELVIS UTIL</td> <td><input type='text' id='txtPELVIUTL' class='t1'></td> <td>SANGRADO VAGINAL</td> <td><input type='text' id='txtSANGRAVAGINA' class='t1'></td> <td>CONTRACCIONES</td> <td><input type='text' id='txtCONTRACCIONES' class='t1'></td> </tr> <tr> <td colspan='10'> <textarea cols='100' rows='4' class='CajaArea2' id='txt10embarazoparto'></textarea> </td> </tr> </table> <table> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>11 ANALISIS DE PROBLEMAS </td> <td>NO APLICA <input type='text' id='txt11analisdeprnoap' class='t1'></td> </tr> <tr> <td colspan='2'> <textarea cols='100' rows='4' class='CajaArea2' id='txtanalisideproble'></textarea> </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='13'>12 PLAN DIAGNOSTICO</td> <td colspan='3'>REGISTRAR ABAJO COMENTARIOS Y RESULTADOS, ANOTANDO EL NUMERO   NO APLICA <input type='text' id='txtnoaple12paldiag' class='t1'></td> </tr> <tr> <td>1 BIOMETRIA</td> <td><input type='text' id='txt1BIOMETRI' class='t1'></td> <td>3 QUIMICA SANGUINEA</td> <td><input type='text' id='txt3QUIMISANGU' class='t1'></td> <td>5 GASOMETRIA</td> <td><input type='text' id='txt5GASOMETRI' class='t1'></td> <td>7 ENDOSCOPIA</td> <td><input type='text' id='txt7ENDOSCOPIA' class='t1'></td> <td>9 R-X ABDOMEN</td> <td><input type='text' id='txt9RXABDOME' class='t1'></td> <td>11 TOMOGRAFIA</td> <td><input type='text' id='txt11TOMOGRAIA' class='t1'></td> <td>13 ENCOGRAFIA PELVICA</td> <td><input type='text' id='txtENCOGRAPEL' class='t1'></td> <td>15 INTERCONSULTA</td> <td><input type='text' id='txt' class='t1'></td> </tr> <tr> <td>2 URUANALISIS</td> <td><input type='text' id='txt2URUANALIS' class='t1'></td> <td>4 ELECTROLITOS</td> <td><input type='text' id='txt4ELECTROLIT' class='t1'></td> <td>6 ELECTROCARDIOGRAMA</td> <td><input type='text' id='txt6ELECTROCARDI' class='t1'></td> <td>8 R-X TORAX</td> <td><input type='text' id='txt8RXTORAX' class='t1'></td> <td>10 R-X OSEA</td> <td><input type='text' id='txt10RXOSEA' class='t1'></td> <td>12 RESONANCIA</td> <td><input type='text' id='txt12RESONANCIA' class='t1'></td> <td>14 ENCOGRAFIA ABDOMEN</td> <td><input type='text' id='txt14ENCOGRAFIAABDOME' class='t1'></td> <td>16 OTROS</td> <td><input type='text' id='txt16OTROS' class='t1'></td> </tr> <tr> <td colspan='16'><textarea cols='100' rows='4' id='txt12plandiagnos' class='CajaArea2'></textarea></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>13 DIAGNOSTICOS PRESUNTIVOS</td> <td>CIE</td> <td></td> <td>14 DIAGNOSTICOS DEFINITIVOS</td> <td>CIE</td> <td></td> </tr> <tr> <td><input type='text' id='txtdiagp1' class='medio' /></td> <td><input type='text' id='txtciep1' class='CajaTallas' /></td> <td><input type='button' class='btn btn-danger' value='Borrar' onclick='' /></td> <td><input type='text' id='txtdiagd1' class='medio' /></td> <td><input type='text' id='txtcied1' class='CajaTallas' /></td> <td><input type='button' class='btn btn-danger' value='Borrar' onclick='' /></td> </tr> <tr> <td><input type='text' id='txtdiagp2' class='medio' /></td> <td><input type='text' id='txtciep2' class='CajaTallas' /></td> <td><input type='button' class='btn btn-danger'  value='Borrar'onclick='' />	</td> <td><input type='text' id='txtdiagd2' class='medio' /></td> <td><input type='text' id='txtcied2' class='CajaTallas' /></td> <td><input type='button' class='btn btn-danger' value='Borrar' onclick='' /></td> </tr> <tr> <td><input type='text' id='txtdiagp3' class='medio' /></td> <td><input type='text' id='txtciep3' class='CajaTallas' /></td> <td><input type='button' class='btn btn-danger' value='Borrar' onclick='' /></td> <td><input type='text' id='txtdiagd3' class='medio' /></td> <td><input type='text' id='txtcied3' class='CajaTallas' /></td> <td><input type='button' class='btn btn-danger' value='Borrar' onclick='' /></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='2'>15 PLAN DE TRATAMIENTO</td> </tr> <tr> <td> <table> <tr> <td>MEDICAMENTOS GENERICOS</td> <td>VIA</td> <td>DOSIS</td> <td>POSO LOGIA</td> <td>DIAS</td> </tr> <tr> <td><input type='text' id='txtmediage1' class='medio'></td> <td><input type='text' id='txtvia1' class='t1'></td> <td><input type='text' id='txtdosis1' class='t1'></td> <td><input type='text' id='txtposolo1' class='t1'></td> <td><input type='text' id='txtdias1' class='t1'></td> </tr> <tr> <td><input type='text' id='txtmediage2' class='medio'></td> <td><input type='text' id='txtvia2' class='t1'></td> <td><input type='text' id='txtdosis2' class='t1'></td> <td><input type='text' id='txtposolo2' class='t1'></td> <td><input type='text' id='txtdias2' class='t1'></td> </tr> <tr> <td><input type='text' id='txtmediage3' class='medio'></td> <td><input type='text' id='txtvia3' class='t1'></td> <td><input type='text' id='txtdosis3' class='t1'></td> <td><input type='text' id='txtposolo3' class='t1'></td> <td><input type='text' id='txtdias3' class='t1'></td> </tr> <tr> <td><input type='text' id='txtmediage4' class='medio'></td> <td><input type='text' id='txtvia4' class='t1'></td> <td><input type='text' id='txtdosis4' class='t1'></td> <td><input type='text' id='txtposolo4' class='t1'></td> <td><input type='text' id='txtdias4' class='t1'></td> </tr> </table> </td> <td> <table > <tr> <td>1 I. GENERALES</td> <td><input type='text' id='txtINDICAGENERE' class='t1' /></td> <td>2 PROCEDIMIENTOS</td> <td><input type='text' id='txtPROCEDIMIE' class='t1' /></td> <td>3 C. INFORMADO</td> <td><input type='text' id='txtCONCENTINFORM' class='t1' /></td> <td>4 OTROS</td> <td><input type='text' id='txtPLANTRATAOTROS' class='t1' /></td> </tr> <tr> <td colspan='8'><input type='text' id='txt1platra1'></td> </tr> <tr> <td colspan='8'><input type='text' id='txt1platra2'></td> </tr> <tr> <td colspan='8'><input type='text' id='txt1platra3'></td> </tr> <tr> <td colspan='8'><input type='text' id='txt1platra4'></td> </tr> </table> </td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td colspan='18'>16 SALIDA</td> </tr> <tr> <td>DOMICILIO</td> <td><input type='text' id='tx15tDOMICILIO' class='t1' /></td> <td>CONSULTA EXTERNA</td> <td><input type='text' id='txt15CONSULTAEXTER' class='t1' /></td> <td>OBSERVACION</td> <td><input type='text' id='txt15OBERVACION' class='t1' /></td> <td>INTERNACION</td> <td><input type='text' id='txt15INTERNACION' class='t1' /></td> <td>REFERENCIA</td> <td><input type='text' id='txt15REFERENCIA' class='t1' /></td> <td>VIVO</td> <td><input type='text' id='txt15VIVO' class='t1' /></td> <td>ESTABLE</td> <td><input type='text' id='txt15ESTABLE' class='t1' /></td> <td>INESTABLE</td> <td><input type='text' id='txt15INTESTABLE' class='t1' /></td> <td>DIAS DE INCAPACIDAD</td> <td><input type='text' id='txt15DIASINCAPACIDA' class='t1' /></td> </tr> <tr> <td colspan='2'>SERVICO</td> <td colspan='2'><input type='text' id='txtSERVICO15' class='medio'></td> <td colspan='2'>ESTABLECIMIENTO</td> <td colspan='2'><input type='text' id='txtESTABLECIMIENTO15' class='medio'></td> <td colspan='2'>MUERTO EN EMERGENCIA</td> <td colspan='2'><input type='text' id='txtMUERTOENEMERGE15' class='medio'></td> <td colspan='2'>CAUSAS</td> <td colspan='3'><input type='text' id='txtCAUSUS15' class='medio'></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>FECHA DE SALIDA</td> <td><input type='text' id='txtFECHASALIDA' ></td> <td>HORA DE SALIDA</td> <td><input type='text' id='txtHORADESALIDA' ></td> <td>MEDICO</td> <td><input type='text' id='txtMEDIOC' ></td> <td>FIRMA</td> <td><input type='text' id='txtFIRMNAMEDIEME' ></td> <td><input type='text' id='txtCODIGOEMERGE' class='t1'></td> </tr> </table>");


}

//------------------------------- Mi codigo Anamnesis -------------------------------------//

//modal Anamnesis para Cdu
function AnamnesisCdu()
{
	//$("#Datos").hide();
/*	$( "#AnamnesisCdu" ).attr("title","Consulta");
	$( "#AnamnesisCdu" ).dialog({
			autoOpen: false,
			modal: true,
			height:800,
			width:1094,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#AnamnesisCdu" ).dialog( "open" );	
	*/
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");

		
				$.ajax({
					url:'Procesar.php?accion=GenerarAnamesisCdu&CodigoPac2='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
					}
				}); 
		
		
		/* $( "#AnamnesisCdu" ).html("<!-- Cabecera --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td rowspan='2'><center>Establecimiento</center></td> <td rowspan='2'><center>Nombre</center></td> <td rowspan='2'><center>Apellido</center></td> <td colspan='2' rowspan='2'><center>Sexo</center></td> <td rowspan='2'><center>Número de <br />hoja</center></td> <td rowspan='2'><center>Historia <br />clínica</center></td> </tr> <tr> </tr> <tr> <td><input type='text' id='txtEstablecim' style='width:140px; text-align:center;' value='Clínica de Urología' readonly /></td> <td><input type='text' id='txtNompac' style='width:140px; text-align:center;' value='$nompac' readonly /></td> <td><input type='text' id='txtApepac' style='width:140px; text-align:center;' value='$apepac' readonly /></td> <td colspan='2'><input type='text' id='SexAnam' style='width:80px; text-align:center;' value='$sexpac' readonly /></td> <td><input type='text' id='txtNumHoja' style='width:100px; text-align:center;' readonly/></td> <td><input type='text' id='txtHisCl' style='width:100px; text-align:center;' value='$cedpac' readonly /></td> </tr> </table> <!-- 1 --> <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td>1. Motivo de consulta</td> </tr> <tr> <td><textarea id='txtMotivoCon' cols='40' rows='2' style='width:760px;'></textarea></td> </tr> </table> <!-- 2 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>2. Antecedentes personales</td> </tr> <tr> <td><textarea id='txtAntePer' cols='40' rows='2' style='width:760px;' ></textarea></td> </tr> </table> <!-- 3 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>3. Antecedentes familiares</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtAnteFam' style='width:760px;' ></textarea> </td> </tr> </table> <!-- 4 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>4. Enfermedad o problema actual</td> </tr> <tr> <td><textarea id='txtEnfermeAc' cols='40' rows='2' style='width:760px;'></textarea></td> </tr> </table> <!-- 5 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>5. Revisión actual de órganos y sistemas</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtRevisionOys' style='width:760px;' ></textarea> </td> </tr> </table> <!-- 6 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>6. Signos vitales</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed '> <tr> <td><center>Fecha: </center></td> <td><input type='text' id='txtFechAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtFechAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Presión arterial: </center></td> <td><input type='text' id='txtPreArAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPreArAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Pulso x min: </center></td> <td><input type='text' id='txtPulAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtPulAnam4' style='width:140px; text-align:center;' /></td> </tr> <tr> <td><center>Temperatura °c: </center></td> <td><input type='text' id='txtTemcAnam' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam2' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam3' style='width:140px; text-align:center;' /></td> <td><input type='text' id='txtTemcAnam4' style='width:140px; text-align:center;' /></td> </tr> </table> </td> </tr> </table> <!-- 7 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>7. Examen físico</td> </tr> <tr> <td><textarea cols='40' rows='2' id='txtExamenFi' style='width:760px;' ></textarea> </td> </tr> </table> <!-- 8 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>8. Diagnósticos</td> </tr> <tr> <td>&nbsp; <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td colspan='2'>Descripción</td> <td>Cod. CIE</td> <td>Pre.</td> <td >Def.</td> </tr> <tr> <td>1</td> <td><input type='text' id='txtCie1' /></td> <td><input type='text' id='txtCod1' /></td> <td><input type='checkbox' id='txtPre1'></td> <td><input type='checkbox' id='txtDef1'></td> </tr> <tr> <td>2</td> <td><input type='text' id='txtCie2' /></td> <td><input type='text' id='txtCod2' /></td> <td><input type='checkbox' id='txtPre2'></td> <td><input type='checkbox' id='txtDef2'></td> </tr> <tr> <td>3</td> <td><input type='text' id='txtCie3' /></td> <td><input type='text' id='txtCod3' /></td> <td><input type='checkbox' id='txtPre3'></td> <td><input type='checkbox' id='txtDef3'></td> </tr> <tr> <td>4</td> <td><input type='text' id='txtCie4' /></td> <td><input type='text' id='txtCod4' /></td> <td><input type='checkbox' id='txtPre4'></td> <td><input type='checkbox' id='txtDef4'></td> </tr> <tr> <td>5</td> <td><input type='text' id='txtCie5' /></td> <td><input type='text' id='txtCod5' /></td> <td><input type='checkbox' id='txtPre5'></td> <td><input type='checkbox' id='txtDef5'></td> </tr> </table> </td> </tr> </table> <!-- 9 --> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr> <td>9. Planes de Diagnóstico, Terapeúticos y Educacionales </td> </tr> <tr> <td><textarea id='txtPlanesdte' cols='90' rows='2' style='width:760px;'></textarea></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr><td><center><input type='button' class='btn btn-success' id='bntNewAnamnesisCdu' value='Nuevo' onclick='NewAnamnesisCdu()' />&nbsp; <input type='button' class='btn btn-primary' id='bntAnamnesisCdu' value='Subsecuente' onclick='SaveAnanmesisCdu()' />&nbsp; <input type='button' class='btn btn-danger' id='bntCloseAnam' value='Cerrar' onclick='CloseAnamnesisCdu()' /></center></td> </tr> </table>"); */
}
//fin modal Anamnesis para Cdu

//funcion para guardar Anamnesis Cdu
function SaveAnanmesisCdu()
{
	if($('#txtCie1').val()!="")
	{
	if($('#txtMedich').val()!="")
	{
		
		$.ajax({
			url:'Procesar.php?accion=SaveAnamnesis2Cdu&CodPacCdu99='+$('#codigoPaciente').val()+'&LugarEstabl='+$('#txtEstablecim').val()+'&NombrePac='+$('#txtNompac').val()+'&ApellidoPac='+$('#txtApepac').val()+'&SexoPac='+$('#SexAnam').val()+'&NumueroHoja='+$('#txtNumHoja').val()+'&HistoriaCl='+$('#txtHisCl').val()+'&MotivoCo='+$('#txtMotivoCon').val()+'&AntecPer='+$('#txtAntePer').val()+'&AntecFam='+$('#txtAnteFam').val()+'&EnfermeProAc='+$('#txtEnfermeAc').val()+'&ReviOrgSis='+$('#txtRevisionOys').val()+'&FechaSigVi1='+$('#txtFechAnam').val()+'&FechaSigVi2='+$('#txtFechAnam2').val()+'&FechaSigVi3='+$('#txtFechAnam3').val()+'&FechaSigVi4='+$('#txtFechAnam4').val()+'&PreSigVi1='+$('#txtPreArAnam').val()+'&PreSigVi2='+$('#txtPreArAnam2').val()+'&PreSigVi3='+$('#txtPreArAnam3').val()+'&PreSigVi4='+$('#txtPreArAnam4').val()+'&PulsSigVi1='+$('#txtPulAnam').val()+'&PulsoSigVi2='+$('#txtPulAnam2').val()+'&PulsoSigVi3='+$('#txtPulAnam3').val()+'&PulsoSigVi4='+$('#txtPulAnam4').val()+'&TempSigVi1='+$('#txtTemcAnam').val()+'&TempSigVi2='+$('#txtTemcAnam2').val()+'&TempSigVi3='+$('#txtTemcAnam3').val()+'&TempSigVi4='+$('#txtTemcAnam4').val()+'&ExaFisico='+$('#txtExamenFi').val()+'&Diagn1='+$('#txtCie1').val()+'&Diagn2='+$('#txtCie2').val()+'&Diagn3='+$('#txtCie3').val()+'&Diagn4='+$('#txtCie4').val()+'&Diagn5='+$('#txtCie5').val()+'&CodCie1='+$('#txtCod1').val()+'&CodCie2='+$('#txtCod2').val()+'&CodCie3='+$('#txtCod3').val()+'&CodCie4='+$('#txtCod4').val()+'&CodCie5='+$('#txtCod5').val()+'&Pre1='+$("#txtPre1").is(":checked")+'&Pre2='+$("#txtPre2").is(":checked")+'&Pre3='+$("#txtPre3").is(":checked")+'&Pre4='+$("#txtPre4").is(":checked")+'&Pre5='+$("#txtPre5").is(":checked")+'&Def1='+$("#txtDef1").is(":checked")+'&Def2='+$("#txtDef2").is(":checked")+'&Def3='+$("#txtDef3").is(":checked")+'&Def4='+$("#txtDef4").is(":checked")+'&Def5='+$("#txtDef5").is(":checked")+'&PlanesDte='+$('#txtPlanesdte').val()+'&FechaContr='+$('#txtFechaControl').val()+'&HoraFin='+$('#txtHoraFin').val()+'&Medico='+$('#txtMedich').val()+'&CodMedico='+$('#txtCodM3').val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
		//$("#Datos").show();
	}
	else
	{
		alert ("Por favor llene el campo de médico para poder continuar");
	}
	}
	else
	{
		alert ("Debe ingresar al menos el primer diagnóstico");
	}
			
		
}
//fin funcion para guardar Anamnesis Cdu 

//mostrar modal expediente subsecuente
function Expediente()
{
	/*$( "#AnamnesisCdu" ).attr("title","Expediente");
	$( "#AnamnesisCdu" ).dialog({
			autoOpen: false,
			modal: true,
			height:800,
			width:1040,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});*/
	
		var med=$("#txtmd").val();
		$( ".Resp2" ).html("<!-- subsecuente 2 --> <table class='table-bordered table-striped table-hover table-condensed' > <tr><td colspan='5'>Médico: &nbsp; <input type='text' id='txtMedicAnam' style='width:400px; text-align:center;' value='"+med+"' readonly/></td></tr> <tr> <td style='text-align:center'>Fecha <br />(Año/Mes/Dia)</td> <td style='text-align:center'>Hora</td> <td style='text-align:center'>Evolución</td> <td style='text-align:center'>Prescripciones</td> <td style='text-align:center'>Medicamentos<br />Registrar /Administrar</td> </tr> <tr> <td height='42'><input type='text' id='txtFechaSubs' style='width:100px; text-align:center;'/></td> <td><input type='text' id='txtHoraSubs' style='width:70px; text-align:center;'/></td> <td><textarea id='txtEvolucionSub' cols='40' rows='4' style='width:300px;'></textarea></td> <td><textarea id='txtPrescriSub' cols='40' rows='4' style='width:300px;'></textarea></td> <td><a href='#myModal' role='button'  data-toggle='modal' class='btn btn-success' onclick='datosvademecun5()' ><i class='icon-plus'></i> Medicamento</a></td> </tr> <tr> <td colspan='5'><center><a class='btn btn-info' onclick='AnamnesisCdu()'><i class=' icon-arrow-left'></i> Atrás</a>&nbsp;<a class='btn btn-success' onclick='SaveExpediente()'><i class=' icon-file'></i> Guardar</a>&nbsp;<a href='#'  class='btn btn-primary' onclick='VerExpedienteAnt()'><i class=' icon-list-alt'></i> Ver Lista de Expedientes</a><!-- <input id='bntimprExpediente' onclick='PrintExpediente()' class='btn btn-danger' type='button' value='Imprimir' />--> </center></td> </tr> </table>");
		
	$('#txtFechaSubs').datepicker({
		changeMonth: true,
		changeYear: true
	});
	$('#txtFechaSubs').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );
}
//fin mostrar modal expediente subsecuente

//funcion guardar expediente (consecuente)
function SaveExpediente()
{
	if($('#txtFechaSubs').val()!="" & $('#txtHoraSubs').val()!="" & $('#txtEvolucionSub').val()!="" & $('#txtPrescriSub').val()!="" & $('#txtMedicamentosSub').val()!="")
	{

	/*$("#ExpedienteFin").attr("title","Expediente");
	$( "#ExpedienteFin" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
			width:1300,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#ExpedienteFin" ).dialog( "open" );*/
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");
	$.ajax({
			url:'Procesar.php?accion=SaveExpedienteCdu&CodPacCdu73='+$('#codigoPaciente').val()+'&FechaExp='+$('#txtFechaSubs').val()+'&HoraExp='+$('#txtHoraSubs').val()+'&EvolucionExp='+$('#txtEvolucionSub').val()+'&PrescripcionesExp='+$('#txtPrescriSub').val()+'&MedicamentosExp='+$('#txtMedicamentosSub').val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
		
		$('#txtFechaSubs').val("");
		$('#txtHoraSubs').val("");
		$('#txtEvolucionSub').val("");
		$('#txtPrescriSub').val("");
		$('#txtMedicamentosSub').val("");
	}
	else
	{
		alert ("Complete los campos para continuar");
	}
}
//fin funcion guardar expediente (consecuente) 

//funcion imprimir anamnesis cdu 
function PrintAnamnesisCdu()
{
	//SaveAnanmesisCdu();
/*	$("#PrintAnamnesiscdu").attr("title","Anamnesis");
	$( "#PrintAnamnesiscdu" ).dialog({
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
	$( "#PrintAnamnesiscdu" ).dialog( "open" );*/
	$( ".modal-body" ).html("<object type='text/html' data='../Reportes/AnamnesisCdu.php?idPac="+$('#codigoPaciente').val()+"'></object>");
}
//fin funcion imprimir anamnesis cdu 

//funcion salir Anamnesis
function ExitAn()
{
	$( "#AnamnesisCdu" ).dialog( "close" );
}
//fin funcion salir Anamnesis

//borrar cie
function DeleteCie1()
{
	if($("#txtCie1").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie1").val("");
			$("#txtCod1").val("");
		}
	}
	else
	{
		$("#txtCie1").val("");
		$("#txtCod1").val("");
	}
}

function DeleteCie2()
{
	if($("#txtCie2").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie2").val("");
			$("#txtCod2").val("");
		}
	}
	else
	{
		$("#txtCie2").val("");
		$("#txtCod2").val("");
	}
}

function DeleteCie3()
{
	if($("#txtCie3").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie3").val("");
			$("#txtCod3").val("");
		}
	}
	else
	{
		$("#txtCie3").val("");
		$("#txtCod3").val("");
	}
}

function DeleteCie4()
{
	if($("#txtCie4").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie4").val("");
			$("#txtCod4").val("");
		}
	}
	else
	{
		$("#txtCie4").val("");
		$("#txtCod4").val("");
	}
}

function DeleteCie5()
{
	if($("#txtCie5").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie5").val("");
			$("#txtCod5").val("");
		}
	}
	else
	{
		$("#txtCie5").val("");
		$("#txtCod5").val("");
	}
}
//fin borrar cie

//finalizar anamnesis
function FinalizarAnam(cod)
{
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");

	$.ajax({
	url:'Procesar.php?accion=FinalizarAnamn&idAnam='+cod,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
}
//fin finalizar anamnesis 

//funcion imprimir expediente
function ImprimirExp(cod)
{
/*	$("#ImprimirExpediente").attr("title","Expediente Único para la Historia Clínica");
	$( "#ImprimirExpediente" ).dialog({
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
		$( "#ImprimirExpediente" ).dialog( "open" );	*/
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/ExpedienteCdu.php?id="+cod+"'></object>");
}
//fin funcion imprimir expediente

//ver expedientes anteriores
function VerExpedienteAnt()
{
	$("#VerAllExpediente").attr("title","Expediente Único para la Historia Clínica");
	/*$( "#VerAllExpediente" ).dialog({
			autoOpen: false,
			modal: true,
			height:700,
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
		$( "#VerAllExpediente" ).dialog( "open" );*/
	$.ajax({
			url:'Procesar.php?accion=LoadAllExpediente&cod='+$("#codigoPaciente").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp3").html(res);
			},
			error:function()
			{
				$(".Resp3").html("error al cargar");
			}
		});
}
//fin ver expedientes anteriores

//funcion nueva anamnesis
function NewAnamnesisCdu(){
$(".Resp2").html("");
$(".Resp3").html("");
$(".Resp4").html("");
$(".Resp5").html("");
$(".Resp6").html("");

$.ajax({
				url:'Procesar.php?accion=CreateNewAnamnesis&IdPaciente='+$("#codigoPaciente").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
				},
				error:function()
				{
					$(".Resp2").html("error al cargar");
				}
			});	
}
//fin funcion nueva anamnesis

//------------------------------- Mi codigo Interconsulta -------------------------------------// 

//solicitu interconsulta 
function PedidoInterconsulta()
{
	/*$("#SolicitudInCo").attr("title","INTERCONSULTA - SOLICITUD");
	$( "#SolicitudInCo" ).dialog({
			autoOpen: false,
			modal: true,
			height:864,
			width:1280,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#SolicitudInCo" ).dialog( "open" );*/
		$(".Resp2").html("");
		$(".Resp3").html("");
		$(".Resp4").html("");
		$(".Resp5").html("");
		$(".Resp6").html("");
		$.ajax({
					url:'Procesar.php?accion=GenerarSolicitudInterco&CodigoPacInt1='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
					}
				});

}
//fin solicitud interconsulta

//funcion guardar la solicitud de interconsulta
//funcion guardar la solicitud de interconsulta
function SaveSolucitud()
{
	if($('#txtCie1In').val()!="")
	{
		$.ajax({
					url:'Procesar.php?accion=SaveSolicituInCo&CodpacCduIn1='+$('#codigoPaciente').val()+'&InstitucionSys='+$('#txtInstitucionSis').val()+'&UnidadOp2='+$('#txtUnidadOp').val()+'&CodigoSo='+$('#txtCode').val()+'&ParroquiaSo='+$('#txtParroquia').val()+'&CantonSo='+$('#txtCanton').val()+'&ProvinciaSo='+$('#txtProvincia').val()+'&HistoriaClSo='+$('#txtHistoriaCl').val()+'&ApellidoSo='+$('#txtApedillos').val()+'&NombresSo='+$('#txtNombres').val()+'&CedulaSo='+$('#txtCedulaCi').val()+'&FechaAtn='+$('#txtFechaAt').val()+'&HoraSo='+$('#txtHoraIn').val()+'&EdadSo='+$('#txtEdadIn').val()+'&GeneroSo='+$('#txtGeneroIn').val()+'&EstadoCivSo='+$('#txtEstCi').val()+'&IntruccionSo='+$('#txtInstruccionIn').val()+'&EmpresaSo='+$('#txtEmpresaTr').val()+'&SeguroSaludSo='+$('#txtSeguroSa').val()+'&EstablecimientoDes='+$('#txtEstablDe').val()+'&ServicioCon='+$('#txtServicioCo').val()+'&ServicioSo='+$('#txtServicioSo').val()+'&SalaSo='+$('#txtSalaIn').val()+'&CamaSo='+$('#txtCamaIn').val()+'&NormalSo='+$("#chkNormal").is(":checked")+'&UrgenteSo='+$("#chkUrgente").is(":checked")+'&MedicoInter='+$('#txtMedicoInt').val()+'&CuadroClinico='+$('#txtCuadroClinicoAc').val()+'&ResultadoPruebas='+$('#txtResulPrDi').val()+'&Cie1So='+$('#txtCie1In').val()+'&Cie2So='+$('#txtCie2In').val()+'&Cie3So='+$('#txtCie3In').val()+'&Cie4So='+$('#txtCie4In').val()+'&Cie5So='+$('#txtCie5In').val()+'&Cie6So='+$('#txtCie6In').val()+'&Cod1So='+$('#txtCod1In').val()+'&Cod2So='+$('#txtCod2In').val()+'&Cod3So='+$('#txtCod3In').val()+'&Cod4So='+$('#txtCod4In').val()+'&Cod5So='+$('#txtCod5In').val()+'&Cod6So='+$('#txtCod6In').val()+'&Pre1So='+$("#chkPre1In").is(":checked")+'&Pre2So='+$("#chkPre2In").is(":checked")+'&Pre3So='+$("#chkPre3In").is(":checked")+'&Pre4So='+$("#chkPre4In").is(":checked")+'&Pre5So='+$("#chkPre5In").is(":checked")+'&Pre6So='+$("#chkPre6In").is(":checked")+'&Def1So='+$("#chkDef1In").is(":checked")+'&Def2So='+$("#chkDef2In").is(":checked")+'&Def3So='+$("#chkDef3In").is(":checked")+'&Def4So='+$("#chkDef4In").is(":checked")+'&Def5So='+$("#chkDef5In").is(":checked")+'&Def6So='+$("#chkDef6In").is(":checked")+'&PlanTerape='+$('#txtPlanTe').val()+'&PlanEd='+$('#txtPlanEd').val()+'&Servicio='+$('#txtServicio').val()+'&MedicSo='+$('#txtMedicoIn').val()+'&CodigoMedSo='+$('#txtCodIn').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
					}
				});	
	}
	else
	{
		alert ("Debe ingresar al menos el primer diagnóstico");
	}
}
//fin funcion guardar la solicitud de interconsulta 

//finalizar solicitud interconsulta
function EndSolucitud(cod)
{
	$.ajax({
	url:'Procesar.php?accion=FinalizarSolicitudIn&idSolictd='+cod+'&MedSolctd='+$('#txtMedicoIn').val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
}
//fin finalizar solicitud interconsulta

//funcion nueva solicitud interconsulta
function NewSolucitud()
{
	$.ajax({
		url:'Procesar.php?accion=CreateNewSolicInt&IdPacienteSoIn='+$("#codigoPaciente").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
				},
				error:function()
				{
					$(".Resp2").html("error al cargar");
				}
			});
}
//fin funcion nueva solicitud interconsulta

//imprimir solicitud interconsulta
function PrintSolucitud()
{
	/*SaveSolucitud();
	$("#PrintSolicitudIn").attr("title","Solicitud - Interconsulta");
	$( "#PrintSolicitudIn" ).dialog({
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
	$( "#PrintSolicitudIn" ).dialog( "open" );*/
	$( ".modal-body" ).html("<object type='text/html' data='../Reportes/SolicitudInterconsulta.php?idPac="+$('#codigoPaciente').val()+"'></object>");
}
//fin imprimir solicitud interconsulta

//borrar cie
function DeleteCie1In()
{
	if($("#txtCie1In").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie1In").val("");
			$("#txtCod1In").val("");
		}
	}
	else
	{
		$("#txtCie1In").val("");
		$("#txtCod1In").val("");
	}
}

function DeleteCie2In()
{
	if($("#txtCie2In").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie2In").val("");
			$("#txtCod2In").val("");
		}
	}
	else
	{
		$("#txtCie2In").val("");
		$("#txtCod2In").val("");
	}
}

function DeleteCie3In()
{
	if($("#txtCie3In").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie3In").val("");
			$("#txtCod3In").val("");
		}
	}
	else
	{
		$("#txtCie3In").val("");
		$("#txtCod3In").val("");
	}
}

function DeleteCie4In()
{
	if($("#txtCie4In").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie4In").val("");
			$("#txtCod4In").val("");
		}
	}
	else
	{
		$("#txtCie4In").val("");
		$("#txtCod4In").val("");
	}
}

function DeleteCie5In()
{
	if($("#txtCie5In").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie5In").val("");
			$("#txtCod5In").val("");
		}
	}
	else
	{
		$("#txtCie5In").val("");
		$("#txtCod5In").val("");
	}
}

function DeleteCie6In()
{
	if($("#txtCie6In").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie6In").val("");
			$("#txtCod6In").val("");
		}
	}
	else
	{
		$("#txtCie6In").val("");
		$("#txtCod6In").val("");
	}
}
//fin borrar cie

//modal informe interconsulta
function InformeInterconsulta()
{
	/*$("#InformeInterconsulta").attr("title","INTERCONSULTA - INFORME");
	$( "#InformeInterconsulta" ).dialog({
			autoOpen: false,
			modal: true,
			height:864,
			width:1200,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#InformeInterconsulta" ).dialog( "open" );*/
		$(".Resp2").html("");
		$(".Resp3").html("");
		$(".Resp4").html("");
		$(".Resp5").html("");
		$(".Resp6").html("");
		$.ajax({
					url:'Procesar.php?accion=GenerarInformeInterco&CodigoPacInt2='+$("#codigoPaciente").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
					}
				});
}
//fin modal informe interconsulta

//guardar informe
function SaveInforme()
{
	if($('#txtCie1Info').val()!="")
	{
		$.ajax({
					url:'Procesar.php?accion=SaveInformeInCo&CodpacCduIn2='+$('#codigoPaciente').val()+'&InstitucionInfo='+$('#InstitucionSisInfo').val()+'&UnidadOpInfo='+$('#UniOperativaInfo').val()+'&CodInfo='+$('#CodeInfo').val()+'&ParroqInfo='+$('#ParroquiaInfo').val()+'&CanInfo='+$('#CantonInfo').val()+'&ProviInfo='+$('#ProvinciaInfo').val()+'&HistoclInfo='+$('#HistoriaClInfo').val()+'&CuadrocliInfo='+$('#CuadroClInInfo').val()+'&PruebasdiInfo='+$('#PruebasDiProInfo').val()+'&Diagnostico1='+$('#txtCie1Info').val()+'&Diagnostico2='+$('#txtCie2Info').val()+'&Diagnostico3='+$('#txtCie3Info').val()+'&Diagnostico4='+$('#txtCie4Info').val()+'&Diagnostico5='+$('#txtCie5Info').val()+'&Diagnostico6='+$('#txtCie6Info').val()+'&Codcie1='+$('#txtCod1Info').val()+'&Codcie2='+$('#txtCod2Info').val()+'&Codcie3='+$('#txtCod3Info').val()+'&Codcie4='+$('#txtCod4Info').val()+'&Codcie5='+$('#txtCod5Info').val()+'&Codcie6='+$('#txtCod6Info').val()+'&Pre1Info='+$("#chkPre1Info").is(":checked")+'&Pre2Info='+$("#chkPre2Info").is(":checked")+'&Pre3Info='+$("#chkPre3Info").is(":checked")+'&Pre4Info='+$("#chkPre4Info").is(":checked")+'&Pre5Info='+$("#chkPre5Info").is(":checked")+'&Pre6Info='+$("#chkPre6Info").is(":checked")+'&Def1Info='+$("#chkDef1Info").is(":checked")+'&Def2Info='+$("#chkDef2Info").is(":checked")+'&Def3Info='+$("#chkDef3Info").is(":checked")+'&Def4Info='+$("#chkDef4Info").is(":checked")+'&Def5Info='+$("#chkDef5Info").is(":checked")+'&Def6Info='+$("#chkDef6Info").is(":checked")+'&PlanteInfo='+$('#PlanTeProInfo').val()+'&PlanedInfo='+$('#PlanEdProInfo').val()+'&ResumencInfo='+$('#ResumenInfo').val()+'&ServiceInfo='+$('#txtServicioInfo').val()+'&MedicInfo='+$('#txtMedicoInfo').val()+'&CodmedInfo='+$('#txtCodInfo').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
					}
				});
	}
	else
	{
		alert ("Debe llenar al menos el primer diagnóstico");
	}
}
//fin guardar informe

//finalizar informe interconsulta
function EndInforme(cod)
{
	$.ajax({
	url:'Procesar.php?accion=FinalizarInformeIn&idInforme='+cod+'&MedInforme='+$('#txtMedicoInfo').val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
}
//fin finalizar informe interconsulta

//funcion nuevo informe interconsulta
function NewInforme()
{
	$.ajax({
		url:'Procesar.php?accion=CreateNewInformeInt&IdPacienteInfoIn='+$("#codigoPaciente").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
				},
				error:function()
				{
					$(".Resp2").html("error al cargar");
				}
			});
}
//fin funcion nuevo informe interconsulta

//borrar cie
function DeleteCie1Info()
{
	if($("#txtCie1Info").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie1Info").val("");
			$("#txtCod1Info").val("");
		}
	}
	else
	{
		$("#txtCie1Info").val("");
		$("#txtCod1Info").val("");
	}
}

function DeleteCie2Info()
{
	if($("#txtCie2Info").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie2Info").val("");
			$("#txtCod2Info").val("");
		}
	}
	else
	{
		$("#txtCie2Info").val("");
		$("#txtCod2Info").val("");
	}
}

function DeleteCie3Info()
{
	if($("#txtCie3Info").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie3Info").val("");
			$("#txtCod3Info").val("");
		}
	}
	else
	{
		$("#txtCie3Info").val("");
		$("#txtCod3Info").val("");
	}
}

function DeleteCie4Info()
{
	if($("#txtCie4Info").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie4Info").val("");
			$("#txtCod4Info").val("");
		}
	}
	else
	{
		$("#txtCie4Info").val("");
		$("#txtCod4Info").val("");
	}
}

function DeleteCie5Info()
{
	if($("#txtCie5Info").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie5Info").val("");
			$("#txtCod5Info").val("");
		}
	}
	else
	{
		$("#txtCie5Info").val("");
		$("#txtCod5Info").val("");
	}
}

function DeleteCie6Info()
{
	if($("#txtCie6Info").val() != "")
	{
		if(confirm("Esta seguro que desea borrar este diagnóstico ?"))
		{
			$("#txtCie6Info").val("");
			$("#txtCod6Info").val("");
		}
	}
	else
	{
		$("#txtCie6Info").val("");
		$("#txtCod6Info").val("");
	}
}
//fin borrar cie

//funcion para cargar los examnes del paciente que estan en pdf subidos por el usuario
function HExamenes(){
	/*
$("#DivLoadExamnesPdf").attr("title","Archivos de los pacientes");
	$( "#DivLoadExamnesPdf" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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
	$( "#DivLoadExamnesPdf" ).dialog( "open" );*/
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");

	$.ajax({
		url:'Procesar.php?accion=LoadFilePaciente&IdPacienteInfoIn='+$("#codigoPaciente").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
				},
				error:function()
				{
					$("#DivLoadExamnesPdf").html("error al cargar");
				}
			});
}
function SeeAllFile(pac,pos){
/*		//$("#Frm4").css("overflow-y","scroll");

$("#PrfirLoadFile").attr("title","Archivos de los pacientes");
	$( "#PrfirLoadFile" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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
	$( "#PrfirLoadFile" ).dialog( "open" );*/

		$.ajax({
			url:'Procesar.php?accion=SeeAllFile&PacietId='+pac+'&pos='+pos,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});	
}
function SeeList(pac,pos){
/*	$("#SegSecLoadFile").attr("title","Archivos de los pacientes");
	$( "#SegSecLoadFile" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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
	$( "#SegSecLoadFile" ).dialog( "open" );
*/

		$.ajax({
			url:'Procesar.php?accion=SeeAllLista2&PacietId='+pac+'&pos='+pos,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp2").html(res);
			},
			error:function()
			{
				$(".Resp2").html("error al cargar");
			}
		});
}
//fin funcion para cargar los examnes del paciente que estan en pdf subidos por el usuario
function FileOrder(codigo){

        $.ajax({
            url:'Procesar.php?accion=HistoriTotalPdf&CdPacToPDF='+codigo,
            type:'GET',
            cache:false,
            success:function(res)
            {
                $(".Resp2").html(res);
            },
            error:function()
            {
                $(".Resp2").html("error al cargar");
            }
        });
}
//funcion para cargar los datos de anamnesis y epicrisis
function SeeAllAnamesis(codigo){
/*$("#LoadFileAnanamesis").attr("title","Lista de anamnesis del paciente");
	$( "#LoadFileAnanamesis" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:360,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#LoadFileAnanamesis" ).dialog( "open" );
*/

		$.ajax({
			url:'Procesar.php?accion=SeeAllListaAnamnesis&PacietId='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp3").html(res);
			},
			error:function()
			{
				$(".Resp3").html("error al cargar");
			}
		});
}
function VerAnamnesis(codigo){
/*$("#VerPdfAnamnesis").attr("title","Anamnesis");
	$( "#VerPdfAnamnesis" ).dialog({
			autoOpen: false,
			modal: true,
			height:600,
			width:800,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#VerPdfAnamnesis" ).dialog( "open" );*/
	$( ".modal-body" ).html("<object type='text/html' data='../Reportes/AnamnesisCdu2.php?code="+codigo+"'></object>");
}
function SeeAllEpicrisis(codigo){
$("#LoadFileEpiciris").attr("title","Lista de epicrisis del paciente");
	$( "#LoadFileEpiciris" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:360,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#LoadFileEpiciris" ).dialog( "open" );


		$.ajax({
			url:'Procesar.php?accion=SeeAllListaEpicrisis&PacietId='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#LoadFileEpiciris").html(res);
			},
			error:function()
			{
				$("#LoadFileEpiciris").html("error al cargar");
			}
		});
}
//





function ImprimirExp1(code){
	$("#ImprimirExpediente").attr("title","Expediente Único para la Historia Clínica");
	$( "#ImprimirExpediente" ).dialog({
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
		$( "#ImprimirExpediente" ).dialog( "open" );	
		$( "#ImprimirExpediente" ).html("<object type='text/html' data='../Reportes/ExpedienteCdu2.php?id="+code+"'></object>");	
}



function PrintRECELih(code){
	//SaveAnanmesisCdu();

	setTimeout(function(){
	
	/*$("#ImpReceTaVDe").attr("title","Receta");
	$( "#ImpReceTaVDe" ).dialog({
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
		$( "#ImpReceTaVDe" ).dialog( "open" );	*/
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/ImpCitaVDes.php?id="+code+"'></object>");

	},1000);	


}

//Imprimir informe interconsulta
function PrintInforme()
{
	/*SaveInforme();
	$("#PrintInformeInterconsulta").attr("title","Informe - Interconsulta");
    $( "#PrintInformeInterconsulta" ).dialog({
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
    $( "#PrintInformeInterconsulta" ).dialog( "open" );*/
    $( ".modal-body" ).html("<object type='text/html' data='../Reportes/InformeInterconsulta.php?idPac="+$('#codigoPaciente').val()+"'></object>");
}
//Fin imprimir informe interconsulta


function AgendaCirugia(){
	/*$("#AgendaCirugiaLight").attr("title","Agenda Cirugia");
    $( "#AgendaCirugiaLight" ).dialog({
            autoOpen: false,
            modal: true,
            height:700,
            width:1200,
            show: {
                effect: "slide",
                duration: 1000
            },
            hide: {
                effect: "drop",
                duration: 1000
            }
        });
    $( "#AgendaCirugiaLight" ).dialog( "open" );*/
    Home();
    $(".Cabe1").html("<table class='table table-bordered table-condensend table-striped table-hover'><tr><th colspan=''><center>Agenda Medicos</center></th></tr><tr><th><center><div id='arecmb1'></div><div id='arecmb2'></div></center></th></tr><tr><th><center><a href='#' class='btn btn-succes' onclick='Back();'><i class='icon-backward'></i> </a> <a href='#' class='btn btn-succes' onclick='Next();'><i class='icon-forward'></i></a></center></th></tr></table> <div id='RespsAgend'> </div> <input type='hidden' id='txtadelante'> <input type='hidden' id='txtatras'>");	
    LoadCombos();
}
function LoadCombos(){
	
	fechact=new Date();
		year=fechact.getFullYear();
		firstyear=2010;
		endyear=parseInt(year);
		numyear=endyear-firstyear;
		numyear=numyear+1;
		cabselec="Año:<select id='CmbAnio'><option value=''>--Seleccione--</option>";
		pieselec="</select>";
		cuerselec="";
		for(x=0;x<=numyear;x++){
			aux=firstyear+x;
			cuerselec+="<option>"+aux+"</option>";
		}
		combo=cabselec+cuerselec+pieselec; 
	
		$("#arecmb1").html(""+combo+"");

		$("#arecmb2").html("Mes: <select id='cmb_mes' onchange='LoadAgendaCirugia()'><option value=''>--Seleccione--</option><option value='1'>Enero</option><option value='2'>Febrero</option><option value='3'>Marzo</option><option value='4'>Abril</option><option value='5'>Mayo</option><option value='6'>Junio</option><option value='7'>Julio</option><option value='8'>Agosto</option><option value='9'>Septiembre</option><option value='10'>Octubre</option><option value='11'>Noviembre</option><option value='12'>Diciembre</option></select>");	
}

 function LoadAgendaCirugia(){
 			if($("#CmbAnio").val()!="" & $("#cmb_mes").val()!=""){
	 			
				var m=$("#cmb_mes").val();
				$("#txtatras").val(""+m+"");
				$.ajax({
						url:'Procesar.php?accion=LoadAgendaCirugia2&aa='+$("#CmbAnio").val()+'&mm='+$("#cmb_mes").val(),
						type:'GET',
						cache:false,
						success:function(res)
						{
							$(".Resp1").html(res);
						},
						error:function()
						{
							$(".Resp1").html("error al cargar");
						}
				});	
 			}else{
 				alert("Seleccione un mes y año para poder visualizar la agenda");
 			}
 }
 function Next(){
	var aux=parseInt($("#txtatras").val());
	aux=aux+1;
	if(aux<=12){
		$('#cmb_mes').prop('selectedIndex',aux);
		$("#txtatras").val(""+aux+"");
		$.ajax({
						url:'Procesar.php?accion=LoadAgendaCirugia2&aa='+$("#CmbAnio").val()+'&mm='+aux,
						type:'GET',
						cache:false,
						success:function(res)
						{
							$("#RespsAgend").html(res);
						},
						error:function()
						{
							$("#RespsAgend").html("error al cargar");
						}
				});
	}

 }
 function Back(){
	var aux=parseInt($("#txtatras").val());
	aux=aux-1;
	if(aux>=1){
		$('#cmb_mes').prop('selectedIndex',aux);
		$("#txtatras").val(""+aux+"");
		$.ajax({
						url:'Procesar.php?accion=LoadAgendaCirugia2&aa='+$("#CmbAnio").val()+'&mm='+aux,
						type:'GET',
						cache:false,
						success:function(res)
						{
							$("#RespsAgend").html(res);
						},
						error:function()
						{
							$("#RespsAgend").html("error al cargar");
						}
				});
	}
 }

  function RedactarDatos(codigo){
	/*$("#CitaCiru").attr("title","Cita Cirugia");
	$( "#CitaCiru" ).dialog({
			autoOpen: false,
			modal: true,
			height:650,
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
		$( "#CitaCiru" ).dialog( "open" );	*/ 	
		$.ajax({
						url:'Procesar.php?accion=LoadCitaAgendaCirugia2&code='+codigo,
						type:'GET',
						cache:false,
						success:function(res)
						{
							$(".modal-body").html(res);
						},
						error:function()
						{
							$(".modal-body").html("error al cargar");
						}
				});	
 }
  function ImpCitaEmergenci(code){
 	/*$("#PdfCitaCirug").attr("title","Cita Cirugia");
	$( "#PdfCitaCirug" ).dialog({
			autoOpen: false,
			modal: true,
			height:650,
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
		$( "#PdfCitaCirug" ).dialog( "open" );*/
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/CitaCirugiaImp.php?code="+code+"'></object>");
 }

 
 
 //Imprimir receta solicitud interconsulta
function PrintReceSoli(code){
	///SaveSolucitud();

	setTimeout(function(){
	
	/*$("#ImpReceSolicitud").attr("title","Receta");
	$( "#ImpReceSolicitud" ).dialog({
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
		$( "#ImpReceSolicitud" ).dialog( "open" );	*/
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/RecetaSolicitudIn.php?id="+code+"'></object>");

	},1000);	


}
//Fin imprimir receta solicitud interconsulta

//Imprimir receta informe interconsulta
function PrintReceInfo(code){
	//SaveInforme();

	setTimeout(function(){
	
/*	$("#ImpReceInforme").attr("title","Receta");
	$( "#ImpReceInforme" ).dialog({
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
		$( "#ImpReceInforme" ).dialog( "open" );	*/
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/RecetaInformeIn.php?id="+code+"'></object>");

	},1000);	


}
//Fin imprimir receta informe interconsulta

//Imprimir receta epicrisis
function PrintReceEpi(code){
	//SaveEpicrisis();

	setTimeout(function(){
	
	/*$("#ImpReceEpicrisis").attr("title","Receta");
	$( "#ImpReceEpicrisis" ).dialog({
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
		$( "#ImpReceEpicrisis" ).dialog( "open" );	*/
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/RecetaEpicrisis.php?id="+code+"'></object>");

	},1000);	


}
//Fin imrpimir receta epicrisis

// --------------------- Medicamentos --------------------- //
//Epicrisis
function datosvademecun2()
{
	/*$("#AreaVademecun").attr("title","Vademecum");
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
		$("#AreaVademecun").dialog( "open");*/
		
	$.ajax({
				url:'Procesar.php?accion=VademecunCargar22',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
				}
			});
		
}

function CodigoVademecum22(codigo)
{
	$.ajax({
				url:'Procesar.php?accion=recetarvademecun2&codvade2='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					var ant=$("#txtrestraterepi").val();
					var con=ant+"  \n"+res;
					$("#txtrestraterepi").attr("value",""+con+"");
					$("#AreaVademecun").dialog( "close");
				},
				error:function()
				{
					//$("#AreaVademecun").html("error al cargar");
				}
			});
				
				
}

//Solicitud interconsulta
function datosvademecun3()
{
	/*$("#AreaVademecun").attr("title","Vademecum");
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
		$("#AreaVademecun").dialog( "open");*/
		
	$.ajax({
				url:'Procesar.php?accion=VademecunCargar3',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
				}
			});
		
}

function CodigoVademecum3(codigo)
{
	$.ajax({
				url:'Procesar.php?accion=recetarvademecun3&codvade3='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					var ant=$("#txtPlanTe").val();
					var con=ant+"  \n"+res;
					$("#txtPlanTe").attr("value",""+con+"");
					$("#AreaVademecun").dialog( "close");
				},
				error:function()
				{
					//$("#AreaVademecun").html("error al cargar");
				}
			});
				
				
}

//Informe interconsulta
function datosvademecun4()
{
	/*$("#AreaVademecun").attr("title","Vademecum");
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
		*/
	$.ajax({
				url:'Procesar.php?accion=VademecunCargar4',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
				}
			});
		
}

function CodigoVademecum4(codigo)
{
	$.ajax({
				url:'Procesar.php?accion=recetarvademecun4&codvade4='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					var ant=$("#PlanTeProInfo").val();
					var con=ant+"  \n"+res;
					$("#PlanTeProInfo").attr("value",""+con+"");
					$("#AreaVademecun").dialog( "close");
				},
				error:function()
				{
					//$("#AreaVademecun").html("error al cargar");
				}
			});
				
				
}

//Subsecuente
function datosvademecun5()
{
	/*$("#AreaVademecun").attr("title","Vademecum");
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
		$("#AreaVademecun").dialog( "open");*/
		
	$.ajax({
				url:'Procesar.php?accion=VademecunCargar5',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
				}
			});
		
}

function CodigoVademecum5(codigo)
{
	$.ajax({
				url:'Procesar.php?accion=recetarvademecun5&codvade5='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					var ant=$("#txtPrescriSub").val();
					var con=ant+"  \n"+res;
					$("#txtPrescriSub").attr("value",""+con+"");
					$("#AreaVademecun").dialog( "close");
				},
				error:function()
				{
					//$("#AreaVademecun").html("error al cargar");
				}
			});
				
				
}
//Fin medicamentos


//
// logica para protocolo operatorio
//
function LoadCitasCirugiaXDoc(){
			$.ajax({
				url:'Procesar.php?accion=LoadCitasCirugiaXDoc',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#CitasCirugia").html(res);
				},
				error:function()
				{
					$("#CitasCirugia").html("error al cargar");
				}
			});	
}


 function protooperatorio(code){
 	$("#ProtOper").attr("title","Protocolo Operatorio");
	$( "#ProtOper" ).dialog({
			autoOpen: false,
			modal: true,
			height:650,
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
		$( "#ProtOper" ).dialog( "open" );
		$( "#ProtOper" ).html("<table class='table table-bordered table-striped table-condensend table-hover'> <tr> <td>PROTOCOLO OPERTATORIO</td> <td>&nbsp;</td> <td colspan='8'>CLINICA DE URULOGIA Y ESPECIALIDADES</td> </tr> <tr> <td colspan='8'>NOMBRE: </td> <td colspan='2'>CEDULA: </td> </tr> <tr> <td colspan='10'><div align='center'>A. DIAGNOSTICO</div></td> </tr> <tr> <td>PRE-OPERATORIO:</td> <td colspan='9'>&nbsp;</td> </tr> <tr> <td>POST-OPERATORIO:</td> <td colspan='9'>&nbsp;</td> </tr> <tr> <td>CIRUGIA EFECTUADA: </td> <td colspan='9'>&nbsp;</td> </tr> <tr> <td colspan='10'>&nbsp;</td> </tr> <tr> <td colspan='10'><div align='center'>B. EQUIPO OPERATORIO</div></td> </tr> <tr> <td colspan='5'>CIRUJANO:</td> <td colspan='5'>ANESTESIOLOGO:</td> </tr> <tr> <td colspan='5'>COCIRUJANO:</td> <td colspan='5'>INSTRUMENTISTA:</td> </tr> <tr> <td colspan='5'>PRIMER AYUDANTE:</td> <td colspan='5'>CIRCULANTE:</td> </tr> <tr> <td colspan='10'>&nbsp;</td> </tr> <tr> <td>C. FECHA CIRUGIA </td> <td>H. INICIO</td> <td>D. TIPO DE ANESTESIA </td> <td colspan='7'>E. TIEMPO QUIRURGICO. </td> </tr> <tr> <td>&nbsp;</td> <td>&nbsp;</td> <td><select name='cmbanestes' id='cmbanestes'> </select></td> <td colspan='7'>&nbsp;</td> </tr> <tr> <td colspan='10'><div align='center'>F. PROTOCOLO OPERATORIO </div></td> </tr> <tr> <td colspan='10'>HALLAZGOS</td> </tr> <tr> <td colspan='10'><input type='text' id='txthalla1' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txthalla2' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txthalla3' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txthalla4' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txthalla5' class='span8'/></td> </tr> <tr> <td colspan='10'>PROCEDIMIENTOS</td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce1' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce2' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce3' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce4' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce5' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce6' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce7' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce8' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce9' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce10' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce11' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce12' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce13' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce14' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce15' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce16' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce17' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce18' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce19' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce20' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce21' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce22' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce23' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce24' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtproce25' class='span8'/></td> </tr> <tr> <td colspan='10'>&nbsp;</td> </tr> <tr> <td colspan='10'><input type='text' id='txtop1' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop2' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop3' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop4' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop5' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop6' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop7' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop8' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop9' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop10' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop11' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop12' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop13' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop14' class='span8'/></td> </tr> <tr> <td colspan='10'><input type='text' id='txtop15' class='span8'/></td> </tr> <tr> <td colspan='2'>PREPARADO POR: </td> <td>FECHA: </td> <td colspan='3'>APROBADO POR:</td> <td colspan='4'>FECHA: </td> </tr> <tr> <td colspan='10'><center><input type='button' class='btn btn-success' id='saveprotoope' value='Guardar' /> <input type='button' class='btn btn-primary' id='cancelprotoope' value='Cancelar'/></center></td> </tr> </table>");
 }


//
//fin  logica para protocolo operatorio
//

//Registyro trnas-anestesico
function transanestesico(code){
 	$("#RegTransAnest").attr("title","Registro Trans - Anestésico");
	$( "#RegTransAnest" ).dialog({
			autoOpen: false,
			modal: true,
			height:1200,
			width:1200,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#RegTransAnest" ).dialog( "open" );
		$( "#RegTransAnest" ).html("<table class='table table-bordered table-striped table-condensend table-hover' > <tr> <td colspan='4' style='text-align:center'>Nombre</td> <td colspan='2' style='text-align:center'>Historia clínica</td> </tr> <tr> <td colspan='4' style='text-align:center' ><input type='text' class='span4' id='txtnombre'/></td> <td colspan='2' style='text-align:center'><input type='text' class='span2' id='txthistoria'/></td> </tr> <tr> <td style='text-align:center'>Fecha</td> <td  colspan='2' style='text-align:center'>Edad</td> <td style='text-align:center'>Sexo</td> <td style='text-align:center'>Estatura</td> <td style='text-align:center'>Peso</td> </tr> <tr> <td style='text-align:center'><input type='text' class='span2' id='txtfecha' /></td> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtedad'/></td> <td style='text-align:center'><input type='text' class='span2' id='txtsexo'/></td> <td style='text-align:center'><input type='text' class='span2' id='txtestatura'/></td> <td style='text-align:center'><input type='text' class='span2' id='txtpeso'/></td> </tr> <tr> <td colspan='2' style='text-align:center'>Ocupación actual</td> <td colspan='2' style='text-align:center'>Servicio</td> <td style='text-align:center'>Sala </td> <td style='text-align:center'>Cama</td> </tr> <tr> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtocupacion'/></td> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtservicio'/></td> <td style='text-align:center'><input type='text' class='span2' id='txtsala'/></td> <td style='text-align:center'><input type='text' class='span2' id='txtcama'/></td> </tr> <tr> <td  colspan='2' style='text-align:center'>Diagnóstico preoperatorio</td> <td colspan='2' style='text-align:center'>Diagnóstico post-operatorio</td> <td colspan='2' style='text-align:center'>Operación propuesta</td> </tr> <tr> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtpreoperatorio'/></td> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtpostoperatorio'/></td> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtoperacion'/></td> </tr> <tr> <td colspan='2' style='text-align:center'>Cirujano</td> <td colspan='2' style='text-align:center'>Ayudantes</td> <td colspan='2' style='text-align:center'>Opración realizada</td> </tr> <tr> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtcirujano'/></td> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtayudante'/></td> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtrealizada'/></td> </tr> <tr> <td colspan='2' style='text-align:center'>Anestesiólogo</td> <td colspan='2' style='text-align:center'>Ayudantes</td> <td  colspan='2' style='text-align:center'>Instrumentista</td> </tr> <tr> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtanestesiologo'/></td> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtayudante'/></td> <td colspan='2' style='text-align:center'><input type='text' class='span3' id='txtinstrumentista'/></td> </tr></table><table class='table table-bordered table-striped table-condensend table-hover' ><tr><td colspan='6' style='text-align:center'><b>REGISTRO TRANS - ANESTÉSICO</b></td></tr> </table> <table class='table table-bordered table-striped table-condensend table-hover' > <tr> <td><div id='canvas'></div></td> </tr> </table> <table class='table table-bordered table-striped table-hover table-condensed ' > <tr><td colspan='2'>Tipo</td><td colspan='2' style='text-align:center'>Tiempos</td></tr><tr> <td width='8'>1</td> <td width='710'><input type='text' id='txtVademe1' style='width:710px;' onclick='' /></td> <td colspan='2' style='text-align:center'>Duración Anestesia</td> </tr> <tr> <td>2</td> <td><input type='text' id='txtVademe2' style='width:710px;' onclick='' /></td><td width='113' style='text-align:center'>Hs.</td> <td width='113' style='text-align:center'>Min.</td> </tr> <tr> <td>3</td> <td><input type='text' id='txtVademe3' style='width:710px;' onclick='' /></td><td style='text-align:center'><select id='horasan' style='width:120px'><option>--Selecione--</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option></select></td><td><select id='minsan' style='width:120px'><option>--Selecione--</option><option>15</option><option>30</option><option>45</option></select></td> </tr> <tr> <td>4</td> <td><input type='text' id='txtVademe4' style='width:710px;' onclick='' /></td><td style='text-align:center' colspan='2'>Duración de la Operación</td> </tr> <tr> <td>5</td> <td><input type='text' id='txtVademe5' style='width:710px;' onclick='' /></td><td style='text-align:center'>Hs.</td> <td style='text-align:center'>Min.</td>  </tr> <tr> <td>6</td> <td><input type='text' id='txtVademe6' style='width:710px;' onclick='' /></td><td style='text-align:center'><select id='horasop' style='width:120px'><option>--Selecione--</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option><option>16</option><option>17</option><option>18</option><option>19</option><option>20</option><option>21</option><option>22</option><option>23</option><option>24</option></select> </td><td style='text-align:center'><select id='minop' style='width:120px'><option>--Selecione--</option><option>15</option><option>30</option><option>45</option></select></td> </tr> </table> </td> </tr> </table> <!--4--> ");
		

		var x=0;
		var y=0;
		var grafico="";
		for(x=1;x<=23;x++){
			for(y=1;y<=60;y++){
				grafico=grafico+"<div id='cuadro-"+x+"-"+y+"' class='cuadrados' onclick='cargarsimbolo("+x+","+y+")'></div>";
			}
			grafico=grafico+"</br>";

		}
		$('#canvas').html(grafico);
 }
//Fin registro trans-anestesi

function cargarsimbolo(cod1,cod2)
{
	$("#cuadro-"+cod1+"-"+cod2+"").html("<img src='resource/max.jpg'>");
	
}


 function VerificarCI(){
    var numci=$("#txtcedulaUsu1").val();
    if(numci.length>9){
        $.ajax({
                    url:'Procesar.php?accion=ComprovandoCIDB&CedulaPac1='+$('#txtcedulaUsu1').val(),
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                        //$("#RespuestaNewPaciente").html(res);
                        var num = parseInt(res);
                        if(num>0){
                            alert("Esta Cedula Ya Existe en la base de datos");
                            $("#bntSaveUsu1").attr("disabled",true);
                            $(".Resp1").html("");
                        }
                        else{
                            $("#bntSaveUsu1").removeAttr("disabled",false);
                        }
                    },
                    error:function()
                    {
                        $(".Resp1").html("error al cargar");

                    }
                }); 
    }
}

function SeeAllSolicEpi(code){
	/* $("#SolicituInterconsulta").attr("title","Lista de solicitud de interconsulta");
	$( "#SolicituInterconsulta" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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
		$( "#SolicituInterconsulta" ).dialog( "open" );
*/

	 $.ajax({
                    url:'Procesar.php?accion=HistorialSolicitudInterconsulta&codePac='+code,
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                     $(".Resp3").html(res);
                    },
                    error:function()
                    {
                        $(".Resp3").html("error al cargar");

                    }
         }); 	
}
function SoliciConsuVer(t,pc){
 /*$("#ImpSolicituInterconsulta").attr("title","Solicitud de interconsulta");
	$( "#ImpSolicituInterconsulta" ).dialog({
			autoOpen: false,
			modal: true,
			height:1200,
			width:1200,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#ImpSolicituInterconsulta" ).dialog( "open" );	*/
		//$( "#ImpSolicituInterconsulta" ).html("<object type='text/html' data='../Reportes/SolicitudInterconsulta2.php?idPac="+pc+"&id="+t+"'></object>");
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/SolicitudInterconsulta.php?idPac="+pc+"&id="+t+"'></object>");
}
function SeeAllInfoSolic(code){
/*	$("#InfoInterconsulta").attr("title","Solicitud de interconsulta");
	$( "#InfoInterconsulta" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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
		$( "#InfoInterconsulta" ).dialog( "open" );	*/

		$.ajax({
                    url:'Procesar.php?accion=HistorialInfoInterconsulta&codePac='+code,
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                            $(".Resp3").html(res);
                    },
                    error:function()
                    {
                        $(".Resp3").html("error al cargar");

                    }
         }); 	
}
function VerInfoIntercons(t,pc){
/*$("#ImpInfoInterconsulta").attr("title","Solicitud de interconsulta");
	$( "#ImpInfoInterconsulta" ).dialog({
			autoOpen: false,
			modal: true,
			height:1200,
			width:1200,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#ImpInfoInterconsulta" ).dialog( "open" );	*/
		//$( ".modal-body" ).html("<object type='text/html' data='../Reportes/InformeInterconsulta2.php?idPac="+pc+"&id="+t+"'></object>");
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/InformeInterconsulta.php?idPac="+pc+"&id="+t+"'></object>");
}


function ComprobarFecha(code){
	
		$.ajax({
				url:'Procesar.php?accion=ComprobarFechavencimiento&IDPAC='+code,
				type:'GET',
				cache:false,
				success:function(res)
				{
					var num=parseInt(res);
					if (num>=1) {

						/*$( "#frmdoct01" ).attr("title","Alerta");
						$( "#AlertaFechaVencimiento" ).dialog({
							autoOpen: false,
							modal: true,
							height:300,
							width:600,
							show: {
								effect: "shake",
								duration: 1000
							},
							hide: {
								effect: "explode",
								duration: 1000
							}
						});

						$( "#AlertaFechaVencimiento" ).dialog( "open" );*/
						$( ".modal-body" ).html("<center><div class='alert alert-error'><h2>Alerta la fecha de autorizacion a caducado</h2></div></center>");
					}

				},
				error:function()
				{
					$("#AlertaFechaVencimiento").html("error al cargar");
				}
			});	
}
function BuscarProtocolos(){
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td> <center><h4>Buscar Cita De Cirugia Para Iniciar Protocolo Opertario</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span12' id='txtBuscarVerProto'  onkeypress='BuscarPacienteVerProt();'  type='text'> <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a> </div> </center> </td> </tr> </table>");
}




//Funciones de Hospitalizacion * Author -> Lesnier Gonzalez

//Cargar y Mostrar tabla de anamnesis de hospitalizacion
function LoadAnamnesisHospitali(nueva) {

	$(".Resp2").html("");
	$.ajax({
		url: 'Procesar.php?accion=LoadAnamnesisHospitali&CodigoPac2=' + $("#codigoPaciente").val()+'&Nueva='+nueva,
		type: 'GET',
		cache: false,
		success: function (res) {
			$(".Resp2").html(res);
		},
		error: function () {
			$(".Resp2").html("error al cargar");
		}
	});

    $(".Resp3").html("");

}
//Guardar o Actualizar anamnesis Hospitalizacion

function SaveAnamnesisHospitalizacion(gestion)
{
	
	
	    CduPac=  $('#CduPac').val();
		id_pac=  $('#codigoPaciente').val();
		MotivoConsA=  $('#MotivoConsA').val();
		MotivoConsB=  $('#MotivoConsB').val();
		MotivoConsC=  $('#MotivoConsC').val();
		MotivoConsD=  $('#MotivoConsD').val();
		cb_vacunas=  $('#cb_vacunas').prop('checked');
		cb_alergica=  $('#cb_alergica').prop('checked');
		cb_neurologica=  $('#cb_neurologica').prop('checked');
		cb_traumatologica=  $('#cb_traumatologica').prop('checked');
		cb_tendsexual=  $('#cb_tendsexual').prop('checked');
		cb_actsexual=  $('#cb_actsexual').prop('checked');
		cb_perinatal=  $('#cb_perinatal').prop('checked');
		cb_cardiaca=  $('#cb_cardiaca').prop('checked');
		cb_metabolica=  $('#cb_metabolica').prop('checked');
		cb_quirurgica=  $('#cb_quirurgica').prop('checked');
		cb_riesgosocial=  $('#cb_riesgosocial').prop('checked');
		cb_dietahabitos=  $('#cb_dietahabitos').prop('checked');
		cb_infancia=  $('#cb_infancia').prop('checked');
		cb_respiratoria=  $('#cb_respiratoria').prop('checked');
		cb_hemolinf=  $('#cb_hemolinf').prop('checked');
		cb_mental=  $('#cb_mental').prop('checked');
		cb_riesgolaboral=  $('#cb_riesgolaboral').prop('checked');
		cb_religioncultura=  $('#cb_religioncultura').prop('checked');
		cb_adolecente=  $('#cb_adolecente').prop('checked');
		cb_digestiva=  $('#cb_digestiva').prop('checked');
		cb_urinaria=  $('#cb_urinaria').prop('checked');
		cb_tsexual=  $('#cb_tsexual').prop('checked');
		cb_riesgofamiliar=  $('#cb_riesgofamiliar').prop('checked');
		cb_otro=  $('#cb_otro').prop('checked');
		txtAntePer=  $('#txtAntePer').val();
		cb_cardiopatia=  $('#cb_cardiopatia').prop('checked');
		cb_diabetes=  $('#cb_diabetes').prop('checked');
		cb_enfvasculares=  $('#cb_enfvasculares').prop('checked');
		cb_hta=  $('#cb_hta').prop('checked');
		cb_cancer=  $('#cb_cancer').prop('checked');
		cb_tuberculosis=  $('#cb_tuberculosis').prop('checked');
		cb_enfenfmental=  $('#cb_enfenfmental').prop('checked');
		cb_enfinfecciosa=  $('#cb_enfinfecciosa').prop('checked');
		cb_malformacion=  $('#cb_malformacion').prop('checked');
		cb_afotro=  $('#cb_afotro').prop('checked');
		txtNoRef=  $('#txtNoRef').val();
		txtProbActual=  $('#txtProbActual').val();
		cb_1CP=  $('#cb_1CP').prop('checked');
		cb_1SP=  $('#cb_1SP').prop('checked');
		cb_3CP=  $('#cb_3CP').prop('checked');
		cb_3SP=  $('#cb_3SP').prop('checked');
		cb_5CP=  $('#cb_5CP').prop('checked');
		cb_5SP=  $('#cb_5SP').prop('checked');
		cb_7CP=  $('#cb_7CP').prop('checked');
		cb_7SP=  $('#cb_7SP').prop('checked');
		cb_9CP=  $('#cb_9CP').prop('checked');
		cb_9SP=  $('#cb_9SP').prop('checked');
		cb_2CP=  $('#cb_2CP').prop('checked');
		cb_2SP=  $('#cb_2SP').prop('checked');
		cb_4CP=  $('#cb_4CP').prop('checked');
		cb_4SP=  $('#cb_4SP').prop('checked');
		cb_6CP=  $('#cb_6CP').prop('checked');
		cb_6SP=  $('#cb_6SP').prop('checked');
		cb_8CP=  $('#cb_8CP').prop('checked');
		cb_8SP=  $('#cb_8SP').prop('checked');
		cb_10CP=  $('#cb_10CP').prop('checked');
		cb_10SP=  $('#cb_10SP').prop('checked');
		txtRevisOrgs=  $('#txtRevisOrgs').val();
		ta=  $('#ta').val();
		fc=  $('#fc').val();
		fr=  $('#fr').val();
		sato2=  $('#sato2').val();
		tempbuc=  $('#tempbuc').val();
		peso=  $('#peso').val();
		glucem=  $('#glucem').val();
		talla=  $('#talla').val();
		gm=  $('#gm').val();
		go=  $('#go').val();
		gv=  $('#gv').val();
		cb_1RCP=  $('#cb_1RCP').prop('checked');
		cb_1RSP=  $('#cb_1RSP').prop('checked');
		cb_6RCP=  $('#cb_6RCP').prop('checked');
		cb_6RSP=  $('#cb_6RSP').prop('checked');
		cb_11RCP=  $('#cb_11RCP').prop('checked');
		cb_11RSP=  $('#cb_11RSP').prop('checked');
		cb_1SCP=  $('#cb_1SCP').prop('checked');
		cb_1SSP=  $('#cb_1SSP').prop('checked');
		cb_6SCP=  $('#cb_6SCP').prop('checked');
		cb_6SSP=  $('#cb_6SSP').prop('checked');
		cb_2RCP=  $('#cb_2RCP').prop('checked');
		cb_2RSP=  $('#cb_2RSP').prop('checked');
		cb_7RCP=  $('#cb_7RCP').prop('checked');
		cb_7RSP=  $('#cb_7RSP').prop('checked');
		cb_12RCP=  $('#cb_12RCP').prop('checked');
		cb_12RSP=  $('#cb_12RSP').prop('checked');
		cb_2SCP=  $('#cb_2SCP').prop('checked');
		cb_2SSP=  $('#cb_2SSP').prop('checked');
		cb_7SCP=  $('#cb_7SCP').prop('checked');
		cb_7SSP=  $('#cb_7SSP').prop('checked');
		cb_3RCP=  $('#cb_3RCP').prop('checked');
		cb_3RSP=  $('#cb_3RSP').prop('checked');
		cb_8RCP=  $('#cb_8RCP').prop('checked');
		cb_8RSP=  $('#cb_8RSP').prop('checked');
		cb_13RCP=  $('#cb_13RCP').prop('checked');
		cb_13RSP=  $('#cb_13RSP').prop('checked');
		cb_3SCP=  $('#cb_3SCP').prop('checked');
		cb_3SSP=  $('#cb_3SSP').prop('checked');
		cb_8SCP=  $('#cb_8SCP').prop('checked');
		cb_8SSP=  $('#cb_8SSP').prop('checked');
		cb_4RCP=  $('#cb_4RCP').prop('checked');
		cb_4RSP=  $('#cb_4RSP').prop('checked');
		cb_9RCP=  $('#cb_9RCP').prop('checked');
		cb_9RSP=  $('#cb_9RSP').prop('checked');
		cb_14RCP=  $('#cb_14RCP').prop('checked');
		cb_14RSP=  $('#cb_14RSP').prop('checked');
		cb_4SCP=  $('#cb_4SCP').prop('checked');
		cb_4SSP=  $('#cb_4SSP').prop('checked');
		cb_9SCP=  $('#cb_9SCP').prop('checked');
		cb_9SSP=  $('#cb_9SSP').prop('checked');
		cb_5RCP=  $('#cb_5RCP').prop('checked');
		cb_5RSP=  $('#cb_5RSP').prop('checked');
		cb_10RCP=  $('#cb_10RCP').prop('checked');
		cb_10RSP=  $('#cb_10RSP').prop('checked');
		cb_15RCP=  $('#cb_15RCP').prop('checked');
		cb_15RSP=  $('#cb_15RSP').prop('checked');
		cb_5sCP=  $('#cb_5sCP').prop('checked');
		cb_5sSP=  $('#cb_5sSP').prop('checked');
		cb_10sCP=  $('#cb_10sCP').prop('checked');
		cb_10sSP=  $('#cb_10sSP').prop('checked');
		txtExaFisico=  $('#txtExaFisico').val();
		txtCie1=  $('#txtCie1').val();
		txtCod1=  $('#txtCod1').val();
		cb_1PRE=  $('#cb_1PRE').prop('checked');
		cb_1DEF=  $('#cb_1DEF').prop('checked');
		txtCie4=  $('#txtCie4').val();
		txtCod4=  $('#txtCod4').val();
		cb_4PRE=  $('#cb_4PRE').prop('checked');
		cb_4DEF=  $('#cb_4DEF').prop('checked');
		txtCie2=  $('#txtCie2').val();
		txtCod2=  $('#txtCod2').val();
		cb_2PRE=  $('#cb_2PRE').prop('checked');
		cb_2DEF=  $('#cb_2DEF').prop('checked');
		txtCie5=  $('#txtCie5').val();
		txtCod5=  $('#txtCod5').val();
		cb_5PRE=  $('#cb_5PRE').prop('checked');
		cb_5DEF=  $('#cb_5DEF').prop('checked');
		txtCie3=  $('#txtCie3').val();
		txtCod3=  $('#txtCod3').val();
		cb_3PRE=  $('#cb_3PRE').prop('checked');
		cb_3DEF=  $('#cb_3DEF').prop('checked');
		txti3=  $('#txti3').val();
		txtic3=  $('#txtic3').val();
		cb_6PRE=  $('#cb_6PRE').prop('checked');
		cb_6DEF=  $('#cb_6DEF').prop('checked');
		txtPlanTrat=  $('#txtPlanTrat').val();
		txtFechaAgendDoct=  $('#txtFechaAgendDoct').val();
		nombremedico=  $('#nombremedico').val();
		firmaDoc=  $('#firmaDoc').val();
	
  
	$(".Resp2").html("");
	$.ajax({
		url: 'Procesar.php?accion=SaveAnamnesisHospitali&'+ 
		'CduPac=' + CduPac +
		'&id_pac=' + id_pac+
		'&MotivoConsA=' +MotivoConsA+
		'&MotivoConsB=' + MotivoConsB+
		'&MotivoConsC=' + MotivoConsC+
		'&MotivoConsD=' + MotivoConsD+
		'&cb_vacunas=' + cb_vacunas+
		'&cb_alergica=' + cb_alergica+
		'&cb_neurologica=' +cb_neurologica+
		'&cb_traumatologica=' + cb_traumatologica+
		'&cb_tendsexual=' + cb_tendsexual+
		'&cb_actsexual=' +cb_actsexual+
		'&cb_perinatal=' +cb_perinatal+
		'&cb_cardiaca=' +cb_cardiaca+
		'&cb_metabolica=' + cb_metabolica+
		'&cb_quirurgica=' + cb_quirurgica+
		'&cb_riesgosocial=' +cb_riesgosocial+
		'&cb_dietahabitos=' + cb_dietahabitos+
		'&cb_infancia=' + cb_infancia+
		'&cb_respiratoria=' + cb_respiratoria+
		'&cb_hemolinf=' +cb_hemolinf+
		'&cb_mental=' +cb_mental+
		'&cb_riesgolaboral=' + cb_riesgolaboral+
		'&cb_religioncultura=' + cb_religioncultura+
		'&cb_adolecente=' + cb_adolecente+
		'&cb_digestiva=' + cb_digestiva+
		'&cb_urinaria=' + cb_urinaria+
		'&cb_tsexual=' + cb_tsexual+
		'&cb_riesgofamiliar=' + cb_riesgofamiliar+
		'&cb_otro=' + cb_otro+
		'&txtAntePer=' + txtAntePer+
		'&cb_cardiopatia=' + cb_cardiopatia+
		'&cb_diabetes=' + cb_diabetes+
		'&cb_enfvasculares=' + cb_enfvasculares+
		'&cb_hta=' + cb_hta+
		'&cb_cancer=' +cb_cancer+
		'&cb_tuberculosis=' + cb_tuberculosis+
		'&cb_enfenfmental=' + cb_enfenfmental+
		'&cb_enfinfecciosa=' + cb_enfinfecciosa+
		'&cb_malformacion=' + cb_malformacion+
		'&cb_afotro=' + cb_afotro+
		'&txtNoRef=' + txtNoRef+
		'&txtProbActual=' + txtProbActual+
		'&cb_1CP=' + cb_1CP+
		'&cb_1SP=' + cb_1SP+
		'&cb_3CP=' + cb_3CP+
		'&cb_3SP=' + cb_3SP+
		'&cb_5CP=' + cb_5CP+
		'&cb_5SP=' + cb_5SP+
		'&cb_7CP=' + cb_7CP+
		'&cb_7SP=' + cb_7SP+
		'&cb_9CP=' + cb_9CP+
		'&cb_9SP=' + cb_9SP+
		'&cb_2CP=' + cb_2CP+
		'&cb_2SP=' + cb_2SP+
		'&cb_4CP=' + cb_4CP+
		'&cb_4SP=' + cb_4SP+
		'&cb_6CP=' + cb_6CP+
		'&cb_6SP=' + cb_6SP+
		'&cb_8CP=' + cb_8CP+
		'&cb_8SP=' + cb_8SP+
		'&cb_10CP=' +cb_10CP+
		'&cb_10SP=' +cb_10SP+
		'&txtRevisOrgs=' +txtRevisOrgs+
		'&ta=' +ta+
		'&fc=' +fc+
		'&fr=' +fr+
		'&sato2=' +sato2+
		'&tempbuc=' +tempbuc+
		'&peso=' +peso+
		'&glucem=' +glucem+
		'&talla=' +talla+
		'&gm=' +gm+
		'&go=' +go+
		'&gv=' +gv+
		'&cb_1RCP=' +cb_1RCP+
		'&cb_1RSP=' +cb_1RSP+
		'&cb_6RCP=' +cb_6RCP+
		'&cb_6RSP=' +cb_6RSP+
		'&cb_11RCP=' +cb_11RCP+
		'&cb_11RSP=' +cb_11RSP+
		'&cb_1SCP=' +cb_1SCP+
		'&cb_1SSP=' +cb_1SSP+
		'&cb_6SCP=' +cb_6SCP+
		'&cb_6SSP=' +cb_6SSP+
		'&cb_2RCP=' +cb_2RCP+
		'&cb_2RSP=' +cb_2RSP+
		'&cb_7RCP=' +cb_7RCP+
		'&cb_7RSP=' +cb_7RSP+
		'&cb_12RCP=' +cb_12RCP+
		'&cb_12RSP=' +cb_12RSP+
		'&cb_2SCP=' +cb_2SCP+
		'&cb_2SSP=' +cb_2SSP+
		'&cb_7SCP=' +cb_7SCP+
		'&cb_7SSP=' +cb_7SSP+
		'&cb_3RCP=' +cb_3RCP+
		'&cb_3RSP=' +cb_3RSP+
		'&cb_8RCP=' +cb_8RCP+
		'&cb_8RSP=' +cb_8RSP+
		'&cb_13RCP=' +cb_13RCP+
		'&cb_13RSP=' +cb_13RSP+
		'&cb_3SCP=' +cb_3SCP+
		'&cb_3SSP=' +cb_3SSP+
		'&cb_8SCP=' +cb_8SCP+
		'&cb_8SSP=' +cb_8SSP+
		'&cb_4RCP=' +cb_4RCP+
		'&cb_4RSP=' +cb_4RSP+
		'&cb_9RCP=' +cb_9RCP+
		'&cb_9RSP=' +cb_9RSP+
		'&cb_14RCP=' +cb_14RCP+
		'&cb_14RSP=' +cb_14RSP+
		'&cb_4SCP=' +cb_4SCP+
		'&cb_4SSP=' +cb_4SSP+
		'&cb_9SCP=' +cb_9SCP+
		'&cb_9SSP=' +cb_9SSP+
		'&cb_5RCP=' +cb_5RCP+
		'&cb_5RSP=' +cb_5RSP+
		'&cb_10RCP=' +cb_10RCP+
		'&cb_10RSP=' +cb_10RSP+
		'&cb_15RCP=' +cb_15RCP+
		'&cb_15RSP=' +cb_15RSP+
		'&cb_5sCP=' +cb_5sCP+
		'&cb_5sSP=' +cb_5sSP+
		'&cb_10sCP=' +cb_10sCP+
		'&cb_10sSP=' +cb_10sSP+
		'&txtExaFisico=' +txtExaFisico+
		'&txtCie1=' +txtCie1+
		'&txtCod1=' +txtCod1+
		'&cb_1PRE=' +cb_1PRE+
		'&cb_1DEF=' +cb_1DEF+
		'&txtCie4=' +txtCie4+
		'&txtCod4=' +txtCod4+
		'&cb_4PRE=' +cb_4PRE+
		'&cb_4DEF=' +cb_4DEF+
		'&txtCie2=' +txtCie2+
		'&txtCod2=' +txtCod2+
		'&cb_2PRE=' +cb_2PRE+
		'&cb_2DEF=' +cb_2DEF+
		'&txtCie5=' +txtCie5+
		'&txtCod5=' +txtCod5+
		'&cb_5PRE=' +cb_5PRE+
		'&cb_5DEF=' +cb_5DEF+
		'&txtCie3=' +txtCie3+
		'&txtCod3=' +txtCod3+
		'&cb_3PRE=' +cb_3PRE+
		'&cb_3DEF=' +cb_3DEF+
		'&txti3=' +txti3+
		'&txtic3=' +txtic3+
		'&cb_6PRE=' +cb_6PRE+
		'&cb_6DEF=' +cb_6DEF+
		'&txtPlanTrat=' +txtPlanTrat+
		'&txtFechaAgendDoct=' +txtFechaAgendDoct+
		'&nombremedico=' +nombremedico+
		'&firmaDoc=' +firmaDoc+
		'&gestion=' +gestion,
		type: 'GET',
		cache: false,
		success: function (res) {
			$(".Resp2").html(res);
		},
		error: function () {
			$(".Resp2").html("error al cargar");
		}
	});

}
	//Imprimir anamnesis de Hospitalización - Crear el PDF

function PrintAnamnesisHosp ()
{
   var id_pac = $("#codigoPaciente").val();
   var url =   $("#a_print").attr("href");
   url += "?Codigo="+ id_pac;
   window.open(url,'_blank'); 
   

}

	//Imprimir anamnesis de Hospitalización desde Archivos - Crear el PDF
function PrintAnamnesisHospHisto (id_anam_hosp)
{
   var id_pac = $("#codigoPaciente").val();
   var url =   $("#verFileHist").attr("href");
   url += "?Codigo="+ id_pac+"&IdAnamHosp="+id_anam_hosp;
   window.open(url,'_blank'); 
   

}

//Finalizar la anamnesis de Hospitalización ya cuando no allan mas cambios y se quiera guardar la planilla

function FinalizarAnamHosp(cod)
{
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");

	$.ajax({
		url: 'Procesar.php?accion=FinalizarAnamnHosp&idAnam=' + cod,
		type: 'GET',
		cache: false,
		success: function (res) {
			$(".Resp2").html(res);
		},
		error: function () {
			$(".Resp2").html("error al cargar");
		}
	});
}

//Listar todos los documentos de anamnesis de un paciente derterminado para revisar planillas anteriores
function ListFileAnamnHosp(codigo) {
	
	$.ajax({
		url: 'Procesar.php?accion=AllAnamesisHospFile&PacietId=' + codigo,
		type: 'GET',
		cache: false,
		success: function (res) {
			$(".Resp3").html(res);
		},
		error: function () {
			$(".Resp3").html("error al cargar");
		}
	});
}


	




