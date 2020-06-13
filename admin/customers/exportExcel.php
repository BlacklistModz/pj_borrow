<?php 
include("../../config.php"); // use for varible;
include("../../app/SQLiManager.php");
include("../../app/fn.php"); // use function on this page

$sql = new SQLiManager();

require '../../vendor/autoload.php'; // GET AUTOLOAD
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

//SET HEADER
$spreadsheet->getActiveSheet()->setCellValue('A1', 'รหัสลูกค้า')
    ->setCellValue('B1', 'ชื่อ-นามสกุล')
    ->setCellValue('C1', 'บัตรประชาชน')
    ->setCellValue('D1', 'อาชีพ')
    ->setCellValue('E1', 'รายได้')
    ->setCellValue('F1', 'จังหวัด')
    ->setCellValue('G1', 'เบอร์โทรศัพท์');

$cell = 2;
$sql->table = "customers c LEFT JOIN borrows b ON c.id=b.customer_id LEFT JOIN province p ON b.address_province=p.PROVINCE_ID";
$sql->field = "c.*, b.address_phone, b.work_position, b.work_income, p.PROVINCE_NAME as province";
$query = $sql->select();
$numRows = mysqli_num_rows($query);
while($result = mysqli_fetch_assoc($query)){
	$spreadsheet->getActiveSheet()->setCellValue('A'.$cell , !empty($result["code"]) ? $result["code"] : "-")
		->setCellValue('B'.$cell , showPrefixName($result["prefix_name"])." ".$result["first_name"]." ".$result["last_name"])
		->setCellValue('C'.$cell , $result["idcard"])
		->setCellValue('D'.$cell , $result["work_position"])
		->setCellValue('E'.$cell , $result["work_income"])
		->setCellValue('F'.$cell , $result["province"])
		->setCellValue('G'.$cell , $result["address_phone"]);
	$cell++;
}

##
$lastRow = $numRows+1;
##

//SET AUTO SIZE FILED
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);

//SET Header Color
$spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('00BFFF');

//SET FILED CENTER
$sheet->getStyle('A1:G1')->getAlignment()->setHorizontal('center');
$sheet->getStyle('A2:A'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('C2:C'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('E2:E'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('F2:F'.$lastRow)->getAlignment()->setHorizontal('center');

//SET Number Format for idcard
$spreadsheet->getActiveSheet()->getStyle('C2:C'.$lastRow)
    ->getNumberFormat()
    ->setFormatCode(NumberFormat::FORMAT_NUMBER);

//SET Number Format for income
$spreadsheet->getActiveSheet()->getStyle('E2:E'.$lastRow)
    ->getNumberFormat()
    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);

//BUILD
$writer = new Xlsx($spreadsheet);

//SHOW ON BROWSER
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="customers-'.date("Y_m_d").'.xlsx"');
$writer->save('php://output');

//SHOW DOWNLOAD
// save file to server and create link
// $writer->save('excel/itoffside.xlsx');
// echo '<a href="excel/itoffside.xlsx">Download Excel</a>';