<?php 
include("../../config.php"); // use for varible;
include(WWW_PATH."app/SQLiManager.php");
include(WWW_PATH."app/fn.php"); // use function on this page

$ops = [
	"title" => "Sabaijai_Loan",
	"file" => WWW_MPDF."Sabaijai_loan.pdf",
	"file_template" => true,
	"css" => [
		URL."public/css/pdf.css"
	]
];

if( empty($_GET["id"]) ){
	header('location:'.URL.'admin/borrows/?page=borrows');
}

$sql = new SQLiManager();
$sql->table = "borrows b LEFT JOIN customers c ON b.customer_id=c.id 
						 LEFT JOIN saleagents s ON b.saleagents_id=s.id

						 LEFT JOIN province ap ON b.address_province=ap.PROVINCE_ID
						 LEFT JOIN amphur aa ON b.address_amphur=aa.AMPHUR_ID
						 LEFT JOIN district ad ON b.address_district=ad.DISTRICT_ID

						 LEFT JOIN province wp ON b.work_addr_province=wp.PROVINCE_ID
						 LEFT JOIN amphur wa ON b.work_addr_amphur=wa.AMPHUR_ID
						 LEFT JOIN district wd ON b.work_addr_district=wd.DISTRICT_ID

						 LEFT JOIN province dp ON b.doc_addr_province=dp.PROVINCE_ID
						 LEFT JOIN amphur da ON b.doc_addr_amphur=ad.AMPHUR_ID
						 LEFT JOIN district dd ON b.doc_addr_district=dd.DISTRICT_ID";
$sql->field = "b.*
				, c.code as cuscode, c.prefix_name, c.first_name, c.last_name, c.birthday, c.idcard, c.idcard_expire
				, s.code as salecode, s.prefix_name as sprefix, s.first_name as sfname, s.last_name as slname
				, ap.PROVINCE_NAME AS addressProvince, aa.AMPHUR_NAME AS addressAmphur, ad.DISTRICT_NAME AS addressDistrict
				, wp.PROVINCE_NAME AS workProvince, wa.AMPHUR_NAME AS workAmphur, wd.DISTRICT_NAME AS workDistrict
				, dp.PROVINCE_NAME AS docProvince, da.AMPHUR_NAME AS docAmphur, dd.DISTRICT_NAME AS docDistrict";
$sql->condition = "WHERE b.id={$_GET["id"]} LIMIT 1";
$query = $sql->select();
if( mysqli_num_rows($query) <= 0 ){
	header('location:'.URL.'admin/borrows/?page=borrows');
}

$result = mysqli_fetch_assoc($query);

// $sql->table = "borrows b LEFT JOIN province p ON b.address_province=p.PROVINCE_ID LEFT JOIN district d ON b.address_district=d.DISTRICT_ID LEFT JOIN amphur a ON b.address_amphur=a.AMPHUR_ID";
// $sql->field = "PROVINCE_NAME, DISTRICT_NAME, AMPHUR_NAME";
// $sql->condition = "WHERE b.id={$_GET["id"]} LIMIT 1";
// $adQuery = $sql->select();
// if( mysqli_num_rows($adQuery) <= 0 ){
// 	header('location:'.URL.'admin/borrows/?page=borrows');
// }

// $adResult = mysqli_fetch_assoc($adQuery);

// $sql->table = "borrows b LEFT JOIN province p ON b.work_addr_province=p.PROVINCE_ID LEFT JOIN district d ON b.work_addr_district=d.DISTRICT_ID LEFT JOIN amphur a ON b.work_addr_amphur=a.AMPHUR_ID";
// $sql->field = "PROVINCE_NAME, DISTRICT_NAME, AMPHUR_NAME";
// $sql->condition = "WHERE b.id={$_GET["id"]} LIMIT 1";
// $wkQuery = $sql->select();
// if( mysqli_num_rows($wkQuery) <= 0 ){
// 	header('location:'.URL.'admin/borrows/?page=borrows');
// }

// $wkResult = mysqli_fetch_assoc($wkQuery);

// $sql->table = "borrows b LEFT JOIN province p ON b.doc_addr_province=p.PROVINCE_ID LEFT JOIN district d ON b.doc_addr_district=d.DISTRICT_ID LEFT JOIN amphur a ON b.doc_addr_amphur=a.AMPHUR_ID";
// $sql->field = "PROVINCE_NAME, DISTRICT_NAME, AMPHUR_NAME";
// $sql->condition = "WHERE b.id={$_GET["id"]} LIMIT 1";
// $docQuery = $sql->select();
// if( mysqli_num_rows($adQuery) <= 0 ){
// 	header('location:'.URL.'admin/borrows/?page=borrows');
// }

// $docResult = mysqli_fetch_assoc($docQuery);

//SET DATA
$date = date("d", strtotime($result["date"]));
$month = date("m", strtotime($result["date"]));
$year = date("Y", strtotime($result["date"]));

$age = getAge($result["birthday"]);

// USE $html for content page //
$html = '

	<div style="page-break-after: always"></div>

	<div style="position: absolute; top: 140px; left: 135px; width: 100px;"> '.$result["cuscode"].' </div>
	<div style="position: absolute; top: 140px; left: 350px; width: 100px;"> '.$result["salecode"].' </div>

	<!-- DATE -->
	<div style="position: absolute; top: 119px; left: 586px; width: 50px;"> '.$date[0].' </div>
	<div style="position: absolute; top: 119px; left: 604px; width: 50px;"> '.$date[1].' </div>
	<div style="position: absolute; top: 119px; left: 631px; width: 50px;"> '.$month[0].' </div>
	<div style="position: absolute; top: 119px; left: 649px; width: 50px;"> '.$month[1].' </div>
	<div style="position: absolute; top: 119px; left: 674px; width: 50px;"> '.$year[0].' </div>
	<div style="position: absolute; top: 119px; left: 692px; width: 50px;"> '.$year[1].' </div>
	<div style="position: absolute; top: 119px; left: 710px; width: 50px;"> '.$year[2].' </div>
	<div style="position: absolute; top: 119px; left: 728px; width: 50px;"> '.$year[3].' </div>

	<div class="pdf_name">'.showPrefixName($result["prefix_name"]).''.$result["first_name"].' &nbsp; '.$result["last_name"].'</div>
	<div class="pdf_birth b-1">'.date("d", strtotime($result["birthday"])).'</div>
	<div class="pdf_birth b-2">'.date("m", strtotime($result["birthday"])).'</div>
	<div class="pdf_birth b-3">'.(date("Y", strtotime($result["birthday"]))+543).'</div>
	<div class="pdf_yold y-1">'.( !empty($age["year"]) ? $age["year"] : 0 ).'</div>
	<div class="pdf_yold y-2">'.( !empty($age["month"]) ? $age["month"] : 0 ).'</div>
	<div class="pdf_idcard">'.$result["idcard"].'</div>
	<div class="pdf_cardexp e-1">'.date("d", strtotime($result["idcard_expire"])).'</div>
	<div class="pdf_cardexp e-2">'.date("m", strtotime($result["idcard_expire"])).'</div>
	<div class="pdf_cardexp e-3">'.(date("Y", strtotime($result["idcard_expire"]))+543).'</div>
';

	if ($result["education"] == 1) {
		$html .= '<div class="pdf_edu edu-1">&#10004;</div>';
	}
	if ($result["education"] == 2) {
		$html .= '<div class="pdf_edu edu-2">&#10004;</div>';
	}
	if ($result["education"] == 3) {
		$html .= '<div class="pdf_edu edu-3">&#10004;</div>';
	}
	if ($result["education"] == 4) {
		$html .= '<div class="pdf_edu edu-4">&#10004;</div>';
	}
	if ($result["education"] == 5) {
		$html .= '<div class="pdf_edu edu-5">&#10004;</div>';
	}

	if ($result["family_status"] == 1) {
		$html .= '<div class="pdf_fam fm-1">&#10004;</div>';
	}
	if ($result["family_status"] == 2) {
		$html .= '
			<div class="pdf_fam fm-2">&#10004;</div>
			<div class="sp_main pdf_spname">'.showPrefixName($result["spouse_prefix"]).''.$result["spouse_firstname"].' &nbsp; '.$result["spouse_lastname"].'</div>
			<div class="sp_main pdf_sptel">'.$result["spouse_mobile"].'</div>
			<div class="sp_main pdf_sppos">'.$result["spouse_career"].'</div>
			<div class="sp_main pdf_spchd">'.$result["spouse_children"].'</div>
			<div class="sp_main pdf_spsal">'.number_format($result["spouse_income"], 2).'</div>
		';
	}
	if ($result["family_status"] == 3) {
		$html .= '<div class="pdf_fam fm-3">&#10004;</div>';
	}
	if ($result["family_status"] == 4) {
		$html .= '<div class="pdf_fam fm-4">&#10004;</div>';
	}

$html .= '

	<div class="ad_1 pdf_adnum">'.$result["address_number"].'</div>
	<div class="ad_1 pdf_adroom">'.$result["address_room"].'</div>
	<div class="ad_1 pdf_adsoi">'.$result["address_soi"].'</div>
	<div class="ad_1 pdf_adstr">'.$result["address_street"].'</div>
	<div class="ad_1 pdf_addis">'.$result["addressDistrict"].'</div>
	<div class="ad_1 pdf_adamp">'.$result["addressAmphur"].'</div>

	<div class="ad_2 pdf_adpvn">'.$result["addressProvince"].'</div>
	<div class="ad_2 pdf_adzip">'.$result["address_zipcode"].'</div>
	<div class="ad_2 pdf_adphone">'.$result["address_phone"].'</div>
	<div class="ad_2 pdf_adtel">'.$result["mobile"].'</div>
	<div class="ad_2 pdf_admail">'.$result["email"].'</div>
';

	if ($result["address_feature"] == 1) {
		$html .= '<div class="housing hs-1">&#10004;</div>';
	}
	if ($result["address_feature"] == 2) {
		$html .= '<div class="housing hs-2">&#10004;</div>';
	}
	if ($result["address_feature"] == 3) {
		$html .= '<div class="housing hs-3">&#10004;</div>';
	}
	if ($result["address_feature"] == 4) {
		$html .= '<div class="housing hs-4">&#10004;</div>';
	}
	if ($result["address_feature"] == 5) {
		$html .= '<div class="housing hs-5">&#10004;</div>';
	}
	if ($result["address_feature"] == 6) {
		$html .= '<div class="housing hs-6">&#10004;</div>';
	}
	if ($result["address_feature"] == 7) {
		$html .= '<div class="housing hs-7">&#10004;</div>';
	}

	if ($result["address_status"] == 1) {
		$html .= '<div class="lv_status lvs-1">&#10004;</div>';
	}
	if ($result["address_status"] == 2) {
		$html .= '<div class="lv_status lvs-2">&#10004;</div>';
	}
	if ($result["address_status"] == 3) {
		$html .= '<div class="lv_status lvs-3">&#10004;</div>';
	}
	if ($result["address_status"] == 4) {
		$html .= '<div class="lv_status lvs-4">&#10004;</div>';
	}
	if ($result["address_status"] == 5) {
		$html .= '<div class="lv_status lvs-5">&#10004;</div>';
	}
	
	
	if ($result["address_hire"] != 0.00) {
		$html .= '<div class="pdf_rental rt-1">'.number_format($result["address_hire"], 2).'</div>';
	}
	if ($result["address_year"] != 0) {
		$html .= '<div class="pdf_rental rt-2">'.$result["address_year"].'</div>';
	}
	if ($result["address_month"] != 0) {
		$html .= '<div class="pdf_rental rt-3">'.$result["address_month"].'</div>';
	}

$html .= '

	<div class="pdf_rental rt-4">'.$result["address_person"].'</div>

	<div class="pdf_cpyname">'.$result["work_company"].'</div>
	<div class="pdf_cpystatus">'.$result["work_status"].'</div>
	<div class="pdf_position">'.$result["work_position"].'</div>
	<div class="pdf_depart">'.$result["work_department"].'</div>
	<div class="pdf_salary">'.number_format($result["work_income"], 2).'</div>
';
	if ($result["work_income_etc"] != 0.00) {
		$html .= '<div class="pdf_salmore">'.number_format($result["work_income_etc"], 2).'</div>';
	}

$html .= '
	<div class="pdf_salref">'.$result["work_income_source"].'</div>

	<div class="cp_1 pdf_cpnum">'.$result["work_addr_number"].'</div>
	<div class="cp_1 pdf_cpbuild">'.$result["work_addr_build"].'</div>
	<div class="cp_1 pdf_cpfl">'.$result["work_addr_floor"].'</div>
	<div class="cp_1 pdf_cpnum-2">'.$result["work_addr_code"].'</div>
	<div class="cp_1 pdf_cpsoi">'.$result["work_addr_soi"].'</div>

	<div class="cp_2 pdf_cpstr">'.$result["work_addr_street"].'</div>
	<div class="cp_2 pdf_cpdis">'.$result["workDistrict"].'</div>
	<div class="cp_2 pdf_cpamp">'.$result["workAmphur"].'</div>
	<div class="cp_2 pdf_cppvn">'.$result["workProvince"].'</div>
	<div class="cp_2 pdf_cpzip">'.$result["work_addr_zipcode"].'</div>

	<div class="cp_3 pdf_cpphone">'.$result["work_addr_phone"].'</div>
	<div class="cp_3 pdf_cpext">'.$result["work_addr_mobile"].'</div>
	<div class="cp_3 pdf_cpfax">'.$result["work_addr_fax"].'</div>
';

	if ($result["work_old_year"] != 0) {
		$html .= '<div class="cp_3 pdf_cpyold">'.$result["work_old_year"].'</div>';
	}
	if ($result["work_old_month"] != 0) {
		$html .= '<div class="cp_3 pdf_cpmold">'.$result["work_old_month"].'</div>';
	}	
	
	if ($result["doc_address"] == 1) {
		$html .= '<div class="sent_doc std-1">&#10004;</div>';
	}
	if ($result["doc_address"] == 2) {
		$html .= '<div class="sent_doc std-2">&#10004;</div>';
	}
	if ($result["doc_address"] == 3) {
		$html .= '
			<div class="ad_other">&#10004;</div>

			<div class="other_add">'.$result["doc_addr_number"].' '.$result["doc_addr_room"].' '.$result["doc_addr_street"].' '.$result["docDistrict"].' '.$result["docAmphur"].' '.$result["docProvince"].' '.$result["doc_addr_zipcode"].'</div>
		';
	}
	

$html .= '

	<div class="package_interest_1">'.$result["package_interest1"].'</div>
	<div class="maybe_do_date_1">'.date("d / m / Y", strtotime("+543 years", strtotime($result['package_interest_date1']))).'</div>

';

if ($result["package_interest_date2"] != 0000-00-00) {
	$html .= '
			<div class="package_interest_2">'.$result["package_interest2"].'</div>
			<div class="maybe_do_date_2">'.date("d / m / Y", strtotime("+543 years", strtotime($result['package_interest_date2']))).'</div>
	';
}

$html .= '

	<div class="sale_agent_name">'.showPrefixName($result["sprefix"]).''.$result["sfname"].' &nbsp; '.$result["slname"].'</div>
	<div class="sale_agent_id">'.$result["salecode"].'</div>

	<div class="ref_1 rfn-1">'.showPrefixName($result["person_prefix"]).''.$result["person_firstname"].' &nbsp; '.$result["person_lastname"].'</div>
	<div class="ref_1 rfn-2">'.$result["person_phone"].'</div>
	<div class="ref_1 rfn-3">'.$result["person_relationship"].'</div>

	<div style="page-break-after: always"></div>
	<div style="page-break-after: always"></div>
	<div style="page-break-after: always"></div>
	<div style="page-break-after: always"></div>
';

include WWW_PATH."mpdf/display.php";