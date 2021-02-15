<?php
include '../../core/config.php';

$tbl = $_POST['tbl'];
$par = $_POST['par'];
echo FM_DELETE_QUERY($tbl,$par);
