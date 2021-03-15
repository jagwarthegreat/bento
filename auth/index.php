<?php
include '../system/core/config.php';
if (!isset($_SESSION['system']['user_id'])) {
} else {
  echo "<script>window.location='../system';</script>";
}
$error = $_SESSION['error'];
$_SESSION['error'] = '';
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>INV | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="color: #1c1e21;">
  <div class="container px-5" style="position: absolute;top: 20%;padding: 0 70px 0 70px;">
    <div style="display: flex; flex-direction: row;justify-content: space-between;">
      <div class="col">
        <div class="login-logo text-left d-flex" style="flex-direction: column;">
          <span style="font-size: 72px; font-weight: bold;"><b>bento</b></span>
          <span style="font-size: 30px; width: 70%;">Manage your inventory for your store or stablishment using bento.</span>
        </div>
        <!-- /.login-logo -->
      </div>
      <div>
        <div class="content">
          <div class="card" style="width: 390px;">
            <div class="card-body login-card-body">

              <form action="sign_in.php" method="post">
                <div class="input-group mb-3">
                  <input type="text" name="username" class="form-control form-control-lg" placeholder="Username" autocomplete="off" autofocus>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" autocomplete="off">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Log In</button>
                  </div>
                  <!-- /.col -->
                </div>
                <p class="mb-1">
                  <span style="color: red"><?= $error ?></span>
                </p>
              </form>
            </div>
            <!-- /.login-card-body -->
          </div>
          <p class="mb-1 text-center">zechSolutions &trade;</p>
        </div>
      </div>
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../assets/dist/js/adminlte.min.js"></script>

</body>

</html>