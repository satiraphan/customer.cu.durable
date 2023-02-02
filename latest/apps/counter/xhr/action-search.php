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

	if($_POST['code']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'No Option.'
		));
	}else{

		if($dbc->HasRecord("asm_assets","code = '".$_POST['code']."'")){
			$asset = $dbc->GetRecord("asm_assets","*","code='".$_POST['code']."'");
			echo json_encode(array(
				'success'=>true,
				"asset_id" => $asset['id'],
				"counting_id" => $_POST['counting_id'],
			));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Not Found"
			));
		
		}

	
	}

	$dbc->Close();
?>
