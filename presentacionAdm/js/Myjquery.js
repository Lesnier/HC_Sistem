// JavaScript Document
$(document).ready(function()
{
$("#menufenix").menu();



$("#MainUsuario").show();
$("#MainRoles").hide();
$("#MainEspecialidad").hide();
$("#MainPaciente").hide();
$("#MainBodega").hide();

$("#ShowUsuer").click(function()
{
	$("#MainUsuario").show();
	$("#MainRoles").hide();
	$("#MainEspecialidad").hide();
	$("#MainPaciente").hide();
	$("#MainBodega").hide();	
});

$("#ShowRol").click(function()
{
	$("#MainUsuario").hide();
	$("#MainRoles").show();
	$("#MainEspecialidad").hide();
	$("#MainPaciente").hide();
	$("#MainBodega").hide();	
});

$("#ShowEspe").click(function()
{
	$("#MainUsuario").hide();
	$("#MainRoles").hide();
	$("#MainEspecialidad").show();
	$("#MainPaciente").hide();
	$("#MainBodega").hide();	
});

$("#ShowPac").click(function()
{
	$("#MainUsuario").hide();
	$("#MainRoles").hide();
	$("#MainEspecialidad").hide();
	$("#MainPaciente").show();
	$("#MainBodega").hide();	
});


$("#ShowBode").click(function()
{
	$("#MainUsuario").hide();
	$("#MainRoles").hide();
	$("#MainEspecialidad").hide();
	$("#MainPaciente").hide();
	$("#MainBodega").show();	
});


CargarUsuarios();
CargarAllRoles();
CargarAllEspecialidades();
CargarAllPacientes();
CargarAllFarmacos();

});




function CargarUsuarios()
{
		$.ajax({
			url:'Procesar.php?accion=LoadUsuarios',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#MainUsuario").html(res);
			},
			error:function()
			{
				$("#MainUsuario").html("error al cargar");
			}
		});	
}
function ShowNewUser()
{
	$( "#ShowNewUser2" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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
		$( "#ShowNewUser2" ).dialog( "open" );
		$.ajax({
			url:'Procesar.php?accion=NewUser',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#ShowNewUser2").html(res);
			},
			error:function()
			{
				$("#ShowNewUser2").html("error al cargar");
			}
		});	
		
	
}
function SaveUser()
{
		$.ajax({
			url:'Procesar.php?accion=SaveNewUser&Cedula='+$("#txtCedula").val()+'&apellido='+$("#txtapellido").val()+'&nombres='+$("#txtnombres").val()+'&edad='+$("#txtEdad").val()+'&direccion='+$("#txtDireccion").val()+'&Login='+$("#txtLogin").val()+'&pass='+$("#txtpassword").val()+'&rol='+$("#cmbrol").val()+'&especialida='+$("#cmbesp").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#ShowNewUser2").html(res);
			},
			error:function()
			{
				$("#ShowNewUser2").html("error al cargar");
			}
		});	
		setTimeout(function()
		{
			CargarUsuarios();
		},1000);
	
}
function ShowModificarUser(codigo)
{
	$( "#AreParaModificarElUsaurio" ).dialog({
			autoOpen: false,
			modal: true,
			height:370,
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
		$( "#AreParaModificarElUsaurio" ).dialog( "open" );
		$.ajax({
			url:'Procesar.php?accion=LoadaMddificarUsuario&CodiMod='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreParaModificarElUsaurio").html(res);
			},
			error:function()
			{
				$("#AreParaModificarElUsaurio").html("error al cargar");
			}
		});		
}
function ModificarUser(codigo)
{
		$.ajax({
			url:'Procesar.php?accion=ModificarUser&CodigoMod='+codigo+'&ApellidoUser='+$("#txtApeUs").val()+'&NombresUser='+$("#txtNombUs").val()+'&edadUser='+$("#txtEdadUs").val()+'&loginUser='+$("#txtLogdUs").val()+'&passUser='+$("#txtPassdUs").val()+'&direccionUsu='+$("#txtDirecUs").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreParaModificarElUsaurio").html(res);
			},
			error:function()
			{
				$("#AreParaModificarElUsaurio").html("error al cargar");
			}
		});	
		setTimeout(function()
		{
			CargarUsuarios();
		},1000);
			
	
}
function ShowDeleteUser(codigo)
{
	$( "#EliminarUsuario" ).dialog({
			autoOpen: false,
			modal: true,
			height:150,
			width:270,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#EliminarUsuario" ).dialog( "open" );
		$("#EliminarUsuario").html("<table><tr><td><input type='button' value='Aceptar' class='btn btn-success' id='ConfirmarDeleteUser' /></td><td><input type='button' class='btn btn-danger' value='Cancelar' id='CancelDelete'/><td></tr></table>");
		$("#ConfirmarDeleteUser").button();
		$("#CancelDelete").button();
		$("#ConfirmarDeleteUser").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteUser&IDUser='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#EliminarUsuario").html(res);
				},
				error:function()
				{
					$("#EliminarUsuario").html("error al cargar");
				}
			});			
			setTimeout(function()
							{
								CargarUsuarios();
							},1000);
		});
		$("#CancelDelete").click(function()
		{
			$( "#EliminarUsuario" ).dialog( "close" );
		});		
	
}
function CargarAllRoles()
{
			$.ajax({
				url:'Procesar.php?accion=CargarRoles',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#MainRoles").html(res);
				},
				error:function()
				{
					$("#MainRoles").html("error al cargar");
				}
			});		
}
function ShowModificarRol(codigo)
{
	$( "#AreDeModificarRol" ).dialog({
			autoOpen: false,
			modal: true,
			height:300,
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
		$( "#AreDeModificarRol" ).dialog( "open" );
		$.ajax({
			url:'Procesar.php?accion=LoadaModificarRol&CodiModRol='+codigo,
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreDeModificarRol").html(res);
			},
			error:function()
			{
				$("#AreDeModificarRol").html("error al cargar");
			}
		});		
	
}
function ModificarRol(codigo)
{
		$.ajax({
			url:'Procesar.php?accion=ModificarRl&CodiModRol1='+codigo+'&descRol='+$("#txtDesRol").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$("#AreDeModificarRol").html(res);
			},
			error:function()
			{
				$("#AreDeModificarRol").html("error al cargar");
			}
		});	
			setTimeout(function()
							{
								CargarAllRoles();
							},1000);
	
}
function ShowDeleteRol(codigo)
{
	$( "#ShowDeleteRl" ).dialog({
			autoOpen: false,
			modal: true,
			height:150,
			width:270,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#ShowDeleteRl" ).dialog( "open" );
		$("#ShowDeleteRl").html("<table><tr><td><input type='button' value='Aceptar' id='ConfirmarDeleteRol' /></td><td><input type='button' value='Cancelar' id='CancelDeleteRol'/><td></tr></table>");
		$("#ConfirmarDeleteRol").button();
		$("#CancelDeleteRol").button();
		$("#ConfirmarDeleteRol").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteUser&IDUser='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#ShowDeleteRl").html(res);
				},
				error:function()
				{
					$("#ShowDeleteRl").html("error al cargar");
				}
			});			
			setTimeout(function()
							{
								CargarUsuarios();
							},1000);
		});
		$("#CancelDeleteRol").click(function()
		{
			$( "#ShowDeleteRl" ).dialog( "close" );
		});		
	
	
}
function CargarAllEspecialidades()
{
			$.ajax({
				url:'Procesar.php?accion=CargarEspecialidades',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#MainEspecialidad").html(res);
				},
				error:function()
				{
					$("#MainEspecialidad").html("error al cargar");
				}
			});		
}
function ShowNewEspe()
{
	$( "#NuevaEspecialidad" ).dialog({
			autoOpen: false,
			modal: true,
			height:250,
			width:270,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#NuevaEspecialidad" ).dialog( "open" );
		$( "#NuevaEspecialidad" ).html("<table><tr><td>Descripcion</td><td><input type='text' id='txtEspe'/></td></tr><tr><td>Estado</td><td><select id='cmbesp'><option value=''>Seleccione</option><option value='MA'>Medico Activo</option><option value='PA'>Pasante Activo</option></select></td></tr><tr><td colspan='2'><input type='button' value='Guardar' id='bntSaveEsp'/></td></tr></table>");
	$("#bntSaveEsp").button();
	$("#bntSaveEsp").click(function()
	{
			$.ajax({
				url:'Procesar.php?accion=newespecialidad&descripcionesp='+$("#txtEspe").val()+'&estaesp='+$("#cmbesp").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#NuevaEspecialidad").html(res);
				},
				error:function()
				{
					$("#NuevaEspecialidad").html("error al cargar");
				}
			});	
			
			setTimeout(function()
							{
								CargarAllEspecialidades();
							},1000);				
		
	});
}
function ShowModificarEspecialidad(codigo)
{
	$( "#ModificarEspecialidad" ).dialog({
			autoOpen: false,
			modal: true,
			height:250,
			width:350,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
			$( "#ModificarEspecialidad" ).dialog( "open" );
			$.ajax({
				url:'Procesar.php?accion=LoadaModEspe&codgioEsp='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#ModificarEspecialidad").html(res);
				},
				error:function()
				{
					$("#ModificarEspecialidad").html("error al cargar");
				}
			});			
}
function Modificarespecialidad(codigo)
{
			$.ajax({
				url:'Procesar.php?accion=ModEspe&codgioEspeci='+codigo+'&descripcionespesci='+$("#txtDesesp").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#ModificarEspecialidad").html(res);
				},
				error:function()
				{
					$("#ModificarEspecialidad").html("error al cargar");
				}
			});		
			setTimeout(function()
							{
								CargarAllEspecialidades();
							},1000);			
}
function ShowDeleteEspecialidad(codigo)
{
	$( "#deleteEspecialidad" ).dialog({
			autoOpen: false,
			modal: true,
			height:150,
			width:270,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#deleteEspecialidad" ).dialog( "open" );
		$("#deleteEspecialidad").html("<table><tr><td><input type='button' value='Aceptar' class='btn btn-success' id='ConfirmarDeleteEsp' /></td><td><input type='button' value='Cancelar' class='btn btn-danger' id='CancelDeleteEsp'/><td></tr></table>");
		$("#ConfirmarDeleteEsp").button();
		$("#CancelDeleteEsp").button();
		$("#ConfirmarDeleteEsp").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteEspe&IDEspe='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#deleteEspecialidad").html(res);
				},
				error:function()
				{
					$("#deleteEspecialidad").html("error al cargar");
				}
			});			
			setTimeout(function()
							{
								CargarAllEspecialidades();
							},1000);
		});
		$("#CancelDeleteEsp").click(function()
		{
			$( "#deleteEspecialidad" ).dialog( "close" );
		});		
	
	
}
function CargarAllPacientes()
{
			$.ajax({
				url:'Procesar.php?accion=LoadPacientes',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#MainPaciente").html(res);
				},
				error:function()
				{
					$("#MainPaciente").html("error al cargar");
				}
			});			
	
}
function ShowModificarPaciente(codigo)
{
	$( "#ModificarPaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:350,
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
		$( "#ModificarPaciente" ).dialog( "open" );
			$.ajax({
				url:'Procesar.php?accion=LoadModPaciente&CodigoPac='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#ModificarPaciente").html(res);
				},
				error:function()
				{
					$("#ModificarPaciente").html("error al cargar");
				}
			});			
	
}
function ModificarPaciente(codigo)
{
			$.ajax({
				url:'Procesar.php?accion=ModificarPaciente&CoPaciente='+codigo+'&apellidoPac='+$("#txtApePac").val()+'&nombrePac='+$("#txtNombrePac").val()+'&EdadPac='+$("#txtEdadPac").val()+'&direccionPac='+$("#txtDireccionPac").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#ModificarPaciente").html(res);
				},
				error:function()
				{
					$("#ModificarPaciente").html("error al cargar");
				}
			});			
			setTimeout(function()
							{
								CargarAllPacientes();
							},1000);	
}
function ShowDeletepaciente(codigo)
{
	$( "#DeletePaciente" ).dialog({
			autoOpen: false,
			modal: true,
			height:150,
			width:270,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#DeletePaciente" ).dialog( "open" );
		$("#DeletePaciente").html("<table><tr><td><input type='button' class='btn btn-success' value='Aceptar' id='ConfirmarDeletePacie' /></td><td><input type='button' value='Cancelar' class='btn btn-danger' id='CancelDeletePacie'/><td></tr></table>");
		$("#ConfirmarDeletePacie").button();
		$("#CancelDeletePacie").button();
		$("#ConfirmarDeletePacie").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeletePaciente&IDPaciente='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#DeletePaciente").html(res);
				},
				error:function()
				{
					$("#DeletePaciente").html("error al cargar");
				}
			});			
			setTimeout(function()
							{
								CargarAllPacientes();
							},1000);
		});
		$("#CancelDeletePacie").click(function()
		{
			$( "#DeletePaciente" ).dialog( "close" );
		});		
	
}
function CargarAllFarmacos()
{
			$.ajax({
				url:'Procesar.php?accion=LoadaFarmacos',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#MainBodega").html(res);
				},
				error:function()
				{
					$("#MainBodega").html("error al cargar");
				}
			});	
}

function ShowNewFarmaco()
{
	$( "#NewFarmaco" ).dialog({
			autoOpen: false,
			modal: true,
			height:350,
			width:370,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#NewFarmaco" ).dialog( "open" );	
	$( "#NewFarmaco" ).html("<table><tr><td>Descripcion</td><td><input type='text' id='txtDescriFarm'></td></tr><tr><td>Foto</td><td><input type='file' id='subirfoto1'></td></tr><tr><td>Fecha Caducacion</td><td><input type='text' id='txtfechaCad'></td></tr><tr><td>Cantidad</td><td><input type='text' id='txtCantFarm'></td></tr><tr><td><input type='button' id='bntSaveFarm' value='Guardar'></td></tr></table>");
					$('#txtfechaCad').datepicker({
						changeMonth: true,
						changeYear: true
					});
					$('#txtfechaCad').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );		
					$("#bntSaveFarm").button();
					$("#bntSaveFarm").click(function()
					{

						var inputFileImage = document.getElementById("subirfoto1");
						var archivo = inputFileImage.files[0];
						
						if($("#txtDescriFarm").val()!="" & $("#txtfechaCad").val()!="" & $("#txtCantFarm").val()!="")
						{
							$.ajax({
								   beforeSend:function(xhr)
								   {
									   xhr.setRequestHeader("X-File-Name",archivo.name);
								   },
								   url:'Procesar.php?accion=NewFarmaco&descripFarmaco='+$("#txtDescriFarm").val()+'&fechaCad='+$("#txtfechaCad").val()+'&cantidaFar='+$("#txtCantFarm").val(),
								   type:'POST',
								   data:archivo,
								   processData:false,
								   success:function(respuesta)
								   {
									   $("#NewFarmaco").html(respuesta);
								   },
								   error:function()
								   {
									   $("#NewFarmaco").html("Error al cargar los datos");
								   }			   
							   });
								setTimeout(function()
												{
													CargarAllFarmacos();
												},1000);
							
							
						}
						else
						{
							alert("Llene todos los campos para poder guardar el nuevo producto");
						}



					});
	
}
function ShowModificarFarmaco(codigo)
{
	$( "#ModificarFarmaco" ).dialog({
			autoOpen: false,
			modal: true,
			height:300,
			width:340,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#ModificarFarmaco" ).dialog( "open" );	
			$.ajax({
				url:'Procesar.php?accion=ModificarFarmacos&CodigoFarmaco='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#ModificarFarmaco").html(res);
				},
				error:function()
				{
					$("#ModificarFarmaco").html("error al cargar");
				}
			});			
}

function Modificarfarmaco(codigo)
{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarModificarFarmacos&CodigoFarmaco3='+codigo+'&desFarm='+$("#txtDesfar").val()+"&cantFarm="+$("#txtCantfar").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#ModificarFarmaco").html(res);
				},
				error:function()
				{
					$("#ModificarFarmaco").html("error al cargar");
				}
			});	
											setTimeout(function()
												{
													CargarAllFarmacos();
												},1000);		
	
}
function ShowDeleteFarmaco(codigo)
{
	$( "#DeleteFarmaco" ).dialog({
			autoOpen: false,
			modal: true,
			height:150,
			width:270,
			show: {
				effect: "blind",
				duration: 1000
			},
			hide: {
				effect: "explode",
				duration: 1000
			}
		});
		$( "#DeleteFarmaco" ).dialog( "open" );
		$("#DeleteFarmaco").html("<table><tr><td><input type='button' class='btn btn-success' value='Aceptar' id='ConfirmarDeleteFarm' /></td><td><input type='button' value='Cancelar' class='btn btn-danger' id='CancelDeleteFarma'/><td></tr></table>");
		$("#ConfirmarDeleteFarm").button();
		$("#CancelDeleteFarma").button();
		$("#ConfirmarDeleteFarm").click(function()
		{
			$.ajax({
				url:'Procesar.php?accion=ConfirmarDeleteFarmaco&IDFarmaco='+codigo,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#DeleteFarmaco").html(res);
				},
				error:function()
				{
					$("#DeleteFarmaco").html("error al cargar");
				}
			});			
			setTimeout(function()
							{
								CargarAllFarmacos();
							},1000);
		});
		$("#CancelDeleteFarma").click(function()
		{
			$( "#DeleteFarmaco" ).dialog( "close" );
		});		
	
	
}