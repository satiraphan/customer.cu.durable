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


	if($_POST['date_start']=="" || $_POST['date_finish']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'โปรดระบุข้อมูล'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			"date_start" => $_POST['date_start'],
			"date_finish" => $_POST['date_finish'],
			"#status" => 1,
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			"#approved" => 'NULL',
			"#approver" => 'NULL',
			"#closed" => 'NULL',
			"name" => addslashes($_POST['name']),
			"remark" => addslashes($_POST['remark']),
		);

		if($dbc->Insert("asm_counting",$data)){
			$counting_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $counting_id
			));

			$counting = $dbc->GetRecord("asm_counting","*","id=".$counting_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"counting-add",$counting_id,array("asm_counting" => $counting));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
