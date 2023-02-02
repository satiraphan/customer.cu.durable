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
			'remark' => addslashes($_POST['remark']),
			'#closed' => 'NOW()',
			'#status' => 3,
		);

		if($dbc->Update("ams_tasks",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$issue = $dbc->GetRecord("ams_tasks","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"issue-close",$_POST['id'],array("ams_tasks" => $issue));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	

	$dbc->Close();
?>
