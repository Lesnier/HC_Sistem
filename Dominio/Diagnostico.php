<?php
 class CodigoDiagnostico
 {
 	public function Consultar_CodigoDiagnostico($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
				"id_cie"=>$res->fields[0],
				"codigo_cie"=>$res->fields[1]
				,"descripcion_cie"=>$res->fields[2],
				"tipo_cie"=>$res->fields[3],
				"estado_cie"=>$res->fields[4]
				
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