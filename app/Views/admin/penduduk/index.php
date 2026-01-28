<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Data Penduduk<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Data Penduduk</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Penduduk</li>
    </ol>
</section>

<section class="content">
    <?php if(session()->getFlashdata('success')):?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif;?>
    <?php if(session()->getFlashdata('error')):?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif;?>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header">
                    <a href="<?= base_url('admin/penduduk/add') ?>" class="btn btn-success">
                        <i class="fa fa-plus"></i> Tambah Penduduk
                    </a>
                </div>
                <div class="box-body">
                    <table id="data" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>No HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; foreach ($penduduk as $row): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $row['nik'] ?></td>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['alamat'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['no_telp'] ?></td>
                                <td>
                                    <a href="<?= base_url('admin/penduduk/edit/'.$row['id_penduduk']) ?>" class="btn btn-warning btn-xs">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="<?= base_url('admin/penduduk/delete/'.$row['id_penduduk']) ?>" class="btn btn-danger btn-xs" onclick="return confirm('Yakin ingin menghapus data penduduk ini?')">
                                        <i class="fa fa-trash"></i> Hapus
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