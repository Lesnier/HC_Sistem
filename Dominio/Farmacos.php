<?php
 class Farmacos
 {
 	public function Consultar_Farmacos($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_far"=>$res->fields[0],"descripcion_far"=>$res->fields[1],"foto_far"=>$res->fields[2],"Fecaduca_far"=>$res->fields[3],"estock_far"=>$res->fields[4],"estado_far"=>$res->fields[5],"presentacion_farm"=>$res->fields[6]);
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