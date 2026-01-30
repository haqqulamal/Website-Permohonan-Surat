<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['jagabaya', 'ulu-ulu']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('persetujuan/index.php');
}

$id_surat = intval($_POST['id_surat']);
$status_persetujuan = clean_input($_POST['status_persetujuan']);
$catatan = clean_input($_POST['catatan']);
$id_user = $_SESSION['id_user'];

$final_status = ($status_persetujuan == 'disetujui') ? 'disetujui_staff' : 'ditolak_staff';

// Start transaction
mysqli_begin_transaction($conn);

try {
    // 1. Insert into persetujuan_permohonan (New Table)
    $stmt = mysqli_prepare($conn, "INSERT INTO persetujuan_permohonan (id_surat, id_user, tanggal_approval, status, catatan) VALUES (?, ?, ?, ?, ?)");
    $tanggal = date('Y-m-d');
    mysqli_stmt_bind_param($stmt, "iisss", $id_surat, $id_user, $tanggal, $final_status, $catatan);
    mysqli_stmt_execute($stmt);

    // 2. If Approved, create Draft SK in sk_disetujui (New Table)
    if ($final_status == 'disetujui_staff') {
        $nomor_sk = '470/' . $id_surat . '/SK/' . date('Y');
        $stmt2 = mysqli_prepare($conn, "INSERT INTO sk_disetujui (id_surat, nomor_sk, tanggal_sk) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt2, "iss", $id_surat, $nomor_sk, $tanggal);
        mysqli_stmt_execute($stmt2);
    }

    // 3. Update Status in Main Table (For View Compatibility)
    $stmt3 = mysqli_prepare($conn, "UPDATE permohonan_sk SET status = ?, catatan_staff = ? WHERE id_surat = ?");
    mysqli_stmt_bind_param($stmt3, "ssi", $final_status, $catatan, $id_surat);
    mysqli_stmt_execute($stmt3);

    mysqli_commit($conn);
    set_flash('success', 'Keputusan staff berhasil disimpan!');
} catch (Exception $e) {
    mysqli_rollback($conn);
    set_flash('error', 'Gagal menyimpan keputusan: ' . $e->getMessage());
}

redirect('persetujuan/index.php');
?>