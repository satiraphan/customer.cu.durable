<?
	global $os,$dbc;
	$asset = $dbc->GetRecord("asm_assets","*","id=".$_GET['id']);
	$category = $dbc->GetRecord("asm_categories","*","id=".$asset['cat_id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>Asset Number :</h5>
	</div>
	<div class="card-body">
	<?php
		echo '<dl class="row">';
			echo '<dt class="col-sm-3">หมวดหมู่</dt><dd class="col-sm-9">'.$category['name'].'</dd>';
			echo '<dt class="col-sm-3">ชื่อ</dt><dd class="col-sm-9">'.$asset['name'].'</dd>';
			echo '<dt class="col-sm-3">Brand</dt><dd class="col-sm-9">'.$asset['brand'].'</dd>';
			echo '<dt class="col-sm-3">ปีที่ซื้อ</dt><dd class="col-sm-9">'.$asset['year_purcahse'].'</dd>';
			echo '<dt class="col-sm-3">วันหมดอายุ</dt><dd class="col-sm-9">'.$asset['date_depreciate'].'</dd>';
			echo '<dt class="col-sm-3">วันหมดประกัน</dt><dd class="col-sm-9">'.$asset['date_warranty'].'</dd>';
			echo '<dt class="col-sm-3">Location</dt><dd class="col-sm-9">'.$asset['location'].'</dd>';
			echo '<dt class="col-sm-3">รายละเอียด</dt><dd class="col-sm-9">'.$asset['detail'].'</dd>';
		echo '</dl>';
	?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-success" onclick="fn.app.counter.inspect();"><i class="fa-solid fa-check mr-1"></i> Approve</button>
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
		<form name="form_inspect" >
			<input type="hidden" name="asset_id" value="<?php echo $asset['id']?>">
			<input type="hidden" name="counting_id" value="<?php echo $_GET['counting_id']?>">
			<input type="hidden" name="action" value="1">
			
			<div class="m-2 border-top pt-2">
				<div class="btn-group" role="group" aria-label="Basic example">
					<button type="button" xname="option" data-value="1" class="btn btn-dark text-white">ถูกต้อง</button>
					<button type="button" xname="option" data-value="2" class="btn btn-outline-dark">แจ้งของเสีย</button>
					<button type="button" xname="option" data-value="3" class="btn btn-outline-dark">แจ้งของผิดตำแหน่ง</button>
					<button type="button" xname="option" data-value="4" class="btn btn-outline-dark">แจ้งของหาย</button>
					<button type="button" xname="option" data-value="5" class="btn btn-outline-dark">อื่น ๆ</button>
				</div>
			</div>
			<div class="m-2 border-top pt-2 form-inline show_location">
				<label for="location_id" class="mr-2"> ตำแหน่งใหม่ </label>
					<select name="location_id" class="form-control">
					<?php
						$sql = "SELECT * FROM asm_locations WHERE status = 1";
						$rst = $dbc->Query($sql);
						while($location = $dbc->Fetch($rst)){
							$selected = $asset['location']==$location['id']?" selected":"";
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
	</div>
