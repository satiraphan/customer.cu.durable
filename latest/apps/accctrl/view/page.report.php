<?php
global $os, $dbc;
?>
<div class="btn-area mb-2">
    <button onclick="fn.app.accctrl.report()" class="btn btn-primary mr-1"><i
                class="fa-solid fa-file-export"></i> export
    </button>
</div>
<div class="description text-center mb-4">
    <h3>รายงานการเข้าใช้ระบบและการแก้ไข</h3>
</div>
<form name="export_report">
    <input type="hidden" name="id" value="">
</form>
<table id="tblUser" class="table table-striped table-bordered table-hover table-middle" width="100%">
    <thead>
    <tr>
        <th class="text-center">ว/ด/ป</th>
        <th class="text-center">USERNAME</th>
        <th class="text-center hidden-xs">เข้าใช้งานระบบ</th>
        <th class="text-center hidden-xs">แก้ไขข้อมูล</th>
        <th class="text-center hidden-xs">เพิ่มข้อมูล</th>
        <th class="text-center hidden-xs">ค้นหา</th>
        <th class="text-center hidden-xs">พิมพ์ QR Code</th>
        <th class="text-center">การรับประกัน</th>
        <th class="text-center">หมดอายุการใช้งาน</th>
    </tr>
    </thead>
    <tbody>
    <?php
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
        echo '<tr>';
            echo '<td>'.$log['datetime'].'</td>';
            echo '<td>'.$log['username'].'</td>';
            echo '<td>'.$log['last_login'].'</td>';
            echo '<td>'.$edit.'</td>';
            echo '<td>'.$add.'</td>';
            echo '<td>'.$search.'</td>';
            echo '<td>'.$print.'</td>';
            echo '<td></td>';
            echo '<td></td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
