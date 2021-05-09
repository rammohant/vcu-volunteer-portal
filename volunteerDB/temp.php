<html>
<head>
<title>VDASH Organizer Portal</title>
<style type="text/css">
h2 {
    text-align: center;
    font-size: 25px; 
    padding-top: 25px; 
    font-family: "Verdana";
    font-weight: bold; 
}

p {
    text-align: center;
    font-size: 13px;
    font-family: "Verdana"; 
    
}
div {
    text-align: center;
}
body {
    background-image:url('bg.png'); 
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
/*   float: right; */
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  font-family: "Verdana"; 
  font-size: 15px; 
  padding-top: 15px;
  padding-bottom: 15px;
  padding-right: 15px; 
  text-decoration: none;
}

li a:hover {
    background-color: #111;
}


</style>
<?php require_once('header.php'); ?>

<script src="js/organizer_v.js"></script>

</head>
<!-- check if user is logged in and a organizer -->
<?php require_once('connection-organizer.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
	<li><a href="volunteer_v.php">Volunteer Portal</a></li>
	<li class="active"><a href="organizer_v.php">Organizer Portal</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<?php

require_once('connection.php'); // Using database connection file here

global $conn;

$title_f = $_POST['Title']; // get id through query string

$qry = mysqli_query($link,"select eventID, title, description, type, startdate, enddate, link,available_spots, needed_skills,age_minimum,needed_skills,organizerID,approverID from volunteer_events where title='$title_f'"); // select query

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
    
    // $sqlQuery = "UPDATE volunteer_events
    //                 SET
    //                 title = :vtitle,
    //                 description = :vdescription,
    //                 type = :vtype,
    //                 startdate = :vstartdate,
    //                 enddate = :venddate,
    //                 link = :vlink,
    //                 available_spots = :vavailable_spots,
    //                 needed_skills = :vneeded_skills,
    //                 age_minimum = :vage_minimum,
    //                 needed_skills = :vneeded_skills,
    //                 organizerID = :vorganizerID,
    //                 approverID = :vapproverID
    //                 WHERE title = :title_f";

    // $stmt = $conn->prepare($sqlQuery);
    // $stmt->bindValue(':title_f', $title_f, PDO::PARAM_STR);
    // $stmt->bindValue(':vtitle', $_POST["title"], PDO::PARAM_STR);
    // $stmt->bindValue(':vdescription', $_POST["description"]);
    // $stmt->bindValue(':vtype', $_POST["type"], PDO::PARAM_STR);
    // $stmt->bindValue(':vstartdate', $_POST["startdate"], PDO::PARAM_STR);
    // $stmt->bindValue(':venddate', $_POST["enddate"], PDO::PARAM_STR);
    // $stmt->bindValue(':vlink', $_POST["link"], PDO::PARAM_STR);
    // $stmt->bindValue(':vavailable_spots', $_POST["available_spots"], PDO::PARAM_STR);
    // $stmt->bindValue(':vneeded_skills', $_POST["needed_skills"], PDO::PARAM_STR);
    // $stmt->bindValue(':vage_minimum', $_POST["age_minimum"], PDO::PARAM_STR);
    // $stmt->bindValue(':vorganizerID', $_POST["organizerID"], PDO::PARAM_STR);
    // $stmt->bindValue(':vapproverID', $_POST["approverID"], PDO::PARAM_STR);
    // //$stmt->bindValue(':eventID', $_POST["eventID"], PDO::PARAM_STR);
    // $stmt->execute();

    // header("location:organizer_v.php"); 
    // exit; 
} 
// else {
//     echo "Error deleting record"; // display error message if not delete
// }
?>

<h3>Update Data</h3>

<form method='POST' action='temp.php'>
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