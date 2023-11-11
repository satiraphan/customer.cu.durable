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

    $filename='รายงานการเข้าใช้ระบบและการแก้ไข';

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    //header
    $aCol = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I');
    $aField = array('ว/ด/ป','USERNAME','เข้าใช้งานระบบ','แก้ไขข้อมูล','เพิ่มข้อมูล','ค้นหา','พิมพ์ QR Code','การรับประกัน','หมดอายุการใช้งาน');

    $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal('center');
    $sheet->mergeCells('A1:I1');

    $sheet->setCellValue('A1', $filename);
    for ($i = 0; $i < count($aField); $i++) {
        $sheet->setCellValue($aCol[$i] . '2', $aField[$i]);
        $sheet->getColumnDimension($aCol[$i])->setAutoSize(true);
    }

    //data
    $line_number = 3;

    $sql = "SELECT  os_users.id as id,
                        os_users.name as username,
                        os_users.last_login as last_login,
                        os_logs.action as log_action,
                        os_logs.datetime as datetime
                        FROM os_logs
                        LEFT JOIN os_users ON os_users.id = os_logs.user
                        ORDER BY os_logs.id DESC";
    $rst = $dbc->Query($sql);
    $num = 1;
    while ($log = $dbc->Fetch($rst)) {
        $edit = strpos($log['log_action'], 'edit') !== false ? $log['log_action'] :'';
        $add = strpos($log['log_action'], 'add') !== false ? $log['log_action'] :'';
        $search = strpos($log['log_action'], 'search') !== false ? $log['log_action'] :'';
        $print = strpos($log['log_action'], 'print') !== false ? $log['log_action'] :'';

        $sheet->setCellValue("A" . $line_number, $log['datetime']);
        $sheet->setCellValue("B" . $line_number,$log['username']);
        $sheet->setCellValue("C" . $line_number, $log['last_login']);
        $sheet->setCellValue("D" . $line_number, $edit);
        $sheet->setCellValue("E" . $line_number, $add);
        $sheet->setCellValue("F" . $line_number, $search);
        $sheet->setCellValue("G" . $line_number, $print);
        $sheet->setCellValue("H" . $line_number, '');
        $sheet->setCellValue("I" . $line_number, '');


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