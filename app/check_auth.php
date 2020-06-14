<?php
ob_start();
session_start();

$sql = new SQLiManager(); //ONLY AUTH
if( !empty($_SESSION["admin"]) ){
	$sql->table = "users";
	$sql->field = "name, username, id";
	$sql->condition = "WHERE id={$_SESSION["admin"]}";
	$rsAuth = $sql->select();
}

if( !empty($_SESSION["users"]) ){
	$sql->table="customers";
	$sql->condition="WHERE id={$_SESSION["users"]}";
	$rsAuth = $sql->select();
}

if( !empty($rsAuth) ){
	if( mysqli_num_rows($rsAuth) <= 0 ){
		session_destroy();
		ob_clean();

		header("location:".URL);
	}
	else{
		$auth = mysqli_fetch_assoc($rsAuth);
	}
}