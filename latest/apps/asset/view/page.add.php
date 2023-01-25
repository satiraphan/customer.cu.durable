<?php
	global $os,$dbc;

	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_add_asset");

	$blueprint = array(
		array(
			array(
				"name" => "code",
				"caption" => "รหัสสินค้า",
				"placeholder" => "Account Name"
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
				"caption" => "หมวดหมู่"
			)
		),
    array(
			array(
				"name" => "name",
				"caption" => "ชื่อครุภัณฑ์",
				"placeholder" => "ชื่อครุภัณฑ์"
			)
		),
    array(
			array(
				"name" => "brand",
				"caption" => "Brand",
				"placeholder" => "Brand"
			)
		),
    array(
			array(
				"name" => "serial",
				"caption" => "Serial Number",
				"placeholder" => "Serial Number"
			)
		),
    array(
			array(
				"type" => "textarea",
				"name" => "detail",
				"caption" => "รายละเอียด",
				"placeholder" => "รายละเอียด"
			)
		),
    array(
			array(
				"name" => "year_purchase",
				"caption" => "ปีทีซื้อ",
				"placeholder" => "รายละเอียด",
        "flex" => 3
      ),
			array(
				"type" => "date",
				"name" => "date_depreciate",
				"placeholder" => "วันหมดอายุ",
        "flex" => 3
      ),
			array(
				"type" => "date",
				"name" => "date_warranty",
				"placeholder" => "วันหมดประกัน",
        "flex" => 3
			)
		),array(
			array(
				"type" => "comboboxdb",
				"name" => "location",
				"source" => array(
					"table" => "asm_locations AS a LEFT JOIN asm_locations AS b ON a.parent = b.id LEFT JOIN asm_locations AS c ON b.parent = c.id",
					"name" => "
						IF(
							c.id IS NOT NULL,
							CONCAT(c.name,' ',b.name,' ',a.name),
							IF(
								b.id IS NOT NULL,
								CONCAT(b.name,' ',a.name),
								a.name
							)
						)",
					"value" => "a.id",
					"where" => "a.status = 1"
				),
				"default" => array(
          "value" => "NULL",
          "name" => "ไม่ระบุ"
        ),
				"caption" => "สถานที่จัดเก็บ"
			)
		)
	);

	$modal->SetBlueprint($blueprint);
?>
<div class="card container">
	<div class="card-header border-bottom">
		<h5 class="card-title p-2"><i class="far fa-pen mr-2"></i>Add Asset</h5>
	</div>
	<div class="card-body">
	<?php $modal->EchoInterface(); ?>
	</div>
	<div class="card-bottom border-top">
		<div class="m-2 float-right">
			<button class="btn btn-outline-dark" onclick="fn.app.asset.add()"><i class="fa-solid fa-save mr-1"></i> Save</button>
		</div>
		<div class="m-2">
			<button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa-solid fa-up-left mr-1"></i> Back</button>
		</div>
	</div>
</div>
