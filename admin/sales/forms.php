<?php 
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

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
}
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="clearfix">
						<h4 class="m-0 text-dark float-left"><?= !empty($_title) ? $_title : "" ?></h4>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="card">
				<form class="form-submit" action="<?=$_action?>" method="POST">
					<div class="card-body">
						<div class="form-group">
							<label for="code">รหัส</label>
							<input type="text" class="form-control" id="code" name="code" placeholder="รหัส (หากไม่กรอก ระบบจะดำเนินการให้อัตโนมัติ)" value="<?= !empty($result["code"]) ? $result["code"] : "" ?>">
							<div class="invalid-feedback"></div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-2">
								<label for="prefix_name">คำนำหน้า</label>
								<select name="prefix_name" id="prefix_name" class="form-control">
									<option value="">- คำนำหน้า -</option>
									<?php 
									foreach (prefix() as $key => $value) {
										$sel = '';
										if( !empty($result["prefix_name"]) ){
											if( $result["prefix_name"] == $value["id"] ) $sel = 'selected="1"';
										}
										echo '<option value="'.$value["id"].'" '.$sel.'>'.$value["name"].'</option>';
									}
									?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group col-md-5">
								<label for="prefix_name">ชื่อ (ภาษาไทย)</label>
								<input type="text" class="form-control" id="first_name" name="first_name" placeholder="ชื่อ (ภาษาไทย)" value="<?= !empty($result["first_name"]) ? $result["first_name"] : "" ?>">
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group col-md-5">
								<label for="prefix_name">นามสกุล (ภาษาไทย)</label>
								<input type="text" class="form-control" id="last_name" name="last_name" placeholder="นามสกุล (ภาษาไทย)" value="<?= !empty($result["last_name"]) ? $result["last_name"] : "" ?>">
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="idcard">รหัสประจำตัวประชาชน</label>
							<input type="text" class="form-control" id="idcard" name="idcard" placeholder="รหัสประจำตัวประชาชน" value="<?= !empty($result["idcard"]) ? $result["idcard"] : "" ?>" maxlength="13">
							<div class="invalid-feedback"></div>
						</div>
						<?php 
						if( !empty($result["id"]) ) echo '<input type="hidden" name="id" value="'.$result["id"].'">';
						?>
					</div>
					<div class="card-footer">
						<div class="clearfix">
							<a href="<?=URL?>admin/sales/?page=<?=$_GET["page"]?>&sub=<?=$_GET["sub"]?>" class="btn btn-danger float-left">
								<i class="fa fa-arrow-left"></i> กลับหน้าหลัก
							</a>
							<button type="submit" class="btn btn-primary btn-submit float-right">
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