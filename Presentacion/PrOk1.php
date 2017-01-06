<?php
session_start();
if(!isset($_SESSION['DOCTOR']))
{
  header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="../favicon.png" type="image/x-icon">
    <title>Copyright: Quantum</title>
<!--<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />-->

<!--plugin jquery-->
  <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    
    <!--mis plugins y estilos-->
    <script type="text/javascript" src="js/MyJqueryOk1.js"></script>
    <link rel="stylesheet" href="css/MyEstilo.css" type="text/css" media="all"/>
  
    <!--plugin para trabajar con mejores interfaces-->

  <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
    
    <!--<link rel="stylesheet" href="css/overcast/jquery-ui-1.10.3.custom.css" type="text/css" />-->
    <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.9.2.custom.css" type="text/css"/>

  
    <!--<link rel="stylesheet" type="text/css" href="css/overcast/jquery-ui-1.10.3.custom.css"/>-->

    <!--validador de cedula-->
    <script src="js/ruc_jquery_validator.min.js" type="text/javascript" ></script>    
    <!--tabla -->
<!--      <link rel="stylesheet" href="css/demo_table_jui.css" type="text/css"/>
    <link rel="stylesheet" href="css/demo_page.css" type="text/css"/>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>-->

  <!--ESTILOS Y SCRIPT BOOBSTRAP-->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="css/bootstrap-responsive.css" type="text/css"/>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


    <!--general all-->
    <script type="text/javascript" src="js/MyJqueryGeneral.js"></script>
    <!--general all-->



    <!-- Le styles -->
    
    <style type="text/css">
      .Resp2 object{
        width: 100%;
        height: 800px;
      }
      body {
        padding-top: 60px;
        padding-bottom: 40px;
        background:#FFF;
        font-family: "Times New Roman", Georgia, Serif;
        font-size: 15px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

       .modal-body object{
        width: 100%;
        height: 600px;
       }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }

      }
      
    </style>
    
  </head>

  <body>


<!--BARRA DE NAVEGACION-->


    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid" style="background:#0088cc; ">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a style="color:white;" class="brand" href="http://www.quantum.ec/" target="_blank">Quantum</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
               <a style="color:white;" href="#" class="navbar-link" id="InfoDataDoc">Cargando...</a>
            </p>
            <ul class="nav">
              <!--<li><a href="#" onclick="CargarConsultasDeHoyXDoctor()"><span class="icon-refresh"></span>&nbsp;Consultas de hoy</a></li>-->
              <li class=""  ><a style="color:white;"  href="PrOk1.php">Inicio</a></li>



              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color:white;" data-toggle="dropdown">Seguridad</a>
                        <ul class="dropdown-menu">
                            <li><a href="../Dominio/CerrarSecion.php"><span class="icon-off"></span>&nbsp;Salir</a></li>
                        </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<!--FIN BARRA DE NAVEGACION-->








    <div class="container-fluid">
      <div class="row-fluid">
      
      

      <!--MENU PACIENTE-->
        <div class="span3">
          <div class="well sidebar-nav" id="MenuDoctor">
            <ul class="nav nav-list">

              <li class="nav-header"><span class="icon-calendar"></span> Agendas</li>
              <li class='active'><a href="#" onclick="VerAgendaCirug()" ><i class=' icon-chevron-right'></i> Agenda de cirugias</a></li>
              <li><a href="#" onclick="BuscarCitasCirg()" ><i class=' icon-chevron-right'></i>Buscar citas cirugias</a></li>
              <li class="nav-header"><i class='icon-user'></i> Menú Paciente</li>
              <li ><a href="#" onclick="NuevoPaciente()"><i class=' icon-chevron-right'></i> Nuevo Paciente</a></li>
              <li><a href="#" onclick="ShowModPaciente()" ><i class=' icon-chevron-right'></i> Actualizar datos paciente</a></li>
              <li><a href="#" onclick="HistorialPacienteAngular()" ><i class=' icon-chevron-right'></i> Historial paciente</a></li>

              <li class="nav-header"><span class="icon-calendar"></span> Citas</li>
              <li class=''><a href="#" onclick="NewCitaNormal()" ><i class=' icon-chevron-right'></i> Crear cita</a></li>
              <li class=''><a href="#" onclick="SearchCitaNormal()" ><i class=' icon-chevron-right'></i> Buscar cita</a></li>



              <li class="nav-header"><i class='icon-plus'></i> Menú Medico</li>
              <li><a href="#" onclick="NuevoMedico()" ><i class=' icon-chevron-right'></i> Nuevo Medico</a></li>
              <li><a href="#" onclick="ShowModMedico()" ><i class=' icon-chevron-right'></i> Actualizar datos medico</a></li>

              <li class="nav-header"><i class='icon-plus'></i> Administrador</li>
              <li><a href="#" onclick="GestionarAdiministrador()" ><i class=' icon-chevron-right'></i> Actualizar datos</a></li>

              <li class="nav-header"><i class='icon-plus'></i> Secretaria</li>
              <li><a href="#" onclick="GestionarSecretaria()" ><i class=' icon-chevron-right'></i> Actualizar datos</a></li>

              <li class="nav-header"><i class='icon-plus'></i> Digitador</li>
              <li><a href="#" onclick="GestionarDigitador()" ><i class=' icon-chevron-right'></i> Actualizar datos</a></li>


            </ul>
          </div><!--/.well -->

        

        </div><!--/span-->

        <!--MENU PACIENTE-->



        <!--CUERPO-->
        <div class="span9">
            
            <!--TEXT OCULTAS-->
            <input type='hidden' id='txtadelante'>
            <input type='hidden' id='txtatras'>

            <input type='hidden' id='txthidecodigocitaok1'/>
        
        
    		    <div class="Cabe1"></div>
          	<div class="Resp1"></div>
          	<div class="Resp2"></div>
          	<div class="Resp3"></div>
          	<div class="Resp4"></div>
         	  <div class="Resp5"></div>
         	  <div class="Resp6"></div>


      	 <!-- Button to trigger modal -->
       	<!--  <a href='#myModal' role='button' class='btn' data-toggle='modal'>Launch demo modal</a>-->
       	<!-- Modal -->
      	 <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        		<h3 id="myModalLabel">Quantum</h3>
        	</div>
          	<div class="modal-body">
                  
          	</div>

           	<div class="modal-footer">
           		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                  
           	</div>
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
                            <input class="span12" id="txtBuscar1"  onkeydown="BuscarPaciente2();"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Buscar Cita Del Paciente</a>
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
                        <center><h4>Agenda Cirugia</h4></center>
                    </td>
                </tr>
                <tr>
                    <td>
                        <center>
                        <div class="input-append">
                            <input class="span12" id="txtBuscar4"  onkeydown="BuscarPaciente4();"  type="text">
                            <a class='btn' ><i class='icon-search'></i>Cedula Paciente</a>
                        </div>
                        </center>
                    </td>
                </tr>
            </table>
        </div>













       
          


        </div><!--/span-->

        <!--CUERPO-->



      </div><!--/row-->

      <hr>

      <footer>
        <center> <p>&copy; Company 2015  <a href="http://www.quantum.ec/"  target="_blank">Quantum </a> </p> </center>
      </footer>
      
         



        <!---<div id="AreaParaViewConsulta"></div>-->
        <div id="AreaDeBusquedafecha">
        </div>
        <div id="RespuestaHorasDisponibles">
        </div>
        <div id="RespuestaAsignacionTurno">
        </div>
        <div id="DeletePaciente" title="Borrar Paciente">
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

            <!--altas y bajas medico-->
            <div id='ModMedico'>
            </div>
            <div id='DeleMedico'> </div>
            <!--altas y bajas medico-->
            
             <!--nuevo medico-->
            <div id='NewMedico'>
                <div id="ModalNewMedico">
                </div>
            </div>
            <!--nuevo medico-->



            <!--div para cargar los datos de la cita de curgia-->
            <div id="CitaCiru" style="position:relative; width:100%; height:100%;">
            </div>
            <div id='PdfCitaCirug'>
            </div>
            <!--fin div para cargar los datos de la cita de curgia-->
            <!-- fin divs  para de respuestas de los procesos de la logica-->                

          


                <input type='hidden' id='thtcodciruja'/>
                <input type='hidden' id='thtcodantesi'/>
                <input type='hidden' id='thtcodayudan'/>
                <input type='hidden' id='txtCodigoPacienteSelecParaCitCir'/> 

    <div class="zonadivs">
    </div>



















    </div><!--/.fluid-container-->



  </body>
</html>

