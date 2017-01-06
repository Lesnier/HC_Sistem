<?php
session_start();
if(!isset($_SESSION['ENFERMERA']))
{
	header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Copyright: Quantum</title>
<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />

<link rel="icon" href="../favicon.png" type="image/x-icon">

	<!--plugin jquery-->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    
    <!--mis plugins y estilos-->
    <script type="text/javascript" src="js/MyJquery.js"></script>
    <link rel="stylesheet" href="css/MyEstilo.css" type="text/css" media="all"/>
    <!--plugin para trabajar con mejores interfaces-->
    <script src="js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>

<!--    <link rel="stylesheet" href="css/overcast/jquery-ui-1.10.3.custom.css" type="text/css" />-->
	<link rel="stylesheet" href="css/custom-theme/jquery-ui-1.9.2.custom.css" type="text/css"/>

    <!--validador de cedula-->
		<script src="js/ruc_jquery_validator.min.js" type="text/javascript" ></script>    
    <!--tabla -->
    	<link rel="stylesheet" href="css/demo_table_jui.css" type="text/css"/>
		<link rel="stylesheet" href="css/demo_page.css" type="text/css"/>
		<script type="text/javascript" src="js/jquery.dataTables.js"></script>

<!--script para validar texto y numeros-->
	<script type="text/javascript" src="js/jquery.alphanumeric.pack.js"></script>



    <!--general all-->
    <script type="text/javascript" src="js/MyJqueryGeneral.js"></script>
    <!--general all-->
    


	<!--ESTILOS Y SCRIPT BOOBSTRAP-->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="css/bootstrap-responsive.css" type="text/css"/>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


    <!--general all-->
    <script type="text/javascript" src="js/MyJqueryGeneral.js"></script>
    <!--general all-->

    
</head>

<body>

<div class="container" style="height:2000px;">

   
    <!--inicio fila1-->    	    
    <div class="row-fluid">
   	       <div class="span12">
            	<div class="navbar">
                	<div class="navbar-inner">
                    <div class="brand"><div id="logoEmp"><img src="images/logosimed.fw.png" /></div></div>
                        	<ul class="nav pull-right">
                            	<li><a href="#"><div id="InfoDataDoc"></div></a></li>
                                <li >
                                	<a href="#" id='home' >Inicio</a>
                                </li>                                
                            

                                <li class="dropdown">
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menú </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" onclick="NuevoPaciente()"><span class="icon-user"></span>&nbsp;Nuevo Paciente</a></li>
                                                        <li><a href="#" onclick="" id="modpac"><span class="icon-refresh"></span><i class='icon-user'></i>&nbsp;Actualizar datos paciente</a></li>
                                                        <li><a href="#" onclick="" id="agend1"><span class="icon-calendar"></span>&nbsp;Agenda</a></li>
                                                        <li><a href="#" onclick="" id="gecita"><span class="icon-calendar"></span>&nbsp;Crear cita</a></li>
                                                        <li><a href="#" onclick="" id="agend2"><span class="icon-calendar"></span><i class='icon-cog'></i>&nbsp;Agendar Cirugias</a></li>
                                                        <li><a href="#" onclick="" id="agendCirug"><span class="icon-calendar"></span>&nbsp;Ver Agenda de cirugias</a></li>
                                                        <li><a href="#" onclick="" id="citaalldoct"><span class="icon-calendar"></span>&nbsp;Citas de los medicos</a></li>
                                                        <li><a href="#" onclick="" id="buscarcitacirugia"><span class="icon-search"></span>&nbsp;Buscar citas cirugias</a></li>
                                                        <li><a href="#" onclick="" id="Buscarpropertario"><span class="icon-search"></span>&nbsp;Ver Protocolos Operatorios</a></li>
                                                    </ul>
                                </li>

                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Seguridad</a>
                                        <ul class="dropdown-menu">

                                            <li><a href="../Dominio/CerrarSecion.php"><span class="icon-arrow-left"></span>Salir</a></li>
                                        </ul>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
    </div>
    <!--fin fila1-->   
        	

    
 <!--inicio de la fila 2-->   
  <div class="row-fluid">
  	<div class="span12">
        <div id="FormularioIniEF">
        	<table class='table table-bordered  table-condensend table-striped table-hover'>
                <tr>
                    <td>
                        <center><h4>Agendar paciente para cita</h4></center>
                    </td>
                </tr>
            	<tr>
                    <td>
                    	<center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscar"  onkeydown="BuscarPaciente1();"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a>
                        </div>
                        </center>
                    </td>
                </tr>
            </table>
        </div>

        <div id="Form2Search">
            <table class='table table-bordered  table-condensend table-striped table-hover'>
                 <tr>
                    <td>
                        <center><h4>Citas de pacientes</h4></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscar1"  onkeypress="BuscarPaciente2();"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Buscar Cita Del Paciente</a>
                        </div>
                        </center>
                    </td>
                </tr>
            </table>
        </div>

        <div id="Form3Search">
            <table class='table table-bordered  table-condensend table-striped table-hover'>
                 <tr>
                    <td>
                        <center><h4>Actualizar datos paciente</h4></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscar2"  onkeydown="BuscarPaciente3();"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Buscar Paciente</a>
                        </div>
                        </center>
                    </td>
                </tr>
            </table>
        </div>


        <div id="Form4Search">
            <table class='table table-bordered  table-condensend table-striped table-hover'>
                 <tr>
                    <td>
                        <center><h4>Agendar Cirugía</h4></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscar4"  onkeydown="BuscarPaciente4();"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a>
                        </div>
                        </center>
                    </td>
                </tr>
            </table>
        </div>



 <div id="Form5Search">
            <table class='table table-bordered table-condensend table-striped table-hover'><tr><th colspan=''><center>Agenda Médicos</center></th></tr><tr><th><center><div id='arecmb1'></div><div id='arecmb2'></div></center></th></tr><tr><th><center><a href='#' class='btn btn-succes' onclick='Back();'><i class='icon-backward'></i> </a> <a href='#' class='btn btn-succes' onclick='Next();'><i class='icon-forward'></i></a></center></th></tr></table>
            <div id="RespsAgend">
            </div>
            <input type='hidden' id='txtadelante'>
            <input type='hidden' id='txtatras'>
        </div>



    <div id="Form6Search">
            <table class='table table-bordered  table-condensend table-striped table-hover'>
                 <tr>
                    <td>
                        <center><h4>Agendar Cita Medica</h4></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscar6"  onkeypress="BuscarPaciente6();"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a>
                        </div>
                        </center>
                    </td>
                </tr>
            </table>

            <div id="resp6"></div>

            <div id="Searchmedico002">
               
            </div>
            <div id="frmdoct01">
                <div id="resdoct01"></div>
                <div id="resdoct02"></div>
                <div id="resdoct03"></div>
            </div>
           
           <input type='hidden' id='codepaciente'> 
           <input type='hidden' id='codemedico'> 
        </div>







  <div  id="FrmVerInicProtocolos">
           <table class='table table-bordered  table-condensend table-striped table-hover'>
                 <tr>
                    <td>
                        <center><h4>Buscar Cita De Cirugia Para Iniciar Protocolo Opertario</h4></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscarVerProto"  onkeypress="BuscarPacienteVerProt();"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a>
                        </div>
                        </center>
                    </td>
                </tr>
            </table>

            
            <div  class="FrmVerIni2">
            </div>
            <div  class="FrmVerIni3">
            </div>
            <div  class="FrmVerIni4">
            </div>

            <div  class="FrmVerIniModal">
            </div>

        </div>






<!--buscar medicos-->

     <div id="Form7Search">
            <table class='table table-bordered  table-condensend table-striped table-hover'>
                 <tr>
                    <td colspan='2'>
                        <center><h4>Citas de los medicos</h4></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscar7"  onkeypress="BuscarMedico7()"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Cédula Médico</a>
                        </div>
                        </center>
                    </td>
                    
                </tr>
            </table>

            <div id="resp7"></div>


            <div id='ModalFechasDoc'>
                <div id="buscadores"></div>
                <div id="respuestas"></div>
            </div>

          
        </div>


<!--fin buscar medicos-->





        <div id="FormSearchCirugia">
            <table class='table table-bordered  table-condensend table-striped table-hover'>
                 <tr>
                    <td colspan='2'>
                        <center><h4>Buscar Citas Cirugias</h4></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscarsercir"  onkeyup="BuscarCirugia()"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Cédula Paciente</a>
                        </div>
                        </center>
                    </td>
                    
                </tr>
            </table>

            <div id="respsercrugi"></div>


            

          
        </div>






    
    </div>
  </div>
   <!--fin de la fila 2-->     
    

	<div class="row-fluid">
    	<div class="span12">
		
    	<!--div pricipal para las respuestas de la logica-->    
        <div id="MainAreaPrEf">
    
    		
    
        </div>
        <!---<div id="AreaParaViewConsulta"></div>-->
        <div id="AreaDeBusquedafecha">
        </div>
        <div id="RespuestaHorasDisponibles">
        </div>
        <div id="RespuestaAsignacionTurno">
        </div>        
    	<!--fin div pricipal para las respuestas de la logica-->    
        
        	<!-- divs  para de respuestas de los procesos de la logica-->    
            <div id="AsignarPacienteDoctor" title="Asignar un doctor">
            	<div id="RespuestaAsignacion">
                </div>
            </div>
    		
            <div id="estadopago"><div id="formpago"></div></div><!-- area para el pago--->
            <div id="AreaCancelarCita"></div><!--cancelar cita-->
            <div id="CodigoPaciente">
            </div>
            <div id="ResAsFormularioHide">
            </div>
            <div id="FormularioDeImpresionTurno">
            </div>
            
            <div id="NewPaciente" title="Nuevo Paciente">
            	<div id="RespuestaNewPaciente">
                </div>
            </div>            
            
            <div id="DataFiliaCionPaciente"></div>
            <div id="FrmCitaCiru"></div>
            <div id="FrmSearchCirja">
                <div id="SearchCirja"></div>
                <div id="ResSearchCirja"></div>
            </div>

            <div id="FrmSearchCirja1">
                <div id="SearchCirja1"></div>
                <div id="ResSearchCirja1"></div>
            </div>


            <div id="FrmSearchCirja2">
                <div id="SearchCirja2"></div>
                <div id="ResSearchCirja2"></div>
            </div>

           	<!-- fin divs  para de respuestas de los procesos de la logica-->                

            <!--input ocultos-->
                <input type='hidden' id='thtcodciruja'/>
                <input type='hidden' id='thtcodantesi'/>
                <input type='hidden' id='thtcodayudan'/>
                <input type='hidden' id='txtCodigoPacienteSelecParaCitCir'/> 
            <!--fin input ocultos-->


            

            <!--div de alertas de vencimiento de fecha-->
                <div id="AlertaFechaVencimiento"></div>
            <!--div de alertas de vencimiento de fecha-->



            <!--div de modificacion de citas medicas-->
                <div class="modal01"></div>
            <!--div de modificacion de citas medicas-->




            <div id="CitaCiru">
            </div>
            
            <div id="PdfCitaCirug">
            </div>



            <!--div generales-->
                <div id="CitasMedicoXFecha"></div>
            <!--div generales-->



        </div>
    </div>
    

    <div id="BorrarPaciente">
    </div>
    
    <div class="zonadivs">
    </div>
    
		
	<div class="row-fluid">
    	<div class="span12">
        	<div class="badge badge-inverse navbar-fixed-bottom"><center><span class="icon-info-sign"></span>COPYRIGHT: Quantum  <a href="https://www.facebook.com/pages/Quantum/421396868000546?ref=%20notif&%20ampnotif_t=page_invite_accepted/%20class" target="_blank"><img src="images/re1.png"/></a>  <a href="https://twitter.com/QUANTUMCLICK" target="_blank"><img src="images/re2.png"</a></center></div>
        </div>
    </div>    



</div>
</body>
</html>
