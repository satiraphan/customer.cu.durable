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
		"submitted" => "asm_counting.submitted",
		"submit_user_id" => "asm_counting.submit_user_id",
		"approved" => "asm_counting.approved",
		"approver" => "asm_counting.approver",
		"closed" => "asm_counting.closed",
		"name" => "asm_counting.name",
		"remark" => "asm_counting.remark",
		"username" => "os_users.name",
	);

	$table = array(
		"index" => "id",
		"name" => "asm_counting",
		"join" => array(
			array(
				"field" => "submit_user_id",
				"table" => "os_users",
				"with" => "id" 

			)
		),
		"where" => "asm_counting.status = 3"
	);

	$dbc->SetParam($table,$columns,$_GET['order'],$_GET['columns'],$_GET['search']);
	$dbc->SetLimit($_GET['length'],$_GET['start']);
	$dbc->Processing();
	echo json_encode($dbc->GetResult());

	$dbc->Close();

?>
