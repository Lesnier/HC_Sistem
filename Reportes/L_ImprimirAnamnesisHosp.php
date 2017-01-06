<?php 
require_once('pdf/mpdf.php');
include "../Dominio/coneccion.php";
include "../Dominio/AnamnesisCdu.php";
include "../Dominio/EdadConvert.php";
//$html= file_get_contents('ahpdf.html') ;


$codigo = '';

  
	if (isset($_GET["Codigo"])) 
	{
		$codigo = $_GET["Codigo"];

	}
   else
	{
		echo "Problema al recepcionar POST de Impresion";
	}



$aux= new AnamnesisCdu;


$html = "";

					$id_anam_hosp=$aux->Consultar("SELECT MAX(id_anam_hosp) FROM tbl_anamnesis_hosp WHERE id_pac='$codigo'");
					$datos=$aux->Consultar_AnamnesisHosp("SELECT * FROM tbl_anamnesis_hosp WHERE id_anam_hosp='$id_anam_hosp'");
					$nompac=$aux->Consultar("SELECT nombres_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$nompac=utf8_encode($nompac);
					$apepac=$aux->Consultar("SELECT apellidos_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$apepac=utf8_encode($apepac);
					$sexpac=$aux->Consultar("SELECT sexo_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$cedpac=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$fecnacpac=$aux->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo'");
					$edadConvert = new EdadConvert;
			        $edad=$edadConvert->Edad($fecnacpac);			       
                    
					foreach($datos as $fila)
					{
						
					
$html = "<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='utf-8'>
<title>Anamnesis Hopitalización</title>
<!--<link rel='stylesheet' href='style.css' media='all' />-->
</head>
<body>
<header class='clearfix'>
<h2>Anamnesis de Hospitalización</h2>
 <hr>
 
  <div id='subt'><h3>Sistema Nacional de Salud</h3></div>
  <div id='logo'><img src='L_asset/Asset_Print_AnamnesisHosp/pdflogo.jpg'> </div> 

</header>
<main>
  <table >
    <thead>
      <tr>
        <th  colspan='36' scope='col' ><center>
          <strong>  LITOTRIFAST CLINICA DE UROLOGIA</strong>
          </center></th>
      </tr>
    </thead>
    <tbody>
      <tr align='center' >
        <td colspan='6' class='active datos-principales'>NOMBRES</td>
        <td colspan='6' class='active datos-principales'>APELLIDOS</td>
        <td colspan='6' class='active datos-principales'>EDAD</td>
        <td colspan='6' class='active datos-principales'>SEXO</td>
        <td colspan='6' class='active datos-principales'>No. HOJA</td>
        <td colspan='6' class='active datos-principales'>HCL</td>
      </tr>
      <tr>
        <td colspan='6' class=' datos-principales'>$nompac</td>
        <td colspan='6' class=' datos-principales'>$apepac</td>
        <td colspan='6' class=' datos-principales'>$edad</td>
        <td colspan='6' class=' datos-principales'>$sexpac</td>
        <td colspan='6' class=' datos-principales' >texto aqui</td>
        <td colspan='6' class=' datos-principales'>$cedpac</td>
      </tr>
    
    </tbody>
  </table>
  <table>
  	  <tr>
        <td colspan='36' class='active title'><strong>1. MOTIVO DE LA CONSULTA</strong></td>
      </tr>
      <tr>
        <td class='active'><strong>A</strong></td>
        <td colspan='17' id='td_MotivoConsA'>$fila[motivo_cons_a]</td>
        <td class='active'><strong>C</strong></td>
        <td colspan='17' id='td_MotivoConsC'>$fila[motivo_cons_c]</td>
      </tr>
      <tr>
		    <td class='active'><strong>B</strong></td>
		    <td colspan='17' id='td_MotivoConsB'>$fila[motivo_cons_b]</td>
		    <td class='active'><strong>D</strong></td>
		    <td colspan='17' id='td_MotivoConsD'>$fila[motivo_cons_d]</td>
		  </tr>
  </table>
  <table>
  	<tr>
  	      <td colspan='20' class='active title'><strong>2. ANTECEDENTES PERSONALES</strong></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>1. VACUNAS <br>
		      <input type='checkbox' id='cb_vacunas' ".$aux->checkOrNotcheck($fila[cb_vacunas])."/></td>
		    <td colspan='3' class='active'>5. ENF ALÉRGICA <br>
		      <input type='checkbox' id='cb_alergica' ".$aux->checkOrNotcheck($fila[cb_alergica])." /></td>
		    <td colspan='3' class='active'>9. ENF NEUROLÓGICA <br>
		      <input type='checkbox' id='cb_neurologica' ".$aux->checkOrNotcheck($fila[cb_neurologica])." /></td>
		    <td colspan='3' class='active'>13. ENF TRAUMATOLÓGICA <br>
		      <input type='checkbox' id='cb_traumatologica' ".$aux->checkOrNotcheck($fila[cb_traumatologica])." /></td>
		    <td colspan='3' class='active'>17. TENDENCIA SEXUAL <br>
		      <input type='checkbox' id='cb_tendsexual' ".$aux->checkOrNotcheck($fila[cb_tendsexual])." /></td>
		    <td colspan='4' class='active'>21. ACTIVIDAD SEXUAL <br>
		      <input type='checkbox' id='cb_actsexual' ".$aux->checkOrNotcheck($fila[cb_actsexual])." /></td>
		  </tr>
		   <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>2. ENF PERINATAL <br>
		      <input type='checkbox' id='cb_perinatal' ".$aux->checkOrNotcheck($fila[cb_perinatal])." /></td>
		    <td colspan='3' class='active'>6. ENF CARDIACA <br>
		      <input type='checkbox' id='cb_cardiaca' ".$aux->checkOrNotcheck($fila[cb_cardiaca])." /></td>
		    <td colspan='3' class='active'>10. ENF METABÓLICA <br>
		      <input type='checkbox' id='cb_metabolica' ".$aux->checkOrNotcheck($fila[cb_metabolica])." /></td>
		    <td colspan='3' class='active'>14. ENF QUIRURGICA <br>
		      <input type='checkbox' id='cb_quirurgica' ".$aux->checkOrNotcheck($fila[cb_quirurgica])." /></td>
		    <td colspan='3' class='active'>18. RIESGO SOCIAL <br>
		      <input type='checkbox' id='cb_riesgosocial' ".$aux->checkOrNotcheck($fila[cb_riesgosocial])." /></td>
		    <td colspan='4' class='active'>22. DIETA Y HABITOS <br>
		      <input type='checkbox' id='cb_dietahabitos' ".$aux->checkOrNotcheck($fila[cb_dietahabitos])." /></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>3. ENF INFANCIA <br>
		      <input type='checkbox' id='cb_infancia' ".$aux->checkOrNotcheck($fila[cb_infancia])."   /></td>
		    <td colspan='3' class='active'>7. ENF RESPIRATORIA <br>
		      <input type='checkbox' id='cb_respiratoria' ".$aux->checkOrNotcheck($fila[cb_respiratoria])."   /></td>
		    <td colspan='3' class='active'>11. ENF HEMO LINF <br>
		      <input type='checkbox' id='cb_hemolinf' ".$aux->checkOrNotcheck($fila[cb_hemolinf])."   /></td>
		    <td colspan='3' class='active'>15. ENF MENTAL <br>
		      <input type='checkbox' id='cb_mental' ".$aux->checkOrNotcheck($fila[cb_mental])."   /></td>
		    <td colspan='3' class='active'>19. RIESGO LABORAL <br>
		      <input type='checkbox' id='cb_riesgolaboral' ".$aux->checkOrNotcheck($fila[cb_riesgolaboral])."   /></td>
		    <td colspan='4' class='active'>23. RELIGION Y CULTURA <br>
		      <input type='checkbox' id='cb_religioncultura' ".$aux->checkOrNotcheck($fila[cb_religioncultura])."   /></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='4' class='active'>4. ENF ADOLECENTE <br>
		      <input type='checkbox' id='cb_adolecente' ".$aux->checkOrNotcheck($fila[cb_adolecente])."  /></td>
		    <td colspan='3' class='active'>8. ENF DIGESTIVA <br>
		      <input type='checkbox' id='cb_digestiva' ".$aux->checkOrNotcheck($fila[cb_digestiva])."  /></td>
		    <td colspan='3' class='active'>12. ENF URINARIA X <br>
		      <input type='checkbox' id='cb_urinaria' ".$aux->checkOrNotcheck($fila[cb_urinaria])."  /></td>
		    <td colspan='3' class='active'>16. ENF T SEXUAL <br>
		      <input type='checkbox' id='cb_tsexual' ".$aux->checkOrNotcheck($fila[cb_tsexual])."  /></td>
		    <td colspan='3' class='active'>20. RIESGO FAMILIAR <br>
		      <input type='checkbox' id='cb_riesgofamiliar' ".$aux->checkOrNotcheck($fila[cb_riesgofamiliar])."  /></td>
		    <td colspan='4' class='active'>24. OTRO <br>
		      <input type='checkbox' id='cb_otro' ".$aux->checkOrNotcheck($fila[cb_otro])."  /></td>
		  </tr>
		  <tr >
		    <td class='text-area' colspan='20' id='td_txtAntePer'>$fila[txt_ante_per]</td>
		  </tr>
	</table>
  <table>
  	 <tr>
  	    <td colspan='36' class='active title'><strong>3. ANTECEDENTES FAMILIARES</strong></td>
		  </tr>
		  <tr style='font-size:10px; '>
		    <td colspan='2' class='active'>1.<br> CARDIOPATIA <br>
		      <input type='checkbox' id='cb_cardiopatia'  ".$aux->checkOrNotcheck($fila[cb_cardiopatia])."  /></td>
		    <td colspan='2' class='active'>2.<br>  DIABETES <br>
		      <input type='checkbox' id='cb_diabetes'  ".$aux->checkOrNotcheck($fila[cb_diabetes])."  /></td>
		    <td colspan='4' class='active'>3.<br>  ENF VASCULARES <br>
		      <input type='checkbox' id='cb_enfvasculares'  ".$aux->checkOrNotcheck($fila[cb_enfvasculares])."  /></td>
		    <td colspan='4' class='active'>4.<br>  HTA <br>
		      <input type='checkbox' id='cb_hta'  ".$aux->checkOrNotcheck($fila[cb_hta])."  /></td>
		    <td colspan='4' class='active'>5.<br>  CANCER <br>
		      <input type='checkbox' id='cb_cancer'  ".$aux->checkOrNotcheck($fila[cb_cancer])."  /></td>
		    <td colspan='4' class='active'>6.<br>  TUBERCULOSIS <br>
		      <input type='checkbox' id='cb_tuberculosis'  ".$aux->checkOrNotcheck($fila[cb_tuberculosis])."  /></td>
		    <td colspan='4' class='active'>7.<br>   ENF MENTAL <br>
		      <input type='checkbox' id='cb_enfenfmental'  ".$aux->checkOrNotcheck($fila[cb_enfenfmental])."  /></td>
		    <td colspan='4' class='active'>8.<br>  ENF INFECCIOSA <br>
		      <input type='checkbox' id='cb_enfinfecciosa'  ".$aux->checkOrNotcheck($fila[cb_enfinfecciosa])."  /></td>
		    <td colspan='4' class='active'>9.<br>  MAL FORMACIÓN <br>
		      <input type='checkbox' id='cb_malformacion'  ".$aux->checkOrNotcheck($fila[cb_malformacion])."  /></td>
		    <td colspan='4' class='active'>10.<br>  OTRO <br>
		      <input type='checkbox' id='cb_afotro'  ".$aux->checkOrNotcheck($fila[cb_afotro])."  /></td>
		  </tr>
		  <tr>
		    <td class='text-area-no-ref' colspan='36' id='td_txtNoRef' >$fila[txt_no_ref]</td>
		  </tr>
  </table>
	  <table class='page-break-after'>
		  <tr>
		    <td colspan='20' class='active title'><strong> 4. ENFERMEDAD O PROBLEMA ACTUAL (Nota de Ingreso)</strong></td>
		  </tr>
		  <tr>
		    <td class='text-area' colspan='20' id='td_txtProbActual'>$fila[txtProbActual]</td>
		  </tr>
		  <tr>
		  <tr>
		    <td colspan='20' class='active title'><strong>5. REVISIÓN ACTUAL DE ÓRGANOS Y SISTEMAS AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		  </tr>
		   <tr style='font-size:10px; ' align='center'>
		    <td colspan='2' class='active'>1. ÓRGANOS DE LOS SENTIDOS</td>
		    <td><input type='checkbox' id='cb_1CP'  ".$aux->checkOrNotcheck($fila[cb_uno_cp])." /></td>
		    <td><input type='checkbox' id='cb_1SP'  ".$aux->checkOrNotcheck($fila[cb_uno_sp])." /></td>
		    <td colspan='2' class='active'>3. CARDIOVASCULAR</td>
		    <td><input type='checkbox' id='cb_3CP'  ".$aux->checkOrNotcheck($fila[cb_tres_cp])." /></td>
		    <td><input type='checkbox' id='cb_3SP'  ".$aux->checkOrNotcheck($fila[cb_tres_SP])." /></td>
		    <td colspan='2' class='active'>5. GENITAL</td>
		    <td><input type='checkbox' id='cb_5CP'  ".$aux->checkOrNotcheck($fila[cb__cinco_cp])." /></td>
		    <td><input type='checkbox' id='cb_5SP'  ".$aux->checkOrNotcheck($fila[cb_cinco_sp])." /></td>
		    <td colspan='2' class='active'>7. MÚSCULO ESQUELÉTICO</td>
		    <td><input type='checkbox' id='cb_7CP'  ".$aux->checkOrNotcheck($fila[cb_siete_cp])." /></td>
		    <td><input type='checkbox' id='cb_7SP'  ".$aux->checkOrNotcheck($fila[cb_siete_sp])." /></td>
		    <td colspan='2' class='active'>9. HEMO LINFÁTICO</td>
		    <td><input type='checkbox' id='cb_9CP'  ".$aux->checkOrNotcheck($fila[cb_nueve_cp])." /></td>
		    <td><input type='checkbox' id='cb_9SP'  ".$aux->checkOrNotcheck($fila[cb_nueve_sp])." /></td>
		  </tr>
		  <tr style='font-size:10px; ' align='center'>
		    <td colspan='2' class='active'>2. RESPIRATORIO</td>
		    <td><input type='checkbox' id='cb_2CP' ".$aux->checkOrNotcheck($fila[cb_dos_cp])."/></td>
		    <td><input type='checkbox' id='cb_2SP' ".$aux->checkOrNotcheck($fila[cb_dos_sp])."/></td>
		    <td colspan='2' class='active'>4. DIGESTIVOS</td>
		    <td><input type='checkbox' id='cb_4CP' ".$aux->checkOrNotcheck($fila[cb_cuatro_cp])."/></td>
		    <td><input type='checkbox' id='cb_4SP' ".$aux->checkOrNotcheck($fila[cb_cuatro_sp])."/></td>
		    <td colspan='2' class='active'>6. URINARIO</td>
		    <td><input type='checkbox' id='cb_6CP' ".$aux->checkOrNotcheck($fila[cb_seis_cp])."/></td>
		    <td><input type='checkbox' id='cb_6SP' ".$aux->checkOrNotcheck($fila[cb_seis_sp])."/></td>
		    <td colspan='2' class='active'>8. ENDOCRINO</td>
		    <td><input type='checkbox' id='cb_8CP' ".$aux->checkOrNotcheck($fila[cb_ocho_cp])."/></td>
		    <td><input type='checkbox' id='cb_8SP' ".$aux->checkOrNotcheck($fila[cb_ocho_sp])."/></td>
		    <td colspan='2' class='active'>10. NERVIOSO</td>
		    <td><input type='checkbox' id='cb_10CP' ".$aux->checkOrNotcheck($fila[cb_diez_cp])."/></td>
		    <td><input type='checkbox' id='cb_10SP' ".$aux->checkOrNotcheck($fila[cb_diez_sp])."/></td>
		  </tr>
		  <tr >
		    <td class='text-area-no-ref' colspan='20' id='td_txtRevisOrgs' >$fila[txt_revis_orgs]</td>
		  </tr>
		  <tr>
		    <td  colspan='20' class='active title'><strong>6. SIGNOS VITALES AL INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='17' >&nbsp;</td>
		    <td class='active'>M</td>
		    <td class='active'>O</td>
		    <td class='active'>V</td>
		  </tr>
		  <tr style='font-size:10px; ' align='cneter'>
		    <td class='active'>TA</td>
		    <td id='ta' >$fila[ta]</td>
		    <td class='active' width='5%'>F.C</td>
		    <td id='fc' >$fila[fc]</td>
		    <td class='active' width='5%'>F.R</td>
		    <td width='5%' id='fr' >$fila[fr]</td>
		    <td class='active' width='5%'>SAT O2</td>
		    <td width='5%' id='sato2' >$fila[sato_dos]</td>
		    <td class='active' width='5%'>TEMP BUCAL</td>
		    <td width='5%' id='tempbuc' >$fila[tempbuc]</td>
		    <td class='active' width='5%'>PESO</td>
		    <td width='5%' id='peso' >$fila[peso]</td>
		    <td class='active' width='5%'>GLUCEMIA</td>
		    <td width='5%' id='glucem' >$fila[glucem]</td>
		    <td class='active' width='5%'>TALLA</td>
		    <td width='5%' id='talla' >$fila[talla]</td>
		    <td class='active' width='10%'>ESCALA DE COMA DE GLASGOW</td>
		    <td width='3%' id='gm' >$fila[gm]</td>
		    <td width='3%' id='go' >$fila[go]</td>
		    <td width='3%' id='gv' >$fila[gv]</td>
		  </tr>
		  </table>
		 
		  <table  class='page-break-before'>
		  <tr>
		    <th colspan='20' class='active title'><strong>7. EXAMEN FÍSICO AL INGRESO</strong></th>
		  </tr>
		  <tr align='center'>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		    <td colspan='2'>&nbsp;</td>
		    <td class='active'>CP</td>
		    <td class='active'>SP</td>
		  </tr>
		   <tr style='font-size:10px;' align='center' >
		    <td colspan='2' class='active'>1.R PIEL Y FANERAS</td>
		    <td><input type='checkbox' id='cb_1RCP' ".$aux->checkOrNotcheck($fila[cb_uno_rcp])." /></td>
		    <td><input type='checkbox' id='cb_1RSP' ".$aux->checkOrNotcheck($fila[cb_uno_rsp])." /></td>
		    <td colspan='2' class='active'>6.R BOCA</td>
		    <td><input type='checkbox' id='cb_6RCP' ".$aux->checkOrNotcheck($fila[cb_seis_rcp])." /></td>
		    <td><input type='checkbox' id='cb_6RSP' ".$aux->checkOrNotcheck($fila[cb_seis_rsp])." /></td>
		    <td colspan='2' class='active'>11.R ABDOMEN</td>
		    <td><input type='checkbox' id='cb_11RCP' ".$aux->checkOrNotcheck($fila[cb_once_rcp])." /></td>
		    <td><input type='checkbox' id='cb_11RSP' ".$aux->checkOrNotcheck($fila[cb_once_rsp])." /></td>
		    <td colspan='2' class='active'>1. S ORGANOS DE LOS SENTIDOS</td>
		    <td><input type='checkbox' id='cb_1SCP' ".$aux->checkOrNotcheck($fila[cb_uno_scp])." /></td>
		    <td><input type='checkbox' id='cb_1SSP' ".$aux->checkOrNotcheck($fila[cb_uno_ssp])." /></td>
		    <td colspan='2' class='active'>6. S URINARIO</td>
		    <td><input type='checkbox' id='cb_6SCP' ".$aux->checkOrNotcheck($fila[cb_seis_scp])." /></td>
		    <td><input type='checkbox' id='cb_6SSP' ".$aux->checkOrNotcheck($fila[cb_seis_ssp])." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center' >
		    <td colspan='2' class='active'>2.R CABEZA</td>
		    <td><input type='checkbox' id='cb_2RCP' ".$aux->checkOrNotcheck($fila[cb_dos_rcp])."/></td>
		    <td><input type='checkbox' id='cb_2RSP' ".$aux->checkOrNotcheck($fila[cb_dos_rsp])."/></td>
		    <td colspan='2' class='active'>7.R OROFARINGE</td>
		    <td><input type='checkbox' id='cb_7RCP' ".$aux->checkOrNotcheck($fila[cb_siete_rcp])."/></td>
		    <td><input type='checkbox' id='cb_7RSP' ".$aux->checkOrNotcheck($fila[cb_siete_rsp])."/></td>
		    <td colspan='2' class='active'>12.R COLUMNA VERTEBRAL</td>
		    <td><input type='checkbox' id='cb_12RCP' ".$aux->checkOrNotcheck($fila[cb_doce_rcp])."/></td>
		    <td><input type='checkbox' id='cb_12RSP' ".$aux->checkOrNotcheck($fila[cb_doce_rsp])."/></td>
		    <td colspan='2' class='active'>2. S RESPIRATORIO</td>
		    <td><input type='checkbox' id='cb_2SCP' ".$aux->checkOrNotcheck($fila[cb_dos_scp])."/></td>
		    <td><input type='checkbox' id='cb_2SSP' ".$aux->checkOrNotcheck($fila[cb_dos_ssp])."/></td>
		    <td colspan='2' class='active'>7. S MÚSCULO ESQUELÉTICO</td>
		    <td><input type='checkbox' id='cb_7SCP' ".$aux->checkOrNotcheck($fila[cb_siete_scp])."/></td>
		    <td><input type='checkbox' id='cb_7SSP' ".$aux->checkOrNotcheck($fila[cb_siete_ssp])."/></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>3.R OJOS</td>
		    <td><input type='checkbox' id='cb_3RCP' ".$aux->checkOrNotcheck($fila[cb_tres_rcp])."/></td>
		    <td><input type='checkbox' id='cb_3RSP' ".$aux->checkOrNotcheck($fila[cb_tres_rsp])."/></td>
		    <td colspan='2' class='active'>8.R CUELLO</td>
		    <td><input type='checkbox' id='cb_8RCP' ".$aux->checkOrNotcheck($fila[cb_ocho_rcp])."/></td>
		    <td><input type='checkbox' id='cb_8RSP' ".$aux->checkOrNotcheck($fila[cb_ocho_rsp])."/></td>
		    <td colspan='2' class='active'>13.R INGLE-PERINE</td>
		    <td><input type='checkbox' id='cb_13RCP' ".$aux->checkOrNotcheck($fila[cb_trece_rcp])."/></td>
		    <td><input type='checkbox' id='cb_13RSP' ".$aux->checkOrNotcheck($fila[cb_trece_rsp])."/></td>
		    <td colspan='2' class='active'>3. S CARDIOVASCULAR</td>
		    <td><input type='checkbox' id='cb_3SCP' ".$aux->checkOrNotcheck($fila[cb_tres_scp])."/></td>
		    <td><input type='checkbox' id='cb_3SSP' ".$aux->checkOrNotcheck($fila[cb_tres_ssp])."/></td>
		    <td colspan='2' class='active'>8.S ENDOCRINO</td>
		    <td><input type='checkbox' id='cb_8SCP' ".$aux->checkOrNotcheck($fila[cb_ocho_scp])."/></td>
		    <td><input type='checkbox' id='cb_8SSP' ".$aux->checkOrNotcheck($fila[cb_ocho_ssp])."/></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>4.R OIDOS</td>
		    <td><input type='checkbox' id='cb_4RCP'  ".$aux->checkOrNotcheck($fila[cb_cuatro_rcp])." /></td>
		    <td><input type='checkbox' id='cb_4RSP'  ".$aux->checkOrNotcheck($fila[cb_cuatro_rsp])." /></td>
		    <td colspan='2' class='active'>9.R AXILAS MAMAS</td>
		    <td><input type='checkbox' id='cb_9RCP'  ".$aux->checkOrNotcheck($fila[cb_nueve_rcp])." /></td>
		    <td><input type='checkbox' id='cb_9RSP'  ".$aux->checkOrNotcheck($fila[cb_nueve_rsp])." /></td>
		    <td colspan='2' class='active'>14.R MIEMBROS SUPERIORES</td>
		    <td><input type='checkbox' id='cb_14RCP'  ".$aux->checkOrNotcheck($fila[cb_catorce_rcp])." /></td>
		    <td><input type='checkbox' id='cb_14RSP'  ".$aux->checkOrNotcheck($fila[cb_catorce_rsp])." /></td>
		    <td colspan='2' class='active'>4. S DIGESTIVOS</td>
		    <td><input type='checkbox' id='cb_4SCP'  ".$aux->checkOrNotcheck($fila[cb_cuatro_scp])." /></td>
		    <td><input type='checkbox' id='cb_4SSP'  ".$aux->checkOrNotcheck($fila[cb_cuatro_ssp])." /></td>
		    <td colspan='2' class='active'>9. S HEMOLINFÁTICOS</td>
		    <td><input type='checkbox' id='cb_9SCP'  ".$aux->checkOrNotcheck($fila[cb_nueve_scp])." /></td>
		    <td><input type='checkbox' id='cb_9SSP'  ".$aux->checkOrNotcheck($fila[cb_nueve_ssp])." /></td>
		  </tr>
		  <tr style='font-size:10px;' align='center'>
		    <td colspan='2' class='active'>5.R NARIZ</td>
		    <td><input type='checkbox' id='cb_5RCP'  ".$aux->checkOrNotcheck($fila[cb_cinco_rcp])."/></td>
		    <td><input type='checkbox' id='cb_5RSP'  ".$aux->checkOrNotcheck($fila[cb_cinco_rsp])."/></td>
		    <td colspan='2' class='active'>10.R TORAX</td>
		    <td><input type='checkbox' id='cb_10RCP'  ".$aux->checkOrNotcheck($fila[cb_diez_rcp])."/></td>
		    <td><input type='checkbox' id='cb_10RSP'  ".$aux->checkOrNotcheck($fila[cb_diez_rsp])."/></td>
		    <td colspan='2' class='active'>15.R MIEMBROS</td>
		    <td><input type='checkbox' id='cb_15RCP'  ".$aux->checkOrNotcheck($fila[cb_quince_rcp])."/></td>
		    <td><input type='checkbox' id='cb_15RSP'  ".$aux->checkOrNotcheck($fila[cb_quince_rsp])."/></td>
		    <td colspan='2' class='active'>5.S GENITAL</td>
		    <td><input type='checkbox' id='cb_5sCP'  ".$aux->checkOrNotcheck($fila[cb_cinco_scp])."/></td>
		    <td><input type='checkbox' id='cb_5sSP'  ".$aux->checkOrNotcheck($fila[cb_cinco_ssp])."/></td>
		    <td colspan='2' class='active'>10.S NEUROLÓGICO</td>
		    <td><input type='checkbox' id='cb_10sCP'  ".$aux->checkOrNotcheck($fila[cb_diez_scp])."/></td>
		    <td><input type='checkbox' id='cb_10sSP'  ".$aux->checkOrNotcheck($fila[cb_diez_ssp])."/></td>
		  </tr>
		  <tr >
		    <td class='text-area'  colspan='20'  id='td_txtExaFisico'>$fila[txt_exa_fisico]</td>
		  </tr>
		   <tr>
		    <td colspan='20' class='active title'><strong>9. DIAGNÓSTICO DE INGRESO</strong></td>
		  </tr>
		  <tr align='center'>
		    <td colspan='8'>&nbsp;</td>
		    <td class='active'>CIE</td>
		    <td class='active'>PRE</td>
		    <td class='active'>DEF</td>
		    <td colspan='6'>&nbsp;</td>
		    <td class='active'>CIE</td>
		    <td class='active'>PRE</td>
		    <td class='active'>DEF</td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>1</td>
		    <td colspan='7' id='td_txtCie1'>$fila[txt_cie_uno]</td>
		    <td style='width:8%' id='td_txtCod1'>$fila[txt_cod_uno]</td>
		    <td><input type='checkbox' id='cb_1PRE' ".$aux->checkOrNotcheck($fila[cb_uno_pre])."/></td>
		    <td><input type='checkbox' id='cb_1DEF' ".$aux->checkOrNotcheck($fila[cb_uno_def])."/></td>
		    <td class='active'>4</td>
		    <td colspan='5' id='td_txtCie4'>$fila[txt_cie_cuatro]</td>
		    <td style='width:8%' id='td_txtCod4'>$fila[txt_cod_cuatro]</td>
		    <td><input type='checkbox' id='cb_4PRE' ".$aux->checkOrNotcheck($fila[cb_cuatro_pre])."/></td>
		    <td><input type='checkbox' id='cb_4DEF' ".$aux->checkOrNotcheck($fila[cb_cuatro_def])."/></td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>2</td>
		    <td colspan='7' id='td_txtCie2' >$fila[txt_cie_dos]</td>
		    <td id='td_txtCod2'>$fila[txt_cod_dos]</td>
		    <td><input type='checkbox' id='cb_2PRE'  ".$aux->checkOrNotcheck($fila[cb_dos_pre])."/></td>
		    <td><input type='checkbox' id='cb_2DEF'  ".$aux->checkOrNotcheck($fila[cb_dos_def])."/></td>
		    <td class='active'>5</td>
		    <td colspan='5' id='td_txtCie5'>$fila[txt_cie_cinco]</td>
		    <td id='txtCod5'>$fila[txt_cod_cinco]</td>
		    <td><input type='checkbox' id='cb_5PRE'  ".$aux->checkOrNotcheck($fila[cb_cinco_pre])."/></td>
		    <td><input type='checkbox' id='cb_5DEF'  ".$aux->checkOrNotcheck($fila[cb_cinco_def])."/></td>
		  </tr>
		  <tr align='center'>
		    <td class='active'>3</td>
		    <td colspan='7' id='td_txtCie3'>$fila[txt_cie_tres]</td>
		    <td id='td_txtCod3'>$fila[txt_cod_tres]</td>
		    <td><input type='checkbox' id='cb_3PRE' ".$aux->checkOrNotcheck($fila[cb_tres_pre])." /></td>
		    <td><input type='checkbox' id='cb_3DEF' ".$aux->checkOrNotcheck($fila[cb_tres_def])."/></td>
		    <td class='active'>6</td>
		    <td colspan='5' id='td_txti3'>$fila[txti_tres]</td>
		    <td id='txtic3'>$fila[txtic_tres]</td>
		    <td><input type='checkbox' id='cb_6PRE' ".$aux->checkOrNotcheck($fila[cb_seis_pre])."/></td>
		    <td><input type='checkbox' id='cb_6DEF' ".$aux->checkOrNotcheck($fila[cb_seis_def])."/></td>
		  </tr>
		   
		  
		</table>
        <table> 
        <tr>
		    <td colspan='36' class='active'>&nbsp;</td>
		  </tr>
        <tr>
		    <td class='text-area' colspan='36' id='td_txtPlanTrat'>$fila[txt_plan_trat]</textarea></td>
		</tr>
	    <tr>
		    <td colspan='2' class='active firma'>FECHA - HORA</td>
		    <td colspan='10' id='td_txtFechaAgendDoct'>$fila[txt_fecha_agend_doct]</td>
		    <td colspan='2' class='active firma'>NOMBRE DEL PROFESIONAL</td>
		    <td colspan='10' id='td_nombremedico'>$fila[nombremedico]</td>
		    <td colspan='2' class='active firma' >FIRMA</td>
		    <td colspan='10' id='td_firmaDoc' >$fila[firma_doc]</td>
		</tr>
		  
  </table>
  
</main>
<footer>
  
</footer>
</body>
</html>";

}


$mpdf = new mPDF('c','A4');
$css = file_get_contents('L_asset/Asset_Print_AnamnesisHosp/style.css');
$mpdf->writeHTML($css,1);
$mpdf->SetHTMLFooter('<table class="table-footer">
                  <tr>
                  <td class="no-border text-aling-left"> SNS-MSP / HCU-FORM.003 / 2007.</td>
                  <td class="no-border text-aling-right"> ANAMNESIS</td>
                  </tr>
  </table>');
$mpdf->writeHTML($html);
$mpdf->Output('reporte.pdf','I');



 ?>