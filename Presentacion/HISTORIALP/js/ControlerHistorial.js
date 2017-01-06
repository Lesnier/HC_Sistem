var app=angular.module("HistorialPaciente",[]);
	app.controller("historial",["$scope","$http",function($scope,$http){   
		$scope.Buscar;
		$scope.DataHPaciente=[];
		$scope.DataHisFilePact=[];
		$scope.FileDatos=[];

		$scope.BuscarHPaciente=function() {
			$http.get('../Procesar.php?accion=DataHPaciente&Buscar='+$scope.Buscar)
			.success(function (data) {
				$scope.DataHPaciente=data;
				$scope.DataHisFilePact=[];
				$scope.FileDatos=[];
			})
			.error(function(error){

			});
		};
		$scope.Historial=function(paciente) {
			$http.post('../Procesar.php?accion=InfoPaciente',paciente)
			.success(function (data) {
				$scope.DataHisFilePact=data;
			})
			.error(function(error){

			});
		};
		$scope.VerFile=function(paciente,archivo) {
			$http.get('../Procesar.php?accion=ArchivosXPaciente&PACIENTE='+paciente.Codigo+'&Archivo='+archivo)
			.success(function (data) {
				$scope.FileDatos=data;
			})
			.error(function(error){
			});	
		}
	}]);

