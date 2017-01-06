<?php
include "coneccion.php";
include "Usuario.php";
include "funcion.php";
$log= $_POST['txtUser'];
$cla= $_POST['txtPass'];
//$tip= $_POST['cmbtipo'];
$usua=new Usuario;
session_start();

//if($usua->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE login_usu='$log' AND pass_usu='$cla' AND id_rol='$tip' AND estado_usu='A'")==1)
if($usua->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE login_usu='$log' AND pass_usu='$cla'  AND estado_usu='A'")==1)
{
	
	
	$usurol = $usua->Consultar("SELECT id_rol FROM tbl_usuario WHERE login_usu='$log' AND pass_usu='$cla' AND estado_usu='A'");
	$idusu = $usua->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$log' AND pass_usu='$cla' AND estado_usu='A'");
	
	$sql=LOGCasat($idusu,date("y-m-d"),'',"SELECT COUNT(*) FROM tbl_usuario WHERE");
	$usua->Ejecutar($sql);

	//medicos
	if($usurol=="1")
	{
		$_SESSION['DOCTOR']=$log;
		$_SESSION['IDUser']=$idusu;
		header("Location:../Presentacion/PrDoctor.php");
	}
	//medicos fin 


	//administradores del sistema con permisos
	if ($usurol=="3") {
		
		$ingr = $usua->Consultar("SELECT id_esp FROM tbl_usuario WHERE login_usu='$log' AND pass_usu='$cla' AND estado_usu='A'");
		if($ingr==17){
			$_SESSION['DOCTOR']=$log;
			$_SESSION['IDUser']=$idusu;
			header("Location:../Presentacion/PrOk.php");
		}
		if ($ingr==18) {
			$_SESSION['DOCTOR']=$log;
			$_SESSION['IDUser']=$idusu;
			header("Location:../Presentacion/PrOk1.php");
		}

	}
	//fin administrador sitema


	//rol de enfermera
	if($usurol=="2")
	{
		$_SESSION['ENFERMERA']=$log;
		//header("Location:../Presentacion/PrEnfermera.php");
	}
	//fin rol de enfermera
	

	//QUIROFANO
	if($usurol=="4")
	{
		$_SESSION['QUIROFANO']=$log;
		//header("Location:../Presentacion/PrQuirofano.php");
	} 
	//QUIROFANO FIN

	//SECRETARIA
	if($usurol=="5")
	{
		$_SESSION['ENFERMERA']=$log;
		$_SESSION['IDUser']=$idusu;
		header("Location:../Presentacion/PrEnfermera.php");
	} 
	//SECRETARIA FIN

	//OPERADOR
	if($usurol=="6")
	{
		$_SESSION['OPERADOR']=$log;
		//header("Location:../Presentacion/PrOperador.php");
	} 
	//OPERADOR FIN

	//PRESTADOR EXTERNO
	if($usurol=="7")
	{
		$_SESSION["PRESTADOR EXTERNO"]=$log;
		//header("Location:../Presentacion/PrPrestadorExterno.php");
	}
	//PRESTADOR EXTERNO FIN 

	//rol UPLOAD FILE
	if($usurol=="8")
	{
		$_SESSION['DOCTOR']=$log;
		$_SESSION['IDUser']=$idusu;
		header("Location:../Presentacion/PrMUpPdf.php");
	}
	//rol UPLOAD FILE FIN 
	
}
else
{
	header("Location:../index.php?UserDesc=Usuario desconocido");
}


?>