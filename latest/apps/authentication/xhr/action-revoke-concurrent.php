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

	if($dbc->HasRecord("concurrents","name = '".$_POST['name']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Concurrent Name is already exist.'
		));
	}else{
		$data = array(
			'name' => $_POST['name'],
			'#updated' => 'NOW()',
		);

		if($dbc->Update("concurrents",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$concurrent = $dbc->GetRecord("concurrents","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"concurrent-revoke",$_POST['id'],array("concurrents" => $concurrent));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
