<?php
include "koneksi.php";
include "auth_middleware.php";
check_login();
include "alert/loadalert.php";

$nama_lengkap = mysqli_real_escape_string($konek, $_POST["nama_lengkap"]);
$email = mysqli_real_escape_string($konek, $_POST["email"]);
$role_name = mysqli_real_escape_string($konek, $_POST["role"]);
$username = mysqli_real_escape_string($konek, $_POST["username"]);
$password = password_hash($_POST["password"], PASSWORD_BCRYPT);

// Map role name to id_role
$role_query = mysqli_query($konek, "SELECT id_role FROM roles WHERE role_name = '$role_name'");
$role_data = mysqli_fetch_array($role_query);
$id_role = $role_data ? $role_data['id_role'] : 0;

$query = "INSERT INTO user (nama_lengkap, email, role, id_role, username, password) 
          VALUES ('$nama_lengkap', '$email', '$role_name', '$id_role', '$username', '$password')";

if ($add = mysqli_query($konek, $query)) {
        echo " 
    <script>
        setTimeout(function () {  
            swal({
                title: 'Sukses',
                text:  'User Berhasil Di Simpan!!',
                type: 'success',
                timer: 1900,
                showConfirmButton: true
            });  
        }, 90); 
        window.setTimeout(function(){ 
            window.location.replace('user.php');
        }, 1900); 
    </script>
    ";
        exit();
}
die("Terdapat kesalahan : " . mysqli_error($konek));
?>