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
	$counting = $dbc->GetRecord("asm_counting","*","id=".$_POST['id']);

	$modal = new imodal($dbc,$os->auth);

	$modal->setModel("dialog_edit_counting","Edit Counting");
	$modal->initiForm("form_edit_counting");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.counting.edit()")
	));
	$modal->SetVariable(array(
		array("id",$counting['id'])
	));

	$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "รอบ",
				"value" => $counting['name']
			)
		),
		array(
			array(
				"type" => "date",
				"name" => "date_start",
				"caption" => "เริ่มต้น",
				"value" => $counting['date_start']
			)
		),array(
			array(
				"type" => "date",
				"name" => "date_finish",
				"caption" => "สิ้นสุด",
				"value" => $counting['date_finish']
			)
		),array(
			array(
				"type" => "textarea",
				"name" => "remark",
				"caption" => "เพิ่มเติม",
				"value" => $counting['remark']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>
