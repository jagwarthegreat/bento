<?php
error_reporting(0);
define("SYSTEM_NAME", "bento");
define("BASE_NAME", "bento");
define("BASE_PATH", "http://localhost/" . BASE_NAME . "/");
define("APP_FOLDER", "system/");
define("VIEWS_FOLDER", "views/");

// GLOBALS DATABASE CONFIG AND OTHERS
$GLOBALS['config'] = [
	'mysql' => [
		'host'         => 'localhost',
		'username'     => 'root',
		'password'     => '',
		'database'	   => 'bento'
	]
];

// CLASSES AND FUNCTIONS (inside directory)
define("VALUE", serialize(array("my_functions.php")));
$today = date('H:i:s');
$date = date('Y-m-d H:i:s', strtotime($today) + 28800);

// START THE SESSION
session_start();


// CONNECT TO DATABASE SERVER
$database = $GLOBALS['config']['mysql']['database'];
$host 	  = $GLOBALS['config']['mysql']['host'];
$username = $GLOBALS['config']['mysql']['username'];
$password = $GLOBALS['config']['mysql']['password'];

@mysql_connect($host, $username, $password, $database) or die(mysql_error());
@mysql_select_db($database) or die(mysql_error());
@mysql_query("SET SESSION sql_mode=''");


// INCLUDE ALL FUNCTIONS
foreach (unserialize(VALUE) as $val) {
	if (!empty($val)) {
		include  __DIR__ . '/' . $val;
	}
}


// THIS WILL LOAD ONLY THE NEEDED CLASS
spl_autoload_register(function ($class) {
	include __DIR__ . '/../autoloader.php';
	if (array_key_exists($class, $classes)) {
		require_once $classes[$class];
	}
});
