<?php
 class log
 {
 	public function Consultar_log($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
					"id"=>$res->fields[0],
					"usuario"=>$res->fields[1],
					"fecha"=>$res->fields[2],
					"hora"=>$res->fields[3],
					"ip"=>$res->fields[4],
					"navegador"=>$res->fields[5],
					"accion"=>$res->fields[6]

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