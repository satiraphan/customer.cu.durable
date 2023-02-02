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

		$data = array('#status' => 2);
		$dbc->Update("asm_assets",$data,"id=".$task['asset_id']);

		$data = array(
			"#id" => "DEFAULT",
			"#task_id" => $task['id'],
			"#asset_id" => $task['asset_id'],
			"#created" => "NOW()",
			"#updated" => "NOW()",
			"#status" => "1",
			"data" => addslashes($_POST['data']),
			"#returned" => "NULL",
			"#date_repair_actual" =>  "NULL"
		);

		if($_POST['date_repair_plan']==""){
			$data['#date_repair_plan'] = "NULL";
		}else{
			$data['date_repair_plan'] = $_POST['date_repair_plan'];
		}

		$dbc->Insert("asm_repairing",$data);
		$repair_id = $dbc->GetID();

		$os->save_log(0,$_SESSION['auth']['user_id'],"task-repair",$_POST['id'],array("repair" => $repair_id));
	}else{
		echo json_encode(array(
			'success'=>false,
			'msg' => "No Change"
		));
	}
	

	$dbc->Close();
?>
