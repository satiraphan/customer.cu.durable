<?
	global $os,$dbc;
	$counting = $dbc->GetRecord("asm_counting","*","id=".$_GET['id']);
	
	$total_asset = $dbc->GetRecord("asm_assets","COUNT(id)","status > 0");
	$counted = $dbc->GetRecord(
		"asm_assets LEFT JOIN asm_counting_items ON asm_assets.id = asm_counting_items.asset_id",
		"COUNT(asm_assets.id)",
		"asm_counting_items.counting_id=".$counting['id']
	);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>Counting Lookup</h5>
	</div>
	<div class="card-body">
	<?php
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">หมายเลข</dt><dd class="col-sm-9">'.$counting['id'].'</dd>';
			echo '<dt class="col-sm-3">หัวข้อ</dt><dd class="col-sm-9">'.$counting['name'].'</dd>';
			echo '<dt class="col-sm-3">วันที่เรีิ่มต้น</dt><dd class="col-sm-9">'.$counting['date_start'].'</dd>';
			echo '<dt class="col-sm-3">วันที่สินสุด</dt><dd class="col-sm-9">'.$counting['date_finishe'].'</dd>';
			echo '<dt class="col-sm-3">วันที่สร้าง</dt><dd class="col-sm-9">'.$counting['created'].'</dd>';
			echo '<dt class="col-sm-3">วันที่ปรับปรุง</dt><dd class="col-sm-9">'.$counting['updated'].'</dd>';
			echo '<dt class="col-sm-3">ผู้ส่ง</dt><dd class="col-sm-9">'.$counting['submitted'].'</dd>';
		echo '</dl>';
	?>
	<div class="row gutters-sm">
		<div class="col-sm-6 col-xl-3 mb-3">
			<div class="card h-100 text-white bg-primary">
				<div class="card-body">
					<div class="flex-center justify-content-start mb-2">
						<h3 class="card-title mb-0 mr-auto"><i class="fa-regular fa-box-taped"></i></h3>
						<span>จำนวนที่ต้องตรวจสอบ </span>
					</div>
					<h2 class="text-center"><?php echo $counted[0];?></h2>
				</div>
			</div>
		</div>
		<!-- /Connections -->

		<!-- Your Articles -->
		<div class="col-sm-6 col-xl-3 mb-3">
			<div class="card h-100">
				<div class="card-body text-white bg-dark">
					<div class="flex-center justify-content-start mb-2">
						
						<h3 class="card-title mb-0 mr-auto"><i class="fa-sharp fa-solid fa-check"></i></h3>
						<span>จำนวนที่ตรวจสอบแล้ว</span>
					</div>
					<h2 class="text-center"><?php echo $counted[0];?></h2>
				</div>
			</div>
		</div>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
