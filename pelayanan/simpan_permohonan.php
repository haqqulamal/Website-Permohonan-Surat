<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['penduduk']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('pelayanan/permohonan_baru.php');
}

$id_penduduk = $_SESSION['id_penduduk'];
$keterangan = clean_input($_POST['keterangan']);
$tanggal_permohonan = date('Y-m-d');

$stmt = mysqli_prepare($conn, "INSERT INTO permohonan_sk (id_penduduk, keterangan, tanggal_permohonan, status) VALUES (?, ?, ?, 'menunggu_staff')");
mysqli_stmt_bind_param($stmt, "iss", $id_penduduk, $keterangan, $tanggal_permohonan);

if (mysqli_stmt_execute($stmt)) {
    set_flash('success', 'Permohonan berhasil dikirim!');
} else {
    set_flash('error', 'Gagal mengirim permohonan!');
}

redirect('pelayanan/riwayat.php');
?>