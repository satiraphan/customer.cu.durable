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
			$issue = $dbc->GetRecord("ams_tasks","*","id=".$this->param['id']);

			echo '<form name="form_closeissue">';
				echo '<div>';
					echo '<input type="hidden" name="id" value="'.$this->param['id'].'">';
					echo '<textarea class="form-control" name="remark">'.$issue['remark'].'</textarea>';
				echo '</div>';
			echo '</form>';
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_close_issue","Close Issue");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Close","fn.app.task.issue.close()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
