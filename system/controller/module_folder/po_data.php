<?php
include '../../core/config.php';

$count = 1;
$response['data'] = array();
$current_branch = $_SESSION['system']['branch_id'];
$result = FM_SELECT_LOOP_QUERY('*' , 'tbl_purchase_header', "branch = '$current_branch' ORDER BY status,id DESC");
foreach($result as $list){
    $data = array(
        'id' => $list[id],
        'count' => $count++,
        'branch_id' => $list[branch],
        'branch_name' => getBranchName($list[branch]),
        'ref_code' => $list["ref_code"],
        'remarks' => $list["remarks"],
        'date' => $list["date"],
        'status' => $list[status]
    );
    array_push($response['data'], $data);
}
echo json_encode($response);