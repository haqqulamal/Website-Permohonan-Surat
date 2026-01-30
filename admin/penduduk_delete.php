<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['admin']);

$id = intval($_GET['id']);

mysqli_query($conn, "DELETE FROM penduduk WHERE id_penduduk = $id");

set_flash('success', 'Penduduk berhasil dihapus!');
redirect('admin/penduduk_index.php');
?>