<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$current_user = $_SESSION['system']['user_id'];

$convert_from_unit = $_POST['conv_from_unit'];
$convert_from_qty = $_POST['conv_from_qty'];
$convert_to_unit = $_POST['conv_to_unit'];
$convert_to_qty = $_POST['conv_to_qty'];
$convert_date = $_POST['conv_date'];
$convert_code = $_POST["'conv_code'"];
$convert_product = $_POST['conv_product'];

// compute converted amount
$convert_qty = ($convert_from_qty * getUnitQty($convert_from_unit)) / getUnitQty($convert_to_unit);
$data = array(
    "ref_code"      => $convert_code,
    "branch"        => $current_branch,
    "convert_date"  => $convert_date,
    "product"       => $convert_product,
    "from_unit"     => $convert_from_unit,
    "from_qty"      => $convert_from_qty,
    "to_unit"       => $convert_to_unit,
    "to_qty"        => $convert_qty,
    "encoded_by"    => $current_user,
);
$response = FM_INSERT_QUERY('tbl_product_convert', $data);
echo $response;
