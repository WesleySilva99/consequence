<?php

	session_start();
	include '../util/conexao.php';
	$jogador = $_POST['jogador'];
	$pergunta = $_POST['pergunta'];
	$partida = $_POST['partida'];
	$rodada = $_POST['rodada'];
	$consequencia = $_POST['consequencia'];

	try {
			
		$sql = "insert into jogador_partida_pergunta(id_jogador, id_partida, id_pergunta, is_consequence) values(?, ?, ?, ?)";

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $jogador);
		$stmt->bindValue(2, $partida);
		$stmt->bindValue(3, $pergunta);
		$stmt->bindValue(4, 1);
		$stmt->bindValue(5, );

		$stmt->execute();

		
		$sql = "SELECT id_consequencia FROM jogador_partida_pergunta where id_jogador = ?";

		$execucao = $conexao->prepare($sql);
		$execucao->bindParam(1, $partida);
		$execucao->execute();   
		$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);
		$ids;
		$cont = 0;

		header("Location: executeConsequence.php");

	} catch (Exception $e) {
		header("Location: /index.php");		
	}
	
?>