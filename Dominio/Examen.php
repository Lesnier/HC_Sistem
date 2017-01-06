<?php
 class Examen
 {
 	public function Consultar_Examen($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_exa"=>$res->fields[0],
			"desc_exa"=>$res->fields[1],
			"id_tu"=>$res->fields[2],
			"otrosori_exa"=>$res->fields[3],
			"estliq_exa"=>$res->fields[4],
			"muestra_exa"=>$res->fields[5],
			"diasno_exa"=>$res->fields[6],
			"otroselec_exa"=>$res->fields[7]
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