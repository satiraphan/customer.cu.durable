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

    $filename='รายงานประวัติการซ่อมแซม';
    $repairing_id = $_POST['id'];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    //header
    $aCol = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J','K');
    $aField = array('ที่','รายการครุภัณฑ์','ยี่ห้อ/รุ่น','รหัสครุภัณฑ์','อาการที่ส่งซ่อม','จำนวนเงิน','ว/ด/ป ที่ส่งซ่อม','การรับประกัน','ใช้ประจำ','Vendor','Sale');

    $sheet->getStyle('A1:K1')->getAlignment()->setHorizontal('center');
    $sheet->mergeCells('A1:K1');

    $sheet->setCellValue('A1', $filename);
    for ($i = 0; $i < count($aField); $i++) {
        $sheet->setCellValue($aCol[$i] . '2', $aField[$i]);
        $sheet->getColumnDimension($aCol[$i])->setAutoSize(true);
    }

    //data
    $line_number = 3;

    $sql = "SELECT asm_repairing.asset_id as asset_id,
                asm_assets.name as asset_name,
                asm_assets.brand as asset_brand,
                asm_assets.code as code,
                asm_assets.date_warranty as asset_warranty,
                ams_tasks.title as task_title,
                ams_tasks.issued as task_issued,
                asm_locations.name AS asset_location
                
                        FROM asm_repairing
                        LEFT JOIN ams_tasks ON asm_repairing.task_id = ams_tasks.id
                        LEFT JOIN asm_assets ON asm_repairing.asset_id = asm_assets.id
                        LEFT JOIN asm_locations ON asm_assets.location = asm_locations.id
                        WHERE asm_repairing.id IN ($repairing_id)
                           
                    ";
    $rst = $dbc->Query($sql);
    $num = 1;
    while ($line = $dbc->Fetch($rst)) {


        $sheet->setCellValue("A" . $line_number, $num);
        $sheet->setCellValue("B" . $line_number,$line['asset_name'] );
        $sheet->setCellValue("C" . $line_number, $line['asset_brand']);
        $sheet->setCellValue("D" . $line_number, $line['code']);
        $sheet->setCellValue("E" . $line_number, $line['task_title']);
        $sheet->setCellValue("F" . $line_number, '');
        $sheet->setCellValue("G" . $line_number, $line['task_issued']);
        $sheet->setCellValue("H" . $line_number, $line['asset_warranty']);
        $sheet->setCellValue("I" . $line_number, $line['asset_location']);
        $sheet->setCellValue("J" . $line_number, '');
        $sheet->setCellValue("K" . $line_number, '');


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