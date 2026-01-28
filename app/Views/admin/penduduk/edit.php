<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Edit Penduduk
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Edit Data Penduduk</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-10">
            <div class="box box-warning">
                <div class="box-body">
                    <form action="<?= base_url('admin/penduduk/update') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_penduduk" value="<?= $penduduk['id_penduduk'] ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" name="nik" class="form-control" value="<?= $penduduk['nik'] ?>"
                                        required maxlength="16">
                                </div>
                                <div class="form-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control"
                                        value="<?= $penduduk['nama_lengkap'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" required>
                                        <option value="Laki-laki" <?= ($penduduk['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= ($penduduk['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="form-control"
                                        value="<?= $penduduk['tempat_lahir'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Lahir</label>
                                    <input type="date" name="tanggal_lahir" class="form-control"
                                        value="<?= $penduduk['tanggal_lahir'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" rows="3"
                                        required><?= $penduduk['alamat'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Agama</label>
                                    <input type="text" name="agama" class="form-control"
                                        value="<?= $penduduk['agama'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Pekerjaan</label>
                                    <input type="text" name="pekerjaan" class="form-control"
                                        value="<?= $penduduk['pekerjaan'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Kewarganegaraan</label>
                                    <input type="text" name="kewarganegaraan" class="form-control"
                                        value="<?= $penduduk['kewarganegaraan'] ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer text-right">
                            <a href="<?= base_url('admin/penduduk') ?>" class="btn btn-default">Batal</a>
                            <button type="submit" class="btn btn-warning">Update Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>