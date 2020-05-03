<?php

	session_start();
	include '../util/conexao.php';
	$jogador = $_POST['jogador'];
	$pergunta = $_POST['pergunta'];
	$partida = $_POST['partida'];
	$rodada = $_POST['rodada'];
	$consequencia = $_POST['consequencia'];

	try {
			
		$sql = "insert into jogador_partida_pergunta(id_jogador, id_partida, id_pergunta, is_consequence, id_consequencia, rodada) values(?, ?, ?, ?, ?, ?)";

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $jogador);
		$stmt->bindValue(2, $partida);
		$stmt->bindValue(3, $pergunta);
		$stmt->bindValue(4, 1);
		$stmt->bindValue(5, $consequencia);
		$stmt->bindValue(6, $rodada);

		//$stmt->execute();

		
		$queryJogadores;
		$redirect;

		if($_SESSION['atual'] < $_SESSION['max']){

			$queryJogadores = "select j.* from jogador j left join partida_jogador pj on j.id = pj.id_jogador where pj.id_partida = ? and j.id <> ?";

			$execucao = $conexao->prepare($queryJogadores);
			$execucao->bindParam(1, $partida);
			$execucao->bindParam(2, $jogador);
			$execucao->execute();   
			$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);

			foreach ($volta as $row) {
				
				if($row['id'] > $_SESSION['atual']){

					$_SESSION['atual'] = $row['id'];
					break;
				}


			}
			$redirect = "verifica.php";
			
		}else{

			$sql = "update partida set rodada = ? where id = ?";

			$stmt = $conexao->prepare($sql);

			$_SESSION['rodada']++;

			$stmt->bindValue(1, $partida);
			$stmt->bindValue(2, $_SESSION['rodada']);

			$stmt->execute();

			$queryJogadores = "select j.* from jogador j left join partida_jogador pj on j.id = pj.id_jogador where pj.id_partida = ?";

			$execucao = $conexao->prepare($queryJogadores);
			$execucao->bindParam(1, $partida);
			$execucao->execute();   
			$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);

			foreach ($volta as $row) {
				
				$_SESSION['atual'] = $row['id'];
				break;
			}

			$redirect = "finaliza.php";

		}
		
		header("Location: ".$redirect);
		

	} catch (Exception $e) {

		$msg = "Ocorreu algum erro na sua partida!";

		header("Location: /index.php?msg=".$msg);		
	}
	
?>