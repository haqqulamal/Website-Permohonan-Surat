<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        <?= $this->renderSection('title') ?> - Sistem Informasi Surat
    </title>
    <link rel="shortcut icon" type="image/icon" href="<?= base_url('sleman.png') ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url('aset/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('aset/fa/css/font-awesome.css') ?>">
    <link rel="stylesheet" href="<?= base_url('aset/plugins/datatables/dataTables.bootstrap.css') ?>">
    <link rel="stylesheet" href="<?= base_url('aset/dist/css/AdminLTE.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('aset/dist/css/skins/_all-skins.min.css') ?>">
    <?= $this->renderSection('styles') ?>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        <header class="main-header">
            <div class="logo">
                <span class="logo-mini"><img src="<?= base_url('sleman.png') ?>" class="img-circle" height="50"
                        width="50"></span>
                <span class="logo-lg"><b>Surat Perizinan</b></span>
            </div>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="icon"></span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?= base_url('sleman.png') ?>" class="user-image" alt="Foto">
                                <span class="hidden-xs" style="text-transform:capitalize;">
                                    <?= session()->get('username') ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?= base_url('sleman.png') ?>" class="img-circle" alt="Foto">
                                    <p style="text-transform:capitalize;">Hi
                                        <?= session()->get('username') ?>,
                                    </p>
                                    <p>Selamat datang diaplikasi</p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?= base_url('/logout') ?>" class="btn btn-yellow">Log out <i
                                                class="fa fa-sign-out"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Sidebar -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="header">
                        <h4><b>
                                <center>Dashboard</center>
                            </b></h4>
                    </li>
                    <li class="<?= (uri_string() == 'dashboard') ? 'active' : '' ?>">
                        <a href="<?= base_url('/dashboard') ?>"><i class="fa fa-home"></i><span>Dashboard</span></a>
                    </li>

                    <?php if (session()->get('role_name') === 'admin'): ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-folder"></i> <span>Master Data</span><i
                                    class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url('/admin/user') ?>"><i
                                            class="fa fa-circle-o"></i><span>User</span></a></li>
                                <li><a href="<?= base_url('/admin/penduduk') ?>"><i
                                            class="fa fa-circle-o"></i><span>Penduduk</span></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if (in_array(session()->get('role_name'), ['penduduk', 'admin'])): ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-book"></i> <span>Pelayanan</span><i
                                    class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url('/pelayanan/riwayat') ?>"><i
                                            class="fa fa-circle-o"></i><span>Riwayat Permohonan</span></a></li>
                                <li><a href="<?= base_url('/pelayanan/tambah') ?>"><i class="fa fa-circle-o"></i><span>Buat
                                            Permohonan Baru</span></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if (in_array(session()->get('role_name'), ['jagabaya', 'ulu-ulu', 'admin'])): ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-file"></i> <span>Persetujuan</span><i
                                    class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url('/permohonan/persetujuan') ?>"><i
                                            class="fa fa-circle-o"></i><span>Verifikasi Staff</span></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if (in_array(session()->get('role_name'), ['lurah', 'admin'])): ?>
                        <li class="treeview">
                            <a href="#"><i class="fa fa-pencil"></i> <span>Pengesahan</span><i
                                    class="fa fa-angle-left pull-right"></i></a>
                            <ul class="treeview-menu">
                                <li><a href="<?= base_url('/pengesahan') ?>"><i class="fa fa-circle-o"></i><span>Tanda
                                            Tangan Lurah</span></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li class="treeview">
                        <a href="#"><i class="fa fa-thumbs-o-up"></i> <span>Arsip Surat</span><i
                                class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="<?= base_url('/arsip') ?>"><i class="fa fa-circle-o"></i><span>Daftar Surat
                                        Selesai</span></a></li>
                        </ul>
                    </li>
                </ul>
            </section>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <?= $this->renderSection('content') ?>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs"><b>Version</b> 1.1</div>
            <strong>Copyright &copy;
                <?= date('Y') ?> Village Letter Application.
            </strong> All rights reserved.
        </footer>
    </div>

    <!-- Scripts -->
    <script src="<?= base_url('aset/plugins/jQuery/jQuery-2.1.4.min.js') ?>"></script>
    <script src="<?= base_url('aset/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('aset/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= base_url('aset/plugins/datatables/dataTables.bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('aset/dist/js/app.min.js') ?>"></script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>