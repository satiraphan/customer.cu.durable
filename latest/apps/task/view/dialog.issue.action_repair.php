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

	$modal->setModel("dialog_action","ส่งซ่อม");
	$modal->initiForm("form_action");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-outline-dark","Save Change","fn.app.task.count.edit()")
	));
	$modal->SetVariable(array(
		array("id",$count['id']),
		array("counting_item_id",$counting_item['id']),
		array("counting_id",$counting['id']),
		array("asset_id",$counting['asset_id'])
	));

	$blueprint = array(
		array(
			array(
				"name" => "name",
				"caption" => "Name",
				"placeholder" => "Count Name",
				"value" => $count['name']
			)
		),array(
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
