<?
	global $os,$dbc;
	$counting = $dbc->GetRecord("asm_counting","*","id=".$_GET['id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>ตรวจสอบการทำงาน</h5>
		<div class="custom-control custom-switch">
			<input onchange='$("#tblAsset").DataTable().draw();' type="checkbox" class="custom-control-input" id="chk_showall">
			<label class="custom-control-label" for="chk_showall">Show All</label>
		</div>
	</div>
	<div class="card-body">
	<table id="tblValidate" class="table table-striped table-bordered table-hover" width="100%" counting-id="<?php echo $counting['id'];?>">
			<thead>
				<tr>
					<th class="text-center">รหัสสินค้า</th>
					<th class="text-center">รายการ</th>
					<th class="text-center">Serial Number</th>
					<th class="text-center">สถานะ</th>
					<th class="text-center">วันที่ตรวจสอบ</th>
					<th class="text-center">ผู้ตรวจสอบข้อมูล</th>
					<th class="text-center">ข้อแนะนำ</th>
					<th class="text-center">รายละเอียด</th>
					<th class="text-center">ดำเนินการ</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
