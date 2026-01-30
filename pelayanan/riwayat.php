<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['penduduk']);

$page_title = 'Riwayat Permohonan';

$id_penduduk = $_SESSION['id_penduduk'];
$query = "SELECT permohonan_sk.*, penduduk.nama_lengkap 
          FROM permohonan_sk 
          LEFT JOIN penduduk ON permohonan_sk.id_penduduk = penduduk.id_penduduk 
          WHERE permohonan_sk.id_penduduk = $id_penduduk 
          ORDER BY permohonan_sk.id_surat DESC";
$permohonan_list = mysqli_query($conn, $query);

include '../views/layout_header.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Riwayat Permohonan</h1>
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

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Permohonan Saya</h3>
                <div class="card-tools">
                    <a href="permohonan_baru.php" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Buat Permohonan Baru
                    </a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($p = mysqli_fetch_assoc($permohonan_list)): ?>
                            <tr>
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($p['tanggal_permohonan'])) ?>
                                </td>
                                <td>
                                    <?= $p['keterangan'] ?>
                                </td>
                                <td>
                                    <?php
                                    $badge_class = 'secondary';
                                    if ($p['status'] == 'menunggu_staff')
                                        $badge_class = 'warning';
                                    if ($p['status'] == 'disetujui_staff')
                                        $badge_class = 'info';
                                    if ($p['status'] == 'disahkan_lurah')
                                        $badge_class = 'success';
                                    if (strpos($p['status'], 'ditolak') !== false)
                                        $badge_class = 'danger';
                                    ?>
                                    <span class="badge badge-<?= $badge_class ?>">
                                        <?= ucwords(str_replace('_', ' ', $p['status'])) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include '../views/layout_footer.php'; ?>