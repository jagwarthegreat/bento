<?php
function FM_INSERT_QUERY($table_name, $form_data, $last_id = 'N')
{
	$fields = array_keys($form_data);

	$sql = "INSERT INTO " . $table_name . "
		(`" . implode('`,`', $fields) . "`)
		VALUES('" . implode("','", $form_data) . "')";

	$return_insert = mysql_query($sql) or die(mysql_error());
	$lastID = mysql_insert_id();

	$ret_ = ($last_id == 'Y') ? $lastID : 1;
	return ($return_insert) ? $ret_ : 0;
}

function FM_INSERT_QUERY_SELECT($table_name, $select_table, $form_data, $where_clause)
{
	$fields = array_keys($form_data);
	$inject = ($where_clause == '') ? "" : "WHERE $where_clause";
	$sql = "INSERT INTO " . $table_name . " (`" . implode('`,`', $fields) . "`) SELECT " . implode(",", $form_data) . " FROM $select_table $inject";
	$return_insert = mysql_query($sql);
	return ($return_insert) ? 1 : 0;
}

function FM_SELECT_QUERY($type, $table, $params = '')
{
	$inject = ($params == '') ? "" : "WHERE $params";
	$select_query = mysql_query("SELECT $type FROM $table $inject") or die(mysql_error());
	$fetch = mysql_fetch_array($select_query);
	return $fetch;
}

function FM_SELECT_LOOP_QUERY($type, $table, $params = '')
{
	$inject = ($params == '') ? "" : "WHERE $params";
	$fetch = mysql_query("SELECT $type FROM $table $inject") or die(mysql_error());
	while ($row = mysql_fetch_array($fetch)) {
		$data[] = $row;
	}
	return $data;
}

function FM_UPDATE_QUERY($table_name, $form_data, $where_clause = '')
{
	$whereSQL = '';
	if (!empty($where_clause)) {
		if (substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
			$whereSQL = " WHERE " . $where_clause;
		} else {
			$whereSQL = " " . trim($where_clause);
		}
	}
	$sql = "UPDATE " . $table_name . " SET ";
	$sets = array();
	foreach ($form_data as $column => $value) {
		$sets[] = "`" . $column . "` = '" . $value . "'";
	}
	$sql .= implode(', ', $sets);
	$sql .= $whereSQL;

	$return_query = mysql_query($sql);
	return ($return_query) ? 1 : 0;
}

function FM_DELETE_QUERY($table_name, $where_clause = '')
{
	$whereSQL = '';
	if (!empty($where_clause)) {
		if (substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE') {
			$whereSQL = " WHERE " . $where_clause;
		} else {
			$whereSQL = " " . trim($where_clause);
		}
	}
	$sql = "DELETE FROM " . $table_name . $whereSQL;
	$return_delete = mysql_query($sql);
	return ($return_delete) ? 1 : 0;
}

function FM_QUERY($query)
{
	$r = mysql_query($query);
	return ($r) ? 1 : 0;
}

function clean($str)
{
	$str = @trim($str);
	if (get_magic_quotes_gpc()) {
		$str = stripslashes($str);
	}
	return mysql_real_escape_string($str);
}

function sidebar_parent($active_li, $tree, $menu = 0)
{
	$menu_ = ($menu == 1) ? "menu-open" : "active";
	return in_array($active_li, $tree) ? $menu_  : '';
}
function sidebar_li($module_name, $li, $active_li, $icon = "fa-circle-o")
{
	$is_active = ($active_li == $li) ? 'active' : '';
	return "<li class='nav-item'>
			<a href='" . BASE_PATH . APP_FOLDER . "$li' class='nav-link $is_active'>
				<i class='nav-icon fa $icon'></i>
				<p>$module_name</p>
			</a>
		</li>";
}

function sidebar_ul($name, $icon_ = "fa-file-o")
{
	return "<i class='nav-icon fa $icon_'></i><p>$name<i class='right fa fa-angle-left'></i></p>";
}

function sign_out()
{
	return "<li class='nav-item'>
			<a onclick='logOut()' class='nav-link'>
				<i class='nav-icon fa fa-sign-out'></i>
				<p>SIGN OUT</p>
			</a>
		</li>";
}

function getBranches()
{
	$data = "";
	$current_br = $_SESSION['system']['branch_id'];
	$data .= "<option value=''>-- select branch --</option>";
	$data_q = FM_SELECT_LOOP_QUERY("*", "tbl_branch", "status = 0 ORDER BY name ASC");
	foreach ($data_q as $list) {
		$isSelected = ($current_br == $list['branch_id']) ? 'selected' : '';
		$data .= "<option " . $isSelected . " value='" . $list['branch_id'] . "'>" . $list["name"] . "</option>";
	}
	return $data;
}

function getBranchName($br_id)
{
	$br_name = FM_SELECT_QUERY("name", "tbl_branch", "branch_id = '$br_id'");
	return $br_name["name"];
}

function randomCodeGenerator($length = 6)
{
	$str = "";
	$characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str;
}

function codeGenerator($length = 4)
{
	$str = "";
	$end = date('ymdhis');
	$characters = array_merge(range('A', 'Z'), range('a', 'z'), range('0', '9'));
	$max = count($characters) - 1;
	for ($i = 0; $i < $length; $i++) {
		$rand = mt_rand(0, $max);
		$str .= $characters[$rand];
	}
	return $str . $end;
}

function getEmployeePosition($selected_id = "")
{
	$data = "";
	$current_br = $_SESSION['system']['branch_id'];
	$data .= "<option value=''>-- select position --</option>";
	$data_q = FM_SELECT_LOOP_QUERY("*", "tbl_employee_position", "id > 0 ORDER BY position ASC");
	foreach ($data_q as $list) {
		$selected = ($selected_id == $list['id']) ? "selected" : "";
		$data .= "<option " . $selected . " value='" . $list['id'] . "'>" . $list["position"] . "</option>";
	}
	return $data;
}

function employeePositionName($id)
{
	$q = FM_SELECT_QUERY("*", "tbl_employee_position", "id = '$id'");
	return $q["position"];
}

function getBranchProduct($selected_id = "")
{
	$data = "";
	$current_br = $_SESSION['system']['branch_id'];
	$data .= "<option value=''>-- select product --</option>";
	$data_q = FM_SELECT_LOOP_QUERY("*", "tbl_products", "branch = '$current_br' ORDER BY name ASC");
	foreach ($data_q as $list) {
		$selected = ($selected_id == $list['id']) ? "selected" : "";
		$data .= "<option " . $selected . " value='" . $list['id'] . "'>" . $list["name"] . "</option>";
	}
	return $data;
}

function getUnit($category = "", $selected_id = "")
{
	$data = "";
	$current_br = $_SESSION['system']['branch_id'];
	$data .= "<option value=''>-- select unit --</option>";
	$params = ($category == "") ? "id > 0" : "category = '$category'";
	$data_q = FM_SELECT_LOOP_QUERY("*", "tbl_product_unit", "$params ORDER BY name ASC");
	foreach ($data_q as $list) {
		$selected = ($selected_id == $list['id']) ? "selected" : "";
		$data .= "<option " . $selected . " value='" . $list['id'] . "'>" . $list["name"] . "</option>";
	}
	return $data;
}

function getProdCategory($selected_id = "")
{
	$data = "";
	$current_br = $_SESSION['system']['branch_id'];
	$data .= "<option value=''>-- select category --</option>";
	$data_q = FM_SELECT_LOOP_QUERY("*", "tbl_product_category", "id > 0 ORDER BY name ASC");
	foreach ($data_q as $list) {
		$selected = ($selected_id == $list['id']) ? "selected" : "";
		$data .= "<option " . $selected . " value='" . $list['id'] . "'>" . $list["name"] . "</option>";
	}
	return $data;
}

function getProdCategoryName($id)
{
	$q = FM_SELECT_QUERY("name", "tbl_product_category", "id = '$id'");
	return $q["name"];
}

function getProductName($id, $br_id)
{
	$q = FM_SELECT_QUERY("name", "tbl_products", "id = '$id' AND branch = '$br_id'");
	return $q["name"];
}

function getProdUnit($id)
{
	$q = FM_SELECT_QUERY("name", "tbl_product_unit", "id = '$id'");
	return $q["name"];
}

function logMe($content, $module)
{
	$current_br = $_SESSION['system']['branch_id'];
	$current_user = $_SESSION['system']['user_id'];
	$data = array(
		'branch_id'	=> $current_br,
		'content'	=> $content,
		'module'	=> $module,
		'user'		=> $current_user,
		'date'		=> date("Y-m-d")
	);
	$res = FM_INSERT_QUERY("tbl_logs", $data);
	//return $res;
}

function getUnitQty($unit_id)
{
	$res = FM_SELECT_QUERY("qty", "tbl_product_unit", "id = '$unit_id'");
	return $res[0];
}

function getAllEmployee($selected_id = "")
{
	$data = "";
	$data_q = FM_SELECT_LOOP_QUERY("*", "tbl_employee", "id > 0 ORDER BY fullname ASC");
	foreach ($data_q as $list) {
		$selected = ($selected_id == $list['id']) ? "selected" : "";
		$data .= "<option " . $selected . " value='" . $list['id'] . "'>" . $list["fullname"] . "</option>";
	}
	return $data;
}

function getEmployeeName($employee_id)
{
	$data = FM_SELECT_QUERY("fullname", "tbl_employee", "id = '$employee_id'");
	return $data[0];
}
