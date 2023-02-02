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
			'data' => addslashes($_POST['data']),
			'#updated' => 'NOW()',
		);

		if($_POST['date_repair_plan']==""){
			$data['#date_repair_plan'] = "NULL";
		}else{
			$data['date_repair_plan'] = $_POST['date_repair_plan'];
		}

		if($_POST['date_repair_actual']==""){
			$data['#date_repair_actual'] = "NULL";
		}else{
			$data['date_repair_actual'] = $_POST['date_repair_actual'];
		}

		if($dbc->Update("asm_repairing",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$repair = $dbc->GetRecord("asm_repairing","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"repair-edit",$_POST['id'],array("asm_repairing" => $repair));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	

	$dbc->Close();
?>
