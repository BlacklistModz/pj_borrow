<?php 
include("../../config.php");
include(WWW_PATH.'app/SQLiManager.php');
include(WWW_PATH.'app/fn.php');

$sql = new SQLiManager();

$_title = "เพิ่มข้อมูล";
$_action = URL."admin/sales/save.php?page={$_GET["page"]}";
//EDIT DATA
if( !empty($_GET["id"]) ){
	$sql->table = "saleagents";
	$sql->condition = "WHERE id={$_GET["id"]} LIMIT 1";
	$query = $sql->select();
	if( mysqli_num_rows($query) <= 0 ){
		header('location:'.URL.'admin/sales/?page='.$_GET['page']);
		exit;
	}
	$result = mysqli_fetch_assoc($query);

	//SET FORM
	$_title = "แก้ไขข้อมูล";
	$_action = URL."admin/sales/update.php?page={$_GET["page"]}";

	//Set Input type Hidden
	$arr['hiddenInput'][] = ['name'=>'id', 'value'=>$_GET['id']];
}

$arr['dialogClass'] = 'modal-lg';

$arr['title'] = $_title;

$arr['form'] = '<form class="form-submit" action="'.$_action.'" method="POST">';

$options = '';
foreach (prefix() as $key => $value) {
	$sel = '';
	if( !empty($result["prefix_name"]) ){
		if( $result["prefix_name"] == $value["id"] ) $sel = 'selected="1"';
	}
	$options .= '<option value="'.$value["id"].'" '.$sel.'>'.$value["name"].'</option>';
}

$arr['body'] = '<div class="form-group">
					<label for="code">รหัส</label>
					<input type="text" class="form-control" id="code" name="code" placeholder="รหัส (หากไม่กรอก ระบบจะดำเนินการให้อัตโนมัติ)" value="'.(!empty($result["code"]) ? $result["code"] : "").'">
					<div class="invalid-feedback"></div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-2">
						<label for="prefix_name">คำนำหน้า</label>
						<select name="prefix_name" id="prefix_name" class="form-control">
							<option value="">- คำนำหน้า -</option>
							'.$options.'
						</select>
						<div class="invalid-feedback"></div>
					</div>
					<div class="form-group col-md-5">
						<label for="prefix_name">ชื่อ (ภาษาไทย)</label>
							<input type="text" class="form-control" id="first_name" name="first_name" placeholder="ชื่อ (ภาษาไทย)" value="'.(!empty($result["first_name"]) ? $result["first_name"] : "").'">
						<div class="invalid-feedback"></div>
					</div>
					<div class="form-group col-md-5">
						<label for="prefix_name">นามสกุล (ภาษาไทย)</label>
						<input type="text" class="form-control" id="last_name" name="last_name" placeholder="นามสกุล (ภาษาไทย)"  value="'.(!empty($result["last_name"]) ? $result["last_name"] : "").'">
						<div class="invalid-feedback"></div>
					</div>
				</div>
				<div class="form-group">
					<label for="idcard">รหัสประจำตัวประชาชน</label>
					<input type="text" class="form-control" id="idcard" name="idcard" placeholder="รหัสประจำตัวประชาชน" value="'.(!empty($result["idcard"]) ? $result["idcard"] : "").'" maxlength="13">
					<div class="invalid-feedback"></div>
				</div>';

$arr['btnclose'] = '<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-ban"></i> ยกเลิก</button>'; // ปุ่มปิด
$arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn-submit"><i class="fa fa-save"></i> บันทึก</button>'; // ปุ่ม Submit

echo json_encode($arr);