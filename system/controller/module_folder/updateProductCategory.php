<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$category_name = $_POST['cat_dt_name'];
$cat_dt_id = $_POST['cat_dt_id'];

$ifExist = FM_SELECT_QUERY("COUNT(*)", "tbl_product_category", "name = '$category_name' AND id != '$cat_dt_id'");
if ($ifExist[0] > 0) {
    $res = 2;
} else {
    $data = array(
        "name" => $category_name
    );
    $res = FM_UPDATE_QUERY("tbl_product_category", $data, "id = '$cat_dt_id'");
}
echo $res;
