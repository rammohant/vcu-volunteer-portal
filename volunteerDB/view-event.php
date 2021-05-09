<html>
<head>
<title>VDASH Organizer Portal</title>
<style type="text/css">
h2 {
    text-align: center;
    font-size: 20px; 
    padding-top: 25px; 
    font-family: "Verdana";
    font-weight: bold; 
}

p {
    text-align: center;
    font-size: 15px;
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

td{
    word-wrap:break-word
}

</style>
<?php require_once('header.php'); ?>

<script src="js/organizer_v.js"></script>

</head>

<!-- check if user is logged in as an organizer -->
<?php require_once('config.php'); ?>

<body>

<ul>
	<li class="active"><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
	<li><a href="volunteer_v.php">Volunteer Portal</a></li>
	<li><a href="organizer_v.php">Organizer Portal</a></li>
    <li><a href="orgs.php">Organizations</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<?php 
if ($_POST['eventID']) { 

$selectsql = "select eventID, title, description, organization, number, email, type, daterange, link, available_spots, needed_skills,age_minimum,needed_skills,organizer,approved_by,
            technology,
            address, vaccine_required, precautions,
            dropoff_time,dropoff_address,instructions
            from v_volunteer_ops where eventID=:eventID"; 

$selectstmt = $conn->prepare($selectsql);
$selectstmt->bindValue(':eventID', $eventID, PDO::PARAM_STR);
$selectstmt->execute();

echo "<h2>Test</h2>"; 
while ($data = $selectstmt->fetch()) {
    echo "<div class='wrapper'>"; 
    echo "<h2>View Event</h2>"; 
        echo "<form method='GET'>"; 
        echo "<table class='table table-dark' style='width:50%; margin-left: auto; margin-right: auto; opacity: 90%'>"; 
        echo "<tr><td>Title</td><td>".$data['title']."</td></tr>";
        echo "<tr><td>Description</td><td>".$data['description']."</td></tr>";
        echo "<tr><td>Organization</td><td>".$data['organization']."</td></tr>";
        echo "<tr><td>Number</td><td>".$data['number']."</td></tr>";
        echo "<tr><td>Email</td><td>".$data['email']."</td></tr>";
        echo "<tr><td>Dates</td><td>".$data['daterange']."</td></tr>";
        echo "<tr><td>Link</td><td>".$data['link']."</td></tr>";
        echo "<tr><td>Available Spots</td><td>".$data['available_spots']."</td></tr>";
        echo "<tr><td>Skills Needed</td><td>".$data['needed_skills']."</td></tr>";
        echo "<tr><td>Age Minimum</td><td>".$data['age_minimum']."</td></tr>";
            // if($data['type']=='virtual event') {
            //     echo "<tr><td>Technology</td><td>" . $data['technology'] . "</td></tr>";
            // }

            // if($data['type']=='in-person event') {
            //     echo "<tr><td>Address</td><td>" . $data['address'] . "</td></tr>";
            //     echo "<tr><td>Vaccine Required</td><td>" . $data['vaccine_required'] . "</td></tr>";
            //     echo "<tr><td>Precautions</td><td>" . $data['precautions'] . "</td></tr>";
            // }

            // if($data['type']=='donations') {
            //     echo "<tr><td>Dropoff time</td><td>" . $data['dropoff_time'] . "</td></tr>";
            //     echo "<tr><td>Dropoff address</td><td>" . $data['dropoff_address'] . "</td></tr>";
            //     echo "<tr><td>Instructions</td><td>" . $data['instructions'] . "</td></tr>";
            // }
    echo "</table>";
    echo "</form>";
    echo "</div>"; 
} 
}
?>
<div id="center_button" style='padding-bottom: 20px'>
    <button class="btn btn-secondary" onclick="location.href='index.php'">Return home</button>
</div>