<?
	global $os,$dbc;
?>
<div class="row card m-2">
	<div class="col-12 p-3">
	<?php
		if(is_null($os->auth['account'])){
	?>
	<div class="btn-area btn-group mb-3">
		<button class="btn btn-primary" onclick="fn.navigate('user_account','view=add')">Add</button>
	</div>
	<table id="tblAccount" class="table table-striped table-bordered table-hover" width="100%">
		<thead>
			<tr>
				<th class="text-center hidden-xs">
					<span type="checkall" control="chk_account" class="far fa-lg fa-square"></span>
				</th>
				<th class="text-center">Name</th>
				<th class="text-center hidden-xs">Created</th>
				<th class="text-center hidden-xs">Updated</th>
				<th class="text-center">Org Name</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
	<?php
		}else{
			echo '<h2>Access Denial</h2>';
		}
	?>

	</div>
</div>