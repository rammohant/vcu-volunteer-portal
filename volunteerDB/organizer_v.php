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

global $conn;
$organizer = $_SESSION['userID'];

$stmt = $conn->prepare("SELECT v.eventID, 
v.title as 'Title', 
v.description as 'Description', 
v.link as 'Link', 
v.type as 'Type', 
v.DateRange as 'Date', 
v.available_spots as 'Available Spots',
v.needed_skills as 'Skills Needed',
v.age_minimum as 'Age Minimum',
v.approved_by as 'Approver'
FROM v_volunteer_ops v where v.organizer=:organizerID");

$stmt->bindValue(':organizerID', $organizer);
$stmt->execute();

echo "<h2>Welcome to the Organizer Portal</h2>";
echo "<p>View, add, and delete volunteer events for your organization below.</p>";

echo "<table class='table table-dark table-stripped' style='width:80%; margin-left: auto; margin-right: auto; opacity: 90%'>";
echo "<tr>";
echo "<th>ID</th>";
echo "<th>Title</th>";
echo "<th>Description</th>";
echo "<th>Link</th>";
echo "<th>Type</th>";
echo "<th>Date</th>";
echo "<th>Available Spots</th>";
echo "<th>Skills Needed</th>";
echo "<th>Age Minimum</th>";
echo "<th>Approver</th>";
echo "</tr>";

while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . $row['eventID'] . "</td>";
        echo "<td>" . $row['Title'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "<td>" . $row['Link'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Date'] . "</td>";
        echo "<td>" . $row['Available Spots'] . "</td>";
        echo "<td>" . $row['Skills Needed'] . "</td>";
        echo "<td>" . $row['Age Minimum'] . "</td>";
        echo "<td>" . $row['Approver'] . "</td>";
        echo "<td><form action='delete-organizer.php' method='POST'><input type='hidden' name='Title' value='".$row['Title']."'/><input type='submit' name='delete-btn' value='Delete' /></form></td></tr>";
        echo "<td><form action='temp.php' method='POST'><input type='hidden' name='Title' value='".$row['Title']."'/><input type='submit' name='update-btn' value='Update' /></form></td></tr>";
        echo "<td><form action='update2.php' method='POST'><input type='hidden' name='eventID' value='".$row['eventID']."'/><input type='submit' name='update' value='Update' /></form></td></tr>";
        echo "</tr>";
    }
        echo "</table>";

?>

<?php
// $sql = "SELECT v.eventID, 
// v.title as 'Title', 
// v.description as 'Description', 
// v.link as 'Link', 
// v.type as 'Type', 
// v.DateRange as 'Date', 
// v.available_spots as 'Available Spots',
// v.needed_skills as 'Skills Needed',
// v.age_minimum as 'Age Minimum',
// v.approved_by as 'Approver'
// FROM v_volunteer_ops v where v.organizer='$organizer'";

// echo $_SESSION['userID']; //DELETE
// echo "<h2>Welcome to the Organizer Portal</h2>";
// echo "<p>View, add, and delete volunteer events for your organization below.</p>";

// if($result = mysqli_query($link, $sql)){
//     if(mysqli_num_rows($result) > 0){
//         echo "<table class='table table-dark table-stripped' style='width:80%; margin-left: 10%; margin-right: 10%; opacity: 90%'>";
//         echo "<tr>";
//         echo "<th>ID</th>";
//         echo "<th>Title</th>";
//         echo "<th>Description</th>";
//         echo "<th>Link</th>";
//         echo "<th>Type</th>";
//         echo "<th>Date</th>";
//         echo "<th>Available Spots</th>";
//         echo "<th>Skills Needed</th>";
//         echo "<th>Age Minimum</th>";
//         echo "<th>Approver</th>";
//         echo "</tr>";
//         while($row = mysqli_fetch_array($result)){
//             echo "<tr>";
//             echo "<td>" . $row['eventID'] . "</td>";
//             echo "<td>" . $row['Title'] . "</td>";
//             echo "<td>" . $row['Description'] . "</td>";
//             echo "<td>" . $row['Link'] . "</td>";
//             echo "<td>" . $row['Type'] . "</td>";
//             echo "<td>" . $row['Date'] . "</td>";
//             echo "<td>" . $row['Available Spots'] . "</td>";
//             echo "<td>" . $row['Skills Needed'] . "</td>";
//             echo "<td>" . $row['Age Minimum'] . "</td>";
//             echo "<td>" . $row['Approver'] . "</td>";
//             echo "<td><form action='delete-organizer.php' method='POST'><input type='hidden' name='Title' value='".$row['Title']."'/><input type='submit' name='delete-btn' value='Delete' /></form></td></tr>";
//             echo "<td><form action='temp.php' method='POST'><input type='hidden' name='Title' value='".$row['Title']."'/><input type='submit' name='update-btn' value='Update' /></form></td></tr>";
//             echo "<td><form action='update2.php' method='POST'><input type='hidden' name='eventID' value='".$row['eventID']."'/><input type='submit' name='update' value='Update' /></form></td></tr>";
//             echo "</tr>";
//         }
//         echo "</table>";
//         // Free result set
//         mysqli_free_result($result);
//     } else{
//         echo "<p>No records matching your query were found.<p>";
//     }
// } else{
//     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
// }
?>
<div id="center_button" style='padding-bottom: 20px'>
    <button onclick="location.href='addEvent.php'">Add Event</button>
</div>
</body>
</html>