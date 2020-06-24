<?php
include("../../config.php");
include("../../app/SQLiManager.php");

$sql = new SQLiManager();

$sql->table = "borrows";
$sql->condition = "WHERE id={$_GET["id"]}";
$query = $sql->select();
if( mysqli_num_rows($query) < 0 ){
	$arr["type"] = "error";
	$arr["title"] = "ไม่พบข้อมูลที่ต้องการลบ";
	$arr["status"] = 422;
}
else{
	$old = mysqli_fetch_assoc($query);

	/* GET BOOKBANK DATA */
	$sql->table = "borrow_bookbanks";
	$sql->condition = "WHERE borrow_id={$old['id']}";
	$query = $sql->select();
	while($img = mysqli_fetch_assoc($query)){
		if( file_exists( WWW_UPLOADS.$img['img_bookbank'] ) ){
			unlink( WWW_UPLOADS.$img['img_bookbank'] );
		}
	}
	/* Delete bookbank */
	$sql->delete();
	/* End */

	/* Delete IDCard */
	if( !empty($old['img_idcard']) ){
		if( file_exists( WWW_UPLOADS.$old['img_idcard'] ) ){
			unlink( WWW_UPLOADS.$old['img_idcard'] );
		}
	}
	/**/

	/* Delete Borrows */
	$sql->table = "borrows";
	$sql->condition = "WHERE id={$old['id']}";
	if( $sql->delete() ){
		$arr = [
			'type' => 'success',
			'title' => 'ลบข้อมูลเรียบร้อยแล้ว',
			'status' => 200,
			'url' => 'refresh'
		];
	}
	else{
		$arr = [
			'type' => 'error',
			'title' => 'ไม่สามารถลบข้อมูลได้',
			'status' => 200
		];
	}
	/**/
}

echo json_encode($arr);