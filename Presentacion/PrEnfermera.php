<?php
session_start();
if(!isset($_SESSION['ENFERMERA']))
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
    <script type="text/javascript" src="js/MyJquery.js"></script>
    <link rel="stylesheet" href="css/MyEstilo.css" type="text/css" media="all"/>
  
    <!--plugin para trabajar con mejores interfaces-->

  <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
    
    <!--<link rel="stylesheet" href="css/overcast/jquery-ui-1.10.3.custom.css" type="text/css" />-->
    <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.9.2.custom.css" type="text/css"/>

  
    <!--<link rel="stylesheet" type="text/css" href="css/overcast/jquery-ui-1.10.3.custom.css"/>-->

    <!--validador de cedula-->
    <script src="js/ruc_jquery_validator.min.js" type="text/javascript" ></script>    
    <!--tabla -->
      <link rel="stylesheet" href="css/demo_table_jui.css" type="text/css"/>
    <link rel="stylesheet" href="css/demo_page.css" type="text/css"/>
    <script type="text/javascript" src="js/jquery.dataTables.js"></script>

  <!--ESTILOS Y SCRIPT BOOBSTRAP-->
    <link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="css/bootstrap-responsive.css" type="text/css"/>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>


    <!--general all-->
    <script type="text/javascript" src="js/MyJqueryGeneral.js"></script>
    <!--general all-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>


    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
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

<body  onblur='Controll();'>

<!--BARRA DE NAVEGACION-->


    <div class="navbar navbar-inverse navbar-fixed-top" >
      <div class="navbar-inner" >
        <div class="container-fluid" style="background:#0088cc; ">
          <button type="button" class="btn btn-navbar"  data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a style="color:white;"  class="brand" href="http://www.oyzecuador.com/" target="_blank" >Quantum</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
               <a href="#" class="navbar-link "  style="color:white;"     id="InfoDataDoc">Cargando...</a>
            </p>
            <ul class="nav">
              <!--<li><a href="#" onclick="CargarConsultasDeHoyXDoctor()"><span class="icon-refresh"></span>&nbsp;Consultas de hoy</a></li>-->
              <li   ><a href="PrEnfermera.php" style="color:white;" >Inicio</a></li>



              <li class="dropdown">
                    <a href="#" class="dropdown-toggle" style="color:white;"  data-toggle="dropdown">Seguridad</a>
                        <ul class="dropdown-menu">
                            <li><a href="../Dominio/CerrarSecion.php"  ><span class="icon-off"></span>&nbsp;Salir</a></li>
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
               
              
            

              <li class="nav-header"><i class='icon-user'></i> Menú Paciente</li>
              <li class="active"><a href="#" onclick="NuevoPaciente()"><span class="icon-chevron-right"></span>&nbsp;Nuevo Paciente</a></li>
              <li><a href="#" onclick="ShowModPaciente()" id="modpac"><i class='icon-chevron-right'></i>&nbsp;Actualizar datos paciente</a></li>

              <li class="nav-header"><i class='icon-calendar'></i> Agendas</li>
              <li><a href="#" onclick="ShowCitaPacientes()" id="agend1"><span class="icon-chevron-right "></span>&nbsp;Agenda</a></li>
              <li><a href="#" onclick="ShowCreateCita()" id="gecita"><span class="icon-chevron-right "></span>&nbsp;Crear cita</a></li>
              <li><a href="#" onclick="ShowAgendarCirg()" id="agend2"><span class="icon-chevron-right "></span>&nbsp;Agendar Cirugias</a></li>
              <li><a href="#" onclick="ShowAgendaCirg()" ><span class="icon-chevron-right"></span>&nbsp;Ver Agenda de cirugias</a></li>
              <li><a href="#" onclick="ShowCitasMedicos()" id="citaalldoct"><span class="icon-chevron-right"></span>&nbsp;Citas de los medicos</a></li>

              <li class="nav-header"><i class='icon-search'></i> Buscar</li>
              <li><a href="#" onclick="ShowSearchCitasCirg()" id="buscarcitacirugia"><span class="icon-chevron-right"></span>&nbsp;Buscar citas cirugias</a></li>
              <li><a href="#" onclick="ShowVerProtocolosOp()" id="Buscarpropertario"><span class="icon-chevron-right"></span>&nbsp;Ver Protocolos Operatorios</a></li>


            </ul>
          </div><!--/.well -->

          <!--<div class="well sidebar-nav">
            <ul class="nav nav-list">
               <li class="nav-header">Redes sociales</li>
               <li class="active">
                    <a href="https://www.facebook.com/pages/Quantum/421396868000546?ref=%20notif&%20ampnotif_t=page_invite_accepted/%20class" target="_blank"><img src="images/re1.png"/>Facebook</a>  
                </li>
                <li>
                    <a href="https://twitter.com/QUANTUMCLICK" target="_blank"><img src="images/re2.png">Twitter</a> 
               </li> 
            </ul>
          </div>-->

        </div><!--/span-->

        <!--MENU PACIENTE-->



        <!--CUERPO-->
        <div class="span9">
          

        
         <!--Ocultos Text-->
            <input type='hidden' id='txtadelante'>
            <input type='hidden' id='txtatras'>

            <input type='hidden' id='codepaciente'> 
            <input type='hidden' id='codemedico'> 

            <input type='hidden' id='thtcodciruja'/>
            <input type='hidden' id='thtcodantesi' value="0" />
            <input type='hidden' id='thtcodayudan' value="0" />
            <input type='hidden' id='txtCodigoPacienteSelecParaCitCir'/> 
          <!--Ocultos Text-->



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







		<div id="frmdoct01">
        	<div id="resdoct01"></div>
        	<div id="resdoct02"></div>
        </div>
        
        
        
       
       <div id="cmbhor02"></div>
       
       <input type='hidden' id='codepaciente'> 
       <input type='hidden' id='codemedico'>



        </div><!--/span-->

        <!--CUERPO-->

        <div class='zonadivs'></div>

      </div><!--/row-->

      <hr>

      <footer>
        <center> <p>&copy; Company 2015  <a href="http://www.oyzecuador.com/"  target="_blank">Quantum </a> </p> </center>
      </footer>








    

    </div><!--/.fluid-container-->



</body>
</html>
