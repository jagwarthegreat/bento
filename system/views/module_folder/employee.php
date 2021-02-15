<?php
$EmployeeClass = new EmployeeClass();
echo $EmployeeClass->header();
?>


<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
    <div class="card-header">
        <div style="display: flex;flex-direction: row;justify-content: space-between;align-items: center;">
        <button type="button" onclick="openEmpPositionModal()" class="btn btn-primary btn-sm">Employee Position</button>

            <div class="card-tools">
                <div class="align-right">
                    <button type="button" onclick="openModal()" class="btn btn-secondary btn-sm">Add employee</button>
                    <button type="button" id="delete_emp_btn" class="btn btn-danger btn-sm" onclick="deleteEmployee()">Delete selected employee</button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table id="emp_tbl" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th class="no-sort" style="width: 25px;"></th>
                    <th style="width: 25px;"></th>
                    <th>EMPLOYEE NAME</th>
                    <th>CONTACT</th>
                    <th>POSITION</th>
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
    $('title').html("Employee");
    $(function () {
        loadEmployeeData();
    });

    const add_employee_content = "<div class='col-12' style='padding: 15px; max-height: 400px; overflow: auto;'><div class='row'><div class='col-12' id='emp_modal_content'></div></div></div>";

    function openEmpPositionModal() {
        modal_show('modal-md','modal-xl', 'Employee position');
        const add_emp_position_content = "<div class='col-12' style='padding: 15px; max-height: 400px; overflow: auto;'><div class='row'>on development</div></div>";
        $("#global-modal-content").html(add_emp_position_content);
    }

    function openModal(){
        loadEmpCode();
        modal_show('modal-lg','modal-md', 'Employee entry');

        $("#global-modal-content").html(add_employee_content);
        $("#emp_modal_content").html("<div class='form-group'><label for='emp_code'>Employee code</label><input type='text' class='form-control' id='emp_code' placeholder='employee code' autocomplete='off' disabled='true'></div><div class='form-group'><label for='emp_full_name'>Full Name</label><input type='text' class='form-control' id='emp_full_name' placeholder='Enter fullname' autocomplete='off'></div><div class='form-group'><label for='emp_address'>Address</label><input type='text' class='form-control' id='emp_address' placeholder='Enter address' autocomplete='off'></div><div class='form-group d-flex' style='flex-direction: column;'><label for='emp_class'>Position</label><select class='form-control select2' id='emp_position'></select></div><div class='form-group'><label for='emp_contact'>Contact</label><input type='number' class='form-control' id='emp_contact' placeholder='Enter contact' autocomplete='off'></div><div class='form-group'><label for='emp_datehired'>Date hired</label><input type='date' class='form-control' id='emp_datehired' autocomplete='off'></div><div class='d-flex' style='justify-content: space-between;'><div id='emp_modal_btn'></div><button type='button' class='btn btn-default btn-sm' id='c_branch' onclick='modal_hide()'>Cancel</button></div>");
        $("#emp_modal_btn").html("<button type='button' onclick='saveEmpChanges()' id='emp_sc_branch' class='btn btn-success btn-sm'>Save changes</button>");
        getEmployeePosition('emp_position', '');
        $('#emp_position').select2();
    }

    function getEmployeePosition(emp_position, selected_id) {
        $.post(controller+"getEmployeePosition.php",{
            selected: selected_id
        },function(data,status){
            $('#'+emp_position).html(data);
        });
    }

    function empDetails(id) {
        modal_show('modal-lg','modal-md', 'Employee details');

        $.post(controller+"employee_single_data.php",{
            id: id
        },function(data,status){
            var list_json = JSON.parse(data); 
            var emp_list = list_json[0];
            
            $("#global-modal-content").html(add_employee_content);
            $("#emp_modal_content").html("<div class='form-group'><label for='update_emp_code'>Employee code</label><input type='text' class='form-control' id='update_emp_code' placeholder='employee code' autocomplete='off' disabled='true' value='"+emp_list.ref_code+"'></div><div class='form-group'><label for='update_emp_full_name'>Full Name</label><input type='text' class='form-control' id='update_emp_full_name' placeholder='Enter fullname' autocomplete='off' value='"+emp_list.fullname+"'></div><div class='form-group'><label for='update_emp_address'>Address</label><input type='text' class='form-control' id='update_emp_address' placeholder='Enter address' autocomplete='off' value='"+emp_list.address+"'></div><div class='form-group d-flex' style='flex-direction: column;'><label for='update_emp_position'>Position</label><select class='form-control select2' id='update_emp_position'></select></div><div class='form-group'><label for='update_emp_contact'>Contact</label><input type='number' class='form-control' id='update_emp_contact' placeholder='Enter contact' autocomplete='off' value='"+emp_list.contact+"'></div><div class='form-group'><label for='update_emp_datehired'>Date hired</label><input type='date' class='form-control' id='update_emp_datehired' autocomplete='off' value='"+emp_list.datehired+"'></div><div class='d-flex' style='justify-content: space-between;'><div id='update_emp_modal_btn'></div><button type='button' class='btn btn-default btn-sm' id='update_emp_c_employee' onclick='modal_hide()'>Cancel</button></div>");
            $("#update_emp_modal_btn").html("<button type='button' onclick='updateEmployeeData(\""+emp_list.id+"\")' id='update_emp_sc_employee' class='btn btn-primary btn-sm'>Update changes</button>");
            getEmployeePosition('update_emp_position', emp_list.position);
            $('#update_emp_position').select2();
        });
    }

    function updateEmployeeData(id) {
        var emp_full_name = $('#update_emp_full_name').val();
        var emp_address = $('#update_emp_address').val();
        var emp_contact = $('#update_emp_contact').val();
        var emp_datehired = $('#update_emp_datehired').val();
        var emp_position = $('#update_emp_position').val();

        var emp_update_data = "fullname = '"+emp_full_name+"', address = '"+emp_address+"', contact = '"+emp_contact+"', datehired = '"+emp_datehired+"', position_id = '"+emp_position+"'";
        $("#update_emp_sc_employee").prop('disabled', true);
        $("#update_emp_sc_employee").html("<span class='fa fa-spin fa-spinner'></span> Updating...");
        sql_data_update('tbl_employee',emp_update_data, "id = '"+id+"'", 'afterEmpEdit');
        $("#update_emp_sc_employee").prop('disabled', false);
        $("#update_emp_sc_employee").html("Update changes");
    }

    function afterEmpEdit() {
        success_update();
        modal_hide();
        location.reload();
    }

    function loadEmpCode() {
        $.post(controller+"generateRandomCode.php",{
        },function(data,status){
            $('#emp_code').val(data);
        });
        
    }

    function saveEmpChanges() {
        var emp_code = $('#emp_code').val();
        var emp_full_name = $('#emp_full_name').val();
        var emp_address = $('#emp_address').val();
        var emp_contact = $('#emp_contact').val();
        var emp_datehired = $('#emp_datehired').val();
        var emp_position = $('#emp_position').val();
        var branch_id = $('#current_branch_hidden').val();
        if(emp_code == "" || emp_full_name == "" || emp_datehired == "" || branch_id == ""){
            alertMe("error", "some field is missing...")
        }else{
            var emp_item_data = {
                branch_id: branch_id,
                ref_code: emp_code,
                fullname: emp_full_name,
                address: emp_address,
                contact: emp_contact,
                datehired: emp_datehired,
                position_id: emp_position
            };
            sql_data_add('tbl_employee',emp_item_data, 'afterEmpSave');
        }
    }

    function afterEmpSave() {
        success_add();
        clearInputs();
        loadEmployeeData();
    }

    function clearInputs() {
        $('#emp_code').val('');
        $('#emp_full_name').val('');
        $('#emp_address').val('');
        $('#emp_contact').val('');
        $('#emp_datehired').val('');
        $('#emp_position').val('');
    }

    function deleteEmployee() {
        var count_checked = $("input[name='emp_checkbox']:checked").length;
        if(count_checked > 0){
            var checkedValues = $("input[name='emp_checkbox']:checked").map(function() {
                return this.value;
            }).get();
            id = [];

            var retVal = confirm("Are you sure to delete?");
            if(retVal){
                $("#delete_emp_btn").prop('disabled', true);
                $("#delete_emp_btn").html("<span class='fa fa-spin fa-spinner'></span> Deleting...");
                
                sql_data_delete('tbl_employee','id IN('+checkedValues+')','afterEmpDelete');
                
                $("#delete_emp_btn").prop('disabled', false);
                $("#delete_emp_btn").html("Delete selected employee");
            }
        }
    }

    function afterEmpDelete() {
        success_delete();
        loadEmployeeData();
    }

    function loadEmployeeData() {
        $("#emp_tbl").DataTable().destroy();
        $("#emp_tbl").DataTable({
            "responsive": true,
            "autoWidth": false,
            "paging": true,
            "dataSrc": "data",
            "ajax": {
                type: 'post',
                url: controller+"employee_data.php"
            },
            "columns": [
                {
                    "mRender": function(data,type,row){
                        return "<input type='checkbox' name='emp_checkbox' value='"+row.id+"'>";
                    },
                    "className": "text-center"
                },
                {
                    "data": "count",
                    "className": "text-center"
                },
                {
                    "mRender": function(data,type,row){
                        var emp_view_data = [
                            row.id
                        ];
                        return "<a href='#' onclick='empDetails("+emp_view_data+")'>"+row.fullname+"</a>";
                    }
                },
                {
                    "data": "contact"
                },
                {
                    "data": "position"
                },
                {
                    "mRender": function(data,type,row){
                        const stats = (row.status == 0) ? '<span style="color: green;">Active</span>' : '<span style="color: gray;">Inactive</span>' ;
                        return stats;
                    },
                    "className": "text-center"
                }
            ]
        });
    }
</script>