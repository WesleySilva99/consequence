<?php

	session_start();
	
	include '../util/conexao.php';


	$queryJogadores = "SELECT j.nome nome, po.consequencias consequencias, po.verdades verdades FROM jogador j  join partida_jogador pj on j.id = pj.id_jogador join pontuacao po on j.id = po.jogador WHERE pj.id_partida = ?";

	$execucao = $conexao->prepare($queryJogadores);
	$execucao->bindParam(1, $_GET['partida']);
	$execucao->execute();   
	$jogadores = $execucao->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Resultados da partida</title>
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
								Partida Finalizada!
							</h2>
						</span>
					</div>
					<center>
					<div class="container-login100-form-btn m-t-17">
						<table class="table table-striped">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Nome</th>
									<th scope="col">Verdades</th>
									<th scope="col">Consequencias</th>
								</tr>	
							</thead>
							<tbody>
								<?php

									$contador = 1;

									foreach ($jogadores as $row) {
										
								?>

								<tr>
									<th scope="col"><?=$contador;?></th>
									<th scope="col"><?=$row['nome'];?></th>
									<th scope="col"><?=$row['verdades'];?></th>
									<th scope="col"><?=$row['consequencias'];?></th>
								</tr>

								<?php

									$contador++;
								
								}

								?>
							</tbody>
							
							
						</table>
						<br>
						<button onclick="window.close();" class="btn-danger btn-lg">
							Sair
						</button>
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