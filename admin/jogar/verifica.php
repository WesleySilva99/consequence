<?php

	session_start();
	include '../util/conexao.php';

	$partida = $_SESSION['pId'];
	$jogador = $_SESSION['atual'];

	$sql = "SELECT rodada FROM partida where id = ?";

	$execucao = $conexao->prepare($sql);
	$execucao->bindParam(1, $partida);
	$execucao->execute();   
	$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);
	$rodada;

	foreach ($volta as $row) {
		
		$rodada = $row['rodada'];

	}

	$sql = "SELECT id_pergunta FROM jogador_partida_pergunta WHERE id_jogador = ? AND rodada = ?";

	$execucao = $conexao->prepare($sql);
	$execucao->bindParam(1, $partida);
	$execucao->bindParam(2, $rodada);
	$execucao->execute();   
	$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);
	$ids;
	$cont = 0;

	foreach ($volta as $row) {
		
		$ids[$cont] = $row['id_pergunta'];

	}

	$sai = 0;
	$pergunta;
	$idPergunta;

	while ($sai == 0) {

		$queryPerguntas = "SELECT * FROM perguntas WHERE nivel = ? ORDER BY RAND() LIMIT 1";
		$execucao = $conexao->prepare($queryPerguntas);
		$execucao->bindParam(1, $_SESSION['nivel']);
		$execucao->execute();
		$perguntaRetorno = $execucao->fetch();


		if(count($ids) == 0){

			$_SESSION['perguntaAtual'] = $perguntaRetorno['descricao'];
			$_SESSION['idPerguntaAtual'] = $perguntaRetorno['id'];
			$sai = 1;

		}else{
			for ($i=0; $i < count($ids); $i++) { 

				if($ids[$i] != $volta['id']){
					$_SESSION['perguntaAtual'] = $perguntaRetorno['descricao'];
					$_SESSION['idPerguntaAtual'] = $perguntaRetorno['id'];
					$sai = 1;
					break;
				}
			}	
		}

	}

	header("Location: index.php");

?>