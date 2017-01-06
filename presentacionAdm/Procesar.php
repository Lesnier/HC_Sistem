<?php
include "../Dominio/Logica0.php";
if(isset($_GET['accion']))
{
	$accion=$_GET['accion'];
	$aux=new Logica;
	if($accion=="LoadUsuarios")
	{
		echo $aux->LoadUsuarios();
	}
	if($accion=="NewUser")
	{
		echo $aux->CargarNuevoUsuario();
	}
	if($accion=="SaveNewUser")
	{
		$Cedula=$_GET['Cedula'];
		$apellido=$_GET['apellido'];
		$nombres=$_GET['nombres'];
		$edad=$_GET['edad'];
		$direccion=$_GET['direccion'];
		$Login=$_GET['Login'];
		$pass=$_GET['pass'];
		$rol=$_GET['rol'];
		$especialida=$_GET['especialida'];
		echo $aux->SaveUser($Cedula,$nombres,$apellido,$edad,$direccion,$Login,$pass,$rol,$especialida);
	}
	if($accion=="LoadaMddificarUsuario")
	{
		$CodiMod=$_GET['CodiMod'];
		echo $aux->LoadDatosParaModUser($CodiMod);
	}
	if($accion=="ModificarUser")
	{
		$CodigoMod=$_GET['CodigoMod'];
		$ApellidoUser=$_GET['ApellidoUser'];
		$NombresUser=$_GET['NombresUser'];
		$edadUser=$_GET['edadUser'];
		$loginUser=$_GET['loginUser'];
		$passUser=$_GET['passUser'];
		$direccionUsu=$_GET['direccionUsu'];
		echo $aux->ModifyUsuario($CodigoMod,$ApellidoUser,$NombresUser,$edadUser,$loginUser,$passUser,$direccionUsu);
	}
	if($accion=="ConfirmarDeleteUser")
	{
		$IDUser=$_GET['IDUser'];
		echo $aux->DeleteUser($IDUser);
	}
	if($accion=="CargarRoles")
	{
		echo $aux->LoadRoles();
	}
	if($accion=="LoadaModificarRol")
	{
		$CodiModRol=$_GET['CodiModRol'];
		echo $aux->LoadRol($CodiModRol);
	}
	if($accion=="ModificarRl")
	{
		$CodiModRol1=$_GET['CodiModRol1'];
		$descRol=$_GET['descRol'];
		echo $aux->ModifyRol($CodiModRol1,$descRol);
	}
	if($accion=="CargarEspecialidades")
	{
		echo $aux->LoadEspecialidad();
	}
	if($accion=="newespecialidad")
	{
		$descripcionesp=$_GET['descripcionesp'];
		$estaesp=$_GET['estaesp'];
		echo $aux->saveEspecialidad($descripcionesp,$estaesp);
	}
	if($accion=="LoadaModEspe")
	{
		$codgioEsp=$_GET['codgioEsp'];
		echo $aux->CargarEspecialidad($codgioEsp);
	}
	if($accion=="ModEspe")
	{
		$codgioEspeci=$_GET['codgioEspeci'];
		$descripcionespesci=$_GET['descripcionespesci'];
		echo $aux->ModifyEspecialidad($codgioEspeci,$descripcionespesci);
	}
	if($accion=="ConfirmarDeleteEspe")
	{
		$IDEspe=$_GET['IDEspe'];
		echo $aux->DeleteEspecialidad($IDEspe);
	}
	if($accion=="LoadPacientes")
	{
		echo $aux->LoadPacientes();
	}
	if($accion=="LoadModPaciente")
	{
		$CodigoPac=$_GET['CodigoPac'];
		echo $aux->CargarPaciente($CodigoPac);
	}
	if($accion=="ModificarPaciente")
	{
		$CoPaciente=$_GET['CoPaciente'];
		$apellidoPac=$_GET['apellidoPac'];
		$nombrePac=$_GET['nombrePac'];
		$EdadPac=$_GET['EdadPac'];
		$direccionPac=$_GET['direccionPac'];
		echo $aux->ModifyPaciente($CoPaciente,$apellidoPac,$nombrePac,$EdadPac,$direccionPac);
	}
	if($accion=="ConfirmarDeletePaciente")
	{
		$IDPaciente=$_GET['IDPaciente'];
		echo $aux->deletePaciente($IDPaciente);
	}
	if($accion=="LoadaFarmacos")
	{
		echo $aux->LoadMedicamentos();
	}
	if($accion=="NewFarmaco")
	{
		$descripFarmaco=$_GET['descripFarmaco'];
		$fechaCad=$_GET['fechaCad'];
		$cantidaFar=$_GET['cantidaFar'];
		echo $aux->NuevoFarmaco($descripFarmaco,$fechaCad,$cantidaFar);
	}
	if($accion=="ModificarFarmacos")
	{
		$CodigoFarmaco=$_GET['CodigoFarmaco'];
		echo $aux->VerFarmaco($CodigoFarmaco);
	}
	if($accion=="ConfirmarModificarFarmacos")
	{
		$CodigoFarmaco3=$_GET['CodigoFarmaco3'];
		$desFarm=$_GET['desFarm'];
		$cantFarm=$_GET['cantFarm'];
		echo $aux->Modifyfarmaco($CodigoFarmaco3,$desFarm,$cantFarm);
	}
	if($accion=="ConfirmarDeleteFarmaco")
	{
		$IDFarmaco=$_GET['IDFarmaco'];
		echo $aux->Deletefarmaco($IDFarmaco);
	}
	
	if($accion=="Anamnesis1")
	{
		$MotivoConsu=$_GET['MotivoConsu'];
		$EnfActual=$_GET['EnfActual'];
		$TipSangre=$_GET['TipSangre'];
		$PatoNoPersonales=$_GET['PatoNoPersonales'];
		$Alergias=$_GET['Alergias'];
		$Cardiovascu=$_GET['Cardiovascu'];
		$Metabolico=$_GET['Metabolico'];
		$Infecciosos=$_GET['Infecciosos'];
		$Neoplasia=$_GET['Neoplasia'];
		$Endocrono=$_GET['Endocrono'];
		$Pulmonares=$_GET['Pulmonares'];
		$Nefrologicas=$_GET['Nefrologicas'];
		$Hematologica=$_GET['Hematologica'];
		$Esqueleticos=$_GET['Esqueleticos'];
		$Inmuno=$_GET['Inmuno'];
		$Ginecoobstetr=$_GET['Ginecoobstetr'];
		$Otros2=$_GET['Otros2'];
		$Cardiovasfam=$_GET['Cardiovasfam'];
		$Metabolifam=$_GET['Metabolifam'];
		$Infecciososfam=$_GET['Infecciososfam'];
		$Neoplasfam=$_GET['Neoplasfam'];
		$Endocronofam=$_GET['Endocronofam'];
		$Pulmonaresfam=$_GET['Pulmonaresfam'];
		$Nefrolofam=$_GET['Nefrolofam'];
		$Hematolofam=$_GET['Hematolofam'];
		$Esqueletifam=$_GET['Esqueletifam'];
		$Inmunolofam=$_GET['Inmunolofam'];
		$Otros3=$_GET['Otros3'];
		
		$Tabaco=$_GET['Tabaco'];
		$Alcohol=$_GET['Alcohol'];
		$Drogas=$_GET['Drogas'];
		$Medicamentos=$_GET['Medicamentos'];
		$Ejercicio=$_GET['Ejercicio'];
		$TipoDieta=$_GET['TipoDieta'];
		$Vacunas=$_GET['Vacunas'];
		
		$Auditivo=$_GET['Auditivo'];
		$Oftalmologico=$_GET['Oftalmologico'];
		$Otorrinolari=$_GET['Otorrinolari'];
		$NerviosCra=$_GET['NerviosCra'];
		$Digestivo=$_GET['Digestivo'];
		$Renal=$_GET['Renal'];
		$Pulmonar=$_GET['Pulmonar'];
		$Cardiovascular=$_GET['Cardiovascular'];
		$Oseo=$_GET['Oseo'];
		$Ginecobs=$_GET['Ginecobs'];
		$Otros=$_GET['Otros'];
		
		
		$CodOculPac=$_GET['CodOculPac'];
		
		echo $aux->IngresarAnamnesis($MotivoConsu,$EnfActual,$TipSangre,$PatoNoPersonales,$Alergias,$Cardiovascu,$Metabolico,$Infecciosos,$Neoplasia,$Endocrono,$Pulmonares,$Nefrologicas,$Hematologica,$Esqueleticos,$Inmuno,$Ginecoobstetr,$Otros2,$Cardiovasfam,$Metabolifam,$Infecciososfam,$Neoplasfam,$Endocronofam,$Pulmonaresfam,$Nefrolofam,$Hematolofam,$Esqueletifam,$Inmunolofam,$Otros3,$Tabaco,$Alcohol,$Drogas,$Medicamentos,$Ejercicio,$TipoDieta,$Vacunas,$Auditivo,$Oftalmologico,$Otorrinolari,$NerviosCra,$Digestivo,$Renal,$Pulmonar,$Cardiovascular,$Oseo,$Ginecobs,$Otros,$CodOculPac);
	}

}
else
{
	header("Location:index.php");
}
?>