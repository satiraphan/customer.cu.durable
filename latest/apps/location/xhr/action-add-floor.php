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
			'msg'=>'Floor Name is already exist.'
		));
	}else{
		$data = array(
			"#id" => "DEFAULT",
			"code" => "",
			"name" => addslashes($_POST['name']),
			"#type" => 2,
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			"detail" => addslashes($_POST['detail']),
			"#parent" => $_POST['parent'],
			"#status" => 1
		);

		if($dbc->Insert("asm_locations",$data)){
			$floor_id = $dbc->GetID();
			$building = $dbc->GetRecord("asm_locations","*","id=".$_POST['parent']);

			$code = $building['code']."-".sprintf("%03d",$floor_id);
			$dbc->Update("asm_locations",array("code"=>$code),"id=".$floor_id);
			echo json_encode(array(
				'success'=>true,
				'msg'=> $floor_id
			));

			$floor = $dbc->GetRecord("asm_locations","*","id=".$floor_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"floor-add",$floor_id,array("floors" => $floor));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
