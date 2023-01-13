<?php
	session_start();
	include_once "../../../config/define.php";
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	include_once "../../../include/iface.php";

	$dbc = new dbc;
	$dbc->Connect();

	$os = new oceanos($dbc);

	$modal = new imodal($dbc,$os->auth);
	$modal->setModel("dialog_add_counting","Add Counting");
	$modal->initiForm("form_add_counting");
	$modal->setExtraClass("modal-md");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.counting.add()")
	));

	$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "รอบ"
			)
		),
		array(
			array(
				"type" => "date",
				"name" => "date_start",
				"caption" => "เริ่มต้น"
			)
		),array(
			array(
				"type" => "date",
				"name" => "date_finish",
				"caption" => "สิ้นสุด"
			)
		),array(
			array(
				"type" => "textarea",
				"name" => "remark",
				"caption" => "เพิ่มเติม"
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();

?>
