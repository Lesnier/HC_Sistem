var app=angular.module("AltasBajasAdm",[]);
	app.controller("Admin",["$scope","$http",function($scope,$http){   
		$scope.Buscar;
		$scope.DataAdmin=[];
		$scope.Admin=[];
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

		$scope.BuscarAdm=function() {
			$http.get('../Procesar.php?accion=DataAdm&Buscar='+$scope.Buscar)
			.success(function (data) {
				$scope.DataAdmin=data;
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
		$scope.SaveAdmin=function() {
			$scope.Admin={
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
			console.log($scope.Admin);
			$http.post('../Procesar.php?accion=SaveChangeAdmin',$scope.Admin)
			.success(function(data){
				$scope.Cancelar();
				$scope.BuscarAdm();
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
				$scope.BuscarAdm();
				$scope.Ok=1;
			}).error(function(erro){

			});
		};
	}]);
