$(document).ready(function(){
	ZonaDivs();
});
function ZonaDivs(){
	$(".zonadivs").html("<div id='ProtocoloOperatorio'></div>                                                                                         <div class='BuscardorMedico'><div class='CabBuscMedico'></div>                      <div class='CueBuMedico'></div></div>          <input type='text' id='txtocanestesiologo'/><input type='text' id='txtoccoocirujano'/><input type='text' id='txtocprimerayudante'/><input type='text' id='txtocsegundoayudante'/><input type='text' id='txtocaprobadopor'/><input type='text' id='txtoccodiiees'/>                                                       <div class='windiess'><div class='cawiess'></div> <div class='cuwiess'></div></div><input type='text' id='txtociess'/>  <input type='text' id='txtoccirujano' />");
}
function ImprimirCitasMedicoXFecha(code){
	$("#CitasMedicoXFecha").attr("title","Citas del medico");
	$( "#CitasMedicoXFecha" ).dialog({
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
	$( "#CitasMedicoXFecha" ).dialog( "open" );
	$( "#CitasMedicoXFecha" ).html("<object type='text/html' data='../Reportes/ImprimirCitasMedicosXfecha.php?code="+code+"&fi="+$("#txtFechai").val()+"&ff="+$("#txtfechaf").val()+"'></object>");
	
}
function ImprimirCitasXMes(code,mes){
	$("#CitasMedicoXFecha").attr("title","Citas del medico");
	$( "#CitasMedicoXFecha" ).dialog({
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
	$( "#CitasMedicoXFecha" ).dialog( "open" );
	$( "#CitasMedicoXFecha" ).html("<object type='text/html' data='../Reportes/ImprimirCitasMedicosXMes.php?code="+code+"&mes="+mes+"'></object>");
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
					$(".FrmVerIni2").html(res);

				},
				error:function()
				{
					$(".FrmVerIni2").html("error al cargar");
				}
		});
	}else{
		$(".FrmVerIni2").html("");
	}
}
function IniProtocolo(code){
	$(".FrmVerIniModal").attr("title","Nuevo Protocolo Operatorio");
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

	$.ajax({
				url:'Procesar.php?accion=LoadINIProtcoOP&Id='+code+'&rol=1',
				type:'GET',
				cache:false,
				success:function(res)
				{
					$(".FrmVerIniModal").html(res);

				},
				error:function()
				{
					$(".FrmVerIniModal").html("error al cargar");
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
	}
}


function OpenIess () {
$(".windiess").attr("title","Buscar");
	$( ".windiess" ).dialog({
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
	$( ".windiess" ).dialog( "open" );	
$(".cawiess").html("<table class='table table-bordered  table-condensend table-striped table-hover'><td> <center> <div class='input-append'> <input class='span4' id='txtBuscarIessGeneral'  onkeydown='BuscarIessGeneral();'  type='text'> <a class='btn' ><i class='icon-search'></i>Buscar </a> </div> </center> </td></table>");	
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
function SeleccionarIess (code) {
	var codi=$("#code"+code).html();
	var desc=$("#desc"+code).html();
	var valo=$("#valo"+code).html();

	$("#txtcirujiaefectuada").val(codi+" "+desc+"  ("+valo+")");
	$("#txtoccodiiees").val(code);
	$( ".windiess" ).dialog( "close" );
}


function SaveProtocolo (code) {
	$.ajax({
			url:'Procesar.php?accion=SaveProtocolo&servicio='+$("#txtseranete").val()+'&postoperatorio='+$("#txtpostoperatorio").val()+'&cirugiaefectuada='+$("#txtoccodiiees").val()+'&anestesiologo='+$("#txtocanestesiologo").val()+'&coocirujano='+$("#txtoccoocirujano").val()+'&inistrumentista='+$("#txtinstrumentista").val()+'&primerayudante='+$("#txtocprimerayudante").val()+'&circulante='+$("#txtcirculante").val()+'&segndoayudante='+$("#txtsegundoayudante").val()+'&datecirugia='+$("#txtdatecirugina").val()+'&anestesia='+$("#txtanestesia").val()+'&hora='+$("#cmb_hora").val()+'&tiempoquirugico='+$("#txttiempoquirujico").val()+'&hallasgos='+$("#txthallasgos").val()+'&procedimiento='+$("#txtprocedimiento").val()+'&preparadopor='+$("#txtocaprobadopor").val()+'&datefecha2='+$("#txtfecha2").val()+'&datefecha3='+$("#txtfecha3").val()+'&idcitacir='+code+'&cirujano='+$("#txtoccirujano").val(),
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
}