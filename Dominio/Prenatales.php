<?php
 class Prenatales
 {
 	public function Consultar_Prenatales($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_prenatal"=>$res->fields[0],
							"prenag_prenatal"=>$res->fields[1],
							"prenaa_prenatal"=>$res->fields[2],
							"prenap_prenatal"=>$res->fields[3],
							"prenac_prenatal"=>$res->fields[4],
							"condicionem_prenatal"=>$res->fields[5],
							"nac_prenatal"=>$res->fields[6],
							"edadges_prenatal"=>$res->fields[7],
							"peso_prenatal"=>$res->fields[8],
							"talla_prenatal"=>$res->fields[9],
							"pc_prenatal"=>$res->fields[10],
							"apgar1_prenatal"=>$res->fields[11],
							"apgar2_prenatal"=>$res->fields[12],
							"complicanac_prenatal"=>$res->fields[13],
							"screening_prenatal"=>$res->fields[14],
							"est_prenatal"=>$res->fields[15],
							"id_pac"=>$res->fields[16]
							
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