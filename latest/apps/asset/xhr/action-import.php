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
					if($row>2 && $line[0]!=""){
						if(!$dbc->HasRecord("asm_categories","name='".$line[1]."'")){
							$iFail++;
							array_push($err,array(
								"msg" => "No Category : ".$line[1],
								"data" => $line
							));
						}else{
							$category = $dbc->GetRecord("asm_categories","*","name='".$line[1]."'");
							$location_id = null;

							//Building
							if($line[9] != ""){
								if($dbc->HasRecord("asm_locations","name='".$line[9]."' AND type = 1")){
									$location = $dbc->GetRecord("asm_locations","*","name='".$line[9]."' AND type = 1");
									$location_id = $location['id'];
									$building_id = $location['id'];
									$code = $location['code'];
								}else{
									$data = array(
										"#id" => "DEFAULT",
										"code" => "",
										"name" => addslashes($line[9]),
										"#type" => 1,
										'#created' => 'NOW()',
										'#updated' => 'NOW()',
										"detail" => "",
										"#parent" => "NULL",
										"#status" => 1,
									);

									$dbc->Insert("asm_locations",$data);
									$building_id = $dbc->GetID();
									$code = "L-".sprintf("%03d",$building_id);
									$dbc->Update("asm_locations",array("code"=>$code),"id=".$building_id);
									$location_id = $building_id;

									// Floor
									if($line[10] != ""){
										if($dbc->HasRecord("asm_locations","name='".$line[10]."' AND type = 2 AND parent=".$building_id)){
											$location = $dbc->GetRecord("asm_locations","*","name='".$line[10]."' AND type = 2 AND parent=".$building_id);
											$location_id = $location['id'];
											$floor_id = $location['id'];
											$code = $location['code'];
										}else{
											$data = array(
												"#id" => "DEFAULT",
												"code" => "",
												"name" => addslashes($line[10]),
												"#type" => 1,
												'#created' => 'NOW()',
												'#updated' => 'NOW()',
												"detail" => "",
												"#parent" => $building_id,
												"#status" => 1,
											);

											$dbc->Insert("asm_locations",$data);
											$floor_id = $dbc->GetID();
											$code = $code."-".sprintf("%03d",$floor_id);
											$dbc->Update("asm_locations",array("code"=>$code),"id=".$floor_id);
											$location_id = $floor_id;
										}

										// Room
										if($line[10] != ""){
											if($dbc->HasRecord("asm_locations","name='".$line[11]."' AND type = 3 AND parent=".$floor_id)){
												$location = $dbc->GetRecord("asm_locations","*","name='".$line[11]."' AND type = 3 AND parent=".$floor_id);
												$location_id = $location['id'];
												$code = $location['code'];
											}else{
												$data = array(
													"#id" => "DEFAULT",
													"code" => "",
													"name" => addslashes($line[11]),
													"#type" => 1,
													'#created' => 'NOW()',
													'#updated' => 'NOW()',
													"detail" => "",
													"#parent" => $floor_id,
													"#status" => 1,
												);

												$dbc->Insert("asm_locations",$data);
												$room_id = $dbc->GetID();
												$code = $code."-".sprintf("%03d",$room_id);
												$dbc->Update("asm_locations",array("code"=>$code),"id=".$room_id);
												$location_id = $room_id;
											}
										}
									}
								}
							}

							$data = array(
								'#id' => "DEFAULT",
								"code" => $line[0],
								"#cat_id" => $category['id'],
								"name" => addslashes($line[2]),
								"brand" => addslashes($line[3]),
								"serial" => addslashes($line[4]),
								"detail" => addslashes($line[5]),
								"#status" => 1,
								"#location" => $location_id?$location_id:"NULL",
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
						}
						

						
						
					}
					
				}
				fclose($handle);
				echo json_encode(array(
					'success'=>true,
					'error' => $err,
					'msg'=> "นำเข้าสำเร็จ ".$iSuccess." รายการ"
				));
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