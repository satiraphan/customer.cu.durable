<?php
	global $dbc,$_GET;
?>
<div class="card">
	<div class="card-header border-bottom d-print-none">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
	</div>
	<div class="card-body print-area">
	<?php
		$sql = "SELECT * FROM asm_assets WHERE id in (".$_GET['ids'].")";
		$rst = $dbc->Query($sql);
		while($asset = $dbc->Fetch($rst)){
			$category = $dbc->GetRecord("asm_categories","*","id=".$asset['cat_id']);
			
			echo '<div class="row m-4 p-2 ">';
				echo '<table>';
					echo '<tbody>';
						echo '<tr>';
							echo '<td class="pt-4">';
								echo '<dl id="dlAsset" class="row" data-code="'.$asset['code'].'">';
									echo '<dt class="col-sm-3">code</dt><dd class="col-sm-9">'.$asset['code'].'</dd>';
									echo '<dt class="col-sm-3">หมวดหมุ่</dt><dd class="col-sm-9">'.$category['name'].'</dd>';
									echo '<dt class="col-sm-3">ชื่อ</dt><dd class="col-sm-9">'.$asset['name'].'</dd>';
									echo '<dt class="col-sm-3">รุ่น</dt><dd class="col-sm-9">'.$asset['brand'].'</dd>';
								echo '</dl>';
							echo '</td>';
							echo '<td>';
								echo '<div class="qrcode" data-code="'.$asset['code'].'"></div>';
							echo '</td>';
						echo '</tr>';
					echo '</tbody>';
				echo '</table>';
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

	#dlAsset {
		margin-top:20px;
		font-size: 25px;
	}

}
</style>