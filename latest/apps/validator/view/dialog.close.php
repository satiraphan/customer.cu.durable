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
			$counting = $dbc->GetRecord("asm_counting","*","id=".$this->param['id']);
			echo 'ต้องการที่จะปิด "'.$counting['name'].'" หรือไม่';
			echo '<form name="form_close_validator"><input type="hidden" name="id" value="'.$counting['id'].'"></form>';
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_close_validator","Close Validator");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Close","fn.app.validator.close()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
