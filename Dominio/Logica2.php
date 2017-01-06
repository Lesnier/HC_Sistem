<?php
class Logica2{
	//funcion para definir la hora actual del ecuador
	public function Mifecha()
	{
		$timestamp=time();
		$diferenciahorasgmt = (date('Z', time()) / 3600 - (-5)) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
		$timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
		//$fecha1 = date("l jS \of F Y h:i:s A", $timestamp_ajuste); //mostramos la fecha/hora
		$fecha1 = date("y-m-d", $timestamp_ajuste);
		return $fecha1;		
	}
	//fin de al funcio para definir la hora actual del ecuador
	//funcion para definir la hora actual del ecuador
	public function MiHora()
	{
		$timestamp=time();
		$diferenciahorasgmt = (date('Z', time()) / 3600 - (-5)) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
		$timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
		//$fecha1 = date("l jS \of F Y h:i:s A", $timestamp_ajuste); //mostramos la fecha/hora
		$fecha1 = date("H:i:s", $timestamp_ajuste);
		return $fecha1;		
	}
	//fin de al funcio para definir la hora actual del ecuador	
	//funcion para calcular la edad de los paciente 
	public function Edad($fecha)
	{
			list($anio,$mes,$dia) = explode("-",$fecha);
			$anio_dif = date("Y") - $anio;
			/*$mes_dif = date("m") - $mes;
			$dia_dif = date("d") - $dia;
			if ($dia_dif < 0 || $mes_dif < 0)
			$anio_dif--;
			$edActu=$anio_dif." años, con ".$mes." meses , y ".$dia_dif." dias";


			return 	$edActu;*/
			
			
			//calculado el año 
			list($Y,$m,$d) = explode("-",$fecha);
	    	$yearLight =( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );

			$fecha_de_nacimiento =$fecha; 
			$fecha_actual =$this->Mifecha(); 



			// separamos en partes las fechas 
			$array_nacimiento = explode ( "-", $fecha_de_nacimiento ); 
			$array_actual = explode ( "-", $fecha_actual ); 

			$anos =  $array_actual[0] - $array_nacimiento[0]; // calculamos años 
			$meses = $array_actual[1] - $array_nacimiento[1]; // calculamos meses 
			$dias =  $array_actual[2] - $array_nacimiento[2]; // calculamos días 

			//ajuste de posible negativo en $días 
			if ($dias < 0) 
			{ 
			    --$meses; 

		    //ahora hay que sumar a $dias los dias que tiene el mes anterior de la fecha actual 
		   switch ($array_actual[1]) { 
           case 1:     $dias_mes_anterior=31; break; 
           case 2:     $dias_mes_anterior=31; break; 
           case 3:  
                if ($this->bisiesto($array_actual[0])) 
                { 
                    $dias_mes_anterior=29; break; 
                } else { 
                    $dias_mes_anterior=28; break; 
                } 
           case 4:     $dias_mes_anterior=31; break; 
           case 5:     $dias_mes_anterior=30; break; 
           case 6:     $dias_mes_anterior=31; break; 
           case 7:     $dias_mes_anterior=30; break; 
           case 8:     $dias_mes_anterior=31; break; 
           case 9:     $dias_mes_anterior=31; break; 
           case 10:     $dias_mes_anterior=30; break; 
           case 11:     $dias_mes_anterior=31; break; 
           case 12:     $dias_mes_anterior=30; break; 
    	} 

	    $dias=$dias + $dias_mes_anterior; 
		} 

		//ajuste de posible negativo en $meses 
		if ($meses < 0) 
		{ 
		    --$anos; 
		   $meses=$meses + 12; 
		} 

			 $edad="$yearLight años con $meses meses y $dias días";			
			 return $edad;
			
	}
	private function bisiesto($anio_actual){ 
	   $bisiesto=false; 
	   //probamos si el mes de febrero del año actual tiene 29 días 
		 if (checkdate(2,29,$anio_actual)) 
		 { 
		  $bisiesto=true; 
	   } 
	   return $bisiesto; 
	}
	//fin de la funcion para calcular la edad de lospaciente



	/*
	* logica para el protocolo operatorio
	*/
	public function LoadCitasCirugiaXDoc(){
		$cc=new CitaCirugia;
		session_start();
		$log=$_SESSION['DOCTOR'];
		$today=$this->Mifecha();
		$datos=NULL;
		$id=$cc->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$log';");
		$cir=$cc->Consultar("SELECT  COUNT(*) FROM tbl_citacirugia WHERE id_userregs='$id' AND fechaciru_cir='$today' AND estado_cir!='K' ;");
		$antes=$cc->Consultar("SELECT  COUNT(*) FROM tbl_citacirugia WHERE antes_cir='$id' AND fechaciru_cir='$today' AND estado_cir!='K' ;");
		$ayud=$cc->Consultar("SELECT  COUNT(*) FROM tbl_citacirugia WHERE ayudan_cir='$id' AND fechaciru_cir='$today' AND estado_cir!='K' ;");
		if ($cir!=0 || $antes!=0 || $ayud!=0 ) {

			if($cir>0)$datos=$cc->Consultar_CitaCirugia("SELECT  * FROM tbl_citacirugia WHERE id_userregs='$id' AND fechaciru_cir='$today' AND estado_cir!='K' ;");
			if($antes>0)$datos=$cc->Consultar_CitaCirugia("SELECT  * FROM tbl_citacirugia WHERE antes_cir='$id' AND fechaciru_cir='$today' AND estado_cir!='K' ;");
			if($ayud>0)$datos=$cc->Consultar_CitaCirugia("SELECT  * FROM tbl_citacirugia WHERE ayudan_cir='$id' AND fechaciru_cir='$today' AND estado_cir!='K' ;");
			echo"<table  class='table table-bordered table-hover table-condensend table-striped'>
				<tr>
					<td colspan='7'><center><h3>Citas Cirujia De Hoy</h3></center></td>
				</tr>
				<tr> 
					<td>Hora</td>
					<td>Cirujano</td>
					<td>Anestesiologo</td>
					<td>Ayudante</td>
					<td>Paciente</td>
					<td>Cirujia</td>
					<td></td>
				</tr>
			";
			foreach ($datos as $fila) {
				$cirujano=$cc->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila[id_userregs]';");
				$anestesiologo=$cc->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila[antes_cir]';");
				$ayudante=$cc->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila[ayudan_cir]';");
				$paciente=$cc->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]';");
				$paciente=utf8_encode($paciente);
				$hora=$cc->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$fila[horacir_cir]';");
				echo "
						
						<tr> 
							<td>$hora</td>
							<td>$cirujano</td>
							<td>$anestesiologo</td>
							<td>$ayudante</td>
							<td>$paciente</td>
							<td>$fila[procedimi_cir]</td>
							<td><a class='btn btn-success'  onclick='protooperatorio($fila[id_cir])' >Protocolo Operatorio</a></td>
						</tr>
				";
			}
			echo"</table>";
		}
	}

	/*
	* fin logica para el protocolo operatorio
	*/	

	/*
	* logica para modificar la agenda de cirurgoia
	*/
	public function ModificarCitaCiruPOrAdmDow($code){
	$pac=new Paciente;
	$cit=new CitaCirugia;
	$ti=new Hora;
	$codigo=$pac->Consultar("SELECT id_pac FROM tbl_citacirugia WHERE id_cir='$code';");
	$nombre=$pac->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codigo';");
	$fecha_de_nacimiento=$pac->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo';");
	$edadpaciend=$this->Edad($fecha_de_nacimiento);
	$datos=$ti->Consultar_Hora("SELECT * FROM tbl_hora;");

	$fechaCir=$cit->Consultar("SELECT fechaciru_cir FROM tbl_citacirugia WHERE id_cir='$code';");
	$pos=$cit->Consultar("SELECT horacir_cir FROM tbl_citacirugia WHERE id_cir='$code';");
	$est=$cit->Consultar("SELECT estado_cir FROM tbl_citacirugia WHERE id_cir='$code';");
	$durop=$cit->Consultar("SELECT duraccionop_cir FROM tbl_citacirugia WHERE id_cir='$code';");


	$ciru=$cit->Consultar("SELECT id_userregs FROM tbl_citacirugia WHERE id_cir='$code';");
	$cirujano=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ciru';");

	$ant=$cit->Consultar("SELECT antes_cir FROM tbl_citacirugia WHERE id_cir='$code';");
	$antestesiologo=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ant';");
	
	$ayu=$cit->Consultar("SELECT ayudan_cir FROM tbl_citacirugia WHERE id_cir='$code';");
	$ayudante=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ayu';");
	
	$procedimie=$cit->Consultar("SELECT procedimi_cir FROM tbl_citacirugia WHERE id_cir='$code';");
	
	$tiemh=$cit->Consultar("SELECT tiempohosp_cir FROM tbl_citacirugia WHERE id_cir='$code';");

	$vec = explode(" ", $tiemh);

	$obser=$cit->Consultar("SELECT observacion_cir FROM tbl_citacirugia WHERE id_cir='$code';");
	
	echo "
		<table class='table table-bordered table-hover table-condensend table-striped'>
			<tr>
				<th>Paciente :</th>
				<td>$nombre</td>
				<th>Edad :</th>
				<td>$edadpaciend</td>
			</tr>
			<tr>
				<th>Fecha De Cirugia:</th>
				<td><input type='date' id='txtfecprocir' value='$fechaCir'/></td>
				<th>Hora:</th>
				<td><select id='cmb_horacir'><option>--Seleccione un hora--</option>
				";
				foreach ($datos as $fila) {
					echo "<option value='$fila[id_hor]'>$fila[hora_hor]</option>";
				}
			echo "
				</select>
				</td>
			</tr>
			<tr>
				<th>Duraccion operacion:</th>
				<td colspan='3'><div class='input-append'><input type='text' id='txtduropera' value='$durop' class='span4' /><a class='btn' ><i class='icon-time'></i>Horas</a></div></td>
			</tr>
			<tr>
				<th>Cirujano:</th>
				<td colspan='3'><input type='text' id='txtCirujano' value='$cirujano' class='txtcirugia' /> <a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='SearCirujano()'><i class='icon-plus'></i> Cirujano</a></td>
			</tr>
			<tr>
				<th>Anestesiologo:</th>
				<td colspan='3'><input type='text' id='txtanestesiologo' value='$antestesiologo'  class='txtcirugia'/>  <a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='SearchAnestesiologo();'><i class='icon-plus'></i> Anestesiologo</a></td>
			</tr>
			<tr>
				<th>Ayudante:</th>
				<td colspan='3'><input type='text' id='txtayudante' value='$ayudante'  class='txtcirugia'/> <a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='SearchAyudante()'><i class='icon-plus'></i> Ayudante</a></td>
			</tr>
			<tr>
				<th>Procedimiento:</th>
				<td colspan='3'><textarea id='txtprocedicirug'  cols='200' rows='2' class='txtcirugia2'>$procedimie</textarea></td>
			</tr>
			<tr>
				<th>Tiempo de hospitalizacion:</th>
				<td colspan='3'><input type='text' id='txttiempohospital' value='$vec[0]'  style='width:60px;'/><select id='cmb_destiemhosp'><option value=''>--Seleccione--</option><option value='Horas'>Horas</option><option value='Dias'>Dias</option><option value='Semanas'>Semanas</option><option value='Meses'>Meses</option></select></td>
			</tr>
			<tr>
				<th>Observaciones:</th>
				<td colspan='3'><textarea id='txtobservaciones' cols='200' rows='2' class='txtcirugia2'>$obser</textarea></td>
			</tr>
			<tr>
				<td colspan='4'><center><a class='btn btn-success' onclick='ModificarCitaCirujia($code)' ><i class='icon-file'></i>Guardar</a>   <a class='btn btn-primary' onclick='CloseCitCir()' ><i class='icon-file'></i>Cancelar</a></center></td>
			</tr>
		</table>


		<script type='text/javascript'>
			switch ('$est') {
				case 'P':
					$('#cmbEstado').prop('selectedIndex','1');
					break;
				
				case 'C':
					$('#cmbEstado').prop('selectedIndex','2');
					break;

				case 'K':
					$('#cmbEstado').prop('selectedIndex','3');
					break;
			}

			$('#cmb_horacir').prop('selectedIndex','$pos');
			$('#cmb_destiemhosp').val('$vec[1]');
			$('#thtcodciruja').val('$ciru');
			$('#thtcodantesi').val('$ant');
			$('#thtcodayudan').val('$ayu');
		</script>
	";


	}
	public function SaveModificarCirugiaCita($cirj_cir,$antes_cir,$ayudan_cir,$fechaciru_cir,$horacir_cir,$duraccionop_cir,$procedimi_cir,$tiempohosp_cir,$observacion_cir,$code){
	$cicir=new CitaCirugia;
	$cicir->Ejecutar("UPDATE tbl_citacirugia SET id_userregs='$cirj_cir',  antes_cir='$antes_cir', ayudan_cir='$ayudan_cir', fechaciru_cir='$fechaciru_cir',horacir_cir='$horacir_cir', duraccionop_cir='$duraccionop_cir',procedimi_cir='$procedimi_cir', tiempohosp_cir='$tiempohosp_cir',observacion_cir='$observacion_cir' WHERE id_cir='$code';");

	//capturando acciones
		session_start();
		$idusu2015=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"UPDATE tbl_citacirugia SET id_userregs=$cirj_cir,  antes_cir=$antes_cir, ayudan_cir=$ayudan_cir, fechaciru_cir=$fechaciru_cir,horacir_cir=$horacir_cir, duraccionop_cir=$duraccionop_cir,procedimi_cir=$procedimi_cir, tiempohosp_cir=$tiempohosp_cir,observacion_cir=$observacion_cir WHERE id_cir=$code;");
		$cicir->Ejecutar($sql2015);
		//capturando acciones

	echo $this->Msm("v", "Se guardaron correctamente los datos de la cita");
}
	/*
	* fin de la logica para modificar la agenda de cirurgoia
	*/


 public function HoraCirugia($fecha){
 
        $aux=new CitaCirugia;
            $aux1=new Usuario;
            $aux2=new Hora;
            $dato=$aux->Consultar_CitaCirugia("SELECT * FROM tbl_citacirugia WHERE fechaciru_cir='$fecha'");
         //capturando acciones
		session_start();
		$idusu2015=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"SELECT * FROM tbl_citacirugia WHERE fechaciru_cir=$fecha");
		$aux->Ejecutar($sql2015);
		//capturando acciones

            echo "
            <select id='cmb_horacir' > <option value=''>Seleccione un horario</option>";
            if(count($dato)>0)
            {
                    $tu= array();
                    $ho= array();
                    foreach($dato as $fila)
                    {
                        $tu[]=($fila['horacir_cir']);
                    }
                    $dato1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
                        foreach($dato1 as $fila1)
                        {
                                $ho[]=($fila1['id_hor']);
                        }
                         
                        $contar=count($ho);
                        for($x=0;$x<count($tu);$x++)
                        {
                            for($y=0;$y<count($ho);$y++)
                            {
                                if(isset($ho[$y])){
                                if($ho[$y]==$tu[$x])
                                {
                                    Unset($ho[$y]);
                                }
                                }
                            }
                        }
 
                        for($z=0;$z<$contar;$z++)
                        {
                            if(isset($ho[$z]))
                            {
                            $des=$aux1->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$ho[$z]' ");
                            echo "<option value='$ho[$z]'>$des</option>";
                            }
 
                        }
            }
            else
            {
                $datos1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
                foreach($datos1 as $filas1)
                {
                    echo "<option value='$filas1[id_hor]'>$filas1[hora_hor]</option>";
                }
            }
 
             
            echo "</select>
             
                    <script type='text/javascript'>                       
                        $('#bntDarTurno').button();                     
                    </script>
             
            ";
    }


 public function HoraCitaMedica($fecha){
 
        $aux=new Turno;
            $aux1=new Usuario;
            $aux2=new Hora;
            $dato=$aux->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaR_tu='$fecha';");
            echo "
            <select id='cmb_horacir02' > <option value=''>Seleccione un horario</option>";
            if(count($dato)>0)
            {
                    $tu= array();
                    $ho= array();
                    foreach($dato as $fila)
                    {
                        $tu[]=($fila['id_hor']);
                    }
                    $dato1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
                        foreach($dato1 as $fila1)
                        {
                                $ho[]=($fila1['id_hor']);
                        }
                         
                        $contar=count($ho);
                        for($x=0;$x<count($tu);$x++)
                        {
                            for($y=0;$y<count($ho);$y++)
                            {
                                if(isset($ho[$y])){
                                if($ho[$y]==$tu[$x])
                                {
                                    Unset($ho[$y]);
                                }
                                }
                            }
                        }
 
                        for($z=0;$z<$contar;$z++)
                        {
                            if(isset($ho[$z]))
                            {
                            $des=$aux1->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$ho[$z]' ");
                            echo "<option value='$ho[$z]'>$des</option>";
                            }
 
                        }
            }
            else
            {
                $datos1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
                foreach($datos1 as $filas1)
                {
                    echo "<option value='$filas1[id_hor]'>$filas1[hora_hor]</option>";
                }
            }
 
             
            echo "</select>
             
                    <script type='text/javascript'>                       
                        $('#bntDarTurno').button();                     
                    </script>
             
            ";
    }

	

    public function ComprobarCI($cedula){
    	$pac=new Paciente;
    	$res=$pac->Consultar("SELECT COUNT(*) FROM tbl_paciente WHERE cedula_pac LIKE '$cedula%'");
    	echo $res;
    }
	
	public function ComprobarCIMed($cedula){
    	$usu=new Usuario;
    	$res=$usu->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE cedula_usu LIKE '$cedula%'");
    	echo $res;
    }

    public function BorrarPacenteXCOde($code){
    	$pac=new Paciente;
    	$res=$pac->Ejecutar("UPDATE tbl_paciente SET cedula_pac='', estado_pac='E' WHERE id_pac='$code';");
    	echo $this->Msm("r", "Se eliminó correctamente el paciente");
    }


    public function BuscarMedico002($buscar,$bt){
    	$doc=new Usuario;
    	$datos=$doc->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='1' AND estado_usu='A' AND cedula_usu LIKE '$buscar%' OR estado_usu='A' AND nombresCom_usu LIKE '%$buscar%';");
    	echo "
    		<div class='table-responsive'><table class='table table-striped table-condensend table-hover table-bordered'>
    		<tr>

    			<th>Médico</th>
    			<th>Especialidad</th>
    			<th></th>
    			
    		</tr>
    	";
    	foreach ($datos as $f) {
    		$espe=$doc->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$f[id_esp]';");
    		echo "<tr>
    				<td><div id='nommed$f[id_usu]'> $f[nombresCom_usu]</div></td>
    				<td>$espe</td>
    		";
    		if ($bt==1) {
    			echo "<td> <a class='btn ' data-dismiss='modal' aria-hidden='true' onclick='CatchDoc($f[id_usu])'> Agendar</a></td>";
    		}
    		if ($bt==2) {
    			echo "<td><center><a class='btn ' onclick='BuscarFechaMed($f[id_usu])'> Seleccionar Fecha</a></center></td>";
    		}
    		if ($bt==3) {
    			echo "<td><center><a class='btn ' data-dismiss='modal' aria-hidden='true'  onclick='CatchMedicoToPacient($f[id_usu])'> Seleccionar</a></center></td>";
    		}
    		echo "</tr>";
    	}
    	echo "
    		</table></div>
    	";
    }


    	//incio del combo de horas disponibles
		public function cargarhorario2($fecha,$iddoctor)
		{
			$aux=new Turno;
			$aux1=new Usuario;
			$aux2=new Hora;
			$dato=$aux->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$fecha' and id_usu='$iddoctor' AND estado_tur!='E';");
			echo "
			
			<select id='cmb_horacir02' > <option>Seleccione un horario</option>";
			if(count($dato)>0)
			{
					$tu= array();
					$ho= array();
					foreach($dato as $fila)
					{
						$tu[]=($fila['id_hor']);
					}
					$dato1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
						foreach($dato1 as $fila1)
						{
								$ho[]=($fila1['id_hor']);
						}
						
						$contar=count($ho);
						for($x=0;$x<count($tu);$x++)
						{
							for($y=0;$y<count($ho);$y++)
							{
								if(isset($ho[$y])){
								if($ho[$y]==$tu[$x])
								{
									Unset($ho[$y]);
								}
								}
							}
						}

						for($z=0;$z<$contar;$z++)
						{
							if(isset($ho[$z]))
							{
							$des=$aux1->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$ho[$z]' ");
							echo "<option value='$ho[$z]'>$des</option>";
							}

						}
			}
			else
			{
				$datos1=$aux2->Consultar_Hora("SELECT * FROM tbl_hora");
				foreach($datos1 as $filas1)
				{
					echo "<option value='$filas1[id_hor]'>$filas1[hora_hor]</option>";
				}
			}

			
			echo "</select>
			
			
			
			";
		}	
	//fin del combo de horas disponbles



		//buscador de citas de los medicos por fechas

	public function BuscarCitasMedicoXFechas($id,$fi,$ff){
		$tur=new Turno;
		$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$id' AND fechaC_tu>='$fi' AND fechaC_tu<='$ff' ORDER BY  id_hor ASC ;");
		echo "<div class='table-responsive'><table class='table table-bordered table-hover table-striped table-condensend'>
				<tr>
					<th colspan='6'><center><a href='#myModal' role='button' class='btn btn-primary' data-toggle='modal' id='bntPrintCitasMedXFe' onclick='ImprimirCitasMedicoXFecha($id,$fi,$ff)' style='font-family:Times New Roman, Georgia, Serif; color:white;' >Imprimir<a/></center></th>
				</tr>

				<tr>
					<th>Paciente</th>
					<th>Telefono</th>
					<th>Celular</th>
					<th>Fecha De la consulta</th>
					<th>Hora</th>
					<th></th>
				</tr>
		";
		if(count($datos)>0){
			foreach ($datos as $c) {
				$paciente=$tur->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$paciente=utf8_encode($paciente);
				$hora=$tur->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$c[id_hor]';");
				$TELEFONO=$tur->Consultar("SELECT telefono_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$Celular=$tur->Consultar("SELECT celular_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				echo "<tr>
						<td>$paciente</td>
						<td>$TELEFONO</td>
						<td>$Celular</td>
						<td>$c[fechaC_tu]</td>
						<td>$hora</td>
						
			";
			switch ($c["estado_tur"]) {
				case 'AE':
					 echo "<td>Agendada</td>";
					break;
				case 'E':
					 echo "<td>Cancelada</td>";
					break;
				case 'RM':
					 echo "<td>Completada</td>";
					break;
				
				
			}

			echo "</tr>";
			}
		}
		else{
			echo "
				<tr>
					<td colspan='6'> No se encontraron citas en las fechas seleccionadas</td>
				</tr>
			";
		}
		echo "</table></div>";
	}
		

public function BuscarDiaMedicoCita($id,$fecha){
		$fi=$fecha;
		

		$tur=new Turno;
		//$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$id' AND fechaR_tu>='$fi' AND fechaR_tu<='$ff';");
		$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$id' AND fechaC_tu='$fi'  ORDER BY  id_hor ASC ;");
		echo "<div class='table-responsive'><table class='table table-bordered table-hover table-striped table-condensend'>
				<tr>
					<td colspan='8'><center><a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' id='bntPrintCitasMes' onclick='ImprimirCitasXDia($id)' style='font-family:Times New Roman, Georgia, Serif; color:white;' >Imprimir<a/></center></td>
				</tr>

				<tr>
					<th>Paciente</th>
					<th>Telefono</th>
					<th>Celular</th>
					<th>Fecha De la consulta</th>
					<th>Hora</th>
					<th>Estado</th>
					<th>Fecha Ingreso</th>
					<th>Fecha Caducidad</th>
				</tr>
		";
		if(count($datos)>0){
			foreach ($datos as $c) {
				$paciente=$tur->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$paciente=utf8_encode($paciente);
				$TELEFONO=$tur->Consultar("SELECT telefono_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$Celular=$tur->Consultar("SELECT celular_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$hora=$tur->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$c[id_hor]';");

				$fechaRegistro=$tur->Consultar("SELECT fechaiauto_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$fechaFinRegistro=$tur->Consultar("SELECT fechafauto_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");

				echo "<tr>
						<td>$paciente</td>
						<td>$TELEFONO</td>
						<td>$Celular</td>
						<td>$c[fechaC_tu]</td>
						<td>$hora</td>
						
			";
			switch ($c["estado_tur"]) {
				case 'AE':
					 echo "<td>Agendada</td>";
					break;
				case 'E':
					 echo "<td>Cancelada</td>";
					break;
				case 'RM':
					 echo "<td>Completada</td>";
					break;
				
				
			}
				echo "
					<td>$fechaRegistro</td>
					<td>$fechaFinRegistro</td>

				";

			echo "</tr>";
			}
		}
		else{
			echo "
				<tr>
					<td colspan='8'> No se encontraron citas en las fechas seleccionadas</td>
				</tr>
			";
		}
		echo "</table></div>";

	}


		//fin del buscador de citas de los medicos por fechas

	public function DiasF($Month,$Year){
		return date("d",mktime(0,0,0,$Month+1,0,$Year));
	}
	public function BuscadorCitasXMes($id,$mes){
		$fi=date("y")."-".$mes."-01";
		$diasfin=$this->DiasF($mes,date("y"));
		$ff=date("y")."-".$mes."-$diasfin";

		$tur=new Turno;
		//$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$id' AND fechaR_tu>='$fi' AND fechaR_tu<='$ff';");
		$datos=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_usu='$id' AND fechaC_tu>='$fi' AND fechaC_tu<='$ff' ORDER BY  id_hor, fechaC_tu ASC ;");
		echo "<div class='table-responsive'><table class='table table-bordered table-hover table-striped table-condensend'>
				<tr>
					<td colspan='6'><center><a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' id='bntPrintCitasMes' onclick='ImprimirCitasXMes($id,$mes)' style='font-family:Times New Roman, Georgia, Serif; color:white;' >Imprimir<a/></center></td>
				</tr>

				<tr>
					<th>Paciente</th>
					<th>Telefono</th>
					<th>Celular</th>
					<th>Fecha De la consulta</th>
					<th>Hora</th>
					<th>Estado</th>
					<th>Fecha Ingreso</th>
					<th>Fecha Caducidad</th>
				</tr>
		";
		if(count($datos)>0){
			foreach ($datos as $c) {
				$paciente=$tur->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$paciente=utf8_encode($paciente);
				$TELEFONO=$tur->Consultar("SELECT telefono_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$Celular=$tur->Consultar("SELECT celular_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$hora=$tur->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$c[id_hor]';");

				$fechaRegistro=$tur->Consultar("SELECT fechaiauto_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");
				$fechaFinRegistro=$tur->Consultar("SELECT fechafauto_pac FROM tbl_paciente WHERE id_pac='$c[id_pac]';");

				echo "<tr>
						<td>$paciente</td>
						<td>$TELEFONO</td>
						<td>$Celular</td>
						<td>$c[fechaC_tu]</td>
						<td>$hora</td>
						
			";
			switch ($c["estado_tur"]) {
				case 'AE':
					 echo "<td>Agendada</td>";
					break;
				case 'E':
					 echo "<td>Cancelada</td>";
					break;
				case 'RM':
					 echo "<td>Completada</td>";
					break;
				
				
			}
				echo "
					<td>$fechaRegistro</td>
					<td>$fechaFinRegistro</td>

				";

			echo "</tr>";
			}
		}
		else{
			echo "
				<tr>
					<td colspan='6'> No se encontraron citas en las fechas seleccionadas*</td>
				</tr>
			";
		}
		echo "</table></div>";

	}


	//calcular fecha de vencimiento de autorizacion
	public function FechaVencimeitoAutorizacion($fecha_inicio){
		 if($fecha_inicio!=false) {
		          $fecha_base = strtotime($fecha_inicio);
		   }else {
		          $time=time();
		          $fecha_actual=date("Y-m-d",$time);
		          $fecha_base=strtotime($fecha_actual);
		   }
		   //tiempo de validez de autorización
		   //$calculo = strtotime("90 days","$fecha_base");
		   $calculo = strtotime("30 days","$fecha_base");
		 
		   echo  date("Y-m-d", $calculo);
	}
	public function ComprobarFechavencimiento($id_pac){
		$usu=new Usuario;
		$today=$this->Mifecha();
		$res=$usu->Consultar("SELECT COUNT(*) FROM tbl_paciente WHERE id_pac='$id_pac' AND fechafauto_pac>='$today';");
		echo $res;
	}
	//calcular fehca de vencimiento de autorizacion fin



	/*modificar cita medica*/

	public function ModificarCitaMedica($codigo){
    $pac=new Paciente;
    $ti=new Hora;
    session_start();
   // $today=$this->Mifecha();
    //$today="20".$today;
    $log=NULL;
    if(isset($_SESSION['ENFERMERA'])) $log=$_SESSION['ENFERMERA'];
    elseif(isset($_SESSION['DOCTOR'])) $log=$_SESSION['DOCTOR'];


    $enfermera=$pac->Consultar("SELECT u.nombresCom_usu FROM tbl_turno t, tbl_usuario u WHERE t.id_tu='$codigo' AND t.usuarioR_tu=u.login_usu;");
    $nombre=$pac->Consultar("SELECT p.nombresCom_pac FROM tbl_turno t, tbl_paciente p WHERE t.id_tu='$codigo' AND t.id_pac=p.id_pac;");
    $nombre=utf8_encode($nombre);
    $fecha_de_nacimiento=$pac->Consultar("SELECT p.fechaN_pac FROM tbl_turno t, tbl_paciente p WHERE t.id_tu='$codigo' AND t.id_pac=p.id_pac;");
    $edadpaciend=$this->Edad($fecha_de_nacimiento);
    $idhora=$pac->Consultar("SELECT id_hor FROM tbl_turno WHERE id_tu='$codigo' ;");
    $datos=$ti->Consultar_Hora("SELECT * FROM tbl_hora;");

    $Nmedico=$pac->Consultar("SELECT u.nombresCom_usu FROM tbl_turno t, tbl_usuario u WHERE t.id_tu='$codigo' AND t.id_usu=u.id_usu;");

    $fechaR=$pac->Consultar("SELECT fechaC_tu FROM tbl_turno WHERE id_tu='$codigo' ;");
    $today=$pac->Consultar("SELECT fechaR_tu FROM tbl_turno WHERE id_tu='$codigo' ;");

    echo "
        <div class='table-responsive'><table class='table table-bordered table-hover table-condensend table-striped'>
            <tr>
                <th>Quien agenda: </th>
                <td>$enfermera</td>
                <th>Fecha de agenda:</th>
                <td>$today</td>
            </tr>
            <tr>
                <th>Paciente :</th>
                <td>$nombre</td>
                <th>Edad :</th>
                <td>$edadpaciend</td>
            </tr>
              <tr>
                <th>Medico:</th>
                <td colspan='2'><input type='text' id='txtmedicio22' class='txtcirugia' /> <a  href='#myModal' role='button'  data-toggle='modal' class='btn btn-success' onclick='BuscarDoctor()' ><i class='icon-plus'></i> Medico</a></td>
                <td>Medico actual : <strong>$Nmedico</strong></td>
            </tr>
            <tr>
                <th>Fecha De Cita:</th>
                <td><input type='date' id='txtfecprocir02' value='$fechaR' onchange='CargarHorarios02()'/></td>
                <th>Hora:</th>
                <td><div id='cmbhor02'><select id='cmb_horacir02'><option>--Seleccione un hora--</option>
                ";
                foreach ($datos as $fila) {
                    echo "<option value='$fila[id_hor]'>$fila[hora_hor]</option>";
                }
            echo "
                </select></div>
                </td>
            </tr>
            
            <tr>
                <td colspan='4'><center><a href='#' class='btn btn-success' onclick='SaveModificarTurno002($codigo)' ><i class='icon-file'></i>Guardar</a>
                	<!-- <a href='#' class='btn btn-info' onclick='CancelMOdifyCit()' >Cancelar</a> -->
                </center></td>
            </tr>
        </table></div>
        <script>
        	$('#cmb_horacir02').val('$idhora');
        </script>
    ";
 
}

	public function GuardarCambiosCitaMedica($paciente,$especialidad,$doctor,$fechaC,$hora,$codigoTurno)
	{
		
		$tu=new Turno;
		
		$tu->Ejecutar("UPDATE tbl_turno SET id_usu='$doctor', id_hor='$hora', fechaC_tu='$fechaC' WHERE id_tu='$codigoTurno';");
		$codigo=$codigoTurno;
		echo "
			<center>
			<table class='table table-bordered table-condensend table-hover table-striped'>
				<tr>
					<td>Se asigno el turno correctamente</td>
					<td><a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' id='bntImprimir' onclick='ImprimirTurno($codigo)' style='font-family:Times New Roman, Georgia, Serif; color:white;' >Imprimir Turno<a/></td>
					<td><input type='button' id='bntNewturno'  class='btn btn-primary' value='Revisar Agenda'/></td>
				</tr>
			  </table>
			  </center>
					<script type='text/javascript'>						
						
						$('#bntNewturno').click(function()
						{
							ShowCitaPacientes();
						});
					</script>			  
			  ";
	}










	/*buscar cirugias*/
	public function BuscadorCitasCirugiaXPac($buscar,$rol){
		$cir=new CitaCirugia;
		$pac=new Paciente;
		$today=$this->Mifecha();
		$buscar=utf8_decode($buscar);
		$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE cedula_pac LIKE '%$buscar%' AND estado_pac='A' OR nombresCom_pac like '%$buscar%' AND estado_pac='A'");

		echo "<div class='table-responsive'>
		<table class='table table-striped table-bordered table-condensend'>
				<tr>
					<th>Cédula</th>
					<th>Paciente</th>
					<th>Médico</th>
					<th>Fecha Cirugía</th>
					<th style='text-align:center'>Estado</th>
					<th>Fecha De Caducidad</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			$datos1=$cir->Consultar_CitaCirugia("SELECT * FROM tbl_citacirugia WHERE id_pac='$fila[id_pac]' AND fechaciru_cir>='$today' ORDER BY fechaciru_cir ASC;");
			//capturando acciones

			foreach ($datos1 as $fila1) {
				$medico=$cir->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila1[id_userregs]';");
				echo "
					<tr>
						<td>$fila[cedula_pac]</td>
					 	<td>".utf8_encode($fila["nombresCom_pac"])."</td>
					 	<td>$medico</td>
					 	<td>$fila1[fechaciru_cir]</td>
				";
				switch ($fila1['estado_cir']) {
					case 'P':
						echo "<td>PROVICIONADA</td>";
						break;
					case 'C':
						echo "<td>CONFRIMADA</td>";
						break;
					case 'K':
						echo "<td>CANCELADA</td>";
						break;
				}
				echo  "<td>$fila[fechafauto_pac]</td>";
				if($rol==1){
					echo "<td>
					<a  href='#myModal' role='button' class='btn  btn-success' data-toggle='modal' onclick='RedactarDatos($fila1[id_cir])' > Ver cita</a>
					</td>";
				}elseif($rol==2){
					echo "<td><input type='button' class='btn btn-primary' value='Ver Cita' onclick='RecarDatos($fila1[id_cir])' style='font-family:Times New Roman, Georgia, Serif; font-size:15px;'></td>";
				}elseif($rol==3){
					echo "<td><input type='button' class='btn btn-info' value='Iniciar Protocolo' onclick='IniProtocolo($fila1[id_cir])' style='font-family:Times New Roman, Georgia, Serif; font-size:15px;'/></td>";
				}
				echo "</tr>";
			}
		}
		echo "</table></div>";
	}
	/*buscar cirugias*/



	/*msm*/
	function Msm($p,$msm){
		switch ($p) {
			case 'v':
				echo "
					<div class='alert alert-success' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<center><h4>$msm</h4></center>
					</div>
				";

				break;
			case 'a':
				echo "
					<div class='alert alert-info' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<center><h4>$msm</h4></center>
					</div>
				";

				break;
			case 't':
				echo "
					<div class='alert alert-warning' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<center><h4>$msm</h4></center>
					</div>
				";

				break;
			case 'r':
				echo "
					<div class='alert alert-danger' role='alert'>
						<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
							<center><h4>$msm</h4></center>
					</div>
				";

				break;
			
			
		}
	}
	/*fin msm*/


	/* cargar de protocolos xD*/
	public function MakeProtocoloOPeratorio($idac,$rol){
		$cit=new CitaCirugia;
		$ho=new Hora;
		$pro=new ProtocoloOperatorio;
		$datos=$cit->Consultar_CitaCirugia("SELECT * FROM tbl_citacirugia WHERE id_cir='$idac' AND estado_cir='C';");

		//capturando acciones
		session_start();
		$idusu2015=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"SELECT * FROM tbl_citacirugia WHERE id_cir=$idac AND estado_cir=C;");
		$cit->Ejecutar($sql2015);
		
		//capturando acciones
		$exisprotoc=$cit->Consultar("SELECT COUNT(*) FROM tbl_protocoloperatorio WHERE id_cir='$idac';");
		$datos1=$ho->Consultar_Hora("SELECT * FROM tbl_hora");
		$datos2=$ho->Consultar_Hora("SELECT * FROM tbl_hora");
		
		if(count($datos)>0 & $exisprotoc==0){
			echo "<div class='table-responsive'>
			
			
			<table class='table table-bordered table-striped '>
			 ";
			foreach ($datos as $fila) {

				$CI=$cit->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]';");
				$NOMBRES=$cit->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]';");
				$NOMBRES=utf8_decode($NOMBRES);

				$CIRUJANO=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila[cirj_cir]';");
				$ANESTESIOLOGO=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila[antes_cir]';");
				echo "
				
					 <tr>
					 	<th colspan='2'>
					 		PROTOCOLO OPERTATORIO
					 	</th>
					 	<th colspan='2'>
					 		DPTO. CIRUGIA</BR>
					 		ENDOSCOPIA ANESTESIOLOGIA</BR>
					 		  <hr>
					 		SER.
					 		<input type='text' id='txtseranete'/>
					 	</th>
					 </tr>

					<tr>
						<td>NOMBRE:</td>
						<td><input type='text' id='txtnombre' value='$NOMBRES' readonly /></td>
						<td>CI:</td>
						<td><input type='text' id='txtci' value='$CI' readonly /></td>
					</tr>

					<tr>
						<th colspan='4'><center>A. DIAGNOSTICO </center></th>
					</tr>
					<tr>
						<td colspan='2'>PRE-OPERATORIO</td>
						<div class='col-xs-10'>
						<td colspan='2'><input type='text' id='txtpreoperatorio' value='$fila[procedimi_cir]' class='protocolos' onclick='OpenIess3()' 
						size='50'  />
						<br/>
						<input type='text' id='txtpreoperatorio2' class='protocolos' onclick='OpenIessAux2()' 
						size='50'  />
						<br/>
						<input type='text' id='txtpreoperatorio3' class='protocolos' onclick='OpenIessAux3()' 
						size='50'  />
						</div></td>
					</tr>

					<tr>
						<td colspan='2'>POST-OPERATORIO</td>
						<td colspan='2'>
						<input type='text' 
						onclick='OpenIess2()' class='protocolos'  id='txtpostoperatorio'/>
						<br/>
						<input type='text' 
						onclick='OpenPostAux2()' class='protocolos'  id='txtpostoperatorio2'/>
						<br/>
						<input type='text' 
						onclick='OpenPostAux3()' class='protocolos'  id='txtpostoperatorio3'/></td>
					</tr>

					<tr>
						<td colspan='2'>CIRUGIA EFECTUADA</td>
						<td colspan='2'>
						<input type='text' id='txtcirujiaefectuada' onclick='OpenIess()' class='protocolos'/>
						<br/>
						<input type='text' id='txtcirujiaefectuada2' onclick='OpenIessCirjAux2()' class='protocolos'/>
						<br/>
						<input type='text' id='txtcirujiaefectuad3' onclick='OpenIessCiruAux3()' class='protocolos'/></td>
					</tr>

					<tr>
						<th colspan='4'><center> </center></th>
					</tr>

					<tr>
						<td>1er CIRUJANO</td>
						<td><input type='text' id='txtcirujano' value='' onclick='MakeGeneralMedico(6)' /></td>
						<td>ANESTESIOLOGO</td>
						<td><input type='text' id='txtanestesiologo' value='' onclick='MakeGeneralMedico(1)' /></td>
					</tr>

					<tr>
						<td>2do CIRUJANO</td>
						<td><input type='text' onclick='MakeGeneralMedico(2)' id='txtcoocirujano' value=''/></td>
						<td>INSTRUMENTISTA</td>
						<td><input type='text' id='txtinstrumentista' value=''/></td>
					</tr>

					<tr>
						<td>3er CIRUJANO</td>
						<td><input type='text' onclick='MakeGeneralMedico(7)' id='txtcirujano3' value=''/></td>
						<td>CIRCULANTE</td>
						<td><input type='text' id='txtcirculante' value=''/></td>
					</tr>

					<tr>
						<td>PRIMER AYUDANTE</td>
						<td><input type='text' onclick='MakeGeneralMedico(3)' id='txtprimerayudante' value=''/></td>
						<td>ECOGRAFISTA</td>
						<td ><input type='text' id='txtecografista' value=''/></td>
					</tr>

					<tr>
						<td>SEGUNDO AYUDANTE</td>
						<td ><input type='text'  onclick='MakeGeneralMedico(4)' id='txtsegundoayudante' value=''/></td>

						<td colspan='2'>&nbsp;</td>

					</tr>

					<tr>
						<td colspan='2'>
							C. FECHA DE CIRUGIA</br>
							<input type='date' id='txtdatecirugina' onclick='hoy()'/></br>
							HORA INICIO:</br>
							<select id='cmb_hora'> <option value=''>--SELEECCIONE--</option>
							";
							foreach ($datos1 as $h) {
								echo "<option value='$h[id_hor]'>$h[hora_hor] </option>";
							}
					echo"
						 </select>
						 </br>HORA FIN:</br>
						 <select id='cmb_horaF'> <option value=''>--SELEECCIONE--</option>
							";
							foreach ($datos2 as $h2) {
								echo "<option value='$h2[id_hor]'>$h2[hora_hor] </option>";
							}
					echo"
						 </select>
						</td>
						<td colspan='2'>
							D. TIPO DE ANESTESIA</br>
							<input type='text' id='txtanestesia'/></br>
							E. TIEMPO QUIRURGICO</br>
							<input type='text' id='txttiempoquirujico' onclick='tiempoCirugia()'/>
						</td>
					</tr>

					<tr>
						<th colspan='4'><center>F. PROTOCOLO OPERTATORIO</center></th>
					</tr>

					<tr>
						<td>HALLAZGOS</td>
						<td colspan='3'><textarea id='txthallasgos' cols='100' rows='5' class='span5'></textarea></td>
					</tr>

					<tr>
						<td>E.T.O. </br>PROCEDIMIENTO</td>
						<td colspan='3'><textarea id='txtprocedimiento' cols='100' rows='5' class='span5'></textarea></td>
					</tr>

					
					<tr>
						<td>COMPLICACIONES</td>
						<td colspan='3'><textarea id='txtcomplicaciones' cols='100' rows='5' class='span5'></textarea></td>
					</tr>

					<tr>
						<td colspan='2'>
							SANGRADO<HR></BR>
							<input type='text' class='span4' id='txtsangrado'/>+/- CC
						</td>
						<td colspan='2'>
						<div class='divHistopatologia'>
							HISTOPATOLOGIA<HR></BR>
							<select class='span4' id='cmb_histopatologia' >
								<option value=''>--Seleccione--</option>
								<option value='SI'>SI</option>
								<option value='NO'>NO</option>
								<!-- onchange='validaHistopatologia()' -->
							</select>
						</div>
						</td>
					</tr>
					

					<tr>
						<td>
							PREPARADO POR:</br>
							<input type='text' onclick='MakeGeneralMedico(5)' id='txtpreparadopor'/>
						</td>
						<td>
							FECHA:</br>
							<input type='date' class='span8' id='txtfecha2' onclick='hoy()' />
						</td>
						<td>
							APROBADO POR:
						</td>
						<td>
							FECHA:</br>
							<input type='date' class='span8' id='txtfecha3' onclick='hoy()' />
						</td>
					</tr>

					<tr>
						<td colspan='4'>
							<center>
								
								<a href='#' class='btn btn-success' onclick='SaveProtocolo($idac)' id='btnCancelProtocolo'> Guardar</a> 

								<a href='#' class='btn btn-primary' onclick='CancelProtocolo()' id='btnCancelProtocolo' style='color:white;' > Cancelar</a>
							</center>
						</td>
					</tr>
				

				";
			}
			echo "</table></div>
			
			";
		}elseif(count($datos)==0 & $exisprotoc==0){
			$this->Msm("t","Esta cita no esta confirmada");
		}elseif($exisprotoc>0){

		
			$idUser=$_SESSION['IDUser'];
			$permisos=$pro->Consultar("SELECT id_rol FROM tbl_usuario WHERE id_usu='$idUser';");

			$datos2=$pro->Consultar_ProtocoloOperatorio("SELECT * FROM tbl_protocoloperatorio WHERE id_cir='$idac';");



			echo "<table class='table table-bordered table-striped '>";
			foreach ($datos2 as $fila2) {

				$CI1=$pro->Consultar("SELECT p.cedula_pac FROM tbl_citacirugia c, tbl_paciente p WHERE c.id_pac=p.id_pac AND c.id_cir='$fila2[id_cir]';");
				$NOMBRES1=$pro->Consultar("SELECT p.nombresCom_pac FROM tbl_citacirugia c, tbl_paciente p WHERE c.id_pac=p.id_pac AND c.id_cir='$fila2[id_cir]';");
				$NOMBRES1=utf8_decode($NOMBRES1);

				$NOMBRES1=$pro->Consultar("SELECT p.nombresCom_pac FROM tbl_citacirugia c, tbl_paciente p WHERE c.id_pac=p.id_pac AND c.id_cir='$fila2[id_cir]';");
			
				$Cirugia=$pro->Consultar("SELECT procedimi_cir FROM tbl_citacirugia WHERE id_cir='$fila2[id_cir]'");	

				$cirugiaefe=$pro->Consultar("SELECT CONCAT(codigo_ciess,' ',descripcion_ciess,' ',valor_ciess) FROM tbl_codigoiess WHERE id_ciess='$fila2[cirugiaefectuada_pop]';");	

				$CIRUJANO=$pro->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila2[cirujano_pop]';");

				$ANESTESIOLOGO=$pro->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila2[anestesiologo_pop]';");

				$COOCIRUJANO=$pro->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila2[coocirujano_pop]';");	

				$PRIMERAYUDANTE=$pro->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila2[priayudante_pop]';");	

				$SEGUNDOAYUDANTE=$pro->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila2[segayudante_pop]';");

				$PREPARADOPOR=$pro->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila2[preparadopor_pop]';");

				$HALLAZGOS=$pro->Consultar("SELECT hallazgos_pop FROM tbl_protocoloperatorio WHERE id_pop='$fila2[id_pop]'");

				$CIRUJANO3=$pro->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila2[cirujano3_pop]';");

				//estado = A  pueden ver todos  y modificar todos
				//estado = P  pueden ver todos pero no modificar expecto los medicos 

				switch ($fila2['estado_pop']) {
					case 'A':
						
				echo "

					 <tr>
					 	<th colspan='2'>
					 		PROTOCOLO OPERTATORIO
					 	</th>
					 	<th colspan='2'>
					 		DPTO. CIRUGIA</BR>
					 		ENDOSCOPIA ANESTESIOLOGIA</BR>
					 		  <hr>
					 		SER.
					 		<input type='text' id='txtseranete' value='$fila2[servicio_pop]'/>
					 	</th>
					 </tr>

					<tr>
						<td>NOMBRE:</td>
						<td><input type='text' id='txtnombre' value='$NOMBRES1' readonly /></td>
						<td>CI:</td>
						<td><input type='text' id='txtci' value='$CI1' readonly /></td>
					</tr>

					<tr>
						<th colspan='4'><center>A. DIAGNOSTICO </center></th>
					</tr>
					<tr>
						<td colspan='2'>PRE-OPERATORIO</td>
						<td colspan='2'>
						<input type='text' id='txtpreoperatorio' value='$fila2[preop_pop]' class='protocolos' onclick='OpenIess3()' />
						<br/>
						<input type='text' id='txtpreoperatorio2' value='$fila2[preop2_pop]' class='protocolos' onclick='OpenIessAux2()' />
						<br/>
						<input type='text' id='txtpreoperatorio3' value='$fila2[preop3_pop]' class='protocolos' onclick='OpenIessAux3()' />
						</td>
					</tr>

					<tr>
						<td colspan='2'>POST-OPERATORIO</td>
						<td colspan='2'>
						<input type='text' value='$fila2[postoperatorio_pop]' id='txtpostoperatorio' class='protocolos'/>
						<br/>
						<input type='text' value='$fila2[postop2_pop]' id='txtpostoperatorio2' class='protocolos' onclick='OpenPostAux2()' />
						<br/>
						<input type='text' value='$fila2[postop3_pop]' id='txtpostoperatorio3' class='protocolos' onclick='OpenPostAux3()' /></td>
					</tr>

					<tr>
						<td colspan='2'>CIRUGIA EFECTUADA</td>
						<td colspan='2'>  
						<input type='text' id='txtcirujiaefectuada' value='$cirugiaefe' class='protocolos' onclick='OpenIess()' />
						<br/>
						<input type='text' id='txtcirujiaefectuada2' value='$fila2[cirugiaefc2_pop]' class='protocolos' onclick='OpenIessCirjAux2()' />
						<br/>
						<input type='text' id='txtcirujiaefectuad3' value='$fila2[cirugiaefc3_pop]' class='protocolos' onclick='OpenIessCiruAux3()' />
						</td>
					</tr>

					<tr>
						<th colspan='4'><center> </center></th>
					</tr>

					<tr>
						<td>1er CIRUJANO</td>
						<td><input type='text' id='txtcirujano' value='$CIRUJANO' onclick='MakeGeneralMedico(6)' /></td>
						<td>ANESTESIOLOGO</td>
						<td><input type='text' id='txtanestesiologo' value='$ANESTESIOLOGO' onclick='MakeGeneralMedico(1)' /></td>
					</tr>

					<tr>
						<td>2do CIRUJANO</td>
						<td><input type='text' onclick='MakeGeneralMedico(2)' id='txtcoocirujano' value='$COOCIRUJANO'/></td>
						<td>INSTRUMENTISTA</td>
						<td><input type='text' id='txtinstrumentista' value='$fila2[instrumentista_pop]'/></td>
					</tr>

					<tr>
						<td>3er CIRUJANO</td>
						<td><input type='text' id='txtcirujano3' value='$CIRUJANO3' onclick='MakeGeneralMedico(7)' /></td>
						<td>CIRCULANTE</td>
						<td><input type='text' id='txtcirculante' value='$fila2[circulante_pop]'/></td>
					</tr>

					<tr>
							<td>PRIMER AYUDANTE</td>
						<td><input type='text' onclick='MakeGeneralMedico(3)' id='txtprimerayudante' value='$PRIMERAYUDANTE'/></td>
						<td>ECOGRAFISTA</td>
						<td ><input type='text' id='txtecografista' value='$fila2[ecografista_pop]'/></td>
					</tr>

					<tr>
						<td>SEGUNDO AYUDANTE</td>
						<td ><input type='text' id='txtsegundoayudante' value='$SEGUNDOAYUDANTE'/></td>

						<td colspan='2'>&nbsp;</td>
					</tr>

					<tr>
						<td colspan='2'>
							C. FECHA DE CIRUGIA</br>
							<input type='date' id='txtdatecirugina' value='$fila2[datecirugia_pop]' onclick='hoy()'/></br>
							HORA INICIO:</br>
							<select id='cmb_hora'> <option value=''>--SELEECCIONE--</option>
							";
							foreach ($datos1 as $h) {
								echo "<option value='$h[id_hor]'>$h[hora_hor] </option>";
							}
					echo"
						 </select></br>
						  HORA FIN:</br>
						 <select id='cmb_horaF' onchange='CalculaHora()'> <option value=''>--SELEECCIONE--</option>
							";
							foreach ($datos1 as $h) {
								echo "<option value='$h[id_hor]'>$h[hora_hor] </option>";
							}
					echo"
						 </select>
						</td>
						<td colspan='2'>
							D. TIPO DE ANESTESIA</br>
							<input type='text' id='txtanestesia' value='$fila2[tipanestesiologo_pop]'/></br>
							E. TIEMPO QUIRURGICO</br>
							<input type='text' id='txttiempoquirujico' value='$fila2[etiempoquirugico_pop]'/>
						</td>
					</tr>

					<tr>
						<th colspan='4'><center>F. PROTOCOLO OPERTATORIO</center></th>
					</tr>

					<tr>
						<td>HALLAZGOS</td>
						<td colspan='3'><textarea id='txthallasgos' cols='100' rows='5' class='span5'>$fila2[hallazgos_pop]</textarea></td>
					</tr>

					<tr>
						<td>E.T.O. </br>PROCEDIMIENTO</td>
						<td colspan='3'><textarea id='txtprocedimiento' cols='100' rows='5' class='span5'>$fila2[procedimientos_pop]</textarea></td>
					</tr>



					<tr>
						<td>COMPLICACIONES</td>
						<td colspan='3'><textarea id='txtcomplicaciones' cols='100' rows='5' class='span5'>$fila2[complicaciones_pop]</textarea></td>
					</tr>

					<tr>
						<td colspan='2'>
							SANGRADO<HR></BR>
							<input type='text' class='span4' value='$fila2[sangrado_pop]' id='txtsangrado'/>+/- CC
						</td>
						<td colspan='2'>
						HISTOPATOLOGIA<HR></BR>
								<select class='span4' id='cmb_histopatologia'>
								<option value=''>--Seleccione--</option>
								<option value='SI'>SI</option>
								<option value='NO'>NO</option>
							</select>
							<!-- <input type='text' name='txtHistopatologia' id='txtHistopatologia' class='span8' value='$fila2[dignhisp_pop]' /> -->
						</td>

					</tr>


					

					<tr>
						<td>
							PREPARADO POR:</br>
							<input type='text' onclick='MakeGeneralMedico(5)' id='txtpreparadopor' value='$PREPARADOPOR'/>
						</td>
						<td>
							FECHA:</br>
							<input type='date' class='span8' value='$fila2[date2_pop]' id='txtfecha2' onclick='hoy()' />
						</td>
						<td>
							APROBADO POR:
						</td>
						<td>
							FECHA:</br>
							<input type='date' class='span8' value='$fila2[date3_pop]' id='txtfecha3' onclick='hoy()' />
						</td>
					</tr>

					<tr>
						<td colspan='4'>
							<center>";

								switch ($permisos) {
									case 1: //medico
										echo "
											 <input type='button' value='Modificar' class='btn btn-primary' onclick='ModificarProtocolo($fila2[id_pop])' />
											 <input type='button' value='Aprobar' class='btn btn-success' onclick='AprobaProtocolo($fila2[id_pop],$idUser)' />
											 <a href='#myModal' role='button' class='btn btn-success' onclick='ImpProtocolo($fila2[id_pop])' data-toggle='modal'>Imprimir</a>
											 
											";
										break;
									
									case 3:// administrador
										echo "
											 <!--<input type='button' value='Modificar' class='btn btn-primary' onclick='ModificarProtocolo($fila2[id_pop])' />
											 <input type='button' value='Aprobar' class='btn btn-success' onclick='AprobaProtocolo($fila2[id_pop])' />-->
											 <a href='#myModal' role='button' class='btn btn-success' onclick='ImpProtocolo($fila2[id_pop])' data-toggle='modal'>Imprimir</a>
											 
											";
									break;

									case 5://
										echo "
											 <input type='button' value='Modificar' class='btn btn-primary' onclick='ModificarProtocolo($fila2[id_pop])' />
											 <a href='#myModal' role='button' class='btn btn-success' onclick='ImpProtocolo($fila2[id_pop])' data-toggle='modal'>Imprimir</a>
											 
											";
									break;
								}
					echo"		</center>
						</td>
					</tr>

					<script type='text/javascript'>
						$('#cmb_hora').val('$fila2[horainicio_pop]');
						$('#cmb_horaF').val('$fila2[horafin_pop]');
						$('#txtoccodiiees').val('$fila2[cirugiaefectuada_pop]');
						$('#txtoccirujano').val('$fila2[cirujano_pop]');
						$('#txtocanestesiologo').val('$fila2[anestesiologo_pop]');
						$('#txtoccoocirujano').val('$fila2[coocirujano_pop]');
						$('#txtocprimerayudante').val('$fila2[priayudante_pop]');
						$('#txtocsegundoayudante').val('$fila2[segayudante_pop]');
						$('#txtocaprobadopor').val('$fila2[preparadopor_pop]');

						$('#cmb_histopatologia').val('$fila2[histopatologia_pop]');
					</script>

				";




						break;



					case 'P':
						

	echo "

					 <tr>
					 	<th colspan='2'>
					 		PROTOCOLO OPERTATORIO
					 	</th>
					 	<th colspan='2'>
					 		DPTO. CIRUGIA</BR>
					 		ENDOSCOPIA ANESTESIOLOGIA</BR>
					 		  <hr>
					 		SER.
					 		<input type='text' id='txtseranete' value='$fila2[servicio_pop]' readonly/>
					 	</th>
					 </tr>

					<tr>
						<td>NOMBRE:</td>
						<td><input type='text' id='txtnombre' value='$NOMBRES1' readonly /></td>
						<td>CI:</td>
						<td><input type='text' id='txtci' value='$CI1' readonly /></td>
					</tr>

					<tr>
						<th colspan='4'><center>A. DIAGNOSTICO </center></th>
					</tr>
					<tr>
						<td colspan='2'>PRE-OPERATORIO</td>
						<td colspan='2'><input type='text' id='txtpreoperatorio' readonly value='$fila2[preop_pop]'  /></td>
					</tr>

					<tr>
						<td colspan='2'>POST-OPERATORIO</td>
						<td colspan='2'><input type='text' value='$fila2[postoperatorio_pop]' id='txtpostoperatorio' readonly /></td>
					</tr>

					<tr>
						<td colspan='2'>CIRUGIA EFECTUADA</td>
						<td colspan='2'><input type='text' id='txtcirujiaefectuada' value='$cirugiaefe' onclick='OpenIess()' readonly class='span4'/></td>
					</tr>

					<tr>
						<th colspan='4'><center> </center></th>
					</tr>

					<tr>
						<td>1er CIRUJANO</td>
						<td><input type='text' id='txtcirujano' value='$CIRUJANO' readonly onclick='MakeGeneralMedico(6)' /></td>
						<td>ANESTESIOLOGO</td>
						<td><input type='text' id='txtanestesiologo' value='$ANESTESIOLOGO' readonly onclick='MakeGeneralMedico(1)' /></td>
					</tr>

					<tr>
						<td>2do CIRUJANO</td>
						<td><input type='text' onclick='MakeGeneralMedico(2)' id='txtcoocirujano' readonly value='$COOCIRUJANO'/></td>
						<td>INSTRUMENTISTA</td>
						<td><input type='text' id='txtinstrumentista' value='$fila2[instrumentista_pop]'readonly /></td>
					</tr>

					<tr>
						<td>PRIMER AYUDANTE</td>
						<td><input type='text' onclick='MakeGeneralMedico(3)' id='txtprimerayudante' readonly value='$PRIMERAYUDANTE'/></td>
						<td>CIRCULANTE</td>
						<td><input type='text' id='txtcirculante' value='$fila2[circulante_pop]' readonly /></td>
					</tr>

					<tr>
						<td>SEGUNDO AYUDANTE</td>
						<td ><input type='text'  onclick='MakeGeneralMedico(4)' id='txtsegundoayudante' readonly value='$SEGUNDOAYUDANTE'/></td>
						<td>ECOGRAFISTA</td>
						<td ><input type='text' id='txtecografista' value='$fila2[ecografista_pop]' readonly /></td>
					</tr>

					<tr>
						<td colspan='2'>
							C. FECHA DE CIRUGIA</br>
							<input type='date' id='txtdatecirugina' readonly value='$fila2[datecirugia_pop]'/></br>
							HORA INICIO:</br>
							<select id='cmb_hora' readonly > <option value=''>--SELEECCIONE--</option>
							";
							foreach ($datos1 as $h) {
								echo "<option value='$h[id_hor]'>$h[hora_hor] </option>";
							}
					echo"
						 </select></br>
						  HORA FIN:</br>
						 <select id='cmb_horaF' onchange='CalculaHora()'> <option value=''>--SELEECCIONE--</option>
							";
							foreach ($datos1 as $h) {
								echo "<option value='$h[id_hor]'>$h[hora_hor] </option>";
							}
					echo"
						 </select>
						</td>
						<td colspan='2'>
							D. TIPO DE ANESTESIA</br>
							<input type='text' id='txtanestesia' readonly value='$fila2[tipanestesiologo_pop]'/></br>
							E. TIEMPO QUIRURGICO</br>
							<input type='text' id='txttiempoquirujico' readonly value='$fila2[etiempoquirugico_pop]'/>
						</td>
					</tr>

					<tr>
						<th colspan='4'><center>F. PROTOCOLO OPERTATORIO</center></th>
					</tr>

					<tr>
						<td>HALLAZGOS</td>
						<td colspan='3'><textarea id='txthallasgos' readonly cols='100' rows='5' class='span5'>$fila2[hallazgos_pop]</textarea></td>
					</tr>

					<tr>
						<td>E.T.O. </br>PROCEDIMIENTO</td>
						<td colspan='3'><textarea  readonly id='txtprocedimiento' cols='100' rows='5' class='span5'>$fila2[procedimientos_pop]</textarea></td>
					</tr>





					<tr>
						<td>COMPLICACIONES</td>
						<td colspan='3'><textarea id='txtcomplicaciones'  readonly cols='100' rows='5' class='span5'>$fila2[complicaciones_pop]</textarea></td>
					</tr>

					<tr>
						<td colspan='2'>
							SANGRADO<HR></BR>
							<input type='text' class='span4'  readonly value='$fila2[sangrado_pop]' id='txtsangrado'/>+/- CC
						</td>
						<td colspan='2'>
							HISTOPATOLOGIA<HR></BR>
							<select class='span4' readonly id='cmb_histopatologia'>
								<option value=''>--Seleccione--</option>
								<option value='SI'>SI</option>
								<option value='NO'>NO</option>
							</select>
						</td>
					</tr>




					

					<tr>
						<td>
							PREPARADO POR:</br>
							<input type='text' readonly onclick='MakeGeneralMedico(5)' id='txtpreparadopor' value='$PREPARADOPOR'/>
						</td>
						<td>
							FECHA:</br>
							<input type='date' readonly class='span8' value='$fila2[date2_pop]' id='txtfecha2' onclick='hoy()'/>
						</td>
						<td>
							APROBADO POR:
						</td>
						<td>
							FECHA:</br>
							<input type='date' readonly class='span8' value='$fila2[date3_pop]' id='txtfecha3' onclick='hoy()'/>
						</td>
					</tr>

					<tr>
						<td colspan='4'>
							<center>";

								switch ($permisos) {
									case 1: //medico
										echo "
											 <!--<input type='button' value='Guardar' class='btn btn-primary' onclick='ModificarProtocolo($fila2[id_pop])' />
											 <input type='button' value='Aprobar' class='btn btn-success' onclick='AprobaProtocolo($fila2[id_pop],$idUser)' />-->
											 <a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='ImpProtocolo($fila2[id_pop])'  > Imprimir</a>
											 
											";
										break;
									
									case 3:// administrador
										echo "
											 <!--<input type='button' value='Guardar' class='btn btn-primary' onclick='ModificarProtocolo($fila2[id_pop])' />
											 <input type='button' value='Aprobar' class='btn btn-success' onclick='AprobaProtocolo($fila2[id_pop],$idUser)' />-->
											 <a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='ImpProtocolo($fila2[id_pop])'  > Imprimir</a>
											 
											";
									break;

									case 5://
										echo "
											<!-- <input type='button' value='Guardar' class='btn btn-primary' onclick='ModificarProtocolo($fila2[id_pop])' />-->
											<a href='#myModal' role='button' class='btn btn-success' data-toggle='modal'  onclick='ImpProtocolo($fila2[id_pop])  > Imprimir</a>
											 
											";
									break;
								}
					echo"		</center>
						</td>
					</tr>

					<script type='text/javascript'>
						$('#cmb_hora').val('$fila2[horainicio_pop]');
						$('#cmb_horaF').val('$fila2[horafin_pop]');

						$('#txtoccodiiees').val('$fila2[cirugiaefectuada_pop]');
						$('#txtoccirujano').val('$fila2[cirujano_pop]');
						$('#txtocanestesiologo').val('$fila2[anestesiologo_pop]');
						$('#txtoccoocirujano').val('$fila2[coocirujano_pop]');
						$('#txtocprimerayudante').val('$fila2[priayudante_pop]');
						$('#txtocsegundoayudante').val('$fila2[segayudante_pop]');
						$('#txtocaprobadopor').val('$fila2[preparadopor_pop]');

						$('#cmb_histopatologia').val('$fila2[histopatologia_pop]');
					</script>

				";







						break;
					
					
				}

			}
			echo "</table>";


		}	
	}
	/* cargar de protocolos xD*/

	/*calcular las horas*/
	

	public function CalcularHora($hi,$hf)
	{
		$h=new Hora;
		$start_time=$h->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$hi'");
		$end_time=$h->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$hf'");
		
		$total_seconds = strtotime($end_time) - strtotime($start_time); 
	    $horas              = floor ( $total_seconds / 3600 );
	    $minutes            = ( ( $total_seconds / 60 ) % 60 );
	    $seconds            = ( $total_seconds % 60 );
	     
	    $time['horas']      = str_pad( $horas, 2, "0", STR_PAD_LEFT );
	    $time['minutes']    = str_pad( $minutes, 2, "0", STR_PAD_LEFT );
	    $time['seconds']    = str_pad( $seconds, 2, "0", STR_PAD_LEFT );
	     
	    $time               = implode( ':', $time );

		echo $time;

		
	}
	/*calcular las horas*/

	/* buscador general */
	public function BuscadorGeneralMedicos($buscar,$re,$rol)
	{
		$usu=new Usuario;
		$datos=$usu->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE CONCAT(apellidos_usu,' ',nombres_usu) LIKE '%$buscar%' AND estado_usu='A' AND id_rol='1' OR cedula_usu LIKE '%$buscar%' AND estado_usu='A' AND id_rol='1'");
		echo "
			<table class='table table-bordered table-striped table-condensend'>
			<tr>
				<th>CI</th>
				<th>Medico</th>
				<th></th>
				<th></th>
			</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td>$fila[cedula_usu]</td>
						<td><div id='catcMedNom$fila[id_usu]'>$fila[apellidos_usu] $fila[nombres_usu]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "
								<td colspan='2'><input type='button' class='btn btn-primary' value='Seleccionar' onclick='SeleccionarMedico($fila[id_usu],$re)' /></td>
							";
							break;

					}
			echo "</tr>";
		}
		echo "</table>";

	}
	/* fin buscador general*/

	/*bucador general de codigos iees*/
	public function BuscarCodigoIess($buscar,$rol)
	{
		$iess=new CodigoIess;
		$datos=$iess->Consultar_CodigoIess("SELECT * FROM tbl_codigoiess WHERE codigo_ciess LIKE '$buscar%' OR descripcion_ciess LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Valor</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_ciess]'>$fila[codigo_ciess]</div></td>
						<td><div id='desc$fila[id_ciess]'>$fila[descripcion_ciess]</div></td>
						<td><div id='valo$fila[id_ciess]'>$fila[valor_ciess]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarIess($fila[id_ciess])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}
	/*bucador general de codigos iees*/
	/*bucador general de codigos iees*/
	public function BuscarCodigoIess2($buscar,$rol)
	{
		
		$dgnCie=new CodigoDiagnostico;
		$datos=$dgnCie->Consultar_CodigoDiagnostico("SELECT * FROM tbl_diagnostico WHERE codigo_cie LIKE '$buscar%' OR descripcion_cie LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Tipo</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_cie]'>$fila[codigo_cie]</div></td>
						<td><div id='desc$fila[id_cie]'>$fila[descripcion_cie]</div></td>
						<td><div id='valo$fila[id_cie]'>$fila[tipo_cie]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarIess2($fila[id_cie])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}
	/*bucador general de codigos iees*/
	/*bucador general de codigos iees*/
	public function BuscarCodigoIess3($buscar,$rol)
	{
		$dgn=new CodigoDiagnostico;
		$datos=$dgn->Consultar_CodigoDiagnostico("SELECT * FROM tbl_diagnostico WHERE codigo_cie LIKE '$buscar%' OR descripcion_cie LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Tipo</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_cie]'>$fila[codigo_cie]</div></td>
						<td><div id='desc$fila[id_cie]'>$fila[descripcion_cie]</div></td>
						<td><div id='valo$fila[id_cie]'>$fila[tipo_cie]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarIess3($fila[id_cie])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}
	/*bucador general de codigos iees*/
	/*save protocolo operatorio*/
	public function SaveProtocoloOperatorio($id_cir,$servicio_pop,$postoperatorio_pop,$cirugiaefectuada_pop,$anestesiologo_pop,$coocirujano_pop,$instrumentista_pop,$priayudante_pop,$circulante_pop,$segayudante_pop,$datecirugia_pop,$tipanestesiologo_pop,$horainicio_pop,$etiempoquirugico_pop,$hallazgos_pop,$procedimientos_pop,$preparadopor_pop,$date2_pop,$date3_pop,$cirujano_pop,$preop,$hf,$complicaciones,$sangrado,$histopatologico,$ecografista,$preopaux2,$preopaux3,$postopaux2,$postopaux3,$ciruefaux2,$ciruefaux3,$cirujano3,$dgnhispatologia)
	{	
		$pro=new ProtocoloOperatorio;
		session_start();
		$user_pop=$_SESSION['IDUser'];
		$hallazgos_pop=nl2br($hallazgos_pop);

		$anestesiologo_pop = ($anestesiologo_pop != '')? $anestesiologo_pop : 0;
		$coocirujano_pop = ($coocirujano_pop != '')? $coocirujano_pop : 0;
		$cirujano3 = ($cirujano3 != '')? $cirujano3 : 0;
		$priayudante_pop = ($priayudante_pop != '')? $priayudante_pop : 0;
		$segayudante_pop = ($segayudante_pop != '')? $segayudante_pop : 0;
		$preparadopor_pop = ($preparadopor_pop != '')? $preparadopor_pop : 0;


		$procedimientos_pop=nl2br(htmlentities($procedimientos_pop, ENT_QUOTES, 'UTF-8'));
		$complicaciones=nl2br(htmlentities($complicaciones, ENT_QUOTES, 'UTF-8'));


		$pro->Ejecutar("INSERT INTO tbl_protocoloperatorio (id_cir,servicio_pop,postoperatorio_pop,cirugiaefectuada_pop,anestesiologo_pop,coocirujano_pop,instrumentista_pop,priayudante_pop,circulante_pop,segayudante_pop,datecirugia_pop,tipanestesiologo_pop,horainicio_pop,etiempoquirugico_pop,hallazgos_pop,procedimientos_pop,preparadopor_pop,date2_pop,date3_pop,estado_pop,cirujano_pop,user_pop,preop_pop,horafin_pop,complicaciones_pop,sangrado_pop,histopatologia_pop,ecografista_pop,preop2_pop,preop3_pop,postop2_pop,postop3_pop,cirugiaefc2_pop,cirugiaefc3_pop,cirujano3_pop,dignhisp_pop) VALUES('$id_cir','$servicio_pop','$postoperatorio_pop','$cirugiaefectuada_pop','$anestesiologo_pop','$coocirujano_pop','$instrumentista_pop','$priayudante_pop','$circulante_pop','$segayudante_pop','$datecirugia_pop','$tipanestesiologo_pop','$horainicio_pop','$etiempoquirugico_pop','$hallazgos_pop','$procedimientos_pop','$preparadopor_pop','$date2_pop','$date3_pop','A','$cirujano_pop','$user_pop','$preop','$hf','$complicaciones','$sangrado','$histopatologico','$ecografista','$preopaux2','$preopaux3','$postopaux2','$postopaux3','$ciruefaux2','$ciruefaux3','$cirujano3','$dgnhispatologia');");

		echo $this->Msm("v","Los datos se guardaron correctamente");


	}
	/*save protocolo operatorio*/

	/*modificar protocolo operatorio*/
	public function ModifyOkProtocoOperatorio($id_pop,$servicio_pop,$postoperatorio_pop,$cirugiaefectuada_pop,$anestesiologo_pop,$coocirujano_pop,$instrumentista_pop,$priayudante_pop,$circulante_pop,$segayudante_pop,$datecirugia_pop,$tipanestesiologo_pop,$horainicio_pop,$etiempoquirugico_pop,$hallazgos_pop,$procedimientos_pop,$preparadopor_pop,$date2_pop,$date3_pop,$cirujano_pop,$preop,$hf,$complicaciones,$sangrado,$histopatologico,$ecografista,$preopaux2,$preopaux3,$postopaux2,$postopaux3,$ciruefaux2,$ciruefaux3,$cirujano3,$dgnhispatologia)
	{
		$pro=new ProtocoloOperatorio;
		session_start();
		$user_pop=$_SESSION['IDUser'];

		$anestesiologo_pop = ($anestesiologo_pop != '')? $anestesiologo_pop : 0;
		$coocirujano_pop = ($coocirujano_pop != '')? $coocirujano_pop : 0;
		$cirujano3 = ($cirujano3 != '')? $cirujano3 : 0;
		$priayudante_pop = ($priayudante_pop != '')? $priayudante_pop : 0;
		$segayudante_pop = ($segayudante_pop != '')? $segayudante_pop : 0;
		$preparadopor_pop = ($preparadopor_pop != '')? $preparadopor_pop : 0;

		$pro->Ejecutar("UPDATE tbl_protocoloperatorio SET servicio_pop='$servicio_pop', postoperatorio_pop='$postoperatorio_pop', cirugiaefectuada_pop='$cirugiaefectuada_pop',anestesiologo_pop='$anestesiologo_pop',coocirujano_pop='$coocirujano_pop',instrumentista_pop='$instrumentista_pop',priayudante_pop='$priayudante_pop',circulante_pop='$circulante_pop',segayudante_pop='$segayudante_pop',datecirugia_pop='$datecirugia_pop',tipanestesiologo_pop='$tipanestesiologo_pop',horainicio_pop='$horainicio_pop',etiempoquirugico_pop='$etiempoquirugico_pop',hallazgos_pop='$hallazgos_pop',procedimientos_pop='$procedimientos_pop',preparadopor_pop='$preparadopor_pop',date2_pop='$date2_pop',date3_pop='$date3_pop',cirujano_pop='$cirujano_pop',user_pop='$user_pop', preop_pop='$preop',horafin_pop='$hf', complicaciones_pop='$complicaciones',sangrado_pop='$sangrado',histopatologia_pop='$histopatologico', ecografista_pop='$ecografista' , preop2_pop='$preopaux2' , preop3_pop='$preopaux3' , postop2_pop='$postopaux2' , postop3_pop='$postopaux3' , cirugiaefc2_pop='$ciruefaux2' , cirugiaefc3_pop='$ciruefaux3' , cirujano3_pop='$cirujano3' WHERE id_pop='$id_pop';");
		echo $this->Msm("a","Los datos se modificaron correctamente");


	}
	/*modificar protocolo operatorio*/


	/*aprobar protocolo*/
	public function AprobarProtocoloOpertatorio($code)
	{
		$pop=new ProtocoloOperatorio;
		session_start();
		$aprobadopor_pop=$_SESSION['IDUser'];
		$pop->Ejecutar("UPDATE tbl_protocoloperatorio SET estado_pop='P' , aprobadopor_pop='$aprobadopor_pop' WHERE id_pop='$code';");
		$this->Msm("v", "Aprobacion satisfactoria");
	}
	/*aprobar protocolo*/

	/*lista de protocolos operatorios*/
	public function ListaProtocolooperatorio($code)
	{
		$ci=new CitaCirugia;
		$pro=new ProtocoloOperatorio;
		$datos=$ci->Consultar_CitaCirugia("SELECT * FROM tbl_citacirugia WHERE id_pac='$code';");
		//capturando acciones
		session_start();
		$idusu2015=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"SELECT * FROM tbl_citacirugia WHERE id_pac=$code;");
		$ci->Ejecutar($sql2015);
		//capturando acciones

		echo "<table class='table table-bordered table-striped table-condensend'>
				<tr>
					
					<th>Servicio</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			$contar=$ci->Consultar("SELECT COUNT(*) FROM tbl_protocoloperatorio WHERE id_cir='$fila[id_cir]';");
			if($contar>0){
				$IDPROTOCOLO=$ci->Consultar("SELECT id_pop FROM tbl_protocoloperatorio WHERE id_cir='$fila[id_cir]';");
				$SERVICIO=$ci->Consultar("SELECT servicio_pop FROM tbl_protocoloperatorio WHERE id_pop='$IDPROTOCOLO';");

				echo "
					<tr>
						
						<td>$SERVICIO</td>
						<td>
							<a  href='#myModal' role='button' onclick='ImpProtocolo($IDPROTOCOLO)' class='btn btn-success' data-toggle='modal' > Imprimir</a>
						</td>
					</tr>
				";
			}

		}
		echo "</table>";
	}


	//fin protocoloopertatorio



	//emergencia
	public function FrmMkEmergenciaIni($code)
	{
		$pac=new Paciente;
		$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE id_pac='$code';");

		foreach ($datos as $fila) {
			$EDAD=$this->Edad($fila["fechaN_pac"]);

		echo "
			<table class='table table-striped table-condensend table-bordered'>
				<tr>
					<td colspan='4'>1 REGISTRO DE ADMISION</td>
				</tr>
				<tr>
					<td>UNIDAD OPERATIVA: <input type='text' class='span2' id='txtemunidadopertativa' /></td>
					<td>CODIGO:<hr></br> <input type='text' class='span1' id='txtemcodigo'/></td>
					<td>
						LOCALIZACION</BR>
						PARROQUIA: <input type='text' id='txtemparroquia' class='span2'/></br>
						CANTON: <input type='text' id='txtemcanton' class='span2'/></br>
						PROVINCIA: <input type='text' id='txtemprovincia' class='span2'/>
					</td>
					<td>
						Nº HISTORIA CLINICA:<input type='text' class='span2' value='$fila[cedula_pac]' readonly id='txtemhistoriaclinica'/>
					</td>
				</tr>
				<tr>
					<th colspan='4'>
						1. REGISTRO DE EMERGENCIAS
					</th>
				</tr>
				<tr>
					<th colspan='2'>
						NOMBRE: <input type='text' id='txtemnombre' value='$fila[nombresCom_pac]'/> 
					</th>
					<th>
						NACIONALIDAD: <input type='text' class='span2' id='txtemnacionalidad'/>
					</th>
					<th>
						Nº HISTORIA CLINICA:<input type='text' class='span2' value='$fila[cedula_pac]' readonly id='txtemhistoriaclinica'/>
					</th>
				</tr>
				<tr>
					<td>DIRECCION:</td>
				</tr>
				<tr>
					<td>FECHA DE ATENCION: <input type='date' id='txtemdate1' /></td>
					<td>
						Hora: <input type='text' id='txtemhora' class='span1'/><hr></br>
						EDAD: $EDAD;
					</td>
					<td>SEXO: <input type='text' id='txtemesexo' value='$fila[sexo_pac]'/></td>
					<td>INSTRUCCION: <input type='text' id='txteminstruccion' value='$fila[instruccion_pac]' class='span2'/></td>
				</tr>
				<tr>
					<td>OCUPACION: <input type='text' id='txtemocupacion'  value='$fila[ocupacion_pac]'/></td>
					<td colspan='3'>
						Nª SEGURO DE SALUD<HR> </BR>
						IESS:<input type='text' id='txtemiess' class='span1' /> OTRO:<input type='text' id='txtemotro' class='span1'/></br>
						<input type='text' id='txtemnumerodeseguro' class='span5'/> 
					</td>
				</tr>
				<tr>
					<td>
						NOMBRE DE LA PERSONA PARA NOTIFICACION<HR></BR>
						<input type='text' id='txtemnombreparanotificacion'/>
					</td>
					<td>
						PARENTESCO O AFINIADAD <HR></BR>
						<input type='text' id='txtemparentesco' />
					</td>
					<td>
						DIRECCION<HR></BR>
						<input type='text' id='txtemdirecionpare' />
					</td>
					<td>
						Nª TELEFONO<HR></BR>
						<input type='text' id='txtemtelefonopare' />
					</td>
				</tr>

				<tr>
					<td>
						NOMBRE DEL ACOMPAÑANTE<HR></BR>
						<input type='text' id='txtemnombreacompanante'/>
					</td>
					<td>
						Nª CEDULA DE IDENTIDAD <HR></BR>
						<input type='text' id='txtemacompanantecedula' />
					</td>
					<td>
						DIRECCION <HR></BR>
						<input type='text' id='txtemacompanantedireccion' />
					</td>
					<td>
						Nª TELEFONO <HR></BR>
						<input type='text' id='txtemacompanantetelefono' />
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						FORMA DE LLEGADA<HR></BR>
						AMBULATORIO:<input type='text' id='txtemambulatorio' class='span1'/>
						SILLA DE RUEDAS:<input type='text' id='txtemsillaruedas' class='span1'/></br>
						CAMILLA:<input type='text' id='txtemcamilla' class='span1'/>
					</td>
					<td colspan='2'>
						FUENTE DE INFORMACION<HR></BR>
						<input type='text' id='txtemfuenteinformacion'/>
					</td>
				</tr>
				
				<tr>
					<td colspan='2'>
						INSTITUCION O PERSONA QUE ENTREGA AL PACIENTE<HR></BR>
						<input type='text' id='txteminstperentalpaciente' class='span5'/>
					</td>

					<td colspan='2'>
						Nª TELEFONO<HR></BR>
						<input type='text' id='txteminstperentalpacientetelefono' />
					</td>
				</tr>

				<tr>
					<td colspan='4'></td>
				</tr>

				<tr>
					<td colspan='4'>2 INICIO DE ATENCION</td>
				</tr>				
				<tr>
					<td colspan='2'>
						HORA: <input type='text' class='span1' id='txtemhorainiatencion'/><hr></br>
						VIA AEREA LIBRE: <input type='text' id='txtemviaerelibre' class='span1'><hr></br>
						VIA AEREA OBSTRUIDA: <input type='text' id='txtemviaereobstruida' class='span1' /><hr></br>
						GRUPO - RH: <input type='text' id='txtemgruporh' class='span2' /><hr></br>
					</td>
					<td colspan='2'>
						CONDICIONES DE LLEGADA<HR></BR>
						ESTABLE:  <input type='text' id='txtemestable' class='span1'><hr></br>
						INESTABLE:  <input type='text' id='txteminestable' class='span1'><hr></br>
						OTRO:  <input type='text' id='txtemotro' class='span1'><hr></br>
					</td>
				</tr>
				<tr>
					<td>
						MOTIVO DE LLEGADA:
					</td>
					<td colspan='3'>
						<input type='text' id='txtemmotivodellegada' class='span5'/>
					</td>
				</tr>

				<tr>
					<td colspan='4'>
					</td>
				</tr>

				<tr>
					<td colspan='3'>
						3 ACCIDENTE, VIOLENCIA, INTOXICACION
					</td>
					<td>
						NO APLICA <input type='text' class='span1' id='txtemnoaplica33'/>
					</td>
				</tr>

				<tr>
					<td>
						LUGAR DEL EVENTO<HR></BR>
						<input type='text' id='txtemlugarevento' />
					</td>
					<td colspan='3'>
						DIRECCION DEL EVENTO<HR></BR>
						<input type='text' id='txtemdireccionevento' class='span5'/>
					</td>
				</tr>

				<tr>
					<td>
						FECHA<HR></BR>
						<input type='date' id='txtemfecha21'/>
					</td>
						
					<td>
						HORA<HR></BR>	
						<input type='text' id='txtemhora22'/>
					</td>
					<td colspan='2'>
						VEHICULO O ARMA<HR></BR>
						<input type='text' id='txtemvehiculooarma' class='span4'/>
					</td>
				</tr>

				<tr>
					<td>
						TIPO DE EVENTO<HR></BR>
						ACCIDENTE <input type='text' id='txtemaccidente' class='span1'/><HR></BR>
						ENVENENAMIENTO <input type='text' id='txtemenvenenamiento' class='span1'/><HR></BR>
						VIOLENCIA <input type='text' id='txtemviolencia' class='span1'/><HR></BR>
						OTRO <input type='text' id='txtemotro33' class='span1'/><HR></BR>
					</td>
					<td colspan='3'>
						AUTORIDAD COMPETENTE<HR></BR>
						<input type='text' id='txtemautoridadcompetente' class='span5'/><HR></BR>
						HORA DENUNCIA <input type='text' id='txtemhoradenuncia' class='span1'/><HR></BR>
						CUSTODIA POLICIAL <input type='text' id='txtemcustodiapolicial' class='span1'/><HR></BR>
					</td>
				</tr>

				<tr>
					<td>
						OBSERVACIONES
					</td>
					<td colspan='3'>
						<input type='text' id='txtemobservaciones' class='span6'/>
					</td>
				</tr>

				<tr>
					<td colspan='2'>
						INTOXICACION<HR></BR>
						<table>
							<tr>
								<td>
									ALIENTO ETILICO<input type='text' class='span1' id='txtemalientoetilico' />
								</td>
								<td>
									VALOR ALCOCHECK<input type='text' id='txtemvaloralcocheck' class='span1'/>
								</td>
							</tr>
							<tr>
								<td>
									HORA EXAMEN <input  type='text' id='txtemhoraexamen' class='span1'/>
								</td>
								<td>
									SE HACE ALCOHOLEMIA<input type='text' id='txtemsehacealcoholemia' class='span1'/>
								</td>

							</tr>
							<tr>
								<td colspan='2'>
								OTRAS SUSTANCIAS<input type='text' id='txtemotrassustancias' class='span1'/>
								</td>
							</tr>
						</table>
					</td>

					<td colspan='2'>
						VIOLENCIA<HR></BR>

						<table>
							<tr>
								<td>SOSPECHA<input type='text' id='txtemsospecha' class='span1'/></td>
								<td>ABUSO FISICO<input type='text' id='txtemsabusofisico' class='span1'/></td>
							</tr>
							<tr>
								<td>ABUSO SPICOLOGICO<input type='text' id='txtemabusospicologico' class='span1'/></td>
								<td>ABUSO SEXUAL<input type='text' id='txtemabusosexual' class='span1'/></td>
							</tr>

						</table>
					</td>
				</tr>

				<tr>
					<td>OBSERVACIONES</td>
					<td colspan='3'>
						<input type='text' class='span5' id='txtemobservaciones33'/>
					</td>
				</tr>

				<tr>
					<td colspan='2'>
						QUEMADURA<HR></BR>
						<table>
							<tr>
								<td>GRADO I<input type='text' id='txtemquemaduragradoI' class='span1'/></td>
								<td>GRADO II<input type='text' id='txtemquemaduragradoII' class='span1'/></td>
							</tr>
							<tr>
								<td>GRADO III<input type='text' id='txtemquemaduragradoIII' class='span1'/></td>
								<td>PORCENTAJE SUPERFICIE<input type='text' id='txtemsporcentajeuperficie' class='span1'/></td>
							</tr>
						</table>

					</td>
					<td >
						PICADURA<HR></BR>
						<input type='text' id='txtempicadura'/>
					</td>
					<td >
						MORDEDURA<HR></BR>
						<input type='text' id='txtemmordedura'/>
					</td>
				</tr>

				<tr>
					<td colspan='3'>ANTECEDENTES PERSONALES Y FAMILIARES RELEVANTES</td>
					<td>
						NO APLICA <input type='text' id='txtemnoaplica34' class='span1'/>
					</td>
				</tr>
				
				<tr>
					<td>1.ALERGICOS<input type='text' id='txtem1alergicos' class='span1'/></td>
					<td>2.CLINICOS<input type='text' id='txtem2clinicos' class='span1'/></td>
					<td>3.GINECOLOGICOS<input type='text' id='txtem3ginecologicos' class='span1'/></td>
					<td>4.TRAUMATOLOGICOS<input type='text' id='txtem4traumatologicos' class='span1'/></td>
				</tr>

				<tr>
					<td>5.PEDIATRICOS<input type='text' id='txtem5pediatricos' class='span1'/></td>
					<td>6.QUIRURGICOS<input type='text' id='txtem6quirurgicos' class='span1'/></td>
					<td>7.FARMACOLOGICOS<input type='text' id='txtem7farmacologicos' class='span1'/></td>
					<td>8.OTROS<input type='text' id='txtem8otros' class='span1'/></td>
				</tr>
				<tr>
					<td colspan='4'>
						<textarea cols='100' rows='5' id='txtemantecedentespersonalesyfamiliares' class='span8'></textarea>
					</td>
				</tr>

				<tr>
					<td colspan='3'>5 ENFERMEDAD ACTUAL Y REVISION DE SISTEMAS</td>
					<td>NO APLICA<input type='text' id='txtemnoaplica35' class='span1'/></td>
				</tr>

				<tr>
					<td colspan='4'>
						<textarea cols='100' rows='5' class='span8' id='txtenferemedadactualyreposo'></textarea>
					</td>
				</tr>

				<tr>
					<td colspan='3'>6 CARACTERISTICAS DEL DOLOR</td>
					<td>
						NO APLICA <input type='text' class='span1' id='txtemnoaplica36'/>
					</td>
				</tr>
				<tr>
					<td colspan='2'>
						REGION ANATOMICA<HR></BR>
						<input type='text' class='span4' id='txtemregionanatomica1'/> </br>
						<input type='text' class='span4' id='txtemregionanatomica2'/> </br>
						<input type='text' class='span4' id='txtemregionanatomica3'/> 
					</td>


					<td colspan='2'>
						PUNTO DOLOROSO<HR></BR>
						<input type='text' class='span4' id='txtempuntodoloroso1'/> </br>
						<input type='text' class='span4' id='txtempuntodoloroso2'/> </br>
						<input type='text' class='span4' id='txtempuntodoloroso3'/> 
					</td>
				</tr>


				<tr>
					<td colspan='2'>
						<table>
							<tr>
								<td colspan='3'>EVOLOCION</td>
							</tr>
							<tr>
								<td>AGUDO</td>
								<td>SUBAGUDO</td>
								<td>CRONICO</td>
							</tr>
							<tr>
								<td><input type='text' id='txtagudo1' class='span1'/></td>
								<td><input type='text' id='txtsubagudo1' class='span1'/></td>
								<td><input type='text' id='txtcronico1' class='span1'/></td>
							</tr>
							<tr>
								<td><input type='text' id='txtagudo2' class='span1'/></td>
								<td><input type='text' id='txtsubagudo2' class='span1'/></td>
								<td><input type='text' id='txtcronico2' class='span1'/></td>
							</tr>
							<tr>
								<td><input type='text' id='txtagudo3' class='span1'/></td>
								<td><input type='text' id='txtsubagudo3' class='span1'/></td>
								<td><input type='text' id='txtcronico3' class='span1'/></td>
							</tr>

						</table>
					</td>



					<td colspan='2'>
						<table>
							<tr>
								<td colspan='3'>TIPO</td>
							</tr>
							<tr>
								<td>EPISODICO</td>
								<td>CONTINUO</td>
								<td>COLICO</td>
							</tr>
							<tr>
								<td><input type='text' id='txtepisodico1' class='span1'/></td>
								<td><input type='text' id='txtcontinuo1' class='span1'/></td>
								<td><input type='text' id='txtcolico1' class='span1'/></td>
							</tr>
							<tr>
								<td><input type='text' id='txtepisodico2' class='span1'/></td>
								<td><input type='text' id='txtcontinuo2' class='span1'/></td>
								<td><input type='text' id='txtcolico2' class='span1'/></td>
							</tr>
							<tr>
								<td><input type='text' id='txtepisodico3' class='span1'/></td>
								<td><input type='text' id='txtcontinuo3' class='span1'/></td>
								<td><input type='text' id='txtcolico3' class='span1'/></td>
							</tr>

						</table>
					</td>
				</tr>

				<tr>
					<td colspan='2'>
						<table>
							<tr>
								<td colspan='5'>MODIFICACIONES</td>
							</tr>
							<tr>
								<td>POSICION</td>
								<td>INGESTA</td>
								<td>ESFUERZO</td>
								<td>DIGITO PRESION</td>
								<td>SE IRRADIA</td>
							</tr>
							<tr>
								<td><input type='text' id='txtemposicio1' class='span1'/></td>
								<td><input type='text' id='txtemingesta1' class='span1'/></td>
								<td><input type='text' id='txtemesfuerzo1'  class='span1'/></td>
								<td><input type='text'  id='txtemdigitopresion1' class='span1'/></td>
								<td><input type='text' id='txtemseirradia1' class='span1' /></td>
							</tr>

							<tr>
								<td><input type='text' id='txtemposicio2' class='span1'/></td>
								<td><input type='text' id='txtemingesta2' class='span1'/></td>
								<td><input type='text' id='txtemesfuerzo2'  class='span1'/></td>
								<td><input type='text'  id='txtemdigitopresion2' class='span1'/></td>
								<td><input type='text' id='txtemseirradia2' class='span1' /></td>
							</tr>

							<tr>
								<td><input type='text' id='txtemposicio3' class='span1'/></td>
								<td><input type='text' id='txtemingesta3' class='span1'/></td>
								<td><input type='text' id='txtemesfuerzo3'  class='span1'/></td>
								<td><input type='text'  id='txtemdigitopresion3' class='span1'/></td>
								<td><input type='text' id='txtemseirradia3' class='span1' /></td>
							</tr>
						</table>
					</td>

					<td colspan='2'>
						<table>
							<tr>
								<td colspan='4'>ALIVIA CON</td>
							</tr>
							<tr>
								<td>ANTIES PASMODICO</td>
								<td>OPIACEO</td>
								<td>AINE</td>
								<td>NO ALIVIA</td>
							</tr>
							<tr>
								<td><input type='text' id='txtemantiespasmodico1' class='span1' /></td>
								<td><input type='text' id='txtemopiaceo1' class='span1' /></td>
								<td><input type='text' id='txtemaine1' class='span1' /></td>
								<td><input type='text' id='txtemnoalivia1' class='span1' /></td>
							</tr>
							<tr>
								<td><input type='text' id='txtemantiespasmodico2' class='span1' /></td>
								<td><input type='text' id='txtemopiaceo2' class='span1' /></td>
								<td><input type='text' id='txtemaine2' class='span1' /></td>
								<td><input type='text' id='txtemnoalivia2' class='span1' /></td>
							</tr>
							<tr>
								<td><input type='text' id='txtemantiespasmodico3' class='span1' /></td>
								<td><input type='text' id='txtemopiaceo3' class='span1' /></td>
								<td><input type='text' id='txtemaine3' class='span1' /></td>
								<td><input type='text' id='txtemnoalivia3' class='span1' /></td>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<td colspan='4'>
					<center>
						<table>
							<tr>
								<td>INTENSIDAD: LEVE, MODERADO O GTRAVE</td>
							</tr>
							<tr>
								<td><input type='text' id='txtemintesidadlmg1' /></td>
							</tr>
							<tr>
								<td><input type='text' id='txtemintesidadlmg2' /></td>
							</tr>
							<tr>
								<td><input type='text' id='txtemintesidadlmg3' /></td>
							</tr>
						</table>
					</center>
					</td>
				</tr>



				<tr>
					<td colspan='4'>7 SIGNOS VITALES, MEDICIONES Y VALORES</td>
				</tr>
				
				<tr>
					<td>
						PRESION ARTERIAL<HR></BR>
						<input type='text' id='txtempresionareterial' class='span1'/>
					</td>
					<td>
						FRECUENCIA CARDIACA min<HR></BR>
						<input type='text' id='txtemfrecuenciacardiaca' class='span1'/>
					</td>
					<td>
						FRECUENCIA RESPIRATORIA mini<HR></BR>
						<input type='text' id='txtemfrecuenciarespiratoria' class='span1'/>
					</td>
					<td>
						TEMPERATURA BUCAL ªC<HR></BR>
						<input type='text' id='txtemtempertaturalbucal' class='span1'/>
					</td>
				</tr>

				<tr>
					<td>
						TEMPERATURA AXILAR ªC<HR></BR>
						<input type='text' id='txtemtempertaturaaxilar' class='span1'/>
					</td>
					<td>
						PESO kg<HR></BR>
						<input type='text' id='txtempesokg' class='span1'/>
					</td>
					<td>
						TALLA m<HR></BR>
						<input type='text' id='txtemtallam' class='span1'/>
					</td>
					<td>
						PERIMET CEFALIC cm<HR></BR>
						<input type='text' id='txtemperimetcefalic' class='span1'/>
					</td>
				</tr>

				<tr>
					<td colspan='4'>
						<table>
							<tr>
								<td>GLASGOW INICIAL</td>
								<td>OCULAR</td>
								<td><input type='text' id='txtemocualar' class='span1'/></td>
								<td>VERBAL</td>
								<td><input type='text' id='txtemverbal' class='span1'/></td>
								<td>MOTORA</td>
								<td><input type='text' id='txtemmotora' class='span1'/></td>
								<td>TOTAL</td>
								<td><input type='text' id='txtemtotal' class='span1'/></td>
							</td>
						</table>
					</td>
				</tr>

				<tr>
					
						<td colspan='4'>
							<table>
								<tr>
									<td>REACCION PUPILAR DER</td>
									<td><input type='text' id='txtemreacinpupilarder' class='span1'/> </td>
									<td>REACCION PUPILAR IZQ</td>
									<td><input type='text' id='txtemreacinpupilarizq' class='span1'/> </td>
									<td>T. LLENADO CAPILAR</td>
									<td><input type='text' id='txtemllenadocapilar' class='span1'/> </td>
									<td><input type='text' id='txtemllenadocapilar2' class=''/></td>

								</tr>
							</table>
						</td>
					
				</tr>

				<tr>
					<td colspan='4'>EXAMEN FISICO</td>
				</tr>

				<tr>
					<td colspan='2'>
						<table>
							<tr>
								<td></td>
								<td>CP</td>
								<td>SP</td>
							</tr>
							<tr>
								<td>1R PIEL Y FANERAS</td>
								<td><input type='text' id='txtempielfanerascp' class='span1'/></td>
								<td><input type='text' id='txtempielfanerassp' class='span1'/></td>
							</tr>
							<tr>
								<td>2R CABEZA</td>
								<td><input type='text' id='txtemcabezacp' class='span1'/></td>
								<td><input type='text' id='txtemcabezasp' class='span1'/></td>
							</tr>
							<tr>
								<td>3R OJOS</td>
								<td><input type='text' id='txtemojoscp' class='span1'/></td>
								<td><input type='text' id='txtemojossp' class='span1'/></td>
							</tr>
							<tr>
								<td>4R OIDOS</td>
								<td><input type='text' id='txtemoidoscp' class='span1'/></td>
								<td><input type='text' id='txtemoidossp' class='span1'/></td>
							</tr>
							<tr>
								<td>5R NARIZ</td>
								<td><input type='text' id='txtemnarizcp' class='span1'/></td>
								<td><input type='text' id='txtemnarizsp' class='span1'/></td>
							</tr>
						</table>

						
					</td>

					<td colspan='2'>
						<table>
							<tr>
								<td></td>
								<td>CP</td>
								<td>SP</td>
							</tr>
							<tr>
								<td>6R BOCA</td>
								<td><input type='text' id='txtenbocacp' class='span1'/></td>
								<td><input type='text' id='txtenbocasp' class='span1'/></td>
							</tr>
							<tr>
								<td>7R ORO Y FARINGE</td>
								<td><input type='text' id='txtemoroyfarungecp' class='span1'/></td>
								<td><input type='text' id='txtemoroyfarungesp' class='span1'/></td>
							</tr>
							<tr>
								<td>8R CUELLO</td>
								<td><input type='text' id='txtemcuellocp' class='span1'/></td>
								<td><input type='text' id='txtemcuellosp' class='span1'/></td>
							</tr>
							<tr>
								<td>9R AXILLAS - MAMAS</td>
								<td><input type='text' id='txtemaxillasmamascp' class='span1'/></td>
								<td><input type='text' id='txtemaxillasmamassp' class='span1'/></td>
							</tr>
							<tr>
								<td>10R TORAX</td>
								<td><input type='text' id='txtemtoraxcp' class='span1'/></td>
								<td><input type='text' id='txtemtoraxsp' class='span1'/></td>
							</tr>
						</table>

					</td>
				</tr>

				<tr>
					<td colspan='2'>
						<table>
							<tr>
								<td></td>
								<td>CP</td>
								<td>SP</td>
							</tr>
							<tr>
								<td>11R ABDOMEN</td>
								<td><input type='text' id='txtenabdomencp' class='span1'/></td>
								<td><input type='text' id='txtenabdomensp' class='span1'/></td>
							</tr>
							<tr>
								<td>12R COLUMNA VERTEBRAL</td>
								<td><input type='text' id='txtemcolumnavertebralcp' class='span1'/></td>
								<td><input type='text' id='txtemcolumnavertebralsp' class='span1'/></td>
							</tr>
							<tr>
								<td>13R INGLE - PERINE</td>
								<td><input type='text' id='txteminglreperinecp' class='span1'/></td>
								<td><input type='text' id='txteminglreperinesp' class='span1'/></td>
							</tr>
							<tr>
								<td>14R MIEMBROS SUPERIORES</td>
								<td><input type='text' id='txtemmiembrossuperiorescp' class='span1'/></td>
								<td><input type='text' id='txtemmiembrossuperioressp' class='span1'/></td>
							</tr>
							<tr>
								<td>15R MIEMBROS INFERIORES</td>
								<td><input type='text' id='txtemmiembrosinferiorescp' class='span1'/></td>
								<td><input type='text' id='txtemmiembrosinferioressp' class='span1'/></td>
							</tr>
						</table>
					</td>

					<td colspan='2'>
						<table>
							<tr>
								<td></td>
								<td>CP</td>
								<td>SP</td>
							</tr>
							<tr>
								<td>1s ORGANOSDELOS SENTIDOS</td>
								<td><input type='text' id='txtemorganossentidoscp' class='span1'/></td>
								<td><input type='text' id='txtemorganossentidossp' class='span1'/></td>
							</tr>
							<tr>
								<td>2s RESPIRATORIO</td>
								<td><input type='text' id='txtemrespirtatoriocp' class='span1'/></td>
								<td><input type='text' id='txtemrespirtatoriosp' class='span1'/></td>
							</tr>
							<tr>
								<td>3S CARDIO VASCULAR</td>
								<td><input type='text' id='txtemcardiovascularcp' class='span1'/></td>
								<td><input type='text' id='txtemcardiovascularsp' class='span1'/></td>
							</tr>
							<tr>
								<td>4S DIGESTIVO</td>
								<td><input type='text' id='txtemmiembrossuperiorescp' class='span1'/></td>
								<td><input type='text' id='txtemmiembrossuperioressp' class='span1'/></td>
							</tr>
							<tr>
								<td>5S GENITAL</td>
								<td><input type='text' id='txtemgenitalcp' class='span1'/></td>
								<td><input type='text' id='txtemgenitalsp' class='span1'/></td>
							</tr>
						</table>
					</td>
				</tr>




		";

		}
		echo "</table>";
	}
	//emergencia



	public function AdelantarFecha($modo,$valor,$fecha_inicio=false){
 
	   if($fecha_inicio!=false) {
	          $fecha_base = strtotime($fecha_inicio);
	   }else {
	          $time=time();
	          $fecha_actual=date("Y-m-d",$time);
	          $fecha_base=strtotime($fecha_actual);
	   }
	 
	   $calculo = strtotime("$valor $modo","$fecha_base");
	 
	   return date("Y-m-d", $calculo);
	 
	}

	public function LoadDataCi($code)
	{
		$cit=new Turno;
		$datos=$cit->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_tu='$code';");
		echo "
			<table class='table table-bordered table-striped table-condensend'>
		";
		foreach ($datos as $f) {
			$PACIENTE=$cit->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$f[id_pac]';");
			$PACIENTE=utf8_encode($PACIENTE);
			$TELEFONO=$cit->Consultar("SELECT telefono_pac FROM tbl_paciente WHERE id_pac='$f[id_pac]';");
			$Celular=$cit->Consultar("SELECT celular_pac FROM tbl_paciente WHERE id_pac='$f[id_pac]';");
			echo "
				<tr>
					<td>Fecha Reserva: </td>
					<td>$f[fechaR_tu]</td>
				</tr>
				<tr>
					<td>Fecha Consulta: </td>
					<td>$f[fechaC_tu]</td>
				</tr>
				<tr>
					<td>Paciente: </td>
					<td>$PACIENTE</td>
				</tr>
				<tr>
					<td>Telefono Paciente: </td>
					<td>$TELEFONO</td>
				</tr>
				<tr>
					<td>Celular Paciente: </td>
					<td>$Celular</td>
				</tr>
			";
		}
		echo "</table>";
	}
	
public function CargarVistaCitasPorSemana($backandnext,$persona)
	{
		
		$tur=new Turno;
		$HO=new Hora;
		$today=NULL;
		$LUNES=NULL;
		$MARTES=NULL;
		$MIERCOLES=NULL;
		$JUEVES=NULL;
		$VIERNES=NULL;
		$SABADO=NULL;
		$DOMINGO=NULL;
		$LUNES2=NULL;
		$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');
	
		$today=$this->Mifecha();
		$NUMERODIA=date('N', strtotime($backandnext))-1;
		if($NUMERODIA==0){
				$LUNES2=$backandnext;
		}else{
			 	$LUNES2=$this->AdelantarFecha("days",-$NUMERODIA,$backandnext);
		}
			
		$LUNES=$LUNES2;
		$MARTES=$this->AdelantarFecha("days",1,$LUNES);
		$MIERCOLES=$this->AdelantarFecha("days",2,$LUNES);
		$JUEVES=$this->AdelantarFecha("days",3,$LUNES);
		$VIERNES=$this->AdelantarFecha("days",4,$LUNES);
		$SABADO=$this->AdelantarFecha("days",5,$LUNES);
		$DOMINGO=$this->AdelantarFecha("days",6,$LUNES);
		$vecLunes=NULL;
		$vecMartes=NULL;
		$vecMiercoles=NULL;
		$vecJueves=NULL;
		$vecViernes=NULL;
		$vecSabado=NULL;
		$vecDomingo=NULL;
		$datos2=$HO->Consultar_Hora("SELECT * FROM tbl_hora;");
		echo "	
			<div class='table-responsive'>
			<table class='table table-bordered table-striped table-condensend'>
			<tr>
				<th colspan='8'><center>$LUNES  //  $DOMINGO</center></th>
			</tr>
			<tr>
				<th>Hora</th>
				<th>Lunes</br><hr> $LUNES</th>
				<th>Martes</br><hr> $MARTES</th>
				<th>Miercoles</br><hr> $MIERCOLES</th>
				<th>Jueves</br><hr> $JUEVES</th>
				<th>Viernes</br><hr> $VIERNES</th>
				<th>Sabado</br><hr> $SABADO</th>
				<th>Domingo</br><hr> $DOMINGO</th>
			</tr>
		";
		foreach ($datos2 as $h) {
			echo "<tr>";
				echo "<td>$h[hora_hor]</td>";

				
				if($persona==""){
					$vecLunes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$LUNES' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecLunes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$LUNES' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				$MEDICO=NULL;
				echo "<td>"; 
					foreach ($vecLunes as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						
						echo "<a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='LoadDataCi($l[id_tu])'>$MEDICO
						</br>
							Cita: $ESTADO
						</a> ";
					}
				echo"</td>";

				if($persona==""){
					$vecMartes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$MARTES' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecMartes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$MARTES' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				echo "<td>";
					foreach ($vecMartes as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						echo "<a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='LoadDataCi($l[id_tu])'>$MEDICO
						</br>
							Cita: $ESTADO
						</a> ";
					}
				echo"</td>";

				if($persona==""){
					$vecMiercoles=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$MIERCOLES' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecMiercoles=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$MIERCOLES' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				echo "<td>";
					foreach ($vecMiercoles as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						echo "<a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='LoadDataCi($l[id_tu])'>$MEDICO
						</br>
							Cita: $ESTADO
						</a> ";
					}
				echo "</td>";

				if($persona==""){
					$vecJueves=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$JUEVES' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecJueves=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$JUEVES' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				echo "<td>";
					foreach ($vecJueves as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						echo "<a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='LoadDataCi($l[id_tu])'>$MEDICO
						</br>
							Cita: $ESTADO
						</a> ";
					}
				echo"</td>";

				if($persona==""){
					$vecViernes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$VIERNES' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecViernes=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$VIERNES' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				echo "<td>"; 
					foreach ($vecViernes as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						echo "<a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='LoadDataCi($l[id_tu])'>$MEDICO
						</br>
							Cita: $ESTADO
						</a> ";
					}
				echo"</td>";

				if($persona==""){
					$vecSabado=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$SABADO' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecSabado=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$SABADO' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				echo "<td>";
					foreach ($vecSabado as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						echo "<a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='LoadDataCi($l[id_tu])'>$MEDICO
						</br>
							Cita: $ESTADO
						</a> ";
					}
				echo"</td>";

				if($persona==""){
					$vecDomingo=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$DOMINGO' AND id_hor='$h[id_hor]' ORDER BY id_hor ;");
				}else{
					$vecDomingo=$tur->Consultar_Turno("SELECT * FROM tbl_turno WHERE fechaC_tu='$DOMINGO' AND id_hor='$h[id_hor]' AND id_usu='$persona' ORDER BY id_hor ;");
				}
				echo "<td>"; 
					foreach ($vecDomingo as $l) {
						$ESTADO="";
						switch ($l["estado_tur"]) {
							case 'AE':
								 $ESTADO="Agendada";
								break;
							case 'CC':
								 $ESTADO="Cancelada";
								break;
							case 'RM':
								 $ESTADO="Completada";
								break;
						}
						$MEDICO=$HO->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$l[id_usu]';");
						echo "<a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='LoadDataCi($l[id_tu])'>$MEDICO
						</br>
							Cita: $ESTADO
						</a> ";
					}
				echo "</td>";

			echo "</tr>";
		}
		echo '</table></div>';
		
	}

//cerrar session
	public function CloseWindows($verificar)
	{
			if($verificar=="0"){
				session_start();
					session_destroy();	
				$_SESSION['DOCTOR']=NULL;
					session_destroy();
				$_SESSION['ENFERMERA']=NULL;
					session_destroy();
				return 0;	
			}else{
				$verificar=$verificar;
			}
			echo $verificar;
	}



// data para protocosl
	public function DATAHORA()
	{
		$ho=new Hora;
		$datos1=$ho->Consultar_Hora("SELECT * FROM tbl_hora");
		$datah = array();
		foreach ($datos1 as $fila) {
			$datah[] = array(
					'id' =>$fila['id_hor'] , 
					'hora' =>$fila['hora_hor'] 
				);
		}
		return json_encode($datah);	
	}
	public function DATAPROTOCOLO($idac){
		$idac=623;
		$cit=new CitaCirugia;
		$ho=new Hora;
		$pro=new ProtocoloOperatorio;
		$datos=$cit->Consultar_CitaCirugia("SELECT * FROM tbl_citacirugia WHERE id_cir='$idac' AND estado_cir='C';"); //aprobacion de cita cirugia
		session_start();
		$idUser=$_SESSION['IDUser'];
		$permisos=$pro->Consultar("SELECT id_rol FROM tbl_usuario WHERE id_usu='$idUser';"); // permisos de usuario
		$datapop = array();	//vector para el data de angular
		$exisprotoc=$cit->Consultar("SELECT COUNT(*) FROM tbl_protocoloperatorio WHERE id_cir='$idac';"); //comprobacion de que existe un protocolo asignado a la cita
		$nuevopop=$cit->Consultar("SELECT newest_pop FROM tbl_protocoloperatorio WHERE id_cir='$idac';"); //comprobacion de que existe nuevo protocolo 
		$vecpop=NULL;
		if(count($datos)>0 & $exisprotoc==0 & $nuevopop==""){ // primera ves protocolo version antigua
			foreach ($datos as $fila) {
				$CEDULA=$cit->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]';");
				$NOMBRE=$cit->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]';");
				$NOMBRE=utf8_encode($NOMBRE);
				$datapop[]= array(
					'NOMBRE' =>  $NOMBRE, 
					'HCL' => $CEDULA,
					'PRE'=> "",
					'POST'=> "",
					'CIRUGIA'=> "",
					'CIRUJANO'=> "",
					'ANESTESIOLOGO'=> "",
					'COOCIRUJANO'=> "",
					'INSTRUMENTISTA'=> "",
					'PRIMERAYUDANTE'=> "",
					'CIRCULANTE'=> "",
					'SEGUNDOAYUDANTE'=> "",
					'FECHA1'=> "",
					'HORAI'=> "",
					'HORAF'=> "",
					'TIPOANESTESIA'=> "",
					'TQUIRURGICO'=> "",
					'HALLAZGOS'=> "",
					'PROCEDIMIENTOS'=> "",
					'COMPLICACIONES'=> "",
					'SANGRADO'=> "",
					'HISTOPATOLOGIA'=> "",
					'PREPARADPOR'=> " ",
					'FECHA2'=> "",
					'APROBADOPOR'=> "",
					'FECHA3'=> "",
					'ECOGRAFISTA'=>"",
					'SERVICIO'=>"",
					'PERMISOS'=>$permisos,
					'LISTCIRUGIA'=>"",
					'IDCITCIR'=>$idac
					);
			}
			//return json_encode($datapop);
		}elseif(count($datos)>0 & $exisprotoc>0 & $nuevopop==""){ //existencia de protocolo antiguo
			$IDPOP=$pro->Consultar("SELECT MAX(id_pop) FROM tbl_protocoloperatorio WHERE id_cir='$idac'");
			$vecpop=$pro->Consultar_ProtocoloOperatorio("SELECT * FROM tbl_protocoloperatorio WHERE id_pop='$IDPOP'");
			foreach ($vecpop as $fila){
				$CEDULA=$cit->Consultar("SELECT cedula_pac FROM tbl_citacirugia c, tbl_paciente p WHERE c.id_pac=p.id_pac AND c.id_cir='$idac';");
				$NOMBRE=$cit->Consultar("SELECT nombresCom_pac FROM tbl_citacirugia c, tbl_paciente p WHERE c.id_pac=p.id_pac AND c.id_cir='$idac';");
				$NOMBRE=utf8_encode($NOMBRE);
				$datapop[]= array(
					'NOMBRE' =>  $NOMBRE, 
					'HCL' => $CEDULA,
					'PRE'=> $fila["preop_pop"],
					'POST'=> $fila["postoperatorio_pop"],
					'CIRUGIA'=> $fila["cirugiaefectuada_pop"],
					'CIRUJANO'=> $fila["cirujano_pop"],
					'ANESTESIOLOGO'=> $fila["anestesiologo_pop"],
					'COOCIRUJANO'=> $fila["coocirujano_pop"],
					'INSTRUMENTISTA'=> $fila["instrumentista_pop"],
					'PRIMERAYUDANTE'=> $fila["priayudante_pop"],
					'CIRCULANTE'=> $fila["circulante_pop"],
					'SEGUNDOAYUDANTE'=> $fila["segayudante_pop"],
					'FECHA1'=> $fila["datecirugia_pop"],
					'HORAI'=> $fila["horainicio_pop"],
					'HORAF'=> $fila["horafin_pop"],
					'TIPOANESTESIA'=> $fila["tipanestesiologo_pop"],
					'TQUIRURGICO'=> $fila["etiempoquirugico_pop"],
					'HALLAZGOS'=> $fila["hallazgos_pop"],
					'PROCEDIMIENTOS'=> $fila["procedimientos_pop"],
					'COMPLICACIONES'=> $fila["complicaciones_pop"],
					'SANGRADO'=> $fila["sangrado_pop"],
					'HISTOPATOLOGIA'=> $fila["histopatologia_pop"],
					'PREPARADPOR'=> $fila["preparadopor_pop"],
					'FECHA2'=> $fila["date2_pop"],
					'APROBADOPOR'=> $fila["aprobadopor_pop"],
					'FECHA3'=> $fila["date3_pop"],
					'ECOGRAFISTA'=>$fila["ecografista_pop"],
					'SERVICIO'=>$fila["servicio_pop"],
					'PERMISOS'=>$permisos,
					'LISTCIRUGIA'=>"",
					'IDCITCIR'=>$idac
					);		
			}				
		}elseif(count($datos)>0 & $exisprotoc>0 & $nuevopop=="N"){ //existencia de protocolo nuevo
		}
		return json_encode($datapop);
	}
	public function AddNuevoProtocolo()
	{
		$pop=new ProtocoloOperatorio;
		$datapop = file_get_contents("php://input");
		$IDCIT=json_decode($datapop);
		foreach ($IDCIT as $f) {
			echo $f->IDCITCIR;
		}
		$today=$this->Mifecha();
	   	$res=$pop->Ejecutar("INSERT INTO tbl_protocoloperatorio (data_pop,newest_pop,fechaing_pop) VALUES('$datapop','N','$today');");
	  //  echo $res;
	}
	public function DataCirugia($buscar)
	{
		$iess=new CodigoIess;
		$datos=$iess->Consultar_CodigoIess("SELECT * FROM tbl_codigoiess WHERE  codigo_ciess LIKE '$buscar%' OR descripcion_ciess LIKE '$buscar%' LIMIT 100");
		$dataCodigosIess = array();
		foreach ($datos as $fila) {
			$dataCodigosIess[] = array(
					'Id' =>$fila['id_ciess'] , 
					'Codigo' =>$fila['codigo_ciess'],
					'Descripcion' =>$fila['descripcion_ciess'],
					'Precio' =>$fila['valor_ciess']
				);
		}
		return json_encode($dataCodigosIess);
	}


		/* buscador general de medicos */
	public function BuscadorDataGeneralMedicos($buscar)
	{
		$usu=new Usuario;
		$datos=$usu->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE CONCAT(apellidos_usu,' ',nombres_usu) LIKE '%$buscar%' AND estado_usu='A' AND id_rol='1' OR cedula_usu LIKE '%$buscar%' AND estado_usu='A' AND id_rol='1' LIMIT 100");
		$dataMedicos = array();
		foreach ($datos as $fila) {
			$dataMedicos[]=array(
						'Codigo' =>$fila["id_usu"] ,
						'Cedula'=>$fila["cedula_usu"],
						'Medico'=>$fila["apellidos_usu"]." ".$fila["nombres_usu"],
						'Edad'=>$fila["edad_usu"]
						 );
		}
		return json_encode($dataMedicos);
	}
	/* fin buscador general de medicos*/

	public function CalcularHora2($hi,$hf)
	{
		$h=new Hora;
		$start_time=$h->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$hi'");
		$end_time=$h->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$hf'");
		
		$total_seconds = strtotime($end_time) - strtotime($start_time); 
	    $horas              = floor ( $total_seconds / 3600 );
	    $minutes            = ( ( $total_seconds / 60 ) % 60 );
	    $seconds            = ( $total_seconds % 60 );
	     
	    $time['horas']      = str_pad( $horas, 2, "0", STR_PAD_LEFT );
	    $time['minutes']    = str_pad( $minutes, 2, "0", STR_PAD_LEFT );
	    $time['seconds']    = str_pad( $seconds, 2, "0", STR_PAD_LEFT );
	     
	    $time               = implode( ':', $time );

		return $time;
	}
//fin protocolo operatorio 2

	//Diagnostico pre-operatorio Aux2
	public function BuscarCodigoIess3Aux2($buscar,$rol)
	{
		
		$dgnCie=new CodigoDiagnostico;
		$datos=$dgnCie->Consultar_CodigoDiagnostico("SELECT * FROM tbl_diagnostico WHERE codigo_cie LIKE '$buscar%' OR descripcion_cie LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Tipo</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_cie]'>$fila[codigo_cie]</div></td>
						<td><div id='desc$fila[id_cie]'>$fila[descripcion_cie]</div></td>
						<td><div id='valo$fila[id_cie]'>$fila[tipo_cie]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarIessAux2($fila[id_cie])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}


	//Diagnostico pre-operatorio Aux3
	public function BuscarCodigoIess3Aux3($buscar,$rol)
	{
		
		$dgnCie=new CodigoDiagnostico;
		$datos=$dgnCie->Consultar_CodigoDiagnostico("SELECT * FROM tbl_diagnostico WHERE codigo_cie LIKE '$buscar%' OR descripcion_cie LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Tipo</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_cie]'>$fila[codigo_cie]</div></td>
						<td><div id='desc$fila[id_cie]'>$fila[descripcion_cie]</div></td>
						<td><div id='valo$fila[id_cie]'>$fila[tipo_cie]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarIessAux3($fila[id_cie])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}


	//Diagnostico post-operatorio Aux2
	public function BuscarPostOpAux2($buscar,$rol)
	{
		
		$dgnCie=new CodigoDiagnostico;
		$datos=$dgnCie->Consultar_CodigoDiagnostico("SELECT * FROM tbl_diagnostico WHERE codigo_cie LIKE '$buscar%' OR descripcion_cie LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Tipo</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_cie]'>$fila[codigo_cie]</div></td>
						<td><div id='desc$fila[id_cie]'>$fila[descripcion_cie]</div></td>
						<td><div id='valo$fila[id_cie]'>$fila[tipo_cie]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarPostAux2($fila[id_cie])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}


	//Diagnostico post-operatorio Aux3
	public function BuscarPostOpAux3($buscar,$rol)
	{
		
		$dgnCie=new CodigoDiagnostico;
		$datos=$dgnCie->Consultar_CodigoDiagnostico("SELECT * FROM tbl_diagnostico WHERE codigo_cie LIKE '$buscar%' OR descripcion_cie LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Tipo</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_cie]'>$fila[codigo_cie]</div></td>
						<td><div id='desc$fila[id_cie]'>$fila[descripcion_cie]</div></td>
						<td><div id='valo$fila[id_cie]'>$fila[tipo_cie]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarPostAux3($fila[id_cie])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}


	//Cirugia efectuada Aux2
	public function BuscarCodigoCirgAux2($buscar,$rol)
	{
		$iess=new CodigoIess;
		$datos=$iess->Consultar_CodigoIess("SELECT * FROM tbl_codigoiess WHERE codigo_ciess LIKE '$buscar%' OR descripcion_ciess LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Valor</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_ciess]'>$fila[codigo_ciess]</div></td>
						<td><div id='desc$fila[id_ciess]'>$fila[descripcion_ciess]</div></td>
						<td><div id='valo$fila[id_ciess]'>$fila[valor_ciess]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarCirgAux2($fila[id_ciess])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}


	//Cirugia efectuada Aux3
	public function BuscarCodigoCirgAux3($buscar,$rol)
	{
		$iess=new CodigoIess;
		$datos=$iess->Consultar_CodigoIess("SELECT * FROM tbl_codigoiess WHERE codigo_ciess LIKE '$buscar%' OR descripcion_ciess LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Valor</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_ciess]'>$fila[codigo_ciess]</div></td>
						<td><div id='desc$fila[id_ciess]'>$fila[descripcion_ciess]</div></td>
						<td><div id='valo$fila[id_ciess]'>$fila[valor_ciess]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarCiruAux3($fila[id_ciess])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}


	//Diagnostico Hispatologia
	public function BuscarCodigoDiagnHisp($buscar,$rol)
	{
		$iess=new CodigoIess;
		$datos=$iess->Consultar_CodigoIess("SELECT * FROM tbl_codigoiess WHERE codigo_ciess LIKE '$buscar%' OR descripcion_ciess LIKE '$buscar%';");
		echo "
			<table class='table table-striped table-bordered table-hover'>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Valor</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>";
				echo "
						<td><div id='code$fila[id_ciess]'>$fila[codigo_ciess]</div></td>
						<td><div id='desc$fila[id_ciess]'>$fila[descripcion_ciess]</div></td>
						<td><div id='valo$fila[id_ciess]'>$fila[valor_ciess]</div></td>
					";
					switch ($rol) {
						case 1:
							echo "<td><input type='button' class='btn btn-success' value='Seleccionar' onclick='SeleccionarDgnHisp($fila[id_ciess])' /></td>";
							break;
					}
			echo "</tr>";
		}
		echo "</table>";
	}


}
?> 