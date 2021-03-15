<?php
include '../../core/config.php';

$count = 1;
$response['data'] = array();
$current_branch = $_SESSION['system']['branch_id'];
$result = FM_SELECT_LOOP_QUERY('*', 'tbl_employee', "branch_id = '$current_branch' ORDER BY id DESC");
foreach ($result as $list) {
    $data = array(
        'id' => $list['id'],
        'count' => $count++,
        'branch_id' => $list['branch_id'],
        'branch_name' => getBranchName($list['branch_id']),
        'ref_code' => $list["ref_code"],
        'fullname' => $list["fullname"],
        'contact' => $list["contact"],
        'datehired' => $list["datehired"],
        'position' => ($list["position_id"] != 0) ? employeePositionName($list["position_id"]) : 'not set',
        'status' => $list['status']
    );
    array_push($response['data'], $data);
}
echo json_encode($response);
