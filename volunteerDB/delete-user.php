<?php

require_once('connection.php'); // Using database connection file here

global $conn;

// $id = $_GET['eventID']; // get id through query string

// $del = mysqli_query($link,"DELETE FROM volunteer_events WHERE eventID = '$id'"); // delete query

if ($_POST['eventID']) {
            
    $sqlQuery = "DELETE FROM volunteer_signup WHERE eventID = :eventID AND volunteerID = :volunteerID";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':eventID', $_POST["eventID"], PDO::PARAM_STR);
    $stmt->bindValue(':volunteerID', $_SESSION["userID"], PDO::PARAM_STR);
    $stmt->execute();

}

// if($del)
// {
//     mysqli_close($link); // Close connection
//     echo "Record deleted"; // display error message if not delete
//     header("location:index.php"); // redirects to all records page
//     exit;	
// }
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>