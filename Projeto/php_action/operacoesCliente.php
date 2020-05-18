<?php
require_once 'db_connect.php';

$id = mysqli_escape_string($connect, $_POST['id']);
if(isset($_POST['btn-deletar'])):
	$apagaPedidos = "DELETE FROM pedido WHERE id_usuario = '$id'";

	if(mysqli_query($connect, $apagaPedidos)):
		$apagaUser = "DELETE FROM cadastro WHERE id_usuario = '$id'";		
		if(mysqli_query($connect, $apagaUser)){
			header('location:../clientes.php?signup=success');
		}
		else{
			header('location:../clientes.php?signup=erro_user');
		}
	else:
		header('location:../clientes.php?signup=erro_pedido');
	endif;
endif;

if(isset($_POST['btn-liberar'])):
	$qry = "UPDATE CADASTRO SET FLAG = 1 WHERE id_usuario = '$id'";

	if(mysqli_query($connect, $qry)):
		header('location:../clientes.php?signup=success');
	else:
		header('location:../clientes.php?signup=erro_liberar');
	endif;
endif;


if(isset($_POST['btn-remove'])):
	$qry = "UPDATE CADASTRO SET FLAG = 0 WHERE id_usuario = '$id'";

	if(mysqli_query($connect, $qry)):
		header('location:../clientes.php?signup=success');
	else:
		header('location:../clientes.php?signup=remove');
	endif;
endif;
