<?php
 class Usuario
 {
 	public function Consultar_Usuario($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_usu"=>$res->fields[0],
			"cedula_usu"=>$res->fields[1],
			"apellidos_usu"=>$res->fields[2],
			"nombres_usu"=>$res->fields[3],
			"nombresCom_usu"=>$res->fields[4],
			"edad_usu"=>$res->fields[5],
			"login_usu"=>$res->fields[6],
			"pass_usu"=>$res->fields[7],
			"direccion_usu"=>$res->fields[8],
			"estado_usu"=>$res->fields[9],
			"id_rol"=>$res->fields[10],
			"id_esp"=>$res->fields[11],
			"libro_usu"=>$res->fields[12],
			"folio_usu"=>$res->fields[13],
			"num_usu"=>$res->fields[14],
			"img_usu"=>$res->fields[15],
			"url_usu"=>$res->fields[16]);
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