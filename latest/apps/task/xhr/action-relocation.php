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

	$data = array('#status' => 2);
	if($dbc->Update("ams_tasks",$data,"id=".$_POST['id'])){
		echo json_encode(array(
			'success'=>true
		));
		$task = $dbc->GetRecord("ams_tasks","*","id=".$_POST['id']);

		$data = array('#location' => $_POST['location']);
		$asset = $dbc->Update("asm_assets",$data,"id=".$task['asset_id']);

		$os->save_log(0,$_SESSION['auth']['user_id'],"task-relocation",$_POST['id'],array("asset" =>$asset));
	}else{
		echo json_encode(array(
			'success'=>false,
			'msg' => "No Change"
		));
	}
	

	$dbc->Close();
?>
