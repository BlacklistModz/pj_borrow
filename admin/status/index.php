<?php 
$_title = "สถานะการสมัคร";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

$sql->table = "borrows b LEFT JOIN customers c ON b.customer_id = c.id LEFT JOIN saleagents s ON b.saleagents_id=s.id";
$sql->field = "b.*, c.code, c.prefix_name, c.first_name, c.last_name, c.idcard, s.code as sale_code";
$sql->condition = "ORDER BY b.id DESC";
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
								<th width="7%">เลขที่ใบสมัคร</th>
								<th width="15%">ชื่อ-นามสกุล</th>
								<th width="15%">อาชีพ</th>
								<th width="8%">วงเงินที่ได้รับอนุมัติ</th>
								<th width="7%">สถานะ</th>
								<th width="9%">วันที่เอกสารครบ</th>
								<th width="3%">คลินิก</th>
								<th width="7%">วันที่อนุมัติ</th>
								<th width="8%">วันที่ติดต่อลูกค้า</th>
								<th width="11%">วันที่ลูกค้าทำศัลกรรม</th>
								<th width="7%">วันที่โอนเงิน</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							$no = 1;
							while($result = mysqli_fetch_assoc($query)){
								?>
								<tr>
									<td class="text-center"><?=$no++?></td>
									<td class="text-center"><?=$result["app_number"]?></td>
									<td><?=showPrefixName($result["prefix_name"])." ".$result["first_name"]." ".$result["last_name"]?></td>
									<td class="text-center"><?= !empty($result["work_position"]) ? $result["work_position"] : "-" ?></td>
									<td class="text-center"><?php if ($result["approve_limit"] != 0.00 ) { echo number_format($result["approve_limit"]).'.-'; } ?></td>
									<td class="text-center">
										<?php
											$status = getStatus($result["status"]);
											echo '<a class="'.$status['class'].' text-setup">'.$status['name'].'</a>';
										?>
									</td>
									<td class="text-center">
										<a data-plugins="modal" href="<?=URL?>admin/status/doc_completed.php?&id=<?=$result["id"]?>" class="btn btn-info btn--sh btn-sm text-white" title="วันที่เอกสารครบ">
											<i class="fas fa-file-alt"></i>
										</a>
									</td>

									<td class="text-center">
										<a data-plugins="modal" href="<?=URL?>admin/status/clinic.php?&id=<?=$result["id"]?>" class="btn btn-danger btn--sh btn-sm text-white" title="คลินิก">
											<i class="fas fa-clinic-medical"></i>
										</a>
									</td>
									
									<td class="text-center">
										<a data-plugins="modal" href="<?=URL?>admin/status/approved_date.php?&id=<?=$result["id"]?>" class="btn btn-warning btn--sh btn-sm text-white" title="วันที่อนุมัติ">
											<i class="fas fa-clipboard-check"></i>
										</a>
									</td>

									<td class="text-center">
										<a data-plugins="modal" href="<?=URL?>admin/status/contact_date.php?&id=<?=$result["id"]?>" class="btn btn-success btn--sh btn-sm text-white" title="วันที่ติดต่อลูกค้า">
											<i class="fas fa-address-book"></i>
										</a>
									</td>
									
									<td class="text-center">
										<a data-plugins="modal" href="<?=URL?>admin/status/made_date.php?&id=<?=$result["id"]?>" class="btn btn-primary btn--sh btn-sm text-white" title="วันที่ทำศัลกรรม">
											<i class="fas fa-syringe"></i>
										</a>
									</td>

									<td class="text-center">
										<a data-plugins="modal" href="<?=URL?>admin/status/transfer_date.php?&id=<?=$result["id"]?>" class="btn btn-dark btn--sh btn-sm text-white" title="วันที่โอนเงิน">
											<i class="fas fa-file-invoice-dollar"></i>
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