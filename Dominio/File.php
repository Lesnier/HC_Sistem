<?php
 class File
 {
 	public function Consultar_File($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
				"id_fil"=>$res->fields[0],
				"id_pac"=>$res->fields[1]
				,"url_fil"=>$res->fields[2],
				"nombre_fil"=>$res->fields[3],
				"ubicacion_fil"=>$res->fields[4],
				"estado_fil"=>$res->fields[5],
				"fecha_fil"=>$res->fields[6]
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