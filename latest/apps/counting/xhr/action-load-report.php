<?php
    session_start();
    include_once "../../../config/define.php";
    include_once "../../../include/db.php";
    include_once "../../../include/oceanos.php";

    @ini_set('display_errors', DEBUG_MODE ? 1 : 0);
    date_default_timezone_set(DEFAULT_TIMEZONE);

    $dbc = new dbc;
    $dbc->Connect();
    $os = new oceanos($dbc);
    $items = $_POST['item'];
    $counting_id = implode(",", $items);

    $data = array();
    $sql = "SELECT
                        asm_counting_items.id AS id,
                        asm_counting_items.validated AS validated,
                        asm_counting_items.validator AS validator,
                        asm_counting_items.detail AS detail,
                        asm_counting_items.action AS action,
                        asm_counting_items.id AS id,
                        asm_assets.name AS asset_name,
                        asm_assets.brand AS asset_brand,
                        asm_assets.serial AS asset_serial,
                        asm_assets.code AS code
    
                    FROM asm_counting_items
                    LEFT JOIN asm_assets ON asm_counting_items.asset_id = asm_assets.id
                    WHERE asm_counting_items.counting_id IN ($counting_id)
                ";
    $rst = $dbc->Query($sql);
    while ($line = $dbc->Fetch($rst)) {
        array_push($data, $line);
    }
    echo json_encode($data);

    $dbc->Close();
    ?>