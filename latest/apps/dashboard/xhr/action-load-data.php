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
	$dataset = array();

	$aColor = array("#467bcb","#6610f2","#6f42c1","#e83e8c","#d35f41","#fd7e14","#f1ae1b","#2c9b5e","#20c997","#00878d","#fff","#718096","#2d3748");


	$options = array(
		"maintainAspectRatio" => false,
		"tooltips" => array(
			"mode" => 'index',
			"intersect" => false
		),
		"elements" => array(
			"line" => array(
				"borderWidth" => 1
			),
			"rectangle" => array(
				"borderWidth" => 1
			)
		),
		"legend" => array(
			"display" => true
		),
    	"onClick" => null
	);

	$counter = $dbc->GetRecord("asm_counting","*","1 ORDER BY id DESC");
	$count_asset = $dbc->GetRecord("asm_assets LEFT JOIN asm_counting_locations ON asm_counting_locations.location_id = asm_assets.location ","COUNT(asm_assets.id)","asm_counting_locations.counting_id=".$counter['id']);

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


	$aLastCouting = array(
		"type" => "horizontalBar",
		"data" => array(
			"labels" => array("ข้อมูลถูกต้อง","พบความเสียหาย","ผิดตำแหน่ง","ไม่พบของ","อื่น ๆ"),
			"datasets" => array(
				array(
					"label" => "รายละเอียด",
					"backgroundColor" => array("#2c9b5e","#f1ae1b","#467bcb","#d35f41","#00878d","#2d3748"),
					"borderColor" => "black",
					"data" => array($aCount[0],$aCount[1],$aCount[2],$aCount[3],$aCount[4])
				)
			)
		),
		"options" => array(
			"maintainAspectRatio" => false,
			"tooltips" => array(
				"mode" => 'index',
				"intersect" => false
			),
			"elements" => array(
				"line" => array(
					"borderWidth" => 1
				),
				"rectangle" => array(
					"borderWidth" => 1
				)
			)
		)
	);

	$dataset['last_counting'] = $aLastCouting;


	$a_cat_label = array();
	$a_cat_data = array();
	$a_cat_data_id = array();
	$sql = "SELECT asm_categories.name,COUNT(asm_assets.id),asm_categories.id FROM asm_assets LEFT JOIN asm_categories ON asm_assets.cat_id = asm_categories.id GROUP BY(asm_categories.id) ORDER BY COUNT(asm_assets.id) DESC LIMIT 0,10";
	$rst = $dbc->Query($sql);
	while($line = $dbc->Fetch($rst)){
		array_push($a_cat_label,$line[0]);
		array_push($a_cat_data,$line[1]);
		array_push($a_cat_data_id,$line[2]);
	}


	$aPieCategory = array(
		"type" => 'pie',
    	"data" => array(
      	"labels"=> $a_cat_label,
      	"datasets" => array(
				array(
					"data" => $a_cat_data,
					"raw" => $a_cat_data_id,
					"backgroundColor" => $aColor,
				)

			)
		),
    	"options" => $options
	);
  
	$dataset['pie_category'] = $aPieCategory;


	echo json_encode($dataset,JSON_UNESCAPED_UNICODE);
	$dbc->Close();
?>