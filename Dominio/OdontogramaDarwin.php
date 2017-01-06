<?php
 class OdontogramaDarwin
 {
 	public function Consultar_OdontogramaDarwin($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_odo"=>$res->fields[0],
			"up"=>$res->fields[1],
			"right"=>$res->fields[2],
			"down"=>$res->fields[3],
			"left"=>$res->fields[4],
			"center"=>$res->fields[5],
			"box1"=>$res->fields[6],
			"box2"=>$res->fields[7],
			"treatment"=>$res->fields[8],
			"tooth"=>$res->fields[9],
			"person"=>$res->fields[10]
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