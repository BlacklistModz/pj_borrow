<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/check_auth.php");

$_POST["staff_id"] = $auth["id"];

$sql = new SQLiManager();

$sql->table = "borrows";
$sql->condition = "WHERE id={$_POST["id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL."admin/borrows/?page=borrows"
	];
	echo json_encode($arr);
	exit;
}

foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( $_POST["status"] == 1 ){
	$_POST["approved_date"] = date('c');
}

if( $_POST["status"] == 2 || $_POST["status"] == 3){
	$_POST["approve_limit"] = 0;
	$_POST["approve_period"] = "";
	$_POST["approved_date"] = "";
}

if( empty($arr["error"]) ){
	$value = '';
	foreach ($_POST as $key => $val) {
		if( $key == "id" ) continue;

		$value .= !empty($value) ? "," : "";
		$value .= "{$key}='{$val}'";
	}

	$sql->table = "borrows";
	$sql->value = $value;
	$sql->condition = "WHERE id={$_POST["id"]}";

	if( $sql->update() ){
		$arr["type"] = "success";
		$arr["title"] = "ปรับปรุงข้อมูลเรียบร้อยแล้ว";
		$arr["url"] = URL."admin/borrows/?page=borrows";
		$arr["status"] = 200;
	}
	else{
		$arr["type"] = "error";
		$arr["title"] = "ไม่สามารถปรับสถานะได้ กรุณาลองใหม่อีกครั้ง";
		// $arr["url"] = URL."admin/borrows/?page=borrows";
		$arr["status"] = 422;
	}
}

echo json_encode($arr);