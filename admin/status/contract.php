<?php 
include("../../config.php");
include(WWW_PATH.'app/SQLiManager.php');
include(WWW_PATH.'app/fn.php');

$sql = new SQLiManager();

$_title = "วันที่เริ่มสัญญา";
$_action = URL."admin/borrows/do_sign.php";

$sql->table = "borrows";
$sql->field = "id, contract_date";
$sql->condition = "WHERE id={$_GET["id"]} LIMIT 1";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

//Set Input type Hidden
$arr['hiddenInput'][] = ['name'=>'id', 'value'=>$_GET['id']];


$arr['dialogClass'] = 'modal-sm';

$arr['title'] = $_title;

$arr['form'] = '<form class="form-submit" action="'.$_action.'" method="POST">';

$arr['body'] = '<div class="form-group">
					<label for="contract_date">วันที่เริ่มสัญญา <span class="text-red">* (ระบุปีเป็น ค.ศ.)</span></label>
					<input type="text" class="form-control DatePicker" id="contract_date" name="contract_date" value="'.(!empty($result["contract_date"]) ? date("d/m/Y", strtotime($result["contract_date"])) : "").'" placeholder="กรุณาเลือก วันที่เริ่มสัญญา" style="background-color:#fff;" readonly>
					<div class="invalid-feedback"></div>
				</div>';

$arr['btnclose'] = '<button type="button" class="btn btn-default btn--sh float-left" data-dismiss="modal"><i class="fas fa-ban"></i> ยกเลิก</button>'; // ปุ่มปิด
$arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn--sh float-right btn-submit"><i class="fa fa-save"></i> บันทึก</button>'; // ปุ่ม Submit

echo json_encode($arr);