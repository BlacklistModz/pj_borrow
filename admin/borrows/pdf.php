<?php 
include("../../config.php"); // use for varible;
include("../../app/SQLiManager.php");

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

$prefix = $result["prefix_name"];
if ($prefix = 1) { $pre = "นาย";}
elseif ($prefix = 2) { $pre = "นาง";}
elseif ($prefix = 3) { $pre = "นางสาว";}

$y_o = substr($result["birthday"],0,-6) +543;
$m_o = substr($result["birthday"],5,-3);
$m_ol = date("m");
$y_ol = date("Y")+543;
$y_old = $y_ol - $y_o;
$m_old = $m_ol - $m_o;


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

	<div class="pdf_name"> '.$pre.''.$result["first_name"].' &nbsp; '.$result["last_name"].' </div>
	<div class="pdf_birth b-1">'.substr($result["birthday"],8).'</div>
	<div class="pdf_birth b-2">'.substr($result["birthday"],5,-3).'</div>
	<div class="pdf_birth b-3">'.$y_o.'</div>
	<div class="pdf_yold y-1">'.$y_old.'</div>
	<div class="pdf_yold y-2">'.$m_old.'</div>
';



$_startPathVendor = "../../";
include "../../mpdf/display.php";
?>