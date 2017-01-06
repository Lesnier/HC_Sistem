<!DOCTYPE html>
<html ng-app="CitaNormal">
<head>
	<title></title>
	<script type="text/javascript" src="../js/angular.js"></script>
	<script type="text/javascript" src="js/ControlerCitasAgendas.js"></script>

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
<body ng-controller="CitaN">
<div class="container-fluid">
		<div class="row-fluid">
				<div class="span12">
					<table class="table table-bordered table-striped table-condensend">
						<tr>
							<td>
								<center>
									<div class="input-append">
											<input type="text" ng-model="Buscar" ng-keypress="BuscarPaciente()" >
											<a class="btn"><i class="icon-search"></i> Buscar Paciente</a>
									</div>
								</center>
							</td>
						</tr>
					</table>

					<table class="table table-bordered table-striped table-condensend" ng-show="Pacientes.length>0">
						<tr>
							<th>Cedula</th>
							<th>Paciente</th>
							<th>Edad</th>
							<th>Direccion</th>
							<th></th>
							<th></th>
						</tr>
						<tr ng-repeat="paciente in Pacientes">
							<td>{{paciente.Cedula}}</td>
							<td>{{paciente.Paciente}}</td>
							<td>{{paciente.Edad}}</td>
							<td>{{paciente.Direccion}}</td>
							<td>{{paciente.EstadoAtencion}}</td>
							<td>
								<a href="#myModal" class="btn btn-success" ng-click="InitProcesCita(paciente)" role='button' data-toggle='modal'> Agendar</a>
							</td>
						</tr>
					</table>
					

					<table class="table table-bordered table-striped table-condensend" ng-show="Codigo>0">
						<tr>
							<th>Quien agenda: </th>      	<td>{{NameUserAct}}</td>
							<th>Fecha de agenda: </th>		<td>{{FechaBusqueda}}</td>
						</tr>
						<tr>
							<th>Paciente: </th>			<td>{{Paciente}}</td>
							<th>Edad: </th>				<td>{{Edad}}</td>
						</tr>
						<tr>
							<th>Telefono: </th>			<td>{{Telefono}}</td>
							<th>Celular: </th>			<td>{{Celular}}</td>
						</tr>
						<tr>
							<th>Medico: </th>				
							<td>
								<div class="input-append"> 
									<input type="text"> 
									<a href="#myModal1" class="btn btn-info" ng-click="" role='button' data-toggle='modal'><i class='icon-search'></i></a>
								</div>
							</td>
							<th colspan="2"> {{MedicoPaciente}}</th>
						</tr>
						<tr>
							<th>Fecha Cita:</th>		<td> <input type="date" class="Fecha" ng-model="FechaCita" ng-change="LoadTime()" > </td>
							<th>Hora:</th>
							<td>
								<select ng-model="HoraCita">
									<option>--Seleccione--</option>
									<option ng-repeat='time in Horas' value="{{time.ID}}" >{{time.Time}}</option>
								</select>
							</td>
						</tr>
						<tr>
							<td colspan="4">
								<center>
									<a href="#" class="btn btn-success" ng-click="SaveCita()" > Guardar</a>
									<a href="#" class="btn btn-danger" ng-click="Cancelar()" > Cancelar</a>
								</center>
							</td>
						</tr>
					</table>


					<table class="table table-bordered table-striped table-condensend" ng-show="CodeCita>0">
						<tr>
							<th>
								<center>
									La cita se genero correctamente..!! 
								</center>
							</th>
						</tr>
						<tr>
							<td>
								<center>
									<a href="#myModal2" class="btn btn-success" ng-click="ImpCit()" role='button' data-toggle='modal'> <i class="icon-print"></i>  Imprimir</a>
									<a href="#" class="btn btn-info" ng-click="Reiniciar()" ><i class="icon-file"></i> Nueva cita</a>
								</center>
							</td>
						</tr>
					</table>
					


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
                            <div class="" >
                                  
                            <div  ng-show="Ok>0" class="alert  alert-success">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Fecha!</strong> correcta.
							</div>

							<div  ng-show="Ok==0" class="alert">
								<button type="button" class="close" data-dismiss="alert">&times;</button>
								<strong>Alerta</strong> la fecha de autorizacion a caducado.
							</div>

                            </div>
                         </div>

                         <div class="modal-footer">
                              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            
                         </div>
                   </div>

	  <!-- Button to trigger modal -->
                     <div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         <div class="modal-header">
                         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                         <h3 id="myModalLabel">Quantum</h3>
                    </div>
                         <div class="modal-body" >
                            <div class="" >
                                 
                            <table class="table table-bordered table-striped ">
                                        <tr>
                                             <td>
                                                  <center>
                                                       <div class="input-append">
                                                            <input type="text" ng-model="BuscadorM" ng-keypress="BuscarMedico()" ><a href="#" class="btn"><i class='icon-search'></i></a>
                                                       </div>
                                                  </center>
                                             </td>
                                        </tr>
                                   </table>
                                   <table class="table table-bordered table-striped ">
                                        <tr>
                                             <th>Codigo</th>
                                             <th>Cedula</th>
                                             <th>Medico</th>
                                             <th></th>
                                        </tr>
                                        <tr ng-repeat='medico in DataMedico'>
                                             <td>{{medico.Codigo}}</td>
                                             <td>{{medico.Cedula}}</td>
                                             <td>{{medico.Medico}}</td>
                                             <td>
                                                  
                                                  <button class="btn" data-dismiss="modal" aria-hidden="true" ng-click="CatchObjectM(medico)" >Seleccionar</button>
                                             </td>
                                        </tr>
                                   </table>


                            </div>
                         </div>

                         <div class="modal-footer">
                              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            
                         </div>
                   </div>

	<!-- Button to trigger modal -->
                     <div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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