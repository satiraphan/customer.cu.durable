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

	if($_POST['name']==""){
		echo json_encode(array(
			'success'=>false,
			'msg'=>'Asset Name is null'
		));
	}else{

		$data = array(
			"code" => $_POST['code'],
			"#cat_id" => $_POST['cat_id'],
			"name" => addslashes($_POST['name']),
			"brand" => addslashes($_POST['brand']),
			"serial" => $_POST['serial'],
			"detail" => addslashes($_POST['detail']),
			"#location" => $_POST['location'],
			'#updated' => 'NOW()'
		);

		if($_POST['year_purchase']==""){$data['#year_purchase']="NULL";}else{$data['year_purchase']=$_POST['year_purchase'];}
		if($_POST['date_depreciate']==""){$data['#date_depreciate']="NULL";}else{$data['date_depreciate']=$_POST['date_depreciate'];}
		if($_POST['date_warranty']==""){$data['#date_warranty']="NULL";}else{$data['date_warranty']=$_POST['date_warranty'];}


		if($dbc->Update("asm_assets",$data,"id=".$_POST['id'])){
			echo json_encode(array(
				'success'=>true
			));
			$asset = $dbc->GetRecord("asm_assets","*","id=".$_POST['id']);
			$os->save_log(0,$_SESSION['auth']['user_id'],"asset-edit",$_POST['id'],array("asm_assets" => $asset));
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "No Change"
			));
		}
	}

	$dbc->Close();
?>
