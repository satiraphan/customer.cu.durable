<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_edit_asset");

	$asset = $dbc->GetRecord("asm_assets","*","id=".$_GET['id']);

	$modal->SetVariable(array(
		array("id",$asset['id']),
	));


	$blueprint = array(
		array(
			array(
				"name" => "code",
				"caption" => "รหัสสินค้า",
				"placeholder" => "Account Name",
				"value" => $asset['code']
      )
		),
		array(
			array(
				"type" => "comboboxdb",
				"name" => "cat_id",
				"source" => array(
					"table" => "asm_categories",
					"name" => "name",
					"value" => "id"
				),
				"caption" => "หมวดหมู่",
				"value" => $asset['cat_id']
			)
		),
    array(
			array(
				"name" => "name",
				"caption" => "ชื่อครุภัณฑ์",
				"placeholder" => "ชื่อครุภัณฑ์",
				"value" => $asset['name']
			)
		),
    array(
			array(
				"name" => "brand",
				"caption" => "Brand",
				"placeholder" => "Brand",
				"value" => $asset['brand']
			)
		),
    array(
			array(
				"name" => "serial",
				"caption" => "Serial Number",
				"placeholder" => "Serial Number",
				"value" => $asset['serial']
			)
		),
    array(
			array(
				"type" => "textarea",
				"name" => "detail",
				"caption" => "รายละเอียด",
				"placeholder" => "รายละเอียด",
				"value" => $asset['detail']
			)
		),
    array(
			array(
				"name" => "year_purchase",
				"caption" => "ปีทีซื้อ",
				"placeholder" => "รายละเอียด",
        "flex" => 3,
				"value" => $asset['year_purchase']
      ),
			array(
				"type" => "date",
				"name" => "date_depreciate",
				"placeholder" => "วันหมดอายุ",
        "flex" => 3,
				"value" => $asset['date_depreciate']
      ),
			array(
				"type" => "date",
				"name" => "date_warranty",
				"placeholder" => "วันหมดประกัน",
        "flex" => 3,
				"value" => $asset['date_warranty']
			)
		),array(
			array(
				"type" => "comboboxdb",
				"name" => "location",
				"source" => array(
					"table" => "asm_locations",
					"name" => "name",
					"value" => "id",
					"where" => "status = 1"
				),
				"default" => array(
          "value" => "NULL",
          "name" => "ไม่ระบุ"
        ),
				"caption" => "สถานที่จัดเก็บ",
				"value" => $asset['location']
			)
		)
	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Edit Asset</h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.asset.edit()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
