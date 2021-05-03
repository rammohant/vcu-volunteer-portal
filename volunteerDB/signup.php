<?php
require_once 'connection.php'; // Using database connection file here
global $conn;

$eventID = $_GET['eventID']; // get id through query string
$userID = $_SESSION['userID']; 

$insert = mysqli_query($link,"INSERT INTO volunteer_signup(eventID,volunteerID) VALUES('$eventID','$userID')"); // insert query

if($insert)
{
    mysqli_close($link); // Close connection
    header("location:index.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error signing up for volunteer event"; // display error message if not delete
}
?>