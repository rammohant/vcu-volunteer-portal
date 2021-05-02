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
    font-size: 30px; 
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
  padding-right: 15px; 
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

<script src="js/manager_v.js"></script>

</head>
<!-- check if user is logged in and a manager -->
<?php require_once('connection.php'); ?>

<body>

<ul>
	<li><a href="#" class="pull-left" style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
    <li><a href="index.php">Home</a></li>
	<li><a href="user_v.php">Volunteer Portal</a></li>
	<li class="active"><a href="manager_v.php">Manager Portal</a></li>
	<li><a href="signup.php">Sign up</a></li>
</ul>

<div class="container-fluid mt-3 mb-3">
	<h2>Welcome to the Manager Portal</h2>
	<p>View, add, and delete volunteer events for your organization below.</p>
	
	<div class="pb-3">
		<button type="button" id="addEvent" class="btn btn-primary btn-sm">Add Event</button>
	</div> 
        	
	<div class="table-responsive">
		<table id="t_m_volunteer_event" class="table table-bordered">
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