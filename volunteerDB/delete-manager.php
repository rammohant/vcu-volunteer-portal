<?php

require_once('connection.php'); // Using database connection file here

// global $conn;

// if(isset($_POST['Title'])) {

//     $title = $_POST['Title'];

//     $stmt = $mysqli->prepare("DELETE FROM volunteer_events WHERE title = ?");
//     $stmt->bind_param('title', $title);
//     $stmt->execute(); 
//     $stmt->close();
//     echo "Record deleted"; // display error message if not delete
//     header("location:manager_v.php"); // redirects to all records page
//     exit;	
// }

$title = $_POST['Title']; // get id through query string

$del = mysqli_query($link,"delete from volunteer_events where eventID = 6"); // delete query

if($del)
{
    mysqli_close($link); // Close connection
    header("location:manager_v.php"); // redirects to all records page
    echo "Record deleted"; // display error message if not delete
    exit;	
} else
{
    echo "Error deleting record"; // display error message if not delete
}
?>