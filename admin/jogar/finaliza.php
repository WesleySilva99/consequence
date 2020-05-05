<?php

	session_start();
	
	include '../util/conexao.php';


	$updatePartida = "UPDATE partida SET finalizada = ? WHERE id = ?";

	$um = 1;

	$execucao = $conexao->prepare($updatePartida);
	$execucao->bindParam(1, $um);
	$execucao->bindParam(2, $_SESSION['pId']);
	$execucao->execute();

	$partida = $_SESSION['pId'];
	$email = $_SESSION["email"];
	$nome = $_SESSION["nome"];
	$id = $_SESSION["id"];
	$admin = $_SESSION["admin"];
	
	session_destroy();

	session_start();

	$_SESSION["email"]=$email;
	$_SESSION["nome"]=$nome;
	$_SESSION["id"]= $id;
	$_SESSION["admin"]= $admin;

	header("Location: /jogar/finalizada.php?partida=".$partida);
	


?>