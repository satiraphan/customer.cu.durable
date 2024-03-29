<?php
	session_start();
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	include_once "../../../include/iface.php";

	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);

	$dbc = new dbc;
	$dbc->Connect();

	$os = new oceanos($dbc);

	class myModel extends imodal{
		function body(){
			$dbc = $this->dbc;
			$items = isset($this->param['item'])?$this->param['item']:array();
			$removable = true;

			if(count($items)==0){
				$removable = false;
			}

			if($removable){
				echo '<ul>';
				foreach($items as $item){
					$asset = $dbc->GetRecord("asm_assets","*","id=".$item);
					echo "<li>".$asset['id'].' : '.$asset['name']."</li>";
				}
				echo '</ul>';
			}else{
				echo 'Please selecte item to remove!';
			}
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_remove_asset","Remove Asset");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-danger","Remove","fn.app.asset.remove()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
