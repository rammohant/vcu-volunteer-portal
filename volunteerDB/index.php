<html>
<head>
<style type="text/css">

h1 {
    text-align: center;
}
p {
    text-align: center;
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
}

li {
  float: left;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}
</style>

<title>Welcome to VDash!</title>

<?php require_once('header.php'); ?>

<script src="js/volunteer_event.js"></script>

</head>

<?php require_once('connection.php'); ?> <!-- comment this out once file is done -->
s
<body>

<!-- <nav class="navbar navbar-inverse"> -->
<!--   <div class="container-fluid"> -->
<!--     <div class="navbar-header"> -->
<!--       <a class="navbar-brand" href="#">VDash</a> -->
<!--     </div> -->
<!--     <ul class="topnav"> -->
<!--         <li class="active"><a href="#">Home</a></li> -->
<!--     	<li><a href="volunteer_event.php">Volunteer Events</a></li> -->
<!--     	<li><a href="addEvent.php">Add events</a></li> -->
<!--     	<li><a href="manager_v.php">Manager Portal</a></li> -->
<!--     </ul> -->
<!--   </div> -->
<!-- </nav> -->


<ul>
    <li class="active"><a href="#">Home</a></li>
	<li><a href="volunteer_event.php">Volunteer Events</a></li>
	<li><a href="addEvent.php">Add events</a></li>
	<li><a href="manager_v.php">Manager Portal</a></li>
</ul>

<div class="container-fluid mt-3 mb-3">
	<h4>Volunteer Opportunities</h4>
	<div class="table-responsive">
		<table id="t_volunteer_event" class="table table-bordered table-striped">
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
