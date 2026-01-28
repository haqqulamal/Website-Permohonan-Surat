<?php
include "../koneksi.php";
include "alert/loadalert.php";
include "auth_middleware.php";
check_login();
check_role(['lurah', 'admin']);

$id_surat = mysqli_real_escape_string($konek, $_POST["id_surat"]);
$id_sk = mysqli_real_escape_string($konek, $_POST["id_sk"]);
$status_pengesahan = mysqli_real_escape_string($konek, $_POST["status_pengesahan"]);
$catatan = mysqli_real_escape_string($konek, $_POST["catatan"]);

// Map status for permohonan_sk table
$final_status = ($status_pengesahan == 'Sahkan') ? 'disahkan_lurah' : 'ditolak_lurah';

// Update permohonan_sk table
$update_sql = "UPDATE permohonan_sk SET status = '$final_status', catatan_lurah = '$catatan' WHERE id_surat = '$id_surat'";

if (mysqli_query($konek, $update_sql)) {
    // If Sahkan, also populate legacy tables sk_disahkan & pengesahan_sk
    if ($final_status == 'disahkan_lurah') {
        $tanggal_pengesahan = date('Y-m-d');

        // 1. Insert into pengesahan_sk (Log table)
        mysqli_query($konek, "INSERT INTO pengesahan_sk (id_sk, tanggal_pengesahan, created_at_pengesahan) 
                              VALUES ('$id_sk', '$tanggal_pengesahan', NOW())");

        // Get the last inserted id for sk_disahkan FK if needed, 
        // but sk_disahkan references id_sk (which is sk_disetujui.id_sk)

        // 2. Insert into sk_disahkan (Arsip table)
        mysqli_query($konek, "INSERT INTO sk_disahkan (id_pengesahan, tanggal_disahkan, created_at_disahkan) 
                              VALUES ('$id_sk', '$tanggal_pengesahan', NOW())");
    }

    echo " 
    <script>
        setTimeout(function () {  
            swal({
                title: 'Sukses',
                text:  'Pengesahan Lurah Berhasil Di Simpan!!',
                type: 'success',
                timer: 1900,
                showConfirmButton: true
            });  
        }, 90); 
        window.setTimeout(function(){ 
            window.location.replace('pengesahan_sk.php');
        } , 1900); 
    </script>
    ";
    exit();
}

die("Terdapat kesalahan : " . mysqli_error($konek));
?>