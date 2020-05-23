<?php 
include("layouts/head.php");
include("app/SQLiManager.php");

$sql = new SQLiManager();
?>
<div class="container">
	<section class="content">
		<div class="content__inner">
			<header class="content__title">
				<h1>บริษัท สบายใจมันนี่ จํากัด</h1>
				<small>161/1 อาคาร เอส จี ทาวเวอร์ ชั้น 8 ซอยมหาดเล็กหลวง 3
				ถนนราชดําริ แขวงลุมพินี เขตปทุมวัน กรุงเทพฯ 10330</small>
			</div>
		</header>
		<div class="card">
			<img class="card-img-top" src="public/img/calendar/january.jpg">
			<div class="card-body">
				<h4 class="card-title" style="font-size: 1.85rem;">ใบสมัครสินเชื่อ</h4>
				<h6 class="card-subtitle">กรุณากรอกข้อมูลของท่าน</h6>
				<form class="row form-submit" action="saveRegister.php" name="registration" id="registration" method="POST">
					<div class="col-md-12">
						<div class="radio radio--inline">
							<input type="radio" name="prefix_name" id="prefixRadio_1" value="1" checked>
							<label class="radio__label" for="prefixRadio_1">นาย</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="prefix_name" id="prefixRadio_2" value="2">
							<label class="radio__label" for="prefixRadio_2">นาง</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="prefix_name" id="prefixRadio_3" value="3">
							<label class="radio__label" for="prefixRadio_3">นางสาว</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input name="first_name" type="text" class="form-control">
							<label>ชื่อ (ภาษาไทย)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="last_name" class="form-control">
							<label>นามสกุล (ภาษาไทย)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<label>วัน/เดือน/ปีเกิด</label>
						<div class="input-group" style="padding-top: 7px;">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
							</div>
							<input type="date" class="form-control hidden-md-up" name="birthday" placeholder="กรุณากรอก วัน/เดือน/ปีเกิด">
							<input type="text" class="form-control date-picker hidden-sm-down flatpickr-input active" placeholder="กรุณากรอก วัน/เดือน/ปีเกิด" readonly="readonly" name="birthday">
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="idcard" class="form-control">
							<label>บัตรประจำตัวประชาชนเลขที่</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<label>บัตรหมดอายุ</label>
						<div class="input-group" style="padding-top: 7px;">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
							</div>
							<input type="date" class="form-control hidden-md-up" name="idcard_expire" placeholder="กรุณากรอกวันหมดอายุ">
							<input type="text" class="form-control date-picker hidden-sm-down flatpickr-input active" placeholder="กรุณากรอกวันหมดอายุ" readonly="readonly" name="idcard_expire">
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-12">
						<h4>ระดับการศึกษา</h4>
						<div class="radio radio--inline">
							<input type="radio" name="education" id="eduRadio_1" value="1" checked>
							<label class="radio__label" for="eduRadio_1">ประถมศึกษา</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="education" id="eduRadio_2" value="2">
							<label class="radio__label" for="eduRadio_2">มัธยมศึกษา</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="education" id="eduRadio_3" value="3">
							<label class="radio__label" for="eduRadio_3">ปวช. / ปวส. / ปวท.</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="education" id="eduRadio_4" value="4">
							<label class="radio__label" for="eduRadio_4">ปริญญาตรี</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="education" id="eduRadio_5" value="5">
							<label class="radio__label" for="eduRadio_5">สูงกว่าปริญญาตรี</label>
						</div>
						<br><br><br>
					</div>
					<div class="col-md-12 js-married">
						<h4>สถานภาพครอบครัว</h4>
						<div class="radio radio--inline">
							<input type="radio" name="family_status" id="farmRadio_1" value="1" checked>
							<label class="radio__label" for="farmRadio_1">โสด</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="family_status" id="farmRadio_2" value="2" class="ck-js-married">
							<label class="radio__label" for="farmRadio_2">สมรส</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="family_status" id="farmRadio_3" value="3">
							<label class="radio__label" for="farmRadio_3">หย่า</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="family_status" id="farmRadio_4" value="4">
							<label class="radio__label" for="farmRadio_4">หม้าย</label>
						</div>
					</div>
					<div class="col-md-12 married">
						<br><br>
						<h4>ข้อมูลคู่สมรส</h4>
						<div class="radio radio--inline">
							<input type="radio" name="spouse_prefix" id="sp_prefixRadio_1" value="1" checked>
							<label class="radio__label" for="sp_prefixRadio_1">นาย</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="spouse_prefix" id="sp_prefixRadio_2" value="2">
							<label class="radio__label" for="sp_prefixRadio_2">นาง</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="spouse_prefix" id="sp_prefixRadio_3" value="3">
							<label class="radio__label" for="sp_prefixRadio_3">นางสาว</label>
						</div>
					</div>
					<div class="col-md-4 married">
						<div class="form-group form-group--float">
							<input type="text" name="spouse_firstname" class="form-control">
							<label>ชื่อ (ภาษาไทย)</label>
							<div class="invalid-feedback married_txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4 married">
						<div class="form-group form-group--float">
							<input type="text" name="spouse_lastname" class="form-control">
							<label>นามสกุล (ภาษาไทย)</label>
							<div class="invalid-feedback married_txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4 married">
						<div class="form-group form-group--float">
							<input type="text" name="spouse_mobile" class="form-control">
							<label>เบอร์โทร</label>
							<div class="invalid-feedback married_txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6 married">
						<div class="form-group form-group--float">
							<input type="text" name="spouse_career" class="form-control">
							<label>อาชีพคู่สมรส</label>
							<div class="invalid-feedback married_txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3 married">
						<div class="form-group form-group--float">
							<input type="text" name="spouse_children" class="form-control">
							<label>จำนวนบุตร / ธิดา</label>
							<div class="invalid-feedback married_txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3 married">
						<div class="form-group form-group--float">
							<input type="text" name="spouse_income" class="form-control">
							<label>รายได้คู่สมรสต่อเดือน</label>
							<div class="invalid-feedback married_txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<br><br>
						<h4>ที่อยู่ปัจจุบัน</h4>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_number" class="form-control">
							<label>เลขที่</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_room" class="form-control">
							<label>เลขที่ห้องพัก</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_soi" class="form-control">
							<label>ซอย</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_street" class="form-control">
							<label>ถนน</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_district" class="form-control">
							<label>แขวง / ตำบล</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_amphur" class="form-control">
							<label>เขต / อำเภอ</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group" style="padding-top: 8px;">
							<label>จังหวัด</label>
							<select class="select2 select2-hidden-accessible" name="address_province" data-placeholder="กรุณาเลือกจังหวัด" tabindex="-1" aria-hidden="true">
								<option></option>
								<?php 
								$sql->table = "province";
								$query = $sql->select();
								while($province = mysqli_fetch_assoc($query)){
									echo '<option value="'.$province["PROVINCE_ID"].'">'.$province["PROVINCE_NAME"].'</option>';
								}
								?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_zipcode" class="form-control">
							<label>รหัสไปปรษณีย์</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="address_phone" class="form-control">
							<label>โทรศัพท์บ้าน</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="mobile" class="form-control">
							<label>โทรศัพท์มือถือ</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="email" class="form-control">
							<label>อีเมล์</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>ลักษณะที่อยู่อาศัย</h4>
						<div class="radio radio--inline">
							<input type="radio" name="address_feature" id="housingRadio_1" value="1" checked>
							<label class="radio__label" for="housingRadio_1">บ้านเดี่ยว</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_feature" id="housingRadio_2" value="2">
							<label class="radio__label" for="housingRadio_2">บ้านแฝด</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_feature" id="housingRadio_3" value="3">
							<label class="radio__label" for="housingRadio_3">ทาวน์เฮาส์</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_feature" id="housingRadio_4" value="4">
							<label class="radio__label" for="housingRadio_4">อาคารพาณิชย์</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_feature" id="housingRadio_5" value="5">
							<label class="radio__label" for="housingRadio_5">คอนโดมิเนียม</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_feature" id="housingRadio_6" value="6">
							<label class="radio__label" for="housingRadio_6">อพาร์ทเม้นท์ / หอพัก</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_feature" id="housingRadio_7" value="7">
							<label class="radio__label" for="housingRadio_7">อื่นๆ</label>
						</div>
						<br><br><br>
					</div>
					<div class="col-md-12">
						<h4>สถานภาพที่อยู่อาศัย</h4>
						<div class="radio radio--inline">
							<input type="radio" name="address_status" id="livingRadio_1" value="1" checked>
							<label class="radio__label" for="livingRadio_1">เป็นบ้านของตนเอง</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_status" id="livingRadio_2" value="2">
							<label class="radio__label" for="livingRadio_2">เป็นบ้านของสมาชิกในครอบครัว</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_status" id="livingRadio_3" value="3">
							<label class="radio__label" for="livingRadio_3">บ้านพักบริษัท</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_status" id="livingRadio_4" value="4">
							<label class="radio__label" for="livingRadio_4">อาศัยอยู่กับเพื่อน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="address_status" id="livingRadio_5" value="5">
							<label class="radio__label" for="livingRadio_5">บ้านเช่า</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="address_hire" class="form-control">
							<label>ผ่อน / เช่าอยู่เดือนละ ... (บาท)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" name="address_year" class="form-control">
							<label>อาศัยมานาน ... (ปี)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" name="address_month" class="form-control">
							<label>อาศัยมานาน ... (เดือน)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control" id="address_person" name="address_person">
							<label>จำนวนผู้พักอาศัย ... (คน)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>ข้อมูลการทำงาน</h4>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="work_company" class="form-control">
							<label>ชื่อบริษัท</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="work_status" class="form-control">
							<label>ลักษณะธุรกิจขององค์กร</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_position" class="form-control">
							<label>ตำแหน่ง</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_department" class="form-control">
							<label>ฝ่ายงาน</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_income" class="form-control">
							<label>รายได้ส่วนบุคคลต่อเดือน ... (บาท)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="work_income_etc" class="form-control">
							<label>รายได้ส่วนบุคคลอื่นๆ ต่อเดือน ... (บาท)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="work_income_source" class="form-control">
							<label>แหล่งที่มาของรายได้อื่นๆ</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_number" class="form-control">
							<label>ที่อยู่ เลขที่</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_build" class="form-control">
							<label>อาคาร</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_floor" class="form-control">
							<label>ชั้น</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_code" class="form-control">
							<label>เลขที่</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_soi" class="form-control">
							<label>ซอย</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_street" class="form-control">
							<label>ถนน</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_district" class="form-control">
							<label>แขวง / ตำบล</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_amphur" class="form-control">
							<label>เขต / อำเภอ</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group" style="padding-top: 8px;">
							<label>จังหวัด</label>
							<select class="select2 select2-hidden-accessible" name="work_addr_province" data-placeholder="กรุณาเลือกจังหวัด" tabindex="-1" aria-hidden="true">
								<option></option>
								<?php 
								$sql->table = "province";
								$query = $sql->select();
								while($province = mysqli_fetch_assoc($query)){
									echo '<option value="'.$province["PROVINCE_ID"].'">'.$province["PROVINCE_NAME"].'</option>';
								}
								?>
							</select>
							<div class="invalid-feedback"></div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_zipcode" class="form-control">
							<label>รหัสไปปรษณีย์</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_phone" class="form-control">
							<label>โทรศัพท์</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_mobile" class="form-control">
							<label>เบอร์ต่อ</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_fax" class="form-control">
							<label>เบอร์แฟ็กซ์</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" name="work_old_year" class="form-control">
							<label>อายุงาน ... (ปี)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" name="work_old_month" class="form-control">
							<label>อายุงาน ... (เดือน)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12 js-other">
						<h4>สถานจัดส่งเอกสาร</h4>
						<div class="radio radio--inline">
							<input type="radio" name="doc_address" id="docRadio_1" value="1" checked>
							<label class="radio__label" for="docRadio_1">ที่อยู่ปัจจุบัน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="doc_address" id="docRadio_2" value="2">
							<label class="radio__label" for="docRadio_2">ที่อยู่ที่ทำงาน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="doc_address" id="docRadio_3" class="js-other-address" value="3">
							<label class="radio__label" for="docRadio_3">อื่นๆ โปรดระบุ</label>
						</div>
						<br><br>
					</div>

					<div class="col-md-12 other-address">
						<h4>ที่อยู่จัดส่งเอกสารอื่นๆ</h4>
					</div>
					<div class="col-md-3 other-address">
						<div class="form-group form-group--float">
							<input type="text" name="doc_addr_number" class="form-control other-address">
							<label>เลขที่</label>
							<div class="invalid-feedback txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3 other-address">
						<div class="form-group form-group--float">
							<input type="text" name="doc_addr_room" class="form-control other-address">
							<label>เลขที่ห้องพัก</label>
							<div class="invalid-feedback txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3 other-address">
						<div class="form-group form-group--float">
							<input type="text" name="doc_addr_soi" class="form-control other-address">
							<label>ซอย</label>
							<div class="invalid-feedback txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3 other-address">
						<div class="form-group form-group--float">
							<input type="text" name="doc_addr_street" class="form-control other-address">
							<label>ถนน</label>
							<div class="invalid-feedback txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3 other-address">
						<div class="form-group form-group--float">
							<input type="text" name="doc_addr_district" class="form-control other-address">
							<label>แขวง / ตำบล</label>
							<div class="invalid-feedback txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3 other-address">
						<div class="form-group form-group--float">
							<input type="text" name="doc_addr_amphur" class="form-control other-address">
							<label>เขต / อำเภอ</label>
							<div class="invalid-feedback txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3 other-address">
						<div class="form-group" style="padding-top: 8px;">
							<label>จังหวัด</label>
							<select class="select2 select2-hidden-accessible other-address" name="doc_addr_province" data-placeholder="กรุณาเลือกจังหวัด" tabindex="-1" aria-hidden="true">
								<option></option>
								<?php 
								$sql->table = "province";
								$query = $sql->select();
								while($province = mysqli_fetch_assoc($query)){
									echo '<option value="'.$province["PROVINCE_ID"].'">'.$province["PROVINCE_NAME"].'</option>';
								}
								?>
							</select>
							<div class="invalid-feedback txt_err"></div>
						</div>
						
					</div>
					<div class="col-md-3 other-address">
						<div class="form-group form-group--float">
							<input type="text" name="doc_addr_zipcode" class="form-control other-address">
							<label>รหัสไปปรษณีย์</label>
							<div class="invalid-feedback txt_err"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<!-- <div class="col-md-12">
						<div class="form-group">
							<textarea class="form-control textarea-autosize other-address" placeholder="กรุณากรอกที่อยู่อื่นๆ..." style="overflow: hidden; overflow-wrap: break-word; height: 51px;" name="address"></textarea>
							<i class="form-group__bar"></i>
							<div class="invalid-feedback txt_err"></div>
						</div>
					</div> -->
					<div class="col-md-12">
						<h4>วัตถุประสงค์การขอกู้</h4>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="objective_company" class="form-control">
							<label>สถานประกอบการ / คลินิก</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="objective_program" class="form-control">
							<label>โปรแกรมที่ขอกู้</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="objective_price" class="form-control">
							<label>ราคา ... (บาท)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>ระยะเวลาผ่อนชำระ</h4>
						<div class="radio radio--inline">
							<input type="radio" name="objective_duration" id="objRadio_1" checked>
							<label class="radio__label" for="objRadio_1">3 เดือน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="objective_duration" id="objRadio_2">
							<label class="radio__label" for="objRadio_2">6 เดือน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="objective_duration" id="objRadio_3">
							<label class="radio__label" for="objRadio_3">9 เดือน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="objective_duration" id="objRadio_4">
							<label class="radio__label" for="objRadio_4">12 เดือน</label>
						</div>
						<br><br>
					</div>
					<div class="col-md-12">
						<h4>บุคคลอ้างอิง (1)</h4>
					</div>
					<div class="col-md-12">
						<div class="radio radio--inline">
							<input type="radio" name="person_prefix" id="refRadio_1" value="1" checked>
							<label class="radio__label" for="refRadio_1">นาย</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="person_prefix" id="refRadio_2" value="2">
							<label class="radio__label" for="refRadio_2">นาง</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="person_prefix" id="refRadio_3" value="3">
							<label class="radio__label" for="refRadio_3">นางสาว</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_firstname" class="form-control">
							<label>ชื่อ</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_lastname" class="form-control">
							<label>นามสกุล</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_phone" class="form-control">
							<label>โทร</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_relationship" class="form-control">
							<label>ความสัมพันธ์</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>บุคคลอ้างอิง (2)</h4>
					</div>
					<div class="col-md-12">
						<div class="radio radio--inline">
							<input type="radio" name="person_prefix2" id="ref2Radio_1" value="1" checked>
							<label class="radio__label" for="ref2Radio_1">นาย</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="person_prefix2" id="ref2Radio_2" value="2">
							<label class="radio__label" for="ref2Radio_2">นาง</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="person_prefix2" id="ref2Radio_3" value="3">
							<label class="radio__label" for="ref2Radio_3">นางสาว</label>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_firstname2" class="form-control">
							<label>ชื่อ</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_lastname2" class="form-control">
							<label>นามสกุล</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_phone2" class="form-control">
							<label>โทร</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_relationship2" class="form-control">
							<label>ความสัมพันธ์</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<div class="checkbox" style="text-align: center; padding-top: 50px;">
							<input type="checkbox" id="customCheck1" name="checkconfirm" value="1">
							<label class="checkbox__label" for="customCheck1">ข้าพเจ้าขอยอมรับว่าข้อมูลที่กรอกเป็นความจริง</label>
						</div>
					</div>
					<div class="col-md-12" style="text-align: center;margin-top: 50px;">
						<button type="submit" class="btn btn-info btn-submit">ส่งใบสมัคร</button>
					</div>
				</form>
			</div>
			<footer class="footer hidden-xs-down">
				<p>© 2020 สงวนลิขสิทธิ์ บริษัท สบายใจมันนี่ จํากัด</p>
			</footer>
		</div>
	</section>
</div>
<?php 
include("layouts/foot.php");
?>
<script type="text/javascript">
	$(".other-address").hide();
	$(".js-other").change(function(){
		if( $(this).find('.js-other-address').is(":checked") ){
			$(".other-address").show();
			$(".txt_err").show();
		}
		else{
			$(".other-address").hide();
			$(".txt_err").hide();
		}
	});

	$(".married").hide();
	$(".js-married").change(function(){
		if( $(this).find('.ck-js-married').is(":checked") ){
			$(".married").show();
			$(".married_txt_err").show();
		}
		else{
			$(".married").hide();
			$(".married_txt_err").hide();
		}
	});
</script>