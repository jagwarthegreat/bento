<?php
$ProductCatClass = new ProductCatClass();
echo $ProductCatClass->header();
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
                    <button type="button" onclick="addProductCategoryModal()" class="btn btn-secondary btn-sm">Add category</button>
                    <button type="button" id="delete_prod_cat_btn" class="btn btn-danger btn-sm" onclick="deleteProductCat()">Delete selected category</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="cat_tbl" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="no-sort" style="width: 25px;"></th>
                    <th style="width: 25px;"></th>
                    <th>CATEGORY NAME</th>
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
    $('title').html("Product Category");
    $(function () {
        loadProductCatData();
    });

    const add_product_content = "<div class='col-12' style='padding: 15px; max-height: 400px; overflow: auto;'><div class='row'><div class='col-12' id='prod_modal_content'></div></div></div>";

    function addProductCategoryModal() {
        $('#cat_name').val("");
        $('#product_category_modal').modal('show');
    }

    function saveCatChanges() {
        var cat_name = $('#cat_name').val();
        if(cat_name == ""){
            alertMe("error", "some field is missing...");
        }else{
            $.post(controller+"addProductCategory.php",{
                cat_name: cat_name
            },function(data){
                if(data == 1){
                    alertMe("success", "Category added");
                }else if(data == 2){
                    alertMe("warning", "Category exist");
                }else{
                    alertMe("error", "Something went wrong!");
                }
                loadProductCatData();
            });
        }
    }

    function updateCatChanges() {
        const cat_dt_name = $('#cat_det_name').val();
        const cat_dt_id = $("#cat_detail_id").val();
        if(cat_dt_name == ""){
            alertMe("error", "some field is missing...");
        }else{
            $.post(controller+"updateProductCategory.php",{
                cat_dt_name: cat_dt_name,
                cat_dt_id: cat_dt_id
            },function(data){
                if(data == 1){
                    alertMe("success", "Category updated");
                }else if(data == 2){
                    alertMe("warning", "Category exist");
                }else{
                    alertMe("error", "Something went wrong!");
                }
                loadProductCatData();
            });
        }
    }

    function deleteProductCat() {
        var count_checked = $("input[name='cat_checkbox']:checked").length;
        if(count_checked > 0){
            var checkedValues = $("input[name='cat_checkbox']:checked").map(function() {
                return this.value;
            }).get();
            id = [];

            var retVal = confirm("Are you sure to delete?");
            if(retVal){
                $("#delete_prod_cat_btn").prop('disabled', true);
                $("#delete_prod_cat_btn").html("<span class='fa fa-spin fa-spinner'></span> Deleting...");
                
                sql_data_delete('tbl_product_category','id IN('+checkedValues+')','afterProdCatDelete');
                
                $("#delete_prod_cat_btn").prop('disabled', false);
                $("#delete_prod_cat_btn").html("Delete selected product");
            }
        }
    }

    function afterProdCatDelete() {
        alertMe("success", "Category deleted");
        loadProductCatData();
    }

    function prodCatDetails(id, name) {
        $('#cat_det_name').val(name);
        $("#cat_detail_id").val(id);
        $("#product_category_detail_modal").modal("show");
    }

    function loadProductCatData() {
        $("#cat_tbl").DataTable().destroy();
        $("#cat_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"product_category_data.php"
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        return "<input type='checkbox' name='cat_checkbox' value='"+row.id+"'>";
                    },
                    "className": "text-center"
                },
                {
                    "data": "count",
                    "className": "text-center"
                },
                {
                    "mRender": function(data,type,row){
                        var cat_data = [
                            row.id,
                            "\""+row.name+"\""
                        ];
                        return "<a href='#' onclick='prodCatDetails("+cat_data+")'>"+row.name+"</a>";
                    }
                }
            ]
        });
    }
</script>