<?php 

include("../../config.php");
include(WWW_PATH.'app/SQLiManager.php');
include(WWW_PATH.'app/fn.php');

$sql = new SQLiManager();

$sql->table = "borrows";
$sql->condition = "WHERE id='{$_GET["id"]}'";
$query = $sql->select();
$result = mysqli_fetch_assoc($query);

$arr['dialogClass'] = 'modal-lg'; //ขยายให้ใหญ่ขึ้น
// $arr['dialogClass'] = 'modal-sm'; //ย่อให้เล็กลง
## ถ้าไม่ใส่ dialogClass จะแสดงขนาดปกติ ##

$arr['form'] = '<form class="form-submit" method="POST" action="'.URL.'admin/borrows/do_approve.php">'; // สามารถใช้ Form เพื่อ Insert / Update ได้
// $arr['center'] = "false"; //แสดง Modal ด้านบน (ค่า Defualt คือ true จะแสดงกึ่งกลางหน้าจอ)

 $arr['headClose'] = true; //แสดงกากบาทบน Header Modal

$arr['title'] = "หลักฐานการสมัคร";
$arr['body'] = '<h5 class="do--idcard" style="text-align: center; margin: 10px;">รูปถ่ายพร้อมบัตรประชาชน</h5>';

$arr['body'] .= '<img style="width: 100%; margin-bottom: 30px;" src="'.URL.'public/uploads/'.$result["img_idcard"].'">';
 
$arr['body'] .= '<h5 class="do--bookbank" style="text-align: center; margin: 10px;">รูปถ่าย Book Bank</h5>';

$sql->table = "borrow_bookbanks";
$sql->condition="WHERE borrow_id = {$_GET["id"]}";
$queryPic = $sql->select();
while ($resultPic = mysqli_fetch_assoc($queryPic)) {
	$arr['body'] .= '<img style="width: 100%; margin-top: 10px;" src="'.URL.'public/uploads/'.$resultPic["img_bookbank"].'">';
}



// <button type="submit" class="btn btn-primary btn-submit">Save changes</button>
//$arr['btnclose'] = '<button type="button" class="float-left btn btn-default" data-dismiss="modal">Close</button>'; // ปุ่มปิด
//$arr['btnsubmit'] = '<button type="submit" class="float-right btn btn-primary btn-submit">Save changes</button>'; // ปุ่ม Submit

//* ตั้งค่า input type hidden *//
$arr['hiddenInput'][] = ["name"=>"id", "value"=>1];
// $arr['hiddenInput'][] = ["name"=>"customer_id", "value"=>2];

// ตั้งค่าให้สามารถกดพื้นหลังแล้วปิด Modal //
$arr['bgClose'] = true;

echo json_encode($arr);