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

	if($dbc->HasRecord("issues","name = '".$_POST['name']."' AND id !=".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Issue Name is already exist.'
		));
	}else{
		$data = array(
			'name' => $_POST['name'],
			'#updated' => 'NOW()',
		);

		if($dbc->Update("issues",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$issue = $dbc->GetRecord("issues","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"issue-edit",$_POST['id'],array("issues" => $issue));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
