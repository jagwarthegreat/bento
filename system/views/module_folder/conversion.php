<?php
$ProductConvertClass = new ProductConvertClass();
echo $ProductConvertClass->header();
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
                    <input type="hidden" id="cur_pc_id">
                    <button type="button" onclick="addConvertModal()" class="btn btn-secondary btn-sm">Add Product Conversion</button>
                    <button type="button" id="delete_prod_btn" class="btn btn-danger btn-sm" onclick="cancelConversion()">Cancel selected conversion</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="prod_convert_tbl" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="no-sort" style="width: 25px;"></th>
                    <th style="width: 25px;"></th>
                    <th style="width: 110px;">CONVERT #</th>
                    <th>BRANCH</th>
                    <th>ITEM</th>
                    <th style="width: 150px;">FROM UNIT</th>
                    <th style="width: 150px;">TO UNIT</th>
                    <th style="width: 70px;">STATUS</th>
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
    $('title').html("Conversion");
    $(function () {
        loadConversionData();
        $("#modal_width_po").css("max-width", "30%");
        $("#pc_detail_form").hide();
    });
    
    function addConvertModal() {
        loadConvertCode();
        $("#conversion_modal").modal('show');
    }

    function modal_hide_pc(){
        // show_side_content();
        $("#conversion_modal").modal('hide');
    }

    function modal_hide_pc_detail(){
        // show_side_content();
        $("#conversion_detail_modal").modal('hide');
    }

    function loadConvertCode() {
        $.post(controller+"generateRandomCode.php",{
        },function(data,status){
            $('#convert_code').val("RPCK-"+data);
        });
    }

    function computeConvertedQty(type) {
        var convert_from_qty = (type == "ADD")?$("#convert_from_qty").val():$("#dt_convert_from_qty").val();
        var convert_from_unit = (type == "ADD")?$("#convert_from_unit").val():$("#dt_convert_from_unit").val();
        var convert_to_unit = (type == "ADD")?$("#convert_to_unit").val():$("#dt_convert_to_unit").val();
        var convert_to_qty = (type == "ADD")?$("#convert_to_qty").val():$("#dt_convert_to_qty").val();
        var convert_product = (type == "ADD")?$("#convert_product").val():$("#dt_convert_product").val();
        
        // var convert_date = $("#convert_date").val();
        // var convert_code = $("#convert_code").val();
        // alert(convert_from_qty+" : "+convert_from_unit+" : "+convert_to_unit+" : "+convert_to_qty+" : "+convert_date+" : "+convert_code);
        if(convert_product == "" || convert_to_unit == "" || convert_from_unit == ""){
            alertMe("error", "some field is missing...");
        }else{
            $.post(controller+"compute_converted_unit.php",{
                convert_from_unit: convert_from_unit,
                convert_from_qty: convert_from_qty,
                convert_to_unit: convert_to_unit,
                convert_to_qty: convert_to_qty
            },function(data){
                if(type == "ADD"){
                    $("#convert_to_qty").val(data);
                }else{
                    $("#dt_convert_to_qty").val(data);
                }
            });
        }
    }

    function convertProduct() {
        var conv_from_qty = $("#convert_from_qty").val();
        var conv_from_unit = $("#convert_from_unit").val();
        var conv_to_unit = $("#convert_to_unit").val();
        var conv_to_qty = $("#convert_to_qty").val();
        var conv_product = $("#convert_product").val();
        var conv_date = $("#convert_date").val();
        var conv_code = $("#convert_code").val();

        if(conv_product == "" || conv_to_unit == "" || conv_from_unit == ""){
            alertMe("error", "some field is missing...");
        }else{
            $.post(controller+"add_product_convert.php",{
                conv_from_unit: conv_from_unit,
                conv_from_qty: conv_from_qty,
                conv_to_unit: conv_to_unit,
                conv_to_qty: conv_to_qty,
                conv_date: conv_date,
                conv_code: conv_code,
                conv_product: conv_product
            },function(data){
                if(data == 1){
                    loadConversionData();
                    $("#conversion_modal").modal('hide');
                }else{
                    alertme("error","Something wrong");
                }
            });
        }
    }

    function updateProductConvert() {
        var dt_conv_from_qty = $("#dt_convert_from_qty").val();
        var dt_conv_from_unit = $("#dt_convert_from_unit").val();
        var dt_conv_to_unit = $("#dt_convert_to_unit").val();
        var dt_conv_to_qty = $("#dt_convert_to_qty").val();
        var dt_conv_product = $("#dt_convert_product").val();
        var dt_conv_date = $("#dt_convert_date").val();
        var dt_conv_code = $("#dt_convert_code").val();

        if(dt_conv_product == "" || dt_conv_to_unit == "" || dt_conv_from_unit == ""){
            alertMe("error", "some field is missing...");
        }else{
            $.post(controller+"update_product_convert.php",{
                dt_conv_from_unit: dt_conv_from_unit,
                dt_conv_from_qty: dt_conv_from_qty,
                dt_conv_to_unit: dt_conv_to_unit,
                dt_conv_to_qty: dt_conv_to_qty,
                dt_conv_date: dt_conv_date,
                dt_conv_code: dt_conv_code,
                dt_conv_product: dt_conv_product
            },function(data){
                if(data == 1){
                    loadConversionData();
                    $("#conversion_detail_modal").modal('hide');
                }else{
                    alertme("error","Something wrong");
                }
            });
        }
    }

    function convertProdSelectedAdd(type) {
        var selected_conversion_prod= (type == "ADD")?$("#convert_product").val():$("#dt_convert_product").val();
        $.post(controller+"getSelectedProdUnit.php",{
            selected_po_item: selected_conversion_prod
        },function(data,status){
            if(type == "ADD"){
                $("#convert_from_unit").html(data);
                $("#convert_to_unit").html(data);
            }else{
                $("#dt_convert_from_unit").html(data);
                $("#dt_convert_to_unit").html(data);
            }
        });
    }

    function getPcDetails(ref_code, id) {
        pc_detail_data(id);
        $("#conversion_detail_modal").modal('show');
    }

    function pc_detail_data(id) {
        $.post(controller+"conversion_data.php",{
            id: id
        },function(data){
            var conversion_json = JSON.parse(data);
            var convert_list = conversion_json[0];
            $("#dt_convert_from_qty").val(convert_list.from_qty);
            // $("#dt_convert_from_unit").val(convert_list.from_unit);
            // $("#dt_convert_to_unit").val(convert_list.to_unit);
            $("#dt_convert_to_qty").val(convert_list.to_qty);
            // $("#dt_convert_product").val(convert_list.prod_id);
            // convertProdSelectedAdd('DT');
            getConvertProd(convert_list.prod_id);
            getUnitFrom(convert_list.prod_id, convert_list.from_unit);
            getUnitTo(convert_list.prod_id, convert_list.to_unit);
            $("#dt_convert_date").val(convert_list.convert_date);
            $("#dt_convert_code").val(convert_list.ref_code);
        });
    }
    
    function getConvertProd(selected) {
        $.post(controller+"conv_prod_data.php",{
            selected: selected
        },function(data){
            $("#dt_convert_product").html(data);
        });
    }

    function getUnitFrom(prod_id, from_unit_id) {
        $.post(controller+"getUnitFromData.php",{
            prod_id: prod_id,
            from_unit_id: from_unit_id
        },function(data){
            $("#dt_convert_from_unit").html(data);
        });
    }

    function getUnitTo(prod_id, to_unit_id) {
        $.post(controller+"getUnitToData.php",{
            prod_id: prod_id,
            to_unit_id: to_unit_id
        },function(data){
            $("#dt_convert_to_unit").html(data);
        });
    }

    function removePoItem(id) {
        var pc_header_id = $("#cur_pc_id").val();
        var retVal = confirm("Are you sure to delete?");
        if(retVal){
            sql_data_delete('tbl_purchase_detail', "id = '"+id+"' AND pc_header_id = '"+pc_header_id+"'",'afterPoItemDelete',[pc_header_id]);
        }
    }

    function afterPoItemDelete(id) {
        success_delete();
        purchaseDetailsView(id);
    }

    function finishPO() {
        var pc_header_id = $("#cur_pc_id").val();
        var retVal = confirm("Are you sure to finish this PO?");
        if(retVal){
            $("#finish_pc_btn").prop('disabled', true);
            $("#finish_pc_btn").html("<span class='fa fa-spin fa-spinner'></span> loading...");

            var pc_finish_data = "status = 1";
            sql_data_update('tbl_purchase_header',pc_finish_data, "id = '"+pc_header_id+"'", 'afterFinish', [pc_header_id]);

            $("#finish_pc_btn").prop('disabled', false);
            $("#finish_pc_btn").html("Finish this Purchase Order");
        }
    }

    function afterFinish(id) {
        $("#pc_detail_info_section").css("display","none");
        $("#sc_update_pc_header_btn").css("display","none");
        $("#update_pc_date").prop("disabled", true);
        $("#update_pc_remarks").prop("disabled", true);
        $("#isFinish").html("");
        purchaseDetailsView(id);
        loadConversionData();
    }

    function cancelConversion() {
        var cancel_convert_checks = $(".conversion_checkbox:checkbox:checked").map(function() {
            return this.value;
        }).get();

        if(cancel_convert_checks.length < 1){
            alert("No item selected");
        }else{
            // console.log(cancel_convert_checks);
            $.post(controller+"cancel_conversion.php", {
                cancel_convert_checks: cancel_convert_checks
            },function(data) {
                if(data == 1){
                    alert("Conversion was closed!");
                    loadConversionData();
                }else{
                    alert("Something went wrong");
                }
            });
        }
    }

    function loadConversionData() {
        $("#prod_convert_tbl").DataTable().destroy();
        $("#prod_convert_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"convert_data.php"
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        var checCOnvertBox = (row.status != 0)?"<input type='hidden' value='"+row.id+"'>":"<input type='checkbox' class='conversion_checkbox' value='"+row.id+"'>";
                        return checCOnvertBox;
                    },
                    "className": "text-center"
                },
                {
                    "data": "count",
                    "className": "text-center"
                },
                {
                    "mRender": function(data,type,row){
                        var conv_data = [
                            "\""+row.ref_code+"\"",
                            row.id
                        ];
                        return "<a href='#' onclick='getPcDetails("+conv_data+")'>"+row.ref_code+"</a>";
                    },
                    "className": "text-center"
                },
                {
                    "data": "branch_name"
                },
                {
                    "data": "prod_name"
                },
                {
                    "data": "from_unit"
                },
                {
                    "data": "to_unit"
                },
                {
                    "mRender": function(data,type,row){
                        const stats = (row.status == 1) ? '<span style="color: green;">Finish</span>' : (row.status == 2)?'<span style="color: red;">Closed</span>':'<span style="color: orange;">Pending</span>';
                        return stats;
                    },
                    "className": "text-center"
                }
            ]
        });
    }
</script>