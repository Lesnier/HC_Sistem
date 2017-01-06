<?php
 class Paciente
 {
 	public function Consultar_Paciente($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
					"id_pac"=>$res->fields[0],
					"cedula_pac"=>$res->fields[1],
					"apellidos_pac"=>$res->fields[2],
					"nombres_pac"=>$res->fields[3],
					"nombresCom_pac"=>$res->fields[4],
					"fechaN_pac"=>$res->fields[5],
					"direccion_pac"=>$res->fields[6],
					"estado_pac"=>$res->fields[7],
					"nombresReferencia_pac"=>$res->fields[8],
					"telefonoReferencia_pac"=>$res->fields[9],
					"direccionFamAmCon_pac"=>$res->fields[10],
					"pasaporte_pac"=>$res->fields[11],
					"sexo_pac"=>$res->fields[12],
					"lugarnac_pac"=>$res->fields[13],
					"lugresid_pac"=>$res->fields[14],
					"raza_pac"=>$res->fields[15],
					"religion_pac"=>$res->fields[16],
					"instruccion_pac"=>$res->fields[17],
					"profesion_pac"=>$res->fields[18],
					"ocupacion_pac"=>$res->fields[19],
					"telefono_pac"=>$res->fields[20],
					"telefonoTra_pac"=>$res->fields[21],
					"celular_pac"=>$res->fields[22],
					"estadociv_pac"=>$res->fields[23],
					"condicion_pac"=>$res->fields[24],
					"correo_pac"=>$res->fields[25],
					"otros_pac"=>$res->fields[26],
					"alerta_pac"=>$res->fields[27],
					"autorizacion_pac"=>$res->fields[28],
					"fechaiauto_pac"=>$res->fields[29],
					"fechafauto_pac"=>$res->fields[30],
					"condi2_pac"=>$res->fields[31],
					"auxmovimiento_pac"=>$res->fields[32],
					"medico"=>$res->fields[33]
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
			return 1;
		}
	}
 }
?>