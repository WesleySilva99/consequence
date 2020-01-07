<?php

	$jogador = $_GET['id'];

	include '../util/conexao.php';

	$sql = "delete from jogador where id = ?";
	$query = "delete from partida_jogador where id_jogador = ?";

	try{

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $jogador);

		$stmt->execute();

		$tentativa = $conexao->prepare($query);

		$tentativa->bindValue(1, $jogador);

		$tentativa->execute();
		
		$msg = 'Jogador excluído com sucesso';

	}catch(PDOException $e){
			echo $e->getMessage();
	}

	header("Location: /index.php?msg=".$msg);

?>