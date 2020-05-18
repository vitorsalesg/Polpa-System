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
	<title>Polpa System - Trocas Solicitadas</title>
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
				$flag = $_SESSION["flag"];
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
					Trocas
					<?php
						$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						
						if(strpos($fullUrl, "signup=success") == true){
							echo "<i class='fas fa-check-circle' style='color:green' title='Operação realizada com sucesso!'></i>";
						}
						else if(strpos($fullUrl, "signup=erro_update") == true){
							echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Operação não realizada!'></i>";
						}
					?>
				</h1>
				<?php
					$sql = "SELECT DISTINCT id_usuario FROM troca ";
					$resultado = mysqli_query($connect, $sql);

	            	if(mysqli_num_rows($resultado) > 0):
						while($dados = mysqli_fetch_array($resultado)):
							$user     = $dados['id_usuario'];
							$query =  "SELECT DISTINCT nome FROM cadastro WHERE id_usuario = '$user'";
							$res 	  = mysqli_query($connect, $query);
							$dados 	  = mysqli_fetch_array($res)
				?>
				<form  action="troca.php" method="POST">
					<div class="form-group">
						<label>Cliente</label>
						<input type="hidden" readonly value="<?php echo $user?>" name="id_cliente" class="form-control">
						<input type="text" readonly value="<?php echo $dados['nome']?>"  class="form-control"><br>
						<button type="submit" name="btn_status" class="btn btn-dark">Verificar Trocas deste Cliente</button><br><br>
					</div>
				</form>
				<?php
					endwhile;
				else: 
					?>
					<input type="text" class="form-control" readonly placeholder="Não possui nenhuma solicitação de troca no momento" >
					<br>
					<?php
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