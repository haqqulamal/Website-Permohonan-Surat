<?php
include "../koneksi.php";
include "alert/loadalert.php";
include "auth_middleware.php";
check_login();
check_role(['jagabaya', 'ulu-ulu', 'admin']);

$id_surat = mysqli_real_escape_string($konek, $_POST["id_surat"]);
$status_persetujuan = mysqli_real_escape_string($konek, $_POST["status_persetujuan"]);
$catatan = mysqli_real_escape_string($konek, $_POST["catatan"]);

// Map status for permohonan_sk table
$final_status = ($status_persetujuan == 'disetujui') ? 'disetujui_staff' : 'ditolak_staff';

// Update permohonan_sk table
$update_sql = "UPDATE permohonan_sk SET status = '$final_status', catatan_staff = '$catatan' WHERE id_surat = '$id_surat'";

if (mysqli_query($konek, $update_sql)) {
    // If approved, MUST insert into sk_disetujui for legacy FK compatibility
    if ($final_status == 'disetujui_staff') {
        $nomor_sk = "SK-" . str_pad($id_surat, 3, "0", STR_PAD_LEFT);
        $tanggal_sk = date('Y-m-d');
        // Check if already exists to avoid duplicates
        $check = mysqli_query($konek, "SELECT id_sk FROM sk_disetujui WHERE id_surat = '$id_surat'");
        if (mysqli_num_rows($check) == 0) {
            mysqli_query($konek, "INSERT INTO sk_disetujui (id_surat, nomor_sk, tanggal_sk, created_at_disetujui) 
                                  VALUES ('$id_surat', '$nomor_sk', '$tanggal_sk', NOW())");
        }
    }

    // Log action
    $id_user = $_SESSION['id_user'];
    $tanggal_approval = date('Y-m-d');
    mysqli_query($konek, "INSERT INTO persetujuan_permohonan (id_surat, id_user, tanggal_approval, status_persetujuan, catatan, created_at) 
                          VALUES ('$id_surat', '$id_user', '$tanggal_approval', '$status_persetujuan', '$catatan', NOW())");

    echo " 
    <script>
        setTimeout(function () {  
            swal({
                title: 'Sukses',
                text:  'Keputusan Staff Berhasil Di Simpan!!',
                type: 'success',
                timer: 1900,
                showConfirmButton: true
            });  
        }, 90); 
        window.setTimeout(function(){ 
            window.location.replace('persetujuan_permohonan.php');
        } ,1900); 
    </script>
    ";
    exit();
}

die("Terdapat kesalahan : " . mysqli_error($konek));
?>