<?php
$role_name = isset($_SESSION['role_name']) ? $_SESSION['role_name'] : '';
?>

<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="header">
        <h4><b>
            <center>Dashboard</center>
          </b></h4>
      </li>
      <li class="active"><a href="index.php"><i class="fa fa-home"></i><span>Dashboard</span></a></li>

      <?php if ($role_name === 'admin'): ?>
        <li><a href="#"><i class="fa fa-folder"></i> <span>Master Data</span><i
              class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="user.php"><i class="fa fa-circle-o"></i><span>User</span></a></li>
            <li><a href="penduduk.php"><i class="fa fa-circle-o"></i><span>Penduduk</span></a></li>
          </ul>
        </li>
      <?php endif; ?>

      <?php if (in_array($role_name, ['penduduk', 'admin'])): ?>
        <li><a href="#"><i class="fa fa-book"></i> <span>Pelayanan</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="kepemilikan_tanah.php"><i class="fa fa-circle-o"></i><span>Kepemilikan Tanah</span></a></li>
            <li><a href="perizinan_usaha.php"><i class="fa fa-circle-o"></i><span>Perizinan Usaha</span></a></li>
          </ul>
        </li>
      <?php endif; ?>

      <?php if (in_array($role_name, ['jagabaya', 'ulu-ulu', 'admin'])): ?>
        <li><a href="#"><i class="fa fa-file"></i> <span>Persetujuan</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="persetujuan_permohonan.php"><i class="fa fa-circle-o"></i><span>Verifikasi Staff</span></a></li>
          </ul>
        </li>
      <?php endif; ?>

      <?php if (in_array($role_name, ['lurah', 'admin'])): ?>
        <li><a href="#"><i class="fa fa-pencil"></i> <span>Pengesahan</span><i
              class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="pengesahan_sk.php"><i class="fa fa-circle-o"></i><span>Tanda Tangan Lurah</span></a></li>
          </ul>
        </li>
      <?php endif; ?>

      <li><a href="#"><i class="fa fa-thumbs-o-up"></i> <span>Arsip Surat</span><i
            class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
          <li><a href="sk_disahkan.php"><i class="fa fa-circle-o"></i><span>Daftar Surat Selesai</span></a></li>
        </ul>
      </li>

      <?php if ($role_name === 'admin'): ?>
        <li><a href="#"><i class="fa fa-print"></i> <span>Laporan</span><i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="cetak_penduduk.php" target="_blank"><i class="fa fa-circle-o"></i><span>Penduduk</span></a></li>
            <li><a href="cetak_permohonan_sk_usaha.php" target="_blank"><i class="fa fa-circle-o"></i><span>Laporan SK
                  61: Usaha</span></a></li>
            <li><a href="cetak_permohonan_sk_tanah.php" target="_blank"><i class="fa fa-circle-o"></i><span>Laporan SK
                  63: Tanah</span></a></li>
          </ul>
        </li>
      <?php endif; ?>
    </ul>
  </section>
</aside>