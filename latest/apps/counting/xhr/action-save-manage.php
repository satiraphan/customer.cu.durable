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


	$dbc->Delete("asm_counting_locations","counting_id=".$_POST['id']);
	$dbc->Delete("asm_counting_user","counting_id=".$_POST['id']);

	foreach($_POST['location'] AS $location_id){
		$data = array(
			"#id" => "DEFAULT",
			"#counting_id" => $_POST['id'],
			"#location_id" => $location_id,
			"#user_id" => "NULL",
			"#list_id" => "NULL",
		);
		$dbc->Insert("asm_counting_locations",$data);
	}
	foreach($_POST['user'] AS $user_id){
		$data = array(
			"#id" => "DEFAULT",
			"#counting_id" => $_POST['id'],
			"#user_id" => $user_id
		);
		$dbc->Insert("asm_counting_user",$data);
	}
	$counting = $dbc->GetRecord("asm_counting","*","id=".$_POST['id']);
	$os->save_log(0,$_SESSION['auth']['user_id'],"counting-edit",$_POST['id'],array("asm_counting" => $counting));

	echo json_encode(array(
		'success'=>true
	));
	$dbc->Close();
?>
