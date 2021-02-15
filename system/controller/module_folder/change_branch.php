<?php
include '../../core/config.php';

$select_id = $_REQUEST["id"];
if($select_id > 0){
    $br_name = getBranchName($select_id);
    $_SESSION['system']['branch_id'] = $select_id;
    $_SESSION['system']['branch_name'] = $br_name;
    echo 1; 
}else{
    echo 0;
}