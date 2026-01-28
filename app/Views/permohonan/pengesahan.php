<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Antrean Pengesahan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Antrean Pengesahan Lurah</h1>
    <p>Silahkan tinjau dan sahkan permohonan yang telah disetujui Staff.</p>
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
                                <th>Catatan Staff</th>
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
                                        <?= $row['catatan_staff'] ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('/pengesahan/add/' . $row['id_surat']) ?>"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-pencil text-white"></i> Sahkan
                                        </a>
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