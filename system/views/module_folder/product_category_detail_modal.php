<div class="modal fade" id="product_category_detail_modal" role="dialog">
    <div class="modal-dialog" id="product_category_detail_modal" style="max-width: 25%;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center">Product category detail</h5>
        </div>
        <div class="modal-body" style="padding: 0; overflow: auto; max-height: 400px;">
            <div class='col-12' style='padding: 15px;'>
                <div class='row'>
                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col'>
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label for='cat_det_name'>Category name</label>
                                        <input type='text' class='form-control' id='cat_det_name' placeholder='category name' autocomplete='off'>
                                        <input type="hidden" id="cat_detail_id">
                                    </div>
                                    <div class='d-flex' style='justify-content: space-between;'>
                                        <button type='button' onclick='updateCatChanges()' id='prod_sc_branch' class='btn btn-primary btn-sm'>Update changes</button>
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