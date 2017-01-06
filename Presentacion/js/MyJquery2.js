// JavaScript Document
$(document).ready(function()
{
	LoadCombos();
	$("#Frm1").show();
	$("#Form5Search").hide();
	$("#Form7Search").hide();
	$("#FormSearchCirugia").hide();

	$("#home").click(function(){
		$("#Frm1").show();
		$("#Form5Search").hide();
		$("#Form7Search").hide();
		$("#FormSearchCirugia").hide();
		Home();
	});

	$("#agendCirug").click(function(){
	$("#Frm1").hide();
	$("#Form5Search").show();
	$("#Form7Search").hide();
	$("#FormSearchCirugia").hide();
		Home();
	});

	$("#citaalldoct").click(function(){
	$("#Frm1").hide();
	$("#Form5Search").hide();
	$("#Form7Search").show();
	$("#FormSearchCirugia").hide();
	Home();
	});


	$("#buscarcitacirugia").click(function(){
	$("#Frm1").hide();
	$("#Form5Search").hide();
	$("#Form7Search").hide();
	$("#FormSearchCirugia").show();
	Home();
	});




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
                $("#Frm2").html(res);
            },
            error:function()
            {
                $("#Frm2").html("error al cargar");
            }
        }); 

    }else{
        $("#Frm2").html("");
        $("#Frm3").html("");
        $("#Frm4").html("");
        $("#Frm4").css("overflow-y","");

    }
}
function FileOrder(codigo){
        $.ajax({
            url:'Procesar.php?accion=GenerarForm2ToUpPdf&paciente='+codigo,
            type:'GET',
            cache:false,
            success:function(res)
            {
                $("#Frm3").html(res);
            },
            error:function()
            {
                $("#Frm3").html("error al cargar");
            }
        });     
}
function UpFile(idp,po){
$( "#ModalDigital" ).attr("title","Digital ");
    $( "#ModalDigital" ).dialog({
            autoOpen: true,
            modal: true,
            height:200,
            width:500,
            show: {
                effect: "blind",
                duration: 1000
            },
            hide: {
                effect: "fade",
                duration: 1000
            }
        });
        $( "#ModalDigital" ).dialog( "open" );
        $( "#ModalDigital" ).html("<table class='table table-bordered table-condensend table-hover table-striped'><tr><th>Fecha</th><td colspan='2'><input type='text' id='txtfechaup' readyonly/></td></tr><tr><th>Buscar: </th><td><input type='file' id='fileLight'/></td><td><input type='button' class='btn btn-primary' value='Subir' id='subitlight'/></td></tr></table>");

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
                            $("#ModalDigital").html(res);
                            setTimeout(function(){
                                ReloadFiles(idp);
                            },1000);
                        },
                        error:function()
                        {
                            $("#ModalDigital").html("error al cargar");
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
                $("#Frm3").html(res);
            },
            error:function()
            {
                $("#Frm3").html("error al cargar");
            }
        });     
}
function SeeAllFile(pac,pos){
        $("#Frm4").css("overflow-y","scroll");
        $.ajax({
            url:'Procesar.php?accion=SeeAllFile&PacietId='+pac+'&pos='+pos,
            type:'GET',
            cache:false,
            success:function(res)
            {
                $("#Frm4").html(res);
            },
            error:function()
            {
                $("#Frm4").html("error al cargar");
            }
        }); 
}
function SeeList(pac,pos){
        $("#Frm4").css("overflow-y","scroll");
        $.ajax({
            url:'Procesar.php?accion=SeeAllLista&PacietId='+pac+'&pos='+pos,
            type:'GET',
            cache:false,
            success:function(res)
            {
                $("#Frm4").html(res);
            },
            error:function()
            {
                $("#Frm4").html("error al cargar");
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

//inicio de la funcion para un nuevo paciente
function NuevoPaciente()
{
    $( "#NewPaciente" ).dialog({
            autoOpen: false,
            modal: true,
            height:630,
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

        $( "#NewPaciente" ).dialog( "open" );
        $("#RespuestaNewPaciente").html("<table class=''><tr><td>Cédula:</td><td><input type='text' id='txtcedulaUsu1' onkeyup='VerificarCI()' /></td><td>Pasaporte:</td><td><input type='text' id='txtPasport' /></td></tr><tr><td>Apellidos:</td> <td><input type='text' id='txtapellidoUsu1' /></td><td>Nombres:</td><td><input type='text' id='txtnombresUsu1'  /></td></tr><tr><td>Otro:</td><td colspan='3'><textarea id='txtOtro' cols='40' rows='2'></textarea></td></tr></tr><tr><td>Fecha de Nacimiento:</td><td><input type='date' id='txtEdadUsu1' onchange='Calcular();' /><td colspan='2'><input type='text' id='TxtEdad123'/></tr><tr><td>Lugar de Nacimiento:</td><td><input type='text' id='txtLugnacim' /><td>Lugar de Residencia:</td><td><input type='text' id='txtLugres' /></td></tr><tr><td>Sexo:</td><td><select id='txtSex'><option value=''>--Seleccione--</option><option value='Femenino'>Femenino</option><option value='Masculino'>Masculino</option></select></td><!-- <td>Raza:</td> <td><input type='text' id='txtRaza' /></td><tr><td>Religión:</td><td><input type='text' id='txtReligion' /></td> --><td>Estado civil:</td><td><select id='txtEstadociv'><option value=''>--Seleccione un estado civil--</option><option value='Solter@'>Solter@</option><option value='Casad@'>Casad@</option><option value='Divorciad@'>Divorciad@</option><option value='Viud@'>Viud@</option><option value='Union Libre'>Union Libre</option></select></td></tr><tr><td>Instrucción:</td><td><input type='text' id='txtInstr' /></td><!-- <td>Profesión:</td><td><input type='text' id='txtProf' /></td> --></tr><tr><td>Autorizacion:</td><td><input type='text' id='txtautorizacion'/></td><td>Fecha:</td><td><input type='text' id='txtfechaauto' onchange='CalcularFechaVencimiento()' /></td></tr><tr><td>Fecha V.</td><td><input type='text' id='txtfechaautovenc' readonly /></td></tr><tr><!-- <td>Ocupación:</td><td><input type='text' id='txtOcupe' /></td> --><td>Condición del paciente:</td><td><select id='txtCondpac'><option value=''>--Seleccione una condición--</option><option value='Convenio'>Convenio</option><option value='Empresa'>Empresa</option><option value='Particular'>Particular</option></select></td><td><input type='text' id='txtconve2'/></td></tr><tr><td>Dirección:</td><td><input type='text' id='txtdireccionUsu1'  /></td><td>Teléfono Domicilio:</td><td><input type='text' id='txtTelef'></td><tr><td>Teléfono Trabajo:</td><td><input type='text' id='txtTelefTraba'></td><td>Celular:</td><td><input type='text' id='txtCelular'></td><tr><td>Correo:</td><td><input type='text' id='txtCorreo'></td></tr><tr><td>Referencia: </td><td><input type='text' id='txtNombresRefe'></td><td>Teléfono de Referencia:</td><td><input type='text' id='txtTelefonoRefe'></td></tr><tr><td>&nbsp;</td><td>&nbsp;</td><td><input type='button' id='bntSaveUsu1'  onclick='SavePac()' class='btn btn-success' value='Guardar' /></td></tr>  </table>");

            $('#txtfechaauto').datepicker({
                        changeMonth: true,
                        changeYear: true
                    });
            $('#txtfechaauto').datepicker( 'option', 'dateFormat', 'yy-mm-dd' );    
        
        //onclick='SavePac()' 
        
        //<tr><td>Alergias</td><td><textarea cols='30' rows='1' id='txtAlergias'></textarea></td></tr><tr><td>Fracturas o lesiones: </td><td><textarea cols='30' rows='1' id='txtLesionesFracturas'></textarea></td></tr>
         
    $("#txtcedulaUsu1").validarCedulaEC({
          onValid: function () {
            console.log(this);
            $("#bntSaveUsu1").removeAttr("disabled");   
            $("#txtcedulaUsu1").css("background","green");
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
        $("#txtapellidoUsu1").alpha({allow:" "}); //restringe todos los numeros y algunos caracteres especiales menos el espacio
        $("#txtnombresUsu1").alpha({allow:" "});

        $("#txtNombresFAOC").alpha({allow:" "});        
        
     /*   
        $("#bntSaveUsu1").click(function()
        {
            if($('#txtcedulaUsu1').val()!="" & $('#txtapellidoUsu1').val()!="" & $('#txtnombresUsu1').val()!="" & $('#txtdireccionUsu1').val()!="" & $('#txtEdadUsu1').val()!="")
            {
                $.ajax({
                    url:'Procesar.php?accion=NewPaciente&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+"&conve2="+$("#txtconve2").val(),
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
            
        });*/
        
    
}
//fin de la funcio par un nuevo paciente

function SavePac()
{
            if( $('#txtapellidoUsu1').val()!="" & $('#txtnombresUsu1').val()!="" )
            {
                $.ajax({
                    url:'Procesar.php?accion=NewPaciente&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+"&autori="+$("#txtautorizacion").val()+"&fechaiaut="+$("#txtfechaauto").val()+"&fechafaut="+$("#txtfechaautovenc").val()+"&conve2="+$("#txtconve2").val(),
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
                            $("#RespuestaNewPaciente").html("");
                        }
                        else{
                            $("#bntSaveUsu1").removeAttr("disabled",false);
                        }
                    },
                    error:function()
                    {
                        $("#RespuestaNewPaciente").html("error al cargar");

                    }
                }); 
    }
}

function ModificaPaciente(){


    $("#MainAreaPrEf").html("");
 $( "#modpaciente002" ).dialog({
            autoOpen: false,
            modal: true,
            height:630,
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

        $( "#modpaciente002" ).dialog( "open" );
        $("#ree2222").html("<div id='Form3Search'> <table class='table table-bordered  table-condensend table-striped table-hover'> <tr> <td> <center><h4>Actualizar datos paciente</h4></center> </td> </tr> <tr> <td> <center> <div class='input-append'> <input class='span3' id='txtBuscar2'  onkeydown='BuscarPaciente3();'  type='text'> <a class='btn' ><i class='icon-search'></i>Cedula Paciente</a> </div> </center> </td> </tr> </table> </div>");
        

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
function SaveAndModPac(codigo)
{
                $.ajax({
                    url:'Procesar.php?accion=ModDataPac&CedulaPac='+$('#txtcedulaUsu1').val()+'&Passaporte='+$("#txtPasport").val()+'&ApellidoPac='+$('#txtapellidoUsu1').val()+'&NombrePac='+$('#txtnombresUsu1').val()+'&Otros='+$("#txtOtro").val()+'&Edadpac='+$('#txtEdadUsu1').val()+'&LugarNac='+$('#txtLugnacim').val()+'&LugarReside='+$("#txtLugres").val()+'&Sexo='+$("#txtSex").val()+'&Raza='+$("#txtRaza").val()+'&Religion='+$("#txtReligion").val()+'&EstadoCivil='+$("#txtEstadociv").val()+'&Intruccion='+$("#txtInstr").val()+'&Profesion='+$('#txtProf').val()+'&Ocupacion='+$('#txtOcupe').val()+'&CondicioPaci='+$('#txtCondpac').val()+'&Direccion='+$('#txtdireccionUsu1').val()+'&TelefoDomici='+$('#txtTelef').val()+'&TelefonoTrabaj='+$('#txtTelefTraba').val()+'&Celular='+$('#txtCelular').val()+'&Correo='+$('#txtCorreo').val()+'&NombRefere='+$('#txtNombresRefe').val()+'&TelefoRefere='+$('#txtTelefonoRefe').val()+'&CodigoPaciente='+codigo+"&autori="+$("#txtautorizacion").val()+"&fechaiaut="+$("#txtfechaauto").val()+"&fechafaut="+$("#txtfechaautovenc").val()+"&condi2="+$("#txtCondicio").val(),
                    type:'GET',
                    cache:false,
                    success:function(res)
                    {
                        $("#DataFiliaCionPaciente").html(res);
                        setTimeout(function()
                        {
                            $("#DataFiliaCionPaciente").html("");
                            
                        },3000);
                    },
                    error:function()
                    {
                        $("#DataFiliaCionPaciente").html("error al cargar");
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
                                BuscarPaciente3();
                            },1000);        
        });
        $("#CancelDeletePacie").click(function()
        {
            $( "#DeletePaciente" ).dialog( "close" );
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
							$("#RespsAgend").html(res);
						},
						error:function()
						{
							$("#RespsAgend").html("error al cargar");
						}
				});	
 			}else{
 				alert("Seleccione un mes y año para poder visualizar la agenda");
 			}
 }
 function RedactarDatos(codigo){
	$("#CitaCiru").attr("title","Cita Cirugia");
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
		$( "#CitaCiru" ).dialog( "open" );	 	
		$.ajax({
						url:'Procesar.php?accion=LoadCitaAgendaCirugia2&code='+codigo,
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
  function ImpCitaEmergenci(code){
 	$("#PdfCitaCirug").attr("title","Cita Cirugia");
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
		$( "#PdfCitaCirug" ).dialog( "open" );
		$( "#PdfCitaCirug" ).html("<object type='text/html' data='../Reportes/CitaCirugiaImp.php?code="+code+"'></object>");
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
 function BuscarMedico7(){
	if($("#txtBuscar7").val()!=""){
		$.ajax({
				url:'Procesar.php?accion=BuscarMedico003&Buscar='+$("#txtBuscar7").val(),
				type:'GET',
				cache:false,
				success:function(res)
				{
					$("#resp7").html(res);

				},
				error:function()
				{
					$("#resp7").html("error al cargar");
				}
			});	
	}else{
		$("#resp7").html("");
	}	
}
function BuscarFechaMed(code){
	$("#respuestas").html("");
	$( "#ModalFechasDoc" ).dialog({
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

		$( "#ModalFechasDoc" ).dialog( "open" );

		$("#buscadores").html("<table class='table table-bordered table-striped table-condensend'><tr><td colspan='5'><center>Buscar por fechas</center></td></tr><tr><td>Fecha de inicio:</td><td><input type='text' id='txtFechai'/></td><td>Fecha final:</td><td><input type='text' id='txtfechaf'/></td><td><a class='btn btn-success' onclick='BuscarPorFechas("+code+")'> Buscar</a></td></tr><tr><td colspan='5'><center>Buscar por meses</center></td></tr><tr><td>Mes: </td><td colspan='3'><select class='cmb_mes002'><option value=''>--Seleccione--</option><option value='1'>Enero</option><option value='2'>Febrero</option><option value='3'>Marzo</option><option value='4'>Abril</option><option value='5'>Mayo</option><option value='6'>Junio</option><option value='7'>Julio</option><option value='8'>Agosto</option><option value='9'>Septiembre</option><option value='10'>Octubre</option><option value='11'>Noviembre</option><option value='12'>Diciembre</option></select></td><td><a class='btn btn-primary' onclick='BuscarXMesDoc("+code+")'> Buscar</a></td></tr></table>");


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
					$("#respuestas").html(res);

				},
				error:function()
				{
					$("#respuestas").html("error al cargar");
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
					$("#respuestas").html(res);

				},
				error:function()
				{
					$("#respuestas").html("error al cargar");
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
					$("#respsercrugi").html(res);

				},
				error:function()
				{
					$("#respsercrugi").html("error al cargar");
				}
			});	
	}else{
		$("#respsercrugi").html("");
	}
}