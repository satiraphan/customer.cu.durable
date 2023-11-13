<?php global $dbc;


$repairing_id = $_GET['id'];
//$counting_id = implode(",", $item_selected);
?>
<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>รายงานประวัติการซ่อมแซม</h5>
    </div>
    <div class="card-body">
        <div class="btn-area mb-2">
            <button class="btn btn-outline-dark" onclick="window.history.back()"><i
                        class="fa-solid fa-up-left mr-1"></i> Back
            </button>
            <button onclick="fn.app.repair.report()" class="btn btn-primary mr-1"><i
                        class="fa-solid fa-file-export"></i> export
            </button>
        </div>
        <div class="description text-center mb-4">
            <h3>รายงานประวัติการซ่อมแซม</h3>
        </div>
        <form name="export_report">
            <input type="hidden" name="id" value="<?php echo $repairing_id; ?>">
        </form>
        <table class="table table-sm table-bordered" id="report">
            <thead>
            <tr>
                <th class="text-center">ที่</th>
                <th class="text-center">รายการครุภัณฑ์</th>
                <th class="text-center">ยี่ห้อ/รุ่น</th>
                <th class="text-center">รหัสครุภัณฑ์</th>
                <th class="text-center">อาการที่ส่งซ่อม</th>
                <th class="text-center">จำนวนเงิน</th>
                <th class="text-center">ว/ด/ป ที่ส่งซ่อม</th>
                <th class="text-center">การรับประกัน</th>
                <th class="text-center">ใช้ประจำ</th>
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


                echo '<tr>';
                echo '<td class="text-center align-middle">' . $num . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_name'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_brand'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['code'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['task_title'] . '</td>';
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