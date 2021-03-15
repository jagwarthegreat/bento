<?php
include '../../core/config.php';

$count = 1;
$response['data'] = array();
$result = FM_SELECT_LOOP_QUERY('*', 'tbl_branch', 'branch_id > 0 ORDER BY branch_id DESC');
foreach ($result as $list) {
    $data = array(
        'id' => $list['branch_id'],
        'count' => $count++,
        'br_name' => $list["name"],
        'status' => $list['status']
    );
    array_push($response['data'], $data);
}
echo json_encode($response);
