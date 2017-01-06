<?php
class Logica1{


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


//procesos para el modulo digitador
	public function LoadPacienteToUpPdf($descripcion,$pr){
		$pac=new Paciente;
		$descripcion=utf8_decode($descripcion);
		$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE apellidos_pac LIKE '%$descripcion%' AND estado_pac='A' OR nombresCom_pac LIKE '%$descripcion%' AND estado_pac='A' OR cedula_pac LIKE '%$descripcion%' AND estado_pac='A' LIMIT 100;");
		echo "<table class='table table-bordered table-condensend table-hover table-striped' style='font-family:Times New Roman, Georgia, Serif; font-size:15px;'>
			<tr>
				<th>Cédula</th>
				<th>Nombres Paciente</th>
				<th></th>
			</tr>
		";
		foreach ($datos as $fila) {
			echo "
			<tr>
				<td>$fila[cedula_pac]</td>
				<td>".utf8_encode($fila["nombresCom_pac"])."</td>
			";

			if ($pr==1) {
				echo "
					<td>
						<center><a class='btn btn-success' href='#' onclick='FileOrder($fila[id_pac])'><i class='icon-file'></i> Archivar examenes</a></center>
					</td>
				";
			}

			echo"
			</tr>
			";
		}
		echo "</table>";
	}

	public function FormToUpPDFPaciente($id_pac){
		$pac=new Paciente;
		$cedula=$pac->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$id_pac';");
		if($pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac';")==0  && file_exists("../HP/$cedula")==false){
			 
				//carpeta raiz del paciente
				if(!mkdir("../HP/$cedula/", 0777, true)) {
				   die('Fallo al crear las carpetas...');
				}
				//fin de la carpeta raiz del paciente

				//carpetas de los archivos en pdf de los examenes que se arealizado el paciente
				if(!mkdir("../HP/$cedula/1/", 0777, true)) { //laboratorio
				   die('Fallo al crear las carpetas...');
				}
				if(!mkdir("../HP/$cedula/2/", 0777, true)) { // RX
				   die('Fallo al crear las carpetas...');
				}
				if(!mkdir("../HP/$cedula/3/", 0777, true)) {	//urudinamia
				   die('Fallo al crear las carpetas...');
				}
				if(!mkdir("../HP/$cedula/4/", 0777, true)) {	//ultrasonido
				   die('Fallo al crear las carpetas...');
				}
				if(!mkdir("../HP/$cedula/5/", 0777, true)) {	//tomografias
				   die('Fallo al crear las carpetas...');
				}
				if(!mkdir("../HP/$cedula/6/", 0777, true)) {	//otros
				   die('Fallo al crear las carpetas...');
				}
				if(!mkdir("../HP/$cedula/7/", 0777, true)) {	//otros
				   die('Fallo al crear las carpetas...');
				}
				if(!mkdir("../HP/$cedula/8/", 0777, true)) {	//otros
				   die('Fallo al crear las carpetas...');
				}
				//fin de las carpetas de los archivos en pdf de los examenes que se arealizado el paciente



				//menu o formulario para subir los archivos a el servidor
					$this->DisiFormUpToUpFile($id_pac);
				//fin menu o formulario para subir los archivos a el servidor
			
		}else{
			$this->DisiFormUpToUpFile($id_pac);
		}

	}
	public function DisiFormUpToUpFile($id_pac){
		$pac=new Paciente;

		$laboratorio=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='1';");
		$rx=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='2';");
		$urudinamia=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='3';");
		$ultrasonido=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='4';");
		$tomografias=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='5';");
		$otros=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='6';");
		$auto=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='7';");
		$HC=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='8';");


		$pacientenom=$pac->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$id_pac';");
		$pacientenom=utf8_encode($pacientenom);
		echo "
			<table class='table table-bordered table-condensend table-hover table-striped'>
				<tr>
					<th colspan='5'>
						<h3><center>Examenes del paciente $pacientenom</center></h3>
					</th>
				</tr>
				<tr>
					<th>Examenes</th>
					<th>Cantidad</th>
					<th>Subir</th>
					<th>Ver</th>
					<th>Ver Lista</th>
				</tr>
                
				<tr>
					<th>Laboratorios </th>
					<th>$laboratorio Archivos <i class='icon-file'></i></th>
					<th><a href='#' role='button' class='btn btn-success' onclick='UpFile($id_pac,1)'><i class='icon-file'></i> Subir</a></th>
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,1)'><i class='icon-list'></i> Ver</a></th>





					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,1)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Rx</th>
					<th>$rx Archivos <i class='icon-file'></i></th>
					<th><a href='#' role='button'  class='btn btn-success' onclick='UpFile($id_pac,2)'><i class='icon-file'></i> Subir</a></th>
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,2)'><i class='icon-list'></i> Ver</a></th>




					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,2)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Urudinamia</th>
					<th>$urudinamia Archivos <i class='icon-file'></i></th>
					<th><a  href='#' role='button' class='btn btn-success' onclick='UpFile($id_pac,3)'><i class='icon-file'></i> Subir</a></th>
					<th><a  href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,3)'><i class='icon-list'></i> Ver</a></th>



					<th><a  href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,3)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Ultrasonido</th>
					<th>$ultrasonido Archivos <i class='icon-file'></i></th>
					<th><a  href='#' role='button'  class='btn btn-success' onclick='UpFile($id_pac,4)'><i class='icon-file'></i> Subir</a></th>
					<th><a  href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,4)'><i class='icon-list'></i> Ver</a></th>


					<th><a  href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,4)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Tomografia</th>
					<th>$tomografias Archivos <i class='icon-file'></i></th>
					<th><a  href='#' role='button' class='btn btn-success' onclick='UpFile($id_pac,5)'><i class='icon-file'></i> Subir</a></th>
					<th><a  href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,5)'><i class='icon-list'></i> Ver</a></th>

					<th><a  href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,5)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Cardiologia</th>
					<th>$otros Archivos <i class='icon-file'></i></th>
					<th><a  href='#' role='button' class='btn btn-success' onclick='UpFile($id_pac,6)'><i class='icon-file'></i> Subir</a></th>
					<th><a  href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,6)'><i class='icon-list'></i> Ver</a></th>
					<th><a  href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,6)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 


				<th>Autorizaciones</th>
					<th>$auto Archivos <i class='icon-file'></i></th>
					<th><a  href='#' role='button' class='btn btn-success' onclick='UpFile($id_pac,7)'><i class='icon-file'></i> Subir</a></th>
					<th><a  href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,7)'><i class='icon-list'></i> Ver</a></th>
					<th><a  href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,7)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 



				<th>HC Antigua</th>
					<th>$HC  Archivos <i class='icon-file'></i></th>
					<th><a  href='#' role='button' class='btn btn-success' onclick='UpFile($id_pac,8)'><i class='icon-file'></i> Subir</a></th>
					<th><a  href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,8)'><i class='icon-list'></i> Ver</a></th>
					<th><a  href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,8)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr>                
			</table>
		";

	}
	public function LoadARchivosToMedico($id_pac){
		$pac=new Paciente;

		$laboratorio=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='1';");
		$rx=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='2';");
		$urudinamia=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='3';");
		$ultrasonido=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='4';");
		$tomografias=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='5';");
		$otros=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='6';");
		$auto=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='7';");
		$HC=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='8';");


		$pacientenom=$pac->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$id_pac';");
		$pacientenom=utf8_encode($pacientenom);
		echo "
			<table class='table table-bordered table-condensend table-hover table-striped'>
				<tr>
					<th colspan='5'>
						<h3><center>Examenes del paciente $pacientenom</center></h3>
					</th>
				</tr>
				<tr>
					<th>Examenes</th>
					<th>Cantidad</th>
					
					<th>Ver</th>
					<th>Ver Lista</th>
				</tr>
                
				<tr>
					<th>Laboratorios </th>
					<th>$laboratorio Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' class='btn btn-info' onclick='SeeAllFile($id_pac,1)'><i class='icon-list'></i> Ver</a></th>





					<th><a href='#' class='btn btn-primary' onclick='SeeList($id_pac,1)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Rx</th>
					<th>$rx Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' class='btn btn-info' onclick='SeeAllFile($id_pac,2)'><i class='icon-list'></i> Ver</a></th>




					<th><a href='#' class='btn btn-primary' onclick='SeeList($id_pac,2)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Urudinamia</th>
					<th>$urudinamia Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' class='btn btn-info' onclick='SeeAllFile($id_pac,3)'><i class='icon-list'></i> Ver</a></th>



					<th><a href='#' class='btn btn-primary' onclick='SeeList($id_pac,3)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Ultrasonido</th>
					<th>$ultrasonido Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' class='btn btn-info' onclick='SeeAllFile($id_pac,4)'><i class='icon-list'></i> Ver</a></th>


					<th><a href='#' class='btn btn-primary' onclick='SeeList($id_pac,4)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Tomografia</th>
					<th>$tomografias Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' class='btn btn-info' onclick='SeeAllFile($id_pac,5)'><i class='icon-list'></i> Ver</a></th>

					<th><a href='#' class='btn btn-primary' onclick='SeeList($id_pac,5)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Otros</th>
					<th>$otros Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' class='btn btn-info' onclick='SeeAllFile($id_pac,6)'><i class='icon-list'></i> Ver</a></th>
					<th><a href='#' class='btn btn-primary' onclick='SeeList($id_pac,6)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr>


				<th>Autorizacion</th>
					<th>$auto Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' class='btn btn-info' onclick='SeeAllFile($id_pac,7)'><i class='icon-list'></i> Ver</a></th>
					<th><a href='#' class='btn btn-primary' onclick='SeeList($id_pac,7)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr>


				<th>Historia antigua</th>
					<th>$HC Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' class='btn btn-info' onclick='SeeAllFile($id_pac,8)'><i class='icon-list'></i> Ver</a></th>
					<th><a href='#' class='btn btn-primary' onclick='SeeList($id_pac,8)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr>                
			</table>
		";
	}

public function UpTofilePaciente($id_pac,$pos,$fecha){
	$aux=new Paciente;
	$fil=NULL;
	$cedula=$aux->Consultar("SELECT cedula_pac FROM tbl_paciente WHERE id_pac='$id_pac';");
	
	if(isset($_SERVER['HTTP_X_FILE_NAME']))
		{
			if(!file_exists("../HP/$cedula/$pos/")){
				if(!mkdir("../HP/$cedula/$pos/", 0777, true)) {	//electrocardiograma
				   die('Fallo al crear las carpetas...');
				}
			}



			$fil=$_SERVER['HTTP_X_FILE_NAME'];
			if(file_exists("../HP/$cedula/$pos/$fil"))
			{
						echo "
								<center><h3>Hay!! Un archivo con el mismo nombre en el servidor</h3></center>
							 ";
			}
			else
			{
				$url="../HP/$cedula/$pos/".$_SERVER['HTTP_X_FILE_NAME'];
				//$today=date("y-m-d");
				$today=$fecha;
				$res1=$aux->Ejecutar("INSERT INTO tbl_file (id_pac,url_fil,nombre_fil,ubicacion_fil,fecha_fil) VALUES('$id_pac','$url','$fil','$pos','$today');");
				if($res1==1)
				{
							$carpeta="../HP/$cedula/$pos/";
								file_put_contents($carpeta.$_SERVER['HTTP_X_FILE_NAME'],
								file_get_contents('php://input'));
							
							echo "<center><h3>Se guardo correctamente el archivo con el nombre: $fil</h3></center>";
							
				}
				else
				{
							echo "Error: ".$res;
				}	
			}
		}
		

}	
	

public function LoadFilePaciente($pac,$pos,$ac,$b){
	$fl=new File;
	
	$datos=$fl->Consultar_File("SELECT * FROM tbl_file WHERE id_pac='$pac' AND ubicacion_fil='$pos' ORDER BY fecha_fil DESC ;");
	if(count($datos)>0){
		foreach ($datos as $fila) {
			if($ac=="1"){
				echo "
				<table class='table table-bordered table-striped table-condensed table-hover'><tr><td><center><input type='button' class='btn btn-success' value='Regresar' id='btnRegresar' onclick='FileOrder($pac)' style='font-family:Times New Roman, Georgia, Serif;'/></center></td></tr></table>
				<div class='Archivos'>
				<object type='text/html' data='$fila[url_fil]'></object>
				<a href='$fila[url_fil]' target='_blank'><div class='InfoFile'>
					Fecha:$fila[fecha_fil] </br>
					Nombre: $fila[nombre_fil]
				</div></a>
				</div>
			";
			}
			if($ac=="2"){
				echo "
					<table class='table table-bordered table-striped table-condensed table-hover'><tr><td><center><input type='button' class='btn btn-success' value='Regresar' id='btnRegresar' onclick='FileOrder($pac)' style='font-family:Times New Roman, Georgia, Serif;'/></center></td></tr></table>
					<div class='LArchivo'>
								<a href='$fila[url_fil]' target='_blank'>
								<div class='info'>
								</br>
								</br>
								</br>
								</br>
								Fecha:$fila[fecha_fil] 
								Nombre: $fila[nombre_fil]";
						if($b==0){
							echo "";
						}
						if ($b==1) {
							echo "<a href='#' class='btn btn-danger' onclick='DeleteFil($fila[id_fil],$pac)'><i class='icon-trash'></i> Borrar</a>";
						}
				echo "				
								</div></a>

								<div class='previa'><object type='text/html' data='$fila[url_fil]'></object></div></th>
							
					</div>
				";
			}
		
		}
	}else{
		echo "<table class='table table-bordered table-striped table-condensed table-hover'><tr><td><center><input type='button' class='btn btn-success' value='Regresar' id='btnRegresar' onclick='FileOrder($pac)' style='font-family:Times New Roman, Georgia, Serif;'/></center></td></tr></table>";
		echo $this->Msm("r", "No existen exámenes");
	}

}

public function DeleteFil($id_file){
	$fl=new File;
	$url=$fl->Consultar("SELECT url_fil FROM tbl_file WHERE id_fil='$id_file';");
	$fl->Ejecutar("DELETE FROM tbl_file WHERE id_fil='$id_file';");
	if(unlink($url)){
	echo $this->Msm("r", "Se ha eliminado correctamente el archivo");
	}
}


//fin procesos para el modulo digitador

//metodo para cargar las citas de los pacientes  y poder cancelarlas
public function AgendaEneferme($buscar){
	$pac=new Paciente;
	$tu=new Turno;	
	$today=$this->Mifecha();
	$buscar=utf8_decode($buscar);
	$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE cedula_pac LIKE '$buscar%' AND estado_pac='A' OR nombresCom_pac LIKE '%$buscar%'  AND estado_pac='A' OR nombres_pac LIKE '%$buscar%' AND estado_pac='A' AND apellidos_pac LIKE '%$buscar%' AND estado_pac='A' LIMIT 60;");
	echo "<div class='table-responsive'><table class='table table-striped table-hover table-condensed table-bordered'>
		<tr>
			<td>Cédula</td>
			<td>Paciente</td>
			<td>Médico</td>
			<td>Especialidad</td>
			<td>Fecha Cita</td>
			<td>Hora</td>
			<td>Turno</td>
			<td></td>
			<td></td>
		</tr>
	";
	foreach ($datos as $fila) {
		$datos1=$tu->Consultar_Turno("SELECT * FROM tbl_turno WHERE id_pac='$fila[id_pac]' AND fechaC_tu>='$today' AND estado_tur!='E';");


		if(count($datos1)>=0){
			
			foreach ($datos1 as $fila1) {
				$Medico=$tu->Consultar("SELECT u.nombresCom_usu FROM tbl_turno t, tbl_usuario u WHERE t.id_tu='$fila1[id_tu]' AND t.fechaC_tu>='$today' AND t.id_usu=u.id_usu AND t.estado_tur!='E';");
				$Especialidad=$tu->Consultar("SELECT e.descripcion_esp FROM tbl_turno t, tbl_usuario u, tbl_especialida e WHERE t.id_tu='$fila1[id_tu]' AND t.fechaC_tu>='$today' AND t.id_usu=u.id_usu AND u.id_esp=e.id_esp AND t.estado_tur!='E';");
				$Fecha=$tu->Consultar("SELECT t.fechaC_tu FROM tbl_turno t, tbl_usuario u WHERE t.id_tu='$fila1[id_tu]' AND t.fechaC_tu>='$today' AND t.id_usu=u.id_usu AND t.estado_tur!='E';");
				$Hora=$tu->Consultar("SELECT h.hora_hor FROM tbl_turno t, tbl_usuario u, tbl_hora h WHERE t.id_tu='$fila1[id_tu]' AND t.fechaC_tu>='$today' AND t.id_usu=u.id_usu AND h.id_hor=t.id_hor AND t.estado_tur!='E' ;");
				$Turno=$tu->Consultar("SELECT numero_tur FROM tbl_turno WHERE id_tu='$fila1[id_tu]' AND fechaC_tu>='$today' AND estado_tur!='E';");
				$Codigo=$tu->Consultar("SELECT id_tu FROM tbl_turno WHERE id_tu='$fila1[id_tu]' AND fechaC_tu>='$today' AND estado_tur!='E';");

					echo "<tr>
						<td>$fila[cedula_pac]</td>
						<td>".utf8_encode($fila["nombresCom_pac"])."</td>
						<td>$Medico</td>
						<td>$Especialidad</td>
						<td>$Fecha</td>
						<td>$Hora</td>
						<td>$Turno</td>

						<!-- <td><a href='#' class='btn btn-danger' onclick='CancelarCita($Codigo)'>Cancelar Cita</a></td>
					<td><a href='#' class='btn btn-info' onclick='ModificarCita($Codigo)'>Modificar Cita</a></td> -->

						<td><a href='#myModal' role='button'  data-toggle='modal' class='btn btn-danger' onclick='CancelarCita($Codigo)'> Cancelar Cita</a></td>
						<td><a href='#' class='btn btn-info' onclick='ModificarCita($Codigo)'> Modificar Cita</a></td>
				";
					echo "</tr>";
			}

		
		}else{
			echo "";
		}
	}
	echo "</table></div>";
}
//fin metodo para cargar las citas de los pacientes  y poder cancelarlas

public function CargarDatosUpdatePaciente($cedula,$pro){
	$pac=new Paciente;
	$cedula=utf8_decode($cedula);
	$datos=$pac->Consultar_Paciente("SELECT * FROM tbl_paciente WHERE cedula_pac LIKE '$cedula%' AND estado_pac='A'  OR nombresCom_pac LIKE '%$cedula%'  AND estado_pac='A' LIMIT 100;");
	if (count($datos)>0) {
			echo "
			<div class='table-responsive'><table class='table table-striped table-bordered table-condensend table-hover'>
			<tr>
				<th>Cédula</th>
				<th>Paciente</th>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		";
		foreach ($datos as $fila) {
			echo "<tr>
					<td>$fila[cedula_pac]</td>
					<td>".$fila["nombresCom_pac"]."</td>
					<td>$fila[auxmovimiento_pac]</td>
					";
				switch ($pro) {
					case '1':
						echo "<td><center><a href='#' class='btn btn-primary' onclick='DatosAllFiliacion($fila[id_pac])'><i class='icon-refresh'></i> Modificar</a></center></td> 
						<td><center><a href='#myModal' role='button' class='btn btn-danger' data-toggle='modal' id='bntDeletePac' onclick='DelePac($fila[id_pac])' style='color:white;'><i class='icon-trash'></i> Eliminar<a/></center></td> ";
						break;
					
					case '2':
						echo "<td colspan='2'><center><a href='#' role='button' class='btn btn-success' onclick='Ini1CitCirugia($fila[id_pac])'><i class='icon-cog'></i> Cita Cirugia</a></center></td>
						<!--<td><a class='btn btn-danger' onclick='DelePac($fila[id_pac])'><i class='icon-trash'></i> Eliminar</a></td>--> ";
						break;
				}

			echo "
					
				</tr>
			";
		}
		echo "</table></div>";
	}else{
		echo $this->Msm("r", "No se encontró un paciente con esta cèdula");
	}
}

public function Frm1CitCirugia($codigo){
    $pac=new Paciente;
    $ti=new Hora;
    session_start();
    $today=$this->Mifecha();
    $today="20".$today;
    $log=NULL;
    if(isset($_SESSION['ENFERMERA'])) $log=$_SESSION['ENFERMERA'];
    elseif(isset($_SESSION['DOCTOR'])) $log=$_SESSION['DOCTOR'];
    $enfermera=$pac->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$log' AND estado_usu='A';");
    $nombre=$pac->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codigo';");
    $fecha_de_nacimiento=$pac->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo';");
    $edadpaciend=$this->Edad($fecha_de_nacimiento);
    $datos=$ti->Consultar_Hora("SELECT * FROM tbl_hora;");
    echo "
        <table class='table table-bordered table-hover table-condensend table-striped'>
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
                <th>Fecha De Cirugia:</th>
                <td><input type='date' id='txtfecprocir' onchange='CargarHorarios()'/></td>
                <th>Hora:</th>
                <td><div id='cmbhor'><select id='cmb_horacir'><option>--Seleccione un hora--</option>
                ";
                foreach ($datos as $fila) {
                    echo "<option value='$fila[id_hor]'>$fila[hora_hor]</option>";
                }
            echo "
                </select></div>
                </td>
            </tr>
            <tr>
                <th>Duraccion operacion:</th>
                <td colspan='3'><div class='input-append'><input type='text' id='txtduropera' class='span3' /><a class='btn' ><i class='icon-time'></i>Horas</a></div></td>
            </tr>
            <tr>
                <th>Cirujano:</th>
                <td colspan='3'><input type='text' id='txtCirujano' class='txtcirugia' /> <a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='SearCirujano()' ><i class='icon-plus'></i> Cirujano</a></td>
            </tr>
            <tr>
                <th>Anestesiologo:</th>
                <td colspan='3'><input type='text' id='txtanestesiologo'  class='txtcirugia'/>  <a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='SearchAnestesiologo();' ><i class='icon-plus'></i> Anestesiologo</a></td>
            </tr>
            <tr>
                <th>Ayudante:</th>
                <td colspan='3'><input type='text' id='txtayudante' class='txtcirugia'/>  <a href='#myModal' role='button' class='btn btn-success' data-toggle='modal' onclick='SearchAyudante();' ><i class='icon-plus'></i> Ayudante</a> </td>
            </tr>
            <tr>
                <th>Procedimiento:</th>
                <td colspan='3'><textarea  class='span6' id='txtprocedicirug' cols='40' rows='2' class='txtcirugia2'></textarea></td>
            </tr>
            <tr>
                <th>Tiempo de hospitalizacion:</th>
                <td colspan='3'><input type='text' id='txttiempohospital' style='width:60px;'/><select id='cmb_destiemhosp'><option value=''>--Seleccione--</option><option value='Horas'>Horas</option><option value='Dias'>Dias</option><option value='Semanas'>Semanas</option><option value='Meses'>Meses</option></select></td>
            </tr>
            <tr>
                <th>Observaciones:</th>
                <td colspan='3'><textarea class='span6' id='txtobservaciones' cols='40' rows='2' class='txtcirugia2'></textarea></td>
            </tr>
            <tr>
                <td colspan='4'><center><a href='#' class='btn btn-success' onclick='SaveCitaEmergenci()' ><i class='icon-file'></i>Guardar</a>

                <a href='#' class='btn btn-primary' id='btnExitAgenda'><i class='icon-file'></i>Cancelar</a>
                </center></td>
            </tr>
        </table>
		
		<script type='text/javascript'>
			$('#btnExitAgenda').click(function()
			{
				ShowAgendarCirg();
			});
		</script>
    ";
 
}

public function Frm2Cita2($codigo){
    $pac=new Paciente;
    $ti=new Hora;
    session_start();
    $today=$this->Mifecha();
    $today="20".$today;
    $log=NULL;
    if(isset($_SESSION['ENFERMERA'])) $log=$_SESSION['ENFERMERA'];
    elseif(isset($_SESSION['DOCTOR'])) $log=$_SESSION['DOCTOR'];
    $enfermera=$pac->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE login_usu='$log' AND estado_usu='A';");
    $nombre=$pac->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codigo';");

    $nombre=utf8_encode($nombre);

    $nombreMedico=$pac->Consultar("SELECT medico FROM tbl_paciente WHERE id_pac='$codigo';");
    $fecha_de_nacimiento=$pac->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo';");
    $edadpaciend=$this->Edad($fecha_de_nacimiento);
    $Telefono=$pac->Consultar("SELECT telefono_pac FROM tbl_paciente WHERE id_pac='$codigo';");
    $Celular=$pac->Consultar("SELECT celular_pac FROM tbl_paciente WHERE id_pac='$codigo';");
    $datos=$ti->Consultar_Hora("SELECT * FROM tbl_hora;");
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
            	<th>Telefono:</th>
            	<th>$Telefono</th>
            	<th>Celular: </th>
            	<th>$Celular</th>
            </tr>
              <tr>
                <th>Medico:</th>
                <td colspan='3'>
                	<input type='text' id='txtmedicio22' class='txtcirugia' href='#myModal' role='button'  data-toggle='modal' class='btn btn-success' onclick='BuscarDoctor()'/>
                	$nombreMedico
                </td>
            </tr>
            <tr>
                <th>Fecha De Cita:</th>
                <td><input type='date' id='txtfecprocir02' onchange='CargarHorarios02()'/></td>
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
            
          
          <!--  <tr>
                <th>Anestesiologo:</th>
                <td colspan='3'><input type='text' id='txtanestesiologo' onclick='SearchAnestesiologo();' class='txtcirugia'/></td>
            </tr>
            <tr>
                <th>Ayudante:</th>
                <td colspan='3'><input type='text' id='txtayudante' onclick='SearchAyudante()' class='txtcirugia'/></td>
            </tr>
            <tr>
                <th>Procedimiento:</th>
                <td colspan='3'><textarea id='txtprocedicirug' cols='200' rows='2' class='txtcirugia2'></textarea></td>
            </tr>
            <tr>
                <th>Tiempo de hospitalizacion:</th>
                <td colspan='3'><input type='text' id='txttiempohospital' style='width:60px;'/><select id='cmb_destiemhosp'><option value=''>--Seleccione--</option><option value='Horas'>Horas</option><option value='Dias'>Dias</option><option value='Semanas'>Semanas</option><option value='Meses'>Meses</option></select></td>
            </tr>
            <tr>
                <th>Observaciones:</th>
                <td colspan='3'><textarea id='txtobservaciones' cols='200' rows='2' class='txtcirugia2'></textarea></td>
            </tr>-->
            <tr>
                <td colspan='4'><center><a href='#' class='btn btn-success' onclick='SaveTurno002()' ><i class='icon-file'></i>Guardar</a></center></td>
            </tr>
        </table></div>
    ";
 
}



public function MedicosDispuestos($fecha,$hora,$medico,$cirujano,$anestesi,$btn){
	$tur=new Turno;
	$usu=new Usuario;
	$datos=$usu->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE nombresCom_usu LIKE '$medico%' AND estado_usu='A' AND id_rol='1' AND id_usu!='$cirujano' AND id_usu!='$anestesi';");
	$desho=$tur->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$hora';");
	echo "
		<table class='table table-bordered table-striped table-condensend table-hover'>
			<tr>
				<th>Medico</th>
				<th>Fecha</th>
				<th>Hora</th>
				<td></td>
			</tr>
	";
	foreach ($datos as $fila) {
		$disponi=$tur->Consultar("SELECT COUNT(*) FROM tbl_turno WHERE fechaC_tu='$fecha' AND id_hor='$hora' AND id_usu='$fila[id_usu]' AND estado_tur!='E';");
		if($disponi>0){
			echo "
			<tr>
				<td>$fila[nombresCom_usu]</td>
				<td colspan='3'>Medico indispuesto en esta fecha: $fecha a esta hora: $desho </td>
				
			</tr>
		";
		}else{
			echo "
			<tr>
				<td><div id='cir_$fila[id_usu]'>$fila[nombresCom_usu]</div></td>
				<td>$fecha</td>
				<td>$desho</td>";
				if ($btn==1) {
					echo "<td><a  data-dismiss='modal' aria-hidden='true' class='btn btn-success' onclick='AgendCiruj($fila[id_usu])'><i class='icon-book'></i> Reservar</a></td>";
				}
				if ($btn==2) {
					echo "<td><a data-dismiss='modal' aria-hidden='true' class='btn btn-primary' href='#' onclick='AgendAneste($fila[id_usu])'><i class='icon-book'></i> Reservar</a></td>";
				}
				if ($btn==3) {
					echo "<td><a data-dismiss='modal' aria-hidden='true' class='btn btn-info' href='#' onclick='AgendAyudante($fila[id_usu])'><i class='icon-book'></i> Reservar</a></td>";
				}
				echo"
			</tr>
		";
		}
		
	}
	echo "</table>";
}

public function SaveCitaCirugia($id_pac,$cirj_cir,$antes_cir,$ayudan_cir,$fechaciru_cir,$horacir_cir,$duraccionop_cir,$procedimi_cir,$tiempohosp_cir,$observacion_cir){
	$cicir=new CitaCirugia;
	session_start();
	$loguser=NULL;
	if(isset($_SESSION['ENFERMERA'])) $loguser=$_SESSION['ENFERMERA'];
    elseif(isset($_SESSION['DOCTOR'])) $loguser=$_SESSION['DOCTOR'];

	$today=$this->Mifecha();
	$id_userregs=$cicir->Consultar("SELECT id_usu FROM tbl_usuario WHERE login_usu='$loguser' AND estado_usu='A';");
	$res=$cicir->Ejecutar("INSERT INTO tbl_citacirugia (id_pac,id_userregs,cirj_cir,antes_cir,ayudan_cir,fechaciru_cir,horacir_cir,duraccionop_cir,procedimi_cir,tiempohosp_cir,observacion_cir,estado_cir,fecha) VALUES('$id_pac','$cirj_cir','$id_userregs','$antes_cir','$ayudan_cir','$fechaciru_cir','$horacir_cir','$duraccionop_cir','$procedimi_cir','$tiempohosp_cir','$observacion_cir','P','$today');");	
	
	$cicir->Ejecutar("UPDATE tbl_paciente SET auxmovimiento_pac='TRATAMIENTO' WHERE id_pac='$id_pac';");

	//capturando acciones
		
		$idusu2015=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"INSERT INTO tbl_citacirugia (id_pac,id_userregs,cirj_cir,antes_cir,ayudan_cir,fechaciru_cir,horacir_cir,duraccionop_cir,procedimi_cir,tiempohosp_cir,observacion_cir,estado_cir,fecha) VALUES($id_pac,$cirj_cir,$id_userregs,$antes_cir,$ayudan_cir,$fechaciru_cir,$horacir_cir,$duraccionop_cir,$procedimi_cir,$tiempohosp_cir,$observacion_cir,P,$today);");
		$cicir->Ejecutar($sql2015);
		//capturando acciones

	echo $this->Msm("v", "Se guardaron correctamente los datos de la cita");
}

	public function LoadDataDoc($buscar){
		$user=new Usuario;
		$datos=NULL;
		if ($buscar=="") {
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='1' AND estado_usu='A' LIMIT 100;");
		}elseif($buscar!=""){
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='1' AND estado_usu='A' AND cedula_usu LIKE '$buscar%'  OR nombresCom_usu LIKE '$buscar%' AND id_rol='1' AND  estado_usu='A' LIMIT 100;");
		}

		
		if (count($datos)>0) {
			echo "
			

			<table class='table table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Cédula</th>
						<th>Médico</th>
						<th>Dirección</th>				
						<th>Especialidad</th>
						<th></th>
						<th></th>
					</tr>
			";
				foreach ($datos as $fila) {
					$esp=$user->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$fila[id_esp]'");
					$username =$fila['nombresCom_usu'];
					echo " 
						<tr>
							<td>$fila[cedula_usu]</td>
							<td>$username</td>
							<td>$fila[direccion_usu]</td>
							<td>$esp</td>
							<td><a href='#' class='btn btn-primary' onclick='ModMed($fila[id_usu])'><i class='icon-refresh'></i> Actualizar</a></td>
							<td><a href='#myModal' role='button' class='btn btn-danger' data-toggle='modal' id='bntDiagnosticar' onclick='DeleMed($fila[id_usu])' style='color:white;'><i class='icon-trash'></i> Eliminar<a/></td>
						</tr>
					";
				}
			echo "</table>";
		}else{
			echo "<center><h4>No Hay Medicos En La Base De Datos</h4></center>";
		}
	}
	
	public function FrmModMedico($codigo){
		$user=new Usuario;
		$esp=new Especialidad;
		//$datoses=$esp->Consultar_Especialidad("SELECT * FROM tbl_especialida");
		$datos=$esp->Consultar_Especialidad("SELECT * FROM tbl_especialida;");
		$datosUser=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_usu='$codigo';");
		
		
		echo "<table class='table table-hover table-striped table-condensend table-bordered' style='font-family:Times New Roman, Georgia, Serif; font-size:17px;'>";
		foreach ($datosUser as $fila) {
			$pos=($fila['id_esp'])-1;
			$apellido = $fila['apellidos_usu'];
		    $name = $fila['nombres_usu'];
		    $direccion = $fila['direccion_usu'];
			echo "
				 <tr>
				    <td>Cédula: </td>
				    <td colspan='3'><input type='text' id='txtCedulaMed'  value='$fila[cedula_usu]'  class='span4' /></td>
				  </tr>
				  <tr>
				    <td>Apellidos:</td>
				    <td><input type='text' id='txtApellMed'  value='$apellido' /></td>
				    <td>Nombres:</td>
				    <td><input type='text' id='txtNomMedic' value='$name' /></td>
				    
				  </tr>
				  <tr>
				    <td>Edad:</td>
				    <td><input type='text' id='txtEdadMed' value='$fila[edad_usu]' /></td>
				    <td>Direccion:</td>
				    <td><input type='text' id='txtDirecioMed' value='$direccion' /></td>
				  </tr>
				  <tr>
				    <td>Usuario:</td>
				    <td><input type='text' id='txtUserMed' value='$fila[login_usu]' /></td>
				    <td>Password:</td>
				    <td><input type='text' id='txtPassMed' value='$fila[pass_usu]' /></td>
				  </tr>
				  <tr>
				    <td>Especialidad:</td>
				    <td colspan='3' > <select id='cmb_espLod' class='span4'> <option value=''>--Seleccione--</option> "; 
					foreach($datos as $fila1)
					{
						echo "<option value='$fila1[id_esp]'>$fila1[descripcion_esp]</option>";
					}
					echo " </select> </td> 
				  </tr>
				  <tr>
				  <td>Libro:</td>
				  <td><input type='text' id='txtLibro' value='$fila[libro_usu]' /></td>
				  <td>Folio:</td>
				  <td><input type='text' id='txtFolio' value='$fila[folio_usu]' /></td>
				  </tr>
				  <tr>
				  <td>Número:</td>
				  <td><input type='text' id='txtNumero' value='$fila[num_usu]' /></td>
				  <td>Firma:</td>
				  <td><input type='file' id='filefirm'></td>
				  </tr>
				  <tr>
				    <td colspan='4'><center><a href='#' class='btn btn-primary' onclick='ModOkMed($codigo)'><i class='icon-ok'></i> Guardar</a> <!-- <a href='#' class='btn btn-success' onclick='CloseMeModMed()'><i class='icon-remove'></i> Cancelar</a> --> </center></td>
				  </tr>
		 		<script type='text/javascript'>
							$('#cmb_espLod').prop('selectedIndex','$pos');
				</script>
				 

			";
		}
		echo "</table>

		

		";
	}

	//nuevo historia para cargar todos los archivos referentes a el paciente estos archivos se van a cargar solo en pdf
	public function AllUPLoadFileOFPac($id_pac){
		$pac=new Paciente;

		$laboratorio=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='1';");
		$rx=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='2';");
		$urudinamia=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='3';");
		$ultrasonido=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='4';");
		$tomografias=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='5';");
		$otros=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='6';");
		$aname=$pac->Consultar("SELECT COUNT(*)  FROM  tbl_cduanamnesis WHERE id_pac='$id_pac' AND est_cduanam='F' ;");
		$epircris=$pac->Consultar("SELECT COUNT(*) FROM tbl_epicrisis WHERE id_user='$id_pac' AND estado_epi='F';");
		$anamHosp=$pac->Consultar("SELECT COUNT(*) FROM tbl_anamnesis_hosp WHERE id_pac='$id_pac' AND estado_proceso='F';");

		//Electrocardiograma subido por el medico
		$electrocardi=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='20';");
		

		$PROTOCOLOOPERTATORIO=$pac->Consultar("SELECT COUNT(*) FROM tbl_protocoloperatorio p, tbl_citacirugia c WHERE p.id_cir=c.id_cir AND c.id_pac='$id_pac';");


		$auto=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='7';");

		$HC=$pac->Consultar("SELECT COUNT(*) FROM tbl_file WHERE id_pac='$id_pac' AND ubicacion_fil='8';");

		$solinter=$pac->Consultar("SELECT COUNT(*) FROM tbl_solicitudinterconsulta WHERE id_pac='$id_pac'  AND est_intsoli='F';");

		$infosolinter=$pac->Consultar("SELECT COUNT(*) FROM tbl_informeinterconsulta WHERE id_pac='$id_pac' AND est_intinfo='F';");

		$pacientenom=$pac->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$id_pac';");

		$pacientenom=utf8_encode($pacientenom);

		echo "
			<table class='table table-bordered table-condensend table-hover table-striped'>
				<tr>
					<th colspan='5'>
						<h3><center>Historial de  $pacientenom</center></h3>
					</th>
				</tr>
				<tr>
					<th>Archivos</th>
					<th>Cantidad</th>
					
					<th>Ver</th>
					<th>Ver Lista</th>
				</tr>

				<tr>
					<th>Consulta inicial </th>
					<th>$aname Archivos <i class='icon-file'></i></th>
					<th colspan='2'><center><a href='#' class='btn btn-info' onclick='SeeAllAnamesis($id_pac)'><i class='icon-list'></i> Lista de archivos</a></center></th>
				</tr>


				<tr>
					<th>Epicrisis </th>
					<th>$epircris Archivos <i class='icon-file'></i></th>
					<th colspan='2'><center><a href='#' class='btn btn-info' onclick='SeeAllEpicrisis($id_pac)'><i class='icon-list'></i> Lista de archivos</a></center></th>
				</tr>


				<tr>
					<th>Anamnesis Hospitalización</th>
					<th>$anamHosp Archivos <i class='icon-file'></i></th>
					<th colspan='2'><center><a href='#' class='btn btn-info' onclick='ListFileAnamnHosp($id_pac)'><i class='icon-list'></i> Lista de archivos</a></center></th>
				</tr>

				<tr>
					<th>Solicitud Interconsulta </th>
					<th>$solinter Archivos <i class='icon-file'></i></th>
					<th colspan='2'><center><a href='#' class='btn btn-info' onclick='SeeAllSolicEpi($id_pac)'><i class='icon-list'></i> Lista de archivos</a></center></th>
				</tr>


				<tr>
					<th>Informe Interconsulta </th>
					<th>$infosolinter Archivos <i class='icon-file'></i></th>
					<th colspan='2'><center><a href='#' class='btn btn-info' onclick='SeeAllInfoSolic($id_pac)'><i class='icon-list'></i> Lista de archivos</a></center></th>
				</tr>

				<tr>
					<th>PROTOCOLO OPERTATORIO </th>
					<th>$PROTOCOLOOPERTATORIO Archivos <i class='icon-file'></i></th>
					<th colspan='2'><center><a href='#' class='btn btn-info' onclick='SeeAllInfoProtocoloOPeratorio($id_pac)'><i class='icon-list'></i> Lista de archivos</a></center></th>
				</tr>


                
				<tr>
					<th>Laboratorios </th>
					<th>$laboratorio Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,1)'><i class='icon-list'></i> Ver</a></th>





					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,1)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Rx</th>
					<th>$rx Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,2)'><i class='icon-list'></i> Ver</a></th>




					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,2)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Urudinamia</th>
					<th>$urudinamia Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button'  class='btn btn-info' onclick='SeeAllFile($id_pac,3)'><i class='icon-list'></i> Ver</a></th>



					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,3)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Ultrasonido</th>
					<th>$ultrasonido Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,4)'><i class='icon-list'></i> Ver</a></th>


					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,4)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Tomografia</th>
					<th>$tomografias Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,5)'><i class='icon-list'></i> Ver</a></th>

					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,5)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr> 
                
                
                <th>Cardiologia</th>
					<th>$otros Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,6)'><i class='icon-list'></i> Ver</a></th>
					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,6)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr>  

				<th>Autorizacion</th>
					<th>$auto Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,7)'><i class='icon-list'></i> Ver</a></th>
					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,7)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr>


				<th>Historia antigua</th>
					<th>$HC Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,8)'><i class='icon-list'></i> Ver</a></th>
					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,8)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr>


				<th>Electrocardiograma</th>
					<th>$electrocardi Archivos <i class='icon-file'></i></th>
					
					<th><a href='#' role='button' class='btn btn-info' onclick='SeeAllFile($id_pac,20)'><i class='icon-list'></i> Ver</a></th>
					<th><a href='#' role='button' class='btn btn-primary' onclick='SeeList($id_pac,20)'><i class='icon-th-list'></i> Lista de archivos</a></th>
				</tr>

			</table>
		";

	}
	public function AllAnamesis($code){
		$ana=new AnamnesisCdu;
		$datos=$ana->Consultar_AnamnesisCdu("SELECT *  FROM  tbl_cduanamnesis WHERE id_pac='$code' AND est_cduanam='F' ORDER BY fechasa_cduanm DESC ;");
		if(count($datos)>0){
			echo "<table class='table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Fecha de realizacion de la anamnesis</th>
						<th></th>

					</tr>
			";
			foreach ($datos as $fila) {
				echo "
					<tr>
						<td>$fila[fechasa_cduanm]</td>
						<td><a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='VerAnamnesis($fila[id_cduanam])'><i class='icon-eye-open'></i> Ver</a></td>
					</tr>
				";
			}
			echo "</table>";
		}else{
			echo "<center><h4>El paciente no tiene datos de anamnesis</h4></center>";
		}
	}


	public function AllEpicrisis($code){
		$ana=new Epicrisis;
		$datos=$ana->Consultar_Epicrisis("SELECT * FROM tbl_epicrisis WHERE id_user='$code' AND estado_epi='F' ORDER BY fechaat_epi DESC;");
		if(count($datos)>0){
			echo "<table class='table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Fecha de realizacion de la epicrisis</th>
						<th></th>

					</tr>
			";
			foreach ($datos as $fila) {
				echo "
					<tr>
						<td>$fila[fechaat_epi]</td>
						<td><a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='ImpEpicrisis2($fila[id_epi],$code)'><i class='icon-eye-open'></i> Ver</a></td>
					</tr>
				";
			}
			echo "</table>";
		}else{
			echo "<center><h4>El paciente no tiene datos de epircris</h4></center>";
		}
	}
	
	//fin nuevo historia para cargar todos los archivos referentes a el paciente estos archivos se van a cargar solo en pdf

	//ver agenda cirugias para el administrador
	public function getUltimoDiaMes($elAnio,$elMes)
	{
	  	return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
	}


	public function AgendaCirugiaPorMes2($a,$m){
		$citc=new CitaCirugia;

		$year=$a;
		$month=$m;
		
		$finFech=$year."-".$month."-".$this->getUltimoDiaMes($year,$month);
		

		$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');

		$mes = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

		$fin=$this->getUltimoDiaMes($year,$month);
		
		

		for($x=1;$x<=$fin;$x++){
			 
			$dia=$dias[date('N', strtotime($year."-".$month."-".$x))-1];
			$me=$mes[date('n', strtotime($year."-".$month."-".$x))-1];
			$date=$year."-".$month."-".$x;
			$obtdata=$citc->Consultar_CitaCirugia("SELECT * FROM tbl_citacirugia WHERE fechaciru_cir='$date' ORDER BY horacir_cir ASC;");
			

			if(count($obtdata)>0){
				echo "
					<div class='Dia'>
					<div class='TextD'>$dia $x de $me</div>
					<div class='DiaCont'>
				";
				foreach ($obtdata as $fila) {
					$medico=$citc->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila[id_userregs]';");
					$hor=$citc->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$fila[horacir_cir]';");
					$pac=$citc->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]'");
					$pac=utf8_encode($pac);
					switch ($fila['estado_cir']) {
						case 'P':
							echo "<div class='infocirugia'>
									<a  href='#myModal' role='button' data-toggle='modal' class='btn  btn-primary' onclick='RedactarDatos($fila[id_cir])' >
										$pac </br><div class='pindoct'>$medico</div> $hor
										<div id='' style='color:#FFFF00;'>$fila[procedimi_cir]</div>
									</a>
						  		 </div>";
							break;
						case 'C':
							echo "<div class='infocirugia'>
									<a href='#myModal' role='button' data-toggle='modal'  class='btn  btn-success' onclick='RedactarDatos($fila[id_cir])' >
										$pac </br><div class='pindoct'> $medico</div> $hor
										<div id='' style='color:#FFFF00;'>$fila[procedimi_cir]</div>
									</a>
						  		 </div>";
							break;
						case 'K':
							echo "<div class='infocirugia'>
									<a href='#myModal' role='button' data-toggle='modal'  class='btn  btn-danger' onclick='RedactarDatos($fila[id_cir])' >
										$pac </br><div class='pindoct'>$medico</div> $hor
										<div id='' style='color:#FFFF00;'>$fila[procedimi_cir]</div>
									</a>
						  		</div>";
							break;
					}
				}
				echo "
					</div>
					</div>
				";
			}else{
			echo "

				<div class='Dia'>

					<div class='TextD'>$dia $x de $me</div>

					<div class='DiaCont'>
						<center><h3>Dia Vacio</h3></center>
					</div>
				  </div>

			";
			}
		}
	}

	public function AgendaCirugiaPorMes($a,$m){
		$citc=new CitaCirugia;

		$year=$a;
		$month=$m;
		
		$finFech=$year."-".$month."-".$this->getUltimoDiaMes($year,$month);
		

		$dias = array('Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo');

		$mes = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');

		$fin=$this->getUltimoDiaMes($year,$month);
		
		

		for($x=1;$x<=$fin;$x++){
			 
			$dia=$dias[date('N', strtotime($year."-".$month."-".$x))-1];
			$me=$mes[date('n', strtotime($year."-".$month."-".$x))-1];
			$date=$year."-".$month."-".$x;
			$obtdata=$citc->Consultar_CitaCirugia("SELECT * FROM tbl_citacirugia WHERE fechaciru_cir='$date' ORDER BY horacir_cir ASC;;");
			if(count($obtdata)>0){
				echo "
					<div class='Dia'>
					<div class='TextD'>$dia $x de $me</div>
					<div class='DiaCont'>
				";
				foreach ($obtdata as $fila) {
					$medico=$citc->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila[id_userregs]';");
					$hor=$citc->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$fila[horacir_cir]';");
					$pac=$citc->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]'");
					$pac=utf8_encode($pac);
					switch ($fila['estado_cir']) {
						case 'P':
							echo "<div class='infocirugia'>
									<a class='btn  btn-primary' onclick='RecarDatos($fila[id_cir])'>$pac </br><div class='pindoct'> $medico</div> $hor<div id='' style='color:#FFFF00;'>$fila[procedimi_cir]</div></a>
						  		 </div>";
							break;
						case 'C':
							echo "<div class='infocirugia'>
									<a class='btn  btn-success' onclick='RecarDatos($fila[id_cir])'>$pac </br><div class='pindoct'> $medico</div> $hor<div id='' style='color:#FFFF00;'>$fila[procedimi_cir]</div></a>
						  		 </div>";
							break;
						case 'K':
							echo "<div class='infocirugia'>
									<a class='btn  btn-danger' onclick='RecarDatos($fila[id_cir])'>$pac </br><div class='pindoct'> $medico</div> $hor<div id='' style='color:#FFFF00;'>$fila[procedimi_cir]</div></a>
						  		</div>";
							break;
					}
				}
				echo "
					</div>
					</div>
				";
			}else{
			echo "

				<div class='Dia'>

					<div class='TextD'>$dia $x de $me</div>

					<div class='DiaCont'>
						<center><h3>Dia Vacio</h3></center>
					</div>
				  </div>

			";
			}
		}
	}
	
	public function LoadCitaSelecionada($code){
		$cit=new CitaCirugia;
		$pac=new Paciente;
		$ti=new Hora;
		$codigo=$pac->Consultar("SELECT id_pac FROM tbl_citacirugia WHERE id_cir='$code';");
		$nombre=$pac->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codigo';");
		$nombre=utf8_encode($nombre);
		$fecha_de_nacimiento=$pac->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo';");
		$edadpaciend=$this->Edad($fecha_de_nacimiento);
		$datos=$ti->Consultar_Hora("SELECT * FROM tbl_hora;");

		$fechaCir=$cit->Consultar("SELECT fechaciru_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$pos=$cit->Consultar("SELECT horacir_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$deshora=$cit->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$pos';");
		$durop=$cit->Consultar("SELECT duraccionop_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$ciru=$cit->Consultar("SELECT id_userregs FROM tbl_citacirugia WHERE id_cir='$code';");
		$cirujano=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ciru';");
		$ant=$cit->Consultar("SELECT antes_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$antestesiologo=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ant';");
		$ayu=$cit->Consultar("SELECT ayudan_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$ayudante=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ayu';");
		$procedimie=$cit->Consultar("SELECT procedimi_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$tiemh=$cit->Consultar("SELECT tiempohosp_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$obser=$cit->Consultar("SELECT observacion_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$est=$cit->Consultar("SELECT estado_cir FROM tbl_citacirugia WHERE id_cir='$code';");
	echo "
	<div class='table-responsive'>
		<table class='table table-bordered table-hover table-condensend table-striped'>
			<tr>
				<td>
					<select id='cmbEstado'>
						<option value=''>--Seleccione--</option>
						<option value='1'>Provicional</option>
						<option value='2'>Confirmado</option>
						<option value='3'>Cancelado</option>
					</select>
					<a class='btn btn-success' onclick='UpdateCitaEmergenci($code)' ><i class='icon-file'></i>Guardar</a>

					<a href='#myModal' role='button' class='btn btn-primary' data-toggle='modal' id='bntPrintCitaEm' onclick='ImpCitaEmergenci($code)' style='color:white;'><i class='icon-print'></i>Imprimir<a/>

					<a class='btn btn-warning' onclick='ModCitaEmerge($code)' ><i class='icon-pencil'></i>Modificar</a>

					<a class='btn btn-info' onclick='LoadAgendaCirugia()' ><i class='icon-file'></i>Regresar a agenda</a>

				</td>
			</tr
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
		</script>

		<table class='table table-bordered table-hover table-condensend table-striped'>
			<tr>
				<th>Paciente :</th>
				<td>$nombre</td>
				<th>Edad :</th>
				<td>$edadpaciend</td>
			</tr>
			<tr>
				<th>Fecha De Cirugia:</th>
				<td><input type='date' id='txtfecprocir' readonly value='$fechaCir'/></td>
				<th>Hora:</th>
				<td><input type='text' id='' value='$deshora' class='span12' readonly><!--<select id='cmb_horacir' readonly><option>--Seleccione un hora--</option>-->
				";
				/*foreach ($datos as $fila) {
					echo "<option value='$fila[id_hor]'>$fila[hora_hor]</option>";
				}*/
			echo "
				<!--</select>-->
				</td>
			</tr>
			<tr>
				<th>Duraccion operacion:</th>
				<td colspan='3'><div class='input-append'><input type='text' id='txtduropera' value='$durop' class='span11' readonly /><a class='btn' ><i class='icon-time'></i>Horas</a></div></td>
			</tr>
			<tr>
				<th>Cirujano:</th>
				<td colspan='3'><input type='text' id='txtCirujano' class='txtcirugia' value='$cirujano' readonly /></td>
			</tr>
			<tr>
				<th>Anestesiologo:</th>
				<td colspan='3'><input type='text' id='txtanestesiologo'  value='$antestesiologo' readonly class='txtcirugia' />  </td>
			</tr>
			<tr>
				<th>Ayudante:</th>
				<td colspan='3'><input type='text' id='txtayudante'  value='$ayudante' readonly class='txtcirugia'/></td>
			</tr>
			<tr>
				<th>Procedimiento:</th>
				<td colspan='3'><textarea id='txtprocedicirug' cols='200' rows='2' class='txtcirugia2' readonly>$procedimie</textarea></td>
			</tr>
			<tr>
				<th>Tiempo de hospitalizacion:</th>
				<td colspan='3'><input type='text' id='txttiempohospital' value='$tiemh' readonly class='span2'/></td>
			</tr>
			<tr>
				<th>Observaciones:</th>
				<td colspan='3'><textarea id='txtobservaciones' cols='200' rows='2' readonly class='txtcirugia2'>$obser</textarea></td>
			</tr>
			
		</table>
		</div>

		<script type='text/javascript'>
			$('#cmb_horacir').prop('selectedIndex','$pos');
		</script>
	";
	}


public function LoadCitaSelecionada2($code){
		$cit=new CitaCirugia;
		$pac=new Paciente;
		$ti=new Hora;


		

		$codigo=$pac->Consultar("SELECT id_pac FROM tbl_citacirugia WHERE id_cir='$code';");
		$nombre=$pac->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$codigo';");
		$nombre=utf8_encode($nombre);
		$fecha_de_nacimiento=$pac->Consultar("SELECT fechaN_pac FROM tbl_paciente WHERE id_pac='$codigo';");
		$edadpaciend=$this->Edad($fecha_de_nacimiento);
		$datos=$ti->Consultar_Hora("SELECT * FROM tbl_hora;");

		$fechaCir=$cit->Consultar("SELECT fechaciru_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$pos=$cit->Consultar("SELECT horacir_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$deshora=$cit->Consultar("SELECT hora_hor FROM tbl_hora WHERE id_hor='$pos';");
		$durop=$cit->Consultar("SELECT duraccionop_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$ciru=$cit->Consultar("SELECT id_userregs FROM tbl_citacirugia WHERE id_cir='$code';");
		$cirujano=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ciru';");
		$ant=$cit->Consultar("SELECT antes_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$antestesiologo=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ant';");
		$ayu=$cit->Consultar("SELECT ayudan_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$ayudante=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$ayu';");
		$procedimie=$cit->Consultar("SELECT procedimi_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$tiemh=$cit->Consultar("SELECT tiempohosp_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$obser=$cit->Consultar("SELECT observacion_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$est=$cit->Consultar("SELECT estado_cir FROM tbl_citacirugia WHERE id_cir='$code';");


		$fechadeagenda=$cit->Consultar("SELECT fecha FROM tbl_citacirugia WHERE id_cir='$code';");





		$enfer=$cit->Consultar("SELECT cirj_cir FROM tbl_citacirugia WHERE id_cir='$code';");
		$enfermera=$cit->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$enfer';");
	echo "

		<div class='table-responsive'><table class='table table-bordered table-hover table-condensend table-striped'>
			<tr>
				<td>
					<center><a href='#myModal2' role='button' class='btn btn-primary' data-toggle='modal' id='bntPrintCitaEm' onclick='ImpCitaEmergenci($code)' style='color:white;'><i class='icon-print'></i>Imprimir<a/></center>
				</td>
			</tr>
		</table></div>


		<div class='table-responsive'><table class='table table-bordered table-hover table-condensend table-striped'>
			<tr>
				<th>Quien agenda: </th>
				<td>$enfermera</td>
				<th>Fecha de agenda:</th>
				<td>$fechadeagenda</td>
			</tr>

			<tr>
				<th>Paciente :</th>
				<td>$nombre</td>
				<th>Edad :</th>
				<td>$edadpaciend</td>
			</tr>
			<tr>
				<th>Fecha De Cirugia:</th>
				<td><input type='date' id='txtfecprocir' readonly value='$fechaCir'/></td>
				<th>Hora:</th>
				<td><input type='text' id='' value='$deshora' class='span2' readonly><!--<select id='cmb_horacir' readonly><option>--Seleccione un hora--</option>-->
				";
				/*foreach ($datos as $fila) {
					echo "<option value='$fila[id_hor]'>$fila[hora_hor]</option>";
				}*/
			echo "
				<!--</select>-->
				</td>
			</tr>
			<tr>
				<th>Duraccion operacion:</th>
				<td colspan='3'><div class='input-append'><input type='text' id='txtduropera' value='$durop' class='span1' readonly /><a class='btn' ><i class='icon-time'></i>Horas</a></div></td>
			</tr>
			<tr>
				<th>Cirujano:</th>
				<td colspan='3'><input type='text' id='txtCirujano' class='txtcirugia' value='$cirujano' readonly onclick='SearCirujano()'/></td>
			</tr>
			<tr>
				<th>Anestesiologo:</th>
				<td colspan='3'><input type='text' id='txtanestesiologo' onclick='SearchAnestesiologo();' value='$antestesiologo' readonly class='txtcirugia'/></td>
			</tr>
			<tr>
				<th>Ayudante:</th>
				<td colspan='3'><input type='text' id='txtayudante' onclick='SearchAyudante()' value='$ayudante' readonly class='txtcirugia'/></td>
			</tr>
			<tr>
				<th>Procedimiento:</th>
				<td colspan='3'><textarea id='txtprocedicirug' cols='20' class='span10' rows='2' class='txtcirugia2' readonly>$procedimie</textarea></td>
			</tr>
			<tr>
				<th>Tiempo de hospitalizacion:</th>
				<td colspan='3'><input type='text' id='txttiempohospital' value='$tiemh' readonly class='span2'/></td>
			</tr>
			<tr>
				<th>Observaciones:</th>
				<td colspan='3'><textarea id='txtobservaciones' cols='20' class='span10' rows='2' readonly class='txtcirugia2'>$obser</textarea></td>
			</tr>
			
		</table></div>

		<script type='text/javascript'>
			$('#cmb_horacir').prop('selectedIndex','$pos');
		</script>
	";
	}

	public function UpdateEstadoCitaCirug($code,$estado){
		$cit=new CitaCirugia;
		$msg=NULL;
		switch ($estado) {
				case 'P':
					$msg="Provicionado";
					break;
				
				case 'C':
					$msg="Confirmado";
					break;

				case 'K':
					$msg="Cancelado";
					break;
		}
		$cit->Consultar("UPDATE tbl_citacirugia SET estado_cir='$estado' WHERE id_cir='$code';");
		//capturando acciones
		session_start();
		$idusu2015=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu2015,$this->Mifecha(),$this->MiHora(),"UPDATE tbl_citacirugia SET estado_cir=$estado WHERE id_cir=$code;");
		$cit->Ejecutar($sql2015);
		//capturando acciones

		echo $this->Msm("v", "La cita se ha $msg");
	}
	//fin ver agenda cirugias para el administrador
	
	// --------------------------------------- modulo adm 1 ---------------------------------------------//
	
	//modal new medic
	public function ModalNewMedic()
	{
		$med=new Usuario;
		$esp=new Especialidad;
		$datos=$esp->Consultar_Especialidad("SELECT * FROM tbl_especialida;");
		echo "<table class='table table-hover table-striped table-condensend table-bordered'> 
		<tr> 
		<td>Cédula: </td> 
		<td colspan='3'><input type='text' id='txtCedulaMedNew'  class='span4' onkeyup='VerificarCIMed()' /></td> 
		</tr> 
		<tr> 
		<td>Apellidos:</td> 
		<td><input type='text' id='txtApellMedNew' /></td> 
		<td>Nombres:</td> 
		<td><input type='text' id='txtNomMedicNew' /></td> 
		</tr> 
		<tr> 
		<td>Edad:</td> 
		<td><input type='text' id='txtEdadMedNew' /></td> 
		<td>Direccion:</td> 
		<td><input type='text' id='txtDirecioMedNew' /></td> 
		</tr> 
		<tr> 
		<td>Usuario:</td> 
		<td><input type='text' id='txtUserMedNew' /></td> 
		<td>Password:</td> 
		<td><input type='text' id='txtPassMedNew' /></td> 
		</tr> 
		<tr> 
		<td>Especialidad:</td> 
		<td colspan='3' > <select id='cmb_espLodNew' class='span4'> <option value=''>--Seleccione--</option> "; 
		foreach($datos as $fila)
		{
			echo "<option value='$fila[id_esp]'>$fila[descripcion_esp]</option>";
		}
		echo " </select> </td> 
		</tr> 
		<tr> 
		<td>Libro:</td> 
		<td><input type='text' id='txtLibroNew' /></td> 
		<td>Folio:</td> 
		<td><input type='text' id='txtFolioNew' /></td> 
		</tr> 
		<tr> 
		<td>Número:</td> 
		<td><input type='text' id='txtNumeroNew' /></td>
		<td>Firma:</td>
		<td><input type='file' id='fileimgfirmNew'></td> 
		</tr> 
		<tr> 
		<td colspan='4'><center><a href='#' class='btn btn-primary' id='bntSaveMed1' onclick='SaveNewOkMed()' style='font-family:Times New Roman, Georgia, Serif; font-size:15px;'><i class='icon-ok'></i> Guardar</a> <!-- <a href='#' class='btn btn-success' onclick='CloseNewMed()' style='font-family:Times New Roman, Georgia, Serif; font-size:15px;'><i class='icon-remove'></i> Cancelar</a> --></center></td> 
		</tr> 
		</table> ";
	}
	//fin modal new medic
	
	//save new medico
	public function SaveNewMedicos($ced,$apellidos,$nombres,$edad,$usu,$pass,$direccion,$especialidad,$libro,$folio,$num)
	{
		$med=new Usuario;
		$nomcomp=$apellidos." ".$nombres;
		$nomcomp=strtoupper($nomcomp);
		//if($med->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE cedula_usu='$ced'")==0)
		//{
			if($med->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE login_usu='$usu'")==0)
			{
				if(isset($_SERVER['HTTP_X_FILE_NAME']))
				{
					$aux3=$_SERVER['HTTP_X_FILE_NAME'];
					$aux=$med->Ejecutar("INSERT INTO tbl_usuario (cedula_usu,apellidos_usu,nombres_usu,nombresCom_usu,edad_usu,login_usu,pass_usu,direccion_usu,estado_usu,id_rol,id_esp,libro_usu,folio_usu,num_usu,img_usu) VALUES ('$ced','$apellidos','$nombres','$nomcomp','$edad','$usu','$pass','$direccion','A','1','$especialidad','$libro','$folio','$num','$aux3')");
					echo $this->Msm("v", "El médico se ha guardado correctamente");
					
					$nummed=$med->Consultar("SELECT MAX(id_usu) FROM tbl_usuario");
					if(!mkdir("../ME/$nummed",0777,true))
					{
						echo $this->Msm("r", "Fallo la creacion de la carpeta ME");
					}
					if(!mkdir("../ME/$nummed/F",0777,true))
					{
						echo $this->Msm("r", "La carpeta F no se ha creado");
					}
					file_put_contents("../ME/$nummed/F/".$_SERVER['HTTP_X_FILE_NAME'],
					file_get_contents('php://input'));
					$url="../ME/$nummed/F/$aux3";
					$upusu=$med->Ejecutar("UPDATE tbl_usuario SET url_usu='$url' WHERE id_usu='$nummed'");
					
				}
				else
				{
					$aux=$med->Ejecutar("INSERT INTO tbl_usuario (cedula_usu,apellidos_usu,nombres_usu,nombresCom_usu,edad_usu,login_usu,pass_usu,direccion_usu,estado_usu,id_rol,id_esp,libro_usu,folio_usu,num_usu) VALUES ('$ced','$apellidos','$nombres','$nomcomp','$edad','$usu','$pass','$direccion','A','1','$especialidad','$libro','$folio','$num')");
					echo $this->Msm("v", "El médico se ha guardado correctamente");
					
					$nummed=$med->Consultar("SELECT MAX(id_usu) FROM tbl_usuario");
					if(!mkdir("../ME/$nummed",0777,true))
					{
						echo $this->Msm("r", "Fallo la creacion de la carpeta ME");
					}
					if(!mkdir("../ME/$nummed/F",0777,true))
					{
						echo $this->Msm("r", "La carpeta F no se ha creado");
					}
					}
					//echo "../ME/$nummed";
					
			}
			else
			{
				echo $this->Msm("t", "Ya existe un médico con este mismo usuario");	
			}
			
			
		
		//}
		//else
		//{
		//	echo "<h3><center>Ya existe un médico con esta cédula</center></h3>";
		//}
		
	}
	//fin save new medico
	
	///modificar usuario
	public function ModifyUser($ced,$apellidos,$nombres,$edad,$usu,$pass,$direccion,$especialidad,$libro,$folio,$num,$cod)
	{
		$user=new Usuario;
		$esp=new Especialidad;
		$nomco=$apellidos." ".$nombres;
		$nomco=strtoupper($nomco); 

		$nombre_fichero="../ME/$cod/F";
		if (file_exists($nombre_fichero)) {
		   
		} else {
		    		if(!mkdir("../ME/$cod",0777,true))
					{
						echo $this->Msm("r", "No se pudo crear la carpeta ME");
					}
					if(!mkdir("../ME/$cod/F",0777,true))
					{
						echo $this->Msm("r", "La carpeta F no se ha creado");
					}
		}

		
					

				$modu=$user->Consultar("SELECT url_usu FROM tbl_usuario WHERE id_usu='$cod'");
					if(isset($_SERVER['HTTP_X_FILE_NAME']))
					{
						$img=$_SERVER['HTTP_X_FILE_NAME'];
						$url="../ME/$cod/F/$img";
						if($modu!=""){if(unlink($modu));}
						$upu=$user->Ejecutar("UPDATE tbl_usuario SET cedula_usu='$ced', apellidos_usu='$apellidos', nombres_usu='$nombres', nombresCom_usu='$nomco', edad_usu='$edad', login_usu='$usu', pass_usu='$pass', direccion_usu='$direccion', estado_usu='A', id_esp='$especialidad', libro_usu='$libro', folio_usu='$folio', num_usu='$num', img_usu='$img', url_usu='$url' WHERE id_usu='$cod';");
						
						file_put_contents("../ME/$cod/F/".$_SERVER['HTTP_X_FILE_NAME'],
						file_get_contents('php://input'));
						
						echo $this->Msm("v", "El médico se ha modificado correctamente");
						//echo $this->LoadDataDoc($cod);
						
				
		
						
				
					}
					else
					{
						$upu=$user->Ejecutar("UPDATE tbl_usuario SET cedula_usu='$ced', apellidos_usu='$apellidos', nombres_usu='$nombres', nombresCom_usu='$nomco', edad_usu='$edad', login_usu='$usu', pass_usu='$pass', direccion_usu='$direccion', estado_usu='A', id_esp='$especialidad', libro_usu='$libro', folio_usu='$folio', num_usu='$num' WHERE id_usu='$cod';");
						
						echo $this->Msm("v", "El médico se ha modificado correctamente");
						
						
						//echo $this->LoadDataDoc($cod);
					
					}

		//capturando acciones
		session_start();
		$idusu=$_SESSION['IDUser'];
		$sql2015=LOGCasat($idusu,$this->Mifecha(),$this->MiHora(),"UPDATE tbl_usuario SET cedula_usu");
		$user->Ejecutar($sql2015);
		//capturando acciones
					
				
		
	}
	//fin modificar usuario
	
	/*eliminar user
	public function DelUserMed($cod)
	{
		$user=new Usuario;
		$aux=$user->Ejecutar("DELETE FROM tbl_usuario WHERE id_usu='$cod'");
		echo "<h3><center>El médico ha sido eliminado correctamente</center></h3>";
	}
	//fin eliminar user */
	
	//delete user medico
	public function DeleteUser($codigo)
	{
		$user=new Usuario;
		//$user->Ejecutar("UPDATE tbl_usuario SET estado_usu='E', cedula_usu='' WHERE id_usu='$codigo'");
		$user->Ejecutar("DELETE FROM tbl_usuario WHERE id_usu='$codigo'");
		echo $this->Msm("r", "Se ha eliminado correctamente el usuario");
	}
	//fin delete user medico


	/*
	 *
	 *	logica para poder realizar los documentacion facturacion
	 *
	*/

	public function DocumentosFinalizados(){
		$ana=new AnamnesisCdu;
		$epi=new Epicrisis;
		$ex=new Expediente;
		$sol=new Solicitud;
		$inf=new Informe;

		$datosana=$ana->Consultar_AnamnesisCdu("SELECT * FROM tbl_cduanamnesis WHERE est_cduanam='F' ORDER BY fechasa_cduanm DESC;");
		$da=$epi->Consultar_Epicrisis("SELECT * FROM tbl_epicrisis WHERE estado_epi='F' ORDER BY fechaat_epi DESC");
		echo "
			<table class='table table-hover table-condensend table-striped table-bordered'>
			<tr>
				<th colspan='5'><center><h1>Anamnesis Finalizadas</h1></center></th>
			</tr>
			<tr>
				<th>Fecha</th>
				<th>Paciente</th>
				<th>Medico</th>
				<th></th>
				<th></th>
			</tr>
		";
		foreach($datosana as $fila){

			$pac=$ana->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_pac]';");
			$pac=utf8_encode($pac);
			$medico=$ana->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$fila[id_med]';");
			echo "
				<tr>
					<td>$fila[fechasa_cduanm]</td>
					<td>$pac</td>
					<td>$medico</td>
					<td><input type='button' class='btn btn-success' onclick='ImpAnam($fila[id_cduanam])' value='Imprimir'/></td>
					<td><input type='button' class='btn btn-primary' onclick='FacturaAnam($fila[id_cduanam])' value='Facturar'/></td>
				</tr>
			";
		}
		echo "
			</table></br></br>
		";

		

		echo "
			<table class='table table-hover table-condensend table-striped table-bordered'>
			<tr>
				<th colspan='5'><center><h1>Epicrisis Finalizadas</h1></center></th>
			</tr>
			<tr>
				<th>Fecha</th>
				<th>Paciente</th>
				<th>Medico</th>
				<th></th>
				<th></th>
			</tr>
		";
		foreach ($da as $fila) {
			$pa1=$epi->Consultar("SELECT nombresCom_pac FROM tbl_paciente WHERE id_pac='$fila[id_user]';");
			$id=$epi->Consultar("SELECT id_med FROM tbl_epicrisis WHERE id_epi='$fila[id_epi]';");
			$med1=$epi->Consultar("SELECT nombresCom_usu FROM tbl_usuario WHERE id_usu='$id';");
			echo "

				<tr>
					<td>$fila[fechaat_epi]</td>
					<td>$pa1</td>
					<td>$med1  </td>
					<td><input type='button' class='btn btn-success' onclick='ImpEpicris($fila[id_epi])' value='Imprimir'/></td>
					<td><input type='button' class='btn btn-primary' onclick='FacturaAnam($fila[id_epi])' value='Facturar'/></td>
				</tr>
			";
		}
		echo "</table></br></br>";


		echo "
			<table class='table table-hover table-condensend table-striped table-bordered'>
			<tr>
				<th colspan='5'><center><h1>Epicrisis Finalizadas</h1></center></th>
			</tr>
			<tr>
				<th>Fecha</th>
				<th>Paciente</th>
				<th>Medico</th>
				<th></th>
				<th></th>
			</tr>
		";

		


	}

	/*
	 *
	 *	fin logica para poder realizar los documentacion facturacion
	 *
	*/


	/*
	*
	* logica para administradores nuevo menu
	*/
	public function AllAdms($buscar){
		$user=new Usuario;

		$datos=NULL;
		if ($buscar=="") {
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='3' AND estado_usu='A' AND id_esp!='5'  LIMIT 100;");
		}elseif($buscar!=""){
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='3' AND estado_usu='A' AND id_esp!='5' AND cedula_usu LIKE '$buscar%' AND id_rol='3' AND estado_usu='A' OR nombresCom_usu LIKE '$buscar%' AND id_rol='3' LIMIT 100;");
		}
		
		if (count($datos)>0) {
			echo "
			

			<table class='table table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Cedula</th>
						<th>Administrador</th>
						<th>Direccion</th>				
						<th>Permiso</th>
						<th></th>
						<th></th>
					</tr>
			";
				foreach ($datos as $fila) {
					$esp=$user->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$fila[id_esp]'");
					echo " 
						<tr>
							<td>$fila[cedula_usu]</td>
							<td>$fila[nombresCom_usu]</td>
							<td>$fila[direccion_usu]</td>
							<td>$esp</td>
							<td><a href='#' class='btn btn-primary' onclick='ModAdm($fila[id_usu])'><i class='icon-refresh'></i> Actualizar</a></td>
							<td><a href='#myModal' role='button' data-toggle='modal'class='btn btn-danger' onclick='DeleAdm($fila[id_usu])'><i class='icon-trash'></i> Eliminar</a></td>
						</tr>
					";
				}
			echo "</table>";
		}else{
			echo "<center><h4>No Hay Administradores En La Base De Datos</h4></center>";
		}

	}
	public function LoadDataAdm($code){
		$med=new Usuario;

	
		$cedua=$med->Consultar("SELECT cedula_usu FROM tbl_usuario WHERE id_usu='$code';");
		$apellidos=$med->Consultar("SELECT apellidos_usu FROM tbl_usuario WHERE id_usu='$code';");
		$nombres=$med->Consultar("SELECT nombres_usu FROM tbl_usuario WHERE id_usu='$code';");
		$edad=$med->Consultar("SELECT edad_usu FROM tbl_usuario WHERE id_usu='$code';");
		$direccion=$med->Consultar("SELECT direccion_usu FROM tbl_usuario WHERE id_usu='$code';");
		$Usuario=$med->Consultar("SELECT login_usu FROM tbl_usuario WHERE id_usu='$code';");
		$pass=$med->Consultar("SELECT pass_usu FROM tbl_usuario WHERE id_usu='$code';");
		$espe=$med->Consultar("SELECT id_esp FROM tbl_usuario WHERE id_usu='$code';");
		$pos=NULL;
		switch ($espe) {
			case '17':
					$pos=1;
				break;
			
			case '18':
				$pos=2;
				break;
		}
		echo "

		<table class='table table-hover table-striped table-condensend table-bordered'> 
		<tr> 
		<td>Cedula: </td> 
		<td colspan='3'><input type='text' id='txtCedulaMedadm' value='$cedua'  class='span4' /></td> 
		</tr> 
		<tr> 
		<td>Apellidos:</td> 
		<td><input type='text' id='txtApellMedadm' value='$apellidos' /></td> 
		<td>Nombres:</td> 
		<td><input type='text' id='txtNomMedicadm' value='$nombres' /></td> 
		</tr> 
		<tr> 
		<td>Edad:</td> 
		<td><input type='text' id='txtEdadMedadm' value='$edad' /></td> 
		<td>Direccion:</td> 
		<td><input type='text' id='txtDirecioMedadm' value='$direccion' /></td> 
		</tr> 
		<tr> 
		<td>Usuario:</td> 
		<td><input type='text' id='txtUserMedadm' value='$Usuario' /></td> 
		<td>Password:</td> 
		<td><input type='text' id='txtPassMedadm' value='$pass' /></td> 
		</tr> 
		<tr> 
		<td>Permiso:</td> 
		<td colspan='3' > 
		<select id='cmb_espLodadm2' class='span4'> <option value=''>--Seleccione--</option> 
			<option value='17'>Administrador</option>
			<option value='18'>Administrador cirujia</option>
		 </select> 
		</tr> 
		<tr> 
		<td colspan='4'><center><a href='#' class='btn btn-primary' onclick='SaveNewOkADm($code)'><i class='icon-ok'></i> Guardar</a>  <a href='#' class='btn btn-success' onclick='CloseNewADm()'><i class='icon-remove'></i> Cancelar</a></center></td> 
		</tr> 
		</table>
		</td> <script type='text/javascript'>
				$('#cmb_espLodadm2').prop('selectedIndex',$pos);
		</script>
		 ";
	}
	public function UpdateAdministrador($ced,$apellidos,$nombres,$edad,$usu,$pass,$direccion,$especialidad,$cod){
		$user=new Usuario;
		$nomco=$apellidos." ".$nombres;
		$nomco=strtoupper($nomco);
		$upu=$user->Ejecutar("UPDATE tbl_usuario SET cedula_usu='$ced', apellidos_usu='$apellidos', nombres_usu='$nombres', nombresCom_usu='$nomco', edad_usu='$edad', login_usu='$usu', pass_usu='$pass', direccion_usu='$direccion', estado_usu='A', id_esp='$especialidad' WHERE id_usu='$cod';");
		echo "<center><h3>Se guardo correctamente los cambios</h3></center>";
	}

	public function SaveNewADm($ced,$apellidos,$nombres,$edad,$usu,$pass,$direccion,$especialidad)
	{
		$med=new Usuario;
		$nomcomp=$apellidos." ".$nombres;
		$nomcomp=strtoupper($nomcomp);
		if($med->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE cedula_usu='$ced'")==0)
		{
			if($med->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE login_usu='$usu'")==0)
			{
				
				
					$aux=$med->Ejecutar("INSERT INTO tbl_usuario (cedula_usu,apellidos_usu,nombres_usu,nombresCom_usu,edad_usu,login_usu,pass_usu,direccion_usu,estado_usu,id_rol,id_esp) VALUES ('$ced','$apellidos','$nombres','$nomcomp','$edad','$usu','$pass','$direccion','A','3','$especialidad')");
					echo "<h3><center>El administrador se ha guardado correctamente</center></h3>";
			}
			else
			{
				echo "<h3><center>Ya existe un administrador con este mismo usuario</center></h3>";	
			}
		}
		else
		{
			echo "<h3><center>Ya existe un administrador con esta cédula</center></h3>";
		}
		
	}

   /*
	*
	* logica para administradores nuevo menu
	*/






	 /*
	*
	* logica para secretarias y residentes nuevo menu
	*/
	public function LOadAllSecreR($buscar){
		$user=new Usuario;

		$datos=NULL;
		if ($buscar=="") {
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='5' AND estado_usu='A' AND id_esp='16' LIMIT 100;");
		}elseif($buscar!=""){
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='5' AND estado_usu='A' AND id_esp='16' AND cedula_usu LIKE '$buscar%' OR id_rol='5' AND id_esp='16' AND estado_usu='A' AND nombresCom_usu LIKE '$buscar%'   LIMIT 100;");
		}
		
		if (count($datos)>0) {
			echo "
			
			<table class='table table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Cedula</th>
						<th>Secretaria o R.</th>
						<th>Direccion</th>				
						<th>Permiso</th>
						<th></th>
						<th></th>
					</tr>
			";
				foreach ($datos as $fila) {
					$esp=$user->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$fila[id_esp]'");
					echo " 
						<tr>
							<td>$fila[cedula_usu]</td>
							<td>$fila[nombresCom_usu]</td>
							<td>$fila[direccion_usu]</td>
							<td>$esp</td>
							<td><a href='#' class='btn btn-primary' onclick='ModSecreR($fila[id_usu])'><i class='icon-refresh'></i> Actualizar</a></td>
							<td><a href='#myModal' role='button' data-toggle='modal' class='btn btn-danger' onclick='DeleSecreR($fila[id_usu])'><i class='icon-trash'></i> Eliminar</a></td>
						</tr>
					";
				}
			echo "</table>";
		}else{
			echo "<center><h4>No Hay secretarias En La Base De Datos</h4></center>";
		}		
	}

		public function LoadDataSecreR($code){
		$med=new Usuario;

	
		$cedua=$med->Consultar("SELECT cedula_usu FROM tbl_usuario WHERE id_usu='$code';");
		$apellidos=$med->Consultar("SELECT apellidos_usu FROM tbl_usuario WHERE id_usu='$code';");
		$nombres=$med->Consultar("SELECT nombres_usu FROM tbl_usuario WHERE id_usu='$code';");
		$edad=$med->Consultar("SELECT edad_usu FROM tbl_usuario WHERE id_usu='$code';");
		$direccion=$med->Consultar("SELECT direccion_usu FROM tbl_usuario WHERE id_usu='$code';");
		$Usuario=$med->Consultar("SELECT login_usu FROM tbl_usuario WHERE id_usu='$code';");
		$pass=$med->Consultar("SELECT pass_usu FROM tbl_usuario WHERE id_usu='$code';");
	
		echo "

		<table class='table table-hover table-striped table-condensend table-bordered'> 
		<tr> 
		<td>Cedula: </td> 
		<td colspan='3'><input type='text' id='txtCedulaMedsecreR' value='$cedua'  class='span4' /></td> 
		</tr> 
		<tr> 
		<td>Apellidos:</td> 
		<td><input type='text' id='txtApellMedsecreR' value='$apellidos' /></td> 
		<td>Nombres:</td> 
		<td><input type='text' id='txtNomMedicsecreR' value='$nombres' /></td> 
		</tr> 
		<tr> 
		<td>Edad:</td> 
		<td><input type='text' id='txtEdadMedsecreR' value='$edad' /></td> 
		<td>Direccion:</td> 
		<td><input type='text' id='txtDirecioMedsecreR' value='$direccion' /></td> 
		</tr> 
		<tr> 
		<td>Usuario:</td> 
		<td><input type='text' id='txtUserMedsecreR' value='$Usuario' /></td> 
		<td>Password:</td> 
		<td><input type='text' id='txtPassMedsecreR' value='$pass' /></td> 
		</tr>  
		<tr> 
		<td colspan='4'><center><a href='#' class='btn btn-primary' onclick='SaveNewOkSecreR($code)'><i class='icon-ok'></i> Guardar</a>  <a href='#' class='btn btn-success' onclick='CloseNewSecreR()'><i class='icon-remove'></i> Cancelar</a></center></td> 
		</tr> 
		</table>
		 ";
	}
	public function UpdateSecreR($ced,$apellidos,$nombres,$edad,$usu,$pass,$direccion,$cod){
		$user=new Usuario;
		$nomco=$apellidos." ".$nombres;
		$nomco=strtoupper($nomco);
		$upu=$user->Ejecutar("UPDATE tbl_usuario SET cedula_usu='$ced', apellidos_usu='$apellidos', nombres_usu='$nombres', nombresCom_usu='$nomco', edad_usu='$edad', login_usu='$usu', pass_usu='$pass', direccion_usu='$direccion', estado_usu='A' WHERE id_usu='$cod';");
		echo "<center><h3>Se guardo correctamente los cambios</h3></center>";
	}

	public function SaveNewSecreR($ced,$apellidos,$nombres,$edad,$usu,$pass,$direccion)
	{
		$med=new Usuario;
		$nomcomp=$apellidos." ".$nombres;
		$nomcomp=strtoupper($nomcomp);
		if($med->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE cedula_usu='$ced'")==0)
		{
			if($med->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE login_usu='$usu'")==0)
			{
				
				
					$aux=$med->Ejecutar("INSERT INTO tbl_usuario (cedula_usu,apellidos_usu,nombres_usu,nombresCom_usu,edad_usu,login_usu,pass_usu,direccion_usu,estado_usu,id_rol,id_esp) VALUES ('$ced','$apellidos','$nombres','$nomcomp','$edad','$usu','$pass','$direccion','A','5','16')");
					echo "<h3><center>La secretaria o el R. se ha guardado correctamente</center></h3>";
			}
			else
			{
				echo "<h3><center>Ya existe una secretaria o un R. con este mismo usuario</center></h3>";	
			}
		}
		else
		{
			echo "<h3><center>Ya existe una secretaria o un R. con esta cédula</center></h3>";
		}
		
	}
	 /*
	*
	* logica para secretarias y residentes nuevo menu
	*/




	 /*
	*
	* logica para digitadores nuevo menu
	*/

	public function LOadAllDigF($buscar){
		$user=new Usuario;

		$datos=NULL;
		if ($buscar=="") {
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='8' AND estado_usu='A' AND id_esp='16' LIMIT 100;");
		}elseif($buscar!=""){
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='8' AND estado_usu='A' AND id_esp='16' AND cedula_usu LIKE '$buscar%' AND id_rol='8' AND id_esp='16' AND estado_usu='A' OR nombresCom_usu LIKE '$buscar%'  AND id_rol='8' AND id_esp='16' LIMIT 100;");
		}
		
		if (count($datos)>0) {
			echo "
			
			<table class='table table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Cedula</th>
						<th>Digitador</th>
						<th>Direccion</th>				
						<th>Permiso</th>
						<th></th>
						<th></th>
					</tr>
			";
				foreach ($datos as $fila) {
					$esp=$user->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$fila[id_esp]'");
					echo " 
						<tr>
							<td>$fila[cedula_usu]</td>
							<td>$fila[nombresCom_usu]</td>
							<td>$fila[direccion_usu]</td>
							<td>$esp</td>
							<td><a href='#' class='btn btn-primary' onclick='ModDigF($fila[id_usu])'><i class='icon-refresh'></i> Actualizar</a></td>
							<td><a href='#myModal' role='button' data-toggle='modal' class='btn btn-danger' onclick='DeleDigF($fila[id_usu])'><i class='icon-trash'></i> Eliminar</a></td>
						</tr>
					";
				}
			echo "</table>";
		}else{
			echo "<center><h4>No Hay digitadores  En La Base De Datos</h4></center>";
		}		
	}
		public function LoadDataDigF($code){
		$med=new Usuario;

	
		$cedua=$med->Consultar("SELECT cedula_usu FROM tbl_usuario WHERE id_usu='$code';");
		$apellidos=$med->Consultar("SELECT apellidos_usu FROM tbl_usuario WHERE id_usu='$code';");
		$nombres=$med->Consultar("SELECT nombres_usu FROM tbl_usuario WHERE id_usu='$code';");
		$edad=$med->Consultar("SELECT edad_usu FROM tbl_usuario WHERE id_usu='$code';");
		$direccion=$med->Consultar("SELECT direccion_usu FROM tbl_usuario WHERE id_usu='$code';");
		$Usuario=$med->Consultar("SELECT login_usu FROM tbl_usuario WHERE id_usu='$code';");
		$pass=$med->Consultar("SELECT pass_usu FROM tbl_usuario WHERE id_usu='$code';");
	
		echo "

		<table class='table table-hover table-striped table-condensend table-bordered'> 
		<tr> 
		<td>Cedula: </td> 
		<td colspan='3'><input type='text' id='txtCedulaMedDigF' value='$cedua'  class='span4' /></td> 
		</tr> 
		<tr> 
		<td>Apellidos:</td> 
		<td><input type='text' id='txtApellMedDigF' value='$apellidos' /></td> 
		<td>Nombres:</td> 
		<td><input type='text' id='txtNomMedicDigF' value='$nombres' /></td> 
		</tr> 
		<tr> 
		<td>Edad:</td> 
		<td><input type='text' id='txtEdadMedDigF' value='$edad' /></td> 
		<td>Direccion:</td> 
		<td><input type='text' id='txtDirecioMedDigF' value='$direccion' /></td> 
		</tr> 
		<tr> 
		<td>Usuario:</td> 
		<td><input type='text' id='txtUserMedDigF' value='$Usuario' /></td> 
		<td>Password:</td> 
		<td><input type='text' id='txtPassMedDigF' value='$pass' /></td> 
		</tr>  
		<tr> 
		<td colspan='4'><center><a href='#' class='btn btn-primary' onclick='SaveNewOkDigF($code)'><i class='icon-ok'></i> Guardar</a>  <a href='#' class='btn btn-success' onclick='CloseNewDigF()'><i class='icon-remove'></i> Cancelar</a></center></td> 
		</tr> 
		</table>
		 ";
	}


	public function SaveNewDigF($ced,$apellidos,$nombres,$edad,$usu,$pass,$direccion)
	{
		$med=new Usuario;
		$nomcomp=$apellidos." ".$nombres;
		$nomcomp=strtoupper($nomcomp);
		if($med->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE cedula_usu='$ced'")==0)
		{
			if($med->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE login_usu='$usu'")==0)
			{
				
					$aux=$med->Ejecutar("INSERT INTO tbl_usuario (cedula_usu,apellidos_usu,nombres_usu,nombresCom_usu,edad_usu,login_usu,pass_usu,direccion_usu,estado_usu,id_rol,id_esp) VALUES ('$ced','$apellidos','$nombres','$nomcomp','$edad','$usu','$pass','$direccion','A','8','16')");
					echo "<h3><center>El digitador se ha guardado correctamente</center></h3>";
			}
			else
			{
				echo "<h3><center>Ya existe un digitador con este mismo usuario</center></h3>";	
			}
		}
		else
		{
			echo "<h3><center>Ya existe un digitador con esta cédula</center></h3>";
		}
		
	}
	 /*
	*
	* logica para digitadores nuevo menu
	*/
	
	//delete paciente 2
	public function deletePaciente2($codigo)
	{
		$pac=new Paciente;
		$pac->Ejecutar("UPDATE tbl_paciente SET estado_pac='E' WHERE id_pac='$codigo'");
		echo $this->Msm("r", "El paciente se ha eliminado correctamente");
	}
	//fin delete paciente 2
	
	//Altas y bajas Anestesiólogo
	
	public function SaveNewAn($ced,$ape,$noms,$edad,$dir,$user,$pass)
	{
		$an=new Usuario;
		$nomcomp=$ape." ".$noms;
		$nomcomp=strtoupper($nomcomp);
		
		if($an->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE cedula_usu='$ced'")==0)
		{
			if($an->Consultar("SELECT COUNT(*) FROM tbl_usuario WHERE login_usu='$user'")==0)
			{
				$aux=$an->Ejecutar("INSERT INTO tbl_usuario (cedula_usu,apellidos_usu,nombres_usu,nombresCom_usu,edad_usu,direccion_usu,login_usu,pass_usu,estado_usu,id_rol,id_esp) VALUES ('$ced','$ape','$noms','$nomcomp','$edad','$dir','$user','$pass','A','9','23')");
				echo "<h3><center>$aux El anestesiólogo se ha creado correctamente</center></h3>";
			}
			
			else
			{
				echo "<h3><center>Ya existe un anestesiólogo con este mismo usuario</center></h3>";
			}
		}
		else
		{
			echo "<h3><center>Ya existe un anestesiólogo con esta misma cédula</center></h3>";
		}
	}
	
	public function LoadDataAnestesia($buscar){
		$user=new Usuario;
		$datos=NULL;
		if ($buscar=="") {
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='9' AND estado_usu='A' AND id_esp='23' LIMIT 100;");
		}elseif($buscar!=""){
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='9' AND estado_usu='A' AND id_esp='23' AND cedula_usu LIKE '$buscar%' AND id_rol='9' AND id_esp='23' AND estado_usu='A' OR nombresCom_usu LIKE '$buscar%'  AND id_rol='9' AND id_esp='23' LIMIT 100;");
		}
		
		if (count($datos)>0) {
			echo "
			

			<table class='table table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Cédula</th>
						<th>Nombre</th>
						<th>Dirección</th>				
						<th>Especialidad</th>
						<th></th>
						<th></th>
					</tr>
			";
				foreach ($datos as $fila) {
					$esp=$user->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$fila[id_esp]'");
					echo " 
						<tr>
							<td>$fila[cedula_usu]</td>
							<td>$fila[nombresCom_usu]</td>
							<td>$fila[direccion_usu]</td>
							<td>$esp</td>
							<td><a class='btn btn-primary' onclick='LoadModAnestesiologo($fila[id_usu])'><i class='icon-refresh'></i> Actualizar</a></td>
							<td><a href='#myModal' role='button'  data-toggle='modal' class='btn btn-danger' onclick='DeleteAn($fila[id_usu])'><i class='icon-trash'></i> Eliminar</a></td>
						</tr>
					";
				}
			echo "</table>";
		}else{
			echo "<center><h4>No hay anestesiólogos en la base de datos</h4></center>";
		}
	}
	
	public function LOadAllAn($buscar){
		$user=new Usuario;

		$datos=NULL;
		if ($buscar=="") {
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='9' AND estado_usu='A' AND id_esp='23' LIMIT 100;");
		}elseif($buscar!=""){
			$datos=$user->Consultar_Usuario("SELECT * FROM tbl_usuario WHERE id_rol='9' AND estado_usu='A' AND id_esp='23' AND cedula_usu LIKE '$buscar%' AND id_rol='9' AND id_esp='23' AND estado_usu='A' OR nombresCom_usu LIKE '$buscar%'  AND id_rol='9' AND id_esp='23' LIMIT 100;");
		}
		
		if (count($datos)>0) {
			echo "
			
			<table class='table table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Cedula</th>
						<th>Secretaria o R.</th>
						<th>Direccion</th>				
						<th>Permiso</th>
						<th></th>
						<th></th>
					</tr>
			";
				foreach ($datos as $fila) {
					$esp=$user->Consultar("SELECT descripcion_esp FROM tbl_especialida WHERE id_esp='$fila[id_esp]'");
					echo " 
						<tr>
							<td>$fila[cedula_usu]</td>
							<td>$fila[nombresCom_usu]</td>
							<td>$fila[direccion_usu]</td>
							<td>$esp</td>
							<td><a href='#' class='btn btn-primary' onclick='LoadModAnestesiologo($fila[id_usu])'><i class='icon-refresh'></i> Actualizar</a></td>
							<td><a href='#' class='btn btn-danger' onclick='DeleteAn($fila[id_usu])'><i class='icon-trash'></i> Eliminar</a></td>
						</tr>
					";
				}
			echo "</table>";
		}else{
			echo "<center><h4>No hay anestesiólogos en la base de datos</h4></center>";
		}		
	}
	
	public function LoadModifyAn($code){
		$an=new Usuario;

	
		$cedua=$an->Consultar("SELECT cedula_usu FROM tbl_usuario WHERE id_usu='$code';");
		$apellidos=$an->Consultar("SELECT apellidos_usu FROM tbl_usuario WHERE id_usu='$code';");
		$nombres=$an->Consultar("SELECT nombres_usu FROM tbl_usuario WHERE id_usu='$code';");
		$edad=$an->Consultar("SELECT edad_usu FROM tbl_usuario WHERE id_usu='$code';");
		$direccion=$an->Consultar("SELECT direccion_usu FROM tbl_usuario WHERE id_usu='$code';");
		$Usuario=$an->Consultar("SELECT login_usu FROM tbl_usuario WHERE id_usu='$code';");
		$pass=$an->Consultar("SELECT pass_usu FROM tbl_usuario WHERE id_usu='$code';");
	
		echo "

		<table class='table table-hover table-striped table-condensend table-bordered'> 
		<tr> 
		<td>Cedula: </td> 
		<td colspan='3'><input type='text' id='txtCedulaAn' value='$cedua'  class='span4' /></td> 
		</tr> 
		<tr> 
		<td>Apellidos:</td> 
		<td><input type='text' id='txtApellAn' value='$apellidos' /></td> 
		<td>Nombres:</td> 
		<td><input type='text' id='txtNomAn' value='$nombres' /></td> 
		</tr> 
		<tr> 
		<td>Edad:</td> 
		<td><input type='text' id='txtEdadAn' value='$edad' /></td> 
		<td>Direccion:</td> 
		<td><input type='text' id='txtDirecioAn' value='$direccion' /></td> 
		</tr> 
		<tr> 
		<td>Usuario:</td> 
		<td><input type='text' id='txtUserAn' value='$Usuario' /></td> 
		<td>Password:</td> 
		<td><input type='text' id='txtPassAn' value='$pass' /></td> 
		</tr>  
		<tr> 
		<td colspan='4'><center><a href='#' class='btn btn-primary' onclick='ModifyAnest($code)'><i class='icon-ok'></i> Guardar</a>  <a href='#' class='btn btn-success' onclick='CloseModAnestesia()'><i class='icon-remove'></i> Cancelar</a></center></td> 
		</tr> 
		</table>
		 ";
	}
	
	public function UpdateAnestesia($ced,$apellidos,$nombres,$edad,$usu,$pass,$direccion,$cod){
		$user=new Usuario;
		$nomco=$apellidos." ".$nombres;
		$nomco=strtoupper($nomco);
		$upu=$user->Ejecutar("UPDATE tbl_usuario SET cedula_usu='$ced', apellidos_usu='$apellidos', nombres_usu='$nombres', nombresCom_usu='$nomco', edad_usu='$edad', login_usu='$usu', pass_usu='$pass', direccion_usu='$direccion', estado_usu='A' WHERE id_usu='$cod';");
		echo "<center><h3>Se guardo correctamente los cambios</h3></center>";
	}
	
	public function DeleteUserAn($codigo)
	{
		$user=new Usuario;
		$user->Ejecutar("UPDATE tbl_usuario SET estado_usu='E', cedula_usu='' WHERE id_usu='$codigo'");
		echo "<h3>Se ha eliminado correctamente el usuario</h3>";
	}
	
	//Fin altas y bajas Anestesiólogo

	//historial de  solicitud de interconsulta
	public function HistorialSolicitudInterconsulta($id_pac){
		$inte=new Solicitud;

		$datos=$inte->Consultar_Solicitud("SELECT * FROM tbl_solicitudinterconsulta WHERE id_pac='$id_pac'  AND est_intsoli='F' ORDER BY  id_intsoli DESC");
		echo "<table class='table table-striped table-condensend table-hover table-bordered'>
				<tr>
					<th>Fecha</th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "
				<tr>

			";
				echo "  <td>$fila[fechatn_intsoli]</td>
						<td><a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='SoliciConsuVer($fila[id_intsoli],$id_pac)'> Ver</a></td>
				";
			echo "
				</tr>
			";
		}
		echo "</table>";
	}

	public function HistorialInfoInterconsulta($code){
		$info=new Informe;
		$datos=$info->Consultar_Informe("SELECT * FROM tbl_informeinterconsulta WHERE id_pac='$code' AND est_intinfo='F' ORDER BY id_intinfo DESC;");
		echo "<table class='table table-striped table-condensend table-hover table-bordered'>
				<tr>
					<th>Número de informe </th>
					<th></th>
				</tr>
		";
		foreach ($datos as $fila) {
			echo "
				<tr>

			";
				echo "  <td>$fila[id_intinfo]</td>
						<td><a href='#myModal' role='button' class='btn' data-toggle='modal' onclick='VerInfoIntercons($fila[id_intinfo],$code)'> Ver</a></td>
				";
			echo "
				</tr>
			";
		}
		echo "</table>";
	}

	//historial de  solicitud de interconsulta


	//MUESTRA TODOS LOS ARCHIVOS DE ANAMNESIS DE HOSPITALIZACION 

public function AllAnamesisHospFile($code){
		$ana=new AnamnesisCdu;
		$datos=$ana->Consultar_AnamnesisHosp("SELECT *  FROM  tbl_anamnesis_hosp WHERE id_pac='$code' AND estado_proceso='F' ORDER BY txt_fecha_agend_doct DESC ;");
		if(count($datos)>0){
			echo "<table class='table-hover table-striped table-condensend table-bordered'>
					<tr>
						<th>Fecha de realizacion de la anamnesis</th>
						<th></th>

					</tr>
			";
			foreach ($datos as $fila) {
				echo "
					<tr>
						<td>$fila[txt_fecha_agend_doct]</td>
						<td><a id='verFileHist' href='../Reportes/L_ImprimirAnamnesisHospHist.php'  role='button' class='btn' data-toggle='modal' onclick='PrintAnamnesisHospHisto($fila[id_anam_hosp])'><i class='icon-eye-open'></i> Ver</a></td>
					</tr>
				";
			}
			echo "</table>";
		}else{
			echo "<center><h4>El paciente no tiene datos de anamnesis</h4></center>";
		}
	}

	
}
?>