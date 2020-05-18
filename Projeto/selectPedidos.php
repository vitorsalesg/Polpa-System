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
	<title>Polpa System - Pedido</title>
	<meta charset="utf-8">
	<link rel="icon" type="imagem/png" href="image/icon.png">
	<link rel="stylesheet" type="text/css" href="style/menu_profile.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
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
				<h1>Pedidos do Cliente Selecionado</h1>
				<?php
					$id_cliente = $_POST['id_cliente'];
					$sql = "SELECT * FROM pedido WHERE status_pedido <> 'Pedido Finalizado' AND id_usuario <> $id  AND id_usuario = $id_cliente ORDER BY id_pedido";
					$resultado = mysqli_query($connect, $sql);
	            	if(mysqli_num_rows($resultado) > 0):
						while($dados = mysqli_fetch_array($resultado)):
							$user     = $dados['id_usuario'];
							$query =  "SELECT * FROM cadastro WHERE id_usuario = '$user'";
							$res 	  = mysqli_query($connect, $query);
							$nome 	  = mysqli_fetch_array($res)
				?>
				<form  action="php_action/operacoesPedido.php" method="POST">
					<h3><?php echo $dados['id_pedido']; ?> - Pedido </h3>
					<input type="hidden" name = "id_pedido"  value="<?php echo $dados['id_pedido']; ?>" >
					<div class="form-group">
						<label>Cliente / Empresa</label>
						<input type="text" readonly value="<?php echo $nome['nome']; echo '  -  '. $nome['empresa'];  ?>"  class="form-control">
					</div>
					<div class="form-group">
						<label>Data do pedido</label>
						<input type="text" readonly value="<?php echo $dados['data_pedido']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Valor do pedido</label>
						<input type="text" readonly value="<?php echo $dados['valor_pedido']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Quantidade / Pedido</label>
						<input type="text" readonly="" value="<?php echo $dados['quantidade_pedido'] . ' - ' .  $dados['nome_pedido']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<label>Status do Pedido</label>
						<select class="form-control" name="status">
							<option>
								<?php echo $dados['status_pedido']; ?>
							</option>
							
							<option value="Verificando pedido">
							    Verificando pedido
							</option>
							<option value="Aguardando pagamento">  
								Aguardando pagamento
							</option>
							<option value="Preparando produto">
							    Preparando produto
							</option>
							<option value="Saiu para entrega">	
							   Saiu para entrega
							</option>
							<option value="Pedido Finalizado">
							     Pedido Finalizado
							 </option>
						</select>
					</div>
					<div class="form-group">
						<label>Observação sobre o pedido</label>
						<input type="text" name="observacao"  value="<?php echo $dados['observacao']; ?>" class="form-control">
					</div>
					<button type="submit" name="btn_status" class="btn btn-dark">Enviar</button>
					<a href="pedidos.php" class="btn btn-dark">Voltar</a><br><br>
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