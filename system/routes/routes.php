<?php

// $url = urlencode(serialize($array));
$base_name = BASE_NAME;
$uri = $_SERVER['REQUEST_URI'];
$request = explode('?', $_SERVER['REQUEST_URI'], 2);
$routes = str_replace("/" . $base_name . "/system", "", $request[0]);
$par_data = unserialize(urldecode($_GET["q"]));

$error_file = VIEWS_FOLDER . 'error.php';

// thi will load the routes
$routeList = [
	'' => [
		"views_file" => '/home.php',
		"active_li" => "home",
		"folder_file" => "module_folder"
	],
	'/' => [
		"views_file" => '/home.php',
		"active_li" => "home",
		"folder_file" => "module_folder"
	],
	'/home' => [
		"views_file" => '/home.php',
		"active_li" => "home",
		"folder_file" => "module_folder"
	],
	'/module-link' => [
		"views_file" => '/module_view.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/profile' => [
		"views_file" => '/profile.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/supplier' => [
		"views_file" => '/supplier_view.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/branch' => [
		"views_file" => '/branch_view.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/employee' => [
		"views_file" => '/employee.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/product' => [
		"views_file" => '/module_view.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/purchase' => [
		"views_file" => '/purchase.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/product-repack' => [
		"views_file" => '/conversion.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/prod-inv' => [
		"views_file" => '/inv_report.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/srp-entry' => [
		"views_file" => '/srp_entry.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/product-category' => [
		"views_file" => '/product_category.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/product-unit' => [
		"views_file" => '/product_unit.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	],
	'/settings' => [
		"views_file" => '/settings.php',
		"active_li" => trim($routes, '/'),
		"folder_file" => "module_folder"
	]
];

// check the routes the n route to views
if (array_key_exists($routes, $routeList)) {
	$folder_file = $routeList[$routes]["folder_file"];
	$views_file = VIEWS_FOLDER . $folder_file . $routeList[$routes]["views_file"];
	$active_li = $routeList[$routes]["active_li"];
} else {
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
	'product-repack',
	'purchase'
);

$report_tree = array(
	'prod-inv',
	'sales'
);
