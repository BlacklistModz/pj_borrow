<?php 
$_title = "ตั้งค่าข้อมูลผู้ใช้งาน";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

$sql->table = "users";
$sql->condition = "WHERE id='{$_SESSION["admin"]}' LIMIT 1";
$result = mysqli_fetch_assoc($sql->select());
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="clearfix">
						<h4 class="m-0 text-dark float-left"><i class="fa fa-user"></i> <?= !empty($_title) ? $_title : "" ?></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<form class="form-submit" action="<?=URL?>admin/profile/save.php" method="POST">
					<div class="card-body">
						<div class="row">
						<div class="col-md-6">
						<div class="form-group">
							<label for="name">ชื่อ-นามสกุล</label>
							<input type="name" class="form-control" id="name" name="name" placeholder="กรอกชื่อ-นามสกุล" value="<?=$result["name"]?>">
							<div class="invalid-feedback"></div>
						</div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
							<label for="username">ชื่อผู้ใช้ (Username)</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?=$result["username"]?>">
							<div class="invalid-feedback"></div>
						</div>
						</div>
						</div>
						<input type="hidden" name="id" value="<?=$result["id"]?>">
						<input type="hidden" name="action" value="profile">
					</div>
					<div class="card-footer">
						<div class="clearfix">
							<button class="btn btn-warning btn--sh float-left text-white" type="reset"><i class="fas fa-eraser"></i> ยกเลิก</button>
							<button type="submit" class="btn btn-primary btn-submit btn--sh float-right">
								<i class="fa fa-save"></i> บันทึกข้อมูล
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<!-- End Content -->
<?php
//FOOTER
include($_pathURL."admin/layouts/footer.php");
?>