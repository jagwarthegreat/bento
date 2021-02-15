<?php
include '../../core/config.php';

$current_branch = $_SESSION['system']['branch_id'];
$prod_id = $_POST['prod_srp_id'];
$srp_value = $_POST['srp_value'];

$form_data = array(
    "selling_price" => $srp_value
);
$response = FM_UPDATE_QUERY("tbl_products", $form_data, "id = '$prod_id'");
echo $response;