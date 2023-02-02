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
		array("action","btn-outline-dark","ส่งซ่อม","fn.app.task.issue.repair()")
	));
	$modal->SetVariable(array(
		array("id",$task['id']),
		array("task_id",$task['id']),
		array("counting_item_id",$counting_item['id']),
		array("counting_id",$counting['id']),
		array("asset_id",$counting_item['asset_id'])
	));

	$blueprint = array(
		array(
			array(
				"type" => "textarea",
				"name" => "data",
				"caption" => "รายละเอียด",
				"placeholder" => "รายละเอียดเพิ่มเติม"
			)
		),array(
			array(
				"type" => "date",
				"name" => "date_repair_plan",
				"caption" => "วันที่ซ่อมเสร็จ",
				"placeholder" => "วันที่ซ่อมเสร็จ"
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();
?>
