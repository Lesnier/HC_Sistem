<?php
 class Anamnesis
 {
 	public function Consultar_Anamnesis($sql)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute($sql);
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array(
			"id_anam"=>$res->fields[0],
			"motivocon_anam"=>$res->fields[1],
			"enfermedac_anam"=>$res->fields[2],
			"id_habitos"=>$res->fields[3],
			"id_sistemas"=>$res->fields[4],
			"tiposangre_anam"=>$res->fields[5],
			"nopatologicos_anam"=>$res->fields[6],
			"alergias_anam"=>$res->fields[7],
			"cardiovaculares_anam"=>$res->fields[8],
			"metabolicos_anam"=>$res->fields[9],
			"infescciosos_anam"=>$res->fields[10]
			,"neoplastias_anam"=>$res->fields[11],
			"endocrono_anam"=>$res->fields[12],
			"pulmonares_anam"=>$res->fields[13],
			"nefro_anam"=>$res->fields[14],
			"hemato_anam"=>$res->fields[15],
			"esquele_anam"=>$res->fields[16],
			"inmuno_anam"=>$res->fields[17],
			"ginecoobste_anam"=>$res->fields[18],
			"otros_anam"=>$res->fields[19],
			"cardiovasfam_anam"=>$res->fields[20],
			"metabofam_anam"=>$res->fields[21],
			"infeccfam_anam"=>$res->fields[22],
			"neoplasfam_anam"=>$res->fields[23],
			"endocronofam_anam"=>$res->fields[24],
			"pulmofam_anam"=>$res->fields[25],
			"nefrolofam_anam"=>$res->fields[26],
			"hematofam_anam"=>$res->fields[27],
			"esquelefam_anam"=>$res->fields[28],
			"inmunofam_anam"=>$res->fields[29],
			"otrosfam_anam"=>$res->fields[30],
			"estado_anam"=>$res->fields[31],
			"id_paciente"=>$res->fields[32],
			"fecha_anam"=>$res->fields[33],
			"id_tu"=>$res->fields[34],
			"gastroe_anam"=>$res->fields[35]);
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