<?php

	session_start();
	include '../util/conexao.php';



	try {
		
		$query = "select * from partida where id = ?";

	 	$execucao = $conexao->prepare($query);
		$execucao->bindParam(1, $_GET['partida']);
		$execucao->execute();   
		$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);
		$partida = 0;
		$nivel = 0;
        $pId = 0;
		$rodada = 0;
		
		
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
        $_SESSION['total'] = count($volta);

		$query = "select max(id_jogador) as id from partida_jogador where id_partida = ?";
		$execucao = $conexao->prepare($query);
		$execucao->bindParam(1, $pId);
		$execucao->execute();
		$maxId = $execucao->fetch();

		$query = "SELECT jogador FROM pontuacao WHERE partida = ?";
		$execucao = $conexao->prepare($query);
		$execucao->bindParam(1, $pId);
		$execucao->execute();
		$jogadores = $execucao->fetchAll(PDO::FETCH_ASSOC);

		$_SESSION['max'] = $maxId['id'];

		$queryJogadores = "select j.* from jogador j left join partida_jogador pj on j.id = pj.id_jogador where pj.id_partida = ? ORDER BY j.id";
		$execucao = $conexao->prepare($queryJogadores);
		$execucao->bindParam(1, $_GET['partida']);
		$execucao->execute();
		$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);
		$zero = 0;
		if(count($jogadores) == 0){

			foreach ($volta as $row) {
				
				$insertPontuacao = "INSERT INTO pontuacao(jogador, partida, verdades, consequencias) VALUES (?, ?, ?, ?)";

				$stmt = $conexao->prepare($insertPontuacao);
				$stmt->bindParam(1, $row['id']);
				$stmt->bindParam(2, $pId);
				$stmt->bindParam(3, $zero);
				$stmt->bindParam(4, $zero);
				$stmt->execute();

			}

		}else{

			foreach ($volta as $row) {

				$verificador = 1;

				foreach ($jogadores as $atual) {
					
					if ($atual == $row['id']) {
						$verificador = 0;
					}

				}

				if($verificador == 0){
					
					
					$insertPontuacao = "INSERT INTO pontuacao(jogador, partida, verdades, consequencias) VALUES (?, ?, ?, ?)";

					$execucao = $conexao->prepare($insertPontuacao);
					$execucao->bindParam(1, $row['id']);
					$execucao->bindParam(2, $pId);
					$execucao->bindParam(3, $zero);
					$execucao->bindParam(4, $zero);
					$execucao->execute();

				}

			}
		}
		

		foreach ($volta as $row) {
			
			$_SESSION['atual'] = $row['id'];
			
			break;
		}
		

		
		header("Location: verifica.php");

	} catch (Exception $e) {
		echo $e->getMessage();
		header("Location: /index.php?msg=".$msg);	
	}

?>