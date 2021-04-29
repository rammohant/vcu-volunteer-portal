<!-- Managers and Admin should only only be manually entered  -->
<?php

require_once('connection.php');

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    
    echo "<form method='post' action='addUser.php'>";
    echo "<table style='border: solid 1px black;'>";
    echo "<tbody>";
    echo "<tr><td>First name</td><td><input name='first_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Last name</td><td><input name='last_name' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='email' type='email' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='languages' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='skills' type='text' size='25'></td></tr>";
    echo "<tr><td>Email</td><td><input name='vaccinated' type='text' size='25'></td></tr>";
    echo "<tr><td>Manager</td><td>";
    
    $stmt = $conn->prepare("SELECT universityID, university_name, last_name FROM Universities");
    $stmt->execute();
    
    echo "<select name='universityID'>";
        
    while ($row = $stmt->fetch()) {
        echo "<option value='$row[universityID]'>$row[university_name]</option>";
    }
    
    echo "</select>";
    echo "</td></tr>";
        
    echo "<tr><td></td><td><input type='submit' value='Submit'></td></tr>";
    
    echo "</tbody>";
    echo "</table>";
    echo "</form>";
} else {
    
    try {
        $stmt = $conn->prepare("INSERT INTO Users (first_name, last_name, email, universityID, languages, skills, vaccinated)
                                VALUES (:first_name, :last_name, :email, :universityID, :languages, :skills, :vaccinated)");
        
        $stmt->bindValue(':first_name', $_POST['first_name']);
        $stmt->bindValue(':last_name', $_POST['last_name']);
        $stmt->bindValue(':email', $_POST['email']);
        $stmt->bindValue(':job_id', $_POST['job_id']);
        $stmt->bindValue(':salary', $_POST['salary']);
        
        if($_POST['universityID'] != -1) {
            $stmt->bindValue(':universityID', $_POST['universityID']);
        } else {
            $stmt->bindValue(':universityID', null, PDO::PARAM_INT);
        }

        
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        die();
    }
    
    echo "Success";
}

?>