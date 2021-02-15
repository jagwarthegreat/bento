<?php
$ProductUnitClass = new ProductUnitClass();
echo $ProductUnitClass->header();
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
                    <button type="button" onclick="addProductUnitModal()" class="btn btn-secondary btn-sm">Add unit</button>
                    <button type="button" id="delete_prod_unit_btn" class="btn btn-danger btn-sm" onclick="deleteProductUnit()">Delete selected unit</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="unit_tbl" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="no-sort" style="width: 25px;"></th>
                    <th style="width: 25px;"></th>
                    <th>UNIT NAME</th>
                    <th>QUANTITY</th>
                    <th>CATEGORY</th>
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
    $('title').html("Product Unit");
    $(function () {
        loadProductUnitData();
    });

    const add_product_content = "<div class='col-12' style='padding: 15px; max-height: 400px; overflow: auto;'><div class='row'><div class='col-12' id='prod_modal_content'></div></div></div>";

    function addProductUnitModal() {
        $('#unit_name').val("");
        $('#unit_qty').val("");
        $('#unit_category').val("");
        $('#product_unit_modal').modal('show');
    }

    function saveUnitChanges() {
        var unit_name = $('#unit_name').val();
        var unit_qty = $('#unit_qty').val();
        var unit_category = $('#unit_category').val();
        if(unit_name == "" || unit_qty == "" || unit_category == ""){
            alertMe("error", "some field is missing...");
        }else{
            $.post(controller+"addProductUnit.php",{
                unit_name: unit_name,
                unit_qty: unit_qty,
                unit_category: unit_category
            },function(data){
                if(data == 1){
                    alertMe("success", "Unit added");
                }else if(data == 2){
                    alertMe("warning", "Unit exist");
                }else{
                    alertMe("error", "Something went wrong!");
                }
                loadProductUnitData();
            });
        }
    }

    function updateUnitChanges() {
        const d_unit_name = $('#d_unit_name').val();
        const d_unit_qty = $("#d_unit_qty").val();
        const d_unit_category = $("#d_unit_category").val();
        const d_unit_id = $("#d_unit_id").val();
        if(d_unit_name == "" || d_unit_qty == "" || d_unit_category == ""){
            alertMe("error", "some field is missing...");
        }else{
            $.post(controller+"updateProductUnit.php",{
                d_unit_name: d_unit_name,
                d_unit_qty: d_unit_qty,
                d_unit_category: d_unit_category,
                d_unit_id: d_unit_id
            },function(data){
                if(data == 1){
                    alertMe("success", "Unit updated");
                }else if(data == 2){
                    alertMe("warning", "Unit exist");
                }else{
                    alertMe("error", "Something went wrong!");
                }
                loadProductUnitData();
            });
        }
    }

    function deleteProductUnit() {
        var count_checked = $("input[name='unit_checkbox']:checked").length;
        if(count_checked > 0){
            var checkedValues = $("input[name='unit_checkbox']:checked").map(function() {
                return this.value;
            }).get();
            id = [];

            var retVal = confirm("Are you sure to delete?");
            if(retVal){
                $("#delete_prod_unit_btn").prop('disabled', true);
                $("#delete_prod_unit_btn").html("<span class='fa fa-spin fa-spinner'></span> Deleting...");
                
                sql_data_delete('tbl_product_unit','id IN('+checkedValues+')','afterProdUnitDelete');
                
                $("#delete_prod_unit_btn").prop('disabled', false);
                $("#delete_prod_unit_btn").html("Delete selected product");
            }
        }
    }

    function afterProdUnitDelete() {
        alertMe("success", "Unit deleted");
        loadProductUnitData();
    }

    function prodUnitDetails(id, name, qty, cat_id) {
        $('#d_unit_name').val(name);
        $("#d_unit_qty").val(qty);
        $("#d_unit_id").val(id);
        getProductUnitCategory(cat_id);
        $("#product_unit_detail_modal").modal("show");
    }

    function getProductUnitCategory(selected_id) {
        $.post(controller+"getProductUnitCategory.php",{
            selected: selected_id
        },function(data,status){
            $('#d_unit_category').html(data);
        });
    }

    function loadProductUnitData() {
        $("#unit_tbl").DataTable().destroy();
        $("#unit_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"product_unit_data.php"
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        return "<input type='checkbox' name='unit_checkbox' value='"+row.id+"'>";
                    },
                    "className": "text-center"
                },
                {
                    "data": "count",
                    "className": "text-center"
                },
                {
                    "mRender": function(data,type,row){
                        var unit_data = [
                            row.id,
                            "\""+row.name+"\"",
                            row.qty,
                            row.category_id
                        ];
                        return "<a href='#' onclick='prodUnitDetails("+unit_data+")'>"+row.name+"</a>";
                    }
                },
                {
                    "data": "qty"
                },
                {
                    "data": "category"
                },
            ]
        });
    }
</script>