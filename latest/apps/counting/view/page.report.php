<?php
	global $os,$dbc,$_GET;
	$counting = $dbc->GetRecord("asm_counting","*","id=".$_GET['id']);
	
	$total_asset = $dbc->GetRecord("asm_assets","COUNT(id)","status > 0");
	$counted = $dbc->GetRecord(
		"asm_assets LEFT JOIN asm_counting_items ON asm_assets.id = asm_counting_items.asset_id",
		"COUNT(asm_assets.id)",
		"asm_counting_items.counting_id=".$counting['id']
	);

	$counted2 = $dbc->GetRecord(
		"asm_assets LEFT JOIN asm_counting_locations ON asm_assets.location = asm_counting_locations.id",
		"COUNT(asm_assets.id)",
		"asm_counting_locations.counting_id=".$counting['id']
	);
?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>รายงานการนับ</h5>
	</div>
	<div class="card-body">
	<?php
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">หมายเลข</dt><dd class="col-sm-9">'.$counting['id'].'</dd>';
			echo '<dt class="col-sm-3">หัวข้อ</dt><dd class="col-sm-9">'.$counting['name'].'</dd>';
			echo '<dt class="col-sm-3">วันที่เรีิ่มต้น</dt><dd class="col-sm-9">'.$counting['date_start'].'</dd>';
			echo '<dt class="col-sm-3">วันที่สินสุด</dt><dd class="col-sm-9">'.$counting['date_finish'].'</dd>';
			echo '<dt class="col-sm-3">วันที่สร้าง</dt><dd class="col-sm-9">'.$counting['created'].'</dd>';
			echo '<dt class="col-sm-3">วันที่ปรับปรุง</dt><dd class="col-sm-9">'.$counting['updated'].'</dd>';
			echo '<dt class="col-sm-3">วันที่จัดผู้ส่ง</dt><dd class="col-sm-9">'.$counting['submitted'].'</dd>';
		echo '</dl>';
	?>
	<table class="table table-sm table-bordered">
		<thead>
			<tr>
				<th class="text-center">รหัส</th>
				<th class="text-center">ชื่อรายการ</th>
				<th class="text-center">รุ่น</th>
				<th class="text-center">วันที่ตรวจสอบ</th>
				<th class="text-center">รายงาน</th>
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
					asm_assets.code AS code

				FROM asm_counting_items
				LEFT JOIN asm_assets ON asm_counting_items.asset_id = asm_assets.id
				WHERE asm_counting_items.counting_id = ".$counting['id']."
			";
			$rst = $dbc->Query($sql);
			while($line = $dbc->Fetch($rst)){
				echo '<tr>';
					echo '<td class="text-center">'.$line['code'].'</td>';
					echo '<td class="text-left">'.$line['asset_name'].'</td>';
					echo '<td class="text-left">'.$line['asset_brand'].'</td>';
					echo '<td class="text-center">'.$line['validated'].'</td>';
					echo '<td class="text-center">';
					switch($line['action']){
						case "1":
							echo '<span class="text-success">ข้อมูลถูกต้อง</span>';
							break;
						case "2":
							echo '<span class="text-warning">พบความเสียหาย</span>';
							break;	
						case "3":
							echo '<span class="text-primary">ผิดตำแหน่ง</span>';
							break;	
						case "4":
							echo '<span class="text-danger">ไม่พบของ</span>';
							break;	
						case "5":
							echo '<span class="text-dark">อื่น ๆ</span>';
							break;	
					}
					echo '</td>';

				echo '</tr>';
			}
		?>
		</tbody>
	</table>


	<div class="row gutters-sm">
		<div class="col-sm-6 col-xl-3 mb-3">
			<div class="card h-100 text-white bg-primary">
				<div class="card-body">
					<div class="flex-center justify-content-start mb-2">
						<h3 class="card-title mb-0 mr-auto"><i class="fa-regular fa-box-taped"></i></h3>
						<span>จำนวนที่ต้องตรวจสอบ </span>
					</div>
					<h2 class="text-center"><?php echo $counted2[0];?></h2>
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
	<div class="card-bottom border-top d-print-none">
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
<style>
@media print
{   

    .breadcrumb,.main-header{
        display: none !important;
    }
	
	
	
	
}
</style>