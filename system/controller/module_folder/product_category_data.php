<?php
include '../../core/config.php';

$count = 1;
$response['data'] = array();
$current_branch = $_SESSION['system']['branch_id'];
$result = FM_SELECT_LOOP_QUERY('*', 'tbl_product_category', "id > 0 ORDER BY id DESC");
foreach($result as $list){
    $data = array(
        'id' => $list[id],
        'count' => $count++,
        'name' => $list[name],
        'status' => $list[status],
    );
    array_push($response['data'], $data);
}
echo json_encode($response);