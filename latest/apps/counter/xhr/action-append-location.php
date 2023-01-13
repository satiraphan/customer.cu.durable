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

	foreach($_POST['location'] AS $counting_location_id){

		$data = array(
			'user_id' => $_POST['user_id']
		);

		$dbc->Update("asm_counting_locations",$data,"id=".$counting_location_id);

		$counter = $dbc->GetRecord("asm_counting_locations","*","id=".$counting_location_id);
		$os->save_log(0,$_SESSION['auth']['user_id'],"counter-location-append",$counting_location_id,array("asm_counting_locations" => $counter));
	}

	echo json_encode(array(
		'success'=>true
	));
	
	$dbc->Close();
?>