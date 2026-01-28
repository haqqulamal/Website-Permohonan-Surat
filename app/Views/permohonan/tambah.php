<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Buat Permohonan Baru
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Buat Permohonan Baru</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body">
                    <form action="<?= base_url('/pelayanan/simpan') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="form-group">
                            <label>Jenis Permohonan</label>
                            <select class="form-control" name="jenis_permohonan" required>
                                <option value="Kepemilikan Tanah">Kepemilikan Tanah</option>
                                <option value="Perizinan Usaha">Perizinan Usaha</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Keterangan Tambahan / Lokasi / Nama Usaha</label>
                            <textarea class="form-control" name="keterangan" rows="5"
                                placeholder="Tuliskan detail permohonan Anda..." required></textarea>
                        </div>
                        <div class="box-footer text-right">
                            <a href="<?= base_url('/pelayanan/riwayat') ?>" class="btn btn-default">Batal</a>
                            <button type="submit" class="btn btn-primary">Kirim Permohonan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">Informasi</h3>
                </div>
                <div class="box-body">
                    <p>Pastikan data yang Anda tulis sudah benar. Permohonan yang sudah dikirim akan segera diproses
                        oleh Staff Desa.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>