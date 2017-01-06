<?php
 class Estomatognatico
 {
 	public function Consultar_Estomatognatico($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_estoma"=>$res->fields[0],
							"lab_estoma"=>$res->fields[1],
							"mej_estoma"=>$res->fields[2],
							"msup_estoma"=>$res->fields[3],
							"minf_estoma"=>$res->fields[4],
							"len_estoma"=>$res->fields[5],
							"pal_estoma"=>$res->fields[6],
							"pis_estoma"=>$res->fields[7],
							"carr_estoma"=>$res->fields[8],
							"glsa_estoma"=>$res->fields[9],
							"far_estoma"=>$res->fields[10],
							"atm_estoma"=>$res->fields[11],
							"gan_estoma"=>$res->fields[12],
							"det_estoma"=>$res->fields[13],
							"est__estoma"=>$res->fields[14],
							"id_pac"=>$res->fields[15]
							
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