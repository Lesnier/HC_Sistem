<?php
 class Informe
 {
 	public function Consultar_Informe($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_intinfo"=>$res->fields[0],
			"instisis_intinfo"=>$res->fields[1],
			"uniope_intinfo"=>$res->fields[2],
			"code_intinfo"=>$res->fields[3],
			"parroq_intinfo"=>$res->fields[4],
			"canton_intinfo"=>$res->fields[5],
			"prov_intinfo"=>$res->fields[6],
			"histcl_intinfo"=>$res->fields[7],
			"cuadcl_intinfo"=>$res->fields[8],
			"pruebdi_intinfo"=>$res->fields[9],
			"dign1_intinfo"=>$res->fields[10],
			"dign2_intinfo"=>$res->fields[11],
			"dign3_intinfo"=>$res->fields[12],
			"dign4_intinfo"=>$res->fields[13],
			"dign5_intinfo"=>$res->fields[14],
			"dign6_intinfo"=>$res->fields[15],
			"cod1_intinfo"=>$res->fields[16],
			"cod2_intinfo"=>$res->fields[17],
			"cod3_intinfo"=>$res->fields[18],
			"cod4_intinfo"=>$res->fields[19],
			"cod5_intinfo"=>$res->fields[20],
			"cod6_intinfo"=>$res->fields[21],
			"pre1_intinfo"=>$res->fields[22],
			"pre2_intinfo"=>$res->fields[23],
			"pre3_intinfo"=>$res->fields[24],
			"pre4_intinfo"=>$res->fields[25],
			"pre5_intinfo"=>$res->fields[26],
			"pre6_intinfo"=>$res->fields[27],
			"def1_intinfo"=>$res->fields[28],
			"def2_intinfo"=>$res->fields[29],
			"def3_intinfo"=>$res->fields[30],
			"def4_intinfo"=>$res->fields[31],
			"def5_intinfo"=>$res->fields[32],
			"def6_intinfo"=>$res->fields[33],
			"plantep_intinfo"=>$res->fields[34],
			"planedp_intinfo"=>$res->fields[35],
			"resumcri_intinfo"=>$res->fields[36],
			"serv_intinfo"=>$res->fields[37],
			"medico_intinfo"=>$res->fields[38],
			"codeme_intinfo"=>$res->fields[39],
			"id_pac"=>$res->fields[40],
			"est_intinfo"=>$res->fields[41],
			"id_med"=>$res->fields[42]);
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