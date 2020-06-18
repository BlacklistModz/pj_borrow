<?php 
$_title = "ข้อมูลใบขอกู้เงิน";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

$sql->table = "borrows b LEFT JOIN customers c ON b.customer_id = c.id LEFT JOIN saleagents s ON b.saleagents_id=s.id";
$sql->field = "b.*, c.code, c.prefix_name, c.first_name, c.last_name, c.idcard, s.code as sale_code";
$query = $sql->select();
?>
<!-- Content -->

<style>
	.modal-body {
		max-height: 640px;
		overflow-y: auto;
</style>
<div class="content-wrapper">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="clearfix">
						<h4 class="m-0 text-dark float-left"><i class="fa fa-text"></i> <?= !empty($_title) ? $_title : "" ?></h4>
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
								<th width="3%">#</th>
								<th width="10%">วันที่สมัคร</th>	
								<th width="7%">Agent</th>			
								<th width="10%">รหัสลูกค้า</th>
								<th width="22%">ชื่อ-นามสกุล</th>
								<th width="10%">สถานะ</th>
								<th width="7%">หลักฐาน</th>
								<th width="5%">อนุมัติ</th>
								<th width="5%">พิมพ์</th>
								<th width="9%">วงเงินที่อนุมัติ</th>
								<th width="7%">ระยะเวลา</th>
								<th width="5%">จัดการ</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							while($result = mysqli_fetch_assoc($query)){
								?>
								<tr>
									<td class="text-center"><?=$no++?></td>
									<td class="text-center"><?=DateTH($result["date"])?></td>
									
									<td class="text-center"><?=$result["sale_code"]?></td>
									
									<td class="text-center"><?=$result["code"] ?></td>
									<td><?=showPrefixName($result["prefix_name"])." ".$result["first_name"]." ".$result["last_name"]?></td>
									<td class="text-center">
										<?php
										$status = getStatus($result["status"]);
										// echo '<a class="'.$status['class'].' text-white">'.$status['name'].'</a>';
										echo '<a class="'.$status['class'].' text-setup">'.$status['name'].'</a>';
										?>
										<!-- <select class="form-control js-select" data-url="<?=URL?>admin/borrows/change_status.php" data-id="<?=$result["id"]?>"> -->
											<?php 
											// foreach (status() as $key => $value) {
											// 	$sel = "";
											// 	if( $result["status"] == $value["id"] ) $sel = "selected";
											// 	echo '<option value="'.$value["id"].'" '.$sel.'>'.$value["name"].'</option>';
											// }
											?>
										<!-- </select> -->
									</td>

									<td class="text-center">
										<!-- <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="far fa-image"></i></button> -->
										<a href="<?=URL?>admin/borrows/dataModal.php?id=<?=$result["id"]?>" data-plugins="modal" class="btn btn-primary btn-sm btn--sh">แสดง</a>
									</td>
									
									<td class="text-center">
										<a href="<?=URL?>admin/borrows/approved.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-warning btn-sm btn--sh text-white" title="อนุมัติ / ไม่อนุมัติ">
											<i class="fa fa-info-circle"></i>
										</a>
									</td>
									<td class="text-center">
										<a href="<?=URL?>admin/borrows/pdf.php?id=<?=$result["id"]?>" target="_blank" class="btn btn-success btn-sm btn--sh"><i class="far fa-file-pdf"></i></a>
									</td>

									<td class="text-center"><?php if ($result["approve_limit"] != 0.00 ) { echo number_format($result["approve_limit"]).'.-'; } ?></td>

									<td class="text-center"><?php if ( !empty($result["approve_period"]) ) { echo $result["approve_period"].' เดือน'; } ?></td>

									<td class="text-center">

										<!-- <a href="<?=URL?>admin/borrows/forms.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-warning btn-sm text-white" title="แก้ไขข้อมูล">
											<i class="fa fa-pen"></i>
										</a> -->

										<?php 
										$ops = [
											"title" => "ยืนยันการลบข้อมูล",
											"text" => "คุณต้องการลบข้อมูลใบสมัครสินเชื่อนี้หรือไม่ ?",
											"btnconfirm" => "btn btn-danger m-1",
											"textconfirm" => "ลบข้อมูล"
										];
										?>
										<a href="<?=URL?>admin/borrows/delete.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-danger btn-confirm btn-sm btn--sh" data-title="ยืนยันการลบข้อมูล" data-options="<?=stringify($ops)?>">
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