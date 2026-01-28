<?php
include "koneksi.php";
include "auth_middleware.php";
check_login();
include "alert/loadalert.php";

$id_user = $_SESSION["id_user"];
$id_penduduk = $_SESSION["id_penduduk"];
$jenis_permohonan = "Perizinan Usaha";
$keterangan = mysqli_real_escape_string($konek, $_POST["keterangan"]);
$tanggal_permohonan = mysqli_real_escape_string($konek, $_POST["tanggal_permohonan"]);
$status = "menunggu_staff";

$query = "INSERT INTO permohonan_sk (id_user, id_penduduk, jenis_permohonan, keterangan, tanggal_permohonan, status) 
          VALUES ('$id_user', '$id_penduduk', '$jenis_permohonan', '$keterangan', '$tanggal_permohonan', '$status')";

if ($add = mysqli_query($konek, $query)) {
        echo " 
    <script>
        setTimeout(function () {  
            swal({
                title: 'Sukses',
                text:  'Permohonan Berhasil Di Simpan!!',
                type: 'success',
                timer: 1900,
                showConfirmButton: true
            });  
        }, 90); 
        window.setTimeout(function(){ 
            window.location.replace('perizinan_usaha.php');
        }, 1900); 
    </script>
    ";
        exit();
}
die("Terdapat kesalahan : " . mysqli_error($konek));
?>