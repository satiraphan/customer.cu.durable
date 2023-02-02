<?php
	global $dbc,$_GET;
?>
<div class="card">
	<div class="card-header border-bottom  d-print-none">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
	</div>
	<div class="card-body">
	<?php
		$sql = "SELECT * FROM asm_assets WHERE id in (".$_GET['ids'].")";
		$rst = $dbc->Query($sql);
		while($asset = $dbc->Fetch($rst)){
			$category = $dbc->GetRecord("asm_categories","*","id=".$asset['cat_id']);
			echo '<div class="row m-4 p-2 border border-dark">';
				echo '<div class="col-sm-4">';
					echo '<div class="qrcode" data-code="'.$asset['code'].'"></div>';
					echo '</div>';
				echo '<div class="col-sm-8">';
					echo '<dl id="dlAsset" class="row" data-code="'.$asset['code'].'">';
						echo '<dt class="col-sm-3">ID</dt><dd class="col-sm-9">'.$asset['id'].'</dd>';
						echo '<dt class="col-sm-3">code</dt><dd class="col-sm-9">'.$asset['code'].'</dd>';
						echo '<dt class="col-sm-3">หมวดหมุ่</dt><dd class="col-sm-9">'.$category['name'].'</dd>';
						echo '<dt class="col-sm-3">ชื่อ</dt><dd class="col-sm-9">'.$asset['name'].'</dd>';
						echo '<dt class="col-sm-3">รุ่น</dt><dd class="col-sm-9">'.$asset['brand'].'</dd>';
						echo '<dt class="col-sm-3">Serial Number</dt><dd class="col-sm-9">'.$asset['serial'].'</dd>';
					echo '</dl>';
				echo '</div>';
			echo '</div>';
		}


	?>
	</div>
</div>

<style>
@media print
{    
    .breadcrumb,.main-header{
        display: none !important;
    }
}
</style>