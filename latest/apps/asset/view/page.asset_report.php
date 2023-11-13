<?php global $dbc;


$repairing_id = $_GET['id'];
//$counting_id = implode(",", $item_selected);
?>
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>รายงานประวัติการซ่อมแซม</h5>
    </div>
    <div class="card-body">

        <table class="table table-sm table-bordered" id="report">
            <thead>
            <tr>
                <th class="text-center">ประเภทครุภัณฑ์</th>
                <th class="text-center">รายการครุภัณฑ์</th>
                <th class="text-center">ยี่ห้อรุ่น</th>
                <th class="text-center">รหัสครุภัณฑ์</th>
                <th class="text-center">ปี่ที่ซื้อ/ได้มา</th>
                <th class="text-center">จำนวนเงิน</th>
                <th class="text-center">จำนวน</th>
                <th class="text-center">หน่วยนับ</th>
                <th class="text-center">ใช้ประจำ</th>
                <th class="text-center">อาคาร</th>
                <th class="text-center">ชั้น</th>
                <th class="text-center">ห้อง</th>
                <th class="text-center align-middle">Vendor</th>
                <th class="text-center align-middle">Sale</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $sql = "SELECT asm_repairing.asset_id as asset_id,
                    asm_assets.name as asset_name,
                    asm_assets.brand as asset_brand,
                    asm_assets.code as code,
                    asm_assets.date_warranty as asset_warranty,
                    asm_assets.cat_id as cat_id,
                    asm_assets.year_purchase as year_purchase,
                    asm_locations.name AS asset_location
            
                    FROM asm_assets
                    LEFT JOIN asm_locations ON asm_assets.location = asm_locations.id
                       
                ";
            $rst = $dbc->Query($sql);
            $num = 1;
            while ($line = $dbc->Fetch($rst)) {


                echo '<tr>';
                echo '<td class="text-center align-middle">' . $line['cat_id'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_name'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_brand'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['code'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['year_purchase'] . '</td>';
                echo '<td class="text-center align-middle"></td>';
                echo '<td class="text-center align-middle">' . $line['task_issued'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_warranty'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_location'] . '</td>';
                echo '<td class="text-center align-middle"></td>';
                echo '<td class="text-center align-middle"></td>';
                echo '</tr>';
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