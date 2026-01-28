<?php
session_start();
include "koneksi.php";

$username = mysqli_real_escape_string($konek, $_POST["username"]);
$password = $_POST["password"];

if (!empty($username) && !empty($password)) {
    // Fetch user with role info
    $query = mysqli_query($konek, "SELECT u.*, r.role_name FROM user u 
                                   LEFT JOIN roles r ON u.id_role = r.id_role 
                                   WHERE u.username='$username'");
    $user = mysqli_fetch_array($query);

    if ($user && password_verify($password, $user["password"])) {
        $_SESSION["id_user"] = $user["id_user"];
        $_SESSION["id_penduduk"] = $user["id_penduduk"];
        $_SESSION["nama_lengkap"] = $user["nama_lengkap"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["id_role"] = $user["id_role"];
        $_SESSION["role_name"] = $user["role_name"];
        $_SESSION["Login"] = true;

        // All roles go to admin/index for dashboard routing
        header("Location: admin/index.php");
        exit();
    } else {
        header("Location: index.php?Err=1");
        exit();
    }
} else {
    header("Location: index.php?Err=2");
    exit();
}
?>