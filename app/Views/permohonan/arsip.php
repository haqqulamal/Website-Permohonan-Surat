<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Arsip Surat Selesai
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Arsip Surat (Selesai Disahkan)</h1>
    <p>Daftar semua surat yang telah disahkan dan siap diunduh.</p>
</section>

<section class="content">
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
                                <th>Tanggal Selesai</th>
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
                                        <?= $row['tanggal_permohonan'] ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('/download-pdf/' . $row['id_surat']) ?>"
                                            class="btn btn-success btn-xs">
                                            <i class="fa fa-download"></i> Download PDF
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