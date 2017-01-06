<?php

class Consultas
{
 	public function Consultar_Consultas($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_cons"=>$res->fields[0],
			"fechaProx_cons"=>$res->fields[1],
			"estado_cons"=>$res->fields[2],
			"diagnostico_cons"=>$res->fields[3],
			"examenes_cons"=>$res->fields[4],
			"tratamiento_cons"=>$res->fields[5],
			"id_tu"=>$res->fields[6],
			"id_cie"=>$res->fields[7],
			"vademecun_cons"=>$res->fields[8],
			"cantidad_cons"=>$res->fields[9],
			"dosis_cons"=>$res->fields[10],
			"viaAdmin_cons"=>$res->fields[11],
			"frecuencia_cons"=>$res->fields[12],
			"duracion_cons"=>$res->fields[13],
			"nomcomercial_cons"=>$res->fields[14],
			"numduracion_cons"=>$res->fields[15]
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