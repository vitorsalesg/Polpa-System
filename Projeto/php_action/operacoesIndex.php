<?php
require_once 'db_connect.php';
function clear($input) {
	global $connect;
	// sql
	$var = mysqli_escape_string($connect, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

if(isset($_POST['enviar'])):
	$nome 		= clear($_POST['nome']);
	$email 		= clear($_POST['email']);
	$assunto 	= clear($_POST['assunto']);
	$comentario = clear($_POST['comentario']);


	if(empty($nome) or empty($email) or empty($assunto) or empty($comentario) ) {
		header('location:../index.php?signup=vazio&#contato');
	}
	else{
		$sql = "INSERT INTO contato (nome, email, assunto, comentario)
		VALUES ('$nome', '$email', '$assunto', '$comentario')";

		if(mysqli_query($connect, $sql)){
			header('location:../index.php?signup=success&#contato');
		}
		else{
			header('location:../index.php?signup=erro_insert&#contato');
		}
	}
endif;

	