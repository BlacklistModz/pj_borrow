<?php
function dateTH($strDate, $full=null, $time=null)
{
	$dateTH = "";
	$strYear = date("Y", strtotime($strDate)) + 543;
	$strMonth = date("n", strtotime($strDate));
	$strDay = date("j", strtotime($strDate));

	$strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
	$strMonthThai = $strMonthCut[$strMonth];

	if( !empty($full) ){
		$strMonthFull = array("", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
		$strMonthThai = $strMonthFull[$strMonth];
	}

	$dateTH = "$strDay $strMonthThai $strYear";

	if( !empty($time) ){
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$dateTH .= " ($strHour:$strMinute น.)";
	}

	return $dateTH;
}
?>