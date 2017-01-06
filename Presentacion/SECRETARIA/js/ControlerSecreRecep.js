var app=angular.module("AltasBajasSecreRecep",[]);
	app.controller("SecreRecep",["$scope","$http",function($scope,$http){   
		$scope.Buscar;
		$scope.DataSecRece=[];
		$scope.SecRecep=[];
		$scope.Cedula;
		$scope.Apellidos;
		$scope.Nombres;
		$scope.Edad;
		$scope.Direccion;
		$scope.Login;
		$scope.Clave;
		$scope.Rol;
		$scope.Codigo;
		$scope.Ok=0;
		$scope.Adnmi={};

		$scope.BuscarSecreRe=function() {
			$http.get('../Procesar.php?accion=DataSecRece&Buscar='+$scope.Buscar)
			.success(function (data) {
				$scope.DataSecRece=data;
			})
			.error(function(error){

			});
		};
		$scope.SeeUser=function(usuario){
			$scope.Cedula=usuario.Cedula;
			$scope.Apellidos=usuario.Apellidos;
			$scope.Nombres=usuario.Nombre;
			$scope.Edad=usuario.Edad;
			$scope.Direccion=usuario.Direccion;
			$scope.Login=usuario.Login;
			$scope.Clave=usuario.Clave;
			$scope.Rol=usuario.Permisos;
			$scope.Codigo=usuario.Codigo;
			$scope.Ok=0;
		};
		$scope.Cancelar=function() {
			$scope.Cedula="";
			$scope.Apellidos="";
			$scope.Nombres="";
			$scope.Edad="";
			$scope.Direccion="";
			$scope.Login="";
			$scope.Clave="";
			$scope.Rol="";
			$scope.Codigo=0;
			$scope.Adnmi={};
		};
		$scope.SaveSecRecep=function() {
			$scope.SecRecep={
				Cedula:$scope.Cedula,
				Apellidos:$scope.Apellidos,
				Nombres:$scope.Nombres,
				Edad:$scope.Edad,
				Direccion:$scope.Direccion,
				Login:$scope.Login,
				Clave:$scope.Clave,
				Permisos:$scope.Rol,
				Codigo:$scope.Codigo
			};
			console.log($scope.SecRecep);
			$http.post('../Procesar.php?accion=SaveChangeSecRecep',$scope.SecRecep)
			.success(function(data){
				$scope.Cancelar();
				$scope.BuscarSecreRe();
				$scope.Ok=1;
			}).error(function(erro){

			})
		};
		$scope.BorraUserAdm=function(user) {
			$scope.Adnmi=user;
		};
		$scope.OkDelete=function () {
			console.log($scope.Adnmi);
			$http.post('../Procesar.php?accion=DeleteUserAdmin',$scope.Adnmi)
			.success(function(data){
				console.log(data);
				$scope.Cancelar();
				$scope.BuscarSecreRe();
				$scope.Ok=1;
			}).error(function(erro){

			});
		};
	}]);
