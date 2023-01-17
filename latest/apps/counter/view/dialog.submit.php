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
			$counter = $dbc->GetRecord("asm_counting","*","id=".$this->param['id']);
			$count_asset = $dbc->GetRecord("asm_assets LEFT JOIN asm_counting_locations ON asm_counting_locations.location_id = asm_assets.location ","COUNT(asm_assets.id)","asm_counting_locations.counting_id=".$this->param['id']);

			$aCount = array(0,0,0,0,0);
			$sql = "SELECT * FROM asm_counting_items WHERE counting_id =".$counter['id'];
			$rst = $dbc->Query($sql);
			while($line = $dbc->Fetch($rst)){
				switch($line['action']){
					case "1":$aCount[0]++;break;
					case "2":$aCount[1]++;break;
					case "3":$aCount[2]++;break;
					case "4":$aCount[3]++;break;
					case "5":$aCount[4]++;break;
				}
			}
			$aTotal = array();
			

			echo "<h3>ต้องการส่งข้อมูลตรวจนับ ".$counter['name']."</h3>";
			echo '<table class="table table-bordered table-sm">';
				echo '<thead>';
					echo '<tr>';
						echo '<th class="text-center">รายกาย</th>';
						echo '<th class="text-center">จำนวน</th>';
					echo '</tr>';
				echo '</thead>';
				echo '<tbody>';
					echo '<tr><td class="text-center">ตรวจสอบแล้วปกติ</td><td class="text-center">'.$aCount[0].'</td></tr>';
					echo '<tr><td class="text-center">พบของเสียหาย</td><td class="text-center">'.$aCount[1].'</td></tr>';
					echo '<tr><td class="text-center">ของผิดตำแหน่ง</td><td class="text-center">'.$aCount[2].'</td></tr>';
					echo '<tr><td class="text-center">แจ้งของหาย</td><td class="text-center">'.$aCount[3].'</td></tr>';
					echo '<tr><td class="text-center">อื่น ๆ</td><td class="text-center">'.$aCount[4].'</td></tr>';
				echo '</tbody>';
			echo '</table>';
			echo '<div class="alert alert-info">';
				echo 'มีรายการ '.array_sum($aCount).' จาก '.$count_asset[0].' รายการ';
			echo '</div>';
			echo '<div class="alert alert-warning">ต้องการส่งใช่มั้ย</div>';
			echo '<form name="form_submit_counter"><input type="hidden" name="id" value="'.$counter['id'].'"></form>';

		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_submit_counter","Submit Counter");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-warning","Submit","fn.app.counter.submit()")
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
