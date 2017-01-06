<?php
 
 function LOGCasat($user,$fecha,$hora,$accion){
 	$ip=$_SERVER['REMOTE_ADDR'];
 	$navegador=$_SERVER['HTTP_USER_AGENT'];
 	$sql="INSERT INTO log (usuario,fecha,hora,ip,navegador,accion) VALUES('$user','$fecha','$hora','$ip','$navegador','$accion');";
 	return $sql;
 }
?>