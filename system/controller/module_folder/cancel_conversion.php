<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$cancel_convert_checks = $_POST['cancel_convert_checks'];
$checkIds = implode("','", $cancel_convert_checks);
$data = array(
    "status"    => 2
);
$res = FM_UPDATE_QUERY("tbl_product_convert",$data, "id IN('$checkIds')");
echo $res;