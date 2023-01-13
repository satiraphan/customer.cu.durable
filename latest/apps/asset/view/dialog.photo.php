<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	include_once "../../../include/iface.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();

	$os = new oceanos($dbc);

	class myModel extends imodal{
		function body(){
			$dbc = $this->dbc;
			$asset = $dbc->GetRecord("asm_assets","*","id=".$this->param['id']);
			$imgs = json_decode($asset['imgs']);
			echo '<form name="asset_imgs">';
				echo '<input type="hidden" name="id" value="'.$asset['id'].'">';
				echo '<div id="asset_photo_area" class="row">';
				foreach($imgs as $img){
					echo '<div class="col-4">';
						echo '<input type="hidden" name="action" value="">';
						echo '<input type="hidden" name="img[]" value="">';
						echo '<img src="..." class="img-fluid img-thumbnail" alt="...">';
					echo '</div>';
				}
				echo '</div>';
				echo '';
			echo '</form>';
			echo '<form name="form_uploader">';
				echo '<input type="file" name="file[]" enctype="multipart/form-data" multiple>';
			echo '</form>';
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_photo_asset","Asset Photo");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Upload","$('form[name=form_uploader] input[type=file]').click();"),
		array("action","btn-danger","Remove","fn.app.asset.remove()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
