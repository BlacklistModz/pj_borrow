<?php 
//SET ERROR BY Validator
$arr["error"]["firstname"] = "กรุณากรอกชื่อ";
$arr["error"]["lastname"] = "กรุณากรอกนามสกุล";
$arr["error"]["birthday"] = "กรุณาเลือกวัน เดือน ปีเกิด";

//SET ALERT
$arr["alert"] = true;
$arr["type"] = "error";
$arr["title"] = "เกิดข้อผิดพลาด";
$arr["text"] = "กรุณาตรวจสอบข้อมูลให้ครบถ้วน !";
$arr["status"] = 422;

echo json_encode($arr);