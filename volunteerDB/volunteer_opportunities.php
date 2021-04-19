<html>
<head>
<title>University Volunteer Database</title>
<?php require_once('header.php'); ?>
<!-- My JS libraries -->
<script src="js/volunteer_opportunities.js"></script>
</head>

<?php require_once('connection.php'); ?>

<body>

<div class="container-fluid mt-3 mb-3">
	<h4>Volunteer Opportunities</h4>
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