<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "asm_assets.id",
		"code" => "asm_assets.code",
		"name" => "asm_assets.name",
		"serial" => "asm_assets.serial",
		"detail" => "asm_assets.detail",
		"year_purchase" => "asm_assets.year_purchase",
		"date_depreciate" => "asm_assets.date_depreciate",
		"date_warranty" => "asm_assets.date_warranty",
		"status" => "asm_assets.status",
		"location" => "asm_locations.name",
		"created" => "asm_assets.created",
		"updated" => "asm_assets.updated",
	);

	$table = array(
		"index" => "id",
		"name" => "asm_assets",
		"join" => array(
			array(
				"field" => "location",
				"table" => "asm_locations",
				"with" => "id",
			)
		)
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
