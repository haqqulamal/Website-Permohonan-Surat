<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['penduduk']);

$page_title = 'Buat Permohonan Baru';

include '../views/layout_header.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Buat Permohonan Baru</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Form Permohonan Surat</h3>
            </div>
            <form action="simpan_permohonan.php" method="POST">
                <div class="card-body">
                    <div class="form-group">
                        <label>Jenis Permohonan / Keterangan</label>
                        <textarea name="keterangan" class="form-control" rows="4" required
                            placeholder="Contoh: Surat Keterangan Usaha untuk membuka toko kelontong"></textarea>
                        <small class="text-muted">Jelaskan jenis surat dan keperluan Anda</small>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Permohonan
                    </button>
                    <a href="riwayat.php" class="btn btn-default">Batal</a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php include '../views/layout_footer.php'; ?>