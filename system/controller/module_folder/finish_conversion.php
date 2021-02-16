<?php
include '../../core/config.php';
$current_branch = $_SESSION['system']['branch_id'];
$convert_code = $_POST['convert_code'];
$data = [
	"status" => 1
];
$res = FM_UPDATE_QUERY("tbl_product_convert",$data, "ref_code = '$convert_code'");
echo $res;