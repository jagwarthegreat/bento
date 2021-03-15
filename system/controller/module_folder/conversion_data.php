<?php
include '../../core/config.php';

$count = 1;
$response = array();
$id = $_POST['id'];
$current_branch = $_SESSION['system']['branch_id'];
$list = FM_SELECT_QUERY('*', 'tbl_product_convert', "branch = '$current_branch' AND id = '$id'");
$data = array(
    'id' => $list['id'],
    'count' => $count++,
    'branch_id' => $list['branch'],
    'branch_name' => getBranchName($list['branch']),
    'ref_code' => $list["ref_code"],
    "convert_date"  => date("Y-m-d", strtotime($list["convert_date"])),
    'prod_id' => $list['product'],
    'from_unit' => $list['from_unit'],
    'from_qty' => $list['from_qty'],
    'to_unit' => $list['to_unit'],
    'to_qty' => $list['to_qty'],
    'status' => $list['status']
);
array_push($response, $data);
echo json_encode($response);
