<?php

require_once('connection.php'); // Using database connection file here

global $conn;

$title_f = $_POST['Title']; // get id through query string

$qry = mysqli_query($link,"select eventID, title, description, type from volunteer_events where title='$title_f'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    $title = $_POST['title'];
    $description = $_POST['description'];
	
    $edit = mysqli_query($link,"update volunteer_events set title='$title', description='$description' where title='$title_f'");
	
    if($edit)
    {
        mysqli_close($link); // Close connection
        header("location:organizer_v.php"); // redirects to all records page
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
  <input type="text" name="description" value="<?php echo $data['description'] ?>" placeholder="Enter description">
  <input type="text" name="type" value="<?php echo $data['type'] ?>" placeholder="Enter type" Required>
  <input type="submit" name="update" value="Update">
</form>