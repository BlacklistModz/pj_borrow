<?php 
include("layouts/head.php");
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
							<input type="radio" name="prefix" id="customRadio1" checked>
							<label class="radio__label" for="customRadio1">นาย</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="prefix" id="customRadio2">
							<label class="radio__label" for="customRadio2">นาง</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="prefix" id="customRadio3">
							<label class="radio__label" for="customRadio3">นางสาว</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input name="firstname" id="firstname" type="text" class="form-control">
							<label>ชื่อ (ภาษาไทย)</label>
							<div class="invalid-feedback"></div>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" name="lastname" class="form-control">
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
							<input type="text" class="form-control date-picker hidden-sm-down flatpickr-input active" placeholder="กรุณากรอก วัน/เดือน/ปีเกิด" readonly="readonly">
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
							<input type="date" class="form-control hidden-md-up" placeholder="กรุณากรอกวันหมดอายุ">
							<input type="text" class="form-control date-picker hidden-sm-down flatpickr-input active" placeholder="กรุณากรอกวันหมดอายุ" readonly="readonly">
						</div>
					</div>
					<div class="col-md-12">
						<h4>ระดับการศึกษา</h4>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio2" id="customRadio4" checked>
							<label class="radio__label" for="customRadio4">ประถมศึกษา</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio2" id="customRadio5">
							<label class="radio__label" for="customRadio5">มัธยมศึกษา</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio2" id="customRadio6">
							<label class="radio__label" for="customRadio6">ปวช. / ปวส. / ปวท.</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio2" id="customRadio7">
							<label class="radio__label" for="customRadio7">ปริญญาตรี</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio2" id="customRadio8">
							<label class="radio__label" for="customRadio8">สูงกว่าปริญญาตรี</label>
						</div>
						<br><br><br>
					</div>
					<div class="col-md-12">
						<h4>สถานภาพครอบครัว</h4>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio3" id="customRadio9" checked>
							<label class="radio__label" for="customRadio4">โสด</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio3" id="customRadio10">
							<label class="radio__label" for="customRadio5">สมรส</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio3" id="customRadio11">
							<label class="radio__label" for="customRadio6">หย่า</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio3" id="customRadio12">
							<label class="radio__label" for="customRadio7">หม้าย</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ชื่อคู่สมรส</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>เบอร์โทร</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>อาชีพคู่สมรส</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>จำนวนบุตร / ธิดา</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>รายได้คู่สมรสต่อเดือน</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>ที่อยู่ปัจจุบัน</h4>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>เลขที่</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>เลขที่ห้องพัก</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ซอย</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ถนน</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>แขวง / ตำบล</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>เขต / อำเภอ</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group" style="padding-top: 8px;">
							<label>จังหวัด</label>
							<select class="select2 select2-hidden-accessible" data-placeholder="กรุณาเลือกจังหวัด" tabindex="-1" aria-hidden="true">
								<option></option>
								<option>กรุงเทพมหานคร</option>
								<option>เชียงใหม่</option>
								<option>ลำปาง</option>
								<option>ขอนแก่น</option>
								<option>สงขลา</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>รหัสไปปรษณีย์</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>โทรศัพท์บ้าน</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>โทรศัพท์มือถือ</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>อีเมล์</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>ลักษณะที่อยู่อาศัย</h4>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio4" id="customRadio13" checked>
							<label class="radio__label" for="customRadio13">บ้านเดี่ยว</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio4" id="customRadio14">
							<label class="radio__label" for="customRadio14">บ้านแฝด</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio4" id="customRadio15">
							<label class="radio__label" for="customRadio15">ทาวน์เฮาส์</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio4" id="customRadio16">
							<label class="radio__label" for="customRadio16">อาคารพาณิชย์</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio4" id="customRadio17">
							<label class="radio__label" for="customRadio17">คอนโดมิเนียม</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio4" id="customRadio18">
							<label class="radio__label" for="customRadio18">อพาร์ทเม้นท์ / หอพัก</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio4" id="customRadio19">
							<label class="radio__label" for="customRadio19">อื่นๆ</label>
						</div>
						<br><br><br>
					</div>
					<div class="col-md-12">
						<h4>สถานภาพที่อยู่อาศัย</h4>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio5" id="customRadio20" checked>
							<label class="radio__label" for="customRadio20">เป็นบ้านของตนเอง</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio5" id="customRadio21">
							<label class="radio__label" for="customRadio21">เป็นบ้านของสมาชิกในครอบครัว</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio5" id="customRadio22">
							<label class="radio__label" for="customRadio22">บ้านพักบริษัท</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio5" id="customRadio23">
							<label class="radio__label" for="customRadio23">อาศัยอยู่กับเพื่อน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio5" id="customRadio24">
							<label class="radio__label" for="customRadio24">บ้านเช่า</label>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ผ่อน / เช่าอยู่เดือนละ ... (บาท)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>อาศัยมานาน ... (ปี)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>อาศัยมานาน ... (เดือน)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>จำนวนผู้พักอาศัย ... (คน)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>ข้อมูลการทำงาน</h4>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ชื่อบริษัท</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ลักษณะธุรกิจขององค์กร</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ตำแหน่ง</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ฝ่ายงาน</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>รายได้ส่วนบุคคลต่อเดือน ... (บาท)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>รายได้ส่วนบุคคลอื่นๆ ต่อเดือน ... (บาท)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>แหล่งที่มาของรายได้อื่นๆ</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ที่อยู่ เลขที่</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>อาคาร</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ชั้น</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>เลขที่</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ซอย</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ถนน</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>แขวง / ตำบล</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>เขต / อำเภอ</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group" style="padding-top: 8px;">
							<label>จังหวัด</label>
							<select class="select2 select2-hidden-accessible" data-placeholder="กรุณาเลือกจังหวัด" tabindex="-1" aria-hidden="true">
								<option></option>
								<option>กรุงเทพมหานคร</option>
								<option>เชียงใหม่</option>
								<option>ลำปาง</option>
								<option>ขอนแก่น</option>
								<option>สงขลา</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>รหัสไปปรษณีย์</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>โทรศัพท์</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>เบอร์ต่อ</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>เบอร์แฟ็กซ์</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>อายุงาน ... (ปี)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>อายุงาน ... (เดือน)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12 js-other">
						<h4>สถานจัดส่งเอกสาร</h4>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio6" id="customRadio25" value="1" checked>
							<label class="radio__label" for="customRadio25">ที่อยู่ปัจจุบัน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio6" id="customRadio26" value="2">
							<label class="radio__label" for="customRadio26">ที่อยู่ที่ทำงาน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio6" id="customRadio27" class="js-other-address" value="3">
							<label class="radio__label" for="customRadio27">อื่นๆ โปรดระบุ</label>
						</div>
						<br><br>
						<div class="invalid-feedback"></div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<textarea class="form-control textarea-autosize other-address" placeholder="กรุณากรอกที่อยู่อื่นๆ..." style="overflow: hidden; overflow-wrap: break-word; height: 51px;" name="address"></textarea>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>วัตถุประสงค์การขอกู้</h4>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>สถานประกอบการ / คลินิก</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>โปรแกรมที่ขอกู้</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ราคา ... (บาท)</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<h4>ระยะเวลาผ่อนชำระ</h4>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio7" id="customRadio28" checked>
							<label class="radio__label" for="customRadio28">3 เดือน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio7" id="customRadio29">
							<label class="radio__label" for="customRadio29">6 เดือน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio7" id="customRadio30">
							<label class="radio__label" for="customRadio30">9 เดือน</label>
						</div>
						<div class="radio radio--inline">
							<input type="radio" name="customRadio7" id="customRadio31">
							<label class="radio__label" for="customRadio31">12 เดือน</label>
						</div>
						<br><br>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>บุคคลอ้างอิง 1.ชื่อ-นามสกุล</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>โทร</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ความสัมพันธ์</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>บุคคลอ้างอิง 2.ชื่อ-นามสกุล</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>โทร</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group form-group--float">
							<input type="text" class="form-control">
							<label>ความสัมพันธ์</label>
							<i class="form-group__bar"></i>
						</div>
					</div>
					<div class="col-md-12">
						<div class="checkbox" style="text-align: center; padding-top: 50px;">
							<input type="checkbox" id="customCheck1">
							<label class="checkbox__label" for="customCheck1">ข้าพเจ้าขอยอมรับว่าข้อมูลที่กรอกเป็นความจริง</label>
						</div>
					</div>
					<div class="col-md-12" style="text-align: center;margin-top: 50px;">
						<button type="submit" class="btn btn-info btn-submit">ส่งใบสมัคร</button>
					</div>
				</form>
			</div>
			<footer class="footer hidden-xs-down">
				<p>© สงวนลิขสิทธิ์ บริษัท สบายใจมันนี่ จํากัด</p>
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
		}
		else{
			$(".other-address").hide();
		}
	});
</script>