<!-- Default box -->
<div class="card">
	<div class="card-header">
		<div style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
			<h3 class="card-title"></h3>

			<div class="card-tools">
				<div class="align-right">
					<button type="button" onclick="addUserModal()" class="btn btn-secondary btn-sm">Add user</button>
					<button type="button" id="delete_branch_btn" class="btn btn-danger btn-sm" onclick="deleteBranch()">Delete selected user</button>
				</div>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table id="users_tbl" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th class="no-sort" style="width: 25px;"></th>
					<th style="width: 25px;"></th>
					<th>FULL NAME</th>
					<th>USERNAME</th>
					<th>EMAIL</th>
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