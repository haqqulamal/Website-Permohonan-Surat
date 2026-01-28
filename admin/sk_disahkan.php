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
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
                <h1>Arsip Surat Disahkan</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-book"></i> Arsip Surat</li>
                </ol>
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
                                            <th>Nama Penduduk</th>
                                            <th>Jenis Surat</th>
                                            <th>Status</th>
                                            <th>Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $where = "WHERE status = 'disahkan_lurah'";
                                        if ($role_name == 'penduduk') {
                                            $where .= " AND p.id_penduduk = '$id_penduduk'";
                                        }

                                        $query = "SELECT p.*, d.nama_lengkap FROM permohonan_sk p 
                                              JOIN penduduk d ON p.id_penduduk = d.id_penduduk 
                                              $where";
                                        $res = mysqli_query($konek, $query);

                                        $no = 0;
                                        while ($row = mysqli_fetch_array($res)) {
                                            $no++;
                                            echo "
                                            <tr>
                                                <td>$no</td>
                                                <td>{$row['nama_lengkap']}</td>
                                                <td>{$row['jenis_permohonan']}</td>
                                                <td><span class='label label-success'>Disahkan Lurah</span></td>
                                                <td>
                                                    <a href='generate_pdf.php?id={$row['id_surat']}' class='btn btn-primary btn-sm'>
                                                        <i class='fa fa-download'></i> Download PDF
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


<!-- /.content -->

<div id="ModalEditDosen" class="modal fade" tabindex="-1" role="dialog"></div>

<!-- Modal Popup untuk delete-->
<div class="modal fade" id="modal_delete">
    <div class="modal-dialog">
        <div class="modal-content" style="margin-top:100px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" style="text-align:center;">Yakin Ingin Hapus Data Ini ?</h4>
            </div>
            <div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;">
                <a href="#" class="btn btn-danger" id="delete_link">Delete</a>
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- /.Modal Popup untuk delete-->
</div><!-- /.content-wrapper -->
<?php include "content_footer.php"; ?>
</div><!-- ./wrapper -->
<!-- Library Scripts -->
<?php include "bundle_script.php"; ?>
<script>
    window.setTimeout(function () {
        $(".alert-success").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 5000);

    window.setTimeout(function () {
        $(".alert-info").fadeTo(500, 0).slideUp(500, function () {
            $(this).remove();
        });
    }, 7000); 
</script>
</body>

</html>