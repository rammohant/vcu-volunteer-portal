<?php

require_once('connection.php'); // Using database connection file here

global $conn;

if ($_POST['eventID']) {
            
    $sqlQuery = "DELETE FROM volunteer_signup WHERE eventID = :eventID AND volunteerID = :volunteerID";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':eventID', $_POST["eventID"], PDO::PARAM_STR);
    $stmt->bindValue(':volunteerID', $_SESSION["userID"], PDO::PARAM_STR);
    $stmt->execute();
    header("location:volunteer_v.php"); 
    exit; 
} else
{
    echo "Error deleting record"; // display error message if not delete
}
?>