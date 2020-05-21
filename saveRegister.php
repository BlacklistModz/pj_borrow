<?php 
//SET ERROR BY Validator
foreach ($_POST as $key => $value) {
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

//SET ALERT
$arr["alert"] = true;
$arr["type"] = "error";
$arr["title"] = "เกิดข้อผิดพลาด";
$arr["text"] = "กรุณาตรวจสอบข้อมูลให้ครบถ้วน !";
$arr["status"] = 422;

echo json_encode($arr);