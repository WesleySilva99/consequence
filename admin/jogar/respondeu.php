<?php

	session_start();
	include '../util/conexao.php';
	$jogador = $_POST['jogador'];
	$pergunta = $_POST['pergunta'];
	$partida = $_POST['partida'];
	$rodada = $_POST['rodada'];

	//try {
			
		$sql = "insert into jogador_partida_pergunta(id_jogador, id_partida, id_pergunta, is_consequence, rodada) values(?, ?, ?, ?, ?)";

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $jogador);
		$stmt->bindValue(2, $partida);
		$stmt->bindValue(3, $pergunta);
		$stmt->bindValue(4, 0);
		$stmt->bindValue(5, $rodada);

		$stmt->execute();

		$queryJogadores;

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

		
			
		}else{

			$_SESSION['rodada']++;
			$sql = "update partida set rodada = ? where id = ?";

			$stmt = $conexao->prepare($sql);

			$stmt->bindValue(1, $_SESSION['rodada']);
			$stmt->bindValue(2, $partida);

			$stmt->execute();

			$queryJogadores = "select j.* from jogador j left join partida_jogador pj on j.id = pj.id_jogador where pj.id_partida = ? ORDER BY j.id";

			$execucao = $conexao->prepare($queryJogadores);
			$execucao->bindParam(1, $partida);
			$execucao->execute();   
			$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);

			foreach ($volta as $row) {
				
				$_SESSION['atual'] = $row['id'];
				break;
			}
			
		}
		

		header("Location: verifica.php");

	//} catch (Exception $e) {
	//	header("Location: /index.php");		
	//}
	
?>