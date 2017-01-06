<?php
 class ExamenFisico
 {
 	public function Consultar_ExamenFisico($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("id_examen_fisico"=>$res->fields[0],
			"biotipo_constitucional"=>$res->fields[1],
			"actitud"=>$res->fields[2],
			"estado_conciencia"=>$res->fields[3],
			"glasgow"=>$res->fields[4],
			"temperatura"=>$res->fields[5],
			"presion_arterial"=>$res->fields[6],
			"frecuencia_cardiaca"=>$res->fields[7],
			"frecuencia_respiratoria"=>$res->fields[8],
			"peso"=>$res->fields[9],
			"talla"=>$res->fields[10],
			"indice_masa_corporal"=>$res->fields[11],
			"perimetro_cefalico"=>$res->fields[12],
			"perimetro_toracico"=>$res->fields[13],
			"perimetro_abdominal"=>$res->fields[14],
			"peso_ideal"=>$res->fields[15],
			"tension_arterial_acostado"=>$res->fields[16],
			"tension_arterial_sentado"=>$res->fields[17],
			"tension_arterial_de_pie"=>$res->fields[18],
			"superficie_corporal"=>$res->fields[19],
			"piel"=>$res->fields[20],
			"cabeza_cuello_conopcion"=>$res->fields[21],
			"cuello_conopcion"=>$res->fields[22],
			"torax_conopcion"=>$res->fields[23],
			"abdomen_conopcion"=>$res->fields[24],
			"aparato_urinario"=>$res->fields[25],
			"aparato_digestivo"=>$res->fields[26],
			"aparato_genital_masculino"=>$res->fields[27],
			"aparato_genital_femenino"=>$res->fields[28],
			"sistema_musculo_esqueletico"=>$res->fields[29],
			"sistema_nervioso"=>$res->fields[30],
			"id_pac"=>$res->fields[31],
			"CCFascies"=>$res->fields[32],
			"CCOjos"=>$res->fields[33],
			"CCNariz"=>$res->fields[34],
			"CCBoca"=>$res->fields[35],
			"CCOidos"=>$res->fields[36],
			"CCFaringe"=>$res->fields[37],
			"CForma"=>$res->fields[38],
			"CMovimientos"=>$res->fields[39],
			"CPiel"=>$res->fields[40],
			"CPartesBlandas"=>$res->fields[41],
			"CTiroides"=>$res->fields[42],
			"CGanglios"=>$res->fields[43],
			"TRespiratorios"=>$res->fields[44],
			"TPiel"=>$res->fields[45],
			"TBlandas"=>$res->fields[46],
			"TMamas"=>$res->fields[47],
			"TCorazon"=>$res->fields[48],
			"TPulmones"=>$res->fields[49],
			"AbdomenPiel"=>$res->fields[50],
			"Abdomenvolumen"=>$res->fields[51],
			"volumenPartesBlandas"=>$res->fields[52],
			"id_tu"=>$res->fields[53]
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