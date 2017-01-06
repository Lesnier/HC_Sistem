<?php
 class Consulta
 {
 	public function Consultar_ConsultaHoy($user,$fecha)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT
tu.id_tu as Codigo,
tu.numero_tur as Numero_Turno,
pac.cedula_pac as Cedula_Paciente,
pac.nombresCom_pac as Nombres_Paciente,
pac.id_pac as CodigoPaciente,
h.hora_hor,
tu.estadoEmer_tur,
tu.estadoPa_tur
FROM tbl_turno tu, tbl_paciente pac, tbl_usuario us, tbl_hora h
WHERE tu.id_usu=us.id_usu AND  us.login_usu='$user' AND pac.id_pac=tu.id_pac AND tu.fechaC_tu='$fecha' AND tu.estado_tur='AE' AND tu.id_hor=h.id_hor ORDER BY tu.id_tu ASC
");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("Codigo"=>$res->fields[0],"Numero_Turno"=>$res->fields[1],"Cedula_Paciente"=>$res->fields[2],"Nombres_Paciente"=>$res->fields[3],"CodigoPaciente"=>$res->fields[4],"hora_hor"=>$res->fields[5],"estadoEmer_tur"=>$res->fields[6],"estadoPa_tur"=>$res->fields[7]);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}
	
	public function Consultar_ConsultasHoyAll($user,$fecha)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT 
tu.id_tu as Codigo,
tu.numero_tur as Numero_Turno,
pac.cedula_pac as Cedula_Paciente,
pac.nombresCom_pac as Nombres_Paciente,
pac.id_pac as CodigoPaciente,
h.hora_hor,
tu.estadoEmer_tur,
tu.estadoPa_tur
FROM tbl_turno tu, tbl_paciente pac, tbl_usuario us, tbl_hora h
WHERE us.login_usu='$user' AND tu.fechaC_tu='$fecha' AND pac.id_pac=tu.id_pac AND tu.id_hor=h.id_hor AND tu.estado_tur='AE' ORDER BY tu.id_tu ASC

");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("Codigo"=>$res->fields[0],"Numero_Turno"=>$res->fields[1],"Cedula_Paciente"=>$res->fields[2],"Nombres_Paciente"=>$res->fields[3],"CodigoPaciente"=>$res->fields[4],"hora_hor"=>$res->fields[5],"estadoEmer_tur"=>$res->fields[6],"estadoPa_tur"=>$res->fields[7]);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;		
	}
	
	public function Consultar_HistorialPaciente($codigo)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT c.diagnostico_cons,c.examenes_cons,c.tratamiento_cons, t.fechaC_tu, c.id_cons FROM tbl_consultas c, tbl_turno t, tbl_paciente p
WHERE c.id_tu=t.id_tu AND t.id_pac=p.id_pac AND p.id_pac='$codigo'");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("diagnostico_cons"=>$res->fields[0],"examenes_cons"=>$res->fields[1],"tratamiento_cons"=>$res->fields[2],"fechaC_tu"=>$res->fields[3],"id_cons"=>$res->fields[4]);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}
	
	public function Consultar_VerReceta($codigo)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT r.indicaciones, f.descripcion_far, f.foto_far FROM tbl_receta r, tbl_farmacos f WHERE r.id_cons='$codigo' AND r.id_far=f.id_far");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("indicaciones"=>$res->fields[0],"descripcion_far"=>$res->fields[1],"foto_far"=>$res->fields[2]);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}
		
 	public function Consultar_Receta($consulta)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("SELECT fa.descripcion_far ,re.cantidad,re.indicaciones FROM tbl_receta re,tbl_farmacos fa WHERE id_cons='$consulta' AND re.id_far=fa.id_far");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("descripcion_far"=>$res->fields[0],"cantidad"=>$res->fields[1],"indicaciones"=>$res->fields[2]);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}
 	public function Consultar_Historia($cedula)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT 
tu.fechaC_tu as Fecha_Consulta,
c.desc_diag as Diagnostico,
con.tratamiento_cons as Tratamiento,
con.vademecun_cons as Medicamentos


FROM 
tbl_consultas con, tbl_turno tu, tbl_paciente pac, tbl_cie c
WHERE con.id_tu=tu.id_tu AND tu.id_pac=pac.id_pac and c.id_diag=con.id_cie AND pac.cedula_pac='$cedula'		
		");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("Fecha_Consulta"=>$res->fields[0],"Diagnostico"=>$res->fields[1],"Tratamiento"=>$res->fields[2],"Medicamentos"=>$res->fields[3]);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}

 	public function Consultar_Historia2($cedula)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT 
tu.fechaC_tu as Fecha_Consulta,
c.desc_diag as Diagnostico,
con.tratamiento_cons as Tratamiento,
con.vademecun_cons as Medicamentos


FROM 
tbl_consultas con, tbl_turno tu, tbl_paciente pac, tbl_cie c
WHERE con.id_tu=tu.id_tu AND tu.id_pac=pac.id_pac and c.id_diag=con.id_cie AND pac.id_pac='$cedula'		
		");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("Fecha_Consulta"=>$res->fields[0],"Diagnostico"=>$res->fields[1],"Tratamiento"=>$res->fields[2],"Medicamentos"=>$res->fields[3]);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}

	
 	public function Consultar_PacienteEmer($fecha,$hora,$medico)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT p.nombresCom_pac , t.estadoEmer_tur FROM tbl_turno t, tbl_paciente p WHERE t.fechaR_tu='$fecha' AND t.id_hor='$hora' AND t.id_pac= p.id_pac AND t.id_usu='$medico'");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("nombresCom_pac"=>$res->fields[0],"estadoEmer_tur"=>$res->fields[1]);
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
	
	//inicio conculta Cirugia
public function Consultar_hoy_cirugia($user,$fecha)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT
tu.id_tu as Codigo,
tu.numero_tur as Numero_Turno,
pac.cedula_pac as Cedula_Paciente,
pac.nombresCom_pac as Nombres_Paciente,
pac.id_pac as CodigoPaciente,
h.hora_hor,
tu.estadoEmer_tur,
tu.estadoPa_tur,
lg.Lugar_Cirugia,
tu.TipoCirugia
FROM tbl_turno tu, tbl_paciente pac, tbl_usuario us, tbl_hora h, tbl_lugar_turno lt, tbl_lugar lg
WHERE tu.id_usu=us.id_usu AND  us.login_usu='$user' AND pac.id_pac=tu.id_pac AND tu.fechaC_tu='$fecha' AND tu.estado_tur='AE' AND tu.id_tu=lt.id_tu AND lt.id_lugar=lg.id_lugar  AND tu.id_hor=h.id_hor  ORDER BY tu.id_tu ASC
");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("Codigo"=>$res->fields[0],"Numero_Turno"=>$res->fields[1],"Cedula_Paciente"=>$res->fields[2],"Nombres_Paciente"=>$res->fields[3],"CodigoPaciente"=>$res->fields[4],"hora_hor"=>$res->fields[5],"estadoEmer_tur"=>$res->fields[6],"estadoPa_tur"=>$res->fields[7],"Lugar_Cirugia"=>$res->fields[8],);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}
//fin de la consulta Cirugia

//inicio consulta para la consulta hitoria cirugia
public function Consultar_HistoriaCir($cedula)
	{
		$base=new Conexion;
		$con=$base->conectardb();
		$res=$con->Execute("
SELECT
tu.fechaC_tu as FechaIngreso,
tu.fechaR_tu as FechaAlta,  
tu.TipoCirugia as TipoCirugia,
l.Lugar_Cirugia as LugarCirugia,
tu.estadoPa_tur as Pago,
tu.honorario_Cirugia as Honorario,
pa.nombresCom_pac as Nombres

FROM tbl_turno tu, tbl_lugar_turno tl, tbl_lugar l, tbl_paciente pa
WHERE tu.id_pac=pa.id_pac  AND pa.cedula_pac='$cedula' AND tu.id_tu=tl.id_tu AND l.id_lugar=tl.id_lugar ORDER BY tu.fechaC_tu  DESC
		");
		$datos=array();
		while(!$res->EOF)
		{
			$datos[]=array("FechaIngreso"=>$res->fields[0],
			"FechaAlta"=>$res->fields[1],
			"TipoCirugia"=>$res->fields[2],
			"LugarCirugia"=>$res->fields[3],
			"Pago"=>$res->fields[4],
			"Honorario"=>$res->fields[5],
			);
			$res->MoveNext();
		}
		$res->Close();
		return $datos;
	}
//fin de la consulta historia cirugia

	
	
	
 }
?>