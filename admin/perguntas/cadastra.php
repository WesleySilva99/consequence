<?php
	session_start();
	$descricao = $_POST['descricao'];
	$nivel = $_POST['nivel'];
	$ativo = $_POST['ativo'];
	

	require ($_SERVER["DOCUMENT_ROOT"].'/util/conexao.php');

	$sql = "insert into perguntas (descricao, nivel, ativo) values(?, ?, ?);";

	try{

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $descricao);
		$stmt->bindValue(2, $nivel);
		$stmt->bindValue(3, $_SESSION['admin']);

		$stmt->execute();

		$msg;

		if ($_SESSION['admin'] == 1) {
			$msg = "Pergunta criada com sucesso";
		}else {
			$msg = "Pergunta solicitada com sucesso";
		}
		

		header("Location: /index.php?msg=".$msg);

	}catch(PDOException $e){
			echo $e->getMessage();
	}
	

?>