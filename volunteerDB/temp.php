<?php

require_once('connection.php'); // Using database connection file here

global $conn;

$title_f = $_POST['Title']; // get id through query string

$qry = mysqli_query($link,"select eventID, title, description, type, startdate, enddate, link,available_spots, needed_skills,age_minimum,needed_skills,organizerID,approverID from volunteer_events where title='$title_f'"); // select query

$data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) // when click on Update button
{
    // $title = $_POST['title'];
    // $description = $_POST['description'];
	
    // $edit = mysqli_query($link,"update volunteer_events set title='$title', description='$description' where title='$title_f'");
	
    // if($edit)
    // {
    //     mysqli_close($link); // Close connection
    //     header("location:organizer_v.php"); // redirects to all records page
    //     exit;
    // }
    // else
    // {
    //     echo mysqli_error();
    // }    
    
    $sqlQuery = "UPDATE volunteer_events
                    SET
                    title = :title,
                    description = :description,
                    type = :type,
                    startdate = :startdate,
                    enddate = :enddate,
                    link = :link,
                    available_spots = :available_spots,
                    needed_skills = :needed_skills,
                    age_minimum = :age_minimum,
                    needed_skills = :needed_skills,
                    organizerID = :organizerID,
                    approverID = :approverID
                    WHERE title = :title_f";

    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':title_f', $title_f, PDO::PARAM_STR);
    $stmt->bindValue(':title', $_POST["title"], PDO::PARAM_STR);
    $stmt->bindValue(':description', $description);
    $stmt->bindValue(':type', $_POST["type"], PDO::PARAM_STR);
    $stmt->bindValue(':startdate', $_POST["startdate"], PDO::PARAM_STR);
    $stmt->bindValue(':enddate', $_POST["enddate"], PDO::PARAM_STR);
    $stmt->bindValue(':link', $_POST["link"], PDO::PARAM_STR);
    $stmt->bindValue(':available_spots', $_POST["available_spots"], PDO::PARAM_STR);
    $stmt->bindValue(':needed_skills', $_POST["needed_skills"], PDO::PARAM_STR);
    $stmt->bindValue(':age_minimum', $_POST["age_minimum"], PDO::PARAM_STR);
    $stmt->bindValue(':organizerID', $_POST["organizerID"], PDO::PARAM_STR);
    $stmt->bindValue(':approverID', $_POST["approverID"], PDO::PARAM_STR);
    //$stmt->bindValue(':eventID', $_POST["eventID"], PDO::PARAM_STR);
    $stmt->execute();

    header("location:organizer_v.php"); 
    exit; 
} else
{
    echo "Error deleting record"; // display error message if not delete
}
?>

<h3>Update Data</h3>

<form method="POST">
<input type="text" name="title" value="<?php echo $data['title'] ?>" placeholder="Enter title" Required>
<input type="text" name="description" value="<?php echo $data['description'] ?>" placeholder="Enter description">
<input type="text" name="type" value="<?php echo $data['type'] ?>" placeholder="Enter type" Required>
<input type="text" name="startdate" value="<?php echo $data['startdate'] ?>" placeholder="Enter startdate">
<input type="text" name="enddate" value="<?php echo $data['enddate'] ?>" placeholder="Enter enddate">
<input type="text" name="link" value="<?php echo $data['link'] ?>" placeholder="Enter link">
<input type="text" name="available_spots" value="<?php echo $data['available_spots'] ?>" placeholder="Enter available_spots">
<input type="text" name="needed_skills" value="<?php echo $data['needed_skills'] ?>" placeholder="Enter needed_skills">
<input type="text" name="age_minimum" value="<?php echo $data['age_minimum'] ?>" placeholder="Enter age_minimum">
<input type="text" name="organizerID" value="<?php echo $data['organizerID'] ?>" placeholder="Enter organizerID">
<input type="text" name="approverID" value="<?php echo $data['approverID'] ?>" placeholder="Enter approverID">
<input type="submit" name="update" value="Update">
</form>