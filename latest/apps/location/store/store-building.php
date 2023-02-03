<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "asm_locations.id",
		"code" => "asm_locations.code",
		"name" => "asm_locations.name",
		"type" => "asm_locations.type",
		"created" => "asm_locations.created",
		"updated" => "asm_locations.updated",
		"detail" => "asm_locations.detail",
		"parent" => "asm_locations.parent",
		"status" => "asm_locations.status",
		"total" => "(SELECT COUNT(id) FROM asm_assets WHERE asm_assets.location = asm_locations.id)"
	);

	$table = array(
		"index" => "id",
		"name" => "asm_locations",
		"where" => "asm_locations.type = 1",
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
