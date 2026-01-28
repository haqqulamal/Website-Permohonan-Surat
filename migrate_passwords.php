<?php
include "admin/koneksi.php";

// Fetch all users
$query = mysqli_query($konek, "SELECT id_user, password FROM user");

while ($row = mysqli_fetch_assoc($query)) {
    $id = $row['id_user'];
    $plain_password = $row['password'];
    
    // Only hash if it's not already a Bcrypt hash (Bcrypt hashes start with $2y$)
    if (strpos($plain_password, '$2y$') !== 0) {
        $hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);
        mysqli_query($konek, "UPDATE user SET password = '$hashed_password' WHERE id_user = $id");
        echo "Updated user ID $id\n";
    } else {
        echo "User ID $id already hashed\n";
    }
}

echo "Password re-hashing completed.\n";
?>
