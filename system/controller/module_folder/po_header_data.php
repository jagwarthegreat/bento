<?php
include '../../core/config.php';

$po_header_id = $_POST['id'];
$response = array();
$current_branch = $_SESSION['system']['branch_id'];
$list = FM_SELECT_QUERY('*', 'tbl_purchase_header', "branch = '$current_branch' AND id = '$po_header_id'");
$data = array(
    'id'            => $list['id'],
    'branch_id'     => $list['branch'],
    'branch_name'   => getBranchName($list['branch']),
    'ref_code'      => $list["ref_code"],
    'remarks'       => $list["remarks"],
    'date'          => $list["date"],
    'status'        => $list['status']
);
array_push($response, $data);
echo json_encode($response);
