<?php
	$nome = $_POST['nome'];
	$email = $_POST['email'];
	$senha = $_POST['pass'];

	$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

	require ($_SERVER["DOCUMENT_ROOT"].'/util/conexao.php');

	$sql = "insert into usuario (nome, email, senha, admin) values(?, ?, ?,?);";

	try{

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $nome);
		$stmt->bindValue(2, $email);
		$stmt->bindValue(3, $senhaCriptografada);
		$stmt->bindValue(4, 0);

		$stmt->execute();
			header("Location: /");

	}catch(PDOException $e){
			echo $e->getMessage();
	}
	

?>