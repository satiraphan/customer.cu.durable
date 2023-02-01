<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "asm_counting_items.id",
		"asset_id" => "asm_counting_items.asset_id",
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

		"code" => "asm_assets.code",
		"cat_id" => "asm_assets.cat_id",
		"name" => "asm_assets.name",
		"brand" => "asm_assets.brand",
		"serial" => "asm_assets.serial",
		"asset_detail" => "asm_assets.detail",
		"year_purchase" => "asm_assets.year_purchase",
		"date_depreciate" => "asm_assets.date_depreciate",
		"date_warranty" => "asm_assets.date_warranty",
		"asset_status" => "asm_assets.status",
		"old_location" => "asm_assets.location",
		"created" => "asm_assets.created",
		"updated" => "asm_assets.updated",
		"action" => "asm_counting_items.action",
		"remark" => "asm_assets.remark",
		"imgs" => "asm_assets.imgs"
	);

	$where = "asm_counting_items.counting_id = ".$_GET['counting_id'];

	if($_GET['show_all']=="false"){
		$where .=" AND asm_counting_items.checked IS NULL";
	}

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
		"where" => $where
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
