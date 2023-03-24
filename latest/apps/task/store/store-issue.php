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
		"asset_name" => "asm_assets.name",
		"asset_status" => "asm_assets.status",
		"issued" => "ams_tasks.issued",
		"issuer" => "ams_tasks.issuer",
		"status" => "ams_tasks.status",
		"closed" => "ams_tasks.closed",
		"counting_item_id" => "ams_tasks.counting_item_id",
		"data" => "ams_tasks.data",
		"remark" => "ams_tasks.remark",
		"current_location_id" => "asm_assets.location",
		"new_location_id" => "asm_counting_items.location_id",
		"repair_id" => "asm_repairing.id"
	);

	$table = array(
		"index" => "id",
		"name" => "ams_tasks",
		"join" => array(
			array(
				"field" => "asset_id",
				"table" => "asm_assets",
				"with" => "id"
			),
			array(
				"field" => "counting_item_id",
				"table" => "asm_counting_items",
				"with" => "id"
			),
			array(
				"field" => "id",
				"table" => "asm_repairing",
				"with" => "task_id"
			),
		),
		"where" => "ams_tasks.status != 3"
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();

	$data = $dbc->GetResult();

	for($i=0;$i<count($data['aaData']);$i++){
		if($data['aaData'][$i]['type']==1){
			$current = $dbc->GetRecord("asm_locations","*","id=".$data['aaData'][$i]['current_location_id']);
			$new = $dbc->GetRecord("asm_locations","*","id=".$data['aaData'][$i]['new_location_id']);
			$data['aaData'][$i]['current_location'] =$current['name'];
			$data['aaData'][$i]['new_location'] =$new['name'];

		}
	}


	echo json_encode($data);

	$dbc->Close();

?>
