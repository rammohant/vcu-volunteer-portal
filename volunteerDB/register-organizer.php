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

<?php require_once('connection.php'); ?>

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

    $check = $conn->prepare("SELECT email FROM users WHERE userID=:volunteerID and type like 'admin'");
    $check->bindValue(':volunteerID',$_SESSION['userID']);
    $check->execute();

    $checkResult = $check->fetch();
        
    if(empty($checkResult)) {
        echo "<p>Access denied: Please log out and login to your admin account to register organizers.</p>";
    } else {
        echo "<h2>Register as Organizer</h2>";
        echo "<form method='post' action='register-organizer.php' style='padding: 10px 20px 10px 20px'>";
        echo "<table>";
        echo "<tbody>";
        echo "<tr><td>First Name</td><td><input name='first_name' type='text' Required></td></tr>";
        echo "<tr><td>Last Name</td><td><input name='last_name' type='text'></td></tr>";
        echo "<tr><td>Email</td><td><input name='email' type='text' Required></td></tr>";
        echo "<tr><td>Password</td><td><input name='password' type='password' Required></td></tr>";
        
        echo "<tr><td>Organization</td><td>";
        // Retrieve list of organizer
        $stmt = $conn->prepare("SELECT orgID,org_name FROM organizations");
        $stmt->execute();
        
        echo "<select name='orgID'>";
        
        while ($row = $stmt->fetch()) {
            echo "<option value='$row[orgID]'>$row[org_name]</option>";
        }
        
        echo "</select>";
        echo "</td></tr>";
    
        echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
        
        echo "</tbody>";
        echo "</table>";
        echo "</form>";
    }
} else {
    
    echo "<tr><td>First Name</td><td><input name='first_name' type='text' Required></td></tr>";
    echo "<tr><td>Last Name</td><td><input name='last_name' type='text'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='text' Required></td></tr>";
    echo "<tr><td>Email</td><td><input name='password' type='text' Required></td></tr>";
    echo "<tr><td>Confirm Password</td><td><input name='password_conf' type='password' Required></td></tr>";

    try {
        //Insert user into user table 
        $stmt = $conn->prepare("INSERT INTO users (email, password, first_name, last_name, type) 
                                VALUES (:email, :password, :first_name, :last_name, :type)");

        //Set parameters
        $param_email = trim($_POST['email']);
        $param_password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Creates a password hash
        $param_firstname = trim($_POST['first_name']);
        $param_lastname = trim($_POST['last_name']);
        $param_type = 'organizer'; 

        $stmt->bindValue(':email',$param_email);
        $stmt->bindValue(':password',$param_password);
        $stmt->bindValue(':first_name',$param_firstname);
        $stmt->bindValue(':last_name',$param_lastname);
        $stmt->bindValue(':type', $param_type);
        
        $stmt->execute();

        //Find userID of user just created and assign to variable
        $stmt2 = $conn->prepare("SELECT userID FROM users WHERE email=:email");
        $stmt2->bindValue(':email', $param_email);
        $stmt2->execute();
        
        $row = $stmt2->fetch();
        $param_userID = $row['userID'];

        //Insert user into organizer table
        $stmt_organizer = $conn->prepare("INSERT INTO organizers (userID, orgID) 
                                VALUES (:userID,:orgID)");

        $stmt_organizer->bindValue(':userID',$param_userID);

        if($_POST['orgID'] != -1) {
        $stmt_organizer->bindValue(':orgID', $_POST['orgID']);
        } else {
        $stmt_organizer->bindValue(':orgID', '1', PDO::PARAM_INT);
        }
        $stmt_organizer->execute();
        

    } catch (PDOException $e) {
        echo "Failed to register manager"; 
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";    
}

?>

</body>
</html>