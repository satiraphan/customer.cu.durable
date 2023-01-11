<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	$locations = array();

	$sql = "SELECT * FROM asm_locations WHERE type=2";
	$rst = $dbc->Query($sql);
	while($list = $dbc->Fetch($rst)){
		array_push($locations,array(
			$list['id'],
			$list['name']
		));
	}

	echo json_encode($locations);

	$dbc->Close();
?>
