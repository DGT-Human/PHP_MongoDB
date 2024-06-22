<?php
// Assuming you have a session started in your application
session_start();

// Check if the user is logged in
if(isset($_SESSION['user_name'])) {
    // If logged in, destroy the session and redirect to the login page
    session_destroy();
    header("Location: login.php");
    exit();
}
?>
