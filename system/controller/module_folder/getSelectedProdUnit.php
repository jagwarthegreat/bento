<?php
include '../../core/config.php';

$current_branch = $_SESSION['system']['branch_id'];
$itemSelected = $_POST['selected_po_item'];

$prodCatQ = FM_SELECT_QUERY("*", "tbl_products", "id = '$itemSelected'");
$data = getUnit($prodCatQ['category']);
echo $data;
