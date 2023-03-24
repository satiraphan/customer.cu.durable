<?php
	global $os,$dbc;
?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="fa fa-house mr-2"></i>รายการตรวจนับ</h5>
	</div>
	<div class="card-body">
		
		<table id="tblCounter" class="table table-striped table-bordered table-hover" width="100%" user-id="<?php echo $os->auth['id'];?>">
			<thead>
				<tr>
					<th class="text-center">ดำเนินการ</th>
					<th class="text-center">การตรวจนับ</th>
					<th class="text-center">วันที่เริ่มต้น</th>
					<th class="text-center">วันที่สิ้นสุด</th>
					<th class="text-center">บันทึกเพิ่มเติม</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
