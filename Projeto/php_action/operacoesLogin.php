<?php
include 'db_connect.php';

$usuario = $_POST ['usuario'];
$senha   = $_POST ['senha'];
$senha   = sha1($senha);

$query = "SELECT usuario, senha,id_usuario,flag FROM cadastro
WHERE usuario = '$usuario' AND senha='$senha'";

$logar  = mysqli_query($connect,$query);
$linhas = mysqli_num_rows($logar);
$dado   = mysqli_fetch_array($logar);

if($linhas == 1){
	session_start();
	$_SESSION["login"]      = $dado["usuario"];
	$_SESSION["id_usuario"] = $dado["id_usuario"];
	$_SESSION["flag"]       = $dado["flag"];

	//fazer a flag para definir o tipo de usuario
	if($dado['flag'] == 1)
	{
		header('location:../perfil.php');
	}
	else
	{
		header('location:../perfilCliente.php');
	}
}else{
	header('location:../login.php?signup=incorreto');
}	
?>

