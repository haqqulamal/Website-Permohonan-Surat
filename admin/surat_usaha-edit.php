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
            Buat Surat Perizinan Usaha
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-book"></i> Buat Surat Perizinan Usaha</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">

<?php
include "../koneksi.php";
$id_surat_usaha = $_GET['id_surat_usaha'];

$querymatakuliah = mysqli_query($konek, "SELECT * FROM surat_usaha 
                                                    INNER JOIN penduduk ON penduduk.id_penduduk = surat_usaha.id_penduduk
                                                      WHERE id_surat_usaha='$id_surat_usaha'");
if($querymatakuliah == false){
  die ("Terjadi Kesalahan : ". mysqli_error($konek));
}
while($matakuliah = mysqli_fetch_array($querymatakuliah)){

?>
					<div class='col-md-12'>
              <div class='box box-info'>
                <div class='box-header with-border'>
                  <h3 class='box-title'>Edit Data Buat Surat Perizinan Usaha</h3>
                </div>
              <div class='box-body'>
              <form method='POST' class='form-horizontal' action='surat_usaha-proses-edit' enctype="multipart/form-data">
                <div class='col-md-12'>
                  <table class='table table-condensed table-bordered'>
                  <tbody>

                  <tr><th scope='row'>id_surat_usaha</th> <td><input type='text' readonly class='form-control' name='id_surat_usaha' value="<?php echo $matakuliah["id_surat_usaha"]; ?>"> </td></tr>  


                  <tr><th scope='row'>nomor_surat</th> <td><input type='text' class='form-control' name='nomor_surat' 
                      required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                      value="<?php echo $matakuliah["nomor_surat"]; ?>"> </td></tr>

                <tr><th scope='row'>Nama Penduduk</th> <td>
                <select class='form-control' name='id_penduduk' required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')">
                <option value="<?php echo $matakuliah["id_penduduk"]; ?>"><?php echo $matakuliah["nama_lengkap"]; ?></option>
                <?php
                include "../koneksi.php";

                //display values in combobox/dropdown
                $result = mysqli_query($konek,"SELECT * FROM penduduk ");
                  while($row = mysqli_fetch_assoc($result)){
                     echo "<option value=$row[id_penduduk]>$row[nama_lengkap]</option>";
                    }
                ?>
                </select>
                </td></tr>  

                  <tr><th scope='row'>tempat_tanggal_lahir</th> <td><input type='text' class='form-control' name='tempat_tanggal_lahir' 
                      required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                      value="<?php echo $matakuliah["tempat_tanggal_lahir"]; ?>"> </td></tr>  

                  <tr><th scope='row'>alamat_tempat_tinggal</th> <td><input type='text' class='form-control' name='alamat_tempat_tinggal' 
                      required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                      value="<?php echo $matakuliah["alamat_tempat_tinggal"]; ?>"> </td></tr> 

                      <tr><th scope='row'>jenis_usaha</th> <td><input type='text' class='form-control' name='jenis_usaha' 
                      required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                      value="<?php echo $matakuliah["jenis_usaha"]; ?>"> </td></tr>  

                      <tr><th scope='row'>tanggal_surat</th> <td><input type='date' class='form-control' name='created_at' 
                      required oninvalid="this.setCustomValidity('Data tidak boleh kosong')" oninput="setCustomValidity('')"
                      value="<?php echo $matakuliah["created_at"]; ?>"> </td></tr>    


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
