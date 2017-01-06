<!DOCTYPE html>
<html ng-app="AltasBajasSecreRecep">
<head>
	<title></title>
	<script type="text/javascript" src="../js/angular.js"></script>
	<script type="text/javascript" src="js/ControlerSecreRecep.js"></script>

	<script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="../css/bootstrap-responsive.css" type="text/css"/>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body ng-controller="SecreRecep">
	<div class="container-fluid">
		<div class="row-fluid">
				<div class="span12">
					<table class="table table-bordered table-striped table-condensend">
						<tr>
							<td>
								<center>
									<div class="input-append">
											<input type="text" ng-model="Buscar" ng-keypress="BuscarSecreRe()" >
											<a class="btn"><i class="icon-search"></i> Buscar Secretaria</a>
									</div>
								</center>
							</td>
						</tr>
					</table>

					<table ng-show="DataSecRece.length>0" class="table table-bordered table-striped table-condensend">
						<tr>
							<th>Cedula</th>
							<th>Usuario</th>
							<th></th>
							<th></th>
						</tr>
						<tr ng-repeat="user in DataSecRece">
							<td>{{user.Cedula}}</td>
							<td>{{user.Usuario}}</td>
							<td><a href="" class="btn" ng-click="SeeUser(user)" > Modificar</a></td>
							<td><a  href='#myModal' ng-click="BorraUserAdm(user)" role='button' class='btn btn-danger' data-toggle='modal'> Borrar</a></td>


						</tr>
					</table>

					<table ng-show="Codigo>0" class="table table-bordered table-striped table-condensend">
						<tr>
							<td>Cedula</td>
							<td colspan="3"><input type="text" ng-model="Cedula"/></td>
						</tr>
						<tr>
							<td>Apellidos</td>
							<td><input type="text" ng-model="Apellidos"></td>
							<td>Nombres</td>
							<td><input type="text" ng-model="Nombres"></td>
						</tr>
						<tr>
							<td>Edad</td>
							<td><input type="text" ng-model="Edad"></td>
							<td>Direccion</td>
							<td><input type="text" ng-model="Direccion" /></td>
						</tr>
						<tr>
								<td>Login</td>
								<td><input type="text" ng-model="Login" /></td>
								<td>Password</td>
								<td><input type="text" ng-model="Clave"/></td>
						</tr>
						
						<tr>
							<td colspan="4">
								<center>
									<a href="" class="btn" ng-click="SaveSecRecep()" > Guardar</a>
									<a href="" class="btn btn-info" ng-click="Cancelar()"> Cancelar</a>
								</center>
							</td>
						</tr>
					</table>

					<div  ng-show="Ok>0" class="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>Se guardo!</strong> correctamente los datos.
					</div>
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
                                  
                            <table class="table table-bordered table-striped table-condensend">
                            	<tr>
                            		<th>
                            			<center>
                            				Desea Borrar La Secretaria
                            			</center>
                            		</th>
                            	</tr>
                            	<tr>
                            		<td> 
                            			<center>
                            				<a href="#" ng-click="OkDelete()" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true" > Aceptar</a>
                            				<a href="#" class="btn btn-info" data-dismiss="modal" aria-hidden="true" > Cancelar</a>
                            			</center>
                            		</td>
                            	</tr>
                            </table>

                            </div>
                         </div>

                         <div class="modal-footer">
                              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            
                         </div>
                   </div>

</body>
</html>