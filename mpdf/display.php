<?php
$settings = array_merge(array(
	'title' => '',
	'format' => 'A4', // A4, A4-L
	'mode' => 'fullpage', // real,

	'margin_left' => 5,
	'margin_right' => 5,
	'margin_top' => 5,
	'margin_bottom' => 5,
	'margin_header' => 0,
	'margin_footer' => 0,

	'file_template' => false,

	'autoLangToFont' => true,

	'output' => 'BO'

), isset($ops) ? $ops: array() );

$css = '';
if( !empty($settings['css']) ){
	foreach ($settings['css'] as $key => $pathCSS) {
		$css = '<link rel="stylesheet" type="text/css" href="'.$pathCSS.'">';
	}
}

$content = '<!doctype html><html lang="th">'.

'<head>'.
	'<title id="pageTitle">'.$settings['title'].'</title>'.

	'<meta charset="utf-8" />'.
	'<link rel="stylesheet" type="text/css" href="'.URL.'public/css/mpdf.css">'.
	$css.

'</head>'.

'<body>'.$html.'</body></html>';

//SET OUTPUT PDF
require_once $_pathURL.'/vendor/autoload.php';
$mpdf = new \Mpdf\Mpdf( $settings );

if( isset($settings['horizontal']) ){
	$mpdf->AddPage('L'); // Adds a new page in Landscape orientation
}

if( isset($settings['title']) ){
	$mpdf->SetTitle($settings['title']);

	$settings['output'] .= !empty($settings['output']) ? ' - ':'';
	$settings['output'] .= $settings['title'];
}

$mpdf->debug = true;
$mpdf->allow_charset_conversion = true;
$mpdf->charset_in='UTF-8';

if( !empty($settings['file']) ){
	$mpdf->SetDocTemplate($settings["file"],$settings["file_template"]);
}

$mpdf->SetDisplayMode( $settings['mode'] );
$mpdf->list_indent_first_level = 0;

$mpdf->WriteHTML( $content );
$mpdf->Output( $settings["title"].".pdf", "I" );