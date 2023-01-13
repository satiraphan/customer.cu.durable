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

	if($dbc->HasRecord("asm_counting","name = '".$_POST['name']."' AND id !=".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Counting Name is already exist.'
		));
	}else{
		$data = array(
			"date_start" => $_POST['date_start'],
			"date_finish" => $_POST['date_finish'],
			'#updated' => 'NOW()',
			"name" => addslashes($_POST['name']),
			"remark" => addslashes($_POST['remark']),
		);

		if($dbc->Update("asm_counting",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$counting = $dbc->GetRecord("asm_counting","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"counting-edit",$_POST['id'],array("asm_counting" => $counting));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
