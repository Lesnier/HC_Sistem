<?php
include "../Dominio/Logica0.php";
include "../Dominio/LogicaCirugia.php";
include "../Dominio/Logica1.php";
include "../Dominio/Logica2.php";
include "../Dominio/LogicA.php";
if(isset($_GET['accion']))
{
	$accion=$_GET['accion'];
	$aux=new Logica;
	$cir=new LogicaCirugia;
	$aux1=new Logica1;
	$aux2=new Logica2;
        $aux3=new LogicAngular;
	//inicio de la llamada al meotodo de al loogica para cargar ek login
	if($accion=="LoadLogin")
	{
		echo $aux->CargarFormulacioLogi();
	}
	//fin de la llamada al meotodo de al loogica para cargar ek login
	//inicio de la llamada al metodo de la logica para cargar la busqueda de los pacinete
	if($accion=="BuscarPaciente")
	{
		$buscar=$_GET['buscar'];
		$por=$_GET['por'];
		$CodigoRol=$_GET['CodigoRol'];
		echo $aux->BuscarXPeticionPacinete($buscar,$por,$CodigoRol);
	}
	//fin de la llamada al metodo de la logica para cargar la busqueda de los pacinete
	//incio de la llamada al metodo para cancelar la cita y cargar agenda 
	if ($accion=="BuscarPacieAgenda") {
		$buscar=$_GET['buscar'];
		echo $aux1->AgendaEneferme($buscar);
	}
	//incio de la llamada al metodo para cancelar la cita y cargar agenda 
	//inicio de la llamada al metodo  de la logica para cargar la busqueda de los pacinete
	if($accion=="BuscarPacientev2")
	{
		$buscar=$_GET['buscar'];
		$por=$_GET['por'];
		$CodigoRol=$_GET['CodigoRol'];
		echo $aux->BuscarXPeticionPacinetev2($buscar,$CodigoRol);
	}
	//fin de la llamada al metodo de la logica para cargar la busqueda de los pacinete
	//inicio de la llamada al metod de la logica para cargar el formulario de asignar doctor
	if($accion=="CargarEspecialidades")
	{
		echo $aux->CargarEspecialidadesParaAsignar();
	}
	//fin de la llamada al metod de la logica para cargar el formulario de asignar doctor
	//inicio de la llamda al metodo para cargar los doctores segun la especialida selecionada 
	if($accion=="CargarDoctoresXEspe")
	{
		$especialidad=$_GET['especialidad'];
		echo $aux->CargarDoctoresXEspe($especialidad);
	}
	//fin de la llamda al metodo para cargar los doctores segun la especialida selecionada 
	//inicio de la llamada al metodo para cargar los horas diponibles
	if($accion=="CargarHoras")
	{
		$fechaC=$_GET['fechaC'];
		$Doctor=$_GET['Doctor'];
		echo $aux->cargarhorario($fechaC,$Doctor);
	}
	//fin  de la llamada al metodo para cargar los horas diponibles
	//incio de la llamada al metodo para dat el turno
	if($accion=="AsignarTurno")
	{
		$Paciente1=$_GET['Paciente1'];
		$Especialidad1=$_GET['Especialidad1'];
		$Doctor1=$_GET['Doctor1'];
		$fechaC1=$_GET['fechaC1'];
		$hora1=$_GET['hora1'];
		echo $aux->GenerarTurno($Paciente1,$Especialidad1,$Doctor1,$fechaC1,$hora1);
	}
	//fin de la llamada al metodo para dat el turno
	//inicio de la llamada al metodo de la logica para un nuevo paciente
	if($accion=="NewPaciente")
	{
		$CedulaPac=$_GET['CedulaPac'];
		$Passaporte=$_GET['Passaporte'];
		$ApellidoPac=$_GET['ApellidoPac'];
		$NombrePac=$_GET['NombrePac'];
		$Otros=$_GET['Otros'];
		$Edadpac=$_GET['Edadpac'];
		$LugarNac=$_GET['LugarNac'];
		$LugarReside=$_GET['LugarReside'];
		$Sexo=$_GET['Sexo'];
		$Raza=$_GET['Raza'];
		$Religion=$_GET['Religion'];
		$EstadoCivil=$_GET['EstadoCivil'];
		$Intruccion=$_GET['Intruccion'];
		$Profesion=$_GET['Profesion'];
		$Ocupacion=$_GET['Ocupacion'];
		$CondicioPaci=$_GET['CondicioPaci'];
		$Direccion=$_GET['Direccion'];
		$TelefoDomici=$_GET['TelefoDomici'];
		$TelefonoTrabaj=$_GET['TelefonoTrabaj'];
		$Celular=$_GET['Celular'];
		$Correo=$_GET['Correo'];
		$NombRefere=$_GET['NombRefere'];
		$TelefoRefere=$_GET['TelefoRefere'];
		$autori=$_GET['autori'];
		$fechaiaut=$_GET['fechaiaut'];
		$fechafaut=$_GET['fechafaut'];
		$conve2=$_GET['conve2']; 
		$NUmeroHistoria=$_GET['NUmeroHistoria']; 
		echo $aux->NewPaciente($CedulaPac,$Passaporte,$ApellidoPac,$NombrePac,$Otros,$Edadpac,$LugarNac,$LugarReside,$Sexo,$Raza,$Religion,$EstadoCivil,$Intruccion,$Profesion,$Ocupacion,$CondicioPaci,$Direccion,$TelefoDomici,$TelefonoTrabaj,$Celular,$Correo,$NombRefere,$TelefoRefere,$autori,$fechaiaut,$fechafaut,$conve2,$NUmeroHistoria);
	}
	//fin de la llamada al metodo de la logica para un nuevo paciente
	//inicio de la llamada al metodo de la logica para catgar las consultas de hoy
	if($accion=="CargarPacientes")
	{
		echo $aux->ConsultasDeHoyXDoctor();
	}
	//fin  de la llamada al metodo de la logica para catgar las consultas de hoy
	//incio del diagnostico
	if($accion=="Diagnosticar")
	{
		$dignosticopaciente=$_GET['dignosticopaciente'];
		$examensePac=$_GET['examensePac'];
		$tratamientoPac=$_GET['tratamientoPac'];
		$turnoPac=$_GET['turnoPac'];
		$fechaPr=$_GET['fechaPr'];
		echo $aux->SaveDiagnostico($dignosticopaciente,$tratamientoPac,$examensePac,$turnoPac,$fechaPr);
	}
	if ($accion=="BuscarPacieUpdatedatos") {
		$buscar=$_GET['buscar'];
		echo $aux1->CargarDatosUpdatePaciente($buscar,1);
	}
	if($accion=="CargarFarmacos")
	{
		$codigoTu=$_GET['codigoTu'];
		echo $aux->CargarFarmacos($codigoTu);
	}
	if($accion=="RecetaConsulta")
	{
		$CodMedicamento=$_GET['CodMedicamento'];
		$CodConsulta=$_GET['CodConsulta'];
		$indicaciones=$_GET['indicaciones'];
		$cantidad=$_GET['cantidad'];
		echo $aux->AgregarFarmacosALareceta($CodMedicamento,$CodConsulta,$cantidad,$indicaciones);
	}
	if($accion=="HorarioConsutaDoc")
	{
		$FechaPoxima=$_GET['FechaPoxima'];
		$CodigoForma=$_GET['CodigoForma'];
		echo $aux->cargarhorarioXDoctor($FechaPoxima,$CodigoForma);
	}
	if($accion=="AsignarTurnoXDoctor")
	{
		$Paciente12=$_GET['Paciente12'];
		$fechaProx12=$_GET['fechaProx12'];
		$hora12=$_GET['hora12'];
		echo $aux->GenerarTurnoXDoctor($Paciente12,$fechaProx12,$hora12);
	}
	if($accion=="HistorialPaciente")
	{
		$CodigoPac=$_GET['CodigoPac'];
		echo $aux->HistorialPaciente($CodigoPac);
	}
	if($accion=="VerReceta")
	{
		$CodCons=$_GET['CodCons'];
		echo $aux->VerReceta($CodCons);
	}
	if($accion=="VerCie")
	{
		echo $aux->VerCie();
	}
	if($accion=="VerCie3")
	{
		$Descripcion33=$_GET['Descripcion33'];
		echo $aux->VerCie33($Descripcion33);
	}
	if($accion=="AsigCie")
	{
		$Cie=$_GET['Cie'];
		echo $aux->CargarDiagnostico($Cie);
	}

	if($accion=="CargarDatosFiliacion")
	{
		$Filiacion=$_GET['filiacion'];
		echo $aux->CargarPacXCod($Filiacion);
	}
	if($accion=="VerCitasAllHoy")
	{
		echo $aux->VerCitasFormOrder();
	}
	if($accion=="AgendarHoy")
	{
		$HoraHoy=$_GET['HoraHoy'];
		$Paciente=$_GET['Paciente'];
		echo $aux->AsignarCita($HoraHoy,$Paciente);
	}
	if($accion=="AgendarHoyEmergencia")
	{
		$HoraHoy=$_GET['HoraHoy'];
		$Paciente=$_GET['Paciente'];
		echo $aux->AgendarHoyEmeregencia($HoraHoy,$Paciente);		
	}
	if($accion=="DataDoc")
	{
		echo $aux->DataDoctor();
	}
	if($accion=="AgendarPcienteXDocotorGeneral")
	{
		$FechaPoxima=$_GET['FechaPoxima'];
		$hora12=$_GET['hora12'];
		$CodigoPanciente=$_GET['CodigoPanciente'];
		echo $aux->ReservarTurnoPorDocGeneral($CodigoPanciente,$FechaPoxima,$hora12);
	}
	if($accion=="DataAfiliacionPaciente")
	{ 
		$CodigoPac=$_GET['CodigoPac'];
		echo $aux->DataAllPaciente($CodigoPac);
	}
	if($accion=="ModDataPac")
	{
		$CedulaPac=$_GET['CedulaPac'];
		$Passaporte=$_GET['Passaporte'];
		$ApellidoPac=$_GET['ApellidoPac'];
		$NombrePac=$_GET['NombrePac'];
		$Otros=$_GET['Otros'];
		$Edadpac=$_GET['Edadpac'];
		$LugarNac=$_GET['LugarNac'];
		$LugarReside=$_GET['LugarReside'];
		$Sexo=$_GET['Sexo'];
		$Raza=$_GET['Raza'];
		$Religion=$_GET['Religion'];
		$EstadoCivil=$_GET['EstadoCivil'];
		$Intruccion=$_GET['Intruccion'];
		$Profesion=$_GET['Profesion'];
		$Ocupacion=$_GET['Ocupacion'];
		$CondicioPaci=$_GET['CondicioPaci'];
		$Direccion=$_GET['Direccion'];
		$TelefoDomici=$_GET['TelefoDomici'];
		$TelefonoTrabaj=$_GET['TelefonoTrabaj'];
		$Celular=$_GET['Celular'];
		$Correo=$_GET['Correo'];
		$NombRefere=$_GET['NombRefere'];
		$TelefoRefere=$_GET['TelefoRefere'];
		$CodigoPaciente=$_GET['CodigoPaciente'];
		$autori=$_GET['autori'];
		$fechaiaut=$_GET['fechaiaut'];
		$fechafaut=$_GET['fechafaut'];
		$condi2=$_GET['condi2'];
		$estadoPac=$_GET['estadoPac'];
		echo $aux->UpdateFiliacion($CedulaPac,$Passaporte,$ApellidoPac,$NombrePac,$Otros,$Edadpac,$LugarNac,$LugarReside,$Sexo,$Raza,$Religion,$EstadoCivil,$Intruccion,$Profesion,$Ocupacion,$CondicioPaci,$Direccion,$TelefoDomici,$TelefonoTrabaj,$Celular,$Correo,$NombRefere,$TelefoRefere,$CodigoPaciente,$autori,$fechaiaut,$fechafaut,$condi2,$estadoPac);
	}
	if($accion=="actualizarpago")
	{
		$codigoturno=$_GET['codigoturno'];
		$pago=$_GET['pago'];
		echo $aux->ActualizarPago($codigoturno,$pago);
	}
	if($accion=="LoadDataCitasToday")
	{
		echo $aux->ConsultasDeHoyAll();
	}
	if($accion=="CancelarPago")
	{
		$Codigoturno321=$_GET['Codigoturno321'];
		echo $aux->EliminarCita($Codigoturno321);
	}
	if($accion=="NombrePaciente")
	{
		$CodigoPaciente321=$_GET['CodigoPaciente321'];
		echo $aux->NombreCompletoPaciente($CodigoPaciente321);
	}
	if($accion=="ImprimirMedImagen")
	{
		$CodTur2=$_GET['CodTur2'];
		$medimagenes=$_GET['medimagenes'];
		echo $aux->solicutudimagen($medimagenes,$CodTur2);
	}
	if($accion=="GuardarExamen")
	{
		$Codtu=$_GET['Codtu'];
		$DescExamen=$_GET['DescExamen'];
		echo $aux->SolicitudExamenes($DescExamen,$Codtu);
	}

	//guardar cajas de texto en solicitud de examenes
	if($accion=="SaveExamFi")
	{
		$Codtu0=$_GET['Codtu0'];
		$OtOrina=$_GET['OtOrina'];
		$EstLiquidos=$_GET['EstLiquidos'];
		$Muestra=$_GET['Muestra'];
		$DiasNo=$_GET['DiasNo'];
		$OtElectro=$_GET['OtElectro'];
		echo $aux->SolicitudExam2($OtOrina,$EstLiquidos,$Muestra,$DiasNo,$OtElectro,$Codtu0);
	}

	//de la funcion de examen fisico
	if($accion=="DataExamen")
	{
		$ComboBiotipo=$_GET['ComboBiotipo'];
		$Actitud=$_GET['Actitud'];
		$Conciencia=$_GET['Conciencia'];
		$GlasGow=$_GET['GlasGow'];
		$Teperatura=$_GET['Teperatura'];
		$PrecionArterial=$_GET['PrecionArterial'];
		$FrecuenciaCardiaca=$_GET['FrecuenciaCardiaca'];
		$FrecuenciaRespiratoria=$_GET['FrecuenciaRespiratoria'];
		$Peso=$_GET['Peso'];
		$Talla=$_GET['Talla'];
		$MasaCorporal=$_GET['MasaCorporal'];
		$PerimetroCefalico=$_GET['PerimetroCefalico'];
		$PerimetroToracico=$_GET['PerimetroToracico'];
		$PerimetroAbdominal=$_GET['PerimetroAbdominal'];
		$PesoIdeal=$_GET['PesoIdeal'];
		$TenArtAcostado=$_GET['TenArtAcostado'];
		$TenArtSentado=$_GET['TenArtSentado'];
		$TenArtPie=$_GET['TenArtPie'];
		$SuperCorporal=$_GET['SuperCorporal'];
		$Piel=$_GET['Piel'];		
		$AparatoUrinario=$_GET['AparatoUrinario'];
		$AparatoDigestivo=$_GET['AparatoDigestivo'];
		$AparatoGMasculino=$_GET['AparatoGMasculino'];
		$AparatoGFemenino=$_GET['AparatoGFemenino'];
		$MusculoEsqueletico=$_GET['MusculoEsqueletico'];
		$SistemaNervioso=$_GET['SistemaNervioso'];
		$codigo=$_GET['codigo'];
		$CCfaciees=$_GET['CCfaciees'];
		$CCojos=$_GET['CCojos'];
		$CCNariz=$_GET['CCNariz'];
		$CCboca=$_GET['CCboca'];
		$CCoido=$_GET['CCoido'];
		$CCfaringe=$_GET['CCfaringe'];
		$Cuforma=$_GET['Cuforma'];
		$Cumovi=$_GET['Cumovi'];
		$Cupiel=$_GET['Cupiel'];
		$CuParBlan=$_GET['CuParBlan'];
		$Cutiroides=$_GET['Cutiroides'];
		$Cuganglios=$_GET['Cuganglios'];
		$Trespita=$_GET['Trespita'];
		$Tpiel=$_GET['Tpiel'];
		$TBlandas=$_GET['TBlandas'];
		$Tmamas=$_GET['Tmamas'];
		$ToCorazon=$_GET['ToCorazon'];
		$ToPulmones=$_GET['ToPulmones'];
		$AdPiel=$_GET['AdPiel'];
		$AdForVoTam=$_GET['AdForVoTam'];
		$AdTblandaParte=$_GET['AdTblandaParte'];
		$turno=$_GET['turno'];
		echo $aux->dateExamenFisico($ComboBiotipo,$Actitud,$Conciencia,$GlasGow,$Teperatura,$PrecionArterial,$FrecuenciaCardiaca,$FrecuenciaRespiratoria,$Peso,$Talla,$MasaCorporal,$PerimetroCefalico,$PerimetroToracico,$PerimetroAbdominal,$PesoIdeal,$TenArtAcostado,$TenArtSentado,$TenArtPie,$SuperCorporal,$Piel,$AparatoUrinario,$AparatoDigestivo,$AparatoGMasculino,$AparatoGFemenino,$MusculoEsqueletico,$SistemaNervioso,$codigo,$CCfaciees,$CCojos,$CCNariz,$CCboca,$CCoido,$CCfaringe,$Cuforma,$Cumovi,$Cupiel,$CuParBlan,$Cutiroides,$Cuganglios,$Trespita,$Tpiel,$TBlandas,$Tmamas,$ToCorazon,$ToPulmones,$AdPiel,$AdForVoTam,$AdTblandaParte,$turno);
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
		$Endocrino=$_GET['Endocrino'];
		
		
		$CodOculPac=$_GET['CodOculPac'];
		
		//codigo turno para relacionar a las consultas con el turno y los motivos de consulta
		$CodigoTurnoLight=$_GET['CodigoTurnoLight'];
		
		$Gastroente=$_GET['Gastroente'];
		
		echo $aux->IngresarAnamnesis($MotivoConsu,$EnfActual,$TipSangre,$PatoNoPersonales,$Alergias,$Cardiovascu,$Metabolico,$Infecciosos,$Neoplasia,$Endocrono,$Pulmonares,$Nefrologicas,$Hematologica,$Esqueleticos,$Inmuno,$Ginecoobstetr,$Otros2,$Cardiovasfam,$Metabolifam,$Infecciososfam,$Neoplasfam,$Endocronofam,$Pulmonaresfam,$Nefrolofam,$Hematolofam,$Esqueletifam,$Inmunolofam,$Otros3,$Tabaco,$Alcohol,$Drogas,$Medicamentos,$Ejercicio,$TipoDieta,$Vacunas,$Auditivo,$Oftalmologico,$Otorrinolari,$NerviosCra,$Digestivo,$Renal,$Pulmonar,$Cardiovascular,$Oseo,$Ginecobs,$Otros,$CodOculPac,$CodigoTurnoLight,$Endocrino,$Gastroente);
	}
	//if para  actualizar anamnesisi
		//if para  actualizar anamnesisi
		if($accion=="UpdateAnamnesis1")
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
		$Endocrino=$_GET['Endocrino'];
		
		
		$CodOculPac=$_GET['CodOculPac'];
		$CodigoPacieten789=$_GET['CodigoPacieten789'];
		
		$Gastroente=$_GET['Gastroente'];
		
		echo $aux->UpdateAnamnesis($MotivoConsu,$EnfActual,$TipSangre,$PatoNoPersonales,$Alergias,$Cardiovascu,$Metabolico,$Infecciosos,$Neoplasia,$Endocrono,$Pulmonares,$Nefrologicas,$Hematologica,$Esqueleticos,$Inmuno,$Ginecoobstetr,$Otros2,$Cardiovasfam,$Metabolifam,$Infecciososfam,$Neoplasfam,$Endocronofam,$Pulmonaresfam,$Nefrolofam,$Hematolofam,$Esqueletifam,$Inmunolofam,$Otros3,$Tabaco,$Alcohol,$Drogas,$Medicamentos,$Ejercicio,$TipoDieta,$Vacunas,$Auditivo,$Oftalmologico,$Otorrinolari,$NerviosCra,$Digestivo,$Renal,$Pulmonar,$Cardiovascular,$Oseo,$Ginecobs,$Otros,$CodOculPac,$CodigoPacieten789,$Endocrino,$Gastroente);
	}
	//fin if para la actualizacion de anamneis
	if($accion=="VademecunCargar")
	{
		echo $aux->VademecunDoc();
	}
	
	if($accion=="recetarvademecun")
	{
		$codvade=$_GET['codvade'];
		echo $aux->codvademecun($codvade);
	}
	//guardando el diagnostico
	if($accion=="SaveConsulta")
	{
		$CodTurnoFenix123=$_GET['CodTurnoFenix123'];
		$codCie10=$_GET['codCie10'];
		$vademe=$_GET['vademe'];
		$Cantidad=$_GET['Cantidad'];
		$Dosis=$_GET['Dosis'];
		$ViaAdmin=$_GET['ViaAdmin'];
		$Frecuen=$_GET['Frecuen'];
		$Hora=$_GET['Hora'];
		$nombrecomer=$_GET['nombrecomer'];
		$numeroDsm=$_GET['numeroDsm'];
		$TratamietoF=$_GET['TratamietoF'];
		echo $aux->SaveConsulta($CodTurnoFenix123,$codCie10,$vademe,$Cantidad,$Dosis,$ViaAdmin,$Frecuen,$Hora,$nombrecomer,$numeroDsm,$TratamietoF);

	}
	//fin guardando el diagnostico		
	//generar formulario de anamesis
	if($accion=="GenerarAnamesisi")
	{
		$CodigoPaciente312=$_GET['CodigoPaciente312'];
		echo $aux->GenerarFormAnanmesis($CodigoPaciente312);
	}
	//fin generar formulario de anamesis	
	//generar form sistema
	if($accion=="SistemaLoad")
	{
		$CodigoPaciente312=$_GET['CodigoPaciente312'];
		echo $aux->Systema($CodigoPaciente312);
	}
	//fin generar form siteme
	//inicio de form habitos
	if($accion=="SistemaHabitos")
	{
		$CodigoPaciente312=$_GET['CodigoPaciente312'];
		echo $aux->HabitosLoad($CodigoPaciente312);
	}
	//fin de form habitos
	//ver new  historial
	if($accion=="NewDiagnosticoDelPaciente")
	{
		$CodigoPaciente159=$_GET['CodigoPaciente159'];
		echo $aux->NewHistorialPaciente($CodigoPaciente159);
	}
	//fin new  historial
	//salvar alerta
	if($accion=="savealerta")
	{
		$codigopac=$_GET['codigopac'];
		$alerta=$_GET['alerta'];
		echo $aux->RegistrarAlerta($codigopac, $alerta);
	}
	//fin salvar alerta	
	//Load all alertas
	if($accion=="CargarAlert")
	{
		$CodigoPaciente321=$_GET['CodigoPaciente321'];
		echo $aux->CargarAllAlertas($CodigoPaciente321);
	}
	//Fin Load all alertas
	//dar debaja a el pacieten ya revisado
	if($accion=="EndPaciete")
	{
		$CodigoTurno753=$_GET['CodigoTurno753'];
		echo $aux->FinaLizarPaciente($CodigoTurno753);
	}
	if($accion=="LoadMotivoConsulta")
	{
		echo $aux->LoadMotivoNow();
	}
	if($accion=="LoadEnefermedadConsultaLoad")
	{
		echo $aux->LoadEneferemedadNow();
	}
	if($accion=="LoadDataExamenNow")
	{
		$CodigoExamenNow=$_GET['CodigoExamenNow'];
		echo $aux->LoadExamendNow($CodigoExamenNow);
	}
	if($accion=="VerSolictudExamenNow")
	{
		$CodtuNow=$_GET['CodtuNow'];
		echo $aux->LoadSolicitudExamenNow($CodtuNow);
	}
	if($accion=="LoadNowconsHoyPorTunoN")
	{
		$CodigoTurno951=$_GET['CodigoTurno951'];
		echo $aux->LoadConsHoyXTurno($CodigoTurno951);
	}
	if($accion=="VerAgendaAll"){
		echo $aux->LoadAgendaAll();
	}
	if($accion=="VerAgendaXFecha"){
		$FechaAgenda=$_GET['FechaAgenda'];
		echo $aux->LoadAgendaAXFecha($FechaAgenda);
	}
	if($accion=="SaveHabitosLight"){
		$CodigoPaciente567=$_GET['CodigoPaciente567'];
		$TabacoHa=$_GET['TabacoHa'];
		$AlcoholHab=$_GET['AlcoholHab'];
		$DrogasHab=$_GET['DrogasHab'];
		$MedicametoHab=$_GET['MedicametoHab'];
		$EjercicioHab=$_GET['EjercicioHab'];
		$DietaHab=$_GET['DietaHab'];
		$VacunasHab=$_GET['VacunasHab'];
		echo $aux->HabitosLight($CodigoPaciente567,$TabacoHa,$AlcoholHab,$DrogasHab,$MedicametoHab,$EjercicioHab,$DietaHab,$VacunasHab);
	} 
	if($accion=="SaveSistemaLight"){
		$CodigoPaciente741=$_GET['CodigoPaciente741'];
		$AuditivoSis=$_GET['AuditivoSis'];
		$OftalmologicoSis=$_GET['OftalmologicoSis'];
		$OtorrinoSis=$_GET['OtorrinoSis'];
		$NerviosCraneSis=$_GET['NerviosCraneSis'];
		$DigestivoSis=$_GET['DigestivoSis'];
		$RenalSis=$_GET['RenalSis'];
		$PulmonarSis=$_GET['PulmonarSis'];
		$CardioSIs=$_GET['CardioSIs'];
		$OseoSis=$_GET['OseoSis'];
		$GinecoObstSis=$_GET['GinecoObstSis'];
		$OtrosSis=$_GET['OtrosSis'];
		$Endocrino=$_GET['Endocrino'];
		echo $aux->SistemasLight($CodigoPaciente741,$AuditivoSis,$OftalmologicoSis,$OtorrinoSis,$NerviosCraneSis,$DigestivoSis,$RenalSis,$PulmonarSis,$CardioSIs,$OseoSis,$GinecoObstSis,$OtrosSis,$Endocrino);
	}
	if($accion=="CalcularEdadPhp"){
		$Fecha123=$_GET['Fecha123'];
		echo $aux->EdadPhp($Fecha123);
	}
	
	//Odontologia mijardin 
	
	
	if($accion=="GuardarEstoma")
	{
		$Codtu=$_GET['Codtu'];
		$DescOdonto=$_GET['DescOdonto'];
		//$DetalleOdonto=$_GET['DetalleOdonto'];
		echo $aux->ExamenEstomatognatico($DescOdonto,$Codtu);
	} 
	
	//cargar datos de salud bucal segun el codigo del paciente
	if($accion=="LoadDatosSaludbucal")
	{
		$CodigoPaciente7=$_GET['CodigoPaciente7'];
		echo $aux->LoadAllDatosSaludbucal($CodigoPaciente7);
	}
	//fin cargar datos de salud segun el codigo del paciente	
	//start cargar datos de Indices Cpo - ceo segun el codigo de pac
	if($accion=="LoadDatosIndicesCPOCeo")
	{
		$CodigoPaciente27=$_GET['CodigoPaciente27'];
		echo $aux->LoadAllRegIndicesCpoceo($CodigoPaciente27);
	}
	//end cargar datos de Indices Cpo - ceo segun el codigo de pac
	//start cargar datos de planes de diagnostico terapeutico y educacional
	if($accion=="LoadDatosPlanesD")
	{
		$CodigoPaciente00=$_GET['CodigoPaciente00'];
		echo $aux->LoadAllPlanesdeDiagnostico($CodigoPaciente00);
	}
	//end cargar datos de planes de diagnostico terapeutico y educacional 
	
	//save indicadores salud bucal
	if($accion=="SaveSaludbucal")
	{
		$CodPac=$_GET['CodPac'];
		$piezadental16=$_GET['piezadental16'];
		$piezadental17=$_GET['piezadental17'];
		$piezadental55=$_GET['piezadental55'];
		$piezadental11=$_GET['piezadental11'];
		$piezadental21=$_GET['piezadental21'];
		$piezadental51=$_GET['piezadental51'];
		$piezadental26=$_GET['piezadental26'];
		$piezadental27=$_GET['piezadental27'];
		$piezadental65=$_GET['piezadental65'];
		$piezadental36=$_GET['piezadental36'];
		$piezadental37=$_GET['piezadental37'];
		$piezadental75=$_GET['piezadental75'];
		$piezadental31=$_GET['piezadental31'];
		$piezadental41=$_GET['piezadental41'];
		$piezadental71=$_GET['piezadental71'];
		$piezadental46=$_GET['piezadental46'];
		$piezadental47=$_GET['piezadental47'];
		$piezadental85=$_GET['piezadental85'];
		$PlacaV1=$_GET['PlacaV1'];
		$PlacaV2=$_GET['PlacaV2'];
		$PlacaV3=$_GET['PlacaV3'];
		$PlacaV4=$_GET['PlacaV4'];
		$PlacaV5=$_GET['PlacaV5'];
		$PlacaV6=$_GET['PlacaV6'];
		$PlacaRess=$_GET['PlacaRess'];
		$CalculoV1=$_GET['CalculoV1'];
		$CalculoV2=$_GET['CalculoV2'];
		$CalculoV3=$_GET['CalculoV3'];
		$CalculoV4=$_GET['CalculoV4'];
		$CalculoV5=$_GET['CalculoV5'];
		$CalculoV6=$_GET['CalculoV6'];
		$CalculoRess=$_GET['CalculoRess'];
		$GingivitisV1=$_GET['GingivitisV1'];
		$GingivitisV2=$_GET['GingivitisV2'];
		$GingivitisV3=$_GET['GingivitisV3'];
		$GingivitisV4=$_GET['GingivitisV4'];
		$GingivitisV5=$_GET['GingivitisV5'];
		$GingivitisV6=$_GET['GingivitisV6'];
		$GingivitisRess=$_GET['GingivitisRess'];
		$EnfePeriodonLeve=$_GET['EnfePeriodonLeve'];
		$EnfePeriodonModerada=$_GET['EnfePeriodonModerada'];
		$EnfePeriodonSevera=$_GET['EnfePeriodonSevera'];
		$MalOcluAngle1=$_GET['MalOcluAngle1'];
		$MalOcluAngle2=$_GET['MalOcluAngle2'];
		$MalOcluAngle3=$_GET['MalOcluAngle3'];
		$FluorosisLeve=$_GET['FluorosisLeve'];
		$FluorosisModerada=$_GET['FluorosisModerada'];
		$FluorosisSeve=$_GET['FluorosisSeve'];
		echo $aux->SaveAllSaludBucal($piezadental16,$piezadental17,$piezadental55,$piezadental11,$piezadental21,$piezadental51,$piezadental26,$piezadental27,$piezadental65,$piezadental36,$piezadental37,$piezadental75,$piezadental31,$piezadental41,$piezadental71,$piezadental46,$piezadental47,$piezadental85,$PlacaV1,$PlacaV2,$PlacaV3,$PlacaV4,$PlacaV5,$PlacaV6,$PlacaRess,$CalculoV1,$CalculoV2,$CalculoV3,$CalculoV4,$CalculoV5,$CalculoV6,$CalculoRess,$GingivitisV1,$GingivitisV2,$GingivitisV3,$GingivitisV4,$GingivitisV5,$GingivitisV6,$GingivitisRess,$EnfePeriodonLeve,$EnfePeriodonModerada,$EnfePeriodonSevera,$MalOcluAngle1,$MalOcluAngle2,$MalOcluAngle3,$FluorosisLeve,$FluorosisModerada,$FluorosisSeve,$CodPac);
	}
	//fin indicadores salud bucal
	//start indices CPO - ceo
	if($accion=="SaveCPOCeo")
	{
		$CodePaciente=$_GET['CodePaciente'];
		$IndicesCPO1=$_GET['IndicesCPO1'];
		$IndicesCPO2=$_GET['IndicesCPO2'];
		$IndicesCPO3=$_GET['IndicesCPO3'];
		$IndicesCPOTotal=$_GET['IndicesCPOTotal'];
		$Indicesceo1=$_GET['Indicesceo1'];
		$Indicesceo2=$_GET['Indicesceo2'];
		$Indicesceo3=$_GET['Indicesceo3'];
		$IndicesceoTotal=$_GET['IndicesceoTotal'];
		echo $aux->SaveAllIndicesCPOCeo($IndicesCPO1,$IndicesCPO2,$IndicesCPO3,$IndicesCPOTotal,$Indicesceo1,$Indicesceo2,$Indicesceo3,$IndicesceoTotal,$CodePaciente);
	}
	//end indices CPO - ceo
	
	//start save planes de diagnostico terapeurtico y educacional
	if($accion=="SavePlanesD")
	{
		$CodPaciente=$_GET['CodPaciente'];
		$biome=$_GET['biome'];
		$quimsang=$_GET['quimsang'];
		$rayosx=$_GET['rayosx'];
		$otros=$_GET['otros'];
		$detalleplanes=$_GET['detalleplanes'];
		echo $aux->SavePlanesDiagnostico($biome,$quimsang,$rayosx,$otros,$detalleplanes,$CodPaciente);
	}
	//end save planes de diagnostico terapeurtico y educacional 
	
	//start save signos vitales
	if($accion=="SaveSignosVitales")
	{
		$CodePac17=$_GET['CodePac17'];
		$pressnarterial=$_GET['pressnarterial'];
		$frecardiaca=$_GET['frecardiaca'];
		$tempeC=$_GET['tempeC'];
		$frespiramin=$_GET['frespiramin'];
		echo $aux->SaveSignosVitales($pressnarterial,$frecardiaca,$tempeC,$frespiramin,$CodePac17);
	}
	//end save signos vitales 
	
	//start load all datos signos vitales
	if($accion=="LoadDatosSignosVitales")
	{
		$CodigoPaciente89=$_GET['CodigoPaciente89'];
		echo $aux->LoadAllSignosVitales($CodigoPaciente89);
	}
	//end load all datos signos vitales
	// inicio llamada logica para cargar los pacientes cirugia
	if($accion=="CargarPacienteCir")
	{
		echo $cir->ConsultasDeHoyXCirugia();
	}
	// fin de la llamada pacientes cirugia
	// inicion de lugar de la Cirugia
	if($accion=="agendarLugarCir")
	{
		$LugCirugia=$_GET['LugCirugia'];
		echo $cir->CargarLugarCirugia($LugCirugia);
	}
	// Fin de lugar Cirugia
	// inicion de lugar de la Cirugia fecha
	if($accion=="agendarLugarCir2")
	{
		$LugCirugia2=$_GET['LugCirugia2'];
		echo $cir->CargarLugarCirugia($LugCirugia2);
	}
	// Fin de lugar Cirugia fecha
	// asignar turno x cirugia
	if($accion=="AsignarTurnoXCirugia")
	{
		$Paciente12=$_GET['Paciente12'];
		$fechaProx12=$_GET['fechaProx12'];
		$hora12=$_GET['hora12'];
		echo $cir->GenerarTurnoXCirugia($Paciente12,$fechaProx12,$hora12);
	}
	// fin de la asignacion turno cirugia
	// citas Hoy
	if($accion=="VerCitasAllHoyCir")
	{
		echo $cir->VerCitasFormOrderCir();
	}
	if($accion=="HorarioConsutaCir")
	{
		$FechaPoxima=$_GET['FechaPoxima'];
		$CodigoForma=$_GET['CodigoForma'];
		echo $cir->cargarhorarioXDoctorCir($FechaPoxima,$CodigoForma);
	}
	// fin Citas Hoy
	// inicio ver cie
	if($accion=="VerCieCir")
	{
		echo $cir->VerCieCirgia();
	}
	// fin ver cie
	// inicio ver cie 3
	if($accion=="VerCie3Cir")
	{
		$Descripcion33=$_GET['Descripcion33'];
		echo $cir->VerCie3Cir($Descripcion33);
	}
	//fin ver cie 3
	//inicio asignar cie
	if($accion=="AsigCieCirugia")
	{
		$Cie=$_GET['Cie'];
		echo $cir->CargarDiagnosticoCirugia($Cie);
	}
	//fin asignar cie
	if($accion=="ControCir")
	{
		$codigopaciente=$_GET['codigopaciente'];
		$codigoturno=$_GET['codigoturno'];
		echo $cir->cargarIngresoSalida($codigopaciente,$codigoturno);
	}
	if($accion=="salidacirugia")
	{
		$codigocir=$_GET['codigocir'];
		$fecha=$_GET['fecha'];
		$TipoCiru=$_GET['TipoCiru'];
		$honorario=$_GET['honorario'];
		echo $cir->alta($codigocir,$fecha,$TipoCiru,$honorario);
	}
	
	//start Save datos prenatales
	if($accion=="SavePrenatales")
	{
		$CodePacP17=$_GET['CodePacP17'];
		$PrenaG=$_GET['PrenaG'];
		$PrenaA=$_GET['PrenaA'];
		$PrenaP=$_GET['PrenaP'];
		$PrenaC=$_GET['PrenaC'];
		$ComplicaEmbarazo=$_GET['ComplicaEmbarazo'];
		$Nacimiento=$_GET['Nacimiento'];
		$EdadGes=$_GET['EdadGes'];
		$Peso=$_GET['Peso'];
		$Talla=$_GET['Talla'];
		$Pc=$_GET['Pc'];
		$Apgar1=$_GET['Apgar1'];
		$Apgar2=$_GET['Apgar2'];
		$ComplicacionesNa=$_GET['ComplicacionesNa'];
		$ScreeMeta=$_GET['ScreeMeta'];
		echo $aux->SaveAllPrenatales($PrenaG,$PrenaA,$PrenaP,$PrenaC,$ComplicaEmbarazo,$Nacimiento,$EdadGes,$Peso,$Talla,$Pc,$Apgar1,$Apgar2,$ComplicacionesNa,$ScreeMeta,$CodePacP17);
	}
	//end Save datos prenatales
	//start save vacunas
	if($accion=="SaveVacunas")
	{
		$CodePacP99=$_GET['CodePacP99'];
		$Dosis1Dpt=$_GET['Dosis1Dpt'];
		$Dosis2Dpt=$_GET['Dosis2Dpt'];
		$Dosis3Dpt=$_GET['Dosis3Dpt'];
		$Refuerzo1Dpt=$_GET['Refuerzo1Dpt'];
		$Refuerzo2Dpt=$_GET['Refuerzo2Dpt'];
		$observaDpt=$_GET['observaDpt'];
		$Dosis1Po=$_GET['Dosis1Po'];
		$Dosis2Po=$_GET['Dosis2Po'];
		$Dosis3Po=$_GET['Dosis3Po'];
		$Refuerzo1Po=$_GET['Refuerzo1Po'];
		$Refuerzo2Po=$_GET['Refuerzo2Po'];
		$observaPo=$_GET['observaPo'];
		$Dosis1HiB=$_GET['Dosis1HiB'];
		$Dosis2HiB=$_GET['Dosis2HiB'];
		$Dosis3HiB=$_GET['Dosis3HiB'];
		$Refuerzo1HiB=$_GET['Refuerzo1HiB'];
		$Refuerzo2HiB=$_GET['Refuerzo2HiB'];
		$observaHiB=$_GET['observaHiB'];
		$Dosis1Hvb=$_GET['Dosis1Hvb'];
		$Dosis2Hvb=$_GET['Dosis2Hvb'];
		$Dosis3Hvb=$_GET['Dosis3Hvb'];
		$Refuerzo1Hvb=$_GET['Refuerzo1Hvb'];
		$Refuerzo2Hvb=$_GET['Refuerzo2Hvb'];
		$observaHvb=$_GET['observaHvb'];
		$Dosis1Neumo=$_GET['Dosis1Neumo'];
		$Dosis2Neumo=$_GET['Dosis2Neumo'];
		$Dosis3Neumo=$_GET['Dosis3Neumo'];
		$Refuerzo1Neumo=$_GET['Refuerzo1Neumo'];
		$Refuerzo2Neumo=$_GET['Refuerzo2Neumo'];
		$observaNeumo=$_GET['observaNeumo'];
		$Dosis1Rota=$_GET['Dosis1Rota'];
		$Dosis2Rota=$_GET['Dosis2Rota'];
		$Dosis3Rota=$_GET['Dosis3Rota'];
		$Refuerzo1Rota=$_GET['Refuerzo1Rota'];
		$Refuerzo2Rota=$_GET['Refuerzo2Rota'];
		$observaRota=$_GET['observaRota'];
		$Dosis1Spr=$_GET['Dosis1Spr'];
		$Dosis2Spr=$_GET['Dosis2Spr'];
		$Dosis3Spr=$_GET['Dosis3Spr'];
		$Refuerzo1Spr=$_GET['Refuerzo1Spr'];
		$Refuerzo2Spr=$_GET['Refuerzo2Spr'];
		$observaSpr=$_GET['observaSpr'];
		$Dosis1Vari=$_GET['Dosis1Vari'];
		$Dosis2Vari=$_GET['Dosis2Vari'];
		$Dosis3Vari=$_GET['Dosis3Vari'];
		$Refuerzo1Vari=$_GET['Refuerzo1Vari'];
		$Refuerzo2Vari=$_GET['Refuerzo2Vari'];
		$observaVari=$_GET['observaVari'];
		$Dosis1Hva=$_GET['Dosis1Hva'];
		$Dosis2Hva=$_GET['Dosis2Hva'];
		$Dosis3Hva=$_GET['Dosis3Hva'];
		$Refuerzo1Hva=$_GET['Refuerzo1Hva'];
		$Refuerzo2Hva=$_GET['Refuerzo2Hva'];
		$observaHva=$_GET['observaHva'];
		$Dosis1Fama=$_GET['Dosis1Fama'];
		$Dosis2Fama=$_GET['Dosis2Fama'];
		$Dosis3Fama=$_GET['Dosis3Fama'];
		$Refuerzo1Fama=$_GET['Refuerzo1Fama'];
		$Refuerzo2Fama=$_GET['Refuerzo2Fama'];
		$observaFama=$_GET['observaFama'];
		$Dosis1Influ=$_GET['Dosis1Influ'];
		$Dosis2Influ=$_GET['Dosis2Influ'];
		$Dosis3Influ=$_GET['Dosis3Influ'];
		$Refuerzo1Influ=$_GET['Refuerzo1Influ'];
		$Refuerzo2Influ=$_GET['Refuerzo2Influ'];
		$observaInflu=$_GET['observaInflu'];
		$Dosis1Meningo=$_GET['Dosis1Meningo'];
		$Dosis2Meningo=$_GET['Dosis2Meningo'];
		$Dosis3Meningo=$_GET['Dosis3Meningo'];
		$Ref1Meningo=$_GET['Ref1Meningo'];
		$Ref2Meningo=$_GET['Ref2Meningo'];
		$observaMeningo=$_GET['observaMeningo'];
		$Dosis1Hpv=$_GET['Dosis1Hpv'];
		$Dosis2Hpv=$_GET['Dosis2Hpv'];
		$Dosis3Hpv=$_GET['Dosis3Hpv'];
		$Refuerzo1Hpv=$_GET['Refuerzo1Hpv'];
		$Refuerzo2Hpv=$_GET['Refuerzo2Hpv'];
		$observaHpv=$_GET['observaHpv'];
		$Dosis1Ftifo=$_GET['Dosis1Ftifo'];
		$Dosis2Ftifo=$_GET['Dosis2Ftifo'];
		$Dosis3Ftifo=$_GET['Dosis3Ftifo'];
		$Refuerzo1Ftifo=$_GET['Refuerzo1Ftifo'];
		$Refuerzo2Ftifo=$_GET['Refuerzo2Ftifo'];
		$observaFtifo=$_GET['observaFtifo'];
		
		$Dosis1Dp=$_GET['Dosis1Dp'];
		$Dosis2Dp=$_GET['Dosis2Dp'];
		$Dosis3Dp=$_GET['Dosis3Dp'];
		$Refuerzo1Dp=$_GET['Refuerzo1Dp'];
		$Refuerzo2Dp=$_GET['Refuerzo2Dp'];
		$observaDp=$_GET['observaDp'];
	  echo $aux->SaveVacunas($Dosis1Dpt,$Dosis2Dpt,$Dosis3Dpt,$Refuerzo1Dpt,$Refuerzo2Dpt,$observaDpt,$Dosis1Po,$Dosis2Po,$Dosis3Po,$Refuerzo1Po,$Refuerzo2Po,$observaPo,$Dosis1HiB,$Dosis2HiB,$Dosis3HiB,$Refuerzo1HiB,$Refuerzo2HiB,$observaHiB,$Dosis1Hvb,$Dosis2Hvb,$Dosis3Hvb,$Refuerzo1Hvb,$Refuerzo2Hvb,$observaHvb,$Dosis1Neumo,$Dosis2Neumo,$Dosis3Neumo,$Refuerzo1Neumo,$Refuerzo2Neumo,$observaNeumo,$Dosis1Rota,$Dosis2Rota,$Dosis3Rota,$Refuerzo1Rota,$Refuerzo2Rota,$observaRota,$Dosis1Spr,$Dosis2Spr,$Dosis3Spr,$Refuerzo1Spr,$Refuerzo2Spr,$observaSpr,$Dosis1Vari,$Dosis2Vari,$Dosis3Vari,$Refuerzo1Vari,$Refuerzo2Vari,$observaVari,$Dosis1Hva,$Dosis2Hva,$Dosis3Hva,$Refuerzo1Hva,$Refuerzo2Hva,$observaHva,$Dosis1Fama,$Dosis2Fama,$Dosis3Fama,$Refuerzo1Fama,$Refuerzo2Fama,$observaFama,$Dosis1Influ,$Dosis2Influ,$Dosis3Influ,$Refuerzo1Influ,$Refuerzo2Influ,$observaInflu,$Dosis1Meningo,$Dosis2Meningo,$Dosis3Meningo,$Ref1Meningo,$Ref2Meningo,$observaMeningo,$Dosis1Hpv,$Dosis2Hpv,$Dosis3Hpv,$Refuerzo1Hpv,$Refuerzo2Hpv,$observaHpv,$Dosis1Ftifo,$Dosis2Ftifo,$Dosis3Ftifo,$Refuerzo1Ftifo,$Refuerzo2Ftifo,$observaFtifo,$CodePacP99,$Dosis1Dp,$Dosis2Dp,$Dosis3Dp,$Refuerzo1Dp,$Refuerzo2Dp,$observaDp);
				
	}
	//end save vacunas
	
	//start cargar datos de prenatales
	if($accion=="LoadAllDatosPrenatales")
	{
		$CodigoPaciente77=$_GET['CodigoPaciente77'];
		echo $aux->LoadAllPrenatales($CodigoPaciente77);
	}
	//end cargar datos de prenatales
	//start cargar datos de vacunas
	if($accion=="LoadDatosVacunas")
	{
		$CodigoPaciente91=$_GET['CodigoPaciente91'];
		echo $aux->LOadAllVacunas($CodigoPaciente91);
	}
	//end cargar datos de vacunas
	
	if($accion=="SaveOdontograma3Light"){
		$CodPaciente=$_GET['CodPaciente'];
		$Tratamiento=$_GET['Tratamiento'];
		echo $aux->SaveOdontogramaLight($CodPaciente,$Tratamiento);
	}
	
	
	if($accion=="LoadOdontograma3Light"){
		$CodPaciente=$_GET['CodPaciente'];
		echo $aux->LoadOdontograma3Light($CodPaciente);
	}
	if($accion=="LoadOdontograma"){
		$CP0=$_GET['CP0'];
		echo $aux->LoadOdontogramaLightV4($CP0);
	}
	
	if($accion=="UpdateMotivoCo")
	{
		$CodigoMo=$_GET['CodigoMo'];
		$MotivoConsulta=$_GET['MotivoConsulta'];
		echo $aux->UpdateMotivoConsulta($CodigoMo,$MotivoConsulta);
	}
	if($accion=="UpdateEnfermedadAc")
	{
		$CodigoEnAc=$_GET['CodigoEnAc'];
		$EnfermedadActual=$_GET['EnfermedadActual'];
		echo $aux->UpdateEnfermedadActual($CodigoEnAc,$EnfermedadActual);
	}
	
	if($accion=="SaveSistemaEstoma")
	{
		$CodPac09=$_GET['CodPac09'];
		$labios=$_GET['labios'];
		$mejillas=$_GET['mejillas']; 
		$maxilarsup=$_GET['maxilarsup'];
		$maxilarinf=$_GET['maxilarinf'];
		$lengua=$_GET['lengua'];
		$paladar=$_GET['paladar']; 
		$piso=$_GET['piso']; 
		$carrillos=$_GET['carrillos'];
		$glsalibales=$_GET['glsalibales'];
		$ofaringe=$_GET['ofaringe'];
		$atm=$_GET['atm'];
		$ganglios=$_GET['ganglios'];
		$detallesisestoma=$_GET['detallesisestoma']; 
		echo $aux->SaveEstamatognatico($labios,$mejillas,$maxilarsup,$maxilarinf,$lengua,$paladar,$piso,$carrillos,$glsalibales,$ofaringe,$atm,$ganglios,$detallesisestoma,$CodPac09);
	}
	
	if($accion=="LoadDatosEstoma")
	{
		$CodigoPaciente09=$_GET['CodigoPaciente09'];
		echo $aux->LoadAllEstomatignatico($CodigoPaciente09);
	}
	
	//save consentimiento informado de representante legal
	if($accion=="SaveConsentimientoInfoRep")
	{
		$CodigoPac06=$_GET['CodigoPac06'];
		$NombreRepLegal=$_GET['NombreRepLegal'];
		$Parentesco=$_GET['Parentesco'];
		$Telefono=$_GET['Telefono'];
		$Cedula=$_GET['Cedula'];
		$InstitucionSistema=$_GET['InstitucionSistema'];
		$UnidadOp=$_GET['UnidadOp'];
		$CodUO=$_GET['CodUO'];
		$Parroquia=$_GET['Parroquia'];
		$Canton=$_GET['Canton'];
		$Provincia=$_GET['Provincia'];
		$HistoriaCli=$_GET['HistoriaCli'];
		$ApellidoPa=$_GET['ApellidoPa'];
		$ApellidoMa=$_GET['ApellidoMa'];
		$Nombres=$_GET['Nombres'];
		$Servicio=$_GET['Servicio'];
		$Sala=$_GET['Sala'];
		$Cama=$_GET['Cama'];
		$Fecha=$_GET['Fecha'];
		$Hora=$_GET['Hora'];
		$Turno=$_GET['Turno'];
		echo $aux->SaveConsenInfoRep($NombreRepLegal,$Parentesco,$Telefono,$Cedula,$InstitucionSistema,$UnidadOp,$CodUO,$Parroquia,$Canton,$Provincia,$HistoriaCli,$ApellidoMa,$ApellidoPa,$Nombres,$Servicio,$Sala,$Cama,$Fecha,$Hora,$CodigoPac06,$Turno);
	}
	//fin save consentimiento informado representante legal
	
	//incion de la captura de las variables para gurdar el odontograma
	if($accion=="SaveOdontogramaLight5"){
		$Dentadura=$_GET['Dentadura'];/*
		$Dentadura2=$_GET['Dentadura2'];
		$Dentadura3=$_GET['Dentadura3'];*/
		echo $aux->GuardarOdontogramaLIGHT5($Dentadura);
	}
	if($accion=="SaveOdontogramaLight6"){
		$Dentadura=$_GET['Dentadura'];/*
		$Dentadura2=$_GET['Dentadura2'];
		$Dentadura3=$_GET['Dentadura3'];*/
		echo $aux->GuardarOdontogramaLIGHT5($Dentadura);
	}
	if($accion=="SaveOdontogramaLight7"){
		$Dentadura=$_GET['Dentadura'];/*
		$Dentadura2=$_GET['Dentadura2'];
		$Dentadura3=$_GET['Dentadura3'];*/
		echo $aux->GuardarOdontogramaLIGHT5($Dentadura);
	}

	//fin de la captura de las variables para gurdar el odontograma 
	
	//guardar datos plan de tratamiento y pagos
	if($accion=="SavePlanTratamientoPagos")
	{
		$CodPac99=$_GET['CodPac99'];
		$Actividad=$_GET['Actividad'];
		$NumActividad=$_GET['NumActividad'];
		$PrecUnitario=$_GET['PrecUnitario'];
		$Total=$_GET['Total'];
		$Fecha123=$_GET['Fecha123'];
		$Abono=$_GET['Abono'];
		$NumFactura=$_GET['NumFactura'];
		$Cheque=$_GET['Cheque'];
		$Efectivo=$_GET['Efectivo'];
		$Saldo=$_GET['Saldo']; 
		echo $aux->SaveTratamPagos($Actividad,$NumActividad,$PrecUnitario,$Total,$Fecha123,$Abono,$NumFactura,$Cheque,$Efectivo,$Saldo,$CodPac99);
	}
	//fin guardar datos plan de tratamiento y pagos
	
	//mostrar el historial plan de tratamiento y pagos
	if($accion=="PlanTratamiPagos")
	{
		$CodigoPaciente15=$_GET['CodigoPaciente15'];
		echo $aux->MostrarHistorialPagos($CodigoPaciente15);
	}
	//fin mostrar el historial plan de tratamiento y pagos 

	//cargar epicrisis
	if($accion=="VerEpicris"){
		$CodTurEpi=$_GET['CodTurEpi'];
		echo $aux->LoadEpicrisis($CodTurEpi);
	}
	//fin cargar epicrisis
	//cargar cie para epicrisis
	if($accion=="VademecunCargar1"){
		$caja=$_GET['caja'];
		echo $aux->VademecunDoc2($caja);

	}
	//fin cargar cie para epicrisis
	
	//cargar cie para la epicris 
	if ($accion=="LoadCieEpi") {
		$cie=$_GET['cie'];
		$textbox=$_GET['textbox'];
		echo $aux->LoadCieTextbox($cie,$textbox);
	}
	//fin de cargar de cie para la epicris
	//buscador cie 
	if ($accion=="CieCargar1") {
		$caja=$_GET['caja'];
		$BuscarPor=$_GET['BuscarPor'];
		echo $aux->BuscarCieEpic($caja,$BuscarPor);
	}
	//fin buscador cie 
	//guardar cie de epiricris
	if ($accion=="SaveCiePi") {
		$CieEpicris=$_GET['CieEpicris'];
		echo $aux->SaveCieEpicris($CieEpicris);
	}
	//fin guardar cie de epiricris
	// guardar epicrisis
	if ($accion=="SaveEpicrisP") {
		$ObjEpic=$_GET['ObjEpic'];
		echo $aux->SaveEpicrisPhp($ObjEpic);
	}
	//fin para guardar la epicrisis
	//first finalizacion de la epicrisis
	if ($accion=="EndEpicrisis") {
		$CodEpicri=$_GET['CodEpicri'];
		$MedicoEpi=$_GET['MedicoEpi'];
		echo $aux->EndEpicris($CodEpicri,$MedicoEpi);
	}
	//end finalizacion de la epicrisis
	//first nueva epicrisis
	if ($accion=="AddNewEpicrisisi") {
		$IdPaciente=$_GET['IdPaciente'];
		echo $aux->AddNewEpicrisis($IdPaciente);
	}
	//end nueva epicrisis
	//first cargar diagnosticos epicrisis
	if ($accion=="LoadDiagnosticosEpicrisis") {
		$IdDiaEpicri=$_GET['IdDiaEpicri'];
		echo $aux->LoadDiagnosticoEpicrisisi($IdDiaEpicri);
	}
	//end  cargar diagnosticos epicrisis

	//ver el historial de epicrisis ordenado por fechas 
	if ($accion=="Hisepcrisis") {
		$IdPacienteEp=$_GET['IdPacienteEp'];
		echo $aux->LoadHisEpicrisis($IdPacienteEp);
	}
	//fin ver el historial de epicrisis ordenado por fechas





	/*incion de los proceso para el  modulo para subir pdf de los paciente*/
		//buscar paciente
		if ($accion=="BuscapacienteToUpPdf") {
			$Descripcion=$_GET['Descripcion'];
			$pr=$_GET['pr'];
			echo $aux1->LoadPacienteToUpPdf($Descripcion,$pr);
		}
		//fin buscar paciente

		//formulario para subir archivos y creacion de directorios para almacenar los archivos del paciente
		if($accion=="GenerarForm2ToUpPdf"){
			$paciente=$_GET['paciente'];
			echo $aux1->FormToUpPDFPaciente($paciente);
		}
		//fin formulario para subir archivos y creacion de directorios para almacenar los archivos del paciente
		//subir archivos del paciente a el servidor
		if ($accion=="SubirDigital") {
			$idp=$_GET['idp'];
			$pos=$_GET['pos'];
			$Fecha=$_GET['Fecha'];
			echo $aux1->UpTofilePaciente($idp,$pos,$Fecha);
		}
		//fin subir archivos del paciente a el servidor
		//reload archivos
		if ($accion=="ReloadFiles") {
			$PacietId=$_GET['PacietId'];
			echo $aux1->DisiFormUpToUpFile($PacietId);
		}
		//fin reload archivos
		//ver los archivos pertenecientes al el paciente
		if ($accion=="SeeAllFile") {
			$PacietId=$_GET['PacietId'];
			$pos=$_GET['pos'];
			echo $aux1->LoadFilePaciente($PacietId,$pos,"1",1);
		}
		//fin ver los archivos pertenecientes al el paciente
		//lista de archivos para tener la opcion de borrar
		if($accion=="SeeAllLista"){
			$PacietId=$_GET['PacietId'];
			$pos=$_GET['pos'];
			echo $aux1->LoadFilePaciente($PacietId,$pos,"2",1);
		}
		//lista de archivos para tener la opcion de borrar
		if($accion=="SeeAllLista2"){
			$PacietId=$_GET['PacietId'];
			$pos=$_GET['pos'];
			echo $aux1->LoadFilePaciente($PacietId,$pos,"2",1);
		}
		//fin lista de archivos para tener la opcion de borrar
		//borrar archivos del paciente 
		if($accion=="DeleteFil"){
			$CodFile=$_GET['CodFile'];
			echo $aux1->DeleteFil($CodFile);
		}
		//fin borrar archivos del paciente
	/*fin de los procesos para el modulo para subir pdf de los paciente*/
	
	//-------------------- Mi codigo Anamnesis -------------------------//

	//save Anamnesis Cdu
	if($accion=="SaveAnamnesis2Cdu")
	{
		$CodPacCdu99=$_GET['CodPacCdu99'];
		$LugarEstabl=$_GET['LugarEstabl'];
		$NombrePac=$_GET['NombrePac'];
		$ApellidoPac=$_GET['ApellidoPac'];
		$SexoPac=$_GET['SexoPac'];
		$NumueroHoja=$_GET['NumueroHoja'];
		$HistoriaCl=$_GET['HistoriaCl'];
		$MotivoCo=$_GET['MotivoCo'];
		$AntecPer=$_GET['AntecPer'];
		$AntecFam=$_GET['AntecFam'];
		$EnfermeProAc=$_GET['EnfermeProAc'];
		$ReviOrgSis=$_GET['ReviOrgSis'];
		$FechaSigVi1=$_GET['FechaSigVi1'];
		$FechaSigVi2=$_GET['FechaSigVi2'];
		$FechaSigVi3=$_GET['FechaSigVi3'];
		$FechaSigVi4=$_GET['FechaSigVi4'];
		$PreSigVi1=$_GET['PreSigVi1'];
		$PreSigVi2=$_GET['PreSigVi2'];
		$PreSigVi3=$_GET['PreSigVi3'];
		$PreSigVi4=$_GET['PreSigVi4'];
		$PulsSigVi1=$_GET['PulsSigVi1'];
		$PulsoSigVi2=$_GET['PulsoSigVi2'];
		$PulsoSigVi3=$_GET['PulsoSigVi3'];
		$PulsoSigVi4=$_GET['PulsoSigVi4'];
		$TempSigVi1=$_GET['TempSigVi1'];
		$TempSigVi2=$_GET['TempSigVi2'];
		$TempSigVi3=$_GET['TempSigVi3'];
		$TempSigVi4=$_GET['TempSigVi4'];
		$ExaFisico=$_GET['ExaFisico'];
		$Diagn1=$_GET['Diagn1'];
		$Diagn2=$_GET['Diagn2'];
		$Diagn3=$_GET['Diagn3'];
		$Diagn4=$_GET['Diagn4'];
		$Diagn5=$_GET['Diagn5'];
		$CodCie1=$_GET['CodCie1'];
		$CodCie2=$_GET['CodCie2'];
		$CodCie3=$_GET['CodCie3'];
		$CodCie4=$_GET['CodCie4'];
		$CodCie5=$_GET['CodCie5'];
		$Pre1=$_GET['Pre1'];
		$Pre2=$_GET['Pre2'];
		$Pre3=$_GET['Pre3'];
		$Pre4=$_GET['Pre4'];
		$Pre5=$_GET['Pre5'];
		$Def1=$_GET['Def1'];
		$Def2=$_GET['Def2'];
		$Def3=$_GET['Def3'];
		$Def4=$_GET['Def4'];
		$Def5=$_GET['Def5'];
		$PlanesDte=$_GET['PlanesDte'];
		$FechaContr=$_GET['FechaContr'];
		$HoraFin=$_GET['HoraFin'];
		$Medico=$_GET['Medico'];
		$CodMedico=$_GET['CodMedico'];
		echo $aux->SaveCduAnamnesis($LugarEstabl,$NombrePac,$ApellidoPac,$SexoPac,$NumueroHoja,$HistoriaCl,$MotivoCo,$AntecPer,$AntecFam,$EnfermeProAc,$ReviOrgSis,$FechaSigVi1,$FechaSigVi2,$FechaSigVi3,$FechaSigVi4,$PreSigVi1,$PreSigVi2,$PreSigVi3,$PreSigVi4,$PulsSigVi1,$PulsoSigVi2,$PulsoSigVi3,$PulsoSigVi4,$TempSigVi1,$TempSigVi2,$TempSigVi3,$TempSigVi4,$ExaFisico,$Diagn1,$Diagn2,$Diagn3,$Diagn4,$Diagn5,$CodCie1,$CodCie2,$CodCie3,$CodCie4,$CodCie5,$Pre1,$Pre2,$Pre3,$Pre4,$Pre5,$Def1,$Def2,$Def3,$Def4,$Def5,$PlanesDte,$CodPacCdu99,$FechaContr,$HoraFin,$Medico,$CodMedico);
		
	}
	//fin save Anamnesis Cdu
	
	//generar y cargar anamnesis cdu por id_pac
	if($accion=="GenerarAnamesisCdu")
	{
		$CodigoPac2=$_GET['CodigoPac2'];
		echo $aux->LoadAllAnamnesisCdu($CodigoPac2);
	}
	//fin generar y cargar anamnesis cdu por id_pac
	
	//save expediente (consecuente)
	if($accion=="SaveExpedienteCdu")
	{
		$CodPacCdu73=$_GET['CodPacCdu73'];
		$FechaExp=$_GET['FechaExp'];
		$HoraExp=$_GET['HoraExp'];
		$EvolucionExp=$_GET['EvolucionExp'];
		$PrescripcionesExp=$_GET['PrescripcionesExp'];
		$MedicamentosExp=$_GET['MedicamentosExp'];
		echo $aux->SaveExpedienteCdu($FechaExp,$HoraExp,$EvolucionExp,$PrescripcionesExp,$MedicamentosExp,$CodPacCdu73);
	}
	//fin save expediente (consecuente)
	
	//finalizar update anamnesis
	if($accion=="FinalizarAnamn")
	{
		$idAnam=$_GET['idAnam'];
		//$MedAnam=$_GET['MedAnam'];
		$aux->FinalizarAnamCdu($idAnam);
	}
	//fin finalizar update anamnesis
	
	//load expediente
	if($accion=="LoadAllExpediente")
	{
		$cod=$_GET['cod'];
		echo $aux->LoadAllExpediente($cod);
	}
	//fin load expediente
	
	//nueva anamnesis
	if ($accion=="CreateNewAnamnesis") {
		$IdPaciente=$_GET['IdPaciente'];
		echo $aux->CreateNewAnamnesis($IdPaciente);
	}

	//buscar paciente para cirugia
	if ($accion=="citacirugia") {
		$buscar=$_GET['buscar'];
		echo $aux1->CargarDatosUpdatePaciente($buscar,2);
	}
	//fin buscar paciente para cirugia

	//abrir frm1 para agendar paciente para la cirugia
	if ($accion=="FrmCirugia") {
		$pacientcod=$_GET['pacientcod'];
		echo $aux1->Frm1CitCirugia($pacientcod);
	}
	//fin frm1 para agendar paciente para la cirugia
	//buscar medico para ver diponibilidad del medico para agendarlo a una cita de cirugia
	if ($accion=="SearchCirujia") {
		$Medico=$_GET['Medico'];
		$fecha=$_GET['fecha'];
		$Hora=$_GET['Hora'];
		echo $aux1->MedicosDispuestos($fecha,$Hora,$Medico,0,0,1);
	}
	//fin buscar medico para ver disponibilidad del medico para agendarlo a una cita de cirugia
	//buscar anestesiologo
	if ($accion=="SearchAnestesiolo") {
		$Medico=$_GET['Medico'];
		$fecha=$_GET['fecha'];
		$Hora=$_GET['Hora'];
		$CirujCod=$_GET['CirujCod'];
		echo $aux1->MedicosDispuestos($fecha,$Hora,$Medico,$CirujCod,0,2);
	}
	//fin de buscar a el anestesiologo
	//buscar ayudante 
	if ($accion=="SearchAyudante") {
		$Medico=$_GET['Medico'];
		$fecha=$_GET['fecha'];
		$Hora=$_GET['Hora'];
		$CirujCod=$_GET['CirujCod'];
		$AnestesCod=$_GET['AnestesCod'];
		echo $aux1->MedicosDispuestos($fecha,$Hora,$Medico,$CirujCod,$AnestesCod,3);	
	}
	//fin buscar ayudante
	//guardar las citas de cirugia
	if ($accion=="SaveCirugiaCita") {
		$Codayudate=$_GET['Codayudate'];
		$fecha=$_GET['fecha'];
		$Hora=$_GET['Hora'];
		$CirujCod=$_GET['CirujCod'];
		$AnestesCod=$_GET['AnestesCod'];
		$Procedimieto=$_GET['Procedimieto'];
		$tieHos=$_GET['tieHos'];
		$Observaciones=$_GET['Observaciones'];
		$CodiPacie=$_GET['CodiPacie'];
		$DuracionCir=$_GET['DuracionCir'];
		echo $aux1->SaveCitaCirugia($CodiPacie,$CirujCod,$AnestesCod,$Codayudate,$fecha,$Hora,$DuracionCir,$Procedimieto,$tieHos,$Observaciones);
	}
	if ($accion=="SaveModificarCirugiaCita") {
		$Codayudate=$_GET['Codayudate'];
		$fecha=$_GET['fecha'];
		$Hora=$_GET['Hora'];
		$CirujCod=$_GET['CirujCod'];
		$AnestesCod=$_GET['AnestesCod'];
		$Procedimieto=$_GET['Procedimieto'];
		$tieHos=$_GET['tieHos'];
		$Observaciones=$_GET['Observaciones'];
		$DuracionCir=$_GET['DuracionCir'];
		$CodeCirugia=$_GET['CodeCirugia'];
		echo $aux2->SaveModificarCirugiaCita($CirujCod,$AnestesCod,$Codayudate,$fecha,$Hora,$DuracionCir,$Procedimieto,$tieHos,$Observaciones,$CodeCirugia);
	}
	//fin guardar las citas de cirugia
	//cargar solo los medicos para poder dar altas y bajas de dichos medicos
	if ($accion=='LoadDataDoc') {
		echo $aux1->LoadDataDoc("");
	}
	//fin cargar solos medicos para poder dar altas y bajas de dichis medicos
	//cargar busque de los medicos mas especifica
	if ($accion=="SearchDataDoc") {
		$Medico=$_GET['Medico'];
		echo $aux1->LoadDataDoc($Medico);
	}
	//fin cargar busque de los medicos mas especifica
	//pasos para cargar los datos del medico 
	if ($accion=="LoadDataMedico") {
		$CodMedico=$_GET['CodMedico'];
		echo $aux1->FrmModMedico($CodMedico);
	}
	//fin pasos para cargar los datos del  medico 
	
	//-------------------- Micodigo Interconsulta -------------------------// 
	
	//save solicitud interconsulta
	if($accion=="SaveSolicituInCo")
	{
		$CodpacCduIn1=$_GET['CodpacCduIn1'];
		$InstitucionSys=$_GET['InstitucionSys'];
		$UnidadOp2=$_GET['UnidadOp2'];
		$CodigoSo=$_GET['CodigoSo'];
		$ParroquiaSo=$_GET['ParroquiaSo'];
		$CantonSo=$_GET['CantonSo'];
		$ProvinciaSo=$_GET['ProvinciaSo'];
		$HistoriaClSo=$_GET['HistoriaClSo'];
		$ApellidoSo=$_GET['ApellidoSo'];
		$NombresSo=$_GET['NombresSo'];
		$CedulaSo=$_GET['CedulaSo'];
		$FechaAtn=$_GET['FechaAtn'];
		$HoraSo=$_GET['HoraSo'];
		$EdadSo=$_GET['EdadSo'];
		$GeneroSo=$_GET['GeneroSo'];
		$EstadoCivSo=$_GET['EstadoCivSo'];
		$IntruccionSo=$_GET['IntruccionSo'];
		$EmpresaSo=$_GET['EmpresaSo'];
		$SeguroSaludSo=$_GET['SeguroSaludSo'];
		$EstablecimientoDes=$_GET['EstablecimientoDes'];
		$ServicioCon=$_GET['ServicioCon'];
		$ServicioSo=$_GET['ServicioSo'];
		$SalaSo=$_GET['SalaSo'];
		$CamaSo=$_GET['CamaSo'];
		$NormalSo=$_GET['NormalSo'];
		$UrgenteSo=$_GET['UrgenteSo'];
		$MedicoInter=$_GET['MedicoInter'];
		$CuadroClinico=$_GET['CuadroClinico'];
		$ResultadoPruebas=$_GET['ResultadoPruebas'];
		$Cie1So=$_GET['Cie1So'];
		$Cie2So=$_GET['Cie2So'];
		$Cie3So=$_GET['Cie3So'];
		$Cie4So=$_GET['Cie4So'];
		$Cie5So=$_GET['Cie5So'];
		$Cie6So=$_GET['Cie6So'];
		$Cod1So=$_GET['Cod1So'];
		$Cod2So=$_GET['Cod2So'];
		$Cod3So=$_GET['Cod3So'];
		$Cod4So=$_GET['Cod4So'];
		$Cod5So=$_GET['Cod5So'];
		$Cod6So=$_GET['Cod6So'];
		$Pre1So=$_GET['Pre1So'];
		$Pre2So=$_GET['Pre2So'];
		$Pre3So=$_GET['Pre3So'];
		$Pre4So=$_GET['Pre4So'];
		$Pre5So=$_GET['Pre5So'];
		$Pre6So=$_GET['Pre6So'];
		$Def1So=$_GET['Def1So'];
		$Def2So=$_GET['Def2So'];
		$Def3So=$_GET['Def3So'];
		$Def4So=$_GET['Def4So'];
		$Def5So=$_GET['Def5So'];
		$Def6So=$_GET['Def6So'];
		$PlanTerape=$_GET['PlanTerape'];
		$PlanEd=$_GET['PlanEd'];
		$Servicio=$_GET['Servicio'];
		$MedicSo=$_GET['MedicSo'];
		$CodigoMedSo=$_GET['CodigoMedSo'];
		
		echo $aux->SaveSolicitudInterconsulta($InstitucionSys,$UnidadOp2,$CodigoSo,$ParroquiaSo,$CantonSo,$ProvinciaSo,$HistoriaClSo,$ApellidoSo,$NombresSo,$CedulaSo,$FechaAtn,$HoraSo,$EdadSo,$GeneroSo,$EstadoCivSo,$IntruccionSo,$EmpresaSo,$SeguroSaludSo,$EstablecimientoDes,$ServicioCon,$ServicioSo,$SalaSo,$CamaSo,$NormalSo,$UrgenteSo,$MedicoInter,$CuadroClinico,$ResultadoPruebas,$Cie1So,$Cie2So,$Cie3So,$Cie4So,$Cie5So,$Cie6So,$Cod1So,$Cod2So,$Cod3So,$Cod4So,$Cod5So,$Cod6So,$Pre1So,$Pre2So,$Pre3So,$Pre4So,$Pre5So,$Pre6So,$Def1So,$Def2So,$Def3So,$Def4So,$Def5So,$Def6So,$PlanTerape,$PlanEd,$Servicio,$MedicSo,$CodigoMedSo,$CodpacCduIn1);
	}
	//fin save solicitud interconsulta
	
	//generar form solicitud interconsulta
	if($accion=="GenerarSolicitudInterco")
	{
		$CodigoPacInt1=$_GET['CodigoPacInt1'];
		echo $aux->LoadAllSolicitudInterco($CodigoPacInt1);
	}
	//fin generar form solicitud interconsulta
	
	//finalizar solicitud interconsulta
	if($accion=="FinalizarSolicitudIn")
	{
		$idSolictd=$_GET['idSolictd'];
		$MedSolctd=$_GET['MedSolctd'];
		echo $aux->FinalizarSolicInterconsulta($idSolictd,$MedSolctd);
	}
	//fin finalizar solicitud interconsulta
	
	//nueva solicitud interconsulta
	if($accion=="CreateNewSolicInt")
	{
		$IdPacienteSoIn=$_GET['IdPacienteSoIn'];
		echo $aux->NuevaSolicitudInterc($IdPacienteSoIn);
	}
	//fin nueva solicitud interconsulta
	
	//save informe interconsulta
	if($accion=="SaveInformeInCo")
	{
		$CodpacCduIn2=$_GET['CodpacCduIn2'];
		$InstitucionInfo=$_GET['InstitucionInfo'];
		$UnidadOpInfo=$_GET['UnidadOpInfo'];
		$CodInfo=$_GET['CodInfo'];
		$ParroqInfo=$_GET['ParroqInfo'];
		$CanInfo=$_GET['CanInfo'];
		$ProviInfo=$_GET['ProviInfo'];
		$HistoclInfo=$_GET['HistoclInfo'];
		$CuadrocliInfo=$_GET['CuadrocliInfo'];
		$PruebasdiInfo=$_GET['PruebasdiInfo'];
		$Diagnostico1=$_GET['Diagnostico1'];
		$Diagnostico2=$_GET['Diagnostico2'];
		$Diagnostico3=$_GET['Diagnostico3'];
		$Diagnostico4=$_GET['Diagnostico4'];
		$Diagnostico5=$_GET['Diagnostico5'];
		$Diagnostico6=$_GET['Diagnostico6'];
		$Codcie1=$_GET['Codcie1'];
		$Codcie2=$_GET['Codcie2'];
		$Codcie3=$_GET['Codcie3'];
		$Codcie4=$_GET['Codcie4'];
		$Codcie5=$_GET['Codcie5'];
		$Codcie6=$_GET['Codcie6'];
		$Pre1Info=$_GET['Pre1Info'];
		$Pre2Info=$_GET['Pre2Info'];
		$Pre3Info=$_GET['Pre3Info'];
		$Pre4Info=$_GET['Pre4Info'];
		$Pre5Info=$_GET['Pre5Info'];
		$Pre6Info=$_GET['Pre6Info'];
		$Def1Info=$_GET['Def1Info'];
		$Def2Info=$_GET['Def2Info'];
		$Def3Info=$_GET['Def3Info'];
		$Def4Info=$_GET['Def4Info'];
		$Def5Info=$_GET['Def5Info'];
		$Def6Info=$_GET['Def6Info'];
		$PlanteInfo=$_GET['PlanteInfo'];
		$PlanedInfo=$_GET['PlanedInfo'];
		$ResumencInfo=$_GET['ResumencInfo'];
		$ServiceInfo=$_GET['ServiceInfo'];
		$MedicInfo=$_GET['MedicInfo'];
		$CodmedInfo=$_GET['CodmedInfo'];
		
		echo $aux->SaveInformeInterconsulta($InstitucionInfo,$UnidadOpInfo,$CodInfo,$ParroqInfo,$CanInfo,$ProviInfo,$HistoclInfo,$CuadrocliInfo,$PruebasdiInfo,$Diagnostico1,$Diagnostico2,$Diagnostico3,$Diagnostico4,$Diagnostico5,$Diagnostico6,$Codcie1,$Codcie2,$Codcie3,$Codcie4,$Codcie5,$Codcie6,$Pre1Info,$Pre2Info,$Pre3Info,$Pre4Info,$Pre5Info,$Pre6Info,$Def1Info,$Def2Info,$Def3Info,$Def4Info,$Def5Info,$Def6Info,$PlanteInfo,$PlanedInfo,$ResumencInfo,$ServiceInfo,$MedicInfo,$CodmedInfo,$CodpacCduIn2);
	}
	//fin save informe interconsulta
	
	//load all datos informe interconsulta
	if($accion=="GenerarInformeInterco")
	{
		$CodigoPacInt2=$_GET['CodigoPacInt2'];
		echo $aux->LoadAllDatosInformeInterco($CodigoPacInt2);
		
	}
	//fin load all datos informe interconsulta
	
	//finalizar informe
	if($accion=="FinalizarInformeIn")
	{
		$idInforme=$_GET['idInforme'];
		$MedInforme=$_GET['MedInforme'];
		echo $aux->FinalizarInformeInterco($idInforme,$MedInforme);
	}
	//fin finalizar informe
	
	//nuevo informe
	if($accion=="CreateNewInformeInt")
	{
		$IdPacienteInfoIn=$_GET['IdPacienteInfoIn'];
		echo $aux->NewInformeInterco($IdPacienteInfoIn);
	}
	//fin nuevo informe
	//cargar archivos de los pacientes
	if ($accion=="LoadFilePaciente") {
		$IdPacienteInfoIn=$_GET['IdPacienteInfoIn'];
		echo $aux1->AllUPLoadFileOFPac($IdPacienteInfoIn);

	}
	//fin cargar archivos de los pacientes 
	//se presenta toda la historia del pacente a traves de un conte de archivos  estos archivos estan en pdf
	if ($accion=="HistoriTotalPdf") {
		$CdPacToPDF=$_GET['CdPacToPDF'];
		echo $aux1->AllUPLoadFileOFPac($CdPacToPDF);
	}
	//end se presenta toda la historia del pacente a traves de un conte de archivos  estos archivos estan en pdf
	if ($accion=="SeeAllListaAnamnesis") {
		$PacietId=$_GET['PacietId'];
		echo $aux1->AllAnamesis($PacietId);
	}
	if ($accion=="SeeAllListaEpicrisis") {
		$PacietId=$_GET['PacietId'];
		echo $aux1->AllEpicrisis($PacietId);
	}
	if ($accion=="LoadAgendaCirugia") {
		$aa=$_GET['aa'];
		$mm=$_GET['mm'];
		echo $aux1->AgendaCirugiaPorMes($aa,$mm);
	}
	if ($accion=="LoadAgendaCirugia2") {
		$aa=$_GET['aa'];
		$mm=$_GET['mm'];
		echo $aux1->AgendaCirugiaPorMes2($aa,$mm);
	}
	if ($accion=="LoadCitaAgendaCirugia") {
		$code=$_GET['code'];
		echo $aux1->LoadCitaSelecionada($code);
	}
	if ($accion=="LoadCitaAgendaCirugia2") {
		$code=$_GET['code'];
		echo $aux1->LoadCitaSelecionada2($code);
	}
	if ($accion=="UpDateCitCir") {
		$code=$_GET['code'];
		$esta=$_GET['esta'];
		echo $aux1->UpdateEstadoCitaCirug($code,$esta);
	}
	
	// --------------------------------------- modulo adm 1 ---------------------------------------------//
	
	//modal nevo medico
	if($accion=="NewMedico")
	{
		echo $aux1->ModalNewMedic();
	}
	//fin modal nevo medico
	
	//save new medico
	if($accion=="SaveNuevoMed")
	{
		$CedMed=$_GET['CedMed'];
		$ApellidosMed=$_GET['ApellidosMed'];
		$NombresMed=$_GET['NombresMed'];
		$EdadMed=$_GET['EdadMed'];
		$DireccionMed=$_GET['DireccionMed'];
		$UsuarioMed=$_GET['UsuarioMed'];
		$PasswordMed=$_GET['PasswordMed'];
		$EspecMed=$_GET['EspecMed'];
		$LibroMed=$_GET['LibroMed'];
		$FolioMed=$_GET['FolioMed'];
		$NumeroMed=$_GET['NumeroMed'];
		echo $aux1->SaveNewMedicos($CedMed,$ApellidosMed,$NombresMed,$EdadMed,$UsuarioMed,$PasswordMed,$DireccionMed,$EspecMed,$LibroMed,$FolioMed,$NumeroMed);
	}
	//fin save new medico
	
	//modificar usuario
	if($accion=="UpdateMedico")
	{
		$CodigoMed=$_GET['CodigoMed'];
		$CedulaMed2=$_GET['CedulaMed2'];
		$ApellidosMed2=$_GET['ApellidosMed2'];
		$NombresMed2=$_GET['NombresMed2'];
		$EdadMed2=$_GET['EdadMed2'];
		$DireccionMed2=$_GET['DireccionMed2'];
		$UsuarioMed2=$_GET['UsuarioMed2'];
		$PasswordMed2=$_GET['PasswordMed2'];
		$EspecMed2=$_GET['EspecMed2'];
		$LibroMed2=$_GET['LibroMed2'];
		$FolioMed2=$_GET['FolioMed2'];
		$NumeroMed2=$_GET['NumeroMed2'];
		echo $aux1->ModifyUser($CedulaMed2,$ApellidosMed2,$NombresMed2,$EdadMed2,$UsuarioMed2,$PasswordMed2,$DireccionMed2,$EspecMed2,$LibroMed2,$FolioMed2,$NumeroMed2,$CodigoMed);
	}
	//fin modificar usuario
	
	/*eliminar user
	if($accion=="DeleteUserMed")
	{
		$CodMed09=$_GET['CodMed09'];
		echo $aux1->DelUserMed($CodMed09);
	}
	//fin eliminar user */
	
	//delete user medico
	if($accion=="ConfirmarDeleteUser")
	{
		$IDUser=$_GET['IDUser'];
		echo $aux1->DeleteUser($IDUser);
	}
	//fin delete user med
	
	//cargar todos los archivos finalizados
	if ($accion=="LoadFinalizaall") {
		echo $aux1->DocumentosFinalizados();
	}
	//fin para cargar todos los archivos finalizados
	//cargar adm
	if ($accion=="LoadAllAdms") {
		echo $aux1->AllAdms("");
	}
	if ($accion=="LoadAllAdm1s") {
		$buscar=$_GET['buscar'];
		echo $aux1->AllAdms($buscar);
	}
	if ($accion=="LoadDataAdm") {
		$CodAdm=$_GET['CodAdm'];
		echo $aux1->LoadDataAdm($CodAdm);
	}
	if ($accion=="SaveNuevoAdm") {
		$CedADm=$_GET['CedADm'];
		$Apellidosadm=$_GET['Apellidosadm'];
		$Nombresadm=$_GET['Nombresadm'];
		$Edadadm=$_GET['Edadadm'];
		$Direccionadm=$_GET['Direccionadm'];
		$Usuarioadm=$_GET['Usuarioadm'];
		$Passwordadm=$_GET['Passwordadm'];
		$Especadm=$_GET['Especadm'];
		$codeadm=$_GET['codeadm'];
		echo $aux1->UpdateAdministrador($CedADm,$Apellidosadm,$Nombresadm,$Edadadm,$Usuarioadm,$Passwordadm,$Direccionadm,$Especadm,$codeadm);

	}
	if ($accion=="NewAdm") {
		$CedADm=$_GET['CedADm'];
		$Apellidosadm=$_GET['Apellidosadm'];
		$Nombresadm=$_GET['Nombresadm'];
		$Edadadm=$_GET['Edadadm'];
		$Direccionadm=$_GET['Direccionadm'];
		$Usuarioadm=$_GET['Usuarioadm'];
		$Passwordadm=$_GET['Passwordadm'];
		$Especadm=$_GET['Especadm'];
		echo $aux1->SaveNewADm($CedADm,$Apellidosadm,$Nombresadm,$Edadadm,$Usuarioadm,$Passwordadm,$Direccionadm,$Especadm);
	}
	//cargar adm
	//todos los metodos cargar secretarias o residentes
	if($accion=="LoadSecreR"){
		echo $aux1->LOadAllSecreR("");
	}
	if ($accion=="LoadDataSecreR") {
		$CodSecreR=$_GET['CodSecreR'];
		echo $aux1->LoadDataSecreR($CodSecreR);
	}
	if($accion=="SaveNuevosecreR"){
		$CedsecreR=$_GET['CedsecreR'];
		$ApellidossecreR=$_GET['ApellidossecreR'];
		$NombressecreR=$_GET['NombressecreR'];
		$EdadsecreR=$_GET['EdadsecreR'];
		$DireccionsecreR=$_GET['DireccionsecreR'];
		$UsuariosecreR=$_GET['UsuariosecreR'];
		$PasswordsecreR=$_GET['PasswordsecreR'];
		$codesecreR=$_GET['codesecreR'];
		echo $aux1->UpdateSecreR($CedsecreR,$ApellidossecreR,$NombressecreR,$EdadsecreR,$UsuariosecreR,$PasswordsecreR,$DireccionsecreR,$codesecreR);
	}
	if ($accion=="LoadAllsecreR1") {
		$buscar=$_GET['buscar'];
		echo $aux1->LOadAllSecreR($buscar);
	}
	if($accion=="NewsecreR3"){
		$CedsecreR3=$_GET['CedsecreR3'];
		$ApellidossecreR3=$_GET['ApellidossecreR3'];
		$NombressecreR3=$_GET['NombressecreR3'];
		$EdadsecreR3=$_GET['EdadsecreR3'];
		$DireccionsecreR3=$_GET['DireccionsecreR3'];
		$UsuariosecreR3=$_GET['UsuariosecreR3'];
		$PasswordsecreR3=$_GET['PasswordsecreR3'];
		echo $aux1->SaveNewSecreR($CedsecreR3,$ApellidossecreR3,$NombressecreR3,$EdadsecreR3,$UsuariosecreR3,$PasswordsecreR3,$DireccionsecreR3);
	}
	//fin todos los metodos cargar secretarias o residentes
	//todo metodos para digitador
	if ($accion=="LoadDigF") {
		echo $aux1->LOadAllDigF("");
	}
	if ($accion=="LoadDataDigF") {
		$CodDigF=$_GET['CodDigF'];
		echo $aux1->LoadDataDigF($CodDigF);
	}
	if($accion=="SaveNuevoDigF"){
		$CedDigF=$_GET['CedDigF'];
		$ApellidosDigF=$_GET['ApellidosDigF'];
		$NombresDigF=$_GET['NombresDigF'];
		$EdadDigF=$_GET['EdadDigF'];
		$DireccionDigF=$_GET['DireccionDigF'];
		$UsuarioDigF=$_GET['UsuarioDigF'];
		$PasswordDigF=$_GET['PasswordDigF'];
		$codeDigF=$_GET['codeDigF'];
		echo $aux1->UpdateSecreR($CedDigF,$ApellidosDigF,$NombresDigF,$EdadDigF,$UsuarioDigF,$PasswordDigF,$DireccionDigF,$codeDigF);
	}
	if ($accion=="LoadAllDigF1") {
		$buscar=$_GET['buscar'];
		echo $aux1->LOadAllDigF($buscar);
	}
	if ($accion=="NewDigF") {
		$CedDigF=$_GET['CedDigF'];
		$ApellidosDigF=$_GET['ApellidosDigF'];
		$NombresDigF=$_GET['NombresDigF'];
		$EdadDigF=$_GET['EdadDigF'];
		$DireccionDigF=$_GET['DireccionDigF'];
		$UsuarioDigF=$_GET['UsuarioDigF'];
		$PasswordDigF=$_GET['PasswordDigF'];
		echo $aux1->SaveNewDigF($CedDigF,$ApellidosDigF,$NombresDigF,$EdadDigF,$UsuarioDigF,$PasswordDigF,$DireccionDigF);

	}
	//fin todos los metodos para digitador
	
	// --------------------- Medicamentos --------------------- //
	
	//Epicrisis
	if($accion=="VademecunCargar22")
	{
		//$desc=$_GET['desc'];
		echo $aux->VademecunDoc22();
	}
	
	if($accion=="recetarvademecun2")
	{
		$codvade2=$_GET['codvade2'];
		echo $aux->codvademecun2($codvade2);
	}
	
	//Solicitud interconsulta
	if($accion=="VademecunCargar3")
	{
		//$desc=$_GET['desc'];
		echo $aux->VademecunDoc3();
	}
	
	if($accion=="recetarvademecun3")
	{
		$codvade3=$_GET['codvade3'];
		echo $aux->codvademecun3($codvade3);
	}
	
	//Informe interconsulta
	if($accion=="VademecunCargar4")
	{
		//$desc=$_GET['desc'];
		echo $aux->VademecunDoc4();
	}
	
	if($accion=="recetarvademecun4")
	{
		$codvade4=$_GET['codvade4'];
		echo $aux->codvademecun4($codvade4);
	}
	
	//Subsecuente
	if($accion=="VademecunCargar5")
	{
		//$desc=$_GET['desc'];
		echo $aux->VademecunDoc5();
	}
	
	if($accion=="recetarvademecun5")
	{
		$codvade5=$_GET['codvade5'];
		echo $aux->codvademecun5($codvade5);
	}
	
	//Fin medicamentos

	/*
		logica para el protocolo opertatorio
	*/	
		if ($accion=="LoadCitasCirugiaXDoc") {
			echo $aux2->LoadCitasCirugiaXDoc();
		}

	/*
		fin logica para el protocolo opertatorio
	*/	
	
	//delete pacientes 2
	if($accion=="ConfirmarDeletePaciente")
	{
		$IDPaciente=$_GET['IDPaciente'];
		echo $aux1->deletePaciente2($IDPaciente);
	}
	//fin delete pacientes 2
	if ($accion=="ModificarCitaCiruPOrAdmDow") {
		$CitaCirCode=$_GET['CitaCirCode'];
		echo $aux2->ModificarCitaCiruPOrAdmDow($CitaCirCode);
	}

	if ($accion=="HorariosCirugia") {
        $fecha=$_GET['fecha'];
        echo $aux2->HoraCirugia($fecha);
    }
	
	//Altas y bajas Anestesiologo
	
	if($accion=="NewAnest")
	{
		$CedAn=$_GET['CedAn'];
		$ApellidosAn=$_GET['ApellidosAn'];
		$NombresAn=$_GET['NombresAn'];
		$EdadAn=$_GET['EdadAn'];
		$DireccionAn=$_GET['DireccionAn'];
		$UsuarioAn=$_GET['UsuarioAn'];
		$PasswordAn=$_GET['PasswordAn'];
		echo $aux1->SaveNewAn($CedAn,$ApellidosAn,$NombresAn,$EdadAn,$DireccionAn,$UsuarioAn,$PasswordAn);
	}
	
	
	if ($accion=="SearchDataAn") {
		$Anestesiologo=$_GET['Anestesiologo'];
		echo $aux1->LoadDataAnestesia($Anestesiologo);
	}
	
	if($accion=="LoadAllAnest"){
		echo $aux1->LOadAllAn("");
	}
	
	if ($accion=="LoadActAnestesia") {
		$CodAnestesiologo=$_GET['CodAnestesiologo'];
		echo $aux1->LoadModifyAn($CodAnestesiologo);
	}
	
	if($accion=="ModifyAn"){
		$CedAnes=$_GET['CedAnes'];
		$ApellidosAnes=$_GET['ApellidosAnes'];
		$NombresAnes=$_GET['NombresAnes'];
		$EdadAnes=$_GET['EdadAnes'];
		$DireccionAnes=$_GET['DireccionAnes'];
		$UsuarioAnes=$_GET['UsuarioAnes'];
		$PasswordAnes=$_GET['PasswordAnes'];
		$codeAnes=$_GET['codeAnes'];
		echo $aux1->UpdateAnestesia($CedAnes,$ApellidosAnes,$NombresAnes,$EdadAnes,$UsuarioAnes,$PasswordAnes,$DireccionAnes,$codeAnes);
	}
	
	if($accion=="ConfirmarDeleteAn")
	{
		$IDUserAn=$_GET['IDUserAn'];
		echo $aux1->DeleteUserAn($IDUserAn);
	}
	
	//Fin Altas y bajas Anestesiologo

	if($accion=="ComprovandoCIDB"){
		$CedulaPac1=$_GET['CedulaPac1'];
		echo $aux2->ComprobarCI($CedulaPac1);
	}
	
	if($accion=="ComprovandoCIDBMed"){
		$CedulaMed1=$_GET['CedulaMed1'];
		echo $aux2->ComprobarCIMed($CedulaMed1);
	}
	
	if ($accion=="BorrarPacenteXCOde") {
		$CodigoPaciente=$_GET['CodigoPaciente'];
		echo $aux2->BorrarPacenteXCOde($CodigoPaciente);
	}

	if ($accion=="FRmCrearCita2") {
		$pacientcod=$_GET['pacientcod'];
		echo $aux1->Frm2Cita2($pacientcod);
	}
	if ($accion=="HorasCitaMedica02") {
		$fecha=$_GET['fecha'];
		echo $aux2->HoraCitaMedica($fecha);
	}


	//agenda de citas 2 
	if ($accion=="BuscarMedico002") {
		$Buscar=$_GET['Buscar'];
		echo $aux2->BuscarMedico002($Buscar,1);
	}
	if ($accion=="BuscarMedico003") {
		$Buscar=$_GET['Buscar'];
		echo $aux2->BuscarMedico002($Buscar,2);
	}
	if($accion=="CargarHoras2")
	{
		$fechaC=$_GET['fechaC'];
		$Doctor=$_GET['Doctor'];
		echo $aux2->cargarhorario2($fechaC,$Doctor);
	}
	if($accion=="BuscarCitasMedicoXFechas"){
		$IDDOc=$_GET['IDDOc'];
		$FechaI=$_GET['FechaI'];
		$FechaF=$_GET['FechaF'];
		echo $aux2->BuscarCitasMedicoXFechas($IDDOc,$FechaI,$FechaF);
	}
	if($accion=="BuscarDiaMedicoCita"){
		$IDDOc=$_GET['IDDOc'];
		$FechaI=$_GET['FechaI'];
		
		echo $aux2->BuscarDiaMedicoCita($IDDOc,$FechaI);
	}


	if($accion=="BuscadorCitasXMes"){
		$IDDOc=$_GET['IDDOc'];
		$mes=$_GET['mes'];
		
		echo $aux2->BuscadorCitasXMes($IDDOc,$mes);
	}
	if ($accion=="HistorialSolicitudInterconsulta") {
		$codePac=$_GET['codePac'];
		echo $aux1->HistorialSolicitudInterconsulta($codePac);
	}
	if ($accion=="HistorialInfoInterconsulta") {
		$codePac=$_GET['codePac'];
		echo $aux1->HistorialInfoInterconsulta($codePac);
	}
	if ($accion=="FechaVencimeitoAutorizacion") {
		$date=$_GET['date'];
		echo $aux2->FechaVencimeitoAutorizacion($date);
	}
	//COMPROBARA FECHA DE VENCIMIENTO 
	if($accion=="ComprobarFechavencimiento"){
		$IDPAC=$_GET['IDPAC'];
		echo $aux2->ComprobarFechavencimiento($IDPAC);
	}
	//fin COMPROBARA FECHA DE VENCIMIENTO 

	/*modificar cita medica*/
	if($accion=="ModificarCitaMedicav1"){
		$CodigoTurno=$_GET["CodigoTurno"];
		echo $aux2->ModificarCitaMedica($CodigoTurno);
	}
	if($accion=="MoficarCitaMedica")
	{
		$Paciente1=$_GET['Paciente1'];
		$Especialidad1=$_GET['Especialidad1'];
		$Doctor1=$_GET['Doctor1'];
		$fechaC1=$_GET['fechaC1'];
		$hora1=$_GET['hora1'];
		$codigoTurno=$_GET["codigoTurno"];
		echo $aux2->GuardarCambiosCitaMedica($Paciente1,$Especialidad1,$Doctor1,$fechaC1,$hora1,$codigoTurno);
	}
	/*modificar cita medica*/

	if($accion=="BuscadorCitasCirugiaXPac"){
		$Buscar=$_GET['Buscar'];
		$rol=$_GET['rol'];
		echo $aux2->BuscadorCitasCirugiaXPac($Buscar,$rol);
	}
	if($accion=="BuscadorCitasCirugiaXPac2"){
		$Buscar=$_GET['Buscar'];
		$rol=$_GET['rol'];
		echo $aux2->BuscadorCitasCirugiaXPac($Buscar,$rol);
	}
	if($accion=="BuscadorCitasCirugiaXPacParaIniProto"){
		$Buscar=$_GET['Buscar'];
		$rol=$_GET['rol'];
		echo $aux2->BuscadorCitasCirugiaXPac($Buscar,$rol);
	}

	/*Makeprotocollo operatorio*/
	if($accion=="LoadINIProtcoOP"){
		$Id=$_GET["Id"];
		$rol=$_GET["rol"];
		echo $aux2->MakeProtocoloOPeratorio($Id,$rol);
	}
	if($accion=="BuscadorGeneralMedicos"){
		$buscar=$_GET['buscar'];
		$re=$_GET['re'];
		$rol=$_GET['rol'];
		echo $aux2->BuscadorGeneralMedicos($buscar,$re,$rol);
	}
	if($accion=="BuscadorGeneralIess"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarCodigoIess($buscar,$rol);
	}
	if($accion=="BuscadorGeneralIess2"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarCodigoIess2($buscar,$rol);
	}
	if($accion=="BuscadorGeneralIess3"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarCodigoIess3($buscar,$rol);
	}
	if($accion=="SaveProtocolo"){
		$idcitacir=$_GET['idcitacir'];
		$servicio=$_GET['servicio'];
		$postoperatorio=$_GET['postoperatorio'];
		$cirugiaefectuada=$_GET['cirugiaefectuada'];
		$anestesiologo=$_GET['anestesiologo'];
		$coocirujano=$_GET['coocirujano'];
		$inistrumentista=$_GET['inistrumentista'];
		$primerayudante=$_GET['primerayudante'];
		$circulante=$_GET['circulante'];
		$segndoayudante=$_GET['segndoayudante'];
		$datecirugia=$_GET['datecirugia'];
		$anestesia=$_GET['anestesia'];
		$hora=$_GET['hora'];
		$tiempoquirugico=$_GET['tiempoquirugico'];
		$hallasgos=$_GET['hallasgos'];
		$procedimiento=$_GET['procedimiento'];
		$preparadopor=$_GET['preparadopor'];
		$datefecha2=$_GET['datefecha2'];
		$datefecha3=$_GET['datefecha3'];
		$cirujano=$_GET['cirujano'];
		$preop=$_GET['preop'];
		$hf=$_GET['hf'];
		$complicaciones=$_GET['complicaciones'];
		$sangrado=$_GET['sangrado'];
		$histopatologico=$_GET['histopatologico'];
		$ecografista=$_GET['ecografista'];
		$preopaux2=$_GET['preopaux2'];
		$preopaux3=$_GET['preopaux3'];
		$postopaux2=$_GET['postopaux2'];
		$postopaux3=$_GET['postopaux3'];
		$ciruefaux2=$_GET['ciruefaux2'];
		$ciruefaux3=$_GET['ciruefaux3'];
		$cirujano3=$_GET['cirujano3'];
		$dgnhispatologia=$_GET['dgnhispatologia'];
		// echo "<pre>";
		// print_r($_REQUEST);
		// echo "</pre>";
		echo $aux2->SaveProtocoloOperatorio($idcitacir,$servicio,$postoperatorio,$cirugiaefectuada,$anestesiologo,$coocirujano,$inistrumentista,$primerayudante,$circulante,$segndoayudante,$datecirugia,$anestesia,$hora,$tiempoquirugico,$hallasgos,$procedimiento,$preparadopor,$datefecha2,$datefecha3,$cirujano,$preop,$hf,$complicaciones,$sangrado,$histopatologico,$ecografista,$preopaux2,$preopaux3,$postopaux2,$postopaux3,$ciruefaux2,$ciruefaux3,$cirujano3,$dgnhispatologia);

	}
	if($accion=="ModifyOkProtocoOperatorio"){
		$idprotocolo=$_GET['idprotocolo'];
		$servicio=$_GET['servicio'];
		$postoperatorio=$_GET['postoperatorio'];
		$cirugiaefectuada=$_GET['cirugiaefectuada'];
		$anestesiologo=$_GET['anestesiologo'];
		$coocirujano=$_GET['coocirujano'];
		$inistrumentista=$_GET['inistrumentista'];
		$primerayudante=$_GET['primerayudante'];
		$circulante=$_GET['circulante'];
		$segndoayudante=$_GET['segndoayudante'];
		$datecirugia=$_GET['datecirugia'];
		$anestesia=$_GET['anestesia'];
		$hora=$_GET['hora'];
		$tiempoquirugico=$_GET['tiempoquirugico'];
		$hallasgos=$_GET['hallasgos'];
		$procedimiento=$_GET['procedimiento'];
		$preparadopor=$_GET['preparadopor'];
		$datefecha2=$_GET['datefecha2'];
		$datefecha3=$_GET['datefecha3'];
		$cirujano=$_GET['cirujano'];
		$preop=$_GET['preop'];
		$hf=$_GET['hf'];
		$complicaciones=$_GET['complicaciones'];
		$sangrado=$_GET['sangrado'];
		$histopatologico=$_GET['histopatologico'];
		$ecografista=$_GET['ecografista'];
		$preopaux2=$_GET['preopaux2'];
		$preopaux3=$_GET['preopaux3'];
		$postopaux2=$_GET['postopaux2'];
		$postopaux3=$_GET['postopaux3'];
		$ciruefaux2=$_GET['ciruefaux2'];
		$ciruefaux3=$_GET['ciruefaux3'];
		$cirujano3=$_GET['cirujano3'];
		$dgnhispatologia=$_GET['dgnhispatologia'];
		echo $aux2->ModifyOkProtocoOperatorio($idprotocolo,$servicio,$postoperatorio,$cirugiaefectuada,$anestesiologo,$coocirujano,$inistrumentista,$primerayudante,$circulante,$segndoayudante,$datecirugia,$anestesia,$hora,$tiempoquirugico,$hallasgos,$procedimiento,$preparadopor,$datefecha2,$datefecha3,$cirujano,$preop,$hf,$complicaciones,$sangrado,$histopatologico,$ecografista,$preopaux2,$preopaux3,$postopaux2,$postopaux3,$ciruefaux2,$ciruefaux3,$cirujano3,$dgnhispatologia);

	}
	if ($accion=="CalcularHora") {
		$HI=$_GET['HI'];
		$HF=$_GET['HF'];
		echo $aux2->CalcularHora($HI,$HF);
	}
	if ($accion=="AprobarProtocoloOpertatorio") {
		$IDPOP=$_GET['IDPOP'];
		echo $aux2->AprobarProtocoloOpertatorio($IDPOP);
	}
	if($accion=="ListaProtocolooperatorio"){
		$IDUSER=$_GET['IDUSER'];
		echo $aux2->ListaProtocolooperatorio($IDUSER);
	}
	/*Makeprotocollo operatorio*/

	/*emergencia*/
	if ($accion=="FrmMkEmergenciaIni") {
		$ID=$_GET['ID'];
		echo $aux2->FrmMkEmergenciaIni($ID);
	}
	/*emergencia*/ 
	
	if($accion=="DataEnf")
	{
		echo $aux->DataEnfermera();
	}
	


	if($accion=="PRUEBASQL"){
		echo $aux2->Prueba();
	}


	//buscar medico para asignacion
	if ($accion=="BuscarMedico005") {
		$Buscar=$_GET['Buscar'];
		echo $aux2->BuscarMedico002($Buscar,3);
	}

	if($accion=="BuscarCitasMedicoXSemanaDesing"){
		$IDDOc=$_GET['IDDOc'];
		$FechaI=$_GET['FechaI'];
		echo $aux2->CargarVistaCitasPorSemana($FechaI,$IDDOc);
	}
	if($accion=="LoadDataCi") {
		$IDCita=$_GET["IDCita"];
		echo $aux2->LoadDataCi($IDCita);
	}
	if($accion=="CloseWindows"){
		echo $aux2->CloseWindows();
	}










	//angular
	if($accion=="DataProtocoloP"){
		echo $aux2->DATAPROTOCOLO(7);
	}
	if($accion=="DataHoro"){
		echo $aux2->DATAHORA();
	}
	
	if ($accion=="AddNuevoProtocolo") {
		echo $aux2->AddNuevoProtocolo();	
	}
	if ($accion=="DataCirugia") {
		$Buscar=$_GET["Buscar"];
		echo $aux2->DataCirugia($Buscar);
	}
	if ($accion=="DataMeduci") {
		$Buscar=$_GET["Buscar"];
		echo $aux2->BuscadorDataGeneralMedicos($Buscar);
	}
	if ($accion=="CalcularHour") {
		$I=$_GET["I"];
		$F=$_GET["F"];
		echo $aux2->CalcularHora2($I,$F);
	}
	//fn angular

	//actualizando procesos por angular
	if ($accion=="DataHPaciente") {
		$Buscar=$_GET["Buscar"];
		echo $aux3->DataHPaciente($Buscar);
	}
	if ($accion=="InfoPaciente") {
		//$PACIENTE=$_GET["PACIENTE"];
		echo $aux3->DataHistoriaPaciente();
	}
	if ($accion=="ArchivosXPaciente") {
		$PACIENTE=$_GET["PACIENTE"];
		$Archivo=$_GET["Archivo"];
		echo $aux3->VerFileXPaciente($PACIENTE,$Archivo);
	}

	//altas y bajas administrador
	if ($accion=="DataAdm") {
		$Buscar=$_GET['Buscar'];
		echo $aux3->BuscarAdm($Buscar);
	}
	if ($accion=="SaveChangeAdmin") {
		echo $aux3->SaveChangeAdmin();
	}
	if($accion=="DeleteUserAdmin") {
		echo $aux3->DeleteUserAdmin();	
	}
	//altas y bajas administrador
	if ($accion=="DataSecRece") {
		$Buscar=$_GET['Buscar'];
		echo $aux3->BuscarSecRece($Buscar);
	}
	if ($accion=="SaveChangeSecRecep") {
		echo $aux3->SaveVariosUsers();
	}
	//altas y bajas digitador
	if ($accion=="DataDigitador") {
		$Buscar=$_GET['Buscar'];
		echo $aux3->DataDigitador($Buscar);
	}
	if ($accion=="DataTimeCitasNormales") {
		$Fecha=$_GET["Fecha"];
		$IDMedico=$_GET["IDMedico"];
		echo $aux3->DataTimeCitasNormales($Fecha,$IDMedico);
	}
	if ($accion=="AddNuevoCitaOTurno") {
		echo $aux3->GenerarTurnoOCita();
	}
	if ($accion=="BuscarCitaMedico") {
		$Medico=$_GET["Medico"];
		$Fecha=$_GET["Fecha"];
		$Fecha2=$_GET["Fecha2"];
		$Control=$_GET["Control"];
		echo $aux3->BuscarCitaMedico($Medico,$Fecha,$Fecha2,$Control);
	}
	if ($accion=="CitaSemana") {
		$Medico=$_GET["Medico"];
		$Fecha=$_GET["Fecha"];
		echo $aux3->CargarVistaCitasPorSemana2($Fecha,$Medico);
	}

	//Diagnostico pre-operatorio Aux2
	if($accion=="BuscadorGeneralIessAux2"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarCodigoIess3Aux2($buscar,$rol);
	}


	//Diagnostico pre-operatorio Aux3
	if($accion=="BuscadorGeneralIessAux3"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarCodigoIess3Aux3($buscar,$rol);
	}


	//Diagnostico post-operatorio Aux2
	if($accion=="BuscadorPostAux2"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarPostOpAux2($buscar,$rol);
	}


	//Diagnostico post-operatorio Aux3
	if($accion=="BuscadorPostAux3"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarPostOpAux3($buscar,$rol);
	}


	//Cirugia efectuada Aux2
	if($accion=="BuscadorCirgAux2"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarCodigoCirgAux2($buscar,$rol);
	}


	//Cirugia efectuada Aux3
	if($accion=="BuscadorCirgAux3"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarCodigoCirgAux3($buscar,$rol);
	}


	//Diagnostico hispatologia
	if($accion=="BuscadorDiagnHispatologia"){
		$buscar=$_GET["buscar"];
		$rol=$_GET['rol'];
		echo $aux2->BuscarCodigoDiagnHisp($buscar,$rol);
	}
	
	
	

	//Acciones para hospitalización * Author Lesnier Gonzalez
	
	  //Cargar modelo de anamnesis
	if($accion=="LoadAnamnesisHospitali")
	{
		$CodigoPac2=$_GET['CodigoPac2'];
		$Nueva=$_GET['Nueva'];

		echo $aux->LoadAnamnesisHospitali($CodigoPac2,$Nueva);
	}
	
	if($accion=="SaveAnamnesisHospitali")
	{
		$CduPac=$_GET['CduPac'];
		$id_pac=$_GET['id_pac'];
		$MotivoConsA=$_GET['MotivoConsA'];
		$MotivoConsB=$_GET['MotivoConsB'];
		$MotivoConsC=$_GET['MotivoConsC'];
		$MotivoConsD=$_GET['MotivoConsD'];
		$cb_vacunas=$_GET['cb_vacunas'];
		$cb_alergica=$_GET['cb_alergica'];
		$cb_neurologica=$_GET['cb_neurologica'];
		$cb_traumatologica=$_GET['cb_traumatologica'];
		$cb_tendsexual=$_GET['cb_tendsexual'];
		$cb_actsexual=$_GET['cb_actsexual'];
		$cb_perinatal=$_GET['cb_perinatal'];
		$cb_cardiaca=$_GET['cb_cardiaca'];
		$cb_metabolica=$_GET['cb_metabolica'];
		$cb_quirurgica=$_GET['cb_quirurgica'];
		$cb_riesgosocial=$_GET['cb_riesgosocial'];
		$cb_dietahabitos=$_GET['cb_dietahabitos'];
		$cb_infancia=$_GET['cb_infancia'];
		$cb_respiratoria=$_GET['cb_respiratoria'];
		$cb_hemolinf=$_GET['cb_hemolinf'];
		$cb_mental=$_GET['cb_mental'];
		$cb_riesgolaboral=$_GET['cb_riesgolaboral'];
		$cb_religioncultura=$_GET['cb_religioncultura'];
		$cb_adolecente=$_GET['cb_adolecente'];
		$cb_digestiva=$_GET['cb_digestiva'];
		$cb_urinaria=$_GET['cb_urinaria'];
		$cb_tsexual=$_GET['cb_tsexual'];
		$cb_riesgofamiliar=$_GET['cb_riesgofamiliar'];
		$cb_otro=$_GET['cb_otro'];
		$txtAntePer=$_GET['txtAntePer'];
		$cb_cardiopatia=$_GET['cb_cardiopatia'];
		$cb_diabetes=$_GET['cb_diabetes'];
		$cb_enfvasculares=$_GET['cb_enfvasculares'];
		$cb_hta=$_GET['cb_hta'];
		$cb_cancer=$_GET['cb_cancer'];
		$cb_tuberculosis=$_GET['cb_tuberculosis'];
		$cb_enfenfmental=$_GET['cb_enfenfmental'];
		$cb_enfinfecciosa=$_GET['cb_enfinfecciosa'];
		$cb_malformacion=$_GET['cb_malformacion'];
		$cb_afotro=$_GET['cb_afotro'];
		$txtNoRef=$_GET['txtNoRef'];
		$txtProbActual=$_GET['txtProbActual'];
		$cb_1CP=$_GET['cb_1CP'];
		$cb_1SP=$_GET['cb_1SP'];
		$cb_3CP=$_GET['cb_3CP'];
		$cb_3SP=$_GET['cb_3SP'];
		$cb_5CP=$_GET['cb_5CP'];
		$cb_5SP=$_GET['cb_5SP'];
		$cb_7CP=$_GET['cb_7CP'];
		$cb_7SP=$_GET['cb_7SP'];
		$cb_9CP=$_GET['cb_9CP'];
		$cb_9SP=$_GET['cb_9SP'];
		$cb_2CP=$_GET['cb_2CP'];
		$cb_2SP=$_GET['cb_2SP'];
		$cb_4CP=$_GET['cb_4CP'];
		$cb_4SP=$_GET['cb_4SP'];
		$cb_6CP=$_GET['cb_6CP'];
		$cb_6SP=$_GET['cb_6SP'];
		$cb_8CP=$_GET['cb_8CP'];
		$cb_8SP=$_GET['cb_8SP'];
		$cb_10CP=$_GET['cb_10CP'];
		$cb_10SP=$_GET['cb_10SP'];
		$txtRevisOrgs=$_GET['txtRevisOrgs'];
		$ta=$_GET['ta'];
		$fc=$_GET['fc'];
		$fr=$_GET['fr'];
		$sato2=$_GET['sato2'];
		$tempbuc=$_GET['tempbuc'];
		$peso=$_GET['peso'];
		$glucem=$_GET['glucem'];
		$talla=$_GET['talla'];
		$gm=$_GET['gm'];
		$go=$_GET['go'];
		$gv=$_GET['gv'];
		$cb_1RCP=$_GET['cb_1RCP'];
		$cb_1RSP=$_GET['cb_1RSP'];
		$cb_6RCP=$_GET['cb_6RCP'];
		$cb_6RSP=$_GET['cb_6RSP'];
		$cb_11RCP=$_GET['cb_11RCP'];
		$cb_11RSP=$_GET['cb_11RSP'];
		$cb_1SCP=$_GET['cb_1SCP'];
		$cb_1SSP=$_GET['cb_1SSP'];
		$cb_6SCP=$_GET['cb_6SCP'];
		$cb_6SSP=$_GET['cb_6SSP'];
		$cb_2RCP=$_GET['cb_2RCP'];
		$cb_2RSP=$_GET['cb_2RSP'];
		$cb_7RCP=$_GET['cb_7RCP'];
		$cb_7RSP=$_GET['cb_7RSP'];
		$cb_12RCP=$_GET['cb_12RCP'];
		$cb_12RSP=$_GET['cb_12RSP'];
		$cb_2SCP=$_GET['cb_2SCP'];
		$cb_2SSP=$_GET['cb_2SSP'];
		$cb_7SCP=$_GET['cb_7SCP'];
		$cb_7SSP=$_GET['cb_7SSP'];
		$cb_3RCP=$_GET['cb_3RCP'];
		$cb_3RSP=$_GET['cb_3RSP'];
		$cb_8RCP=$_GET['cb_8RCP'];
		$cb_8RSP=$_GET['cb_8RSP'];
		$cb_13RCP=$_GET['cb_13RCP'];
		$cb_13RSP=$_GET['cb_13RSP'];
		$cb_3SCP=$_GET['cb_3SCP'];
		$cb_3SSP=$_GET['cb_3SSP'];
		$cb_8SCP=$_GET['cb_8SCP'];
		$cb_8SSP=$_GET['cb_8SSP'];
		$cb_4RCP=$_GET['cb_4RCP'];
		$cb_4RSP=$_GET['cb_4RSP'];
		$cb_9RCP=$_GET['cb_9RCP'];
		$cb_9RSP=$_GET['cb_9RSP'];
		$cb_14RCP=$_GET['cb_14RCP'];
		$cb_14RSP=$_GET['cb_14RSP'];
		$cb_4SCP=$_GET['cb_4SCP'];
		$cb_4SSP=$_GET['cb_4SSP'];
		$cb_9SCP=$_GET['cb_9SCP'];
		$cb_9SSP=$_GET['cb_9SSP'];
		$cb_5RCP=$_GET['cb_5RCP'];
		$cb_5RSP=$_GET['cb_5RSP'];
		$cb_10RCP=$_GET['cb_10RCP'];
		$cb_10RSP=$_GET['cb_10RSP'];
		$cb_15RCP=$_GET['cb_15RCP'];
		$cb_15RSP=$_GET['cb_15RSP'];
		$cb_5sCP=$_GET['cb_5sCP'];
		$cb_5sSP=$_GET['cb_5sSP'];
		$cb_10sCP=$_GET['cb_10sCP'];
		$cb_10sSP=$_GET['cb_10sSP'];
		$txtExaFisico=$_GET['txtExaFisico'];
		$txtCie1=$_GET['txtCie1'];
		$txtCod1=$_GET['txtCod1'];
		$cb_1PRE=$_GET['cb_1PRE'];
		$cb_1DEF=$_GET['cb_1DEF'];
		$txtCie4=$_GET['txtCie4'];
		$txtCod4=$_GET['txtCod4'];
		$cb_4PRE=$_GET['cb_4PRE'];
		$cb_4DEF=$_GET['cb_4DEF'];
		$txtCie2=$_GET['txtCie2'];
		$txtCod2=$_GET['txtCod2'];
		$cb_2PRE=$_GET['cb_2PRE'];
		$cb_2DEF=$_GET['cb_2DEF'];
		$txtCie5=$_GET['txtCie5'];
		$txtCod5=$_GET['txtCod5'];
		$cb_5PRE=$_GET['cb_5PRE'];
		$cb_5DEF=$_GET['cb_5DEF'];
		$txtCie3=$_GET['txtCie3'];
		$txtCod3=$_GET['txtCod3'];
		$cb_3PRE=$_GET['cb_3PRE'];
		$cb_3DEF=$_GET['cb_3DEF'];
		$txti3=$_GET['txti3'];
		$txtic3=$_GET['txtic3'];
		$cb_6PRE=$_GET['cb_6PRE'];
		$cb_6DEF=$_GET['cb_6DEF'];
		$txtPlanTrat=$_GET['txtPlanTrat'];
		$txtFechaAgendDoct=$_GET['txtFechaAgendDoct'];
		$nombremedico=$_GET['nombremedico'];
		$firmaDoc=$_GET['firmaDoc'];
		$gestion=$_GET['gestion'];
		
	
		if($gestion == 'insertar')
		{
		    echo $aux->SaveAnamnesisHospitalizacion(
		    $CduPac, $id_pac, $MotivoConsA, $MotivoConsB, $MotivoConsC, $MotivoConsD, $cb_vacunas, $cb_alergica, $cb_neurologica, $cb_traumatologica, $cb_tendsexual, $cb_actsexual, $cb_perinatal, $cb_cardiaca, $cb_metabolica, $cb_quirurgica, $cb_riesgosocial, $cb_dietahabitos, $cb_infancia, $cb_respiratoria, $cb_hemolinf, $cb_mental, $cb_riesgolaboral, $cb_religioncultura, $cb_adolecente, $cb_digestiva, $cb_urinaria, $cb_tsexual, $cb_riesgofamiliar, $cb_otro, $txtAntePer, $cb_cardiopatia, $cb_diabetes, $cb_enfvasculares, $cb_hta, $cb_cancer, $cb_tuberculosis, $cb_enfenfmental, $cb_enfinfecciosa, $cb_malformacion, $cb_afotro, $txtNoRef, $txtProbActual, $cb_1CP, $cb_1SP, $cb_3CP, $cb_3SP, $cb_5CP, $cb_5SP, $cb_7CP, $cb_7SP, $cb_9CP, $cb_9SP, $cb_2CP, $cb_2SP, $cb_4CP, $cb_4SP, $cb_6CP, $cb_6SP, $cb_8CP, $cb_8SP, $cb_10CP, $cb_10SP, $txtRevisOrgs, $ta, $fc,$fr, $sato2, $tempbuc, $peso, $glucem, $talla, $gm, $go, $gv, $cb_1RCP, $cb_1RSP, $cb_6RCP, $cb_6RSP, $cb_11RCP, $cb_11RSP, $cb_1SCP, $cb_1SSP, $cb_6SCP, $cb_6SSP, $cb_2RCP, $cb_2RSP, $cb_7RCP, $cb_7RSP, $cb_12RCP, $cb_12RSP, $cb_2SCP, $cb_2SSP, $cb_7SCP, $cb_7SSP, $cb_3RCP, $cb_3RSP, $cb_8RCP, $cb_8RSP, $cb_13RCP, $cb_13RSP, $cb_3SCP, $cb_3SSP, $cb_8SCP, $cb_8SSP, $cb_4RCP, $cb_4RSP, $cb_9RCP, $cb_9RSP, $cb_14RCP, $cb_14RSP, $cb_4SCP, $cb_4SSP, $cb_9SCP, $cb_9SSP, $cb_5RCP, $cb_5RSP, $cb_10RCP, $cb_10RSP, $cb_15RCP, $cb_15RSP, $cb_5sCP, $cb_5sSP, $cb_10sCP, $cb_10sSP, $txtExaFisico, $txtCie1, $txtCod1, $cb_1PRE, $cb_1DEF, $txtCie4, $txtCod4, $cb_4PRE, $cb_4DEF, $txtCie2, $txtCod2, $cb_2PRE, $cb_2DEF, $txtCie5, $txtCod5, $cb_5PRE, $cb_5DEF, $txtCie3, $txtCod3, $cb_3PRE, $cb_3DEF, $txti3, $txtic3, $cb_6PRE, $cb_6DEF, $txtPlanTrat, $txtFechaAgendDoct, $nombremedico, $firmaDoc );
		}
		if($gestion == 'modificar')
		{
          echo $aux->ModifAnamnesisHospitalizacion(
		 $CduPac, $id_pac, $MotivoConsA, $MotivoConsB, $MotivoConsC, $MotivoConsD, $cb_vacunas, $cb_alergica, $cb_neurologica, $cb_traumatologica, $cb_tendsexual, $cb_actsexual, $cb_perinatal, $cb_cardiaca, $cb_metabolica, $cb_quirurgica, $cb_riesgosocial, $cb_dietahabitos, $cb_infancia, $cb_respiratoria, $cb_hemolinf, $cb_mental, $cb_riesgolaboral, $cb_religioncultura, $cb_adolecente, $cb_digestiva, $cb_urinaria, $cb_tsexual, $cb_riesgofamiliar, $cb_otro, $txtAntePer, $cb_cardiopatia, $cb_diabetes, $cb_enfvasculares, $cb_hta, $cb_cancer, $cb_tuberculosis, $cb_enfenfmental, $cb_enfinfecciosa, $cb_malformacion, $cb_afotro, $txtNoRef, $txtProbActual, $cb_1CP, $cb_1SP, $cb_3CP, $cb_3SP, $cb_5CP, $cb_5SP, $cb_7CP, $cb_7SP, $cb_9CP, $cb_9SP, $cb_2CP, $cb_2SP, $cb_4CP, $cb_4SP, $cb_6CP, $cb_6SP, $cb_8CP, $cb_8SP, $cb_10CP, $cb_10SP, $txtRevisOrgs, $ta, $fc, $fr, $sato2, $tempbuc, $peso, $glucem, $talla, $gm, $go, $gv, $cb_1RCP, $cb_1RSP, $cb_6RCP, $cb_6RSP, $cb_11RCP, $cb_11RSP, $cb_1SCP, $cb_1SSP, $cb_6SCP, $cb_6SSP, $cb_2RCP, $cb_2RSP, $cb_7RCP, $cb_7RSP, $cb_12RCP, $cb_12RSP, $cb_2SCP, $cb_2SSP, $cb_7SCP, $cb_7SSP, $cb_3RCP, $cb_3RSP, $cb_8RCP, $cb_8RSP, $cb_13RCP, $cb_13RSP, $cb_3SCP, $cb_3SSP, $cb_8SCP, $cb_8SSP, $cb_4RCP, $cb_4RSP, $cb_9RCP, $cb_9RSP, $cb_14RCP, $cb_14RSP, $cb_4SCP, $cb_4SSP, $cb_9SCP, $cb_9SSP, $cb_5RCP, $cb_5RSP, $cb_10RCP, $cb_10RSP, $cb_15RCP, $cb_15RSP, $cb_5sCP, $cb_5sSP, $cb_10sCP, $cb_10sSP, $txtExaFisico, $txtCie1, $txtCod1, $cb_1PRE, $cb_1DEF, $txtCie4, $txtCod4, $cb_4PRE, $cb_4DEF, $txtCie2, $txtCod2, $cb_2PRE, $cb_2DEF, $txtCie5, $txtCod5, $cb_5PRE, $cb_5DEF, $txtCie3, $txtCod3, $cb_3PRE, $cb_3DEF, $txti3, $txtic3, $cb_6PRE, $cb_6DEF, $txtPlanTrat, $txtFechaAgendDoct, $nombremedico, $firmaDoc );

		}
	
	}
	
		if($accion=="FinalizarAnamnHosp")
	{
		$idAnam=$_GET['idAnam'];
		
		$aux->FinalizarAnamHosp($idAnam);
	}

	if ($accion=="AllAnamesisHospFile") {
		$PacietId=$_GET['PacietId'];
		echo $aux1->AllAnamesisHospFile($PacietId);
	}

}
else
{
	header("Location:../index.php");
}



?>