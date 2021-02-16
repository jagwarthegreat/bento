<div class="modal fade" id="conversion_detail_modal" role="dialog">
    <div class="modal-dialog" style="max-width: 35%;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center">Product conversion details</h5>

            <div style="display: flex;flex-direction: row;">
                <div id="isFinish" style="margin-right: 4px;"></div>
                <button type='button' onclick='modal_hide_pc_detail()' id='m_hide' class='btn btn-default btn-sm'>Close</button>
            </div>
        </div>
        <div class="modal-body" style="padding: 0; overflow: auto;">
            <div class='col-12' style='padding: 15px;'>
                <div class='row'>
                    <div class='col-md-12' id='dt_pc_modal_content'>
                        <div class='row'>
                            <div class='col' id="dt_pc_header_form">
                                <div class="row">
                                    <div class="col-6">
                                        <div class='form-group'>
                                            <label for='dt_convert_code'>Convert code</label>
                                            <input type='text' class='form-control' id='dt_convert_code' placeholder='conversion code' autocomplete='off' disabled='true'>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class='form-group'>
                                            <label for='dt_convert_date'>Date</label>
                                            <input type='date' class='form-control' id='dt_convert_date'>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12'>
                                        <div class='form-group'>
                                            <label for='dt_convert_product'>Product</label>
                                            <select class='form-control select2' id='dt_convert_product' onchange="convertProdSelectedAdd('DT')" style="width: 100%;">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class='form-group'>
                                            <label for='dt_convert_from_unit'>From Unit</label>
                                            <select class='form-control select2' id='dt_convert_from_unit' style="width: 100%;">
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label for='dt_convert_from_qty'>From qty</label>
                                            <input type='number' class='form-control' id='dt_convert_from_qty' placeholder='from qty' autocomplete='off' onkeyup="computeConvertedQty('DT')">
                                        </div>
                                    </div>
                                        
                                    <div class="col-6">
                                        <div class='form-group'>
                                            <label for='dt_convert_to_unit'>To Unit</label>
                                            <select class='form-control select2' id='dt_convert_to_unit' style="width: 100%;">
                                            </select>
                                        </div>
                                        <div class='form-group'>
                                            <label for='dt_convert_to_qty'>To qty</label>
                                            <input type='number' class='form-control' id='dt_convert_to_qty' placeholder='to qty' autocomplete='off' disabled readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class='col-md-12 d-flex' style="flex-direction: row; justify-content: space-between;">
                                        <button type='button' onclick='finishProductConvert()' id="dt_fin_product_btn" class='btn btn-primary btn-sm'>Finish Repack</button>
                                        
                                        <button type='button' onclick='updateProductConvert()' id="dt_convert_product_btn" class='btn btn-success btn-sm'>Save changes</button>
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