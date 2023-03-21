<?php
	global $os,$db,$_GET;
	$counting = $dbc->GetRecord("asm_counting","*","id=".$_GET['id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-wrench mr-2"></i>เตรียมการตรวจนับ</h5>
	</div>
	<div class="card-body">
		<form name="form_manage_counting">
			<input type="hidden" name="id" value="<?php echo $counting['id'];?>">
			<div class="row">
				<div class="col-md-6">
					<div class="m-2">
						<a class="btn btn-outline-dark" onclick="fn.app.counting.dialog_location_lookup()"><i class="fa-solid fa-location mr-1"></i> Select</a>
					</div>
					<table id="tblSelectedLocation" class="table table-sm table-bordered">
						<thead>
							<tr>
								<th class="text-center">ดำเนินการ</th>
								<th class="text-center">รหัสห้อง</th>
								<th class="text-center">สถานที่</th>
								<th class="text-center">ตำแหน่ง</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sql ="SELECT * FROM asm_counting_locations WHERE counting_id = ".$counting['id'];
							$rst = $dbc->Query($sql);
							while($item = $dbc->Fetch($rst)){
								$location = $dbc->GetRecord("asm_locations","*","id=".$item['location_id']);
								echo '<tr data-id="'.$location['id'].'" cname="tr-location">';
									echo '<td class="text-center">';
									echo'<button class="btn btn-xs btn-danger" onclick="$(this).parent().parent().remove()">Remove</button>';
									echo'<input type="hidden" name="location[]" value="'.$location['id'].'">';
									echo'</td>';
									echo '<td class="text-center">'.$location['code'].'</td>';
									echo '<td class="text-center">'.$location['name'].'</td>';
									echo '<td class="text-center">'.$location['type'].'</td>';
								echo '</tr>';

							}
						?>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<div class="m-2">
						<a class="btn btn-outline-dark" onclick="fn.app.counting.dialog_user_lookup()"><i class="fa-solid fa-users mr-1"></i> Select</a>
					</div>
					<table id="tblSelectedUser" class="table table-sm table-bordered">
						<thead>
							<tr>
								<th class="text-center">ดำเนินการ</th>
								<th class="text-center">ชื่อผู้ใช้งาน</th>
								<th class="text-center">ชื่อเต็ม</th>
								<th class="text-center">กลุ่ม</th>
							</tr>
						</thead>
						<tbody>
						<?php
							$sql ="SELECT * FROM asm_counting_user WHERE counting_id = ".$counting['id'];
							$rst = $dbc->Query($sql);
							while($item = $dbc->Fetch($rst)){
								$user = $dbc->GetRecord("os_users","*","id=".$item['user_id']);
								if($user != 0){
									$group = $dbc->GetRecord("os_groups","*","id=".$user['gid']);
									echo '<tr data-id="'.$user['id'].'" cname="tr-user">';
										echo '<td class="text-center">';
										echo'<button class="btn btn-xs btn-danger" onclick="$(this).parent().parent().remove()">Remove</button>';
										echo'<input type="hidden" name="user[]" value="'.$user['id'].'">';
										echo'</td>';
										echo '<td class="text-center">'.$user['name'].'</td>';
										echo '<td class="text-center">'.$user['display'].'</td>';
										echo '<td class="text-center">'.$group['name'].'</td>';

									echo '</tr>';
								}
							}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.counting.save_manage()"><i class="fa-solid fa-up-left mr-1"></i> บันทึก</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
