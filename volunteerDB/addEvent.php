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
  width: 100%; 
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

<?php require_once('connection.php'); ?>

<body>

<ul>
	<li><a href="index.php" class="pull-left" style="padding-left: 10px"><img src="VDASH.png" style="height: 28px"></a><li>
	<li class="active"><a href="user_v.php">Volunteer Portal</a></li>
	<li><a href="manager_v.php">Manager Portal</a></li>
	<li><a href="register.php">Register</a></li>
</ul>

<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='addEvent.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Title</td><td><input name='title' type='text'></td></tr>";
    echo "<tr><td>Description</td><td><input name='description' type='text'></td></tr>";
    echo "<tr><td>Start Date</td><td><input name='startdate' type='datetime'></td></tr>";
    echo "<tr><td>End Date</td><td><input name='enddate' type='datetime'></td></tr>";
    echo "<tr><td>Link</td><td><input name='description' type='text'></td></tr>";
    echo "<tr><td>Age Minimum</td><td><input name='age_minimum' type='int'></td></tr>";
    echo "<tr><td>Needed Skills</td><td><input name='needed_skills' type='text'></td></tr>";
    echo "<tr><td>Available Spots</td><td><input name='available_spots' type='int'></td></tr>";
    echo "<tr><td>Type</td><td><input name='type' type='text'></td></tr>";

    // echo "<tr><td>Type</td><td>";

    // // Retrieve list of employees as potential manager of the new employee
    // $stmt = $conn->prepare("Select type from v_volunteer_ops");
    // $stmt->execute();
    
    // while ($row = $stmt->fetch()) {
    //     echo "<option value=''>$row[type]</option>";        
    // }
    
    // echo "</select>";
    // echo "</td></tr>";
    
    echo "<tr><td>Organizer</td><td>";
    // Retrieve list of organizer
    $stmt = $conn->prepare("SELECT userID as organizerID, name FROM allusers where type like 'organizer'");
    $stmt->execute();
    
    echo "<select name='organizerID'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[organizerID]'>$row[name]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
    
    echo "<tr><td>Approved by</td><td>";
    // Retrieve list of admin 
    $stmt = $conn->prepare("SELECT userID as adminID, name FROM allusers where type like 'admin'");
    $stmt->execute();
    
    echo "<select name='adminID'>";
        
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[adminID]'>$row[name]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
 
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
} else {
    
    echo "<tr><td>Title</td><td><input name='title' type='text'></td></tr>";
    echo "<tr><td>Description</td><td><input name='description' type='text'></td></tr>";
    echo "<tr><td>Start Date</td><td><input name='startdate' type='datetime'></td></tr>";
    echo "<tr><td>End Date</td><td><input name='enddate' type='datetime'></td></tr>";
    echo "<tr><td>Link</td><td><input name='description' type='text'></td></tr>";
    echo "<tr><td>Age Minimum</td><td><input name='age_minimum' type='int'></td></tr>";
    echo "<tr><td>Needed Skills</td><td><input name='needed_skills' type='text'></td></tr>";
    echo "<tr><td>Available Spots</td><td><input name='available_spots' type='int'></td></tr>";
    echo "<tr><td>Type</td><td><input name='type' type='text'></td></tr>";
    
    try {
        $stmt = $conn->prepare("INSERT INTO employees (title, description, startdate, enddate, link, age_minimum, needed_skills, available_spots,type, organizerID, adminID)
                                VALUES (:title, :description, :startdate, :enddate, :link, :age_minimum, :needed_skills, :available_spots,:type, :organizerID, :adminID)");

        $stmt->bindValue(':title', trim($_POST['title']));
        $stmt->bindValue(':description', trim($_POST['description']));
        $stmt->bindValue(':startdate', trim($_POST['startdate']));
        $stmt->bindValue(':enddate', trim($_POST['enddate']));
        $stmt->bindValue(':link', trim($_POST['link']));
        $stmt->bindValue(':age_minimum', trim($_POST['age_minimum']));
        $stmt->bindValue(':needed_skills', trim($_POST['needed_skills']));
        $stmt->bindValue(':available_spots', trim($_POST['available_spots']));
        
        
        if($_POST['type'] != -1) {
            $stmt->bindValue(':type', $_POST['type']); }
//         } else {
//             $stmt->bindValue(':type', null, PDO::PARAM_INT);
//         }

        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";    
}

?>

</body>
</html>