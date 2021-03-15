<?php
include '../../core/config.php';

$current_branch = $_SESSION['system']['branch_id'];

$user_id = $_POST["user_id"];
$user_username = $_POST["user_username"];
$user_email = $_POST["user_email"];
$user_pass = $_POST["user_pass"];
$user_role = $_POST["user_role"];

$data = [
	"fullname" => getEmployeeName($user_id),
	"employee_id" => $user_id,
	"username" => $user_username,
	"password" => md5($user_pass),
	"role_id" => $user_role,
	"email" => $user_email
];

$res = FM_INSERT_QUERY("tbl_users", $data);
echo $res;
