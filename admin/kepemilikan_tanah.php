<?php
include "koneksi.php";
include "auth_middleware.php";
check_login();

$id_user = $_SESSION['id_user'];
$role_name = $_SESSION['role_name'];
$id_penduduk = $_SESSION['id_penduduk'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <?php include "../title.php"; ?>
    <link rel="shortcut icon" type="image/icon" href="sleman.png">
    <meta content="width=device-width, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../aset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../aset/fa/css/font-awesome.css">
    <link rel="stylesheet" href="../aset/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../aset/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../aset/dist/css/skins/_all-skins.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include 'content_header.php'; ?>
        <?php include 'menu.php'; ?>

        <div class="content-wrapper">
            <section class="content-header">
                <h1>Permohonan SK Kepemilikan Tanah</h1>
                <p>Monitor status permohonan Anda di bawah ini.</p>
            </section>

            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-body">
                                <?php if ($role_name == 'penduduk'): ?>
                                    <a href="kepemilikan_tanah-add.php"><button class="btn btn-success" type="button"><i
                                                class="fa fa-plus"></i> Ajukan Baru</button></a>
                                    <br><br>
                                <?php endif; ?>
                                <table id="data" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Pemohon</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Ket. Staff</th>
                                            <th>Ket. Lurah</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $where = "WHERE jenis_permohonan='Kepemilikan Tanah'";
                                        if ($role_name == 'penduduk')
                                            $where .= " AND p.id_penduduk = '$id_penduduk'";

                                        $query = "SELECT p.*, d.nama_lengkap FROM permohonan_sk p 
                                              JOIN penduduk d ON p.id_penduduk = d.id_penduduk 
                                              $where";
                                        $res = mysqli_query($konek, $query);

                                        if ($res) {
                                            $no = 0;
                                            while ($row = mysqli_fetch_array($res)) {
                                                $no++;
                                                $status_label = '';
                                                switch ($row['status']) {
                                                    case 'menunggu_staff':
                                                        $status_label = '<span class="label label-warning">Verifikasi Staff</span>';
                                                        break;
                                                    case 'disetujui_staff':
                                                        $status_label = '<span class="label label-info">Disetujui Staff</span>';
                                                        break;
                                                    case 'ditolak_staff':
                                                        $status_label = '<span class="label label-danger">Ditolak Staff</span>';
                                                        break;
                                                    case 'disahkan_lurah':
                                                        $status_label = '<span class="label label-success">Disahkan Lurah</span>';
                                                        break;
                                                    case 'ditolak_lurah':
                                                        $status_label = '<span class="label label-danger">Ditolak Lurah</span>';
                                                        break;
                                                }

                                                echo "
                                                <tr>
                                                    <td>$no</td>
                                                    <td>{$row['nama_lengkap']}</td>
                                                    <td>{$row['keterangan']}</td>
                                                    <td>{$row['tanggal_permohonan']}</td>
                                                    <td>$status_label</td>
                                                    <td>{$row['catatan_staff']}</td>
                                                    <td>{$row['catatan_lurah']}</td>
                                                    <td>";

                                                if ($row['status'] == 'disahkan_lurah') {
                                                    echo "<a href='generate_pdf.php?id={$row['id_surat']}' class='btn btn-primary btn-xs'><i class='fa fa-download'></i> Cetak</a>";
                                                } else {
                                                    echo "-";
                                                }

                                                echo "</td></tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <?php include "content_footer.php"; ?>
    </div>
    <?php include "bundle_script.php"; ?>
</body>

</html>