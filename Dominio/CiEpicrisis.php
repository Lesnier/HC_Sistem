<?php
 class CiEpicrisis
 {
 	public function Consultar_CiEpicrisis($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_ciepi"=>$res->fields[0],
			"id_pac"=>$res->fields[1],
			"descripcion_ciepi"=>$res->fields[2],
			"codigo_ciepi"=>$res->fields[3],
			"pre_ciepi"=>$res->fields[4],
			"def_ciepi"=>$res->fields[5],
			"fecha_ciepi"=>$res->fields[6],
			"estado_ciepi"=>$res->fields[7],
			"pos_ciepi"=>$res->fields[8]
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