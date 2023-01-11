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
	$modal->setModel("dialog_add_floor","เพิ่มชั้นในอาคาร");
	$modal->initiForm("form_addfloor");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.location.floor.add()")
	));

	$blueprint = array(
		array(
			array(
				"type" => "comboboxdb",
				"name" => "parent",
				"source" => array(
					"table" => "asm_locations",
					"name" => "name",
					"value" => "id",
					"where" => "type = 1"
				),
				"caption" => "ชื่ออาคาร"
			)
		),array(
			array(
				"name" => "name",
				"caption" => "ชื่อชั้น",
				"placeholder" => "ชื่อชั้น"
			)
		),array(
			array(
				"type" => "textarea",
				"name" => "detail",
				"caption" => "รายละเอียด",
				"placeholder" => "รายละเอียด"
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();

?>
