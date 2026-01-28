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
<style type="text/css">
  /* ... (keeping existing styles) ... */
</style>

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
    <?php include "content_header.php"; ?>
    <?php include "menu.php"; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>Dashboard <?php echo ucfirst($role_name); ?></h1>
        <ol class="breadcrumb">
          <li><i class="fa fa-home"></i> Dashboard</li>
        </ol>
      </section>

      <section class="content">
        <div class="row">
          <?php if ($role_name == 'penduduk'): ?>
            <!-- Penduduk Dashboard View -->
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-red">
                <div class="inner">
                  <?php
                  $sql = "SELECT COUNT(*) as total FROM permohonan_sk WHERE id_penduduk = '$id_penduduk' AND jenis_permohonan='Kepemilikan Tanah'";
                  $res = mysqli_query($konek, $sql);
                  $row = mysqli_fetch_assoc($res);
                  echo "<h3>" . $row['total'] . "</h3>";
                  ?>
                  <p>Surat Keterangan<br>Kepemilikan Tanah</p>
                </div>
                <div class="icon"><i class="fa fa-file-picture-o"></i></div>
                <a href="kepemilikan_tanah.php" class="small-box-footer">Ajukan Permohonan.. <i
                    class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-yellow">
                <div class="inner">
                  <?php
                  $sql = "SELECT COUNT(*) as total FROM permohonan_sk WHERE id_penduduk = '$id_penduduk' AND jenis_permohonan='Perizinan Usaha'";
                  $res = mysqli_query($konek, $sql);
                  $row = mysqli_fetch_assoc($res);
                  echo "<h3>" . $row['total'] . "</h3>";
                  ?>
                  <p>Surat Keterangan<br>Perizinan Usaha</p>
                </div>
                <div class="icon"><i class="fa fa-file-pdf-o"></i></div>
                <a href="perizinan_usaha.php" class="small-box-footer">Ajukan Permohonan.. <i
                    class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          <?php endif; ?>

          <?php if (in_array($role_name, ['jagabaya', 'ulu-ulu', 'lurah', 'admin'])): ?>
            <!-- Staff/Admin Dashboard View -->
            <div class="col-lg-3 col-xs-6">
              <div class="small-box bg-aqua">
                <div class="inner">
                  <?php
                  $where = "WHERE 1=1";
                  if ($role_name == 'jagabaya')
                    $where .= " AND jenis_permohonan='Kepemilikan Tanah' AND status='menunggu_staff'";
                  if ($role_name == 'ulu-ulu')
                    $where .= " AND jenis_permohonan='Perizinan Usaha' AND status='menunggu_staff'";
                  if ($role_name == 'lurah')
                    $where .= " AND status='disetujui_staff'";

                  $sql = "SELECT COUNT(*) as total FROM permohonan_sk $where";
                  $res = mysqli_query($konek, $sql);
                  $row = mysqli_fetch_assoc($res);
                  echo "<h3>" . $row['total'] . "</h3>";
                  ?>
                  <p>Permohonan Masuk</p>
                </div>
                <div class="icon"><i class="fa fa-envelope"></i></div>
                <?php
                $link = "persetujuan_permohonan.php";
                if ($role_name == 'lurah')
                  $link = "pengesahan_sk.php";
                if ($role_name == 'admin')
                  $link = "permohonan_sk.php";
                ?>
                <a href="<?php echo $link; ?>" class="small-box-footer">Lihat Detail.. <i
                    class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
          <?php endif; ?>

        </div>
      </section>
    </div>
    <?php include "content_footer.php"; ?>
  </div>


  <!-- jQuery 2.1.4 -->
  <script src="../aset/plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="../aset/bootstrap/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="../aset/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../aset/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="../aset/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="../aset/plugins/fastclick/fastclick.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../aset/dist/js/app.min.js"></script>

</body>

</html>