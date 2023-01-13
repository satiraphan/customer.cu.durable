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
			echo '';
			echo '<table id="tblUserLookup" class="table table-striped table-bordered" width="100%">';
				echo '<thead>';
					echo '<tr>';
						echo '<th class="text-center">Select</th>';
						echo '<th class="text-center">User</th>';
						echo '<th class="text-center">Fullname</th>';
						echo '<th class="text-center">Email</th>';
						echo '<th class="text-center">Phone</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				echo '</tbody>';
			echo '</table>';
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_user_lookup","Select User");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Select","fn.app.counting.select_user()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
