<?php

// $url = urlencode(serialize($array));
$base_name = BASE_NAME;
$uri = $_SERVER['REQUEST_URI'];
$request = explode('?', $_SERVER['REQUEST_URI'], 2);
$routes = str_replace("/".$base_name."/system", "", $request[0]);
$par_data = unserialize(urldecode($_GET[q]));

$error_file = VIEWS_FOLDER.'error.php';
if($routes == '/' || $routes == '' || $routes == '/home'){
	$views_file = VIEWS_FOLDER.'home.php';
	$active_li = "home";
	$folder_file = "module_folder";
}


/*
	START OF MODULE
*/
else if($routes == '/module-link'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/module_view.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/profile'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/profile.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/supplier'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/supplier_view.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/branch'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/branch_view.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/employee'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/employee.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/product'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/product.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/purchase'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/purchase.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/product-convert'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/conversion.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/prod-inv'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/inv_report.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/srp-entry'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/srp_entry.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/product-category'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/product_category.php';
	$active_li = trim($routes,'/');
}
else if($routes == '/product-unit'){
	$folder_file = "module_folder";
	$views_file = VIEWS_FOLDER.$folder_file.'/product_unit.php';
	$active_li = trim($routes,'/');
}
/*
	END OF MODULE
*/

else{
	$views_file = $error_file;
}

$restricted_li = array(
	'min-sidebar'
);

$tree_module = array(
	'module-link'
);

$master_tree = array(
	'branch',
	'employee',
	'product',
	'product-category',
	'product-unit'
);

$transaction_tree = array(
	'sales',
	'product-convert',
	'purchase'
);

$report_tree = array(
	'prod-inv',
	'sales'
);