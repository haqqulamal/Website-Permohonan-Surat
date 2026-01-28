<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="content-header">
    <h1>Dashboard <small>Status Permohonan Surat</small></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?= $total_pending ?>
                    </h3>
                    <p>Menunggu Staff</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clock-o"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?= $total_disetujui_staff ?>
                    </h3>
                    <p>Disetujui Staff (Menunggu Lurah)</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?= $total_disahkan ?>
                    </h3>
                    <p>Selesai / Disahkan Lurah</p>
                </div>
                <div class="icon">
                    <i class="fa fa-flag-checkered"></i>
                </div>
            </div>
        </div>
    </div>

    <?php if (session()->get('role_name') === 'penduduk'): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Pemberitahuan Penduduk</h3>
                    </div>
                    <div class="box-body">
                        <p>Selamat Datang, <b>
                                <?= session()->get('nama_lengkap') ?>
                            </b>.</p>
                        <p>Anda dapat mengajukan permohonan surat melalui menu <b>Pelayanan</b> dan memantau statusnya di
                            dashboard ini.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</section>
<?= $this->endSection() ?>