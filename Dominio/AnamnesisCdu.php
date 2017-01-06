<?php
 class AnamnesisCdu
 {
 	public function Consultar_AnamnesisCdu($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_cduanam"=>$res->fields[0],
			"establ_cduanam"=>$res->fields[1],
			"nom_cduanam"=>$res->fields[2],
			"ape_cduanam"=>$res->fields[3],
			"sex_cduanam"=>$res->fields[4],
			"numh_cduanam"=>$res->fields[5],
			"histcl_cduanam"=>$res->fields[6],
			"motivoc_cduanam"=>$res->fields[7],
			"anteper_cduanam"=>$res->fields[8],
			"antefam_cduanam"=>$res->fields[9],
			"enferac_cduanam"=>$res->fields[10],
			"reviorgsis_cduanam"=>$res->fields[11],
			"fecha1_cduanam"=>$res->fields[12],
			"fecha2_cduanam"=>$res->fields[13],
			"fecha3_cduanam"=>$res->fields[14],
			"fehca4_cduanam"=>$res->fields[15],
			"prearte1_cduanam"=>$res->fields[16],
			"prearte2_cduanam"=>$res->fields[17],
			"prearte3_cduanam"=>$res->fields[18],
			"prearte4_cduanam"=>$res->fields[19],
			"pulso1_cduanam"=>$res->fields[20],
			"pulso2_cduanam"=>$res->fields[21],
			"pulso3_cduanam"=>$res->fields[22],
			"pulso4_cduanam"=>$res->fields[23],
			"temp1_cduanam"=>$res->fields[24],
			"temp2_cduanam"=>$res->fields[25],
			"temp3_cduanam"=>$res->fields[26],
			"temp4_cduanam"=>$res->fields[27],
			"examfi_cduanam"=>$res->fields[28],
			"cie1_cduanam"=>$res->fields[29],
			"cie2_cduanam"=>$res->fields[30],
			"cie3_cduanam"=>$res->fields[31],
			"cie4_cduanam"=>$res->fields[32],
			"cie5_cduanam"=>$res->fields[33],
			"codcie1_cduanam"=>$res->fields[34],
			"codcie2_cduanam"=>$res->fields[35],
			"codcie3_cduanam"=>$res->fields[36],
			"codcie4_cduanam"=>$res->fields[37],
			"codcie5_cduanam"=>$res->fields[38],
			"pre1_cduanam"=>$res->fields[39],
			"pre2_cduanam"=>$res->fields[40],
			"pre3_cduanam"=>$res->fields[41],
			"pre4_cduanam"=>$res->fields[42],
			"pre5_cduanam"=>$res->fields[43],
			"def1_cduanam"=>$res->fields[44],
			"def2_cduanam"=>$res->fields[45],
			"def3_cduanam"=>$res->fields[46],
			"def4_cduanam"=>$res->fields[47],
			"def5_cduanam"=>$res->fields[48],
			"planesdte_cduanam"=>$res->fields[49],
			"est_cduanam"=>$res->fields[50],
			"id_pac"=>$res->fields[51],
			"fechcontr_cduanam"=>$res->fields[52],
			"horafin_cduanam"=>$res->fields[53],
			"medico_cduanam"=>$res->fields[54],
			"codmed_cduanam"=>$res->fields[55],
			"fechasa_cduanm"=>$res->fields[56],
			"id_med"=>$res->fields[57]
			);
		
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}
	public function Consultar($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		return $res->fields[0];
	}
	public function Ejecutar($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		if(!$res)
		{
			return $con->ErrorMsg();
		}
		else
		{
			return "La informacion se ejecuto correctamente";
		}
	}
	
	
	
//CODIGO DE ANAMNESIS DE HOSPITALIZACION
	//Codigo de consulta de toda la tabla de anamnesis
	public function Consultar_AnamnesisHosp($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
		$datos[]=array(
				"id_anam_hosp"=>$res->fields[0],
				"historia_clinica"=>$res->fields[1],
				"id_pac"=>$res->fields[2],
				"motivo_cons_a"=>$res->fields[3],
				"motivo_cons_b"=>$res->fields[4],
				"motivo_cons_c"=>$res->fields[5],
				"motivo_cons_d"=>$res->fields[6],
				"cb_vacunas"=>$res->fields[7],
				"cb_alergica"=>$res->fields[8],
				"cb_neurologica"=>$res->fields[9],
				"cb_traumatologica"=>$res->fields[10],
				"cb_tendsexual"=>$res->fields[11],
				"cb_actsexual"=>$res->fields[12],
				"cb_perinatal"=>$res->fields[13],
				"cb_cardiaca"=>$res->fields[14],
				"cb_metabolica"=>$res->fields[15],
				"cb_quirurgica"=>$res->fields[16],
				"cb_riesgosocial"=>$res->fields[17],
				"cb_dietahabitos"=>$res->fields[18],
				"cb_infancia"=>$res->fields[19],
				"cb_respiratoria"=>$res->fields[20],
				"cb_hemolinf"=>$res->fields[21],
				"cb_mental"=>$res->fields[22],
				"cb_riesgolaboral"=>$res->fields[23],
				"cb_religioncultura"=>$res->fields[24],
				"cb_adolecente"=>$res->fields[25],
				"cb_digestiva"=>$res->fields[26],
				"cb_urinaria"=>$res->fields[27],
				"cb_tsexual"=>$res->fields[28],
				"cb_riesgofamiliar"=>$res->fields[29],
				"cb_otro"=>$res->fields[30],
				"txt_ante_per"=>$res->fields[31],
				"cb_cardiopatia"=>$res->fields[32],
				"cb_diabetes"=>$res->fields[33],
				"cb_enfvasculares"=>$res->fields[34],
				"cb_hta"=>$res->fields[35],
				"cb_cancer"=>$res->fields[36],
				"cb_tuberculosis"=>$res->fields[37],
				"cb_enfenfmental"=>$res->fields[38],
				"cb_enfinfecciosa"=>$res->fields[39],
				"cb_malformacion"=>$res->fields[40],
				"cb_afotro"=>$res->fields[41],
				"txt_no_ref"=>$res->fields[42],
				"txtProbActual"=>$res->fields[43],
				"cb_uno_cp"=>$res->fields[44],
				"cb_uno_sp"=>$res->fields[45],
				"cb_tres_cp"=>$res->fields[46],
				"cb_tres_SP"=>$res->fields[47],
				"cb__cinco_cp"=>$res->fields[48],
				"cb_cinco_sp"=>$res->fields[49],
				"cb_siete_cp"=>$res->fields[50],
				"cb_siete_sp"=>$res->fields[51],
				"cb_nueve_cp"=>$res->fields[52],
				"cb_nueve_sp"=>$res->fields[53],
				"cb_dos_cp"=>$res->fields[54],
				"cb_dos_sp"=>$res->fields[55],
				"cb_cuatro_cp"=>$res->fields[56],
				"cb_cuatro_sp"=>$res->fields[57],
				"cb_seis_cp"=>$res->fields[58],
				"cb_seis_sp"=>$res->fields[59],
				"cb_ocho_cp"=>$res->fields[60],
				"cb_ocho_sp"=>$res->fields[61],
				"cb_diez_cp"=>$res->fields[62],
				"cb_diez_sp"=>$res->fields[63],
				"txt_revis_orgs"=>$res->fields[64],
				"ta"=>$res->fields[65],
				"fc"=>$res->fields[66],
				"fr"=>$res->fields[67],
				"sato_dos"=>$res->fields[68],
				"tempbuc"=>$res->fields[69],
				"peso"=>$res->fields[70],
				"glucem"=>$res->fields[71],
				"talla"=>$res->fields[72],
				"gm"=>$res->fields[73],
				"go"=>$res->fields[74],
				"gv"=>$res->fields[75],
				"cb_uno_rcp"=>$res->fields[76],
				"cb_uno_rsp"=>$res->fields[77],
				"cb_seis_rcp"=>$res->fields[78],
				"cb_seis_rsp"=>$res->fields[79],
				"cb_once_rcp"=>$res->fields[80],
				"cb_once_rsp"=>$res->fields[81],
				"cb_uno_scp"=>$res->fields[82],
				"cb_uno_ssp"=>$res->fields[83],
				"cb_seis_scp"=>$res->fields[84],
				"cb_seis_ssp"=>$res->fields[85],
				"cb_dos_rcp"=>$res->fields[86],
				"cb_dos_rsp"=>$res->fields[87],
				"cb_siete_rcp"=>$res->fields[88],
				"cb_siete_rsp"=>$res->fields[89],
				"cb_doce_rcp"=>$res->fields[90],
				"cb_doce_rsp"=>$res->fields[91],
				"cb_dos_scp"=>$res->fields[92],
				"cb_dos_ssp"=>$res->fields[93],
				"cb_siete_scp"=>$res->fields[94],
				"cb_siete_ssp"=>$res->fields[95],
				"cb_tres_rcp"=>$res->fields[96],
				"cb_tres_rsp"=>$res->fields[97],
				"cb_ocho_rcp"=>$res->fields[98],
				"cb_ocho_rsp"=>$res->fields[99],
				"cb_trece_rcp"=>$res->fields[100],
				"cb_trece_rsp"=>$res->fields[101],
				"cb_tres_scp"=>$res->fields[102],
				"cb_tres_ssp"=>$res->fields[103],
				"cb_ocho_scp"=>$res->fields[104],
				"cb_ocho_ssp"=>$res->fields[105],
				"cb_cuatro_rcp"=>$res->fields[106],
				"cb_cuatro_rsp"=>$res->fields[107],
				"cb_nueve_rcp"=>$res->fields[108],
				"cb_nueve_rsp"=>$res->fields[109],
				"cb_catorce_rcp"=>$res->fields[110],
				"cb_catorce_rsp"=>$res->fields[111],
				"cb_cuatro_scp"=>$res->fields[112],
				"cb_cuatro_ssp"=>$res->fields[113],
				"cb_nueve_scp"=>$res->fields[114],
				"cb_nueve_ssp"=>$res->fields[115],
				"cb_cinco_rcp"=>$res->fields[116],
				"cb_cinco_rsp"=>$res->fields[117],
				"cb_diez_rcp"=>$res->fields[118],
				"cb_diez_rsp"=>$res->fields[119],
				"cb_quince_rcp"=>$res->fields[120],
				"cb_quince_rsp"=>$res->fields[121],
				"cb_cinco_scp"=>$res->fields[122],
				"cb_cinco_ssp"=>$res->fields[123],
				"cb_diez_scp"=>$res->fields[124],
				"cb_diez_ssp"=>$res->fields[125],
				"txt_exa_fisico"=>$res->fields[126],
				"txt_cie_uno"=>$res->fields[127],
				"txt_cod_uno"=>$res->fields[128],
				"cb_uno_pre"=>$res->fields[129],
				"cb_uno_def"=>$res->fields[130],
				"txt_cie_cuatro"=>$res->fields[131],
				"txt_cod_cuatro"=>$res->fields[132],
				"cb_cuatro_pre"=>$res->fields[133],
				"cb_cuatro_def"=>$res->fields[134],
				"txt_cie_dos"=>$res->fields[135],
				"txt_cod_dos"=>$res->fields[136],
				"cb_dos_pre"=>$res->fields[137],
				"cb_dos_def"=>$res->fields[138],
				"txt_cie_cinco"=>$res->fields[139],
				"txt_cod_cinco"=>$res->fields[140],
				"cb_cinco_pre"=>$res->fields[141],
				"cb_cinco_def"=>$res->fields[142],
				"txt_cie_tres"=>$res->fields[143],
				"txt_cod_tres"=>$res->fields[144],
				"cb_tres_pre"=>$res->fields[145],
				"cb_tres_def"=>$res->fields[146],
				"txti_tres"=>$res->fields[147],
				"txtic_tres"=>$res->fields[148],
				"cb_seis_pre"=>$res->fields[149],
				"cb_seis_def"=>$res->fields[150],
				"txt_plan_trat"=>$res->fields[151],
				"txt_fecha_agend_doct"=>$res->fields[152],
				"nombremedico"=>$res->fields[153],
				"firma_doc"=>$res->fields[154],
				"id_doc"=>$res->fields[155],
				"estado_proceso"=>$res->fields[156]);
		
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}

//Comprobacion si el check box esta marcado o no segun lo que esta guardado en la BD true o false
	public function checkOrNotcheck($param)
	{     
		
         $StringCheck  = '';

       if ($param == "false") 
        {
        $StringCheck = '';                  	
        }
        else
        {
        	 $StringCheck = 'checked=\"true\"';        
        }
        
         return $StringCheck;                                                          
	} 

	
 }
?>