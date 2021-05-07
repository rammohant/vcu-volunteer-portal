<?php

require_once('connection.php'); // Using database connection file here

global $conn;
    
if ($_POST['eventID']) {

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
                    age_minumum = :age_minumum,
                    needed_skills = :needed_skills,
                    organizer = :organizer,
                    approved_by = :approved_by
                    WHERE eventID = :eventID";
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':title', $_POST["title"]);
    $stmt->bindValue(':description', $_POST["description"]);
    $stmt->bindValue(':type', $_POST["type"]);
    $stmt->bindValue(':startdate', $_POST["startdate"]);
    $stmt->bindValue(':enddate', $_POST["enddate"]);
    $stmt->bindValue(':link', $_POST["link"]);
    $stmt->bindValue(':available_spots', $_POST["available_spots"]);
    $stmt->bindValue(':needed_skills', $_POST["needed_skills"]);
    $stmt->bindValue(':age_minumum', $_POST["age_minumum"]);
    $stmt->bindValue(':organizer', $_POST["organizer"]);
    $stmt->bindValue(':approved_by', $_POST["approved_by"]);
    $stmt->bindValue(':eventID', $_POST["eventID"]);
    $stmt->execute();

    header("location:manager_v.php"); 
    exit; 
} else
{
    echo "Error updating record"; // display error message if not updated
}
?>

<h2>Update Event</h2>

<form method="POST">
  <input type="text" name="title" value="<?php echo $data['title'] ?>" placeholder="Enter title" Required>
  <input type="text" name="description" value="<?php echo $data['description'] ?>" placeholder="Enter description" Required>
  <input type="text" name="type" value="<?php echo $data['type'] ?>" placeholder="Enter type" Required>
  <input type="date" name="startdate" value="<?php echo $data['startdate'] ?>" placeholder="Enter startdate" >
  <input type="date" name="enddate" value="<?php echo $data['enddate'] ?>" placeholder="Enter enddate" >
  <input type="text" name="link" value="<?php echo $data['link'] ?>" placeholder="Enter link" >
  <input type="number" name="available_spots" value="<?php echo $data['available_spots'] ?>" placeholder="Enter available_spots" >
  <input type="text" name="needed_skills" value="<?php echo $data['needed_skills'] ?>" placeholder="Enter needed_skills" >
  <input type="number" name="age_minumum" value="<?php echo $data['age_minumum'] ?>" placeholder="Enter age_minumum" >
  <input type="text" name="organizer" value="<?php echo $data['organizer'] ?>" placeholder="Enter Age" Required>
  <input type="text" name="approved_by" value="<?php echo $data['approved_by'] ?>" placeholder="Enter Age" Required>

  <input type="submit" name="update" value="Update">
</form>