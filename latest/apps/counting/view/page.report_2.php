<?php global $dbc;


$counting_id = $_GET['id'];
$counted1 = $dbc->GetRecord(
    "asm_assets LEFT JOIN asm_counting_items ON asm_assets.id = asm_counting_items.asset_id",
    "COUNT(asm_assets.id)",
    "asm_counting_items.action = '1' AND asm_counting_items.counting_id IN ($counting_id)"
);
$counted2 = $dbc->GetRecord(
    "asm_assets LEFT JOIN asm_counting_items ON asm_assets.id = asm_counting_items.asset_id",
    "COUNT(asm_assets.id)",
    "asm_counting_items.action = '2' AND asm_counting_items.counting_id IN ($counting_id)"
);
$counted3 = $dbc->GetRecord(
    "asm_assets LEFT JOIN asm_counting_items ON asm_assets.id = asm_counting_items.asset_id",
    "COUNT(asm_assets.id)",
    "asm_counting_items.action = '3' AND asm_counting_items.counting_id IN ($counting_id)"
);
$counted4 = $dbc->GetRecord(
    "asm_assets LEFT JOIN asm_counting_items ON asm_assets.id = asm_counting_items.asset_id",
    "COUNT(asm_assets.id)",
    "asm_counting_items.action = '4' AND asm_counting_items.counting_id IN ($counting_id)"
);
$counted5 = $dbc->GetRecord(
    "asm_assets LEFT JOIN asm_counting_items ON asm_assets.id = asm_counting_items.asset_id",
    "COUNT(asm_assets.id)",
    "asm_counting_items.action = '5' AND asm_counting_items.counting_id IN ($counting_id)"
);
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
            <button onclick="fn.app.counting.report('2')" class="btn btn-primary mr-1"><i
                        class="fa-solid fa-file-export"></i> export
            </button>
        </div>
        <div class="description text-center mb-4">
            <h3>รายงานสรุปผลการตรวจสอบพัสดุ</h3>
        </div>
        <form name="export_report">
            <input type="hidden" name="id" value="<?php echo $counting_id; ?>">
        </form>
        <table class="table table-sm table-bordered" id="report" style="border: 1px solid #000;">
            <thead style="background-color: lightgrey;">
            <tr >
                <th class="text-center">ที่</th>
                <th class="text-center">สถานที่ตรวจพบ</th>
                <th class="text-center">รูปภาพยืนยัน</th>
                <th class="text-center" colspan="3">จำนวน / รายการ</th>
            </tr>

            </thead>
            <tbody>
            <tr>
                <td class="text-center align-middle">1</td>
                <td class="text-left align-middle">ครุภัณฑ์ที่ตรวจสอบแล้วพบรายการแล้วใช้งานได้</td>
                <td class="text-center align-middle"></td>
                <td class="text-center align-middle">จำนวน</td>
                <td class="text-center align-middle" ><?php echo $counted1['0']; ?></td>
                <td class="text-center align-middle">รายการ</td>
            </tr>
            <tr>
                <td class="text-center align-middle">2</td>
                <td class="text-left align-middle">ครุภัณฑ์ที่ตรวจสอบแล้วพบรายการแล้วใช้งานไม่ได้</td>
                <td class="text-center align-middle">ต้องระบุ</td>
                <td class="text-center align-middle">จำนวน</td>
                <td class="text-center align-middle" ><?php echo $counted2['0']; ?></td>
                <td class="text-center align-middle">รายการ</td>
            </tr>
            <tr>
                <td class="text-center align-middle">3</td>
                <td class="text-left align-middle">ครุภัณฑ์ที่ตรวจสอบแล้วไม่พบรายการแล้วใช้งานได้</td>
                <td class="text-center align-middle"></td>
                <td class="text-center align-middle">จำนวน</td>
                <td class="text-center align-middle" ><?php echo $counted3['0']; ?></td>
                <td class="text-center align-middle">รายการ</td>
            </tr>
            <tr>
                <td class="text-center align-middle">4</td>
                <td class="text-left align-middle">ครุภัณฑ์ที่ตรวจสอบแล้วไม่พบรายการแล้วใช้งานไม่ได้</td>
                <td class="text-center align-middle">ต้องระบุ</td>
                <td class="text-center align-middle">จำนวน</td>
                <td class="text-center align-middle" ><?php echo $counted4['0']; ?></td>
                <td class="text-center align-middle">รายการ</td>
            </tr>
            <tr>
                <td class="text-center align-middle">5</td>
                <td class="text-left align-middle">ครุภัณฑ์ที่ตรวจสอบแล้วไม่พบรายการ QR Code (มีปัญหา)</td>
                <td class="text-center align-middle">ต้องระบุ</td>
                <td class="text-center align-middle">จำนวน</td>
                <td class="text-center align-middle" ><?php echo $counted5['0']; ?></td>
                <td class="text-center align-middle">รายการ</td>
            </tr>
            <tr>
                <td class="text-center align-middle">6</td>
                <td class="text-left align-middle">ครุภัณฑ์ที่ตรวจสอบแล้ว QR Code ซ้ำ</td>
                <td class="text-center align-middle"></td>
                <td class="text-center align-middle">จำนวน</td>
                <td class="text-center align-middle" ><?php echo 0; ?></td>
                <td class="text-center align-middle">รายการ</td>
            </tr>
            </tbody>
        </table>
    </div>
    <style>
        @media print {

            .breadcrumb, .main-header {
                display: none !important;
            }


        }
        .table-sm thead th{
            font-weight: bold;
        }
    </style>