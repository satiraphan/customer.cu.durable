<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "ams_tasks.id",
		"type" => "ams_tasks.type",
		"title" => "ams_tasks.title",
		"asset_id" => "ams_tasks.asset_id",
		"issued" => "ams_tasks.issued",
		"issuer" => "ams_tasks.issuer",
		"status" => "ams_tasks.status",
		"closed" => "ams_tasks.closed",
		"counting_item_id" => "ams_tasks.counting_item_id",
		"data" => "ams_tasks.data",
		"remark" => "ams_tasks.remark",
	);

	$table = array(
		"index" => "id",
		"name" => "ams_tasks",
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
