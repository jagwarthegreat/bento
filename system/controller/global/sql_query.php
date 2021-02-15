<?php
include '../../core/config.php';

$queries = $_POST['query'];
if(count($queries)>0){
	foreach ($queries as $query) {
		FM_QUERY($query);
	}
}
echo 1;