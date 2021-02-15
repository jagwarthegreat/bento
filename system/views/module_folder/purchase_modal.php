<div class="modal fade" id="purchase_modal" role="dialog">
    <div class="modal-dialog" id="modal_width_po" style="max-width: 85%;">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center">Purchase entry</h5>
          <button type='button' onclick='modal_hide_po()' id='m_hide' class='btn btn-default btn-sm'>Close</button>
        </div>
        <div class="modal-body" style="padding: 0">
            <div class='col-12' style='padding: 15px;'>
                
                    <div class='col-md-12' id='po_modal_content'>
                        <div class='row'>
                            <div class='col' id="po_header_form">
                                <div class='col-md-12'>
                                    <div class='form-group'>
                                        <label for='po_code'>Purchase code</label>
                                        <input type='text' class='form-control' id='po_code' placeholder='purchase code' autocomplete='off' disabled='true'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='po_date'>Purchase date</label>
                                        <input type='date' class='form-control' id='po_date'>
                                    </div>
                                    <div class='form-group'>
                                        <label for='po_remarks'>Remarks</label>
                                        <input type='text' class='form-control' id='po_remarks' placeholder='purchase remarks' autocomplete='off'>
                                    </div>
                                </div>
                                <div class='col-md-12'>
                                    <button type='button' onclick='savePoChanges()' id="sc_po_header_btn" class='btn btn-success btn-sm float-right'>Add PO</button>
                                </div>
                            </div>
                            <div class='col-md-8' id="po_detail_form" style="display: none;max-height: 400px; overflow: auto;">
                                <div class="row" style="">
                                    <div class='col-md-12'>
                                        <div class='row'>
                                            
                                            <div class='col-md-6 form-group'>
                                                <label for='po_det_item'>Item</label>
                                                <select class='form-control select2' id='po_det_item' onchange="getSelectedProdUnitAdd()" style="width: 100%;">
                                                    <?=getBranchProduct()?>
                                                </select>
                                            </div>
                                            
                                            <div class='col-md-3 form-group'>
                                                <label for='po_det_unit'>Unit</label>
                                                <select class='form-control select2' id='po_det_unit' style="width: 100%;">
                                                </select>
                                            </div>
                                            
                                            <div class='col-md-3 form-group'>
                                                <label for='po_det_qty'>Qty</label>
                                                <input type='number' class='form-control' id='po_det_qty' placeholder='qty'autocomplete='off'>
                                            </div>

                                            <div class='col-md-3 form-group'>
                                                <label for='po_det_expiry'>Expiry date</label>
                                                <input type='date' class='form-control' id='po_det_expiry' placeholder='expiry' autocomplete='off'>
                                            </div>
                                        
                                            <div class='col-md-3 form-group'>
                                                <label for='po_det_price'>Cost</label>
                                                <input type='number' class='form-control' id='po_det_price' placeholder='Cost' autocomplete='off'>
                                            </div>
                                        
                                            <div class='col-md-3 form-group' style='display: flex;flex-direction: row;align-items: flex-end;'>
                                                <button type='button' onclick='savePoDetails()' id='po_add_detail' class='btn btn-success btn-md'>Add item</button>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class='col-12'>
                                        <table id='po_details_tbl' class='table table-bordered table-striped'>
                                            <thead>
                                                <tr>
                                                    <th class='no-sort' style='width: 25px;'></th>
                                                    <th style='width: 25px;'></th>
                                                    <th>ITEM NAME</th>
                                                    <th>UNIT</th>
                                                    <th>QTY</th>
                                                    <th style='width: 90px;'>PRICE</th>
                                                    <th style='width: 90px;'>BALANCE</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="6" style="padding: 3px !important;text-align: right !important;"><b>TOTAL : </b></td>
                                                    <td style="padding: 3px !important;text-align: right !important;"><b><span id="grandPoTotalAdd"></span></b></td>
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