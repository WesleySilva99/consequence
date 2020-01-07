<?php

	$partida = $_GET['id'];

	include '../util/conexao.php';

	$sql = "delete from partida where id = ?";
	$query = "delete from partida_jogador where id_partida = ?";

	try{

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $partida);

		$stmt->execute();

		$tentativa = $conexao->prepare($query);

		$tentativa->bindValue(1, $partida);

		$tentativa->execute();
		
		$msg = 'Partida excluída com sucesso';

		echo "<script> alert('".$msg."') </script>";

	}catch(PDOException $e){
			echo $e->getMessage();
	}

	header("Location: /index.php?msg=".$msg);

?>