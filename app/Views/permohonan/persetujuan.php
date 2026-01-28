<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Verifikasi Staff
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Antrean Verifikasi Staff</h1>
    <p>Daftar permohonan yang perlu ditinjau sebelum diteruskan ke Lurah.</p>
</section>

<section class="content">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Pemohon</th>
                                <th>Jenis Surat</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($permohonan as $row): ?>
                                <tr>
                                    <td>
                                        <?= $no++ ?>
                                    </td>
                                    <td>
                                        <?= $row['nama_lengkap'] ?>
                                    </td>
                                    <td>
                                        <?= $row['jenis_permohonan'] ?>
                                    </td>
                                    <td>
                                        <?= $row['keterangan'] ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#modal-<?= $row['id_surat'] ?>">
                                            <i class="fa fa-edit"></i> Review
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-<?= $row['id_surat'] ?>" tabindex="-1"
                                            role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?= base_url('/permohonan/aksi-staff') ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="id_surat"
                                                            value="<?= $row['id_surat'] ?>">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                            <h4 class="modal-title">Review Permohonan -
                                                                <?= $row['nama_lengkap'] ?>
                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label>Keputusan</label>
                                                                <select class="form-control" name="status_persetujuan"
                                                                    required>
                                                                    <option value="disetujui">Setujui (Teruskan ke Lurah)
                                                                    </option>
                                                                    <option value="ditolak">Tolak</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label>Catatan ke Lurah/Pemohon</label>
                                                                <textarea class="form-control" name="catatan" rows="3"
                                                                    required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default pull-left"
                                                                data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Keputusan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(function () {
        $("#data").DataTable();
    });
</script>
<?= $this->endSection() ?>