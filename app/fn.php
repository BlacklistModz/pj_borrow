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
	if( !preg_match("/^[กขฃคฅฆงจฉชซฌญฎฏฐฑฒณดตถทธนบปผฝพฟภมยรฤลฦวศษสหฬอฮฯะัาำิีึืฺุูเแโใไๅๆ็่้๊๋์]+$/", $text) ){
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

function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }
   
    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }
   
    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }
   
    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }
   
    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return "Browser : {$bname} | Version : {$version} | Platform : {$platform}";
   
    /* return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    ); */
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
function DateJQToPHP($strDate){
	$dateArr = explode("/", $strDate);
	return "{$dateArr[2]}-{$dateArr[1]}-{$dateArr[0]}";
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

//***** SET DATA FOR LOOP *****//
//PREFIX
function prefix(){
	$_prefix = [];
	$_prefix[] = ['id'=>1, 'name'=>'นาย'];
	$_prefix[] = ['id'=>2, 'name'=>'นาง'];
	$_prefix[] = ['id'=>3, 'name'=>'นางสาว'];
	return $_prefix;
}
function showPrefixName($prefix){
	$data = "";
	foreach (prefix() as $key => $value) {
		if( $prefix == $value["id"] ){
			$data = $value["name"];
			break;
		}
	}
	return $data;
}

//SEX
function sex(){
	$_sex = [];
	$_sex[] = ['id'=>'male', 'name'=>'ชาย'];
	$_sex[] = ['id'=>'female', 'name'=>'หญิง'];
	return $_sex;
}
function showSex($sex){
	$data = "";
	foreach (sex() as $key => $value) {
		if( $sex == $value["id"] ){
			$data = $value["name"];
			break;
		}
	}
	return $data;
}

//STATUS
function status(){
	$_status = [];
	// $_status[] = ['id'=>0, 'name'=>'รอตรวจสอบ', 'class'=>'btn btn-secondary btn-sm', 'icon'=>'fa fa-info'];
	// $_status[] = ['id'=>1, 'name'=>'อนุมัติ', 'class'=>'btn btn-success btn-sm', 'icon'=>'fa fa-check'];
	// $_status[] = ['id'=>2, 'name'=>'ไม่อนุมัติ', 'class'=>'btn btn-danger btn-sm', 'icon'=>'fa fa-remove'];
	$_status[] = ['id'=>0, 'name'=>'รอตรวจสอบ', 'class'=>'text-info'];
	$_status[] = ['id'=>1, 'name'=>'อนุมัติ', 'class'=>'text-success'];
	$_status[] = ['id'=>2, 'name'=>'ปฏิเสธ', 'class'=>'text-danger'];
	$_status[] = ['id'=>3, 'name'=>'รอเอกสาร', 'class'=>'text-warning'];
	$_status[] = ['id'=>4, 'name'=>'ยกเลิก', 'class'=>'text-danger'];
	$_status[] = ['id'=>5, 'name'=>'โอนเงิน', 'class'=>'text-success'];
	return $_status;
}
function getStatus($status){
	$data = "";
	foreach (status() as $key => $value) {
		if( $status == $value["id"] ){
			$data = $value;
			break;
		}
	}
	return $data;
}

// Time
function getAge($birthday)
{
	$birthday = strtotime($birthday); // set time to seconds
	$time = date("Y-m-d"); //set date now

	if ( ! is_numeric($birthday)){
		$birthday = 1;
	}
 
	if ( ! is_numeric($time)){
		$time = time();
	}
 
	if ($time <= $birthday){
		$birthday = 1;
	}
	else{
		$birthday = $time - $birthday;
	}

	$data = [];
	$years = floor($birthday / 31536000);
 
	if ($years > 0){	
		$data["year"] = $years;
	}	
 
	$birthday -= $years * 31536000;
	$months = floor($birthday / 2628000);
 
	if ($years > 0 OR $months > 0){
		if ($months > 0){	
			$data["month"] = $months;
		}
	}
 
	return $data;
}

function role(){
	$a = [];
	$a[] = ["id"=>"admin", "name"=>"ผู้ดูแลระบบ"];
	$a[] = ["id"=>"manager", "name"=>"ผู้จัดการ"];
	$a[] = ["id"=>"staff", "name"=>"พนักงาน"];
	return $a;
}
function getRole($role){
	$data = "";
	foreach (role() as $key => $value) {
		if( $role == $value["id"] ){
			$data = $value["name"];
			break;
		}
	}
	return $data;

}

function period(){
	$a = [];
	$a[] = ["id"=>3, "name"=>"3 เดือน"];
	$a[] = ["id"=>6, "name"=>"6 เดือน"];
	$a[] = ["id"=>9, "name"=>"9 เดือน"];
	$a[] = ["id"=>12, "name"=>"12 เดือน"];
	return $a;
}

function getPeriod($id){
	$data = "";
	foreach (period() as $key => $value) {
		if( $id == $value["id"] ){
			$data = $value["name"];
			break;
		}
	}
	return $data;
}

function educate(){
	$_educate = [];
	$_educate[] = ['id'=>1, 'name'=>'ประถมศึกษา'];
	$_educate[] = ['id'=>2, 'name'=>'มัธยมศึกษา'];
	$_educate[] = ['id'=>3, 'name'=>'ปวช./ปวส./ปวท.'];
	$_educate[] = ['id'=>4, 'name'=>'ปริญญาตรี'];
	$_educate[] = ['id'=>5, 'name'=>'สูงกว่าปริญญาตรี'];
	return $_educate;
}
function showEducate($educate){
	$data = "";
	foreach (educate() as $key => $value) {
		if( $educate == $value["id"] ){
			$data = $value["name"];
			break;
		}
	}
	return $data;
}

function sta(){
	$sta = [];
	$sta[] = ['id'=>1, 'name'=>'โสด'];
	$sta[] = ['id'=>2, 'name'=>'สมรส'];
	$sta[] = ['id'=>3, 'name'=>'หย่า'];
	$sta[] = ['id'=>4, 'name'=>'หม้าย'];
	return $sta;
}
function showSta($sta){
	$data = "";
	foreach (sta() as $key => $value) {
		if( $sta == $value["id"] ){
			$data = $value["name"];
			break;
		}
	}
	return $data;
}