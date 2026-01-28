<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Form Pengesahan Lurah
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Form Pengesahan SK (Lurah)</h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Review Akhir</h3>
                </div>
                <div class="box-body">
                    <form action="<?= base_url('/pengesahan/aksi-lurah') ?>" method="post" class="form-horizontal">
                        <?= csrf_field() ?>
                        <input type="hidden" name="id_surat" value="<?= $permohonan['id_surat'] ?>">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Pemohon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= $permohonan['nama_lengkap'] ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jenis Surat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= $permohonan['jenis_permohonan'] ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Catatan Staff</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" readonly><?= $permohonan['catatan_staff'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Keputusan Lurah</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="status_pengesahan" required>
                                    <option value="Sahkan">Sahkan</option>
                                    <option value="Tolak">Tolak</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Catatan Lurah</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="catatan"
                                    placeholder="Berikan alasan jika ditolak atau catatan tambahan..."
                                    required></textarea>
                            </div>
                        </div>

                        <div class="box-footer text-right">
                            <a href="<?= base_url('/pengesahan') ?>" class="btn btn-default">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan Pengesahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>