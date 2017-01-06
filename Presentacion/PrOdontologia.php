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
    <script type="text/javascript" src="js/MyJqueryOdontologia.js"></script>
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
                                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menú Doctor</a>
                                    	<ul class="dropdown-menu">
                                        	<li><a href="#" onclick="CargarConsultasDeHoyXDoctor()"><span class="icon-refresh"></span>&nbsp;Consultas de hoy</a></li>
                                            <li><a href="#" onclick="NuevoPaciente()"><span class="icon-user"></span>&nbsp;Nuevo Paciente</a></li>
                                            <li><a href="#" onclick="VerCitas()"><span class="icon-tags"></span>&nbsp;Citas Hoy</a></li>
                                            <li><a href="#" onclick="AgendarCitas()"><span class="icon-list-alt"></span>&nbsp;Agendar Citas</a></li>
                                            <li><a href="#" onclick="BuscarHistoriaPaciente()"><span class="icon-search"></span>&nbsp;Buscar Historias</a></li>
                                          	<li><a href="#" onclick='CertificadoOtros()'><span class="icon-file"></span>&nbsp;Certificado otros</a></li>
                                            <li><a href="#" onclick='AgendaDoctor()'><span class="icon-file"></span>&nbsp;Agenda</a></li>
                                        </ul>
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
        	<div id="MyAreaFenixCodTurno"></div>
            <div id="MainRespuestaDoctor">
            </div>
            <div id="arealerta" style="color:red;"></div>
           
                       
            <div id="HistorialPaciente">
            </div>
            
            
           

				<!--cargar de datos-->

				<div id="LoadaDataNow">
                </div>
                <!--fin cargar datos-->
                
	           <div id="RespuestaFamacos">
    	       </div>
               <div id="RespConsulta">
               </div>
 
            <div id="RespuestaFamacos">
            </div>
           <div id="Modal3"></div>
           <div id="Modal7"></div>
            <div id='areaExamenes'><div id='areaPdf'></div></div>
            <div id="areaEstoma"></div> <div id="areaPdf73"></div>
           
			<div id="Modal7"></div>
            

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
                
                <div id="NewPaciente" title="Nuevo Paciente DATOS DE FILIACIÓN"><div id="RespuestaNewPaciente"></div></div>
                <div id="FormularioDeImpresionTurno"></div>
            </div>
            
            <div id="AreaAnanmesis"></div>
            <div id="VerReceta"></div>
            <div id="Modal2"></div>
            <div id="AreaAnamnesis"></div>
             <div id="IndicadoresSaludBucal"></div><!--VENTA MODAL PARA LOS DATOS DE HIGIENE ORAL-->
            <div id="AreaIndicesCpo"></div><!--VENTA MODAL PARA LOS INDICES CPO - ceo-->
            <div id="AreadeDiagnTerapeutico"></div><!--VENTA MODAL PARA PLANES DE DIAGNOSTICO,TERAPEUTICO Y EDUCACIONAL-->
            <div id="AreadeSistEstomatognatico"></div><!--VENTA MODAL PARA EXAMEN DE SISTEMA ESTOMATOGNATICO-->
            <div id="SignosVitales"></div><!--VENTA MODAL PARA LOS DATOS DE SIGNOS VITALES-->
            
            <div id="NewCitas"><!--ver citas doctor y gaenda nuevas-->
            </div>
            
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
            <div id="Diagnostico133"></div>
            <!--fin div para diagnostico -->   

            <!--div para diagnostico -->
            <div id="DiagnosticoFenix"><div id="HeaderDiagFenix"></div><div id="bodyDiaFenix"></div></div>
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
            
            <!--div para ver la agenda del doctor-->        
            <div id="AgendaDoctor">
            	<div id="FrmSearchAgenda"></div>
                <div id="ResSearchAgenda"></div>
            </div>
            <!--fin div para ver la agenda del doctor-->                    
            
            <!--div para ver la agenda del doctor-->        
            <div id="AreReceta2">
            </div>
            <!--fin div para ver la agenda del doctor-->             
            
        </div>
    </div>
  <!--fin fila 3-->        


            <div id="Caja"></div>
           <div id="caja32"></div>
           
           <div id="ConsenInfoPaciente"></div>
           <div id="ConsenInfoRepresentante"></div>
           <div id="ReporteConsenInfoRep"></div>
           <div id="IngPlanTratamientoPago"></div>
           <div id="HistoPlanTratamientoPagos"></div>

			 <div id="ad_18">
             	<input type='text' id='txt_da_18'/><input type='text' id='txt_dd_18'/>
                <input type='text' id='txt_dab_18'/><input type='text' id='txt_di_18'/>
                <input type='text' id='txt_dc_18'/><input type='text' id='sim_18'/>
                
             	<input type='text' id='txt_da_17'/><input type='text' id='txt_dd_17'/>
                <input type='text' id='txt_dab_17'/><input type='text' id='txt_di_17'/>
                <input type='text' id='txt_dc_17'/><input type='text' id='sim_17'/>
                
             	<input type='text' id='txt_da_16'/><input type='text' id='txt_dd_16'/>
                <input type='text' id='txt_dab_16'/><input type='text' id='txt_di_16'/>
                <input type='text' id='txt_dc_16'/><input type='text' id='sim_16'/>
                
             	<input type='text' id='txt_da_15'/><input type='text' id='txt_dd_15'/>
                <input type='text' id='txt_dab_15'/><input type='text' id='txt_di_15'/>
                <input type='text' id='txt_dc_15'/><input type='text' id='sim_15'/>
                
             	<input type='text' id='txt_da_14'/><input type='text' id='txt_dd_14'/>
                <input type='text' id='txt_dab_14'/><input type='text' id='txt_di_14'/>
                <input type='text' id='txt_dc_14'/><input type='text' id='sim_14'/><br />

             	<input type='text' id='txt_da_13'/><input type='text' id='txt_dd_13'/>
                <input type='text' id='txt_dab_13'/><input type='text' id='txt_di_13'/>
                <input type='text' id='txt_dc_13'/><input type='text' id='sim_13'/>
                
                
             	<input type='text' id='txt_da_12'/><input type='text' id='txt_dd_12'/>
                <input type='text' id='txt_dab_12'/><input type='text' id='txt_di_12'/>
                <input type='text' id='txt_dc_12'/><input type='text' id='sim_12'/>
                

             	<input type='text' id='txt_da_11'/><input type='text' id='txt_dd_11'/>
                <input type='text' id='txt_dab_11'/><input type='text' id='txt_di_11'/>
                <input type='text' id='txt_dc_11'/><input type='text' id='sim_11'/>
                
             	<input type='text' id='txt_da_21'/><input type='text' id='txt_dd_21'/>
                <input type='text' id='txt_dab_21'/><input type='text' id='txt_di_21'/>
                <input type='text' id='txt_dc_21'/><input type='text' id='sim_21'/>
                
             	<input type='text' id='txt_da_22'/><input type='text' id='txt_dd_22'/>
                <input type='text' id='txt_dab_22'/><input type='text' id='txt_di_22'/>
                <input type='text' id='txt_dc_22'/><input type='text' id='sim_22'/>

             	<input type='text' id='txt_da_23'/><input type='text' id='txt_dd_23'/>
                <input type='text' id='txt_dab_23'/><input type='text' id='txt_di_23'/>
                <input type='text' id='txt_dc_23'/><input type='text' id='sim_23'/>

             	<input type='text' id='txt_da_24'/><input type='text' id='txt_dd_24'/>
                <input type='text' id='txt_dab_24'/><input type='text' id='txt_di_24'/>
                <input type='text' id='txt_dc_24'/><input type='text' id='sim_24'/>
                
             	<input type='text' id='txt_da_25'/><input type='text' id='txt_dd_25'/>
                <input type='text' id='txt_dab_25'/><input type='text' id='txt_di_25'/>
                <input type='text' id='txt_dc_25'/><input type='text' id='sim_25'/>
                
                
             	<input type='text' id='txt_da_26'/><input type='text' id='txt_dd_26'/>
                <input type='text' id='txt_dab_26'/><input type='text' id='txt_di_26'/>
                <input type='text' id='txt_dc_26'/><input type='text' id='sim_26'/>
                

             	<input type='text' id='txt_da_27'/><input type='text' id='txt_dd_27'/>
                <input type='text' id='txt_dab_27'/><input type='text' id='txt_di_27'/>
                <input type='text' id='txt_dc_27'/><input type='text' id='sim_27'/>
                
             	<input type='text' id='txt_da_28'/><input type='text' id='txt_dd_28'/>
                <input type='text' id='txt_dab_28'/><input type='text' id='txt_di_28'/>
                <input type='text' id='txt_dc_28'/><input type='text' id='sim_28'/>
                
             	<input type='text' id='txt_da_55'/><input type='text' id='txt_dd_55'/>
                <input type='text' id='txt_dab_55'/><input type='text' id='txt_di_55'/>
                <input type='text' id='txt_dc_55'/><input type='text' id='sim_55'/>
                
             	<input type='text' id='txt_da_54'/><input type='text' id='txt_dd_54'/>
                <input type='text' id='txt_dab_54'/><input type='text' id='txt_di_54'/>
                <input type='text' id='txt_dc_54'/><input type='text' id='sim_54'/>
                

             	<input type='text' id='txt_da_53'/><input type='text' id='txt_dd_53'/>
                <input type='text' id='txt_dab_53'/><input type='text' id='txt_di_53'/>
                <input type='text' id='txt_dc_53'/><input type='text' id='sim_53'/>                                                                                                                   
             	<input type='text' id='txt_da_52'/><input type='text' id='txt_dd_52'/>
                <input type='text' id='txt_dab_52'/><input type='text' id='txt_di_52'/>
                <input type='text' id='txt_dc_52'/><input type='text' id='sim_52'/>

             	<input type='text' id='txt_da_51'/><input type='text' id='txt_dd_51'/>
                <input type='text' id='txt_dab_51'/><input type='text' id='txt_di_51'/>
                <input type='text' id='txt_dc_51'/><input type='text' id='sim_51'/>
                
             	<input type='text' id='txt_da_61'/><input type='text' id='txt_dd_61'/>
                <input type='text' id='txt_dab_61'/><input type='text' id='txt_di_61'/>
                <input type='text' id='txt_dc_61'/><input type='text' id='sim_61'/>
                
             	<input type='text' id='txt_da_62'/><input type='text' id='txt_dd_62'/>
                <input type='text' id='txt_dab_62'/><input type='text' id='txt_di_62'/>
                <input type='text' id='txt_dc_62'/><input type='text' id='sim_62'/>
                
             	<input type='text' id='txt_da_63'/><input type='text' id='txt_dd_63'/>
                <input type='text' id='txt_dab_63'/><input type='text' id='txt_di_63'/>
                <input type='text' id='txt_dc_63'/><input type='text' id='sim_63'/>
                
             	<input type='text' id='txt_da_64'/><input type='text' id='txt_dd_64'/>
                <input type='text' id='txt_dab_64'/><input type='text' id='txt_di_64'/>
                <input type='text' id='txt_dc_64'/><input type='text' id='sim_64'/>
                

             	<input type='text' id='txt_da_65'/><input type='text' id='txt_dd_65'/>
                <input type='text' id='txt_dab_65'/><input type='text' id='txt_di_65'/>
                <input type='text' id='txt_dc_65'/><input type='text' id='sim_65'/>
                
                
              <input type='text' id='txt_da_85'/><input type='text' id='txt_dd_85'/>
                <input type='text' id='txt_dab_85'/><input type='text' id='txt_di_85'/>
                <input type='text' id='txt_dc_85'/><input type='text' id='sim_85'/>
                

              <input type='text' id='txt_da_84'/><input type='text' id='txt_dd_84'/>
                <input type='text' id='txt_dab_84'/><input type='text' id='txt_di_84'/>
                <input type='text' id='txt_dc_84'/><input type='text' id='sim_84'/>
                
              <input type='text' id='txt_da_83'/><input type='text' id='txt_dd_83'/>
                <input type='text' id='txt_dab_83'/><input type='text' id='txt_di_83'/>
                <input type='text' id='txt_dc_83'/><input type='text' id='sim_83'/>                                                                                                                   

                <input type='text' id='txt_da_82'/><input type='text' id='txt_dd_82'/>
                <input type='text' id='txt_dab_82'/><input type='text' id='txt_di_82'/>
                <input type='text' id='txt_dc_82'/><input type='text' id='sim_82'/>                                                                                                                   
                
                <input type='text' id='txt_da_81'/><input type='text' id='txt_dd_81'/>
                <input type='text' id='txt_dab_81'/><input type='text' id='txt_di_81'/>
                <input type='text' id='txt_dc_81'/><input type='text' id='sim_81'/>
                
               	<input type='text' id='txt_da_71'/><input type='text' id='txt_dd_71'/>
                <input type='text' id='txt_dab_71'/><input type='text' id='txt_di_71'/>
                <input type='text' id='txt_dc_71'/><input type='text' id='sim_71'/>
                

               	<input type='text' id='txt_da_72'/><input type='text' id='txt_dd_72'/>
                <input type='text' id='txt_dab_72'/><input type='text' id='txt_di_72'/>
                <input type='text' id='txt_dc_72'/><input type='text' id='sim_72'/>
                
               	<input type='text' id='txt_da_73'/><input type='text' id='txt_dd_73'/>
                <input type='text' id='txt_dab_73'/><input type='text' id='txt_di_73'/>
                <input type='text' id='txt_dc_73'/><input type='text' id='sim_73'/>
                
               	<input type='text' id='txt_da_74'/><input type='text' id='txt_dd_74'/>
                <input type='text' id='txt_dab_74'/><input type='text' id='txt_di_74'/>
                <input type='text' id='txt_dc_74'/><input type='text' id='sim_74'/>
                

               	<input type='text' id='txt_da_75'/><input type='text' id='txt_dd_75'/>
                <input type='text' id='txt_dab_75'/><input type='text' id='txt_di_75'/>
                <input type='text' id='txt_dc_75'/><input type='text' id='sim_75'/>   

                <input type='text' id='txt_da_48'/><input type='text' id='txt_dd_48'/>
                <input type='text' id='txt_dab_48'/><input type='text' id='txt_di_48'/>
                <input type='text' id='txt_dc_48'/><input type='text' id='sim_48'/>   

                <input type='text' id='txt_da_47'/><input type='text' id='txt_dd_47'/>
                <input type='text' id='txt_dab_47'/><input type='text' id='txt_di_47'/>
                <input type='text' id='txt_dc_47'/><input type='text' id='sim_47'/>   
                

                <input type='text' id='txt_da_46'/><input type='text' id='txt_dd_46'/>
                <input type='text' id='txt_dab_46'/><input type='text' id='txt_di_46'/>
                <input type='text' id='txt_dc_46'/><input type='text' id='sim_46'/>   
                

                <input type='text' id='txt_da_45'/><input type='text' id='txt_dd_45'/>
                <input type='text' id='txt_dab_45'/><input type='text' id='txt_di_45'/>
                <input type='text' id='txt_dc_45'/><input type='text' id='sim_45'/>   
                
                <input type='text' id='txt_da_44'/><input type='text' id='txt_dd_44'/>
                <input type='text' id='txt_dab_44'/><input type='text' id='txt_di_44'/>
                <input type='text' id='txt_dc_44'/><input type='text' id='sim_44'/>   
                

                <input type='text' id='txt_da_43'/><input type='text' id='txt_dd_43'/>
                <input type='text' id='txt_dab_43'/><input type='text' id='txt_di_43'/>
                <input type='text' id='txt_dc_43'/><input type='text' id='sim_43'/>   
                

                <input type='text' id='txt_da_42'/><input type='text' id='txt_dd_42'/>
                <input type='text' id='txt_dab_42'/><input type='text' id='txt_di_42'/>
                <input type='text' id='txt_dc_42'/><input type='text' id='sim_42'/>   
               
                <input type='text' id='txt_da_41'/><input type='text' id='txt_dd_41'/>
                <input type='text' id='txt_dab_41'/><input type='text' id='txt_di_41'/>
                <input type='text' id='txt_dc_41'/><input type='text' id='sim_41'/>   
                



                <input type='text' id='txt_da_31'/><input type='text' id='txt_dd_31'/>
                <input type='text' id='txt_dab_31'/><input type='text' id='txt_di_31'/>
                <input type='text' id='txt_dc_31'/><input type='text' id='sim_31'/>


                <input type='text' id='txt_da_32'/><input type='text' id='txt_dd_32'/>
                <input type='text' id='txt_dab_32'/><input type='text' id='txt_di_32'/>
                <input type='text' id='txt_dc_32'/><input type='text' id='sim_32'/>

                <input type='text' id='txt_da_33'/><input type='text' id='txt_dd_33'/>
                <input type='text' id='txt_dab_33'/><input type='text' id='txt_di_33'/>
                <input type='text' id='txt_dc_33'/><input type='text' id='sim_33'/>


                <input type='text' id='txt_da_34'/><input type='text' id='txt_dd_34'/>
                <input type='text' id='txt_dab_34'/><input type='text' id='txt_di_34'/>
                <input type='text' id='txt_dc_34'/><input type='text' id='sim_34'/>


                <input type='text' id='txt_da_35'/><input type='text' id='txt_dd_35'/>
                <input type='text' id='txt_dab_35'/><input type='text' id='txt_di_35'/>
                <input type='text' id='txt_dc_35'/><input type='text' id='sim_35'/>


                <input type='text' id='txt_da_36'/><input type='text' id='txt_dd_36'/>
                <input type='text' id='txt_dab_36'/><input type='text' id='txt_di_36'/>
                <input type='text' id='txt_dc_36'/><input type='text' id='sim_36'/>


                <input type='text' id='txt_da_37'/><input type='text' id='txt_dd_37'/>
                <input type='text' id='txt_dab_37'/><input type='text' id='txt_di_37'/>
                <input type='text' id='txt_dc_37'/><input type='text' id='sim_37'/>


                <input type='text' id='txt_da_38'/><input type='text' id='txt_dd_38'/>
                <input type='text' id='txt_dab_38'/><input type='text' id='txt_di_38'/>
                <input type='text' id='txt_dc_38'/><input type='text' id='sim_38'/>





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
        	<div class="badge badge-inverse navbar-fixed-bottom"><center><span class="icon-info-sign"></span>COPYRIGHT: <a href="http://www.oyzecuador.com/"  target="_blank">OYZ ECUADOR</a></center></div>
        </div>
    </div>    



</div>





    <div id="OdontogramaLightV2">
    	<div id="OdontogramaLightV2Dibujo">
        </div>
        <div id="AreaListTrataMiento">
        </div>
    </div>


  </div>

</div>  



</body>
</html>
