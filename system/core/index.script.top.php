  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link type="text/css" rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
   <link type="text/css" rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link type="text/css" rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/datatables/fixedColumns.dataTables.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="<?=BASE_PATH?>assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- SweetAlert2 -->
  <link type="text/css" rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/sweetalert2/bootstrap-4.min.css">
  <!-- Toastr -->
  <link type="text/css" rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/toastr/toastr.min.css">
  <!-- Select2 -->
  <link type="text/css" rel="stylesheet" href="<?=BASE_PATH?>assets/plugins/select2/css/select2.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- jQuery -->
  <script src="<?=BASE_PATH?>assets/plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?=BASE_PATH?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?=BASE_PATH?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- SweetAlert2 -->
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
  <!-- Toastr -->
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/toastr/toastr.min.js"></script>
  <!-- Select2 -->
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/select2/js/select2.full.min.js"></script>
  <!-- DataTables -->
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/datatables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" src="<?=BASE_PATH?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  
  <!-- overlayScrollbars -->
  <script src="<?=BASE_PATH?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?=BASE_PATH?>assets/dist/js/adminlte.js"></script>
  <?php
  if(in_array($active_li, $restricted_li)){
  ?>
  <style type="text/css">
  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 15px;
  }
  </style>
  <?php
  }else{ ?>
  <style type="text/css">
    thead th {
      padding: 5px !important;
      background: #4e6881;
      color: #ffff;
    }
    tbody td {
      padding: 1px 5px !important;
      white-space: nowrap;
    }
    .select2-container .select2-selection--single{
      height: 40px;
    }
  </style>
  <?php } ?>
<script type="text/javascript">
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
var BASE_PATH = '<?=BASE_PATH?>';
var APP_FOLDER = '<?=APP_FOLDER?>';
var folder_file = '<?=$folder_file?>';
var loader = "<div class='col-md-12'><center><img style='width:30%;' src='"+BASE_PATH+"assets/dist/loader_new.gif' class='pull-center'></center></div>";
var controller = BASE_PATH+APP_FOLDER+'controller/'+folder_file+'/';
var controller_global = BASE_PATH+APP_FOLDER+'controller/global/';

var model = BASE_PATH+APP_FOLDER+'model/'+folder_file+'/';

function modal_show(to_remove = 'modal-md',to_add = 'modal-lg', title = 'Title'){
    $("#global_modal_dialog").removeClass(to_remove);
    $("#global_modal_dialog").addClass(to_add);

    // hide_side_content();
    $('#modal_title').html(title);
    $("#global_modal").modal({"keyboard":false,"backdrop" : 'static'});
    $("#global_modal").modal('show');

    $("#global-modal-content").html(loader);
}
function modal_hide(){
    // show_side_content();
    $("#global_modal").modal('hide');
}
function swalMe(type,title){
    Swal.fire({
    toast : true,
    type: type,
    title: title,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000
    });
}
function swalMe2(type,title){
    Swal.fire({
    type: type,
    title: title,
    showConfirmButton: true,
    });
}
function success_update(){
    Toast.fire({
        type: 'success',
        title: 'Data successfully updated!'
    });
}
function success_add(){
    Toast.fire({
        type: 'success',
        title: 'Data successfully added!'
    });
}
function success_delete(){
    Toast.fire({
        type: 'success',
        title: 'Data successfully deleted!'
    });
}
function alertMe(type, msg) {
    Toast.fire({
        type: type,
        title: msg
    });
}
function failed_query(){
    Toast.fire({
        type: 'error',
        title: 'Error executing query.'
    });
}

function page_loader(param){
    $("#page_loader_content").html(param);
    $('#modalLoader').modal({backdrop: 'static', keyboard: false});
    $("#modalLoader").modal('show');
    // hide_side_content();
}

function page_loader_hide(){
    $("#modalLoader").modal('hide');
    show_side_content();
}
function hide_side_content(){
    $("#sidebar").css("z-index",0);
    $("#content-wrapper").hide("fast");
}
function show_side_content(){
    $("#sidebar").css("z-index",1100);
    $("#content-wrapper").show("fast");
}

function sql_data_add(tbl,item_data,func = "", param = []){
    $.post(controller_global+"sql_query_add.php",{
        data:item_data,
        tbl:tbl
    },function (data,status){
        if(data == 1){
            if(func != ""){
                setTimeout(function(){
                window[func].apply(this,param);
                },500);
            }
        }else{
            failed_query();
        }
    });
    }

    function sql_data_update(tbl,item_data,par,func = "", param = []){
    $.post(controller_global+"sql_query_update.php",{
        data:item_data,
        tbl:tbl,
        par:par
    },function (data,status){
        if(data == 1){
            if(func != ""){
                setTimeout(function(){
                window[func].apply(this,param);
                },500);
            }
        }else{
            failed_query();
        }
    });
    }

    function sql_data_delete(tbl,par,func = "", param = []){
    $.post(controller_global+"sql_query_delete.php",{
        tbl:tbl,
        par:par
    },function (data,status){
        if(data == 1){
            if(func != ""){
                setTimeout(function(){
                window[func].apply(this,param);
                },100);
            }
        }else{
            failed_query();
        }
    });
    }

    function sql_data_query(query,func = "", param = []){
    $.post(controller_global+"sql_query.php",{
        query:query
    },function (data,status){
        if(data == 1){
            if(func != ""){
                setTimeout(function(){
                window[func].apply(this,param);
                },100);
            }
        }else{
            failed_query();
        }
    });
    }

    function logOut(){
        Swal.fire({
        title: 'Are you sure to Log Out?',
        text: "You will be redirected to Login Page!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, logout!'
        }).then((result) => {
        if (result.value) {
            window.location = '../auth/log_out.php';
        }
        });
    }
</script>