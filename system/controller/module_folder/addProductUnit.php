<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$unit_name = $_POST['unit_name'];
$unit_qty = $_POST['unit_qty'];
$unit_category = $_POST['unit_category'];

$ifExist = FM_SELECT_QUERY("COUNT(*)", "tbl_product_unit", "name = '$unit_name' AND category = '$unit_category' AND qty = '$unit_qty'");
if ($ifExist[0] > 0) {
    $res = 2;
} else {
    $data = array(
        "category" => $unit_category,
        "name" => $unit_name,
        "qty" => $unit_qty
    );
    $res = FM_INSERT_QUERY("tbl_product_unit", $data);
}
echo $res;
