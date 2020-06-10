<?php 
include("../../config.php"); // use for varible;
include("../../app/SQLiManager.php");
include("../../app/fn.php"); // use function on this page

$ops = [
	"title" => "Sabaijai_Loan",
	"file" => "../../public/file_mpdf/Sabaijai_loan.pdf",
	"file_template" => true,
	"css" => [
		URL."pdf.css"
	]
];

if( empty($_GET["id"]) ){
	header('location:'.URL.'admin/borrows/?page=borrows');
}

$sql = new SQLiManager();
$sql->table = "borrows b LEFT JOIN customers c ON b.customer_id=c.id";
$sql->condition = "WHERE b.id={$_GET["id"]} LIMIT 1";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	header('location:'.URL.'admin/borrows/?page=borrows');
}

$result = mysqli_fetch_assoc($query);

//SET DATA
$date = date("d", strtotime($result["date"]));
$month = date("m", strtotime($result["date"]));
$year = date("Y", strtotime($result["date"]));

$age = getAge($result["birthday"]);

// USE $html for content page //
$html = '
	<!-- DATE -->
	<div style="position: absolute; top: 119px; left: 586px; width: 50px;"> '.$date[0].' </div>
	<div style="position: absolute; top: 119px; left: 604px; width: 50px;"> '.$date[1].' </div>
	<div style="position: absolute; top: 119px; left: 631px; width: 50px;"> '.$month[0].' </div>
	<div style="position: absolute; top: 119px; left: 649px; width: 50px;"> '.$month[1].' </div>
	<div style="position: absolute; top: 119px; left: 674px; width: 50px;"> '.$year[0].' </div>
	<div style="position: absolute; top: 119px; left: 692px; width: 50px;"> '.$year[1].' </div>
	<div style="position: absolute; top: 119px; left: 710px; width: 50px;"> '.$year[2].' </div>
	<div style="position: absolute; top: 119px; left: 728px; width: 50px;"> '.$year[3].' </div>

	<div class="pdf_name"> '.showPrefixName($result["prefix_name"]).''.$result["first_name"].' &nbsp; '.$result["last_name"].' </div>
	<div class="pdf_birth b-1">'.date("d", strtotime($result["birthday"])).'</div>
	<div class="pdf_birth b-2">'.date("m", strtotime($result["birthday"])).'</div>
	<div class="pdf_birth b-3">'.(date("Y", strtotime($result["birthday"]))+543).'</div>
	<div class="pdf_yold y-1">'.$age["year"].'</div>
	<div class="pdf_yold y-2">'.$age["month"].'</div>
';



$_startPathVendor = "../../";
include "../../mpdf/display.php";
?>