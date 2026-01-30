<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role();

$page_title = 'Arsip Surat';

$query = "SELECT permohonan_sk.*, penduduk.nama_lengkap 
          FROM permohonan_sk 
          LEFT JOIN penduduk ON permohonan_sk.id_penduduk = penduduk.id_penduduk 
          WHERE permohonan_sk.status = 'disahkan_lurah' 
          ORDER BY permohonan_sk.id_surat DESC";
$arsip_list = mysqli_query($conn, $query);

include '../views/layout_header.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Arsip Surat</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar Surat yang Telah Disahkan</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pemohon</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($p = mysqli_fetch_assoc($arsip_list)): ?>
                            <tr>
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <?= date('d/m/Y', strtotime($p['tanggal_permohonan'])) ?>
                                </td>
                                <td>
                                    <?= $p['nama_lengkap'] ?>
                                </td>
                                <td>
                                    <?= $p['keterangan'] ?>
                                </td>
                                <td>
                                    <a href="download.php?id=<?= $p['id_surat'] ?>" class="btn btn-danger btn-sm"
                                        target="_blank">
                                        <i class="fas fa-file-pdf"></i> Download PDF
                                    </a>
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