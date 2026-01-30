<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('auth/login.php');
}

$username = clean_input($_POST['username']);
$password = $_POST['password'];

// Query login table with prepared statement
$stmt = mysqli_prepare($conn, "SELECT login.*, user.nama_lengkap, user.role, user.role as role_name 
                                FROM login 
                                LEFT JOIN user ON login.id_user = user.id_user 
                                WHERE login.username = ?");
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

// If not found in user table, check penduduk
if ($user && empty($user['id_user']) && !empty($user['id_penduduk'])) {
    $stmt2 = mysqli_prepare($conn, "SELECT login.*, penduduk.nama_lengkap, 'penduduk' as role_name 
                                     FROM login 
                                     LEFT JOIN penduduk ON login.id_penduduk = penduduk.id_penduduk 
                                     WHERE login.username = ?");
    mysqli_stmt_bind_param($stmt2, "s", $username);
    mysqli_stmt_execute($stmt2);
    $result2 = mysqli_stmt_get_result($stmt2);
    $user = mysqli_fetch_assoc($result2);
}

// Verify password
if ($user && password_verify($password, $user['password'])) {
    // Set session
    $_SESSION['id_login'] = $user['id_login'];
    $_SESSION['id_user'] = $user['id_user'] ?? null;
    $_SESSION['id_penduduk'] = $user['id_penduduk'] ?? null;
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
    $_SESSION['role_name'] = $user['role_name'];

    set_flash('success', 'Login berhasil! Selamat datang, ' . $user['nama_lengkap']);
    redirect('index.php');
} else {
    set_flash('error', 'Username atau password salah!');
    redirect('auth/login.php');
}
?>