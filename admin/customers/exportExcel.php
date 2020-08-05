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
$spreadsheet->getActiveSheet()->setCellValue('A1', 'วันที่สมัคร')
    ->setCellValue('B1', 'เลขที่ผู้สมัคร')
    ->setCellValue('C1', 'ชื่อผู้สมัคร')
    ->setCellValue('D1', 'วัน/เดือน/ปีเกิด')
    ->setCellValue('E1', 'บัตรประชาชน')
    ->setCellValue('F1', 'วันหมดอายุ')
    ->setCellValue('G1', 'ระดับการศึกษา')
    ->setCellValue('H1', 'สถานภาพ')
    ->setCellValue('I1', 'เบอร์โทร')
    ->setCellValue('J1', 'LINE ID')
    ->setCellValue('K1', 'ที่อยู่')
    ->setCellValue('L1', 'ชื่อบริษัท')
    ->setCellValue('M1', 'อาชีพ')
    ->setCellValue('N1', 'รายได้ส่วนตัวต่อเดือน')
    ->setCellValue('O1', 'ที่อยู่ที่ทำงาน')
    ->setCellValue('P1', 'โปรแกรมที่สนใจทำ (1)')
    ->setCellValue('Q1', 'โปรแกรมที่สนใจทำ (2)')
    ->setCellValue('R1', 'วงเงินที่อนุมัติ')
    ->setCellValue('S1', 'วันที่อนุมัติวงเงิน/เปลี่ยนแปลงสถานะของเอกสาร')
    ->setCellValue('T1', 'วันที่เริ่มสัญญา')
    ->setCellValue('U1', 'วันที่เอกสารครบ')
    ->setCellValue('V1', 'วันที่ Center ติดต่อลูกค้าหลังจากได้รับผลอนุมัติ')
    ->setCellValue('W1', 'วันที่ลูกค้าทำศัลกรรม')
    ->setCellValue('X1', 'วันที่มีการโอนเงินให้คลินิก')
    ->setCellValue('Y1', 'ชื่อคลินิก')
    ->setCellValue('Z1', 'Sales Agent Code')
    ->setCellValue('AA1', 'สถานะ');

$cell = 2;
$sql->table = "borrows b LEFT JOIN customers c ON b.customer_id=c.id 
                         LEFT JOIN saleagents s ON b.saleagents_id=s.id

                         LEFT JOIN province ap ON b.address_province=ap.PROVINCE_ID
                         LEFT JOIN amphur aa ON b.address_amphur=aa.AMPHUR_ID
                         LEFT JOIN district ad ON b.address_district=ad.DISTRICT_ID

                         LEFT JOIN province wp ON b.work_addr_province=wp.PROVINCE_ID
                         LEFT JOIN amphur wa ON b.work_addr_amphur=wa.AMPHUR_ID
                         LEFT JOIN district wd ON b.work_addr_district=wd.DISTRICT_ID";
$sql->field = "b.* , c.*
                , s.code as salecode
                , ap.PROVINCE_NAME AS addressProvince, aa.AMPHUR_NAME AS addressAmphur, ad.DISTRICT_NAME AS addressDistrict
                , wp.PROVINCE_NAME AS workProvince, wa.AMPHUR_NAME AS workAmphur, wd.DISTRICT_NAME AS workDistrict";
$query = $sql->select();
$numRows = mysqli_num_rows($query);
while($result = mysqli_fetch_assoc($query)){
	$spreadsheet->getActiveSheet()->setCellValue('A'.$cell , DateTH($result["date"]))
        ->setCellValue('B'.$cell , !empty($result["code"]) ? $result["code"] : "-")
		->setCellValue('C'.$cell , showPrefixName($result["prefix_name"])." ".$result["first_name"]." ".$result["last_name"])
        ->setCellValue('D'.$cell , DateTH($result["birthday"]))
		->setCellValue('E'.$cell , $result["idcard"])
        ->setCellValue('F'.$cell , DateTH($result["idcard_expire"]))
        ->setCellValue('G'.$cell , showEducate($result["education"]))
        ->setCellValue('H'.$cell , showSta($result["family_status"]))
        ->setCellValue('I'.$cell , $result["mobile"])
        ->setCellValue('J'.$cell , $result["line_id"])
        ->setCellValue('K'.$cell , $result["address_number"]." ".$result["address_room"]." ".$result["address_soi"]." ".$result["address_street"]." ".$result["addressDistrict"]." ".$result["addressAmphur"]." ".$result["addressProvince"]." ".$result["address_zipcode"])
        ->setCellValue('L'.$cell , $result["work_company"])
		->setCellValue('M'.$cell , $result["work_position"])
		->setCellValue('N'.$cell , $result["work_income"])
        ->setCellValue('O'.$cell , $result["work_addr_number"]." ".$result["work_addr_build"]." ".$result["work_addr_code"]." ".$result["work_addr_soi"]." ".$result["work_addr_street"]." ".$result["workDistrict"]." ".$result["workAmphur"]." ".$result["workProvince"]." ".$result["work_addr_zipcode"])
        ->setCellValue('P'.$cell , $result["package_interest1"])
        ->setCellValue('Q'.$cell , !empty($result["package_interest2"]) ? $result["package_interest2"] : "-")
        ->setCellValue('R'.$cell , $result["approve_limit"])
        ->setCellValue('S'.$cell , !empty($result["approved_date"]) ? DateTH($result["approved_date"]) : "-")
        ->setCellValue('T'.$cell , !empty($result["contract_date"]) ? DateTH($result["contract_date"]) : "-")
        ->setCellValue('U'.$cell , !empty($result["doc_completed_date"]) ? DateTH($result["doc_completed_date"]) : "-")
        ->setCellValue('V'.$cell , !empty($result["contact_date"]) ? DateTH($result["contact_date"]) : "-")
        ->setCellValue('W'.$cell , !empty($result["made_date"]) ? DateTH($result["made_date"]) : "-")
        ->setCellValue('X'.$cell , !empty($result["transfer_date"]) ? DateTH($result["transfer_date"]) : "-")
        ->setCellValue('Y'.$cell , $result["clinic"])
        ->setCellValue('Z'.$cell , $result["salecode"])
        ->setCellValue('AA'.$cell , status($result["status"]));
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
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('S')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('T')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('U')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('V')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('W')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('X')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('Y')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('Z')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('AA')->setAutoSize(true);

//SET Header Color
$spreadsheet->getActiveSheet()->getStyle('A1:AA1')->getFill()
    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
    ->getStartColor()->setARGB('8DB4E2');

//SET FILED CENTER
$sheet->getStyle('A1:AA1')->getAlignment()->setHorizontal('center');
$sheet->getStyle('A2:A'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('B2:B'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('C2:C'.$lastRow)->getAlignment()->setHorizontal('left');
$sheet->getStyle('D2:D'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('E2:E'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('F2:F'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('G2:G'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('H2:H'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('I2:I'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('J2:J'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('K2:K'.$lastRow)->getAlignment()->setHorizontal('left');
$sheet->getStyle('L2:L'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('M2:M'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('N2:N'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('O2:O'.$lastRow)->getAlignment()->setHorizontal('left');
$sheet->getStyle('P2:P'.$lastRow)->getAlignment()->setHorizontal('left');
$sheet->getStyle('Q2:Q'.$lastRow)->getAlignment()->setHorizontal('left');
$sheet->getStyle('R2:R'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('S2:S'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('T2:T'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('U2:U'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('V2:V'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('W2:W'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('X2:X'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('Y2:Y'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('Z2:Z'.$lastRow)->getAlignment()->setHorizontal('center');
$sheet->getStyle('AA2:AA'.$lastRow)->getAlignment()->setHorizontal('center');

//SET Number Format for idcard
$spreadsheet->getActiveSheet()->getStyle('E2:E'.$lastRow)
    ->getNumberFormat()
    ->setFormatCode(NumberFormat::FORMAT_NUMBER);

//SET Number Format for income
$spreadsheet->getActiveSheet()->getStyle('N2:N'.$lastRow)
    ->getNumberFormat()
    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

//SET Number Format for approved
$spreadsheet->getActiveSheet()->getStyle('R2:R'.$lastRow)
    ->getNumberFormat()
    ->setFormatCode(NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

$spreadsheet->getActiveSheet()->getStyle('A1:AA1')->getFont()->setBold(true);

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