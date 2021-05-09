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
    text-align: left;
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

$eventID = $_GET['eventID']; // get id through query string

$selectsql = "select eventID, title, description, organization, number, email, type, daterange, link, available_spots, needed_skills,age_minimum,needed_skills,organizer,approved_by,
            technology,
            address, vaccine_required, precautions,
            dropoff_time,dropoff_address,instructions
            from v_volunteer_ops where eventID=:eventID"; 

$selectstmt = $conn->prepare($selectsql);
$selectstmt->bindValue(':eventID', $eventID, PDO::PARAM_STR);
$selectstmt->execute();

$data = $selectstmt->fetch();
?>

<div class="wrapper">
<h2>View Event</h2>
    <form method='POST'>
        <table class='table table-dark' style='width:50%; margin-left: auto; margin-right: auto; opacity: 90%'>
        <tr><td>Title</td><td><?php echo $data['title'] ?></td></tr>
        <tr><td>Description</td><td><?php echo $data['description'] ?></td></tr>
        <tr><td>Organization</td><td><?php echo $data['organization'] ?></td></tr>
        <tr><td>Number</td><td><?php echo $data['number'] ?></td></tr>
        <tr><td>Email</td><td><?php echo $data['email'] ?></td></tr>
        <tr><td>Dates</td><td><?php echo $data['daterange'] ?></td></tr>
        <tr><td>Link</td><td><?php echo $data['link'] ?></td></tr>
        <tr><td>Available Spots</td><td><?php echo $data['available_spots'] ?></td></tr>
        <tr><td>Skills Needed</td><td><?php echo $data['needed_skills'] ?></td></tr>
        <tr><td>Age Minimum</td><td><?php echo $data['age_minimum'] ?></td></tr>
        <?php
        if($data['type']=='virtual event') {
            echo "<tr><td>Technology</td><td>" . $data['technology'] . "</td></tr>";
        }

        if($data['type']=='in-person event') {
            echo "<tr><td>Address</td><td>" . $data['address'] . "</td></tr>";
            echo "<tr><td>Vaccine Required</td><td>" . $data['vaccine_required'] . "</td></tr>";
            echo "<tr><td>Precautions</td><td>" . $data['precautions'] . "</td></tr>";
        }

        if($data['type']=='donations') {
            echo "<tr><td>Dropoff time</td><td>" . $data['dropoff_time'] . "</td></tr>";
            echo "<tr><td>Dropoff address</td><td>" . $data['dropoff_address'] . "</td></tr>";
            echo "<tr><td>Instructions</td><td>" . $data['instructions'] . "</td></tr>";
        }
        ?>
        </table>
    </form>
</div>

