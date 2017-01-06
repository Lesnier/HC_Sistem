var app=angular.module("CitaNormal",[]);
	app.controller("CitaN",["$scope","$http",function($scope,$http){   
		$scope.Buscar;
		$scope.Pacientes=[];
		$scope.Ok;

		$scope.Paciente;
		$scope.Cedula;
		$scope.Edad;
		$scope.Direccion;
		$scope.Telefono;
		$scope.Celular;
		$scope.EstadoAtencion;
		$scope.Codigo;
		$scope.FechaBusqueda;
		$scope.NameUserAct;
		$scope.IDUserAct;
		$scope.MedicoPaciente;

		$scope.DataMedico=[];
		$scope.AsignarMedicoID;

		$scope.FechaCita;
		$scope.Horas=[];
		$scope.HoraCita;
		$scope.DatosCita={};

		$scope.CodeCita;
		$scope.BuscarPaciente=function() {
			$http.get('../Procesar.php?accion=DataHPaciente&Buscar='+$scope.Buscar)
			.success(function (data) {
				$scope.Pacientes=data;
			})
			.error(function(error){
			});
		};

		$scope.InitProcesCita=function(pact) {
			$http.get('../Procesar.php?accion=ComprobarFechavencimiento&IDPAC='+pact.Codigo)
			.success(function (data) {
				$scope.Ok=data;
			})
			.error(function(error){
			});

			$scope.Paciente=pact.Paciente;
			$scope.Cedula=pact.Cedula;
			$scope.Edad=pact.Edad;
			$scope.Direccion=pact.Direccion;
			$scope.Telefono=pact.Telefono;
			$scope.Celular=pact.Celular;
			$scope.EstadoAtencion=pact.EstadoAtencion;
			$scope.Codigo=pact.Codigo;
			$scope.FechaBusqueda=pact.FechaBusqueda;
			$scope.NameUserAct=pact.NameUserAct;
			$scope.IDUserAct=pact.IDUserAct;
			$scope.MedicoPaciente=pact.MedicoPaciente;
		};

		$scope.BuscarMedico=function() {
			$http.get('../Procesar.php?accion=DataMeduci&Buscar='+$scope.BuscadorM)
			.success(function (data) {
				$scope.DataMedico=data;
			})
			.error(function(error){

			});	
		};
		$scope.CatchObjectM=function(medico) {
			$scope.MedicoPaciente=medico.Medico;
			$scope.AsignarMedicoID=medico.Codigo;
		};
		$scope.LoadTime=function() {
			if ($scope.AsignarMedicoID>0) {
				$http.get('../Procesar.php?accion=DataTimeCitasNormales&Fecha='+$(".Fecha").val()+'&IDMedico='+$scope.AsignarMedicoID)
				.success(function (data) {
					$scope.Horas=data;
				})
				.error(function(error){

				});
			}else{
				alert("Seleccione un medico!");
			}
		};

		$scope.SaveCita=function() {

			if ($scope.AsignarMedicoID>0 & $scope.HoraCita>0  & $(".Fecha").val()!="") {
				$scope.DatosCita={
				PacienteID: $scope.Codigo,
				MedicoID:$scope.AsignarMedicoID,
				HoraCita: $scope.HoraCita,
				FechaReserva: $scope.FechaBusqueda,
				FechaConsulta: $(".Fecha").val()
				};
				$http.post('../Procesar.php?accion=AddNuevoCitaOTurno',$scope.DatosCita)
				.success(function(data){
					$scope.CodeCita=data;


					$scope.Pacientes=[];
					$scope.Ok="";

					$scope.Paciente="";
					$scope.Cedula="";
					$scope.Edad="";
					$scope.Direccion="";
					$scope.Telefono="";
					$scope.Celular="";
					$scope.EstadoAtencion="";
					$scope.Codigo=0;
					$scope.FechaBusqueda="";
					$scope.NameUserAct="";
					$scope.IDUserAct="";
					$scope.MedicoPaciente="";

					$scope.DataMedico=[];
					$scope.AsignarMedicoID=0;

					$scope.FechaCita;
					$scope.Horas=[];
					$scope.HoraCita="";
					$scope.DatosCita={}

				}).error(function(erro){

				});
			}else
			{
				alert("Seleccione un medico, una fecha y un horario para guardar la cita!!");
			}
		};
		$scope.ImpCit=function() {
			if($scope.CodeCita>0){
				$( ".Pdf" ).html("<object type='text/html' data='../../Reportes/Turno.php?id="+$scope.CodeCita+"'></object>");
			}	
		};

		$scope.Reiniciar=function() {
			$scope.Pacientes=[];
			$scope.Ok="";

			$scope.Paciente="";
			$scope.Cedula="";
			$scope.Edad="";
			$scope.Direccion="";
			$scope.Telefono="";
			$scope.Celular="";
			$scope.EstadoAtencion="";
			$scope.Codigo=0;
			$scope.FechaBusqueda="";
			$scope.NameUserAct="";
			$scope.IDUserAct="";
			$scope.MedicoPaciente="";

			$scope.DataMedico=[];
			$scope.AsignarMedicoID=0;

			$scope.FechaCita;
			$scope.Horas=[];
			$scope.HoraCita="";
			$scope.DatosCita={};

			$scope.CodeCita="";
			$scope.Buscar="";
		};

	}]);