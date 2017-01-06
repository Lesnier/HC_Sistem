<?php
 class Turno
 {
 	public function Consultar_Turno($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_tu"=>$res->fields[0],"id_usu"=>$res->fields[1],"id_pac"=>$res->fields[2],"id_hor"=>$res->fields[3],"fechaR_tu"=>$res->fields[4],"fechaC_tu"=>$res->fields[5],"usuarioR_tu"=>$res->fields[6],"numero_tur"=>$res->fields[7],"estado_tur"=>$res->fields[8],"estadoEmer_tur"=>$res->fields[9],"estadoPa_tur"=>$res->fields[8]);
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