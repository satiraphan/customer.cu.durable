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

	$iSuccess = 0;
	$iFail = 0;
	
	if(!isset($_FILES['file'])){
		echo json_encode(array(
			'success'=>false,
			'msg' => "Please select photo"
		));
	}else{
		$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		if(strtolower($ext)=="csv"){
			$row = 1;
			if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
				while (($line = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$row++;
					if($row>2){
						$category = $dbc->GetRecord("asm_categories","*","name='".$line[1]."'");
						$location = $dbc->GetRecord("asm_locations","*","name='".$line[9]."'");

						$data = array(
							'#id' => "DEFAULT",
							"code" => $line[0],
							"#cat_id" => $category['id'],
							"name" => addslashes($line[2]),
							"brand" => addslashes($line[3]),
							"serial" => addslashes($line[4]),
							"detail" => addslashes($line[5]),
							"#status" => 1,
							"#location" => $location['id'],
							'#created' => 'NOW()',
							'#updated' => 'NOW()',
							"remark" => "",
							"imgs" => "[]"
						);
				
						if($line[6]==""){$data['#year_purchase']="NULL";}else{$data['year_purchase']=($line[6]>2500)?$line[6]-543:$line[6];}
						if($line[7]==""){$data['#date_depreciate']="NULL";}else{$data['date_depreciate']=$line[7];}
						if($line[8]==""){$data['#date_warranty']="NULL";}else{$data['date_warranty']=$line[8];}

						if($dbc->Insert("asm_assets",$data)){
							$iSuccess++;
						}else{
							$iFail++;
						}

						echo json_encode(array(
							'success'=>true,
							'msg'=> "นำเข้าสำเร็จ ".$iSuccess." รายการ"
						));
						
					}
				}
				fclose($handle);
			}
		}else{
			echo json_encode(array(
				'success'=>false,
				'msg' => "ไม่ใช่ CSV",
			));
		}

	}
	$dbc->Close();
?>