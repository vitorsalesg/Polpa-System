<?php
  include_once 'php_action/db_connect.php';
  verificaLogin();

  if ($_SESSION["flag"] == 1){
    echo "<script>location.href='perfil.php';</script>";
  }

  if(!isset($_SESSION['carrinho'])){
	$_SESSION['carrinho'] = array();
  } //adiciona produto

  if(isset($_GET['acao'])){
    //ADICIONAR CARRINHO
  	if($_GET['acao'] == 'add'){
  		$id = intval($_GET['id']);
  		if(!isset($_SESSION['carrinho'][$id])){
  			$_SESSION['carrinho'][$id] = 1;
  		} else {
  			$_SESSION['carrinho'][$id] += 1;
  		}
    }
    
    //REMOVER CARRINHO
    if($_GET['acao'] == 'del'){
    	$id = intval($_GET['id']);
    	if(isset($_SESSION['carrinho'][$id])){
    		unset($_SESSION['carrinho'][$id]);
    	}
    }
    //ALTERAR QUANTIDADE
    if($_GET['acao'] == 'up'){
    	if(is_array($_POST['prod'])){
    		foreach($_POST['prod'] as $id => $qtd){
    			$id  = intval($id);
    			$qtd = intval($qtd);
    			if(!empty($qtd) || $qtd <> 0){
    				$_SESSION['carrinho'][$id] = $qtd;
    			}else{
    				unset($_SESSION['carrinho'][$id]);
    			}
    		}
    	}
    }
    if(count($_SESSION['carrinho']) == 0){
    	header('location:carrinho.php?signup=vazio');
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Polpa System - Carrinho de compras</title>
  <meta charset="utf-8">
  <link rel="icon" type="imagem/png" href="image/icon.png">
	<link rel="stylesheet" type="text/css" href="style/menu_profile.css">
	<link rel="stylesheet" type="text/css" href="style/carrinho.css">
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
          <h1>Carrinho de Compras 
            <i class="fas fa-file-invoice-dollar" style="color:black;" onclick="myFunction()" title="Formas de Pagamento"></i>
              <?php
                $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

                if(strpos($fullUrl, "signup=vazio") == true){
                  echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Seu carrinho de compras esta vazio !'></i>";
                }
                else if(strpos($fullUrl, "signup=erro_insert") == true || strpos($fullUrl, "signup=erro_update") == true){
                  echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Operação não realizada!'></i>";
                }
                else if(strpos($fullUrl, "signup=qtd_indisponivel") == true){
                  $polpa = $_GET['nome'];
                  echo "<i class='fas fa-exclamation-circle erro' style='color:red' title='Quantidade de Polpa escolhida indisponivel! $polpa'></i>";
                }
              ?>      
          </h1>
          <table class="table table-alternate">
            <tr>
              <th>PRODUTO</th>
              <th>QUANTIDADE</th>
              <th>PREÇO</th>
              <th>SUBTOTAL</th>
              <th>REMOVER</th>
            </tr>
            <form action="?acao=up" method="post">
              <a href="https://api.whatsapp.com/send?phone='5511948931505'&text=Ola, Fiquei com duvida na hora de realizar a compra. Poderia me ajudar ..." class="float" target="_blank">
                <i class="fa fa-whatsapp my-float" title="Ficou com Duvida? Entre em contato com vendedor!"></i>
              </a>  
              <tbody>
                <?php
                if(count($_SESSION['carrinho']) == 0){
                  echo '
                  <tr>
                  <td colspan="5">Não há produto no carrinho</td>
                  </tr>';
                }
                else{
                  $total = 0;
                  $_SESSION['dados'] = array();
                  foreach($_SESSION['carrinho'] as $id => $qtd){
                    $query =  "SELECT * FROM estoque WHERE id= '$id'";
                    $listar = mysqli_query($connect,$query);
                    $dados = mysqli_fetch_array($listar);

                    $nome  = $dados['nome'];
                    $preco = number_format($dados['preco'], 2, ',', '.');
                    $sub   = number_format($dados['preco'] * $qtd, 2, ',', '.');
                    $total += $dados['preco'] * $qtd;

                    echo '
                    <tr>
                    <td>'.$nome.'</td>
                    <td>
                    <input type="text" size="1"  class="form-control" name="prod['.$id.']" value="'.$qtd. '" />
                    </td>
                    <td>R$ '.$preco.'</td>
                    <td>R$ '.$sub.'</td>
                    <td>
                    <a href="?acao=del&id='.$id.'">
                    <i class="fas fa-window-close" style="color:black;">
                    </i></a></td>
                    </tr>';
                    $total = number_format($total, 2, ',', '.');
                    array_push($_SESSION['dados'], array(
                      'nome' => $nome,
                      'qtd' => $qtd,
                      'total' => $total,

                    ));
                  }
                  echo '<tr>
                  <td colspan="4">Total</td>
                  <td>R$ '.$total.'</td>
                  </tr>';

                }
                ?>
                <tr>
                  <td colspan="5">
                    <button type="submit" class="btn btn-success">
                      Atualizar Carrinho
                    </button>
                    <a href="php_action/operacoesCarrinho.php">
                      <button type="button" class="btn btn-success">
                        Finalizar Pedido
                      </button>
                    </a>
                    <a href="pedidosCliente.php">
                      <button type="button" class="btn btn-dark">
                      Continuar Comprando
                      </button>
                    </a>
                  </td>
                </tr>
              </table>
              <dialog id="myDialog" class="myDialog">
                  <i class="fas fa-window-close" onclick="location.reload();"></i>
                  <h1>
                    Formas de Pagamento
                  </h1>
                  <h3>
                    <i class="fas fa-file-invoice-dollar pay" style='color: black;' title="Boleto Bancario"></i>
                    <i class="fab fa-cc-visa pay" id="indiponivel" title="Cartão de Credito (VISA)"></i>
                    <i class="fab fa-cc-mastercard pay" id="indiponivel" title="Cartão de Credito (MASTERCARD)"></i>
                  </h3>
                  <p>
                    No momento estamos disponibilizando apenas o pagamento por boleto bancario. O boleto vai junto com seu pedido com um prazo de pagamento de ate 5 dias uteis. Ou se prefirir o valor pode ser pago no ato da entrega onde estara acompanhando a nota do pedido.
                  </p>
                  <h5>
                    Obs: Estamos trabalhando para liberar todas as formas de pagamento.
                  </h5>
              <dialog>
              <script>
                  function myFunction() {
                    document.getElementById("myDialog").showModal();
                  }
                  function close(){
                    location.reload();
                  }

              </script>
              <h5>Observação: O pacote de cada Polpa de Fruta contém 10 unidades</h5>
      <script src="js/script.js"></script>
      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>

