<?php
require_once 'db_connect.php';

$id_usuario 		= $_POST['id_usuario'];
$id_troca 			= $_POST['id_troca'];
$pedido				= $_POST['pedido'];
$motivo_troca		= $_POST['motivo_troca'];
$observacao			= $_POST['observacao'];
$telefone 	    	= $_POST['telefone'];
$obs_vendedor 		= $_POST['obs_vendedor'];


if(isset($_POST['btn-enviar'])){
	$sql = "INSERT INTO troca (id_usuario, pedido, 	motivo_troca, observacao, telefone) VALUES ('$id_usuario','$pedido','$motivo_troca','$observacao','$telefone')";
	if(mysqli_query($connect, $sql)){
		header('location:../trocaProdutos.php?signup=success');
	}
	else{
		header('location:../trocaProdutos.php?signup=erro_insert');
	}
}


if(isset($_POST['btn-obs'])){
	$sql = "UPDATE troca SET obs_vendedor = '$obs_vendedor' WHERE id_troca = '$id_troca'";
	
	if(mysqli_query($connect, $sql)){
		header('location:../selectTroca.php?signup=success');
	}
	else{
		header('location:../selectTroca.php?signup=erro_update');
	}
}
