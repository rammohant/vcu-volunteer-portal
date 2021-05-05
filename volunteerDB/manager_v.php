<html>
<head>

<title>VDASH Manager Portal</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
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

<script src="js/manager_v.js"></script>

</head>
<!-- check if user is logged in and a manager -->
<?php require_once('connection.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
	<li><a href="user_v.php">Volunteer Portal</a></li>
	<li class="active"><a href="manager_v.php">Manager Portal</a></li>
	<li><a href="register.php">Register</a></li>
</ul>

<?php 

global $conn;

$username = $_SESSION['userID'];

$sql = "SELECT v.eventID, 
v.title as 'Title', 
v.description as 'Description', 
v.link as 'Link', 
v.type as 'Type', 
v.DateRange as 'Date', 
v.available_spots as 'Available Spots',
v.needed_skills as 'Skills Needed',
v.age_minimum as 'Age Minimum',
v.approved_by as 'Approver'
FROM v_volunteer_ops v";
    
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
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['Link'] . "</td>";
            echo "<td>" . $row['Type'] . "</td>";
            echo "<td>" . $row['Date'] . "</td>";
            echo "<td>" . $row['Available Spots'] . "</td>";
            echo "<td>" . $row['Skills Needed'] . "</td>";
            echo "<td>" . $row['Age Minimum'] . "</td>";
            echo "<td>" . $row['Approver'] . "</td>";
            echo "<td><form action='delete.php' method='POST'><input type='hidden' name='eventID' value='".$row["eventID"]."'/><input type='submit' name='submit-btn' value='View/Update Details' /></form></td></tr>";
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
	<h2>Welcome to the Manager Portal</h2>
	<p>View, add, and delete volunteer events for your organization below.</p>

	<div class="pb-3">
		<button type="button" id="addEvent" class="btn btn-primary btn-sm">Add Event</button>
	</div> 
        	
	<div class="table-responsive">
		<table id="t_m_volunteer_event" class="table table-bordered table-inverse">
			<thead>
				<tr>
					<th>eventID</th>
					<th>Title</th>
					<th>Description</th>
					<th>Type</th>
					<th>Start Date</th>
					<th>End Date</th>
					<th>Link</th>
					<th>Available Spots</th>
					<th>Skills Needed</th>
					<th>Age Minimum</th>
					<th>Organizer</th>
					<th>Approved By</th>
				</tr>
			</thead>
		</table>
	</div>
</div>
</body>
</html>