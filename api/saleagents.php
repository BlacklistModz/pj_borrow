<?php
include("../config.php");
include("../app/SQLiManager.php");
include("../app/fn.php");

$sql = new SQLiManager();

$data = [];
if( !empty($_GET["id"]) ){
	$sql->table = "saleagents";
	$sql->condition = "WHERE id={$_GET["id"]} LIMIT 1";
	$query = $sql->select();
	$data = mysqli_fetch_assoc($query);
}

echo json_encode($data);