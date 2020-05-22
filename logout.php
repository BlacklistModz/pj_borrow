<?php
include("config.php");

ob_start();
session_start();
if(isset($_SESSION["admin"]) || isset($_SESSION["user"]))
{
	session_destroy();
	ob_clean();

	$arr["type"] = "success";
	$arr["title"] = "ออกจากระบบ";
	$arr["url"] = URL;
	$arr["status"] = 200;

	echo json_encode($arr);
}
else{
	header("location:".URL);
}
