var app=angular.module("BuscarCitaNormal",[]);
	app.controller("BuscarCitaN",["$scope","$http",function($scope,$http){   
		$scope.Buscar;
		$scope.DataMedico=[];
		$scope.MedicoId;
		$scope.ControlBuscar;
		$scope.DataCita=[];
		$scope.Mes;
		$scope.BuscarMedico=function() {
			$http.get('../Procesar.php?accion=DataMeduci&Buscar='+$scope.Buscar)
			.success(function (data) {
				$scope.DataMedico=data;
				$scope.MedicoId=0;
				$scope.ControlBuscar=0;
				$scope.DataCita=[];
			})
			.error(function(error){

			});	
		};
		$scope.GenerarBuscadorxFechas=function(medico) {
			$scope.MedicoId=medico.Codigo;
		};
		$scope.BuscarCitaMedico=function() {
			var Fecha,Fecha2;
			switch($scope.ControlBuscar){
				case 1:
					Fecha=$(".UDFecha").val();
					Fecha2="";
				break;
				case 2:
					Fecha=$(".DDFechas1").val();
					Fecha2=$(".DDFechas2").val();
				break;
				case 3:
					Fecha=$scope.Mes;
					Fecha2="";
				break;
			}
			if(Fecha!=""){
				$http.get('../Procesar.php?accion=BuscarCitaMedico&Medico='+$scope.MedicoId+'&Fecha='+Fecha+"&Fecha2="+Fecha2+"&Control="+$scope.ControlBuscar)
				.success(function (data) {
					$scope.DataCita=data;
				})
				.error(function(error){
				});
			}else{
				alert("Seleccione una fehca..!!");
			}
		};
		$scope.ImpCitaMedico=function(argument) {
			switch($scope.ControlBuscar){
				case 1:
					$(".Pdf").html("<object type='text/html' data='../../Reportes/ImprimirCitasMedicosXDia.php?code="+$scope.MedicoId+"&fi="+$(".UDFecha").val()+"'></object>");
				break;
				case 2:
					$(".Pdf").html("<object type='text/html' data='../../Reportes/ImprimirCitasMedicosXfecha.php?code="+$scope.MedicoId+"&fi="+$(".DDFechas1").val()+"&ff="+$(".DDFechas2").val()+"'></object>");
				break;
				case 3:
					$(".Pdf").html("<object type='text/html' data='../../Reportes/ImprimirCitasMedicosXMes.php?code="+$scope.MedicoId+"&mes="+$scope.Mes+"'></object>");
				break;
			}
		};
		$scope.CitaSemana=function(argument) {
			if($(".FechaSemana").val()!=""){
				$http.get('../Procesar.php?accion=CitaSemana&Medico='+$scope.MedicoId+'&Fecha='+$(".FechaSemana").val())
				.success(function (data) {
					console.log(data);
				})
				.error(function(error){
				});
			}else{
				alert("Seleccione una fehca..!!");
			}	
		};

	}]);

//ComprobarFechavencimiento