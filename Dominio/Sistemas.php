<?php
 class Sistemas
 {
 	public function Consultar_Sistemas($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_sist"=>$res->fields[0],
			"auditivo_sist"=>$res->fields[1],
			"oftalmo_sist"=>$res->fields[2],
			"otorrino_sist"=>$res->fields[3],
			"nervioscra_sist"=>$res->fields[4],
			"digestivo_sist"=>$res->fields[5],
			"renal_sist"=>$res->fields[6],
			"pulmonar_sist"=>$res->fields[7],
			"cardiovas_sist"=>$res->fields[8],
			"oseao_sist"=>$res->fields[9],
			"ginecoobst_sist"=>$res->fields[10],
			"otros_sist"=>$res->fields[11],
			"estado_sist"=>$res->fields[12],
			"endocrino_sist"=>$res->fields[13]
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