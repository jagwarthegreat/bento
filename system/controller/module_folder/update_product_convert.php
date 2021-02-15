<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$current_user = $_SESSION['system']['user_id'];

$dt_convert_from_unit = $_POST[dt_conv_from_unit];
$dt_convert_from_qty = $_POST[dt_conv_from_qty];
$dt_convert_to_unit = $_POST[dt_conv_to_unit];
$dt_convert_to_qty = $_POST[dt_conv_to_qty];
$dt_convert_date = $_POST[dt_conv_date];
$dt_convert_code = $_POST["dt_conv_code"];
$dt_convert_product = $_POST[dt_conv_product];

// compute converted amount
$convert_qty = ($dt_convert_from_qty * getUnitQty($dt_convert_from_unit)) / getUnitQty($dt_convert_to_unit);
$data = array(
    "branch"        => $current_branch,
    "convert_date"  => date("Y-m-d", strtotime($dt_convert_date)),
    "product"       => $dt_convert_product,
    "from_unit"     => $dt_convert_from_unit,
    "from_qty"      => $dt_convert_from_qty,
    "to_unit"       => $dt_convert_to_unit,
    "to_qty"        => $convert_qty
);
$response = FM_UPDATE_QUERY('tbl_product_convert', $data, "ref_code = '$dt_convert_code'");
echo $response;

