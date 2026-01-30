<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['admin']);

$id = intval($_GET['id']);

// Check if deleting self
if ($id == $_SESSION['id_user']) {
    set_flash('error', 'Anda tidak bisa menghapus akun sendiri!');
    redirect('admin/user_index.php');
}

// Delete login first
mysqli_query($conn, "DELETE FROM login WHERE id_user = $id");

// Delete user
mysqli_query($conn, "DELETE FROM user WHERE id_user = $id");

set_flash('success', 'User berhasil dihapus!');
redirect('admin/user_index.php');
?>