<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['lurah']);

$page_title = 'Pengesahan Surat';

$query = "SELECT permohonan_sk.*, penduduk.nama_lengkap 
          FROM permohonan_sk 
          LEFT JOIN penduduk ON permohonan_sk.id_penduduk = penduduk.id_penduduk 
          WHERE permohonan_sk.status = 'disetujui_staff' 
          ORDER BY permohonan_sk.id_surat DESC";
$permohonan_list = mysqli_query($conn, $query);

include '../views/layout_header.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengesahan Surat</h1>
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
                <h3 class="card-title">Daftar Surat Menunggu Pengesahan</h3>
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
                        while ($p = mysqli_fetch_assoc($permohonan_list)): ?>
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
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#modalSahkan<?= $p['id_surat'] ?>">
                                        <i class="fas fa-stamp"></i> Sahkan
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal Sahkan -->
                            <div class="modal fade" id="modalSahkan<?= $p['id_surat'] ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="proses.php" method="POST">
                                            <input type="hidden" name="id_surat" value="<?= $p['id_surat'] ?>">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Pengesahan Surat</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Pemohon:</strong>
                                                    <?= $p['nama_lengkap'] ?>
                                                </p>
                                                <p><strong>Keterangan:</strong>
                                                    <?= $p['keterangan'] ?>
                                                </p>
                                                <div class="form-group">
                                                    <label>Keputusan</label>
                                                    <select name="status_pengesahan" class="form-control" required>
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Sahkan">Sahkan</option>
                                                        <option value="Tolak">Tolak</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Catatan</label>
                                                    <textarea name="catatan" class="form-control" rows="3"></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default"
                                                    data-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-success">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php include '../views/layout_footer.php'; ?>