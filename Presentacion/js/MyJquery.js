$(document).ready(function()
{
		LoadCombos();
		DataEnfermera();
		ShowAgendarCirg();




});

//home
function Home(){
	$("#RespsAgend").css("height","none");
	$("#RespsAgend").css("overflow-y","none");
	$("#RespsAgend").html(""); LoadCombos();
}
//fin home

function Home2(){
	$(".Cabe1").html("");
	$(".Resp1").html("");
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");
}

function Home3(){
	//$(".Cabe1").html("");
	$(".Resp1").html("");
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");
}

function ShowModPaciente()
{
	Home2();
        $(".Cabe1").html("<div id='table-responsive'><table class='table table-bordered table-condensend table-striped table-hover'> <tr> <td> <center><h4>Actualizar datos paciente</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span8' id='txtBuscar2'  onkeydown='BuscarPaciente3();' type='text'> <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a> </div> </center> </td> </tr> </table> </div>");
		
		$("#txtBuscar2:first").focus();
}

function ShowCitaPacientes()
{
	Home2();
        $(".Cabe1").html("<div id='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td><center><h4>Citas de pacientes</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscar1'  onkeypress='BuscarPaciente2();'  type='text'><a class='btn' ><i class='icon-search'></i>Buscar Cita Del Paciente</a></div></center></td></tr></table> </div>");
		
		$("#txtBuscar1:first").focus();
}

function ShowCreateCita()
{
	Home2();
        $(".Cabe1").html("<div id='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td><center><h4>Agendar Cita Médica</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscar6'  onkeypress='BuscarPaciente6();'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Paciente</a></div></center></td></tr></table> </div>");
		
		$("#txtBuscar6:first").focus();
}

function ShowAgendarCirg()
{
	Home2();
	$(".Cabe1").html("<div id='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td><center><h4>Agendar Cirugía</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscar4'  onkeydown='BuscarPaciente4();'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Paciente</a></div></center></td></tr></table> </div>");
		
		$("#txtBuscar4:first").focus();
}

function ShowAgendaCirg()
{
	Home2();
	$(".Cabe1").html(" <div class='table-responsive'><table class='table table-bordered table-condensend table-striped table-hover'><tr><th colspan=''><center>Agenda Médicos</center></th></tr><tr><th><center><div id='arecmb1'></div><div id='arecmb2'></div></center></th></tr><tr><th><center><a href='#' class='btn btn-succes' onclick='Back();'><i class='icon-backward'></i> </a> <a href='#' class='btn btn-succes' onclick='Next();'><i class='icon-forward'></i></a></center></th></tr></table></div>");
	LoadCombos();
}

function ShowCitasMedicos()
{
	Home2();
	$(".Cabe1").html("<div id='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td colspan='2'><center><h4>Citas de los médicos</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscar7'  onkeypress='BuscarMedico7()'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Médico</a></div></center></td></tr></table> </div>");
		
		$("#txtBuscar7:first").focus();
}

function ShowSearchCitasCirg()
{
	Home2();
	$(".Cabe1").html("<div id='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td colspan='2'><center><h4>Buscar Citas Cirugias</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscarsercir'  onkeyup='BuscarCirugia()'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Paciente</a></div></center></td></tr></table> </div>");
		
		$("#txtBuscarsercir:first").focus();
}

function ShowVerProtocolosOp()
{
	Home2();
	$(".Cabe1").html("<div id='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td><center><h4>Buscar Cita De Cirugia Para Iniciar Protocolo Opertario</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscarVerProto'  onkeypress='BuscarPacienteVerProt();'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Paciente</a></div></center></td></tr></table> </div>");
		
		$("#txtBuscarVerProto:first").focus();
}

function CancelProtocolo() {
	ShowVerProtocolosOp();
}

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
//fin funcion para buscar a el paciente para ver su cita y cancelars

//funcion para buscar a el paciente para ver su cita y cancelar
function BuscarPaciente3(){
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
	$(".modal-body").html("<object type='text/html' data='../Reportes/Turno.php?id="+codigo+"'></object>");
	
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
//inicio de la funcion para un nuevo paciente
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
		Home2();
		$(".Resp1").html("<div class='table-responisve'><table class='table table-bordered table-striped table-condensedn'><tr><td>Cédula:</td><td><input type='text' id='txtcedulaUsu1' onkeyup='VerificarCI()' /></td><td>Pasaporte:</td><td><input type='text' id='txtPasport' /></td></tr><tr><td>Paciente:</td> <td colspan='3'><input type='text' class='span10' id='txtapellidoUsu1' /></td></tr>          <tr><td>Medico:</td><td colspan='3'><div class='input-append'><input type='text' class='span12' id='txtnombresUsu1'  /><a href='#myModal' role='button' class='btn' data-toggle='modal'  onclick='AsgnarMedicoPaciente()'> Buscar</a></div></td></tr><tr><td>Otro:</td><td colspan=''><textarea id='txtOtro' cols='40' rows='2'></textarea></td>                                                                                        <td> #Historia</td><td><input type='text' id='txthistoriaR'/></td>                                                                                                                                                                                                                   </tr></tr><tr><td>Fecha de Nacimiento:</td><td><input type='date' id='txtEdadUsu1' onchange='Calcular();' /><td colspan='2'><input type='text' id='TxtEdad123'/></tr><tr><td>Lugar de Nacimiento:</td><td><input type='text' id='txtLugnacim' /><td>Lugar de Residencia:</td><td><input type='text' id='txtLugres' /></td></tr><tr><td>Sexo:</td><td><select id='txtSex'><option value=''>--Seleccione--</option><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select></td><!-- <td>Raza:</td> <td><input type='text' id='txtRaza' /></td><tr><td>Religión:</td><td><input type='text' id='txtReligion' /></td> --><td>Estado civil:</td><td><select id='txtEstadociv'><option value=''>--Seleccione un estado civil--</option><option value='Solter@'>Solter@</option><option value='Casad@'>Casad@</option><option value='Divorciad@'>Divorciad@</option><option value='Viud@'>Viud@</option><option value='Union Libre'>Union Libre</option></select></td></tr><tr><td>Instrucción:</td><td><input type='text' id='txtInstr' /></td><!-- <td>Profesión:</td><td><input type='text' id='txtProf' /></td> --></tr><tr><td>Autorizacion:</td><td><input type='text' id='txtautorizacion'/></td><td>Fecha:</td><td><input type='text' id='txtfechaauto' onchange='CalcularFechaVencimiento()' /></td></tr><tr><td>Fecha V.</td><td><input type='text' id='txtfechaautovenc' readonly /></td></tr><tr><!-- <td>Ocupación:</td><td><input type='text' id='txtOcupe' /></td> --><td>Condición del paciente:</td><td><select id='txtCondpac'><option value=''>--Seleccione una condición--</option><option value='Convenio'>Convenio</option><option value='Empresa'>Empresa</option><option value='Particular'>Particular</option></select></td><td><input type='text' id='txtconve2'/></td></tr><tr><td>Dirección:</td><td><input type='text' id='txtdireccionUsu1'  /></td><td>Teléfono Domicilio:</td><td><input type='text' id='txtTelef'></td><tr><td>Teléfono Trabajo:</td><td><input type='text' id='txtTelefTraba'></td><td>Celular:</td><td><input type='text' id='txtCelular'></td><tr><td>Correo:</td><td><input type='text' id='txtCorreo'></td></tr><tr><td>Referencia: </td><td><input type='text' id='txtNombresRefe'></td><td>Teléfono de Referencia:</td><td><input type='text' id='txtTelefonoRefe'></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td colspan='4'><input type='button' id='bntSaveUsu1' class='btn btn-success' onclick='SavePac();' value='Guardar' /></td></tr>  </table></div>");
		 


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
function SavePac()
{
			if( $('#txtapellidoUsu1').val()!="" )
			{
				$.ajax({
					url:'Procesar.php?accion=NewPaciente&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+"&autori="+$("#txtautorizacion").val()+"&fechaiaut="+$("#txtfechaauto").val()+"&fechafaut="+$("#txtfechaautovenc").val()+"&conve2="+$("#txtconve2").val()+"&NUmeroHistoria="+$("#txthistoriaR").val(),
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


//fin de la funcion para calucluar la edad del paciente//inicio de la funcion para caragar los datos de todas las consultas de hoy

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
		$(".modal-body").html("<table class='table table-hover table-condensend table-striped table-bordered'><tr><th colspan='2'><center>Desea cancelar la cita ?</center></th></tr><tr><td><center><input type='button' value='Aceptar' class='btn btn-success' id='bntOkCancel'/>&nbsp;<input type='button' class='btn btn-danger' data-dismiss='modal' aria-hidden='true' value='Cancelar' id='bntCancel'/></center></td></tr></table>");
		$("#bntOkCancel").button();
		$("#bntCancel").button();
		$("#bntOkCancel").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=CancelarPago&Codigoturno321='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
					setTimeout(function(){
						BuscarPaciente2();
						},1000);
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
				}
			});			
		});
	
}

function DatosAllFiliacion(codigo)
{
	$.ajax({
		url:'Procesar.php?accion=DataAfiliacionPaciente&CodigoPac='+codigo,
		type:'GET' ,
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

function SaveAndModPac(codigo)
{
       $.ajax({
           url:'Procesar.php?accion=ModDataPac&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+'&CodigoPaciente='+codigo+"&autori="+$("#txtautorizacion").val()+"&fechaiaut="+$("#txtfechaauto").val()+"&fechafaut="+$("#txtfechaautovenc").val()+"&condi2="+$("#txtCondicio").val()+'&estadoPac='+$("#cmbestPac").val(),
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                        $(".Resp1").html(res);
                        setTimeout(function()
                        {
                            DatosAllFiliacion(codigo);
                            
                        },2000);
                    },
                    error:function()
                    {
                        $(".Resp1").html("error al cargar");
                    }
                });
    
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

function Ini1CitCirugia(codigo)
{
	$("#txtCodigoPacienteSelecParaCitCir").val(""+codigo+"");
		ComprobarFecha(codigo);

	$.ajax({
			url:'Procesar.php?accion=FrmCirugia&pacientcod='+codigo,
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

function CargarHorarios()
{
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
	if ($("#txtfecprocir").val()!="" & $("#cmb_horacir").val()!="" & $("#txtduropera").val()!="") 
	{

	$(".modal-body").html("");
	$(".modal-body").html("<div class='Cabec1'></div> <div class='Respt1'></div>");
	$(".Cabec1").html("<table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearcciruja' onkeyup='BuscarCirujano()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table>");

	$("#txtsearcciruja:first").focus();
	}else{
		alert("Llene los campos de fecha de cirugia, la hora que epmieza la cirugia, y la duracion de la operacion");
	}
}

function BuscarCirujano()
{
	if($("#txtsearcciruja").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=SearchCirujia&Medico='+$("#txtsearcciruja").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Respt1").html(res);
				},
				error:function()
				{
					$(".Respt1").html("error al cargar");
				}
			});	
	}else{
		$(".Respt1").html("");
	}
}

function AgendCiruj(codigo)
{
	$("#thtcodciruja").val("");
	$("#thtcodciruja").val(""+codigo+"");
	var user=$("#cir_"+codigo+"").html();
	$("#txtCirujano").val(""+user+"");
	$( "#FrmSearchCirja" ).dialog( "close" );

}

function SearchAnestesiologo()
{
	if($("#thtcodciruja").val()!="")
	{

	$(".modal-body").html("");
	$(".modal-body").html("<div class='Cabec1'></div> <div class='Respt1'></div>");
	$(".Cabec1").html("<table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearchanestesiolo' onkeyup='BuscarAnestesiologo()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table>");
	}else{
		alert("Seleccione un cirujano");
	}
}

function BuscarAnestesiologo()
{
	if ($("#txtsearchanestesiolo").val()!="") {
			$.ajax({
				url:'Procesar.php?accion=SearchAnestesiolo&Medico='+$("#txtsearchanestesiolo").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val()+'&CirujCod='+$("#thtcodciruja").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Respt1").html(res);
				},
				error:function()
				{
					$(".Respt1").html("error al cargar");
				}
			});	
	}else{
		$(".Respt1").html("");		
	}
}

function AgendAneste(codigo)
{
	$("#thtcodantesi").val("");
	$("#thtcodantesi").val(""+codigo+"");
	var user=$("#cir_"+codigo+"").html();
	$("#txtanestesiologo").val(""+user+"");	
	$( "#FrmSearchCirja1" ).dialog( "close" );
}
function SearchAyudante()
{
	if ($("#thtcodantesi").val()!="") 
	{
		$(".modal-body").html("");
		$(".modal-body").html("<div class='Cabec1'></div> <div class='Respt1'></div>");
		$(".Cabec1").html("<table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearchayudante' onkeyup='BuscarAyudante()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table>");

	}
	else
	{
		alert("Seleccione un anestesiólogo");
	}
}

function BuscarAyudante()
{
	if ($("#txtsearchayudante").val()!="") 
	{
			$.ajax({
				url:'Procesar.php?accion=SearchAyudante&Medico='+$("#txtsearchayudante").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val()+'&CirujCod='+$("#thtcodciruja").val()+'&AnestesCod='+$("#thtcodantesi").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Respt1").html(res);
				},
				error:function()
				{
					$(".Respt1").html("error al cargar");
				}
			});	
	}else{
		$(".Respt1").html("");		
	}

}

function AgendAyudante(codigo)
{
	$("#thtcodayudan").val("");
	$("#thtcodayudan").val(""+codigo+"");
	var user=$("#cir_"+codigo+"").html();
	$("#txtayudante").val(""+user+"");	
	$( "#FrmSearchCirja2" ).dialog( "close" );
}

function SaveCitaEmergenci()
{
	if ($("#txtCirujano").val()!=""  & $("#cmb_destiemhosp").val()!="" & $("#txtfecprocir").val()!="" & $("#cmb_horacir").val()!="" & $("#txtcirugia2").val()!="" & $("#txtprocedicirug").val()!="" & $("#txttiempohospital").val()!="" & $("#txtobservaciones").val()!="") {
		var tiempoh=$("#txttiempohospital").val()+" "+$("#cmb_destiemhosp").val();
		$.ajax({
				url:'Procesar.php?accion=SaveCirugiaCita&Codayudate='+$("#thtcodayudan").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val()+'&CirujCod='+$("#thtcodciruja").val()+'&AnestesCod='+$("#thtcodantesi").val()+'&Procedimieto='+$("#txtprocedicirug").val()+'&tieHos='+tiempoh+'&Observaciones='+$("#txtobservaciones").val()+'&CodiPacie='+$("#txtCodigoPacienteSelecParaCitCir").val()+'&DuracionCir='+$("#txtduropera").val(),
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
		alert("LLene todos los campos para poder guardar la cita para cirugía");
	}
}

function LoadCombos()
{
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

function LoadAgendaCirugia()
{
	if($("#CmbAnio").val()!="" & $("#cmb_mes").val()!="")
	{
	 			
			var m=$("#cmb_mes").val();
			$("#txtatras").val(""+m+"");
			$.ajax({
				url:'Procesar.php?accion=LoadAgendaCirugia2&aa='+$("#CmbAnio").val()+'&mm='+$("#cmb_mes").val(),
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
 			alert("Seleccione un mes y año para poder visualizar la agenda");
 		}
 }
 
 function RecarDatos(codigo)
 {
	$("#CitaCiru").attr("title","Cita Cirugia");
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
		$( "#CitaCiru" ).dialog( "open" );	 	
		$.ajax({
						url:'Procesar.php?accion=LoadCitaAgendaCirugia&code='+codigo,
						type:'GET',
						cache:false,
						success:function(res)
						{
							$("#CitaCiru").html(res);
						},
						error:function()
						{
							$("#CitaCiru").html("error al cargar");
						}
				});	
 }
 
 function Next()
 {
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
							$(".Resp2").html(res);
						},
						error:function()
						{
							$(".Resp2").html("error al cargar");
						}
				});
	}

 }
 
 function Back()
 {
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
							$(".Resp2").html(res);
						},
						error:function()
						{
							$(".Resp2").html("error al cargar");
						}
				});
	}
 }
 
 function RedactarDatos(codigo)
 {
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
 
  function ImpCitaEmergenci(code)
  {
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

 function VerificarCI()
 {
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
                            //$(".Cabe1").html("");
							NuevoPaciente();
                        }
                        else{
                            $("#bntSaveUsu1").removeAttr("disabled",false);
                        }
                    },
                    error:function()
                    {
                        $(".Cabe1").html("error al cargar");

                    }
                }); 
    }
}

function DelePac(code)
{	
	$(".modal-body").html("<table class='table table-bordered table-striped table-condensend' style='font-family:Times New Roman, Georgia, Serif;'><tr><th colspan='2'><center>Esta seguro que desea eliminar el paciente ?</center></th></tr><tr><td><center><a class='btn btn-danger' id='BtnBorrarOK'> Aceptar</a>&nbsp;<a class='btn btn-primary' data-dismiss='modal' aria-hidden='true' id='cancelarBorrar'> Cancelar</a></center></td></tr></table>");	

		$("#BtnBorrarOK").click(function(){
			 $.ajax({
                    url:'Procesar.php?accion=BorrarPacenteXCOde&CodigoPaciente='+code,
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {

                        $(".modal-body").html(res);
                        setTimeout(function(){
                        	BuscarPaciente3();
                        },1000);
                    },
                    error:function()
                    {
                        $(".modal-body").html("error al cargar");

                    }
                }); 
		});
}


function BuscarPaciente6()
{
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

function AsignarPaciente(code)
{
	ComprobarFecha(code);
	$("#codepaciente").val("");
	$("#codepaciente").val(code);
	
		$.ajax({
			url:'Procesar.php?accion=FRmCrearCita2&pacientcod='+code,
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

function BuscarDoctor()
{
	$("#txtfecprocir02").val("");
	$("#resdoct02").html("");

		$(".modal-body").html("<div class='Cabec1'></div> <div  class='Respt1'></div>");
		$(".Cabec1").html("<table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearcmedico002' onkeyup='BuscarMedio002()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table>");
	
}

function BuscarMedio002()
{
	if($("#txtsearcmedico002").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=BuscarMedico002&Buscar='+$("#txtsearcmedico002").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Respt1").html(res);

				},
				error:function()
				{
					$(".Respt1").html("error al cargar");
				}
			});	
	}else{
		$(".Respt1").html("");
	}
}

function CatchDoc(codigo)
{
	$("#codemedico").val("");
	$("#codemedico").val(""+codigo+"");
	var user=$("#nommed"+codigo+"").html();
	$("#txtmedicio22").val(""+user+"");
	$( "#frmdoct01" ).dialog( "close" );
}

function CargarHorarios02()
{
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
	}
	else
	{
		alert("SELECCIONE UN MÉDICO PRIMERO");
	}
	
}

function SaveTurno002()
{
	$("#btnagendarTurno").attr("disabled", "disabled");
	if ($("#codemedico").val()!="" & $("#txtfecprocir02").val()!=""  & $("#cmb_horacir02").val()!="") 
	{
		$.ajax({
						url:'Procesar.php?accion=AsignarTurno&Paciente1='+$('#codepaciente').val()+'&Especialidad1=1&Doctor1='+$("#codemedico").val()+'&fechaC1='+$("#txtfecprocir02").val()+'&hora1='+$("#cmb_horacir02").val(),
						type:'GET',
						cache:false,
						success:function(res)
						{
							$(".Resp1").html(res);
							/*setTimeout(function(){
								$("#resp6").html("");
								$("#txtBuscar6").val("");	
							},1000); */
						},
						error:function()
						{
							$(".Resp1").html("error al cargar");
						}
					});	
	}
	else 
	{ 
		alert("Llene los campos de médico, fecha, hora para poder guardar el turno");
	}
	
}

function BuscarMedico7()
{
	if($("#txtBuscar7").val()!="")
	{
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
function LoadDataCi(code) {
		$.ajax({
				url:'Procesar.php?accion=LoadDataCi&IDCita='+code,
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

function BuscarFechaMed(code)
{
	$(".Resp2").html("");
	$(".Resp1").html("<div class='table-responsive'><table class='table table-bordered table-striped table-condensend'><tr> <td>Fecha: </td><td><input type='text' id='txtFechaBuscarCitaMedicos' /></td><td ><a class='btn btn-info' onclick='BuscarDiaMedicoCita("+code+")' > Buscar</a></td>       <td>Seleccione 1 Dia de la semana:</td><td><input type='text' id='txtFechai1'/></td><td colspan='4'><a class='btn btn-success' onclick='BuscarPorFechas1("+code+")'> Buscar</a></td></tr>            <tr><td>Fecha de inicio:</td><td><input type='text' id='txtFechai'/></td><td>Fecha final:</td><td><input type='text' id='txtfechaf'/></td><td colspan='3'><a class='btn btn-success' onclick='BuscarPorFechas("+code+")'> Buscar</a></td></tr><tr><td>Mes: </td><td colspan='3'><select class='cmb_mes002'><option value=''>--Seleccione--</option><option value='1'>Enero</option><option value='2'>Febrero</option><option value='3'>Marzo</option><option value='4'>Abril</option><option value='5'>Mayo</option><option value='6'>Junio</option><option value='7'>Julio</option><option value='8'>Agosto</option><option value='9'>Septiembre</option><option value='10'>Octubre</option><option value='11'>Noviembre</option><option value='12'>Diciembre</option></select></td><td colspan='4'><a class='btn btn-primary' onclick='BuscarXMesDoc("+code+")'> Buscar</a></td></tr></table></div>");


		$('#txtFechai1').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtFechai1').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );

		$('#txtfechaf1').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtfechaf1').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );


		
		$('#txtFechaBuscarCitaMedicos').datepicker({
				changeMonth: true,
				changeYear: true
			});
			$('#txtFechaBuscarCitaMedicos').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );

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
function BuscarDiaMedicoCita(code) {
	if($("#txtFechaBuscarCitaMedicos").val()!=""  )
	{
		$.ajax({
				url:'Procesar.php?accion=BuscarDiaMedicoCita&IDDOc='+code+'&FechaI='+$("#txtFechaBuscarCitaMedicos").val(),
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
		alert("Selecione 1 fecha");
	}
}
function BuscarPorFechas1(code){
	if($("#txtFechai1").val()!="" )
	{	
			$.ajax({
				url:'Procesar.php?accion=BuscarCitasMedicoXSemanaDesing&IDDOc='+code+'&FechaI='+$("#txtFechai1").val(),
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
		alert("Selecione las fechas");
	}
}
function BuscarPorFechas(code)
{
	if($("#txtFechai").val()!=""  & $("#txtfechaf").val()!="")
	{
		$.ajax({
				url:'Procesar.php?accion=BuscarCitasMedicoXFechas&IDDOc='+code+'&FechaI='+$("#txtFechai").val()+'&FechaF='+$("#txtfechaf").val(),
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
		alert("Selecione las fechas");
	}
}

function BuscarXMesDoc(code)
{
	if($(".cmb_mes002").val()!="" )
	{
		$.ajax({
				url:'Procesar.php?accion=BuscadorCitasXMes&IDDOc='+code+'&mes='+$(".cmb_mes002").val(),
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
		alert("Seleccione un mes");
	}
}

function ComprobarFecha(code)
{
	$( ".modal-body" ).html("");
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

/*modificar cita  medica buscando a el paciente*/


function ModificarCita(code)
{	
		$.ajax({
			url:'Procesar.php?accion=ModificarCitaMedicav1&CodigoTurno='+code,
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


function SaveModificarTurno002(code)
{

if ($("#codemedico").val()!="" & $("#txtfecprocir02").val()!=""  & $("#cmb_horacir02").val()!="") {
	$.ajax({
					url:'Procesar.php?accion=MoficarCitaMedica&Paciente1='+$('#codepaciente').val()+'&Especialidad1=1&Doctor1='+$("#codemedico").val()+'&fechaC1='+$("#txtfecprocir02").val()+'&hora1='+$("#cmb_horacir02").val()+"&codigoTurno="+code,
					type:'GET',
					cache:false,
					success:function(res)
					{
						$(".Resp1").html(res);
						setTimeout(function(){
							$("#resp6").html("");
							$("#txtBuscar6").val("");	
						},1000);
					},
					error:function()
					{
						$(".Resp1").html("error al cargar");
					}
				});	
	}else { alert("Llene los campos de medico, fecha, hora para poder guardar el turno");}
}

/*modificar cita  medica buscando a el paciente*/


function BuscarCirugia()
{
	if($("#txtBuscarsercir").val()!="")
	{
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

function DataEnfermera()
{
		$.ajax({
			url:'Procesar.php?accion=DataEnf',
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


function Controll(){
    
    setTimeout(function(){
       $.ajax({
                    url:'Procesar.php?accion=CloseWindows',
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                        location.reload(true);
                    },
                    error:function()
                    {
                        $(".Resp1").html("error al cargar");
                    }
        });
    },1800000);//1800000    600000
}


//posicionar fecha de hoy en campos de fecha
function hoy(){

var today = moment().format('YYYY-MM-DD');
//	alert(today);
$('#txtdatecirugina').val(today);
$('#txtfecha2').val(today);
$('#txtfecha3').val(today);

}