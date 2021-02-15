<?php
include '../system/core/config.php';

$username = clean($_POST['username']);
$password = md5(clean($_POST['password']));

$check_user = FM_SELECT_QUERY("*","tbl_users","username = '$username' AND password = '$password'");
if($check_user[user_id]>0){
	$_SESSION['system']['user_id'] = $check_user[user_id];
	$_SESSION['system']['fullname'] = $check_user[fullname];
	$_SESSION['system']['user_img'] = $check_user[user_img];
	$_SESSION['system']['username'] = $check_user[username];

	$_SESSION['system']['branch_id'] = 0;
	$_SESSION['system']['branch_name'] = "";

	$_SESSION['farm_id'] = 0;
	$_SESSION['farm_name'] = '';

	header("location:../system");
}else{
	$_SESSION['error'] = "Incorrect username or password .Please try again!";
	header("location:index.php");
}