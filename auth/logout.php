<?php
session_start();
require_once '../config/functions.php';

// Destroy session
session_destroy();

// Redirect to login
redirect('auth/login.php');
?>