<?php
require_once ('connection.php');

class Manager_VolunteerOpps
{
    public function listVolunteerOpportunities()
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
                     FROM v_volunteer_ops v";
        
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
            
            $dataRow[] = '<button type="button" name="update" emp_id="' . $sqlRow["ID"] . '" class="btn btn-warning btn-sm update">Update</button>
                          <button type="button" name="delete" emp_id="' . $sqlRow["ID"] . '" class="btn btn-danger btn-sm delete" >Delete</button>';
            
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

$volunteerops = new Manager_VolunteerOpps();

if(!empty($_POST['action']) && $_POST['action'] == 'listVolunteerOpportunities') {
    $volunteerops->listVolunteerOpportunities();
}
if(!empty($_POST['action']) && $_POST['action'] == 'addVolunteerOpportunities') {
    $employee->addVolunteerOpportunities();
}
if(!empty($_POST['action']) && $_POST['action'] == 'getVolunteerOpportunities') {
    $employee->getVolunteerOpportunities();
}
if(!empty($_POST['action']) && $_POST['action'] == 'updateVolunteerOpportunities') {
    $employee->updateVolunteerOpportunities();
}
if(!empty($_POST['action']) && $_POST['action'] == 'deleteVolunteerOpportunities') {
    $employee->deleteVolunteerOpportunities();
}


?>