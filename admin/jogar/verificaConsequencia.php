<?php

	session_start();
	include '../util/conexao.php';

	$jogador = $_POST['jogador'];
	$pergunta = $_POST['pergunta'];
	$partida = $_POST['partida'];
	$rodada = $_POST['rodada'];

	$sql = "SELECT * FROM partida where id = ?";

	$sql = "SELECT id_consequencia FROM jogador_partida_pergunta WHERE id_jogador = ? AND rodada = ?";

	$execucao = $conexao->prepare($sql);
	$execucao->bindParam(1, $jogador);
	$execucao->bindParam(2, $rodada);
	$execucao->execute();   
	$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);
	$ids;
	$cont = 0;

	foreach ($volta as $row) {
		
		$ids[$cont] = $row['id_consequencia'];

	}

	$sai = 0;
	$pergunta;
	$idPergunta;

	while ($sai == 0) {

		$queryPerguntas = "SELECT * FROM consequencias WHERE nivel = ? ORDER BY RAND() LIMIT 1";
		$execucao = $conexao->prepare($queryPerguntas);
		$execucao->bindParam(1, $_SESSION['nivel']);
		$execucao->execute();
		$consequenciaRetorno = $execucao->fetch();


		if(count($ids) == 0){

			$_SESSION['consequencia'] = $consequenciaRetorno['descricao'];
			$_SESSION['idConsequenciaAtual'] = $consequenciaRetorno['id'];
			$sai = 1;

		}else{
			for ($i=0; $i < count($ids); $i++) { 

				if($ids[$i] != $volta['id']){
					$_SESSION['consequencia'] = $consequenciaRetorno['descricao'];
					$_SESSION['idConsequenciaAtual'] = $consequenciaRetorno['id'];
					$sai = 1;
					break;
				}
			}	
		}

	}

	header("Location: exibeConsequencia.php");

?>