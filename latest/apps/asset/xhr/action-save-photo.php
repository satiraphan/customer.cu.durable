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

	$imgs = array();



			for($i=0;$i<count($_POST['img']);$i++){
				array_push($imgs,array(
					"path" => $_POST['img'][$i],
					"caption" => $_POST['caption'][$i]
				));
			}

		$data = array(
			"imgs" => json_encode($imgs,JSON_UNESCAPED_UNICODE),
			'#updated' => 'NOW()'
		);

		if($dbc->Update("asm_assets",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$asset = $dbc->GetRecord("asm_assets","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"asset-imgs",$_POST['id'],array("asm_assets" => $asset));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	

	$dbc->Close();
?>
