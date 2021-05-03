<?php 

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {

    echo "<form method='post' action='addEvent.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>Title</td><td><input name='title' type='text'></td></tr>";
    echo "<tr><td>Description</td><td><input name='description' type='text'></td></tr>";
    echo "<tr><td>Start Date</td><td><input name='email' type='datetime'></td></tr>";
    echo "<tr><td>End Date</td><td><input name='salary' type='datetime'></td></tr>";
    echo "<tr><td>Link</td><td><input name='description' type='text'></td></tr>";
    echo "<tr><td>Age Minimum</td><td><input name='age_minimum' type='text'></td></tr>";
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
    echo "<tr><td>Start Date (dd-mm-yyyy)</td><td><input name='startdate' type='date'></td></tr>";
    echo "<tr><td>End Date (dd-mm-yyyy)</td><td><input name='enddate' type='date'></td></tr>";
    echo "<tr><td>Link</td><td><input name='link' type='text'></td></tr>";
    echo "<tr><td>Age Minimum</td><td><input name='age_minimum' type='number'></td></tr>";
    echo "<tr><td>Needed Skills</td><td><input name='needed_skills' type='text'></td></tr>";
    echo "<tr><td>Available Spots</td><td><input name='available_spots' type='number'></td></tr>";
    
    try {
        $stmt = $conn->prepare("INSERT INTO employees (title, description, startdate, enddate, link, age_minimum, needed_skills, available_spots,type, organizerID, adminID)
                                VALUES (:title, :description, :startdate, :enddate, :link, :age_minimum, :needed_skills, :available_spots,:type, :organizerID, :adminID)");

        $stmt->bindValue(':title', $_POST['title']);
        $stmt->bindValue(':description', $_POST['description']);
        $stmt->bindValue(':start_date', $_POST['startdate']);
        $stmt->bindValue(':end_date', $_POST['enddate']);
        $stmt->bindValue(':link', $_POST['link']);
        $stmt->bindValue(':age_minimum', $_POST['age_minimum']);
        $stmt->bindValue(':needed_skills', $_POST['needed_skills']);
        $stmt->bindValue(':needed_skills', $_POST['age_minimum']);
        
        
        if($_POST['type'] != -1) {
            $stmt->bindValue(':type', $_POST['type']); }
//         } else {
//             $stmt->bindValue(':type', null, PDO::PARAM_INT);
//         }
        if($_POST['userID'] != -1) {
            $stmt->bindValue(':userID', $_POST['userID']); 
                     } else {
                         $stmt->bindValue(':userID', null, PDO::PARAM_INT);
                    }
        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }

    echo "Success";    
}

?>