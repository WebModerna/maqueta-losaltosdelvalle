<?php
	$dbhost = 'localhost';
	$dbuser = 'Tu nombre de usuario';
	$dbpass = 'Tu contrase�a';
	$dbname = 'Nombre de la base de datos';

	$link_id = new mysqli($dbhost,$dbuser,$dbpass,$dbname);
	
	if ($link_id  ->connect_error) {
		echo "Error de Connexion  ($link_id->connect_errno)
		$link_id->connect_error\n";
		exit;
		//header('Location: index.php');
			} 
?>