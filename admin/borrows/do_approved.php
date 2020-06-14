<?php
include("../../config.php");
include("../../app/SQLiManager.php");

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