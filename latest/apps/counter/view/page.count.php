<?
	global $os,$dbc;
	$counter = $dbc->GetRecord("asm_counting","*","id=".$_GET['id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>ตรวจนับ</h5>
	</div>
	<div class="card-menu border-bottom">
		<div class="m-2">
		<button class="btn btn-outline-dark" onclick=""><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
			<button class="btn btn-outline-dark" onclick="fn.app.counter.dialog_location_lookup(<?php echo $counter['id'];?>,<?php echo $os->auth['id'];?>)"><i class="fa-solid fa-chooise mr-1"></i> เลือกห้องที่ต้องการตรวจสอบ</button>
		</div>
	</div>
	<div class="card-body">
		<table id="tblAsset" data-counting-id="<?php echo $counter['id'];?>" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center">ดำเนินการ</th>
					<th class="text-center">การตรวจนับ</th>
					<th class="text-center">รหัสสินค้า</th>
					<th class="text-center">รายการ</th>
					<th class="text-center">ที่จัดเก็บ</th>
					<th class="text-center">สถานะ</th>
					<th class="text-center">Serial Number</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	<?php
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">ID</dt><dd class="col-sm-9">'.$counter['id'].'</dd>';
			echo '<dt class="col-sm-3">Name</dt><dd class="col-sm-9">'.$counter['name'].'</dd>';
		echo '</dl>';
	?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-warning" onclick="fn.app.counter.dialog_submit(<?php echo $counter['id'];?>)"><i class="fa-solid fa-thumbs-up mr-1"></i> ยืนยัน</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
