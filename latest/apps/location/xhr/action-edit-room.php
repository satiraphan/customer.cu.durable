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

	if($dbc->HasRecord("asm_locations","name = '".$_POST['name']."' AND id !=".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Room Name is already exist.'
		));
	}else{
		$data = array(
			"name" => addslashes($_POST['name']),
			'#updated' => 'NOW()',
			"detail" => addslashes($_POST['detail']),
			"#parent" => $_POST['parent']
		);

		if($dbc->Update("asm_locations",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$room = $dbc->GetRecord("asm_locations","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"room-edit",$_POST['id'],array("rooms" => $room));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
