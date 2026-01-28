<?php
include "koneksi.php";
include "auth_middleware.php";
check_login();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <?php include "../title.php"; ?>
    <!-- Icon -->
    <link rel="shortcut icon" type="image/icon" href="../pemuda.png">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../aset/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../aset/fa/css/font-awesome.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../aset/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../aset/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../aset/dist/css/skins/_all-skins.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <?php include 'content_header.php'; ?>
        <?php include 'menu.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>Buat Surat Keterangan Tanah</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-book"></i> Buat Surat Keterangan Tanah</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header"></div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <a href="surat_tanah-add"><button class="btn btn-success" type="button"><i
                                            class="fa fa-plus"></i> Tambah Data</button></a>
                                <br><br>
                                <table id="data" class="table table-bordered table-striped table-scalable">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Umur</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Alamat</th>
                                            <th>nomor_buku</th>
                                            <th>created_at</th>
                                            <?php if ($_SESSION['role'] === 'pejabat'): ?>
                                                <th>Action</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Mendapatkan id_user dan role dari sesi
                                        $id_user = $_SESSION['id_user'];
                                        $role = $_SESSION['role'];

                                        // Menentukan query berdasarkan role dan id_user
                                        if ($id_user == 3) {
                                            // Admin dengan id_user 3 dapat melihat semua data
                                            $query = "SELECT * FROM surat_tanah INNER JOIN penduduk ON penduduk.id_penduduk = surat_tanah.id_penduduk";
                                        } else {
                                            // Pengguna lain hanya dapat melihat data mereka sendiri
                                            $query = "SELECT * FROM surat_tanah INNER JOIN penduduk ON penduduk.id_penduduk = surat_tanah.id_penduduk 
                                                    WHERE user.id_user = '$id_user'";
                                        }

                                        // Menjalankan query
                                        $querymatakuliah = mysqli_query($konek, $query);

                                        if ($querymatakuliah == false) {
                                            die("Terdapat Kesalahan : " . mysqli_error($konek));
                                        }

                                        $no = 0;
                                        while ($matakuliah = mysqli_fetch_array($querymatakuliah)) {
                                            $no++;
                                            echo "
                                            <tr>
                                                <td>$no</td>
                                                <td>{$matakuliah['nama_lengkap']}</td>
                                                <td>{$matakuliah['umur']}</td>
                                                <td>{$matakuliah['tempat_lahir']}</td>
                                                <td>{$matakuliah['tanggal_lahir']}</td>
                                                <td>{$matakuliah['alamat']}</td>
                                                <td>{$matakuliah['nomor_buku']}</td>
                                                <td>{$matakuliah['created_at']}</td> ";

                                            // Menampilkan opsi edit dan delete hanya untuk role pejabat
                                            if ($role === 'pejabat') {
                                                echo "
                                                <td>
                                                    <a href='surat_tanah-edit.php?id_surat_tanah={$matakuliah['id_surat_tanah']}' id='{$matakuliah['id_surat_tanah']}'>Edit</a>  <br>
                                                    <a href='#' onClick='confirm_delete(\"surat_tanah-delete.php?id_surat_tanah={$matakuliah['id_surat_tanah']}\")'>Delete</a> <br>
                                                    <a href='cetak_surat_tanah.php?id_surat_tanah={$matakuliah['id_surat_tanah']}' target='_blank' id='{$matakuliah['id_surat_tanah']}'>Cetak</a>

                                                </td>";
                                            }

                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section><!-- /.content -->

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