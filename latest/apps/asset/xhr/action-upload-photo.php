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

	$err = array();
	$aPath = array();
	
	
	$iVariable = "iAssetNumber";
	$path_begin = 'binary/asset/';
	
	if(!isset($_FILES['file'])){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please select photo"
		));
	}else{
		for($i=0;$i<count($_FILES['file']['name']);$i++){
			$file = array(
				"name" => $_FILES['file']['name'][$i],
				"type" => $_FILES['file']['type'][$i],
				"tmp_name" => $_FILES['file']['tmp_name'][$i],
				"error" => $_FILES['file']['error'][$i],
				"size" => $_FILES['file']['size'][$i]
			);

			$iNumber = $os->load_variable($iVariable);
			$iNumber++;

			$filename = $file['name'];
			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			$path = $path_begin.$iNumber.".".$ext;
			try{
				$uploaded = $os->upload($file,"../../../".$path);
				if(!$uploaded['success']){
					array_push($err,$uploaded['msg']);
				}else{
					array_push($aPath,$path);
					$os->save_variable($iVariable,$iNumber);
				}
			} catch (Exception $e) {
				array_push($err,$e);
			}
		}

		if(count($err)>0){
			echo json_encode(array(
				'success'=>false,
				'msg' => "Error Found",
				'err' => $err
			));
		}else{
			echo json_encode(array(
				'success'=>true,
				'path' => $aPath
			));
		}

	}
	$dbc->Close();
?>