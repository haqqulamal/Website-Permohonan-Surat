<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['admin']);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('admin/user_index.php');
}

$username = clean_input($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
$nama_lengkap = clean_input($_POST['nama_lengkap']);
$email = clean_input($_POST['email']);
$role = clean_input($_POST['role']);
$id_penduduk = !empty($_POST['id_penduduk']) ? intval($_POST['id_penduduk']) : null;

// Start transaction
mysqli_begin_transaction($conn);

try {
    // Insert into user table (only if not penduduk role)
    if ($role != 'penduduk') {
        $stmt = mysqli_prepare($conn, "INSERT INTO user (nama_lengkap, email, role) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $nama_lengkap, $email, $role);
        mysqli_stmt_execute($stmt);
        $id_user = mysqli_insert_id($conn);

        // Insert into login table
        $stmt2 = mysqli_prepare($conn, "INSERT INTO login (username, password, id_user, id_penduduk) VALUES (?, ?, ?, NULL)");
        mysqli_stmt_bind_param($stmt2, "ssi", $username, $password, $id_user);
        mysqli_stmt_execute($stmt2);
    } else {
        // For penduduk role, only create login entry linked to penduduk
        $stmt = mysqli_prepare($conn, "INSERT INTO login (username, password, id_user, id_penduduk) VALUES (?, ?, NULL, ?)");
        mysqli_stmt_bind_param($stmt, "ssi", $username, $password, $id_penduduk);
        mysqli_stmt_execute($stmt);
    }

    mysqli_commit($conn);
    set_flash('success', 'User berhasil ditambahkan!');
} catch (Exception $e) {
    mysqli_rollback($conn);
    set_flash('error', 'Gagal menambahkan user: ' . $e->getMessage());
}

redirect('admin/user_index.php');
?>