<?php
 class SaludBucal
 {
 	public function Consultar_SaludBucal($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_indicasb"=>$res->fields[0],
							"piezas16_indicasb"=>$res->fields[1],
							"piezas17_indicasb"=>$res->fields[2],
							"piezas55_indicasb"=>$res->fields[3],
							"piezas11_indicasb"=>$res->fields[4],
							"piezas21_indicasb"=>$res->fields[5],
							"piezas51_indicasb"=>$res->fields[6],
							"piezas26_indicasb"=>$res->fields[7],
							"piezas27_indicasb"=>$res->fields[8],
							"piezas65_indicasb"=>$res->fields[9],
							"piezas36_indicasb"=>$res->fields[10],
							"piezas37_indicasb"=>$res->fields[11],
							"piezas75_indicasb"=>$res->fields[12],
							"piezas31_indicasb"=>$res->fields[13],
							"piezas41_indicasb"=>$res->fields[14],
							"piezas71_indicasb"=>$res->fields[15],
							"piezas46_indicasb"=>$res->fields[16],
							"piezas47_indicasb"=>$res->fields[17],
							"piezas85_indicasb"=>$res->fields[18],
							"placaval1_indicasb"=>$res->fields[19],
							"placaval2_indicasb"=>$res->fields[20],
							"placaval3_indicasb"=>$res->fields[21],
							"placaval4_indicasb"=>$res->fields[22],
							"placaval5_indicasb"=>$res->fields[23],
							"placaval6_indicasb"=>$res->fields[24],
							"placares_indicasb"=>$res->fields[25],
							"claculoval1_indicasb"=>$res->fields[26], 
							"claculoval2_indicasb"=>$res->fields[27], 
							"claculoval3_indicasb"=>$res->fields[28],
							"claculoval4_indicasb"=>$res->fields[29],
							"claculoval5_indicasb"=>$res->fields[30],
							"claculoval6_indicasb"=>$res->fields[31],
							"claculores_indicasb"=>$res->fields[32],
							"gingivitisval1_indicasb"=>$res->fields[33],
							"gingivitisval2_indicasb"=>$res->fields[34],
							"gingivitisval3_indicasb"=>$res->fields[35],
							"gingivitisval4_indicasb"=>$res->fields[36],
							"gingivitisval5_indicasb"=>$res->fields[37],
							"gingivitisval6_indicasb"=>$res->fields[38], 
							"gingivitisres_indicasb"=>$res->fields[39], 
							"enfperiodonleve_indicasb"=>$res->fields[40],
							"enfperiodonmode_indicasb"=>$res->fields[41],
							"enfperiodonseve_indicasb"=>$res->fields[42],
							"maloclucionangle1_indicasb"=>$res->fields[43],
							"maloclucionangle2_indicasb"=>$res->fields[44],
							"maloclucionangle3_indicasb"=>$res->fields[45],
							"fluorosisleve_indicasb"=>$res->fields[46],
							"fluorosismode_indicasb"=>$res->fields[47],
							"fluorosisseve_indicasb"=>$res->fields[48],
							"estado_indicasb"=>$res->fields[49]
							
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