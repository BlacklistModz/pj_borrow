<?php 
include("../../config.php");
include(WWW_PATH.'app/SQLiManager.php');
include(WWW_PATH.'app/fn.php');

$sql = new SQLiManager();

$_title = "วันที่โอนเงินให้คลินิก";
$_action = URL."admin/status/do_transfer.php";

$sql->table = "borrows";
$sql->field = "id, transfer_date";
$sql->condition = "WHERE id={$_GET["id"]} LIMIT 1";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

//Set Input type Hidden
$arr['hiddenInput'][] = ['name'=>'id', 'value'=>$_GET['id']];


$arr['dialogClass'] = 'modal-sm';

$arr['title'] = $_title;

$arr['form'] = '<form class="form-submit" action="'.$_action.'" method="POST">';

$arr['body'] = '<div class="form-group">
					<label for="contract_date">วันที่โอนเงินให้คลินิก <span class="text-red">* (ระบุปีเป็น ค.ศ.)</span></label>
					<input type="text" class="form-control DatePicker" id="transfer_date" name="transfer_date" value="'.(!empty($result["transfer_date"]) ? date("d/m/Y", strtotime($result["transfer_date"])) : "").'" placeholder="เลือกวันที่โอนเงินให้คลินิก" style="background-color:#fff;" readonly>
					<div class="invalid-feedback"></div>
				</div>';

$arr['btnclose'] = '<button type="button" class="btn btn-default btn--sh float-left" data-dismiss="modal"><i class="fas fa-ban"></i> ยกเลิก</button>'; // ปุ่มปิด
$arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn--sh float-right btn-submit"><i class="fa fa-save"></i> บันทึก</button>'; // ปุ่ม Submit

echo json_encode($arr);