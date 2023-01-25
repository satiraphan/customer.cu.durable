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

	
		$json = array();

		$data = array(
			"#id" => "DEFAULT",
			"#type" => $_POST['type'],
			"title" => $_POST['title'],
			"#asset_id" => $_POST['asset_id'],
			"#issued" => "NOW()",
			"#issuer" => $os->auth['id'],
			"#status" => 1,
			"#closed" => "NULL",
			"#counting_item_id" => $_POST['counting_item_id'],
			"data" => json_encode($json),
			"remark" => addslashes($_POST['remark'])
		);

		if($dbc->Insert("ams_tasks",$data,"id=".$_POST['id'])){
			$task_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true
			));
			$validator = $dbc->GetRecord("ams_tasks","*","id=".$task_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"validator-task",$_POST['id'],array("ams_tasks" => $validator));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	

	$dbc->Close();
?>
