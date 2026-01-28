<?php
include "koneksi.php";
include "auth_middleware.php";
check_login();
check_role(['lurah', 'admin']);
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
  <link rel="stylesheet" href="../aset/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../aset/dist/css/skins/_all-skins.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php include 'content_header.php'; ?>
    <?php include 'menu.php'; ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>Pengesahan SK (Lurah)</h1>
      </section>

      <section class="content">
        <div class="row">
          <div class='col-md-12'>
            <div class='box box-info'>
              <div class='box-header with-border'>
                <h3 class='box-title'>Form Pengesahan</h3>
              </div>
              <div class='box-body'>
                <form method='POST' class='form-horizontal' action='pengesahan_sk-aksi.php'>
                  <?php
                  $id_surat = isset($_GET['id_surat']) ? mysqli_real_escape_string($konek, $_GET['id_surat']) : '';
                  $id_sk = isset($_GET['id_sk']) ? mysqli_real_escape_string($konek, $_GET['id_sk']) : '';

                  $query = mysqli_query($konek, "SELECT p.*, d.nama_lengkap FROM permohonan_sk p JOIN penduduk d ON p.id_penduduk = d.id_penduduk WHERE p.id_surat = '$id_surat'");
                  $data = mysqli_fetch_assoc($query);
                  ?>
                  <input type="hidden" name="id_surat" value="<?php echo $id_surat; ?>">
                  <input type="hidden" name="id_sk" value="<?php echo $id_sk; ?>">

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Pemohon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?php echo $data['nama_lengkap']; ?>" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jenis Surat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?php echo $data['jenis_permohonan']; ?>" readonly>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Catatan Staff</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" readonly><?php echo $data['catatan_staff']; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Keputusan Lurah</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="status_pengesahan" required>
                        <option value="">-- Pilih Keputusan --</option>
                        <option value="Sahkan">Sahkan</option>
                        <option value="Tolak">Tolak</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Catatan Lurah</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="catatan"
                        placeholder="Berikan alasan jika ditolak atau catatan tambahan..." required></textarea>
                    </div>
                  </div>

                  <div class='box-footer'>
                    <button type='submit' class='btn btn-success'>Simpan Pengesahan</button>
                    <a href="pengesahan_sk.php" class='btn btn-default pull-right'>Batal</a>
                  </div>
                </form>
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