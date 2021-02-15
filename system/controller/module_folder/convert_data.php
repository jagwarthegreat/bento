<?php
include '../../core/config.php';

$count = 1;
$response['data'] = array();
$current_branch = $_SESSION['system']['branch_id'];
$result = FM_SELECT_LOOP_QUERY('*' , 'tbl_product_convert', "branch = '$current_branch' ORDER BY status,id DESC");
foreach($result as $list){
    $data = array(
        'id' => $list[id],
        'count' => $count++,
        'branch_id' => $list[branch],
        'branch_name' => getBranchName($list[branch]),
        'ref_code' => $list["ref_code"],
        'prod_name' => getProductName($list[product], $list[branch]),
        'from_unit' => getProdUnit($list["from_unit"]),
        'from_qty' => $list["from_qty"],
        'to_unit' => getProdUnit($list["to_unit"]),
        'to_qty' => $list["to_qty"],
        'status' => $list[status]
    );
    array_push($response['data'], $data);
}
echo json_encode($response);