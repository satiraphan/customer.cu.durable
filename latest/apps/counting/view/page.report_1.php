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


                echo '<tr>';
                echo '<td class="text-center align-middle">' . $num . '</td>';
                echo '<td class="text-center align-middle">' . $line['code'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_name'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['detail'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['year_purchase'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_unit_name'] . '</td>';
                echo '<td class="text-center align-middle">' . $line['asset_location'] . '</td>';


                $icon = '<i class="fa-solid fa-check"></i>';
                echo '<td class="text-center align-middle">';
                echo $line['action'] == 1 ? $icon : '';
                echo '</td>';
                echo '<td class="text-center align-middle">';
                echo $line['action'] != 1 && $line['action'] != 4 ? $icon : '';
                echo '</td>';
                echo '<td class="text-center align-middle">';
                echo $line['action'] == 4 ? $icon : '';
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