<?php
include "koneksi.php";
include "auth_middleware.php";
check_login();

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
                <h1>Antrean Pengesahan Lurah</h1>
                <p>Silahkan tinjau dan sahkan permohonan yang telah disetujui Staff.</p>
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
                                            <th>Catatan Staff</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // We join with sk_disetujui to get the id_sk required for foreign keys
                                        $query = "SELECT p.*, d.nama_lengkap, s.id_sk FROM permohonan_sk p 
                                              JOIN penduduk d ON p.id_penduduk = d.id_penduduk 
                                              JOIN sk_disetujui s ON p.id_surat = s.id_surat
                                              WHERE p.status = 'disetujui_staff'";
                                        $res = mysqli_query($konek, $query);

                                        $no = 0;
                                        while ($row = mysqli_fetch_array($res)) {
                                            $no++;
                                            echo "
                                            <tr>
                                                <td>$no</td>
                                                <td>{$row['nama_lengkap']}</td>
                                                <td>{$row['jenis_permohonan']}</td>
                                                <td>{$row['catatan_staff']}</td>
                                                <td><span class='label label-info'>Disetujui Staff</span></td>
                                                <td>
                                                    <a href='pengesahan_sk-add.php?id_surat={$row['id_surat']}&id_sk={$row['id_sk']}' class='btn btn-success btn-sm'>
                                                        <i class='fa fa-check-square-o'></i> Sahkan
                                                    </a>
                                                </td>
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
</body>

</html>