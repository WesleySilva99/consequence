<?php
	session_start();
	$nome = $_POST['descricao'];
	$nivel = $_POST['nivel'];
	

	require ($_SERVER["DOCUMENT_ROOT"].'/util/conexao.php');

	$sql = "insert into consequencias (descricao, nivel) values(?, ?);";

	try{

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $nome);
		$stmt->bindValue(2, $nivel);

		$stmt->execute();

		$msg = "Consequência cadastrada com sucesso";

		header("Location: /index.php?msg=".$msg);

	}catch(PDOException $e){
			echo $e->getMessage();
	}
	

?>