<?php
include "koneksi.php";
session_start();

// Cek apakah pengguna sudah login dan memiliki role admin atau petugas
if (!isset($_SESSION['Login']) || $_SESSION['Login'] !== true || !in_array($_SESSION['role'], ['pejabat', 'penduduk'])) {
    header("Location: logout.php");
    exit();
}
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
            SK Disetujui
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-book"></i> SK Disetujui</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">

<?php
include "../koneksi.php";
$id_sk = $_GET['id_sk'];

$querymatakuliah = mysqli_query($konek, "SELECT * FROM sk_disetujui 
                                                  INNER JOIN permohonan_sk ON permohonan_sk.id_surat = sk_disetujui.id_surat
                                                      WHERE id_sk='$id_sk'");
if($querymatakuliah == false){
  die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($matakuliah = mysqli_fetch_array($querymatakuliah)){

?>
					<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data SK Disetujui</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='sk_disetujui-proses-edit' enctype="multipart/form-data">
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>

                  <tr><th scope='row'>id_sk</th> <td><input type='text' readonly class='form-control' name='id_sk' value="<?php echo $matakuliah["id_sk"]; ?>"> </td></tr>


                  <tr><th scope='row'>Pilih No Surat Yang Telah Disetujui</th> <td>
                <select class='form-control' name='id_surat' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                <option value="<?php echo $matakuliah["id_surat"]; ?>"><?php echo $matakuliah["id_surat"]; ?> - <?php echo $matakuliah["keterangan"]; ?></option>
                <?php
                include "../koneksi.php";

                //display values in combobox/dropdown
                $result = mysqli_query($konek,"SELECT * FROM permohonan_sk WHERE status = 'disetujui'");
                  while($row = mysqli_fetch_assoc($result)){
                     echo "<option value=$row[id_surat]>$row[id_surat] - $row[keterangan]</option>";
                    }
                ?>
                </select>
                </td></tr> 

                <tr><th scope='row'>nomor_sk</th> <td><input type='text' class='form-control' name='nomor_sk' 
                      required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                      value="<?php echo $matakuliah["nomor_sk"]; ?>"> </td></tr>   

                      <tr><th scope='row'>tanggal_sk</th> <td><input type='date' class='form-control' name='tanggal_sk' 
                      required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                      value="<?php echo $matakuliah["tanggal_sk"]; ?>"> </td></tr>

                  <tr><th scope='row'>created_at_disetujui</th> <td><input type='date' class='form-control' name='created_at_disetujui' 
                      required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                      value="<?php echo $matakuliah["created_at_disetujui"]; ?>"> </td></tr>


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
		include	"content_footer.php";
	?>
    </div><!-- ./wrapper -
	<!-- Library Scripts -->
	<?php
		include "bundle_script.php";
  }
	?>
  </body>
</html>
