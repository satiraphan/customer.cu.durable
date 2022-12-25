<?php
	$modal = new iform($dbc,$os->auth);
	$modal->setForm("form_addaccount");
	
	/*
	$modal->setButton(array(
		array("close","btn-secondary","Dismiss"),
		array("action","btn-primary","Save Change","fn.app.accctrl.account.add()")
	));
	*/
	
	$modal->SetVariable(array(
		array("org_id","")
	));
?>
	<div>
	</div>
<?php

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
				"name" => "name",
				"caption" => "ชื่อครุภัณฑ์",
				"placeholder" => "ชื่อครุภัณฑ์"
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
				"name" => "date_depreciate",
				"placeholder" => "วันหมดอายุ",
        "flex" => 3
      ),
			array(
				"name" => "date_warranty",
				"placeholder" => "วันหมดประกัน",
        "flex" => 3
			)
		),array(
			array(
        "type" => "combobox",
        "name" => "parent",
        "caption" => "ห้องเก็บ",
        "source" => array(
          "ห้อง A","ห้อง B"
        ),
        "default" => array(
          "value" => "NULL",
          "name" => "ไม่ระบุ"
        )
      )
		)
	);
	
	
	
	$modal->SetBlueprint($blueprint);
	$modal->EchoInterface();

	
?>
<button class="btn btn-outline-dark">เพิ่มครุภัณฑ์</button>