<?php
include "koneksi.php";
include "auth_middleware.php";
check_login();
check_role(['admin']);

$role_name = $_SESSION['role_name'];
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
                <h1>Monitoring Seluruh Permohonan</h1>
                <p>Admin dapat memantau seluruh status permohonan surat di sistem.</p>
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
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT p.*, d.nama_lengkap FROM permohonan_sk p 
                                              JOIN penduduk d ON p.id_penduduk = d.id_penduduk 
                                              ORDER BY p.tanggal_permohonan DESC";
                                        $res = mysqli_query($konek, $query);

                                        $no = 0;
                                        while ($row = mysqli_fetch_array($res)) {
                                            $no++;
                                            $status_label = 'default';
                                            $status_text = $row['status'];

                                            if ($row['status'] == 'menunggu_staff') {
                                                $status_label = 'warning';
                                                $status_text = 'Menunggu Staff';
                                            }
                                            if ($row['status'] == 'disetujui_staff') {
                                                $status_label = 'info';
                                                $status_text = 'Disetujui Staff';
                                            }
                                            if ($row['status'] == 'ditolak_staff') {
                                                $status_label = 'danger';
                                                $status_text = 'Ditolak Staff';
                                            }
                                            if ($row['status'] == 'disahkan_lurah') {
                                                $status_label = 'success';
                                                $status_text = 'Disahkan Lurah';
                                            }
                                            if ($row['status'] == 'ditolak_lurah') {
                                                $status_label = 'danger';
                                                $status_text = 'Ditolak Lurah';
                                            }

                                            echo "
                                            <tr>
                                                <td>$no</td>
                                                <td>{$row['nama_lengkap']}</td>
                                                <td>{$row['jenis_permohonan']}</td>
                                                <td>{$row['tanggal_permohonan']}</td>
                                                <td><span class='label label-$status_label'>$status_text</span></td>
                                                <td>{$row['keterangan']}</td>
                                            </tr>";
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
    <script>
        $(function () {
            $("#data").DataTable();
        });
    </script>
</body>

</html>