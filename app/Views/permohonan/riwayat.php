<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Riwayat Permohonan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Riwayat Permohonan Saya</h1>
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
                <div class="box-header">
                    <a href="<?= base_url('/pelayanan/tambah') ?>" class="btn btn-primary">
                        <i class="fa fa-plus"></i> Buat Permohonan Baru
                    </a>
                </div>
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Jenis Surat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Catatan Staff/Lurah</th>
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
                                        <?= $row['jenis_permohonan'] ?>
                                    </td>
                                    <td>
                                        <?= $row['tanggal_permohonan'] ?>
                                    </td>
                                    <td>
                                        <?php
                                        $label = 'label-warning';
                                        $text = str_replace('_', ' ', $row['status']);
                                        if (strpos($row['status'], 'disetujui') !== false)
                                            $label = 'label-info';
                                        if (strpos($row['status'], 'disahkan') !== false)
                                            $label = 'label-success';
                                        if (strpos($row['status'], 'ditolak') !== false)
                                            $label = 'label-danger';
                                        ?>
                                        <span class="label <?= $label ?>">
                                            <?= ucwords($text) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($row['catatan_staff']): ?>
                                            <small>Staff:
                                                <?= $row['catatan_staff'] ?>
                                            </small><br>
                                        <?php endif; ?>
                                        <?php if ($row['catatan_lurah']): ?>
                                            <small>Lurah:
                                                <?= $row['catatan_lurah'] ?>
                                            </small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] == 'disahkan_lurah'): ?>
                                            <a href="<?= base_url('/download-pdf/' . $row['id_surat']) ?>"
                                                class="btn btn-success btn-xs">
                                                <i class="fa fa-download"></i> PDF
                                            </a>
                                        <?php else: ?>
                                            <span class="text-muted">Proses</span>
                                        <?php endif; ?>
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