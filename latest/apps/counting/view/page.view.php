<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="mr-2 fa-regular fa-list-check"></i>การตรวจนับ</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.app.counting.dialog_add()" class="btn btn-outline-dark" ><i class="fa fa-circle-plus mr-1"></i>Add</button>
			<button onclick="fn.app.counting.dialog_remove()" class="btn btn-outline-danger" ><i class="fa fa-trash mr-1"></i>Remove</button>
		</div>
		<table id="tblCounting" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center hidden-xs">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="chk_counting" control="chk_counting">
							<label class="custom-control-label" for="chk_counting"></label>
						</div>
					</th>
					<th class="text-center">รอบตัวตรวจนับ</th>
					<th class="text-center">วันที่ดำเนินการ</th>
					<th class="text-center">สถานะ</th>
					<th class="text-center">ดำเนินการ</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
