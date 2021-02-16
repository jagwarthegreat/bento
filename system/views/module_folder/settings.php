<?php
$settings = new Settings();
echo $settings->header();
?>
<!-- Main content -->
<section class="content">

	<div class="container">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link <?=$settings->isActive('users-tab')?>" id="users-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="true" onclick="setActiveTab('users-tab')">System Users</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?=$settings->isActive('roles-tab')?>" id="roles-tab" data-toggle="tab" href="#role" role="tab" aria-controls="role" aria-selected="false" onclick="setActiveTab('roles-tab')">Roles</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?=$settings->isActive('pref-tab')?>" id="pref-tab" data-toggle="tab" href="#pref" role="tab" aria-controls="pref" aria-selected="false" onclick="setActiveTab('pref-tab')">System Preferences</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">

			<div class="tab-pane fade <?=$settings->isActive('users-tab')?>" id="users" role="tabpanel" aria-labelledby="users-tab">
				<?php $settings->userTab(); ?>
			</div>
			
			<div class="tab-pane fade <?=$settings->isActive('roles-tab')?>" id="roles" role="tabpanel" aria-labelledby="roles-tab">
				<?php $settings->rolesTab(); ?>
			</div>
			
			<div class="tab-pane fade <?=$settings->isActive('pref-tab')?>" id="pref" role="tabpanel" aria-labelledby="pref-tab">
				<?php $settings->prefTab(); ?>
			</div>

		</div>
	</div>

</section>
<script>
$('title').html("Settings");
$(function () {
	loadSysUsersData();
});

function loadSysUsersData() {
	$("#users_tbl").DataTable().destroy();
	$("#users_tbl").DataTable({
		"responsive": true,
		"autoWidth": false,
		"paging": true,
		"dataSrc": "data",
		"ajax": {
			type: 'post',
			url: controller+"users_data.php"
		},
		"columns": [
			{
				"mRender": function(data,type,row){
					return "<input type='checkbox' name='checkbox' value='"+row.id+"'>";
				},
				"className": "text-center"
			},
			{
				"data": "count",
				"className": "text-center"
			},
			{
				"mRender": function(data,type,row){
					var usr_data = [
						row.id,
						"\""+row.name+"\""
					];
					return "<a href='#' onclick='branchDetail("+usr_data+")'>"+row.name+"</a>";
				}
			},
			{
				"data": "username"
			},
			{
				"data": "email"
			},
			{
				"data": "role"
			},
			{
				"mRender": function(data,type,row){
					const stats = (row.status == 0) ? '<span style="color: green;">Visible</span>' : '<span style="color: gray;">Hidden</span>' ;
					return stats;
				},
				"className": "text-center"
			}
		]
	});
}

function setActiveTab(tab) {
	$.post(controller+"settingsActiveTab.php",{
		tab: tab
	},function(data){
		location.reload();
	});
}

function addUserModal() {
	$("#settings_users_modal").modal('show');
}

function saveUser() {
	var user_id = $("#user_name").val();
	var user_username = $("#user_username").val();
	var user_email = $("#user_email").val();
	var user_pass = $("#user_pass").val();
	var user_role = $("#user_role").val();

	$.post(controller+"saveUser.php",{
		user_id: user_id,
		user_username: user_username,
		user_email: user_email,
		user_pass: user_pass,
		user_role: user_role
	},function(data){
		location.reload();
	});
}
</script>