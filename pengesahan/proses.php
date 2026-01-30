<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['lurah']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('pengesahan/index.php');
}

$id_surat = intval($_POST['id_surat']);
$status_pengesahan = clean_input($_POST['status_pengesahan']);
$catatan = clean_input($_POST['catatan']);

$final_status = ($status_pengesahan == 'Sahkan') ? 'disahkan_lurah' : 'ditolak_lurah';

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Find id_sk first
    $result = mysqli_query($conn, "SELECT id_sk FROM sk_disetujui WHERE id_surat = $id_surat");
    $row = mysqli_fetch_assoc($result);
    $id_sk = $row['id_sk'] ?? 0;

    // 1. Insert into pengesahan_sk (New Table)
    $stmt = mysqli_prepare($conn, "INSERT INTO pengesahan_sk (id_sk, tanggal_pengesahan, upload_sk) VALUES (?, ?, NULL)");
    $tanggal = date('Y-m-d');
    mysqli_stmt_bind_param($stmt, "is", $id_sk, $tanggal);
    mysqli_stmt_execute($stmt);
    $id_pengesahan = mysqli_insert_id($conn);

    // 2. If Approved, Finalize in sk_disahkan (New Table)
    if ($final_status == 'disahkan_lurah') {
        $upload_file = 'Surat_Final_' . $id_surat . '.pdf';
        $stmt2 = mysqli_prepare($conn, "INSERT INTO sk_disahkan (id_pengesahan, tanggal_disahkan, upload_sk_disahkan) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt2, "iss", $id_pengesahan, $tanggal, $upload_file);
        mysqli_stmt_execute($stmt2);
    }

    // 3. Update Status in Main Table (For View Compatibility)
    $stmt3 = mysqli_prepare($conn, "UPDATE permohonan_sk SET status = ?, catatan_lurah = ? WHERE id_surat = ?");
    mysqli_stmt_bind_param($stmt3, "ssi", $final_status, $catatan, $id_surat);
    mysqli_stmt_execute($stmt3);

    mysqli_commit($conn);
    set_flash('success', 'Pengesahan lurah berhasil disimpan!');
} catch (Exception $e) {
    mysqli_rollback($conn);
    set_flash('error', 'Gagal menyimpan pengesahan: ' . $e->getMessage());
}

redirect('pengesahan/index.php');
?>