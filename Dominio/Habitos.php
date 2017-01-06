<?php
 class Habitos
 {
 	public function Consultar_Habitos($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_hab"=>$res->fields[0],"tabaco_hab"=>$res->fields[1],"alcohol_hab"=>$res->fields[2],"drogas_hab"=>$res->fields[3],"medicamentos_hab"=>$res->fields[4],"ejercicio_hab"=>$res->fields[5],"tipodieta_hab"=>$res->fields[6],"vacunas_hab"=>$res->fields[7],"estado_hab"=>$res->fields[8]);
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