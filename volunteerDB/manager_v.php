<html>
<head>
<title>HR database - Organizer/Admin View</title>
<!-- check if user is logged in and a manager -->
<?php 
if (!isset($_SESSION['userID']))
{
    // If the page is receiving the email and password from the login form then verify the login data
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $stmt = $conn->prepare("SELECT userID, password FROM users WHERE email=:email and type IN ('manager','admin')");
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->execute();
        
        $queryResult = $stmt->fetch();
        
        // Verify password submitted by the user with the hash stored in the database
        if(!empty($queryResult) && password_verify($_POST["password"], $queryResult['password']))
        {
            // Create session variable
            $_SESSION['userID'] = $queryResult['userID'];
            
            // Redirect to URL
            header("Location: http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        } else {
            // Password mismatch
            require('login.php');
            echo("Please login to your manager account to access this page.");
            exit();
        }
    }
    else
    {
        // Show login page
        require('login.php');
        echo("Please login to your manager account to access this page.");
        exit();
    }
}
?>

<?php require_once('header.php'); ?>

<!-- Font Awesome library -->
<script src="https://kit.fontawesome.com/c6c713cdbc.js"></script>

<!-- JS libraries for datatables buttons-->
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script src="js/manager_v.js"></script>

<!-- CSS for datatables buttons -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"/>

</head>


<?php require_once('connection.php'); ?>

<body>

<div class="container-fluid mt-3 mb-3">
	<h4>Volunteer Opportunities</h4>
	
	<div class="pb-3">
		<button type="button" id="addEvent" class="btn btn-primary btn-sm">Add Event</button>
	</div> 
        	
	<div class="table-responsive">
		<table id="volunteer_events" class="table table-bordered table-striped">
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

<div id="event-modal" class="modal fade">
	<div class="modal-dialog">
		<form method="post" id="event-form">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Event</h4>
				</div>
				<div class="modal-body">
					<div class="form-group">

						<label>Title</label><input type="text" class="form-control" id="title" placeholder="Enter title" required>
						
						<label>Description</label> <input type="text" class="form-control" id="description" placeholder="Enter description">
						
						<label>Start Date</label> <input type="text" class="form-control" id="startdate" placeholder="Enter start date" required>
						
						<label>End Date</label> <input type="text" class="form-control" id="enddate" placeholder="Enter end date">
						
						<label>Link</label> <input type="text" class="form-control" id="startdate" placeholder="Enter link">
						
						<label>Available Spots</label> <input type="number" class="form-control" id="available_spots">
						
						<label>Skills Needed</label> <input type="text" class="form-control" id="needed_skills" placeholder="Enter skills needed">
																							
						<label>Type</label>
						<select class="form-control" id="department" required>
            			    <?php
            			        $sqlQuery = "SELECT DISTINCT type from volunteer_events";
            			        $stmt = $conn->prepare($sqlQuery);
            			        $stmt->execute();
            			        while ($row = $stmt->fetch()) {
            			            echo "<option value=\"" . $row["type"] . "\">" . $row["type"] . "</option>";
            			        }
                            ?>
            			</select>
            			
            			<label>Organizer</label>
						<select class="form-control" id="manager" required>
            			    <?php
            			        $sqlQuery = "SELECT userID, CONCAT(first_name, ' ', last_name) as 'name' from users where type like 'organizer'";
            			        $stmt = $conn->prepare($sqlQuery);
            			        $stmt->execute();
            			        while ($row = $stmt->fetch()) {
            			            echo "<option value=\"" . $row["userID"] . "\">" . $row["name"] . "</option>";
            			        }
                            ?>
            			</select>
            			
            			<label>Approved By</label>
						<select class="form-control" id="job" required>
            			    <?php
            			        $sqlQuery = "SELECT userID, CONCAT(first_name, ' ', last_name) as 'name' from users where type like 'admin'";
            			        $stmt = $conn->prepare($sqlQuery);
            			        $stmt->execute();
            			        while ($row = $stmt->fetch()) {
            			            echo "<option value=\"" . $row["userID"] . "\">" . $row["name"] . "</option>";
            			        }
                            ?>
            			</select>

					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="ID" id="ID"/>
					<input type="hidden" name="action" id="action" value=""/>
					<input type="submit" name="save" id="save" class="btn btn-info" value="Save" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>

</body>
</html>