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

	if($_POST['action']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'No Option.'
		));
	}else{
		$data = array(
			"#id" => 'DEFAULT',
			"#asset_id" => $_POST['asset_id'],
			"#counting_id" => $_POST['counting_id'],
			"#status" => 1,
			"action" => $_POST['action'],
			"#validated" => 'NOW()',
			"#validator" =>$os->auth['id'],
			"#checked" =>'NULL',
			"#checker" => 'NULL',
			"#location_id" => $_POST['location_id'],
			"detail" => addslashes($_POST['detail'])
		);

		if($dbc->Insert("asm_counting_items",$data,"id=".$_POST['id'])){
			$counting_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true
			));
			$counter = $dbc->GetRecord("asm_counting_items","*","id=".$counting_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"counter-inspect",$counting_id,array("asm_counting_items" => $counter));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
