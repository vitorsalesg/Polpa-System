<?php
require_once 'db_connect.php';

$id 			= $_POST['id'];
$produto		= $_POST['produto'];
$unidade		= $_POST['unidade'];
$preco			= $_POST['preco'];
$pacote 	    = $_POST['pacote'];
$quantidade		= $_POST['quantidade'];


if(isset($_POST['btn-cadastrar'])){
	$sql = "INSERT INTO estoque (nome, quantidade, preco, unidade) VALUES ('$produto','$quantidade','$pacote','$unidade')";
	if(mysqli_query($connect, $sql)){
		header('location:../estoque.php?signup=success');
	}
	else{
		header('location:../estoque.php?signup=erro_insert');
	}
}


if(isset($_POST['btn-deletar'])):
	$sql = "DELETE FROM estoque WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		header('location:../estoque.php?signup=success');
	else:
		header('location:../estoque.php?signup=erro_delete');
	endif;
endif;


if(isset($_POST['btn-editar'])):
	$sql = "UPDATE estoque SET nome = '$produto', quantidade = '$quantidade',  unidade = '$unidade', preco = '$preco'
	WHERE id = '$id'";

	if(mysqli_query($connect, $sql)):
		header('location:../estoque.php?signup=success');
	else:
		header('location:../estoque.php?signup=erro_update');
	endif;
endif;