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
	$modal->setModel("dialog_add_room","Add Room");
	$modal->initiForm("form_addroom");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.location.room.add()")
	));

	$blueprint = array(
		array(
			array(
				"type" => "combobox",
				"name" => "building",
				"source" => array('อาคาร 1','อาคาร 2','อาคาร 3'),
				"caption" => "ชื่ออาหาร",
				"placeholder" => "ชื่ออาหาร"
			)
		),array(
			array(
				"type" => "combobox",
				"name" => "building",
				"source" => array('ชั้น 1','ชั้น 2','ชั้น 3'),
				"caption" => "ชื่อชั้น",
				"placeholder" => "ชื่ออาหาร"
			)
		),array(
			array(
				"name" => "name",
				"caption" => "ห้อง",
				"placeholder" => "ห้อง"
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
