<?php 
include("config.php");
include("app/SQLiManager.php");
include("app/fn.php");

$sql = new SQLiManager();

//SET ERROR BY Validator
foreach ($_POST as $key => $value) {

	if( $key == "checkconfirm" ) continue;

	if( $_POST["family_status"] != 2 ){
		if( $key == "spouse_firstname" || $key == "spouse_lastname" || $key == "spouse_mobile" ) continue;
	}

	if( $_POST["address_status"] == 1 ){
		if( $key == "address_hire" ) continue;
	}

	if( $_POST["doc_address"] != 3 ){
		if( $key == "doc_addr_number" || $key == "doc_addr_district" || $key == "doc_addr_amphur" || $key == "doc_addr_province" || $key == "doc_addr_zipcode" ) continue;
	}

	if( $key == "address_hire" || $key == "work_income_etc" || $key == "work_old_year" || $key == "package_interest2" || $key == "package_interest_date2" || $key == "spouse_children" || $key == "address_room"|| $key == "address_soi"|| $key == "address_street"|| $key == "address_phone" || $key == "address_month" || $key == "address_year" || $key == "work_addr_floor" || $key == "work_addr_soi" || $key == "work_addr_street" || $key == "work_addr_mobile" || $key == "work_addr_fax" || $key == "work_old_month" || $key == "doc_addr_room" || $key == "doc_addr_soi" || $key == "doc_addr_street" || $key == "spouse_career" || $key == "spouse_income" || $key == "work_income_source" || $key == "work_addr_code" || $key == "package_interest2" || $key == "package_interest_date2") continue;

	if( empty($value) ) $arr["error"][$key] = "กรุณากรอกข้อมูลให้ครบถ้วน";
}

/* Validator */
if( !empty($_POST["first_name"]) ){
	if( !checkThai($_POST["first_name"]) ) $arr["error"]["first_name"] = "กรุณากรอกชื่อเป็นภาษาไทยเท่านั้น";
}
if( !empty($_POST["last_name"]) ){
	if( !checkThai($_POST["last_name"]) ) $arr["error"]["last_name"] = "กรุณากรอกนามสกุลเป็นภาษาไทยเท่านั้น";
}

if( !empty($_POST["idcard"]) ){
	if( !is_numeric($_POST["idcard"]) ){
		$arr["error"]["idcard"] = "กรุณากรอกข้อมูลเป็นตัวเลข 0-9 และห้ามเว้นว่าง";
	}elseif( !checkPID($_POST["idcard"]) ){
		$arr["error"]["idcard"] = "เลขบัตรประชาชนไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง";
	}
	// $sql->table = "customers";
	// $sql->condition = "WHERE idcard='{$_POST["idcard"]}'";
	// $query = $sql->select();
	// if( mysqli_num_rows($query) > 0 ){
	// 	$arr["error"]["idcard"] = "ตรวจสอบพบข้อมูลผู้สมัครในระบบ กรุณาเข้าสู่ระบบผู้ลงทะเบียนเดิม";
	// 	$arr["alert"] = "true";
	// 	$arr["type"] = "error";
	// 	$arr["title"] = "ตรวจพบข้อมูลซ้ำ";
	// 	$arr["text"] = "ตรวจสอบพบเลขบัตรประชาชน {$_POST["idcard"]} ในระบบ";
	// 	$arr["status"] = 422; 
	// }
}

if( empty($_FILES["img_idcard"]) && empty($arr["error"]) ){
	$arr["error"]["img_idcard"] = "กรุณาอัพโหลดรูปถ่าย";
	$arr["alert"] = "true";
	$arr["type"] = "error";
	$arr["title"] = "กรุณาอัพโหลดรูปถ่าย";
	$arr["text"] = "กรุณาอัพโหลดรูปถ่ายบัตรประชาชนเพื่อยืนยันตัวตน";
	$arr["status"] = 422; 
}

if( empty($_FILES["img_bookbank"]) && empty($arr["error"]) ){
	$arr["error"]["img_idcard"] = "กรุณาอัพโหลดรูป Book Bank";
	$arr["alert"] = "true";
	$arr["type"] = "error";
	$arr["title"] = "กรุณาอัพโหลดรูป Book Bank";
	$arr["text"] = "กรุณาอัพโหลดรูปถ่าย Book Bank";
	$arr["status"] = 422; 
}
/**/

if( !empty($_FILES["img_idcard"]) ){
	$typeFile = strrchr($_FILES["img_idcard"]["name"],".");
	if( $typeFile != ".jpg" && $typeFile != ".png" && $typeFile != ".jpeg" ){
		$arr["error"]["img_idcard"] = "รูปภาพต้องเป็นไฟล์ .jpg / .png / .jpeg เท่านั้น";	
		$arr["alert"] = "true";
		$arr["type"] = "error";
		$arr["title"] = "เกิดข้อผิดพลาดในการยืนยันตัวตน";
		$arr["text"] = "รูปภาพต้องเป็นไฟล์ .jpg / .png / .jpeg เท่านั้น";
		$arr["status"] = 422; 
	}
}

if( !empty($_FILES["img_bookbank"]) ){
	$count = count($_FILES["img_bookbank"]["name"]);
	if( $count > 3 ){
		$arr["error"]["img_bookbank"] = "สามารถเลือกได้เพียง 3 รูปเท่านั้น";	
		$arr["alert"] = "true";
		$arr["type"] = "error";
		$arr["title"] = "เกิดข้อผิดพลาดในการยืนยันตัวตน";
		$arr["text"] = "รูปภาพ Bookbank สามารถเลือกได้เพียง 3 รูปเท่านั้น";
		$arr["status"] = 422; 
	}
	else{
		for($i=0; $i<$count; $i++){
			$typeFile = strrchr($_FILES["img_bookbank"]["name"][$i],".");
			if( $typeFile != ".jpg" && $typeFile != ".png" && $typeFile != ".jpeg" ){
				$arr["error"]["img_bookbank"] = "รูปภาพต้องเป็นไฟล์ .jpg / .png / .jpeg เท่านั้น";	
				$arr["alert"] = "true";
				$arr["type"] = "error";
				$arr["title"] = "เกิดข้อผิดพลาดในการยืนยันตัวตน";
				$arr["text"] = "รูปภาพต้องเป็นไฟล์ .jpg / .png / .jpeg เท่านั้น";
				$arr["status"] = 422;
				exit;
			}
		}
	}
}

if( empty($_POST["checkconfirm"]) && empty($arr["error"]) ){
	$arr["alert"] = "true";
	$arr["type"] = "error";
	$arr["title"] = "กรุณายืนยันข้อมูล";
	$arr["text"] = "กรุณายืนยัน ข้าพเจ้าขอยอมรับว่าข้อมูลที่กรอกเป็นความจริง";
	$arr["status"] = 422; 
}

if( !empty($_POST["checkconfirm"]) && empty($_POST["poll"]) ){
	$arr["alert"] = "true";
	$arr["type"] = "error";
	$arr["title"] = "กรุณากรอกแบบสำรวจ";
	$arr["text"] = "กรุณากรอกแบบสำรวจให้ครบถ้วน";
	$arr["status"] = 422; 

	$arr["error"]["poll"] = "กรุณากรอกแบบสำรวจให้ครบถ้วน";
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
			if( $key == "birthday" || $key == "idcard_expire" ) $post = DateJQToPHP($post);
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

		##SET Customer CODE
		$code = "SBC".sprintf("%06d", $_POST["customer_id"]);
		$sql->value = "code='{$code}'";
		$sql->condition = "WHERE id={$_POST["customer_id"]}";
		$sql->update();

		//SET BORROWS
		$field = '';
		$value = '';
		foreach ($_POST as $key => $post) {
			if( $key == "poll" ) continue;
			$field .= !empty($field) ? "," : "";
			$field .= $key;

			$value .= !empty($value) ? "," : "";
			if( $key == "package_interest_date1" || $key == "package_interest_date2" ) $post = DateJQToPHP($post);
			$value .= "'{$post}'";
		}

		$sql->table = "borrows";
		$sql->field = $field;
		$sql->value = $value;
		if( $sql->insert() ){

			#UPLOAD FILE
			$id = mysqli_insert_id($sql->connect);
			$typeFile = strrchr($_FILES["img_idcard"]["name"],".");
			$img_idcard = 'ID_'.date('Y-m-d').'_'.md5(sprintf("%04d",$id)).$typeFile;
			move_uploaded_file($_FILES["img_idcard"]["tmp_name"], WWW_UPLOADS.$img_idcard);

			$sql->table = "borrows";
			$sql->value = "img_idcard='{$img_idcard}'";
			$sql->condition = "WHERE id={$id}";
			$sql->update();
			#####

			#BOOKBANK
			$field = '';
			$value = '';
			for($i=0; $i<count($_FILES["img_bookbank"]["name"]); $i++){
				$typeFile = strrchr($_FILES["img_bookbank"]["name"][$i],".");
				$img_bookbank = 'ID_'.date('Y-m-d').'_'.md5(sprintf("%04d",$id)).'_'.($i+1).$typeFile;
				move_uploaded_file($_FILES["img_bookbank"]["tmp_name"][$i], WWW_UPLOADS.$img_bookbank);

				$sql->table = "borrow_bookbanks";
				$sql->field = "borrow_id, img_bookbank";
				$sql->value = "{$id}, '{$img_bookbank}'";
				$sql->insert();
			}
			#####

			#POLL
			$field = '';
			$value = '';
			foreach ($_POST["poll"] as $key => $poll) {
				$field .= !empty($field) ? "," : "";
				$field .= $key;

				$value .= !empty($value) ? "," : "";
				$value .= "'{$poll}'";
			}
			$sql->table = "poll";
			$sql->field = $field.",borrow_id";
			$sql->value = $value.",'{$id}'";
			$sql->insert();
			#####

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
else{
	$arr["type"] = "error";
	$arr["title"] = "เกิดข้อผิดพลาด";
	$arr["text"] = "กรุณาตรวจสอบการกรอกข้อมูลอีกครั้ง";
	$arr["status"] = 422;
}
echo json_encode($arr);