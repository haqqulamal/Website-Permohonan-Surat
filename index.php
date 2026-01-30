<?php
session_start();
require_once 'config/database.php';
require_once 'config/functions.php';

// Check if logged in
check_role();

$page_title = 'Dashboard';

// Get statistics based on role
$stats = [];

if ($_SESSION['role_name'] == 'admin') {
    // Count users
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM user");
    $stats['total_users'] = mysqli_fetch_assoc($result)['total'];

    // Count penduduk
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM penduduk");
    $stats['total_penduduk'] = mysqli_fetch_assoc($result)['total'];
}

// Count permohonan by status
$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM permohonan_sk WHERE status = 'menunggu_staff'");
$stats['menunggu_staff'] = mysqli_fetch_assoc($result)['total'];

$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM permohonan_sk WHERE status = 'disetujui_staff'");
$stats['disetujui_staff'] = mysqli_fetch_assoc($result)['total'];

$result = mysqli_query($conn, "SELECT COUNT(*) as total FROM permohonan_sk WHERE status = 'disahkan_lurah'");
$stats['disahkan_lurah'] = mysqli_fetch_assoc($result)['total'];

// If penduduk, filter by their id
if ($_SESSION['role_name'] == 'penduduk') {
    $id_penduduk = $_SESSION['id_penduduk'];
    $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM permohonan_sk WHERE id_penduduk = $id_penduduk");
    $stats['my_permohonan'] = mysqli_fetch_assoc($result)['total'];
}

include 'views/layout_header.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <?php if ($success = get_flash('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $success ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php if ($_SESSION['role_name'] == 'admin'): ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?= $stats['total_users'] ?>
                            </h3>
                            <p>Total User</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?= $stats['total_penduduk'] ?>
                            </h3>
                            <p>Total Penduduk</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>
                            <?= $stats['menunggu_staff'] ?>
                        </h3>
                        <p>Menunggu Staff</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>
                            <?= $stats['disetujui_staff'] ?>
                        </h3>
                        <p>Disetujui Staff</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>
                            <?= $stats['disahkan_lurah'] ?>
                        </h3>
                        <p>Disahkan Lurah</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-stamp"></i>
                    </div>
                </div>
            </div>

            <?php if ($_SESSION['role_name'] == 'penduduk'): ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?= $stats['my_permohonan'] ?>
                            </h3>
                            <p>Permohonan Saya</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Selamat Datang,
                            <?= $_SESSION['nama_lengkap'] ?>!
                        </h3>
                    </div>
                    <div class="card-body">
                        <p>Anda login sebagai: <strong>
                                <?= ucfirst($_SESSION['role_name']) ?>
                            </strong></p>
                        <p>Gunakan menu di sebelah kiri untuk mengakses fitur yang tersedia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'views/layout_footer.php'; ?>