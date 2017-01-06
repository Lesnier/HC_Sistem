<!DOCTYPE html>
<html ng-app="HistorialPaciente">
<head>
	<title></title>
	<script type="text/javascript" src="../js/angular.js"></script>
	<script type="text/javascript" src="js/ControlerHistorial.js"></script>

	<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../css/bootstrap-responsive.css" type="text/css"/>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

</head>
<body ng-controller="historial">
	<div class="container-fluid">
		<div class="row-fluid">
			<!--<div class="span2"></div>-->
			<div class="span12">
				<table class="table table-bordered table-striped table-condensend">
					<tr>
						<td>
							<center>
								<div class="input-append">
										<input type="text" ng-model="Buscar" ng-keypress="BuscarHPaciente()" >
										<a class="btn"><i class="icon-search"></i> Buscar Historia Paciente</a>
								</div>
							</center>
						</td>
					</tr>
				</table>

				<table ng-show="DataHPaciente.length>0" class="table table-bordered table-striped table-condensend">
					<tr>
						<th>Cedula</th>
						<th>Nombres</th>
						<th>Edad</th>
						<th>Direccion</th>
						<th></th>
						<th></th>
					</tr>
					<tr ng-repeat="paciente in DataHPaciente">
						<td>{{paciente.Cedula}}</td>
						<td >{{paciente.Paciente}}</td>
						<td>{{paciente.Edad}}</td>
						<td>{{paciente.Direccion}}</td>
						<td>{{paciente.EstadoAtencion}}</td>
						<td> <a href="#" class="btn " ng-click="Historial(paciente);"><i class="icon-file"></i> </a> </td>
					</tr>
				</table>

				<table ng-show="DataHisFilePact.length>0" class="table table-bordered table-striped table-condensend">
					<tr>
						<th colspan="4">
							
						</th>
					</tr>
					<tr >
						<td>Archivos</td>
						<td>Cantidad</td>
						<td colspan="2">Ver</td>
						
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Laboratorio</td>
					 	<td>{{file.Laboratorio}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,1)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Rayos X</td>
					 	<td>{{file.RayosX}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,2)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Urudinamia</td>
					 	<td>{{file.Urudinamia}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,3)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Ultrasonido</td>
					 	<td>{{file.Ultrasonido}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,4)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Tomografia</td>
					 	<td>{{file.Tomografias}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,5)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Cardiologia</td>
					 	<td>{{file.Otros}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,6)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Autorizacion</td>
					 	<td>{{file.Auto}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,7)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Historia antigua</td>
					 	<td>{{file.HC}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,8)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<!--Nueva Adaptacion xD-->
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Consulta Inicial</td>
					 	<td>{{file.Anamnesis}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,9)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Epicrisis</td>
					 	<td>{{file.Epircris}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,10)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Solicitud Interconsulta</td>
					 	<td>{{file.SInterconsulta}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,11)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Informe Interconsulta</td>
					 	<td>{{file.InfoInterconsulta}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,12)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>
					<tr ng-repeat="file in DataHisFilePact">
					 	<td>Protocolo Operatorio</td>
					 	<td>{{file.POperatorio}} <i class="icon-file"></i></td>
					 	<td colspan="2"> <a href="#" ng-click="VerFile(file,13)" class="btn btn-primary"> <i class="icon-list"></i> Lista Archivos</a></td>
					</tr>

				</table>

				<table ng-show="FileDatos.length>0" class="table table-bordered table-striped table-condensend" >
					<tr>
						<th>Fecha</th>
						<th>Nombre</th>
						<th>Archivo</th>
					</tr>
					<tr ng-repeat="archivo in FileDatos" >
						<td>{{archivo.FECHA}}</td>
						<td>{{archivo.NOMBRE}}</td>
						<td>
							<a href='../{{archivo.URL}}' target='_blank' class="btn btn-success"> <i class="icon-file"></i> </a>
						</td>
					</tr>
				</table>
			</div>
			<!--<div class="span2"></div>-->	
		</div>
	</div>
</body>
</html>