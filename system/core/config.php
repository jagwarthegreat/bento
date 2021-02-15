<?php 
error_reporting(0);
define("SYSTEM_NAME", "bento");
define("BASE_NAME", "bento");
define("BASE_PATH", "http://localhost:8000/".BASE_NAME."/");
define("APP_FOLDER", "system/");
define("VIEWS_FOLDER", "views/");
// GLOBALS DATABASE CONFIG AND OTHERS
	$GLOBALS['config'] = array(
		'mysql' => array(
			'host'         => 'localhost',
			'username'     => 'root',
			'password'     => '',
			'database'	   => 'bento'
		)
	);

// CLASSES AND FUNCTIONS (inside directory)
	define ("VALUE",serialize (array ("my_functions.php")));
	$today = date('H:i:s');
	$date = date('Y-m-d H:i:s', strtotime($today)+28800);

// START THE SESSION
	session_start();


// CONNECT TO DATABASE SERVER
	$database = $GLOBALS['config']['mysql']['database'];
	$host 	  = $GLOBALS['config']['mysql']['host'];
	$username = $GLOBALS['config']['mysql']['username'];
	$password = $GLOBALS['config']['mysql']['password'];

	$conn = mysqli_connect($host, $username, $password, $database) or die(mysqli_connect_errno());
	mysqli_select_db($conn, $database) or die(mysqli_error($conn));
	mysqli_query($conn, "SET SESSION sql_mode=''");

// INCLUDE ALL FUNCTIONS
	foreach(unserialize(VALUE) as $val){
		if(!empty($val)){
			include  __DIR__ .'/'.$val;
		}
	}


// THIS WILL LOAD ONLY THE NEEDED CLASS
	spl_autoload_register(function($class){
		switch ($class) {
			case 'ModuleClass':
				require_once 'core/classes/module.class.php';
				break;
			case 'ProfileClass':
				require_once 'core/classes/profile.class.php';
				break;
			case 'BranchClass':
				require_once 'core/classes/branch.class.php';
				break;
			case 'EmployeeClass':
				require_once 'core/classes/employee.class.php';
				break;
			case 'ProductClass':
				require_once 'core/classes/product.class.php';
				break;
			case 'PurchaseClass':
				require_once 'core/classes/purchase.class.php';
				break;
			case 'ProductConvertClass':
				require_once 'core/classes/prod_convert.class.php';
				break;
			case 'ProdInvClass':
				require_once 'core/classes/prod_inv.class.php';
				break;
			case 'ProductCatClass':
				require_once 'core/classes/product.cat.class.php';
				break;
			case 'ProductUnitClass':
				require_once 'core/classes/product.unit.class.php';
				break;
			default:
				break;
		}
	});
