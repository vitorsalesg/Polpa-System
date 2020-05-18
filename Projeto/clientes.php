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
	<title>Polpa System - Clientes</title>
	<meta charset="utf-8">
	<link rel="icon" type="imagem/png" href="image/icon.png">
	<link rel="stylesheet" type="text/css" href="style/menu_profile.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
	<div class="d-flex" id="wrapper">
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
				<button class="btn btn-secondary" id="menu-toggle">Esconder Menu</button>
			</nav>
			<div class="container-fluid">
				<h1>Lista de clientes
					<?php
						$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						
						if(strpos($fullUrl, "signup=success") == true){
							echo "<i class='fas fa-check-circle' style='color:green' title='Operação realizada com sucesso!'></i>";
						}
						else if(strpos($fullUrl, "signup=erro_user") == true  || strpos($fullUrl, "signup=erro_pedido") == true 
							|| strpos($fullUrl, "signup=erro_liberar") == true  || strpos($fullUrl, "signup=remove") == true){
							echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Operação não realizada!'></i>";
						}
					?>
				</h1>
				<?php
				$sql = "SELECT * FROM cadastro WHERE  id_usuario <> $id";
				$resultado = mysqli_query($connect, $sql);
				if(mysqli_num_rows($resultado) > 0):
					while($dados = mysqli_fetch_array($resultado)):
					?>
					<form action="php_action/operacoesCliente.php" method="POST">
						<input type="hidden" name="id" value="<?php echo $dados['id_usuario']; ?>"> 
						<div class="form-group">
							<label>Nome</label>
							<input type="text" name="nome" readonly class="form-control" value="<?php echo $dados['nome']; ?>">
						</div>
						<div class="form-group">
							<label>Usuario</label>
							<input type="text" name="usuario" readonly class="form-control" value="<?php echo $dados['usuario']; ?>">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" name="email" readonly class="form-control" value="<?php echo $dados['email']; ?>">
						</div>
						<div class="form-group">
							<label>Empresa</label>
							<input type="text" name="empresa" readonly class="form-control" value="<?php echo $dados['empresa']; ?>">
						</div>
						<div class="form-group">
							<label>Telefone</label>
							<input type="text" name="telefone" class="form-control"  readonly  value="<?php echo $dados['telefone']; ?>">
						</div>
						<button type="submit"  name="btn-liberar" class="btn btn-dark">Liberar acesso (Administrador)</button>
						<button type="submit"  name="btn-remove" class="btn btn-danger">Remover acesso ao perfil</button>
						<button type="submit"  name="btn-deletar" class="btn btn-danger">Excluir Cliente</button>
						<br><br>
					</form>
					<?php
						endwhile;
						else: 
					?>
					<input type="text" class="form-control" readonly placeholder="Nenhum cliente cadastrado." >
					<br>
					<?php
						endif;
						}
					?>
		</div>
	</div>
	</div>
	<script src="js/script.js"></script>
	<script src="vendor/jquery/jquery.min.js"></script>
  	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>