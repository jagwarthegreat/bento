<?php
include '../../core/config.php';

$tbl 	= $_POST['tbl'];
$data 	= $_POST['data'];
$par 	= (!empty($_POST['par']))?"WHERE ".$_POST['par']:'';
$query 	= mysql_query("UPDATE $tbl SET $data $par");
echo $query ? 1 : 0;
