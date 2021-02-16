<div class="modal fade" id="settings_users_modal" role="dialog">
    <div class="modal-dialog" id="product_add_modal" style="max-width: 30%;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center">System User entry</h5>
        </div>
        <div class="modal-body" style="padding: 0; overflow: auto; max-height: 400px;">
            <div class='col-12' style='padding: 15px;'>
                <div class='row'>
                    <div class='col-md-12' id='product_add_content'>
                        <div class='row'>
                            <div class='col' id="product_add_entry">
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label for='user_name'>Name</label>
                                        <select class='form-control select2' id='user_name' style="width: 100%;">
											<?=getAllEmployee()?>
										</select>
                                    </div>
									<div class='form-group'>
                                        <label for='cat_name'>Userame</label>
                                        <input type='text' class='form-control' id='cat_name' placeholder='category name' autocomplete='off'>
                                    </div>
									<div class='form-group'>
                                        <label for='cat_name'>Email</label>
                                        <input type='text' class='form-control' id='cat_name' placeholder='category name' autocomplete='off'>
                                    </div>
									<div class='form-group'>
                                        <label for='cat_name'>Default Password</label>
                                        <input type='text' class='form-control' id='cat_name' placeholder='category name' autocomplete='off'>
                                    </div>
									<div class='form-group'>
                                        <label for='user_role'>Role</label>
                                        <select class='form-control select2' id='user_role' style="width: 100%;">
											<?=getEmployeePosition()?>
										</select>
                                    </div>

                                    <div class='d-flex' style='justify-content: space-between;'>
                                        <button type='button' onclick='saveCatChanges()' id='prod_sc_branch' class='btn btn-success btn-sm'>Save changes</button>
                                        <button type='button' class='btn btn-default btn-sm' id='prod_c_branch' data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <p><center>zechSolution &trade;</center></p>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>