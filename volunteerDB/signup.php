<?php
require_once 'connection.php'; // Using database connection file here
global $conn;

$eventID = $_GET['ID']; // get id through query string
$userID = $_SESSION['userID']; 

$insert = mysqli_query($db,"INSERT INTO volunteer_signup(eventID,volunteerID) VALUES('$eventID','$userID')"); // insert query

if($del)
{
    mysqli_close($conn); // Close connection
    header("location:index.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error signing up for volunteer event"; // display error message if not delete
}
?>