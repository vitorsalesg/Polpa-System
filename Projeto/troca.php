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
	<title>Polpa System - Troca</title>
	<meta charset="utf-8">
	<link rel="icon" type="imagem/png" href="image/icon.png">
	<link rel="stylesheet" type="text/css" href="style/menu_profile.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
</head>
<body>
	<div class="d-flex" id="wrapper">
		<div class="bg-light border-right" id="sidebar-wrapper">
			<?php
				$id = $_SESSION["id_usuario"];
				$query =  "SELECT imagem FROM cadastro WHERE id_usuario = '$id'";			
				$listar = mysqli_query($connect,$query);
				while($dados=mysqli_fetch_array($listar)){
					$num =$dados['telefone'];
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
				<h1>Solicitações de troca</h1>
				<?php
					$id = $_POST['id_cliente'];
					$sql = "SELECT * FROM TROCA WHERE id_usuario = '$id'";
					$resultado = mysqli_query($connect, $sql);
	            	if(mysqli_num_rows($resultado) > 0):
						while($dados = mysqli_fetch_array($resultado)):
				?>
				<form action="php_action/operacoesTroca.php" method="POST">
					<input type="hidden" name="id_troca" value="<?php echo $dados['id_troca']; ?>" >
					<div class="form-group">
						<label>Pedido</label>
						<input type="text" class="form-control" value="<?php echo $dados['pedido']; ?>" readonly>
					</div>
					<div class="form-group">
						<label>Motivo da Troca</label>
						<input type="text" class="form-control" style="height: 100px;" value="<?php echo $dados['motivo_troca']; ?>" readonly>
					</div>
					<div class="row">
						<div class="col">
							<label>Observação</label>
							<input type="text" class="form-control" value="<?php echo $dados['observacao']; ?>" readonly>
						</div>
						<div class="col">
							<label>Telefone para Contato</label>
							<input type="text" class="form-control" value="<?php echo $dados['telefone']; ?>" readonly >
						</div>
					</div><br>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="obs_vendedor" placeholder="Descrição para o cliente" value="<?php echo $dados['obs_vendedor'];?>">
						<div class="input-group-append">
							<button type="submit" name="btn-obs" class="btn btn-dark">
								Enviar Observação
							</button>
						</div>
					</div>
					<a href="https://api.whatsapp.com/send?phone='<?php echo $num; ?>'&text=Ola, Sou o Paulo da Deja Alimentos." class="float" target="_blank">
						<i class="fa fa-whatsapp my-float" title="Realizar Contato com Cliente"></i>
					</a>				
				</form>
				<?php 
					endwhile;
					endif;
				?>
			</div>
		</div>
	</div>
	<script src="js/script.js"></script>
	<script src="vendor/jquery/jquery.min.js"></script>
  	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>