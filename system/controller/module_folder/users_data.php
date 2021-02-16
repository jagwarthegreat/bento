<?php
include '../../core/config.php';

$count = 1;
$response['data'] = [];
$result = FM_SELECT_LOOP_QUERY('*' , 'tbl_users', 'user_id > 0 ORDER BY user_id DESC');
foreach($result as $list){
    $data = [
        'id' => $list[user_id],
        'count' => $count++,
        'name' => clean($list["fullname"]),
        'username' => clean($list["username"]),
        'email' => clean($list["email"]),
        'status' => $list[status]
	];
    array_push($response['data'], $data);
}
echo json_encode($response);