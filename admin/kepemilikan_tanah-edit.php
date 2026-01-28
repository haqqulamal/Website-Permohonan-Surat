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
          Kepemilikan Tanah
        </h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-book"></i> Kepemilikan Tanah</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <?php
          include "../koneksi.php";
          $id_surat = $_GET['id_surat'];

          $querymatakuliah = mysqli_query($konek, "SELECT * FROM permohonan_sk 
                                                      INNER JOIN penduduk ON penduduk.id_penduduk = permohonan_sk.id_penduduk
                                                      INNER JOIN user ON user.id_user = permohonan_sk.id_user
                                                      WHERE id_surat='$id_surat'");
          if ($querymatakuliah == false) {
            die("Terjadi Kesalahan : " . mysqli_error($konek));
          }
          while ($matakuliah = mysqli_fetch_array($querymatakuliah)) {

            ?>
            <div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Kepemilikan Tanah</h3>
                </div>
                <div class='box-body'>
                  <form method='POST' class='form-horizontal' action='kepemilikan_tanah-proses-edit'
                    enctype="multipart/form-data">
                    <div class='col-md-12'>
                      <table class='table table-condensed table-bordered'>
                        <tbody>

                          <tr>
                            <th scope='row'>id_surat</th>
                            <td><input type='text' readonly class='form-control' name='id_surat'
                                value="<?php echo $matakuliah["id_surat"]; ?>"> </td>
                          </tr>


                          <tr>
                            <th scope='row'>Nama Penduduk</th>
                            <td>
                              <select class='form-control' name='id_penduduk' required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')">
                                <option value="<?php echo $matakuliah["id_penduduk"]; ?>">
                                  <?php echo $matakuliah["nama_lengkap"]; ?></option>
                                <?php
                                include "../koneksi.php";

                                //display values in combobox/dropdown
                                $result = mysqli_query($konek, "SELECT * FROM penduduk");
                                while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value=$row[id_penduduk]>$row[nama_lengkap]</option>";
                                }
                                ?>
                              </select>
                            </td>
                          </tr>



                          <tr hidden>
                            <th scope='row'>jenis_permohonan</th>
                            <td>
                              <select class='form-control' name='jenis_permohonan' required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')">
                                <option value="<?php echo $matakuliah["jenis_permohonan"]; ?>">
                                  <?php echo $matakuliah["jenis_permohonan"]; ?></option>
                                <option value="Kepemilikan Tanah">Kepemilikan Tanah</option>
                                <option value="Perizinan Usaha">Perizinan Usaha</option>
                              </select>
                            </td>
                          </tr>

                          <tr>
                            <th scope='row'>keterangan</th>
                            <td><input type='text' class='form-control' name='keterangan'
                                value="<?php echo $matakuliah["keterangan"]; ?>" required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')"> </td>
                          </tr>

                          <tr>
                            <th scope='row'>tanggal_permohonan</th>
                            <td><input type='date' class='form-control' name='tanggal_permohonan'
                                value="<?php echo $matakuliah["tanggal_permohonan"]; ?>" required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')"> </td>
                          </tr>

                          <tr>
                            <th scope='row'>Status</th>
                            <td>
                              <select class='form-control' name='status' required
                                oninvalid="this.setCustomValidity('Data tidak boleh kosong')"
                                oninput="setCustomValidity('')">
                                <option value="<?php echo $matakuliah["status"]; ?>"><?php echo $matakuliah["status"]; ?>
                                </option>
                                <option value="Diajukan">Diajukan</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                              </select>
                            </td>
                          </tr>

                          <tr hidden>
                            <th scope='row'>user</th>
                            <td><input type='text' class='form-control' name='id_user'
                                value="<?php echo $matakuliah["id_user"]; ?>"> </td>
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