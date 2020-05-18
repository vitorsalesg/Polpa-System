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
		<title>Polpa System - Cadastro</title>
		<meta charset="utf-8">
		<link rel="icon" href="image/icon.png">
		<link rel="stylesheet" type="text/css" href="style/cadastro.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	</head>
	<body>
		<div class="login-box">
			<h1>
				Cadastro 
				<a href="index.php"><i class="fas fa-undo"></i></a>
				<?php
				$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				if(strpos($fullUrl, "signup=vazio") == true){
					echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Por favor preencha todos os campos!'></i>";
				}
				else if(strpos($fullUrl, "signup=cpf") == true){
					echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Este CPF ja consta em nossa base de dados! '></i>";
				}
				else if(strpos($fullUrl, "signup=user") == true){
					echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Este USUARIO ja consta em nossa base de dados! '></i>";
				}
				else if(strpos($fullUrl, "signup=email") == true){
					echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Este EMAIL ja consta em nossa base de dados! '></i>";
				}
				else if(strpos($fullUrl, "signup=erro_insert") == true){
					echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Operação não realizada! '></i>";
				}
				?>
			</h1>
			<form action="php_action/operacoesCadastro.php" method="POST" enctype="multipart/form-data">
				<div class="textbox">
					<i class="fas fa-user" aria-hidden="true"></i>
					<input type="text" placeholder="Nome completo" name="nome"  minlength="15" title="Nome Completo" required> 
				</div>
				<div class="textbox">
					<i class="fas fa-address-card"></i>
					<input type="text" placeholder="CPF" name="cpf" maxlength="14"   title="(CPF) Digite apenas numeros" 
					OnKeyPress="formatar('###.###.###-##',this)" style="width: 50%;" required> 
					<input type="text" placeholder="Usuario" name="usuario" title="Usuario" style="width: 30%;" maxlength="15" required>
				</div>
				<div class="textbox">
					<i class="fas fa-user" aria-hidden="true"></i>
					<input type="email" placeholder="Email" name="email" title="Email" style="width: 50%;" required>
					<input type="text" placeholder="Telefone" name="telefone" title="Telefone"  maxlength="13" OnKeyPress="formatar('##-#####-####',this)" style="width: 30%;" required>
				</div>
				<div class="textbox">
					<i class="fas fa-home"></i>
					<input type="text" placeholder="Endereço Completo (Rua-N°-Bairro-Cidade)" title="Endereço Completo" name="endereco" required>
				</div>
				<div class="textbox">
					<i class="fas fa-building"></i>
					<input type="text" placeholder="Nome da empresa ou loja" name="empresa" title="Empresa" required>
				</div>
				<div class="textbox">
					<i class="fas fa-lock" aria-hidden="true"></i>
					<input type="password" placeholder="Digite sua Senha" name="senha" title="Senha" required>
				</div>
				<div class="textbox">
					<i class="fas fa-portrait"></i>
					<input type="file" name="img">
				</div>
				<input type="submit" class="btn btn-cadastrar button"  value="Cadastrar" name="cadastrar">
			</div>
		</form>
		<script src="js/cadastro.js" ></script>
	</body>
</html>