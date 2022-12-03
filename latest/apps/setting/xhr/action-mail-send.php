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
	
	if($dbc->HasRecord("groups","name = '".$_REQUEST['txtName']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Group Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_REQUEST['txtName'],
			'#created' => 'NOW()',
			'#updated' => 'NOW()',
			'#role' => 'NULL'
		);
		
		if($dbc->Insert("groups",$data)){
			$group_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $group_id
			));
			
			$group = $dbc->GetRecord("groups","*","id=".$group_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"group-add",$group_id,array("groups" => $group));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}
	
	$dbc->Close();
?>