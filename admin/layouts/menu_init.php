<?php
$menu[] = ["label"=>"จัดการใบสมัครสินเชื่อ", "key"=>"borrows", "url"=>URL."admin/borrows", 'icon'=>'fas fa-file-invoice-dollar'];
$menu[] = ["label"=>"สถานะการสมัคร", "key"=>"status", "url"=>URL."admin/status", 'icon'=>'fa fa-check'];
$menu[] = ["label"=>"จัดการข้อมูลลูกค้า", "key"=>"customers", "url"=>URL."admin/customers", 'icon'=>'fa fa-users'];
// $menu[] = ["label"=>"จัดการข้อมูลผู้ใช้งาน", "key"=>"users", "url"=>URL."admin/users", 'icon'=>'fa fa-user'];

// EX. MENU WITH SUB //
if( $auth['role'] == 'admin' ){
	$sub_admin[] = ["label"=>"ผู้ใช้งานระบบ (หลังบ้าน)", "key"=>"admins", "url"=>URL."admin/users", 'icon'=>''];
}

$sub_admin[] = ["label"=>"Sale Agents", "key"=>"users", "url"=>URL."admin/sales", 'icon'=>''];
$menu[] = ["label"=>"ข้อมูลผู้ใช้งานระบบ", "key"=>"admins", 'icon'=>'fa fa-user', "sub"=>$sub_admin];
// END //