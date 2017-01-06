// JavaScript Document
$(document).ready(function()
{

 DataDoctor();
$("#Form5Search").hide();
$("#FormularioIniEF").show();
$("#Form2Search").hide();
$("#Form3Search").hide();
$("#Form4Search").hide();
$("#Form6Search").hide();
$("#Form7Search").hide();
$("#Form8Search").hide();

$("#Form9Search").hide();
$("#Form10Search").hide();
$("#Form11Search").hide();
$("#ActAnestesiologo").hide();
$("#Form16Search").hide();
$("#Form7Search").hide();
$("#FormSearchCirugia").hide();
$("#Frm1").hide();
$("#FrmVerInicProtocolos").hide();
$("#FrmMkEmergecia").hide();



LoadDataDoc();

Finalizadas();
LoadAllAn();

LoadAllSecreR();
//LoadAllDigF();
//AllAdm();

$(".home").click(function(){
	$("#FormularioIniEF").show();
	$("#Form2Search").hide();
	$("#Form3Search").hide();
	$("#Form5Search").hide();
	$("#Form4Search").hide();
	$("#Form6Search").hide();
	$("#Form7Search").hide();
	$("#Form8Search").hide();
	$("#Form9Search").hide();
	$("#Form10Search").hide();
	$("#Form11Search").hide();
	$("#ActAnestesiologo").hide();
	$("#Form16Search").hide();
	$("#Form7Search").hide();
	$("#FormSearchCirugia").hide();
	$("#Frm1").hide();
	$("#FrmVerInicProtocolos").hide();
	$("#FrmMkEmergecia").hide();
	Home();
});









});

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


//home
function Home(){
	$("#MainAreaPrEf").html("");
	$("#txtBuscar").val("");
	$("#txtBuscar1").val("");
	$("#txtBuscar2").val("");
	$("#txtBuscar4").val("");
	$("#txtBuscarsercir").val("");
	$("#respsercrugi").html("");
	$("#txtsearchpac").val("");
	$("#txtBuscar7").val("");
	$("#Frm2").html("");
	$("#ResmMkEmergencia").html("");
	$("#Frm3").html("");
	$("#Frm4").html("");
	$("#resp7").html("");
	$("#").html("");
	$("#RespsAgend").css("height","none");
	$("#RespsAgend").css("overflow-y","none");
	$("#RespsAgend").html(""); LoadCombos();

	$(".Cabe1").html("");
	$(".Resp1").html("");
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");

}
//fin home
//inicio de la funcio para buscar
function BuscarPaciente1(){
	if($("#txtBuscar").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPacientev2&buscar='+$("#txtBuscar").val()+'&por='+$("#cmbBuspor").val()+'&CodigoRol='+1,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#MainAreaPrEf").html(res);
			},
			error:function()
			{
				$("#MainAreaPrEf").html("error al cargar");
			}
		});
			
	}else{
		$("#MainAreaPrEf").html("");
	}	
}

//fin de la funcio para buscar
//funcion para buscar a el paciente para ver su cita y cancelar
function BuscarPaciente2(){
	if($("#txtBuscar1").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPacieAgenda&buscar='+$("#txtBuscar1").val(),
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
//fin funcion para buscar a el paciente para ver su cita y cancelar
//funcion para buscar a el paciente para ver su cita y cancelar
function BuscarPaciente3(){
	$(".Resp2").html("");
	if($("#txtBuscar2").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPacieUpdatedatos&buscar='+$("#txtBuscar2").val(),
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
//fin funcion para buscar a el paciente para ver su cita y cancelar
//inicio de la funcio para asignar un doctor a un paciente
function ShowAsignarPacADoc(codigo)
{
	$( "#AsignarPacienteDoctor" ).dialog({
			autoOpen: false,
			modal: true,
			height:250,
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

		$( "#AsignarPacienteDoctor" ).dialog( "open" );
		$.ajax({
			url:'Procesar.php?accion=CargarEspecialidades',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#RespuestaAsignacion").html(res);
			},
			error:function()
			{
				$("#RespuestaAsignacion").html("error al cargar");
			}
		});
		$("#CodigoPaciente").html("<input type='hidden' id='txtCodPac' value='"+codigo+"'/>");
}
//fin de la funcio para asignar un doctor a un paciente
//inicio de la funcio para cargar el docto segun la especialida
function CargarDoctores()
{
		$.ajax({
			url:'Procesar.php?accion=CargarDoctoresXEspe&especialidad='+$('#cmbEspec').val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreaDoctores").html(res);
			},
			error:function()
			{
				$("#AreaDoctores").html("error al cargar");
			}
		});	
}
//fin de la funcio para cargar el docto segun la especialida
//inicio de la funcion para regojer las variables en formualario escoonddido
function FormarCamposAsgnar()
{
	if($('#cmbEspec').val()!="" & $('#cmbDoctor').val()!="")
	{
	$("#ResAsFormularioHide").html("<input type='hidden' id='txtCodEspe' value='"+$('#cmbEspec').val()+"'/><input type='hidden' class='btn btn-success' id='txtCodDoc' value='"+$('#cmbDoctor').val()+"'/>");
			$( "#AsignarPacienteDoctor" ).dialog( "close" );
			
			$("#AreaDeBusquedafecha").html("<center><table class='table table-bordered table-striped table-condensend table-hover'><tr><td>Seleccione una fecha: </td><td><input type='text' id='txtFechaBusqueda'/></td><td><input type='button' id='bntBuscarFechaDispo' class='btn btn-success' value='Asignar'/></td></tr></table></center>");
			//$("#bntBuscarFechaDispo").button();
			$('#txtFechaBusqueda').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtFechaBusqueda').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );
			$("#bntBuscarFechaDispo").click(function()
			{
				$.ajax({
					url:'Procesar.php?accion=CargarHoras&fechaC='+$('#txtFechaBusqueda').val()+'&Doctor='+$('#cmbDoctor').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#RespuestaHorasDisponibles").html(res);
					},
					error:function()
					{
						$("#RespuestaHorasDisponibles").html("error al cargar");
					}
				});	

			});
	
	}
	else
	{
		alert("Seleccione las opciones");
	}
}
//fin  de la funcion para regojer las variables en formualario escoonddido
//inici de la funcio para procesar el turno
function GenerarTurnoPaciente()
{
	/*alert("Paciente: "+$("#txtCodPac").val()+", Especialida="+$("#txtCodEspe").val()+", Doctor: "+$("#txtCodDoc").val()+", fecha:"+$("#txtFechaBusqueda").val()+", hora: "+$("#cmb_horas").val());*/
	
				$.ajax({
					url:'Procesar.php?accion=AsignarTurno&Paciente1='+$('#txtCodPac').val()+'&Especialidad1='+$('#txtCodEspe').val()+'&Doctor1='+$("#txtCodDoc").val()+'&fechaC1='+$("#txtFechaBusqueda").val()+'&hora1='+$("#cmb_horas").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#RespuestaAsignacionTurno").html(res);
					},
					error:function()
					{
						$("#RespuestaAsignacionTurno").html("error al cargar");
					}
				});		
}
//fin de la funcio para procesar el turno
//inicio de la funcio para imprimir el turno 
function ImprimirTurno(codigo)
{
	$( "#FormularioDeImpresionTurno" ).attr("title","Turno Del Paciente");
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
//fin de la funcio para imprimir el turno 
//inicio de la funcio para calcular la edad del paciente
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

//fin de la funcio para calculara la edad del paciente



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




//inicio de la funcion para un nuevo paciente
function ModifyPAciente() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td> <center><h4>Actualizar datos paciente</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span12' id='txtBuscar2'  onkeydown='BuscarPaciente3();'  type='text'> <a class='btn' ><i class='icon-search'></i>Cedula Paciente</a> </div> </center> </td> </tr> </table>");
	$("#txtBuscar2:first").focus();
}
function ClearPaciente() {
	$(".Resp1").html("");
}



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
//funcion para calculara la edad
function Calcular()
{
	$("#TxtEdad123").val();
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
}

//fin de la funcion para calucluar la edad del paciente//inicio de la funcion para caragar los datos de todas las consultas de hoy
/*function LoadAllConsutasHoy()
{
				$.ajax({
					url:'Procesar.php?accion=LoadDataCitasToday',
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#AreaParaViewConsulta").html(res);
					},
					error:function()
					{
						$("#AreaParaViewConsulta").html("error al cargar");
					}
				});		
}*/
//fin de la funcion para caragar los datos de todas las consultas de hoy
//inioio de la funcion para pagar
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
		$( "#formpago").html("<table><tr><td>Modificar pago</td> <td> <select id='st_pago'><option value=''>Selecione...</option><option>Cancelado </option> <option>Pendiente</option></select></td></tr><tr><td colspan='2'><input type='button' id='btn_pago' value='guardar'/></td></tr> </table>");
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
//fin functio  para pago
//inicio de la funcio para cancelar la cita
function CancelarCita(codigo)
{
	/*$( "#AreaCancelarCita" ).attr("title","Cancelar Cita");
	$( "#AreaCancelarCita" ).dialog({
			autoOpen: false,
			modal: true,
			height:150,
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
		$( "#AreaCancelarCita" ).dialog("open");*/
		$( ".modal-body").html("<table class='table table-hover table-condensend table-striped table-bordered'><tr><td><center><input type='button' value='Aceptar' class='btn btn-success' id='bntOkCancel'/></center></td></tr></table>");
		
		$("#bntOkCancel").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=CancelarPago&Codigoturno321='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
					setTimeout(function(){BuscarPaciente2();},1000);
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
				}
			});			
		});
		$("#bntCancel").click(function()
		{
			$( ".modal-body" ).dialog("close");
		});
	
}


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

function DatosAllFiliacion(codigo)
{
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
function SaveAndModPac(codigo)
{
				$.ajax({
					 url:'Procesar.php?accion=ModDataPac&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+'&CodigoPaciente='+codigo+"&autori="+$("#txtautorizacion").val()+"&fechaiaut="+$("#txtfechaauto").val()+"&fechafaut="+$("#txtfechaautovenc").val()+"&condi2="+$("#txtCondicio").val()+'&estadoPac='+$("#cmbestPac").val(),
                    type:'GET',
					cache:false,
					contentType:'charset=utf-8'
					success:function(res)
					{
						$(".Resp2").html(res);
						setTimeout(function()
						{
							$(".Resp2").html("");
							BuscarPaciente3();
							
						},3000);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
					}
				});
	
}


function LoadDataDoc(){/*
		$.ajax({
					url:'Procesar.php?accion=LoadDataDoc',
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#LoadDataDoct").html(res);
					},
					error:function()
					{
						$("#LoadDataDoct").html("error al cargar");
					}
				});	*/
}


function CloseMeModMed(){ $( "#ModMedico" ).dialog( "close" );	 }



// --------------------------------------- modulo adm 1 ---------------------------------------------//

//Modal nuevo medico


//Cancelar nuevo medico
function CloseNewMed()
{
	$( "#NewMedico" ).dialog( "close" );
}
function CloseMeModMed(){ $( "#ModMedico" ).dialog( "close" );	 }
//Fin cancelar nuevo medico




//cancelar eliminar medico
function CloseModDelete()
{
	$( "#DeleMedico" ).dialog( "close" );
}
//fin cancelar eliminar medico

/*delete medico
function DeleteUser(codigo)
{
	$.ajax({
		url:'Procesar.php?accion=DeleteUserMed&CodMed09='+codigo,
		type:'GET',
		cache:false,
		success:function(res)
		{
			$("#DeleMedico").html(res);

			setTimeout(function()
			{
				LoadDataDoc();
			},1000);

		},
		error:function()
		{
			$("#DeleMedico").html("error al cargar");
		}
	});
}
//fin delete medico */



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
							$(".Resp1").html(res);
						},
						error:function()
						{
							$(".Resp1").html("error al cargar");
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
							$(".Resp1").html(res);
						},
						error:function()
						{
							$(".Resp1").html("error al cargar");
						}
				});
	}
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

 /*
  * funciones para posiblidad de facturar
  */

function Finalizadas(){
		$.ajax({
						url:'Procesar.php?accion=LoadFinalizaall',
						type:'GET',
						cache:false,
						success:function(res)
						{
							$("#FinaliazaAllFile").html(res);
						},
						error:function()
						{
							$("#FinaliazaAllFile").html("error al cargar");
						}
				});		
}
/*
 *  fifunciones para posiblidad de facturar
 */  


 /*
  * funciones para altas y bajas de administradores
  */

function AllAdm(){
			$.ajax({
						url:'Procesar.php?accion=LoadAllAdms',
						type:'GET',
						cache:false,
						success:function(res)
						{
							$("#LoadDataADm").html(res);
						},
						error:function()
						{
							$("#LoadDataADm").html("error al cargar");
						}
				});	
}





function NuevoAdministrador(){
	/*$("#NewAdm").attr("title","Nuevo administrador");
	$( "#NewAdm" ).dialog({
			autoOpen: false,
			modal: true,
			height:517,
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
		$( "#NewAdm" ).dialog( "open" );*/
		Home();
		$( ".Resp1" ).html("	<table class='table table-hover table-striped table-condensend table-bordered'> <tr> <td>Cedula: </td> <td colspan='3'><input type='text' id='txtCedulaMedadm3'   class='span4' /></td> </tr> <tr> <td>Apellidos:</td> <td><input type='text' id='txtApellMedadm3'  /></td> <td>Nombres:</td> <td><input type='text' id='txtNomMedicadm3'  /></td> </tr> <tr> <td>Edad:</td> <td><input type='text' id='txtEdadMedadm3'  /></td> <td>Direccion:</td> <td><input type='text' id='txtDirecioMedadm3'  /></td> </tr> <tr> <td>Usuario:</td> <td><input type='text' id='txtUserMedadm3'  /></td> <td>Password:</td> <td><input type='text' id='txtPassMedadm3'  /></td> </tr> <tr> <td>Permiso:</td> <td colspan='3' > <select id='cmb_espLodadm3' class='span4'> <option value=''>--Seleccione--</option> <option value='17'>Administrador</option> <option value='18'>Administrador cirujia</option> </select> </tr> <tr> <td colspan='4'><center><a href='#' class='btn btn-primary' onclick='NewOkADm()'><i class='icon-ok'></i> Guardar</a>  <a href='#' class='btn btn-success' onclick='ClosNewADm()'><i class='icon-remove'></i> Cancelar</a></center></td> </tr> </table>");	
}
function ClosNewADm() {
	$(".Resp1").html("")
}
function NewOkADm(){
	if ($('#cmb_espLodadm3').val()!="" & $('#txtUserMedadm3').val()!="") {
	$.ajax({
			url:'Procesar.php?accion=NewAdm&CedADm='+$('#txtCedulaMedadm3').val()+'&Apellidosadm='+$('#txtApellMedadm3').val()+'&Nombresadm='+$('#txtNomMedicadm3').val()+'&Edadadm='+$('#txtEdadMedadm3').val()+'&Direccionadm='+$('#txtDirecioMedadm3').val()+'&Usuarioadm='+$('#txtUserMedadm3').val()+'&Passwordadm='+$('#txtPassMedadm3').val()+'&Especadm='+$('#cmb_espLodadm3').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp1").html(res);
						setTimeout(function(){AllAdm();},1000);
						
					},
					error:function()
					{
						$(".Resp1").html("Error al cargar");
					}
			});	

	}else{
		alert("Seleccione un permiso");
	}	
}
/*
  * fin funciones para altas y bajas de administradores
  */  


/*
  *  funciones para altas y bajas de secretarias y residentes
  */  
function LoadAllSecreR(){
			$.ajax({
						url:'Procesar.php?accion=LoadSecreR',
						type:'GET',
						cache:false,
						success:function(res)
						{
							$("#LoadDataSecreR").html(res);
						},
						error:function()
						{
							$("#LoadDataSecreR").html("error al cargar");
						}
				});		
}






/*
  * fin funciones para altas y bajas de secretarias y residentes
  */  





/*
  *  funciones para altas y bajas de digitadores
  */  
function LoadAllDigF(){
			$.ajax({
						url:'Procesar.php?accion=LoadDigF',
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
function ModDigF(codigo){
		
		$.ajax({
					url:'Procesar.php?accion=LoadDataDigF&CodDigF='+codigo,
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
function SaveNewOkDigF(codigo){
	
	$.ajax({
			url:'Procesar.php?accion=SaveNuevoDigF&CedDigF='+$('#txtCedulaMedDigF').val()+'&ApellidosDigF='+$('#txtApellMedDigF').val()+'&NombresDigF='+$('#txtNomMedicDigF').val()+'&EdadDigF='+$('#txtEdadMedDigF').val()+'&DireccionDigF='+$('#txtDirecioMedDigF').val()+'&UsuarioDigF='+$('#txtUserMedDigF').val()+'&PasswordDigF='+$('#txtPassMedDigF').val()+'&codeDigF='+codigo,
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
						setTimeout(function(){BuscaDigF();},1000);
						
					},
					error:function()
					{
						$(".Resp2").html("Error al cargar");
					}
			});	


}
function CloseNewDigF(){
	$(".Resp2").html("");
} 
function DeleDigF(codigo){
		$( ".modal-body" ).html("<table class='table table-bordered table-striped table-condensend table-hover'><tr><td colspan='2'><center>Esta seguro que desea borrar el digitador</center></td></tr><tr><td><center><a class='btn btn-primary'  id='ConfirmDeleteMed' > <i class='icon-ok' ></i> Borrar</a>&nbsp; </center></td></tr></table>");
		
		$("#ConfirmDeleteMed").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteUser&IDUser='+codigo,
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
			setTimeout(function()
							{
								BuscaDigF();
							},1000);
		});
}
function BuscaDigF(){
	if($("#txtBuscar13").val()!=""){
			$.ajax({
						url:'Procesar.php?accion=LoadAllDigF1&buscar='+$("#txtBuscar13").val(),
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
function NewDigitador(){
Home();

		$( ".Resp1" ).html("<table class='table table-hover table-striped table-condensend table-bordered'> <tr> <td>Cedula: </td> <td colspan='3'><input type='text' id='txtCedulaMedDigF'   class='span4' /></td> </tr> <tr> <td>Apellidos:</td> <td><input type='text' id='txtApellMedDigF'  /></td> <td>Nombres:</td> <td><input type='text' id='txtNomMedicDigF'  /></td> </tr> <tr> <td>Edad:</td> <td><input type='text' id='txtEdadMedDigF'  /></td> <td>Direccion:</td> <td><input type='text' id='txtDirecioMedDigF'  /></td> </tr> <tr> <td>Usuario:</td> <td><input type='text' id='txtUserMedDigF'  /></td> <td>Password:</td> <td><input type='text' id='txtPassMedDigF'  /></td> </tr> <tr> <td colspan='4'><center><a href='#' class='btn btn-primary' onclick='NewOkDigF()'><i class='icon-ok'></i> Guardar</a>  <a href='#' class='btn btn-success' onclick='ClosNewDigF()'><i class='icon-remove'></i> Cancelar</a></center></td> </tr> </table>");	
}
function ClosNewDigF(){ $(".Resp1").html("");}
function NewOkDigF(){
	if ( $('#txtUserMedDigF').val()!="") {
	$.ajax({
			url:'Procesar.php?accion=NewDigF&CedDigF='+$('#txtCedulaMedDigF').val()+'&ApellidosDigF='+$('#txtApellMedDigF').val()+'&NombresDigF='+$('#txtNomMedicDigF').val()+'&EdadDigF='+$('#txtEdadMedDigF').val()+'&DireccionDigF='+$('#txtDirecioMedDigF').val()+'&UsuarioDigF='+$('#txtUserMedDigF').val()+'&PasswordDigF='+$('#txtPassMedDigF').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp1").html(res);
						setTimeout(function(){LoadAllDigF();},1000);
						
					},
					error:function()
					{
						$(".Resp1").html("Error al cargar");
					}
			});	

	}else{
		alert("Seleccione un permiso");
	}	
}
function ModifyDigitador() {
	Home();
	$(".Cabe1").html(" <table class='table table-hover table-striped table-condensend table-bordered'> <tr><td> <center> <div class='input-append'> <input class='span10' id='txtBuscar13'  onkeyup='BuscaDigF();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar digitador</a> </div> </center> </td></tr> </table>");
	$("#txtBuscar13:first").focus();
}

/*
  * fin funciones para altas y bajas de digitadores
  */    




/*
* ver datos de las agendas de las citas de cirugia
*/
function RedactarDatos(codigo){
	/*$("#CitaCiru").attr("title","Cita Cirugia");
	$( "#CitaCiru" ).dialog({
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
		$( "#CitaCiru" ).dialog( "open" );	 */	
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
 /*	$("#PdfCitaCirug").attr("title","Cita Cirugia");
	$( "#PdfCitaCirug" ).dialog({
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
		$( "#PdfCitaCirug" ).dialog( "open" );*/
		$( ".modal-body" ).html("<object type='text/html' data='../Reportes/CitaCirugiaImp.php?code="+code+"'></object>");
 }

/*
* fin ver datos de las agendas de las citas de cirugia
*/

//delete paciente 2
 function DelePac(codigo)
 {
	 
		$(".modal-body").html("<table><tr><td><center><input type='button' class='btn btn-success' value='Aceptar' id='ConfirmarDeletePacie' /></center></td></tr></table>");
		

		$("#ConfirmarDeletePacie").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeletePaciente&IDPaciente='+codigo,
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
			setTimeout(function()
							{
								BuscarPaciente3();
							},1000);		
		});
		$("#CancelDeletePacie").click(function()
		{
			$( ".modal-body" ).dialog( "close" );
		});
 }
  //Fin delete paciente 2
  
   //altas bajas anestesiologo
 function ModifyAnestesiologo() {
	Home();
	$(".Cabe1").html(" <table class='table table-hover table-striped table-condensend table-bordered'> <tr><td> <center> <div class='input-append'> <input class='span7' id='txtBuscarAn'  onkeyup='BuscarAnest();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Anestesiólogo</a> </div> </center> </td></tr> </table>");
	$("#txtBuscarAn:first").focus();
 }
 function NewAnestesiologo(){
Home();
		$( ".Resp1" ).html("<table class='table table-hover table-striped table-condensend table-bordered'> <tr> <td>Cédula: </td> <td colspan='3'><input type='text' id='txtCedulaAn'   class='span4' /></td> </tr> <tr> <td>Apellidos: </td> <td><input type='text' id='txtApellAn'  /></td> <td>Nombres: </td> <td><input type='text' id='txtNomAn'  /></td> </tr> <tr> <td>Edad: </td> <td><input type='text' id='txtEdadAn' /></td> <td>Dirección: </td> <td><input type='text' id='txtDirecioAn' /></td> </tr> <tr> <td>Usuario: </td> <td><input type='text' id='txtUserAn' /></td> <td>Password: </td> <td><input type='text' id='txtPassAn' /></td> </tr> <tr> <td colspan='4'><center><a href='#' class='btn btn-primary' onclick='NewAn()'><i class='icon-ok'></i> Guardar</a>  <a href='#' class='btn btn-success' onclick='CloseNewAn()'><i class='icon-remove'></i> Cancelar</a></center></td> </tr> </table>");	
}
function CloseNewAn(){ $( ".Resp1" ).html("");}
function NewAn(){
	if ( $('#txtUserAn').val()!="") {
	$.ajax({
			url:'Procesar.php?accion=NewAnest&CedAn='+$('#txtCedulaAn').val()+'&ApellidosAn='+$('#txtApellAn').val()+'&NombresAn='+$('#txtNomAn').val()+'&EdadAn='+$('#txtEdadAn').val()+'&DireccionAn='+$('#txtDirecioAn').val()+'&UsuarioAn='+$('#txtUserAn').val()+'&PasswordAn='+$('#txtPassAn').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp1").html(res);
					},
					error:function()
					{
						$(".Resp1").html("Error al cargar");
					}
			});	

	}else{
		alert("Ingrese un usuario");
	}	
}

function LoadAllAn(){
			$.ajax({
						url:'Procesar.php?accion=LoadAllAnest',
						type:'GET',
						cache:false,
						success:function(res)
						{
							$("#LoadDataAn").html(res);
						},
						error:function()
						{
							$("#LoadDataAn").html("error al cargar");
						}
				});		
}

function BuscarAnest()
{
	if ($("#txtBuscarAn").val()!="") {
		$.ajax({
					url:'Procesar.php?accion=SearchDataAn&Anestesiologo='+$("#txtBuscarAn").val(),
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

function LoadModAnestesiologo(codigo){
		$.ajax({
					url:'Procesar.php?accion=LoadActAnestesia&CodAnestesiologo='+codigo,
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

function ModifyAnest(codigo){
	$.ajax({
			url:'Procesar.php?accion=ModifyAn&CedAnes='+$('#txtCedulaAn').val()+'&ApellidosAnes='+$('#txtApellAn').val()+'&NombresAnes='+$('#txtNomAn').val()+'&EdadAnes='+$('#txtEdadAn').val()+'&DireccionAnes='+$('#txtDirecioAn').val()+'&UsuarioAnes='+$('#txtUserAn').val()+'&PasswordAnes='+$('#txtPassAn').val()+'&codeAnes='+codigo,
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
						setTimeout(function(){BuscarAnest();},1000);
						
					},
					error:function()
					{
						$(".Resp2").html("Error al cargar");
					}
			});	


}

function DeleteAn(codigo){
		$( ".modal-body" ).html("<table class='table table-bordered table-striped table-condensend table-hover'><tr><td colspan='2'><center>Esta seguro que desea borrar el anestesiólogo</center></td></tr><tr><td><center><a class='btn btn-primary'  id='ConfirmDeleteAn' > <i class='icon-ok' ></i> Borrar</a>&nbsp;</center></td></tr></table>");
		
		$("#ConfirmDeleteAn").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteAn&IDUserAn='+codigo,
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
			setTimeout(function()
							{
								LoadAllAn();
							},1000);
		});
}

function CloseAnDelete()
{
	$( "#DelAnestesia" ).dialog( "close" );
}

function CloseModAnestesia(){
	$(".Resp2").html("");
}
 
 <!-- Fin altas y bajas Anestesia -->


function BuscarPaciente6(){
	if($("#txtBuscar6").val()!="")
		{
			$.ajax({
				url:'Procesar.php?accion=BuscarPacientev2&buscar='+$("#txtBuscar6").val()+'&por='+$("#SearchFor").val()+'&CodigoRol='+2,
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
	else{
		$(".Resp1").html("");
	}	
}

function AsignarPaciente(code){

	ComprobarFecha(code);
	$("#codepaciente").val("");
	$("#codepaciente").val(code);
/*	$("#Searchmedico002").attr("title","Buscar Medico");
	$( "#Searchmedico002" ).dialog({
			autoOpen: false,
			modal: true,
			height:550,
			width:750,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#Searchmedico002" ).dialog( "open" );	*/
		$.ajax({
			url:'Procesar.php?accion=FRmCrearCita2&pacientcod='+code,
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

function SaveTurno002(){

if ($("#codemedico").val()!="" & $("#txtfecprocir02").val()!=""  & $("#cmb_horacir02").val()!="") {
	$.ajax({
					url:'Procesar.php?accion=AsignarTurno&Paciente1='+$('#codepaciente').val()+'&Especialidad1=1&Doctor1='+$("#codemedico").val()+'&fechaC1='+$("#txtfecprocir02").val()+'&hora1='+$("#cmb_horacir02").val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#Searchmedico002").html(res);
						setTimeout(function(){
							$("#resp6").html("");
							$("#txtBuscar6").val("");	
						},1000);
					},
					error:function()
					{
						$("#Searchmedico002").html("error al cargar");
					}
				});	
	}else { alert("Llene los campos de medico, fecha, hora para poder guardar el turno");}
}

function BuscarDoctor(){
	$("#txtfecprocir02").val("");
	$("#resdoct02").html("");
/*	$( "#frmdoct01" ).attr("title","Buscar Medico");
	$( "#frmdoct01" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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

		$( "#frmdoct01" ).dialog( "open" );*/
		$(".modal-body").html("<div class='Cabece1'></div> <div  class='Respue1'></div>");
		$(".Cabece1").html("<table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearcmedico002' onkeyup='BuscarMedio002()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table>");
	
}
function BuscarMedio002(){
	if($("#txtsearcmedico002").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=BuscarMedico002&Buscar='+$("#txtsearcmedico002").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Respue1").html(res);

				},
				error:function()
				{
					$(".Respue1").html("error al cargar");
				}
			});	
	}else{
		$("#resdoct02").html("");
	}
}
function CatchDoc(codigo){
	$("#codemedico").val("");
	$("#codemedico").val(""+codigo+"");
	var user=$("#nommed"+codigo+"").html();
	$("#txtmedicio22").val(""+user+"");
	$( "#frmdoct01" ).dialog( "close" );
}
function CargarHorarios02(){
if ($("#codemedico").val()!="") {
		$.ajax({
					url:'Procesar.php?accion=CargarHoras2&fechaC='+$('#txtfecprocir02').val()+'&Doctor='+$('#codemedico').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$("#cmbhor02").html(res);
					},
					error:function()
					{
						$("#cmbhor02").html("error al cargar");
					}
				});
	}else{
		alert("SELECCIONE UN MEDICO PRIMERO");
	}
}
function ModificarCita(code){
	
	
/*	$(".modal01").attr("title","Modificar Cita Medica");
	$(".modal01" ).dialog({
			autoOpen: false,
			modal: true,
			height:550,
			width:750,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( ".modal01" ).dialog( "open" );	*/
		$.ajax({
			url:'Procesar.php?accion=ModificarCitaMedicav1&CodigoTurno='+code,
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
function SaveModificarTurno002(code){

if ($("#codemedico").val()!="" & $("#txtfecprocir02").val()!=""  & $("#cmb_horacir02").val()!="") {
	$.ajax({
					url:'Procesar.php?accion=MoficarCitaMedica&Paciente1='+$('#codepaciente').val()+'&Especialidad1=1&Doctor1='+$("#codemedico").val()+'&fechaC1='+$("#txtfecprocir02").val()+'&hora1='+$("#cmb_horacir02").val()+"&codigoTurno="+code,
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
						setTimeout(function(){
							$("#resp6").html("");
							$("#txtBuscar6").val("");
							BuscarPaciente2();	
						},1000);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
					}
				});	
	}else { alert("Llene los campos de medico, fecha, hora para poder guardar el turno");}
}
function BuscarPaciente4(){
	if($("#txtBuscar4").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=citacirugia&buscar='+$("#txtBuscar4").val(),
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
function Ini1CitCirugia(codigo){

	$("#txtCodigoPacienteSelecParaCitCir").val(""+codigo+"");
	/*$( "#FrmCitaCiru" ).attr("title","Cita Cirugia");
	$( "#FrmCitaCiru" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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

		$( "#FrmCitaCiru" ).dialog( "open" );	*/

		ComprobarFecha(codigo);

	$.ajax({
			url:'Procesar.php?accion=FrmCirugia&pacientcod='+codigo,
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

function CargarHorarios(){
    $.ajax({
            url:'Procesar.php?accion=HorariosCirugia&fecha='+$("#txtfecprocir").val(),
            type:'GET',
            cache:false,
            success:function(res)
            {
                $("#cmbhor").html(res);
            },
            error:function()
            {
                $("#cmbhor").html("error al cargar");
            }
        });
}

function SearCirujano()
{
	if ($("#txtfecprocir").val()!="" & $("#cmb_horacir").val()!="" & $("#txtduropera").val()!="") {

	$(".modal-body").html("");
	$(".modal-body").html("<div class='CabeModal'></div> <div class='CuerModal'></div>");
	/*$( "#FrmSearchCirja" ).attr("title","Buscar Cirujano");
	$( "#FrmSearchCirja" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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

		$( "#FrmSearchCirja" ).dialog( "open" );*/
		$(".CabeModal").html("<table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearcciruja' onkeyup='BuscarCirujano()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table>");
	}else{
		alert("Llene los campos de fecha de cirugia, la hora que epmieza la cirugia, y la duracion de la operacion");
	}
}

function SearchAnestesiologo(){
	if($("#thtcodciruja").val()!=""){

	$(".modal-body").html("");
	$(".modal-body").html("<div class='CabeModal'></div> <div class='CuerModal'></div>");
	/*$( "#FrmSearchCirja1" ).attr("title","Buscar Anestesiologo");
	$( "#FrmSearchCirja1" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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

		$( "#FrmSearchCirja1" ).dialog( "open" );*/
		$(".CabeModal").html("<table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearchanestesiolo' onkeyup='BuscarAnestesiologo()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table>");
	}else{
		alert("Seleccione un cirujano");
	}
}
function SearchAyudante(){
	if ($("#thtcodantesi").val()!="") {

	$(".modal-body").html("");
	$(".modal-body").html("<div class='CabeModal'></div> <div class='CuerModal'></div>");
	/*$( "#FrmSearchCirja2" ).attr("title","Buscar Anestesiologo");
	$( "#FrmSearchCirja2" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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

		$( "#FrmSearchCirja2" ).dialog( "open" );*/
		$(".CabeModal").html("<table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearchayudante' onkeyup='BuscarAyudante()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table>");


	}else{
		alert("Seleccione un anestesiologo");
	}
}
function SaveCitaEmergenci(){
	if ($("#txtCirujano").val()!=""  & $("#cmb_destiemhosp").val()!="" & $("#txtfecprocir").val()!="" & $("#cmb_horacir").val()!="" & $("#txtcirugia2").val()!="" & $("#txtprocedicirug").val()!="" & $("#txttiempohospital").val()!="" & $("#txtobservaciones").val()!="") {
		var tiempoh=$("#txttiempohospital").val()+" "+$("#cmb_destiemhosp").val();
		$.ajax({
				url:'Procesar.php?accion=SaveCirugiaCita&Codayudate='+$("#thtcodayudan").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val()+'&CirujCod='+$("#thtcodciruja").val()+'&AnestesCod='+$("#thtcodantesi").val()+'&Procedimieto='+$("#txtprocedicirug").val()+'&tieHos='+tiempoh+'&Observaciones='+$("#txtobservaciones").val()+'&CodiPacie='+$("#txtCodigoPacienteSelecParaCitCir").val()+'&DuracionCir='+$("#txtduropera").val(),
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
	}else{
		alert("LLene todos los campos para poder guardar la cita para cirugia");
	}
}
function BuscarCirujano(){
	if($("#txtsearcciruja").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=SearchCirujia&Medico='+$("#txtsearcciruja").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".CuerModal").html(res);
				},
				error:function()
				{
					$(".CuerModal").html("error al cargar");
				}
			});	
	}else{
		$("#ResSearchCirja").html("");
	}
}
function AgendCiruj(codigo){
	$("#thtcodciruja").val("");
	$("#thtcodciruja").val(""+codigo+"");
	var user=$("#cir_"+codigo+"").html();
	$("#txtCirujano").val(""+user+"");
	$( "#FrmSearchCirja" ).dialog( "close" );

}
function BuscarAnestesiologo(){
	if ($("#txtsearchanestesiolo").val()!="") {
			$.ajax({
				url:'Procesar.php?accion=SearchAnestesiolo&Medico='+$("#txtsearchanestesiolo").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val()+'&CirujCod='+$("#thtcodciruja").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".CuerModal").html(res);
				},
				error:function()
				{
					$(".CuerModal").html("error al cargar");
				}
			});	
	}else{
		$(".CuerModal").html("");		
	}
}
function AgendAneste(codigo){
	$("#thtcodantesi").val("");
	$("#thtcodantesi").val(""+codigo+"");
	var user=$("#cir_"+codigo+"").html();
	$("#txtanestesiologo").val(""+user+"");	
	$( "#FrmSearchCirja1" ).dialog( "close" );
}

function BuscarAyudante(){
	if ($("#txtsearchayudante").val()!="") {
			$.ajax({
				url:'Procesar.php?accion=SearchAyudante&Medico='+$("#txtsearchayudante").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val()+'&CirujCod='+$("#thtcodciruja").val()+'&AnestesCod='+$("#thtcodantesi").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".CuerModal").html(res);
				},
				error:function()
				{
					$(".CuerModal").html("error al cargar");
				}
			});	
	}else{
		$(".CuerModal").html("");		
	}

}
function AgendAyudante(codigo){
	$("#thtcodayudan").val("");
	$("#thtcodayudan").val(""+codigo+"");
	var user=$("#cir_"+codigo+"").html();
	$("#txtayudante").val(""+user+"");	
	$( "#FrmSearchCirja2" ).dialog( "close" );
}

function BuscarMedico7(){
	if($("#txtBuscar7").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=BuscarMedico003&Buscar='+$("#txtBuscar7").val(),
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
function BuscarFechaMed(code){
	$("#respuestas").html("");
	/*$( "#ModalFechasDoc" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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

		$( "#ModalFechasDoc" ).dialog( "open" );*/

		$(".Resp2").html("<table class='table table-bordered table-striped table-condensend'><tr><td colspan='5'><center>Buscar por fechas</center></td></tr><tr><td>Fecha de inicio:</td><td><input type='text' id='txtFechai'/></td><td>Fecha final:</td><td><input type='text' id='txtfechaf'/></td><td><a class='btn btn-success' onclick='BuscarPorFechas("+code+")'> Buscar</a></td></tr><tr><td colspan='5'><center>Buscar por meses</center></td></tr><tr><td>Mes: </td><td colspan='3'><select class='cmb_mes002'><option value=''>--Seleccione--</option><option value='1'>Enero</option><option value='2'>Febrero</option><option value='3'>Marzo</option><option value='4'>Abril</option><option value='5'>Mayo</option><option value='6'>Junio</option><option value='7'>Julio</option><option value='8'>Agosto</option><option value='9'>Septiembre</option><option value='10'>Octubre</option><option value='11'>Noviembre</option><option value='12'>Diciembre</option></select></td><td><a class='btn btn-primary' onclick='BuscarXMesDoc("+code+")'> Buscar</a></td></tr></table>");


		$('#txtFechai').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtFechai').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );


		$('#txtfechaf').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtfechaf').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );



}

function BuscarPorFechas(code){
	if($("#txtFechai").val()!=""  & $("#txtfechaf").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=BuscarCitasMedicoXFechas&IDDOc='+code+'&FechaI='+$("#txtFechai").val()+'&FechaF='+$("#txtfechaf").val(),
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

	}else{
		alert("Selecione las fechas");
	}
}
function BuscarXMesDoc(code){
	if($(".cmb_mes002").val()!="" ){
		$.ajax({
				url:'Procesar.php?accion=BuscadorCitasXMes&IDDOc='+code+'&mes='+$(".cmb_mes002").val(),
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

	}else{
		alert("Seleccione un mes");
	}
}
function BuscarCirugia(){
	if($("#txtBuscarsercir").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=BuscadorCitasCirugiaXPac&Buscar='+$("#txtBuscarsercir").val()+'&rol=1',
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



function SearcPacToUpPdf(){
    if ($("#txtsearchpac").val()!="") {
        $.ajax({
            url:'Procesar.php?accion=BuscapacienteToUpPdf&Descripcion='+$("#txtsearchpac").val()+'&pr=1',
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

    }else{
        $(".Resp2").html("");
        $(".Resp3").html("");
        $(".Resp4").html("");
        $(".Resp4").css("overflow-y","");

    }
}
function FileOrder(codigo){
        $.ajax({
            url:'Procesar.php?accion=GenerarForm2ToUpPdf&paciente='+codigo,
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

function UpFile(idp,po){

        $( ".modal-body" ).html("<table class='table table-bordered table-condensend table-hover table-striped'><tr><th>Fecha</th><td colspan='2'><input type='text' id='txtfechaup' readyonly/></td></tr><tr><th>Buscar: </th><td><input type='file' id='fileLight'/></td><td><input type='button' class='btn btn-primary' value='Subir' id='subitlight'/></td></tr></table>");

                    $('#txtfechaup').datepicker({
                        changeMonth: true,
                        changeYear: true
                    });
                    $('#txtfechaup').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );  

            $("#subitlight").click(function(){

            var inputFileImage = document.getElementById("fileLight");
            var archivo = inputFileImage.files[0];
            var xx=$("#fileLight").val();
            if(xx.match(/.(pdf)$/)  && $("#txtfechaup").val()!=""){
                $.ajax({
                        beforeSend:function(x)
                        {
                            x.setRequestHeader('X-File-Name',archivo.name);
                        },
                        url:'Procesar.php?accion=SubirDigital&idp='+idp+'&pos='+po+'&Fecha='+$("#txtfechaup").val(),
                        type:'POST',
                        data:archivo,
                        cache:false,
                        contentType:false,
                        processData:false,
                        success:function(res)
                        {
                            $(".modal-body").html(res);
                            setTimeout(function(){
                                ReloadFiles(idp);
                            },1000);
                        },
                        error:function()
                        {
                            $(".modal-body").html("error al cargar");
                        }
                    });
            }else{
                alert("Seleccione un archivo pdf y llene el campo de fecha");
            }

        });

        

}


function ReloadFiles(codigo){
        $.ajax({
            url:'Procesar.php?accion=ReloadFiles&PacietId='+codigo,
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
function SeeAllFile(pac,pos){
        $(".modal-body").css("overflow-y","scroll");
        $.ajax({
            url:'Procesar.php?accion=SeeAllFile&PacietId='+pac+'&pos='+pos,
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
function SeeList(pac,pos){
        $(".modal-body").css("overflow-y","scroll");
        $.ajax({
            url:'Procesar.php?accion=SeeAllLista&PacietId='+pac+'&pos='+pos,
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
function DeleteFil(codigo,pac){


    
            $("#Frm4").css("overflow-y","");
                $.ajax({
                    url:'Procesar.php?accion=DeleteFil&CodFile='+codigo,
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                        $("#Frm4").html(res);

                        setTimeout(function(){
                                ReloadFiles(pac);
                            },1000);

                    },
                    error:function()
                    {
                        $("#Frm4").html("error al cargar");
                    }
                }); 
       
}

function BuscarHistoriaPaciente()
{
Home();		
		$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span10' id='txtBuscar'  onkeydown='BuscarPacientePAraVerHistoria();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a> </div> </center> </td></table>");
		$("#txtBuscar:first").focus();
}

function BuscarPacientePAraVerHistoria()
{
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

function HistorialPacienteNew(codigo)
{
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

function SeeAllAnamesis(codigo){
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

function SeeAllEpicrisis(codigo){
		$.ajax({
			url:'Procesar.php?accion=SeeAllListaEpicrisis&PacietId='+codigo,
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

function SeeAllSolicEpi(code){
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
function SeeAllInfoSolic(code){

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
function SeeList(pac,pos){


		$.ajax({
			url:'Procesar.php?accion=SeeAllLista2&PacietId='+pac+'&pos='+pos,
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
function SeeAllFile(pac,pos){
		$.ajax({
			url:'Procesar.php?accion=SeeAllFile&PacietId='+pac+'&pos='+pos,
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
function VerAnamnesis(codigo){
	$( ".modal-body" ).html("<object type='text/html' data='../Reportes/AnamnesisCdu2.php?code="+codigo+"'></object>");
}



function Home() {
	$(".Cabe1").html("");
	$(".Resp1").html("");
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");
}
function ModificarMedicosAll() {
	Home();
	$(".Cabe1").html("<table class='table table-hover table-striped table-condensend table-bordered'> <tr><td> <center> <div class='input-append'> <input class='span10' id='txtBuscar10'  onkeyup='BuscarMedico();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Medico</a> </div> </center> </td></tr> </table>");
	$("#txtBuscar10:first").focus();
}

function BuscarMedico(){
	if ($("#txtBuscar10").val()!="") {
		$.ajax({
					url:'Procesar.php?accion=SearchDataDoc&Medico='+$("#txtBuscar10").val(),
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
function ModMed(codigo){
		$.ajax({
					url:'Procesar.php?accion=LoadDataMedico&CodMedico='+codigo,
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
//modificar medico
function ModOkMed(cod)
{
	var inputFileImage = document.getElementById("filefirm");
	var archivo = inputFileImage.files[0];
	var xx=$("#filefirm").val();
	if($('#txtCedulaMed').val()!="" & $('#cmb_espLod').val()!="" & $('#txtLibro').val()!="" & $('#txtFolio').val()!="" & $('#txtNumero').val()!="")
		if(xx.match(/.(jpg)$/)  && $("#filefirm").val()!=""){
		$.ajax({
			beforeSend:function(x)
							{
								x.setRequestHeader('X-File-Name',archivo.name);
							},
				url:'Procesar.php?accion=UpdateMedico&CodigoMed='+cod+'&CedulaMed2='+$("#txtCedulaMed").val()+'&ApellidosMed2='+$('#txtApellMed').val()+'&NombresMed2='+$('#txtNomMedic').val()+'&EdadMed2='+$('#txtEdadMed').val()+'&DireccionMed2='+$('#txtDirecioMed').val()+'&UsuarioMed2='+$('#txtUserMed').val()+'&PasswordMed2='+$('#txtPassMed').val()+'&EspecMed2='+$('#cmb_espLod').val()+'&LibroMed2='+$('#txtLibro').val()+'&FolioMed2='+$('#txtFolio').val()+'&NumeroMed2='+$('#txtNumero').val(),
				type:'POST',
				data:archivo,
				cache:false,
				contentType:false,
				processData:false,
				success:function(res) 
				{
					$(".Resp2").html(res);
					setTimeout(function(){LoadDataDoc()},1000);
					/*setTimeout(function()
					{
						$( "#ModMedico" ).dialog( "close" );
					},2000); */
				},
				error:function()
				{
					$(".Resp2").html("error al cargar");
				}
			});
			}
				else
				{
					$.ajax({
					url:'Procesar.php?accion=UpdateMedico&CodigoMed='+cod+'&CedulaMed2='+$("#txtCedulaMed").val()+'&ApellidosMed2='+$('#txtApellMed').val()+'&NombresMed2='+$('#txtNomMedic').val()+'&EdadMed2='+$('#txtEdadMed').val()+'&DireccionMed2='+$('#txtDirecioMed').val()+'&UsuarioMed2='+$('#txtUserMed').val()+'&PasswordMed2='+$('#txtPassMed').val()+'&EspecMed2='+$('#cmb_espLod').val()+'&LibroMed2='+$('#txtLibro').val()+'&FolioMed2='+$('#txtFolio').val()+'&NumeroMed2='+$('#txtNumero').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
						setTimeout(function(){BuscarMedico()},1000);
					},
					error:function()
					{
						$(".Resp2").html("error al cargar");
					}
				});
				}
			else
			{
				alert ("Complete los campos para continuar");
			}
				
}

//fin modificar medico
function DeleMed(codigo){
		$( ".modal-body" ).html("<table class='table table-bordered table-striped table-condensend table-hover'><tr><td colspan='2'><center>Esta seguro que desea borrar el medico</center></td></tr><tr><td><center><a class='btn btn-primary'  id='ConfirmDeleteMed' > <i class='icon-ok' ></i> Borrar</a></center></td></tr></table>");
		
		$("#ConfirmDeleteMed").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteUser&IDUser='+codigo,
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
			setTimeout(function()
							{
								LoadDataDoc();
							},1000);
		});
}
function NuevoMedico()
{
Home();
		$.ajax({
			url:'Procesar.php?accion=NewMedico',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp1").html(res);
				/*setTimeout(function(){
					LoadDataDoc();
				},1000);*/

			},
			error:function()
			{
				$(".Resp1").html("error al cargar");
			}
		});
}
//Fin modal nuevo medico


//Guardar nuevo medico
function SaveNewOkMed()
{
		var inputFileImage = document.getElementById("fileimgfirmNew");
			var archivo = inputFileImage.files[0];
			var xx=$("#fileimgfirmNew").val();
			if($('#txtCedulaMedNew').val()!="" & $('#cmb_espLodNew').val()!="" & $('#txtLibroNew').val()!="" & $('#txtFolioNew').val()!="" & $('#txtNumeroNew').val()!="")
			{
			if(xx.match(/.(jpg)$/)  && $("#fileimgfirmNew").val()!=""){
			$.ajax({
				beforeSend:function(x)
						{
							x.setRequestHeader('X-File-Name',archivo.name);
						},
				url:'Procesar.php?accion=SaveNuevoMed&CedMed='+$('#txtCedulaMedNew').val()+'&ApellidosMed='+$('#txtApellMedNew').val()+'&NombresMed='+$('#txtNomMedicNew').val()+'&EdadMed='+$('#txtEdadMedNew').val()+'&DireccionMed='+$('#txtDirecioMedNew').val()+'&UsuarioMed='+$('#txtUserMedNew').val()+'&PasswordMed='+$('#txtPassMedNew').val()+'&EspecMed='+$('#cmb_espLodNew').val()+'&LibroMed='+$('#txtLibroNew').val()+'&FolioMed='+$('#txtFolioNew').val()+'&NumeroMed='+$('#txtNumeroNew').val(),
				type:'POST',
				data:archivo,
				cache:false,
				contentType:false,
				processData:false,
				success:function(res)
				{
					$(".Resp1").html(res);
					setTimeout(function(){LoadDataDoc()},1000);
					setTimeout(function()
					{
						$( ".Resp1" ).dialog( "close" );
					},2000);
				},
				error:function()
				{
					$(".Resp1").html("error al cargar");
					setTimeout(function(){LoadDataDoc()},1000);
					setTimeout(function()
					{
						$( ".Resp1" ).dialog( "close" );
					},2000);
				}
			});
			}
			else
			{
				$.ajax({
				url:'Procesar.php?accion=SaveNuevoMed&CedMed='+$('#txtCedulaMedNew').val()+'&ApellidosMed='+$('#txtApellMedNew').val()+'&NombresMed='+$('#txtNomMedicNew').val()+'&EdadMed='+$('#txtEdadMedNew').val()+'&DireccionMed='+$('#txtDirecioMedNew').val()+'&UsuarioMed='+$('#txtUserMedNew').val()+'&PasswordMed='+$('#txtPassMedNew').val()+'&EspecMed='+$('#cmb_espLodNew').val()+'&LibroMed='+$('#txtLibroNew').val()+'&FolioMed='+$('#txtFolioNew').val()+'&NumeroMed='+$('#txtNumeroNew').val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp1").html(res);
					setTimeout(function(){LoadDataDoc()},1000);
					setTimeout(function()
					{
						$( ".Resp1" ).dialog( "close" );
					},2000);
				},
				error:function()
				{
					$(".Resp1").html("error al cargar");
					setTimeout(function(){LoadDataDoc()},1000);
					setTimeout(function()
					{
						$( ".Resp1" ).dialog( "close" );
					},2000);
				}
			});
			}
			}
			else
			{
				alert ("Complete los campos para continuar");
			}
				
		
}
//Fin guardar nuevo medico

//administrador
function NewAdiministrador() {
	Home();
	$(".Cabe1").html("<table class='table table-hover table-striped table-condensend table-bordered'> <tr><td> <center> <div class='input-append'> <input class='span10' id='txtBuscar11'  onkeyup='BuscaAdm();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Aministrador</a> </div> </center> </td></tr> </table>");
	$("#txtBuscar11:first").focus();
}
function BuscaAdm(){
	if($("#txtBuscar11").val()!=""){
			$.ajax({
						url:'Procesar.php?accion=LoadAllAdm1s&buscar='+$("#txtBuscar11").val(),
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
function ModAdm(codigo){

		$.ajax({
					url:'Procesar.php?accion=LoadDataAdm&CodAdm='+codigo,
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
function SaveNewOkADm(codigo){
	if ($('#cmb_espLodadm2').val()!="") {
	$.ajax({
			url:'Procesar.php?accion=SaveNuevoAdm&CedADm='+$('#txtCedulaMedadm').val()+'&Apellidosadm='+$('#txtApellMedadm').val()+'&Nombresadm='+$('#txtNomMedicadm').val()+'&Edadadm='+$('#txtEdadMedadm').val()+'&Direccionadm='+$('#txtDirecioMedadm').val()+'&Usuarioadm='+$('#txtUserMedadm').val()+'&Passwordadm='+$('#txtPassMedadm').val()+'&Especadm='+$('#cmb_espLodadm2').val()+'&codeadm='+codigo,
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
						setTimeout(function(){BuscaAdm();},1000);
						
					},
					error:function()
					{
						$(".Resp2").html("Error al cargar");
					}
			});	

	}else{
		alert("Seleccione un permiso");
	}
}
function CloseNewADm(){
	$(".Resp2").html("");
}
function DeleAdm(codigo){


		$( ".modal-body" ).html("<table class='table table-bordered table-striped table-condensend table-hover'><tr><td colspan='2'><center>Esta seguro que desea borrar el administrador</center></td></tr><tr><td><center><a class='btn btn-primary'  id='ConfirmDeleteMed' > <i class='icon-ok' ></i> Borrar</a></center></td></tr></table>");
		
		$("#ConfirmDeleteMed").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteUser&IDUser='+codigo,
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
			setTimeout(function()
							{
								BuscaAdm();
							},1000);
		});
}
function ModifySecretaria() {
	Home();
	$(".Cabe1").html("<table class='table table-hover table-striped table-condensend table-bordered'> <tr><td> <center> <div class='input-append'> <input class='span10' id='txtBuscar12'  onkeyup='BuscaSecreR();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar secretaria o R.</a> </div> </center> </td></tr> </table>");

	$("#txtBuscar12:first").focus();
}
function BuscaSecreR(){
	if($("#txtBuscar12").val()!=""){
			$.ajax({
						url:'Procesar.php?accion=LoadAllsecreR1&buscar='+$("#txtBuscar12").val(),
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
function ModSecreR(codigo){
		$.ajax({
					url:'Procesar.php?accion=LoadDataSecreR&CodSecreR='+codigo,
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
function SaveNewOkSecreR(codigo){
	
	$.ajax({
			url:'Procesar.php?accion=SaveNuevosecreR&CedsecreR='+$('#txtCedulaMedsecreR').val()+'&ApellidossecreR='+$('#txtApellMedsecreR').val()+'&NombressecreR='+$('#txtNomMedicsecreR').val()+'&EdadsecreR='+$('#txtEdadMedsecreR').val()+'&DireccionsecreR='+$('#txtDirecioMedsecreR').val()+'&UsuariosecreR='+$('#txtUserMedsecreR').val()+'&PasswordsecreR='+$('#txtPassMedsecreR').val()+'&codesecreR='+codigo,
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp2").html(res);
						setTimeout(function(){BuscaSecreR();},1000);
						
					},
					error:function()
					{
						$(".Resp2").html("Error al cargar");
					}
			});	


}
function CloseNewSecreR(){
	$(".Resp2").html("");
}
function DeleSecreR(codigo){

		$( ".modal-body" ).html("<table class='table table-bordered table-striped table-condensend table-hover'><tr><td colspan='2'><center>Esta seguro que desea borrar la secretaria o R.</center></td></tr><tr><td><center><a class='btn btn-primary'  id='ConfirmDeleteMed' > <i class='icon-ok' ></i> Borrar</a>&nbsp; </center></td></tr></table>");

		$("#ConfirmDeleteMed").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteUser&IDUser='+codigo,
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
			setTimeout(function()
							{
								BuscaSecreR();
							},1000);
		});
}
function NuevoSecreR(){

Home();
		$( ".Resp1" ).html("	<table class='table table-hover table-striped table-condensend table-bordered'> <tr> <td>Cedula: </td> <td colspan='3'><input type='text' id='txtCedulaMedsecreR3'   class='span4' /></td> </tr> <tr> <td>Apellidos:</td> <td><input type='text' id='txtApellMedsecreR3'  /></td> <td>Nombres:</td> <td><input type='text' id='txtNomMedicsecreR3'  /></td> </tr> <tr> <td>Edad:</td> <td><input type='text' id='txtEdadMedsecreR3'  /></td> <td>Direccion:</td> <td><input type='text' id='txtDirecioMedsecreR3'  /></td> </tr> <tr> <td>Usuario:</td> <td><input type='text' id='txtUserMedsecreR3'  /></td> <td>Password:</td> <td><input type='text' id='txtPassMedsecreR3'  /></td> </tr> <tr> <td colspan='4'><center><a href='#' class='btn btn-primary' onclick='NewOkSecreR()'><i class='icon-ok'></i> Guardar</a>  <a href='#' class='btn btn-success' onclick='ClosNewSecreR()'><i class='icon-remove'></i> Cancelar</a></center></td> </tr> </table>");	
}
function ClosNewSecreR(){ $( ".Resp1" ).html( "" );}
function NewOkSecreR(){
	if ( $('#txtUserMedadm3').val()!="") {
	$.ajax({
			url:'Procesar.php?accion=NewsecreR3&CedsecreR3='+$('#txtCedulaMedsecreR3').val()+'&ApellidossecreR3='+$('#txtApellMedsecreR3').val()+'&NombressecreR3='+$('#txtNomMedicsecreR3').val()+'&EdadsecreR3='+$('#txtEdadMedsecreR3').val()+'&DireccionsecreR3='+$('#txtDirecioMedsecreR3').val()+'&UsuariosecreR3='+$('#txtUserMedsecreR3').val()+'&PasswordsecreR3='+$('#txtPassMedsecreR3').val(),
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp1").html(res);
						setTimeout(function(){LoadAllSecreR();},1000);
						
					},
					error:function()
					{
						$(".Resp1").html("Error al cargar");
					}
			});	

	}else{
		alert("Seleccione un permiso");
	}	
}

function ImpEpicrisis2(idepi,idpaci){
		$( "modal-body" ).html("<object type='text/html' data='../Reportes/EpicrisisImp2.php?Paci="+idpaci+"&Epi="+idepi+"'></object>");	
}

function SoliciConsuVer(t,pc){
//$( ".modal-body" ).html("<object type='text/html' data='../Reportes/SolicitudInterconsulta2.php?idPac="+pc+"&id="+t+"'></object>");
$( ".modal-body" ).html("<object type='text/html' data='../Reportes/SolicitudInterconsulta.php?idPac="+pc+"&id="+t+"'></object>");
}
function VerInfoIntercons(t,pc){
 //$( ".modal-body" ).html("<object type='text/html' data='../Reportes/InformeInterconsulta2.php?idPac="+pc+"&id="+t+"'></object>");
 $( ".modal-body" ).html("<object type='text/html' data='../Reportes/InformeInterconsulta.php?idPac="+pc+"&id="+t+"'></object>");
}

function SubirArchivosPaciente() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered table-striped table-condensend table-hover'> <tr> <th >Buscar Paciente</th> <td> <div class='input-append'> <input type='text'  id='txtsearchpac' onkeyup='SearcPacToUpPdf()'> <span class='add-on'><i class='icon-search'></i></span> </div> </td> </tr> </table>");
	$("#txtsearchpac:first").focus();
}
function AgendaCirugiaMes() {
	Home();
	$(".Cabe1").html(" <table class='table table-bordered table-condensend table-striped table-hover'><tr><th colspan=''><center>Agenda Medicos</center></th></tr><tr><th><center><div id='arecmb1'></div><div id='arecmb2'></div></center></th></tr><tr><th><center><a href='#' class='btn btn-succes' onclick='Back();'><i class='icon-backward'></i> </a> <a href='#' class='btn btn-succes' onclick='Next();'><i class='icon-forward'></i></a></center></th></tr></table>");
	LoadCombos();
}
function CitasPacientesAgenda() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td> <center><h4>Citas de pacientes</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span10' id='txtBuscar1'  onkeydown='BuscarPaciente2();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Cita Del Paciente</a> </div> </center> </td> </tr> </table>");
	$("#txtBuscar1:first").focus();
}
function CancelMOdifyCit() {
	$(".Resp2").html("");
}
function CrearCitaNormal() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td> <center><h4>Agendar Cita Medica</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span12' id='txtBuscar6'  onkeypress='BuscarPaciente6();'  type='text'> <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a> </div> </center> </td> </tr> </table>");

	$("#txtBuscar6:first").focus();
}
function AgendaCirugia2() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td> <center><h4>Agenda Cirugia</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span12' id='txtBuscar4'  onkeydown='BuscarPaciente4();'  type='text'> <a class='btn' ><i class='icon-search'></i>Cedula Paciente</a> </div> </center> </td> </tr> </table>");
	$("#txtBuscar4:first").focus();
}
function ExitAgenda() {
	$(".Resp2").html("");
}
function VerCitasDeLosMedicos() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td colspan='2'> <center><h4>Citas de los medicos</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span12' id='txtBuscar7'  onkeypress='BuscarMedico7()'  type='text'> <a class='btn' ><i class='icon-search'></i>Cédula Médico</a> </div> </center> </td> </tr> </table>");
	$("#txtBuscar7:first").focus();
}
function BuscarCitas33() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td colspan='2'> <center><h4>Buscar Citas Cirugias</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span12' id='txtBuscarsercir'  onkeyup='BuscarCirugia()'  type='text'> <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a> </div> </center> </td> </tr> </table>");

	$("#txtBuscarsercir:first").focus();
}
function BuscarProtocolosOpe() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td> <center><h4>Buscar Cita De Cirugia Para Iniciar Protocolo Opertario</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span12' id='txtBuscarVerProto'  onkeypress='BuscarPacienteVerProt();'  type='text'> <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a> </div> </center> </td> </tr> </table>");

	$("#txtBuscarVerProto:first").focus();
}
function CancelProtocolo() {
	$(".Resp2").html("");
}
function FrmEmrgenciaPaciente() {
	Home();
	$(".Cabe1").html("<table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td> <center><h4>Buscar Paciente Para Emeregencia</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span12' id='txtBuscarPAcienteEmergencia'  onkeypress='BuscarEmergencia();'  type='text'> <a class='btn' ><i class='icon-search'></i> Paciente</a> </div> </center> </td> </tr> </table>"); 
	$("#txtBuscarPAcienteEmergencia:first").focus();
}