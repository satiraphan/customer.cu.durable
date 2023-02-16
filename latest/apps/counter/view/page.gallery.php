<?
	global $os,$dbc;
	$asset = $dbc->GetRecord("asm_assets","*","id=".$_GET['id']);
	$category = $dbc->GetRecord("asm_categories","*","id=".$asset['cat_id']);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-eye mr-2"></i>Asset View</h5>
	</div>
	<div class="card-body">
	<?php
		echo '<dl id="dlAsset" class="row" data-code="'.$asset['code'].'">';
			echo '<dt class="col-sm-3">ID</dt><dd class="col-sm-9">'.$asset['id'].'</dd>';
			echo '<dt class="col-sm-3">code</dt><dd class="col-sm-9">'.$asset['code'].'</dd>';
		echo '</dl>';
		echo '<hr>';
		echo '<div class="gellery">';
			echo '<form name="form_gallery">';
			echo '<input type="hidden" name="id" value="'.$asset['id'].'">';
			echo '<div id="asset_photo_area" class="row">';
			$imgs = json_decode($asset['imgs'],true);
			foreach($imgs as $img){
				echo '<div class="col-3">';
					echo '<input type="hidden" name="img[]" value="'.$img['path'].'">';
					echo '<img src="'.$img['path'].'" class="img-fluid img-thumbnail" alt="...">';
					echo '<input class="form-control" name="caption[]" value="'.$img['caption'].'" placeHolder="Caption">';
					echo '<a href="javascript:;" class="btn btn-danger" onclick="$(this).parent().remove();">ลบรูป</a>';
				echo '</div>';
			}

			echo '</div>';
			echo '</form>';
		echo '</div>';
		echo '<form name="form_uploader" class="d-none">';
			echo '<input type="file" name="file[]" enctype="multipart/form-data" multiple>';
		echo '</form>';
	?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
			<button class="btn btn-outline-dark" onclick="$('form[name=form_uploader] input[type=file]').click();"><i class="fa fa-upload mr-1"></i> Upload Photo</button>
			<button class="btn btn-outline-dark" onclick="fn.app.asset.save_photo()"><i class="fa fa-floppy-o mr-1"></i> Save</button>
		</div>
	</div>
</div>