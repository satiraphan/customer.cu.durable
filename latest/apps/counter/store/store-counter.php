<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/datastore.php";

	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new datastore;
	$dbc->Connect();

	$columns = array(
		"id" => "asm_counting.id",
		"date_start" => "asm_counting.date_start",
		"date_finish" => "asm_counting.date_finish",
		"status" => "asm_counting.status",
		"created" => "asm_counting.created",
		"updated" => "asm_counting.updated",
		"approved" => "asm_counting.approved",
		"approver" => "asm_counting.approver",
		"closed" => "asm_counting.closed",
		"name" => "asm_counting.name",
		"remark" => "asm_counting.remark",
	);

	$table = array(
		"index" => "id",
		"name" => "asm_counting",
		"join" => array(
			array(
				"field" => "id",
				"table" => "asm_counting_user",
				"with" => "counting_id",
			)
		),
		"where" => "status = 2 AND asm_counting_user.user_id=".$_GET['user_id']
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
