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
    
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.png" type="image/x-icon">

    <title>Copyright: Quantum</title>
<!--<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />-->

<!--plugin jquery-->
  <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    
    <!--mis plugins y estilos-->
    <script type="text/javascript" src="js/MyJqueryDoc.js"></script>
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



    <!-- Le styles -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
        font-family: "Times New Roman", Georgia, Serif;
        font-size: 15px;
        background: white;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
      .modal-body object {
        width: 100%;
        height: 450px;
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
          <a class="brand"  style="color:white;"  href="#">Quantum</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
               <a href="#" class="navbar-link"  style="color:white;" id="InfoDataDoc">Cargando...</a>
            </p>
            <ul class="nav">
              <!--<li><a href="#" onclick="CargarConsultasDeHoyXDoctor()"><span class="icon-refresh"></span>&nbsp;Consultas de hoy</a></li>-->
              <li  onclick="CargarConsultasDeHoyXDoctor()" ><a  style="color:white;" href="#">Inicio</a></li>
              
              
              <li class="dropdown">
                    <a href="#" class="dropdown-toggle"  style="color:white;" data-toggle="dropdown">Agenda</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick="AgendarCitas()"><span class="icon-list-alt"></span>&nbsp;Agendar Citas</a></li>

                            <li><a href="#" onclick="VerCitas()"><span class="icon-tags"></span>&nbsp;Citas Emergencia</a></li>
                            
                            <li><a href="#" onclick='AgendaDoctor()'><span class="icon-file"></span>&nbsp;Agenda</a></li>
                            <li><a href="#" onclick="AgendaCirugia()" id="agendCirug"><span class="icon-calendar"></span>&nbsp;Agenda de cirugias</a></li>
                            <li class="divider"></li>
                        </ul>
              </li>


              <li class="dropdown">
                    <a href="#" class="dropdown-toggle"  style="color:white;" data-toggle="dropdown">Paciente</a>
                        <ul class="dropdown-menu">
                            <li><a href="#" onclick="NuevoPaciente()"><span class="icon-user"></span>&nbsp;Nuevo Paciente</a></li>
                            <li><a href="#" onclick="BuscarHistoriaPaciente()"><span class="icon-search"></span>&nbsp;Buscar Historias</a></li>
                            <!--<li><a href="#" onclick="BuscarHistoriaPacienteEpicrisis()"><span class="icon-search"></span>&nbsp;Buscar Epicrisis</a></li>-->
                            <li class="divider"></li>
                        </ul>
              </li>

              <li class="dropdown">
                    <a href="#" class="dropdown-toggle"  style="color:white;" data-toggle="dropdown">Otros</a>
                        <ul class="dropdown-menu">
                            
                            <li><a href="#" onclick="NewEmergencia()"><span class="icon-file"></span>&nbsp;Registro emergencia</a></li>
                          <!--  <li><a href="#" onclick='CertificadoOtros()'><span class="icon-file"></span>&nbsp;Certificado otros</a></li>-->
                            <!--<li class="divider"></li>
                            <li class="nav-header">Protocolos</li>-->
                            <li><a href="#" onclick="BuscarProtocolos()" ><span class="icon-search"></span>&nbsp;Ver Protocolos Operatorios</a></li>
                        </ul>
              </li>


              <li class="dropdown">
                    <a href="#" class="dropdown-toggle"   style="color:white;" data-toggle="dropdown">Seguridad</a>
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
                        <li class="nav-header">Menú Paciente</li>
                        <li class="active"><a href="#"><i class="icon-edit"></i>  Datos de filiacion</a></li>
                        <li>
                         <li class="dropdown">
                           <div class="dropdown-backdrop"></div><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" icon-chevron-right"></i>  Consulta Externa</a>
                           <ul class="dropdown-menu">
                            <li><a href="#"  >Consulta</a></li>
                            <li><a href="#" >Epicrisis</a></li>
                          </ul>
                        </li>
                      </li>

                      <li>
                        <li class="dropdown">
                         <div class="dropdown-backdrop"></div><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=" icon-chevron-right"></i>  Hospitalizacion</a>
                         <ul class="dropdown-menu">
                          <li><a href="#"  >Anamnesis</a></li> 
                        </ul>
                      </li>
                    </li>
                    <li><a href="#"><i class="icon-th-list"></i>  Historia Examenes</a></li>

                    <li class="nav-header">Interconsulta</li>
                    <li><a href="#"><i class="icon-hand-right"></i>  Solicitud</a></li>
                    <li><a href="#"><i class="icon-file"></i>  Informe</a></li>
                    <li class="nav-header">Examenes</li>
                    <li><a href="#"><i class="icon-tint"></i>  Examen fisico</a></li>
                    <li><a href="#"><i class="icon-tint"></i>  Examenes</a></li>
                    <hr/>
                    <li class="nav-header">Terminar</li>
                    <li><a href="#"><i class="icon-remove-sign"></i>  Finalizar Consulta</a></li>

                            </ul>
          </div><!--/.well -->

         <!-- <div class="well sidebar-nav">
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
        
        <!--ocultos-->
        <input type='hidden' id='txtCodHora'  />
        <input type='hidden' id='txtCodigoPacente147' />
        <input type='hidden' id='txtfechaReseva147'   />
        <input type='hidden' id='imagenes123' />
        <input type='hidden' id='codigoTurno123' />
        <input type='hidden' id='CajaOcultaFenixTurno' />
        <input type='hidden' id='codigoPaciente' />
        <input type='hidden' id='codigoescondidoanam123' />
        <input type='hidden' id='txtmd'>
        <!--ocultos-->


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

       
          
          <!--div modales jquery-->
          <div id="CieAnamnesisCdu">
            <div id="VerCie"></div>
            <div id="AreaListCie"></div>
          </div>


          <div class="zonadivs">
          </div>

        </div><!--/span-->

        <!--CUERPO-->
      </div><!--/row-->

      <hr>

      <footer>
        <center> <p>&copy; Company 2015  <a href="http://www.oyzecuador.com/"  target="_blank">Quantum </a> </p> </center>
      </footer>
    </div><!--/.fluid-container-->



  </body>
</html>

