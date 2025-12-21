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

	for($i=0;$i<count($_POST['items']);$i++){
		$data = array(
			"#checked" => 'NOW()',
			"#checker" => $os->auth['id']
		);

		if($dbc->Update("asm_counting_items",$data,"id=".$_POST['items'][$i])){
			$validator = $dbc->GetRecord("asm_counting_items","*","id=".$_POST['items'][$i]);
			$os->save_log(0,$_SESSION['auth']['user_id'],"validator-checked",$_POST['items'][$i],array("asm_counting_items" => $validator));
		}

	}	

	echo json_encode(array(
		'success'=>true
	));

	$dbc->Close();
?>
