<?php 
include("config.php"); // use for varible;
$ops = [
	"title" => "Sabaijai_Loan",
	"file" => "public/file_mpdf/Sabaijai_loan.pdf",
	"file_template" => true
];

// USE $html for content page //
$html = '
	<div class="" style="position: absolute; top: 500px; left: 420px; width: 300px;"> === ทดสอบการเขียนข้อความลง PDF === </div>
';

$_startPathVendor = __DIR__;
include "mpdf/display.php";