<html>
<head>

<title>Welcome to VDash!</title>

<style type="text/css">

h2 {
    text-align: center;
    font-size: 30px; 
    padding-top: 25px; 
    font-family: "Andale Mono";
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
  color: black;
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
}

</style>

<?php require_once('header.php'); ?>

<script src="js/volunteer_event.js"></script>

</head>

<?php require_once('connection.php'); ?> 

<body>

<ul>
	<li><a href="#" class="pull-left"  style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
    <li class="active"><a href="#">Home</a></li>
	<li><a href="user_v.php">Volunteer Portal</a></li>
	<li><a href="manager_v.php">Manager Portal</a></li>
	<li><a href="signup.php">Sign up</a></li>
	
</ul>

<div class="container-fluid mt-3 mb-3">
	<h2>Volunteer Opportunities</h2>
	<div class="table-responsive">
		<table id="volunteer_events" class="table table-bordered table-striped">
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
				</tr>
			</thead>
		</table>
	</div>
</div>

</body>
</html>
