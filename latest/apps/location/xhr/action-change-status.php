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

	$location = $dbc->GetRecord("asm_locations","*","id=".$_POST['id']);

	if($location['status']==0){
		$new_status = 1;
	}else{
		$new_status = 0;
	}
	
	$data = array(
		'#status' => $new_status,
		'#updated' => 'NOW()'
	);

	$dbc->Update("asm_locations",$data,"id=".$_POST['id']);
	echo json_encode(array(
		'success'=>true
	));

	$dbc->Close();
?>
