<?php
include '../../core/config.php';

$count = 1;
$response = array();
$current_branch = $_SESSION['system']['branch_id'];
$inv_date = $_REQUEST['date'];
$inv_cat = $_REQUEST['cat'];

$response['unit'] = array();
$unit_result = FM_SELECT_LOOP_QUERY('*', 'tbl_product_unit', "category = '$inv_cat' ORDER BY qty ASC");
$count_unit = 0;
foreach($unit_result as $ulist){
    $count_unit++;
    $plist = array(
        'package_id' => (int) $ulist[id],
        'qty' => (float) $ulist[qty],
        'package_name' => getProdUnit($ulist[id])
    );
    array_push($response['unit'],$plist);
}

$response['items'] = array();
$result = FM_SELECT_LOOP_QUERY('*', 'tbl_products', "branch = '$current_branch' AND category = '$inv_cat' ORDER BY name ASC");
$grandTotal = 0;
foreach($result as $item){
    $list = array();
    $list['product_id'] = $item[id];
    $list['product_name'] = $item['name'];
    $list['srp'] = number_format($item['selling_price'], 2);
    $list['inv'] = array();
    $balance = 0;
    $q = mysql_query("SELECT * FROM tbl_product_unit WHERE category = '$inv_cat'");
    while($row = mysql_fetch_array($q)){
        $perunit = (float) getInvPerUnit($inv_date, $current_branch, $item[id], $row[id]);
        $list['inv'][$row[id]] = $perunit;
        $balance += ($perunit*$row[qty])*$item['selling_price'];
    }

    $grandTotal += $balance;
    $list['balance'] =  $balance;

    array_push($response['items'], $list);
}

$response['grandTotal'] = array();
$gTList = array();
$gTList['gt_span'] = $count_unit;
$gTList['ending'] = $grandTotal;
array_push($response['grandTotal'], $gTList);

function getInvPerUnit($invdate, $branch, $product, $unit)
{
    $inResult = inINV($invdate, $branch, $product, $unit);
    $outResult = outINV($invdate, $branch, $product, $unit);

    return $inResult - $outResult;
}

function inINV($invdate, $branch, $product, $unit)
{
    $purchaseResult = mysql_fetch_array(mysql_query("SELECT pod.product, pod.unit, SUM(pod.qty) AS inv_in_qty FROM tbl_purchase_header AS poh, tbl_purchase_detail AS pod, tbl_product_unit AS prodU WHERE poh.id = pod.po_header_id AND pod.unit = prodU.id AND poh.date <= '$invdate' AND poh.branch = '$branch' AND pod.product = '$product' AND pod.unit = '$unit' AND poh.`status` = 1 GROUP BY pod.unit"));

    $conversionIN = FM_SELECT_QUERY("SUM(pc.to_qty)", "tbl_products AS p, tbl_product_convert AS pc ", "p.id = pc.product AND pc.convert_date <= '$invdate' AND pc.branch = '$branch' AND pc.product = '$product' AND pc.to_unit = '$unit' AND pc.`status` = 1 GROUP BY pc.to_unit");

    return $purchaseResult[0] + $conversionIN[0];
}

function outINV($invdate, $branch, $product, $unit)
{
    $conversionOUT = FM_SELECT_QUERY("SUM(pc.from_qty)", "tbl_products AS p, tbl_product_convert AS pc ", "p.id = pc.product AND pc.convert_date <= '$invdate' AND pc.branch = '$branch' AND pc.product = '$product' AND pc.from_unit = '$unit' AND pc.`status` = 1 GROUP BY pc.from_unit");

    return $conversionOUT[0];
}

echo json_encode($response);