<?php
	session_start();
	$nome = $_POST['nome'];
	

	require ($_SERVER["DOCUMENT_ROOT"].'/util/conexao.php');

	$sql = "insert into jogador (nome, id_usuario) values(?, ?);";

	try{

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $nome);
		$stmt->bindValue(2, $_SESSION['id']);

		$stmt->execute();

		$msg = "Jogador criado com sucesso";

		header("Location: /index.php?msg=".$msg);

	}catch(PDOException $e){
			echo $e->getMessage();
	}
	

?>