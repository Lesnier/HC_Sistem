<?php 
	include "../persistencia/adodb.inc.php";
	class Conexion 
	{
		protected $dbcon;
			public function conectardb()
			{
				$dbcon=ADONewConnection('mysql');
				$dbcon->debug=false;
				$dbcon->Connect('cdusistem.db.10980127.hostedresource.com', 'cdusistem', 'Clinica1@', 'cdusistem');
				return $dbcon;
			}					
	}

?>