<?php
include '../../core/config.php';

$po_det_item = $_POST['po_det_item'];
$po_det_qty = $_POST['po_det_qty'];
$po_det_unit = $_POST['po_det_unit'];
$po_det_expiry = $_POST['po_det_expiry'];
$po_det_price = $_POST['po_det_price'];
$po_header_id = $_POST['po_header_id'];
$c_date = date("Y-m-d");
$form_data = array(
    "po_header_id" => $po_header_id,
    "product" => $po_det_item,
    "unit" => $po_det_unit,
    "qty" => $po_det_qty,
    "price" => $po_det_price,
    "expiry" => $po_det_expiry,
);
$response = FM_INSERT_QUERY('tbl_purchase_detail', $form_data);
echo $response;
