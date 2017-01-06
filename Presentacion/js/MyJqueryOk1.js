// JavaScript Document
$(document).ready(function()
{
	DataDoctor();
	LoadCombos();
 
$("#FormularioIniEF").hide();
$("#Form2Search").hide();
$("#Form3Search").hide();
$("#Form4Search").hide();
$("#Form5Search").show();
$("#Form6Search").hide();
$("#Form7Search").hide();
$("#FormSearchCirugia").hide();

//LoadDataDoc();

$("#home").click(function(){
	$("#FormularioIniEF").show();
	$("#Form2Search").hide();
	$("#Form3Search").hide();
	$("#Form4Search").hide();
	$("#Form5Search").hide();
	$("#Form6Search").hide();
	$("#Form7Search").hide();
	$("#Form8Search").hide();
	$("#FormSearchCirugia").hide();
	Home();
});

$("#agend1").click(function(){
	$("#FormularioIniEF").hide();
	$("#Form2Search").show();
	$("#Form3Search").hide();
	$("#Form4Search").hide();
	$("#Form5Search").hide();
	$("#Form6Search").hide();
	$("#Form7Search").hide();
	$("#Form8Search").hide();
	$("#FormSearchCirugia").hide();
	Home();
});

$("#modpac").click(function(){
	$("#FormularioIniEF").hide();
	$("#Form2Search").hide();
	$("#Form3Search").show();
	$("#Form4Search").hide();
	$("#Form5Search").hide();
	$("#Form6Search").hide();
	$("#Form7Search").hide();
	$("#Form8Search").hide();
	$("#FormSearchCirugia").hide();
	Home();
});

$("#agend2").click(function(){
	$("#FormularioIniEF").hide();
	$("#Form2Search").hide();
	$("#Form3Search").hide();
	$("#Form4Search").show();
	$("#Form5Search").hide();
	$("#Form6Search").hide();
	$("#Form7Search").hide();
	$("#Form8Search").hide();
	$("#FormSearchCirugia").hide();
	Home();
});

$("#agendCirug").click(function(){
	$("#FormularioIniEF").hide();
	$("#Form2Search").hide();
	$("#Form3Search").hide();
	$("#Form4Search").hide();
	$("#Form5Search").show();
	$("#Form6Search").hide();
	$("#Form7Search").hide();
	$("#Form8Search").hide();
	$("#FormSearchCirugia").hide();
	
	Home();
});


$("#buscarcitacirugia").click(function(){
	$("#FormularioIniEF").hide();
	$("#Form2Search").hide();
	$("#Form3Search").hide();
	$("#Form4Search").hide();
	$("#Form5Search").hide();
	$("#Form6Search").hide();
	$("#Form7Search").hide();
	$("#Form8Search").hide();
	$("#FormSearchCirugia").show();
	Home();
});


$("#updatemedi").click(function(){
	$("#FormularioIniEF").show();
	$("#Form2Search").hide();
	$("#Form3Search").hide();
	$("#Form4Search").hide();
	$("#Form5Search").hide();
	$("#Form6Search").hide();
	$("#Form7Search").hide();
	$("#Form8Search").hide();
	$("#FormSearchCirugia").hide();
	Home();
	
});






});
//home
function Home(){
	$(".MainAreaPrEf").html("");
	$(".MainAreaPrEf2").html("");
	$("#txtBuscar").val("");
	$("#txtBuscar1").val("");
	$("#txtBuscar2").val("");
	$("#txtBuscar4").val("");
	$("#txtBuscarsercir").val("");
	$("#respsercrugi").html("");
	$("#").html("");
	$("#").html("");
	$("#").html("");
	$("#").html("");
	$("#").html("");
	$("#").html("");
	$("#RespsAgend").css("height","none");
	$("#RespsAgend").css("overflow-y","none");
	$("#RespsAgend").html(""); LoadCombos();

}

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
//fin home

function VerAgendaCirug()
{
	Home2();
	$(".Cabe1").html(" <div class='table-responsive'><table class='table table-bordered table-condensend table-striped table-hover'><tr><th colspan=''><center>Agenda Medicos</center></th></tr><tr><th><center><div id='arecmb1'></div><div id='arecmb2'></div></center></th></tr><tr><th><center><a href='#' class='btn btn-succes' onclick='Back();'><i class='icon-backward'></i> </a> <a href='#' class='btn btn-succes' onclick='Next();'><i class='icon-forward'></i></a></center></th></tr></table><div class='Resp1'></div><input type='hidden' id='txtadelante'><input type='hidden' id='txtatras'></div>");
	LoadCombos();
}

function BuscarCitasCirg()
{
	Home2();
	$(".Cabe1").html("<div class='table-responsive' ><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td colspan='2'><center><h4>Buscar Citas Cirugías</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span12' id='txtBuscarsercir'  onkeyup='BuscarCirugia()'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Paciente</a></div></center></td></tr></table></div>");
	$("#txtBuscarsercir:first").focus();
}

function ShowModPaciente()
{
	Home2();
	$(".Cabe1").html("<div class='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td><center><h4>Actualizar datos paciente</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscar2'  onkeydown='BuscarPaciente3();'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Paciente</a></div></center></td></tr></table></div>");
	$("#txtBuscar2:first").focus();
}

function ShowModMedico()
{
	Home2();
	$(".Cabe1").html("<div class='table-responsive'><table class='table table-hover table-striped table-condensend table-bordered'><tr><td> <center> <div class='input-append'> <input class='span10' id='txtBuscar10'  onkeyup='BuscarMedico();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar Médico</a> </div> </center></td></tr></table></div></div>");

	$("#txtBuscar10:first").focus();
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
				$(".MainAreaPrEf").html(res);
			},
			error:function()
			{
				$(".MainAreaPrEf").html("error al cargar");
			}
		});
			
	}else{
		$(".MainAreaPrEf").html("");
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
				$(".MainAreaPrEf").html(res);
			},
			error:function()
			{
				$(".MainAreaPrEf").html("error al cargar");
			}
		});
			
	}else{
		$(".MainAreaPrEf").html("");
	}
}
//fin funcion para buscar a el paciente para ver su cita y cancelar
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



function VerificarCIMed(){
    var numci=$("#txtCedulaMedNew").val();
    if(numci.length>9){
        $.ajax({
                    url:'Procesar.php?accion=ComprovandoCIDBMed&CedulaMed1='+$('#txtCedulaMedNew').val(),
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                        //$("#RespuestaNewPaciente").html(res);
                        var num = parseInt(res);
                        if(num>0){
                            alert("Esta Cedula Ya Existe en la base de datos");
                            $("#bntSaveMed1").attr("disabled",true);
                            $(".Resp1").html("");
                        }
                        else{
                            $("#bntSaveMed1").removeAttr("disabled",false);
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
		Home2();
		$(".Resp1").html("<div class='table-responisve'><table class='table table-bordered table-striped table-condensedn'><tr><td>Cédula:</td><td><input type='text' id='txtcedulaUsu1' onkeyup='VerificarCI()' /></td><td>Pasaporte:</td><td><input type='text' id='txtPasport' /></td></tr><tr><td>Paciente:</td> <td colspan='3'><input type='text' class='span10' id='txtapellidoUsu1' /></td></tr>          <tr><td>Medico:</td><td colspan='3'><div class='input-append'><input type='text' class='span12' id='txtnombresUsu1'  /><a href='#myModal' role='button' class='btn' data-toggle='modal'  onclick='AsgnarMedicoPaciente()'> Buscar</a></div></td></tr><tr><td>Otro:</td><td colspan=''><textarea id='txtOtro' cols='40' rows='2'></textarea></td>                                                                                              <td> #Historia</td><td><input type='text' id='txthistoriaR'/></td>                                                                                                                                                                                                                    </tr></tr><tr><td>Fecha de Nacimiento:</td><td><input type='date' id='txtEdadUsu1' onchange='Calcular();' /><td colspan='2'><input type='text' id='TxtEdad123'/></tr><tr><td>Lugar de Nacimiento:</td><td><input type='text' id='txtLugnacim' /><td>Lugar de Residencia:</td><td><input type='text' id='txtLugres' /></td></tr><tr><td>Sexo:</td><td><select id='txtSex'><option value=''>--Seleccione--</option><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select></td><!-- <td>Raza:</td> <td><input type='text' id='txtRaza' /></td><tr><td>Religión:</td><td><input type='text' id='txtReligion' /></td> --><td>Estado civil:</td><td><select id='txtEstadociv'><option value=''>--Seleccione un estado civil--</option><option value='Solter@'>Solter@</option><option value='Casad@'>Casad@</option><option value='Divorciad@'>Divorciad@</option><option value='Viud@'>Viud@</option><option value='Union Libre'>Union Libre</option></select></td></tr><tr><td>Instrucción:</td><td><input type='text' id='txtInstr' /></td><!-- <td>Profesión:</td><td><input type='text' id='txtProf' /></td> --></tr><tr><td>Autorizacion:</td><td><input type='text' id='txtautorizacion'/></td><td>Fecha:</td><td><input type='text' id='txtfechaauto' onchange='CalcularFechaVencimiento()' /></td></tr><tr><td>Fecha V.</td><td><input type='text' id='txtfechaautovenc' readonly /></td></tr><tr><!-- <td>Ocupación:</td><td><input type='text' id='txtOcupe' /></td> --><td>Condición del paciente:</td><td><select id='txtCondpac'><option value=''>--Seleccione una condición--</option><option value='Convenio'>Convenio</option><option value='Empresa'>Empresa</option><option value='Particular'>Particular</option></select></td><td><input type='text' id='txtconve2'/></td></tr><tr><td>Dirección:</td><td><input type='text' id='txtdireccionUsu1'  /></td><td>Teléfono Domicilio:</td><td><input type='text' id='txtTelef'></td><tr><td>Teléfono Trabajo:</td><td><input type='text' id='txtTelefTraba'></td><td>Celular:</td><td><input type='text' id='txtCelular'></td><tr><td>Correo:</td><td><input type='text' id='txtCorreo'></td></tr><tr><td>Referencia: </td><td><input type='text' id='txtNombresRefe'></td><td>Teléfono de Referencia:</td><td><input type='text' id='txtTelefonoRefe'></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td colspan='4'><input type='button' id='bntSaveUsu1' class='btn btn-success' onclick='SavePac();' value='Guardar' /></td></tr>  </table></div>");
		 


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

function SaveNewUser()
{
	if($('#txtcedulaUsu1').val()!="" & $('#txtapellidoUsu1').val()!="" & $('#txtnombresUsu1').val()!="" & $('#txtdireccionUsu1').val()!="" & $('#txtEdadUsu1').val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=NewPaciente&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val(),
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
	$( "#AreaCancelarCita" ).attr("title","Cancelar Cita");
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
		$( "#AreaCancelarCita" ).dialog("open");
		$( "#AreaCancelarCita").html("<table class='table table-hover table-condensend table-striped table-bordered'><tr><td><input type='button' value='Aceptar' class='btn btn-success' id='bntOkCancel'/></td><td><input type='button' class='btn btn-danger' value='Salir' id='bntCancel'/></td></tr></table>");
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
					$("#AreaCancelarCita").html(res);
					setTimeout(function(){LoadAllConsutasHoy();},1000);
				},
				error:function()
				{
					$("#AreaCancelarCita").html("error al cargar");
				}
			});			
		});
		$("#bntCancel").click(function()
		{
			$( "#AreaCancelarCita" ).dialog("close");
		});
	
}



function DatosAllFiliacion(codigo)
{
	Home3();
		$.ajax({
			url:'Procesar.php?accion=DataAfiliacionPaciente&CodigoPac='+codigo,
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
							BuscarPaciente3();
							
						},2000); 
					},
					error:function()
					{
						$(".Resp1").html("error al cargar");
					}
				});
	
}


function LoadDataDoc(){
	Home3();
		$.ajax({
					url:'Procesar.php?accion=LoadDataDoc',
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
		LoadDataDoc();
	}
}



function LoadDataDoc()
{
	Home3();
		$.ajax({
					url:'Procesar.php?accion=LoadDataDoc',
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
		LoadDataDoc();
	}
}
function ModMed(codigo)
{
	Home3();
		$.ajax({
					url:'Procesar.php?accion=LoadDataMedico&CodMedico='+codigo,
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
function CloseMeModMed(){ $( "#ModMedico" ).dialog( "close" );	 }

function DeleMed(codigo)
{
		$(".modal-body").html("<table class='table table-bordered table-striped table-condensend table-hover' style='font-family:Times New Roman, Georgia, Serif;'><tr><th colspan='2'><center>Esta seguro que desea eliminar el médico ?</center></th></tr><tr><td><center><a class='btn btn-primary'  id='ConfirmDeleteMed' > <i class='icon-ok' ></i> Aceptar</a>&nbsp;<a class='btn btn-success' data-dismiss='modal' aria-hidden='true'><i class='icon-remove'></i> Cancelar</a></center></td></tr></table>");
		
		$("#ConfirmDeleteMed").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteUser&IDUser='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
					setTimeout(function()
							{
								LoadDataDoc();
							},1000);
				},
				error:function()
				{
					$(".modal-body").html("error al cargar");
				}
			});			
		});
}

// --------------------------------------- modulo adm 1 ---------------------------------------------//

//Modal nuevo medico
/*
function NuevoMedico()
{
	Home2();
		$.ajax({
			url:'Procesar.php?accion=NewMedico',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Cabe1").html(res);
				setTimeout(function(){
					LoadDataDoc();
				},1000);

			},
			error:function()
			{
				$(".Cabe1").html("error al cargar");
			}
		});
}*/
//Fin modal nuevo medico

//Cancelar nuevo medico
function CloseNewMed()
{
	$( "#NewMedico" ).dialog( "close" );
}
function CloseMeModMed(){ $( "#ModMedico" ).dialog( "close" );	 }
//Fin cancelar nuevo medico

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
					$(".Cabe1").html(res);
					setTimeout(function(){LoadDataDoc()},1000);
					setTimeout(function()
					{
						$( ".Cabe1" ).dialog( "close" );
					},2000);
				},
				error:function()
				{
					$(".Cabe1").html("error al cargar");
					setTimeout(function(){LoadDataDoc()},1000);
					setTimeout(function()
					{
						$( ".Cabe1" ).dialog( "close" );
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
					$(".Cabe1").html(res);
					setTimeout(function(){LoadDataDoc()},1000);
					setTimeout(function()
					{
						$( ".Cabe1" ).dialog( "close" );
					},2000);
				},
				error:function()
				{
					$(".Cabe1").html("error al cargar");
					setTimeout(function(){LoadDataDoc()},1000);
					setTimeout(function()
					{
						$( ".Cabe1" ).dialog( "close" );
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
					$(".Resp1").html(res);
					setTimeout(function(){LoadDataDoc()},1000);
					/*setTimeout(function()
					{
						$( "#ModMedico" ).dialog( "close" );
					},2000); */
				},
				error:function()
				{
					$(".Resp1").html("error al cargar");
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
						$(".Resp1").html(res);
						setTimeout(function(){LoadDataDoc()},1000);
						/*setTimeout(function()
						{
							$( "#ModMedico" ).dialog( "close" );
						},2000); */
					},
					error:function()
					{
						$(".Resp1").html("error al cargar");
					}
				});
				}
			else
			{
				alert ("Complete los campos para continuar");
			}
				
}

//fin modificar medico

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





/*
 *	funciones para cargar la agenda de cirugias
 *
 *
 *
 */
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
 		if($("#CmbAnio").val()!=undefined){


 			if($("#CmbAnio").val()!="" & $("#cmb_mes").val()!=""){
	 			
				var m=$("#cmb_mes").val();
				$("#txtatras").val(""+m+"");
				$.ajax({
						url:'Procesar.php?accion=LoadAgendaCirugia&aa='+$("#CmbAnio").val()+'&mm='+$("#cmb_mes").val(),
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
 				alert("Seleccione un mes y año para poder visualizar la agenda");
 			}
 		}else{
 			$(".Resp2").html("");
 		}
 }
 
 function RecarDatos(codigo)
 {
	/* $("#CitaCiru").attr("title","Cita Cirugia");
	$( "#CitaCiru" ).dialog({
			autoOpen: false,
			modal: true,
			height:550,
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
		$( "#CitaCiru" ).dialog( "open" );	*/ 	

		$("#txthidecodigocitaok1").val(codigo);


		$.ajax({
						url:'Procesar.php?accion=LoadCitaAgendaCirugia&code='+codigo,
						type:'GET',
						cache:false,
						success:function(res)
						{
							$(".Resp1").html("");
							setTimeout(function(){
								$(".Resp2").html(res);
							},1000); 
						},
						error:function()
						{
							$(".Resp2").html("error al cargar");
						}
				});
 }
 //actualizar el estado de la cita de emergencia
 function UpdateCitaEmergenci(code){
 	var estado;
 	switch($("#cmbEstado").val()){
 		case'1':
 			estado="P";
 		break;
 		case'2':
 			estado="C";
 		break;
 		case'3':
 			estado="K";
 		break;
 	}

 			$.ajax({
						url:'Procesar.php?accion=UpDateCitCir&code='+code+'&esta='+estado,
						type:'GET',
						cache:false,
						success:function(res)
						{
							$(".Resp2").html(res);
							setTimeout(function(){
								LoadAgendaCirugia();
							},1000);
						},
						error:function()
						{
							$(".Resp2").html("error al cargar");
						}
				});	

 }
 function ImpCitaEmergenci(code)
 {
		$(".modal-body").html("<object type='text/html' data='../Reportes/CitaCirugiaImp.php?code="+code+"'></object>");
 }
 function Next(){
	var aux=parseInt($("#txtatras").val());
	aux=aux+1;
	if(aux<=12){
		$('#cmb_mes').prop('selectedIndex',aux);
		$("#txtatras").val(""+aux+"");
		$.ajax({
						url:'Procesar.php?accion=LoadAgendaCirugia&aa='+$("#CmbAnio").val()+'&mm='+aux,
						type:'GET',
						cache:false,
						success:function(res)
						{
							$(".Resp2").html(res);
							//$(".Resp2").html("");
						},
						error:function()
						{
							$(".Resp2").html("error al cargar");
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
						url:'Procesar.php?accion=LoadAgendaCirugia&aa='+$("#CmbAnio").val()+'&mm='+aux,
						type:'GET',
						cache:false,
						success:function(res)
						{
							$(".Resp2").html(res);
							//$(".Resp2").html("");
						},
						error:function()
						{
							$(".Resp2").html("error al cargar");
						}
				});
	}
 }

//Modal nuevo medico
function NuevoMedico()
{
	Home2();
		$.ajax({
			url:'Procesar.php?accion=NewMedico',
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
//Fin modal nuevo medico

//delete paciente 2
 function DelePac(codigo)
 {
	 $(".modal-body").html("<table class='table table-striped table-bordered' style='font-family:Times New Roman, Georgia, Serif; font-size:16px;'><tr><th colspan='4' style='text-align:center'>Desea eliminar el paciente ?</th></tr><tr><td><center><input type='button' class='btn btn-success' value='Aceptar' id='ConfirmarDeletePacie' />&nbsp;<input type='button' value='Cancelar' class='btn btn-danger' data-dismiss='modal' aria-hidden='true' id='CancelDeletePacie'/></center></td></tr></table>");
		
		$("#ConfirmarDeletePacie").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeletePaciente&IDPaciente='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".modal-body").html(res);
					setTimeout(function()
							{
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
  //Fin delete paciente 2

function ModCitaEmerge(code){
			$.ajax({
				url:'Procesar.php?accion=ModificarCitaCiruPOrAdmDow&CitaCirCode='+code,
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


 function SearCirujano(){

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
		$(".CabeModal").html("<div class='table-responsive'><table class='table table-bordered table-striped table-condensend'><tr><td><center><div class='input-append'><input type='text' id='txtsearcciruja' onkeyup='BuscarCirujano()'/><a class='btn' ><i class='icon-search'></i> Buscar</a></div><center></td></tr></table></div>");
	}else{
		alert("Llene los campos de fecha de cirugia, la hora que epmieza la cirugia, y la duracion de la operacion");
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
		$(".CuerModal").html("");
	}
}

function AgendCiruj(codigo){
	$("#thtcodciruja").val("");
	$("#thtcodciruja").val(""+codigo+"");
	var user=$("#cir_"+codigo+"").html();
	$("#txtCirujano").val(""+user+"");
	$( "#FrmSearchCirja" ).dialog( "close" );

}

function SearchAnestesiologo(){
	if($("#thtcodciruja").val()!=""){

	$(".modal-body").html("");
	$(".modal-body").html("<div class='CabeModal'></div> <div class='CuerModal'></div>");
	/*$("#ResSearchCirja1").html("");
	$( "#FrmSearchCirja1" ).attr("title","Buscar Anestesiologo");
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


function ModificarCitaCirujia(code){
	if ($("#txtCirujano").val()!="" & $("#txtanestesiologo").val()!=""  & $("#cmb_destiemhosp").val()!="") {
		var tiempoh=$("#txttiempohospital").val()+" "+$("#cmb_destiemhosp").val();
		$.ajax({
				url:'Procesar.php?accion=SaveModificarCirugiaCita&Codayudate='+$("#thtcodayudan").val()+'&fecha='+$("#txtfecprocir").val()+'&Hora='+$("#cmb_horacir").val()+'&CirujCod='+$("#thtcodciruja").val()+'&AnestesCod='+$("#thtcodantesi").val()+'&Procedimieto='+$("#txtprocedicirug").val()+'&tieHos='+tiempoh+'&Observaciones='+$("#txtobservaciones").val()+'&CodiPacie='+$("#txtCodigoPacienteSelecParaCitCir").val()+'&DuracionCir='+$("#txtduropera").val()+"&CodeCirugia="+code,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".Resp2").html(res);
					setTimeout(function(){
						//LoadAgendaCirugia();
						RecarDatos(code);
					},1000);
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
function CloseCitCir(){
	$(".Resp2").html("");	 	
}


function BuscarCirugia(){
	if($("#txtBuscarsercir").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=BuscadorCitasCirugiaXPac2&Buscar='+$("#txtBuscarsercir").val()+'&rol=2',
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










// on window resize run function
$(window).resize(function () {
    fluidDialog();
});

// catch dialog if opened within a viewport smaller than the dialog width
$(document).on("dialogopen", ".ui-dialog", function (event, ui) {
    fluidDialog();
});

function fluidDialog() {
    var $visible = $(".ui-dialog:visible");
    // each open dialog
    $visible.each(function () {
        var $this = $(this);
        var dialog = $this.find(".ui-dialog-content").data("ui-dialog");
        // if fluid option == true
        if (dialog.options.fluid) {
            var wWidth = $(window).width();
            // check window width against dialog width
            if (wWidth < (parseInt(dialog.options.maxWidth) + 50))  {
                // keep dialog from filling entire screen
                $this.css("max-width", "90%");
            } else {
                // fix maxWidth bug
                $this.css("max-width", dialog.options.maxWidth + "px");
            }
            //reposition dialog
            dialog.option("position", dialog.options.position);
        }
    });

}

function ReloadAgenda(){
	RecarDatos($("#txthidecodigocitaok1").val());
}