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
			echo '<form name="form-count-search">';
				echo '<input name="code" class="form-control" placehilder="Please input number">';
				echo '<input type="hidden" name="counting_id" class="form-control" value="'.$this->param['counting_id'].'">';
				echo '<input type="hidden" name="user_id" class="form-control"  value="'.$this->param['user_id'].'">';
			echo '</form>';
			
		}
	}


	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_count_search","Search");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Select","fn.app.counter.search()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>