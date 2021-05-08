<?php

require_once('connection-manager.php'); // Using database connection file here

global $conn;

$eventID = $_POST['eventID']; // get id through query string

$qry = mysqli_query($conn,"select eventID, title, description, type from volunteer_events where eventID='$eventID'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $title = $_POST['title'];
    $description = $_POST['description'];
	
    $edit = mysqli_query($db,"update volunteer_events set title='$title', description='$description' where eventID='$eventID'");
	
    if($edit)
    {
        mysqli_close($conn); // Close connection
        header("location:manager_v.php"); // redirects to all records page
        exit;
    }
    else
    {
        echo mysqli_error();
    }    	
}
?>

<h3>Update Data</h3>

<form method="POST">
<input type="text" name="title" value="<?php echo $data['title'] ?>" placeholder="Enter title" Required>
  <input type="text" name="description" value="<?php echo $data['description'] ?>" placeholder="Enter description" Required>
  <input type="text" name="type" value="<?php echo $data['type'] ?>" placeholder="Enter type" Required>
  <input type="submit" name="update" value="Update">
</form>