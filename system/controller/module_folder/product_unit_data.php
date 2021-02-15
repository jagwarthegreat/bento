<?php
include '../../core/config.php';

$count = 1;
$response['data'] = array();
$current_branch = $_SESSION['system']['branch_id'];
$result = FM_SELECT_LOOP_QUERY('*', 'tbl_product_unit', "id > 0 ORDER BY id DESC");
foreach($result as $list){
    $data = array(
        'id'            => $list[id],
        'category'      => getProdCategoryName($list[category]),
        'category_id'   => $list[category],
        'name'          => $list[name],
        'qty'           => $list[qty],
        'count'         => $count++
    );
    array_push($response['data'], $data);
}
echo json_encode($response);