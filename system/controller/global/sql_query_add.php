<?php
include '../../core/config.php';

$tbl     = $_POST['tbl'];
$data     = $_POST['data'];

echo FM_INSERT_QUERY($tbl, $data);
