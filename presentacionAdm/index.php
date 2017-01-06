<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Medical Theme Css Template</title>
<link rel="stylesheet" type="text/css" href="../Presentacion/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="../Presentacion/css/MyEstilo.css" media="screen" />



	<!--ESTILOS Y SCRIPT BOOBSTRAP-->
    <link rel="stylesheet" href="../Presentacion/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../Presentacion/css/bootstrap-responsive.css" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../Presentacion/css/estilologin.css"/>	
  



</head>

<body>
    

    <div id="container">
    
    <div id="ContainerLog">
		<!--div para cargar el login -->
        <div id="MainLogin">
            <form action="../Dominio/LoginAdm.php" method="post">
                <table>
                  <tr>
                    <td>Usuario: </td>
                    <td><input name="txtUsuerAdm" type="text"  style="width:185px;" /></td>
                  </tr>
                  <tr>
                    <td>Password: </td>
                    <td><input name="txtPassAdm" type="password" style="width:185px;" /></td>
                  </tr>
                  <tr>
                    <td colspan="2"><input name="bntSend" type="submit" value="Ingresar" class="btn" /></td>
                  </tr>
                </table>
		    </form>

        </div>
        <div id="BotonAdministrador" style="margin-top:-49px">
        	<form action="../index.php" >
            	<input type="submit" value="Atras" class="btn" />
            </form>        	
        </div> 

		      		<div id="MensajeErrorDeUser">
        	<?php
				if(isset($_GET['UserDesc']))
				{
					echo  $_GET['UserDesc'];
				}
				
			?>
            
        </div>
         
        <!-fin div--->
        </div>
    </div> 
</body>
</html>
