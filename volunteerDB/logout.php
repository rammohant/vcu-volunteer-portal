<?php
session_start();
// Logout will destroy the session and redirect to login.php page again.
if(session_destroy()) {
    header("Location:index.php");
}
unset($_SESSION['userID']);
?>