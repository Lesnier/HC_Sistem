$(document).ready(function(){
	ZonaDivs();
});
function ZonaDivs(){
	$(".zonadivs").html("<div id='ProtocoloOperatorio'></div>                                                                                         <div class='BuscardorMedico'><div class='CabBuscMedico'></div>                      <div class='CueBuMedico'></div></div>          <input type='hidden' id='txtocanestesiologo'/><input type='hidden' id='txtoccoocirujano'/><input type='hidden' id='txtocprimerayudante'/><input type='hidden' id='txtocsegundoayudante'/><input type='hidden' id='txtocaprobadopor'/><input type='hidden' id='txtoccodiiees'/><input type='hidden' id='txtotercercirujano'/>                                                       <div class='windiess'><div class='cawiess'></div> <div class='cuwiess'></div></div><input type='hidden' id='txtociess'/>  <input type='hidden' id='txtoccirujano' /> <div class='ImpPreoperatorio'></div> <div class='lisprotooperatorio'></div>          <div class='frmEmergencia'></div>");
}
function ImprimirCitasMedicoXFecha(code)
{
	$( ".modal-body" ).html("<object type='text/html' data='../Reportes/ImprimirCitasMedicosXfecha.php?code="+code+"&fi="+$("#txtFechai").val()+"&ff="+$("#txtfechaf").val()+"'></object>");
	
}
function ImprimirCitasXMes(code,mes)
{
	$(".modal-body").html("<object type='text/html' data='../Reportes/ImprimirCitasMedicosXMes.php?code="+code+"&mes="+mes+"'></object>");
}

function ImprimirCitasXDia(code)
{
	$( ".modal-body" ).html("<object type='text/html' data='../Reportes/ImprimirCitasMedicosXDia.php?code="+code+"&fi="+$("#txtFechaBuscarCitaMedicos").val()+"'></object>");
	
}


function OpenNuevoProtocoloOPeratorio(){
	$("#ProtocoloOperatorio").attr("title","Nuevo Protocolo Operatorio");
	$( "#ProtocoloOperatorio" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:950,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( "#ProtocoloOperatorio" ).dialog( "open" );	

	$("#ProtocoloOperatorio").html("<table  cellpadding='0' cellspacing='0' class='table table-bordered table-striped table-condensen' > <tr> <td colspan='2'>PROTOCOLO OPERATORIO</td> <td colspan='2'><table > <tr> <td><p>DPTO. CIRUGIA</p> <p>ENDOSCOPIA ANESTESIOLOGIA</p></td> </tr> <tr> <td>SERV. <input type='text' id='txtservurulogi' /></td> </tr> </table></td> <td colspan='2'>CLINICA DE URULOGIA</td> </tr> <tr> <td>NOMBRE</td> <td colspan='3'><input type='text' id='txtnombrepaciente'/></td> <td>HCL</td> <td><input type='text' id='txtcedulapac' readonly/></td> </tr> <tr> <td colspan='6'><div align='center'>A. DIAGNOSTICO</div></td> </tr> <tr> <td>PRE-OPERATORIO</td> <td colspan='5'><input type='text' id='txtpreoperatoio'/></td> </tr> <tr> <td>POST-OPERATORIO</td> <td colspan='5'><input type='text' id='postoperatorio'/></td> </tr> <tr> <td>CIRUGIA EFECTUADA </td> <td colspan='5'><input type='text' id='txtcirugiaefectuada'/></td> </tr> <tr> <td>CIRUJANO</td> <td colspan='2'><input type='text' id='txtcirujano'/></td> <td>ANESTESIOLOGO</td> <td colspan='2'><input type='text' id='txtanestesiologo'/></td> </tr> <tr> <td>COOCIRUJANO</td> <td colspan='2'><input type='text' id='txtcoocirujano'/></td> <td>INSTRUMENTISTA</td> <td colspan='2'><input type='text' id='txtinstrumentista'/></td> </tr> <tr> <td>PRIMER AYUDANTE</td> <td colspan='2'><input type='text' id='txtprimerayudante'/></td> <td>CIRCULANTE</td> <td colspan='2'><input type='text' id='txtcirculante'/></td> </tr> <tr> <td>SEGUNDO AYUDANTE</td> <td colspan='2'><input type='text' id='txtsegundoayudante'/></td> <td>&nbsp;</td> <td>&nbsp;</td> <td>&nbsp;</td> </tr> <tr> <td colspan='6'>&nbsp;</td> </tr> <tr> <td>C. FECHA DE CIRUGIA:<input type='date' id='txtdatefechacirju'/></td> <td>H. INICIO <select></select></td> <td>D. TIPO DE ANESTESIA <input type='text' id='txtipodeanestecia'/></td> <td colspan='4'>E. TIEMPO QUIRURGICO:</br><input type='text' id='txtiempoqui'</td> </tr> <tr> <td colspan='6'>&nbsp;</td> </tr> <tr> <td>HALLASGOS</td> <td colspan='5'><textarea cols='100' class='span6' rows='2' id='txthallasgos' ></textarea></td> </tr> <tr> <td>E.T.O. PROCEDIMIENTO: </td> <td colspan='4'><textarea id='txtprocedimientos' cols='100'  class='span6' rows='2' ></textarea></td> <td><input type='button' class='btn btn-success' value='Agregar'/></td> </tr> <tr> <td>PREPARADO POR: </td> <td><input type='text' id='txtpreparadox'/></td> <td>FECHA: <input type='date' id='txtfechaaprobacion'/> </td> <td>APROBADO POR: </td> <td>&nbsp;</td> <td>FECHA: <input type='date' id='txtfechaaprobacion2'/></td> </tr> <tr> <td colspan='6'><center><input type='button' class='btn btn-success' value='Guardar'/></center></td> </tr> </table>");
}


function BuscarPacienteVerProt(){
	if($("#txtBuscarVerProto").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=BuscadorCitasCirugiaXPacParaIniProto&Buscar='+$("#txtBuscarVerProto").val()+'&rol=3',
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
function IniProtocolo(code){
/*	$(".FrmVerIniModal").attr("title","Nuevo Protocolo Operatorio");
	$( ".FrmVerIniModal" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:950,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".FrmVerIniModal" ).dialog( "open" );
*/
	$.ajax({
				url:'Procesar.php?accion=LoadINIProtcoOP&Id='+code+'&rol=1',
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

function MakeGeneralMedico (code) {
	$(".CueBuMedico").html("");
	$(".BuscardorMedico").attr("title","Buscar");
	$( ".BuscardorMedico" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:700,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".BuscardorMedico" ).dialog( "open" );
	$(".CabBuscMedico").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarMedicoGeneral'  onkeydown='BuscarMedicoGeneral("+code+");'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");
}
function BuscarMedicoGeneral (code) {
	if($("#txtBuscarMedicoGeneral").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorGeneralMedicos&buscar='+$("#txtBuscarMedicoGeneral").val()+'&re='+code+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".CueBuMedico").html(res);
			},
			error:function()
			{
				$(".CueBuMedico").html("error al cargar");
			}
		});
			
	}else{
		$(".CueBuMedico").html("");
	}	
}
function SeleccionarMedico (code,code1) {
	var medico=$("#catcMedNom"+code+"").html();
	switch(code1){
		case 1:
			$("#txtanestesiologo").val(medico);
			$("#txtocanestesiologo").val(code);
			$( ".BuscardorMedico" ).dialog( "close" );
		break;
		case 2:
			$("#txtcoocirujano").val(medico);
			$("#txtoccoocirujano").val(code);
			$( ".BuscardorMedico" ).dialog( "close" );
		break;

		case 3:
			$("#txtprimerayudante").val(medico);
			$("#txtocprimerayudante").val(code);
			$( ".BuscardorMedico" ).dialog( "close" );
		break;

		case 4:
			$("#txtsegundoayudante").val(medico);
			$("#txtocsegundoayudante").val(code);
			$( ".BuscardorMedico" ).dialog( "close" );
		break;

		case 5:
			$("#txtpreparadopor").val(medico);
			$("#txtocaprobadopor").val(code);
			$( ".BuscardorMedico" ).dialog( "close" );
		break;

		case 6:
			$("#txtcirujano").val(medico);
			$("#txtoccirujano").val(code);
			$( ".BuscardorMedico" ).dialog( "close" );
		break;
		case 7:
			$("#txtcirujano3").val(medico);
			$("#txtotercercirujano").val(code);
			$( ".BuscardorMedico" ).dialog( "close" );
		break;
	}
}


function OpenIess() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarIessGeneral'  onkeydown='BuscarIessGeneral();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}
//buscar iess2
function OpenIess2() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarIessGeneral'  onkeydown='BuscarIessGeneral2();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}
//buscar iess3
function OpenIess3() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarIessGeneral'  onkeydown='BuscarIessGeneral3();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}

function BuscarIessGeneral () {
	if($("#txtBuscarIessGeneral").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorGeneralIess&buscar='+$("#txtBuscarIessGeneral").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}
//para postoperatorio
function BuscarIessGeneral2 () {
	if($("#txtBuscarIessGeneral").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorGeneralIess2&buscar='+$("#txtBuscarIessGeneral").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}
//para preoperatorio

function BuscarIessGeneral3 () {
	if($("#txtBuscarIessGeneral").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorGeneralIess3&buscar='+$("#txtBuscarIessGeneral").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}

//pasar el parametro del codigo del campo para reusar
function SeleccionarIess (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtcirujiaefectuada").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}
//pasar el parametro del codigo del campo para reusar
function SeleccionarIess2 (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtpostoperatorio").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}

//pasar el parametro del codigo del campo para reusar
function SeleccionarIess3 (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtpreoperatorio").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}

function SaveProtocolo(code) {
	if($("#txtpreoperatorio").val()!="")
	{
		if ($("#txtpostoperatorio").val()!="")
		{
			if ($("#txtcirujiaefectuada").val()!="")
			{
				if ($("#txtcirujano").val()!="")
				{
					//alert($("#txthallasgos").val());
					$.ajax({
							url:'Procesar.php?accion=SaveProtocolo&servicio='+$("#txtseranete").val()+'&postoperatorio='+$("#txtpostoperatorio").val()+'&cirugiaefectuada='+$("#txtoccodiiees").val()+'&anestesiologo='+$("#txtocanestesiologo").val()+'&coocirujano='+$("#txtoccoocirujano").val()+'&inistrumentista='+$("#txtinstrumentista").val()+'&primerayudante='+$("#txtocprimerayudante").val()+'&circulante='+$("#txtcirculante").val()+'&segndoayudante='+$("#txtocsegundoayudante").val()+'&datecirugia='+$("#txtdatecirugina").val()+'&anestesia='+$("#txtanestesia").val()+'&hora='+$("#cmb_hora").val()+'&tiempoquirugico='+$("#txttiempoquirujico").val()+'&hallasgos='+$("#txthallasgos").val()+'&procedimiento='+$("#txtprocedimiento").val()+'&preparadopor='+$("#txtocaprobadopor").val()+'&datefecha2='+$("#txtfecha2").val()+'&datefecha3='+$("#txtfecha3").val()+'&idcitacir='+code+'&cirujano='+$("#txtoccirujano").val()+"&preop="+$("#txtpreoperatorio").val()+"&hf="+$("#cmb_horaF").val()+"&complicaciones="+$("#txtcomplicaciones").val()+"&sangrado="+$("#txtsangrado").val()+"&histopatologico="+$("#cmb_histopatologia").val()+"&ecografista="+$("#txtecografista").val()+"&preopaux2="+$("#txtpreoperatorio2").val()+"&preopaux3="+$("#txtpreoperatorio3").val()+"&postopaux2="+$("#txtpostoperatorio2").val()+"&postopaux3="+$("#txtpostoperatorio3").val()+"&ciruefaux2="+$("#txtcirujiaefectuada2").val()+"&ciruefaux3="+$("#txtcirujiaefectuad3").val()+"&cirujano3="+$("#txtotercercirujano").val()+"&dgnhispatologia="+$("#txtHistopatologia").val(),
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
					alert("El campo Primer Cirujano es obligatorio");
				}
				
			}
			else
			{
				alert("El primer campo Cirugia Efectuada es obligatorio");
			}
			
		}
		else
		{
			alert("El primer campo Post-operatorio es obligatorio");
		}
		
	}
	else
	{
		alert("El primer campo Pre-operatorio es obligatorio");
	}
		
}

function ImpProtocolo(code) {
	/*$(".ImpPreoperatorio").attr("title","");
	$( ".ImpPreoperatorio" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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
	$( ".ImpPreoperatorio" ).dialog( "open" );	*/
	$( ".modal-body" ).html("<object type='text/html' data='../Reportes/ProtocoloOperatorio.php?code="+code+"'></object>");
}
function ModificarProtocolo (code) {
	$.ajax({
			url:'Procesar.php?accion=ModifyOkProtocoOperatorio&servicio='+$("#txtseranete").val()+'&postoperatorio='+$("#txtpostoperatorio").val()+'&cirugiaefectuada='+$("#txtoccodiiees").val()+'&anestesiologo='+$("#txtocanestesiologo").val()+'&coocirujano='+$("#txtoccoocirujano").val()+'&inistrumentista='+$("#txtinstrumentista").val()+'&primerayudante='+$("#txtocprimerayudante").val()+'&circulante='+$("#txtcirculante").val()+'&segndoayudante='+$("#txtocsegundoayudante").val()+'&datecirugia='+$("#txtdatecirugina").val()+'&anestesia='+$("#txtanestesia").val()+'&hora='+$("#cmb_hora").val()+'&tiempoquirugico='+$("#txttiempoquirujico").val()+'&hallasgos='+$("#txthallasgos").val()+'&procedimiento='+$("#txtprocedimiento").val()+'&preparadopor='+$("#txtocaprobadopor").val()+'&datefecha2='+$("#txtfecha2").val()+'&datefecha3='+$("#txtfecha3").val()+'&idprotocolo='+code+'&cirujano='+$("#txtoccirujano").val()+"&preop="+$("#txtpreoperatorio").val()+"&hf="+$("#cmb_horaF").val()+"&complicaciones="+$("#txtcomplicaciones").val()+"&sangrado="+$("#txtsangrado").val()+"&histopatologico="+$("#cmb_histopatologia").val()+"&ecografista="+$("#txtecografista").val()+"&preopaux2="+$("#txtpreoperatorio2").val()+"&preopaux3="+$("#txtpreoperatorio3").val()+"&postopaux2="+$("#txtpostoperatorio2").val()+"&postopaux3="+$("#txtpostoperatorio3").val()+"&ciruefaux2="+$("#txtcirujiaefectuada2").val()+"&ciruefaux3="+$("#txtcirujiaefectuad3").val()+"&cirujano3="+$("#txtotercercirujano").val()+"&dgnhispatologia="+$("#txtHistopatologia").val(),
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".Resp1").html(res);
				setTimeout(function()
						{
							BuscarPacienteVerProt();
							
						},2000);
			},
			error:function()
			{
				$(".Resp1").html("error al cargar");
			}
	});	
	
}


function AprobaProtocolo (code) {
	$.ajax({
			url:'Procesar.php?accion=AprobarProtocoloOpertatorio&IDPOP='+code,
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
function SeeAllInfoProtocoloOPeratorio (code) {
/*Resp3$(".lisprotooperatorio").attr("title","");
	$( ".lisprotooperatorio" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
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
	$( ".lisprotooperatorio" ).dialog( "open" );	*/
	$.ajax({
			url:'Procesar.php?accion=ListaProtocolooperatorio&IDUSER='+code,
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

function CalculaHora () {
	var hi=parseInt($("#cmb_hora").val());
	var hf=parseInt($("#cmb_horaF").val());

	if(hf>hi){
		$.ajax({
				url:'Procesar.php?accion=CalcularHora&HI='+hi+"&HF="+hf,
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#txttiempoquirujico").val(res);
				},
				error:function()
				{
					alert("Error al cargar los datos");
				}
		});	
	}else{
		alert("Seleccione un hora superior a la hora de inicio");
	}
}



/*EMERGENCIA*/
function BuscarEmergencia () {
	if($("#txtBuscarPAcienteEmergencia").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscarPacientev2&buscar='+$("#txtBuscarPAcienteEmergencia").val()+'&por='+$("#cmbBuspor").val()+'&CodigoRol='+7,
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
function FrmMkEmergenciaIni (code) {
/*Resp2	$(".frmEmergencia").attr("title","");
	$( ".frmEmergencia" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:1000,
			show: {
				effect: "slide",
				duration: 1000
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".frmEmergencia" ).dialog( "open" );	
*/
	$.ajax({
			url:'Procesar.php?accion=FrmMkEmergenciaIni&ID='+code,
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













//funcione para cargar los nuevos procesops con angular
function Reset(){
	$(".Cabe1").html("");
	$(".Resp1").html("");
	$(".Resp2").html("");
	$(".Resp3").html("");
	$(".Resp4").html("");
	$(".Resp5").html("");
	$(".Resp6").html("");
}

function HistorialPacienteAngular(){
	Reset();
  $( ".Resp2" ).html("<object type='text/html' data='HISTORIALP/historialp.php'></object>"); 
}
//funcioes para modificar los datos de administrador 
function GestionarAdiministrador () {
	Reset();
	$( ".Resp2" ).html("<object type='text/html' data='ADMINISTRADOR/Admin.php'></object>"); 
}
function GestionarSecretaria() {
	Reset();
	$( ".Resp2" ).html("<object type='text/html' data='SECRETARIA/SecreRecep.php'></object>"); 
}
function GestionarDigitador() {
	Reset();
	$( ".Resp2" ).html("<object type='text/html' data='DIGITADOR/Digitador.php'></object>"); 
}
function NewCitaNormal() {
	Reset();
	$(".Resp2").html("<object type='text/html' data='CITASYAGENDAS/CitaNormal.php'></object>");
}
function SearchCitaNormal() {
	Reset();
	$(".Resp2").html("<object type='text/html' data='CITASYAGENDAS/BuscarCitaNormal.php'></object>");	
}

//helpers 
function hoy(){

var today = moment().format('YYYY-MM-DD');
//	alert(today);
$('#txtdatecirugina').val(today);
$('#txtfecha2').val(today);
$('#txtfecha3').val(today);

}

// function validaHistopatologia(){
// 	$("#txtHistopatologia").remove();
// 	if($('#cmb_histopatologia').val()=='SI'){
// 		$(".divHistopatologia").append("<input type='text' name='txtHistopatologia' id='txtHistopatologia' class='span8' onclick='openDgnHispatologia()' />");
// 	}
// }

function tiempoCirugia(){
	var fin =$('#cmb_horaF option:selected').text();
	var inicio = $('#cmb_hora option:selected').text();
	i = inicio.split(':');
   f = fin.split(':');
    min = f[1]-i[1];
    //si estan en la misma hora 
    if (f[0]-i[0] == 0){

    	minutos = f[1]-i[1];
    	$('#txttiempoquirujico').val(minutos + " minutos");
    }
    // si la hora es mayor 
    if (f[0]-i[0] > 0){
    	var hora =f[0]-i[0];
    	// si los minutos finales son menor al inicial
    	
    	if (i[1]>f[1]){
    		hora = hora -1;
    		minutos  = (Number(f[1]) + 60) - i[1];
    		$('#txttiempoquirujico').val(hora+ " hora/s " +minutos+ " minutos ");
    	}else {
    		minutos  = f[1] - i[1];
    		$('#txttiempoquirujico').val(hora+ " hora/s " +minutos+ " minutos ");
    	}
    }
}

//Buscar diagnostico pre-operatorio Aux2
function OpenIessAux2() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarIessAux2'  onkeydown='BuscarIessGeneralAux2();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}

function BuscarIessGeneralAux2 () {
	if($("#txtBuscarIessAux2").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorGeneralIessAux2&buscar='+$("#txtBuscarIessAux2").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}

function SeleccionarIessAux2 (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtpreoperatorio2").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}


//Buscar diagnostico pre-operatorio Aux3
function OpenIessAux3() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarIessAux3'  onkeydown='BuscarIessGeneralAux3();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}

function BuscarIessGeneralAux3 () {
	if($("#txtBuscarIessAux3").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorGeneralIessAux3&buscar='+$("#txtBuscarIessAux3").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}

function SeleccionarIessAux3 (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtpreoperatorio3").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}


//Buscar diagnostico post-operatorio Aux2
function OpenPostAux2() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarPostOp2'  onkeydown='BuscarPostAux2();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}

function BuscarPostAux2 () {
	if($("#txtBuscarPostOp2").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorPostAux2&buscar='+$("#txtBuscarPostOp2").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}

function SeleccionarPostAux2 (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtpostoperatorio2").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}


//Buscar diagnostico post-operatorio Aux3
function OpenPostAux3() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarPostOp3'  onkeydown='BuscarPostAux3();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}

function BuscarPostAux3 () {
	if($("#txtBuscarPostOp3").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorPostAux3&buscar='+$("#txtBuscarPostOp3").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}

function SeleccionarPostAux3 (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtpostoperatorio3").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}


//Buscar cirugia efectuada Aux2
function OpenIessCirjAux2() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarIessCir2'  onkeydown='BuscarIessCirjAux2();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}

function BuscarIessCirjAux2 () {
	if($("#txtBuscarIessCir2").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorCirgAux2&buscar='+$("#txtBuscarIessCir2").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}

function SeleccionarCirgAux2 (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtcirujiaefectuada2").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}


//Buscar cirugia efectuada Aux3
function OpenIessCiruAux3() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarIessCir3'  onkeydown='BuscarIessCiruAux3();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}

function BuscarIessCiruAux3 () {
	if($("#txtBuscarIessCir3").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorCirgAux3&buscar='+$("#txtBuscarIessCir3").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}

function SeleccionarCiruAux3 (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtcirujiaefectuad3").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$(".cuwiess").html("");
	$( ".windiess" ).dialog( "close" );
}


//Buscar diagnostico Histopatologia
function openDgnHispatologia() {
$(".windiess").attr("title","Busqueda");
	$( ".windiess" ).dialog({
			autoOpen: false,
			modal: true,
			height:500,
			width:800,
			show: {
				effect: "slide",
				duration: 500
			},
			hide: {
				effect: "drop",
				duration: 1000
			}
		});
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarDiagnHispatologia'  onkeydown='buscarDiagnosticoHisp();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
}

function buscarDiagnosticoHisp () {
	if($("#txtBuscarDiagnHispatologia").val()!="")
	{
		$.ajax({
			url:'Procesar.php?accion=BuscadorDiagnHispatologia&buscar='+$("#txtBuscarDiagnHispatologia").val()+'&rol=1',
			type:'GET',
			cache:false,
			success:function(res)
			{
				$(".cuwiess").html(res);
			},
			error:function()
			{
				$(".cuwiess").html("error al cargar");
			}
		});
			
	}else{
		$(".cuwiess").html("");
	}	
}

function SeleccionarDgnHisp (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtHistopatologia").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$( ".windiess" ).dialog( "close" );
}