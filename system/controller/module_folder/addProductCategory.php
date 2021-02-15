<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$category_name = $_POST['cat_name'];

$ifExist = FM_SELECT_QUERY("COUNT(*)","tbl_product_category","name = '$category_name'");
if($ifExist[0] > 0){
    $res = 2;
}else{
    $data = array(
        "name" => $category_name
    );
    $res = FM_INSERT_QUERY("tbl_product_category",$data);
}
echo $res;