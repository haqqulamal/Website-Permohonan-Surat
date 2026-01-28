<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Check if user is logged in
 */
function check_login()
{
    if (!isset($_SESSION['Login']) || $_SESSION['Login'] !== true) {
        header("Location: ../index.php?error=session_expired");
        exit();
    }
}

/**
 * Check if user has required role
 * @param array $allowed_roles Array of strings (role names)
 */
function check_role($allowed_roles)
{
    if (!isset($_SESSION['role_name']) || !in_array($_SESSION['role_name'], $allowed_roles)) {
        header("Location: index.php?error=unauthorized");
        exit();
    }
}

/**
 * Get role name from id_role
 */
function get_role_name($id_role, $konek)
{
    $id_role = mysqli_real_escape_string($konek, $id_role);
    $query = mysqli_query($konek, "SELECT role_name FROM roles WHERE id_role = '$id_role'");
    if ($row = mysqli_fetch_assoc($query)) {
        return $row['role_name'];
    }
    return null;
}
?>