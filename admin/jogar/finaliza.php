<?php

	session_start();
	
	include '../util/conexao.php';


	$queryJogadores = "select j.* from jogador j left join partida_jogador pj on j.id = pj.id_jogador where pj.id_partida = ?";

	$execucao = $conexao->prepare($queryJogadores);
	$execucao->bindParam(1, $_SESSION['pId']);
	$execucao->execute();   
	$volta = $execucao->fetchAll(PDO::FETCH_ASSOC);
	$jogadores;
	$cont = 1;

	foreach($volta as $row){
		$nomes[$cont] = $row['nome'];
		$ids[$cont] = $row['id'];
		$cont++;
	}

	$idAtual = $_SESSION["atual"];

	$pergunta = $_SESSION['perguntaAtual'];
	$idPergunta = $_SESSION['idPerguntaAtual'];
	
	


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$_SESSION['partida']?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-110 p-r-110 p-t-62 p-b-33">
					
					<div class="p-t-31 p-b-9">
						<span class="txt1">
							<h2>
								Finalizar Partida?
							</h2>
						</span>
					</div>
					<center>
					<div class="container-login100-form-btn m-t-17">
						<form method="POST" action="/jogar/verifica.php">
							
							<button type="submit" class="btn-success btn-lg">
								Continuar
							</button>
						</form>
						&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						<form method="POST" action="/jogar/finalizaPartida.php">
							
							<button type="submit" class="btn-danger btn-lg">
								Finalizar
							</button>
						</form>
					</div>
					</center>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
<?php

?>