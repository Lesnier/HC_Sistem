<?php
 class Epicrisis
 {
 	public function Consultar_Epicrisis($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_epi"=>$res->fields[0],
			"id_user"=>$res->fields[1],
			"id_tu"=>$res->fields[2],
			"unidadop_epi"=>$res->fields[3],
			"parroquia_epi"=>$res->fields[4],
			"canton_epi"=>$res->fields[5],
			"provincia_epi"=>$res->fields[6],
			"fechaat_epi"=>$res->fields[7],
			"hora_epi"=>$res->fields[8],
			"empresa_epi"=>$res->fields[9],
			"segurosa_epi"=>$res->fields[10],
			"rdcc_epi"=>$res->fields[11],
			"rdeyc"=>$res->fields[12],
			"hrdeyp_epi"=>$res->fields[13],
			"rdtypt_epi"=>$res->fields[14],
			"cdeyp_epi"=>$res->fields[15],
			"altd_epi"=>$res->fields[16],
			"alttr_epi"=>$res->fields[17],
			"asin_epi"=>$res->fields[18],
			"disleve_epi"=>$res->fields[19],
			"dismod_epi"=>$res->fields[20],
			"disgra_epi"=>$res->fields[21],
			"retirovo_epi"=>$res->fields[22],
			"retiinvo_epi"=>$res->fields[23],
			"defant_epi"=>$res->fields[24],
			"defdes_epi"=>$res->fields[25],
			"diases_epi"=>$res->fields[26],
			"diasin_epi"=>$res->fields[27],
			"medicos_epi"=>$res->fields[28],
			"medico_epi"=>$res->fields[29],
			"codigo_epi"=>$res->fields[30],
			"estado_epi"=>$res->fields[31],

			"txti1"=>$res->fields[32],
			"txtic1"=>$res->fields[33],
			"txtipr1"=>$res->fields[34],
			"txtid1"=>$res->fields[35],

			"txti2"=>$res->fields[36],
			"txtic2"=>$res->fields[37],
			"txtipr2"=>$res->fields[38],
			"txtid2"=>$res->fields[39],

			"txti3"=>$res->fields[40],
			"txtic3"=>$res->fields[41],
			"txtipr3"=>$res->fields[42],
			"txtid3"=>$res->fields[43],

			"txti4"=>$res->fields[44],
			"txtic4"=>$res->fields[45],
			"txtipr4"=>$res->fields[46],
			"txtid4"=>$res->fields[47],

			"txti5"=>$res->fields[48],
			"txtic5"=>$res->fields[49],
			"txtipr5"=>$res->fields[50],
			"txtid5"=>$res->fields[51],

			"txte1"=>$res->fields[52],
			"txtec1"=>$res->fields[53],
			"txtepr1"=>$res->fields[54],
			"txtede1"=>$res->fields[55],

			"txte2"=>$res->fields[56],
			"txtec2"=>$res->fields[57],
			"txtepr2"=>$res->fields[58],
			"txtede2"=>$res->fields[59],

			"txte3"=>$res->fields[60],
			"txtec3"=>$res->fields[61],
			"txtepr3"=>$res->fields[62],
			"txtede3"=>$res->fields[63],

			"txte4"=>$res->fields[64],
			"txtec4"=>$res->fields[65],
			"txtepr4"=>$res->fields[66],
			"txtede4"=>$res->fields[67],

			"txte5"=>$res->fields[68],
			"txtec5"=>$res->fields[69],
			"txtepr5"=>$res->fields[70],
			"txtede5"=>$res->fields[71]

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
 }
?>