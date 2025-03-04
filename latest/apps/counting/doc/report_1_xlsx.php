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

    $filename = 'รายงานผลการตรวจสอบพัสดุ';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $counting_id = $_POST['id'];


    //header
    $aCol = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    $aField = array('ที่','หมายเลขครุภัณฑ์','รายการ','รายละเอียด','ปีที่ซื้อ/ได้มา','หน่วยนับ','สถานที่ใช้ประจำ','พบรายการ','','ไม่พบรายการ');
    $bField = array('','','','','','','','ใช้ได้','ใช้ไม่ได้','');

    $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
    $sheet->getStyle('H:J')->getAlignment()->setHorizontal('center');
    $sheet->mergeCells('A1:J1');
    $sheet->mergeCells('H2:I2');
    $sheet->mergeCells('A3:G3');

    $sheet->setCellValue('A1', $filename);
    for ($i = 0; $i < count($aField); $i++) {
        $sheet->setCellValue($aCol[$i] . '2', $aField[$i]);
        $sheet->getColumnDimension($aCol[$i])->setAutoSize(true);
    }
    for ($i = 0; $i < count($bField); $i++) {
        $sheet->setCellValue($aCol[$i] . '3', $bField[$i]);
    }

    //data
    $line_number = 4;
    $sql = "SELECT DISTINCT  asm_counting_items.asset_id AS asset_id
                   FROM asm_counting_items
                   WHERE  asm_counting_items.counting_id IN ($counting_id)
                   ORDER BY asm_counting_items.id ASC";
    $rst = $dbc->Query($sql);
    $num = 1;
    while ($line = $dbc->Fetch($rst)) {
        $counting_item = "";
        $asset_id = $line['asset_id'];
        $sql2 = "SELECT * FROM asm_counting_items 
                    WHERE asm_counting_items.asset_id='$asset_id' AND asm_counting_items.counting_id IN ($counting_id) 
                    ORDER BY asm_counting_items.counting_id DESC";
        $rst2 = $dbc->Query($sql2);
        if ($dbc->Total($rst2) > 0) {
            $line = $dbc->Fetch($rst2);
            $counting_item = $line;
        }

        $asset = $dbc->GetRecord("asm_assets","*","id=".$line['asset_id']);
        $location = $dbc->GetRecord("asm_locations","name","id=".$counting_item['location_id']);
        $icon = '/';

        $sheet->setCellValue("A" . $line_number, $num);
        $sheet->setCellValue("B" . $line_number, $asset['code']);
        $sheet->setCellValue("C" . $line_number, $asset['name']);
        $sheet->setCellValue("D" . $line_number, $counting_item['detail']);
        $sheet->setCellValue("E" . $line_number, $asset['year_purchase']);
        $sheet->setCellValue("F" . $line_number, $asset['unit_name']);
        $sheet->setCellValue("G" . $line_number, $location['name']);
        $sheet->setCellValue("H" . $line_number, $counting_item['action'] == 1 ? $icon : '');
        $sheet->setCellValue("I" . $line_number, $counting_item['action'] != 1 && $counting_item['action'] != 4 ? $icon : '');
        $sheet->setCellValue("J" . $line_number, $counting_item['action'] == 4 ? $icon : '');


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
            $sheet ->getStyle($aCol[$i].$j)->applyFromArray($styleArray);
        }
    }



    $writer = new Xlsx($spreadsheet);
    header('Content-Disposition: attachment; filename="'.$filename.'.xlsx"');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    $dbc->Close();
    ?>