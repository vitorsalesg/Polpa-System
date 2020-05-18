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
	<title>Polpa System - Solicitar Troca</title>
	<meta charset="utf-8">
	<link rel="icon" type="imagem/png" href="image/icon.png">
	<link rel="stylesheet" type="text/css" href="style/menu_profile.css">
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Rubik&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<script type="text/javascript" src="js/script.js" defer></script>
</head>
<body>
	<div class="d-flex" id="wrapper">
		<div class="bg-light border-right" id="sidebar-wrapper">
			<?php
				$id = $_SESSION["id_usuario"];
				$query =  "SELECT imagem FROM cadastro WHERE id_usuario = '$id'";			
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
			<h1>Trocas Solicitadas</h1>
			<table class="table table-alternate">
				<tr>
					<th>Pedido</th>
					<th>Motivo da Troca</th>
					<th>Observação</th>
					<th>Observação do Vendedor</th>
					<th>Telefone</th>
				</tr>
				<?php
					$sql = "SELECT * FROM troca WHERE id_usuario = $id ";
					$resultado = mysqli_query($connect, $sql);
					if(mysqli_num_rows($resultado) > 0):
					while($dados = mysqli_fetch_array($resultado)):
				?>
				<tr>
					<td><?php echo $dados['pedido']; ?></td>
					<td><?php echo $dados['motivo_troca']; ?></td>
					<td><?php echo $dados['observacao']; ?></td>
					<td><?php echo $dados['obs_vendedor']; ?></td>
					<td><?php echo $dados['telefone']; ?></td>
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
					<td>-</td>
				</tr>
				<?php 
					endif;
				?>	
			</table>
			<h1>
				Enviar Solicitação de Troca
				<?php
					$fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
					if(strpos($fullUrl, "signup=success") == true){
						echo "<i class='fas fa-check-circle' style='color:green' title='Operação realizada com sucesso!'></i>";
					}
				?>
			</h1>
			<form action="php_action/operacoesTroca.php"  method="POST">
				<input type="hidden" name="id_usuario" value="<?php echo $id ?>">
				<div class="form-group">
					<label>Selecione o Pedido</label>
					<select class="form-control" name="pedido">
						<option></option>
						<?php
							$query =  "SELECT * FROM pedido WHERE id_usuario = $id";
							$listar = mysqli_query($connect,$query);
							while($dados=mysqli_fetch_array($listar)){
						?>
						<option value="<?php echo $dados['nome_pedido'] ?>">
							<?php echo 'Quantidade e Produto: ' , $dados['quantidade_pedido'] , ' - ' , $dados['nome_pedido'];?> 
						</option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Escreva o motivo da Troca</label>
					<textarea class="form-control" rows="3" required name="motivo_troca" required></textarea>
				</div>
				<div class="row">
					<div class="col">
						<label>Observação</label>
						<input type="text" class="form-control" name="observacao">
					</div>
					<div class="col">
						<label>Telefone para Contato</label>
						<input type="text" class="form-control" required  maxlength="16" title="Por favor preencha no formato solicitado" OnKeyPress="formatar('##-#####-####',this)" placeholder="Ex: 55-11-98888-8888" name="telefone" required>
					</div>
				</div><br>
				<button type="submit" name="btn-enviar" class="btn btn-dark">Enviar</button>
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