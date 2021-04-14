<html>
<head>

<title>Welcome to VDash!</title>

<style type="text/css">

h2 {
    text-align: center;
    font-size: 30px; 
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

/* table { */
/*   width: 100%;  */
/*   background-color: #615F5F; */
/*   opacity: 0.80; */
/* } */

/* tr{ */
/*     color: #EEEAE9; */
/*     font-family: "Verdana"; */
/* } */

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
	<li><a href="signup.php">Sign up</a></li>
	
</ul>

<?php 

global $conn;

$sql = "SELECT orgID, orgname, phone_number,email FROM organizations";
$result = $conn->query($sql);

$sql = "SELECT orgID, org_name, phone_number, email, website FROM v_allorgs where type like 'off-campus org'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<h2>Off Campus Organizations</h2>";
        echo "<table class='table table-dark table-stripped'>";
        echo "<tr>";
        echo "<th>org_name</th>";
        echo "<th>phone_number</th>";
        echo "<th>email</th>";
        echo "<th>website</th>";
        echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $row['org_name'] . "</td>";
            echo "<td>" . $row['phone_number'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['website'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

?>
</body>
</html>
