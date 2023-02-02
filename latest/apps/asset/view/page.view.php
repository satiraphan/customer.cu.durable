<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="mr-2 fa-regular fa-box"></i>รายการครุภัณฑ์</h5>
	</div>
	<div class="card-body">
		<div class="btn-area mb-2">
			<button onclick="fn.navigate('asset','view=add')" class="btn btn-outline-dark" ><i class="fa fa-circle-plus mr-1"></i>Add</button>
			<button onclick="fn.app.asset.dialog_remove()" class="btn btn-outline-danger mr-4" ><i class="fa fa-trash mr-1"></i>Remove</button>
			<button onclick="fn.app.asset.print_tag()" class="btn btn-info" ><i class="fa fa-print mr-1"></i>Printag</button>

			
		</div>
		<table id="tblAsset" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center hidden-xs">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="chk_asset" control="chk_asset">
							<label class="custom-control-label" for="chk_asset"></label>
						</div>
					</th>
					<th class="text-center">รหัสสินค้า</th>
					<th class="text-center">รายการ</th>
					<th class="text-center">Serial Number</th>
					<th class="text-center">ปีทีซื้อ</th>
					<th class="text-center">ที่จัดเก็บ</th>
					<th class="text-center">สถานะ</th>
					<th class="text-center">ดำเนินการ</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>
