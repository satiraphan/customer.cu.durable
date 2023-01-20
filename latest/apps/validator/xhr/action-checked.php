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
			"#checked" => 'NOW()',
			"#checker" => $os->auth['id']
		);

		if($dbc->Update("asm_counting_items",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$validator = $dbc->GetRecord("asm_counting_items","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"validator-checked",$_POST['id'],array("asm_counting_items" => $validator));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	
	$dbc->Close();
?>
