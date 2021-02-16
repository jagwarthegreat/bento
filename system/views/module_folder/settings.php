<?php
$settings = new Settings();
echo $settings->header();
?>
<!-- Main content -->
<section class="content">

	<div class="container">
		<ul class="nav nav-tabs" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">System Users</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Roles</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">System Preferences</a>
			</li>
		</ul>
		<div class="tab-content" id="myTabContent">

			<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
				    <!-- Default box -->
					<div class="card">
						<div class="card-header">
							<div style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
								<h3 class="card-title"></h3>

								<div class="card-tools">
									<div class="align-right">
										<button type="button" onclick="openModal()" class="btn btn-secondary btn-sm">Add branch</button>
										<button type="button" id="delete_branch_btn" class="btn btn-danger btn-sm" onclick="deleteBranch()">Delete selected branch</button>
									</div>
								</div>
							</div>
						</div>
						<div class="card-body">
							<table id="branch_tbl" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th class="no-sort" style="width: 25px;"></th>
										<th style="width: 25px;"></th>
										<th>BRANCH NAME</th>
										<th style="width: 90px;">STATUS</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<!-- /.card-footer-->
					</div>
					<!-- /.card -->
			</div>
			
			<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
				...
			</div>
			
			<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
				...
			</div>
		</div>
	</div>

</section>
<script>
$(function () {
	loadSysUsersData();
});
function loadSysUsersData() {
	$("#branch_tbl").DataTable().destroy();
	$("#branch_tbl").DataTable({
		"responsive": true,
		"autoWidth": false,
		"paging": true,
		"dataSrc": "data",
		"ajax": {
			type: 'post',
			url: controller+"branch_data.php"
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
					var dt_data = [
						row.id,
						"\""+row.br_name+"\""
					];
					return "<a href='#' onclick='branchDetail("+dt_data+")'>"+row.br_name+"</a>";
				}
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
</script>