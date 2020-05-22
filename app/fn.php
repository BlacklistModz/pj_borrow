<?php 
function checkStr( $text , $format = 'utf-8' ){
	return mb_strlen( $text , $format );
}
function checkEngNum($text){
	if( !preg_match('/^[a-z0-9A-Z]+$/i',$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkEng($text){
	if( !preg_match('/^[a-zA-Z]+$/i',$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkEngThai($text){
	if( !preg_match("/^[ก-๙a-zA-Z\s]+$/",$text) ){
		return false;
	}
	else{
		return true;
	}
}
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