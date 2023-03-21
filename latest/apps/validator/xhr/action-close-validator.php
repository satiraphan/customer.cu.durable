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

	
		$data = array(
			'#status' => 4,
			'#updated' => 'NOW()'
		);

		if($dbc->Update("asm_counting",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$validator = $dbc->GetRecord("asm_counting","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"validator-close",$_POST['id'],array("asm_counting" => $validator));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	

	$dbc->Close();
?>
