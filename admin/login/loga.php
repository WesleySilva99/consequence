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

	if(count($resultado) == 0){
        $msg = "Login ou senhas Incorreto(s)!";
        header("Location: index.php?msg=".$msg);
    }
	
	foreach($resultado as $linha){
	
		if(password_verify($senha, $linha["senha"])){
			session_start();
			
			$_SESSION["email"]=$linha["email"];
			$_SESSION["nome"]=$linha["nome"];
			$_SESSION["id"]= $linha["id"];
			$_SESSION["admin"]= $linha["admin"];
			
			
			header("Location: ".'/index.php');
		}else{
			$msg = "Login ou senhas Incorreto(s)!";
			header("Location: index.php?msg=".$msg);
		}
	}
	}	catch(PDOException $e){
		echo $e->getMessage();
	}

?>