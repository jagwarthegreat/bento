<div class="modal fade" id="set_prod_srp_modal" role="dialog">
    <div class="modal-dialog" id="set_prod_srp_modal" style="max-width: 25%;">
      <div class="modal-content">
        <div class="modal-header">
            <input type="hidden" id="prod_srp_id">
            <h5 class="modal-title text-center">Set SRP for item :  <span id="set_srp_for" class="text-muted"></span></h5>
        </div>
        <div class="modal-body" style="padding: 0; overflow: auto; max-height: 400px;">
            <div class='col-12' style='padding: 15px;'>
                <div class='row'>
                    <div class='col-md-12' id='product_add_content'>
                        <div class='row'>
                            <div class='col' id="product_add_entry">
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label for='selling_price'>Selling price</label>
                                        <input type='number' class='form-control' id='selling_price' placeholder='selling price' autocomplete='off'>
                                    </div>
                                    <div class='d-flex' style='justify-content: space-between;'>
                                        <button type='button' onclick='saveSrpChanges()' id='prod_sc_branch' class='btn btn-success btn-sm'>Save changes</button>
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