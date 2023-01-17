<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();


	$table = array(
		"id" => "asm_counting_items.id",
		"asset_id" => "asm_counting_items.asset_id",
		"name" => "asm_assets.name",
		"counting_id" => "asm_counting_items.counting_id",
		"status" => "asm_counting_items.status",
		"action" => "asm_counting_items.action",
		"validated" => "asm_counting_items.validated",
		"validator" => "asm_counting_items.validator",
		"checked" => "asm_counting_items.checked",
		"checker" => "asm_counting_items.checker",
		"data" => "asm_counting_items.data",
		"location_id" => "asm_counting_items.location_id",
		"detail" => "asm_counting_items.detail",
	);

	$table = array(
		"index" => "id",
		"name" => "asm_counting_items",
		"join" => array(
			array(
				"field" => "asset_id",
				"table" => "asm_assets",
				"with" => "id"
			)
		),
		"where" => "asm_counting_items.status = 1
	);


	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
