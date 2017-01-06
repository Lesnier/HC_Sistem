<?php
 class SignosVitales
 {
 	public function Consultar_SignosVitales($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_signvit"=>$res->fields[0],
							"prearte_signvit"=>$res->fields[1],
							"frecar_signvit"=>$res->fields[2],
							"tempeac_signvit"=>$res->fields[3],
							"frespirat_signvit"=>$res->fields[4],
							"est_signvit"=>$res->fields[5],
							"id_pac"=>$res->fields[6]);
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