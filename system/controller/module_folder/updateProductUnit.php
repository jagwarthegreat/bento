<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$d_unit_name = $_POST['d_unit_name'];
$d_unit_qty = $_POST['d_unit_qty'];
$d_unit_category = $_POST['d_unit_category'];
$d_unit_id = $_POST['d_unit_id'];

$ifExist = FM_SELECT_QUERY("COUNT(*)","tbl_product_unit","name = '$d_unit_name' AND qty = '$d_unit_qty' AND id != '$d_unit_id'");
if($ifExist[0] > 0){
    $res = 2;
}else{
    $data = array(
        "category"  => $d_unit_category,
        "name"      => $d_unit_name,
        "qty"       => $d_unit_qty
    );
    $res = FM_UPDATE_QUERY("tbl_product_unit",$data, "id = '$d_unit_id'");
}
echo $res;