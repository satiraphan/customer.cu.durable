<?php
	session_start();
	@ini_set('memory_limit', '512M');
	include_once "../../../config/define.php";
	include_once "../../../include/db.php";
	include_once "../../../include/oceanos.php";
	require '../../../vendor/autoload.php';

	use PhpOffice\PhpSpreadsheet\Spreadsheet;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



	
	@ini_set('display_errors',DEBUG_MODE?1:0);
	date_default_timezone_set(DEFAULT_TIMEZONE);
	
	$dbc = new dbc;
	$dbc->Connect();
	$os = new oceanos($dbc);

	$cat_id = $_POST['cat_id'];
	$file_path = "../../../binary/asset_export.xlsx";

	// 1. Create a new Spreadsheet object
	$spreadsheet = new Spreadsheet();
	$sheet = $spreadsheet->getActiveSheet();

	$aHeader = array(
		"A" => "id",
		"B" => "code",
		"C" => "name",
		"D" => "brand",
		"E" => "serial",
		"F" => "detail",
		"G" => "category_id",
		"H" => "category_name",
		"I" => "year_purchase",
		"J" => "date_depreciate",
		"K" => "date_warranty",
		"L" => "status",
		"M" => "location_id",
		"N" => "location_code",
		"O" => "location_name",
		"P" => "created",
		"Q" => "updated",
		"R" => "remark",
		"S" => "imgs",
		"T" => "unit_name"
	);

	foreach($aHeader as $col => $val){
		$sheet->setCellValue($col.'1', $val);
	}

	$sql = "SELECT 
			asm_assets.*,
			asm_categories.id AS category_id,
			asm_categories.name as category_name,
			asm_locations.id as location_id,
			asm_locations.code as location_code,
			asm_locations.name as location_name
		FROM asm_assets
		LEFT JOIN asm_categories ON asm_assets.cat_id = asm_categories.id 
		LEFT JOIN asm_locations ON asm_assets.location = asm_locations.id
	";

	if($cat_id != "%")$sql .= " WHERE asm_assets.cat_id = '$cat_id'";
	$rst = $dbc->Query($sql);
	$row_nubmer = 2;
	while($line = $dbc->Fetch($rst)){
		foreach($aHeader as $col => $val){
			$sheet->setCellValueExplicit($col.$row_nubmer, $line[$val], \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
		}
		$row_nubmer++;
	}

	// 3. Save the file
	$writer = new Xlsx($spreadsheet);
	$writer->save($file_path);

	echo json_encode(array(
		'success'=>true,
		'file'=> $file_path,
		'src'=>"binary/asset_export.xlsx"
	));

	$dbc->Close();
?>