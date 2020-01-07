<?php

$jogador = $_GET['jogador'];
$partida = $_GET['partida'];

$verificaj;
$verificap;

require ($_SERVER["DOCUMENT_ROOT"].'/util/conexao.php');

$sql = "select * from partida_jogador where id_jogador = ? and id_partida = ?";

try{

	$stmt = $conexao->prepare($sql);

	$stmt->bindValue(1, $jogador);
	$stmt->bindValue(2, $partida);

	$stmt->execute();

	$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($resultado as $linha) {
		$verificaj = $linha['id_jogador'];
		$verificap = $linha['id_partida'];
		echo "Teste, verificap: ".$verificap;
	}

	if ($verificaj == $jogador && $verificap == $partida) {
		$msg = "Jogador Já existente na partida.";
		
		header("Location: /entraNaPartida.php?msg=".$msg."&id=".$partida);
	}else{

		$sql = "insert into partida_jogador(id_jogador, id_partida) values(?, ?);";

		$stmt = $conexao->prepare($sql);

		$stmt->bindValue(1, $jogador);
		$stmt->bindValue(2, $partida);

		$stmt->execute();

		$msg = "Jogador adicionado com sucesso";

		header("Location: /entraNaPartida.php?msg=".$msg."&id=".$partida);

	}

}catch(PDOException $e){
	echo $e->getMessage();
}

?>