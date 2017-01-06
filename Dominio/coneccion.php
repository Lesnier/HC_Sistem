<?php 
	include "../persistencia/adodb.inc.php";
	class Conexion 
	{
		protected $dbcon;
			public function conectardb()
			{
				$dbcon=ADONewConnection('mysqli');
				$dbcon->debug=false;
				//$dbcon->Connect('localhost', 'quantup9_cdusist', 'i.H^B;?S~fii', 'quantup9_cdusistem');
//				$dbcon->Connect('localhost', 'root', 'root', 'cdusistem2016') or die ('no se puede conectar a la base');
				$dbcon->Connect('localhost', 'root', '', 'cdusistem_db') or die ('no se puede conectar a la base');
				//  $dbcon->EXECUTE("set names 'utf8'");
				$dbcon->SetCharSet('utf8'); 
				return $dbcon;
			}					
	}

?>
