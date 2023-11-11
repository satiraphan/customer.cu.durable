<?
	global $os,$dbc;
?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="fa fa-wrench mr-2"></i>View</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.app.repair.dialog_remove()" class="btn btn-outline-danger" ><i class="fa fa-trash mr-1"></i>Remove</button>
            <button onclick="fn.app.repair.report('repair_report')" class="btn btn-outline-dark" ><i class="fa-solid fa-rectangle-list mr-1"></i>รายงานประวัติการซ่อมแซม</button>

        </div>
		<table id="tblRepair" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center hidden-xs">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="chk_repair" control="chk_repair">
							<label class="custom-control-label" for="chk_repair"></label>
						</div>
					</th>
					<th class="text-center">Action</th>
					<th class="text-center">Asset ID</th>
					<th class="text-center">Asset Name</th>
					<th class="text-center">Plan</th>
					<th class="text-center">Actual</th>
					<th class="text-center">Task ID</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
		<div id="selected_item">
		</div>
	</div>
</div>
