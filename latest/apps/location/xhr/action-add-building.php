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
			'msg'=>'Building Name is already exist.'
		));
	}else{
		$data = array(
			"#id" => "DEFAULT",
			"code" => "",
			"name" => addslashes($_POST['name']),
			"#type" => 1,
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			"detail" => addslashes($_POST['detail']),
			"#parent" => "NULL",
			"#status" => 1,
		);

		if($dbc->Insert("asm_locations",$data)){
			$building_id = $dbc->GetID();

			$code = "L-".sprintf("%03d",$building_id);
			$dbc->Update("asm_locations",array("code"=>$code),"id=".$building_id);

			echo json_encode(array(
				'success'=>true,
				'msg'=> $building_id
			));

			$building = $dbc->GetRecord("asm_locations","*","id=".$building_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"building-add",$building_id,array("buildings" => $building));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
