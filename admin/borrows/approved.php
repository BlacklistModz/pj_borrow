<?php 
// HEADER
include("../layouts/header.php");

//NAVBAR
include($_pathURL."admin/layouts/navbar.php");

//MENU
include($_pathURL."admin/layouts/menu.php");

//EDIT DATA
if( !empty($_GET["id"]) ){
	$sql->table = "borrows b LEFT JOIN customers c ON b.customer_id=c.id";
	$sql->field = "b.*, c.code, c.prefix_name, c.first_name, c.last_name";
	$sql->condition = "WHERE b.id={$_GET["id"]} LIMIT 1";
	$query = $sql->select();
	if( mysqli_num_rows($query) <= 0 ){
		header('location:'.URL.'admin/borrows/?page='.$_GET['page']);
		exit;
	}
	$result = mysqli_fetch_assoc($query);

	//SET FORM
	$_title = "อนุมัติใบขอกู้เงิน";
	$_action = URL."admin/borrows/do_approved.php?page={$_GET["page"]}";
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
						<div class="form-row">
							<div class="form-group col-md-4">
								<label for="status">อนุมัติ / ไม่อนุมัติ</label>
								<select name="status" id="status" class="form-control">
									<option value="">- เลือก -</option>
									<?php 
									foreach (status() as $key => $value) {
										$sel = '';
										if( $result["status"] == $value["id"] ) $sel = 'selected';
										echo '<option value="'.$value["id"].'" '.$sel.'>'.$value["name"].'</option>';
									}
									?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group col-md-4">
								<label for="approve_limit">วงเงิน (บาท)</label>
								<input type="text" class="form-control" id="approve_limit" name="approve_limit" placeholder="วงเงิน (บาท)" value="<?= !empty($result["approve_limit"]) ? number_format($result["approve_limit"], 2) : "" ?>">
								<div class="invalid-feedback"></div>
							</div>
							<div class="form-group col-md-4">
								<label for="approve_period">ระยะเวลา (เดือน)</label>
								<select name="approve_period" id="approve_period" class="form-control">
									<option value="">- เลือก -</option>
									<?php 
									foreach (period() as $key => $value) {
										$sel = '';
										if( !empty($result["approve_period"]) ){
											if( $result["approve_period"] == $value["id"] ) $sel = 'selected';
										}
										echo '<option value="'.$value["id"].'" '.$sel.'>'.$value["name"].'</option>';
									}
									?>
								</select>
								<div class="invalid-feedback"></div>
							</div>
						</div>
						<?php 
						if( !empty($result["id"]) ) echo '<input type="hidden" name="id" value="'.$result["id"].'">';
						?>
					</div>
					<div class="card-footer">
						<div class="clearfix">
							<a href="<?=URL?>admin/borrows/?page=<?=$_GET["page"]?>" class="btn btn-danger float-left">
								<i class="fa fa-arrow-left"></i> กลับหน้าหลัก
							</a>
							<button type="submit" class="btn btn-primary btn-submit float-right">
								<i class="fa fa-save"></i> บันทึกข้อมูล
							</button>
						</div>
					</div>
				</form>
			</div>
			<div class="card mt-2">
				<h5 class="ml-2 mt-2 mb-2"><i class="fa fa-file-pdf"></i> ใบสมัครขอกู้เงิน <?=$result["code"]?> : <?=showPrefixName($result["prefix_name"])?><?=$result["first_name"]?> <?=$result["last_name"]?> (วันที่ <?=dateTH($result["date"])?>)</h5>
				<div class="text-center m-1">
					<iframe src="<?=URL?>admin/borrows/pdf.php?id=<?=$result["id"]?>" type=frame&vlink=xx&link=xx&css=xxx&bg=xx&bgcolor=xx marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scorlling=yes width="100%" height="1024"></iframe>
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

<script type="text/javascript">
	$.fn.changeStatus = function( value ){
		if( value == 1 ){
			$("[name=approve_limit]").attr("disabled", false);
			$("[name=approve_period]").attr("disabled", false);
		}
		else{
			$("[name=approve_limit]").attr("disabled", true);
			$("[name=approve_period]").attr("disabled", true);
		}
	};

	//LOAD FIRST TIME
	$.fn.changeStatus( $("[name=status]").val() );

	//IF CHANGE
	$("[name=status]").change(function(){
		$.fn.changeStatus( $(this).val() );
	});
</script>