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

	if($dbc->HasRecord("asm_categories","name = '".$_POST['name']."' AND id !=".$_POST['id'])){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Category Name is already exist.'
		));
	}else{
		$data = array(
			'name' => $_POST['name']
		);

		if($dbc->Update("asm_categories",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$category = $dbc->GetRecord("asm_categories","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"category-edit",$_POST['id'],array("asm_categories" => $category));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
