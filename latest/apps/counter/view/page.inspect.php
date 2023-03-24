<?php
	global $os,$dbc,$aAction;
	$asset = $dbc->GetRecord("asm_assets","*","id=".$_GET['id']);
	$category = $dbc->GetRecord("asm_categories","*","id=".$asset['cat_id']);


	if($dbc->HasRecord("asm_counting_items","counting_id = ".$_GET['counting_id']." AND asset_id = ".$asset['id'])){
		$counting_item = $dbc->GetRecord("asm_counting_items","*","counting_id = ".$_GET['counting_id']." AND asset_id = ".$asset['id']);
		$action_value = $counting_item['action'];
		$counting_item_id = $counting_item['id'];
	}else{
		$action_value = "1";
		$counting_item_id = "";
	}
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>Asset Number :</h5>
		<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
	</div>
	<div class="card-body">
	<?php
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">หมวดหมู่</dt><dd class="col-sm-9">'.$category['name'].'</dd>';
			echo '<dt class="col-sm-3">ชื่อ</dt><dd class="col-sm-9">'.$asset['name'].'</dd>';
			echo '<dt class="col-sm-3">Brand</dt><dd class="col-sm-9">'.$asset['brand'].'</dd>';
			echo '<dt class="col-sm-3">ปีที่ซื้อ</dt><dd class="col-sm-9">'.$asset['year_purchase'].'</dd>';
			echo '<dt class="col-sm-3">วันหมดอายุ</dt><dd class="col-sm-9">'.$asset['date_depreciate'].'</dd>';
			echo '<dt class="col-sm-3">วันหมดประกัน</dt><dd class="col-sm-9">'.$asset['date_warranty'].'</dd>';
			echo '<dt class="col-sm-3">Location</dt><dd class="col-sm-9">'.$asset['location'].'</dd>';
			echo '<dt class="col-sm-3">รายละเอียด</dt><dd class="col-sm-9">'.$asset['detail'].'</dd>';
		echo '</dl>';
	?>
	</div>
	<div class="card-bottom">
		
		<form name="form_inspect" >
			<input type="hidden" name="asset_id" value="<?php echo $asset['id']?>">
			<input type="hidden" name="counting_id" value="<?php echo $_GET['counting_id']?>">
			<input type="hidden" name="action" value="<?php echo $action_value;?>">
			<input type="hidden" name="counting_item_id" value="<?php echo $counting_item_id;?>">
			<div class="m-2 border-top pt-2">
				<div class="btn-group" role="group" aria-label="Basic example">
				<?php
					foreach($aAction as $action){
						$class = $action[0]==$action_value?"btn btn-dark text-white":"btn btn-outline-dark";
						echo '<button type="button" xname="option" data-value="'.$action[0].'" class="'.$class.'">'.$action[1].'</button>';
					}

				?>
				</div>
			</div>
			<div class="m-2 border-top pt-2 form-inline show_location">
				<label for="location_id" class="mr-2"> ตำแหน่งใหม่ </label>
					<select name="location_id" class="form-control">
					<?php
						$sql = "SELECT * FROM asm_locations WHERE status = 1";
						$rst = $dbc->Query($sql);
						while($location = $dbc->Fetch($rst)){
							if($counting_item_id != ""){
								$selected = $counting_item['location_id']==$location['id']?" selected":"";
							}else{
								$selected = $asset['location']==$location['id']?" selected":"";
							}
							echo '<option value="'.$location['id'].'"'.$selected .'>'.$location['name'].'</option>';
						}
					?>
					</select>
			</div>
			<div class="m-2 border-top pt-2 form-inline">
					<label for="detail" class="mr-2">รายละเอียด</label>
					<textarea class="form-control" name="detail"></textarea>
			</div>
		</form>
		<div class="m-2 border-top">
			<button class="btn btn-lg btn-block btn-success" onclick="fn.app.counter.inspect();"><i class="fa-solid fa-check mr-1"></i> Approve</button>
			
		</div>
	</div>
