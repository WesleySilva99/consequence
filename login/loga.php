<?php


	include ($_SERVER['DOCUMENT_ROOT'] .'/util/conexao.php');

	try{
	$email = $_POST['email'];
	$senha = $_POST['pass'];

	$sql = "select * from usuario where email = ?";
	$stmt = $conexao->prepare($sql);
	$stmt->bindParam(1, $email);
	$stmt->execute();	
	$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($resultado as $linha){
	
		if(password_verify($senha, $linha["senha"])){
			session_start();
			
			$_SESSION["email"]=$linha["email"];
			$_SESSION["nome"]=$linha["nome"];
			$_SESSION["USUARIO_LOGADO"] = $linha["nome"];
			$_SESSION["id"]= $linha["id"];
			
			header("Location: ".'/index.php');
		}else{
			print "<script> alert('Login ou senhas Incorreto(s)!');</script>";
			header("Location: loginCadastro.php");
		}
	}
	}	catch(PDOException $e){
		echo $e->getMessage();
	}

?>