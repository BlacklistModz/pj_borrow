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
    ->setCellValue('B1', 'วันที่สมัคร')
    ->setCellValue('C1', 'ชื่อผู้สมัคร')
    ->setCellValue('C1', 'วัน/เดือน/ปีเกิด')
    ->setCellValue('D1', 'บัตรประชาชน')
    ->setCellValue('C1', 'วันหมดอายุ')
    ->setCellValue('G1', 'ระดับการศึกษา')
    ->setCellValue('H1', 'สถานภาพ')
    ->setCellValue('E1', 'ที่อยู่ปัจจุบัน')
    ->setCellValue('F1', 'ข้อมูลที่ทำงาน')
    ->setCellValue('I1', 'รายได้ส่วนตัวต่อเดือน')
    ->setCellValue('J1', 'ที่อยู่ที่ทำงาน')
    ->setCellValue('J1', 'โปรแกรมที่สนใจ (1)')
    ->setCellValue('J1', 'โปรแกรมที่สนใจ (2)')
    ->setCellValue('J1', 'วงเงินที่อนุมัติ')
    ->setCellValue('J1', 'โปรแกรมที่สนใจ (2)');

$cell = 2;
$sql->table = "borrows b LEFT JOIN customers c ON b.customer_id=c.id 
                         LEFT JOIN saleagents s ON b.saleagents_id=s.id

                         LEFT JOIN province ap ON b.address_province=ap.PROVINCE_ID
                         LEFT JOIN amphur aa ON b.address_amphur=aa.AMPHUR_ID
                         LEFT JOIN district ad ON b.address_district=ad.DISTRICT_ID

                         LEFT JOIN province wp ON b.work_addr_province=wp.PROVINCE_ID
                         LEFT JOIN amphur wa ON b.work_addr_amphur=wa.AMPHUR_ID
                         LEFT JOIN district wd ON b.work_addr_district=wd.DISTRICT_ID

                         LEFT JOIN province dp ON b.doc_addr_province=dp.PROVINCE_ID
                         LEFT JOIN amphur da ON b.doc_addr_amphur=ad.AMPHUR_ID
                         LEFT JOIN district dd ON b.doc_addr_district=dd.DISTRICT_ID";
$sql->field = "b.*
                , c.code as cuscode, c.prefix_name, c.first_name, c.last_name, c.birthday, c.idcard, c.idcard_expire
                , s.code as salecode, s.prefix_name as sprefix, s.first_name as sfname, s.last_name as slname
                , ap.PROVINCE_NAME AS addressProvince, aa.AMPHUR_NAME AS addressAmphur, ad.DISTRICT_NAME AS addressDistrict
                , wp.PROVINCE_NAME AS workProvince, wa.AMPHUR_NAME AS workAmphur, wd.DISTRICT_NAME AS workDistrict
                , dp.PROVINCE_NAME AS docProvince, da.AMPHUR_NAME AS docAmphur, dd.DISTRICT_NAME AS docDistrict";
$query = $sql->select();
$numRows = mysqli_num_rows($query);
while($result = mysqli_fetch_assoc($query)){
	$spreadsheet->getActiveSheet()->setCellValue('A'.$cell , !empty($result["cuscode"]) ? $result["cuscode"] : "-")
        ->setCellValue('B'.$cell , DateTH($result["date"]))
		->setCellValue('C'.$cell , showPrefixName($result["prefix_name"])." ".$result["first_name"]." ".$result["last_name"])
		->setCellValue('D'.$cell , $result["idcard"])
		->setCellValue('E'.$cell , $result["work_position"])
		->setCellValue('F'.$cell , $result["work_income"])
        ->setCellValue('G'.$cell , showEducate($result["education"]))
        ->setCellValue('H'.$cell , showSta($result["family_status"]))
        // ->setCellValue('I'.$cell , showPrefixName($result["spouse_prefix"])." ".$result["spouse_firstname"]." ".$result["spouse_lastname"])
        ->setCellValue('J'.$cell , $result["spouse_mobile"]);
  //       ->setCellValue('G'.$cell , $result["addressProvince"])
		// ->setCellValue('G'.$cell , $result["addressProvince"]);
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
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);

//SET Header Color
$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('8DB4E2');

//SET FILED CENTER
$sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
$sheet->getStyle('A2:A'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('B2:B'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('C2:C'.$lastRow)->getAlignment()->setHorizontal('left');
$sheet->getStyle('D2:D'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('E2:E'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('G2:G'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('H2:H'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('I2:I'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('J2:J'.$lastRow)->getAlignment()->setHorizontal('center');

//SET Number Format for idcard
$spreadsheet->getActiveSheet()->getStyle('D2:D'.$lastRow)
    ->getNumberFormat()
    ->setFormatCode(NumberFormat::FORMAT_NUMBER);

//SET Number Format for income
$spreadsheet->getActiveSheet()->getStyle('F2:F'.$lastRow)
    ->getNumberFormat()
    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$spreadsheet->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);

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