<?php
include '../../core/config.php';

$current_branch = $_SESSION['system']['branch_id'];
$prod_id = $_POST['prod_id'];
$to_unit_id = $_POST['to_unit_id'];

$prodCatQ = FM_SELECT_QUERY("*","tbl_products","id = '$prod_id'");
$data = getUnit($prodCatQ[category], $to_unit_id);
echo $data;