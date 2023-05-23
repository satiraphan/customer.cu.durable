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
			
			echo '<div class="row m-2 p-4">';
				echo '<table>';
					echo '<tbody>';
						echo '<tr>';
							echo '<td style="width:350px;font-size:26px;overflow-x: hidden;font-weight: bold;" class="pt-4 label-font">';
								echo '<br>';
								echo $asset['code']."<br>";
								echo $asset['name']."<br>";
								echo $asset['brand']."<br>";
								if(!is_null($asset['location'])){
									$location = $dbc->GetRecord("asm_locations","*","id=".$asset['location']);
									echo $location['name']."<br>";
								}
								echo '<span style="font-size:22px">'.$asset['detail'].'<span>';
							echo '</td>';
							echo '<td style="width:300px">';
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
	.main-body,.card-body{
		padding:0px;
		margin:0px;
	}
	.print-area{
		padding:0px;
		margin:0px;
	}
	@page {size: landscape}
	
    .breadcrumb,.main-header{
        display: none !important;
    }
	
	#dlAsset {
		margin-top:20px;
		page-break-before: always;
	}
	
	.label-font{
		font-family:"tahoma" !important;
		font-weight: bold;
	}
	
	
}
</style>