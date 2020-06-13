<?php 
include("config.php"); // use for varible;
$ops = [
	"title" => "Sabaijai_Loan",
	"file" => "public/file_mpdf/Sabaijai_loan.pdf",
	"file_template" => true,
	"css" => [
		URL."pdf.css"
	]

];

// USE $html for content page //
$html = '
	<div style="page-break-after: always"></div>

	<div class="pdf_name">นายจักรกฤษ แปงเมือง</div>

	<div class="pdf_birth b-1">09</div>

	<div class="pdf_birth b-2">01</div>

	<div class="pdf_birth b-3">2537</div>

	<div class="pdf_yold y-1">26</div>

	<div class="pdf_yold y-2">5</div>

	<div class="pdf_idcard">1529900681375</div>

	<div class="pdf_cardexp e-1">09</div>

	<div class="pdf_cardexp e-2">01</div>

	<div class="pdf_cardexp e-3">2565</div>

	<div class="pdf_edu edu-1">&#10004;</div>

	<div class="pdf_edu edu-2">&#10004;</div>

	<div class="pdf_edu edu-3">&#10004;</div>

	<div class="pdf_edu edu-4">&#10004;</div>

	<div class="pdf_edu edu-5">&#10004;</div>

	<div class="pdf_fam fm-1">&#10004;</div>
	
	<div class="pdf_fam fm-2">&#10004;</div>

	<div class="pdf_fam fm-3">&#10004;</div>

	<div class="pdf_fam fm-4">&#10004;</div>

	<div class="sp_main pdf_spname">นางศุภนิดา แปงเมือง</div>
	
	<div class="sp_main pdf_sptel">0850497648</div>

	<div class="sp_main pdf_sppos">เจ้าหน้าที่ธุรการ</div>

	<div class="sp_main pdf_spchd">1</div>

	<div class="sp_main pdf_spsal">9000</div>

	<div class="ad_1 pdf_adnum">258/2</div>

	<div class="ad_1 pdf_adroom">304</div>

	<div class="ad_1 pdf_adsoi">3</div>

	<div class="ad_1 pdf_adstr">รัชดาภิเษก</div>

	<div class="ad_1 pdf_addis">ดินแดง</div>

	<div class="ad_1 pdf_adamp">ดินแดง</div>

	<div class="ad_2 pdf_adpvn">กรุงเทพมหานคร</div>

	<div class="ad_2 pdf_adzip">10400</div>

	<div class="ad_2 pdf_adphone">020162600</div>

	<div class="ad_2 pdf_adtel">0992723554</div>

	<div class="ad_2 pdf_admail">bigsofteng@gmail.com</div>

	<div class="housing hs-1">&#10004;</div>

	<div class="housing hs-2">&#10004;</div>

	<div class="housing hs-3">&#10004;</div>

	<div class="housing hs-4">&#10004;</div>

	<div class="housing hs-5">&#10004;</div>

	<div class="housing hs-6">&#10004;</div>

	<div class="housing hs-7">&#10004;</div>

	<div class="lv_status lvs-1">&#10004;</div>

	<div class="lv_status lvs-2">&#10004;</div>

	<div class="lv_status lvs-3">&#10004;</div>

	<div class="lv_status lvs-4">&#10004;</div>

	<div class="lv_status lvs-5">&#10004;</div>

	<div class="pdf_rental rt-1">5,500</div>

	<div class="pdf_rental rt-2">2</div>

	<div class="pdf_rental rt-3">11</div>

	<div class="pdf_rental rt-4">2</div>

	<div class="pdf_cpyname">กองทุนเงินให้กู้ยืมเพื่อการศึกษา</div>

	<div class="pdf_cpystatus">ปล่อยเงินกู้ให้แก่ นักเรียน, นักศึกษา</div>

	<div class="pdf_position">เจ้าหน้าที่เทคโนโลยีสารสนเทศ</div>

	<div class="pdf_depart">เทคโนโลยีสารสนเทศ</div>

	<div class="pdf_salary">200,000</div>

	<div class="pdf_salmore">200,000</div>

	<div class="pdf_salref">เทรดหุ้น, ขายของตามตลาดนัด, รับงานอิสระอื่นๆ</div>

	<div class="cp_1 pdf_cpnum">89</div>

	<div class="cp_1 pdf_cpbuild">AIA Capital Center</div>

	<div class="cp_1 pdf_cpfl">5, 6</div>

	<div class="cp_1 pdf_cpnum-2">89</div>

	<div class="cp_1 pdf_cpsoi">รัชดาภิเษก</div>

	<div class="cp_2 pdf_cpstr">รัชดาภิเษก</div>

	<div class="cp_2 pdf_cpdis">ดินแดง</div>

	<div class="cp_2 pdf_cpamp">ดินแดง</div>

	<div class="cp_2 pdf_cppvn">กรุงเทพมหานคร</div>

	<div class="cp_2 pdf_cpzip">10400</div>

	<div class="cp_3 pdf_cpphone">020162600</div>

	<div class="cp_3 pdf_cpext">420</div>

	<div class="cp_3 pdf_cpfax">020162600</div>

	<div class="cp_3 pdf_cpyold">1</div>

	<div class="cp_3 pdf_cpmold">11</div>

	<div class="sent_doc std-1">&#10004;</div>

	<div class="sent_doc std-2">&#10004;</div>

	<div class="ad_other">&#10004;</div>

	<div class="other_add">89 AIA Capital Center ชั้น 5-6 ถนนรัชดาภิเษก แขวงดินแดง เขตดินแดง กรุงเทพมหานคร 10400</div>

	<div class="clinic_name">โรงพยาบาลยันฮี</div>

	<div class="clinic_cost">ศัลยกรรมทรวงอกซิลิโคน</div>

	<div class="cost_price">350,000</div>

	<div class="cost_duration cd-1">&#10004;</div>

	<div class="cost_duration cd-2">&#10004;</div>

	<div class="cost_duration cd-3">&#10004;</div>

	<div class="cost_duration cd-4">&#10004;</div>

	<div class="ref_1 rfn-1">นายพชร นันทอาภา</div>

	<div class="ref_1 rfn-2">098556223</div>

	<div class="ref_1 rfn-3">อาจารย์</div>

	<div class="ref_2 rfn-4">นายภัคล ดิเรกฤทธิ์สุนทร</div>

	<div class="ref_2 rfn-5">086256489</div>

	<div class="ref_2 rfn-6">หัวหน้างาน</div>
	
	<div style="page-break-after: always"></div>

	<div style="page-break-after: always"></div>

	<div style="page-break-after: always"></div>

	<div style="page-break-after: always"></div>

';

$_startPathVendor = __DIR__;
include "mpdf/display.php";