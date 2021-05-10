<html>
<head>
<title>Add Volunteer Event</title>

<style type="text/css">
h2 {
    text-align: center;
    font-size: 20px; 
    padding-top: 25px; 
    font-family: "Verdana";
    font-weight: bold; 
}

p {
    text-align: center;
    font-size: 15px;
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

<?php require_once('connection-organizer.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="images/VDASH.png" style="height: 28px"></a><li>
	<li><a href="volunteer_v.php">Volunteer Portal</a></li>
	<li class="active"><a href="organizer_v.php">Organizer Portal</a></li>
    <li><a href="orgs.php">Organizations</a></li>
    <li><a href="logout.php">Log Out</a></li>
</ul>

<?php 

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    $check = $conn->prepare("SELECT email FROM users WHERE userID=:volunteerID and type like 'organizer'");
    $check->bindValue(':volunteerID',$_SESSION['userID']);
    $check->execute();

    $checkResult = $check->fetch();
        
    if(empty($checkResult)) {
        echo "<p>Access denied: Please log out and login to your manager account to add events.</p>";
    } else {
        echo "<h2>Add a Volunteer Event</h2>";
        echo "<tr><td>Technology</td><td><input name='technology' type='text'></td></tr>";
    
        echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
        
        echo "</tbody>";
        echo "</table>";
        echo "</form>";
    }
} else {

    echo "<tr><td>Technology</td><td><input name='technology' type='text'></td></tr>";

    try {
        $stmt = $conn->prepare("INSERT INTO volunteer_events (title, description, startdate, enddate, link, age_minimum, needed_skills, available_spots,type, organizerID, approverID)
                                VALUES (:title, :description, :startdate, :enddate, :link, :age_minimum, :needed_skills, :available_spots,:type, :organizerID, :approverID)");

        $stmt->bindValue(':title', trim($_POST['title']));
        $stmt->bindValue(':type', trim($_POST['type']));

        if(isset($_POST['age_minimum'])) {
            $stmt->bindValue(':age_minimum', trim($_POST['age_minimum']));
        } else {
            $stmt->bindValue(':age_minimum', NULL);
        }
        
        if(isset($_POST['available_spots'])) {
            $stmt->bindValue(':available_spots', trim($_POST['available_spots']));
        } else {
            $stmt->bindValue(':available_spots', NULL);
        }
        
        if($_POST['organizerID'] != -1) {
            $stmt->bindValue(':organizerID', $_POST['organizerID']);
        } else {
            $stmt->bindValue(':organizerID', '2', PDO::PARAM_INT);
        }

        if($_POST['approverID'] != -1) {
            $stmt->bindValue(':approverID', $_POST['approverID']);
        } else {
            $stmt->bindValue(':approverID', '1', PDO::PARAM_INT);
        }
        
        $stmt->execute();

    } catch (PDOException $e) {
        echo "Failed to add event"; 
        echo "Error: " . $e->getMessage();
        die();
    }

    if($_POST['type']=='virtual event') {
        echo "<tr><td>Technology</td><td>" . $data['technology'] . "</td></tr>";
    }

    if($_POST['type']=='in-person event') {
        echo "<tr><td>Address</td><td>" . $data['address'] . "</td></tr>";
        echo "<tr><td>Vaccine Required</td><td>" . $data['vaccine_required'] . "</td></tr>";
        echo "<tr><td>Precautions</td><td>" . $data['precautions'] . "</td></tr>";
    }

    if($_POST['type']=='donations') {
        echo "<tr><td>Dropoff time</td><td>" . $data['dropoff_time'] . "</td></tr>";
        echo "<tr><td>Dropoff address</td><td>" . $data['dropoff_address'] . "</td></tr>";
        echo "<tr><td>Instructions</td><td>" . $data['instructions'] . "</td></tr>";
    }

    header("location:organizer_v.php"); 
    echo "Success";    
}

?>

</body>
</html>