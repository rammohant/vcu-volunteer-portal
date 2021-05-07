<?php

require_once('connection.php'); // Using database connection file here

global $conn;

if ($_POST['eventID']) {
            
    $sqlQuery = "DELETE FROM volunteer_events WHERE title = :Title";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':eventID', $_POST["eventID"], PDO::PARAM_STR);
    
    $stmt->execute();
    header("location:manager_v.php"); 
    exit; 
} else
{
    echo "Error deleting record"; // display error message if not delete
}
?>