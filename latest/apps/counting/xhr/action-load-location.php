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
	
	function load_location($dbc,$id){
		$location = $dbc->GetRecord("asm_locations","*","id=".$id);
		return $location;
	}
	
	if(is_array($_POST['id'])){
		$array = array();
		foreach($_POST['id'] as $id){
			array_push($array,load_location($dbc,$id));
		}
		echo json_encode($array);
	}else{
		echo json_encode(load_location($dbc,$_POST['id']));
	}

	
	$dbc->Close();
?>