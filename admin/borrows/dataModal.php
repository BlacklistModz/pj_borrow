<?php 

include("../../config.php");

// $arr['dialogClass'] = 'modal-lg'; //ขยายให้ใหญ่ขึ้น
// $arr['dialogClass'] = 'modal-sm'; //ย่อให้เล็กลง
## ถ้าไม่ใส่ dialogClass จะแสดงขนาดปกติ ##

// $arr['form'] = '<form class="form-submit" method="POST" action="'.URL.'admin/borrows/do_approve.php">'; // สามารถใช้ Form เพื่อ Insert / Update ได้
// $arr['center'] = "false"; //แสดง Modal ด้านบน (ค่า Defualt คือ true จะแสดงกึ่งกลางหน้าจอ)

$arr['headClose'] = true; //แสดงกากบาทบน Header Modal

$arr['title'] = "หัว Modal";
$arr['body'] = 'ตัว Modal (ใส่ภาษา HTML ได้) เช่น <div class="float-right">Hello World</div>';

$arr['body'] .= '<div class="form-group col-md-12">
					<label for="approve_limit">วงเงิน (บาท)</label>
						<input type="text" class="form-control" id="approve_limit" name="approve_limit" placeholder="วงเงิน (บาท)" value="">
						<div class="invalid-feedback"></div>
				</div>';

// <button type="submit" class="btn btn-primary btn-submit">Save changes</button>
// $arr['btnclose'] = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'; // ปุ่มปิด
// $arr['btnsubmit'] = '<button type="submit" class="btn btn-primary btn-submit">Save changes</button>'; // ปุ่ม Submit

echo json_encode($arr);