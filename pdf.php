<?php 
include("config.php"); // use for varible;
$ops = [
	"title" => "Sabaijai_Loan",
	"file" => "public/file_mpdf/Sabaijai_loan.pdf",
	"file_template" => true
];

// USE $html for content page //
$html = '
	<div class="" style="position: absolute; top: 252px; left: 280px; width: 100%;">นายจักรกฤษ แปงเมือง</div>

	<div class="" style="position: absolute; top: 282px; left: 138px; width: 100%; letter-spacing: 11.5px;">09</div>

	<div class="" style="position: absolute; top: 282px; left: 183px; width: 100%; letter-spacing: 11.5px;">01</div>

	<div class="" style="position: absolute; top: 282px; left: 228px; width: 100%; letter-spacing: 11.5px;">2537</div>

	<div class="" style="position: absolute; top: 278px; left: 385px; width: 100%;">26</div>

	<div class="" style="position: absolute; top: 278px; left: 470px; width: 100%;">5</div>

	<div class="" style="position: absolute; top: 308px; left: 193px; width: 100%; letter-spacing: 11.4px;">1529900681375</div>

	<div class="" style="position: absolute; top: 308px; left: 575px; width: 100%px; letter-spacing: 11.5px;">09</div>

	<div class="" style="position: absolute; top: 308px; left: 621px; width: 100%px; letter-spacing: 11.5px;">01</div>

	<div class="" style="position: absolute; top: 308px; left: 665px; width: 100%px; letter-spacing: 11.5px;">2565</div>

	<div class="" style="font-family:helvetica; font-size: 18px; position: absolute; top: 329px; left: 450.5px; width: 100%px;">&#10004;</div>

	<div class="" style="font-family:helvetica; font-size: 18px; position: absolute; top: 354px; left: 246px; width: 100%px;">&#10004;</div>

	<div class="" style="position: absolute; top: 380x; left: 105px; width: 125px;">นางศุภนิดา แปงเมือง</div>
	
	<div class="" style="position: absolute; top: 380x; left: 272px; width: 80px;">0850497648</div>

	<div class="" style="position: absolute; top: 380x; left: 407px; width: 75px;">เจ้าหน้าที่ธุรการ</div>

	<div class="" style="position: absolute; top: 380x; left: 560px; width: 75px;">1</div>

	<div class="" style="position: absolute; top: 380x; left: 682px; width: 75px;">9000</div>

';

$_startPathVendor = __DIR__;
include "mpdf/display.php";