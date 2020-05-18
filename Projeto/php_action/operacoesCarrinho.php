<?php
include_once 'db_connect.php';

if(count($_SESSION['carrinho']) == 0){
	header('location:../carrinho.php?signup=vazio');
}
else{
	foreach ($_SESSION['dados'] as $produtos) {	
		$nome 	= $produtos['nome'];
		$qtd 	= $produtos['qtd'];
		$total 	= $produtos['total'];
		$user 	= $_SESSION['id_usuario'];
		$recebeQtd = "SELECT quantidade FROM ESTOQUE  WHERE nome = '$nome'";
		$resultado = mysqli_query($connect, $recebeQtd);
		$res 	   = mysqli_fetch_array($resultado);
		$qtd_atual =  $res['quantidade'];
		$qtd_final =  intval($qtd_atual) - intval($qtd);

		if($qtd > $qtd_atual){
			header('location:../carrinho.php?signup=qtd_indisponivel&nome='.$nome.'');
		}else{
			$qry = "UPDATE ESTOQUE SET quantidade = '$qtd_final'  WHERE nome = '$nome'";
			if(mysqli_query($connect, $qry)){
				$sql = "INSERT INTO pedido (nome_pedido, quantidade_pedido, id_usuario, valor_pedido) 
				VALUES ('$nome','$qtd','$user','$total')";
				if(mysqli_query($connect, $sql)){
					header('location:../pedidosCliente.php?signup=success');
					unset($_SESSION['carrinho']);
				}
				else{
					header('location:../carrinho.php?signup=erro_insert');	
				}
			}
			else{
				header('location:../carrinho.php?signup=erro_update');
			}
		}
	}
}