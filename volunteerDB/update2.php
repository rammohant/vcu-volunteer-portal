<?php
require_once('connection.php'); // Using database connection file here
if(count($_POST)>0) {
    mysqli_query($link,
    "UPDATE employee set eventID='" . $_POST['eventID'] . "', title='" . $_POST['title'] . "', description='" . $_POST['description'] . "' WHERE eventID='" . $_GET['eventID'] . "'");
    $message = "Record Modified Successfully";
}
$result = mysqli_query($link,"select eventID, title, description from volunteer_events WHERE eventID='" . $_GET['eventID'] . "'");
$row= mysqli_fetch_array($result);
?>

<html>
<head>
<title>Update Employee Data</title>
</head>
<body>

<form name="frmUser" method="post" action="">
<div><?php if(isset($message)) { echo $message; } ?>
</div>
<div style="padding-bottom:5px;">
<a href="organizer_v.php">Employee List</a>

</div>
Username: <br>
<input type="hidden" name="eventID" class="txtField" value="<?php echo $row['eventID']; ?>">
<input type="text" name="eventID"  value="<?php echo $row['eventID']; ?>">
<br>
title: <br>
<input type="text" name="title" class="txtField" value="<?php echo $row['title']; ?>">
<br>
description :<br>
<input type="text" name="description" class="txtField" value="<?php echo $row['description']; ?>">
<br>
<input type="submit" name="submit" value="Submit" class="buttom">

</form>
</body>
</html>