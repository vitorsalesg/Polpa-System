<?php
	session_start();
	$_SESSION['login'];
	session_destroy();

	header("location:../index.php");
	exit;
?>