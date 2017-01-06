// JavaScript Document
$(document).ready(function()
{
	Archivar();
	DataDoctor();
	LoadCombos();
	



});

function Home(){
	$("#Frm2").html("");
	$("#Frm3").html("");
	$("#Frm4").html("");
	$("#txtsearchpac").val("");
	$("#respsercrugi").html("");
	$("#RespsAgend").html("");
	$("#resp7").html("");
	$("#txtBuscar7").val("");
	$("#txtBuscarsercir").val("");
     
	LoadCombos();
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

function Archivar()
{
	Home2();
	$(".Cabe1").html(" <div class='table-responsive'><table class='table table-bordered table-striped table-condensend table-hover' style='font-family:Times New Roman, Georgia, Serif;'> <tr> <td><center><div class='input-append'> <input type='text'  id='txtsearchpac' onkeyup='SearcPacToUpPdf()'> <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a> </div></center> </td> </tr> </table></div>");
	
	$("#txtsearchpac:first").focus();
}

function ShowAgendaCirg()
{
	Home2();
	$(".Cabe1").html(" <div class='table-responsive'><table class='table table-bordered table-condensend table-striped table-hover'><tr><th colspan=''><center>Agenda Médicos</center></th></tr><tr><th><center><div id='arecmb1'></div><div id='arecmb2'></div></center></th></tr><tr><th><center><a href='#' class='btn btn-succes' onclick='Back();'><i class='icon-backward'></i> </a> <a href='#' class='btn btn-succes' onclick='Next();'><i class='icon-forward'></i></a></center></th></tr></table><div class='Resp1'></div><input type='hidden' id='txtadelante'><input type='hidden' id='txtatras'></div>");
    LoadCombos();
}

function ShowCitasMedi()
{
	Home2();
	$(".Cabe1").html(" <div class='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td colspan='2'><center><h4>Citas de los médicos</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscar7'  onkeypress='BuscarMedico7()'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Médico</a></div></center></td></tr></table></div>");
	
	$("#txtBuscar7:first").focus();
}

function ShowSearchCitasCirg()
{
	Home2();
	$(".Cabe1").html(" <div class='table-responsive'><table class='table table-bordered  table-condensend table-striped table-hover'><tr><td colspan='2'><center><h4>Buscar Citas Cirugias</h4></center></td></tr><tr><td><center><div class='input-append'><input class='span8' id='txtBuscarsercir' onkeyup='BuscarCirugia()'  type='text'><a class='btn' ><i class='icon-search'></i>Cédula Paciente</a></div></center></td></tr></table></div>");
	
	$("#txtBuscarsercir:first").focus();
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

//funciones para los procedimientos de subir archivos pdf de los pacientes
function SearcPacToUpPdf(){
    if ($("#txtsearchpac").val()!="") {
        $.ajax({
            url:'Procesar.php?accion=BuscapacienteToUpPdf&Descripcion='+$("#txtsearchpac").val()+'&pr=1',
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
        //$("#Frm3").html("");
        //$("#Frm4").html("");
        $(".Resp1").css("overflow-y","");

    }
}
function FileOrder(codigo){
        $.ajax({
            url:'Procesar.php?accion=GenerarForm2ToUpPdf&paciente='+codigo,
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
function UpFile(idp,po)
{
        $(".Resp1").html("<div class='table-responsive'><table class='table table-bordered table-condensend table-hover table-striped' style='font-family:Times New Roman, Georgia, Serif;'><tr><th>Fecha: </th><td colspan='2'><input type='text' id='txtfechaup' readyonly/></td></tr><tr><th>Buscar: </th><td><input type='file' id='fileLight'/></td><td><center><input type='button' class='btn btn-primary' value='Subir' id='subitlight' style='font-family:Times New Roman, Georgia, Serif;'/>&nbsp;<input type='button' class='btn btn-success' value='Regresar' id='btnRegresar' onclick='FileOrder("+idp+")' style='font-family:Times New Roman, Georgia, Serif;'/></center></td></tr></table></div>");

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
                            $(".Resp1").html(res);
                            setTimeout(function(){
                                ReloadFiles(idp);
                            },1000);
                        },
                        error:function()
                        {
                            $(".Resp1").html("error al cargar");
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
                $(".Resp1").html(res);
            },
            error:function()
            {
                $(".Resp1").html("error al cargar");
            }
        });     
}

function SeeAllFile(pac,pos){
        $(".Resp1").css("overflow-y","scroll");
        $.ajax({
            url:'Procesar.php?accion=SeeAllFile&PacietId='+pac+'&pos='+pos,
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

function SeeList(pac,pos){
        $(".Resp1").css("overflow-y","scroll");
        $.ajax({
            url:'Procesar.php?accion=SeeAllLista&PacietId='+pac+'&pos='+pos,
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

function DeleteFil(codigo,pac){


    
            $(".Resp1").css("overflow-y","");
                $.ajax({
                    url:'Procesar.php?accion=DeleteFil&CodFile='+codigo,
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                        $(".Resp1").html(res);

                        setTimeout(function(){
                                ReloadFiles(pac);
                            },1000);

                    },
                    error:function()
                    {
                        $(".Resp1").html("error al cargar");
                    }
                });    
        
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


//inicio de la funcion para un nuevo paciente
function NuevoPaciente()
{
    $(".Resp1").css("overflow-y","");
	Home2();
        $(".Resp1").html("<div class='table-responisve'><table class='table table-bordered table-striped table-condensedn'><tr><td>Cédula:</td><td><input type='text' id='txtcedulaUsu1' onkeyup='VerificarCI()' /></td><td>Pasaporte:</td><td><input type='text' id='txtPasport' /></td></tr><tr><td>Paciente:</td> <td colspan='3'><input type='text' class='span10' id='txtapellidoUsu1' /></td></tr>          <tr><td>Medico:</td><td colspan='3'><div class='input-append'><input type='text' class='span12' id='txtnombresUsu1'  /><a href='#myModal' role='button' class='btn' data-toggle='modal'  onclick='AsgnarMedicoPaciente()'> Buscar</a></div></td></tr><tr><td>Otro:</td><td colspan=''><textarea id='txtOtro' cols='40' rows='2'></textarea></td>                                                                                             <td> #Historia</td><td><input type='text' id='txthistoriaR'/></td>                                                                                                                                                                                                                        </tr></tr><tr><td>Fecha de Nacimiento:</td><td><input type='date' id='txtEdadUsu1' onchange='Calcular();' /><td colspan='2'><input type='text' id='TxtEdad123'/></tr><tr><td>Lugar de Nacimiento:</td><td><input type='text' id='txtLugnacim' /><td>Lugar de Residencia:</td><td><input type='text' id='txtLugres' /></td></tr><tr><td>Sexo:</td><td><select id='txtSex'><option value=''>--Seleccione--</option><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select></td><!-- <td>Raza:</td> <td><input type='text' id='txtRaza' /></td><tr><td>Religión:</td><td><input type='text' id='txtReligion' /></td> --><td>Estado civil:</td><td><select id='txtEstadociv'><option value=''>--Seleccione un estado civil--</option><option value='Solter@'>Solter@</option><option value='Casad@'>Casad@</option><option value='Divorciad@'>Divorciad@</option><option value='Viud@'>Viud@</option><option value='Union Libre'>Union Libre</option></select></td></tr><tr><td>Instrucción:</td><td><input type='text' id='txtInstr' /></td><!-- <td>Profesión:</td><td><input type='text' id='txtProf' /></td> --></tr><tr><td>Autorizacion:</td><td><input type='text' id='txtautorizacion'/></td><td>Fecha:</td><td><input type='text' id='txtfechaauto' onchange='CalcularFechaVencimiento()' /></td></tr><tr><td>Fecha V.</td><td><input type='text' id='txtfechaautovenc' readonly /></td></tr><tr><!-- <td>Ocupación:</td><td><input type='text' id='txtOcupe' /></td> --><td>Condición del paciente:</td><td><select id='txtCondpac'><option value=''>--Seleccione una condición--</option><option value='Convenio'>Convenio</option><option value='Empresa'>Empresa</option><option value='Particular'>Particular</option></select></td><td><input type='text' id='txtconve2'/></td></tr><tr><td>Dirección:</td><td><input type='text' id='txtdireccionUsu1'  /></td><td>Teléfono Domicilio:</td><td><input type='text' id='txtTelef'></td><tr><td>Teléfono Trabajo:</td><td><input type='text' id='txtTelefTraba'></td><td>Celular:</td><td><input type='text' id='txtCelular'></td><tr><td>Correo:</td><td><input type='text' id='txtCorreo'></td></tr><tr><td>Referencia: </td><td><input type='text' id='txtNombresRefe'></td><td>Teléfono de Referencia:</td><td><input type='text' id='txtTelefonoRefe'></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td colspan='4'><input type='button' id='bntSaveUsu1' class='btn btn-success' onclick='SavePac();' value='Guardar' /></td></tr>  </table></div>");

        $('#txtfechaauto').datepicker({
                        changeMonth: true,
                        changeYear: true
                    });
        $('#txtfechaauto').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );    
        
		
		$("#txtcedulaUsu1:first").focus();
    	$("#txtcedulaUsu1").validarCedulaEC({
          onValid: function () {
            console.log(this);
            $("#bntSaveUsu1").removeAttr("disabled");   
            $("#txtcedulaUsu1").css("background","#29DF20");
        },
        onInvalid: function () {
          console.log(this);
          window.alert("Ha ingresado la cédula de un menor de edad");
          $("#txtcedulaUsu1").css("background","red");
          //$("#bntSaveUsu1").attr("disabled","true");  
        }
      });
        $("#bntSaveUsu1").button();
        
        //validando campos de texto
        $("#txtapellidoUsu1").alpha({allow:" "});
        $("#txtnombresUsu1").alpha({allow:" "});
        $("#txtNombresFAOC").alpha({allow:" "});
        
    
}
//fin de la funcio par un nuevo paciente

function SavePac()
{
	if( $('#txtapellidoUsu1').val()!=""  )
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
                alert("Llene los campos para continuar");
            }

}

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


function VerificarCI(){
    var numci=$("#txtcedulaUsu1").val();
    if(numci.length>9){
        $.ajax({
                    url:'Procesar.php?accion=ComprovandoCIDB&CedulaPac1='+$('#txtcedulaUsu1').val(),
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                        var num = parseInt(res);
                        if(num>0){
                            alert("Esta Cédula Ya Existe en la base de datos");
                            $("#bntSaveUsu1").attr("disabled",true);
                            $(".Resp1").html("");
							//NuevoPaciente();
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

function ModificaPaciente()
{
	Home2();
        $(".Cabe1").html("<div id='table-responsive'><table class='table table-bordered table-condensend table-striped table-hover'> <tr> <td> <center><h4>Actualizar datos paciente</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span8' id='txtBuscar2'  onkeydown='BuscarPaciente3();' type='text'> <a class='btn' ><i class='icon-search'></i>Cedula Paciente</a> </div> </center> </td> </tr> </table> </div>");
		
		$("#txtBuscar2:first").focus();
}

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
                            DatosAllFiliacion(codigo);
                            
                        },2000);
                    },
                    error:function()
                    {
                        $(".Resp1").html("error al cargar");
                    }
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

//fin function fecha de vencimiento de autorizacion
 function DelePac(codigo)
 {
      $(".modal-body").html("<table class='table table-bordered table-striped table-condensend table-hover' style='font-family:Times New Roman, Georgia, Serif;'><tr><th colspan='2'><center>Esta seguro que desea eliminar el paciente ?</center></th></tr><tr><td><center><input type='button' class='btn btn-success' value='Aceptar' id='ConfirmarDeletePacie' />&nbsp;<input type='button' value='Cancelar' class='btn btn-danger' data-dismiss='modal' aria-hidden='true' id='CancelDeletePacie'/></center></td></tr></table>");
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
 }
 
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
							$(".Resp2").html(res);
						},
						error:function()
						{
							$(".Resp2").html("error al cargar");
						}
				});
	}
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

function BuscarFechaMed(code)
{
	$(".Resp1").html("<table class='table table-bordered table-striped table-condensend'><tr><td colspan='5'><center>Buscar por fechas</center></td></tr><tr><td>Fecha de inicio:</td><td><input type='text' id='txtFechai'/></td><td>Fecha final:</td><td><input type='text' id='txtfechaf'/></td><td><a class='btn btn-success' onclick='BuscarPorFechas("+code+")'> Buscar</a></td></tr><tr><td colspan='5'><center>Buscar por meses</center></td></tr><tr><td>Mes: </td><td colspan='3'><select class='cmb_mes002'><option value=''>--Seleccione--</option><option value='1'>Enero</option><option value='2'>Febrero</option><option value='3'>Marzo</option><option value='4'>Abril</option><option value='5'>Mayo</option><option value='6'>Junio</option><option value='7'>Julio</option><option value='8'>Agosto</option><option value='9'>Septiembre</option><option value='10'>Octubre</option><option value='11'>Noviembre</option><option value='12'>Diciembre</option></select></td><td><a class='btn btn-primary' onclick='BuscarXMesDoc("+code+")'> Buscar</a></td></tr></table>");

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

function BuscarXMesDoc(code){
	if($(".cmb_mes002").val()!="" ){
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
