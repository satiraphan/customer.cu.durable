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
    $filename = 'รายงานผลการตรวจสอบพัสดุ';
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

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
    $sql = "SELECT
               asm_counting_items.id AS id,
               asm_counting_items.validated AS validated,
               asm_counting_items.validator AS validator,
               asm_counting_items.detail AS detail,
               asm_counting_items.action AS action,
               asm_counting_items.id AS id,
               asm_assets.name AS asset_name,
               asm_assets.brand AS asset_brand,
               asm_assets.serial AS asset_serial,
               asm_assets.code AS code,
               asm_assets.unit_name AS asset_unit_name,
               asm_assets.year_purchase AS year_purchase,
               asm_locations.name AS asset_location
               
        
           FROM asm_counting_items
           LEFT JOIN asm_assets ON asm_counting_items.asset_id = asm_assets.id
           LEFT JOIN asm_locations ON asm_assets.location = asm_locations.id
           WHERE asm_counting_items.counting_id IN ($counting_id)
           GROUP BY asm_counting_items.asset_id
           ORDER BY `asm_locations`.`name` ASC 
                        ";
    $rst = $dbc->Query($sql);
    $num = 1;
    while ($line = $dbc->Fetch($rst)) {
        $icon = '/';

        $sheet->setCellValue("A" . $line_number, $num);
        $sheet->setCellValue("B" . $line_number, $line['code']);
        $sheet->setCellValue("C" . $line_number, $line['asset_name']);
        $sheet->setCellValue("D" . $line_number, $line['detail']);
        $sheet->setCellValue("E" . $line_number, $line['year_purchase']);
        $sheet->setCellValue("F" . $line_number, $line['asset_unit_name']);
        $sheet->setCellValue("G" . $line_number, $line['asset_location']);
        $sheet->setCellValue("H" . $line_number, $line['action'] == 1 ? $icon : '');
        $sheet->setCellValue("I" . $line_number, $line['action'] != 1 && $line['action'] != 4 ? $icon : '');
        $sheet->setCellValue("J" . $line_number, $line['action'] == 4 ? $icon : '');


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