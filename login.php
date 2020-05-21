<?php 
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?=PLUGINS?>fontawesome-free/css/all.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?=PLUGINS?>datatables-bs4/css/dataTables.bootstrap4.css">
	<!-- SWEETALERT -->
	<link rel="stylesheet" href="<?=CSS?>sweetalert2.css">
</head>
<body>
	<form action="<?=URL?>checkLogin.php" method="POST" class="form-submit" accept-charset="utf-8">
		<input type="text" name="username" value="">
		<input type="password" name="password" value="">
		<button type="submit" class="btn btn-primary btn-submit">LOGIN</button>
	</form>
	<!-- jQuery -->
	<script src="<?=PLUGINS?>jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?=PLUGINS?>jquery-ui/jquery-ui.min.js"></script>
	<script src="<?=JS?>main.js"></script>
	<script src="<?=JS?>sweetalert2.js"></script>
</body>
</html>