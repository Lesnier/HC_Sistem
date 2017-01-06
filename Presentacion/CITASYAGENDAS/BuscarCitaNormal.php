<!DOCTYPE html>
<html ng-app="BuscarCitaNormal">
<head>
	<script type="text/javascript" src="../js/angular.js"></script>
	<script type="text/javascript" src="js/ControlerBuscarCitaNormal.js"></script>

	<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../css/bootstrap-responsive.css" type="text/css"/>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <style type="text/css">
    	.Pdf object{
    		height: 100%;
    		width: 100%;
    	}
    </style>
</head>
<body ng-controller="BuscarCitaN">
<div class="container-fluid">
		<div class="row-fluid">
				<div class="span12">
					<table class="table table-bordered table-striped table-condensend">
						<tr>
							<td>
								<center>
									<div class="input-append">
											<input type="text" ng-model="Buscar" ng-keypress="BuscarMedico()" >
											<a class="btn"><i class="icon-search"></i> Buscar Medico</a>
									</div>
								</center>
							</td>
						</tr>
					</table>

					<table class="table table-bordered table-striped table-condensend" ng-show="DataMedico.length>0">
						<tr>
							<th>Cedula</th>
							<th>Medico</th>
							<th></th>
						</tr>
						<tr ng-repeat="medico in DataMedico">
							<td>{{medico.Cedula}}</td>
							<td>{{medico.Medico}}</td>
							<td>
								<a href="#" class="btn btn-success" ng-click="GenerarBuscadorxFechas(medico)"> Seleccionar Fechas</a>
							</td>
						</tr>
					</table>
					

					<table class="table table-bordered table-striped table-condensend" ng-show="MedicoId>0">
						<tr>
							<th>Fecha: </th>
							<td>
								<div class="input-append"> 
									<input type="date" class="UDFecha" > <a href="#" ng-click="ControlBuscar=1;BuscarCitaMedico() " class="btn"> <i class="icon-search"></i> Buscar</a>
								</div>
							</td>
							<th>Seleccione 1 dia de la semana: </th>
							<td>
								<div class="input-append"> 
									<input type="date"  class="FechaSemana" > <a href="#" ng-click="CitaSemana()" class="btn"> <i class="icon-search"></i> Buscar</a>
								</div>
							</td>
						</tr>
						<tr>
							<th>Fecha Incial:</th>
							<td>
								<input type="date" class="DDFechas1">
							</td>
							<th>Fecha Final:</th>
							<td>
								<div class="input-append"> 
									<input type="date"  class="DDFechas2"> <a href="#" ng-click="ControlBuscar=2;BuscarCitaMedico() "  class="btn"> <i class="icon-search"></i> Buscar</a>
								</div>
							</td>
						</tr>
						<tr>
							<th>Mes:</th>
							<td colspan="4">
								<div class="input-append"> 
									<select ng-model="Mes">
										<option value="">--Seleccione--</option>
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
										<option value="3">Marzo</option>
										<option value="4">Abril</option>
										<option value="5">Mayo</option>
										<option value="6">Junio</option>
										<option value="7">Julio</option>
										<option value="8">Agosto</option>
										<option value="9">Septiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
									</select>
									<a href="#" ng-click="ControlBuscar=3;BuscarCitaMedico() " class="btn"> <i class="icon-search"></i> Buscar</a>
								</div>
							</td>
						</tr>
					</table>


					<table class="table table-bordered table-striped table-condensend" ng-show="ControlBuscar>0 && DataCita.length>0">
						<tr>
							<td colspan="8">
								<center>
									<a href="#myModal" role='button' data-toggle='modal' ng-show="ControlBuscar==1" ng-click="ImpCitaMedico()" class="btn btn-info"><i class="icon-print"></i> Imprimir</a>
									<a href="#myModal" role='button' data-toggle='modal' ng-show="ControlBuscar==2" ng-click="ImpCitaMedico()" class="btn btn-info"><i class="icon-print"></i> Imprimir</a>
									<a href="#myModal" role='button' data-toggle='modal' ng-show="ControlBuscar==3" ng-click="ImpCitaMedico()" class="btn btn-info"><i class="icon-print"></i> Imprimir</a>
								</center>
							</td>
						</tr>
						<tr>
							<th>Paciente</th>
							<th>Telefono</th>
							<th>Celular</th>
							<th>Fecha De la Consulta</th>
							<th>Hora</th>
							<th>Estado</th>
							<th>Fecha Ingreso</th>
							<th>Fecha Caducidad</th>
						</tr>
						<tr ng-repeat="cita in DataCita">
							<td>{{cita.Paciente}}</td>
							<td>{{cita.Telefono}}</td>
							<td>{{cita.Celular}}</td>
							<td>{{cita.FechaConsulta}}</td>
							<td>{{cita.Hora}}</td>
							<td>{{cita.EstadoCita}}</td>
							<td>{{cita.FechaRegistro}}</td>
							<td>{{cita.FechaFinRegistro}}</td>
						</tr>
					</table>
					
					<!--<table class="table table-bordered table-striped table-condensend">
						<tr>
							<th colspan="8">
								<center>
									
								</center>
							</th>
						</tr>
						<tr>
							<th>Hora</th>
							<th>Lunes</th>
							<th>Martes</th>
							<th>Miercoles</th>
							<th>Jueves</th>
							<th>Viernes</th>
							<th>Sabado</th>
							<th>Domingo</th>
						</tr>
					</table>-->


				</div>
		</div>
	</div>

	<!-- Button to trigger modal -->
                     <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         <h3 id="myModalLabel">Quantum</h3>
                    </div>
                         <div class="modal-body" >
                            <div class="Pdf" >
                            </div>
                         </div>

                         <div class="modal-footer">
                              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            
                         </div>
                   </div>
</body>
</html>