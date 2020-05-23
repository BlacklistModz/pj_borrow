<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/fn.php");

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

foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( $_POST["action"] == "profile" ){
	if( !empty($_POST["name"]) ){
		if( checkStr($_POST["name"]) < 5 ) $arr["error"]["name"] = "ความยาวของ ชื่อ-นามสกุล ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";
		if( !checkEngThai($_POST["name"]) ) $arr["error"]["name"] = "ชื่อ-นามสกุล ต้องเป็นตัวอักษรภาษาไทย หรือ ภาษาอังกฤษ เท่านั้น";
	}

	if( !empty($_POST["username"]) ){
		if( checkStr($_POST["username"]) < 5 ) $arr["error"]["username"] = "ความยาวของ Username ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";
		if( !checkEngNum($_POST["username"]) ) $arr["error"]["username"] = "ต้องเป็นตัวเลข 0-9 หรือ A-Z หรือ a-z เท่านั้น";
	}

	$haschange = true;
	if( $old["username"] == $_POST["username"] ) $haschange = false;

	$sql->table = "users";
	$sql->condition = "WHERE username='{$_POST['username']}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 && $haschange ){
		$arr["error"]["username"] = "ตรวจสอบพบ Username ซ้ำในระบบ";
	}

	$title = "แก้ไขข้อมูลเรียบร้อยแล้ว";
	$redirect = "index.php";
}
if( $_POST["action"] == "password" ){
	if( !empty($_POST["password"]) && !empty($_POST["password2"]) ){
		if( checkStr($_POST["password"]) < 5 ) $arr["error"]["password"] = "ความยาวของ Password ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";
		if( checkStr($_POST["password2"]) < 5 ) $arr["error"]["password2"] = "ความยาวของ Confim Password ต้องมีตั้งแต่ 5 ตัวอักษรขึ้นไป";

		if( $_POST["password"] != $_POST["password2"] ){
			$arr["error"]["password"] = "รหัสผ่านที่กรอกไม่ตรงกัน";
			$arr["error"]["password2"] = "รหัสผ่านที่กรอกไม่ตรงกัน";
		}
	}

	$title = "เปลี่ยนรหัสผ่านเรียบร้อยแล้ว";
	$redirect = "password.php";
}

/* END CHECK ZONE */
if( empty($arr["error"]) ){
	$value = '';
	foreach ($_POST as $key => $val) {
		if( $key == "id" || $key == "password2" || $key == "action" ) continue;

		$value .= !empty($value) ? "," : "";
		if( $key == "password" ) $val = hashPassword($val);
		$value .= "{$key}='{$val}'";
	}

	$sql->table = "users";
	$sql->value = $value;
	$sql->condition = "WHERE id={$_POST["id"]}";
	if( $sql->update() ){
	$arr = [
			"type" => "success",
			"title" => $title,
			"url" => URL.'admin/profile/'.$redirect,
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