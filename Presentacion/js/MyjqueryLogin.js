// JavaScript Document
$(document).ready(function()
{
//llamando a la funcion para cargar el login
CargarLogin();
//fin de llamando a la funcion para cargar el login
});
//inicio de la funcion para cargar el login
function CargarLogin()
{
	$.ajax({
		url:'Presentacion/Procesar.php?accion=LoadLogin',
		type:'GET',
		cache:false,
		success:function(res)
		{
			$("#MainLogin").html(res);
		},
		error:function()
		{
			$("#MainLogin").html("error al cargar");
		}
	});
	
}
//fin de la funcion para cargar el login