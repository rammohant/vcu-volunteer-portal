<?php

require_once('connection-manager.php'); // Using database connection file here

global $conn;

if ($_POST['Title']) {
            
    $sqlQuery = "DELETE FROM volunteer_events WHERE title = :title";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':title', $_POST["Title"], PDO::PARAM_STR);
    
    $stmt->execute();
    header("location:manager_v.php"); 
    exit; 
} else
{
    echo "Error deleting record"; // display error message if not delete
}
?>