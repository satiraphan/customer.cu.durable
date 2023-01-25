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
	$modal->setModel("dialog_task_validator","เพื่มรายการทำงาน");
	$modal->initiForm("form_task_validator");
	$modal->setExtraClass("modal-lg");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.validator.task()")
	));

	$counting_item = $dbc->GetRecord("asm_counting_items","*","id=".$_POST['id']);

	$modal->SetVariable(array(
		array("counting_item_id",$counting_item['id']),
		array("asset_id",$counting_item['asset_id'])
	));

	$blueprint = array(
		array(
			array(
				"type" => "combobox",
				"name" => "type",
				"source" => array(
					array(1,"เปลี่ยนตำแหน่ง"),
					array(2,"แจ้งหาย"),
					array(3,"ส่งซ่อม")
				),	
				"caption" => "ประเภท"
			)
		),array(
			array(
				"name" => "title",
				"caption" => "ชื่อทรัพย์สิน",
				"placeholder" => "ชื่อทรัพย์สิน"
			)
		),array(
			array(
				"type" => "textarea",
				"name" => "remark",
				"caption" => "รายละเอียด",
				"placeholder" => "รายละเอียด"
			)
		)
	);

	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();
	$dbc->Close();

?>
