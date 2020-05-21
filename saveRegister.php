<?php 
//SET ERROR BY Validator
foreach ($_POST as $key => $value) {
	if( $key == "address" ) continue;
	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

if( $_POST["customRadio6"] == 3 ){
	if( empty($_POST["address"]) ) $arr["error"]["address"] = "กรุณากรอกที่อยู่";
}

//SET ALERT
/* $arr["alert"] = true;
$arr["type"] = "error";
$arr["title"] = "เกิดข้อผิดพลาด";
$arr["text"] = "กรุณาตรวจสอบข้อมูลให้ครบถ้วน !";
$arr["status"] = 422; */

echo json_encode($arr);