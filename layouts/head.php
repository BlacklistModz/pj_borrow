<?php 
$_pathURL = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR."pj_borrow".DIRECTORY_SEPARATOR;
include($_pathURL."config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?=!empty($_title) ? $_title : 'Register System';?></title>
    <!-- Vendor styles -->
    <!-- JQUERY UI -->
    <link rel="stylesheet" href="<?=PLUGINS?>jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?=VENDORS?>material-design-iconic-font/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="<?=VENDORS?>animate.css/animate.min.css">
    <link rel="stylesheet" href="<?=VENDORS?>jquery-scrollbar/jquery.scrollbar.css">
    <link rel="stylesheet" href="<?=VENDORS?>select2/css/select2.min.css">
    <link rel="stylesheet" href="<?=VENDORS?>dropzone/dropzone.css">
    <link rel="stylesheet" href="<?=VENDORS?>nouislider/nouislider.min.css">
    <link rel="stylesheet" href="<?=VENDORS?>trumbowyg/ui/trumbowyg.min.css">
    <link rel="stylesheet" href="<?=VENDORS?>flatpickr/flatpickr.min.css" />
    <link rel="stylesheet" href="<?=VENDORS?>rateyo/jquery.rateyo.min.css">
    <link rel="stylesheet" href="<?=VENDORS?>bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- App styles -->
    <link rel="stylesheet" href="<?=CSS?>app.min.css">
    <!-- Core Framework -->
    <link rel="stylesheet" href="<?=CSS?>sweetalert2.css">
    <style>
        @media (min-width: 1200px) {
        	.content:not(.content--boxed):not(.content--full) {
        	padding: unset !important;
        	}
    	}
    	@media (max-width: 575.98px) {
			.content:not(.content--boxed):not(.content--full) {
    		padding: unset !important;
			}
		}
        .ui-datepicker select.ui-datepicker-month{
          width: 60%;
          margin-top : 1px;
          height: 29px;
          margin : 1px;
        }
        .ui-datepicker select.ui-datepicker-year {
          width: 38%;
          height: 29px;
        }
    </style>
</head>
<body data-ma-theme="cyan">
    <main class="main">
        <div class="page-loader">
            <div class="page-loader__spinner">
                <svg viewBox="25 25 50 50">
                    <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                </svg>
            </div>
        </div>