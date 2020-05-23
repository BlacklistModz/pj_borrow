<?php 
include("config.php");
include("app/SQLiManager.php");
include("app/fn.php");

$sql = new SQLiManager();

//SET ERROR BY Validator
foreach ($_POST as $key => $value) {

	if( $key == "checkconfirm" ) continue;

	if( $_POST["family_status"] != 2 ){
		if( $key == "spouse_firstname" || $key == "spouse_lastname" || $key == "spouse_mobile" || $key == "spouse_career" || $key == "spouse_children" || $key == "spouse_income" ) continue;
	}

	if( $_POST["address_status"] == 1 ){
		if( $key == "address_hire" ) continue;
	}

	if( $_POST["doc_address"] != 3 ){
		if( $key == "doc_addr_number" || $key == "doc_addr_room" || $key == "doc_addr_soi" || $key == "doc_addr_street" || $key == "doc_addr_district" || $key == "doc_addr_amphur" || $key == "doc_addr_province" || $key == "doc_addr_zipcode" ) continue;
	}

	if( $key == "address_hire" || $key == "work_income_etc" || $key == "work_old_year" ) continue;

	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

//Check ID Card
if( !empty($_POST["idcard"]) ){
	if( !is_numeric($_POST["idcard"]) ){
		$arr["error"]["idcard"] = "กรุณากรอกข้อมูลเป็นตัวเลข 0-9 และห้ามเว้นว่าง";
	}elseif( !checkPID($_POST["idcard"]) ){
		$arr["error"]["idcard"] = "เลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง";
	}
	$sql->table = "customers";
	$sql->condition = "WHERE idcard='{$_POST["idcard"]}'";
	$query = $sql->select();
	if( mysqli_num_rows($query) > 0 ){
		$arr["error"]["idcard"] = "ตรวจสอบพบข้อมูลผู้สมัครในระบบ กรุณาเข้าสู่ระบบผู้ลงทะเบียนเดิม";
		$arr["alert"] = "true";
		$arr["type"] = "error";
		$arr["title"] = "ตรวจพบข้อมูลซ้ำ";
		$arr["text"] = "ตรวจสอบพบเลขบัตรประชาชน {$_POST["idcard"]} ในระบบ";
		$arr["status"] = 422; 
	}
}

if( empty($_POST["checkconfirm"]) && empty($arr["error"]) ){
	$arr["alert"] = "true";
	$arr["type"] = "error";
	$arr["title"] = "กรุณายืนยันข้อมูล";
	$arr["text"] = "กรุณายืนยัน ข้าพเจ้าขอยอมรับว่าข้อมูลที่กรอกเป็นความจริง";
	$arr["status"] = 422; 
}
//

if( !empty($_POST["checkconfirm"]) && empty($arr["error"]) ){
	// CLEAR CONFIRM
	unset($_POST["checkconfirm"]);

	// SET SEX
	$_POST["sex"] = $_POST["prefix_name"] == 1 ? "male" : "female";

	//SET CUSTOMERS
	$field = '';
	$value = '';
	foreach ($_POST as $key => $post) {

		if( $key == "prefix_name" || $key == "first_name" || $key == "last_name" || $key == "birthday" || $key == "idcard" || $key == "idcard_expire" || $key == "sex" ){
			$field .= !empty($field) ? "," : "";
			$field .= $key;

			$value .= !empty($value) ? "," : "";
			$value .= "'{$post}'";

			//clear for borrows
			unset($_POST[$key]);
		}
	}
	//

	$sql->table = "customers";
	$sql->field = $field;
	$sql->value = $value;
	if( $sql->insert() ){
		$_POST["customer_id"] = mysqli_insert_id($sql->connect);
		$_POST["date"] = date("Y-m-d");

		//SET BORROWS
		$field = '';
		$value = '';
		foreach ($_POST as $key => $post) {
			$field .= !empty($field) ? "," : "";
			$field .= $key;

			$value .= !empty($value) ? "," : "";
			$value .= "'{$post}'";
		}

		$sql->table = "borrows";
		$sql->field = $field;
		$sql->value = $value;
		if( $sql->insert() ){
			$arr["type"] = "success";
			$arr["title"] = "บันทึกข้อมูลเรียบร้อยแล้ว";
			$arr["text"] = "ระบบกำลังจะพากลับหน้าหลัก";
			$arr["url"] = URL;
			$arr["status"] = 200;
		}
		else{
			$arr["type"] = "error";
			$arr["title"] = "เกิดข้อผิดพลาด";
			$arr["text"] = "ไม่สามารถเพิ่มข้อมูลใบขอกู้ได้";
			$arr["status"] = 422;
		}
	}
	else{
		$arr["type"] = "error";
		$arr["title"] = "เกิดข้อผิดพลาด";
		$arr["text"] = "ไม่สามารถเพิ่มข้อมูลลูกค้าได้";
		$arr["status"] = 422;
	}
}
echo json_encode($arr);