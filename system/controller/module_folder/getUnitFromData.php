<?php
include '../../core/config.php';

$current_branch = $_SESSION['system']['branch_id'];
$prod_id = $_POST['prod_id'];
$from_unit_id = $_POST['from_unit_id'];

$prodCatQ = FM_SELECT_QUERY("*","tbl_products","id = '$prod_id'");
$data = getUnit($prodCatQ[category], $from_unit_id);
echo $data;