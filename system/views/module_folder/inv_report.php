<?php
$ProdInvClass = new ProdInvClass();
echo $ProdInvClass->header();
?>
<style>
    .table td {
        padding: 4px !important;
    }
</style>
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
    <div class="card-header">
        <div style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
            <div style="display: flex;flex-direction: row;align-items: flex-end;">
                <div class='form-group mr-1'>
                    <label for='inv_date'>Inventory date</label>
                    <input type="date" class="form-control" id="inv_date">
                </div>
                <div class='form-group mr-1'>
                    <label for='inv_cat'>Category</label>
                    <select class="form-control select2" name="inv_cat" id="inv_cat" style="width: 100%;"><?=getProdCategory()?></select>
                </div>
                <div class='form-group mr-1'>
                    <label for='gen_inv'></label>
                    <button type="button" class="btn btn-secondary btn-md" id="gen_inv" onclick="generateReport()">Generate report</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body" id="inv_content">
        
    </div>
    <!-- /.card-body -->

    </div>
    <!-- /.card -->

</section>
<!-- /.content -->
<script>
    $("title").html("Inventory Report");
    function generateReport() {
        var inv_date = $('#inv_date').val();
        var inv_cat = $('#inv_cat').val();
        $('#inv_content').html("<center>generating report</center>");
        $.post(controller+"gen_inv.php",{
            date: inv_date,
            cat: inv_cat
        },function(data,status){
            var inv_json = JSON.parse(data); 
            // var inv_list = inv_json[0];
            var skin_inv = "", item_qty = [];

            skin_inv += '<table id="po_tbl" class="table table-bordered table-striped"><thead>';
            skin_inv += '<tr>';
            skin_inv += '<th>STOCK</th>';
            skin_inv += '<th class="text-right" style="width: 120px;">SELLING PRICE</th>';
            for (var i = 0; i < inv_json.unit.length; ++i){
                var unit_list = inv_json.unit[i];
                skin_inv += '<th class="text-right" style="width: 100px;">'+unit_list.package_name+'</th>';
            }
            skin_inv += '<th class="text-right" style="width: 120px;">BALANCE</th>';
            skin_inv += '</tr>';

            for (var item = 0; item < inv_json.items.length; ++item){
                var item_list = inv_json.items[item];
                skin_inv += '<tr>';
                skin_inv += '<td>'+item_list.product_name+'</td>';
                var isSrpZero = (item_list.srp > 0)?item_list.srp:0;
                skin_inv += '<td class="text-right">'+isSrpZero+'</td>';
                for (var i = 0; i < inv_json.unit.length; ++i){
                    var unit_list = inv_json.unit[i];

                    var isQtyZero = (item_list.inv[unit_list.package_id] > 0)?item_list.inv[unit_list.package_id]:'';
                    skin_inv += '<td class="text-right">'+isQtyZero+'</td>';
                }
                skin_inv += '<td class="text-right">'+item_list.balance+'</td>';
                skin_inv += '</tr>';
            }

           
            var gt_span = inv_json.grandTotal[0].gt_span + 2;
            var gt_end = inv_json.grandTotal[0].ending;
            skin_inv += '<tr>';
            skin_inv += '<td colspan="'+gt_span+'" class="text-right"><b>TOTAL : </b></td>';
            skin_inv += '<td class="text-right"><b>'+gt_end+'</b></td>';
            skin_inv += '</tr>';
            
            skin_inv += '</thead><tbody></tbody></table>';

            $('#inv_content').html(skin_inv);
        });
    }
</script>