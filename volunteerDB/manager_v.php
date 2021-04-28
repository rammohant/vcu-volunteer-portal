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
  color: white;
  text-align: center;
  padding: 14px 16px 0px 0px;
  text-decoration: none;
}

li a:hover {
  background-color: #111;
}

table {
  background-color: #111;
  opacity: 0.90;
}
</style>
<?php require_once('header.php'); ?>

<script src="js/manager_v.js"></script>

</head>
<!-- check if user is logged in and a manager -->
<?php require_once('connection.php'); ?>

<body>

<ul>
	<li><a href="#" class="pull-left" style="height:100%"> <img src="VDASH.png"></a><li>
    <li><a href="#">Home</a></li>
	<li><a href="volunteer_event.php">Volunteer Portal</a></li>
	<li><a href="addEvent.php">Add events</a></li>
	<li class="active"><a href="manager_v.php">Manager Portal</a></li>
</ul>

<div class="container-fluid mt-3 mb-3">
	<h2>Welcome to the Manager Portal</h2>
	<p>View, add, and delete volunteer events for your organization below.</p>
	
	<div class="pb-3">
		<button type="button" id="addEvent" class="btn btn-primary btn-sm">Add Event</button>
	</div> 
        	
	<div class="table-responsive">
		<table id="t_m_volunteer_event" class="table table-bordered table-striped">
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

<!-- <div id="event-modal" class="modal fade"> -->
<!-- 	<div class="modal-dialog"> -->
<!-- 		<form method="post" id="event-form"> -->
<!-- 			<div class="modal-content"> -->
<!-- 				<div class="modal-header"> -->
<!-- 					<h4 class="modal-title">Edit Event</h4> -->
<!-- 				</div> -->
<!-- 				<div class="modal-body"> -->
<!-- 					<div class="form-group"> -->

<!-- 						<label>Title</label><input type="text" class="form-control" id="title" placeholder="Enter title" required> -->
						
<!-- 						<label>Description</label> <input type="text" class="form-control" id="description" placeholder="Enter description"> -->
						
<!-- 						<label>Start Date</label> <input type="text" class="form-control" id="startdate" placeholder="Enter start date" required> -->
						
<!-- 						<label>End Date</label> <input type="text" class="form-control" id="enddate" placeholder="Enter end date"> -->
						
<!-- 						<label>Link</label> <input type="text" class="form-control" id="startdate" placeholder="Enter link"> -->
						
<!-- 						<label>Available Spots</label> <input type="number" class="form-control" id="available_spots"> -->
						
<!-- 						<label>Skills Needed</label> <input type="text" class="form-control" id="needed_skills" placeholder="Enter skills needed"> -->
																							
<!-- 						<label>Type</label> -->
<!-- 						<select class="form-control" id="department" required> -->
            			    <?php
//             			        $sqlQuery = "SELECT DISTINCT type from volunteer_events";
//             			        $stmt = $conn->prepare($sqlQuery);
//             			        $stmt->execute();
//             			        while ($row = $stmt->fetch()) {
//             			            echo "<option value=\"" . $row["type"] . "\">" . $row["type"] . "</option>";
//             			        }
//                             ?>
<!--             			</select> -->
            			
<!--             			<label>Organizer</label> -->
<!-- 						<select class="form-control" id="manager" required> -->
            			    <?php
//             			        $sqlQuery = "SELECT userID, CONCAT(first_name, ' ', last_name) as 'name' from users where type like 'organizer'";
//             			        $stmt = $conn->prepare($sqlQuery);
//             			        $stmt->execute();
//             			        while ($row = $stmt->fetch()) {
//             			            echo "<option value=\"" . $row["userID"] . "\">" . $row["name"] . "</option>";
//             			        }
//                             ?>
<!--             			</select> -->
            			
<!--             			<label>Approved By</label> -->
<!-- 						<select class="form-control" id="job" required> -->
            			    <?php
//             			        $sqlQuery = "SELECT userID, CONCAT(first_name, ' ', last_name) as 'name' from users where type like 'admin'";
//             			        $stmt = $conn->prepare($sqlQuery);
//             			        $stmt->execute();
//             			        while ($row = $stmt->fetch()) {
//             			            echo "<option value=\"" . $row["userID"] . "\">" . $row["name"] . "</option>";
//             			        }
//                             ?>
<!--             			</select> -->

<!-- 					</div> -->
<!-- 				</div> -->
<!-- 				<div class="modal-footer"> -->
<!-- 					<input type="hidden" name="ID" id="ID"/> -->
<!-- 					<input type="hidden" name="action" id="action" value=""/> -->
<!-- 					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" /> -->
<!-- 					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
<!-- 				</div> -->
<!-- 			</div> -->
<!-- 		</form> -->
<!-- 	</div> -->
<!-- </div> -->

</body>
</html>