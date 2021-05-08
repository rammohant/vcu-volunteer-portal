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
	<li><a href="volunteer_v.php">Volunteer Portal</a></li>
	<li><a href="organizer_v.php">Organizer Portal</a></li>
  <li><a href="orgs.php">Organizations</a></li>
</ul>

<h2>Volunteer Opportunities</h2>
	<div class="table-responsive">
		<table class='table table-dark table-stripped' style='width:80%; margin-left: auto; margin-right: auto; opacity: 90%'>
				<tr>
          <td>ID</td>
					<td>Title</td>
					<td>Description</td>
					<td style='word-wrap: break-word'>Link</td>
					<td>Type</td>
					<td>Date</td>
					<td>Available Spots</td>
					<td>Skills Needed</td>
					<td>Age Minimum</td>
          <td></td>
				</tr>
      <?php

        $records = mysqli_query($link,"SELECT v.eventID,
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
            <td><?php echo $data['eventID']; ?></td>
            <td><?php echo $data['Title']; ?></td>
            <td><?php echo $data['Description']; ?></td>
            <td><?php echo $data['Link']; ?></td>    
            <td><?php echo $data['Type']; ?></td>   
            <td><?php echo $data['Date']; ?></td>     
            <td><?php echo $data['Available Spots']; ?></td>    
            <td><?php echo $data['Skills Needed']; ?></td>    
            <td><?php echo $data['Age Minimum']; ?></td>    
          </tr>	
        <?php
        }
        ?>
		</table>
	</div>
  <div id="center_button" style='padding-bottom: 20px'>
    <button onclick="location.href='signup.php'">Sign Up</button>
</div>
</body>
</html>
