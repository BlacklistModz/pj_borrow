<?php 
// CHECK FN
function checkStr( $text , $format = 'utf-8' ){
	return mb_strlen( $text , $format );
}
function checkEngNum($text){
	if( !preg_match('/^[a-z0-9A-Z\s]+$/i',$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkEng($text){
	if( !preg_match('/^[a-zA-Z\s]+$/i',$text) ){
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
function checkThai($text){
	if( !preg_match("/^[ก-๙\s]+$/",$text) ){
		return false;
	}
	else{
		return true;
	}
}
function checkPID($pid) {
	if(strlen($pid) != 13) {
		return false;
	}
	for($i=0, $sum=0; $i<12;$i++){
		$sum += (int)($pid{$i})*(13-$i);
	}
	if((11-($sum%11))%10 == (int)($pid{12})){
		return true;
	}
	else{
		return false;
	}
}

//FORMAT TEXT
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
function stringify($data){
	return htmlentities(json_encode($data));
}

//SECURITY
function hashPassword($value){
	$cost = isset($options['rounds']) ? $options['rounds'] : 10;
	$hash = password_hash($value, PASSWORD_BCRYPT, ['cost' => $cost]);
	if ($hash === false) {
		throw new RuntimeException('Bcrypt hashing not supported.');
	}
	return $hash;
}