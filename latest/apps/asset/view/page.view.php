<?php
	global $os,$dbc;
?>
<div class="card">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="mr-2 fa-regular fa-box"></i>รายการครุภัณฑ์</h5>
	</div>
	<div class="card-body">
		<div class="float-right">
			<div>
				
				<select name="filter-category" class="form-control" onchange='$("#tblAsset").DataTable().draw();'>
				<?php
					echo '<option value="%">แสดงทุกหมวดหมู่</option>';
					$rst= $dbc->Query("SELECT * FROM asm_categories");
					while($cat = $dbc->Fetch($rst)){
						
						$selected = isset($_GET['cat_id'])?($_GET['cat_id']==$cat['id']?" selected":""):"";
						echo '<option value="'.$cat['id'].'"'.$selected.'>'.$cat['name'].'</option>';
					}
				?>
				</select>
			</div>
		</div>
		<div class="btn-area mb-2">
			<button onclick="fn.navigate('asset','view=add')" class="btn btn-outline-dark" ><i class="fa fa-circle-plus mr-1"></i>Add</button>
			<button onclick="fn.app.asset.dialog_remove()" class="btn btn-outline-danger" ><i class="fa fa-trash mr-1"></i>Remove</button>
			<button onclick="$('form[name=importer] input').click();" class="btn btn-warning mr-4" ><i class="fa fa-upload mr-1"></i>Import</button>
			<button onclick="fn.app.asset.print_tag()" class="btn btn-info mr-2" ><i class="fa fa-print mr-1"></i>Printag</button>
			<!--
			<button id="openreader-btn" class="btn btn-outline-dark"><i class="fa-solid fa-barcode"></i> ค้นหา</button>
			<button class="btn btn-outline-dark"><i class="fa-solid fa-magnifying-glass"></i> ค้นหา</button>
			-->
		</div>
		<div id="reader" width="300px"></div>
		<table id="tblAsset" class="table table-striped table-bordered table-hover" width="100%" account="<?php echo $os->auth['account'];?>">
			<thead>
				<tr>
					<th class="text-center hidden-xs">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="chk_asset" control="chk_asset">
							<label class="custom-control-label" for="chk_asset"></label>
						</div>
					</th>
					<th class="text-center">รหัสครุภัณฑ์</th>
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
<form name="importer" class="d-none">
	<input type="file" name="file">
</form>
