<?php
include("../../config.php");
include("../../app/SQLiManager.php");

$sql = new SQLiManager();

//CHECK DATA BEFORE DELETE
$sql->table = "saleagents";
$sql->condition = "WHERE id={$_GET["id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) < 0 ){
	$arr["type"] = "error";
	$arr["title"] = "ไม่พบข้อมูลที่ต้องการลบ";
	$arr["status"] = 422;
}
else{
	$sql->table = "borrows";
	$sql->field = "*";
	$sql->condition = "WHERE saleagents_id={$_GET["id"]}";
	if( $sql->countRow() <= 0 ){
		if( $sql->delete() ){
			$arr["type"] = "success";
			$arr["title"] = "ลบข้อมูลเรียบร้อยแล้ว";
			$arr["url"] = "refresh";
			$arr["status"] = 200;
		}
		else{
			$arr["type"] = "error";
			$arr["title"] = "ไม่สามารถลบข้อมูลได้";
			$arr["status"] = 422;
		}
	}
	else{
		$arr["type"] = "error";
		$arr["title"] = "ไม่สามารถลบข้อมูลได้";
		$arr["text"] = "เนื่องจากข้อมูลนี้ถูกใช้กับข้อมูลใบสมัครสินเชื่อ";
		$arr["status"] = 422;
	}
}
echo json_encode($arr);