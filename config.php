<?php
date_default_timezone_set("Asia/Bangkok");

// Always provide a TRAILING SLASH (/) AFTER A PATH
define('URL', 'http://localhost/pj_borrow/');

define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'big_borrow');
define('DB_USER', 'root');
define('DB_PASS', '');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('WWW_PATH', ROOT . DS );
define('WWW_UPLOADS', ROOT . DS . "public". DS. 'uploads' . DS);
define('WWW_MPDF', ROOT . DS . "public". DS. 'file_mpdf' . DS);

define('CSS', URL . 'public/css/');
define('JS', URL . 'public/js/');
define('IMAGES', URL . 'public/images/');
define('PLUGINS', URL . 'public/plugins/');
define('UPLOADS', URL . "public/uploads/");

// FOR FRONTEND //
define('SCSS', URL . 'public/scss/');
define('VENDORS', URL . 'public/vendors/');
define('FONTS', URL . 'public/fonts/');