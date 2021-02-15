<?php
include '../../core/config.php';

$emp_id = $_POST[id];
$response = array();
$current_branch = $_SESSION['system']['branch_id'];
$list = FM_SELECT_QUERY('*' , 'tbl_employee', "branch_id = '$current_branch' AND id = '$emp_id'");
$data = array(
    'id'            => $list[id],
    'branch_id'     => $list[branch_id],
    'branch_name'   => getBranchName($list[branch_id]),
    'ref_code'      => $list["ref_code"],
    'fullname'      => $list["fullname"],
    'address'       => $list["address"],
    'contact'       => $list["contact"],
    'datehired'     => $list["datehired"],
    'position'      => $list["position_id"],
    'status'        => $list[status]
);
array_push($response, $data);
echo json_encode($response);