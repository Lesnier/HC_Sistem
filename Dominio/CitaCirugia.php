<?php
 class CitaCirugia
 {
 	public function Consultar_CitaCirugia($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_cir"=>$res->fields[0],
			"id_pac"=>$res->fields[1],
			"id_userregs"=>$res->fields[2],
			"cirj_cir"=>$res->fields[3],
			"antes_cir"=>$res->fields[4],
			"ayudan_cir"=>$res->fields[5],
			"fechaciru_cir"=>$res->fields[6],
			"horacir_cir"=>$res->fields[7],
			"duraccionop_cir"=>$res->fields[8],
			"procedimi_cir"=>$res->fields[9],
			"tiempohosp_cir"=>$res->fields[10],
			"observacion_cir"=>$res->fields[11],
			"estado_cir"=>$res->fields[12],
			"fecha"=>$res->fields[13]
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