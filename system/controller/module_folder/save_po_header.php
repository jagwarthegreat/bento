<?php
include '../../core/config.php';

$current_branch = $_SESSION['system']['branch_id'];
$po_code = $_POST['po_code'];
$po_date = $_POST['po_date'];
$po_remarks = $_POST['po_remarks'];
$c_date = date("Y-m-d");
$form_data = array(
    "branch" => $current_branch,
    "ref_code" => $po_code,
    "remarks" => $po_remarks,
    "date" => $po_date
);
$response = FM_INSERT_QUERY('tbl_purchase_header', $form_data, "Y");
echo $response;
