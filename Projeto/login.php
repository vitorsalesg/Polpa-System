<?php
session_start();
if(isset($_SESSION["login"])){
	if ($_SESSION["flag"] == 1){
		echo "<script>location.href='perfil.php';</script>";
	}
	else{
		echo "<script>location.href='perfilCliente.php';</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Polpa System - Login do Sistema </title>
	<meta charset="utf-8">
	<link rel="icon" href="image/icon.png">
	<link rel="stylesheet" type="text/css" href="style/login.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<script type="text/javascript" src="js/login.js" defer></script>
</head>
<body>
	<div class="login-box">
		<h1>
			Login
			<a href="index.php"><i class="fas fa-undo"></i></a>
			<?php
				$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if(strpos($fullUrl, "signup=success") == true){
					echo "<i class='fas fa-check-circle' style='color:green' title='Operação realizada com sucesso!'></i>";
				}
				else if(strpos($fullUrl, "signup=incorreto") == true){
					echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Dados Incorretos! Por favor verificar os campo.'></i>";
				}
				else if(strpos($fullUrl, "signup=success") == true){
					echo "<i class='fas fa-check-circle' style='color:green' title='Cadastrado com Sucesso!'></i>";
				}
			?>
		</h1>
		<form action="php_action/operacoesLogin.php" name="form" method="post" id="formulario" onsubmit="return validaLogin();">
			<div class="textbox">
				<i class="fas fa-user" aria-hidden="true"></i>
				<input type="text" placeholder="Insira seu usuario" id="usuario" name="usuario" required>
			</div>
			<div class="textbox">
				<i class="fas fa-lock" aria-hidden="true"></i>
				<input type="password" placeholder="Insira sua senha" id="senha" name="senha" required>
			</div>
			<input type="submit" class="btn" id="mensagem-erro" value="Entrar" name="botao">
		</form>
	</div>
</body>
</html>