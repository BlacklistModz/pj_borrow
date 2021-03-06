<?php 
$_title = "ข้อมูลลูกค้า";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

$sql->table = "customers";
$query = $sql->select();
?>
<!-- Content -->
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="clearfix">
						<h4 class="m-0 text-dark float-left"><i class="fa fa-user"></i> <?= !empty($_title) ? $_title : "" ?></h4>
						<!-- <a href="<?=URL?>admin/customers/forms.php?page=<?=$_GET["page"]?>" class="btn btn-primary float-right"><i class="fa fa-plus"></i> เพิ่มข้อมูล</a> -->

						<a href="<?=URL?>admin/customers/exportExcel.php" class="btn btn-success btn--sh float-right mr-3"><i class="fa fa-file-excel mr-1"></i> Export Excel</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="content">
		<div class="container-fluid">
			<div class="card p-3">
				<div class="table-responsive">
					<table class="table table-striped table-bordered DataTable" style="border: 1px solid #343a40;">
						<thead class="table-dark text-center" style="background-color: #343a40;">
							<tr>
								<th width="5%">#</th>
								<th width="12%">รหัสลูกค้า</th>
								<th width="15%">ชื่อ-นามสกุล</th>
								<th width="10%">บัตรประชาชน</th>
								<th width="5%">เพศ</th>
								<th width="18%">อาชีพ</th>
								<th width="10%">รายได้</th>
								<th width="15%">ปรับปรุงเมื่อ</th>
								<th width="10%">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							while($result = mysqli_fetch_assoc($query)){

								$sql->table = "borrows";
								$sql->field = "work_position, work_income";
								$sql->condition = "WHERE customer_id={$result["id"]} ORDER BY id DESC LIMIT 1";
								$bQuery = $sql->select();
								$borrows = mysqli_fetch_assoc($bQuery);

								?>
								<tr>
									<td class="text-center"><?=$no++?></td>
									<td class="text-center"><?=$result["code"]?></td>
									<td><?=showPrefixName($result["prefix_name"])." ".$result["first_name"]." ".$result["last_name"]?></td>
									<td class="text-center"><?=$result["idcard"]?></td>
									<td class="text-center">
										<?php
										if( !empty($result["sex"]) ){
											echo showSex($result["sex"]);
										}
										else{
											echo "-";
										}
										?>
									</td>
									<td class="text-center"><?= !empty($borrows["work_position"]) ? $borrows["work_position"] : "-" ?></td>
									<td class="text-center"><?= !empty($borrows["work_income"]) ? number_format($borrows["work_income"]).'.-' : "-" ?></td>
									<td class="text-center">
										<?php 
										if( !empty($result["updated_at"]) ){
											echo dateTH($result["updated_at"],0,1);
										}
										else{
											echo dateTH($result["created_at"],0,1);
										}
										?>
									</td>
									<td class="text-center">

										<a href="<?=URL?>admin/customers/forms.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-warning btn-sm btn--sh text-white" title="แก้ไขข้อมูล">
											<i class="fa fa-pen"></i>
										</a>
										<?php 
										$ops = [
											"title" => "ยืนยันการลบข้อมูล",
											"text" => "คุณต้องการลบข้อมูล ".$result["code"]. " หรือไม่ ?",
											"btnconfirm" => "btn btn-danger m-1",
											"textconfirm" => "ลบข้อมูล"
										];
										?>
										<a href="<?=URL?>admin/customers/delete.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-danger btn-confirm btn-sm btn--sh" data-title="ยืนยันการลบข้อมูล" data-options="<?=stringify($ops)?>">
											<i class="fa fa-trash"></i>
										</a>

									</td>
								</tr>
								<?php
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>
<!-- End Content -->
<?php
//FOOTER
include($_pathURL."admin/layouts/footer.php");
?>