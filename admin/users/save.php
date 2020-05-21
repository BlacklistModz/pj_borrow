<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/HashPassword.php");

$sql = new SQLiManager();

/* CHECK ERROR ZONE */
foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( !empty($_POST["password"]) && !empty($_POST["password2"]) ){
	if( $_POST["password"] != $_POST["password2"] ){
		$arr["error"]["password"] = "รหัสผ่านที่กรอกไม่ตรงกัน";
		$arr["error"]["password2"] = "รหัสผ่านที่กรอกไม่ตรงกัน";
	}
}

$sql->table = "users";
$sql->condition = "WHERE username='{$_POST['username']}'";
$query = $sql->select();
if( mysqli_num_rows($query) > 0 ){
	$arr["error"]["username"] = "ตรวจสอบพบ Username ซ้ำในระบบ";
}
/* END CHECK */

//PROCESS ZONE (WITH OUT ERROR)
if( empty($arr["error"]) ){

	/* BUILD SQL COMMAND */
	$field = '';
	$value = '';
	foreach ($_POST as $key => $post) {
		if( $key == "password2" ) continue;

		$field .= !empty($field) ? "," : "";
		$field .= $key;

		$value .= !empty($value) ? "," : "";
		if( $key == "password" ) $post = hashPassword($post);
		$value .= "'{$post}'";
	}
	/* END BUILD */

	$sql->table = "users";
	$sql->field = $field;
	$sql->value = $value;
	if( $sql->insert() ){
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