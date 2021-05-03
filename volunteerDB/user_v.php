<html>
<head>
<title>VDASH Volunteer Portal</title>

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
  padding-top: 15px;
  padding-bottom: 15px;
  padding-right: 20px; 
  text-decoration: none;
}

li a:hover {
    background-color: #111;
}

table {
  width: 100%; 
  background-color: #615F5F;
  opacity: 0.80;
}

tr{
    color: #EEEAE9;
    font-family: "Verdana";
}
</style>

<?php require_once('header.php'); ?>
</head>

<?php require_once('connection.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
	<li class="active"><a href="user_v.php">Volunteer Portal</a></li>
	<li><a href="manager_v.php">Manager Portal</a></li>
	<li><a href="register.php">Register</a></li>
</ul>

<?php 

global $conn;

$sql = "SELECT s.eventID, v.Title, v.description,v.link, v.type, v.DateRange, v.available_spots, v.needed_skills,v.age_minimum, v.organization, v.number, v.email
FROM volunteer_signup s LEFT JOIN v_volunteer_ops v on s.eventID = v.eventID";
                     
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<h2>Welcome to the Manager Portal</h2>";
        echo "<p>View, add, and delete volunteer events for your organization below.</p>";
        echo "<table class='table table-dark table-stripped' style='width:80%; margin-left: 10%; margin-right: 10%; opacity: 90%'>";
        echo "<tr>";
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
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['link'] . "</td>";
            echo "<td>" . $row['type'] . "</td>";
            echo "<td>" . $row['DateRange'] . "</td>";
            echo "<td>" . $row['available_spots'] . "</td>";
            echo "<td>" . $row['needed_skills'] . "</td>";
            echo "<td>" . $row['age_minimum'] . "</td>";
            echo "<td>" . $row['approver'] . "</td>";
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

<div class="container-fluid mt-3 mb-3">
	<h4>Welcome to the Volunteer Portal</h4>
    <p>Check out all the events you've signed up for!</p>
        	
	<div class="table-responsive">
		<table id="t_v_volunteer_events" class="table table-bordered table-inverse">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Description</th>
					<th>Link</th>
					<th>Type</th>
					<th>Date</th>
					<th>Available Spots</th>
					<th>Skills Needed</th>
					<th>Age Minimum</th>
					<th>Organization</th>
                    <th>Contact Number</th>
                    <th>Contact Email</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

</body>
</html>