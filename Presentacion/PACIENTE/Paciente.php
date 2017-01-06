<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="../js/angular.js"></script>
	<!--<script type="text/javascript" src="js/ControlerBuscarCitaNormal.js"></script> colocar el controlador perteneciente-->

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
<body>
<div class="container-fluid">
		<div class="row-fluid">
				<div class="span12">

				<table class="table table-bordered table-striped table-condensend">
					<tr>
						<th>Cedula: </th>
						<td><input type="text">	</td>
						<th>Pasaporte: </th>
						<td><input type="text">	</td>
					</tr>	
					<tr>
						<th> Paciente: </th>
						<td colspan="3"><input type="text" class="span12">	</td>
					</tr>
					<tr>
						<th>Medico:</th>
						<td colspan="3">
							<div class="input-append">
								<input type="text">
								<a href="#" class="btn"> <i class="icon-search"></i> Buscar</a>
							</div>
						</td>
					</tr>
					<tr>
						<th>Fecha de nacimiento:</th>
						<td colspan="3">
						<div class="input-append">
							<input type="date">
							<input type="text" class="span12">	
						</div>
						</td>
					</tr>
					<tr>
						<th>Lugar de nacimiento:</th>
						<td><input type="text">	</td>
						<th>Lugar de residencia:</th>
						<td><input type="text">	</td>
					</tr>
					<tr>
						<th>Sexo:</th>
						<td>
							<select>
								<option value="">--Seleccione--</option>
								<option value="Femenino">Femenino</option>
								<option value="Masculino">Masculino</option>
							</select>
						</td>
						<th>Estado civil:</th>
						<td>
							<select>
								<option value="">--Seleccione--</option>
								<option value="Solter@">Solter@</option>
								<option value="Casad@">Casad@</option>
								<option value="Divorciad@">Divorciad@</option>
								<option value="Viud@">Viud@</option>
								<option value="Union libre">Union libre</option>
							</select>
						</td>
					</tr>
					<tr>
						<th>Instruccion:</th>
						<td colspan="3"><input type="text" class="span6">	</td>
					</tr>
					<tr>
						<th>Autorizacion:</th>
						<td><input type="text">	</td>
						<th>Fecha: </th>
						<td><input type="date">	</td>
					</tr>
					<tr>
						<th>Fecha Vencimiento: </th>
						<td colspan="3"><input type="text" class="span6">	</td>
					</tr>
					<tr>
						<th>Condicion del paciente:</th>
						<td>
							<select>
								<option value="">--Seleccione--</option>
								<option value="Convenio">Convenio</option>
								<option value="Empresa">Empresa</option>
								<option value="Particular">Particular</option>
							</select>
						</td>
						<td colspan="2"><input type="text">	</td>
					</tr>
					<tr>
						<th>Direccion:</th>
						<td><input type="text">	</td>
						<th>Telefono domicilio:</th>
						<td><input type="text">	</td>
					</tr>
					<tr>
						<th>Telefono trabajo: </th>
						<td><input type="text">	</td>
						<th>Celular:</th>
						<td><input type="text">	</td>
					</tr>
					<tr>
						<th>Correo:</th>
						<td colspan="3"><input type="text" class="span9">	</td>
					</tr>
					<tr>
						<th>Referencia:</th>
						<td><input type="text">	</td>
						<th>Telefono referencia:</th>
						<td><input type="text">	</td>
					</tr>
					<tr>
						<td colspan="4">
							<center>
								<a href="#" class="btn btn-success"> Guardar</a>
								<a href="#" class="btn btn-danger"> Cancelar</a>
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
                            <div class="Pdf" >
                            </div>
                         </div>

                         <div class="modal-footer">
                              <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                            
                         </div>
                   </div>
</body>
</html>