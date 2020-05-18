<?php
require_once 'db_connect.php';
if(isset($_POST['btn_status'])){
	$observacao 		   = mysqli_escape_string($connect, $_POST['observacao']);
	$status 			   = mysqli_escape_string($connect, $_POST['status']);
	$id 			       = mysqli_escape_string($connect, $_POST['id_pedido']);
	
	$sql = "UPDATE pedido SET observacao = '$observacao', status_pedido = '$status' 
			WHERE id_pedido = '$id'";
	
	if(mysqli_query($connect, $sql)){
		header('location:../pedidos.php?signup=success');
	}
	else{
		header('location:../estoque.php?signup=erro_update');
	}
}