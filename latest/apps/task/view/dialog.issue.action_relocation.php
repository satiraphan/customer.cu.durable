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
	$task = $dbc->GetRecord("ams_tasks","*","id=".$_POST['id']);
	$counting_item = $dbc->GetRecord("asm_counting_items","*","id=".$task['counting_item_id']);
	$counting = $dbc->GetRecord("asm_counting","*","id=".$counting_item['counting_id']);

	$modal = new imodal($dbc,$os->auth);

	$modal->setModel("dialog_action","ย้ายตำแหน่งใหม่");
	$modal->initiForm("form_action");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","ย้ายตำแหน่งใหม่","fn.app.task.issue.relocation()")
	));
	$modal->SetVariable(array(
		array("id",$task['id']),
		array("counting_item_id",$counting_item['id']),
		array("counting_id",$counting['id']),
		array("asset_id",$counting['asset_id'])
	));

	$blueprint = array(
		array(
			array(
				"type" => "comboboxdb",
				"name" => "location",
				"source" => array(
					"table" => "asm_locations",
					"name" => "name",
					"value" => "id",
					"where" => "status = 1"
				),
				"default" => array(
          "value" => "NULL",
          "name" => "ไม่ระบุ"
        ),
				"caption" => "สถานที่จัดเก็บ",
				"value" => $counting_item['location_id']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>
