<?php
include '../../core/config.php';

$current_branch = $_SESSION['system']['branch_id'];
$itemSelected = $_POST['selected'];

$data = getBranchProduct($itemSelected);
echo $data;