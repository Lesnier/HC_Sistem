<?php
 class PlanesDiagnostico
 {
 	public function Consultar_PlanesDiagnostico($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_planesdi"=>$res->fields[0],
							"biometria_planesdi"=>$res->fields[1],
							"quimicasan_planesdi"=>$res->fields[2],
							"rayosx_planesdi"=>$res->fields[3],
							"otros_planesdi"=>$res->fields[4],
							"detalle_planesdi"=>$res->fields[5],
							"id_pac"=>$res->fields[6],
							"est_planesdi"=>$res->fields[7]
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