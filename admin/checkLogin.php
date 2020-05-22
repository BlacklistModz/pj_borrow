<?php
include("../config.php");
include("../app/SQLiManager.php");

foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูล ".strtoupper($key);
}

if( empty($arr["error"]) ){
	$sql = new SQLiManager();

	$sql->table = "users";
	$sql->condition = "WHERE username='{$_POST["username"]}' LIMIT 1";
	$query = $sql->select();

	if( mysqli_num_rows($query) > 0 ){
		$result = mysqli_fetch_assoc($query);
		if( password_verify($_POST["password"], $result["password"]) ){
			session_start();
			$_SESSION["admin"] = $result["id"];

			$arr["type"] = "success";
			$arr["title"] = "เข้าสู่ระบบเรียบร้อย";
			$arr["text"] = "ยินดีต้อนรับ {$result["name"]} เข้าสู่ระบบ";
			$arr["url"] = URL."admin/";
			$arr["status"] = 200;
		}
		else{
			$arr["error"]["password"] = "รหัสผ่านผิดพลาด กรุณาตรวจสอบอีกครั้ง";
		}
	}
	else{
		$arr["error"]["username"] = "ไม่พบชื่อผู้ใช้นี้ในระบบ กรุณาตรวจสอบอีกครั้ง";
	}
}

echo json_encode($arr);