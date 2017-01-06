<?php
session_start();
if(!isset($_SESSION['ADM']))
{
	header("Location:index.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Copyright: OYZ Ecuador</title>
<link rel="stylesheet" type="text/css" href="../Presentacion/css/style.css" media="screen" />

<!--plugin jquery-->
	<script type="text/javascript" src="../Presentacion/js/jquery-1.7.1.min.js"></script>

    <script type="text/javascript" src="js/Myjquery.js"></script>
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


</head>

<body>
<div class="container">

    
    <!--inicio fila1-->    	    
    <div class="row-fluid">
   	       <div class="span12">
            	<div class="navbar">
                	<div class="navbar-inner">
                    <div class="brand"><div id="logoEmp"><img src="../Presentacion/images/logosimed.fw.png" /></div></div>
                        	<ul class="nav pull-right">
                            	<li><a href="#"><div id="InfoDataDoc"></div></a></li>
                                <li class="dropdown">
                                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Menú Administrador</a>
                                    	<ul class="dropdown-menu">
                                        	<li><a href="#" id="ShowUsuer"><span class="icon-user"></span>Usuarios</a></li>
                                            <li><a href="#" id="ShowRol"><span class="icon-asterisk"></span>Roles</a></li>
                                            <li><a href="#" id="ShowEspe"><span class="icon-asterisk"></span>Especialidad</a></li>
                                            <li><a href="#" id="ShowPac"><span class="icon-asterisk"></span>Pacientes</a></li>
                                            <li><a href="#" id="ShowBode"><span class="icon-asterisk"></span>Vademecun</a></li>
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
    
    
    
    
    
  
    
    
 
<!--fila 2 inicio-->    
 	<div class="row-fluid">
    <div class="span12" style="height:800px;">
    
    <div id="MainUsuario">
		
        
    </div>
	<div id="ShowNewUser2" title="Nuevo usuario">
   	</div>   
    <div id="AreParaModificarElUsaurio" title="Modificar Usuario">
    </div> 
    <div id="EliminarUsuario" title="Borrar Usaurio">
    </div>

	        
    
    
    
    <div id="MainRoles">
    </div>
    <div id="AreDeModificarRol" title="Modificar Rol">
    </div>
    <div id="ShowDeleteRl" title="Eliminar Rol">
    </div>
    
    
    
    <div id="MainEspecialidad">

    </div>
    <div id="NuevaEspecialidad" title="Nueva Especialidad">
    </div>
    <div id="ModificarEspecialidad" title="Modificar Especialidad">
    </div>
    <div id="deleteEspecialidad" title="Eliminar Especialidad">
    </div>    
    
    
    
    
    
    
    <div id="MainPaciente">
    	
    </div>
    <div id="ModificarPaciente" title="Modificar Paciente">
    </div>  
    <div id="DeletePaciente" title="Borrar Paciente">
    </div>        
    
    
    
    <div id="MainBodega">

    </div>
    <div id="NewFarmaco" title="Nuevo Farmaco">
    </div> 
    <div id="ModificarFarmaco" title="Modificar Fármaco">
    </div> 
    <div id="DeleteFarmaco" title="Borrar Farmaco">
    </div>     

   </div>
    </div>


 </div>
<!--fila 2 fin-->

</div>
</body>
</html>
