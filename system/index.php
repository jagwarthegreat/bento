<?php
require 'core/config.php';
require 'routes/routes.php';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?=SYSTEM_NAME?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'core/index.script.top.php';?>
</head>
<body class="hold-transition layout-fixed sidebar-mini <?=(in_array($active_li, $restricted_li))?'sidebar-collapse':'';?>" style="background: #FFF;">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <select class="form-control select2" name="current_branch" onchange="changeBranch()" id="current_branch" style="width: 300px;">
          <?=getBranches()?>
        </select>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?=BASE_PATH?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?=SYSTEM_NAME?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fa fa-user" style="font-size: 30px;color: #c2c7d0;"></i>
        </div>
        <div class="info">
          <a href="<?=BASE_PATH.APP_FOLDER?>profile" class="d-block"><?=$_SESSION['system']['fullname']?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <input type="hidden" id="current_branch_hidden" value="<?=$_SESSION['system']['branch_id']?>">
        <ul class="nav nav-pills nav-child-indent nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php require 'template/sidebar.php'; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="content-wrapper">
    <?php include file_exists($views_file) ? $views_file : $error_file;?>
  </div>
  <footer class="main-footer">
    <strong>Powered by <a href="#">zechSolutions &trade; </a></strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
  <div class="modal fade" id="global_modal">
    <div class="modal-dialog modal-lg" id="global_modal_dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" id="modal_title"></h5>
        </div>
        <div class="modal-body" id="global-modal-content" style="padding: 0">
        </div>
        <div class="modal-footer justify-content-between">
          <p><center>zechSolution &trade;</center></p>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div id="modalLoader" class="modal fade" role="dialog">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content" style='border-radius: 15px;'>
            <div class="modal-body">
                <h4><center><span class='fa fa-spin fa-spinner'></span> <span id='page_loader_content'></span></center></h4>
            </div>
        </div>
    </div>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>

  <?php include VIEWS_FOLDER.'module_folder/purchase_modal.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/purchase_modal_detail.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/convert_modal.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/convert_modal_detail.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/product_add_modal.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/srp_modal_add.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/product_category_modal.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/product_category_detail_modal.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/product_unit_modal.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/product_unit_detail.php'; ?>
  <?php include VIEWS_FOLDER.'module_folder/users_modal.php'; ?>
</div>
</body>
<script>
  $('.select2').select2();

  function changeBranch() {
    var selected_branch = $("#current_branch").val();
    // alert(selected_branch);
    page_loader("changing branch");
    $.post(controller+"change_branch.php",{
      id: selected_branch
    },function(data,status){
        if(data == 1){
          page_loader_hide();
          location.reload();
        }else{
          failed_query();
        }
    });
  }
</script>
</html>
