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
	$repair = $dbc->GetRecord("asm_repairing","*","id=".$_POST['id']);

	$modal = new imodal($dbc,$os->auth);

	$modal->setModel("dialog_edit_repair","Edit Repair");
	$modal->initiForm("form_edit_repair");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.repair.edit()")
	));
	$modal->SetVariable(array(
		array("id",$repair['id'])
	));

	$blueprint = array(
		array(
			array(
				"name" => "data",
				"caption" => "Data",
				"placeholder" => "Data",
				"value" => $repair['data']
			)
		),
		array(
			array(
				"type" => "date",
				"name" => "date_repair_plan",
				"caption" => "Plan Repair",
				"value" => $repair['date_repair_plan']
			)
		),
		array(
			array(
				"type" => "date",
				"name" => "date_repair_actual",
				"caption" => "Plan Actual",
				"value" => $repair['date_repair_actual']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>
