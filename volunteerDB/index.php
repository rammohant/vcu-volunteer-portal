<html>
<head>

<title>Welcome to VDash!</title>

<style type="text/css">

h2 {
    text-align: center;
    font-size: 25px; 
    padding-top: 25px; 
    font-family: "Verdana";
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

</style>

<?php require_once('header.php'); ?>

<script src="js/volunteer_event.js"></script>

</head>

<?php require_once('connection.php'); ?> 

<body>

<ul>
	<li class="active"><a href="index.php" class="pull-left"  style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
	<li><a href="user_v.php">Volunteer Portal</a></li>
	<li><a href="manager_v.php">Manager Portal</a></li>
  <li><a href="orgs.php">Organizations</a></li>
	<li><a href="register.php">Register</a></li>
	
</ul>

<!-- <div class="container-fluid mt-3 mb-3"> 
	<h2>Volunteer Opportunities</h2>
	<div class="table-responsive">
		<table id="volunteer_events" class="table table-dark table-stripped">
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
<div class="container-fluid mt-3 mb-3"> -->

<h2>Volunteer Opportunities</h2>
	<div class="table-responsive">
		<table class='table table-dark table-stripped' style='width:80%; margin-left: 10%; margin-right: 10%; opacity: 90%'>
				<tr>
          <td>ID</td>
					<td>Title</td>
					<td>Description</td>
					<td style='word-wrap: break-word'>Link</td>
					<td>Type</td>
					<td>Date</td>
					<td>Available Spots</td>
					<td>Skills Needed</td>
					<td>Age Min</td>
          <td></td>
				</tr>

      <?php

        $records = mysqli_query($link,"SELECT v.eventID as 'id',
        v.Title as `Title`,
        v.description as `Description`,
        v.link as 'Link',
        v.type as 'Type',
        v.DateRange as `Date`,
        v.available_spots as 'Available Spots',
        v.needed_skills as 'Skills Needed',
        v.age_minimum as 'Age Minimum'   
 FROM  v_volunteer_ops v"); 

        while($data = mysqli_fetch_array($records))
        {
        ?>
          <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['Title']; ?></td>
            <td><?php echo $data['Description']; ?></td>
            <td><?php echo $data['Link']; ?></td>    
            <td><?php echo $data['Type']; ?></td>   
            <td><?php echo $data['Date']; ?></td>     
            <td><?php echo $data['Available Spots']; ?></td>    
            <td><?php echo $data['Skills Needed']; ?></td>    
            <td><?php echo $data['Age Minimum']; ?></td>    
            <td><a href="signup.php?id=<?php echo $data['id']; ?>">Sign Up</a></td>
          </tr>	
        <?php
        }
        ?>
		</table>
	</div>

  <h2>Volunteer Opportunities</h2>
	<div class="table-responsive">
		<table class='table table-dark table-stripped' style='width:80%; margin-left: 10%; margin-right: 10%; opacity: 90%'>
				<tr>
          <td>ID</td>
					<td>Title</td>
					<td>Description</td>
					<td style='word-wrap: break-word'>Link</td>
					<td>Type</td>
					<td>Date</td>
					<td>Available Spots</td>
					<td>Skills Needed</td>
					<td>Age Min</td>
          <td>Organization</td>
					<td>Contact Number</td>
					<td>Contact Email</td>
          <td></td>
				</tr>

      <?php

        $records = mysqli_query($link,"SELECT v.eventID, 
        v.title as 'Title', 
        v.description as 'Description', 
        v.link as 'Link', 
        v.type as 'Type', 
        v.DateRange as 'Date', 
        v.available_spots as 'Available Spots',
        v.needed_skills as 'Skills Needed',
        v.age_minimum as 'Age Minimum',
        v.organization as 'Organization', 
        v.number as 'Contact Number', 
        v.email as 'Contact Email'
        FROM v_all_volunteer_signups v"); 

        while($data = mysqli_fetch_array($records))
        {
        ?>
          <tr>
            <td><?php echo $data['eventID']; ?></td>
            <td><?php echo $data['Title']; ?></td>
            <td><?php echo $data['Description']; ?></td>
            <td><?php echo $data['Link']; ?></td>    
            <td><?php echo $data['Type']; ?></td>   
            <td><?php echo $data['DateRange']; ?></td>     
            <td><?php echo $data['Available Spots']; ?></td>    
            <td><?php echo $data['Skills Needed']; ?></td>    
            <td><?php echo $data['Age Minimum']; ?></td>   
            <td><?php echo $data['Organization']; ?></td>    
            <td><?php echo $data['Contact Number']; ?></td>    
            <td><?php echo $data['Contact Email']; ?></td>    
            <td><a href="delete.php?id=<?php echo $data['eventID']; ?>">Delete</a></td>
          </tr>	
        <?php
        } 
        ?>
		</table>
	</div>

</body>
</html>
