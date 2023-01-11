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


	if($dbc->HasRecord("asm_locations","name = '".$_POST['name']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Room Name is already exist.'
		));
	}else{
		$data = array(
			"#id" => "DEFAULT",
			"code" => "",
			"name" => addslashes($_POST['name']),
			"#type" => 3,
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			"detail" => addslashes($_POST['detail']),
			"#parent" => $_POST['parent'],
			"#status" => 1
		);

		if($dbc->Insert("asm_locations",$data)){
			$room_id = $dbc->GetID();
			$floor = $dbc->GetRecord("asm_locations","*","id=".$_POST['parent']);

			$code = $floor['code']."-".sprintf("%03d",$room_id);
			$dbc->Update("asm_locations",array("code"=>$code),"id=".$room_id);
			echo json_encode(array(
				'success'=>true,
				'msg'=> $room_id
			));

			$room = $dbc->GetRecord("asm_locations","*","id=".$room_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"room-add",$room_id,array("rooms" => $room));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
