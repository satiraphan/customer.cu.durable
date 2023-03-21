<?php
	global $os,$dbc;
	$repair = $dbc->GetRecord("asm_repairing","*","id=".$_GET['id']);
	$task = $dbc->GetRecord("ams_tasks","*","id=".$repair['task_id']);
	$asset = $dbc->GetRecord("asm_assets","*","id=".$repair['asset_id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>Repair Lookup</h5>
	</div>
	<div class="card-body">
	<?php
	
	echo '<dl id="dlAsset" class="row" data-code="'.$asset['code'].'">';
		echo '<dt class="col-sm-3">ID</dt><dd class="col-sm-9">'.$asset['id'].'</dd>';
		echo '<dt class="col-sm-3">code</dt><dd class="col-sm-9">'.$asset['code'].'</dd>';
		echo '<dt class="col-sm-3">หมวดหมุ่</dt><dd class="col-sm-9">'.$category['name'].'</dd>';
		echo '<dt class="col-sm-3">ชื่อ</dt><dd class="col-sm-9">'.$asset['name'].'</dd>';
		echo '<dt class="col-sm-3">รุ่น</dt><dd class="col-sm-9">'.$asset['brand'].'</dd>';
		echo '<dt class="col-sm-3">Serial Number</dt><dd class="col-sm-9">'.$asset['serial'].'</dd>';
		echo '<dt class="col-sm-3">ปีที่ซื้อ</dt><dd class="col-sm-9">'.$asset['name'].'</dd>';
		echo '<dt class="col-sm-3">วันหมดอายุการใช้งาน</dt><dd class="col-sm-9">'.$asset['date_depreciate'].'</dd>';
		echo '<dt class="col-sm-3">วันหมดประกัน</dt><dd class="col-sm-9">'.$asset['date_warranty'].'</dd>';
		echo '<dt class="col-sm-3">วันที่นำเข้าข้อมูล</dt><dd class="col-sm-9">'.$asset['created'].'</dd>';
		echo '<dt class="col-sm-3">วันที่ปรับปรุงข้อมูล</dt><dd class="col-sm-9">'.$asset['updated'].'</dd>';
		echo '<dt class="col-sm-3">ข้อเน้นย้ำ</dt><dd class="col-sm-9">'.$asset['remark'].'</dd>';
	echo '</dl>';
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">ID</dt><dd class="col-sm-9">'.$repair['id'].'</dd>';
			echo '<dt class="col-sm-3">Name</dt><dd class="col-sm-9">'.$repair['name'].'</dd>';
		echo '</dl>';
	?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
