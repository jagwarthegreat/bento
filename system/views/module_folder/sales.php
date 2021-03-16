<?php
$salesClass = new SalesClass();
echo $salesClass->header();
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
                        <button type="button" onclick="addPurchaseModal()" class="btn btn-secondary btn-sm">Add Sales</button>
                        <button type="button" id="delete_prod_btn" class="btn btn-danger btn-sm" onclick="cancelPo()">Close selected sales</button>
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
                        <th style="width: 100px;">SALES #</th>
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
    $('title').html("Sales");
    $(function() {
        loadSalesData();
    });

    function loadSalesCode() {
        $.post(controller + "generateRandomCode.php", {}, function(data, status) {
            // $('#po_code').val(data);
        });
    }
</script>