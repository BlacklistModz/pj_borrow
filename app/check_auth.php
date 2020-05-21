<?php
ob_start();
session_start();
if( !empty($_SESSION["admin"]) ){
	$sql->table="users";
	$sql->condition="WHERE id={$_SESSION["admin"]}";
	$query = $sql->select();
}

if( !empty($_SESSION["users"]) ){
	$sql->table="customers";
	$sql->condition="WHERE id={$_SESSION["users"]}";
	$query = $sql->select();
}

if( !empty($query) ){
	if( mysqli_num_rows($query) <= 0 ){
		session_destroy();
		ob_clean();
	}
	else{
		$_userData = mysqli_fetch_assoc($query);
	}
}