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
			echo '<table id="tblLocationLookup" class="table table-striped table-bordered" width="100%">';
				echo '<thead>';
					echo '<tr>';
						echo '<th class="text-center">Select</th>';
						echo '<th class="text-center">Code</th>';
						echo '<th class="text-center">Name</th>';
						echo '<th class="text-center">Type</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
				echo '</tbody>';
			echo '</table>';
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_location_lookup","Select Location");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Select","fn.app.counting.select_location()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
