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
	$room = $dbc->GetRecord("asm_locations","*","id=".$_POST['id']);

	$modal = new imodal($dbc,$os->auth);

	$modal->setModel("dialog_edit_room","Edit Room");
	$modal->initiForm("form_editroom");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.location.room.edit()")
	));
	$modal->SetVariable(array(
		array("id",$room['id'])
	));

	$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "Name",
				"placeholder" => "Room Name",
				"value" => $room['name']
			)
		)
	);

	
	$floor = $dbc->GetRecord("asm_locations","*","id=".$room['parent']);

	
	$blueprint = array(
		array(
			array(
				"type" => "comboboxdb",
				"name" => "building",
				"source" => array(
					"table" => "asm_locations",
					"name" => "name",
					"value" => "id",
					"where" => "type = 1"
				),
				"caption" => "ชื่ออาคาร",
				"value" => $floor['parent']
			)
		),array(
			array(
				"type" => "comboboxdb",
				"name" => "parent",
				"source" => array(
					"table" => "asm_locations",
					"name" => "name",
					"value" => "id",
					"where" => "type = 2 AND parent = ". $floor['parent']
				),
				"caption" => "ชื่ออาคาร",
				"value" => $room['parent']
			)
		),array(
			array(
				"name" => "name",
				"caption" => "ห้อง",
				"placeholder" => "ห้อง",
				"value" => $room['name']
			)
		),array(
			array(
				"type" => "textarea",
				"name" => "detail",
				"caption" => "รายละเอียด",
				"placeholder" => "รายละเอียด",
				"value" => $room['detail']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>
