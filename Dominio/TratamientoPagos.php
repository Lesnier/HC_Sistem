<?php
 class TratamientoPagos
 {
 	public function Consultar_TratamientoPagos($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_pla"=>$res->fields[0],
							"act_pla"=>$res->fields[1],
							"num_pla"=>$res->fields[2],
							"preuni_pla"=>$res->fields[3],
							"total_pla"=>$res->fields[4],
							"fech_pla"=>$res->fields[5],
							"abono_pla"=>$res->fields[6],
							"numfa_pla"=>$res->fields[7],
							"che_pla"=>$res->fields[8],
							"efect_pla"=>$res->fields[9],
							"saldo_pla"=>$res->fields[10],
							"id_pac"=>$res->fields[11],
							"id_tu"=>$res->fields[12],
							"est_pla"=>$res->fields[13]
							
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