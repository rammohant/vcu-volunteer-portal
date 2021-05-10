<html>
<head>
<title>Sign up</title>

<style type="text/css">
h3 {
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
    background-image:url('images/bg.png'); 
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
  opacity: 0.90;
}

tr{
    color: #EEEAE9;
    font-family: "Verdana";
}
</style>

<?php require_once('header.php'); ?>
</head>

<?php require_once('connection-volunteer.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="images/VDASH.png" style="height: 28px"></a><li>
	<li class="active"><a href="volunteer_v.php">Volunteer Portal</a></li>
	<li><a href="organizer_v.php">Organizer Portal</a></li>
    <li><a href="orgs.php">Organizations</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<?php 

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    $check = $conn->prepare("SELECT email FROM users WHERE userID=:volunteerID and type like 'volunteer'");
    $check->bindValue(':volunteerID',$_SESSION['userID']);
    $check->execute();

    $checkResult = $check->fetch();
        
    if(empty($checkResult)) {
        echo "<p>Access denied: Please log out and login to your volunteer account to sign up for events.</p>";
    } else {
        echo "<h3>Sign up for a Volunteer Event!</h3>";
        echo "<form method='post' action='signup.php'>";
        echo "<table style='padding: 10px 20px 10px 20px'>";
        echo "<tbody>";

        echo "<tr><td>Select Event:</td><td>";

        // Retrieve list of all available events
        $stmt = $conn->prepare("SELECT v.eventID, v.Title as `Title` FROM  v_allevents v");
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
    }
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