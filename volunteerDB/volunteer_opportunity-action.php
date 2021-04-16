<?php
require_once ('connection.php');

class VolunteerOpportunities
{
    public function listVolunteerOpportunities()
    {
        global $conn;
        
        $sqlQuery = "SELECT v.eventID as `ID`,
                            v.title as `Title`,
                            v.description as `Description`,
                            v.link as 'Link'
                            v.type as 'Type'
                            CONCAT(v.startdate,' - ', v.enddate) as `Date`,
                            v.available_spots as 'Available Spots'
                            v.needed_skills as 'Skills Needed'
                            v.age_minimum as 'Age Minimum'   
                     FROM volunteer_events v
                     INNER JOIN employees m ON (e.manager_ID = m.employee_ID)
                     INNER JOIN departments d ON (e.department_ID = d.department_ID)";
        
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
            

            $dataTable[] = $dataRow;
        }
        
        $output = array(
            "recordsTotal" => $numberRows,
            "recordsFiltered" => $numberRows,
            "data" => $dataTable
        );
        
        echo json_encode($output);
    }
}

$volunteerops = new VolunteerOpportunities();

if(!empty($_POST['action']) && $_POST['action'] == 'listVolunteerOpportunities') {
    $volunteerops->listVolunteerOpportunities();
}

?>