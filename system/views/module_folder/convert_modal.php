<div class="modal fade" id="conversion_modal" role="dialog">
    <div class="modal-dialog" style="max-width: 35%;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center">Product conversion entry</h5>

            <div style="display: flex;flex-direction: row;">
                <div id="isFinish" style="margin-right: 4px;"></div>
                <button type='button' onclick='modal_hide_pc()' id='m_hide' class='btn btn-default btn-sm'>Close</button>
            </div>
        </div>
        <div class="modal-body" style="padding: 0; overflow: auto;">
            <div class='col-12' style='padding: 15px;'>
                <div class='row'>
                    <div class='col-md-12' id='pc_modal_content'>
                        <div class='row'>
                            <div class='col' id="pc_header_form">
                                <div class="row">
                                    <div class="col-6">
                                        <div class='form-group'>
                                            <label for='convert_code'>Convert code</label>
                                            <input type='text' class='form-control' id='convert_code' placeholder='conversion code' autocomplete='off' disabled='true'>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class='form-group'>
                                            <label for='convert_date'>Date</label>
                                            <input type='date' class='form-control' id='convert_date'>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12'>
                                        <div class='form-group'>
                                            <label for='convert_product'>Product</label>
                                            <select class='form-control select2' id='convert_product' onchange="convertProdSelectedAdd('ADD')" style="width: 100%;">
                                                <?=getBranchProduct()?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class='form-group'>
                                            <label for='convert_from_unit'>From Unit</label>
                                            <select class='form-control select2' id='convert_from_unit' style="width: 100%;">
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label for='convert_from_qty'>From qty</label>
                                            <input type='number' class='form-control' id='convert_from_qty' placeholder='from qty' autocomplete='off' onkeyup="computeConvertedQty('ADD')">
                                        </div>
                                    </div>
                                        
                                    <div class="col-6">
                                        <div class='form-group'>
                                            <label for='convert_to_unit'>To Unit</label>
                                            <select class='form-control select2' id='convert_to_unit' style="width: 100%;">
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label for='convert_to_qty'>To qty</label>
                                            <input type='number' class='form-control' id='convert_to_qty' placeholder='to qty' autocomplete='off' disabled readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12'>
                                        <button type='button' onclick='convertProduct()' id="convert_product_btn" class='btn btn-success btn-sm float-right'>Save changes</button>
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