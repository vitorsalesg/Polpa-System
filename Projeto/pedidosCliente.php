<?php
include_once 'php_action/db_connect.php';
verificaLogin();
if ($_SESSION["flag"] == 1){
	echo "<script>location.href='perfil.php';</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Polpa System - Realizar Pedido</title>
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
				<a href="perfilCliente.php" class="list-group-item list-group-item-action bg-light">Perfil</a>
				<a href="pedidosCliente.php" class="list-group-item list-group-item-action bg-light">Novo Pedido</a>
				<a href="carrinho.php" class="list-group-item list-group-item-action bg-light">Carrinho</a>
				<a href="trocaProdutos.php" class="list-group-item list-group-item-action bg-light">Troca de Produtos</a>
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
					Historico de pedidos
					<?php
						$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						if(strpos($fullUrl, "signup=success") == true){
							echo "<i class='fas fa-check-circle' style='color:green' title='Operação realizada com sucesso!'></i>";
						}
					?>
				</h1>
				<table class="table table-alternate">
					<tr>
						<th>Numero Pedido</th>
						<th>Data Pedido</th>
						<th>Valor</th>
						<th>Situação</th>
						<th>Observação</th>
					</tr>
					<?php
						$id_user = $_SESSION["id_usuario"];
						$sql = "SELECT * FROM pedido WHERE id_usuario = $id_user ";
						$resultado = mysqli_query($connect, $sql);
						if(mysqli_num_rows($resultado) > 0):
						while($dados = mysqli_fetch_array($resultado)):
					?>
						<tr>
							<td><?php echo $dados['id_pedido']; ?></td>
							<td><?php echo $dados['data_pedido']; ?></td>
							<td><?php echo $dados['valor_pedido']; ?></td>
							<td><?php echo $dados['status_pedido']; ?></td>
							<td><?php echo $dados['observacao']; ?></td>
						</tr>
					<?php 
						endwhile;
						else: 
					?>
						<tr>
							<td>-</td>
							<td>-</td>
							<td>-</td>
							<td>-</td>
						</tr>

					<?php 
						endif;
					?>	
				</table>
				<h1>Produtos Disponiveis</h1>
				<table class="table table-alternate">
					<tr>
						<th>Produto</th>
						<th>Quantidade Disponivel</th>
						<th>Preço do Pacote</th>
						<th></th>
					</tr>
					<?php
						$sql = "SELECT * FROM estoque WHERE quantidade > 0";
						$resultado = mysqli_query($connect, $sql);
						if(mysqli_num_rows($resultado) > 0):
						while($dados = mysqli_fetch_array($resultado)):
					?>
					<tr>
						<td><?php echo $dados['nome'];?></td>
						<td><?php echo $dados['quantidade'];?></td>
						<td>R$ <?php echo number_format($dados['preco'], 2, ',', '.').''; ?></td>
						<td>
							<?php echo '<a href="carrinho.php?acao=add&id='.$dados['id'].'">
							<i class="fas fa-plus-square" style="color:black;"></i>
							</a>'; ?>
						</td>
					</tr>
					<?php
						endwhile;
						else: 
					?>
					<tr>
						<td>-</td>
						<td>-</td>
						<td>-</td>
					</tr>
					<?php
						endif;
					?>
				</table>
				<h5 style="text-align: left;font-size: 15px;">Observação: O pacote de cada Polpa de Fruta contém 10 unidades</h5>
			</div>
			<script src="js/script.js"></script>
			<script src="vendor/jquery/jquery.min.js"></script>
			<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>
