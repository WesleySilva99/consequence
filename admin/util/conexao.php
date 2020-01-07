<?php


	$host= 'localhost';
	$db = 'consequence';   
	$user = 'root';
	$password = 'BHU*nji9';

	try {
	  $conexao = new PDO('mysql:host=localhost;dbname=consequence', $user, $password);
	  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}

?>