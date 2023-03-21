<?
	global $os,$dbc;
?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="fa fa-eye mr-2"></i>View</h5>
		
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
		</div>
		<table id="tblValidator" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center hidden-xs">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="chk_validator" control="chk_validator">
							<label class="custom-control-label" for="chk_validator"></label>
						</div>
					</th>
					<th class="text-center">รอบตัวตรวจนับ</th>
					<th class="text-center">วันที่ดำเนินการ</th>
					<th class="text-center">วันส่งข้อมูล</th>
					<th class="text-center">ผู้ตรวจสอบข้อมูล</th>
					<th class="text-center">สถานะ</th>
					<th class="text-center">ดำเนินการ</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<div id="selected_item">
		</div>
	</div>
</div>
