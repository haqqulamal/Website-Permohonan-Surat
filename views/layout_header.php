<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $page_title ?? 'Dashboard' ?> - Sistem Pelayanan Surat Desa
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('auth/logout.php') ?>">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="<?= base_url('index.php') ?>" class="brand-link">
                <span class="brand-text font-weight-light">Surat Desa</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">
                            <?= $_SESSION['nama_lengkap'] ?>
                        </a>
                        <small class="text-muted">
                            <?= ucfirst($_SESSION['role_name']) ?>
                        </small>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                        <li class="nav-item">
                            <a href="<?= base_url('index.php') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <?php if ($_SESSION['role_name'] == 'admin'): ?>
                            <li class="nav-header">MASTER DATA</li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/user_index.php') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('admin/penduduk_index.php') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-user-friends"></i>
                                    <p>Penduduk</p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if ($_SESSION['role_name'] == 'penduduk'): ?>
                            <li class="nav-header">PELAYANAN</li>
                            <li class="nav-item">
                                <a href="<?= base_url('pelayanan/permohonan_baru.php') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-plus-circle"></i>
                                    <p>Buat Permohonan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url('pelayanan/riwayat.php') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-history"></i>
                                    <p>Riwayat Permohonan</p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if (in_array($_SESSION['role_name'], ['jagabaya', 'ulu-ulu'])): ?>
                            <li class="nav-header">PERSETUJUAN</li>
                            <li class="nav-item">
                                <a href="<?= base_url('persetujuan/index.php') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-check-circle"></i>
                                    <p>Daftar Permohonan</p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <?php if ($_SESSION['role_name'] == 'lurah'): ?>
                            <li class="nav-header">PENGESAHAN</li>
                            <li class="nav-item">
                                <a href="<?= base_url('pengesahan/index.php') ?>" class="nav-link">
                                    <i class="nav-icon fas fa-stamp"></i>
                                    <p>Daftar Pengesahan</p>
                                </a>
                            </li>
                        <?php endif; ?>

                        <li class="nav-header">ARSIP</li>
                        <li class="nav-item">
                            <a href="<?= base_url('arsip/index.php') ?>" class="nav-link">
                                <i class="nav-icon fas fa-archive"></i>
                                <p>Arsip Surat</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">