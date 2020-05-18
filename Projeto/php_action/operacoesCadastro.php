<?php
require_once 'db_connect.php';
 
$nome 		= $_POST['nome'];
$cpf 		= $_POST['cpf'];
$usuario 	= $_POST['usuario'];
$email  	= $_POST['email'];
$endereco  	= $_POST['endereco'];
$empresa	= $_POST['empresa'];
$telefone	= $_POST['telefone'];
$senha 		= $_POST['senha'];

//imagem
$name 		= $_FILES["img"]["name"];
$temp 		= $_FILES["img"]["tmp_name"];

$consultaEmail = mysqli_query($connect,"SELECT email FROM cadastro WHERE email = '$email'") or die (mysqli_error());
$verificaEmail = mysqli_num_rows($consultaEmail);

$consultaUsuario = mysqli_query($connect,"SELECT usuario FROM cadastro WHERE usuario ='$usuario'") or die (mysqli_error());
$verificaUsuario = mysqli_num_rows($consultaUsuario);

$consultaCpf = mysqli_query($connect,"SELECT cpf FROM cadastro WHERE cpf ='$cpf'") or die (mysqli_error());
$verificaCpf = mysqli_num_rows($consultaCpf);


if ($name == ''){
	$name = 'user.png';
}

if (empty($nome) || empty($cpf) || empty($usuario) || empty($email) || empty($endereco) || empty($empresa)  || empty($telefone)) {
	header('location:../cadastro.php?signup=vazio');
}
else if($verificaEmail == 1){
	header('location:../cadastro.php?signup=email');
}
else if($verificaUsuario == 1){
	header('location:../cadastro.php?signup=user');
}
else if($verificaCpf >= 1){
	header('location:../cadastro.php?signup=cpf');
}
else{
	$senha = sha1($senha);
	if(isset($_POST['cadastrar'])){
		$sql = "INSERT INTO cadastro (nome, cpf, usuario, email, endereco, empresa, telefone, senha, imagem) VALUES ('$nome','$cpf','$usuario','$email', '$endereco', '$empresa', '$telefone', '$senha', '$name')";

		if(mysqli_query($connect, $sql)){
			move_uploaded_file($temp, "../uploads_perfil/".$name);
			header('location:../login.php?signup=success');
		}
		else{
			header('location:../cadastro.php?signup=erro_insert');
		}
	}
}
?>