<div class="modal fade" id="purchase_detail_modal" role="dialog">
    <div class="modal-dialog" id="modal_width_update_po_details" style="max-width: 80%;">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center">Purchase details</h5>

            <div style="display: flex;flex-direction: row;">
                <div id="isFinish" style="margin-right: 4px;"></div>
                <button type='button' onclick='modal_hide_update_po()' id='m_hide' class='btn btn-default btn-sm'>Close</button>
            </div>
        </div>
        <div class="modal-body" style="padding: 0">
            <div class='col-12' style='padding: 0px;'>
               
                    <div class='col-md-12' id='update_po_modal_content'>
                        <div class='row'>
                            <div class='col' id="update_po_header_form">
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label for='update_po_code'>Purchase code</label>
                                        <input type='text' class='form-control' id='update_po_code' placeholder='purchase code' autocomplete='off' disabled='true'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='update_po_date'>Purchase date</label>
                                        <input type='date' class='form-control' id='update_po_date'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='update_po_remarks'>Remarks</label>
                                        <input type='text' class='form-control' id='update_po_remarks' placeholder='purchase remarks' autocomplete='off'>
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <button type='button' onclick='updatePoChanges()' id="sc_update_po_header_btn" class='btn btn-primary btn-sm float-right'>Update changes</button>
                                </div>
                            </div>
                            <div class="" style="border-left: 1px solid #eae5e5;"></div>
                            <div class='col-md-8' id="update_po_detail_form" style="max-height: 400px; overflow: auto;">
                                <div class="row" style="width: 100%;">
                                    <div class='col-md-12' id="po_detail_info_section">
                                        <div class='row'>
                                            
                                            <div class='col-md-6 form-group'>
                                                <label for='update_po_det_item'>Item</label>
                                                <select class='form-control select2' id='update_po_det_item' onchange="getSelectedProdUnitUpdate()" style="width: 100%;">
                                                    <?=getBranchProduct()?>
                                                </select>
                                            </div>

                                            <div class='col-md-3 form-group'>
                                                <label for='update_po_det_unit'>Unit</label>
                                                <select class='form-control select2' id='update_po_det_unit' style="width: 100%;">
                                                </select>
                                            </div>

                                            <div class='col-md-3 form-group'>
                                                <label for='update_po_det_qty'>Qty</label>
                                                <input type='number' class='form-control' id='update_po_det_qty' placeholder='qty'autocomplete='off'>
                                            </div>

                                            <div class='col-md-3 form-group'>
                                                <label for='update_po_det_expiry'>Expiry date</label>
                                                <input type='date' class='form-control' id='update_po_det_expiry' placeholder='expiry' autocomplete='off'>
                                            </div>
                                        
                                            <div class='col-md-3 form-group'>
                                                <label for='update_po_det_price'>COST</label>
                                                <input type='number' class='form-control' id='update_po_det_price' placeholder='cost' autocomplete='off'>
                                            </div>
                                        
                                            <div class='col-md-3 form-group' style='display: flex;flex-direction: row;align-items: flex-end;'>
                                                <button type='button' onclick='savePoUpdateDetails()'id='update_po_add_detail' class='btn btn-primary btn-md'>Add item</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0;"><hr></div>
                                    <div class='col-12' style="padding-bottom: 5px;">
                                        <table id='update_po_details_tbl' class='table table-bordered table-striped'>
                                            <thead>
                                                <tr>
                                                    <th class='no-sort' style='width: 25px;'></th>
                                                    <th style='width: 25px;'></th>
                                                    <th>ITEM NAME</th>
                                                    <th>UNIT</th>
                                                    <th>QTY</th>
                                                    <th style='width: 90px;'>COST</th>
                                                    <th style='width: 90px;'>BALANCE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" style="padding: 3px !important;text-align: right !important;"><b>TOTAL : </b></td>
                                                    <td style="padding: 3px !important;text-align: right !important;"><b><span id="grandPoTotal"></span></b></td>
                                                </tr>
                                            </tfoot>
                                        </table>
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