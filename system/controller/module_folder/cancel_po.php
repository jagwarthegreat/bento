<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$cancel_po_checks = $_POST['cancel_po_checks'];
$checkIds = implode("','", $cancel_po_checks);
$data = array(
    "status"    => 2
);
$res = FM_UPDATE_QUERY("tbl_purchase_header",$data, "id IN('$checkIds')");
echo $res;