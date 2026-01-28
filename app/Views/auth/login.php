<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login - Sistem Informasi Surat</title>
    <!-- Icon -->
    <link rel="shortcut icon" type="image/icon" href="<?= base_url('pemuda.png') ?>">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= base_url('aset/bootstrap/css/bootstrap.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('aset/fa/css/font-awesome.css') ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('aset/dist/css/AdminLTE.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('aset/plugins/iCheck/square/blue.css') ?>">
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
            <?php if (session()->getFlashdata('msg')): ?>
                <div class="alert alert-danger">
                    <?= session()->getFlashdata('msg') ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('/login') ?>" method="post">
                <?= csrf_field() ?>
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" id="username" placeholder="username"
                        maxlength="30" required />
                    <span class="form-control-feedback"><i class="fa fa-user"></i></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" id="password" placeholder="password"
                        maxlength="255" required />
                    <span class="form-control-feedback"><i class="fa fa-unlock"></i></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary">Login <i class="fa fa-sign-in"></i></button>
                    </div><!-- /.col -->
                </div>
            </form>

        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url('aset/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= base_url('aset/bootstrap/js/bootstrap.min.js') ?>"></script>
    <!-- iCheck -->
    <script src="<?= base_url('aset/plugins/iCheck/icheck.min.js') ?>"></script>
</body>

</html>