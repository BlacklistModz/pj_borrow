<?php
include("../../config.php");
include("../../app/SQLiManager.php");
include("../../app/HashPassword.php");

if( $_POST["password"] != $_POST["password2"] ){
	$arr = [
		"type" => "error",
		"title" => "รหัสผ่านไม่ตรงกัน",
		"status" => 404
	];
	echo json_encode($arr);
	exit;
}

$sql = new SQLiManager();

$sql->table = "users";
$sql->condition = "WHERE username='{$_POST['username']}'";
$query = $sql->select();
if( mysqli_num_rows($query) > 0 ){
	$arr = [
		"type" => "error",
		"title" => "เกิดข้อผิดพลาด",
		"text" => "ตรวจพบชื่อผู้ใช้งาน {$_POST["username"]} ซ้ำในระบบ !",
		"status" => 404
	];
	echo json_encode($arr);
	exit;
}

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
echo json_encode($arr);