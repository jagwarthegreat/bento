<?php
$BranchClass = new BranchClass();
echo $BranchClass->header();
?>


<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
    <div class="card-header">
        <div style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
            <h3 class="card-title"></h3>

            <div class="card-tools">
                <div class="align-right">
                    <button type="button" onclick="openModal()" class="btn btn-secondary btn-sm">Add branch</button>
                    <button type="button" id="delete_branch_btn" class="btn btn-danger btn-sm" onclick="deleteBranch()">Delete selected branch</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="branch_tbl" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="no-sort" style="width: 25px;"></th>
                    <th style="width: 25px;"></th>
                    <th>BRANCH NAME</th>
                    <th style="width: 90px;">STATUS</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        Footer
    </div>
    <!-- /.card-footer-->
    </div>
    <!-- /.card -->

</section>
<!-- /.content -->

<script>
    $('title').html("Branch");
    $(function () {
        loadBranchData();
    });

    const add_branch_content = "<div class='col-12' style='padding: 15px;'><div class='row'><div class='col-12'><div class='form-group'><label for='br_name'>Branch Name</label><input type='text' class='form-control' id='br_name' placeholder='Enter branch' autocomplete='off'></div><div class='d-flex' style='justify-content: space-between;'><div id='modal_crud_fun_btn'></div><button type='button' class='btn btn-default btn-sm' id='c_branch' onclick='modal_hide()'>Cancel</button></div></div></div></div>";

    function openModal(){
        modal_show('modal-lg','modal-md', 'Branch');
        $("#global-modal-content").html(add_branch_content);
        $('#modal_crud_fun_btn').html("<button type='button' onclick='saveChanges()' id='sc_branch' class='btn btn-success btn-sm'>Save changes</button>");
    }

    function saveChanges() {
        var br_name = $('#br_name').val();
        var item_data = {
            name: br_name
        };
        sql_data_add('tbl_branch',item_data, 'afterSave');
    }

    function afterSave() {
        success_add();
        clearInputs();
        loadBranchData();
    }

    function clearInputs() {
        $('#br_name').val('');
    }

    function deleteBranch() {
        var count_checked = $("input[name='checkbox']:checked").length;
        if(count_checked > 0){
            var checkedValues = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            id = [];

            var retVal = confirm("Are you sure to delete?");
            if(retVal){
                $("#delete_branch_btn").prop('disabled', true);
                $("#delete_branch_btn").html("<span class='fa fa-spin fa-spinner'></span> Deleting...");
                
                sql_data_delete('tbl_branch','branch_id IN('+checkedValues+')','afterBranchDelete');
                
                $("#delete_branch_btn").prop('disabled', false);
                $("#delete_branch_btn").html("Delete selected branch");
            }
        }
    }

    function afterBranchDelete() {
        success_delete();
        loadBranchData();
    }

    function branchDetail(id, name) {
        // console.log(id+" :: "+name);
        modal_show('modal-lg','modal-md', 'Branch details');
        $("#global-modal-content").html(add_branch_content);
        $('#br_name').val(name);
        $('#modal_crud_fun_btn').html("<button type='button' onclick='updateChanges("+id+")' id='sc_update_branch' class='btn btn-primary btn-sm'>Update changes</button>");
    }

    function updateChanges(id) {
        var br_update_name = $('#br_name').val();
        var item_update_data = "name = '"+br_update_name+"'";
        $("#sc_update_branch").prop('disabled', true);
        $("#sc_update_branch").html("<span class='fa fa-spin fa-spinner'></span> Updating...");
        sql_data_update('tbl_branch',item_update_data, "branch_id = '"+id+"'", 'afterEdit');
        $("#sc_update_branch").prop('disabled', false);
        $("#sc_update_branch").html("Update changes");
    }

    function afterEdit() {
        success_update();
        clearInputs();
        loadBranchData();
        modal_hide();
    }

    function loadBranchData() {
        $("#branch_tbl").DataTable().destroy();
        $("#branch_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"branch_data.php"
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        return "<input type='checkbox' name='checkbox' value='"+row.id+"'>";
                    },
                    "className": "text-center"
                },
                {
                    "data": "count",
                    "className": "text-center"
                },
                {
                    "mRender": function(data,type,row){
                        var dt_data = [
                            row.id,
                            "\""+row.br_name+"\""
                        ];
                        return "<a href='#' onclick='branchDetail("+dt_data+")'>"+row.br_name+"</a>";
                    }
                },
                {
                    "mRender": function(data,type,row){
                        const stats = (row.status == 0) ? '<span style="color: green;">Visible</span>' : '<span style="color: gray;">Hidden</span>' ;
                        return stats;
                    },
                    "className": "text-center"
                }
            ]
        });
    }
</script>