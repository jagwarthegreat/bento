<?php
$PurchaseClass = new PurchaseClass();
echo $PurchaseClass->header();
?>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
    <div class="card-header">
        <div style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
            <div></div>

            <div class="card-tools">
                <div class="align-right">
                    <input type="hidden" id="cur_po_id">
                    <button type="button" onclick="addPurchaseModal()" class="btn btn-secondary btn-sm">Add Purchase</button>
                    <button type="button" id="delete_prod_btn" class="btn btn-danger btn-sm" onclick="cancelPo()">Close selected po</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="po_tbl" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="no-sort" style="width: 25px;"></th>
                    <th style="width: 25px;"></th>
                    <th style="width: 100px;">PURCHASE #</th>
                    <th style="width: 100px;">DATE</th>
                    <th>REMARKS</th>
                    <th style="width: 90px;">STATUS</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<script>
    $('title').html("Purchase");
    $(function () {
        loadPurchaseData();
        $("#modal_width_po").css("max-width", "30%");
        $("#po_detail_form").hide();
    });
    
    function addPurchaseModal() {
        loadPoCode();
        $("#cur_po_id").val('');
        clearDetailInputs();
        $("#purchase_modal").modal('show');
        loadPurchaseDetails();
    }

    function modal_hide_po(){
        // show_side_content();
        location.reload();
        $("#purchase_modal").modal('hide');
    }

    function modal_hide_update_po(){
        // show_side_content();
        $("#purchase_detail_modal").modal('hide');
    }

    function savePoChanges() {
        var po_code = $("#po_code").val();
        var po_date = $("#po_date").val();
        var po_remarks = $("#po_remarks").val();
        $.post(controller+"save_po_header.php",{
            po_code: po_code,
            po_date: po_date,
            po_remarks: po_remarks
        },function(data,status){
            if(data > 0){
                $("#cur_po_id").val(data);
                success_add();
                clearDetailInputs();
                loadPurchaseData();
                $("#po_detail_form").show();
                $("#modal_width_po").css("max-width", "80%");
                disablePoHeader();
            }else{
                failed_query();
            }
        });
    }

    function savePoDetails() {
        var po_det_item = $("#po_det_item").val();
        var po_det_qty = $("#po_det_qty").val();
        var po_det_unit = $("#po_det_unit").val();
        var po_det_expiry = $("#po_det_expiry").val();
        var po_det_price = $("#po_det_price").val();
        var po_header_id = $("#cur_po_id").val();

        if(po_det_unit < 1 || po_det_item == "" || po_det_unit == "" || po_det_price == ""){
            alertMe("error", "some field is missing...");
        }else{
            $.post(controller+"save_po_details.php",{
                po_det_item: po_det_item,
                po_det_qty: po_det_qty,
                po_det_unit: po_det_unit,
                po_det_expiry: po_det_expiry,
                po_det_price: po_det_price,
                po_header_id: po_header_id
            },function(data,status){
                if(data == 1){
                    success_add();
                    clearDetailInputs();
                    loadPurchaseDetails();
                }else{
                    failed_query();
                }
            });
        }
    }

    function savePoUpdateDetails() {
        var update_po_det_item = $("#update_po_det_item").val();
        var update_po_det_qty = $("#update_po_det_qty").val();
        var update_po_det_unit = $("#update_po_det_unit").val();
        var update_po_det_expiry = $("#update_po_det_expiry").val();
        var update_po_det_price = $("#update_po_det_price").val();
        var po_header_id = $("#cur_po_id").val();

        $.post(controller+"save_po_details.php",{
            po_det_item: update_po_det_item,
            po_det_qty: update_po_det_qty,
            po_det_unit: update_po_det_unit,
            po_det_expiry: update_po_det_expiry,
            po_det_price: update_po_det_price,
            po_header_id: po_header_id
        },function(data,status){
            if(data == 1){
                success_add();
                $("#update_po_det_qty").val('');
                $("#update_po_det_expiry").val('');
                $("#update_po_det_price").val('');
                purchaseDetailsView(po_header_id);
            }else{
                failed_query();
            }
        });
    }

    function updatePoChanges() {
        var po_up_date = $('#update_po_date').val();
        var po_up_remarks = $('#update_po_remarks').val();
        var po_header_id = $("#cur_po_id").val();

        var br_id = $('#current_branch_hidden').val();
        var po_update_data = "remarks = '"+po_up_remarks+"', date = '"+po_up_date+"'";
        sql_data_update('tbl_purchase_header',po_update_data, "id = '"+po_header_id+"'", 'afterUpdatePo');
    }

    function afterUpdatePo() {
        success_add();
        loadPurchaseData();
    }

    function disablePoHeader() {
        $("#po_date").prop("disabled", true);
        $("#po_remarks").prop("disabled", true);
        $("#sc_po_header_btn").hide();
    }

    function clearDetailInputs() {
        $("#po_det_qty").val('');
        $("#po_det_price").val('');
        $("#po_det_expiry").val('');
    }

    function loadPoCode() {
        $.post(controller+"generateRandomCode.php",{
        },function(data,status){
            $('#po_code').val(data);
        });
    }

    function getPoDetails(ref_code, id) {
        $("#cur_po_id").val(id);
        $("#purchase_detail_modal").modal('show');
        purchaseHeaderView(id);
        purchaseDetailsView(id);
    }

    function purchaseHeaderView(id) {
        $.post(controller+"po_header_data.php",{
            id: id
        },function(data,status){
            console.log(data);
            var poHeadList_json = JSON.parse(data); 
            var po_up_list = poHeadList_json[0];
            
            if(po_up_list.status == 0){
                $("#isFinish").html("<button type='button' onclick='finishPO()' id='finish_po_btn' class='btn btn-success btn-sm'>Finish this Purchase Order</button>");

                $("#po_detail_info_section").css("display","inline-block");
                $("#sc_update_po_header_btn").css("display","inline-block");
                $("#update_po_date").prop("disabled", false);
                $("#update_po_remarks").prop("disabled", false);
            }else{
                $("#isFinish").html("");
                $("#po_detail_info_section").css("display","none");
                $("#sc_update_po_header_btn").css("display","none");
                $("#update_po_date").prop("disabled", true);
                $("#update_po_remarks").prop("disabled", true);
            }
               

            $('#update_po_code').val(po_up_list.ref_code);
            $('#update_po_date').val(po_up_list.date);
            $('#update_po_remarks').val(po_up_list.remarks);
        });
    }

    function removePoItem(id) {
        var po_header_id = $("#cur_po_id").val();
        var retVal = confirm("Are you sure to delete?");
        if(retVal){
            sql_data_delete('tbl_purchase_detail', "id = '"+id+"' AND po_header_id = '"+po_header_id+"'",'afterPoItemDelete',[po_header_id]);
        }
    }

    function afterPoItemDelete(id) {
        success_delete();
        purchaseDetailsView(id);
    }

    function removePoItemADD(id) {
        var po_header_id = $("#cur_po_id").val();
        var retVal = confirm("Are you sure to delete?");
        if(retVal){
            sql_data_delete('tbl_purchase_detail', "id = '"+id+"' AND po_header_id = '"+po_header_id+"'",'afterPoItemDeleteADD',[po_header_id]);
        }
    }

    function afterPoItemDeleteADD() {
        success_delete();
        loadPurchaseDetails();
    }

    function finishPO() {
        var po_header_id = $("#cur_po_id").val();
        var retVal = confirm("Are you sure to finish this PO?");
        if(retVal){
            $("#finish_po_btn").prop('disabled', true);
            $("#finish_po_btn").html("<span class='fa fa-spin fa-spinner'></span> loading...");

            var po_finish_data = "status = 1";
            sql_data_update('tbl_purchase_header',po_finish_data, "id = '"+po_header_id+"'", 'afterFinish', [po_header_id]);

            $("#finish_po_btn").prop('disabled', false);
            $("#finish_po_btn").html("Finish this Purchase Order");
        }
    }

    function afterFinish(id) {
        $("#po_detail_info_section").css("display","none");
        $("#sc_update_po_header_btn").css("display","none");
        $("#update_po_date").prop("disabled", true);
        $("#update_po_remarks").prop("disabled", true);
        $("#isFinish").html("");
        purchaseDetailsView(id);
        loadPurchaseData();
    }

    function getSelectedProdUnitUpdate() {
        var selected_po_item = $("#update_po_det_item").val();
        $.post(controller+"getSelectedProdUnit.php",{
            selected_po_item: selected_po_item
        },function(data,status){
            $("#update_po_det_unit").html(data);
        });
    }

    function getSelectedProdUnitAdd() {
        var selected_po_item_add = $("#po_det_item").val();
        $.post(controller+"getSelectedProdUnit.php",{
            selected_po_item: selected_po_item_add
        },function(data,status){
            $("#po_det_unit").html(data);
        });
    }
    
    function cancelPo() {
        var cancel_po_checks = $(".po_rmv:checkbox:checked").map(function() {
            return this.value;
        }).get();

        if(cancel_po_checks.length < 1){
            alert("No item selected");
        }else{
            // console.log(cancel_po_checks);
            $.post(controller+"cancel_po.php", {
                cancel_po_checks: cancel_po_checks
            },function(data) {
                if(data == 1){
                    alert("Purchase was closed!");
                    loadPurchaseData();
                }else{
                    alert("Something went wrong");
                }
            });
        }
    }

    function purchaseDetailsView(id) {
        $("#grandPoTotal").html("");
        $("#update_po_details_tbl").DataTable().destroy();
        $("#update_po_details_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": false,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"po_detail_data.php",
                data : {
                    po_header_id: id
                }
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        $("#grandPoTotal").html(row.grandPoTotal);
                        var isSaved = (row.status == 0)?"<i class='nav-icon fa fa-trash' onclick='removePoItem("+row.id+")' style='color: red;cursor: pointer;'></i>":"";
                        return isSaved;
                    },
                    "className": "text-center"
                },
                {
                    "data": "count",
                    "className": "text-center"
                },
                {
                    "data": "prod_name"
                },
                {
                    "data": "unit"
                },
                {
                    "data": "qty",
                    "className": "text-right"
                },
                {
                    "data": "price",
                    "className": "text-right"
                },
                {
                    "data": "subtotal",
                    "className": "text-right"
                }
            ]
        });
    }

    function loadPurchaseDetails() {
        var po_header_id = $('#cur_po_id').val();
        $("#po_details_tbl").DataTable().destroy();
        $("#po_details_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": false,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"po_detail_data.php",
                data : {
                    po_header_id: po_header_id
                }
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        $("#grandPoTotalAdd").html(row.grandPoTotal);
                        var isSaved = (row.status == 0)?"<i class='nav-icon fa fa-trash' onclick='removePoItemADD("+row.id+")' style='color: red;cursor: pointer;'></i>":"";
                        return isSaved;
                    },
                    "className": "text-center"
                },
                {
                    "data": "count",
                    "className": "text-center"
                },
                {
                    "data": "prod_name"
                },
                {
                    "data": "unit"
                },
                {
                    "data": "qty"
                },
                {
                    "data": "price"
                },
                {
                    "data": "subtotal",
                    "className": "text-right"
                }
            ]
        });
    }

    function loadPurchaseData() {
        $("#po_tbl").DataTable().destroy();
        $("#po_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"po_data.php"
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        var checkbx = (row.status != 0)?"<input type='hidden' value='"+row.id+"'>":"<input class='po_rmv' type='checkbox' name='po_checkbox' value='"+row.id+"'>";
                        return checkbx;
                        
                    },
                    "className": "text-center"
                },
                {
                    "data": "count",
                    "className": "text-center"
                },
                {
                    "mRender": function(data,type,row){
                        var prod_data = [
                            "\""+row.ref_code+"\"",
                            row.id
                        ];
                        return "<a href='#' onclick='getPoDetails("+prod_data+")'>"+row.ref_code+"</a>";
                    },
                    "className": "text-center"
                },
                {
                    "data": "date"
                },
                {
                    "data": "remarks"
                },
                {
                    "mRender": function(data,type,row){
                        const stats = (row.status == 0) ? '<span style="color: orange;">Pending</span>' : (row.status == 2)?'<span style="color: red;">Closed</span>':'<span style="color: green;">Finish</span>';
                        return stats;
                    },
                    "className": "text-center"
                }
            ]
        });
    }
</script>