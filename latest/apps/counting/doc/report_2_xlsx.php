<?php
    session_start();
    include_once "../../../config/define.php";
    include_once "../../../include/db.php";
    include_once "../../../include/oceanos.php";
    require '../../../vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    @ini_set('display_errors', DEBUG_MODE ? 1 : 0);
    date_default_timezone_set(DEFAULT_TIMEZONE);

    $dbc = new dbc;
    $dbc->Connect();
    $os = new oceanos($dbc);

    $counting_id = $_POST['id'];
    $filename = 'แสดงรายการสรุปผลการตรวจสอบ';

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();


    //header
    $aCol = array('A', 'B', 'C', 'D', 'E', 'F');
    $aField = array('ที่', 'สถานที่ตรวจพบ', 'รูปภาพยืนยัน', 'จำนวน / รายการ', '', '');

    $sheet->getStyle('A2:F2')->getAlignment()->setHorizontal('center');
    $sheet->getStyle('C:F')->getAlignment()->setHorizontal('center');
    $sheet->mergeCells('A1:F1');
    $sheet->mergeCells('D2:F2');

    $sheet->setCellValue('A1', $filename);
    for ($i = 0; $i < count($aField); $i++) {
        $sheet->setCellValue($aCol[$i] . '2', $aField[$i]);
        $sheet->getColumnDimension($aCol[$i])->setAutoSize(true);
    }
    //data
    $line_number = 3;
    $location = array("ครุภัณฑ์ที่ตรวจสอบแล้วพบรายการแล้วใช้งานได้",
        "ครุภัณฑ์ที่ตรวจสอบแล้วพบรายการแล้วใช้งานไม่ได้",
        "ครุภัณฑ์ที่ตรวจสอบแล้วไม่พบรายการแล้วใช้งานได้",
        "ครุภัณฑ์ที่ตรวจสอบแล้วไม่พบรายการแล้วใช้งานไม่ได้",
        "ครุภัณฑ์ที่ตรวจสอบแล้วไม่พบรายการ QR Code (มีปัญหา)");
    $num = 1;
    for ($i = 0; $i < count($location); $i++) {

        $counted = $dbc->GetRecord(
            "asm_assets LEFT JOIN asm_counting_items ON asm_assets.id = asm_counting_items.asset_id",
            "COUNT(asm_assets.id)",
            "asm_counting_items.action = '$num' AND asm_counting_items.counting_id IN ($counting_id)"
        );
        $sheet->setCellValue("A" . $line_number, $num);
        $sheet->setCellValue("B" . $line_number, $location[$i]);
        $sheet->setCellValue("C" . $line_number, $num % 3 == 0 ? "" : "ต้องระบุ");
        $sheet->setCellValue("D" . $line_number, "จำนวน");
        $sheet->setCellValue("E" . $line_number, $counted[0]);
        $sheet->setCellValue("F" . $line_number, "รายการ");
        $num++;
        $line_number++;
    }
    //border
    $styleArray = array(
        'borders' => array(
            'outline' => array(
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => array('argb' => '000000'),
            ),
        ),
    );
    for ($i = 0; $i < count($aCol); $i++) {
        for ($j = 1; $j < $line_number; $j++) {
            $sheet->getStyle($aCol[$i] . $j)->applyFromArray($styleArray);
        }
    }


    $writer = new Xlsx($spreadsheet);
    header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    $dbc->Close();
    ?>