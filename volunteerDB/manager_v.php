<html>
<head>

  <title>Manager View</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
<?php require_once('header.php'); ?>

<script src="js/manager_v.js"></script>

</head>
<!-- check if user is logged in and a manager -->
<?php require_once('connection.php'); ?>

<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="#">Home</a></li>
    	<li><a href="volunteer_opportunities.php">Volunteer Events</a></li>
    	<li><a href="addEvent.php">Add events</a></li>
    	<li class="active"><a href="manager_v.php">Manager Portal</a></li>
    </ul>
  </div>
</nav>

<div class="container-fluid mt-3 mb-3">
	<h4>Volunteer Opportunities</h4>
	
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