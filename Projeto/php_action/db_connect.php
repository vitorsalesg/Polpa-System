<?php
$servername = "localhost";
$username = "root";
$password = "usbw";
$db_name = "polpasystem";

$connect = mysqli_connect($servername, $username, $password, $db_name);
mysqli_set_charset($connect, "utf8");

if(mysqli_connect_error()):
	echo "Erro na conexão: ".mysqli_connect_error();
endif;

session_start();
function verificaLogin(){
	if(!isset($_SESSION["login"])){
		echo"<script>alert('Você não está logado');	
			location.href='login.php';</script>";
	}
}

