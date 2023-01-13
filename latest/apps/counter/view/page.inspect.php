<?
	global $os,$dbc;
	$asset = $dbc->GetRecord("asm_assets","*","id=".$_GET['id']);
	$category = $dbc->GetRecord("asm_categories","*","id=".$asset['cat_id']);
	$asset = $dbc->GetRecord("asm_categories","*","id=".$asset['cat_id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>Asset Number :</h5>
	</div>
	<div class="card-body">
	<?php
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">หมวดหมู่</dt><dd class="col-sm-9">'.$category['name'].'</dd>';
			echo '<dt class="col-sm-3">ชื่อ</dt><dd class="col-sm-9">'.$asset['name'].'</dd>';
			echo '<dt class="col-sm-3">Brand</dt><dd class="col-sm-9">'.$asset['brand'].'</dd>';
			echo '<dt class="col-sm-3">ปีที่ซื้อ</dt><dd class="col-sm-9">'.$asset['year_purcahse'].'</dd>';
			echo '<dt class="col-sm-3">วันหมดอายุ</dt><dd class="col-sm-9">'.$asset['date_depreciate'].'</dd>';
			echo '<dt class="col-sm-3">วันหมดประกัน</dt><dd class="col-sm-9">'.$asset['date_warranty'].'</dd>';
			echo '<dt class="col-sm-3">Location</dt><dd class="col-sm-9">'.$asset['location'].'</dd>';
			echo '<dt class="col-sm-3">รายละเอียด</dt><dd class="col-sm-9">'.$asset['detail'].'</dd>';
		echo '</dl>';
	?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-success" onclick="window.history.back()"><i class="fa-solid fa-check mr-1"></i> Approve</button>
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
