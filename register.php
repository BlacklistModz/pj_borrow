<?php 
include("layouts/head.php");
include("app/SQLiManager.php");

if( empty($_GET["s"]) ){
	header("location:errors/404.php");
	exit;
}

//SET FOR SALE AGENTS LINK
$sql = new SQLiManager();
$sql->table = "saleagents";
$sql->condition = "WHERE code='".base64_decode($_GET["s"])."'";
$sQuery = $sql->select();
if( mysqli_num_rows($sQuery) <= 0 ){
	header("location:errors/404.php");
	exit;
}

$sResult = mysqli_fetch_assoc($sQuery);

//CLEAR DATA FOR FORM
$sql = new SQLiManager();
?>

<style>
	h4 {
		color: #324695;
	}
	.must {
		color: #FF0000 !important;
		display: inline !important;
	}
	.radio__label:after {
    	background-color: #324695;
	}
	.checkbox>input[type=checkbox]:checked~.checkbox__label:before, .checkbox>input[type=checkbox]:checked~.radio__label:before, .checkbox>input[type=radio]:checked~.checkbox__label:before, .checkbox>input[type=radio]:checked~.radio__label:before, .radio>input[type=checkbox]:checked~.checkbox__label:before, .radio>input[type=checkbox]:checked~.radio__label:before, .radio>input[type=radio]:checked~.checkbox__label:before, .radio>input[type=radio]:checked~.radio__label:before {
    	border-color: #03A9F4;
	}
	.checkbox>input[type=checkbox]:checked~.checkbox__label:before, .checkbox>input[type=radio]:checked~.checkbox__label:before, .radio>input[type=checkbox]:checked~.checkbox__label:before, .radio>input[type=radio]:checked~.checkbox__label:before {
    	background-color: #03A9F4;
	}
	.invalid-feedback {
		margin-top: auto;
	}
	.invalid-feedback, .valid-feedback {
    	bottom: auto;
    }

	.banner-loan-mobile
	{
		display: none;
	}

	.card-title {
		display: none;
	}
	.card {
		margin-top: 2.3rem;
	}

	.logo {
		position: absolute;
    	width: 18%;
    	margin-top: 40px;
    	margin-left: 20px;
	}

	@media screen and (max-width: 991px) {
		.banner-loan {
			display: none;
		}
		.banner-loan-mobile {
			display: block;
		}
		.container {
			padding-right: 0px;
    		padding-left: 0px;
		}
		.card {
			margin-bottom: 0rem;
			margin-top: 0rem;
		}
		.card-title {
			display: block;
		}
		.card-subtitle {
			display: none;
		}
		.resp-img, .resp-img img {
			max-width: 230px;
		}
		.logo {
			display: none;
		}
	}
	.card-subtitle {
		font-size: 1.7rem;
		background-color: #da464a;
		padding: 8px;
		margin-top: 5px;
		margin-bottom: 0px !important;
		text-align: center;
		color: #f3f3f3;
	}
	.ui-datepicker {
    	width: 18.5em !important;
	}

</style>

<div class="container">
	<!-- <section class="content">
		<div class="content__inner">
			<header class="content__title">
				<h1>บริษัท สบายใจมันนี่ จํากัด</h1>
				<small>161/1 อาคาร เอส จี ทาวเวอร์ ชั้น 8 ซอยมหาดเล็กหลวง 3
				ถนนราชดําริ แขวงลุมพินี เขตปทุมวัน กรุงเทพฯ 10330</small>
			</div>
		</header> -->
		<div class="card">
			<img class="logo" src="logo.png">
			<img class="card-img-top banner-loan" src="banner.svg">
			<img class="card-img-top banner-loan-mobile" src="banner-mobile.jpg">
			<h6 class="card-subtitle">ข้อมูลผู้สมัคร</h6>
			<div class="card-body">
				<h4 class="card-title" style="font-size: 1.5rem;">ข้อมูลผู้สมัคร</h4>
				
				<form class="row form-submit" action="saveRegister.php" name="registration" id="registration" method="POST" enctype=multipart/form-data>
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
							<label>ชื่อ (ภาษาไทย) <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="last_name" class="form-control">
							<label>นามสกุล (ภาษาไทย) <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<label>วัน/เดือน/ปีเกิด (ระบุปีเป็น ค.ศ.) <label class="must">*</label></label>
						<div class="input-group" style="padding-top: 7px;">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
							</div>
							<input type="text" class="form-control DatePicker" name="birthday" placeholder="กรุณากรอก วัน/เดือน/ปี เกิด" readonly>
							<!-- <input type="date" class="form-control hidden-md-up" name="birthday" placeholder="กรุณากรอก วัน/เดือน/ปีเกิด">
							<input type="text" class="form-control date-picker hidden-sm-down flatpickr-input active" placeholder="กรุณากรอก วัน/เดือน/ปีเกิด" readonly="readonly" name="birthday"> -->
							<div class="invalid-feedback" style="bottom: -1.2rem;"></div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="idcard" class="form-control">
							<label>บัตรประจำตัวประชาชนเลขที่ <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<label>บัตรหมดอายุ (ระบุปีเป็น ค.ศ.) <label class="must">*</label></label>
						<div class="input-group" style="padding-top: 7px;">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
							</div>
							<!-- <input type="date" class="form-control hidden-md-up" name="idcard_expire" placeholder="กรุณากรอกวันหมดอายุ">
							<input type="text" class="form-control date-picker hidden-sm-down flatpickr-input active" placeholder="กรุณากรอกวันหมดอายุ" readonly="readonly" name="idcard_expire"> -->
							<input type="text" class="form-control DatePicker" name="idcard_expire" placeholder="กรุณากรอกวันหมดอายุ" readonly>
							<div class="invalid-feedback" style="bottom: -1.2rem;"></div>
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
							<label>เลขที่ <label class="must">*</label></label>
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

					<!-- <div class="col-md-3">
						<div class="form-group" style="padding-top: 8px;">
							<label>แขวง / ตำบล</label>
							<select class="select2 select2-hidden-accessible" name="address_district" data-placeholder="กรุณาเลือกแขวง / ตำบล" tabindex="-1" aria-hidden="true">
								<option></option> -->
								<?php 
								// $sql->table = "district";
								// $query = $sql->select();
								// while($province = mysqli_fetch_assoc($query)){
								// 	echo '<option value="'.$province["DISTRICT_ID"].'">'.$province["DISTRICT_NAME"].'</option>';
								// }
								?>
							<!-- </select>
							<div class="invalid-feedback"></div>
						</div>
					</div> -->

					<div class="col-md-3">
						<div class="form-group" style="padding-top: 8px;">
							<label>จังหวัด <label class="must">*</label></label>
							<select class="select2 select2-hidden-accessible js-province" name="address_province" data-placeholder="กรุณาเลือกจังหวัด" tabindex="-1" aria-hidden="true">
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
						<div class="form-group" style="padding-top: 8px;">
							<label>เขต / อำเภอ <label class="must">*</label></label>
							<select class="select2 select2-hidden-accessible js-amphur" name="address_amphur" data-placeholder="กรุณาเลือกเขต/อำเภอ" tabindex="-1" aria-hidden="true">
								<option></option>
							</select>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group" style="padding-top: 8px;">
							<label>แขวง / ตำบล <label class="must">*</label></label>
							<select class="select2 select2-hidden-accessible js-district" name="address_district" data-placeholder="กรุณาเลือกแขวง/ตำบล" tabindex="-1" aria-hidden="true">
								<option></option>
							</select>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					
					<!-- <div class="col-md-3">
						<div class="form-group" style="padding-top: 8px;">
							<label>เขต / อำเภอ</label>
							<select class="select2 select2-hidden-accessible" name="address_amphur" data-placeholder="กรุณาเลือกเขต / อำเภอ" tabindex="-1" aria-hidden="true">
								<option></option> -->
								<?php 
								// $sql->table = "amphur";
								// $query = $sql->select();
								// while($province = mysqli_fetch_assoc($query)){
								// 	echo '<option value="'.$province["AMPHUR_ID"].'">'.$province["AMPHUR_NAME"].'</option>';
								// }
								?>
							<!-- </select>
							<div class="invalid-feedback"></div>
						</div>
					</div> -->

					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_zipcode" class="form-control">
							<label>รหัสไปรษณีย์ <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="address_phone" class="form-control">
							<label>โทรศัพท์บ้าน</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="mobile" class="form-control">
							<label>โทรศัพท์มือถือ <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="line_id" class="form-control">
							<label>LINE ID <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="email" class="form-control">
							<label>อีเมล์ <label class="must">*</label></label>
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
							<label>ผ่อน / เช่าอยู่เดือนละ ... (บาท) <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" name="address_year" class="form-control">
							<label>อาศัยมานาน ... (ปี) <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" name="address_month" class="form-control">
							<label>อาศัยมานาน ... (เดือน) <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control" id="address_person" name="address_person">
							<label>จำนวนผู้พักอาศัย ... (คน) <label class="must">*</label></label>
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
							<label>ชื่อบริษัท <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="work_status" class="form-control">
							<label>ลักษณะธุรกิจขององค์กร <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_position" class="form-control">
							<label>ตำแหน่ง <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_department" class="form-control">
							<label>ฝ่ายงาน <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_income" class="form-control">
							<label>รายได้ส่วนบุคคลต่อเดือน ... (บาท) <label class="must">*</label></label>
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
							<label>ที่อยู่ เลขที่ <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_build" class="form-control">
							<label>อาคาร <label class="must">*</label></label>
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
					

					<!-- <div class="col-md-4">
						<div class="form-group" style="padding-top: 8px;">
							<label>เขต / อำเภอ</label>
							<select class="select2 select2-hidden-accessible" name="work_addr_amphur" data-placeholder="กรุณาเลือกเขต/อำเภอ" tabindex="-1" aria-hidden="true">
								<option></option>
							</select>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group" style="padding-top: 8px;">
							<label>แขวง / ตำบล</label>
							<select class="select2 select2-hidden-accessible" name="work_addr_district" data-placeholder="กรุณาเลือกแขวง/ตำบล" tabindex="-1" aria-hidden="true">
								<option></option>
							</select>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div> -->

					<div class="col-md-3">
						<div class="form-group" style="padding-top: 8px;">
							<label>จังหวัด <label class="must">*</label></label>
							<select class="select2 select2-hidden-accessible js-wk-province" name="work_addr_province" data-placeholder="กรุณาเลือกจังหวัด" tabindex="-1" aria-hidden="true">
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
						<div class="form-group" style="padding-top: 8px;">
							<label>เขต / อำเภอ <label class="must">*</label></label>
							<select class="select2 select2-hidden-accessible js-wk-amphur" name="work_addr_amphur" data-placeholder="กรุณาเลือกเขต/อำเภอ" tabindex="-1" aria-hidden="true">
								<option></option>
							</select>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group" style="padding-top: 8px;">
							<label>แขวง / ตำบล <label class="must">*</label></label>
							<select class="select2 select2-hidden-accessible js-wk-district" name="work_addr_district" data-placeholder="กรุณาเลือกแขวง/ตำบล" tabindex="-1" aria-hidden="true">
								<option></option>
							</select>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>

					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_zipcode" class="form-control">
							<label>รหัสไปรษณีย์ <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="work_addr_phone" class="form-control">
							<label>โทรศัพท์ <label class="must">*</label></label>
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
							<label>อายุงาน ... (ปี) <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" name="work_old_month" class="form-control">
							<label>อายุงาน ... (เดือน) <label class="must">*</label></label>
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
						<div class="form-group" style="padding-top: 8px;">
							<label>จังหวัด</label>
							<select class="select2 select2-hidden-accessible js-doc-province" name="doc_addr_province" data-placeholder="กรุณาเลือกจังหวัด" tabindex="-1" aria-hidden="true">
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
						<div class="form-group" style="padding-top: 8px;">
							<label>เขต / อำเภอ</label>
							<select class="select2 select2-hidden-accessible js-doc-amphur" name="doc_addr_amphur" data-placeholder="กรุณาเลือกเขต/อำเภอ" tabindex="-1" aria-hidden="true">
								<option></option>
							</select>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>

					<div class="col-md-3 other-address">
						<div class="form-group" style="padding-top: 8px;">
							<label>แขวง / ตำบล</label>
							<select class="select2 select2-hidden-accessible js-doc-district" name="doc_addr_district" data-placeholder="กรุณาเลือกแขวง/ตำบล" tabindex="-1" aria-hidden="true">
								<option></option>
							</select>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>

					<div class="col-md-3 other-address">
						<div class="form-group form-group--float">
							<input type="text" name="doc_addr_zipcode" class="form-control other-address">
							<label>รหัสไปรษณีย์</label>
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
					<!-- <div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="package_interest1" class="form-control">
							<label>โปรแกรมที่สนใจ 1 <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
 -->
					<div class="col-md-6">
						<div class="form-group" style="padding-top: 8px;">
							<label>โปรแกรมที่สนใจ 1 <label class="must">*</label></label>
							<select class="select2 select2-hidden-accessible" name="package_interest1" data-placeholder="กรุณาเลือกโปรแกรมที่สนใจ 1" tabindex="-1" aria-hidden="true">
								<option></option>
								<option value="โปรแกรมศัลยกรรมตา">โปรแกรมศัลยกรรมตา</option>
								<option value="โปรแกรมศัลยกรรมจมูก">โปรแกรมศัลยกรรมจมูก</option>
								<option value="โปรแกรมศัลยกรรมหน้าอก">โปรแกรมศัลยกรรมหน้าอก</option>
								<option value="โปรแกรมศัลยกรรมกระชับใบหน้าและรูปร่าง (Non surgury)">โปรแกรมศัลยกรรมกระชับใบหน้าและรูปร่าง (Non surgury)</option>
								<option value="โปรแกรมศัลยกรรมดูดไขมัน">โปรแกรมศัลยกรรมดูดไขมัน</option>
							</select>
							<div class="invalid-feedback"></div>
						</div>
					</div>

					<div class="col-md-6">
						<label>กำหนดการที่คาดว่าจะทำ (ระบุปีเป็น ค.ศ.) <label class="must">*</label></label>
						<div class="input-group" style="padding-top: 7px;">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
							</div>
							<!-- <input type="date" class="form-control hidden-md-up" name="package_interest_date1" placeholder="กำหนดการที่คาดว่าจะทำ">
							<input type="text" class="form-control date-picker hidden-sm-down flatpickr-input active" placeholder="กำหนดการที่คาดว่าจะทำ" readonly="readonly" name="package_interest_date1"> -->
							<input type="text" class="form-control DatePicker" name="package_interest_date1" placeholder="กำหนดการที่คาดว่าจะทำ" readonly>
							<div class="invalid-feedback" style="bottom: -1.2rem;"></div>
						</div>
					</div>

					<!-- <div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" name="package_interest2" class="form-control">
							<label>โปรแกรมที่สนใจ 2</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div> -->

					<div class="col-md-6">
						<div class="form-group" style="padding-top: 8px;">
							<label>โปรแกรมที่สนใจ 2</label>
							<select class="select2 select2-hidden-accessible" name="package_interest2" data-placeholder="กรุณาเลือกโปรแกรมที่สนใจ 2" tabindex="-1" aria-hidden="true">
								<option></option>
								<option value="โปรแกรมศัลยกรรมตา">โปรแกรมศัลยกรรมตา</option>
								<option value="โปรแกรมศัลยกรรมจมูก">โปรแกรมศัลยกรรมจมูก</option>
								<option value="โปรแกรมศัลยกรรมหน้าอก">โปรแกรมศัลยกรรมหน้าอก</option>
								<option value="โปรแกรมศัลยกรรมกระชับใบหน้าและรูปร่าง (Non surgury)">โปรแกรมศัลยกรรมกระชับใบหน้าและรูปร่าง (Non surgury)</option>
								<option value="โปรแกรมศัลยกรรมดูดไขมัน">โปรแกรมศัลยกรรมดูดไขมัน</option>
							</select>
							<div class="invalid-feedback"></div>
						</div>
					</div>

					<div class="col-md-6">
						<label>กำหนดการที่คาดว่าจะทำ (ระบุปีเป็น ค.ศ.) </label>
						<div class="input-group" style="padding-top: 7px;">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
							</div>
							<!-- <input type="date" class="form-control hidden-md-up" name="package_interest_date2" placeholder="กำหนดการที่คาดว่าจะทำ">
							<input type="text" class="form-control date-picker hidden-sm-down flatpickr-input active" placeholder="กำหนดการที่คาดว่าจะทำ" readonly="readonly" name="package_interest_date2"> -->
							<input type="text" class="form-control DatePicker" name="package_interest_date2" placeholder="กำหนดการที่คาดว่าจะทำ" readonly>
							<div class="invalid-feedback" style="bottom: -1.2rem;"></div>
						</div>
					</div>
					
					<!-- <div class="col-md-4">
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
					</div> -->
					<!-- <div class="col-md-12">
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
					</div> -->
					<div class="col-md-12">
						<h4>ผู้แนะนำ</h4>
					</div>
					<!-- <div class="col-md-12">
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
					</div> -->
					<div class="col-md-4">
						<div class="form-group" style="padding-top: 8px;">
							<label>รหัสผู้แนะนำ <label class="must">*</label></label>
							<select class="select2 select2-hidden-accessible js-saleagents" name="saleagents_id" data-placeholder="กรุณาเลือกผู้แนะนำ" tabindex="-1" aria-hidden="true" disabled>
								<option></option>
								<?php 
								$sql->table = "saleagents";
								$query = $sql->select();
								while($sale_agent = mysqli_fetch_assoc($query)){
									$sel = '';
									if( !empty($sResult) ){
										if( $sResult["id"] == $sale_agent["id"] ) $sel = 'selected';
									}
									echo '<option '.$sel.' value="'.$sale_agent["id"].'">'.$sale_agent["code"].'</option>';
								}
								?>
							</select>
							<div class="invalid-feedback txt_err"></div>
							<input type="hidden" name="saleagents_id" value="<?=$sResult["id"]?>">
						</div>
						
					</div>
					<div class="col-md-4">
						<div class="form-group" style="margin-top: 7px;">
							<label>ชื่อ</label>
							<input type="text" class="form-control js-saleagents-firstname" readonly>
							
							<!-- <div class="invalid-feedback"></div> -->
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group" style="margin-top: 7px;">
							<label>นามสกุล</label>
							<input type="text" class="form-control js-saleagents-lastname" readonly>
							
							<!-- <div class="invalid-feedback"></div> -->
							<i class="form-group__bar"></i>
						</div>
					</div>
					<!-- <div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_phone" class="form-control">
							<label>โทร</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div> -->
					<!-- <div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_relationship" class="form-control">
							<label>ความสัมพันธ์</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div> -->
					<div class="col-md-12">
						<h4>บุคคลอ้างอิง</h4>
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
							<label>ชื่อ <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_lastname" class="form-control">
							<label>นามสกุล <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_phone" class="form-control">
							<label>โทร <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" name="person_relationship" class="form-control">
							<label>ความสัมพันธ์ <label class="must">*</label></label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>รูปถ่ายพร้อมบัตรประชาชน</h4>
						<label><label class="must">*</label> ถ่ายรูปตัวเองคู่กับบัตรประชาชน</label>
					</div>
					<div class="col-md-12" style="text-align: center;">
						<!-- div class="form-group form-group--float"> -->
							<!-- <input type="file" name="img_upload" class="filestyle form-control" onchange="readURL(this);"> -->
							<label for="file" class="btn btn-info btn--raised" style="margin-top: 20px;">กดเพื่ออัพโหลดรูปถ่าย</label>
							<input type="file" id="file" class="js-img" name="img_idcard" multiple style="visibility: hidden; display: block;" accept="image/*">
							<img class="resp-img" id="js-img" style="max-height: 200px; padding-top: 20px">

							<!-- <label>อัพโหลดรูปถ่าย</label> -->
							<notification class="invalid-feedback"></notification>
							<!-- <i class="form-group__bar"></i>
						</div> -->
					</div>


					<div class="col-md-12" style="margin-top: 20px;">
						<h4>รูปถ่าย Book Bank</h4>
						<label><label class="must">*</label> สามารถอัพโหลดได้สูงสุด 3 รูปเท่านั้น</label>
					</div>

					<div class="col-md-12" style="text-align: center;">
						<label for="ImageMedias" class="btn btn-danger btn--raised" style="margin-top: 20px;">กดเพื่ออัพโหลดรูปถ่าย</label>
						<input type="file" id="ImageMedias" name="img_bookbank[]" accept="image/*" class="custom-file-input" multiple style="visibility: hidden; display: block;">

						<div class="resp-img" id="divImageMediaPreview" style="text-align: center; display: inline-block;"></div>
					</div>
					
					<!-- <div class="col-md-12" style="text-align: center;">
							<inout type="file" name="idcard_img" class="dropzone" id="dropzone-upload">
							<div class="invalid-feedback"></div>
						</div>
					</div> -->
					<div class="col-md-12 js-poll">
						<div class="checkbox" style="text-align: center; padding-top: 50px;">
							<input type="checkbox" id="customCheck1" name="checkconfirm" value="1" class="ck-js-poll">
							<label class="checkbox__label" for="customCheck1">ข้าพเจ้ารับทราบว่า ข้อมูลที่ให้อย่างครบถ้วนนี้ถือเป็นข้อมูลเพื่อประกอบการพิจารณาสินเชื่อ ข้าพเจ้ายืนยันว่าข้อมูลที่กรอกเป็นความจริงทุกประการ โดยยินยอมให้ใช้หรือเปิดเผยข้อมูลส่วนบุคคลที่เกี่ยวข้องกับข้าพเจ้า เพื่อประโยชน์ในการวิเคราะห์สินเชื่อ การออกบัตรเครดิต หรือเพื่อประโยชน์ด้านการศึกษาต่างๆ รวมทั้งเพื่อประโยชน์ในการทบทวนสินเชื่อ ต่ออายุสัญญา และให้ถือว่าคู่ฉบับและบรรดาสำเนาภาพถ่าย (อิเล็กทรอนิกส์) ภาพถ่ายหรือบันทึกไว้ในรูปแบบใด เป็นหลักฐานในการยินยอมของข้าพเจ้าเช่นกัน</label>
						</div>
					</div>

					<div class="col-md-12 pollCheck" style="margin-top: 30px;">
						<h4>โดยปกติใน 1 วันท่านใช้สื่อดิจิตอลมากน้อยเพียงใด</h4>
						<div class="radio radio--inline">
							<input type="radio" name="poll[social_use]" id="socialRadio_1" value="1">
							<label class="radio__label" for="socialRadio_1">ตลอดวัน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[social_use]" id="socialRadio_2" value="2">
							<label class="radio__label" for="socialRadio_2">มากกว่า 12 ชั่วโมงต่อวัน</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[social_use]" id="socialRadio_3" value="3">
							<label class="radio__label" for="socialRadio_3">6 – 12 ชั่วโมงต่อวัน</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[social_use]" id="socialRadio_4" value="4">
							<label class="radio__label" for="socialRadio_4">2 -5 ชั่วโมงต่อวัน</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[social_use]" id="socialRadio_5" value="5">
							<label class="radio__label" for="socialRadio_5">น้อยกว่า 2 ชั่วโมงต่อวัน</label>
						</div>
						
						<br><br><br>
					</div>

					<div class="col-md-12 pollCheck">
						<h4>ในระยะ 2 เดือน ที่ผ่านมาท่านมีประสบการณ์ในการใช้สื่อดิจิตอลเหล่านี้มากน้อยเพียงใด (ให้คะแนน 1-5)</h4>
						<label class="must">*** 1 คือน้อยที่สุด - 5 คือมากที่สุด</label>
						<div class="row" style="background-color: #f3f3f3; padding: 10px 0px 10px 0px; margin-top: 15px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>ใช้เพื่อสื่อสารใน Social Network เช่น Facebook, IG, LINE</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use1]" id="digital1Radio_1" value="1">
							<label class="radio__label" for="digital1Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use1]" id="digital1Radio_2" value="2">
							<label class="radio__label" for="digital1Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use1]" id="digital1Radio_3" value="3">
							<label class="radio__label" for="digital1Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use1]" id="digital1Radio_4" value="4">
							<label class="radio__label" for="digital1Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use1]" id="digital1Radio_5" value="5">
							<label class="radio__label" for="digital1Radio_5">5</label>
						</div>
					</div></div>

						<div class="row" style="padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>ดูหนัง ฟังเพลง เช่น Youtube</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use2]" id="digital2Radio_1" value="1">
							<label class="radio__label" for="digital2Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use2]" id="digital2Radio_2" value="2">
							<label class="radio__label" for="digital2Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use2]" id="digital2Radio_3" value="3">
							<label class="radio__label" for="digital2Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use2]" id="digital2Radio_4" value="4">
							<label class="radio__label" for="digital2Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use2]" id="digital2Radio_5" value="5">
							<label class="radio__label" for="digital2Radio_5">5</label>
						</div>
					</div></div>

						<div class="row" style="background-color: #f3f3f3; padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>สืบค้นข้อมูลบนอินเทอร์เน็ต เช่น Google.com</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use3]" id="digital3Radio_1" value="1">
							<label class="radio__label" for="digital3Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use3]" id="digital3Radio_2" value="2">
							<label class="radio__label" for="digital3Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use3]" id="digital3Radio_3" value="3">
							<label class="radio__label" for="digital3Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use3]" id="digital3Radio_4" value="4">
							<label class="radio__label" for="digital3Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use3]" id="digital3Radio_5" value="5">
							<label class="radio__label" for="digital3Radio_5">5</label>
						</div></div></div>

						<div class="row" style="padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>ธุรกรรมการเงิน เช่น Kbank Plus</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use4]" id="digital4Radio_1" value="1">
							<label class="radio__label" for="digital4Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use4]" id="digital4Radio_2" value="2">
							<label class="radio__label" for="digital4Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use4]" id="digital4Radio_3" value="3">
							<label class="radio__label" for="digital4Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use4]" id="digital4Radio_4" value="4">
							<label class="radio__label" for="digital4Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use4]" id="digital4Radio_5" value="5">
							<label class="radio__label" for="digital4Radio_5">5</label>
						</div></div></div>

						<div class="row" style="background-color: #f3f3f3; padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>ดูข้อมูลท่องเที่ยว เช่น Traveloca</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use5]" id="digital5Radio_1" value="1">
							<label class="radio__label" for="digital5Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use5]" id="digital5Radio_2" value="2">
							<label class="radio__label" for="digital5Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use5]" id="digital5Radio_3" value="3">
							<label class="radio__label" for="digital5Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use5]" id="digital5Radio_4" value="4">
							<label class="radio__label" for="digital5Radio_4">4</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use5]" id="digital5Radio_5" value="5">
							<label class="radio__label" for="digital5Radio_5">5</label>
						</div></div></div>

						<div class="row" style="padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>ทำงาน / ประชุม / E-mail เช่น Hotmail, Gmail</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use6]" id="digital6Radio_1" value="1">
							<label class="radio__label" for="digital6Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use6]" id="digital6Radio_2" value="2">
							<label class="radio__label" for="digital6Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use6]" id="digital6Radio_3" value="3">
							<label class="radio__label" for="digital6Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use6]" id="digital6Radio_4" value="4">
							<label class="radio__label" for="digital6Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use6]" id="digital6Radio_5" value="5">
							<label class="radio__label" for="digital6Radio_5">5</label>
						</div></div></div>

						<div class="row" style="background-color: #f3f3f3; padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>การแสดงความคิดเห็นต่อกลุ่มชุมชนบนอินเตอร์เนต เช่น Pantip</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use7]" id="digital7Radio_1" value="1">
							<label class="radio__label" for="digital7Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use7]" id="digital7Radio_2" value="2">
							<label class="radio__label" for="digital7Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use7]" id="digital7Radio_3" value="3">
							<label class="radio__label" for="digital7Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use7]" id="digital7Radio_4" value="4">
							<label class="radio__label" for="digital7Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use7]" id="digital7Radio_5" value="5">
							<label class="radio__label" for="digital7Radio_5">5</label>
						</div></div></div>

						<div class="row" style="padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>เพื่อติดตามข่าวสาร เช่น Twitter</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use8]" id="digital8Radio_1" value="1">
							<label class="radio__label" for="digital8Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use8]" id="digital8Radio_2" value="2">
							<label class="radio__label" for="digital8Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use8]" id="digital8Radio_3" value="3">
							<label class="radio__label" for="digital8Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use8]" id="digital8Radio_4" value="4">
							<label class="radio__label" for="digital8Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use8]" id="digital8Radio_5" value="5">
							<label class="radio__label" for="digital8Radio_5">5</label>
						</div></div></div>

						<div class="row" style="background-color: #f3f3f3; padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>ช้อปปิ้ง สั่งซื้อสินค้า, ประมูลสินค้า เช่น Lazada, Shopee</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use9]" id="digital9Radio_1" value="1">
							<label class="radio__label" for="digital9Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use9]" id="digital9Radio_2" value="2">
							<label class="radio__label" for="digital9Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use9]" id="digital9Radio_3" value="3">
							<label class="radio__label" for="digital9Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use9]" id="digital9Radio_4" value="4">
							<label class="radio__label" for="digital9Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use9]" id="digital9Radio_5" value="5">
							<label class="radio__label" for="digital9Radio_5">5</label>
						</div></div></div>
						
						<div class="row" style="padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>การเล่นเกมออนไลน์ เช่น ROV, Free Fire, PUBG</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use10]" id="digital10Radio_1" value="1">
							<label class="radio__label" for="digital10Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use10]" id="digital10Radio_2" value="2">
							<label class="radio__label" for="digital10Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use10]" id="digital10Radio_3" value="3">
							<label class="radio__label" for="digital10Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use10]" id="digital10Radio_4" value="4">
							<label class="radio__label" for="digital10Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use10]" id="digital10Radio_5" value="5">
							<label class="radio__label" for="digital10Radio_5">5</label>
						</div></div></div>
						
						<div class="row" style="background-color: #f3f3f3; padding: 10px 0px 10px 0px;">
						<div class="col-md-6" style="margin-top: 6px;"><label>การเล่นการพนันออนไลน์ เช่น ฟุตบอล</label></div>
						<div class="col-md-6"><div class="radio radio--inline">
							<input type="radio" name="poll[digital_use11]" id="digital11Radio_1" value="1">
							<label class="radio__label" for="digital11Radio_1">1</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use11]" id="digital11Radio_2" value="2">
							<label class="radio__label" for="digital11Radio_2">2</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use11]" id="digital11Radio_3" value="3">
							<label class="radio__label" for="digital11Radio_3">3</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use11]" id="digital11Radio_4" value="4">
							<label class="radio__label" for="digital11Radio_4">4</label>
						</div>

						<div class="radio radio--inline">
							<input type="radio" name="poll[digital_use11]" id="digital11Radio_5" value="5">
							<label class="radio__label" for="digital11Radio_5">5</label>
						</div></div></div>
					</div>
						

						<div class="col-md-12 pollCheck" style="margin-top: 30px;">
						<h4>ท่านมีส่วนร่วมในสื่อดิจิทัลในรูปแบบใดบ้าง</h4>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="participateCheck1" name="poll[participate1]" value="1">
							<label class="checkbox__label" for="participateCheck1">โพสต์ (Post)</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="participateCheck2" name="poll[participate2]" value="1">
							<label class="checkbox__label" for="participateCheck2">ไลด์ (Like)</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="participateCheck3" name="poll[participate3]" value="1">
							<label class="checkbox__label" for="participateCheck3">แชร์ (Share)</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="participateCheck4" name="poll[participate4]" value="1">
							<label class="checkbox__label" for="participateCheck4">แท็ก (Tag)</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="participateCheck5" name="poll[participate5]" value="1">
							<label class="checkbox__label" for="participateCheck5">เชค อิน (Check In)</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="participateCheck6" name="poll[participate6]" value="1">
							<label class="checkbox__label" for="participateCheck6">ติดตาม (Subscribe, Follow)</label>
						</div>
						</div>
						
						<div class="col-md-12 pollCheck" style="margin-top: 30px;">
						<h4>ในระยะ 6 เดือนนี้ ท่านมีแนวโน้มจะซื้อสินค้าประเภทใดบ้าง</h4>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="maybe_buyCheck1" name="poll[maybe_buy1]" value="1">
							<label class="checkbox__label" for="maybe_buyCheck1">ยานยนต์</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="maybe_buyCheck2" name="poll[maybe_buy2]" value="1">
							<label class="checkbox__label" for="maybe_buyCheck2">อสังหาริมทรัพย์</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="maybe_buyCheck3" name="poll[maybe_buy3]" value="1">
							<label class="checkbox__label" for="maybe_buyCheck3">เครื่องใช้ไฟฟ้า</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="maybe_buyCheck4" name="poll[maybe_buy4]" value="1">
							<label class="checkbox__label" for="maybe_buyCheck4">สมาร์ทโฟนและอุปกรณ์อิเล็กทรอนิกส์</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="maybe_buyCheck5" name="poll[maybe_buy5]" value="1">
							<label class="checkbox__label" for="maybe_buyCheck5">การลงทุน</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="maybe_buyCheck6" name="poll[maybe_buy6]" value="1">
							<label class="checkbox__label" for="maybe_buyCheck6">การประกัน</label>
						</div>
						<div class="checkbox checkbox--inline">
							<input type="checkbox" id="maybe_buyCheck7" name="poll[maybe_buy7]" value="1">
							<label class="checkbox__label" for="maybe_buyCheck7">การท่องเที่ยว</label>
						</div>
						</div>
					

					<div class="col-md-12" style="text-align: center; margin-top: 50px;">
						<button type="submit" class="btn btn-success btn--raised btn-submit">ส่งใบสมัคร</button>
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
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/2.1.0/bootstrap-filestyle.min.js"></script> -->
<script type="text/javascript">
	// $(":file").filestyle();
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

	$(".pollCheck").hide();
	$(".js-poll").change(function(){
		if( $(this).find('.ck-js-poll').is(":checked") ){
			$(".pollCheck").show();
			$(".poll_txt_err").show();
		}
		else{
			$(".pollCheck").hide();
			$(".poll_txt_err").hide();
		}
	});

	$(".js-saleagents").change(function(){
		$.get( "api/saleagents.php", { id:$(this).val() }, function(result) {
			$(".js-saleagents-firstname").val( result.first_name );
			$(".js-saleagents-lastname").val( result.last_name );
		},"json");
	});

	if( $(".js-saleagents").val() != "" ){
		$.get( "api/saleagents.php", { id:$(".js-saleagents").val() }, function(result) {
			$(".js-saleagents-firstname").val( result.first_name );
			$(".js-saleagents-lastname").val( result.last_name );
		},"json");
	}
// 	    flatpickr(document.getElementById("birthday"), {
//     "locale": "th"
// });
$("#ImageMedias").change(function () {
	if (typeof (FileReader) != "undefined") {
		var dvPreview = $("#divImageMediaPreview");
		dvPreview.html("");            
		$($(this)[0].files).each(function () {
			var file = $(this);                
				var reader = new FileReader();
				reader.onload = function (e) {
					var img = $("<img />");
					img.attr("style", "max-height:200px; margin-top:20px;");
					img.attr("src", e.target.result);
					dvPreview.append(img);
				}
				reader.readAsDataURL(file[0]);                
		});
	} else {
		alert("This browser does not support HTML5 FileReader.");
	}
});
</script>