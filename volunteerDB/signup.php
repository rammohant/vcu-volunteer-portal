<?php
require_once 'connection.php'; // Using database connection file here
global $conn;

$eventID = $userID = ""; 
// Prepare an insert statement
$sql = "INSERT INTO volunteer_signup(eventID,volunteerID) VALUES (?, ?)";

if ($stmt = mysqli_prepare($link, $sql)) {

    // Set parameters
    $eventID = $_GET['id']; // get id through query string
    $userID = $_SESSION['userID']; 
    
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt,'ss', $eventID, $userID);

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to home page
        header("location: index.php");
    } else {
        echo 'You have successfully created a VDASH account!';
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>