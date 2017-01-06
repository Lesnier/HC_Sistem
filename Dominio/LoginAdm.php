<?php
include "coneccion.php";
include "Usuario.php";
$txtUsuerAdm=$_POST['txtUsuerAdm'];
$txtPassAdm=$_POST['txtPassAdm'];
$aux=new Usuario;
if($aux->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE login_usu='$txtUsuerAdm' AND pass_usu='$txtPassAdm' AND id_rol='3' AND id_esp='5' AND estado_usu='A'")>0)
{
	session_start();
	$_SESSION['ADM']=$txtUsuerAdm;
		header("Location:../presentacionAdm/PrAdministrador.php");
}
else
{
	header("Location:../presentacionAdm/index.php?UserDesc=Usuario desconocido");
}

?>