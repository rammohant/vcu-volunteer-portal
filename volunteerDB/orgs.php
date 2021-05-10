<html>
<head>

<title>Welcome to VDash!</title>

<style type="text/css">

h3 {
    text-align: center;
    font-size: 25px; 
    padding-top: 25px; 
    font-family: "Verdana";
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
    background-image:url('images/bg.png'); 
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
  padding-top: 15px;
  padding-bottom: 15px;
  padding-right: 20px; 
  text-decoration: none;
}

li a:hover {
    background-color: #111;
}

table { */
/*   width: 100%;  */
/*   background-color: #615F5F; */
 opacity: 0.90; 
} */

/* tr{ */
/*     color: #EEEAE9; */
/*     font-family: "Verdana"; */
/* } */

</style>

<?php require_once('header.php'); ?>

<script src="js/volunteer_event.js"></script>

</head>

<?php require_once('config.php'); ?> 

<body>

<ul>
	<li><a href="index.php" class="pull-left"  style="padding-left: 10px"><img src="images/VDASH.png" style="height: 28px"></a><li>
	<li><a href="volunteer_v.php">Volunteer Portal</a></li>
	<li><a href="organizer_v.php">Organizer Portal</a></li>
    <li class="active"><a href="orgs.php">Organizations</a></li>
    <li><a href="register.php">Register</a></li>
</ul>

<?php 
global $conn;

$sql = "SELECT orgID, org_name, phone_number, email, website FROM v_allorgs where type like 'off-campus org'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<h3>Off Campus Organizations</h3>";
        echo "<table class='table table-dark table-stripped' style='width:80%; margin-left: 10%; margin-right: 10%; opacity: 90%'>";
        echo "<tr>";
        echo "<th>Organization</th>";
        echo "<th>Contact Number</th>";
        echo "<th>Contact Email</th>";
        echo "<th>Website</th>";
        echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['org_name'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['website'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
?>

<?php 

global $conn;

$sql = "SELECT orgID, org_name, email, university_name, school_address FROM v_allorgs where type like 'student org'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<h3>Student Organizations</h3>";
        echo "<table class='table table-dark table-stripped' style='width:80%; margin-left: 10%; margin-right: 10%; opacity: 90%'>";
        echo "<tr>";
        echo "<th>Club</th>";
        echo "<th>University</th>";
        echo "<th>Contact Email</th>";
        echo "<th>Address</th>";
        echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['org_name'] . "</td>";
            echo "<td>" . $row['university_name'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['school_address'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
?>

</body>
</html>
