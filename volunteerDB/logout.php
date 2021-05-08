<?php
unset($_SESSION['userID']);
session_destroy();  
header("Location:index.php");
?>