<?php
$ProfileClass = new ProfileClass();
echo $ProfileClass->header();
?>


<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">Title</h3>

        <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        Start creating your amazing application!
        <div>
            <button class='btn btn-outline-primary' onclick='swalMe("success","Toast Alert Sample")'> Toast Alert</button>
            <button class='btn btn-outline-success' onclick='swalMe2("success","Swal Alert Sample")'> Swal Alert</button>
            <button class='btn btn-outline-primary' onclick='loadAjax()'> Load Ajax</button>
            <button class='btn btn-outline-danger' onclick='openModal()'> Open Modal</button>
        </div>
        <div>
            <p id='ajax'>asdasdasdsadasdasdasdasdas</p>
        </div>
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
    $('title').html("Profile");
    function loadAjax(){
        $("#ajax").html(loader);
        $.post(controller+"module_ajax.php",{
        },function(data,status){
            $("#ajax").html(data);
        });
    }
    function openModal(){
        modal_show('modal-lg','modal-md');
        $("#global-modal-content").html("<div class='col-12'>content modal</div>");
    }
</script>