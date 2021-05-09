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

td {
    text-align: center;
    vertical-align: middle;
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

global $conn;

$title_f = $_GET['Title']; // get id through query string

$selectsql = "select eventID, title, description, type, startdate, enddate, link,available_spots, needed_skills,age_minimum,needed_skills,organizerID,approverID from volunteer_events where title=:title_f"; 
$selectstmt = $conn->prepare($selectsql);
$selectstmt->bindValue(':title_f', $title_f, PDO::PARAM_STR);
$selectstmt->execute();
$data = $stmt->fetch();
// $qry = mysqli_query($link,"select eventID, title, description, type, startdate, enddate, link,available_spots, needed_skills,age_minimum,needed_skills,organizerID,approverID from volunteer_events where title='$title_f'"); // select query
// $data = mysqli_fetch_array($qry); // fetch data

if(isset($_POST['update'])) {

    $sqlQuery = "UPDATE volunteer_events
                    SET
                    title = :vtitle,
                    description = :vdescription,
                    startdate = :vstartdate,
                    enddate = :venddate,
                    link = :vlink,
                    available_spots = :vavailable_spots,
                    needed_skills = :vneeded_skills,
                    age_minimum = :vage_minimum,
                    needed_skills = :vneeded_skills
                    WHERE title = :title_f";

    // NOTE: We do not want to allow the user to update type, approverID, or organizerID
    $stmt = $conn->prepare($sqlQuery);
    $stmt->bindValue(':title_f', $title_f, PDO::PARAM_STR);
    $stmt->bindValue(':vtitle', $_POST["title"], PDO::PARAM_STR);
    $stmt->bindValue(':vdescription', $_POST["description"]);
    $stmt->bindValue(':vstartdate', $_POST["startdate"], PDO::PARAM_STR);
    $stmt->bindValue(':venddate', $_POST["enddate"], PDO::PARAM_STR);
    $stmt->bindValue(':vlink', $_POST["link"], PDO::PARAM_STR);
    $stmt->bindValue(':vavailable_spots', $_POST["available_spots"], PDO::PARAM_STR);
    $stmt->bindValue(':vneeded_skills', $_POST["needed_skills"], PDO::PARAM_STR);
    $stmt->bindValue(':vage_minimum', $_POST["age_minimum"], PDO::PARAM_STR);
    //$stmt->bindValue(':eventID', $_POST["eventID"], PDO::PARAM_STR);
    $stmt->execute();

    header("location:organizer_v.php"); 
    exit; 
} 
?>

<div class="wrapper">
<h2>Update Event</h2>
    <form method='POST'>
        <table class='table table-dark' style='width:50%; margin-left: auto; margin-right: auto; opacity: 90%'>
        <tr><td>Title</td><td><input type="text" name="title" value="<?php echo $data['title'] ?>" placeholder="Enter title" Required></td></tr>
        <tr><td>Description</td><td><input type="text" name="description" value="<?php echo $data['description'] ?>" placeholder="Enter description"></td></tr>
        <tr><td>Start date</td><td><input type="text" name="startdate" value="<?php echo $data['startdate'] ?>" placeholder="Enter startdate"></td></tr>
        <tr><td>End date</td><td><input type="text" name="enddate" value="<?php echo $data['enddate'] ?>" placeholder="Enter enddate"></td></tr>
        <tr><td>Link</td><td><input type="text" name="link" value="<?php echo $data['link'] ?>" placeholder="Enter link"></td></tr>
        <tr><td>Available Spots</td><td><input type="text" name="available_spots" value="<?php echo $data['available_spots'] ?>" placeholder="Enter available_spots"></td></tr>
        <tr><td>Skills Needed</td><td><input type="text" name="needed_skills" value="<?php echo $data['needed_skills'] ?>" placeholder="Enter needed_skills"></td></tr>
        <tr><td>Age Minimum</td><td><input type="text" name="age_minimum" value="<?php echo $data['age_minimum'] ?>" placeholder="Enter age_minimum"></td></tr>
        <tr><td><input type="submit" name="update" value="Update"></tr>
        </table>
    </form>
</div>

<!-- <h2>Update Event</h2>
<form method='POST'>
<table class='table table-dark' style='width:50%; margin-left: auto; margin-right: auto; opacity: 90%'>
<tr><th></th><th></th><th></th></tr>
<tr><td>Title</td><td colspan="2"><input type="text" name="title" value="<?php echo $data['title'] ?>" placeholder="Enter title" Required></td></tr>
<tr><td>Description</td><td colspan="2"><input type="text" name="description" value="<?php echo $data['description'] ?>" placeholder="Enter description"></td></tr>
<tr><td>Start date</td><td colspan="2"><input type="text" name="startdate" value="<?php echo $data['startdate'] ?>" placeholder="Enter startdate"></td></tr>
<tr><td>End date</td><td colspan="2"><input type="text" name="enddate" value="<?php echo $data['enddate'] ?>" placeholder="Enter enddate"></td></tr>
<tr><td>Link</td><td colspan="2"><input type="text" name="link" value="<?php echo $data['link'] ?>" placeholder="Enter link"></td></tr>
<tr><td>Available Spots</td><td colspan="2"><input type="text" name="available_spots" value="<?php echo $data['available_spots'] ?>" placeholder="Enter available_spots"></td></tr>
<tr><td>Skills Needed</td><td colspan="2"><input type="text" name="needed_skills" value="<?php echo $data['needed_skills'] ?>" placeholder="Enter needed_skills"></td></tr>
<tr><td>Age Minimum</td><td colspan="2"><input type="text" name="age_minimum" value="<?php echo $data['age_minimum'] ?>" placeholder="Enter age_minimum"></td></tr>
<tr><td colspan="3"><input type="submit" name="update" value="Update"></tr>
</table>
</form>
</div> -->