<?php
 class Solicitud
 {
 	public function Consultar_Solicitud($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_intsoli"=>$res->fields[0],
			"insti_intsoli"=>$res->fields[1],
			"uniop_intsoli"=>$res->fields[2],
			"cod_intsoli"=>$res->fields[3],
			"parr_intsoli"=>$res->fields[4],
			"cant_intsoli"=>$res->fields[5],
			"prov_intsoli"=>$res->fields[6],
			"hiscl_intsoli"=>$res->fields[7],
			"ape_intsoli"=>$res->fields[8],
			"nom_intsoli"=>$res->fields[9],
			"cedc_intsoli"=>$res->fields[10],
			"fechatn_intsoli"=>$res->fields[11],
			"hora_intsoli"=>$res->fields[12],
			"edad_intsoli"=>$res->fields[13],
			"gen_intsoli"=>$res->fields[14],
			"estciv_intsoli"=>$res->fields[15],
			"instr_intsoli"=>$res->fields[16],
			"emprtr_intsoli"=>$res->fields[17],
			"segsa_intsoli"=>$res->fields[18],
			"estades_intsoli"=>$res->fields[19],
			"sercon_intsoli"=>$res->fields[20],
			"serso_intsoli"=>$res->fields[21],
			"sala_intsoli"=>$res->fields[22],
			"cama_intsoli"=>$res->fields[23],
			"norm_intsoli"=>$res->fields[24],
			"urge_intsoli"=>$res->fields[25],
			"medin_intsoli"=>$res->fields[26],
			"cuadcl_intsoli"=>$res->fields[27],
			"respru_intsoli"=>$res->fields[28],
			"cie1_intsoli"=>$res->fields[29],
			"cie2_intsoli"=>$res->fields[30],
			"cie3_intsoli"=>$res->fields[31],
			"cie4_intsoli"=>$res->fields[32],
			"cie5_intsoli"=>$res->fields[33],
			"cie6_intsoli"=>$res->fields[34],
			"cod1_intsoli"=>$res->fields[35],
			"cod2_intsoli"=>$res->fields[36],
			"cod3_intsoli"=>$res->fields[37],
			"cod4_intsoli"=>$res->fields[38],
			"cod5_intsoli"=>$res->fields[39],
			"cod6_intsoli"=>$res->fields[40],
			"pre1_intsoli"=>$res->fields[41],
			"pre2_intsoli"=>$res->fields[42],
			"pre3_intsoli"=>$res->fields[43],
			"pre4_intsoli"=>$res->fields[44],
			"pre5_intsoli"=>$res->fields[45],
			"pre6_intsoli"=>$res->fields[46],
			"def1_intsoli"=>$res->fields[47],
			"def2_intsoli"=>$res->fields[48],
			"def3_intsoli"=>$res->fields[49],
			"def4_intsoli"=>$res->fields[50],
			"def5_intsoli"=>$res->fields[51],
			"def6_intsoli"=>$res->fields[52],
			"plante_intsoli"=>$res->fields[53],
			"planed_intsoli"=>$res->fields[54],
			"serv_intsoli"=>$res->fields[55],
			"med_intsoli"=>$res->fields[56],
			"codmed_intsoli"=>$res->fields[57],
			"id_pac"=>$res->fields[58],
			"est_intsoli"=>$res->fields[59],
			"id_med"=>$res->fields[60]);
			
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
 }
?>