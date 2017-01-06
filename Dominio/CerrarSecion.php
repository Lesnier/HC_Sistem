<?php

	session_start();
if(isset($_SESSION['DOCTOR']))
{
	session_destroy();
	$_SESSION['DOCTOR']=NULL;
		header("Location:../index.php");
}
if(isset($_SESSION['ENFERMERA']))
{
		session_destroy();
	$_SESSION['ENFERMERA']=NULL;
		header("Location:../index.php");
}

if(isset($_SESSION['ADM']))
{
		session_destroy();
	$_SESSION['ADM']=NULL;
		header("Location:../index.php");
}
header("Location:../index.php");
?>