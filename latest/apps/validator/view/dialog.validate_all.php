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
			$total_item = isset($this->param['items']) ? count($this->param['items']) : 0;
			if($total_item > 0){
				echo 'ได้เลือกทั้งหมด '.$total_item.' รายการ<br> ';
					echo '<form name="form_validate_all">';
					echo '<table class="table table-bordered table-sm">';
						echo '<thead>';
						echo '<tr>';
							echo '<th class="text-center">#</th>';
							echo '<th class="text-center">รหัสสินค้า</th>';
							echo '<th class="text-center">รายการทรัพย์สิน</th>';
							echo '<th class="text-center">สถานะ</th>';
							echo '<th class="text-center">คำแนะนำ</th>';
							echo '<th class="text-center">การดำเนินการ</th>';
							echo '<th class="text-center">ชื่อทรัพย์สิน</th>';
							echo '<th class="text-center">รายละเอียด</th>';
						echo '</tr>';
						echo '</thead>';
					echo '<tbody>';
					$index = 1;
					$dbc = $this->dbc;
					foreach($this->param['items'] as $item){
						$item = $dbc->GetRecord("asm_counting_items","*","id=".$item);
						$asset = $dbc->GetRecord("asm_assets","*","id=".$item['asset_id']);
						echo '<tr>';
							echo '<td class="text-center">';
								echo $index;
								echo '<input type="hidden" name="items[]" value="'.$item['id'].'"></td>';
								echo '<input type="hidden" name="asset_id[]" value="'.$item['asset_id'].'"></td>';
							echo '</td>';
							echo '<td class="text-center">'.$asset['code'].'</td>';
							echo '<td class="text-center">'.$asset['name'].'</td>';
							switch($item['status']){
								case "0":echo '<td class="text-center"><span class="badge badge-danger">ไม่พบ</span></td>';break;
								case "1":echo '<td class="text-center"><span class="badge badge-dark">ปกติ</span></td>';break;
								case "2":echo '<td class="text-center"><span class="badge badge-warning">กำลังซ่อม</span></td>';break;
							}
							switch($item['action']){
								case "1":echo '<td class="text-center"><span class="badge badge-success">ข้อมูลถูกต้อง</span></td>';break;
								case "2":echo '<td class="text-center"><span class="badge badge-warning">พบความเสียหาย</span></td>';break;
								case "3":echo '<td class="text-center"><span class="badge badge-primary">ผิดตำแหน่ง</span></td>';break;
								case "4":echo '<td class="text-center"><span class="badge badge-danger">ไม่พบของ</span></td>';break;
								case "5":echo '<td class="text-center"><span class="badge badge-dark">อื่น ๆ</span></td>';break;
							}
						
							echo '<td class="text-center">';
								echo '<select name="type[]" class="form-control form-control-sm">';
									echo '<option value="1">เปลี่ยนตำแหน่ง</option>';
									echo '<option value="2">แจ้งหาย</option>';
									echo '<option value="3">ส่งซ่อม</option>';
								echo '</select>';
							echo '</td>';
							echo '<td class="text-center"><input type="text" name="title[]" class="form-control form-control-sm"></td>';
							echo '<td class="text-center"><input type="text" name="remark[]" class="form-control form-control-sm"></td>';
						echo '</tr>';
						$index++;
					}	
					echo '</tbody>';
					echo '</table>';
					echo '</form>';
			}else{
				echo 'ไม่ได้เลือกข้อมูลใดๆเลย ';
			}
		}
	}

	$modal = new myModel($dbc,$os->auth);
	$modal->setParam($_POST);
	$modal->setModel("dialog_validate_all","Validate All");
	$modal->setExtraClass("modal-full");
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		isset($_POST['items']) ? count($_POST['items']) > 0 ? array("action","btn-danger","ยินยันการทำรายการ","fn.app.validator.validate_all()") : array() : array()
	));
	$modal->EchoInterface();

	$dbc->Close();
?>
