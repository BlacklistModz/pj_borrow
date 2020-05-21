<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/HashPassword.php");

$sql = new SQLiManager();

/* OLD DATA FOR CHECK */
$sql->table = "users";
$sql->condition = "WHERE id={$_POST["id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	$arr = [
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ไม่สามารถเข้าถึงข้อมูลที่ต้องการแก้ไข หรือไม่พบข้อมูล",
		"type" => "error",
		"url" => URL."admin/users/?page=users"
	];
	echo json_encode($arr);
	exit;
}
$old = mysqli_fetch_assoc($query);
/* END OLD DATA */

/* CHECK ERROR ZONE */
foreach ($_POST as $key => $value) {
	if( $key == "id" ) continue;
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

$haschange = true;
if( $old["username"] == $_POST["username"] ) $haschange = false;

$sql->table = "users";
$sql->condition = "WHERE username='{$_POST['username']}'";
$query = $sql->select();
if( mysqli_num_rows($query) > 0 && $haschange ){
	$arr["error"]["username"] = "ตรวจสอบพบ Username ซ้ำในระบบ";
}
/* END CHECK ZONE */
if( empty($arr["error"]) ){
	$value = '';
	foreach ($_POST as $key => $val) {
		if( $key == "id" ) continue;

		$value .= !empty($value) ? "," : "";
		$value .= "{$key}='{$val}'";
	}

	$sql->table = "users";
	$sql->value = $value;
	$sql->condition = "WHERE id={$_POST["id"]}";
	if( $sql->update() ){
	$arr = [
			"type" => "success",
			"title" => "บันทึกข้อมูลเรียบร้อยแล้ว",
			"url" => URL.'admin/users/?page=users',
			"status" => 200
		];
	}
	else{
		$arr = [
			"type" => "error",
			"title" => "ไม่สามารถบันทึกข้อมูลได้",
			"status" => 404
		];
	}
}
echo json_encode($arr);