<!-- will allow ALL users to see volunteer opportunities and sign up if wanted -->
<?php
require_once ('connection.php');
$this->userid = $_SESSION['userid']=$user->id;

class VolunteerSignup
{
    public function listVolunteerSignup()
    {
        global $conn;
        
        $sqlQuery = "SELECT s.eventID as `ID`,
                            v.Title as `Title`,
                            v.description as `Description`,
                            v.link as 'Link',
                            v.type as 'Type',
                            v.DateRange as `Date`,
                            v.available_spots as 'Available Spots',
                            v.needed_skills as 'Skills Needed',
                            v.age_minimum as 'Age Minimum',   
                            v.organization as 'Organization',
                            v.number as 'Contact Number',
                            v.email as 'Contact Email'
                     FROM volunteer_signup s where volunteerID = '$id' 
                    LEFT JOIN v_volunteer_ops v on s.eventID = v.eventID";
       
        // Search by title, description, or type 
        if (! empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE (e.title LIKE "%' . $_POST["search"]["value"] . '%" OR e.description LIKE "%' . $_POST["search"]["value"] . '%" or j.type LIKE "%' . $_POST["search"]["value"] . '%") ';
        }
        
        $stmt = $conn->prepare($sqlQuery);
        $stmt->execute();
        
        $numberRows = $stmt->rowCount();
        
        $dataTable = array();
        
        while ($sqlRow = $stmt->fetch()) {
            $dataRow = array();
            
            $dataRow[] = $sqlRow['ID'];
            $dataRow[] = $sqlRow['Title'];
            $dataRow[] = $sqlRow['Description'];
            $dataRow[] = $sqlRow['Link'];
            $dataRow[] = $sqlRow['Type'];
            $dataRow[] = $sqlRow['Date'];
            $dataRow[] = $sqlRow['Available Spots'];
            $dataRow[] = $sqlRow['Skills Needed'];
            $dataRow[] = $sqlRow['Age Minimum'];
            $dataRow[] = $sqlRow['Organization'];
            $dataRow[] = $sqlRow['Contact Number'];
            $dataRow[] = $sqlRow['Contact Email'];
            
            $dataTable[] = $dataRow;
        }
        
        $output = array(
            "recordsTotal" => $numberRows,
            "recordsFiltered" => $numberRows,
            "data" => $dataTable
        );
        
        echo json_encode($output);
    }
    
    
    public function deleteEmployee()
    {
        global $conn;
        
        if ($_POST["ID"]) {
            
            $sqlQuery = "DELETE FROM volunteer_signup WHERE userid = '$id'";
            
            $stmt = $conn->prepare($sqlQuery);
            $stmt->execute();

        }
    }
}

$volunteersignup = new VolunteerSignup(); 

if(!empty($_POST['action']) && $_POST['action'] == 'listVolunteerSignup') {
    $volunteersignup->listVolunteerSignup();
}

if(!empty($_POST['action']) && $_POST['action'] == 'deleteVolunteerSignup') {
    $volunteersignup->deleteVolunteerSignup();
}



?>