<?php
 class Expediente
 {
 	public function Consultar_Expediente($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_exp"=>$res->fields[0],
							"fech_expe"=>$res->fields[1],
							"hora_expe"=>$res->fields[2],
							"evo_expe"=>$res->fields[3],
							"prescr_expe"=>$res->fields[4],
							"medicam_expe"=>$res->fields[5],
							"est_expe"=>$res->fields[6],
							"id_pac"=>$res->fields[7]
							
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