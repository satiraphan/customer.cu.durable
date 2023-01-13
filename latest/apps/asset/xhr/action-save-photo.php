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

	$imgs = array();

	if($_POST['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Asset Name is null'
		));
	}else{

		$data = array(
			"imgs" => json_encode($imgs),
			'#updated' => 'NOW()'
		);

		if($dbc->Update("asm_assets",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$asset = $dbc->GetRecord("asm_assets","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"asset-imgs",$_POST['id'],array("asm_assets" => $asset));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
