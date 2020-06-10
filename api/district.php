<?php
include("../config.php");
include("../app/SQLiManager.php");
include("../app/fn.php");

$sql = new SQLiManager();

$data = [];
if( !empty($_GET["amphur"]) ){
	$sql->table = "district";
	$sql->condition = "WHERE AMPHUR_ID={$_GET["amphur"]}";
	$query = $sql->select();
	while($result = mysqli_fetch_assoc($query)){
		$data[] = ["id"=>$result["DISTRICT_ID"], "name"=>$result["DISTRICT_NAME"]];
	}
}

echo json_encode($data);