var app=angular.module("ProtocoloOp",[]);
	app.controller("First",["$scope","$http",function($scope,$http){   // es para minificar el javascript 
		$scope.NewProtocolo={}; //objeto del vecto
		$scope.DataPO=[];		//vector
		$scope.DataHora=[];		//vector

		$scope.AddProtocolo=function() {	//funcion  para agregar
			$scope.DataPO.push($scope.NewProtocolo); //agregando
			console.log($scope.DataPO);  			// datos por consola
		};
		$scope.NOMBRE;$scope.HCL;$scope.PRE;$scope.POST;
		$scope.CIRUGIA;$scope.CIRUJANO;$scope.ANESTESIOLOGO;
		$scope.COOCIRUJANO;$scope.INSTRUMENTISTA;
		$scope.PRIMERAYUDANTE;$scope.CIRCULANTE;
		$scope.SEGUNDOAYUDANTE; $scope.FECHA1;
		$scope.HORAI;$scope.HORAF;$scope.TIPOANESTESIA;
		$scope.TQUIRURGICO;$scope.HALLAZGOS;
		$scope.PROCEDIMIENTOS;$scope.COMPLICACIONES;
		$scope.SANGRADO;$scope.HISTOPATOLOGIA;
		$scope.PREPARADPOR;$scope.FECHA2;
		$scope.APROBADOPOR;$scope.FECHA3;$scope.ECOGRAFISTA;
		$scope.SERVICIO;$scope.PERMISOS;$scope.IDCITCIR;
		$scope.ListCirugia=[];
		$http.get('../Procesar.php?accion=DataProtocoloP')
		.success(function (data) {
				$scope.HCL= data[0].HCL;
				$scope.NOMBRE= data[0].NOMBRE;
				$scope.PRE=data[0].PRE;
				$scope.POST=data[0].POST;
				$scope.CIRUGIA=data[0].CIRUGIA;
				$scope.CIRUJANO=data[0].CIRUJANO;
				$scope.ANESTESIOLOGO=data[0].ANESTESIOLOGO;
				$scope.COOCIRUJANO=data[0].COOCIRUJANO;
				$scope.INSTRUMENTISTA=data[0].INSTRUMENTISTA;
				$scope.PRIMERAYUDANTE=data[0].PRIMERAYUDANTE;
				$scope.CIRCULANTE=data[0].CIRCULANTE;
				$scope.SEGUNDOAYUDANTE=data[0].SEGUNDOAYUDANTE;
				$scope.FECHA1=new Date(data[0].FECHA1);
				$scope.HORAI=data[0].HORAI;
				$scope.HORAF=data[0].HORAF;
				$scope.TIPOANESTESIA=data[0].TIPOANESTESIA;
				$scope.TQUIRURGICO=data[0].TQUIRURGICO;
				$scope.HALLAZGOS=data[0].HALLAZGOS;
				$scope.PROCEDIMIENTOS=data[0].PROCEDIMIENTOS;
				$scope.COMPLICACIONES=data[0].COMPLICACIONES;
				$scope.SANGRADO=data[0].SANGRADO;
				$scope.HISTOPATOLOGIA=data[0].HISTOPATOLOGIA;
				$scope.PREPARADPOR=data[0].PREPARADPOR;
				$scope.FECHA2=new Date(data[0].FECHA2);
				$scope.APROBADOPOR=data[0].APROBADOPOR;
				$scope.FECHA3=new Date(data[0].FECHA3);
				$scope.ECOGRAFISTA=data[0].ECOGRAFISTA;
				$scope.SERVICIO=data[0].SERVICIO;
				$scope.PERMISOS=data[0].PERMISOS;
				$scope.ListCirugia=data[0].LISTCIRUGIA;
				$scope.IDCITCIR=data.IDCITCIR;
		})
		.error(function(error){console.log(error);});

		$http.get('../Procesar.php?accion=DataHoro')
		.success(function (datah) {
			$scope.DataHora=datah;
		})
		.error(function(error){console.log(error);});
		
		$scope.Buscador="";// variable para buscar
		$scope.DataCirugia=[];		//vector
		$scope.BuscarCirugia=function() {
			$http.get('../Procesar.php?accion=DataCirugia&Buscar='+$scope.Buscador)
			.success(function (data) {
				$scope.DataCirugia=data;
			})
			.error(function(error){

			});
		};
		//asignar 
		
		$scope.CatchObject=function(iess) {
			$scope.ListCirugia.push(iess); 
		};
		//eliminar item lista
		$scope.DeleteCirugia=function(cirugia) {
			$scope.ListCirugia.splice(cirugia,1);
		};
		//buscar medico
		$scope.BuscadorM="";
		$scope.DataMedico=[];
		$scope.AsignarMedico="";
		$scope.BuscarMedico=function() {
			$http.get('../Procesar.php?accion=DataMeduci&Buscar='+$scope.BuscadorM)
			.success(function (data) {
				$scope.DataMedico=data;
			})
			.error(function(error){

			});	
		};
		$scope.CatchObjectM=function(medico) {
			switch($scope.AsignarMedico){
				case 1:
					$scope.CIRUJANO=medico.Medico;	
				break;
				case 2:
					$scope.ANESTESIOLOGO=medico.Medico;	
				break;
				case 3:
					$scope.COOCIRUJANO=medico.Medico;	
				break;
				case 4:
					$scope.PRIMERAYUDANTE=medico.Medico;	
				break;
				case 5:
					$scope.SEGUNDOAYUDANTE=medico.Medico;	
				break;
				case 6:
					$scope.PREPARADPOR=medico.Medico;	
				break;
			}
		};
		//calcular hora
		$scope.CalcularHour=function() {
			if($scope.HORAI!="" & $scope.HORAF!=""){
				if ($scope.HORAI<$scope.HORAF){
					$http.get('../Procesar.php?accion=CalcularHour&I='+$scope.HORAI+'&F='+$scope.HORAF)
						.success(function (data) {
							$scope.TQUIRURGICO=data;
							
						})
						.error(function(error){console.log(error);});
				}else{
					alert("Seleccione una hora menor");
				}
			}else{
				alert("Seleccione un horario");
			}
		};

		$scope.NuevoProtocolo=function(){
			$scope.NuevoProtocolo={
					NOMBRE:$scope.NOMBRE,
					HCL: $scope.HCL,
					PRE:$scope.PRE,
					POST:$scope.POST,
					CIRUGIA:$scope.ListCirugia,
					CIRUJANO:$scope.CIRUJANO,
					ANESTESIOLOGO:$scope.ANESTESIOLOGO,
					COOCIRUJANO:$scope.COOCIRUJANO,
					INSTRUMENTISTA:$scope.INSTRUMENTISTA,
					PRIMERAYUDANTE:$scope.PRIMERAYUDANTE,
					CIRCULANTE:$scope.CIRCULANTE,
					SEGUNDOAYUDANTE:$scope.SEGUNDOAYUDANTE,
					FECHA1:$scope.FECHA1,
					HORAI:$scope.HORAI,
					HORAF:$scope.HORAF,
					TIPOANESTESIA:$scope.TIPOANESTESIA,
					TQUIRURGICO:$scope.TQUIRURGICO,
					HALLAZGOS:$scope.HALLAZGOS,
					PROCEDIMIENTOS:$scope.PROCEDIMIENTOS,
					COMPLICACIONES:$scope.COMPLICACIONES,
					SANGRADO:$scope.SANGRADO,
					HISTOPATOLOGIA:$scope.HISTOPATOLOGIA,
					PREPARADPOR:$scope.PREPARADPOR,
					FECHA2:$scope.FECHA2,
					APROBADOPOR:$scope.APROBADOPOR,
					FECHA3:$scope.FECHA3,
					ECOGRAFISTA:$scope.ECOGRAFISTA,
					SERVICIO:$scope.SERVICIO,
					PERMISOS:$scope.PERMISOS,
					IDCITCIR:$scope.IDCITCIR
			};
			console.log($scope.NuevoProtocolo);
			$http.post('../Procesar.php?accion=AddNuevoProtocolo',$scope.NuevoProtocolo)
			.success(function(data){
				console.log(data);
			}).error(function(erro){

			})
		};
	}]);

