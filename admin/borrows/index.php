<?php 
$_title = "ข้อมูลใบขอกู้เงิน";
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

$sql->table = "borrows b LEFT JOIN customers c ON b.customer_id = c.id";
$query = $sql->select();
?>
<!-- Content -->
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
					<table class="table table-bordered DataTable">
						<thead class="table-dark text-center">
							<tr>
								<th width="5%">#</th>
								<th width="10%">วันที่สมัคร</th>				
								<th width="10%">รหัสลูกค้า</th>
								<th width="20%">ชื่อ-นามสกุล</th>
								<th width="10%">สถานะ</th>
								<th width="5%">หลักฐาน</th>
								<th width="5%">อนุมัติ</th>
								<th width="5%">พิมพ์</th>
								<th width="10%">วงเงินที่อนุมัติ</th>
								<th width="10%">ระยะเวลา</th>
								<th width="10%">จัดการ</th>
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
									
									
									<td class="text-center"><?=$result["code"] ?></td>
									<td><?=showPrefixName($result["prefix_name"])." ".$result["first_name"]." ".$result["last_name"]?></td>
									<td class="text-center">
										<?php
										$status = getStatus($result["status"]);
										echo '<a class="'.$status['class'].' text-white">'.$status['name'].'</a>';
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

									<td class="text-center"><button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default"><i class="far fa-image"></i></button></td>
									
									<td class="text-center">
										<a href="<?=URL?>admin/borrows/approved.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-primary btn-sm text-white" title="อนุมัติ / ไม่อนุมัติ">
											<i class="fa fa-info-circle"></i>
										</a>
									</td>
									<td class="text-center">
										<a href="<?=URL?>admin/borrows/pdf.php?id=<?=$result["id"]?>" target="_blank" class="btn btn-info btn-sm"><i class="far fa-file-pdf"></i></a>
									</td>

									<td class="text-center"><?php if ($result["approve_limit"] != 0.00 ) { echo number_format($result["approve_limit"]).'.-'; } ?></td>

									<td class="text-center"><?php if ($result["approve_period"] != 0 ) { echo $result["approve_period"].' เดือน'; } ?></td>

									<td class="text-center">

										<a href="<?=URL?>admin/borrows/forms.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-warning btn-sm text-white" title="แก้ไขข้อมูล">
											<i class="fa fa-pen"></i>
										</a>

										<?php 
										$ops = [
											"title" => "ยืนยันการลบข้อมูล",
											"text" => "คุณต้องการลบข้อมูล ".$result["idcard"]. "หรือไม่ ?",
											"btnconfirm" => "btn btn-danger m-1",
											"textconfirm" => "ลบข้อมูล"
										];
										?>
										<a href="<?=URL?>admin/borrows/delete.php?page=<?=$_GET["page"]?>&id=<?=$result["id"]?>" class="btn btn-danger btn-confirm btn-sm" data-title="ยืนยันการลบข้อมูล" data-options="<?=stringify($ops)?>">
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

<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Default Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

<!-- End Content -->
<?php
//FOOTER
include($_pathURL."admin/layouts/footer.php");
?>