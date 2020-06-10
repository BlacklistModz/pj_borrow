<?php
include("../config.php");
include("../app/SQLiManager.php");
include("../app/fn.php");

$sql = new SQLiManager();

$data = [];
if( !empty($_GET["province"]) ){
	$sql->table = "amphur";
	$sql->condition = "WHERE PROVINCE_ID={$_GET["province"]}";
	$query = $sql->select();
	while($result = mysqli_fetch_assoc($query)){
		$data[] = ["id"=>$result["AMPHUR_ID"], "name"=>$result["AMPHUR_NAME"]];
	}
}

echo json_encode($data);