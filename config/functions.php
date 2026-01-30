<?php
// Helper Functions

// Base URL
function base_url($path = '')
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $base = $protocol . '://' . $host . '/perijinan_sk/';
    return $base . ltrim($path, '/');
}

// Redirect
function redirect($url)
{
    header('Location: ' . base_url($url));
    exit();
}

// Check if user is logged in
function is_logged_in()
{
    return isset($_SESSION['id_login']) && !empty($_SESSION['id_login']);
}

// Check user role
function check_role($allowed_roles = [])
{
    if (!is_logged_in()) {
        redirect('auth/login.php');
    }

    if (!empty($allowed_roles) && !in_array($_SESSION['role_name'], $allowed_roles)) {
        redirect('index.php?error=unauthorized');
    }
}

// Flash message
function set_flash($key, $message)
{
    $_SESSION['flash'][$key] = $message;
}

function get_flash($key)
{
    if (isset($_SESSION['flash'][$key])) {
        $message = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }
    return null;
}

// Sanitize input
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>