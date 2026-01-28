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
  <link rel="shortcut icon" type="image/icon" href="../logopulpis1.png">
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
  <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../aset/dist/css/skins/_all-skins.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php
    include 'content_header.php';
    ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php
    include 'menu.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Cabang Olahraga
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-book"></i> Cabang Olahraga</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <?php
          include "../koneksi.php";
          $id_penduduk = $_GET['id_penduduk'];

          $querymatakuliah = mysqli_query($konek, "SELECT * FROM penduduk WHERE id_penduduk='$id_penduduk'");
          if ($querymatakuliah == false) {
            die("Terjadi Kesalahan : " . mysqli_error($konek));
          }
          while ($matakuliah = mysqli_fetch_array($querymatakuliah)) {

            ?>
            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Cabang Olahraga</h3>
                </div>
                <div class='box-body'>
                  <form method='POST' class='form-horizontal' action='penduduk-proses-edit' enctype="multipart/form-data">
                    <div class='col-md-12'>
                      <table class='table table-condensed table-bordered'>
                        <tbody>

                          <input type='hidden' class='form-control' name='id_penduduk'
                            value="<?php echo $matakuliah["id_penduduk"]; ?>" />


                          <tr>
                            <th scope='row'>nik</th>
                            <td><input type='text' class='form-control' name='nik'
                                value="<?php echo $matakuliah["nik"]; ?>" required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')"> </td>
                          </tr>

                          <tr>
                            <th scope='row'>nama_lengkap</th>
                            <td><input type='text' class='form-control' name='nama_lengkap'
                                value="<?php echo $matakuliah["nama_lengkap"]; ?>" required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')"> </td>
                          </tr>

                          <tr>
                            <th scope='row'>alamat</th>
                            <td><input type='text' class='form-control' name='alamat'
                                value="<?php echo $matakuliah["alamat"]; ?>" required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')"> </td>
                          </tr>

                          <tr>
                            <th scope='row'>no_telp</th>
                            <td><input type='text' class='form-control' name='no_telp'
                                value="<?php echo $matakuliah["no_telp"]; ?>" required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')"> </td>
                          </tr>

                          <tr>
                            <th scope='row'>email</th>
                            <td><input type='email' class='form-control' name='email'
                                value="<?php echo $matakuliah["email"]; ?>" required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')"> </td>
                          </tr>


                        </tbody>
                      </table>
                    </div>
                </div>
                <div class='box-footer'>
                  <button type='submit' name='submit' class='btn btn-info'>Simpan</button>
                  <button value="Go Back" onclick="history.back(-1)" class='btn btn-default pull-right'>Cancel</button>

                </div>
                </form>
              </div>
              </table>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
    </section><!-- /.content -->

    <!-- Modal Popup Dosen -->

    <?php
    include "content_footer.php";
    ?>
    </div><!-- ./wrapper -
  <!-- Library Scripts -->
    <?php
    include "bundle_script.php";
          }
          ?>
</body>

</html>