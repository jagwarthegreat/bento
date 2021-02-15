<?php
include '../../core/config.php';

$count = 1;
$response['data'] = array();
$current_branch = $_SESSION['system']['branch_id'];
$result = FM_SELECT_LOOP_QUERY('*', 'tbl_products', "branch = '$current_branch' ORDER BY id DESC");
foreach($result as $list){
    $data = array(
        'id' => $list[id],
        'count' => $count++,
        'branch_id' => $list[branch],
        'branch_name' => getBranchName($list[branch]),
        'ref_code' => $list["code"],
        'name' => $list["name"],
        'category_id' => $list["category"],
        'category_name' => getProdCategoryName($list[category]),
        'status' => $list[status],
        'srp' => $list[selling_price]
    );
    array_push($response['data'], $data);
}
echo json_encode($response);