<?php

require_once('connection.php'); // Using database connection file here

$id = $_GET['eventID']; // get id through query string

$del = mysqli_query($link,"DELETE FROM volunteer_events WHERE eventID = '$id'"); // delete query

if($del)
{
    mysqli_close($link); // Close connection
    echo "Record deleted"; // display error message if not delete
    header("location:index.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>