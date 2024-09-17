<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Unset session variables
    unset($_SESSION['id']);
}

// Destroy the session
session_destroy();

// Redirect to login page
header('Location: index.php');
exit();
?>
