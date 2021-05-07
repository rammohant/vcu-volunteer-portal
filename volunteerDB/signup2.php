<html>
<head>
<title>VDASH Volunteer Portal</title>

<style type="text/css">
h2 {
    text-align: center;
    font-size: 25px; 
    padding-top: 25px; 
    font-family: "Verdana";
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
  font-family: "Verdana"; 
  padding-top: 15px;
  padding-bottom: 15px;
  padding-right: 20px; 
  text-decoration: none;
}

li a:hover {
    background-color: #111;
}

table {
  width: 60%; 
  margin-left: auto; 
  margin-right: auto;
  padding: 10px 20px 10px 20px; 
  background-color: #615F5F;
  opacity: 0.80;
}

tr{
    color: #EEEAE9;
    font-family: "Verdana";
}
</style>

<?php require_once('header.php'); ?>
</head>

<?php require_once('volunteer_connection.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
	<li class="active"><a href="volunteer_v.php">Volunteer Portal</a></li>
	<li><a href="manager_v.php">Manager Portal</a></li>
	<li><a href="register.php">Register</a></li>
</ul>

<?php 

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='signup2.php'>";
    echo "<table>";
    echo "<tbody>";

    echo "<tr><td>Available Events</td><td>";

    // Retrieve list of all available events
    $stmt = $conn->prepare("SELECT v.eventID, v.Title as `Title` FROM  v_volunteer_ops v");

    $stmt->execute();
    
    echo "<select name='eventID'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[eventID]'>$row[Title]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td></td><td><input type='submit' value='Confirm Sign Up'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";

} else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO volunteer_signup (eventID, volunteerID)
                                VALUES (:eventID, :volunteerID)");

        $stmt->bindValue(':volunteerID', $_SESSION['userID']);
    
        if($_POST['eventID'] != -1) {
            $stmt->bindValue(':eventID', $_POST['eventID']);
        } else {
            echo "Please select an event to sign up for.";
        }

        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    header("location:volunteer_v.php"); 
    echo "Success";    
}

?>

</body>
</html>