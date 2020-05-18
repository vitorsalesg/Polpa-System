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
	<title>Polpa System - Estoque de produtos</title>
	<meta charset="utf-8">
	<link rel="icon" type="imagem/png" href="image/icon.png">
	<link rel="stylesheet" type="text/css" href="style/menu_profile.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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
			<?php
				}
			?>
			<div class="container-fluid">
				<h1>
					Estoque
					<?php
						$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						
						if(strpos($fullUrl, "signup=success") == true){
							echo "<i class='fas fa-check-circle' style='color:green' title='Operação realizada com sucesso!'></i>";
						}
						else if(strpos($fullUrl, "signup=erro_update") == true  || strpos($fullUrl, "signup=erro_delete") == true
						|| strpos($fullUrl, "signup=erro_insert") == true){
							echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Operação não realizada!'></i>";
						}
					?>
				</h1>
				<?php
					$sql = "SELECT * FROM estoque";
					$resultado = mysqli_query($connect, $sql);
					if(mysqli_num_rows($resultado) > 0):
					while($res = mysqli_fetch_array($resultado)):
				?>
				<form method="POST" action="php_action/operacoesEstoque.php">
					<h4><?php echo $res['nome']?></h4>
					<input type="hidden" name="id" value="<?php echo $res['id']?>">
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" name="produto" title="Nome produto" value="<?php echo $res['nome']?>" >
						</div>
						<div class="col">
							<input type="text" class="form-control" name="unidade" title="Preço unidade" value="<?php echo $res['unidade']?>" >
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col">
							<input type="text" class="form-control" name="preco" title="Preço Total" value="<?php echo $res['preco']?>" >
						</div>
						<div class="col">
							<input type="text" class="form-control" name="quantidade" title="Quantidade Disponivel" value="<?php echo $res['quantidade']?>" >
						</div>
					</div>
					<button type="submit" name="btn-editar" class="btn btn-dark" style="margin-top: 10px;margin-bottom: 10px;">Atualizar</button>
					<button type="submit" name="btn-deletar" class="btn btn-danger" style="margin-top: 10px;margin-bottom: 10px;">Excluir Produto</button>
				</form>
				<?php
					endwhile;
					endif;
				?>
				<h1>Cadastrar Produto</h1>
				<form action="php_action/operacoesEstoque.php"  method="POST">
					<div class="row">
						<div class="col">
							<label>Nome Produto</label>
							<input type="text" name="produto" required class="form-control">
						</div>
						<div class="col">
							<label>Preço da Unidade</label>
							<input type="text" name="unidade" required class="form-control">
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col">
							<label>Preço do Pacote</label>
							<input type="text" name="pacote" required class="form-control">
						</div>
						<div class="col">
							<label>Quantidade</label>
							<input type="text" name="quantidade" required pattern="[0-9]+$" title="Digite apenas numeros" class="form-control">
						</div>
					</div>
					<br>
					<button type="submit" name="btn-cadastrar" class="btn btn-dark">
						Cadastrar
					</button>
					<br><br>				
				</form>
			</div>
		</div>
	</div>
	<script src="js/script.js"></script>
	<script src="vendor/jquery/jquery.min.js"></script>
  	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>