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

</style>

<title>HR database</title>

<?php require_once('header.php'); ?>

<script src="js/volunteer_opportunities.js"></script>

</head>

<?php require_once('connection.php'); ?>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Volunter DB</a>
    </div>
    <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
    	<li><a href="volunteer_opportunities.php">Volunteer Events</a></li>
    	<li><a href="addEvent.php">Add events</a></li>
    	<li><a href="manager_v.php">Manager Portal</a></li>
    </ul>
  </div>
</nav>

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
