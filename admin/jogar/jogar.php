<?php

	session_start();
	include '../util/conexao.php';

	try {
		
		$query = "select * from partida where id = ?";

	 	$execucao = $conexao->prepare($query);
		$execucao->bindParam(1, $_GET['partida']);
		$execucao->execute();   
		$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);
		$partida;
		$nivel;
		$pId;
		$rodada;
		
		
		foreach ($volta as $row) {
	    
	    	$pId = $row['id'];
	    	$partida = $row['descricao'];
	    	$nivel = $row["nivel"];
	    	$rodada = $row['rodada'];
		}

		$_SESSION['pId'] = $pId;
		$_SESSION['partida'] = $partida;
		$_SESSION['nivel'] = $nivel;
		$_SESSION['rodada'] = $rodada;

		$query = "select max(id_jogador) as id from partida_jogador where id_partida = ?";
		$execucao = $conexao->prepare($query);
		$execucao->bindParam(1, $pId);
		$execucao->execute();
		$maxId = $execucao->fetch();

		$_SESSION['max'] = $maxId['id'];

		$queryJogadores = "select j.* from jogador j left join partida_jogador pj on j.id = pj.id_jogador where pj.id_partida = ? ORDER BY j.id";
		$execucao = $conexao->prepare($queryJogadores);
		$execucao->bindParam(1, $_GET['partida']);
		$execucao->execute();
		$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);

		foreach ($volta as $row) {
			
			$_SESSION['atual'] = $row['id'];
			
			break;
		}
		
		$_SESSION['total'] = count($volta);


		
		header("Location: verifica.php");

	} catch (Exception $e) {
		header("Location: /index.php");		
	}
	
?>