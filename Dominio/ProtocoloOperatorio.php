<?php
 class ProtocoloOperatorio
 {
 	public function Consultar_ProtocoloOperatorio($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
					"id_pop"=>$res->fields[0],
					"id_cir"=>$res->fields[1],
					"servicio_pop"=>$res->fields[2],
					"postoperatorio_pop"=>$res->fields[3],
					"cirugiaefectuada_pop"=>$res->fields[4],
					"anestesiologo_pop"=>$res->fields[5],
					"coocirujano_pop"=>$res->fields[6],
					"instrumentista_pop"=>$res->fields[7],
					"priayudante_pop"=>$res->fields[8],
					"circulante_pop"=>$res->fields[9],
					"segayudante_pop"=>$res->fields[10],
					"datecirugia_pop"=>$res->fields[11],
					"tipanestesiologo_pop"=>$res->fields[12],
					"horainicio_pop"=>$res->fields[13],
					"etiempoquirugico_pop"=>$res->fields[14],
					"hallazgos_pop"=>$res->fields[15],
					"procedimientos_pop"=>$res->fields[16],
					"preparadopor_pop"=>$res->fields[17],
					"date2_pop"=>$res->fields[18],
					"date3_pop"=>$res->fields[19],
					"aprobadopor_pop"=>$res->fields[20],
					"estado_pop"=>$res->fields[21],
					"cirujano_pop"=>$res->fields[22],
					"user_pop"=>$res->fields[23],
					"preop_pop"=>$res->fields[24],
					"horafin_pop"=>$res->fields[25],
					"complicaciones_pop"=>$res->fields[26],
					"sangrado_pop"=>$res->fields[27],
					"histopatologia_pop"=>$res->fields[28],
					"ecografista_pop"=>$res->fields[29],
					"preop2_pop"=>$res->fields[30],
					"preop3_pop"=>$res->fields[31],
					"postop2_pop"=>$res->fields[32],
					"postop3_pop"=>$res->fields[33],
					"cirugiaefc2_pop"=>$res->fields[34],
					"cirugiaefc3_pop"=>$res->fields[35],
					"cirujano3_pop"=>$res->fields[36],
					"dignhisp_pop"=>$res->fields[37]

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