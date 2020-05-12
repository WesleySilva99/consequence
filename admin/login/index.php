<!DOCTYPE html>
<html lang="en">
<head>
	<?php

	session_start();
		

	 if (isset($_SESSION['admin'])) {
		# code...
		header("Location:/");
		
	}

	?>
	<script type="text/javascript">

		function carrega(){

			document.getElementById('create').style.display = 'none';

		}

		function change(form){

			if(form == 'create'){
				document.getElementById("create").style.display = 'none';
				document.getElementById("login").style.display = 'block';
			}else{
				document.getElementById("create").style.display = 'block';
				document.getElementById("login").style.display = 'none';
			}

		}

		function checkCreate(){

			var email = document.getElementById('emailcreate');
			var senha = document.getElementById('passcreate');
			var reply = document.getElementById('passreply');

			if (email.value.trim() == "") {

				alert("Email inválido");
				return false;

			}

			if (senha.value == "") {
				alert("Insira uma senha válida");
				alert("No mínimo 8 dígitos \n No mínimo 1 caracter especial; \n No mínimo 1 número");
				return false;
			}

			if (senha.value != reply.value) {
				alert("As senhas não conferem!");
				return false;
			}

			return true;

		}

		function enviar(){

			checkCreate();

			document.getElementById('create').submit();

		}

		function logar(){

			document.getElementById('login').submit();

		}

	</script>
	<title>Login Consequence</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="login/css/util.css">
	<link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body onload="carrega()">
	
	
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<div class="login100-pic js-tilt" data-tilt>
						<img src="login/images/logo.jpeg" alt="IMG">
					</div>

					<form class="login100-form validate-form" onsubmit="logar()" action="/login/loga.php" method="POST" id="login">
						<span class="login100-form-title">
							Logar-se
						</span>

						<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
							<input class="input100" type="text" name="email" placeholder="Email">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Password is required">
							<input class="input100" type="password" name="pass" placeholder="Password">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
						
						<div class="container-login100-form-btn">
							<button class="login100-form-btn" type="submit">
								Login
							</button>
						</div>

                        <?php

                            if(isset($_SESSION['msg'])){
                                ?>

                                <div class="text-center p-t-12">
							<span class="txt1">
								<?=$_SESSION['msg'];?>
							</span>

                                </div>

                        <?php
                                session_destroy();
                            }

                        ?>

						<div class="text-center p-t-12">
							<span class="txt1">
								Forgot
							</span>
							<a class="txt2" href="#">
								Username / Password?
							</a>
						</div>

						<div class="text-center p-t-136">
							<a class="txt2" href="#" onclick="change('login')">
								Crie Sua conta e divirta-se
								<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</a>
						</div>
					</form>

					<form class="login100-form validate-form" onsubmit="return enviar()" action="/login/criar.php" method="POST" id="create">
						<span class="login100-form-title">
							Criar Conta
						</span>

						<div class="wrap-input100 validate-input" data-validate="Nome é obrigatório: ex@abc.xyz">
							<input id="nome"class="input100" type="text" name="nome" placeholder="Nome">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Email Valido é obrigatório: ex@abc.xyz">
							<input id="emailcreate"class="input100" type="text" name="email" placeholder="Email">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-envelope" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Senha é obrigatório">
							<input class="input100" type="password" id="passcreate" name="pass" placeholder="Senha">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Senha é obrigatório">
							<input class="input100" type="password" id="passreply" name="passreply" placeholder="Repira Sua Senha">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
						
						<div class="container-login100-form-btn">
							<button class="login100-form-btn" type="submit">
								Login
							</button>
						</div>

						<div class="text-center p-t-136">
							<a class="txt2" href="#" onclick="change('create')">
								Se logue
								<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
							</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	

	
<!--===============================================================================================-->	
	<script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/bootstrap/js/popper.js"></script>
	<script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="login/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="login/js/main.js"></script>

</body>
</html>