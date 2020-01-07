<?php
	session_start();
	$nivel = $_POST['selectSm'];
	$desc = $_POST['descricao'];
	

	require ($_SERVER["DOCUMENT_ROOT"].'/util/conexao.php');

	$sql = "insert into partida (descricao, nivel, id_usuario) values(?, ?, ?);";

	try{

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $desc);
		$stmt->bindValue(2, $nivel);
		$stmt->bindValue(3, $_SESSION['id']);

		$stmt->execute();
			header("Location: /");

	}catch(PDOException $e){
			echo $e->getMessage();
	}
	

?>