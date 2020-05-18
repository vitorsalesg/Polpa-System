<?php
// Conexão
require_once 'db_connect.php';

if(isset($_POST['btn'])){
	$nome          = mysqli_escape_string($connect, $_POST['nome']);
	$cpf           = mysqli_escape_string($connect, $_POST['cpf']);
	$usuario       = mysqli_escape_string($connect, $_POST['usuario']);
	$email   	   = mysqli_escape_string($connect, $_POST['email']);
	$endereco      = mysqli_escape_string($connect, $_POST['endereco']);
	$empresa   	   = mysqli_escape_string($connect, $_POST['empresa']);
	$telefone      = mysqli_escape_string($connect, $_POST['telefone']);
	$id 		   = mysqli_escape_string($connect, $_POST['id']);
	$flag 		   = mysqli_escape_string($connect, $_POST['flag']);
	$name 		= $_FILES["img"]["name"];
	$temp 		= $_FILES["img"]["tmp_name"];
	$senha 		 				    = $_POST['senha'];
	$confirmaSenha 		   			= $_POST['confirmaSenha'];
	$confirmaSenha		   			= sha1($confirmaSenha);


	$qry =  "SELECT imagem,senha FROM cadastro WHERE id_usuario = '$id'";			
	$list = mysqli_query($connect,$qry);
	$dados=mysqli_fetch_array($list);
	$imageAtual = $dados['imagem'];
	$senhaAtual = $dados['senha'];

	if ($name == '' and $imageAtual == ''){
		$name = 'user.png';
	}
	else if ($name == '' and  $imageAtual <> ''){
		$name = $imageAtual;	
	}

	if ($senha <> $senhaAtual){
		$senha = sha1($senha);
	}
		
	if (empty($nome) || empty($cpf) || empty($usuario) || empty($email) || empty($endereco) || empty($empresa)  || empty($telefone)) {
		if ($flag == 0){
			header('location:../perfilCliente.php?signup=vazio');
		}
		else{
			header('location:../perfil.php?signup=vazio');
		}
	}
	else if($senhaAtual == $confirmaSenha){
		$sql = "UPDATE cadastro SET nome = '$nome', cpf = '$cpf', usuario =  '$usuario', email =  '$email', 
		endereco =  '$endereco', empresa =  '$empresa', telefone =  '$telefone' , senha =  '$senha' , imagem = '$name'
		WHERE id_usuario = '$id'";

		if(mysqli_query($connect, $sql)){
			move_uploaded_file($temp, "../uploads_perfil/".$name);
			if ($flag == 0){
				header('location:../perfilCliente.php?signup=success');
			}
			else{
				header('location:../perfil.php?signup=success');
			}
		}
	}
	else{
		if ($flag == 0){
			header('location:../perfilCliente.php?signup=senhaincorreta');
		}
		else{
			header('location:../perfil.php?signup=senhaincorreta');
		}
	}
}