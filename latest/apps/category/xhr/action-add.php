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


	if($dbc->HasRecord("asm_categories","name = '".$_POST['name']."'")){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Category Name is already exist.'
		));
	}else{
		$data = array(
			'#id' => "DEFAULT",
			'name' => $_POST['name']
		);

		if($dbc->Insert("asm_categories",$data)){
			$category_id = $dbc->GetID();
			echo json_encode(array(
				'success'=>true,
				'msg'=> $category_id
			));

			$category = $dbc->GetRecord("asm_categories","*","id=".$category_id);
			$os->save_log(0,$_SESSION['auth']['user_id'],"category-add",$category_id,array("asm_categories" => $category));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "Insert Error"
			));
		}
	}

	$dbc->Close();
?>
