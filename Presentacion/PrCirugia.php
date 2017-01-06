<?php
session_start();
if(!isset($_SESSION['DOCTOR']))
{
	header("Location:../index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Copyright: OYZ Ecuador</title>
<!--<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />-->

<!--plugin jquery-->
	<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
    
    <!--mis plugins y estilos-->
    <script type="text/javascript" src="js/MyJqueryCirugias.js"	></script>
    
    <link rel="stylesheet" href="css/MyEstilo.css" type="text/css" media="all"/>
	
    <!--plugin para trabajar con mejores interfaces-->

	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>

    <!--<link rel="stylesheet" href="css/overcast/jquery-ui-1.10.3.custom.css" type="text/css" />-->


	
<link rel="stylesheet" type="text/css" href="css/overcast/jquery-ui-1.10.3.custom.css"/>

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

    

</head>

<body>
<div class="container">

    <!--inicio fila1-->    	    
    <div class="row-fluid">
   	       <div class="span12">
            	<div class="navbar">
                	<div class="navbar-inner">
                    <div class="brand"><div id="logoEmp"><img src="images/logosimed.fw.png" /></div></div>
                        	<ul class="nav pull-right">
                            	<li><a href="#"><div id="InfoDataDoc"></div></a></li>
                                <li class="dropdown">
                                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menú  Cirugía</a>
                                    	<ul class="dropdown-menu">   
                                        	<li><a href="#" onclick="ConsultasDeHoyXCirugia()"><span class="icon-refresh"></span>&nbsp;Consultas de hoy</a></li>
                                            <li><a href="#" onclick="NuevoPaciente()"><span class="icon-user"></span>&nbsp;Nuevo Paciente</a></li>
                                            <li><a href="#" onclick="VerCitas()"><span class="icon-tags"></span>&nbsp;Citas Hoy</a></li>
                                            <li><a href="#" onclick="AgendarCitas()"><span class="icon-list-alt"></span>&nbsp;Agendar Citas</a></li>
                                            <li><a href="#" onclick='AgendaDoctor()'><span class="icon-file"></span>&nbsp;Agenda</a></li>                                
                                        </ul>
                                <li class="dropdown">
                                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reportes</a>
                                    	<ul class="dropdown-menu">
                                        	<li><a href="#" onclick="#"><span class="icon-file"></span>&nbsp;Pagos</a></li>
                                            <li><a href="#" onclick=""><span class="icon-file"></span>&nbsp;lugares Cirugía</a></li>
                                            <li><a href="#" onclick="BuscarHistoriaCirugia()"><span class="icon-search"></span>&nbsp;Buscar Historial</a></li>
                                        </ul>
                                </li>
                                </li>                                
                                <li class="dropdown">
                                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Seguridad</a>
                                    	<ul class="dropdown-menu">
                                        	<li><a href="../Dominio/CerrarSecion.php"><span class="icon-arrow-left"></span>&nbsp;Salir</a></li>
                                        </ul>
                                </li>
                            </ul>
                    </div>
                </div>
            </div>
    </div>
    <!--fin fila1-->    	
    
    <!-- fila0 para espacio en blanco-->    	
    <div class="row-fluid">
    	<div class="span12">
        	&nbsp;
        </div>
    </div>
    <!-- fin fila0 para espacio en blanco-->    	    
    
    <!--inicio fila2-->
   <div class="row-fluid">
   		<div class="span12">
        			<div id="MenuDoctor">
        <!--            <ul style="height:150px;" id="menufenix">
                        <li class="ui-state-disabled"><a href="#">Menu Doctor</a></li>
                        <li><a href="#" onclick="CargarConsultasDeHoyXDoctor()">Consultas De Hoy</a></li>
                        <li><a href="#" onclick="NuevoPaciente()">Nuevo paciente</a></li>
                        <li><a href="#" onclick="VerCitas()">Citas hoy</a></li>
                        <li><a href="#" onclick="AgendarCitas()">Agendar Citas</a></li>
                        <li><a href="#" onclick="BuscarHistoriaPaciente()">Buscar historias</a></li>
                    </ul>                -->
                </div>
        </div>
   </div>
    <!--fin fila2-->    
    
  <!--inicio fila 3-->
    <div class="row-fluid">
    	<div class="span12">
            <div id="MainRespuestaCirugia">
            </div>
            <div id="respuesta"></div>
            <!--<div id="arealerta" style="color:red;"></div>-->
                       
            <div id="HistorialPaciente">
            </div>

	           <div id="RespuestaFamacos">
    	       </div>
               <div id="RespConsulta">
               </div>
 
            <div id="RespuestaFamacos">
            </div>
           <div id="Modal3"></div>
           <div id="Modal7"></div>
            <div id='areaExamenes'><div id='areaPdf'></div></div>
           
			<div id="Modal7"></div>
            <div id="Caja"></div>
           <div id="caja32"></div>
           <div id="areaExamenes2"><div id="areaPdf2"></div> </div>
            
            <div id="RecetarFarmacos">
            </div>
            
            
            <div id="CodigoConsulta"></div>
            <div id="FormulatioDeCantFarmacos" title="Cantidad de medicamentos"></div>
            <div id="ImprimirRecetaParaPaciente" title="Receta"></div>
            
            
            <div id="HistoriaClinica" title="Buscar Histora">
                <div id="FrmBuscar">
                </div>
                <div id="RespuesraHistoria">
                </div>
                
                <div id="NewPaciente" title="Nuevo Paciente DATOS DE FILIACI0N"><div id="RespuestaNewPaciente"></div></div>
                <div id="FormularioDeImpresionTurno"></div>
            </div>
            <div id="AreaAnanmesis"></div>
            <div id="VerReceta"></div>
            <div id="Modal2"></div>
            <div id="AreaAnamnesis"></div>
            
            <div id="NewCitas"><!--ver citas doctor y gaenda nuevas-->
            </div>
            
            <div id="DiagnosticoFenix">
            	<div id="HeaderDiagFenix"></div>
            	<div id="Diagnostico133"></div>
            	<div id="bodyDiaFenix"></div>
            </div>
            <!--<div id="lugarCir">
            </div>-->
            
            <div id="DataFiliaCionPaciente"></div><!--VENTA MODAL PARA LOS DATOS DE FILIACION-->
            
            <div id="estadopago"> <!--AREA PARA EL ESTADO DE PAGO-->
                <div id="formpago"></div></div>
                <div id="alert"></div>
                <div id="alerta22"></div>

                
            <!--div para la modal de busqueda-->    
            <div id="SearchPaciente">
                <div id="Buscador"></div>
                <div id="CodHorario"></div>
                <div id="RespuestaPaciente"></div>
                <div id="RespuestaAsignacion"></div>
                <div id="RespuestaFecha"></div>
                <div id="CampoTextocodigo"></div>
                <div id="RespuetaResTurnoDoctor"></div>
            </div>
            <div id="CajaCodPac"></div>
    
   			<!--div para certificado otos-->
            	<div id="AreaCertificados" title=""><div id="ContenidoCertificados"></div></div>
                <div id="AreaImpOtros"></div>
            <!--fin div para certificado otos-->
            <!--inicio del area para el nombre del paciente-->
             <div id="AreNombrePaciente"></div>    	
            <!--fin del area para el nombre del paciente-->
            <!--div para examenes fisicos-->
            <div id="ExamesFisicos2"></div>
            <!--fin div para examenes fisicos-->
            <!--div para vademecum-->
            <div id="AreaVademecun"></div>
            <!--fin div para vedemecun-->
            <!--div para examenes -->
            <div id="Exames3"></div>
            <!--fin div para examenes -->  
            <!--div para tratamiento -->
            <div id="Diagnostico321"></div>
            <!--fin div para tratamiento --> 
            <!--div para diagnostico -->
            
            <!--fin div para diagnostico -->   
            <!--div para certificado salud -->
            <div id="AreaCertificadoSalud"></div>
            <div id="AraImpCertificadoSalud"></div>
            <!--fin div para certificado salud-->  
            <!--div para certificado salud -->
            <div id="AreaParaRevisionSistema2"></div>
            <!--fin div para certificado salud-->
            <!--div para certificado salud y vacunacion -->
            <div id="AreaParaCertificadoSaludVacunacion"></div>
            <div id="ImpAreaParaCertificadoSaludVacunacion"></div>
            <!--fin div para certificado salud y vacunacion-->
            <!--div para certificado asistencia -->
            <div id="AreaParaCertificadoAsistencia"></div>
             <div id="ImpAreaParaCertificadoAsistencia"></div>
            <!--fin div para certificado asistencia-->
            <!--div para certificado cirugia -->
            <div id="AreaParaCertificadoCirugia"></div>
             <div id="ImpAreaParaCertificadoCirugia"></div>
            <!--fin div para certificado cirugia-->
             <!--div para certificado consentimiento informado -->
            <div id="AreaParaCertificadoConsentimientoInfo"></div>
             <div id="ImpAreaParaCertificadoConsentimientoInfo"></div>
            <!--fin div para certificado consentimiento informado-->   
             <!--div para certificado enfermedad y repos -->
            <div id="AreaParaCertificadoEneferemedadYSalud"></div>
             <div id="ImpAreaParaCertificadoEneferemedadYSalud"></div>
            <!--fin div para certificado enfermedad y reposo-->
            <!--div para certificado de cuidado -->
            <div id="AreaParaCertificadoCuidado"></div>
             <div id="ImpAreaParaCertificadoCuidado"></div>
            <!--fin div para certificado de cuidado--> 
            <!--div para capturarar el cie 10-->   
            <div id="AreCie10"></div>
            <!--fin div para capturar el cie 10-->
            <!--div para caragar la historia clinica-->   
            <div id="HistoriPacientes"></div>
            <!--fin div para cargar la historia clinca-->
            
        </div>
    </div>
  <!--fin fila 3-->        
  
<!--div para ver la agenda del doctor-->        
            <div id="AgendaDoctor">
                <div id="FrmSearchAgenda"></div>
                <div id="ResSearchAgenda"></div>
            </div>
   
        
  <!--inico fila 4-->
	<div class="row-fluid">
    	<div class="span12">
					
        </div>
    </div>
  <!--fin fila 4-->                 
    
    
    </div>


</div>
	<div class="row-fluid">
    	<div class="span12">
        	<div class="badge badge-inverse navbar-fixed-bottom"><center><span class="icon-info-sign"></span>COPYRIGHT: <a href="http://www.oyzecuador.com/">OYZ ECUADOR</a></center></div>
        </div>
    </div>    



</div>
</body>
</html>
