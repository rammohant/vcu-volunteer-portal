<?php

require_once('connection.php'); // Using database connection file here

global $conn;

if(isset($_POST['Title'])) {

    $title = $_POST['Title'];

    $stmt = $mysqli->prepare("DELETE FROM volunteer_events WHERE title = ?");
    $stmt->bind_param('title', $title);
    $stmt->execute(); 
    $stmt->close();
    echo "Record deleted"; // display error message if not delete
    header("location:index.php"); // redirects to all records page
    exit;	
}

// $id = $_POST['eventID']; // get id through query string

// $del = mysqli_query($link,"DELETE FROM volunteer_events WHERE eventID = '$id'"); // delete query

// if ($_POST['ID']) {
            
//     $sqlQuery = "DELETE FROM volunteer_events WHERE eventID = ':ID'";
    
//     $stmt = $conn->prepare($sqlQuery);
//     $stmt->bindValue(':ID', $_POST["eventID"]);
//     $stmt->execute();

// }

// if($del)
// {
//     mysqli_close($link); // Close connection
//     echo "Record deleted"; // display error message if not delete
//     header("location:index.php"); // redirects to all records page
//     exit;	
// }

// else
// {
//     echo "Error deleting record"; // display error message if not delete
// }
?>