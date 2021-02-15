<?php
$ProductClass = new ProductClass();
echo $ProductClass->header();
?>


<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
    <div class="card-header">
        <div style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
            <div>
                
            </div>

            <div class="card-tools">
                <div class="align-right">
                    <button type="button" onclick="addProductModal()" class="btn btn-secondary btn-sm">Add product</button>
                    <button type="button" id="delete_prod_btn" class="btn btn-danger btn-sm" onclick="deleteProduct()">Delete selected product</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="prod_tbl" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="no-sort" style="width: 25px;"></th>
                    <th style="width: 25px;"></th>
                    <th>PRODUCT</th>
                    <th>PRODUCT CODE</th>
                    <th>CATEGORY</th>
                    <th style="width: 90px;">STATUS</th>
                    <th style="width: 40px;"></th>
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
    $('title').html("Product");
    $(function () {
        loadProductData();
    });

    const add_product_content = "<div class='col-12' style='padding: 15px; max-height: 400px; overflow: auto;'><div class='row'><div class='col-12' id='prod_modal_content'></div></div></div>";
    
    function loadProdCode() {
        $.post(controller+"generateRandomCode.php",{
        },function(data,status){
            $('#prod_code').val(data);
        });
        
    }

    function addProductModal() {
        loadProdCode();
        $('#product_add_modal').modal('show');
    }

    function saveProdChanges() {
        var prod_code = $('#prod_code').val();
        var prod_name = $('#prod_name').val();
        var prod_category = $('#prod_category').val();
        var branch_id = $('#current_branch_hidden').val();
        if(prod_code == "" || prod_name == "" || branch_id == ""){
            alertMe("error", "some field is missing...");
        }else{
            var prod_item_data = {
                branch: branch_id,
                code: prod_code,
                name: prod_name,
                category: prod_category
            };
            sql_data_add('tbl_products',prod_item_data, 'afterProdSave');
        }
    }

    function afterProdSave() {
        success_add();
        clearInputs();
        loadProductData();
    }

    function clearInputs() {
        location.reload();
    }

    function deleteProduct() {
        var count_checked = $("input[name='prod_checkbox']:checked").length;
        if(count_checked > 0){
            var checkedValues = $("input[name='prod_checkbox']:checked").map(function() {
                return this.value;
            }).get();
            id = [];

            var retVal = confirm("Are you sure to delete?");
            if(retVal){
                $("#delete_prod_btn").prop('disabled', true);
                $("#delete_prod_btn").html("<span class='fa fa-spin fa-spinner'></span> Deleting...");
                
                sql_data_delete('tbl_products','id IN('+checkedValues+')','afterProdDelete');
                
                $("#delete_prod_btn").prop('disabled', false);
                $("#delete_prod_btn").html("Delete selected product");
            }
        }
    }

    function afterProdDelete() {
        success_delete();
        loadProductData();
    }

    function prodDetails(code, id, name, cat_id) {
        modal_show('modal-lg','modal-md', 'Product details');
        $("#global-modal-content").html(add_product_content);
        $("#prod_modal_content").html("<div class='form-group'><label for='update_prod_code'>Product code</label><input type='text' class='form-control' id='update_prod_code' placeholder='product code' autocomplete='off' disabled='true' value='"+code+"'></div><div class='form-group'><label for='update_prod_name'>Product name</label><input type='text' class='form-control' id='update_prod_name' placeholder='product name' autocomplete='off' value='"+name+"'></div><div class='form-group'><label for='update_prod_category'>Product Category</label><select class='form-control select2' name='update_prod_category' id='update_prod_category' style='width: 100%;'></select></div><div class='d-flex' style='justify-content: space-between;'><div id='update_prod_modal_btn'></div><button type='button' class='btn btn-default btn-sm' id='update_prod_c_branch' onclick='modal_hide()'>Cancel</button></div>");

        $("#update_prod_modal_btn").html("<button type='button' onclick='updateProductData(\""+id+"\")' id='update_prod_sc_product' class='btn btn-primary btn-sm'>Update changes</button>");
        getProductCategorySelected('update_prod_category', cat_id);
    }

    function getProductCategorySelected(update_prod_category, selected_id) {
        $.post(controller+"getProductCategory.php",{
            selected: selected_id
        },function(data,status){
            $('#'+update_prod_category).html(data);
        });
    }

    function updateProductData(id) {
        var prod_name = $("#update_prod_name").val();
        var prod_cat = $("#update_prod_category").val();

        var prod_update_data = "name = '"+prod_name+"', category = '"+prod_cat+"'";
        $("#update_prod_sc_product").prop('disabled', true);
        $("#update_prod_sc_product").html("<span class='fa fa-spin fa-spinner'></span> Updating...");
        sql_data_update('tbl_products',prod_update_data, "id = '"+id+"'", 'afterEmpEdit');
        $("#update_prod_sc_product").prop('disabled', false);
        $("#update_prod_sc_product").html("Update changes");
    }

    function afterEmpEdit() {
        success_update();
        modal_hide();
        location.reload();
    }

    function setSrp(id, name, srp) {
        $('#set_srp_for').html(name);
        $('#selling_price').val(srp);
        $('#prod_srp_id').val(id);
        $('#set_prod_srp_modal').modal('show');
    }

    function saveSrpChanges() {
        var srp_id = $('#prod_srp_id').val();
        var srp_value = $('#selling_price').val();

        $.post(controller+"saveProdSrp.php",{
            prod_srp_id: srp_id,
            srp_value: srp_value
        },function(data,status){
            if(data == 1){
                success_add();
                loadProductData();
            }else{
                failed_query();
            }
        });
    }

    function loadProductData() {
        $("#prod_tbl").DataTable().destroy();
        $("#prod_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"product_data.php"
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        return "<input type='checkbox' name='prod_checkbox' value='"+row.id+"'>";
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
                            row.id,
                            "\""+row.name+"\"",
                            "\""+row.category_id+"\""
                        ];
                        return "<a href='#' onclick='prodDetails("+prod_data+")'>"+row.name+"</a>";
                    }
                },
                {
                    "data": "ref_code"
                },
                {
                    "data": "category_name"
                },
                {
                    "mRender": function(data,type,row){
                        const stats = (row.status == 0) ? '<span style="color: green;">Active</span>' : '<span style="color: gray;">Inactive</span>' ;
                        return stats;
                    },
                    "className": "text-center"
                },
                {
                    "mRender": function(data,type,row){
                        var for_srp_data = [
                            row.id,
                            "\""+row.name+"\"",
                            row.srp
                        ];

                        return "<a onclick='setSrp("+for_srp_data+")'><i class='nav-icon fa fa-tag' title='set SRP' style='color: #e09100;'></i></a>";
                    },
                    "className": "text-center"
                }
            ]
        });
    }
</script>