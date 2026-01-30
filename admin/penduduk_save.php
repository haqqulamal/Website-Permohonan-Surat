<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['admin']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('admin/penduduk_index.php');
}

$nik = clean_input($_POST['nik']);
$nama_lengkap = clean_input($_POST['nama_lengkap']);
$alamat = clean_input($_POST['alamat']);
$no_telp = clean_input($_POST['no_telp']);
$email = clean_input($_POST['email']);

$stmt = mysqli_prepare($conn, "INSERT INTO penduduk (nik, nama_lengkap, alamat, no_telp, email) VALUES (?, ?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "sssss", $nik, $nama_lengkap, $alamat, $no_telp, $email);

if (mysqli_stmt_execute($stmt)) {
    set_flash('success', 'Penduduk berhasil ditambahkan!');
} else {
    set_flash('error', 'Gagal menambahkan penduduk!');
}

redirect('admin/penduduk_index.php');
?>