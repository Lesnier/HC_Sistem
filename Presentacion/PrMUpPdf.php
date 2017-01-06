<?php
session_start();
if(!isset($_SESSION['DOCTOR']))
{
    header("Location:index.php");
}
?>

<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Copyright: Quantum</title>
<link rel="stylesheet" type="text/css" href="../Presentacion/css/style.css" media="screen" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" href="../favicon.png" type="image/x-icon">

<!--plugin jquery-->
    <script type="text/javascript" src="../Presentacion/js/jquery-1.7.1.min.js"></script>

    <script type="text/javascript" src="../Presentacion/js/MyJqueryUP.js"></script>
    <link rel="stylesheet" href="../Presentacion/css/MyEstilo.css" type="text/css" media="all"/>
    <!--plugin para trabajar con mejores interfaces-->
    <script src="../Presentacion/js/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../Presentacion/css/overcast/jquery-ui-1.10.3.custom.css" type="text/css" />

    <!--validador de cedula-->
        <script src="../Presentacion/js/ruc_jquery_validator.min.js" type="text/javascript" ></script>    
    <!--tabla -->
        <link rel="stylesheet" href="../Presentacion/css/demo_table_jui.css" type="text/css"/>
        <link rel="stylesheet" href="../Presentacion/css/demo_page.css" type="text/css"/>
        <script type="text/javascript" src="../Presentacion/js/jquery.dataTables.js"></script>

    <!--ESTILOS Y SCRIPT BOOBSTRAP-->
    <link rel="stylesheet" href="../Presentacion/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../Presentacion/css/bootstrap-responsive.css" type="text/css"/>
    <script type="text/javascript" src="../Presentacion/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../Presentacion/css/custom-theme/jquery-ui-1.9.2.custom.css" type="text/css"/>



        <!--general all-->
        <script type="text/javascript" src="js/MyJqueryGeneral.js"></script>
        <!--general all-->

<script type="text/javascript">
</script>

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
          <a class="brand" style="color:white;"  href="http://www.quantum.ec/" target="_blank">Quantum</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
               <a href="#" style="color:white;"  class="navbar-link" id="InfoDataDoc">Cargando...</a>
            </p>
            <ul class="nav">
              <!--<li><a href="#" onclick="CargarConsultasDeHoyXDoctor()"><span class="icon-refresh"></span>&nbsp;Consultas de hoy</a></li>-->
              <li class=""  ><a style="color:white;" href="PrMUpPdf.php">Inicio</a></li>



              <li class="dropdown">
                    <a href="#" style="color:white;" class="dropdown-toggle" data-toggle="dropdown">Seguridad</a>
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
                <li class="nav-header">Archivar</li>
                <li><a href="#" onclick="Archivar()" ><span class="icon-folder-open"></span>&nbsp;Subir Archivos</a></li>
              <li class="nav-header">Menú Paciente</li>
              <li ><a href="#" onclick="NuevoPaciente()"><span class="icon-user"></span>&nbsp;Nuevo Paciente</a></li>
              <li><a href="#" onclick="ModificaPaciente()" id="modpac"><span class="icon-refresh"></span><i class='icon-user'></i>&nbsp;Actualizar datos paciente</a></li>
              <li class="nav-header">Agendas</li>
              <li><a href="#" onclick="ShowAgendaCirg()" ><span class="icon-calendar"></span><i class='icon-plus'></i>&nbsp;Agenda de cirugías</a></li>
              <li><a href="#" onclick="ShowCitasMedi()" ><span class="icon-calendar"></span><i class='icon-user'></i>&nbsp;Citas de los médicos</a></li>
              <li><a href="#" onclick="ShowSearchCitasCirg()" id="buscarcitacirugia"><span class="icon-search"></span>&nbsp;Buscar citas cirugías</a></li>
              
            </ul>
          </div><!--/.well -->

          <!--<div class="well sidebar-nav">
            <ul class="nav nav-list">
               <li class="nav-header">Redes sociales</li>
               <li>
                    <a href="https://www.facebook.com/pages/Quantum/421396868000546?ref=%20notif&%20ampnotif_t=page_invite_accepted/%20class" target="_blank"><img src="images/re1.png"/>&nbsp; Facebook</a>  
                </li>
                <li>
                    <a href="https://twitter.com/QUANTUMCLICK" target="_blank"><img src="images/re2.png">&nbsp; Twitter</a> 
               </li> 
            </ul>
          </div>-->

        </div><!--/span-->

        <!--MENU PACIENTE-->  
    
    
 
<!--CUERPO-->
        <div class="span9">
        


        
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

     
<!--fila 2 fin-->




<!--fila 2 inicio-->    
    <div class="row-fluid">
            <div class="span12" id="Frm7">
           
            </div>
    </div>
<!--fila 2 fin-->





   </div><!--/span-->

        <!--CUERPO-->



     </div><!--/row-->

    



<!--fila 2 inicio-->    
    <div class="row-fluid">
        <div class="span12" id="ModalDigital">
            
        </div>
    </div>
<!--fila 2 fin-->




            <div id="CitaCiru">
            </div>
            <div id="PdfCitaCirug">
            </div>
            



            <!--div generales-->
                <div id="CitasMedicoXFecha"></div>
            <!--div generales-->



  <hr>

      <footer>
        <center> <p>&copy; Company 2015  <a href="http://www.quantum.ec/"  target="_blank">Quantum </a> </p> </center>
      </footer>


</div><!--/.fluid-container-->



</body>
</html>
