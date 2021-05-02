<?php
require_once ('connection.php');

class VolunteerEvent
{
    public function listVolunteerEvent()
    {
        global $conn;
        
        $sqlQuery = "SELECT v.eventID as `ID`,
                            v.Title as `Title`,
                            v.description as `Description`,
                            v.link as 'Link',
                            v.type as 'Type',
                            v.DateRange as `Date`,
                            v.available_spots as 'Available Spots',
                            v.needed_skills as 'Skills Needed',
                            v.age_minimum as 'Age Minimum'   
                     FROM  v_volunteer_ops v";
        
        // Search by title, description, or type
        if (! empty($_POST["search"]["value"])) {
            $sqlQuery .= 'WHERE (v.Title LIKE "%' . $_POST["search"]["value"] . '%" OR v.Description LIKE "%' . $_POST["search"]["value"] . '%") ';
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

$volunteerevent = new VolunteerEvent();

if(!empty($_POST['action']) && $_POST['action'] == 'listVolunteerEvent') {
    $volunteerevent->listVolunteerEvent();
}

?>