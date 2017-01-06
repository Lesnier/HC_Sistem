<?php

session_start();

if(!isset($_SESSION['DOCTOR']))

{

    header("Location:../index.php");

}

?>

<!DOCTYPE html >

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="viewport" content="width=device-width, initial-scale=1.0">



<title>Copyright: QUANTUM</title>

<!--<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />-->



<link rel="icon" href="../favicon.png" type="image/x-icon">





<!--plugin jquery-->

    <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>

    

    <!--mis plugins y estilos-->

    <script type="text/javascript" src="js/MyJqueryOk.js"></script>

    <link rel="stylesheet" href="css/MyEstilo.css" type="text/css" media="all"/>



    <!--general all-->

    <script type="text/javascript" src="js/MyJqueryGeneral.js"></script>

    <!--general all-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>

    

    <!--plugin para trabajar con mejores interfaces-->



    <script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>



    <!--<link rel="stylesheet" href="css/overcast/jquery-ui-1.10.3.custom.css" type="text/css" />-->





    



 <!--<link rel="stylesheet" href="css/overcast/jquery-ui-1.10.3.custom.css" type="text/css" />-->

    <link rel="stylesheet" href="css/custom-theme/jquery-ui-1.9.2.custom.css" type="text/css"/>





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

    









  <meta name="viewport" content="width=device-width,initial-scale=1">

  <link rel="stylesheet" href="public/css/style.css">

  <!--<link rel="stylesheet" href="public/css/jquery-ui-1.8.17.custom.css">-->

  <link rel="stylesheet" href="public/css/jquery.svg.css">

  <link rel="stylesheet" href="public/css/odontograma.css">



  <!-- scripts concatenated and minified via ant build script-->

<!--  <script defer src="public/js/jquery-1.7.1.min.js"></script>-->

  <script defer src="public/js/plugins.js"></script>

  <!--<script defer src="public/js/jquery-ui-1.8.17.custom.min.js"></script>-->

  <script defer src="public/js/jquery.tmpl.js"></script>

  <script defer src="public/js/knockout-2.0.0.js"></script>

  <script defer src="public/js/jquery.svg.min.js"></script>  

  <script defer src="public/js/jquery.svggraph.min.js"></script>  

  <script defer src="public/js/odontograma.js"></script>

  <!-- end scripts-->





<!--script para validar texto y numeros-->

    <script type="text/javascript" src="js/jquery.alphanumeric.pack.js"></script>





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



      .navbar{

        box-shadow: 0px 0px 15px black;

        border: 0;

      }

      .modal-body object{

        width: 100%;

        height: 450px;



      }

      .modal-body2 object{

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

  <div id="top23"></div>



    <div class="navbar navbar-inverse   navbar-fixed-top">

      <div class="navbar-inner "  style="background:#0088cc; ">

        <div class="container-fluid" >

          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse" style='background:#034672;'>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

          </button>

        <a style="color:white;" class="brand" href="http://www.oyzecuador.com/" target="_blank">Quantum</a>

          <div class="nav-collapse collapse">

            <p class="navbar-text pull-right">

               <a href="#" class="navbar-link" style="color:white;" id="InfoDataDoc">Cargando...</a>

            </p>

            <ul class="nav "  >

              







                 <li><a href="#"><div id="InfoDataDoc"></div></a></li>

                                <li >

                                    <a href="#" class='home '  style="color:white;" >Inicio</a>

                                </li>                                



                               



                                <li class="dropdown">

                                                <a href="#"  style="color:white;" class="dropdown-toggle" data-toggle="dropdown">Agendas </a>

                                                    <ul class="dropdown-menu">

                                                        

                                                        <li><a href="#" onclick="AgendaCirugiaMes()" ><span class="icon-calendar"></span>&nbsp;Agenda de cirugias</a></li>

                                                        <li><a href="#" onclick="CitasPacientesAgenda()" ><span class="icon-calendar"></span>&nbsp;Agenda</a></li>

                                                        <li><a href="#" onclick="CrearCitaNormal()" id=""><span class="icon-calendar"></span>&nbsp;Crear cita</a></li>

                                                        <li><a href="#" onclick="AgendaCirugia2()" ><span class="icon-calendar"></span><i class='icon-cog'></i>&nbsp;Agendar Cirugias</a></li>

                                                        <li><a href="#" onclick="VerCitasDeLosMedicos()" ><span class="icon-calendar"></span>&nbsp;Citas de los medicos</a></li>

                                                        <li><a href="#" onclick="BuscarCitas33()" ><span class="icon-search"></span>&nbsp;Buscar citas cirugias</a></li>

                                                    </ul>

                                </li>



                           





                                <li class="dropdown">

                                                <a href="#" class="dropdown-toggle" style="color:white;" data-toggle="dropdown">Otros</a>

                                                    <ul class="dropdown-menu">

                                                        

                                                         <li><a href="#" onclick="BuscarProtocolosOpe()" ><span class="icon-search"></span>&nbsp;Ver Protocolos Operatorios</a></li>

                                                         <li><a href="#" onclick="FrmEmrgenciaPaciente()" ><span class="icon-file"></span>&nbsp;Emergencia</a></li>



                                                    </ul>

                                </li>

                                





                                <!-- <li class="dropdown">

                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Facturacion</a>

                                                    <ul class="dropdown-menu">

                                                        <li><a href="#" onclick="" id="dok"><span class="icon-ok"></span><i class='icon-file'></i>&nbsp;Ducumentacion Finalizada</a></li>

                                                        <li><a href="#" onclick="" id="dom"><span class="icon-remove-sign"></span><i class='icon-file'></i>&nbsp;Docunemtacion Sin Finalizar</a></li>

                                                        <li><a href="#" onclick="" id="dop"><i class='icon-file'></i>&nbsp;Documentos Facturados</a></li>

                                                    </ul>

                                </li>-->



                                <li class="dropdown">

                                    <a href="#" class="dropdown-toggle" style="color:white;" data-toggle="dropdown">Seguridad</a>

                                        <ul class="dropdown-menu">



                                            <li><a href="../Dominio/CerrarSecion.php"><span class="icon-off"></span>Salir</a></li>

                                        </ul>

                                </li>











            </ul>

          </div><!--/.nav-collapse -->

        </div>

      </div>

    </div>



    <div class="container-fluid" style="margin-top:2%;">

      <div class="row-fluid">

        

        <div class='span3   '>





        

        <div class="well sidebar-nav" id="MenuDoctor">

            <ul class="nav nav-list">

                 <li class="active"><a href="#" class='home'><span class="icon-home"></span>&nbsp;Inicio</a></li>



                <li class="nav-header"><i class='icon-user'></i> Personal</li>

            

              <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=' icon-chevron-right'></i>  Medicos</a>

                  <ul class="dropdown-menu">



                      <li><a href="#" onclick="NuevoMedico()" id="newMedi"><span class="icon-user"></span><i class='icon-plus'></i>&nbsp;Nuevo Medico</a></li>

                      <li><a href="#" onclick="ModificarMedicosAll()" ><span class="icon-refresh"></span><i class='icon-user'></i><i class='icon-plus'></i>&nbsp;Actualizar datos medico</a></li>



                  </ul>

              </li>



               <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=' icon-chevron-right'></i>  Administradores</a>

                  <ul class="dropdown-menu">



                       <li><a href="#" onclick="NuevoAdministrador()" id="newMedi"><span class="icon-user"></span><i class='icon-plus'></i>&nbsp;Nuevo administrador</a></li>

                       <li><a href="#" onclick="NewAdiministrador()" ><span class="icon-refresh"></span><i class='icon-user'></i><i class='icon-plus'></i>&nbsp;Actualizar datos administradores</a></li>

                      

                  </ul>

              </li>



              <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=' icon-chevron-right'></i> Secretarias</a>

                  <ul class="dropdown-menu">



                <li><a href="#" onclick="NuevoSecreR()" id="newMedi"><span class="icon-user"></span><i class='icon-plus'></i>&nbsp;Nueva secretaria o R.</a></li>

                <li><a href="#" onclick="ModifySecretaria()" ><span class="icon-refresh"></span><i class='icon-user'></i><i class='icon-plus'></i>&nbsp;Actualizar datos secretaria o R.</a></li>

                      

                  </ul>

              </li>





               <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=' icon-chevron-right'></i> Digitador</a>

                  <ul class="dropdown-menu">

                    <li><a href="#" onclick="NewDigitador()" id="newMedi"><span class="icon-user"></span><i class='icon-plus'></i>&nbsp;Nuevo Digitador</a></li>

                   <li><a href="#" onclick="ModifyDigitador()"><span class="icon-refresh"></span><i class='icon-user'></i><i class='icon-plus'></i>&nbsp;Actualizar datos digitador</a></li>

                  </ul>

              </li>





              <li class="dropdown">

                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class=' icon-chevron-right'></i> Anestesiólogo</a>

                  <ul class="dropdown-menu">

                    <li><a href="#" onclick="NewAnestesiologo()" id="newMedi"><span class="icon-user"></span><i class='icon-plus'></i>&nbsp;Nuevo Anestesiólogo</a></li>

                   <li><a href="#" onclick="ModifyAnestesiologo()" ><span class="icon-refresh"></span><i class='icon-user'></i><i class='icon-plus'></i>&nbsp;Actualizar datos Anestesiólogo</a></li>

                  </ul>

              </li>





              <li class="nav-header"><i class='icon-user'></i> Pacientes</li>

              <li><a href="#" onclick="NuevoPaciente()"><span class="icon-chevron-right"></span>&nbsp;Nuevo Paciente</a></li>

              <li><a href="#" onclick="ModifyPAciente()" ><i class='icon-chevron-right'></i>&nbsp;Actualizar datos paciente</a></li>

              <li><a href="#" onclick="BuscarHistoriaPaciente()"><span class="icon-chevron-right"></span>&nbsp;Buscar Historias</a></li>

              <li><a href="#" onclick="SubirArchivosPaciente()" ><span class="icon-chevron-right"></span>&nbsp;Archivos pacientes</a></li>

              

                

            </ul>

          </div>









        </div>



        <div class="span9">



          <!--contenido-->

          <div class="row-fluid">

           

            <!--Ocultos Text-->

            <input type='hidden' id='txtadelante'>

            <input type='hidden' id='txtatras'>



            <input type='hidden' id='codepaciente'> 

            <input type='hidden' id='codemedico'> 



            <input type='hidden' id='thtcodciruja'/>

            <input type='hidden' id='thtcodantesi'/>

            <input type='hidden' id='thtcodayudan'/>

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





         <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

          <div class="modal-header2">

            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

            <h3 id="myModalLabel">Quantum</h3>

          </div>

            <div class="modal-body">

                  

            </div>



            <div class="modal-footer">

              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

                  

            </div>

         </div>









        <!--facturacion-->

        <div id="Form6Search">

                <div id='FinaliazaAllFile'>

                </div>

        </div>



           





        <!--facturacion-->



      <div id="Form16Search">

            



            <div id="resp6"></div>



            <div id="Searchmedico002">

               

            </div>

            <div id="frmdoct01">

                <div id="resdoct01"></div>

                <div id="resdoct02"></div>

                <div id="resdoct03"></div>

            </div>

           

          

        </div>







          

        </div><!--/span-->

      </div><!--/row-->



        

    <!-- Altas y bajas Anestesia -->

    



    <div class="row-fluid">

        <div class="span12">

        

        <!--div pricipal para las respuestas de la logica-->    

        

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

            <!-- fin divs  para de respuestas de los procesos de la logica-->                





            <div id="CitaCiru">

            </div>

            <div id="PdfCitaCirug">

            </div>

            

            <!-- Altas y bajas Anestesia -->

            <div id="NewAnestesia">

            </div>

            

            <div id="ModAnestesia">

            </div>

            

            <div id="DelAnestesia">

            </div>

            <!-- Fin Altas y bajas Anestesia -->





            <!--div de modificacion de citas medicas-->

                <div class="modal01"></div>

            <!--div de modificacion de citas medicas-->



             <!--div de alertas de vencimiento de fecha-->

                <div id="AlertaFechaVencimiento"></div>

            <!--div de alertas de vencimiento de fecha-->

            



            <!--input ocultos-->

                

            <!--fin input ocultos-->





            <div id='ModalFechasDoc'>

                <div id="buscadores"></div>

                <div id="respuestas"></div>

            </div>







            <div id="HistoriaClinica" title="Buscar Histora">

                <div id="FrmBuscar">

                </div>

                

                <div id="RespuesraHistoria">

                </div>

                

                <div id="NewPaciente" title="Nuevo Paciente DATOS DE FILIACIÓN"><div id="RespuestaNewPaciente"></div></div>

                <div id="FormularioDeImpresionTurno"></div>

            </div>



            <div id="HistorialPaciente">

            </div>

            <div id="LoadFileAnanamesis">

            </div>

            <div id="LoadFileEpiciris">

            </div>



            <!--historial de solicitud de interconsulta-->

                <div id="SolicituInterconsulta"></div>

                <div id="ImpSolicituInterconsulta"></div>

                <div id="InfoInterconsulta"></div>

                <div id="ImpInfoInterconsulta"></div>

            <!--historial de solicitud de interconsulta-->

            <div id="SegSecLoadFile">

            </div>

            <div id="PrfirLoadFile">

            </div>

            <div id="VerPdfAnamnesis">

            </div>



            <!--div generales-->

                <div id="CitasMedicoXFecha"></div>

            <!--div generales-->





        </div>

    </div>



<div class="zonadivs">

</div>



      <hr>



      <footer>

       <center> <p>&copy; Company 2015  <a href="http://www.quantum.ec/"  target="_blank">Quantum </a> </p> </center>

      </footer>



    </div><!--/.fluid-container-->



    <!-- Le javascript

    ================================================== -->

<input type='hidden' id='txtmedicamentos'/>



</body>

</html>