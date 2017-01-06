<?php
 class ConsenRep
 {
 	public function Consultar_ConsenRep($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_cir"=>$res->fields[0],
							"nrep_cir"=>$res->fields[1],
							"pare_cir"=>$res->fields[2],
							"tel_cir"=>$res->fields[3],
							"ced_cir"=>$res->fields[4],
							"insts_cir"=>$res->fields[5],
							"unip_cir"=>$res->fields[6],
							"codu_cir"=>$res->fields[7],
							"parr_cir"=>$res->fields[8],
							"can_cir"=>$res->fields[9],
							"pro_cir"=>$res->fields[10],
							"nuh_cir"=>$res->fields[11],
							"apm_cir"=>$res->fields[12],
							"app_cir"=>$res->fields[13],
							"nom_cir"=>$res->fields[14],
							"ser_cir"=>$res->fields[15],
							"sal_cir"=>$res->fields[16],
							"cam_cir"=>$res->fields[17],
							"fech_cir"=>$res->fields[18],
							"hor_cir"=>$res->fields[19],
							"est_cir"=>$res->fields[20],
							"id_pac"=>$res->fields[21],
							"id_tu"=>$res->fields[22]
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