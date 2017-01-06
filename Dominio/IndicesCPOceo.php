<?php
 class IndicesCPOceo
 {
 	public function Consultar_IndicesCPOceo($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_cpoceo"=>$res->fields[0],
							"c1_cpoceo"=>$res->fields[1],
							"p1_cpoceo"=>$res->fields[2],
							"o1_cpoceo"=>$res->fields[3],
							"totalD_cpoceo"=>$res->fields[4],
							"c2_cpoceo"=>$res->fields[5],
							"e2_cpoceo"=>$res->fields[6],
							"o2_cpoceo"=>$res->fields[7],
							"totalD2_cpoceo"=>$res->fields[8],
							"id_pac"=>$res->fields[9],
							"estado_cpoceo"=>$res->fields[10]
							
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