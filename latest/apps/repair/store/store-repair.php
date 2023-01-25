<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "asm_repairing.id",
		"task_id" => "asm_repairing.task_id",
		"asset_id" => "asm_repairing.asset_id",
		"created" => "asm_repairing.created",
		"updated" => "asm_repairing.updated",
		"status" => "asm_repairing.status",
		"data" => "asm_repairing.data",
		"returned" => "asm_repairing.returned",
		"date_repair_plan" => "asm_repairing.date_repair_plan",
		"date_repair_actual" => "asm_repairing.date_repair_actual"
	);

	$table = array(
		"index" => "id",
		"name" => "asm_repairing",
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
