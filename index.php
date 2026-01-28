<?php
session_start();
include "koneksi.php";

// Notif Error
$Err = "";
if (isset($_GET["Err"]) && !empty($_GET["Err"])) {
  switch ($_GET["Err"]) {
    case 1:
      $Err = "Username atau Password salah";
      break;
    case 2:
      $Err = "Username atau Password belum diisi";
      break;
    case 4:
      $Err = "Password salah";
      break;
    case 5:
      $Err = "Username atau Password salah";
      break;
    case 6:
      $Err = "Maaf, Terjadi Kesalahan";
      break;
  }
}

// Notif
$Notif = "";
if (isset($_GET["Notif"]) && !empty($_GET["Notif"])) {
  switch ($_GET["Notif"]) {
    case 1:
      $Notif = "User berhasil dibuat, silahkan Login";
      break;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <?php include "title.php"; ?>
  <!-- Icon -->
  <link rel="shortcut icon" type="image/icon" href="pemuda.png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="aset/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="aset/fa/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="aset/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="aset/plugins/iCheck/square/blue.css">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>SISTEM INFORMASI SURAT KEPEMILIKAN TANAH DAN SURAT PERIJINAN USAHA</b>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <b>
        <p class="login-box-msg">Login Form</p>
      </b>
      <form action="proses_login.php" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="username" class="form-control" id="username" placeholder="username" maxlength="30" />
          <span class="form-control-feedback"><i class="fa fa-user"></i></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" id="password" placeholder="password"
            maxlength="255" />
          <span class="form-control-feedback"><i class="fa fa-unlock"></i></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
          </div><!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary">Login <i class="fa fa-sign-in"></i></button>
          </div><!-- /.col -->
        </div>
        <br>
        <center>
          <font style="color:red;"><?php echo $Err ?></font>
        </center>
        <center>
          <font style="color:green;"><?php echo $Notif ?></font>
        </center>
        </br>
      </form>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <!-- jQuery 2.1.4 -->
  <script src="aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="aset/bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="aset/plugins/iCheck/icheck.min.js"></script>
</body>

</html>