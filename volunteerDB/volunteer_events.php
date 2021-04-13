<?php 

require_once('connection.php');

if (!isset($_GET['eventID'])) {

    // Retrieve list of employees
    $stmt = $conn->prepare("SELECT title, description, type, available_spots, category, age_minimum, needed_skills FROM volunteer_events ORDER BY startdate, enddate");
    $stmt->execute();
    
    echo "<form method='get'>";
    echo "<select name='eventID' onchange='this.form.submit();'>";
    
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[eventID]'>$row[title]</option>";
    }
    
    echo "</select>";
    echo "</form>";
} else {
      
}

?>