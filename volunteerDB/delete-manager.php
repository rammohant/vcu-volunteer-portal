<?php

require_once('connection.php'); // Using database connection file here

global $conn;

if ($_POST['eventID']) {
            
    $sqlQuery = "DELETE FROM volunteer_signup WHERE eventID = :eventID";
    
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':eventID', $_POST["eventID"], PDO::PARAM_STR);
    $stmt->execute();
    header("location:manager_v.php"); 
    exit; 
} else
{
    echo "Error deleting record"; // display error message if not delete
}


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

// $title = $_POST['Title']; // get id through query string

// $del = mysqli_query($link,"delete from volunteer_events where eventID = 6"); // delete query

// if($del)
// {
//     mysqli_close($link); // Close connection
//     header("location:manager_v.php"); // redirects to all records page
//     echo "Record deleted"; // display error message if not delete
//     exit;	
// } else
// {
//     echo "Error deleting record"; // display error message if not delete
// }
?>