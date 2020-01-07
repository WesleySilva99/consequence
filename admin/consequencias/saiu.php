<?php
	
	$jogador = $_GET['jogador'];
	$partida = $_GET['partida'];
	
	

	require ($_SERVER["DOCUMENT_ROOT"].'/util/conexao.php');

	$sql = "delete from partida_jogador where id_jogador = ? and id_partida = ?";

	try{

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $jogador);
		$stmt->bindValue(2, $partida);

		$stmt->execute();

		$msg = "Jogador removido com sucesso";


		header("Location: /entraNaPartida.php?msg=".$msg."&id=".$partida);

	}catch(PDOException $e){
			echo $e->getMessage();
	}
	

?>