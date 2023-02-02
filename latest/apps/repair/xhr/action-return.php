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

	$repair = $dbc->GetRecord("asm_repairing","*","id=".$_POST['id']);


		$data = array(
			'#status' => 9,
			'#updated' => 'NOW()',
		);

		if($dbc->Update("asm_repairing",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$dbc->Update("asm_assets",array("#status"=>1),"id=".$repair['asset_id']);

			$repair = $dbc->GetRecord("asm_repairing","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"repair-return",$_POST['id'],array("asm_repairing" => $repair));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	

	$dbc->Close();
?>
