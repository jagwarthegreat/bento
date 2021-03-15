<?php
include '../../core/config.php';

$count = 1;
$grandPoTotal = 0;
$response['data'] = array();
$po_header_id = $_POST['po_header_id'];
$current_branch = $_SESSION['system']['branch_id'];
$result = FM_SELECT_LOOP_QUERY('*', 'tbl_purchase_detail', "po_header_id = '$po_header_id' ORDER BY id DESC");
foreach ($result as $list) {
    $finStat = FM_SELECT_QUERY("*", "tbl_purchase_header", "id = '$list[po_header_id]'");
    $subtotal = $list['qty'] * $list['price'];
    $grandPoTotal += $subtotal;
    $data = array(
        'id' => $list['id'],
        'count' => $count++,
        'prod_name' => getProductName($list['product'], $current_branch),
        'unit' => getProdUnit($list['unit']),
        'qty' => $list['qty'],
        'price' => $list['price'],
        'subtotal' => $subtotal,
        'expiry' => $list["expiry"],
        'status' => $finStat['status'],
        'grandPoTotal' => $grandPoTotal
    );
    array_push($response['data'], $data);
}
echo json_encode($response);
