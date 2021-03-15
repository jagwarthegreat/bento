<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];

$convert_from_unit = getUnitQty($_POST['convert_from_unit']);
$convert_from_qty = $_POST['convert_from_qty'];
$convert_to_unit = getUnitQty($_POST['convert_to_unit']);
$convert_to_qty = $_POST['convert_to_qty'];

// compute converted amount
$convert_qty = ($convert_from_qty * $convert_from_unit) / $convert_to_unit;
echo $convert_qty;
