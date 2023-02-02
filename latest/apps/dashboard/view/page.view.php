<?php
	global $dbc;

	$counting = $dbc->GetRecord("asm_counting","*","status = 2");
	$total_cat = $dbc->GetRecord("asm_categories","COUNT(id)","1");
	$total_asset = $dbc->GetRecord("asm_assets","COUNT(id)","status > 0");
	$total_location = $dbc->GetRecord("asm_locations","COUNT(id)","status = 1");

	if($counting!=0){
		$total_counting_counted = $dbc->GetRecord("asm_counting_items","COUNT(id)","counting_id = ".$counting['id']);
	}
?>
<div class="row gutters-sm">
	<div class="col-sm-6 col-xl-3 mb-3">
		<div class="card h-100">
			<div class="card-body">
				<div class="flex-center justify-content-start mb-2">
					<i data-feather="link" class="mr-2 font-size-lgs"></i>
					<h3 class="card-title mb-0 mr-auto"><?php echo $total_cat[0];?></h3>
					<span id="connections">10,200,400,500,300</span>
				</div>
				<h6 class="text-primary">หมวดหมู่</h6>
				<p class="small text-secondary mb-0">จำนวนหมวดในระบบ</p>
			</div>
		</div>
	</div>
	<!-- /Connections -->

	<!-- Your Articles -->
	<div class="col-sm-6 col-xl-3 mb-3">
		<div class="card h-100">
			<div class="card-body">
				<div class="flex-center justify-content-start mb-2">
					<i data-feather="book" class="mr-2 font-size-lgs"></i>
					<h3 class="card-title mb-0 mr-auto"><?php echo $total_asset[0];?></h3>
					<span id="yourArticles">10,400,200,500,300</span>
				</div>
				<h6 class="text-primary">จำนวนครุภัณฑ์</h6>
				<p class="small text-secondary mb-0">จำนวนครุภัณฑ์ที่ยังอยู่ในระบบ</p>
			</div>
		</div>
	</div>
	<!-- Your /Articles -->

	<!-- Your Photos -->
	<div class="col-sm-6 col-xl-3 mb-3">
		<div class="card h-100">
			<div class="card-body">
				<div class="flex-center justify-content-start mb-2">
					<i data-feather="image" class="mr-2 font-size-lgs"></i>
					<h3 class="card-title mb-0 mr-auto"><?php echo $total_location[0];?></h3>
					<span id="yourPhotos">10,200,400,300,500</span>
				</div>
				<h6 class="text-primary">ห้อง</h6>
				<p class="small text-secondary mb-0">สถานที่จัดเก็บไม่ ที่มีสถานะเปิดใช้งาน</p>
			</div>
		</div>
	</div>
	<!-- Your /Photos -->

	<!-- Page Likes -->
	<div class="col-sm-6 col-xl-3 mb-3">
		<div class="card h-100">
			<div class="card-body">
				<div class="flex-center justify-content-start mb-2">
					<i data-feather="thumbs-up" class="mr-2 font-size-lgs"></i>
					<h3 class="card-title mb-0 mr-auto"><?php echo $total_counting_counted[0];?></h3>
					<span id="pageLikes">10,500,400,200,300</span>
				</div>
				<h6 class="text-primary">รายการที่ถูกนับไปแล้ว</h6>
				<p class="small text-secondary mb-0">ระบบนนับจาก "<?php echo $counting['name'];?>"</p>
			</div>
		</div>
	</div>
	<!-- Page /Likes -->
	<!-- Website Audience Metrics -->
	
	<!-- Connections -->
	<div class="col mb-3">
		<div class="card">
			<div class="card-header">
				รายการแยกหมวดหมู่
				<button type="button" data-action="fullscreen" class="btn btn-sm btn-text-secondary btn-icon rounded-circle ml-auto">
					<i class="material-icons">fullscreen</i>
				</button>
			</div>
			<div class="card-body" style="height: 300px">
				<canvas id="pie-basic"></canvas>
			</div>
		</div>
	</div>

	<div class="col mb-3">
			<div class="card">
				<div class="card-header">
					สรุปการนับล่าสุด
					<button type="button" data-action="fullscreen" class="btn btn-sm btn-text-secondary btn-icon rounded-circle ml-auto">
						<i class="material-icons">fullscreen</i>
					</button>
				</div>
				<div class="card-body" style="height: 300px">
					<canvas id="bar-chart-horizontal"></canvas>
				</div>
			</div>
		</div>
</div>