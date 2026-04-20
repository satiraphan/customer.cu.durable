<?php global $dbc;

$counting_id = $_GET['id'];

?>
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>รายงานตรวจสอบพัสดุ</h5>

    </div>
    <div class="card-body">
        <div class="btn-area mb-2">
            <button class="btn btn-outline-dark" onclick="window.history.back()"><i
                        class="fa-solid fa-up-left mr-1"></i> Back
            </button>
            <button onclick="fn.app.counting.report('1')" class="btn btn-primary mr-1"><i
                        class="fa-solid fa-file-export"></i> export
            </button>
        </div>
        <div class="description text-center mb-4">
            <h3>รายงานตรวจสอบพัสดุ</h3>
        </div>
        <form name="export_report">
            <input type="hidden" name="id" value="<?php echo $counting_id; ?>">
        </form>
        <table class="table table-sm table-bordered" id="report">
            <thead>
            <tr>
                <th class="text-center">ที่</th>
                <th class="text-center">หมายเลขครุภัณฑ์</th>
                <th class="text-center">รายการ</th>
                <th class="text-center">รายละเอียด</th>
                <th class="text-center">ปีที่ซื้อ/ได้มา</th>
                <th class="text-center">หน่วยนับ</th>
                <th class="text-center">สถานที่ใช้ประจำ</th>
                <th class="text-center" colspan="2">พบรายการ</th>
                <th class="text-center align-middle" rowspan="2">ไม่พบรายการ</th>

            </tr>
            <tr>
                <th colspan="7"></th>
                <th class="text-center">ใช้ได้</th>
                <th class="text-center">ใช้ไม่ได้</th>
            </tr>
            </thead>
            <tbody>
            <?php

            $sql = "SELECT DISTINCT  asm_counting_items.asset_id AS asset_id
                    FROM asm_counting_items
                    WHERE  asm_counting_items.counting_id IN ($counting_id)
                    ORDER BY asm_counting_items.id ASC";
            $rst = $dbc->Query($sql);
            $num = 1;
            while ($line = $dbc->Fetch($rst)) {
                $counting_item = '';
                $location = '';
                $asset_id = $line['asset_id'];
                $sql2 = "SELECT * FROM asm_counting_items 
                    WHERE asm_counting_items.asset_id='$asset_id' AND asm_counting_items.counting_id IN ($counting_id) 
                    ORDER BY asm_counting_items.counting_id DESC";
                $rst2 = $dbc->Query($sql2);
                if ($dbc->Total($rst2) > 0) {
                    $line = $dbc->Fetch($rst2);
                    $counting_item = $line;
                    $location = $dbc->GetRecord("asm_locations","name","id=".$counting_item['location_id']);
                }
                $asset = $dbc->GetRecord("asm_assets","*","id=".$asset_id);

                echo '<tr>';
                echo '<td class="text-center align-middle">' . $num . '</td>';
                echo '<td class="text-center align-middle">' . $asset['code'] . '</td>';
                echo '<td class="text-center align-middle">' . $asset['name'] . '</td>';
                echo '<td class="text-center align-middle">' . $counting_item['detail'] . '</td>';
                echo '<td class="text-center align-middle">' . $asset['year_purchase'] . '</td>';
                echo '<td class="text-center align-middle">' . $asset['unit_name'] . '</td>';
                echo '<td class="text-center align-middle">' . $location['name'] . '</td>';


                $icon = '<i class="fa-solid fa-check"></i>';
                echo '<td class="text-center align-middle">';
                echo $counting_item['action'] == 1 ? $icon : '';
                echo '</td>';
                echo '<td class="text-center align-middle">';
                echo $counting_item['action'] != 1 && $counting_item['action'] != 4 ? $icon : '';
                echo '</td>';
                echo '<td class="text-center align-middle">';
                echo $counting_item['action'] == 4 ? $icon : '';
                echo '</td>';
                echo '<tr>';
                $num++;
            }
            ?>
            </tbody>
        </table>
    </div>
    <style>
        @media print {

            .breadcrumb, .main-header {
                display: none !important;
            }


        }
    </style>