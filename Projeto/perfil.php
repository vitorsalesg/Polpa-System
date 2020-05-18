<?php
include_once 'php_action/db_connect.php';
verificaLogin();
if ($_SESSION["flag"] == 0){
	echo "<script>location.href='perfilCliente.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Polpa System - Perfil de Administrador</title>
	<meta charset="utf-8">
	<link rel="icon" type="imagem/png" href="image/icon.png">
	<link rel="stylesheet" type="text/css" href="style/menu_profile.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
</head>
<body >
	<div class="d-flex" id="wrapper" >
		<div class="bg-light border-right" id="sidebar-wrapper">
			<?php
				$id = $_SESSION["id_usuario"];
				$query =  "SELECT * FROM cadastro WHERE id_usuario = '$id'";			
				$listar = mysqli_query($connect,$query);
				while($dados=mysqli_fetch_array($listar)){
			?>
			<div class="sidebar-heading">
				<img class="image" src="uploads_perfil/<?php echo $dados['imagem'];?>">
			</div>
			<div class="list-group list-group-flush">
				<a href="perfil.php" class="list-group-item list-group-item-action bg-light">Perfil</a>
				<a href="clientes.php" class="list-group-item list-group-item-action bg-light">Clientes</a>
				<a href="estoque.php" class="list-group-item list-group-item-action bg-light">Estoque</a>
				<a href="pedidos.php" class="list-group-item list-group-item-action bg-light">Pedidos dos Clientes</a>
				<a href="selectTroca.php" class="list-group-item list-group-item-action bg-light">Solicitações de Troca</a>
				<a href="php_action/sair.php" class="list-group-item list-group-item-action bg-light">Sair</a>
			</div>
		</div>
		<div id="page-content-wrapper">
			<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
				<p id="res"></p>
				<p id="name"><?php echo $dados['nome']?></p>
				<button class="btn btn-secondary" id="menu-toggle">Esconder Menu</button>
			</nav>
			<div class="container-fluid">
				<h1>
					Dados Pessoais e Mensagens
					<?php
						$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";	
						if(strpos($fullUrl, "signup=success") == true){
							echo "<i class='fas fa-check-circle' style='color:green' title='Operação realizada com sucesso!'></i>";
						}
						else if(strpos($fullUrl, "signup=vazio") == true){
							echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Por favor preencha todos os campos'></i>";
						}
						else if(strpos($fullUrl, "signup=senhaincorreta") == true){
							echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Senhas estão diferentes, por favor tente novamente! '></i>";
						}
					?>
				</h1>
				<form action="php_action/operacoesPerfil.php" method="POST" enctype="multipart/form-data"> 
					<input type="hidden" name="id"  value="<?php echo $dados['id_usuario']?>">
					<input type="hidden" name="flag"	value="<?php echo $dados['flag']?>" > 
					<div class="form-group">
						<label>Nome</label>
						<input type="text" name="nome" required class="form-control" value="<?php echo $dados['nome']; ?>">
					</div>
					<div class="form-group">
						<label>Usuario</label>
						<input type="text" name="usuario" required class="form-control" value="<?php echo $dados['usuario']; ?>">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" value="<?php echo $dados['email']; ?>" required class="form-control">
					</div>
					<div class="form-group">
						<label>Telefone</label>
						<input type="text" name="telefone" class="form-control"  required maxlength="13" OnKeyPress="formatar('##-#####-####',this)" value="<?php echo $dados['telefone']; ?>">
					</div>
					<div class="form-group">
						<label>CPF</label>
						<input type="text" name="cpf" required  class="form-control"  OnKeyPress="formatar('###.###.###-##',this)" maxlength="15" value="<?php echo $dados['cpf']; ?>">
					</div>
					<div class="form-group">
						<label>Endereço</label>
						<input type="text" name="endereco" required class="form-control" value="<?php echo $dados['endereco']; ?>">
					</div>
					<div class="form-group">
						<label>Empresa</label>
						<input type="text" name="empresa" required class="form-control" value="<?php echo $dados['empresa']; ?>">
					</div>
					<div class="form-group">
						<label>Alterar foto de perfil</label>
						<input type="file" class="form-control-file" name="img">
					</div>
					<div class="form-group">
						<label>Senha</label>
						<input type="password" name="senha"  placeholder="Digite sua nova senha" class="form-control" value="<?php echo $dados['senha']; ?>">
					</div>
					<div class="form-group">
						<label>Confirmar Senha</label>
						<input type="password" name="confirmaSenha" placeholder="Digite sua senha atual" class="form-control" required>
					</div>					
					<button type="submit" name="btn" class="btn btn-dark">
						Atualizar Informações
					</button>
					<?php
						}
					?>
				</form>
				<h1>
					Mensagens de Contato dos Clientes
				</h1>
				<?php
					$sql = "SELECT * FROM contato";
					$resultado = mysqli_query($connect, $sql);
					if(mysqli_num_rows($resultado) > 0):
					while($dados = mysqli_fetch_array($resultado)):
				?>				
				<h3>
					<?php echo $dados['nome'];?>
				</h3>
				<div class="form-group">
					<label>Nome e data mensagem</label>
					<input type="text"  name = "nome" class="form-control" value="<?php echo $dados['nome']; echo '  -  '. $dados['data'];  ?>" readonly>
				</div>
				<div class="form-group">
					<label>Comentario</label>
					<input type="text"  name = "comentario" class="form-control" readonly value="<?php echo $dados['comentario']; ?>">
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="text"  name = "email" class="form-control" readonly value="<?php echo $dados['email']; ?>">
				</div>
				<?php
					endwhile;
					else: 
				?>
					<input type="text" class="form-control" readonly placeholder="Não possui mensagens de contato no momento" >
					<br>
				<?php
					endif;
				?>
			</div>
		</div>
	</div>
	<script src="js/perfil.js"></script>
	<script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>