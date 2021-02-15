<div class="modal fade" id="product_category_modal" role="dialog">
    <div class="modal-dialog" id="product_add_modal" style="max-width: 25%;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center">Product category entry</h5>
        </div>
        <div class="modal-body" style="padding: 0; overflow: auto; max-height: 400px;">
            <div class='col-12' style='padding: 15px;'>
                <div class='row'>
                    <div class='col-md-12' id='product_add_content'>
                        <div class='row'>
                            <div class='col' id="product_add_entry">
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label for='cat_name'>Category name</label>
                                        <input type='text' class='form-control' id='cat_name' placeholder='category name' autocomplete='off'>
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